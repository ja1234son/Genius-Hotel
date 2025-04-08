<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Staff;
use App\Models\RoomType;
use App\Models\Department;
use Illuminate\Http\Request;

class HomeLandingController extends Controller
{
    //

    public function HomeIndex(){

        $rooms =  RoomType::with('room')->get();
        $staffs = Staff::all();

        //Count numbers of Staffs, Rooms and  Department//
        $roomstotal= Room::count();
        $staffstotal = Staff::count();
        $departtotal = Department::count();
      return view('landing.home',compact('rooms','staffs','roomstotal','staffstotal','departtotal'));
    }


}
