@extends("admin.layout.template-master")
@section("page-title", "Tablero")
@section("page-content")
@if($sampIsOnline == false)
<div class="col-12 col-xl-12">
    <a class="block block-rounded block-bordered block-link-shadow" href="javascript:void(0)">
        <div class="block-content block-content-full clearfix">
            {{-- <div class="float-right mt-15 d-none d-sm-block">
                <i class="si si-bag fa-2x text-primary-light"></i>
            </div> --}}
            {{-- <div class="font-size-h3 font-w600 text-primary js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="1500">1500</div> --}}
            <div class="font-size-sm font-w600 text-uppercase text-muted">No se ha podido establecer conexión con el servidor.</div>
        </div>
    </a>
</div>
@else
<div class="row">
    <div class="col-6 col-xl-3">
        <a class="block block-link-shadow text-right" href="javascript:void(0)">
            <div class="block-content block-content-full clearfix">
                <div class="float-left mt-10 d-none d-sm-block">
                    <div class="row">
                        <h2 class="mx-2">Jugadores</h2>
                    </div>
                </div>
                <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1000" data-to="1500">{{$sampInfo['players']}}</div>
                <div class="font-size-sm font-w600 text-uppercase text-muted"> / {{$sampInfo['maxplayers']}}</div>
            </div>
        </a>
    </div>
</div>
{{-- @php
    echo "<pre>".print_r($sampPlayers)."</pre>"
@endphp --}}
<livewire:ingameuser :listplayer="$sampPlayers"/>
@endif
@endsection