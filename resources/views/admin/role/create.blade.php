@extends('faturhelper::layouts/admin/main')

@section('title', 'Tambah Role')

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Tambah Role</h1>
</div>
<div class="row">
	<div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('admin.role.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Nama <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" name="name" class="form-control form-control-sm {{ $errors->has('name') ? 'border-danger' : '' }}" value="{{ old('name') }}" autofocus>
                            @if($errors->has('name'))
                            <div class="small text-danger">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Kode <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" name="code" class="form-control form-control-sm {{ $errors->has('code') ? 'border-danger' : '' }}" value="{{ old('code') }}">
                            @if($errors->has('code'))
                            <div class="small text-danger">{{ $errors->first('code') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Sebagai Admin? <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_admin" id="is_admin-1" value="1" {{ old('is_admin') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_admin-1">
                                    Ya
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_admin" id="is_admin-0" value="0" {{ old('is_admin') == '0' ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_admin-0">
                                    Tidak
                                </label>
                            </div>
                            @if($errors->has('is_admin'))
                            <div class="small text-danger">{{ $errors->first('is_admin') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">Status <span class="text-danger">*</span></label>
                        <div class="col-lg-10 col-md-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_global" id="is_global-1" value="1" {{ old('is_global') == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_global-1">
                                    Global
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="is_global" id="is_global-0" value="0" {{ old('is_global') == '0' ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_global-0">
                                    Lokal
                                </label>
                            </div>
                            @if($errors->has('is_global'))
                            <div class="small text-danger">{{ $errors->first('is_global') }}</div>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-2 col-md-3"></div>
                        <div class="col-lg-10 col-md-9">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="bi-save me-1"></i> Submit</button>
                            <a href="{{ route('admin.role.index') }}" class="btn btn-sm btn-secondary"><i class="bi-arrow-left me-1"></i> Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
	</div>
</div>

@endsection