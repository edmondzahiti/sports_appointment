@extends('frontend.layouts.app')

@section('content')

<div class="row">
  <div class="col-md-3">
    @include('frontend.users.includes.sidebar', ['activePage' => 'change_password'])
  </div>
  <!-- /.col -->
  <div class="col-xl-7 col-md-9">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title">Update Password</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
         <form class="form-horizontal" method="POST" action="{{ route('change_password.update') }}">
           @csrf
           
           <fieldset class="fieldset">
              <label for="current_password" class="control-label">@lang('user.old_password')*</label>
              <div class="input-group mb-3 {{ $errors->has('current_password') ? 'has-error' : ''}}">
                 <input id="current_password" type="password" class="form-control {{ $errors->has('current_password') ? ' is-invalid' : '' }}" name="current_password" required autofocus placeholder="@lang('user.old_password')">
                 <div class="input-group-append">
                   <div class="input-group-text">
                     <span class="fas fa-lock"></span>
                   </div>
                 </div>
                 @if ($errors->has('current_password'))
                     {!! $errors->first('current_password', '<p class="help-block invalid-feedback" role="alert">:message</p>') !!}
                 @endif
              </div>

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

           <a href="{{ route('home') }}" class="btn btn-default">@lang('messages.cancel')</a>
          @if(auth()->user()->canChangePassword())
           <button type="submit" class="btn btn-info pull-right">@lang('messages.update')</button>
          @endif

        </form>
      </div>
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
@endsection
