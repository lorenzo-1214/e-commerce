@extends('layouts.admin')

@section('content')

<div class="container mt-5">
    <h2 class="mb-4">✏️ Modifica Prodotto</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', ['product' => $product->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nome Prodotto</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Prezzo (€)</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" value="{{ old('price', $product->price) }}" required>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Categoria</label>
            <select class="form-control" id="category_id" name="category_id">
                <option value="">-- Seleziona Categoria --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
    <label for="image" class="form-label">Immagine</label>
    <input type="file" class="form-control" id="image" name="image">

    @if($product->image)
        <p class="mt-2">Immagine attuale:</p>
        <img src="{{ asset('storage/' . $product->image) }}" alt="Immagine prodotto" class="img-thumbnail" width="150">
    @else
        <p class="mt-2 text-muted">Nessuna immagine disponibile.</p>
    @endif
    </div>

        <button type="submit" class="btn btn-success">💾 Salva Modifiche</button>
        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">🔙 Annulla</a>
       
    </div>
    </form>
@endsection
