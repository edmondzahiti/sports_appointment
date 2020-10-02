@extends('frontend.layouts.app')

{{-- SEO Related Data --}}

{{-- In page title --}}
@section('page_title', __('Fields Management'))
@section('page_subtitle', __('Update Field'))


@section('content')
    <form method="POST" action="{{ route('fields.update', $field) }}">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-body">

                <div class="form-group row mb-4">
                    <div class="col-12">
                        <h3 class="card-title font-weight-bold">{{ __('field Data') }}</h3>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <div class="col-xl-3 col-lg-4 mb-2 {{ $errors->has('name') ? ' has-error' : '' }}">
                        <input id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" name="name" value="{{ old('name', $field->name) }}" required autocomplete="name" autofocus placeholder="{{ __('Name') }}" maxlength="64">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>

                    <div class="col-xl-3 col-lg-4 mb-2 {{ $errors->has('capacity') ? ' has-error' : '' }}">
                        <input id="capacity" type="text" class="form-control {{ $errors->has('capacity') ? 'is-invalid' : ''}}" name="capacity" value="{{ old('capacity', $field->capacity) }}" required autocomplete="capacity" autofocus placeholder="{{ __('Capacity') }}" maxlength="64">
                        @if ($errors->has('capacity'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('capacity') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

{{--                <div class="form-group row mb-2">--}}
{{--                    <div class="col-xl-6 col-lg-8 mb-2 {{ $errors->has('email') ? ' has-error' : '' }}">--}}
{{--                        <input id="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" name="email" value="{{ old('email', $field->email) }}" required autocomplete="email" placeholder="{{ __('E-Mail Address') }}">--}}
{{--                        @if ($errors->has('email'))--}}
{{--                            <span class="invalid-feedback" role="alert">--}}
{{--                            <strong>{{ $errors->first('email') }}</strong>--}}
{{--                        </span>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="row mb-4">--}}
{{--                    <div class="col-xl-6 mb-2 {{ $errors->has('role') ? ' has-error' : '' }}">--}}
{{--                        <select name="role" class="form-control {{ $errors->has('role') ? ' is-invalid' : '' }}">--}}
{{--                            <option value="0" {{$field->is_admin == 0 ? 'selected' : ''}}>field</option>--}}
{{--                            <option value="1" {{$field->is_admin == 1 ? 'selected' : ''}}>Admin</option>--}}

{{--                        </select>--}}
{{--                        @if ($errors->has('role'))--}}
{{--                            <span class="invalid-feedback" role="alert">{{ $errors->first('role') }}</span>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}

            </div>
        </div><!--card-->

        <div class="row pb-5 mt-5">
            <div class="col">
                <a href="{{ route('fields.index') }}" class="btn btn-default btn-flat btn-gray">@lang('Back')</a>

                <button type="submit" class="btn btn-info btn-flat btn-green ml-2">{{ __('Update') }}</button>
            </div><!--col-->
        </div><!--row-->
    </form>
@endsection



