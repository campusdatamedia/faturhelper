@extends('faturhelper::layouts/admin/main')

@section('title', 'Urutkan Role')

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-2 mb-sm-0">Urutkan Role</h1>
    <a href="{{ route('admin.role.index') }}" class="btn btn-sm btn-secondary"><i class="bi-arrow-left me-1"></i> Kembali ke Kelola Role</a>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">                
                @if(count($roles) > 0)
                <p class="fst-italic small text-muted"><i class="bi-info-circle me-1"></i> Tekan dan geser role di bawah ini untuk mengurutkannya.</p>
                <div class="list-group sortable" data-url="{{ route('admin.role.sort') }}">
                    @csrf
                    @foreach($roles as $role)
                        <div class="list-group-item p-2 {{ $role->code == 'super-admin' ? 'ui-state-disabled' : '' }}" data-id="{{ $role->id }}">
                            {{ $role->name }}
                        </div>
                    @endforeach
                </div>
                @else
                    <em class="text-danger">Belum ada role.</em>
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

    // Sortable Role
    Spandiv.Sortable(".sortable");
</script>

@endsection