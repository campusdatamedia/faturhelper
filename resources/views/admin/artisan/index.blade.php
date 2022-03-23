@extends('faturhelper::layouts/admin/main')

@section('title', 'Artisan')

@section('content')

<div class="d-sm-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0">Artisan</h1>
</div>
<div class="row">
    @foreach($artisans as $artisan)
	<div class="col-lg-3 col-md-4 col-sm-6 mb-3">
		<div class="card h-100">
            <div class="card-body">
                <h4>{{ $artisan['title'] }}</h4>
                <p class="mb-0">{{ $artisan['command'] }}</p>
            </div>
            <div class="card-footer">
                <button type="button" class="btn btn-sm btn-primary btn-artisan" data-key="{{ $artisan['key'] }}" data-command="{{ $artisan['command'] }}"><i class="bi-terminal me-1"></i> Run Command</button>
            </div>
		</div>
	</div>
    @endforeach
</div>

<div class="modal fade" id="modal-artisan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Artisan Output</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <pre class="bash"><span class="bash-command"></span><br><span class="bash-output"></span></pre>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

<script type="text/javascript">
    $(document).on("click", ".btn-artisan", function(e) {
        e.preventDefault();
        if(typeof Pace !== "undefined") Pace.restart();
        var key = $(this).data("key");
        var command = $(this).data("command");
        $.ajax({
            type: "post",
            url: "{{ route('admin.artisan.run') }}",
            data: {_token: "{{ csrf_token() }}", key: key},
            success: function(response) {
                $("#modal-artisan").find(".bash-command").text("> " + command);
                $("#modal-artisan").find(".bash-output").text(response);
                Spandiv.Modal("#modal-artisan").show();
            }
        });
    });
</script>

@endsection

@section('css')

<style>
pre.bash {
    background-color: black;
    color: white;
    font-size: medium; 
    font-family: Consolas, Monaco, Lucida Console, Liberation Mono, DejaVu Sans Mono, Bitstream Vera Sans Mono, Courier New, monospace;
    width: 100%;
    display: inline-block;
    margin-bottom: 0;
}
</style>

@endsection