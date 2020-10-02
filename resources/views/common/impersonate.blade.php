@impersonating
<div class="alert alert-warning logged-in-as" style="border-radius: 0; margin: 0;">
    {{ __('You are currently logged in as') }} <strong>{{ auth()->user()->name }}</strong>. <a href="{{ route('impersonate.leave') }}">{{ __('Return to your account') }}</a>.
</div><!--alert alert-warning logged-in-as-->
@endImpersonating
