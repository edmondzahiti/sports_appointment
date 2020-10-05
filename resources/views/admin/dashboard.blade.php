@extends('frontend.layouts.app')

{{-- SEO Related Data --}}
@section('title', 'Admin')
@section('title_postfix', 'Dashboard')

{{-- In page title --}}
@section('page_title', 'Dashboard')

@push('afterStylesheets')
    <style>
        .video-container {
            overflow: hidden;
            position: relative;
            width:100%;
        }

        .video-container::after {
            padding-top: 56.25%;
            display: block;
            content: '';
        }

        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .links{
            color: white !important;
        }

        .links:hover{
            color: black !important;
        }

    </style>
@endpush
@section('content')
    <section class="content">
        <h4 class="tutorial">About Us</h4>
        <div class="container-fluid">
            <div class="row">
                @if (auth()->user()->isAdmin())
                    <div class="row p-3 col-8 mr-5">
                        <div class="col-md-4">
                            <div class="small-box bg-gradient-warning">
                                <div class="inner">
                                    <h3 class="numbers" style="color:white">
                                        {{$users}} </h3>
                                    <h4 style="color:white">Active Users</h4>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fas fa-users"></i>
                                </div>
                                <a href="{{route('users.index')}}" class="small-box-footer">
                                    All Users<i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="small-box bg-gradient-primary">
                                <div class="inner">
                                    <h3 class="numbers">{{$fields}}</h3>
                                    <h4>Active Fields</h4>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fa fa-home" aria-hidden="true"></i>
                                </div>
                                <a href="{{route('fields.index')}}" class="small-box-footer">
                                    All Fields <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="small-box bg-gradient-red">
                                <div class="inner">
                                    <h3 class="numbers">{{$events}}</h3>
                                    <h4>Active Events</h4>
                                </div>
                                <div class="icon">
                                    <i class="nav-icon fas fa-list-ol"></i>
                                </div>
                                <a href="{{route('events.index')}}" class="small-box-footer">
                                    All Events <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="col-md-8">
                        <div class="video-container">
                            <iframe src="https://www.youtube.com/embed/BLirXR7mkDM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                @endif
                @if (!auth()->user()->isAdmin())
                    <div class="col-md-3">
                        <div class="row">
                            <ul class="nav nav-pills dashboard-items flex-column mt-3">
                                    <li class="nav-item has-treeview ">
                                        <a href="{{route('users.index')}}" class="btn btn-success text-uppercase text-left  nav-link links">
                                                <i class="nav-icon fa fa-plus icons mr-3" aria-hidden="true"></i>
                                                Users
                                        </a>
                                    </li>
                                    <li class="nav-item mt-2">
                                        <a href="{{route('fields.index')}}" class="btn btn-info text-uppercase text-left  nav-link links">
                                                <i class="nav-icon fas fa-list-ol  mr-3" aria-hidden="true"></i>
                                                Fields
                                        </a>
                                    </li>
                                <li class="nav-item mt-2">
                                    <a href="{{route('events.index')}}" class="btn btn-danger text-uppercase text-left  nav-link links">
                                        <i class="nav-icon fas fa-list-ol  mr-3" aria-hidden="true"></i>
                                        All Events
                                    </a>
                                </li>
                                <li class="nav-item mt-2">
                                    <a href="{{route('events.calendar')}}" class="btn btn-dark text-uppercase text-left  nav-link links">
                                        <i class="nav-icon fas fa-list-ol  mr-3" aria-hidden="true"></i>
                                        Events Calendar
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@push('afterJsScripts')
    <script>
        var totalItems = $('.carousel-item').length;
        var currentIndex = $('div.active').index() + 1;
        $('.currentIndex').html(''+currentIndex);
        $('.totalItems').html(''+totalItems);
        $('.step').html('Step '+currentIndex);

        $('#carouselExampleControls').on('slid.bs.carousel', function() {
            currentIndex = $('div.active').index() + 1;
            $('.currentIndex').html(''+currentIndex);
            $('.totalItems').html(''+totalItems);

            $('.step').html('Step '+currentIndex);
        });

        $('#carouselExampleControls').carousel({
            interval: false,
        });

    </script>
@endpush
