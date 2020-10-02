@extends('frontend.layouts.app')

@section('content')

<div class="row">
  <div class="col-md-3">
    @include('frontend.users.includes.sidebar', ['activePage' => 'globals'])
  </div>
  <!-- /.col -->
  <div class="col-xl-7 col-md-9">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title">Global preferences</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form class="form-horizontal" method="POST" action="{{ route('globals.update') }}">
          @csrf
          @method('PUT')

          <fieldset class="fieldset">
              <label for="currency" class="control-label"> {{ trans_choice('messages.currency', 2) }} </label>
              <div class="input-group mb-3 {{ $errors->has('currency') ? 'has-error' : ''}}">
                  <select id="currency" name="currency" class="form-control {{ $errors->has('currency') ? ' is-invalid' : '' }}">
                      <option value="">{{ __('Select Currency') }}</option>
                      @include('common._partials.currencies', [
                          'default_currency' => old('currency', $user->currency)
                      ])
                  </select>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-euro-sign"></span>
                    </div>
                  </div>
                  @if ($errors->has('currency'))
                      <span class="invalid-feedback" role="alert">{{ $errors->first('currency') }}</span>
                  @endif
              </div>
              
               <label for="language" class="control-label"> {{ trans_choice('messages.language', 2) }} </label>
               <div class="input-group mb-3 {{ $errors->has('language') ? ' has-error' : '' }}">
                 <select id="language" name="language" class="form-control {{ $errors->has('language') ? ' is-invalid' : '' }}">
                     <option value="">{{ __('Select Language') }}</option>
                     @include('common._partials.languages', [
                         'default_language' => old('language', $user->language)
                     ])
                  </select>
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-language"></span>
                    </div>
                  </div>
                  @if ($errors->has('language'))
                     <span class="invalid-feedback" role="alert">{{ $errors->first('language') }}</span>
                  @endif
               </div>

               <label for="timezone" class="control-label"> {{ trans_choice('messages.timezone', 2) }} </label>
               <div class="input-group mb-3 {{ $errors->has('timezone') ? ' has-error' : '' }}">
                   <select id="timezone" name="timezone" class="form-control {{ $errors->has('timezone') ? ' is-invalid' : '' }}">
                       <option value="">{{ __('Select Timezone') }}</option>
                       @include('common._partials.timezones', [
                          'default_timezone' => old('timezone', $user->timezone)
                       ])
                   </select>
                   <div class="input-group-append">
                     <div class="input-group-text">
                       <span class="fas fa-clock"></span>
                     </div>
                   </div>
                   @if ($errors->has('timezone'))
                       <span class="invalid-feedback" role="alert">{{ $errors->first('timezone') }}</span>
                   @endif
               </div>
          </fieldset>

          <a href="{{ route('home') }}" class="btn btn-default">@lang('messages.cancel')</a>
          <button type="submit" class="btn btn-info pull-right">@lang('messages.update')</button>
        </form>
      </div>
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
@endsection
