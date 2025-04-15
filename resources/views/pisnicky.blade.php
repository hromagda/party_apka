@extends('layouts.app')

@section('content')
    <div class="container pisnicky-container">

        {{-- Zpět domů --}}
        <div class="mb-3 text-start">
            <a href="{{ route('home') }}" class="btn btn-light back-arrow">
                <i class="bi bi-arrow-left-circle-fill"></i> Zpět domů
            </a>
        </div>

        <h2 class="pisnicky-title">Písničky na přání</h2>

        {{-- Formulář --}}
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
                        <button type="submit" class="btn text-white" style="background-color: #64b5f6;">Odeslat přání</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Seznam přání --}}
        <div class="pisnicky-list">
            <h4 class="pisnicky-title">Seznam přání 🎶</h4>
            <table class="table table-bordered shadow-sm">
                <thead>
                <tr>
                    <th>Interpret</th>
                    <th>Název písničky</th>
                    <th>Od</th>
                    <th>Status</th>
                    @can('oznacit_pisnicku_jako_zahranou')
                        <th>Akce</th>
                    @endcan
                </tr>
                </thead>
                <tbody>
                @foreach ($pisnicky as $pisnicka)
                    <tr class="@if($pisnicka->zahrano) zahrano @endif">
                        <td>{{ $pisnicka->interpret }}</td>
                        <td>{{ $pisnicka->nazev }}</td>
                        <td>{{ $pisnicka->objednavatel }}</td>
                        <td>{{ $pisnicka->zahrano_text }}</td>
                        @can('oznacit_pisnicku_jako_zahranou')
                            <td>
                                @if(!$pisnicka->zahrano)
                                    <form action="{{ route('pisnicky.zahrano', $pisnicka->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm">Zahráno</button>
                                    </form>
                                @endif
                            </td>
                        @endcan
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
@endsection
