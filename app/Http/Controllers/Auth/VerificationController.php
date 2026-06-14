<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Auth\VerifiesEmails;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        //$this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }


    /**
     * Verify
     *
     * @param  mixed $request
     * @return void
     */
    public function verify(Request $request)
    {
        $userId = $request->route('id');
        $user = User::findOrFail($userId);
        if (empty($user)) {
            return redirect($this->redirectTo)->with('warning', trans('auth.Email_cannot_be_identified'));
        }
        if (!empty($user->email_verified_at)) {
            return redirect($this->redirectTo)->with(['warning' => trans('auth.Account_already_verified')]);
        }

        if (!empty($user->password)) {
            // If you want to only verify account open this comment - this is change email_verified_at fields value
            if ($user->markEmailAsVerified()) {
                event(new Verified($request->user()));
            }
            return redirect($this->redirectTo)->with(
                [
                    'verified' => true,
                    'success' => trans('auth.Account_verified')
                ]
            );
        }

        // OR If you want to set new password then it will redirect on set new password page
        return redirect()->action(
            [VerificationController::class, 'showVerifiedPage'],
            [
                'user' =>  Crypt::encryptString($user->id)
            ]
        );
    }

    /**
     * showVerifiedPage
     *
     * @param  mixed $request
     * @param  mixed $user
     * @return void
     */
    public function showVerifiedPage(Request $request, $user)
    {
        return view('auth.verify', compact('user'));
    }

    /**
     * Verified
     *
     * @param  mixed $request
     * @return void
     */
    public function verified(Request $request)
    {
        $user = User::findOrFail(Crypt::decryptString($request->id));

        if (empty($user)) {
            return redirect($this->redirectTo)->with('warning', trans('auth.Email_cannot_be_identified'));
        }

        if (empty($user->email_verified_at)) {
            $user->password = Hash::make($request->password);
            $user->save();

            // Send Welcome mail to user
            $mail_data = [
                'email_id' => 3,
                'user_id' => $user->id,
                'email' => $user->email
            ];

            dispatch(new SendEmailJob($mail_data));
        } else {
            return redirect($this->redirectTo)->with(
                [
                    'warning' => trans('auth.Account_already_verified')
                ]
            );
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }
        return redirect($this->redirectTo)->with(
            [
                'verified' => true,
                'success' => trans('auth.Account_verified')
            ]
        );
    }
}
