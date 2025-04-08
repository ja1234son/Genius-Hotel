<?php

namespace App\Models;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Room extends Model
{
    use HasFactory;
    protected $table = "rooms";
    protected $fillable = ([
        "name","room_type_id"
    ]);

    public function Roomtype(){
        return $this->belongsTo(RoomType::class, 'room_type_id');
    }

    /**
     * Get the bookings that owns the Room
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bookings(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }
}
