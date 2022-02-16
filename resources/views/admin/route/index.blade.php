@extends('faturhelper::layouts/admin/main')

@section('title', 'Route')

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Route</h1>
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
                                <th>Name</th>
                                <th>URL</th>
                                <th>Method</th>
                                <th>Action</th>
                                <th>Parameter</th>
                                <th>Middleware</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($routes as $route)
                                @if($route != null)
                                    <tr>
                                        <td align="right">{{ $i }}</td>
                                        <td>{{ $route['name'] }}</td>
                                        <td>{{ $route['url'] }}</td>
                                        <td>{{ $route['method'] }}</td>
                                        <td>{{ $route['actionName'] }}</td>
                                        <td>
                                            @foreach($route['parameterName'] as $key=>$parameter)
                                                {{ $parameter }}
                                                @if($key < count($route['parameterName']) - 1)
                                                    <hr class="my-1">
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @foreach($route['middleware'] as $key=>$middleware)
                                                {{ $middleware }}
                                                @if($key < count($route['middleware']) - 1)
                                                    <hr class="my-1">
                                                @endif
                                            @endforeach
                                        </td>
                                    </tr>
                                    @php $i++; @endphp
                                @endif
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
        orderAll: true,
        pageLength: -1
    });
</script>

@endsection