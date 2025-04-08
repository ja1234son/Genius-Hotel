<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;

class BookingController extends Controller
{
    //
/////  User Customer Booking////
public function bookRoomindex()
{
    // Fetch all available rooms
    $rooms = Room::with('roomType')->where('is_available', true)->get();
    
    // Return the view and pass the $rooms variable
    return view('landing.book-room', compact('rooms'));
}

public function bookRoom(Request $request)
{
    // Validate the form input
    $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'required|string|min:10', // Validate phone number
        'checkin' => 'required|date|after_or_equal:today', // Ensures check-in is today or in the future
        'checkout' => 'required|date|after_or_equal:checkin', // Ensures check-out is after check-in date
         'adults' => 'required|integer|min:1', // Allow at least 1 adult
        'children' => 'nullable|integer|min:0', // Allow any number of children or none
        'room_id' => 'required|exists:rooms,id', // Ensure the room exists
        'special_request' => 'nullable|string|max:1000', // Optional special request
    ]);

    // Get the selected dates and room
    $checkinDate = $request->input('checkin');
    $checkoutDate = $request->input('checkout');
    $roomId = $request->input('room_id');

    $room = Room::with('roomType')->find($request->room_id); // Use 'with' to eager load the roomType
    
    // Check if the room exists and if the roomType is available
    if (!$room || !$room->roomType) {
        return back()->with('error', 'Selected room or room type not found.');
    }
    
    // Get the price from the room type
    $amount = $room->roomType->price * 100; // 

    // Check if the room is already booked during the selected dates
    $booked = Booking::where('room_id', $room->id)
        ->where(function ($query) use ($checkinDate, $checkoutDate) {
            $query->whereBetween('check_in_date', [$checkinDate, $checkoutDate])
                  ->orWhereBetween('check_out_date', [$checkinDate, $checkoutDate])
                  ->orWhere(function ($query) use ($checkinDate, $checkoutDate) {
                      $query->where('check_in_date', '<=', $checkinDate)
                            ->where('check_out_date', '>=', $checkoutDate);
                  });
        })
        ->exists();

    if ($booked) {
        return back()->with('error', 'This room is already booked for the selected dates. Please choose another room.');
    }

    // Set the Stripe API key
    \Stripe\Stripe::setApiKey('sk_test_51OoNuEBpUHEIlldCIJ87U06v1f83YOa160BH0EZyFRvDTQ3R00jRtUY4nTseeRhnD7JxvuuXQM90XrPaAqAbn1cK00ifRpf15q'); // Your Stripe secret key

   // Save the booking with 'pending' status before redirecting to Stripe
   $booking = new Booking();
   $booking->guest_name = $request->name;
   $booking->guest_email = $request->email;
   $booking->phone = $request->phone;
   $booking->check_in_date = $checkinDate;
   $booking->check_out_date = $checkoutDate;
   $booking->special_request = $request->special_request;
   $booking->adults = $request->adults;
   $booking->children = $request->childrens ?? null;
   $booking->room_id = $room->id;
   $booking->status = 'pending'; // Set status as 'pending'
   $booking->save(); // Save the booking to get the ID

   // Set the Stripe API key
   \Stripe\Stripe::setApiKey(env('STRIPE_SECRET')); // Ensure to use your environment's secret key

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
       'success_url' => route('booking.success') . '?session_id={CHECKOUT_SESSION_ID}', // Add session_id to the URL
       'cancel_url' => route('booking.cancel'). '?session_id={CHECKOUT_SESSION_ID}',   
       'metadata' => [
           'customer_name' => $request->name,
           'customer_email' => $request->email,
           'room_id' => $room->id,
           'checkin' => $checkinDate,
           'checkout' => $checkoutDate,
           'booking_id' => $booking->id, // Save the booking ID for later reference
       ],
   ]);

   // Update the booking record with the Stripe session ID
   $booking->stripe_session_id = $session->id;
   $booking->save();

   // Redirect the user to the Stripe checkout page
   return redirect($session->url);
}

