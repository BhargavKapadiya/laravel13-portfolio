<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = AppServiceProvider::ADMIN_PREFIX . "/login";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    /**
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('admins');
    }

    /**
     * showResetForm
     *
     * @param  mixed $request
     * @param  mixed $token
     * @return void
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('admin.auth.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password'
            ]
        );

        $user = Admin::where('email', $request->email)->first();

        if ($user) {
            $user['password'] = Hash::make($request->password);
            $user->save();
            return redirect()->route('admin.login')->with('success', trans('auth.Password_changed_success'));
        }
        return redirect()->back()->with('failed', 'Failed! something went wrong');
    }

    /**
     * SendResetResponse
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return void
     */
    protected function sendResetResponse(Request $request, $response)
    {
        return redirect($this->redirectPath())->with('success', trans($response));
    }

    /**
     * SendResetFailedResponse
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return void
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return redirect()->back()->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)])
            ->with('error', trans($response));
    }

    /**
     * RedirectTo
     *
     * @return void
     */
    public function redirectTo()
    {
        Auth::guard(ADMIN_GUARD)->logout();
        return $this->redirectTo;
    }
}
