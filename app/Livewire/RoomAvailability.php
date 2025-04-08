<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Room;
use App\Models\Booking;
use Carbon\Carbon;

class RoomAvailability extends Component
{
    public $checkin;
    public $checkout;
    public $availableRooms = [];
    public $rooms = [];
    public $room_id;
    public $errorMessage = '';

    public function mount()
    {
        $this->rooms = Room::all(); // Load all rooms initially
        $this->availableRooms = $this->rooms; // Show all rooms by default
    }

    public function updated($propertyName)
    {
        if ($this->checkin && $this->checkout) {
            $this->checkRoomAvailability();
        } else {
            $this->availableRooms = $this->rooms; // Reset available rooms when no dates
            $this->errorMessage = ''; 
        }
    }

    public function checkRoomAvailability()
    {
        if (!$this->checkin || !$this->checkout) {
            return; // Exit if dates are not selected
        }

        $checkinDate = Carbon::parse($this->checkin);
        $checkoutDate = Carbon::parse($this->checkout);

        // Get IDs of booked rooms for the selected dates
        $bookedRoomIds = Booking::where(function ($query) use ($checkinDate, $checkoutDate) {
                $query->whereBetween('check_in_date', [$checkinDate, $checkoutDate])
                      ->orWhereBetween('check_out_date', [$checkinDate, $checkoutDate])
                      ->orWhere(function ($query) use ($checkinDate, $checkoutDate) {
                          $query->where('check_in_date', '<=', $checkinDate)
                                ->where('check_out_date', '>=', $checkoutDate);
                      });
            })
            ->pluck('room_id') // Get only booked room IDs
            ->toArray();

        // Filter rooms that are NOT booked
        $this->availableRooms = $this->rooms->whereNotIn('id', $bookedRoomIds);

        // Show error if no rooms available
        $this->errorMessage = empty($this->availableRooms) ? 'No rooms available for the selected dates.' : '';
    }

    public function render()
    {
        return view('livewire.room-availability');
    }
}
