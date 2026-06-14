<?php

namespace App\Http\Controllers\Admin\Auth;

use Throwable;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

/**
 * ForgotPasswordController
 */
class ForgotPasswordController extends Controller
{

    use SendsPasswordResetEmails;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    /**
     * Broker
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    protected function broker()
    {
        return Password::broker('admins');
    }

    /**
     * ShowLinkRequestForm
     *
     * @return void
     * @author CK
     */
    public function showLinkRequestForm()
    {
        return view('admin.auth.email');
    }

    /**
     * SendResetLinkEmail
     *
     * @param  mixed $request
     * @return void
     * @author CK
     */
    public function sendResetLinkEmail(Request $request)
    {
        try {
            $this->validate($request, ['email' => 'required|email']);
            $admin = Admin::where('email', $request->email)->first();

            if ($admin) {
                $response = $this->broker()->sendResetLink(
                    $request->only('email')
                );

                if ($response === Password::RESET_LINK_SENT) {
                    return redirect()->route('admin.login')->with('success', trans($response));
                }

                return back()->withErrors(['email' => trans($response)]);
            } else {
                return redirect()->back()->withErrors(['email' => trans('auth.Email_not_found')]);
            }
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
