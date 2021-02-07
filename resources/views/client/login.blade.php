@extends("client.layout.template-master")
@section("page-title", "United States - Juego de rol")
@section("page-content")
<div class="row">
    <div class="d-flex flex-column col-md-12">
        <div class="col-9 align-self-center">
            <a href="{{route("oauth.redirect", 'google')}}" class="btn btn-outline-danger round waves-effect my-2"><i class="fa fa-google"></i> Iniciar sesión con Google</a>
            <a href="{{route("oauth.redirect", 'discord')}}" class="btn btn-outline-primary round waves-effect my-2"><i class="fa fa-google"></i> Iniciar sesión con Google</a>
        </div>
    </div>
</div>
@endsection