@extends('frontend.layouts.app')

{{-- SEO Related Data --}}

{{-- In page title --}}
@section('page_title', __('Users Management'))
@section('page_subtitle', __('Update User'))


@section('content')
<form method="POST" action="{{ route('users.update', $user) }}">
	@csrf
    @method('PUT')

	<div class="card">
	    <div class="card-body">

            <div class="form-group row mb-4">
                <div class="col-12">
                    <h3 class="card-title font-weight-bold">{{ __('User Data') }}</h3>
                </div>
            </div>

            <div class="form-group row mb-2">
                <div class="col-xl-3 col-lg-4 mb-2 {{ $errors->has('name') ? ' has-error' : '' }}">
                    <input id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus placeholder="{{ __('Name') }}" maxlength="64">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col-xl-3 col-lg-4 mb-2 {{ $errors->has('surname') ? ' has-error' : '' }}">
                    <input id="surname" type="text" class="form-control {{ $errors->has('surname') ? 'is-invalid' : ''}}" name="surname" value="{{ old('surname', $user->surname) }}" required autocomplete="surname" autofocus placeholder="{{ __('Surname') }}" maxlength="64">
                    @if ($errors->has('surname'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('surname') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-2">
                <div class="col-xl-6 col-lg-8 mb-2 {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email" placeholder="{{ __('E-Mail Address') }}">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-xl-6 mb-2 {{ $errors->has('role') ? ' has-error' : '' }}">
                    <select name="role" class="form-control {{ $errors->has('role') ? ' is-invalid' : '' }}">
                        <option value="0" {{$user->is_admin == 0 ? 'selected' : ''}}>User</option>
                        <option value="1" {{$user->is_admin == 1 ? 'selected' : ''}}>Admin</option>

                    </select>
                    @if ($errors->has('role'))
                        <span class="invalid-feedback" role="alert">{{ $errors->first('role') }}</span>
                    @endif
                </div>
            </div>

        </div>
	</div><!--card-->

    <div class="row pb-5 mt-5">
        <div class="col">
            <a href="{{ route('users.index') }}" class="btn btn-default btn-flat btn-gray">@lang('Back')</a>

            <button type="submit" class="btn btn-info btn-flat btn-green ml-2">{{ __('Update') }}</button>
        </div><!--col-->
    </div><!--row-->
</form>
@endsection



