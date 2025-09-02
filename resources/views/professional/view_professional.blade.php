@extends('layouts.header')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-align-top">
                <ul class="nav nav-pills flex-column flex-md-row mb-6">
                    <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-sm bx-user me-1_5"></i> Professional's Detail</a></li>
                </ul>
            </div>
            <div class="card mb-6">
                <div class="card-header" style="padding-bottom: 0px;"><h5><b>{{ strtoupper($professional['name']) }}</b></h5><hr></div>
                <div class="card-body">
                    <form id="main-form" action="https://embellishlondon.com/daily_entry/submit-profile">
                        <div class="row g-6">
                            <div class="col-md-3">
                                <label for="firstName" class="form-label">Name</label>
                                <input class="form-control" type="text" id="fname" name="fname" value="{{ $professional['name'] }}" autofocus disabled />
                            </div>
                            <div class="col-md-3">
                                <label for="firstName" class="form-label">Email</label>
                                <input class="form-control" type="text" id="fname" name="fname" value="{{ $professional['email'] }}" autofocus disabled />
                            </div>
                            <div class="col-md-3">
                                <label for="firstName" class="form-label">Mobile no.</label>
                                <input class="form-control" type="text" id="fname" name="fname" value="{{ $professional['phone'] }}" autofocus disabled />
                            </div>
                            <div class="col-md-3">
                                <label for="firstName" class="form-label">Speciality</label>
                                <input class="form-control" type="text" id="fname" name="fname" value="{{ isset($professional['speciality']['name']) ? $professional['speciality']['name'] : '' }}" autofocus disabled />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @php 
            $professional_id = $professional['id'];
        @endphp
        @foreach($slots as $slot)
            @php
                $stime = $slot['start'];
                $etime = $slot['end'];
            @endphp
            <div class="col-xxl-3 mb-6 order-0">
                <div class="card">
                    <div class="d-flex align-items-start row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary mb-3">{{ $slot['start']." To ".$slot['end'] }}</h5>
                                <p class="mb-6">
                                    <a href="javascript:;" onclick="book_now('{{ $professional_id }}','{{ $stime }}','{{ $etime }}')" class="btn btn-sm btn-primary">Book </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="modal fade" id="book_appointment_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('user.book_appointment') }}" id="bookAppointmentForm">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="professional_id" id="professional_id" />
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">Book Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close_book_appointment_modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-6">
                            <label for="nameWithTitle" class="form-label">Date*</label>
                            <input type="date" id="date" name="date" min="<?php echo date('Y-m-d'); ?>" class="form-control" />
                        </div>
                        <div class="col col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-6">
                            <label for="nameWithTitle" class="form-label">Start Time</label>
                            <input type="text" id="stime" name="stime" class="form-control" readonly="true" />
                        </div>
                        <div class="col col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-6">
                            <label for="nameWithTitle" class="form-label">End Time</label>
                            <input type="text" id="etime" name="etime" class="form-control" readonly="true" />
                        </div>
                        <div class="col col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-6">
                            <label for="nameWithTitle" class="form-label">Comment</label>
                            <textarea class="form-control" name="note" id="note" placeholder="Enter comment here..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Book</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    var page_title = "Professionals";
</script>
@endsection