@extends("client.layout.template-master")
@section("page-title", "United States - Juego de rol")
@section("page-content")
<div class="row">
    <div class="d-flex flex-column col-md-12">
        <div class="col-9 align-self-center">
                @isset($resultCode)
                    @if ( strcmp($resultCode, "SUCCESS_AUTH") === 0 )
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                Dirección IP
                            </div>
                        </div>
    
                        <input type="text" class="form-control" value="{{$resultAux}}:7777">
                        <div class="input-group-append">
                            <a class="btn btn-primary" href="samp://{{$resultAux}}">Jugar</a>
                        </div>
                        <p class="text-center my-2">
                            Puedes colocar la dirección IP en tu SA-MP para poder empezar a jugar o directamente presionar el bóton 'Jugar'.
                        </p>
                    </div>
                    {{-- <span class="badge badge-glow badge-info badge-pill"> 50/100 jugadores </span> --}}
                    @elseif ( strcmp($resultCode, "INPROGRESS_AUTH") === 0 )
                        Tu autorización esta en progreso
                    @elseif ( strcmp($resultCode, "MIN_CERTIFICATE") === 0 )
                        Tu cuenta no está certificada, accede a <a href="https://us-rp.org">us-rp.org</a>, registra tu cuenta y realiza nuestro formulario de ingreso.
                    @elseif ( strcmp($resultCode, "PROXY_DETECTED") === 0 )
                        Tu cuenta esta siendo restringida por nuestras medidas de seguridad, contacta con un administrador para resolver tu problema.
                    @elseif ( strcmp($resultCode, "BAN_DETECTED") === 0 || strcmp($resultCode, "INVALID_SESSION_ID") === 0)
                        Tu cuenta esta siendo restringida por nuestras medidas de seguridad, contacta con un administrador para resolver tu problema.
                    @elseif ( strcmp($resultCode, "FAILED_HEALTH") === 0 )
                        192.168.0.1
                    @elseif ( strcmp($resultCode, "NOT_FOUND_ACCOUNT") === 0 )
                        El correo electrónico proporcionado desde la red social (Google/Discord) no corresponde a ninguna cuenta en el servidor.<br>
                        <div role="alert" aria-live="polite" aria-atomic="true" class="alert alert-primary"><div class="alert-body"><svg xmlns="http://www.w3.org/2000/svg" width="14px" height="14px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-25 feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg><span class="ml-25">accede a us-rp.org para crear una cuenta nueva o gestionar una ya existen.</span></div></div>
                    @elseif ( strcmp($resultCode, "BANNED_ACCOUNT") === 0 )
                        Esta cuenta no se encuentra habilitada para poder autentificar.
                    @elseif ( strcmp($resultCode, "MAINT_MODE") === 0 )
                        Mantenimiento en progreso: $resultAux
                    @else
                        Un error a ocurrido: {{$resultCode}}
                @endif
           @endisset
        </div>
    </div>
</div>
@endsection