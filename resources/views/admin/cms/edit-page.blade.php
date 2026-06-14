@extends('layouts.admin')

@section('title') Edit Page @endsection

@section('breadcrumb')
<div class="row page-title align-items-center">
    <div class="col-sm-6 col-xl-6">
        <h4 class="mb-1 mt-0 font-weight-medium">Edit Page</h4>
    </div>
</div>
@endsection

@php
// video, title, content, image, testimonital, editor
$is_update = false;
$cms_contents = $routename = $page_name = null;
if (isset($cms_page) && !empty($cms_page)) {
	$is_update = true;
	$cms_contents = $cms_page->contents;
	$routename = $cms_page->slug;
	$page_name = $cms_page->page_name;
}
@endphp

@section('content')
<style type="text/css" media="screen">
	.cms-pages label.control-label col-md-3{text-transform: capitalize;}
	.cms-pages .dashed-border{border-top: 1px dashed #ccc;}
	.cms-pages .notes,.cms-pages ul.list{position: relative;display: block;float: left;}
	.cke_dialog_ui_vbox_child {
	    padding: 10px 0;
	}
</style>
<div class="content-body">
    <div class="row match-height">
        <div class="col-md-12">
            <div class="card border-info border-bottom-2">
                <div class="card-content collapse show">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.cms.update') }}" class="form-horizontal   cms-page-form-validate" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        @if (isset($is_update) && $is_update)
                            <input type="hidden" value="{{ $cms_page->id }}" name="page_id">
                        @endif
                        <b>Notes:</b>
                        <ul class="list">
                            @if($routename == 'cms.home')
                                <li>All images should be 632px X 515px</li>
                            @endif
                        </ul>
                        <div class="clear"><hr class="dashed-border"></div>

                        <div class="">
                            @if(isset($cms_contents) && !empty($cms_contents) && count($cms_contents))
                                @foreach($cms_contents as $key => $content)
                                    <div class="form-group">
                                        @if(strpos($key, 'short_title') !== false)

                                            <label class="text-capitalize">{{ str_replace('_', ' ', $key) }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control short-title" name="{{ $key }}" id="{{ $key }}" value="{{ $content }}">

                                        @elseif(strpos($key, 'title') !== false)

                                            <label class="text-capitalize">{{ str_replace('_', ' ', $key) }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control title" name="{{ $key }}" id="{{ $key }}" value="{{ $content }}">

                                        @elseif(strpos($key, 'heading') !== false)

                                            <label class="text-capitalize">{{ str_replace('_', ' ', $key) }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control heading" name="{{ $key }}" id="{{ $key }}" value="{{ $content }}">

                                        @elseif(strpos($key, 'content') !== false)

                                            <label class="text-capitalize">{{ str_replace('_', ' ', $key) }} <span class="text-danger">*</span></label>
                                            <textarea class="form-control contents" name="{{ $key }}" id="{{ $key }}" rows="8">{{ $content }}</textarea>

                                        @elseif(strpos($key, 'image') !== false)

                                            <label class="text-capitalize">{{ str_replace('_', ' ', $key) }} <span class="text-danger">*</span></label>
                                            <div class="">
                                                <input type="file" class="images" name="{{ $key }}" id="{{ $key }}" accept="image/*">
                                                <div class="imgContainer mt-1" style="position: relative;">
                                                    <img src="{{ Helper::media(config('constant.cms_page_url') . $content) }}" width="250px" height="150px">
                                                </div>
                                            </div>
                                            <div class="help-block">Accepted formats: jpg, jpeg, png.</div>

                                        @elseif(strpos($key, 'banner') !== false)

                                            <label class="text-capitalize">{{ str_replace('_', ' ', $key) }} <span class="text-danger">*</span></label>
                                            <div class="">
                                                <input type="file" class="banners" name="{{ $key }}" id="{{ $key }}" accept="image/*">
                                                <div class="imgContainer mt-1" style="position: relative;">
                                                    <img src="{{ Helper::media(config('constant.cms_page_url') . $content) }}" width="250px" height="150px">
                                                </div>
                                            </div>
                                            <div class="help-block">Accepted formats: jpg, jpeg, png.</div>

                                        @elseif(strpos($key, 'video') !== false)

                                            <label class="text-capitalize">{{ str_replace('_', ' ', $key) }} <span class="text-danger">*</span></label>
                                            <div class="">
                                                <input type="file" class="videos" name="{{ $key }}" id="{{ $key }}" accept="video/*">
                                                <div class="vidContainer mt-1">
                                                    <video width="320" controls>
                                                        <source src="{{ Helper::media(config('constant.cms_page_url') . $content) }}" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                </div>
                                            </div>
                                            <div class="help-block">Accepted formats: mp4.</div>

                                        @elseif(strpos($key, 'editor') !== false)

                                            <label class="text-capitalize">{{ str_replace('_', ' ', $key) }} <span class="text-danger">*</span></label>
                                            <textarea class="form-control editor" name="{{ $key }}" id="editor-{{ $key }}" rows="10">{{ $content }}</textarea>

                                        @elseif(strpos(strtolower($key), 'link') !== false)

                                            <label class="text-capitalize">{{ str_replace('_', ' ', $key) }} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control link" name="{{ $key }}" id="{{ $key }}" value="{{ $content }}">

                                        @else
                                            {{ $key }}
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="form-actions center">
                            <a href="{{ route('admin.cms.index') }}"><button type="button" class="btn btn-danger mr-1 btn-min-width">Cancel</button></a>
                            <button type="submit" class="btn btn-primary btn-min-width">{{ $is_update ? 'Update' : 'Save' }}</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script-bottom')
    <script type="text/javascript">
        var image_upload_url = "{{ route('upload-ck-editor-images', ['_token' => csrf_token() ]) }}";
    </script>
    <script defer src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}" type="text/javascript"></script>
    <script defer src="{{ Helper::assets('assets/libs/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
    <script defer type="text/javascript">
        var is_form_edit = true;
        var routname = "{{ $routename }}";
        $(document).ready(function () {
            if ( $('.editor').length ) {
                $('.editor').each(function(){
                    const editor = CKEDITOR.replace("description", {
                        height: "350px",
                        toolbarGroups: [
                            { name: "styles", groups: ["styles"] },
                            { name: "paragraph", groups: ["list", "indent", "blocks", "align", "bidi", "paragraph"] },
                            { name: "insert", groups: ["insert"] },
                            { name: "basicstyles", groups: ["basicstyles", "cleanup"] },
                            { name: "colors", groups: ["colors"] },
                            { name: "clipboard", groups: ["clipboard", "undo"] },
                            { name: "editing", groups: ["find", "selection", "spellchecker", "editing"] },
                            { name: "forms", groups: ["forms"] },
                            { name: "links", groups: ["links"] },
                            { name: "document", groups: ["mode", "document", "doctools"] },
                        ],
                        removeButtons: "Save,Language,Templates,NewPage,Preview,Print,Replace,Find,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Flash,Smiley,Iframe,Font,About",
                        image_previewText: " ",
                        removeDialogTabs: "image:advanced;image:Link",
                        filebrowserUploadUrl: image_upload_url,
                        filebrowserUploadMethod: "form",
                    });
                    editor.on('change', function (evt) {
                        const element = evt.editor.name;
                        CKEDITOR.instances[element].updateElement();
                        $("[name=" + element + "]").trigger('blur');
                    });
                })
            }
        });
    </script>
    @if (isset($is_update) && $is_update)
    <script type="text/javascript"> is_form_edit = false; </script>
    @endif
<script defer type="text/javascript" src="{{ Helper::assets('assets/js/pages/admin/cms_pages.js') }}?v={{config('constant.asset_version')}}"></script>
@endsection
