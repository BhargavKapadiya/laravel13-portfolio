@extends('layouts.app')

@section('title') {{ $blog->meta_title ?? $blog->title }} @endsection

@section('facebook_meta')
@php
$meta_image = $blog->image != "" ? $blog->image_url : "";
@endphp
<meta property="og:title" content="{{ $blog->meta_title ?? $blog->title }}">
<meta property="og:description" content="{!! substr(strip_tags($blog->meta_desc ?? $blog->description),0,300) !!}">
<meta property="og:image" content="{{ $meta_image }}">
<meta property="og:image:alt" content="{{$blog->meta_image_alt ?? ''}}">
<meta property="og:updated_time" content="{{Carbon::parse($blog->updated_at)->format(DateTime::ISO8601)}}">
<meta name="twitter:title" content="{{ $blog->meta_title ?? $blog->title }}" />
<meta name="twitter:description" content="{!! substr(strip_tags($blog->meta_desc ?? $blog->description),0,300) !!}" />
<meta property="twitter:image" content="{{$meta_image}}">
<meta name="description" content="{!! substr(strip_tags($blog->meta_desc ?? $blog->description),0,300) !!}">
<meta property="article:published_time" content="{{Carbon::parse($blog->created_at)->format(DateTime::ISO8601)}}">
<meta property="article:modified_time" content="{{Carbon::parse($blog->updated_at)->format(DateTime::ISO8601)}}">
@endsection

@section('content')
    <section class="page-title blog-backimg" style="background-image:url({{ $blog->image_url }});">

    </section>
    <section class="blog-text mt-3 mb-4">
        <div class="">
            <h3 class="blog-main-title">{{ $blog->title }}</h3>
            <div class="mt-4 mb-2 html-content">
                {!! $blog->description !!}
            </div>
        </div>
    </section>

    <section class="read-blogs mb-4">
        <div class="clearfix">
            <div class="row">
                <div class="col-12 text-center">
                    <h3 class="read-more-title">More blogs</h3>
                    <div class="green-line mx-auto"></div>
                </div>
                <x-read-more-blog :blogId="$blog->id"></x-read-more-blog>
            </div>
        </div>
    </section>
@endsection
