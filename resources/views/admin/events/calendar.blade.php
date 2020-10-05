@extends('frontend.layouts.app')
@push('afterStylesheets')
    <style>

    </style>
@endpush
@section('cssTopMiddle')
    <link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}" type="text/css">
@endsection

{{-- SEO Related Data --}}
@section('title', config('app.name') . ' | ' . __('labels.backend.access.users.management'))

{{-- In page title --}}
{{-- @section('page_title', __('labels.backend.access.users.management')) --}}

@section('content')
    <div class="row">
        <div class="col-sm-5">
            <h4 class="card-title mb-0"> Events </h4>
        </div><!--col-->
    </div><!--row-->

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <form action="{{ route('events.calendar') }}" method="GET">
                        Venue:
                        <select name="field_id" id="field_id">
{{--                            <option value="">-- all fields --</option>--}}
                            @foreach($fields as $field)
                                <option value="{{ $field->id }}"
                                        @if (request('field_id') == $field->id) selected @endif>{{ $field->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                    </form>
                    <link rel='stylesheet'
                          href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css'/>
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>

    <div id="calendarModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="modalTitle" class="modal-title">Free Events</h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span
                            class="sr-only">close</span></button>
                </div>
                <div id="modalBody" class="modal-body">
                    <select class="form-control events" name="events" id="events" required="required">

                    </select><br>
                    @if (auth()->user()->isAdmin())
                        Select User:
                        <select class="form-control" name="user" id="user">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name}}</option>
                            @endforeach
                        </select>
                    @endif
                </div>
                <input type="hidden" id="date" name="date">
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-close">Close</button>
                    <button type="submit" class="btn btn-green" id="modal-submit">Save</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scriptBottomMiddle')
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
@endsection

@push('afterJsScripts')
    <script>
        $(document).ready(function () {
            // page is now ready, initialize the calendar...
            events = {!! json_encode($events) !!};

            $('#calendar').fullCalendar({
                events: events,

                // eventClick: function (calEvent, jsEvent, view) {
                //     alert('po')
                // },


                dayClick: function (date, jsEvent, view) {
                    $('#calendarModal').modal();
                    var field_id = $("#field_id").find(':selected').val();
                    $('#date').val((date).format('YYYY-MM-DD'));
                    $.ajax({
                        type: 'POST',
                        url: '/events/getFreeEvents',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            method: 'POST',
                            date: (date).format('YYYY-MM-DD HH:mm:00'),
                            field_id: field_id
                        },
                        success: function (response) {
                            var dropdown = Array();
                            dropdown.push('<option disabled selected></option>');
                            $.each(response, function (key, value) {
                                dropdown.push('<option value="' + value.start_time + '">' + value.start_time + ' - ' + value.end_time + '</option>');
                            });
                            $('.events').html(dropdown.join(''));
                        }
                    });
                }
            })
        });

        $("#modal-submit").on('click', function (event) {
            var $eventSelectModal =  $('.exampleModal');
            event.preventDefault();

            var field_id = $("#field_id").find(':selected').val();
            var user = $("#user").find(':selected').val();
            var hour = $(".events").find(':selected').val();
            var date = $("#date").val();
            $.ajax({
                type: 'POST',
                url: '/events',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    method: 'POST',
                    hour: hour,
                    date: date,
                    field_id: field_id,
                    user: user
                },

                beforeSend: function() {
                    $eventSelectModal.find('.modal-content').mask('Waiting...');
                },
                success: function(data, textStatus, xhr) {
                    if (textStatus === "success") {
                        location.reload();
                    }
                },
                complete: function(xhr, textStatus) {
                    $eventSelectModal.find('.modal-content').unmask();
                },
                error: function (data) {
                    alert("You need to fill in all the fields");
                }

            });

            $eventSelectModal.modal('hide');

            return true;
        });

        $('#calendarModal').on('hidden.bs.modal', function () {
            $('#events').html('');
        })


    </script>
@endpush
