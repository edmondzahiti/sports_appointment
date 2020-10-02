@extends('frontend.layouts.app')

@section('cssTopMiddle')
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}" type="text/css">
@endsection

{{-- SEO Related Data --}}
@section('title', trans_choice('messages.user', 2))

{{-- In page title --}}
@section('page_title', trans_choice('messages.user', 2))

@section('content')
	<div class="row">
	  <div class="col-12">
	    <div class="card card-primary card-outline">
	      <div class="card-body table-responsive">
	          <table class="datatable table" id="filesDataTable">
	              <thead>
		              <tr>
		                <th>{{ __('file.id')}}</th>
		                <th>{{ __('file.type')}}</th>
		                <th>{{ __('file.name')}}</th>
		                <th>{{ __('file.visibility')}}</th>
		                <th>{{ __('file.size')}}</th>
		                <th>{{ __('messages.actions')}}</th>
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
			$('#filesDataTable').DataTable({
				responsive: true,
				order: [1, "desc"],
				processing: true,
				serverSide: true,
				ajax: '{!! route('files.datatable') !!}',
				language: {
					"url": "{{ asset('/plugins/datatables-locales/dataTables.'.str_replace('_', '-', app()->getLocale()).'.lang.json') }}"
				},
				columns: [
				    {data: 'id', name: 'id'},
				    {data: 'type', name: 'type'},
				    {data: 'name', name: 'name'},
				    {data: 'visibility', name: 'visibility'},
				    {data: 'size', name: 'size'},
				    {data: 'actions', name: 'actions', orderable: false, searchable: false }
				],
			});
		});
	})(jQuery);
</script>
@endpush
