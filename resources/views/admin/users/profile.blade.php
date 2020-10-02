@extends('frontend.layouts.app')

@push('afterStylesheets')
    <style>

        .head-title{
            font-size: 22px;
            line-height: 27px;
            font-weight: 400;
        }

        .mandatory_fields{
            font-style: italic;
            font-size: 14px;
            line-height: 17px;
        }
    </style>
@endpush
{{-- SEO Related Data --}}
@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.edit'))

@section('content')

<h4 class="font-weight-bold">User Edit</h4>

<form method="POST" action="{{ route('profile.update', $user) }}">
	@csrf
    @method('PUT')
	<div class="card">
        <div class="card-header">
            <h3 class="card-title font-weight-bold head-title">User Data</h3>
        </div>
	    <div class="card-body">
            <div class="row mb-2">
                <div class="col-xl-3 mb-2 {{ $errors->has('name') ? ' has-error' : '' }}">
                    <input type="text" id="name"
                           class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"
                           name="name"
                           value="{{ old('name', $user->name) }}" required autofocus>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback"
                              role="alert">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="col-xl-3  mb-2 {{ $errors->has('surname') ? ' has-error' : '' }}">
                    <input type="text" id="surname"
                           class="form-control {{ $errors->has('surname') ? ' is-invalid' : '' }}"
                           name="surname"
                           value="{{ old('surname', $user->surname) }}" required>
                    @if ($errors->has('surname'))
                        <span class="invalid-feedback"
                              role="alert">{{ $errors->first('surname') }}</span>
                    @endif
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-xl-6  mb-2  {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input type="email" id="email"
                           class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                           placeholder="ex: john@doe.com" name="email"
                           value="{{ old('email', $user->email) }}" required>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">{{ $errors->first('email') }}</span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col text-left">
                    <button type="submit" class="btn btn-info btn-green btn-flat">Save</button>
                </div>
            </div>
	    </div>
	</div><!--card-->
</form>

<form method="POST" action="{{ route('profile.update.password', $user) }}">
    @csrf
    @method('PUT')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title font-weight-bold head-title">Change Password</h3>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-xl-6">
                    <div class="form-group mb-3 {{ $errors->has('current_password') ? 'has-error' : ''}}">
                        <input id="current_password" type="password"
                               class="form-control {{ $errors->has('current_password') ? ' is-invalid' : '' }}"
                               name="current_password"
                               placeholder="old password">
                        @if ($errors->has('current_password'))
                            {!! $errors->first('current_password', '<p class="help-block invalid-feedback" role="alert">:message</p>') !!}
                        @endif
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" name="password" id="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="new password" autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="form-control  @error('password_confirmation') is-invalid @enderror"
                               placeholder="password confirmation"
                               autocomplete="new-password">
                        @error('password_confirmation')
                        <span class="invalid-feedback"
                              role="alert"> <strong>{{ $message }}</strong> </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-left">
                    <button type="submit" class="btn btn-info btn-green btn-flat">Save</button>
                </div>
            </div>
        </div>
    </div><!--card-->
</form>
@endsection
