<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if (Auth()->user()->cannot('View Rooms')) {
        //     abort(403, 'Access Denied');
        // }
        $room = Room::all();
        return view('Room.index',compact('room'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // if (Auth()->user()->cannot('Manage Rooms')) {
        //     abort(403, 'Access Denied');
        // }
        $roomtyp = RoomType::all();
       return view('Room.create',compact('roomtyp'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // if (Auth()->user()->cannot('Manage Rooms')) {
        //     abort(403, 'Access Denied');
        // }

        $request->validate(
            [
            "name" => "required",
            "room_type_id" => "required"
            ],
            [
                'name.required' => 'The Room  Name field is required',
                'room_type_id.required' => 'The Room Type  field is required',
            ]
    );
        $data = new Room();
        $data->name = $request->name;
        $data->room_type_id = $request->room_type_id;
        $res = $data->save();
        if ($res){
            if (isset($_POST["save_close"])) {
                  return redirect(url('rooms'))->with('success','Room registered successfully');
            }
               return redirect()->back()->with('success','Room registered successfully');
        }else {
                return redirect()->back()->with('error','Room registration failed');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // if (Auth()->user()->cannot('Manage Rooms')) {
        //     abort(403, 'Access Denied');
        // }

        $data = Room::find($id);
        return view('Room.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        // if (Auth()->user()->cannot('Manage Rooms')) {
        //     abort(403, 'Access Denied');
        // }

      $roomtype = RoomType::all();
      $data = Room::find($id);
      return view('Room.edit',compact('data','roomtype'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // if (Auth()->user()->cannot('Manage Rooms')) {
        //     abort(403, 'Access Denied');
        // }

      $request->validate(
        [
          'name' => 'required',
          'room_type_id' => 'required',
        ],
        [
            'name.required' => 'The Room  Name field is required',
            'room_type_id.required' => 'The Room Type  field is required',
        ]
    );
      $data = Room::find($id);
      $data->name = $request->name;
      $data->room_type_id = $request->room_type_id;
      $res = $data->save();

      if ($res){
        if (isset($_POST["save_close"])) {
              return redirect(url('rooms'))->with('success','Room updated successfully');
        }
           return redirect()->back()->with('success','Room updated successfully');
    }else {
            return redirect()->back()->with('error','Room updating failed');
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){

        $room = Room::find($id);

        if (!$room) {
            return response()->json(['error' => 'Room not found.'], 404);
        }

        $room->delete();
        return response()->json(['success' => 'Room deleted successfully!']);
    }

    public function get_rooms() {
        $allrooms = RoomType::with('room')->get();
        return view('landing.rooms', ['allrooms' => $allrooms]);
    }
    
}
