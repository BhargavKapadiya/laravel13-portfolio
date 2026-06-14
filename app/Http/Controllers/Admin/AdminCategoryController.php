<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class AdminCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $categories = Category::orderBy('id', 'desc');

                return DataTables::of($categories)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('admin.category.edit', ['category' => $row->uid]) . '"  data-id="' . $row->uid . '" class="text-primary" title="Edit"><i class="bx bxs-edit"></i></a>';
                        $btn .= '&nbsp;<a href="javascript:;" class="text-danger delete" data-id="' . $row->uid . '" title="Delete"><i class="bx bxs-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action', 'image'])
                    ->make(true);
            }
            return view('admin.category.index');
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            return view('admin.category.add-category');
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make(
                $request->all(),
                [
                    'categories.*.name' => ['required', 'string', 'max:255', 'unique:categories,name,NULL,id,deleted_at,NULL'],
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $category = null;
            foreach ($request->categories as $category) {
                $data = [
                    'name' => $category['name'],
                ];

                $category = Category::create($data);
            }

            if ($category) {
                DB::commit();
                return redirect()->route('admin.category.index')->with('success', trans('app.Category_has_been_added'));
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
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Category $category)
    {
        try {
            if (empty($category)) {
                return redirect()->route('admin.category.index')->with('error', trans('app.Category_is_not_found'));
            }

            // return view('admin.category.view-category', compact('category'));
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Category $category)
    {
        try {
            if (empty($category)) {
                return redirect()->route('admin.category.index')->with('error', trans('app.Category_is_not_found'));
            }

            return view('admin.category.add-category', compact('category'));
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make(
                $request->all(),
                [
                    'id' => ['required'],
                    'name' => ['required', 'string', 'max:255', 'unique:categories,name,' . $request->id . ',id,deleted_at,NULL'],
                ]
            );

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $category->name = $request->name;
            $category->save();

            if ($category) {
                DB::commit();
                return redirect()->route('admin.category.index')->with('success', trans('app.Category_has_been_updated'));
            } else {
                DB::rollback();
                return redirect()->back()->withInput()->with('error', trans('app.something_went_wrong'));
            }
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->withInput()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category)
    {
        try {
            DB::beginTransaction();
            $data = ['status' => false, 'message' => trans('app.Category_is_not_found'), 'data' => null];

            if ($request->ajax()) {
                if ($category) {
                    $category->delete();
                    $data['status'] = true;
                    $data['message'] = trans('app.Category_has_been_deleted');
                    DB::commit();
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
            $exists = Category::where('name', $request->name)
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
}
