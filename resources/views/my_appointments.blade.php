@extends('layouts.header')
@section('content')
<link rel="stylesheet" href="https://supermetplast.com/public/assets/css/datatable/datatables.bootstrap5.css">
<link rel="stylesheet" href="https://supermetplast.com/public/assets/css/datatable/responsive.bootstrap5.css">
<link rel="stylesheet" href="https://supermetplast.com/public/assets/css/datatable/datatables.checkboxes.css">
<link rel="stylesheet" href="https://supermetplast.com/public/assets/css/datatable/buttons.bootstrap5.css">
<link rel="stylesheet" href="https://supermetplast.com/public/assets/css/datatable/rowgroup.bootstrap5.css">
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <h5 class="card-header">My Appointments</h5>
        <div class="container">
            <div class="table-responsive">
                <table class="table table-default table-bordered" id="tblList">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th width="45%">Professional Name</th>
                            <th width="10%">Date</th>
                            <th width="15%">Slot</th>
                            <th width="10%">Status</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($appointments)
                            @foreach($appointments as $key => $val)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ isset($val["professional"]["name"]) ? $val["professional"]["name"] : '' }}</td>
                                    <td>{{ date('d M, Y',strtotime($val['date'])) }}</td>
                                    <td><small>{{ date('h:i A',strtotime($val['stime'])) }} To {{ date('h:i A',strtotime($val['etime'])) }}</small></td>
                                    <td valign="middle" align="center">
                                        @switch($val['status'])
                                            @case('pending')
                                                <p class="badge bg-warning mt-4">PENDING</p>
                                                @break

                                            @case('confirmed')
                                                <p class="badge bg-success mt-4">CONFIRMED</p>
                                                @break

                                            @case('completed')
                                                <p class="badge bg-success mt-4">COMPLETED</p>
                                                @break

                                            @default
                                                <p class="badge bg-danger mt-4">CANCELLED</p>
                                        @endswitch
                                    </td>
                                    <td>
                                        @if($val['status'] == 'pending')
                                            <a class="btn btn-sm btn-danger text-white" href="{{ route('user.cancel_appointment', ['id' => $val['id']]) }}" onclick="return confirm('Are you sure to cancel this appointment?')">Cancel</a>
                                        @elseif(in_array($val["status"],["pending","confirmed","cancelled"]))
                                            <a class="btn btn-sm btn-danger text-white" href="{{ route('user.complete_appointment', ['id' => $val['id']]) }}" onclick="return confirm('Are you sure?')">Mark as Completed</a>
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
            </div><br>
        </div>
    </div>
</div>
<script src="https://supermetplast.com/public/assets/css/datatable/datatables-bootstrap5.js"></script>
<script>
    var page_title = "My Appointments";
    $(document).ready(function() {
        $('#tblList').DataTable();
    });
</script>
@endsection