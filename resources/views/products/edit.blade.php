@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-md border border-gray-100">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Editar Produto</h2>
        <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition">
            Voltar
        </a>
    </div>

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nome" class="block text-gray-700 font-medium mb-2">Nome do Produto</label>
            <input type="text" name="nome" id="nome" value="{{ old('nome', $product->nome) }}" required
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('nome') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="category_id" class="block text-gray-700 font-medium mb-2">Categoria</label>
            <select name="category_id" id="category_id" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->nome }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label for="preco" class="block text-gray-700 font-medium mb-2">Preço (R$)</label>
                <input type="number" step="0.01" name="preco" id="preco" value="{{ old('preco', $product->preco) }}" required
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('preco') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="estoque" class="block text-gray-700 font-medium mb-2">Estoque</label>
                <input type="number" name="estoque" id="estoque" value="{{ old('estoque', $product->estoque) }}" required
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('estoque') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('products.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg transition">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">
                Atualizar Produto
            </button>
        </div>
    </form>
</div>
@endsection