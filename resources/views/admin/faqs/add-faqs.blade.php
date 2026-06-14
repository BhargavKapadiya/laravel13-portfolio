@extends('layouts.admin')

@php
    $is_update = false;
    if (isset($faq)) {
        $is_update = true;
    }
@endphp
@section('title')
    {{ $is_update ? 'Edit' : 'Add' }} FAQ
@endsection

@section('breadcrumb')
    <div class="navbar-nav align-items-center">
        <div class="nav-item navbar-search-wrapper mb-0">
            <h4 class="m-0">{{ $is_update ? 'Edit' : 'Add New' }} FAQ</h4>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="POST" action="{{ $is_update ? route('admin.faqs.update', ['faq' => $faq->uid]) : route('admin.faqs.store') }}" class="form-horizontal   faqs-form-validate" autocomplete="off">
                            @csrf
                            @if ($is_update)
                                <input type="hidden" name="uid" value="{{ $faq->uid }}">
                                @method('PATCH')
                            @endif
                            <div class="form-group">
                                <div class="row mb-3">
                                    <div class="form-group col">
                                        <label class="form-label">Question <span class="text-danger">*</span></label>
                                        <textarea name="question" class="form-control" id="question" rows="2" cols="80" placeholder="Question">{{ old('question', $is_update ? $faq->question : '') }}</textarea>
                                        @error('question')
                                            <label id="question-error" class="invalid-feedback" for="title" style="display: inline-block;">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="form-group col">
                                        <label class="form-label">Answer <span class="text-danger">*</span></label>
                                        <textarea name="answer" class="form-control" id="answer" rows="5" cols="80" placeholder="Answer">{{ old('answer', $is_update ? $faq->answer : '') }}</textarea>
                                        @error('answer')
                                            <label id="answer-error" class="invalid-feedback" for="answer" style="display: inline-block;">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="">
                                <a href="{{ route('admin.faqs.index') }}"><button type="button" class="btn btn-danger mr-1 btn-min-width">Cancel</button></a>
                                <button type="submit" class="btn btn-primary">{{ $is_update ? 'Update' : 'Save' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script defer src="{{ Helper::assets('assets/libs/validation/validate.min.js') }}" type="text/javascript"></script>
@endsection

@section('script-bottom')
    <script type="text/javascript">
        var exists_url = "{{ route('admin.faqs.exists') }}";
    </script>
    <script defer src="{{ Helper::assets('assets/js/pages/admin/faqs.js') }}?v={{ config('constant.asset_version') }}" type="text/javascript"></script>
@endsection
