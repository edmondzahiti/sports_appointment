@extends('frontend.layouts.app')

@section('cssTopMiddle')
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}" type="text/css">
@endsection

{{-- SEO Related Data --}}
@section('title', config('app.name') . ' | ' . __('labels.backend.access.users.management'))

{{-- In page title --}}
{{-- @section('page_title', __('labels.backend.access.users.management')) --}}

@section('content')
	<div class="row">
	    <div class="col-sm-5">
	        <h4 class="card-title mb-0"> Users </h4>
	    </div><!--col-->

	    <div class="col-sm-7">
	        @include('admin.users.includes.header-buttons')
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
		                <th>Surname</th>
		                <th>Email</th>
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
				order: [4, "desc"],
				processing: true,
				serverSide: true,
				ajax: '{!! route('users.datatable') !!}',
				language: {
					"url": "{{ asset('/plugins/datatables-locales/dataTables.'.str_replace('_', '-', app()->getLocale()).'.lang.json') }}"
				},
				columns: [
				    {data: 'name', name: 'name'},
				    {data: 'surname', name: 'surname'},
				    {data: 'email', name: 'email'},
                    {data: 'created_at', name: 'created_at'},
				    {data: 'actions', name: 'actions', orderable: false, searchable: false }
				],
			});
		});
	})(jQuery);
</script>
@endpush
