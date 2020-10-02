@extends('admin.layouts.app')

{{-- SEO Related Data --}}
@section('title', trans_choice('messages.permission', 2))

{{-- In page title --}}
@section('page_title', trans_choice('messages.permission', 2))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('labels.backend.access.permissions.management')
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                {{-- @include('admin.roles.includes.buttons') --}}
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>@lang('labels.backend.access.permissions.table.name')</th>
                            <th>@lang('labels.backend.access.permissions.table.guard')</th>
                            <th>@lang('labels.general.actions')</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($permissions as $permission)
                                <tr>
                                    <td>{{ ucwords($permission->name) }}</td>
                                    <td>{{ $permission->guard }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
        <div class="row">
            <div class="col-7">
                <div class="float-left">
                    {!! $permissions->total() !!} {{ trans_choice('labels.backend.access.permissions.table.total', $permissions->total()) }}
                </div>
            </div><!--col-->
            <div class="col-5">
                <div class="float-right">
                    {!! $permissions->render() !!}
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection