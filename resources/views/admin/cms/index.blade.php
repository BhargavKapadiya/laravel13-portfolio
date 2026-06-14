@extends('layouts.admin')

@section('title') CMS pages @endsection

@section('breadcrumb')
<div class="row page-title align-items-center">
    <div class="col-sm-6 col-xl-6">
        <h4 class="mb-1 mt-0 font-weight-medium">CMS pages</h4>
    </div>
</div>
@endsection

@section('css')
<link href="{{ Helper::assets('assets/libs/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ Helper::assets('assets/libs/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="font-size-16 pb-3 d-none table-title">CMS pages</div>
                <table class="table table-striped table-bordered data-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Page name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script-bottom')
<script type="text/javascript">
    var filter_cms_page_url = "{{ route('admin.cms.index') }}";
</script>
<script defer src="{{ Helper::assets('assets/libs/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/datatables/dataTables.responsive.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/datatables/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/libs/sweetalert/sweetalert.min.js') }}" type="text/javascript"></script>
<script defer src="{{ Helper::assets('assets/js/pages/admin/cms_pages.js') }}?v={{config('constant.asset_version')}}" type="text/javascript"></script>
@endsection