@extends('layouts.header')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-xxl-3 mb-6 order-0">
            <label>Speciality :</label>
            <select class="form-control" id="speciality_id" onchange="load_data()">
                <option value="">Choose speciality</option>
                @if($_specialities)
                    @foreach($_specialities as $speciality)        
                        <option value="{{ $speciality['id'] }}">{{ $speciality['name'] }}</option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="row" id="loaddata">
        
    </div>
</div>
<script>
    var page_title = "Professionals";
    $(document).ready(function(){
        load_data();
    });
    function load_data()
    {
        $.ajax({
            url: "{{ route('user.load_professionals') }}",
            type: "GET",
            data: {
                speciality_id: $("#speciality_id").val()
            },
            success:function(response){
                if(response.status == 200) {
                    $("#loaddata").html(response.html);
                } else {
                    show_toast(response.message);
                }
            }
        });
    }
</script>
@endsection