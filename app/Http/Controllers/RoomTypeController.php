<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;



class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = RoomType::all();
        $count = RoomType::count();
        return view('Roomtype.index',compact('data','count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Roomtype.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate(
        [
           "name" => "required|string",
           "price" => "required",
           "images" => "required",
        ],

       [
        'name.required' => 'The Room Type Name field is required',
        'price.required' => 'The Room Type Price field is required',
        'images.required' => 'The Room Type Image field is required',
    ]
    );
       $data = new RoomType();
       $data->name = $request->name;
        $data->price = $request->price;
        // Uploading Multiple Images In DB::
        foreach ($request->file('images') as $img){
            $filename = $img->getClientOriginalName();
            $img->move('assets/RoomImages',$filename);
            $data->profile = $filename;
            $res = $data->save();
        }
        if ($res) {
            if (isset($_POST["save_close"])) {
                return redirect(url('roomtypes'))->with('success','Roomtype registered successfully');
        }
               return redirect()->back()->with('success','Roomtype registered successfully');
    }else{
         return redirect()->back()->with('error','Roomtype registration failed');
    }
  }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = RoomType::find($id);
        return view('Roomtype.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = RoomType::find($id);
        return view('Roomtype.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
            "name" => "required|string|max:2048",
            "price" => "required|numeric|max:400000000",
            "images" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            ],
            [
                'name.required' => 'The Room Type Name field is required',
                'price.required' => 'The Room Type Price field is required',
                'images.mimes' => 'The  Room Type Image must be of type jpeg, png, jpg, or gif',
                'images.image' => 'The Room Type Image must be an image file',
            ]
    );
        $data = RoomType::find($id);
        $data->name = $request->name;
        $data->price = $request->price;

//        Updating Uploading Multiple Images in DB::
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $filename = $img->getClientOriginalName();
                 $img->move('assets/RoomImages', $filename);
                $data->profile = $filename;
            }
        }else {
            $data->profile = $request->old_images;
        }
        $res = $data->save();

        if ($res) {
            if (isset($_POST["save_close"])) {
                return redirect(url('roomtypes'))->with('success', 'Roomtype updated successfully');
            }
            return back()->with('success', 'Roomtype Updated Successfully');
        } else {
            return back()->with('error', 'Roomtype Updating Failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $data = RoomType::find($id);
       if ( $data->profile) {
           $imgpath = public_path('RoomImages').'/'. $data->profile;
           if (file_exists($imgpath)) {
              unlink($imgpath);
           }
       }
       $res = $data->delete();
       if ($res) {
        return back()->with('success', 'Roomtype Deleted Successfully');
    } else {
        return back()->with('error', 'Roomtype Deleting Failed');
    }
    }
}
