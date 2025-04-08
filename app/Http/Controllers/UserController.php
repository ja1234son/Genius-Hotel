<?php

namespace App\Http\Controllers;

use view;
use App\Models\Role;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\LoggingService;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index()
    {
        // if (Auth()->user()->cannot('View Users')) {
        //     abort(403, 'Access Denied');
        // }
        $data['page'] = 'USERS';
        $data['page2'] = 'Users';
        $data['page3'] = 'All Users';

        $data['roles'] = Role::all();
        $values['users'] = User::where('user_type','employee')->get();

        return view('users.index',compact('data','values'));
    }

    public function create()
    {
        // if (Auth()->user()->cannot('Manage Users')) {
        //     abort(403, 'Access Denied');
        // }

        $data['page'] = 'USERS';
        $data['page2'] = 'Users';
        $data['page3'] = 'Create Users';

        $data['roles'] = Role::all();

        return view('users.create', compact('data'));
    }

    public function store(Request $request)
    {
        // if (Auth()->user()->cannot('Manage Users')) {
        //     abort(403, 'Access Denied');
        // }

      
         // Validate only the fields present in the form
    $request->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'phone' => 'required|digits_between:10,15',
        'gender' => 'required|in:Male,Female',
        'role' => 'required',
    ]);

    // Create a new user
    $user = User::create([
       'first_name' => ucfirst(strtolower($request->first_name)),
        'last_name' => ucfirst(strtolower($request->last_name)),
        'name' => ucfirst(strtolower($request->first_name)) . ' ' . ucfirst(strtolower($request->last_name)),
        'email' => strtolower($request->email),
        'phone_no' => $request->phone,
        'gender' => $request->gender,
        'password' => Hash::make('12345678'),
        'user_type' => 'employee', // ✅ Now it will save correctly
    ]);

    // Assign roles dynamically
    $role = Role::find($request->role);
    if ($role) {
        $user->syncRoles($role->name); // Use role name instead of ID
    } else {
        return back()->withInput()->withErrors(['role' => 'Invalid role selected.']);
    }
    

    // Redirect with success message
    if (isset($_POST["save_close"])) {
        return redirect()->route('users')->with('success', 'User Created Successfully');
    }
    return redirect()->back()->with('success', 'User Created Successfully');
}



    public function edit($id)
    {
        // if (Auth()->user()->cannot('Manage Users')) {
        //     abort(403, 'Access Denied');
        // }

        $data['page'] = 'Editing User Center';
        $data['page2'] = 'Editing Platform';
        $data['page3'] = 'Edit User';

        $data['roles'] = Role::all();

        $users = User::findOrFail($id);

        return view('users.edit', compact('users', 'data'));
    }


public function update(Request $request)
{

    // if (Auth()->user()->cannot('Manage Users')) {
    //     abort(403, 'Access Denied');
    // }


    $request->validate([
      'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255', // Removed uniqueness check
        'phone' => 'required|digits_between:10,15',
        'gender' => 'required|in:Male,Female',
        'role' => 'required',
    ]);

    // Find the role
    $user = User::findOrFail($request->id);
    
    // Update role fields
    $user->update([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'phone_no' => $request->phone,
        'gender' => $request->gender,
    ]);

    $role = Role::find($request->role);
    if ($role) {
        $user->syncRoles($role->name); // Use role name instead of ID
    } else {
        return back()->withInput()->withErrors(['role' => 'Invalid role selected.']);
    }
    // Redirect logic
    if (isset($_POST["save_close"])) {
        return redirect()->route('users')->with('success', 'User Updated Successfully');
    }
    return back()->with('success', 'User Updated Successfully');
}




    public function changePassword(Request $request)
    {
        // if (Auth()->user()->cannot('Change User Password')) {
        //     abort(403, 'Access Denied');
        // }

        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::findOrFail($request->id);
        $user->password = Hash::make($request->password);
        $user->save();

        if (isset($_POST["save_close"])) {
            return redirect()->route('users')->with('success', 'Password Updated Successfully');
        }
        return back()->with('success', 'Password Updated Successfully');
    }

    public function destroy($id){

        // if (Auth()->user()->cannot('Manage Users')) {
        //     abort(403, 'Access Denied');
        // }


        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        $user->delete();
        return response()->json(['success' => 'User deleted successfully!']);
    }

    public function userPermission($id)
    {
        // if (Auth::user()->cannot('Set User Permissions')) {
        //     abort(403, 'Access Denied');
        // }

        $data['page'] = 'USERS';
        $data['page2'] = 'Users';
        $data['page3'] = 'All Users';

        $data['user'] = User::findOrFail($id);

        $data['AssignedPermissions'] = DB::table('model_has_permissions')->selectRaw("permission_id as id")->where('model_id', $id)->get();

        $data['permissionsAll'] = Permission::get()->groupBy('category')->sortKeys();

        $data['permissionsAssigned'] = [];

        foreach ($data['AssignedPermissions'] as $p) {
            $data['permissionsAssigned'][] = $p->id;
        }

        return view("users.permissions", compact('data'));
    }

    public function updatePermission(Request $request)
    {
        // if (Auth::user()->cannot('Set User Permissions')) {
        //     abort(403, 'Access Denied');
        // }

        $request->validate([
            'permissions' => 'required',
        ]);

        $user = User::findOrfail($request->id);

        $user->syncPermissions($request->permissions ?? []);

        ################Logging################
        $channel = 'activitylog';
        $name = 'Updated User Permission';
        $body = "\n" .
            'ip: ' . $request->getClientIp() . "\n" .
            'user_agent: ' . strtolower($_SERVER["HTTP_USER_AGENT"]) . "\n" .
            'action_by_id: ' . Auth::user()->id . "\n" .
            'action_by_name: ' . Auth::user()->name . "\n" .
            'data: ' . json_encode($user, JSON_PRETTY_PRINT) . "\n";
        $logging = new LoggingService();
        $logging($channel, $name, $body);
        ################Logging################

        if (isset($_POST["save_close"])) {
            return redirect()->route('users')->with('success', 'User Permissions Updated Successfully');
        }

        return back()->with('success', 'User Permissions Updated Successfully');
    }


}
