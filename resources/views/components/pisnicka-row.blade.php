<div class="pisnicky-row @if($pisnicka->zahrano) zahrano @endif">
    <div class="pisnicky-column">{{ $pisnicka->nazev }}</div>
    <div class="pisnicky-column">{{ $pisnicka->interpret }}</div>
    <div class="pisnicky-column">{{ $pisnicka->objednavatel }}</div>
    <div class="pisnicky-column">
        <span class="zahrano-text">{{ $pisnicka->zahrano_text }}</span>
    </div>
    <div class="pisnicky-column">
        @can('oznacit_pisnicku_jako_zahranou')
            @if(!$pisnicka->zahrano)
                <form action="{{ route('pisnicky.zahrano', $pisnicka->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-warning btn-sm">Zahráno</button>
                </form>
            @endif
        @endcan
    </div>
</div>
