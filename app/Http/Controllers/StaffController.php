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
    //     if (Auth()->user()->cannot('View Staffs')) {
    //     abort(403, 'Access Denied');
    // }
        $staffs = Staff::all();
        return view('Staffs.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // if (Auth()->user()->cannot('Manage Staffs')) {
        //     abort(403, 'Access Denied');
        // }
        
        $depart = Department::all();
        return view('Staffs.create', compact('depart'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // if (Auth()->user()->cannot('Manage Staffs')) {
        //     abort(403, 'Access Denied');
        // }
        $request->validate(
            [
            "full_name" => "required",
            "email" => "required|email|unique:staff",
            "department_id" => "required",
            "photo" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
            "salary_type" => "required",
            "salary_amount" => "required"
            ],
            [
                'full_name.required' => 'The Full Name field is required',
                'email.required' => 'The Email field is required',
                'email.email' => 'The Email must be valid email',
                'email.unique' => 'The Email has already  been  taken',
                'department_id.required' => 'The Department field is required',
                'photo.mimes' => 'The  Staff photo must be of type jpeg, png, jpg, or gif',
                'photo.image' => 'The Staff photo  must be an image file',
                 'salary_type.required' =>'The Salary Type field is required',
                 'salary_amount.required' => 'The Salary Amount field is required',
            ]
    );

       $staff = new Staff();
       $staff->full_name = $request->full_name;
       $staff->email = $request->email;
       if ($request->hasFile('photo')) {
        $file = $request->file('photo');
        $filename = $file->getClientOriginalName();
        $file->move('assets/StaffImages', $filename);
        $staff->photo = $filename;
       }
       $staff->department_id = $request->department_id;
       $staff->salary_type = $request->salary_type;
       $staff->salary_amount = $request->salary_amount;
       $res = $staff->save();
         if ($res) {
            if (isset($_POST["save_close"])) {
               return redirect(url('staffs'))->with('success', 'Staff registered successfully');
             }
            return redirect()->back()->with('success', 'Staff registered successfully');
           }else {
            return redirect()->back()->with('success', 'Staff registered successfully');
         }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // if (Auth()->user()->cannot('Manage Staffs')) {
        //     abort(403, 'Access Denied');
        // }
        $staff = Staff::find($id);
        return view('Staffs.show', compact('staff'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // if (Auth()->user()->cannot('Manage Staffs')) {
        //     abort(403, 'Access Denied');
        // }
        $depart = Department::all();
        $staff = Staff::find($id);
        return view('Staffs.edit', compact('depart', 'staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // if (Auth()->user()->cannot('Manage Staffs')) {
        //     abort(403, 'Access Denied');
        // }
        $request->validate(
            [
                "full_name" => "required",
                "email" => "required|email|",
                "department_id" => "required",
                "photo" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
                "salary_type" => "required",
                "salary_amount" => "required"
                ],
                [
                    'full_name.required' => 'The Full Name field is required',
                    'email.required' => 'The Email field is required',
                    'email.email' => 'The Email must be valid email',
                    'department_id.required' => 'The Department field is required',
                    'photo.mimes' => 'The  Staff photo must be of type jpeg, png, jpg, or gif',
                    'photo.image' => 'The Staff photo  must be an image file',
                     'salary_type.required' =>'The Salary Type field is required',
                     'salary_amount.required' => 'The Salary Amount field is required',
                ]
    );
        $data = Staff::find($id);
        $data->full_name = $request->full_name;
       $data->email = $request->email;
       if ($request->hasFile('photo')) {
          $file = $request->file('photo');
          $filename = $file->getClientOriginalName();
          $file->move('assets/StaffImages',$filename);
          $data->photo = $filename;
       }else {
           $data->photo = $request->old_photo;
       }
        $data->department_id = $request->department_id;
        $data->salary_type = $request->salary_type;
        $data->salary_amount = $request->salary_amount;
        $res = $data->save();

        if ($res) {
            if (isset($_POST["save_close"])) {
               return redirect(url('staffs'))->with('success', 'Staff updated successfully');
             }
            return redirect()->back()->with('success', 'Staff updated successfully');
           }else {
            return redirect()->back()->with('error', 'Staff updating failed');
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // if (Auth()->user()->cannot('Manage Staffs')) {
        //     abort(403, 'Access Denied');
        // }
        $staff = Staff::find($id);
        if ($staff->photo) {
            $imgpath = public_path('StaffImages').'/'.$staff->photo;
            if (file_exists($imgpath)) {
               unlink($imgpath);
            }
        }
        $res = $staff->delete();
         if ($res) {
         return back()->with('success', 'Staff deleted successfully');
         }else {
            return back()->with('error', 'Staff deleting failed');
        }
    }
}
