@extends('errors::minimal')

@section('title', __('Not Found'))

@section('code', '404')

@section('message')
<div class="text-center">
    <h2 class="mb-3">Oops! Page Not Found.</h2>
    <p class="lead mb-7 px-md-12 px-lg-5 px-xl-7">The page you are looking for is not available or has been
        moved. Try a different page or go to homepage with the button below.</p>
    <a href="{{ request()->is('admin/*') ? route('admin.dashboard') : route('index') }}" class="btn btn-primary rounded-pill">Go to Home page</a>
</div>
@endsection
