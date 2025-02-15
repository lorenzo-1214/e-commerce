<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'E-Commerce')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   
</head>
<body>

    @include('layouts.navigation') <!-- Navbar -->

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <h3>Menù Admin</h3>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.products.index') }}">📦 Gestione Prodotti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('admin.orders.index') }}">🛒 Gestione Ordini</a>
                </li>
            </ul>
        </div>

        <!-- Contenuto Principale -->
        <div class="content">
            @yield('content')
        </div>
    </div>

</body>
</html>
