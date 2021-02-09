<div>
    @if (strcmp($statusAuth, "UNSTARTED") === 0)
    <form class="text-center" method="post" action="{{route("run.auth")}}>
        @csrf
        <div class="d-inline-block">
            <div id="html_element"></div>
        </div>
        <div>
            <div wire:loading>
                Estamos autorizandote...
            </div>
            <button wire:loading.remove wire:click="$refresh" type="submit" class="btn btn-primary waves-effect waves-float waves-light col-6"><i class="fa fa-shield mr-1"></i>Autorizar</button>
        </div>
    </form>
    @elseif (strcmp($statusAuth, "STARTED") === 0)
    Obteniendo ip
    @else
    R: {{$responseAux}}
    @endif
</div>
