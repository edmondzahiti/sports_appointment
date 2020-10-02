@extends('frontend.layouts.app')

{{-- SEO Related Data --}}

{{-- In page title --}}
@section('page_title', __('Events Management'))
@section('page_subtitle', __('Update Event'))


@section('content')
    <form method="POST" action="{{ route('events.update', $event) }}">
        @csrf
        @method('PUT')

        <div class="card">
            <div class="card-body">

                <div class="form-group row mb-4">
                    <div class="col-12">
                        <h3 class="card-title font-weight-bold">{{ __('Event Data') }}</h3>
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <div class="col-xl-3 col-lg-4 mb-2 {{ $errors->has('name') ? ' has-error' : '' }}">
                        <input id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : ''}}"
                               name="name" value="{{ old('name', $event->name) }}" required autocomplete="name" disabled
                               autofocus placeholder="{{ __('Name') }}" maxlength="64">
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <h5>Field</h5>
                <div class="form-group row mb-2">
                    <div class="col-xl-6 col-lg-8 mb-2 {{ $errors->has('month') ? ' has-error' : '' }}">
                        <select class="form-control field" name="field" id="field">
                            <option value="" selected disabled>Select Field</option>
                            @foreach($fields as $field)
                                <option value="{{$field->id}}"{{$field->id == $event->field_id ? 'selected' : ''}}>{{$field->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <h5>Month</h5>
                <div class="form-group row mb-2">
                    <div class="col-xl-6 col-lg-8 mb-2 {{ $errors->has('month') ? ' has-error' : '' }}">
                        <select class="form-control month" name="month" id="month">
                            <option value="" selected>Select Month</option>
                            @foreach($months as $key => $value)
                                <option value="{{$key}}">{{$value}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <h5>Day date</h5>
                <div class="form-group row mb-2">
                    <div class="col-xl-6 col-lg-8 mb-2 {{ $errors->has('day') ? ' has-error' : '' }}">
                        <select class="form-control day" name="day" id="day">
{{--                            <option value="" selected>Select Day</option>--}}
                        </select>
                    </div>
                </div>
                <h5>Time</h5>
                <div class="form-group row mb-2">
                    <div class="col-xl-6 col-lg-8 mb-2 {{ $errors->has('date') ? ' has-error' : '' }}">
                        <select class="form-control date" name="date" id="date">
{{--                            <option value="" selected>Select Time</option>--}}
                        </select>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <div class="col-xl-6 col-lg-8 mb-2 {{ $errors->has('date') ? ' has-error' : '' }}">
                        @if($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li >{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                    </div>
                </div>
            </div>
            <input name="isEditingEvent" id="isEditingEvent" type="hidden" value="{{true}}">
        </div><!--card-->

        <div class="row pb-5 mt-5">
            <div class="col">
                <a href="{{ route('events.index') }}" class="btn btn-default btn-flat btn-gray">@lang('Back')</a>
                <button type="submit" class="btn btn-info ml-2">{{ __('Update') }}</button>
                <form action="{{ route('events.destroy', ['event' => $event]) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-info btn-danger ml-2" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </div><!--col-->
        </div><!--row-->
    </form>
@endsection


@push('afterJsScripts')
    <script>
        var month = '{{$event->start_time->format('m')}}';
        var year = '{{$event->start_time->format('Y')}}';
        var day = '{{$event->start_time->format('d-m-Y')}}';
        var hour = '{{$event->start_time->format('H')}}';
        var field_id = '{{$event->field_id}}';

        var isEditingEvent = true;
        var event_id = '{{$event->id}}';
        $('.month option[value='+month+'-'+year+']').prop('selected', true);


        $.ajax({
            type: 'GET',
            url: '/events/dates_month/' + month + '/' + year,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                method: 'GET',
            },
            success: function (response) {
                var dropdown = Array();
                dropdown.push('<option disabled selected hidden>Select Day</option>');
                $.each(response, function (key, value) {
                    dropdown.push('<option value="'+value+'">' + value + '</option>');
                });
                $('.day').html(dropdown.join(''));

                $('.day option[value='+day+']').prop('selected', true);
            },
        });

        $.ajax({
            type: 'POST',
            url: '/events/getFreeEvents',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                method: 'POST',
                date: day,
                field_id: field_id,
                isEditingEvent: isEditingEvent,
                event_id: event_id,

            },
            success: function (response) {
                var dropdown = Array();
                dropdown.push('<option disabled selected>Select Time</option>');
                $.each(response, function (key, value) {
                    dropdown.push('<option value="' + value.start_time + '">' + value.start_time + ' - ' + value.end_time + '</option>');
                });
                $('.date').html(dropdown.join(''));
                $('.date option[value='+hour+']').prop('selected', true);
            }
        });

        //On change of attributes
        $(".field").on('change', function () {
            $(".month" ).val('');
            $(".day" ).prop( "disabled", true );
            $(".day" ).val('');
            $(".date" ).prop( "disabled", true );
            $(".date" ).val('');

        });

        $(".month").on('change', function () {

            $( ".day" ).prop( "disabled", false );
            $( ".date" ).prop( "disabled", true );
            $( ".date" ).val('');

            var day = this.value.split("-");

            $.ajax({
                type: 'GET',
                url: '/events/dates_month/' + day[0] + '/' + day[1],
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    method: 'GET',
                },
                success: function (response) {
                    var dropdown = Array();
                    dropdown.push('<option disabled selected hidden>Select Day</option>');
                    $.each(response, function (key, value) {
                        dropdown.push('<option value="'+value+'">' + value + '</option>');
                    });
                    $('.day').html(dropdown.join(''));

                },
            });
        });

        $(".day").on('change', function () {

            $( ".date" ).prop( "disabled", false );
            var date = this.value;
            var field_id = $(".field").val();

            $.ajax({
                type: 'POST',
                url: '/events/getFreeEvents',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    method: 'POST',
                    date: date,
                    field_id: field_id,
                    isEditingEvent: isEditingEvent,
                    event_id: event_id,
                },
                success: function (response) {
                    var dropdown = Array();
                    dropdown.push('<option disabled selected>Select Time</option>');
                    $.each(response, function (key, value) {
                        dropdown.push('<option value="' + value.start_time + '">' + value.start_time + ' - ' + value.end_time + '</option>');
                    });
                    $('.date').html(dropdown.join(''));
                }
            });

        });
    </script>
@endpush

