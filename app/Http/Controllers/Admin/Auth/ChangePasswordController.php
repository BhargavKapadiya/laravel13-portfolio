<?php

namespace App\Http\Controllers\Admin\Auth;

use Throwable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{
    /**
     * ChangePassword
     *
     * @return void
     * @author CK
     */
    public function changePassword()
    {
        return view('admin.auth.change-password');
    }

    /**
     * UpdatePassword
     *
     * @param  mixed $request
     * @return void
     */
    public function updatePassword(Request $request)
    {
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'old_password' => 'required',
                    'password' => 'required|string|min:6|confirmed',
                ],
                [
                    'old_password.required' => 'Please enter old password',
                    'password.required' => 'Please enter password',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->getMessageBag()->toArray());
            }

            /** @var \App\Models\Admin $user */
            $user = Auth::guard(ADMIN_GUARD)->user();
            if (Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->password);;
                $user->save();
                return redirect()->route('admin.dashboard')->with('success', trans('auth.Password_changed_success'));
            } else {
                return redirect()->back()->with("error", trans('auth.Please_enter_correct_current_password'));
            }
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
