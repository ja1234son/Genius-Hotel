<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;
    protected $table = "room_types";
    protected $fillable =([
        'title','detail','price',
    ]);

    public function Room(){
        return $this->hasMany(Room::class);
    }
    public function Roomtypeimg(){
        return $this->hasMany(RoomTypeImage::class,'room_type_id');
    }
}
