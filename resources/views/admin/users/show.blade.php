@extends('frontend.layouts.app')

{{-- SEO Related Data --}}
@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.view'))

{{-- In page title --}}
@section('page_title', trans_choice('messages.user', 1))

@section('content')
	<div class="card card-primary card-outline">
	    <div class="card-body">
	        <div class="row">
	            <div class="col-sm-5">
	                <h4 class="card-title mb-0">
	                    @lang('labels.backend.access.users.management')
	                    <small class="text-muted">@lang('labels.backend.access.users.view')</small>
	                </h4>
	            </div><!--col-->
	        </div><!--row-->

	        <div class="row mt-4 mb-4">
	            <div class="col">
	                <ul class="nav nav-tabs" role="tablist">
	                    <li class="nav-item">
	                        <a class="nav-link active" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-expanded="true"><i class="fas fa-user"></i> @lang('labels.backend.access.users.tabs.titles.overview')</a>
	                    </li>
	                </ul>

	                <div class="tab-content">
	                    <div class="tab-pane active" id="overview" role="tabpanel" aria-expanded="true">
	                        @include('admin.users.includes.overview', ['user' => $user])
	                    </div><!--tab-->
	                </div><!--tab-content-->
	            </div><!--col-->
	        </div><!--row-->
	    </div><!--card-body-->

	    <div class="card-footer">
	        <div class="row">
	            <div class="col">
	                <small class="float-right text-muted">
	                    <strong>@lang('labels.backend.access.users.tabs.content.overview.created_at'):</strong> {{ convertToLocal($user->created_at) }} ({{ $user->created_at->diffForHumans() }}),
	                	{{-- {{ dd($user->created_at) }} --}}
	                    <strong>@lang('labels.backend.access.users.tabs.content.overview.last_updated'):</strong> {{ convertToLocal($user->updated_at) }} ({{ $user->updated_at->diffForHumans() }})
	                    @if ($user->trashed())
	                        <strong>@lang('labels.backend.access.users.tabs.content.overview.deleted_at'):</strong> {{ convertToLocal($user->deleted_at) }} ({{ $user->deleted_at->diffForHumans() }})
	                    @endif
	                </small>
	            </div><!--col-->
	        </div><!--row-->
	    </div><!--card-footer-->
	</div><!--card-->
@endsection

@push('afterJsScripts')
<script>
	(function($){
		$(document).ready(function () {

		});
	})(jQuery);
</script>
@endpush
