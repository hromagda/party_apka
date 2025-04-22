@extends('layouts.app')

@section('content')
    <div class="container pisnicky-container">

        {{-- Zpět domů --}}
        <div class="mb-3 text-start">
            <a href="{{ route('home') }}" class="btn btn-light back-arrow" style="color: black">
                <i class="bi blue-arrow bi-arrow-left-circle-fill"></i> Zpět domů
            </a>
        </div>

        <!-- Titulní nadpis pro písničky na přání -->
        <h2 class="pisnicky-title">Písničky na přání</h2>

        {{-- Formulář pro přidání nové písničky --}}
        <div class="mb-4">
            <div class="card shadow-sm pisnicky-form">
                <div class="card-body">
                    <form method="POST" action="{{ route('pisnicky.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="interpret" class="form-label">Interpret</label>
                            <input type="text" class="form-control" id="interpret" name="interpret" required>
                        </div>
                        <div class="mb-3">
                            <label for="nazev" class="form-label">Název písničky</label>
                            <input type="text" class="form-control" id="nazev" name="nazev" required>
                        </div>
                        <div class="mb-3">
                            <label for="objednavatel" class="form-label">Kdo objednává</label>
                            <input type="text" class="form-control" id="objednavatel" name="objednavatel" required>
                        </div>
                        <button type="submit" class="btn text-white bg-modra">Odeslat přání</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Seznam přání --}}
        <div class="pisnicky-list">
            <h4 class="pisnicky-title">Seznam přání 🎶</h4>
            <div class="pisnicky-table">
                <!-- Hlavička tabulky s názvy sloupců -->
                <div class="pisnicky-header">
                    <div class="pisnicky-column">Písnička</div>
                    <div class="pisnicky-column">Interpret</div>
                    <div class="pisnicky-column">Objednavatel</div>
                    <div class="pisnicky-column">Stav</div>
                    <div class="pisnicky-column">Akce</div>
                </div>

                <!-- Procházení seznamu přání a zobrazení každého záznamu -->
                @foreach ($pisnicky as $pisnicka)
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
                @endforeach
            </div>

            {{-- Paginace --}}
            <div class="pagination-wrapper mt-4">
                @include('components.pagination', ['collection' => $pisnicky])
            </div>

        </div>
    </div>
@endsection
