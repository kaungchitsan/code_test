<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminLoginController extends Controller
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
    protected $redirectTo = RouteServiceProvider::ADMIN;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
    
    public function showLoginForm()
    {
        if(Session::get('admin_user'))
        {
            return redirect()->route('dashboard')->with('success','Successfully Loggin'); 
        }
        return view('auth.admin_login');
    }

    public function login(Request $request)
    {
     
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
        
        $user = AdminUser::where('username', $request->username)->first();

        if($user && Hash::check($request->password, $user->password))
        {
            Session::put('admin_user', $user);
            return redirect()->route('dashboard')->with('success','Successfully Loggin');
        }else{
            return redirect()->route('admin.login')
                ->with('error','Username And Password Are Wrong.');
        }
    }
}
