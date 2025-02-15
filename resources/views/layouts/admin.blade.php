<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin - {{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        .sidebar {
            height: 100vh; /* Altezza 100% della finestra */
            width: 250px;
            background-color: #343a40;
            color: white;
            padding: 20px;
            position: fixed;
            left: 0;
            top: 0;
        }
        .content {
            margin-left: 260px; /* Spazio per la sidebar */
            padding: 20px;
            width: calc(100% - 260px);
        }
    </style>
</head>
<body>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <h4 class="mt-5">Gestione Admin</h4>
            <ul class="nav flex-column mt-5">
                <li class="nav-item mb-4">
                    <a class="nav-link text-warning fw-bold" href="{{ route('admin.products.index') }}">
                        🛒 Prodotti Totali: <span class="badge bg-primary">{{ \App\Models\Product::count() }}</span>
                    </a>
                </li>
                         <!-- Aggiungiamo il totale in euro -->
                <li class="nav-item mt-2">
                     <a class="nav-link text-warning fw-bold"  href="{{ route('admin.products.index') }}">
                     💰EURO: <span class="badge bg-primary">€{{ number_format(\App\Models\Product::sum('price'), 2) }} </span>
                     </a>
                </li>
            </ul>
         <ul class="nav flex-column mt-5">
         <li class="nav-item mb-4">
                    <a class="nav-link text-white" href="{{ route('dashboard') }}">🔙 Torna al Sito</a>
                </li>
         </ul>
           
        </div>
        </div>
   

        <!-- Contenuto Principale -->
        <main class="content">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
