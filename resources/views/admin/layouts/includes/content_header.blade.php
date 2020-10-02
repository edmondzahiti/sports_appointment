<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
      @hasSection('page_title')
        <h1 class="m-0 text-dark">
          @yield('page_title')
          <small class="text-muted">@yield('page_subtitle')</small>
        </h1>
      @endif
      </div><!-- /.col -->
{{--      <div class="col-sm-6">--}}
{{--        @if(Breadcrumbs::exists())--}}
{{--          {!! Breadcrumbs::render() !!}--}}
{{--        @endif--}}
{{--        --}}{{----}}
{{--        @hasSection('breadcrumb')--}}
{{--          @yield('breadcrumb')--}}
{{--        @endif--}}
{{--        --}}
{{--      </div><!-- /.col -->--}}
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
