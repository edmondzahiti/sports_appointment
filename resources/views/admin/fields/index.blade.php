@extends('frontend.layouts.app')

@section('cssTopMiddle')
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}" type="text/css">
@endsection

{{-- SEO Related Data --}}
@section('title', config('app.name') . ' | ' . 'Fields')

{{-- In page title --}}
{{-- @section('page_title', __('labels.backend.access.users.management')) --}}

@section('content')
    <div class="row">
        <div class="col-sm-5">
            <h4 class="card-title mb-0"> Users </h4>
        </div><!--col-->

        <div class="col-sm-7">
            <div class="btn-toolbar float-right" role="toolbar" aria-label="@lang('labels.general.toolbar_btn_groups')">
                <a href="{{ route('fields.create') }}" class="btn btn-info btn-flat btn-light-green font-weight-bold ml-1" data-toggle="tooltip" title="Create New User">
                    Create New Field
                </a>
            </div><!--btn-toolbar-->
        </div><!--col-->
    </div><!--row-->

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <table class="table table-bordered" id="tblUsers">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Capacity</th>
                            <th>Created_at</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptBottomMiddle')
    <script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
@endsection

@push('afterJsScripts')
    <script>
        (function($){
            $(document).ready(function () {
                $('#tblUsers').DataTable({
                    responsive: true,
                    order: [1, "asc"],
                    processing: true,
                    serverSide: true,
                    ajax: '{!! route('fields.datatable') !!}',
                    language: {
                        "url": "{{ asset('/plugins/datatables-locales/dataTables.'.str_replace('_', '-', app()->getLocale()).'.lang.json') }}"
                    },
                    columns: [
                        {data: 'name', name: 'name'},
                        {data: 'capacity', name: 'capacity'},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'actions', name: 'actions', orderable: false, searchable: false }
                    ],
                });
            });
        })(jQuery);
    </script>
@endpush
