@extends('faturhelper::layouts/admin/main')

@section('title', 'Profil')

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Profil</h1>
</div>
<div class="row">
    <div class="col-md-4 col-xl-3">
        <div class="card">
            <div class="card-body text-center">
                @if(Auth::user()->avatar != '' && File::exists(public_path('assets/images/users/'.Auth::user()->avatar)))
                    <img src="{{ asset('assets/images/users/'.Auth::user()->avatar) }}" class="rounded-circle" height="150" width="150" alt="Foto">
                @else
                    <div class="d-flex justify-content-center">
                        <div class="avatar rounded-circle me-2 text-center bg-dark" style="height: 150px; width: 150px; line-height: 150px; cursor: pointer;">
                            <div class="avatar-overlay"><i class="bi-camera"></i></div>
                            <h2 class="text-white" style="line-height: 150px; font-size: 75px;">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</h2>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-8 col-xl-9">
        <div class="card">
            <div class="card-header"><h5 class="card-title mb-0">Profil Pengguna</h5></div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0 py-1 d-sm-flex justify-content-between">
                        <div>Nama:</div>
                        <div>{{ $user->name }}</div>
                    </li>
                    <li class="list-group-item px-0 py-1 d-sm-flex justify-content-between">
                        <div>Tanggal Lahir:</div>
                        <div>{{ $user->attribute ? date('d/m/Y', strtotime($user->attribute->birthdate)) : '-' }}</div>
                    </li>
                    <li class="list-group-item px-0 py-1 d-sm-flex justify-content-between">
                        <div>Jenis Kelamin:</div>
                        <div>{{ $user->attribute ? gender($user->attribute->gender) : '-' }}</div>
                    </li>
                    <li class="list-group-item px-0 py-1 d-sm-flex justify-content-between">
                        <div>Email:</div>
                        <div>{{ $user->email }}</div>
                    </li>
                    <li class="list-group-item px-0 py-1 d-sm-flex justify-content-between">
                        <div>Username:</div>
                        <div>{{ $user->username }}</div>
                    </li>
                    <li class="list-group-item px-0 py-1 d-sm-flex justify-content-between">
                        <div>Kunjungan Terakhir:</div>
                        <div>{{ date('d/m/Y, H:i', strtotime($user->last_visit)) }} WIB</div>
                    </li>
                    <li class="list-group-item px-0 py-1 d-sm-flex justify-content-between">
                        <div>Registrasi:</div>
                        <div>{{ date('d/m/Y, H:i', strtotime($user->created_at)) }} WIB</div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection

@section('css')

<style>
    .avatar-overlay {height: 150px; width: 150px; position: absolute; border-radius: 100%; background: rgba(42,127,167,0.7); opacity: 0; transition: .5s;}
    .avatar-overlay:hover {opacity: 1;}
    .avatar-overlay i {color: #fff; font-size: 3.5rem;}
</style>

@endsection