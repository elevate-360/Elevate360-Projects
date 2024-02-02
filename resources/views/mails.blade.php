@extends('layout')

@section('activeMail')
    active
@endsection

@section('pageTitle')
    Super Admin Details
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>User Login Log</strong></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive" style="height: 693px;">
                    <table class="table table-hover table-bordered table-stripped table-head-fixed text-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User Name</th>
                                <th>IP Address</th>
                                <th>Operating System</th>
                                <th>Login Count</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userLogin as $item)
                                <tr>
                                    <td>{{ ++$usercount }}</td>
                                    <td>{{ $item->userFirstName . " " . $item->userLastName }}</td>
                                    <td><span class="badge badge-info">{{ $item->ipAddress }}</span></td>
                                    <td>{{ $item->operatingSystem }}</td>
                                    <td><span class="badge badge-success">{{ $item->loginCount }}</span></td>
                                    <td><span
                                            class="badge bg-warning">{{ date('d M, Y h:i a', strtotime($item->loginDate . " " . $item->loginTime) + ((5 * 60 * 60) + (30 * 60))) }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>Mails Sent</strong></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 693px;">
                    <table class="table table-hover table-head-fixed text-nowrap" id="">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email Address</th>
                                <th>Subject</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr data-widget="expandable-table" aria-expanded="false">
                                    <td>{{ ++$count }}</td>
                                    <td>{{ $item['mailToName'] }}</td>
                                    <td>
                                        @php
                                            $emails = json_decode($item['mailTo'], true);
                                        @endphp
                                        @if (is_array($emails))
                                            @foreach ($emails as $value)
                                                <span class="badge badge-info">{{ $value }}</span><br>
                                            @endforeach
                                        @else
                                            <span class="badge badge-info">{{ $emails }}</span><br>
                                        @endif
                                    </td>
                                    <td>{{ $item['mailSubject'] }}</td>
                                    <td><span
                                            class="badge bg-success">{{ date('d M, Y h:i a', strtotime($item['mailDate']) + ((5 * 60 * 60) + (30 * 60))) }}</span>
                                    </td>
                                </tr>
                                <tr class="expandable-body d-none">
                                    <td colspan="5">
                                        <div>
                                            @php
                                                $customData = [
                                                    'subject' => $item['mailSubject'],
                                                    'message' => $item['mailContent'],
                                                    'name' => $item['mailToName'],
                                                    'date' => $item['mailDate'],
                                                ];
                                            @endphp
                                            <iframe src="/mail?data={{ urlencode(json_encode($customData)) }}"
                                                frameborder="0" width="100%" height="600vh"></iframe>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('tblScript')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection
