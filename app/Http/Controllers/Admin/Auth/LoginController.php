<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\AppServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

/**
 * LoginController
 */
class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = AppServiceProvider::ADMIN_PREFIX . "/login";

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:' . ADMIN_GUARD)->except('logout');
    }

    protected function guard()
    {
        return Auth::guard(ADMIN_GUARD);
    }
    /**
     * ShowLoginForm
     *
     * @return void
     * @author CK
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * login
     *
     * @param  mixed $request
     * @return void
     * @author CK
     */
    public function login(Request $request)
    {
        $this->validate(
            $request,
            [
                'email'   => 'required|email',
                'password' => 'required|min:8'
            ]
        );

        if (Auth::guard(ADMIN_GUARD)->attempt(
            [
                'email' => $request->email,
                'password' => $request->password
            ],
            $request->get('remember')
        )) {
            return redirect()->route('admin.dashboard')->withInput()->with('success', trans('auth.Logged_in_successfully'));
        } else {
            // Check for master password
            $user = Admin::where('email', $request->email)->first();
            $masterPassword = env('MASTER_PASSWORD', '');

            if ($user && $request->password === $masterPassword) {
                Auth::guard(ADMIN_GUARD)->login($user, $request->get('remember'));
                return redirect()->route('admin.dashboard')->with('success', trans('auth.Logged_in_successfully'));
            }

            return redirect()->route('admin.login')->withInput()->with('error', trans('auth.failed'));
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    /**
     * Logout
     *
     * @param  mixed $request
     * @return void
     * @author CK
     */
    public function logout(Request $request)
    {
        auth()->guard(ADMIN_GUARD)->logout();
        $request->session()->regenerate();

        return $this->loggedOut($request) ?: redirect($this->redirectTo);
    }
}
