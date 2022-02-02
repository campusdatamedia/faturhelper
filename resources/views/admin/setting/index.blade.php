@extends('faturhelper::layouts/admin/main')

@section('title', 'Pengaturan')

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Pengaturan</h1>
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
                <form method="post" action="{{ route('admin.setting.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">
                            Nama<span class="text-danger">*</span>
                            <br>
                            <code>setting('name')</code>
                        </label>
                        <div class="col-lg-10 col-md-9">
                            <input type="text" name="setting[name]" class="form-control form-control-sm {{ $errors->has('setting.name') ? 'border-danger' : '' }}" value="{{ setting('name') }}">
                            @if($errors->has('setting.name'))
                            <div class="small text-danger">{{ $errors->first('setting.name') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label class="col-lg-2 col-md-3 col-form-label">
                            Zona Waktu<span class="text-danger">*</span>
                            <br>
                            <code>setting('timezone')</code>
                        </label>
                        <div class="col-lg-10 col-md-9">
                            <select name="setting[timezone]" class="form-select form-select-sm {{ $errors->has('setting.timezone') ? 'border-danger' : '' }}" id="timezone">
                                <option value="" disabled selected>--Pilih--</option>
                                @foreach($timezones as $timezone)
                                <option value="{{ $timezone }}" {{ setting('timezone') == $timezone ? 'selected' : '' }}>{{ $timezone }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('setting.timezone'))
                            <div class="small text-danger">{{ $errors->first('setting.timezone') }}</div>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-2 col-md-3"></div>
                        <div class="col-lg-10 col-md-9">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="bi-save me-1"></i> Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
	</div>
</div>

@endsection

@section('js')

<script type="text/javascript">
    // Select2
    Spandiv.Select2("#timezone");
</script>

@endsection