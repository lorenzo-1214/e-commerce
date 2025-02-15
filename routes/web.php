<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

// Inclusione delle rotte di autenticazione di Laravel Breeze
require __DIR__.'/auth.php';

// 🔹 Rotta Home (accessibile a tutti)
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
    $categories = Category::all(); 
    $totalProducts = Product::count(); // Conta il numero totale di prodotti
    
    return view('home', compact('products', 'categories', 'totalProducts'));
})->name('home');

// 🔹 Dashboard reindirizzata alla home
Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

// 🔹 Rotte per la gestione del profilo
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🔹 Rotte Admin
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.products.index');
    })->name('dashboard');
    // 🔹 CORRETTO: Spostiamo la rotta di eliminazione multipla dentro il gruppo admin
    Route::delete('products/bulk-delete', [ProductController::class, 'bulkDelete'])->name('products.bulkDelete');
    Route::resource('products', ProductController::class);
});
