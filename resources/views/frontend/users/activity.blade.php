@extends('frontend.layouts.app')

@section('cssTopMiddle')
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}" type="text/css">
@endsection

@section('content')

<div class="row">
  <div class="col-md-3">
    @include('frontend.users.includes.sidebar', ['activePage' => 'activity'])
  </div>
  <!-- /.col -->
  <div class="col-xl-7 col-md-9">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title">Activity Log</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
          <table class="datatable table" id="activity">
              <thead>
              <tr>
                  <th>{{ __('activities.id')}}</th>
                  <th>{{ __('activities.causer')}}</th>
                  <th>{{ __('activities.description')}}</th>
                  <th>{{ __('activities.subject_id')}}</th>
                  <th>{{ __('activities.subject_type')}}</th>
                  <th>{{ __('activities.created_at')}}</th>
                  <th>{{ __('messages.actions')}}</th>
              </tr>
              </thead>
          </table>
      </div>
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
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
          $('#activity').DataTable({
            responsive: true,
            order: [1, "desc"],
            processing: true,
            serverSide: true,
            ajax: '{!! route('activity.datatable') !!}',
            language: {
              "url": "{{ asset('/plugins/datatables-locales/dataTables.'.str_replace('_', '-', app()->getLocale()).'.lang.json') }}"
            },
            columns: [
                {data: 'id', name: 'id'},
                {data: 'causer', name: 'causer'},
                {data: 'description', name: 'description'},
                {data: 'subject_id', name: 'subject_id'},
                {data: 'subject_type', name: 'subject_type'},
                {data: 'created_at', name: 'created_at'},
                {
                    data: 'actions',
                    name: 'actions',
                    searchable: false,
                    orderable: false,
                    render: function (data, type, full, meta) {
                      var dropdown = Array();
                      dropdown.push('<div class="dropdown">');
                      dropdown.push(' <button class="btn btn-xs btn-default dropdown-toggle" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="dropdownMenuButton'+full.id+'">');
                      dropdown.push('     <span class="caret"></span>');
                      dropdown.push('     <span>@lang('messages.actions')</span>');
                      dropdown.push(' </button>');
                      dropdown.push(' <div class="dropdown-menu" role="menu" aria-labelledby="dropdownMenuButton'+full.id+'">');
                      dropdown.push('     <a class="dropdown-item" href="'+full.view+'">@lang('messages.show')</a>');
                      dropdown.push('     <div class="dropdown-divider"></div>');
                      dropdown.push('     <div class="dropdown-item">');
                      dropdown.push('         <form method="POST" action="'+full.destroy+'" style="display:inline">');
                      dropdown.push('             @method('DELETE')');
                      dropdown.push('             @csrf');
                      dropdown.push('             <button type="submit" class="btn btn-xs btn-danger" onclick="return confirm(\'@lang('messages.delete_confirmation')\');" value="Submit">');
                      dropdown.push('                 <i class="fa fa-trash"></i> @lang('messages.delete')');
                      dropdown.push('             </button>');
                      dropdown.push('         </form>');
                      dropdown.push('     </div>');
                      dropdown.push(' </div>');
                      dropdown.push('</div>');


                      return dropdown.join('');
                    }
                }
            ],
          });
        });
      })(jQuery);
    </script>
@endpush