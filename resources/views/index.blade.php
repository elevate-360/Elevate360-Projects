@extends('layout')

@section('activeDb')
    active
@endsection

@section('pageTitle')
    Dashboard
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>Transection details</strong></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Attempt No.</th>
                                <th>Title</th>
                                <th>Platform</th>
                                <th>Technology</th>
                                <th>Project Amount</th>
                                <th>Contact Type</th>
                                <th>Status</th>
                                <th>Date-time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ ++$count }}</td>
                                    <td>{{ $item->atpProjectName }}</td>
                                    <td>{{ $item->atpPlatform }}</td>
                                    <td>{{ $item->atpTechnology }}</td>
                                    <td>{{ $item->atpProjectAmount }}</td>
                                    <td>
                                        @switch($item->atpContactType)
                                            @case('0')
                                                <i class="fa fa-envelope"></i>
                                            @break

                                            @case('1')
                                                <i class="fa fa-comment"></i>
                                            @break

                                            @case('2')
                                                <i class="fa fa-phone"></i>
                                            @break

                                            @case('3')
                                                    <i class="fa fa-whatsapp"></i>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>
                                        @switch($item->atpStatus)
                                            @case('0')
                                                <span class="badge badge-danger">Decliened</span>
                                            @break

                                            @case('1')
                                                <span class="badge badge-danger">Accepted</span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="/dist/img/{{ $item->userProfile }}"
                                                alt="user image">
                                            <span class="username">
                                                <a href="">{{ $item->userFirstName }}</a>
                                            </span>
                                            <span
                                                class="description">{{ date('d M, Y - h:m a', strtotime($item->atpDate)) }}</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Attempt No.</th>
                                <th>Title</th>
                                <th>Platform</th>
                                <th>Technology</th>
                                <th>Project Amount</th>
                                <th>Contact Type</th>
                                <th>Status</th>
                                <th>User</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Final Report --}}

    {{-- <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>Final Report</strong></h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><strong>#</strong></td>
                                <td><strong>Total Amount</strong></td>
                                <td class="w-25">
                                    <center><strong>-</strong></center>
                                </td>
                                <td>
                                    <center><strong>-</strong></center>
                                </td>
                                <td><strong>{{ round($report['totalAmount'], 2) }}</strong>&nbsp&nbsp<i
                                        class="fas fa-rupee-sign"></i>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>1.</strong></td>
                                <td>Balance</td>
                                <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                            style="width: {{ ($report['balance'] * 100) / $report['totalAmount'] }}%">
                                        </div>
                                    </div>
                                </td>
                                <td><span
                                        class="badge bg-success">{{ round(($report['balance'] * 100) / $report['totalAmount'], 2) }}%</span>
                                </td>
                                <td><strong>{{ round($report['balance'], 2) }}</strong>&nbsp&nbsp<i
                                        class="fas fa-rupee-sign"></i>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>2.</strong></td>
                                <td>Spent</td>
                                <td>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-striped bg-danger" role="progressbar"
                                            style="width: {{ ($report['spent'] * 100) / $report['totalAmount'] }}%">
                                        </div>
                                    </div>
                                </td>
                                <td><span
                                        class="badge bg-danger">{{ round(($report['spent'] * 100) / $report['totalAmount'], 2) }}%</span>
                                </td>
                                <td><strong>{{ round($report['spent'], 2) }}</strong>&nbsp&nbsp<i
                                        class="fas fa-rupee-sign"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- User wise Report --}}

    {{-- <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>Detailed Report</strong></h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><strong>#</strong></td>
                                <td><strong>User</strong></td>
                                <td class="w-25"><strong>Amount Received</strong></td>
                                <td><strong>Amount Spent</strong></td>
                            </tr>
                            @foreach ($userReport as $item)
                                <tr>
                                    <td><strong>{{ ++$userCount }}</strong></td>
                                    <td>
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="/dist/img/{{ $item->userProfile }}"
                                                alt="user image">
                                            <span class="username">
                                                <a href="">{{ $item->userFirstName . ' ' . $item->userLastName }}</a>
                                            </span>
                                            <span class="description">
                                                @switch($item->userRole)
                                                    @case('0')
                                                        <span class="badge bg-info">Employee</span>
                                                    @break

                                                    @case('1')
                                                        <span class="badge bg-success">CO-Founder</span>
                                                    @break

                                                    @case('2')
                                                        <span class="badge bg-success">Company Profit</span>
                                                    @break
                                                @endswitch
                                            </span>
                                        </div>
                                    </td>
                                    <td>{{ $item->amountReceived }}</td>
                                    <td>{{ $item->amountSpent }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
