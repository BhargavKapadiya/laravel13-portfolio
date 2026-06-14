<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\User;
use App\Helpers\Helper;
use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $users = User::role(USER_ROLE, 'web')->orderBy('id', 'desc');

                return DataTables::of($users)
                    ->addIndexColumn()
                    ->addColumn('photo', function ($row) {
                        $str = "";
                        if ($row->photo_url != null) {
                            $str = "<img src='" . $row->photo_url . "' class='avatar' />";
                        }
                        return $str;
                    })
                    ->editColumn('phone_number', function ($row) {
                        if ($row->country_code != null && $row->phone_number != null) {
                            $btn = $row->country_code . ' ' . $row->phone_number;
                        } else {
                            $btn = "-";
                        }
                        return $btn;
                    })
                    ->filterColumn('phone_number', function ($query) use ($request) {
                        $query->where(function ($query) use ($request) {
                            $search = $request->search['value'];
                            $sql = 'concat(country_code, " ", phone_number)  like ?';
                            $query->whereRaw($sql, ["%{$search}%"]);
                        });
                    })
                    // ->addColumn('referred_by', function ($row) {
                    //     return $row->invite->first_name . " " . $row->invite->last_name;
                    // })
                    // ->filterColumn('referred_by', function ($query) use ($request) {
                    //     $query->whereHas('invite', function ($query) use ($request) {
                    //         $search = $request->search['value'];
                    //         $sql = 'concat(first_name, " ", last_name)  like ?';
                    //         $query->whereRaw($sql, ["%{$search}%"]);
                    //     });
                    // })
                    ->addColumn('status', function ($row) {
                        $class = [0 => 'bg-warning', 1 => 'bg-success', 2 => 'bg-danger'];
                        return '<span class="badge ' . ($class[$row->is_active] ?? '') . '">' . (config('constant.user_status')[$row->is_active] ?? "-") . '</span>';
                    })
                    ->addColumn('action', function ($row) {
                        $btn = '';
                        $btn = '<a href="' . route('admin.user.edit', $row->uid) . '"  data-id="' . $row->uid . '" class="text-primary" title="Edit"><i class="bx bxs-edit"></i></a>';
                        $btn .= '&nbsp;<a href="javascript:;" class="text-danger delete" data-id="' . $row->uid . '" title="Delete"><i class="bx bxs-trash"></i></a>';
                        if ($row->is_active != 0) {
                            $btn .= '&nbsp;<a href="javascript:;" class="teal block-unblock" data-id="' . $row->uid . '" data-status="' . ($row->is_active != 1 ? 1 : 2) . '"><i class="' . ($row->is_active == 1 ? " bx bxs-lock-open" : " bx bxs-lock") . '" title="' . ($row->is_active == 1 ? "Active" : "Inactive") . '"></i></a>';
                        }
                        $btn .= '&nbsp;<a href="' . route('admin.user-login', $row->uid) . '" class="text-info" target="_blank" title="Login"><i class="bx bx-exit"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'photo', 'status'])
                    ->make(true);
            }

            return view('admin.user.index');
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            return view('admin.user.add-user');
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $validator = Validator::make(
                $request->all(),
                [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'max:255', 'unique:users,email,NULL,id,deleted_at,NULL'],
                    'country_code' => ['required', 'string', 'max:255'],
                    'phone_number' => ['required', 'numeric', 'digits_between:7,15'],
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $photo = null;
            if ($request->file('photo') != "") {
                $file = $request->file('photo');
                $photo = "Img-" . date('YmdHis') . rand(1, 100) . '.' . $file->getClientOriginalExtension();
                Helper::uploadFile($file, config('constant.profile_image_url'), $photo);
            }

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'country_code' => $request->country_code,
                'phone_number' => $request->phone_number,
                'photo' => $photo
            ];
            $user = User::create($data);
            $user->assignRole(USER_ROLE);

            if ($user) {
                DB::commit();

                // Send Account created mail to user
                event(new Registered($user));

                return redirect()->route('admin.user.index')->with('success', trans('app.User_has_been_added'));
            } else {
                DB::rollback();
                return redirect()->back()->withInput()->with('error', trans('app.something_went_wrong'));
            }
        } catch (Throwable $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->withInput()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $user)
    {
        try {
            $data = ['status' => false, 'message' => trans('app.User_not_found'), 'data' => null];
            if ($request->ajax()) {
                if ($user) {
                    $data['data'] = $user;
                    $data['message'] = trans('app.User_has_been_deleted');
                    $data['status'] = true;
                }
                return response()->json($data, 200);
            }
            return view('admin.user.view-user', ['user' => $user]);
        } catch (Throwable $e) {
            report($e);
            return response()->json(['error' => trans('app.something_went_wrong')], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.user.add-user', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'max:255', 'unique:users,email,' . $request->id . ',id,deleted_at,NULL'],
            'country_code' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'numeric', 'digits_between:7,15'],
        ]);

        $photo = null;
        if ($request->file('photo') != "") {
            $file = $request->file('photo');
            $photo = "Img-" . date('YmdHis') . rand(1, 100) . '.' . $file->getClientOriginalExtension();
            Helper::uploadFile($file, config('constant.profile_image_url'), $photo);
            $data['photo'] = $photo;
        }

        try {
            $user->fill($data);
            $user->save();

            return redirect()->route('admin.user.index')->with('success', trans('app.User_has_been_updated'));
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, User $user)
    {
        DB::beginTransaction();
        try {
            $data = ['status' => false, 'message' => trans('app.User_not_found'), 'data' => null];
            if ($request->ajax()) {
                if ($user) {
                    $user->delete();
                    DB::commit();
                    $data['message'] = trans('app.User_has_been_deleted');
                    $data['status'] = true;
                }
            }

            return response()->json($data, 200);
        } catch (Throwable $e) {
            report($e);
            DB::rollback();
            return response()->json(['error' => trans('app.something_went_wrong')], 400);
        }
    }

    /**
     * Block
     *
     * @param  mixed $request
     * @return void
     */
    public function block(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = ['status' => false, 'message' => trans('app.Nothing_to_change'), 'data' => null];

            if ($request->ajax()) {
                $user = User::where('uid', $request->id)->first();
                if ($user) {
                    if ($user->is_active == 1 && $request->status == 2) {
                        $user->is_active = 2;
                        $user->save();
                        $data['message'] = trans('app.User_has_been_deactivated_successfully');
                        $data['status'] = true;

                        // Send Account Suspended mail to user
                        $mail_data = [
                            'email_id' => 5,
                            'user_id' => $user->id
                        ];
                        dispatch(new SendEmailJob($mail_data));
                    } else if (($user->is_active == 0 || $user->is_active == 2) && $request->status == 1) {
                        $user->is_active = 1;
                        $user->save();
                        $data['message'] = trans('app.User_has_been_activated_successfully');
                        $data['status'] = true;

                        // Send Account Activated mail to user
                        $mail_data = [
                            'email_id' => 4,
                            'user_id' => $user->id
                        ];
                        dispatch(new SendEmailJob($mail_data));
                    }
                    DB::commit();
                } else {
                    $data['message'] = trans('app.User_not_found');
                }
            }
            return response()->json($data, 200);
        } catch (Throwable $e) {
            report($e);
            DB::rollback();
            return response()->json(['error' => trans('app.something_went_wrong')], 400);
        }
    }

    /**
     * CheckExists
     *
     * @param  mixed $request
     * @return void
     */
    public function checkExists(Request $request)
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

    public function userLogin(Request $request, $id)
    {
        try {
            if (Auth::guard(ADMIN_GUARD)->check()) {
                $encrypted = Crypt::encryptString($id);
                $signedUrl = URL::temporarySignedRoute('redirect.user-login', now()->addMinutes(5), ['id' => $encrypted]);
                return redirect()->away($signedUrl);
            }
            return redirect()->back()->with('warning', trans('auth.Sufficient_permissions'));
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('warning', trans('auth.Sufficient_permissions'));
        }
    }

    public function userLoginRedirect(Request $request, $id)
    {
        try {
            $user = User::where('uid', Crypt::decryptString($id))->first();
            if ($user && $user->hasRole(USER_ROLE)) {
                if (Auth::guard('web')->check() && in_array(Auth::guard('web')->user()->getRoleNames()->first(), [USER_ROLE])) {
                    Auth::guard('web')->logout();
                }

                Auth::guard('web')->loginUsingId($user->id);

                return redirect()->route('index')->withInput()->with('success', trans('auth.Logged_in_successfully'));
            } else {
                return redirect()->back()->with('error', trans('app.User_not_found'));
            }
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.User_not_found'));
        }
    }
}
