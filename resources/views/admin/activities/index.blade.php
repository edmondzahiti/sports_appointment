@extends('admin.layouts.app')

{{-- SEO Related Data --}}
@section('title', trans_choice('messages.activity', 2))

{{-- In page title --}}
@section('page_title', trans_choice('messages.activity', 2))

@section('content')
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                    @lang('labels.backend.activities.management')
                </h4>
            </div><!--col-->

            <div class="col-sm-7 pull-right">
                {{-- @include('admin.roles.includes.buttons') --}}
            </div><!--col-->
        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->
@endsection