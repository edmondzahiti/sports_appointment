@extends('frontend.layouts.app')

@section('content')

<div class="row">
  <div class="col-md-3">
    @include('frontend.users.includes.sidebar', ['activePage' => 'socials'])
  </div>
  <!-- /.col -->
  <div class="col-xl-7 col-md-9">
    <div class="card card-primary card-outline">
      <div class="card-header">
        <h3 class="card-title">Social Accounts</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        @foreach ($socials as $social)
            <div class="info-box">
              <span class="info-box-icon {{ $social->provider }}"><i class="fab fa-{{ $social->provider }}"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">{{ $social->provider }}</span>
                <span class="info-box-number">{{ $social->provider_id }}</span>
              </div>
              <div class="card-tools">
                <a href="javascript:;" class="btn btn-tool" title="Disconnect" onclick="if(confirm('{{ __('Are you sure you want to be remove this conneciton') }}')) { document.getElementById('disconnect_from_social_{{ $social->id }}').submit(); } event.returnValue = false; return false;">
                  <i class="fas fa-times"></i>&nbsp; Disconnect
                </a>
                <form name="disconnect_from_social_{{ $social->id }}" id="disconnect_from_social_{{ $social->id }}" class="hidden" action="{{ route('socials.disconnect', ['social' => $social]) }}" style="display:none;" method="POST">
                  @csrf
                  @method('DELETE')
                </form>
              </div>
            </div>
          {{-- {{ $social->provider }} --}}
        @endforeach
      </div>
      <div class="card-footer text-center">
        {{ $socials->links() }}
      </div>
    </div>
    <!-- /.card -->
  </div>
  <!-- /.col -->
</div>
@endsection
