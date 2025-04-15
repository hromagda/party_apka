@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Upravit uživatele: {{ $user->name }}</h1>

        <!-- Formulář pro editaci uživatele -->
        <form action="{{ route('admin.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Jméno</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <!-- Můžeš přidat i další pole pro editaci, například pro role apod. -->

            <button type="submit" class="btn btn-primary">Uložit změny</button>
        </form>

        <!-- Zobrazit chyby -->
        @if($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection
