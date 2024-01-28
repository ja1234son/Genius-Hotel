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
        $depart = Department::all();
       return view('Department.index',compact('depart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Department.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required",
        ]);
        $data = new Department();
        $data->title = $request->title;
        $res = $data->save();
        if ($res){
            return redirect()->back()->with('success','Department registered successfully');
        }else{
            return redirect()->back()->with('error','Department registration failed');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $departs = Department::find($id);
         return view('Department.show',compact('departs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
       $departs = Department::find($id);
       return view('Department.edit',compact('departs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "title" => "required",
        ]);

        $data = Department::find($id);
        $data->title = $request->title;
        $res = $data->save();
        if ($res){
            return redirect()->back()->with('success','Department updated successfully');
        }else{
            return redirect()->back()->with('error','Department updated failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $departs = Department::where('id',$id)->delete();
        return redirect()->back()->with('success','Department deleted successfully');
    }
}
