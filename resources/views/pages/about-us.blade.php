@extends('layouts.app')

@section('title')
    About
@endsection

@php
    $mobile = in_array(Route::currentRouteName(), ['app.about-us']) ? true : false;
@endphp

@section('content')
    <section class="section-py bg-body first-section-pt">
        <div class="container">
            <div class="card px-3">
                <div class="row">
                    <div class="col-lg-7 card-body">
                        <h4 class="mb-2">About Us</h4>

                        {!! $page_content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
