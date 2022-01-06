@extends('faturhelper::layouts/admin/main')

@section('title', 'Kelola Role')

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Kelola Role</h1>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if(Session::get('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <div class="alert-message">{{ Session::get('message') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <a href="{{ route('admin.role.create') }}" class="btn btn-sm btn-outline-secondary mb-3"><i class="bi-plus me-1"></i>Tambah Role</a>
                <br>
                
                @if(count($roles) > 0)
                <p class="fst-italic small text-muted"><i class="bi-info-circle me-1"></i> Tekan dan geser role di bawah ini untuk mengurutkannya.</p>
                <div class="list-group sortable" data-url="{{ route('admin.role.sort') }}">
                    @csrf
                    @foreach($roles as $role)
                        <div class="list-group-item d-flex justify-content-between align-items-center p-2" data-id="{{ $role->id }}">
                            <div>
                                {{ $role->name }}
                                <br>
                                <small class="text-muted">
                                    Sebagai Admin:
                                    <span class="badge {{ $role->is_admin == 1 ? 'bg-success' : 'bg-danger' }}">{{ $role->is_admin == 1 ? 'Ya' : 'Tidak' }}</span>
                                </small>
                            </div>
                            <div class="btn-group">
                                <a href="{{ route('admin.role.edit', ['id' => $role->id]) }}" class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip" title="Edit Role"><i class="bi-pencil"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-secondary btn-delete" data-id="{{ $role->id }}" data-bs-toggle="tooltip" title="Hapus Role"><i class="bi-trash"></i></a>
                            </div>
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

<form class="form-delete d-none" method="post" action="{{ route('admin.role.delete') }}">
    @csrf
    <input type="hidden" name="id">
</form>

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