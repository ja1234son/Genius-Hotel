<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RolesController extends Controller
{
    public function index()
    {
        // if (Auth()->user()->cannot('View Roles')) {
        //     abort(403, 'Access Denied');
        // }
        $data['page'] = 'ROLES';
        $roles = Role::all();
        // return view('roles.index', compact('')); 
        return view('roles.index', compact('data','roles'));
    }

    // public function getRoles()
    // {
    //     // if (Auth()->user()->cannot('View Roles')) {
    //     //     abort(403, 'Access Denied');
    //     // }
 
        
    // }

    public function create()
    {
        // if (Auth()->user()->cannot('Manage Roles')) {
        //     abort(403, 'Access Denied');
        // }

        $data['page'] = 'NEW ROLE';

        $data['permissions'] = Permission::get()->groupBy('category')->sortKeys();

        return view('roles.create', compact('data'));
    }


    public function store(Request $request)
    {
        // if (Auth()->user()->cannot('Manage Users')) {
        //     abort(403, 'Access Denied');
        // }


        $request->validate([
            'name' => 'unique:roles|required|string|min:2|max:50',
            'description' => 'string|min:5|max:50',
            'permissions' => 'required',
        ]);

        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        if (is_array($request->permissions)) {
            $permissions = Permission::whereIn('id', $request->permissions)->get();
            $role->syncPermissions($permissions);
        }

        if (isset($_POST["save_close"])) {
            return redirect()->route('roles')->with('success', 'Role Created Successfully');
        }

        return back()->with('success', 'Role Created Successfully');
    }

    public function edit(Role $role, $id)
    {
        // if (Auth()->user()->cannot('Manage Roles')) {
        //     abort(403, 'Access Denied');
        // }

        $data['page'] = 'EDIT ROLE';

        $data['role'] = Role::find($id);

        $data['AssignedPermissions'] = DB::select("SELECT permission_id id FROM role_has_permissions where role_id = " . $id . "");
        $data['permissionsAll'] = Permission::get()->groupBy('category')->sortKeys();

        $data['permissionsAssigned'] = [];
        foreach ($data['AssignedPermissions'] as $p) {
            $data['permissionsAssigned'][] = $p->id;
        }

        return view("roles.edit", compact('data'));
    }

    public function update(Request $request)
    {
        // if (Auth()->user()->cannot('Manage Users')) {
        //     abort(403, 'Access Denied');
        // }


        $request->validate([
            'id' => 'required|exists:roles,id',
            'name' => 'required|string|min:2|max:50',
            'description' => 'required',
            'permissions' => 'required|array',
        ]);
    
        // Find the role
        $role = Role::findOrFail($request->id);
        
        // Update role fields
        $role->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
    
        // Convert permission IDs to permission names
        $permissionNames = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
    
        // Sync permissions with the correct names
        $role->syncPermissions($permissionNames);
    
        // Redirect logic
        if ($request->has('save_close')) {
            return redirect()->route('roles')->with('success', 'Role Updated Successfully');
        }
    
        return back()->with('success', 'Role Updated Successfully');
    }

    public function destroy($id){

        $role = Role::find($id);

        if (!$role) {
            return response()->json(['error' => 'Role not found.'], 404);
        }

        $role->delete();
        return response()->json(['success' => 'Role deleted successfully!']);
    }

    }

