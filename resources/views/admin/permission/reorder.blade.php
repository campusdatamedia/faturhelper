@extends('faturhelper::layouts/admin/main')

@section('title', 'Urutkan Hak Akses')

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-2 mb-sm-0">Urutkan Hak Akses</h1>
    <a href="{{ route('admin.permission.index') }}" class="btn btn-sm btn-secondary"><i class="bi-arrow-left me-1"></i> Kembali ke Kelola Hak Akses</a>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if(count($permissions) > 0)
                <p class="fst-italic small text-muted"><i class="bi-info-circle me-1"></i> Tekan dan geser hak akses di bawah ini untuk mengurutkannya.</p>
                <div class="list-group sortable" data-url="{{ route('admin.permission.sort') }}">
                    @csrf
                    @foreach($permissions as $permission)
                        <div class="list-group-item d-sm-flex justify-content-between align-items-center p-2" data-id="{{ $permission->id }}">
                            {{ $permission->name }} <small class="text-muted">{{ $permission->code }}</small>
                        </div>
                    @endforeach
                </div>
                @else
                    <em class="text-danger">Belum ada hak akses.</em>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Toast -->
<div class="toast-container position-fixed top-0 end-0 d-none">
    <div class="toast align-items-center text-white bg-success border-0" id="toast-sort" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body"></div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

@endsection

@section('js')

<script type="text/javascript">
    // Button Delete
    Spandiv.ButtonDelete(".btn-delete", ".form-delete");

    // Sortable permission
    Spandiv.Sortable(".sortable");
</script>

@endsection