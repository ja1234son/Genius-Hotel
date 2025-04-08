<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if (Auth()->user()->can('View Department Module')) {
        //     // abort(403, 'Access Denied');
        // }

        $depart = Department::all();
       return view('Department.index',compact('depart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // if (Auth()->user()->cannot('Manage  Department')) {
        //     abort(403, 'Access Denied');
        // }
        return view('Department.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // if (Auth()->user()->cannot('Manage Department')) {
        //     abort(403, 'Access Denied');
        // }

        $request->validate(
            [
            "title" => "required",
            ],
            [
                'title.required' => 'The Department Name field is required',
            ]
    );
        $data = new Department();
        $data->title = $request->title;
        $res = $data->save();

        if ($res){
            if (isset($_POST["save_close"])) {
                  return redirect(url('departments'))->with('success','Department registered successfully');
            }
               return redirect()->back()->with('success','Department registered successfully');
        }else {
                return redirect()->back()->with('error','Department registration failed');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // if (Auth()->user()->cannot('Manage Department')) {
        //     abort(403, 'Access Denied');
        // }

         $departs = Department::find($id);
         return view('Department.show',compact('departs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // if (Auth()->user()->cannot('Manage Department')) {
        //     abort(403, 'Access Denied');
        // }

       $departs = Department::find($id);
       return view('Department.edit',compact('departs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // if (Auth()->user()->cannot('Manage Department')) {
        //     abort(403, 'Access Denied');
        // }

        $request->validate(
            [
            "title" => "required",
            ],
            [
                'title.required' => 'The Department Name field is required',
            ]
    );

        $data = Department::find($id);
        $data->title = $request->title;
        $res = $data->save();

        if ($res){
            if (isset($_POST["save_close"])) {
                  return redirect(url('departments'))->with('success','Department updated successfully');
            }
               return redirect()->back()->with('success','Department updated successfully');
        }else {
                return redirect()->back()->with('error','Department updating failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){

        $department = Department::find($id);

        if (!$department) {
            return response()->json(['error' => 'Department not found.'], 404);
        }

        $department->delete();
        return response()->json(['success' => 'Department deleted successfully!']);
    }
}
