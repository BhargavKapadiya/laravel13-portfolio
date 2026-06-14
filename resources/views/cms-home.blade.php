@extends('layouts.app')

@section('title') Dashboard @endsection

@php
    $cms_contents = $cms_page->contents ?? [];
@endphp

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h1>{{ $cms_contents['heading'] ?? "" }}</h1></div>

                <div class="card-body">
                    <div class="mb-3">
                        <h2>{{ $cms_contents['banner_title_1'] ?? "" }}</h2>
                    </div>
                    <div class="mb-3">
                        <img src="{{ $cms_contents['banner_image_1'] ? Helper::media(config('constant.cms_page_url') . $cms_contents['banner_image_1']) : "" }}"  width="200"/>
                    </div>
                    <div class="mb-3">
                        <h3>{{ $cms_contents['title_1'] ?? "" }}</h3>
                    </div>
                    <div class="mb-3">
                        <h5>{{ $cms_contents['short_title_1'] ?? "" }}</h5>
                    </div>
                    <div class="mb-3">
                        <img src={{ $cms_contents['image_1'] ? Helper::media(config('constant.cms_page_url') . $cms_contents['image_1']) : "" }}  width="200"/>
                    </div>
                    <div class="mb-3">
                        <p>{{ $cms_contents['content_1'] ?? "" }}</p>
                    </div>
                    <div class="mb-3">
                        <img src={{ $cms_contents['image_2'] ? Helper::media(config('constant.cms_page_url') . $cms_contents['image_2']) : "" }}  width="200"/>
                    </div>
                    <div class="mb-3">
                        {!! $cms_contents['editor_1'] ?? "" !!}
                    </div>
                    <div class="mb-3">
                        <video controls src="{{ $cms_contents['video'] ? Helper::media(config('constant.cms_page_url') . $cms_contents['video']) : "" }}" width="200"></video>
                    </div>
                    <div class="mb-3">
                        <a href="{{ $cms_contents['link_1'] ?? "" }}">Click here</a>
                    </div>
                    <div class="mb-3">
                        {!! $cms_contents['editor_2'] ?? "" !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
