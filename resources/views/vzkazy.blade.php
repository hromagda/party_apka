@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4" style="font-family: 'Dancing Script', cursive; color: #ba68c8;">Zanech vzkaz 🎈</h2>

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <form method="POST" action="{{ route('vzkazy.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="jmeno" class="form-label">Jméno</label>
                        <input type="text" class="form-control" id="jmeno" name="jmeno" required>
                    </div>
                    <div class="mb-3">
                        <label for="text" class="form-label">Vzkaz</label>
                        <textarea class="form-control" id="text" name="text" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Odeslat vzkaz</button>
                </form>
            </div>

            <div class="col-12 col-md-6">
                <h4 class="mb-3">Vzkazy 💌</h4>
                @foreach ($vzkazy as $vzkaz)
                    <div class="card mb-3">
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <p>{{ $vzkaz->text }}</p>
                                <footer class="blockquote-footer">{{ $vzkaz->jmeno }}</footer>
                            </blockquote>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
