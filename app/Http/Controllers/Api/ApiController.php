<?php

namespace App\Http\Controllers\Api;

use Throwable;
use App\Models\Contact;
use App\Models\Country;
use App\Helpers\ApiHelper;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\NotificationResource;

class ApiController extends Controller
{
    /**
     * contact
     *
     * @param  mixed $request
     * @return void
     */
    public function contact(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'subject' => "required|string|max:255",
                'message' => "required|string|max:2000",
            ], [
                'subject.required' => trans('app.Please_enter_a_subject'),
                'message.required' => trans('app.Please_enter_a_message'),
            ]);

            if ($validator->fails()) {
                return ApiHelper::validationErrorResponse($validator);
            }

            $user = Auth::user();

            $contact = Contact::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'subject' => $request->subject,
                'message' => $request->message
            ]);

            if ($contact) {
                if (config('constant.is_send_enquiry_email_to_admin')) {
                    // Send contact enquiry mail to admin
                    $mail_data = [
                        'email_id' => 6,
                        'user_id' => 1,
                        'name' => $contact->name,
                        'email' => $contact->email,
                        'subject' => $contact->subject,
                        'message' => $contact->message,
                    ];

                    dispatch(new SendEmailJob($mail_data));
                }

                DB::commit();
                return ApiHelper::apiSuccessResponse(trans('app.Enquiry_has_been_added'));
            } else {
                DB::rollback();
                return ApiHelper::apiErrorResponse(trans('app.Error_Occurred_During_Save_Please_Try_Again'));
            }
        } catch (Throwable $e) {
            DB::rollback();
            report($e);
            return ApiHelper::apiErrorResponse(trans('app.something_went_wrong'));
        }
    }

    // Terms and Conditions Page
    public function termsConditions(Request $request)
    {
        return ApiHelper::apiSuccessResponse("", route('app.terms-conditions'));
    }

    // Privacy Policy Page
    public function privacyPolicy(Request $request)
    {
        return ApiHelper::apiSuccessResponse("", route('app.privacy-policy'));
    }

    // About Us Page
    public function aboutUs(Request $request)
    {
        return ApiHelper::apiSuccessResponse("", route('app.about-us'));
    }

    /**
     * Get Notifications
     *
     * @param  mixed $request
     * @return void
     */
    public function notifications(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'page' => 'required|integer',
                'per_page' => 'required|integer'
            ], [
                'page.required' => trans('app.Please_provide_a_page'),
                'per_page.required' => trans('app.Please_provide_a_per_page'),
            ]);

            if ($validator->fails()) {
                return ApiHelper::validationErrorResponse($validator);
            }

            $user_id = Auth::id();

            $notifications = NotificationService::getNotification(['user_id' => $user_id, 'paginate' => $request->per_page ?? 10]);

            NotificationService::readNotification(['user_id' => $user_id]);

            $notifications = NotificationResource::collection($notifications->items());

            return ApiHelper::apiSuccessResponse("Notification list", $notifications);
        } catch (Throwable $e) {
            report($e);
            return ApiHelper::apiErrorResponse(trans('app.something_went_wrong'));
        }
    }

    /**
     * Clear Notifications
     *
     * @param  mixed $request
     * @return void
     */
    public function notificationsClear(Request $request)
    {
        DB::beginTransaction();
        try {
            $user_id = Auth::id();

            $res = NotificationService::clearNotifications($user_id);

            if ($res['status'] == 200 || $res['status'] == true) {
                DB::commit();
                return ApiHelper::apiSuccessResponse($res['message'], $res['result']);
            }
            return ApiHelper::apiErrorResponse($res['message'] ?? trans('app.something_went_wrong'));
        } catch (Throwable $e) {
            report($e);
            return ApiHelper::apiErrorResponse(trans('app.something_went_wrong'));
        }
    }

    /**
     * Country
     *
     * @return void
     */
    public function country()
    {
        try {
            $country = Country::select("id", "name")->get();

            return ApiHelper::apiSuccessResponse(trans('app.Country_found'), $country);
        } catch (Throwable $e) {
            report($e);
            return ApiHelper::apiErrorResponse(trans('app.something_went_wrong'));
        }
    }


    /**
     * Masters
     *
     * @return void
     */
    public function masters()
    {
        try {
            $country = Country::select("id", "name")->get();

            $data = [
                'countries' => $country,
                'terms_conditions_link' => route('app.terms-conditions'),
                'privacy_policy_link' =>  route('app.privacy-policy'),
                'cancellation_policy_link' => route('app.cancellation-policy'),
                'about_us_link' => route('app.about-us'),
            ];

            return ApiHelper::apiSuccessResponse(trans('app.Master_found'), $data);
        } catch (Throwable $e) {
            report($e);
            return ApiHelper::apiErrorResponse(trans('app.something_went_wrong'));
        }
    }
}
