@extends('frontend.layouts.app')

{{-- SEO Related Data --}}
@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.change_password'))

{{-- In page title --}}
@section('page_title', __('labels.backend.access.users.management'))
@section('page_subtitle', __('labels.backend.access.users.change_password'))

@section('content')
<form method="POST" action="{{ route('admin.users.change-password.post', $user) }}">
	@csrf
  @method('PATCH')

	<div class="card card-primary card-outline">
	    <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="small text-muted">
                        @lang('labels.backend.access.users.change_password_for', ['user' => $user->name])
                    </div>
                </div><!--col-->
            </div><!--row-->

            <hr />

            <fieldset class="fieldset">
               <label for="password" class="control-label">@lang('user.password')*</label>
               <div class="input-group mb-3">
                  <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="@lang('user.password')" required autocomplete="new-password">
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

               <label for="password_confirmation" class="control-label">@lang('user.password_confirmation')*</label>
               <div class="input-group mb-3">
                  <input type="password" id="password_confirmation" name="password_confirmation" class="form-control  @error('password_confirmation') is-invalid @enderror" placeholder="@lang('user.password_confirmation')" required autocomplete="new-password">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                  @error('password_confirmation')
                     <span class="invalid-feedback" role="alert"> {{ $message }} </span>
                  @enderror
               </div>
            </fieldset>

	    </div><!--card-body-->

	    <div class="card-footer clearfix">
	        <div class="row">
                <div class="col">
                	<a href="{{ route('admin.users.index') }}" class="btn btn-default">@lang('messages.cancel')</a>
                </div><!--col-->

                <div class="col text-right">
                	<button type="submit" class="btn btn-primary">{{ __('messages.update') }}</button>
                </div><!--col-->
            </div><!--row-->
	    </div><!--card-footer-->
	</div><!--card-->
</form>
@endsection
