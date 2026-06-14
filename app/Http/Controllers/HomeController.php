<?php

namespace App\Http\Controllers;

use Throwable;
use Carbon\Carbon;
use App\Models\FAQs;
use App\Models\User;
use App\Helpers\Helper;
use App\Models\Contact;
use App\Models\CmsPages;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use App\Services\BlogService;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;
use App\Services\RecaptchaVerifyService;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (ADMIN_GUARD == "web" && Auth::guard(ADMIN_GUARD)->check() && Auth::user()->role_id == SUPER_ADMIN_ROLE) {
            return redirect()->route('admin.dashboard');
        }

        // else if (Auth::guard('web')->check()) {
        //     return view('welcome');
        // }
        return redirect()->route('home');
    }

    public function dashboard()
    {
        try {
            $faqs = FAQs::select('*')
                ->orderBy('id', 'desc')
                // ->when($search, function ($query) use ($search) {
                //     $query->where(function ($query) use ($search) {
                //         $query->where('question', 'like', "%" . $search . "%");
                //         $query->orWhere('answer', 'like', "%" . $search . "%");
                //     });
                // })
                ->paginate(10);
            return view('home', compact('faqs'));
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    // This is for reference
    public function cmsHome()
    {
        try {
            $cms_page = CmsPages::select('*')->where('slug', Route::currentRouteName())->first();
            return view('cms-home', compact('cms_page'));
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Terms and Conditions Page
     *
     * @return void
     */
    public function termsConditions()
    {
        $page_content = "";
        if (Storage::exists("terms-conditions.txt")) {
            $page_content = Storage::get("terms-conditions.txt");
        }
        return view('pages.terms-conditions', compact('page_content'));
    }

    /**
     * Privacy Policy Page
     *
     * @return void
     */
    public function privacyPolicy()
    {
        $page_content = "";
        if (Storage::exists("privacy-policy.txt")) {
            $page_content = Storage::get("privacy-policy.txt");
        }
        return view('pages.privacy-policy', compact('page_content'));
    }

    /**
     * About Us Page
     *
     * @return void
     */
    public function aboutUs()
    {
        $page_content = "";
        if (Storage::exists("about-us.txt")) {
            $page_content = Storage::get("about-us.txt");
        }
        return view('pages.about-us', compact('page_content'));
    }

    /**
     * Contact Us Page
     *
     * @return void
     */
    public function contactUs()
    {
        return view('pages.contact-us');
    }

    /**
     * Save enquiry
     *
     * @param  mixed $request
     * @return void
     */
    public function enquiry(Request $request)
    {
        $is_ajax = $request->ajax();
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email:rfc,dns', 'max:255'],
                    'subject' => ['required', 'string', 'max:255'],
                    'message' => ['required', 'string', 'max:5000'],
                ]
            );

            if ($validator->fails()) {
                if ($is_ajax) {
                    return response()->json(['status' => 0, 'message' => $validator->getMessageBag()->toArray()], 200);
                }
                return redirect()->back()->withErrors($validator->getMessageBag()->toArray());
            }

            // If you want to implement reCaptcha on contact us form. Review RecaptchaVerifyService.php file
            // change flag in constant.php file

            $res = RecaptchaVerifyService::verifyRecaptcha($request);
            if ($res['status'] === 200) {
                $contact = Contact::create(
                    [
                        'name' => $request->name,
                        'email' => $request->email,
                        'subject' => $request->subject,
                        'message' => $request->message,
                    ]
                );

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

                    if ($is_ajax) {
                        return response()->json(['status' => 200, 'message' => trans('app.Enquiry_has_been_sent_success')], 200);
                    }
                    return redirect()->back()->with('success', trans('app.Enquiry_has_been_sent_success'));
                } else {
                    if ($is_ajax) {
                        return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong')], 200);
                    }
                    return redirect()->back()->with('error', trans('app.something_went_wrong'));
                }
            } else {
                if ($is_ajax) {
                    return response()->json(['status' => 0, 'message' => $res['captcha'] ?? "The reCAPTCHA wasn't entered correctly. Go back and try it again."], 200);
                }
                return redirect()->back()->withErrors(['captcha' => $res['captcha'] ?? "The reCAPTCHA wasn't entered correctly. Go back and try it again."]);
            }
        } catch (Throwable $e) {
            report($e);
            if ($is_ajax) {
                return response()->json(['status' => 0, 'message' => trans('app.something_went_wrong')], 200);
            }
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Check user email is exists or not
     *
     * @param  mixed $request
     * @return void
     */
    public function checkUserExists(Request $request)
    {
        try {
            $exists = User::where('email', $request->email)
                ->when(($request->has('id') && $request->id != ""), function ($query) use ($request) {
                    $query->where('id', '!=', $request->id);
                })
                ->first();

            if ($exists) {
                echo 'false';
            } else {
                echo 'true';
            }
        } catch (Throwable $e) {
            report($e);
            echo "false";
        }
        exit;
    }

    /**
     * FAQs Page
     *
     * @return void
     */
    public function faqs(Request $request)
    {
        try {
            $search = $request->search ?? "";
            $faqs = FAQs::select('*')
                ->orderBy('id', 'desc')
                ->when($search, function ($query) use ($search) {
                    $query->where(function ($query) use ($search) {
                        $query->where('question', 'like', "%" . $search . "%");
                        $query->orWhere('answer', 'like', "%" . $search . "%");
                    });
                })
                ->paginate(10);
            return view('pages.faq', compact("faqs", "search"));
        } catch (Throwable $e) {
            report($e);
            return redirect()->route('index')->with("error", trans('app.something_went_wrong'));
        }
    }

    /**
     * Blog Page
     *
     * @param  mixed $slug
     * @return void
     */
    public function blogs(Request $request, $slug = NULL)
    {
        try {
            if (isset($slug) && !is_null($slug)) {
                $blog = BlogService::getBlogs(['slug' => $slug]);
                if (isset($blog) && !empty($blog)) {
                    return view('pages.blog-details', compact("blog"));
                } else {
                    return redirect()->back()->with("error", trans('app.Blog_is_not_found'));
                }
            }

            $blogs = BlogService::getBlogs(['paginate' => 6]);

            if ($blogs->isEmpty() && $request->page > 1) {
                return redirect()->route('blogs', ['page' => 1]);
            }
            return view('pages.blogs', compact("blogs"));
        } catch (Throwable $e) {
            report($e);
            return redirect()->route('index')->with("error", trans('app.something_went_wrong'));
        }
    }

    /**
     * Notifications
     *
     * @return void
     */
    public function notifications()
    {
        try {
            $user_id = Auth::id();
            $notifications =  NotificationService::getNotification(['user_id' => $user_id, 'paginate' => 50]);

            NotificationService::readNotification(['user_id' => $user_id]);

            return ['status' => 1, 'result' => $notifications->items()];
        } catch (Throwable $e) {
            return ['status' => 0, 'result' => ""];
        }
    }

    /**
     * Upload file into temp directories (It will be delete after 24 hours)
     *
     * @param  mixed $request
     * @return void
     */
    public function uploadFiles(Request $request)
    {
        try {
            $uploadedFile = [];
            $prefix = "";
            if ($request->file('files')) {
                $files = $request->file('files');
                if (is_array($files)) {
                    foreach ($request->file('files') as $file) {
                        $ext = $file->getClientOriginalExtension();
                        $prefix = Helper::getPrefixBasedOnExtension($ext);
                        $filename = $prefix . "-" . Carbon::now()->timestamp . mt_rand(1, 100) . "." . $ext;
                        $temp = [];
                        $temp['name'] = $filename;
                        $temp['url'] = Helper::uploadFile($file, config('constant.temp_file_url'), $filename);
                        $uploadedFile[] = $temp;
                    }
                } else {
                    $file = $request->file('files');
                    $ext = $file->getClientOriginalExtension();
                    $prefix = Helper::getPrefixBasedOnExtension($ext);
                    $filename = $prefix . "-" . Carbon::now()->timestamp . mt_rand(1, 100) . "." . $ext;
                    $uploadedFile['name'] = $filename;
                    $uploadedFile['url'] = Helper::uploadFile($file, config('constant.temp_file_url'), $filename);
                }
                return response()->json(['status' => true, 'files' => $uploadedFile], 200);
            }
            return response()->json(['status' => false, 'files' => null], 200);
        } catch (Throwable $e) {
            report($e);
            return response()->json(
                [
                    'status' => false,
                    'files' => null,
                    'message' => trans('app.something_went_wrong')
                ],
                200
            );
        }
    }

    /**
     * UploadCKeditorImage
     *
     * @param  mixed $request
     * @return void
     */
    public function uploadCKeditorImage(Request $request)
    {
        $url = $msg = "";
        $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            if (in_array($extension, ['png', 'PNG', 'jpg', 'JPG', 'jpeg', 'JPEG', 'gif', 'GIF'])) {
                $fileName = $fileName . '_' . time() . '.' . $extension;

                // Upload image on server
                $file = $request->file('upload');
                Helper::uploadFile($file, config('constant.temp_file_url'), $fileName);
                $url = Helper::media(config('constant.temp_file_url') . $fileName);

                $msg = 'Image uploaded successfully';
            } else {
                $msg = 'An error occurred while uploading the file.';
            }
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
        } else {
            $msg = 'No image uploaded.';
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
        }

        @header('Content-type: text/html; charset=utf-8');
        echo $response;
    }

    /**
     * UploadCropImage
     *
     * @param  mixed $request
     * @return void
     */
    public function uploadCropImage(Request $request)
    {
        $folderPath = public_path(config('constant.cropped_image_url'));

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1] ?? 'png';
        $image_base64 = base64_decode($image_parts[1]);

        $imageName = "Img-" . date('YmdHis') . mt_rand(1, 100) . '.' . $image_type;

        $imageFullPath = $folderPath . $imageName;

        file_put_contents($imageFullPath, $image_base64);

        return response()->json([
            'success' => true,
            'url' => Helper::media(config('constant.cropped_image_url') . $imageName),
            'filename' => $imageName
        ]);
    }
}
