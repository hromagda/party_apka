@extends('layouts.app')

@section('content')
    <div class="container welcome-container">

        <!-- Ikony pro vizuální efekt na začátku stránky -->
        <div class="icons mb-4">
            <i class="fas fa-balloon fa-2x text-danger"></i> <!-- Ikona balónu -->
            <i class="fas fa-gift fa-2x text-warning"></i> <!-- Ikona dárku -->
        </div>

        <!-- Hlavní uvítací nadpis -->
        <h1 class="mb-4">Vítejte na páááárty!<br>Co si přejete udělat?</h1>

        <!-- Zobrazení informace o přihlášení a roli uživatele, pokud je přihlášen -->
        @auth
            <div class="mb-4">
                <p>Jste přihlášen jako: <strong>{{ Auth::user()->name }}</strong></p>
            </div>
        @endauth

        <!-- Karty pro navigaci mezi různými funkcemi aplikace -->
        <div class="row">

            <!-- Karta pro výběr písničky -->
            <div class="col-12 col-md-6 mb-4 d-flex align-items-stretch">
                <div class="party-card shadow p-4 rounded blue-card h-100" onclick="window.location.href='{{ route('pisnicky.index') }}'">
                    <h3 class="card-title">Přát si písničku</h3>
                    <p class="card-text">Vyber si oblíbenou písničku, kterou si přeješ zahrát od DJe!</p>
                </div>
            </div>

            <!-- Karta pro psaní vzkazu -->
            <div class="col-12 col-md-6 mb-4 d-flex align-items-stretch">
                <div class="party-card shadow p-4 rounded purple-card h-100" onclick="window.location.href='{{ route('vzkazy.index') }}'">
                    <h3 class="card-title">Napsat vzkaz</h3>
                    <p class="card-text">Napiš vzkaz pro oslavence nebo kohokoliv v sále a přidej svůj příspěvek k ostatním!</p>
                </div>
            </div>

            <!-- Karta pro nahrání fotky -->
            <div class="col-12 mb-4 d-flex align-items-stretch">
                <div class="party-card shadow p-4 rounded yellow-card h-100" onclick="window.location.href='{{ route('fotky.index') }}'">
                    <h3 class="card-title">Nahrát fotku 📸</h3>
                    <p class="card-text">Vyfoť se a přidej vzpomínku na tuto skvělou oslavu!</p>
                </div>
            </div>

            <!-- Karta pro správu uživatelů, dostupná pouze adminům -->
            @can('spravovat_uzivatele')
                <div class="row">
                    <div class="col-12 mb-4 d-flex justify-content-center">
                        <div class="party-card shadow p-4 rounded green-card h-100" onclick="window.location.href='{{ route('admin.index') }}'">
                            <h3 class="card-title">Správa aplikace</h3>
                            <p class="card-text">Administrace uživatelů a údržba aplikace.</p>
                        </div>
                    </div>
                </div>
            @endcan
        </div>

        <!-- Sekce pro přihlášení pro DJ nebo admina, pokud není přihlášen -->
        <div class="row mt-5">
            <div class="col-12 text-center">
                <p>Jste DJ nebo správce aplikace?</p>
                <!-- Odkazy pro přihlášení nebo registraci -->
                <a href="{{ route('login') }}" class="btn btn-outline-primary">Přihlásit se</a>
                <a href="{{ route('register') }}" class="btn btn-outline-secondary">Registrovat se</a>
            </div>
        </div>

        <!-- Sekce pro odhlášení, pokud je uživatel přihlášen -->
        @auth
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <!-- Formulář pro odhlášení -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf <!-- Token pro ochranu proti CSRF útokům -->
                        <button type="submit" class="btn btn-danger">Odhlásit se</button>
                    </form>
                </div>
            </div>
        @endauth
    </div>
@endsection
