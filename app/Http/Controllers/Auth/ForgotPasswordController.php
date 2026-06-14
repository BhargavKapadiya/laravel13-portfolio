<?php

namespace App\Http\Controllers\Auth;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

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
     * SendResetLinkEmail
     *
     * @param  mixed $request
     * @return void
     */
    public function sendResetLinkEmail(Request $request)
    {
        try {
            $this->validate($request, ['email' => 'required|email']);
            $user = User::where('email', $request->email)->first();

            if ($user) {
                if (in_array($user->getRoleNames()->first(), [USER_ROLE])) {
                    if ($user->is_active == 0 && $user->email_verified_at != null) {
                        return redirect()->back()->with('warning', trans('auth.Account_approval_pending'));
                    } else if (($user->is_active == 1 || $user->is_active == 0) && $user->email_verified_at == null) {
                        return redirect()->back()->with('warning', trans('auth.account_activate'));
                    } else if ($user->is_active == 2 && $user->email_verified_at != null) {
                        return redirect()->back()->with('warning', trans('auth.Your_account_is_deactivated'));
                    } else {
                        $response = $this->broker()->sendResetLink(
                            $request->only('email')
                        );

                        if ($response === Password::RESET_LINK_SENT) {
                            return redirect()->route('login')->with('success', trans($response));
                        }
                        return back()->withErrors(['email' => trans($response)]);
                    }
                } else {
                    return redirect()->back()->with('warning', trans('app.Sufficient_permissions'));
                }
            } else {
                return redirect()->back()->withErrors(['email' => trans('auth.Email_not_found')]);
            }
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('warning', trans('app.something_went_wrong'));
        }
    }
}
