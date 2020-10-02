@if (Session::has('success'))
    <div class="alert alert-success fade in alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check" aria-hidden="true"></i>@lang('messages.success')</h4>
        {{ Session::get('success') }}
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger fade in alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban" aria-hidden="true"></i>@lang('messages.error')</h4>
        {{ Session::get('error') }}
    </div>
@endif

@if (Session::has('warning'))
    <div class="alert alert-warning fade in alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-warning" aria-hidden="true"></i>@lang('messages.warning')</h4>
        {{ Session::get('warning') }}
    </div>
@endif

@if (Session::has('info'))
    <div class="alert alert-info fade in alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-info" aria-hidden="true"></i>@lang('messages.info')</h4>
        {{ Session::get('info') }}
    </div>
@endif

@if ($errors->any() && count($errors->all()) > 0)
    <div class="alert alert-danger fade in alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-ban" aria-hidden="true"></i>@lang('messages.info')</h4>
        <p>@lang('messages.check_fields')</p>
        @foreach($errors->all() as $error)
            <span class="text">{{ $error }}</span><br />
        @endforeach
    </div>
@endif