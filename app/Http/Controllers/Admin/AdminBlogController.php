<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Blog;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AdminBlogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Index
     *
     * @param  mixed $request
     * @return void
     */
    public function index(Request $request)
    {
        try {
            return view('admin.blog.index');
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    public function getRecords(Request $request)
    {
        try {
            $blog = Blog::orderBy('id', 'desc');
            return DataTables::of($blog)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.blogs.edit', ['blog' => $row->uid]) . '"  data-id="' . $row->uid . '" class="text-primary" title="Edit"><i class="bx bxs-edit"></i></a>&nbsp;';
                    $btn .= '&nbsp;<a href="javascript:;" class="text-danger delete" data-id="' . $row->uid . '" title="Delete"><i class="bx bxs-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (Throwable $e) {
            report($e);
            return response()->json()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Create
     *
     * @return void
     */
    public function create(Request $request)
    {
        try {
            return view('admin.blog.add-blog');
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make(
                $request->all(),
                [
                    'title' => ['required', 'string', 'max:255', 'unique:blogs,title,NULL,id,deleted_at,NULL'],
                    'slug' => ['nullable', 'string', 'unique:blogs,slug,NULL,id,deleted_at,NULL'],
                    'image' => 'required',
                    'description' => 'required',
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $slug = $request->slug ?? null;
            if ($slug == null) {
                $slug = Helper::createSlug($request->title, null, "blog");
            }

            $description = Helper::replaceImagePath($request->description, config('constant.cms_page_url'));
            $blog_image = null;

            if ($request->file('image') != "") {
                $image = $request->file('image');
                $blog_image = "Img-" . date('YmdHis') . mt_rand(1, 100) . '.' . $image->getClientOriginalExtension();
                Helper::uploadFile($image, config('constant.blog_url'), $blog_image);
            }

            $data = [
                'title' => $request->title,
                'description' => $description,
                'image' => $blog_image,
                'slug' => $slug,
                'time_spend' => $request->time_spend ?? null,
                'meta_title' => $request->meta_title ?? null,
                'meta_desc' => $request->meta_desc ?? null,
            ];

            $blog = Blog::create($data);

            if ($blog) {
                DB::commit();
                return redirect()->route('admin.blogs.index')->with('success', trans('app.Blog_has_been_added'));
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
     * Edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit(Request $request, Blog $blog)
    {
        try {
            if (empty($blog)) {
                return redirect()->route('admin.blogs.index')->with('error', trans('app.Blog_is_not_found'));
            }

            return view('admin.blog.add-blog', compact('blog'));
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Update
     *
     * @param  mixed $request
     * @return void
     */
    public function update(Request $request, Blog $blog)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make(
                $request->all(),
                [
                    'title' => ['required', 'string', 'max:255', 'unique:blogs,title,' . $request->id . ',id,deleted_at,NULL'],
                    'slug' => ['nullable', 'string', 'unique:blogs,slug,' . $request->id . ',id,deleted_at,NULL'],
                    // 'image' => 'required',
                    'description' => 'required',
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $slug = $request->slug ?? null;
            if ($slug == null) {
                $slug = Helper::createSlug($request->title, $request->id, "blog");
            }

            $description = Helper::replaceImagePath($request->description, config('constant.cms_page_url'));

            $blog_image = "";
            if ($request->file('image') != "") {
                $image = $request->file('image');
                $blog_image = "Img-" . date('YmdHis') . rand(1, 100) . '.' . $image->getClientOriginalExtension();
                Helper::uploadFile($image, config('constant.blog_url'), $blog_image, $request->old_image);
            }

            $data = [
                'title' => $request->title,
                'description' => $description,
                'slug' => $slug,
                'time_spend' => $request->time_spend ?? null,
                'meta_title' => $request->meta_title ?? null,
                'meta_desc' => $request->meta_desc ?? null,
            ];

            if ($blog_image != '') {
                $data['image'] = $blog_image;
            }

            $blog = Blog::where('uid', $request->uid)->update($data);

            if ($blog) {
                DB::commit();
                return redirect()->route('admin.blogs.index')->with('success', trans('app.Blog_has_been_updated'));
            } else {
                DB::rollback();
                return redirect()->back()->withInput()->with('error', trans('app.something_went_wrong'));
            }
        } catch (Throwable $e) {
            DB::rollback();
            report($e);
            return redirect()->back()->withInput()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Delete
     *
     * @param  mixed $request
     * @return void
     */
    public function destroy(Request $request, Blog $blog)
    {
        DB::beginTransaction();
        try {
            $data = ['status' => false, 'message' => trans('app.Blog_is_not_found'), 'data' => null];

            if ($blog) {
                Helper::deleteFile(config('constant.blog_url'), $blog->image);
                $blog->delete();

                $data['message'] = trans('app.Blog_has_been_deleted');
                $data['status'] = true;
                DB::commit();
            }

            return response()->json($data, 200);
        } catch (Throwable $e) {
            DB::rollback();
            report($e);
            return response()->json(['status' => false, 'message' => trans('app.something_went_wrong'), 'data' => null], 400);
        }
    }

    /**
     * Exists
     *
     * @param  mixed $request
     * @return void
     */
    public function exists(Request $request)
    {
        try {
            $exists = Blog::query()
                ->when(($request->has('title') && $request->title != ""), function ($query) use ($request) {
                    $query->where('title', $request->title);
                })
                ->when(($request->has('slug') && $request->slug != ""), function ($query) use ($request) {
                    $query->where('slug', $request->slug);
                })
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
     * Approve / Disapprove
     *
     * @param  mixed $request
     * @return void
     */
    public function approve(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = ['status' => false, 'message' => trans('app.Nothing_to_change'), 'data' => null];

            if ($request->ajax()) {
                $blog = Blog::where('id', $request->id)->first();
                if ($blog) {
                    if (($blog->status == 0 || $blog->status == 2) && $request->status == 1) {
                        // Approve blog
                        $blog->status = 1;
                        $blog->save();
                        $data['message'] = trans('app.Blog_has_been_approved_successfully');
                        $data['status'] = true;
                    } else if ($blog->status == 1 && $request->status == 1) {
                        $data['message'] = trans('app.Blog_already_approved');
                    } else if (($blog->status == 0 || $blog->status == 1) && $request->status == 2) {
                        // Decline blog
                        $blog->status = 2;
                        $blog->save();
                        $data['message'] = trans('app.Blog_has_been_disapproved_successfully');
                        $data['status'] = true;
                    } else if ($blog->status == 2 && $request->status == 2) {
                        $data['message'] = trans('app.Blog_already_declined');
                    }
                    DB::commit();
                } else {
                    $data['message'] = trans('app.Blog_is_not_found');
                }
            }
            return response()->json($data, 200);
        } catch (Throwable $e) {
            report($e);
            DB::rollback();
            return response()->json(['error' => trans('app.something_went_wrong')], 400);
        }
    }
}
