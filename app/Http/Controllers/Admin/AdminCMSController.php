<?php

namespace App\Http\Controllers\Admin;

use Exception;
use DOMDocument;
use App\Helpers\Helper;
use App\Models\CmsPages;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminCMSController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {}

    public function index(Request $request)
    {
        try {
            if ($request->ajax()) {
                $cms_pages = CmsPages::orderBy('id', 'desc');

                return DataTables::of($cms_pages)
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('admin.cms.edit', ['id' => $row->id]) . '"  data-id="' . $row->id . '" class="text-success" title="Edit"><i class="uil-edit"></i></a>&nbsp;';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('admin.cms.index');
        } catch (Exception $e) {
            report($e);
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }

    public function edit($id)
    {
        if (is_null($id)) {
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
        $cms_page = CmsPages::select('*')->where('id', $id)->first();

        if (empty($cms_page)) {
            return redirect()->route('admin.cms.index')->with('error', trans('app.Page_is_not_found'));
        }
        return view('admin.cms.edit-page', compact('cms_page'));
    }

    public function update(Request $request)
    {
        $data = array();
        DB::beginTransaction();
        try {
            $page_id = $request->page_id;
            $cms_page = CmsPages::select('*')->where('id', $page_id)->first();
            $cms_contents_arr = $cms_page->contents;

            $request_arr = $request->all();
            unset($request_arr['_token']);
            unset($request_arr['page_id']);
            $data = array_merge($cms_contents_arr, $request_arr);

            if (!empty($request_arr)) {
                foreach ($request_arr as $key => $value) {
                    if (strpos($key, 'image') !== false || strpos($key, 'banner') !== false) {
                        if ($request->file($key) != "") {
                            $image = $request->file($key);
                            $old_image = $cms_contents_arr[$key];
                            $filename = "Img-" . date('YmdHis') . rand(1, 100) . '.' . $image->getClientOriginalExtension();
                            Helper::uploadFile($image, config('constant.cms_page_url'), $filename, $old_image);
                            $data[$key] = $filename;
                        }
                    } else if (strpos($key, 'banner') !== false) {
                        if ($request->file($key) != "") {
                            $image = $request->file($key);
                            $old_image = $cms_contents_arr[$key];
                            $filename = "Banner-" . date('YmdHis') . rand(1, 100) . '.' . $image->getClientOriginalExtension();
                            Helper::uploadFile($image, config('constant.cms_page_url'), $filename, $old_image);
                            $data[$key] = $filename;
                        }
                    } else if (strpos($key, 'video') !== false) {
                        if ($request->file($key) != "") {
                            $image = $request->file($key);
                            $old_image = $cms_contents_arr[$key];
                            $filename = 'VID-' . date('YmdHsi') . rand(10, 99) . '.' . $image->getClientOriginalExtension();
                            Helper::uploadFile($image, config('constant.cms_page_url'), $filename, $old_image);
                            $data[$key] = $filename;
                        }
                    } else if (strpos($key, 'editor') !== false) {
                        $htmlDom = new DOMDocument();
                        $htmlDom->loadHTML($data[$key]);
                        $imageTags = $htmlDom->getElementsByTagName('img');
                        if (!empty($imageTags)) {
                            foreach ($imageTags as $imageTag) {
                                $imgSrc = $imageTag->getAttribute('src');
                                $file = pathinfo($imgSrc);
                                $filename = $file['basename'];
                                Helper::copyFile(config('constant.temp_image_url'), config('constant.cms_page_url'), $filename);
                            }
                            $data[$key] = str_replace(config('constant.temp_image_url'), config('constant.cms_page_url'), $data[$key]);
                        }
                    }
                }
            }

            $cms_page->contents = json_encode($data);
            $cms_page->save();
            DB::commit();
            return redirect()->route('admin.cms.index')->with('success', 'Page details updated successfully');
        } catch (Exception $e) {
            report($e);
            DB::rollback();
            return redirect()->back()->with('error', trans('app.something_went_wrong'));
        }
    }
}
