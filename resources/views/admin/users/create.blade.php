@extends('frontend.layouts.app')

{{-- SEO Related Data --}}
@section('title', __('Create User') . ' | ' . __('Create User'))

{{-- In page title --}}
@section('page_title', __('Create User'))


@section('content')
<form method="POST" action="{{ route('users.store') }}">
	@csrf
	<div class="card">
	    <div class="card-body">

            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="card-title font-weight-bold">{{ __('User Data') }}</h3>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-xl-3 mb-2 {{ $errors->has('name') ? ' has-error' : '' }}">
                    <input type="text" id="name"
                           class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                           name="name"
                           placeholder="{{ __('Name') }}"
                           value="{{ old('name') }}" autocomplete="name" required autofocus>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback"
                              role="alert">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="col-xl-3  mb-2 {{ $errors->has('surname') ? ' has-error' : '' }}">
                    <input type="text" id="surname"
                           class="form-control {{ $errors->has('surname') ? ' is-invalid' : '' }}"
                           name="surname"
                           placeholder="{{ __('Surname') }}"
                           autocomplete="surname"
                           value="{{ old('surname') }}" required>
                    @if ($errors->has('surname'))
                        <span class="invalid-feedback"
                              role="alert">{{ $errors->first('surname') }}</span>
                    @endif
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-xl-6 mb-2 {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" id="email"
                           class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                           placeholder="ex: example@me.com"
                           autocomplete="email"
                           name="email"
                           value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">{{ $errors->first('email') }}</span>
                    @endif
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-xl-6 mb-2 {{ $errors->has('role') ? ' has-error' : '' }}">
                    <select name="role" class="form-control {{ $errors->has('role') ? ' is-invalid' : '' }}">
                        <option value="0" selected>User</option>
                        <option value="1" >Admin</option>

                    </select>
                    @if ($errors->has('role'))
                        <span class="invalid-feedback" role="alert">{{ $errors->first('role') }}</span>
                    @endif
                </div>
            </div>
        </div><!--card-footer-->
	</div><!--card-->

    <div class="row pb-5 mt-5 ">
        <div class="col">
            <a href="{{ route('users.index') }}" class="btn btn-default btn-flat btn-gray">@lang('Back')</a>
            <button type="submit" class="btn btn-info btn-flat btn-green ml-2">{{ __('Save') }}</button>
        </div><!--col-->
    </div><!--row-->
</form>
@endsection
