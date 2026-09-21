@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-md border border-gray-100">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Cadastrar Novo Produto</h2>
        <a href="{{ route('products.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition">
            Voltar
        </a>
    </div>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Nome do Produto</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

         <div class="mb-4">
            <label for="category_id" class="block text-gray-700 font-medium mb-2">Categoria</label>
            <select name="category_id" id="category_id" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                <option value="" disabled selected>Selecione uma categoria...</option>
                
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }} {{-- <<--- AQUI: alterado de 'nome' para 'name' --}}
                    </option>
                @endforeach
            </select>
            @error('category_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label for="preco" class="block text-gray-700 font-medium mb-2">Preço (R$)</label>
                <input type="number" step="0.01" name="preco" id="preco" value="{{ old('preco') }}" required
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="0.00">
                @error('preco') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="estoque" class="block text-gray-700 font-medium mb-2">Estoque Inicial</label>
                <input type="number" name="estoque" id="estoque" value="{{ old('estoque', 0) }}" required
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                @error('estoque') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('products.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg transition">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">
                Salvar Produto
            </button>
        </div>
    </form>
</div>
@endsection