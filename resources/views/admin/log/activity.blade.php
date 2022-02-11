@extends('faturhelper::layouts/admin/main')

@section('title', 'Log Aktivitas')

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Log Aktivitas</h1>
</div>
<div class="row">
    <div class="col-12">
		<div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-hover table-bordered" id="datatable">
                        <thead class="bg-light">
                            <tr>
                                <th width="80">Waktu</th>
                                <th width="150">Pengguna</th>
                                <th>URL</th>
                                <th width="70">Method</th>
                                <th width="80">IP Address</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

<script type="text/javascript">
    // DataTable
    Spandiv.DataTable("#datatable", {
        serverSide: true,
        orderAll: true,
		pageLength: 50,
        url: Spandiv.URL("{{ route('admin.log.activity') }}"),
        columns: [
            {data: 'datetime', name: 'datetime'},
            {data: 'user', name: 'user'},
            {data: 'url', name: 'url'},
            {data: 'method', name: 'method'},
            {data: 'ip', name: 'ip'}
        ]
    });

    // Button Delete
    Spandiv.ButtonDelete(".btn-delete", ".form-delete");
</script>

@endsection