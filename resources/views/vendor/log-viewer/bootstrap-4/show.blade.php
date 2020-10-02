<?php
/**
 * @var  Arcanedev\LogViewer\Entities\Log            $log
 * @var  Illuminate\Pagination\LengthAwarePaginator  $entries
 * @var  string|null                                 $query
 */
?>
@extends('admin.layouts.app')

@push('afterStylesheets')
    @include('log-viewer::_template.style')
@endpush

@section('page_title', "Log - [{$log->date}]")

@section('content')
<div class="row">

    <div class="col-xl-2 col-lg-3 col-md-4">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-fw fa-flag"></i> Levels
                </h3>
            </div>
            <div class="list-group list-group-flush">
                @foreach($log->menu() as $levelKey => $item)
                    @if ($item['count'] === 0)
                        <a href="#0" class="list-group-item disabled">
                            <span class="badge level level-none">
                                {!! $item['icon'] !!} {{ $item['name'] }}
                            </span>
                        </a>
                    @else
                        <a href="{{ $item['url'] }}" class="list-group-item {{ $level }} {{ $level === $levelKey ? ' active' : ''}}">
                            <span class="badge level level-{{ $level }} float-left">
                                {!! $item['icon'] !!} {{ $item['name'] }}
                            </span>
                            <span class="badge badge-pill level level-{{ $level }} float-right">
                                {{ $item['count'] }}
                            </span>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-xl-10 col-lg-9 col-md-6">
        {{-- Log Details --}}
        <div class="card">
            <div class="card-header">
                Log info :
                <div class="float-right">
                    <a href="{{ route('log-viewer::logs.download', [$log->date]) }}" class="btn btn-sm btn-success">
                        <i class="fa fa-download"></i> DOWNLOAD
                    </a>
                    <a href="#delete-log-modal" class="btn btn-sm btn-danger" data-toggle="modal" data-backdrop="false">
                        <i class="fa fa-trash"></i> DELETE
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-sm-2">
                                File path:
                            </div>
                            <div class="col-sm-10">
                                {{ $log->getPath() }}
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-sm-auto">
                                Log entries: <span class="badge badge-primary">{{ $entries->total() }}</span>
                            </div>
                            <div class="col-sm-auto">
                                Size: <span class="badge badge-primary">{{ $log->size() }}</span>
                            </div>
                            <div class="col-sm-auto">
                                Created at: <span class="badge badge-primary">{{ $log->createdAt() }}</span>
                            </div>
                            <div class="col-sm-auto">
                                Updated at: <span class="badge badge-primary">{{ $log->updatedAt() }}</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="card-footer">
                {{-- Search --}}
                <form action="{{ route('log-viewer::logs.search', [$log->date, $level]) }}" method="GET">
                    <div class="form-group">
                        <div class="input-group">
                            <input id="query" name="query" class="form-control" value="{{ $query }}" placeholder="Type here to search">
                            <div class="input-group-append">
                                @unless (is_null($query))
                                    <a href="{{ route('log-viewer::logs.show', [$log->date]) }}" class="btn btn-secondary">
                                        ({{ $entries->count() }} results) <i class="fa fa-fw fa-times"></i>
                                    </a>
                                @endunless
                                <button id="search-btn" class="btn btn-primary">
                                    <span class="fa fa-fw fa-search"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Log Entries --}}
        <div class="card mt-4">
            @if($entries->hasPages())
                <div class="card-header">
                    <div class="row">
                        <div class="col">
                            {!! $entries->appends(compact('query'))->render('log-viewer::_pagination.bootstrap-4') !!}
                        </div>
                        <div class="col text-right">
                            <span class="badge badge-info">
                                Page {!! $entries->currentPage() !!} of {!! $entries->lastPage() !!}
                            </span>
                        </div>
                    </div>
                </div>
            @endif

            <div class="card-body table-responsive">
                <table id="entries" class="table table-sm mb-0" style="word-break: break-word;">
                    <thead>
                    <tr>
                        <th>ENV</th>
                        <th style="width: 120px;">Level</th>
                        <th style="width: 65px;">Time</th>
                        <th style="width: 50%;">Header</th>
                        <th class="text-right">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($entries as $key => $entry)
                        <tr>
                            <td>
                                <span class="badge badge-env">{{ $entry->env }}</span>
                            </td>
                            <td>
                            <span class="badge level level-{{ $entry->level }}">
                                {!! $entry->level() !!}
                            </span>
                            </td>
                            <td>
                            <span class="badge badge-default">
                                {{ $entry->datetime->format('H:i:s') }}
                            </span>
                            </td>
                            <td>
                                {{ $entry->header }}
                            </td>
                            <td class="text-right">
                                @if($entry->hasStack())
                                    <a class="btn btn-sm btn-outline-info" role="button" data-toggle="collapse" href="#log-stack-{{ $key }}" aria-expanded="false" aria-controls="log-stack-{{ $key }}">
                                        <i class="fa fa-toggle-on"></i> Stack
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @if($entry->hasStack())
                            <tr class="stack-content collapse" id="log-stack-{{ $key }}">
                                <td colspan="5" class="stack">
                                    {!! trim($entry->stack()) !!}
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                <span class="badge badge-default">{{ __('log-viewer::general.empty-logs') }}</span>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div><!--card-body-->
            @if($entries->hasPages())
                <div class="card-footer">
                    <div class="row">
                        <div class="col">
                            {!! $entries->appends(compact('query'))->render('log-viewer::_pagination.bootstrap-4') !!}
                        </div>
                        <div class="col text-right">
                        <span class="badge badge-info">
                            Page {!! $entries->currentPage() !!} of {!! $entries->lastPage() !!}
                        </span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection

@push('afterJsScripts')
    <script>
        $(function () {
            var deleteLogModal = $('div#delete-log-modal'),
                deleteLogForm  = $('form#delete-log-form'),
                submitBtn      = deleteLogForm.find('button[type=submit]');

            deleteLogForm.on('submit', function(event) {
                event.preventDefault();
                submitBtn.button('loading');

                $.ajax({
                    url:      $(this).attr('action'),
                    type:     $(this).attr('method'),
                    dataType: 'json',
                    data:     $(this).serialize(),
                    success: function(data) {
                        submitBtn.button('reset');
                        if (data.result === 'success') {
                            deleteLogModal.modal('hide');
                            location.replace("{{ route('log-viewer::logs.list') }}");
                        }
                        else {
                            alert('OOPS ! This is a lack of coffee exception !')
                        }
                    },
                    error: function(xhr, textStatus, errorThrown) {
                        alert('AJAX ERROR ! Check the console !');
                        console.error(errorThrown);
                        submitBtn.button('reset');
                    }
                });

                return false;
            });

            @unless (empty(log_styler()->toHighlight()))
                @php
                    $htmlHighlight = version_compare(PHP_VERSION, '7.4.0') >= 0
                        ? join('|', log_styler()->toHighlight())
                        : join(log_styler()->toHighlight(), '|');
                @endphp

                $('.stack-content').each(function() {
                    var $this = $(this);
                    var html = $this.html().trim()
                        .replace(/({!! $htmlHighlight !!})/gm, '<strong>$1</strong>');

                    $this.html(html);
                });
            @endunless
        });
    </script>
@endpush
