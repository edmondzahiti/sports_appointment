@extends('admin.layouts.app')

{{-- SEO Related Data --}}
@section('title', trans_choice('messages.role', 2))

{{-- In page title --}}
@section('page_title', trans_choice('messages.role', 2))

@section('content')
<form class="form-horizontal" method="POST" action="{{ route('admin.roles.store') }}">
    @csrf
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.access.roles.management')
                        <small class="text-muted">@lang('labels.backend.access.roles.create')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->
            <hr>
            <div class="row mt-4">
                <div class="col">
                    <div class="form-group row">
                        <label for="name" class="col-md-2 form-control-label">{{ __('validation.attributes.backend.access.roles.name') }}</label>
                        <div class="col-md-10">
                            <input type="text" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus  maxlength="191" placeholder="{{ __('validation.attributes.backend.access.roles.name') }}">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                    </div><!--form-group-->
                    @if (config('app.roles.role_with_permission'))
                    <div class="form-group row">
                        <label for="permissions" class="col-md-2 form-control-label">{{ __('validation.attributes.backend.access.roles.associated_permissions') }}</label>

                        <div class="col-md-10">
                            @if($permissions->count())
                                @foreach($permissions as $permission)
                                    <div class="checkbox d-flex align-items-center">
                                        <div class="form-check">
                                            <input type="checkbox" name="permissions[]" {{ old('permissions') && in_array($permission->name, old('permissions')) ? 'checked' : '' }} value="{{ $permission->name }}" class="form-check-input switch-input" id="permission-{{ $permission->id }}">
                                            <label class="form-check-label" for="permission-{{ $permission->id }}">{{ ucwords($permission->name) }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div><!--col-->
                    </div><!--form-group-->
                    @endif
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->
        
        <div class="card-footer">
            <div class="row">
                <div class="col">
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-default">@lang('messages.cancel')</a>
                </div><!--col-->

                <div class="col text-right">
                    <button type="submit" class="btn btn-info pull-right">@lang('messages.create')</button>
                </div><!--col-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
</form>
@endsection