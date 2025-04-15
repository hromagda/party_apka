@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4" style="font-family: 'Dancing Script', cursive; color: #ba68c8;">Přání písničky</h2>

        <div class="row g-4">
            <div class="col-12 col-md-6">
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
                        <label for="od" class="form-label">Kdo objednává</label>
                        <input type="text" class="form-control" id="od" name="od" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Odeslat přání</button>
                </form>
            </div>

            <div class="col-12 col-md-6">
                <h4 class="mb-3">Seznam přání 🎶</h4>
                <ul class="list-group">
                    @foreach ($pisnicky as $pisnicka)
                        <li class="list-group-item">
                            <strong>{{ $pisnicka->interpret }}</strong> – {{ $pisnicka->nazev }} <br>
                            <small>od: {{ $pisnicka->od }}</small>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection
