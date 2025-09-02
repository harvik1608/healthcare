@if($professionals)
    @foreach($professionals as $professional)
        <div class="col-xxl-4 mb-6 order-0">
            <div class="card">
                <div class="d-flex align-items-start row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary mb-3"><a href="{{ route('user.professionals.show', ['id' => $professional['id']]) }}">{{ $professional['name'] }}</a></h5>
                            <p class="mb-6">{{ isset($professional['speciality']['name']) ? $professional['speciality']['name'] : '' }}</p>
                            <!-- <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a> -->
                        </div>
                    </div>
                    <div class="col-sm-5 d-flex justify-content-center text-sm-left">
                        <div class="card-body pb-0 px-0">
                            <img src="https://embellishlondon.com/daily_entry/public/assets/img/illustrations/man-with-laptop.png" height="175" class="scaleX-n1-rtl" alt="View Badge User">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif