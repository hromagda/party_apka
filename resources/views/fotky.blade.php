@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4" style="font-family: 'Dancing Script', cursive; color: #ba68c8;">Nahrání fotky 📷</h2>

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <form method="POST" action="{{ route('fotky.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="jmeno" class="form-label">Tvoje jméno</label>
                        <input type="text" class="form-control" id="jmeno" name="jmeno" required>
                    </div>
                    <div class="mb-3">
                        <label for="soubor" class="form-label">Vyber fotku</label>
                        <input type="file" class="form-control" id="soubor" name="soubor" accept="image/*" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Nahrát</button>
                </form>
            </div>

            <div class="col-12 col-md-6">
                <h4 class="mb-3">Nahrané fotky 📸</h4>
                <div class="row row-cols-2 g-2">
                    @foreach ($fotky as $fotka)
                        <div class="col">
                            <div class="card">
                                <img src="{{ asset('storage/fotky/' . $fotka->soubor) }}" class="card-img-top" alt="Fotka">
                                <div class="card-body p-2">
                                    <small class="text-muted">{{ $fotka->jmeno }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
