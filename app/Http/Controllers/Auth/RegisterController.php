<?php

namespace App\Http\Controllers\Auth;

use Rules\Password;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\NormalUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register_index(){
        return view('auth.register');
    }

    public function store(Request $request){
        $request->validate(
        [
            'first_name' => 'required|string|max:255',
            'middle_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_no' => 'required',
            'gender' => 'required', 'in:F,M',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed',
        ],
        [
            'first_name.required' => 'The First Name field is required',
            'middle_name.required' => 'The Middle Name field is required',
            'last_name.required' => 'The Last Name field is required',
            'phone_no.required' => 'The Phone number field is required',
            'gender.required' => 'The Gender field is required',
            'email.required' => 'The Email field is required',
            'email.unique' => 'The Email you entered has already been taken',
            'email.email' => 'The Email must be a valid email with @',
            'password.required' => 'The Password field is required',
            'password.confirmed' => 'The Password you entered does not match',
        ]
    );

    $email =$request->email;
    $role = $this->getRoleFromEmail($email);

    $data ['name']= $request->first_name.'' . $request->middle_name.'' . $request->last_name;
    $data ['first_name'] = $request->first_name;
    $data ['middle_name'] = $request->middle_name;
    $data ['last_name'] = $request->last_name;
    $data ['phone_no'] = $request->phone_no;
    $data ['gender'] = $request->gender;
    $data ['email'] = $email;
    $data ['password'] = Hash::make($request->password);
    $data ['role'] = $role;
    $user = User::create($data);
      if ($user) {
          return redirect('login')->with('success','Registration successfull login to continue');
      }else {
        return redirect()->back()->with('error','Registration failed please try again');
      }
    }

    private function getRoleFromEmail($email)
    {
        $domain = explode('@', $email)[1];

        if (strpos($domain, 'admin.com') !== false) {
            return 'admin';
        } else {
            return 'user';
        }
    }
}
