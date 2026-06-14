<?php

namespace App\Http\Controllers;

use Throwable;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Go to change profile page
     *
     * @return void
     */
    public function profile()
    {
        $user = Auth::guard('web')->user();
        return view('auth.profile', compact('user'));
    }

    /**
     * Save profile details
     *
     * @param  mixed $request
     * @return void
     */
    public function saveProfile(Request $request)
    {
        try {
            $user_id = Auth::id();
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['nullable', 'string', 'email', 'max:255', 'unique:users,email,' . $user_id . ',id,deleted_at,NULL'],
                    'country_code' => ['required', 'string', 'max:255'],
                    'phone_number' => ['required', 'numeric', 'digits_between:7,15'],
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->getMessageBag()->toArray())->withInput();
            }

            /** @var \App\Models\User $user */
            $user = Auth::guard('web')->user();
            if ($user) {
                if ($request->has('email') && !empty($request->email)) {
                    $user->email = $request->email;
                }

                $user->name = $request->name;
                $user->country_code = $request->country_code;
                $user->phone_number = $request->phone_number;

                if ($request->file('photo') != "") {
                    $photo = $request->file('photo');
                    $filename = "Img-" . date('YmdHis') . mt_rand(1, 100) . '.' . $photo->getClientOriginalExtension();
                    Helper::uploadFile($photo, config('constant.profile_image_url'), $filename, $user->photo);
                    $user->photo = $filename;
                }

                if ($user->is_complete_profile == 0) {
                    $user->is_complete_profile = 1;
                }

                $user->save();

                return redirect()->route('user.profile')->with('success', trans('app.Profile_has_been_saved_success'));
            } else {
                return redirect()->back()->with('error', trans('app.something_went_wrong'));
            }
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * ChangePassword
     *
     * @return void
     */
    public function changePassword()
    {
        return view('auth.change-password');
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
            $validator = Validator::make($request->all(), [
                'old_password' => 'required',
                'password' => 'required|string|min:6|confirmed',
            ], [
                'old_password.required' => 'Please enter old password',
                'password.required' => 'Please enter password',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->getMessageBag()->toArray())->withInput();
            }

            /** @var \App\Models\User $user */
            $user = Auth::guard('web')->user();
            if (Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->password);;
                $user->save();
                return redirect()->route('home')->with('success', trans('auth.Password_changed_success'));
            } else {
                return redirect()->back()->with("error", trans('auth.Please_enter_correct_current_password'));
            }
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }
}
