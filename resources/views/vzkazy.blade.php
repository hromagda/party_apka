@extends('layouts.app')

@section('content')
    <div class="container pisnicky-container">

        {{-- Zpět domů --}}
        <div class="mb-3 text-start">
            <a href="{{ route('home') }}" class="btn btn-light back-arrow" style="color: black">
                <i class="bi purple-arrow bi-arrow-left-circle-fill"></i> Zpět domů
            </a>
        </div>

        <h2 class="pisnicky-title" style="color: #ba68c8;">Napiš vzkaz </h2>

        {{-- Formulář --}}

        <div class="mb-4">
            <div class="card shadow-sm pisnicky-form">
                <div class="card-body">
                    <form method="POST" action="{{ route('vzkazy.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="jmeno" class="form-label">Tvé jméno</label>
                            <input type="text" class="form-control" id="jmeno" name="jmeno" required>
                        </div>
                        <div class="mb-3">
                            <label for="text" class="form-label">Tvůj vzkaz</label>
                            <textarea class="form-control" id="text" name="text" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn text-white bg-fialova">Odeslat vzkaz</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Seznam vzkazů --}}
        <div class="pisnicky-list">
            <h4 class="pisnicky-title" style="color: #ba68c8;">Vzkazy od srdce 💌</h4>
            <div class="vzkazy-wrapper">
                @foreach ($vzkazy as $vzkaz)
                    @include('components.vzkaz-bubliny', ['vzkaz' => $vzkaz, 'barvy' => $barvy])
                @endforeach
            </div>

            {{-- Paginace --}}
            <div class="pagination-wrapper mt-4">
                @include('components.pagination', ['collection' => $vzkazy])
            </div>
        </div>
    </div>
@endsection
