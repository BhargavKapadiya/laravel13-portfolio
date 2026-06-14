@extends('layouts.app')

@section('title')
    Terms & Conditions
@endsection

@php
    $mobile = in_array(Route::currentRouteName(), ['app.terms-conditions']) ? true : false;
@endphp

@section('content')
    <section class="section-py bg-body first-section-pt">
        <div class="container">
            <div class="card px-3">
                <div class="row">
                    <div class="col-lg-7 card-body">
                        <h4 class="mb-2">Terms & Conditions</h4>

                        {!! $page_content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
