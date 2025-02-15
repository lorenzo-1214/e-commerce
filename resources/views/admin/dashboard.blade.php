@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">Dashboard Admin</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card p-3 shadow-sm">
                <h3>📦 Prodotti</h3>
                <p>Gestisci i prodotti del tuo e-commerce.</p>
                <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Vai a Gestione Prodotti</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3 shadow-sm">
                <h3>🔙 Torna al Sito</h3>
                <p>Visualizza l'e-commerce come un normale utente.</p>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Vai al Sito</a>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <h1 class="mb-4">Dashboard Utente</h1>

    @if(Auth::user()->role === 'admin')
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">🔧 Accedi all'Admin Panel</a>
    @endif

    <p class="mt-3">Benvenuto, {{ Auth::user()->name }}!</p>
</div>
@endsection
