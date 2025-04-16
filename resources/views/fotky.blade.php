@extends('layouts.app')

@section('content')
    <div class="container pisnicky-container">

        {{-- Zpět domů --}}
        <div class="mb-3 text-start">
            <a href="{{ route('home') }}" class="btn btn-light back-arrow" style="color: black">
                <i class="bi text-zluta bi-arrow-left-circle-fill"></i> Zpět domů
            </a>
        </div>

        <h2 class="pisnicky-title text-zluta">Nahrej fotku </h2>

        {{-- Formulář --}}
        <div class="mb-4">
            <div class="card shadow-sm pisnicky-form">
                <div class="card-body">
                    <form method="POST" action="{{ route('fotky.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="soubor" class="form-label">Vyber fotku</label>
                            <input type="file" class="form-control" id="soubor" name="soubor" accept="image/*" required>
                        </div>
                        <button type="submit" class="btn text-white bg-zluta">Nahrát fotku</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Zobrazení fotek --}}
        <div class="pisnicky-list">
            <h4 class="pisnicky-title text-zluta">Nahrané fotky 📸</h4>
            <div class="row row-cols-2 row-cols-md-4 g-3">
                @foreach ($fotky as $fotka)
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset('storage/fotky/' . $fotka->nazev_souboru) }}" class="card-img-top" alt="Fotka">
                            <div class="card-body p-2">
                                <small class="text-muted">{{ $fotka->puvodni_nazev }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Paginace --}}
            <div class="pagination-wrapper mt-4">
                @include('components.pagination', ['collection' => $fotky])
            </div>
        </div>
    </div>
@endsection
