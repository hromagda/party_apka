@extends('layouts.app')

@section('content')
    <div class="container">

        {{-- Zpět domů --}}
        <div class="mb-3 text-start">
            <a href="{{ route('home') }}" class="btn btn-light back-arrow" style="color: black">
                <i class="bi purple-arrow bi-arrow-left-circle-fill"></i> Zpět domů
            </a>
        </div>

        <!-- Nadpis pro správu uživatelů -->
        <h1 class="mt-5">Správa uživatelů</h1>

        <!-- Seznam uživatelů -->
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Jméno</th>
                <th>Email</th>
                <th>Role</th>
                <th>Akce</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @foreach($user->roles as $role)
                            <span class="badge bg-info">{{ $role->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <!-- Tlačítka pro editaci a smazání uživatele -->
                        <a href="{{ route('admin.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                        <a href="{{ route('admin.delete', $user->id) }}" class="btn btn-danger">Smazat</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <hr>

        <!-- Sekce pro správu aplikace -->
        <h2 class="mt-5">Správa aplikace</h2>

        {{-- Vzkazy --}}
        <div class="mb-3">
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseVzkazy" aria-expanded="false" aria-controls="collapseVzkazy">
                Zobrazit / Skrýt vzkazy
            </button>
            <div class="collapse mt-3" id="collapseVzkazy">
                <h4>Vzkazy</h4>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Jméno</th>
                        <th>Text</th>
                        <th>Akce</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(\App\Models\Vzkaz::latest()->get() as $vzkaz)
                        <tr>
                            <td>{{ $vzkaz->jmeno }}</td>
                            <td>{{ $vzkaz->text }}</td>
                            <td>
                                <!-- Formulář pro smazání vzkazu -->
                                <form action="{{ route('admin.vzkazy.delete', $vzkaz->id) }}" method="POST" onsubmit="return confirm('Opravdu smazat vzkaz?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Smazat</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Fotky --}}
        <div class="mb-3">
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFotky" aria-expanded="false" aria-controls="collapseFotky">
                Zobrazit / Skrýt fotky
            </button>
            <div class="collapse mt-3" id="collapseFotky">
                <h4>Fotky</h4>
                <div class="row">
                    @foreach(\App\Models\Fotka::latest()->get() as $fotka)
                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <img src="{{ asset('storage/fotky/' . $fotka->nazev_souboru) }}" class="card-img-top" alt="{{ $fotka->puvodni_nazev }}">
                                <div class="card-body text-center">
                                    <!-- Formulář pro smazání fotky -->
                                    <form action="{{ route('admin.fotky.delete', $fotka->id) }}" method="POST" onsubmit="return confirm('Opravdu smazat fotku?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Smazat</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
