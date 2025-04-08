<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;

class BookinPaymentController extends Controller
{
    public function PaymentIndex(){
        
        return view('Payment.paybooking');
    }

    public function checkout(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Hotel Booking Payment',
                    ],
                    'unit_amount' => $request->amount * 100, // Convert to cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
        ]);

        return redirect($session->url);
 
    }
}


public function bookRoom(Request $request)
{
    // Validate the incoming request data (you can add more validation rules if needed)
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|numeric',
        'checkin' => 'required|date|after_or_equal:today',
        'checkout' => 'required|date|after:checkin',
        'adults' => 'required|integer|min:1',
        'children' => 'required|integer|min:0',
        'room_id' => 'required|exists:rooms,id',
    ]);

    // Get the room based on the selected room ID
    $room = Room::with('roomType')->find($request->room_id); // Use 'with' to eager load the roomType
    
    // Check if the room exists and if the roomType is available
    if (!$room || !$room->roomType) {
        return back()->with('error', 'Selected room or room type not found.');
    }
    
    // Get the price from the room type
    $amount = $room->roomType->price * 100; // Price in cents for Stripe
    
    // Check if the room is already booked for the selected dates
    $existingBooking = Booking::where('room_id', $room->id)
        ->where(function ($query) use ($request) {
            // Check if the check-in or check-out dates overlap with any existing booking
            $query->whereBetween('check_in_date', [$request->checkin, $request->checkout])
                  ->orWhereBetween('check_out_date', [$request->checkin, $request->checkout])
                  ->orWhere(function ($query) use ($request) {
                      // Check if the requested dates are within the existing booking range
                      $query->where('check_in_date', '<=', $request->checkout)
                            ->where('check_out_date', '>=', $request->checkin);
                  });
        })
        ->exists();

    // If the room is already booked, return an error message
    if ($existingBooking) {
        return back()->with('error', 'The selected room is already booked for the chosen dates.');
    }

    // Set the Stripe API key
    \Stripe\Stripe::setApiKey('sk_test_51OoNuEBpUHEIlldCIJ87U06v1f83YOa160BH0EZyFRvDTQ3R00jRtUY4nTseeRhnD7JxvuuXQM90XrPaAqAbn1cK00ifRpf15q'); // Your Stripe secret key

    // Create the Stripe Checkout session
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => $room->name, // Use the room name
                ],
                'unit_amount' => $amount, // Price in cents
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => route('booking.success') . '?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => route('booking.cancel'),
        'metadata' => [
            'customer_name' => $request->name,
            'customer_email' => $request->email,
            'room_id' => $room->id,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
        ],
    ]);

    // Redirect the user to the Stripe checkout page
    return redirect($session->url);

    public function booking_payment_success(Request $request)
{
    $sessionId = $request->get('session_id');

    try {
        $session = \Stripe\Checkout\Session::retrieve($sessionId);

        // Retrieve the customer metadata (that was added during session creation)
        $customerName = $session->metadata->customer_name;
        $customerEmail = $session->metadata->customer_email;
        $roomId = $session->metadata->room_id;
        $checkinDate = $session->metadata->checkin;
        $checkoutDate = $session->metadata->checkout;

        // Create the booking in the database
        $booking = Booking::create([
            'guest_name' => $customerName,
            'guest_email' => $customerEmail,
            'room_id' => $roomId,
            'check_in_date' => $checkinDate,
            'check_out_date' => $checkoutDate,
            'adults' => 1, // Adjust as needed
            'children' => 0, // Adjust as needed
            'status' => 'confirmed', // Mark as confirmed once payment is successful
        ]);

        // Redirect to the success page
        return redirect()->route('booking.success')->with('success', 'Payment was successful. Your booking has been confirmed!');
        
    } catch (\Exception $e) {
        // Handle errors
        return back()->with('error', 'Error: ' . $e->getMessage());
    }
}

}