public function success(Request $request)
{
    // Retrieve the session ID from the URL
    $sessionId = $request->query('session_id');

    if (!$sessionId) {
        return redirect()->route('booking.form');
    }

    // Set the Stripe API key and retrieve the session
    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    $session = \Stripe\Checkout\Session::retrieve($sessionId);

    if ($session->payment_status === 'paid') {
        // Retrieve the booking using the session ID
        $booking = Booking::where('stripe_session_id', $sessionId)->first();

        if ($booking) {
            // Update the booking status to 'complete'
            $booking->status = 'confirmed';
            $booking->save();

            return redirect()->route('booking.success')->with('success', 'Payment successful! Booking is confirmed.');
        } else {
            return redirect()->route('booking.form')->with('error', 'Booking not found.');
        }
    } else {
        return redirect()->route('booking.form')->with('error', 'Payment not completed.');
    }
}

    // Retrieve the room ID from the query parameter
//     public function booking_payment_cancel(Request $request)
// {
//     // Get the session_id from the cancel URL
//     $sessionId = $request->query('session_id');  // Retrieve session_id passed in the cancel URL

//     if (!$sessionId) {
//         return redirect()->route('booking.form')->with('error', 'Payment session id is missing.');
//     }
    
//     // Find the booking by the Stripe session_id
//     $booking = Booking::where('stripe_session_id', $sessionId)->first();

//     if ($booking) {
//         $booking->status = 'cancelled';
//         $booking->save();

//         return redirect()->route('booking.cancel')->with([
//             'success' => 'Your booking has been cancelled successfully.',
//             'booking' => $booking
//         ]);
//     } else {
//         return redirect()->route('home')->with('error', 'Booking not found for the session ID.');
//     }
// }

public function booking_payment_cancel(Request $request)
{
    // Retrieve the session_id from the cancel URL
    $sessionId = $request->query('session_id');

    if (!$sessionId) {
        return redirect()->route('booking.form')->with('error', 'Payment session ID is missing.');
    }

    // Find the booking by the Stripe session ID
    $booking = Booking::where('stripe_session_id', $sessionId)->first();

    if ($booking) {
        // Update the status to 'cancelled'
        $booking->status = 'cancelled';
        $booking->save();

        return redirect()->route('booking.form')->with('success', 'Your booking has been cancelled successfully.');
    } else {
        return redirect()->route('booking.form')->with('error', 'Booking not found for the session ID.');
    }
}
    
    public function AdminBookingIndex(){

        $bookings = Booking::get();
        return view('Bookings.index',compact('bookings'));

    }

    public function AdminBookingdestroy($id){

        $adminBooking = Booking::find($id);

        if (!$adminBooking) {
            return back()->with('error', 'Booking request not found.');
        }

        $adminBooking->delete();
        return back()->with('success','Booking request deleted successfully!');
    }

     // New function for checking room availability via AJAX
     public function checkAvailability(Request $request)
     {
         $checkinDate = $request->input('checkin');
         $checkoutDate = $request->input('checkout');
     
         // Fetch all rooms
         $rooms = Room::all();
     
         // If no dates are provided, return all rooms
         if (!$checkinDate || !$checkoutDate) {
             return response()->json([
                 'success' => count($rooms) > 0,
                 'rooms' => $rooms
             ]);
         }
     
         // Filter out unavailable rooms based on the selected dates
         $availableRooms = [];
         foreach ($rooms as $room) {
             $booked = Booking::where('room_id', $room->id)
                 ->where(function ($query) use ($checkinDate, $checkoutDate) {
                     $query->whereBetween('check_in_date', [$checkinDate, $checkoutDate])
                         ->orWhereBetween('check_out_date', [$checkinDate, $checkoutDate])
                         ->orWhere(function ($query) use ($checkinDate, $checkoutDate) {
                             $query->where('check_in_date', '<=', $checkinDate)
                                 ->where('check_out_date', '>=', $checkoutDate);
                         });
                 })
                 ->exists();
     
             // If the room is not booked, add it to the available rooms array
             if (!$booked) {
                 $availableRooms[] = $room;
             }
         }
     
         return response()->json([
             'success' => count($availableRooms) > 0,
             'rooms' => $availableRooms
         ]);
     }
     
     

}