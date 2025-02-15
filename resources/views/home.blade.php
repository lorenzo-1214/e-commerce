<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - E-Commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .navbar {
            background-color: #343a40;
      
        }
        .navbar a {
            color: white;
        }
        .hero {
            height: 60vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">E-Commerce</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link text-warning" href="{{ route('admin.products.index') }}">
                                    Gestione Prodotti
                                </a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Registrati</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="container mt-5">
        <div class="text-center">
            <h1>Benvenuto nel nostro E-Commerce</h1>
        </div>

        

        <!-- Barra di Ricerca e Filtri -->
        <form action="{{ route('home') }}" method="GET" class="ms-5 mb-4 mt-5">
            <div class="row search-filter-group">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="🔍 Cerca prodotto..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="category" class="form-control">
                        <option value="">📂 Tutte le Categorie</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Filtra</button>
                </div>
            </div>
        </form>

        <div class="text-center">
            <h5 class="mb-4 mt-5">🛍️ Prodotti Disponibili</h5>
        </div>

        <!-- Lista Prodotti -->
        <div class="row mt-5">
        <div class="row mt-5">
    @foreach ($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid" style="height: 250px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">{{ Str::limit($product->description, 80) }}</p>
                    <h4 class="text-primary">€{{ number_format($product->price, 2) }}</h4>
                    <a href="#" class="btn btn-success">🛒 Aggiungi al Carrello</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
