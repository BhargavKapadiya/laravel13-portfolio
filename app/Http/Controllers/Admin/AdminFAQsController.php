<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\FAQs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;


class AdminFAQsController extends Controller
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
            return view('admin.faqs.index');
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Get Records
     *
     * @param  mixed $request
     * @return void
     */
    public function getRecords(Request $request)
    {
        try {
            $faqs = FAQs::orderBy('id', 'desc');

            return DataTables::of($faqs)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.faqs.edit', ['faq' => $row->uid]) . '"  data-id="' . $row->uid . '" class="text-primary" title="Edit"><i class="bx bxs-edit"></i></a>';
                    $btn .= '&nbsp;<a href="javascript:;" class="text-danger delete" data-id="' . $row->uid . '" title="Delete"><i class="bx bxs-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Create
     *
     * @return void
     */
    public function create(Request $request)
    {
        return view('admin.faqs.add-faqs');
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
                    'question' => 'required',
                    'answer' => 'required',
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = [
                'question' => $request->question,
                'answer' => $request->answer,
            ];

            $faq = FAQs::create($data);

            if ($faq) {
                DB::commit();
                return redirect()->route('admin.faqs.index')->with('success', trans('app.FAQ_has_been_added'));
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
    public function edit(Request $request, FAQs $faq)
    {
        try {
            if (empty($faq)) {
                return redirect()->route('admin.faqs.index')->with('error', trans('app.FAQ_is_not_found'));
            }
            return view('admin.faqs.add-faqs', compact('faq'));
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->withInput()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Update
     *
     * @param  mixed $request
     * @return void
     */
    public function update(Request $request, FAQs $faq)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make(
                $request->all(),
                [
                    'question' => 'required',
                    'answer' => 'required',
                ]
            );
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = [
                'question' => $request->question,
                'answer' => $request->answer
            ];

            $faq = FAQs::where('uid', $request->uid)->update($data);

            if ($faq) {
                DB::commit();
                return redirect()->route('admin.faqs.index')->with('success', trans('app.FAQ_has_been_updated'));
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
     * Destroy
     *
     * @param  mixed $request
     * @return void
     */
    public function destroy(Request $request, FAQs $faq)
    {
        try {
            DB::beginTransaction();
            $data = ['status' => false, 'message' => trans('app.FAQ_is_not_found'), 'data' => null];
            if ($request->ajax()) {
                if ($faq) {
                    $faq->delete();

                    $data['message'] = trans('app.FAQ_has_been_deleted');
                    $data['status'] = true;
                    DB::commit();
                }
            }
            DB::rollback();
            return response()->json($data, 200);
        } catch (Throwable $e) {
            report($e);
            DB::rollback();
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
            $exists = FAQs::where('question', $request->question)
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
