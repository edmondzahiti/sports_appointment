@extends('admin.layouts.app')

@push('afterStylesheets')
    @include('log-viewer::_template.style')
@endpush

@section('page_title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <canvas id="stats-doughnut-chart" height="300" class="mb-3"></canvas>
        </div>
        <div class="col-md-6 col-lg-9">
            <div class="row">
                @foreach($percents as $level => $item)
                <div class="col-sm-6 col-md-12 col-lg-4 mb-3">
                    <div class="info-box level-{{ $level }} {{ $item['count'] === 0 ? 'empty' : '' }}">
                        <span class="info-box-icon">
                            {!! log_styler()->icon($level) !!}
                        </span>
                        <div class="info-box-content">
                            <span class="info-box-text">{{ $item['name'] }}</span>
                            <span class="info-box-number">{{ $item['count'] }} entries - {!! $item['percent'] !!} %</span>
                            <div class="progress">
                                <div class="progress-bar" style="width: {{ $item['percent'] }}%"></div>
                            </div>
                            <span class="progress-description">
                                {{ $item['percent'] }}% Increase 
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('afterJsScripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment-with-locales.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.min.js"></script>
    <script>
        Chart.defaults.global.responsive      = true;
        Chart.defaults.global.scaleFontFamily = "'Source Sans Pro'";
        Chart.defaults.global.animationEasing = "easeOutQuart";
    </script>
    <script>
        $(function() {
            new Chart(document.getElementById("stats-doughnut-chart"), {
                type: 'doughnut',
                data: {!! $chartData !!},
                options: {
                    legend: {
                        position: 'bottom'
                    }
                }
            });
        });
    </script>
@endpush
