@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1>Upravit uživatele: {{ $user->name }}</h1>

        <!-- Formulář pro editaci uživatele -->
        <form action="{{ route('admin.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Pole pro jméno uživatele -->
            <div class="mb-3">
                <label for="name" class="form-label">Jméno</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>

            <!-- Pole pro email uživatele -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>

            <!-- Výběr role pro uživatele -->
            <div class="mb-3">
                <label for="role" class="form-label">Vyber roli</label>
                <select name="role" id="role" class="form-select" required>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ $role->name == $user->getRoleNames()->first() ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tlačítka pro uložení a zpět -->
            <button type="submit" class="btn btn-success">Uložit</button>
            <a href="{{ route('admin.index') }}" class="btn btn-secondary">Zpět</a>
        </form>

        <!-- Zobrazení chybových hlášek -->
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
