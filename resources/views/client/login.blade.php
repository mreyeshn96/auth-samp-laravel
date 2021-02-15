@extends("client.layout.template-master")
@section("page-title", "United States - Juego de rol")
@section("page-content")
<div class="row">
    <div class="d-flex flex-column col-md-12">
        <div class="col-9 align-self-center">
            @env("prod")
            <a href="{{route("oauth.redirect", 'google')}}" class="btn btn-outline-danger waves-effect my-2"><i class="fa fa-google"></i> Iniciar sesión con Google</a>
            @endenv
            <a href="{{route("oauth.redirect", 'discord')}}" class="btn btn-outline-primary waves-effect">Iniciar sesión con Discord</a>
        </div>
    </div>
</div>
@endsection
