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
                <div class="card-body table-responsive">
                    <table id="example1" class="table table-hover table-bordered table-striped table-head-fixed">
                        <thead>
                            <tr>
                                <th>Attempt No.</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Project Amount</th>
                                <th>Platform</th>
                                <th>Status</th>
                                <th>User</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ ++$count }}</td>
                                    <td>{{ $item->atpProjectName }}</td>
                                    <td>{{ $item->atpDescription }}</td>
                                    <td>{{ $item->atpProjectAmount }}</td>
                                    <td>
                                        @switch($item->atpStatus)
                                            @case('1')
                                                <span class="badge badge-info">Freelancer</span>
                                            @break

                                            @case('2')
                                                <span class="badge badge-success">Upwork</span>
                                            @break

                                            @case('3')
                                                <span class="badge badge-primary">Linkedin</span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>
                                        @switch($item->atpStatus)
                                            @case('0')
                                                <span class="badge badge-danger">Decliened</span>
                                            @break

                                            @case('1')
                                                <span class="badge badge-warning">Pending</span>
                                            @break

                                            @case('2')
                                                <span class="badge badge-success">Accepted</span>
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
                                                class="description">{{ date('d M, Y - h:m a', (strtotime($item->atpDate)) + ((5 * 60 * 60) + (30 * 60))) }}</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Attempt No.</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Project Amount</th>
                                <th>Platform</th>
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

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>Summary</strong></h3>
                </div>
                <div class="card-body table-responsive p0">
                    <table class="table table-hover table-bordered table-striped table-head-fixed text-nowrap" id="example2">
                        <tbody>
                            <tr>
                                <td><strong>#</strong></td>
                                <td><strong>User</strong></td>
                                <td><strong>Pending Projects</strong></td>
                                <td><strong>Accepted Projects</strong></td>
                                <td><strong>Declined Projects</strong></td>
                            </tr>
                            @foreach ($idvData as $item)
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
                                                        <span class="badge bg-success">Business Developent Executive</span>
                                                    @break
                                                @endswitch
                                            </span>
                                        </div>
                                    </td>
                                    <td>{{ $item->pending }}</td>
                                    <td>{{ $item->accepted }}</td>
                                    <td>{{ $item->declined }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
