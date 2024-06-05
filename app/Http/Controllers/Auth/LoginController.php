<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function login_index(){
        return view('auth.login');
    }

    public function store(Request $request){
        $request->validate(
            [
                // 'phone_no' => 'required',
                'email' => 'required|string|email|max:255',
                'password' => 'required',
            ],
            [
                // 'phone_no.required' => 'The Phone number field is required',
                'email.required' => 'The Email field is required',
                'email.email' => 'The Email must be a valid email with @',
                'password.required' => 'The Password field is required',
                // 'password.confirmed' => 'The Password you entered does not match',
            ]
        );

        $credentials = $request->only('email','password');
        $remember = $request->remember;
         if (Auth::attempt($credentials,$remember)) {
             $user = Auth::user();
             $role = $this->getRoleFromEmail($user->email);

             if ($role === 'admin') {
                 return redirect('admin-dashboard');
             }else{
                return redirect(RouteServiceProvider::HOME)->with('success','You are now successfull login feel free to book any room');
             }
         }else {
            return redirect()->back()->with('error','Invalid login details');
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

    public function logout(Request $request)
    {
       Session::flush();
       Auth::logout();
       return redirect('login');
    }
}
