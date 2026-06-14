@extends('layouts.admin')

@php
    $is_update = false;
    if (isset($category)) {
        $is_update = true;
    }
@endphp
@section('title')
    {{ $is_update ? 'Edit' : 'Add' }} Category
@endsection

@section('breadcrumb')
    <div class="navbar-nav align-items-center">
        <div class="nav-item navbar-search-wrapper mb-0">
            <h4 class="m-0">{{ $is_update ? 'Edit' : 'Add New' }} Category</h4>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="POST" action="{{ $is_update ? route('admin.category.update', ['category' => $category->uid]) : route('admin.category.store') }}" class="form-horizontal form-validate check-form-validation" autocomplete="off">
                            @csrf
                            @if ($is_update)
                                @method('PATCH')
                                <input type="hidden" name="id" value="{{ $category->id }}">
                            @endif
                            @if ($is_update)
                                <div class="row mb-3">
                                    <div class="form-group col-md-6">
                                        <label class="form-label">Category Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Category Name" name="name" id="name" value="{{ old('name', $is_update ? $category->name : '') }}">
                                        @error('name')
                                            <label id="name-error" class="invalid-feedback" for="name" style="display: inline-block;">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="section-repeater" data-startIndex="1">
                                            <div class="row r-group">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col">
                                                            <label class="form-label">Category Name <span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-auto">
                                                            <a href="javascript:void(0)" class="text-danger r-btnRemove" style="visibility: hidden;">- Remove</a>
                                                        </div>
                                                    </div>
                                                    <input type="text" class="form-control category-name unique @error('name') is-invalid @enderror" placeholder="Category Name" name="categories[0][name]" value="{{ old('name') }}" data-pattern="categories[++][name]">
                                                    @error('name')
                                                        <label id="name-error" class="invalid-feedback" for="name" style="display: inline-block;">{{ $message }}</label>
                                                    @enderror
                                                    <div class="border-bottom my-4"></div>
                                                </div>
                                            </div>
                                            <div class="section-append"></div>
                                            <div class="text-right my-3">
                                                <a href="javascript:;" class="text-primary r-btnAdd">+ Add more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="">
                                <a href="{{ route('admin.category.index') }}"><button type="button" class="btn btn-danger mr-1 btn-min-width">Cancel</button></a>
                                <button type="submit" class="btn btn-primary btn-min-width">{{ $is_update ? 'Update' : 'Save' }}</button>
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
        var exists_url = "{{ route('admin.category.exists') }}";
    </script>
    <script defer src="{{ Helper::assets('assets/js/pages/addsection.js') }}" type="text/javascript"></script>
    <script defer src="{{ Helper::assets('assets/js/pages/admin/category.js') }}?v={{ config('constant.asset_version') }}" type="text/javascript"></script>
@endsection
