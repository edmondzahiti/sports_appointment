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
                <div class="col-md-8">
                    <div class="video-container">
                        <iframe src="https://www.youtube.com/embed/BLirXR7mkDM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
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
