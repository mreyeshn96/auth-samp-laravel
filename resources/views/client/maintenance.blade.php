@extends("client.layout.template-master")
@section("page-title", "United States - Juego de rol")
@section("page-content")
    <div class="col-12 text-center">
        <div role="alert" aria-live="polite" aria-atomic="true" class="alert alert-dark">
            <h4 class="alert-heading"> Mantenimiento en progreso </h4>
            <div class="alert-body">
                <span>{{env("MAINTENANCE_TEXT")}}</span>
            </div>
        </div>
    </div>
@endsection