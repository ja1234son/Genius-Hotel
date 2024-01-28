<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\RoomType;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffs = Staff::all();
        return view('Staffs.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $depart = Department::all();
        return view('Staffs.create', compact('depart'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "full_name" => "required",
            "department_id" => "required",
            "photo" => "required",
            "salary_type" => "required",
            "salary_amount" => "required"
        ]);

        $data = new Staff();
        $data->full_name = $request->full_name;
        $data->department_id = $request->department_id;
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('assets/StaffImages', $filename);
            $data->photo = $filename;
        }
        $data->salary_type = $request->salary_type;
        $data->salary_amount = $request->salary_amount;
        $res = $data->save();
        if ($res) {
            return redirect()->back()->with('success', 'Staff registered successfully');
        } else {
            return redirect()->back()->with('success', 'Staff registration failed');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $staff = Staff::find($id);
        return view('Staffs.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $depart = Department::all();
        $staff = Staff::find($id);
        return view('Staffs.edit', compact('depart', 'staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "full_name" => "required",
            "department_id" => "required",
//            "photo" => "required",
            "salary_type" => "required",
            "salary_amount" => "required",
        ]);

        $data = Staff::find($id);
        if ($request->hasFile('photo')){
//Upload new image
           $file = $request->file('photo');
           $extension = $file->getClientOriginalExtension();
           $filename = time().'.'.$extension;
           $imgpath = $file->move(public_path('assets/StaffImages'),$filename);
           $data->photo = $filename;
        }else{
//Save the  old image if it exists
            $file = $request->old_photo;
        }
        $data->full_name = $request->full_name;
        $data->department_id = $request->department_id;
        $data->salary_type = $request->salary_type;
        $data->salary_amount = $request->salary_amount;
        $res = $data->save();
        if ($res){
            return redirect()->back()->with('success', 'Staff updated  successfully');
        }else{
            return redirect()->back()->with('success', 'Staff updating failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }

    private function deleteImage($old_image)
    {
        $imagePath = public_path('StaffImages/' . $old_image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }
}
