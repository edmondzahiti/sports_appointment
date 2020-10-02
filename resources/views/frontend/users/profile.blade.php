@extends('frontend.layouts.app')
@push('afterStylesheets')
    <style>
        .new-button {
            width: 130px;
            height: 35px;
            border-radius: 2px;
        }
    </style>
@endpush
@section('content')
    <div class="row pl-4">
        <div class="col-xl-12 col-md-9">
            <h4 class="font-weight-bold">{{ __('labels.backend.access.users.edit')}}</h4>
            <div class="card card-outline">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">{{ __('auth.data') }}</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PUT')
                        <fieldset class="fieldset">
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
                                <div class="col-xl-3 mb-2 {{ $errors->has('surname') ? ' has-error' : '' }}">
                                    <input type="text" id="surname"
                                           class="form-control {{ $errors->has('surname') ? ' is-invalid' : '' }}"
                                           name="surname"
                                           value="{{ old('surname', $user->surname) }}" required autofocus>
                                    @if ($errors->has('surname'))
                                        <span class="invalid-feedback"
                                              role="alert">{{ $errors->first('surname') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-xl-3  {{ $errors->has('email') ? ' has-error' : '' }}">
                                    <input type="email" id="email"
                                           class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           placeholder="ex: john@doe.com" name="email"
                                           value="{{ old('email', $user->email) }}" required>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-xl-3 {{ $errors->has('language') ? ' has-error' : '' }}">
                                    <label for="language">{{ __('Language') }}</label>
                                    <select id="language" name="language" class="form-control {{ $errors->has('language') ? ' is-invalid' : '' }}">
                                        <option value="" disabled selected hidden>{{ __('Select') }}</option>
                                        @include('common._partials.languages', [
                                            'default_language' => old('language', $user->language)
                                        ])
                                     </select>
                                    @if ($errors->has('language'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('language') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </fieldset>

                        <button type="submit" class="btn btn-info new-button">@lang('messages.save')</button>
                    </form>
                </div>
            </div>
            <div class="card card-outline">
                <div class="card-header">
                    <h3 class="card-title font-weight-bold">{{ __('labels.frontend.user.passwords.change') }}</h3>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('profile.update.password') }}">
                        @csrf
                        @method('PUT')
                        <fieldset class="fieldset">
                            <div class="row mb-4">
                                <div class="col-md-4 {{ $errors->has('current_password') ? ' has-error' : '' }}">
                                    <div
                                        class="input-group mb-3 {{ $errors->has('current_password') ? 'has-error' : ''}}">
                                        <input id="current_password" type="password"
                                               class="form-control {{ $errors->has('current_password') ? ' is-invalid' : '' }}"
                                               name="current_password" autofocus
                                               placeholder="{{ __('user.old_password') }}">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                        @if ($errors->has('current_password'))
                                            {!! $errors->first('current_password', '<p class="help-block invalid-feedback" role="alert">:message</p>') !!}
                                        @endif
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="password" name="password" id="password"
                                               class="form-control @error('password') is-invalid @enderror"
                                               placeholder="{{ __('user.password') }}" autocomplete="new-password">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="input-group mb-3">
                                        <input type="password" id="password_confirmation" name="password_confirmation"
                                               class="form-control  @error('password_confirmation') is-invalid @enderror"
                                               placeholder="{{ __('user.password_confirmation') }}"
                                               autocomplete="new-password">
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
                                        @error('password_confirmation')
                                        <span class="invalid-feedback"
                                              role="alert"> <strong>{{ $message }}</strong> </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <button type="submit" class="btn btn-info new-button">@lang('messages.save')</button>
                    </form>
                </div>
            </div>
        </div>
@endsection
