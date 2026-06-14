<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminEnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $enquiries = Contact::orderBy('id', 'desc');

                return DataTables::of($enquiries)
                    ->addIndexColumn()
                    ->editColumn('created_at', function ($row) {
                        return $row->created_at->format('d/m/Y');
                    })
                    ->addColumn('action', function ($row) {
                        $btn = '';
                        $btn .= '&nbsp;<a href="javascript:;" class="text-danger delete" data-id="' . $row->uid . '" title="Delete"><i class="bx bxs-trash"></i></a>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }

            return view('admin.enquiry.index');
        } catch (Throwable $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = ['status' => false, 'message' => trans('app.Enquiry_is_not_found'), 'data' => null];

            if ($request->ajax()) {
                $enquiry = Contact::where('uid', $request->id)->first();

                if ($enquiry) {
                    $enquiry->delete();
                    DB::commit();
                    $data['message'] = trans('app.Enquiry_has_been_deleted');
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
}
