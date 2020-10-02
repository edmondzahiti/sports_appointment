@extends('frontend.layouts.app')

{{-- SEO Related Data --}}
@section('title', 'Admin')
@section('title_postfix', 'Dashboard')

{{-- In page title --}}
@section('page_title', 'Dashboard')

@push('afterStylesheets')
    <style>
        .slider{
            background-color: #55BDBD;
        }
        .carousel-control-next-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='grey' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E");
        }

        .carousel-control-prev-icon {
            background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='grey' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E");
        }

        .pagingInfo{
            float: right;
            margin-right: 50px;
            font-weight: bold;
            font-size: 25px;
            margin-top: -7px;
            color: grey;
        }
        .step{
            font-weight: bold;
            font-size: 25px;
            color: grey;
        }

        .tutorial{
            font-weight: bold;
            font-size: 25px;
            color: #55BDBD;
            margin-left: 10px;
        }
    </style>
@endpush
@section('content')
    <section class="content">
        <h4 class="tutorial">About Us</h4>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <iframe width="1070" height="615" src="https://www.youtube.com/embed/BLirXR7mkDM" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <ul class="nav nav-pills dashboard-items flex-column mt-3">
                            <li class="nav-item has-treeview ">
                                <a href="" class="btn btn-success button-sizes text-uppercase text-left  nav-link">
                                        <i class="nav-icon fa fa-plus icons  mr-3" aria-hidden="true"></i>
                                        Users
                                </a>
                            </li>
                            <li class="nav-item mt-2">
                                <a href="" class="btn btn-info button-sizes text-uppercase text-left  nav-link">
                                        <i class="nav-icon fas fa-list-ol  mr-3" aria-hidden="true"></i>
                                        Appointments
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
