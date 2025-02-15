<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

// Inclusione delle rotte di autenticazione di Laravel Breeze
require __DIR__.'/auth.php';

// Rotta Home (accessibile a tutti)

Route::get('/', function (Request $request) {
    $query = Product::query();

    // Filtro per ricerca
    if ($request->has('search') && !empty($request->search)) {
        $query->where('name', 'like', '%' . $request->search . '%')
              ->orWhere('description', 'like', '%' . $request->search . '%');
    }

    // Filtro per prezzo
    if ($request->has('min_price') && $request->has('max_price')) {
        $query->whereBetween('price', [$request->min_price, $request->max_price]);
    }

    // Filtro per categoria
    if ($request->has('category') && !empty($request->category)) {
        $query->where('category_id', $request->category);
    }

    $products = $query->get();
    $categories = Category::all(); // Passiamo anche le categorie alla vista

    return view('home', compact('products', 'categories'));
})->name('home');

// Rotta Dashboard Utente (solo per utenti autenticati e verificati)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rotte per la gestione del profilo (solo per utenti autenticati)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rotte Admin (solo per utenti con ruolo "admin")
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('products', ProductController::class);
});

