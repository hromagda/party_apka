@extends('layouts.app')

@section('content')
    <div class="container welcome-container">
        <div class="icons mb-4">
            <i class="fas fa-balloon fa-2x text-danger"></i>
            <i class="fas fa-gift fa-2x text-warning"></i>
        </div>
        <h1 class="mb-4">Vítejte na páááárty!<br>Co si přejete udělat?</h1>

        <!-- Logout tlačítko pro přihlášené -->
        @auth
            <div class="mb-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        @endauth

        <!-- Karty pro všechny (hosty i přihlášené) -->
        <div class="row">
            <!-- Písničky -->
            <div class="col-12 col-md-6 mb-4 d-flex align-items-stretch">
                <div class="party-card shadow p-4 rounded blue-card h-100" onclick="window.location.href='{{ route('pisnicky.index') }}'">
                    <h3 class="card-title">Přát si písničku</h3>
                    <p class="card-text">Vyber si oblíbenou písničku, kterou si přeješ zahrát od DJe!</p>
                </div>
            </div>

            <!-- Vzkazy -->
            <div class="col-12 col-md-6 mb-4 d-flex align-items-stretch">
                <div class="party-card shadow p-4 rounded purple-card h-100" onclick="window.location.href='{{ route('vzkazy.index') }}'">
                    <h3 class="card-title">Napsat vzkaz</h3>
                    <p class="card-text">Napiš vzkaz pro oslavence nebo kohokoliv v sále a přidej svůj příspěvek k ostatním!</p>
                </div>
            </div>

            <!-- Fotky -->
            <div class="col-12 mb-4 d-flex align-items-stretch">
                <div class="party-card shadow p-4 rounded yellow-card h-100" onclick="window.location.href='{{ route('fotky.index') }}'">
                    <h3 class="card-title">Nahrát fotku 📸</h3>
                    <p class="card-text">Vyfoť se a přidej vzpomínku na tuto skvělou oslavu!</p>
                </div>
            </div>

            <!-- Správa uživatelů – pouze pro admina -->
            @can('spravovat_uzivatele')
                <div class="col-12 col-md-6 mb-4 d-flex align-items-stretch">
                    <div class="party-card shadow p-4 rounded green-card h-100" onclick="window.location.href='{{ route('user-management.index') }}'">
                        <h3 class="card-title">Správa uživatelů</h3>
                        <p class="card-text">Administrace účastníků oslavy a jejich oprávnění.</p>
                    </div>
                </div>
            @endcan
        </div>

        <!-- Přihlášení pro DJ nebo admina -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <p>Jste DJ nebo správce aplikace?</p>
                <a href="{{ route('login') }}" class="btn btn-outline-primary">Přihlásit se</a>
                <a href="{{ route('register') }}" class="btn btn-outline-secondary">Registrovat se</a>
            </div>
        </div>
    </div>
@endsection
