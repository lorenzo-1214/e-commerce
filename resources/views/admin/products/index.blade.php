@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4">📦 Gestione Prodotti</h1>

    <a href="{{ route('admin.products.create') }}" class="btn btn-success mb-3">➕ Aggiungi Nuovo Prodotto</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nome</th>
                <th>Prezzo</th>
                <th>Stock</th>
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
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-warning">✏️ Modifica</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">🗑️ Elimina</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Nessun prodotto disponibile.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
