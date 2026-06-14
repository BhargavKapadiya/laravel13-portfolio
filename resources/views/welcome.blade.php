@extends('layouts.app')
@section('title') Home @endsection
@section('content')
    <section class="container mt-2" id="base-style">
        <div class="row justify-content-center">
        @if (Auth::guard()->check())
                You are logged in!
            @else
                You are offline!
            @endif  
        </div>
    </section>
@endsection
