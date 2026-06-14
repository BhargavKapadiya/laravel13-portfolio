@extends('errors::minimal')

@section('title', __('Server Error'))

@section('code', '500')

@section('message')
<h2>Uh oh, there seems to be a problem.</h2>
<p>Sorry, something went wrong on our end. We are currently trying to fix the problem.</p>
<p>In the meantime, you can:</p>
<ul>
    <li>
        Refresh the page
    </li>
    <li>
        Wait a few minutes
    </li>
</ul>
@endsection
