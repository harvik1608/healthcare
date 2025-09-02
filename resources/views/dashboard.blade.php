@extends('layouts.header')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xxl-12 mb-6 order-0">
            <div class="card">
                <div class="d-flex align-items-start row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-3">Welcome {{ ucwords($user->name) }}! 🎉</h5>
                            <p class="mb-6">02 Sep, 2025<br>Tuesday</p>
                            <!-- <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a> -->
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-6">
                            <img src="https://embellishlondon.com/daily_entry/public/assets/img/illustrations/man-with-laptop.png" height="175" class="scaleX-n1-rtl" alt="View Badge User">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var page_title = "Dashboard";
</script>
@endsection