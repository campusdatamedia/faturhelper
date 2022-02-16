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

<div class="modal fade" id="modal-image" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Pilih / Unggah Foto</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">Ukuran 150 x 150 pixel.</p>
                <!-- <form id="form-upload-image" method="post" action="#" enctype="multipart/form-data"> -->
                    <div class="row">
                        <div class="col-12">
                            <div class="dropzone">
                                <div class="dropzone-description">
                                    <i class="dropzone-icon bi-upload"></i>
                                    <p>Pilih file gambar atau geser ke sini.</p>
                                </div>
                                <input type="file" name="file" class="dropzone-input croppie-input" accept="image/*">
                            </div>
                        </div>
                    </div>
                <!-- </form> -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-croppie" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sesuaikan Foto</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center">Ukuran 150 x 150 pixel.</p>
                <div class="table-responsive">
                    <div id="croppie"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-sm btn-primary btn-croppie">Potong</button>
                <button class="btn btn-sm btn-danger" data-bs-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js"></script>
<script>
    function Croppie(selector, options) {
        var croppie = $("#croppie").croppie({
            viewport: {width: options.width, height: options.height, type: options.type == 'square' || options.type == 'circle' ? options.type : 'square'},
            boundary: {width: options.width, height: options.height}
        });
        return croppie;
    }

    function CroppieBindFromURL(croppieObject, input) {
        if(input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                croppieObject.croppie('bind', {
                    url: e.target.result
                });
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function CroppieResult(croppieObject) {
        croppieObject.croppie('result', {
            type: 'base64'
        }).then(function(response) {
            console.log(response);
        });
    }
</script>
<script>
    // Init Croppie
    var croppie = Croppie("#croppie", {
        width: 150,
        height: 150,
        type: 'circle'
    });

    // Click on Avatar
    $(document).on("click", ".avatar", function() {
        Spandiv.Modal("#modal-image").show();
    });

    // Change Croppie Input
    $(document).on("change", ".croppie-input", function() {
        CroppieBindFromURL(croppie, this);
        Spandiv.Modal("#modal-image").hide();
        Spandiv.Modal("#modal-croppie").show();
        $(this).val(null);
    });

    // Button Croppie
    $(document).on("click", ".btn-croppie", function(e) {
        e.preventDefault();
        CroppieResult(croppie);
    });
</script>

@endsection

@section('css')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css">
<style>
    .avatar-overlay {height: 150px; width: 150px; position: absolute; border-radius: 100%; background: rgba(42,127,167,0.7); opacity: 0; transition: .5s;}
    .avatar-overlay:hover {opacity: 1;}
    .avatar-overlay i {color: #fff; font-size: 3.5rem;}

    #modal-image .modal-body {height: 80vh; overflow-y: auto;}
    #modal-image .dropzone {display: flex; justify-content: center; align-items: center; height: 150px; border: 2px dashed #bebebe;}
    #modal-image .dropzone:hover {background-color: #e5e5e5; transition: .3s ease-in;}
    #modal-image .dropzone-description {text-align: center; font-weight: bold;}
    #modal-image .dropzone-icon {font-size: 2rem;}
    #modal-image .dropzone-input, #modal-image .dropzone-input:focus {position: absolute; width: 100%; height: 150px; outline: none!important; cursor: pointer; opacity: 0;}

    .cr-boundary {border: 3px dashed #bebebe;}
</style>

@endsection