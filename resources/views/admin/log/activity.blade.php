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
                                <th width="20"></th>
                                <th width="150">Pengguna</th>
                                <th>URL</th>
                                <th width="70">Method</th>
                                <th width="100">IP Address</th>
                                <th width="100">Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($logs as $key=>$log)
                            <?php $user = \Ajifatur\FaturHelper\Models\User::find($log[1]['user_id']); ?>
                            <tr>
                                <td align="right">{{ ($key+1) }}</td>
                                <td>
                                    @if($user)
                                        <a href="{{ \Route::has('admin.user.detail') ? route('admin.user.detail', ['id' => $user->id]) : '#' }}">{{ $user->name }}</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ $log[1]['url'] }}" target="_blank" style="word-break: break-all;">
                                        {{ strlen($log[1]['url']) > 100 ? substr($log[1]['url'],0,100).'...' : $log[1]['url'] }}
                                    </a>
                                </td>
                                <td>{{ $log[1]['method'] }}</td>
                                <td>{{ $log[1]['ip'] }}</td>
                                <td>
                                    <span class="d-none">{{ $log[0] }}</span>
                                    {{ date('d/m/Y', strtotime($log[0])) }}
                                    <br>
                                    <small>{{ date('H:i:s', strtotime($log[0])) }}</small>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
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
        orderAll: true
    });

    // Button Delete
    Spandiv.ButtonDelete(".btn-delete", ".form-delete");
</script>

@endsection