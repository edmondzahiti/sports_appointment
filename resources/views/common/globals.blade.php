<script>
    var AppHelper = window.AppHelper || {};
    AppHelper.csrf = "{{ csrf_token() }}";
    AppHelper.locale = "{{ app()->getLocale() }}";
    AppHelper.fullBaseUrl = "{!! url('/') !!}";
    AppHelper.currentUrl = "{!! url()->current() !!}";
    AppHelper.assetsDirectory = "{!! asset('/') !!}";
</script>
