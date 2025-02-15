@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4 mt-5">📦 Gestione Prodotti</h1>

    

 <!-- Barra di Ricerca e Filtri -->
  <form action="{{ route('admin.products.index') }}" method="GET" class="ms-5 mb-4 mt-5">
  
            <div class="row">
            
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
                <div class="col-md-2">
                  <a href="{{ route('admin.products.create') }}" class="btn btn-success mb-3">➕ Nuovo Prodotto</a>
                </div>
            </div>
  </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
    <thead class="table-dark">
        <tr>
            <th>Nome</th>
            <th>Prezzo</th>
            <th>Stock</th>
            <th>Descrizione</th> <!-- 🔹 Colonna Descrizione -->
            <th>Data </th> <!-- 🔹 Nuova Colonna Data -->
            <th>Azioni</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>€{{ number_format($product->price, 2) }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    <!-- 🔹 Mostra solo i primi 25 caratteri -->
                    {{ Str::limit($product->description, 20) }} 
                    
                    <!-- 🔹 Bottone per leggere la descrizione completa -->
                    @if(strlen($product->description) > 20)
                        <button type="button" class="btn btn-link text-decoration-none p-0" data-bs-toggle="modal" data-bs-target="#descModal{{ $product->id }}">
                        ...Leggi
                        </button>
                    @endif
                </td>
                <td>{{ $product->created_at->format('d/m/Y H:i') }}</td> <!-- 🔹 Formatta data e ora -->
                <td>
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">✏️ Modifica</a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">🗑️ Elimina</button>
                    </form>
                </td>
            </tr>

            <!-- 🔹 Modale per Mostrare la Descrizione Completa -->
            <div class="modal fade" id="descModal{{ $product->id }}" tabindex="-1" aria-labelledby="descModalLabel{{ $product->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="descModalLabel{{ $product->id }}">📜 Descrizione Completa</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            {{ $product->description }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                        </div>
                    </div>
                </div>
            </div>

        @empty
            <tr>
                <td colspan="6" class="text-center">Nessun prodotto disponibile.</td>
            </tr>
        @endforelse
    </tbody>
</table>


</div>
@endsection
