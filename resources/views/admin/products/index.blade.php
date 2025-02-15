@extends('layouts.admin')

@section('content')
<div class="container">
    <h1 class="mb-4 mt-5">📦 Gestione Prodotti</h1>

    <!-- 🔹 Barra di Ricerca e Filtri -->
    <form action="{{ route('admin.products.index') }}" method="GET" class="ms-5 mb-4 mt-5">
        <div class="row search-filter-group">
            <div class="col-md-4 ">
                <input type="text" name="search" class="form-control" placeholder="🔍 Cerca prodotto..." value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <select name="category" class="form-control">
                    <option value="">📂 Categorie</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary w-100">Filtra</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('admin.products.create') }}" class="btn btn-success mb-3">➕ Nuovo Prodotto</a>
            </div>
            <!-- 🔹 Bottone per Eliminazione Multipla (Fuori dal form) -->
            <div class="col-md-3">
                <button type="button" class="btn btn-danger mb-3" id="deleteSelectedBtn" disabled>🗑️ Elimina Selezionati</button>
            </div>
        </div>
    </form>

    <!-- 🔹 Tabella con Checkbox -->
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th><input type="checkbox" id="selectAll"></th> <!-- 🔹 Checkbox per selezionare tutti -->
                <th>Nome</th>
                <th>Prezzo</th>
                <th>Stock</th>
                <th>Descrizione</th>
                <th>Data</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td><input type="checkbox" name="selected_products[]" value="{{ $product->id }}" class="productCheckbox"></td>
                    <td>{{ $product->name }}</td>
                    <td>€{{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        {{ Str::limit($product->description, 25) }}
                        @if(strlen($product->description) > 25)
                            <button type="button" class="btn btn-link text-decoration-none p-0" data-bs-toggle="modal" data-bs-target="#descModal{{ $product->id }}">
                                ... Leggi tutto
                            </button>
                        @endif
                    </td>
                    <td>{{ $product->created_at->format('d/m/Y H:i') }}</td>
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
                    <td colspan="7" class="text-center">Nessun prodotto disponibile.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- 🔹 Form nascosto per Eliminazione Multipla -->
    <form id="bulkDeleteForm" action="{{ route('admin.products.bulkDelete') }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="hidden" name="selected_products" id="selectedProductsInput">
    </form>

</div>

<!-- 🔹 JavaScript per la Selezione Multipla e Eliminazione -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const selectAllCheckbox = document.getElementById("selectAll");
        const productCheckboxes = document.querySelectorAll(".productCheckbox");
        const deleteSelectedBtn = document.getElementById("deleteSelectedBtn");
        const bulkDeleteForm = document.getElementById("bulkDeleteForm");
        const selectedProductsInput = document.getElementById("selectedProductsInput");

        // Seleziona/Deseleziona tutti i checkbox
        selectAllCheckbox.addEventListener("change", function() {
            productCheckboxes.forEach(checkbox => checkbox.checked = selectAllCheckbox.checked);
            toggleDeleteButton();
        });

        // Abilita/Disabilita bottone di eliminazione multipla
        productCheckboxes.forEach(checkbox => {
            checkbox.addEventListener("change", toggleDeleteButton);
        });

        function toggleDeleteButton() {
            const selectedProducts = [...productCheckboxes].filter(checkbox => checkbox.checked).map(checkbox => checkbox.value);
            deleteSelectedBtn.disabled = selectedProducts.length === 0;
        }

        // Invio del form di eliminazione multipla con gli ID selezionati
        deleteSelectedBtn.addEventListener("click", function() {
            const selectedProducts = [...productCheckboxes].filter(checkbox => checkbox.checked).map(checkbox => checkbox.value);

            if (selectedProducts.length > 0) {
                selectedProductsInput.value = JSON.stringify(selectedProducts);
                bulkDeleteForm.submit();
            }
        });
    });
</script>

@endsection
