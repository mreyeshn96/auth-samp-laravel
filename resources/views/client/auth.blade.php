@extends("client.layout.template-master")
@section('page-title', 'United States - Juego de rol')
@section('extra-js-top')
    <script type="text/javascript">
        var onloadCallback = function() {
            grecaptcha.render('html_element', {
                'sitekey': '6LfCKt8ZAAAAAD2XOaC4uKwlxInvul8u3h4iOO0a'
            });
        };

    </script>
@endsection
@section('extra-css')
    @livewireStyles
@endsection
@section('page-content')
    <div class="row text-center">
        <div class="main-container col-12">
            <div class="col-12 text-center">
                <form class="form-main text-center" method="post" action="{{ route('run.auth') }}">
                    @csrf
                    <div class="cap-container d-inline-block">
                        <div id="html_element"></div>
                    </div>
                    <div>
                        <button type="submit" class="btn-action g-recaptcha btn btn-primary waves-effect waves-float waves-light col-6"><i class="fa fa-shield mr-1"></i>Autorizar</button>
                    </div>
                </form>
            </div>
        @if (session('demoring_auth'))
        <div class="demo-spacing-0">
            <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                <div class="alert-body">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-info mr-50 align-middle">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="16" x2="12" y2="12"></line>
                        <line x1="12" y1="8" x2="12.01" y2="8"></line>
                    </svg>
                    <span>La autorización se prolongó más de lo esperado, espere unos segundos e intente de nuevo.</span>
                </div>
            </div>
        </div>
    @endif
        @if (session('recaptcha-error'))
            <div class="demo-spacing-0">
                <div class="alert alert-danger mt-1 alert-validation-msg" role="alert">
                    <div class="alert-body">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-info mr-50 align-middle">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="16" x2="12" y2="12"></line>
                            <line x1="12" y1="8" x2="12.01" y2="8"></line>
                        </svg>
                        <span>No se completo la seguridad anti-robot.</span>
                    </div>
                </div>
            </div>
        @endif
    </div>
    </div>
@endsection
@section('extra-js')
    <script src="{{ asset('app-assets/mscript.js') }}?v=@php echo "?v=".time().""@endphp"></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer>
    </script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <script>
    </script>
@endsection
