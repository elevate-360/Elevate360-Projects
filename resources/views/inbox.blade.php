@extends('layout')

@section('activeInbox')
    active
@endsection

@section('pageTitle')
    Inbox
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><strong>Mails Recived</strong></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 693px;">
                    <table class="table table-head-fixed text-nowrap" id="">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>To</th>
                                <th>Subject</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mails as $item)
                                <tr data-widget="expandable-table" aria-expanded="false">
                                    <td>{{ ++$count }}</td>
                                    <td>{{ $item['fromName'] }}</td>
                                    <td>{{ $item['fromEmail'] }}</td>
                                    <td>{{ $item['toEmail'] }}</td>
                                    <td>{{ $item['subject'] }}</td>
                                    <td><span
                                            class="badge bg-success">{{ date("d M, Y h:i:s a", strtotime($item["date"]) + (5 * 60 * 60 + 30 * 60)) }}</span>
                                    </td>
                                </tr>
                                <tr class="expandable-body d-none">
                                    <td colspan="6">
                                        <div><iframe src="/mail/{{ urlencode(($item["id"])) }}"
                                            frameborder="0" width="100%" height="600vh"></iframe></div>
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
            $(".example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('.example2').DataTable({
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
