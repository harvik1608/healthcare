@extends('layouts.header')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <h5 class="card-header">My Appointments</h5>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-default table-bordered" id="tblList">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="15%">Professional Name</th>
                            <th width="15%">Date</th>
                            <th width="15%">Slot</th>
                            <th width="10%">Status</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($appointments)
                            @foreach($appointments as $key => $val)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ date('d M, Y',strtotime($val['date'])) }}</td>
                                    <td>{{ date('h:i A',strtotime($val['stime'])) }} To {{ date('h:i A',strtotime($val['etime'])) }}</td>
                                    <td>
                                        @switch($val['status'])
                                            @case('pending')
                                                <p>Pending</p>
                                                @break

                                            @case('confirmed')
                                                <p>Confirmed</p>
                                                @break

                                            @case('completed')
                                                <p>Completed</p>
                                                @break

                                            @default
                                                <p>Cancelled</p>
                                        @endswitch
                                    </td>
                                    <td>
                                        @if($val['status'] == 'pending')
                                            <a class="btn btn-sm btn-danger text-white" href="{{ route('user.cancel_appointment', ['id' => $val['id']]) }}" onclick="confirm('Are you sure to cancel this appointment?')">Cancel</a>
                                        @elseif(in_array($val["status"],["pending","confirmed","cancelled"]))
                                            <a class="btn btn-sm btn-danger text-white" href="{{ route('user.complete_appointment', ['id' => $val['id']]) }}" onclick="confirm('Are you sure?')">Mark as Completed</a>
                                        @else 
                                            {{ "-" }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else 
                            <tr>
                                <td colspan="6">You don't book any appointment yet.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    var page_title = "My Appointments";
</script>
@endsection