<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use App\Models\RoomTypeImage;
use Illuminate\Http\Request;

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
       $request->validate([
           "name" => "required|string",
           "price" => "required",
           "images" => "required",
       ]);
       $data = new RoomType();
       $data->name = $request->name;
        $data->price = $request->price;
        // Uploading Multiple Images In DB::
        foreach ($request->file('images') as $img){
            $extension = $img->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $imgpath= $img->move('assets/RoomImages',$filename);
            $data->profile = $filename;
            $res = $data->save();
        }
        if ($res){
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
        $request->validate([
            "name" => "required|string",
            "price" => "required",
            "images" => "required",
        ]);
        $data = RoomType::find($id);
        $data->name = $request->name;
        $data->price = $request->price;

//        Updating Uploading Multiple Images in DB::
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $img) {
                $extension = $img->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $imgpath = $img->move('assets/RoomImages', $filename);
                $data->profile = $filename;
                $res = $data->save();
            }
            if ($res){
                return redirect()->back()->with('success','Roomtype updated successfully');
            }else{
                return redirect()->back()->with('error','Roomtype updating failed');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $data = RoomType::where('id',$id)->delete();
        return redirect()->back()->with('success','Roomtype deleted successfully');
    }
}
