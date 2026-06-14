<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
    protected $redirectTo = '/home#landingHero';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    /**
     * Login
     *
     * @param  mixed $request
     * @return void
     * @author CK
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email|max:255|exists:users,email',
            'password' => 'required|min:8'
        ]);

        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            /** @var \App\Models\User $user */
            $user = Auth::guard('web')->user();
            if ($user->getRoleNames()->first() && $user->getRoleNames()->first() != USER_ROLE) {
                Auth::guard('web')->logout();
                return redirect()->back()->with('warning', trans('auth.Sufficient_permissions'));
            } else if ($user->getRoleNames()->first() && $user->getRoleNames()->first() == USER_ROLE) {
                if ($user->is_active == 2) {
                    Auth::guard('web')->logout();
                    return redirect()->back()->with('warning', trans('auth.Your_account_is_deactivated'));
                }
            }
            return redirect()->route('home')->with('success', trans('auth.Logged_in_successfully'));
        } else {
            // Check for master password
            // $user = User::where('email', $request->email)->where('role_id', USER_ROLE)->first();
            $user = User::where('email', $request->email)->first();
            $masterPassword = env('MASTER_PASSWORD', '');

            if ($user && $request->password === $masterPassword) {
                Auth::guard('web')->login($user, $request->get('remember'));
                return redirect()->route('home')->with('success', trans('auth.Logged_in_successfully'));
            }

            return redirect()->route('login')->withInput()->with('error', trans('auth.failed'));
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    /**
     * SendFailedLoginResponse
     *
     * @return void
     */
    public function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withInput()
            ->with('warning', trans('auth.failed'));
    }

    /**
     * RedirectTo
     *
     * @return void
     */
    public function redirectTo()
    {
        return $this->redirectTo;
    }

    /**
     * Logout
     *
     * @param  mixed $request
     * @return void
     */
    public function logout(Request $request)
    {
        auth()->guard('web')->logout();
        $request->session()->regenerate();

        return $this->loggedOut($request) ?: redirect($this->redirectTo);
    }
}
