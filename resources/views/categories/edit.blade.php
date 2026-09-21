@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-md border border-gray-100">
    <!-- Cabeçalho -->
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Editar Categoria</h2>
        <a href="{{ route('categories.index') }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition duration-150 ease-in-out">
            Voltar
        </a>
    </div>

    <!-- Formulário de Edição -->
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="nome" class="block text-gray-700 font-medium mb-2">Nome da Categoria</label>
            <input type="text" 
                   name="nome" 
                   id="nome" 
                   value="{{ old('nome', $category->nome) }}" 
                   class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('nome') border-red-500 @enderror" 
                   placeholder="Ex: Eletrônicos">

            <!-- Mensagem de Erro de Validação -->
            @error('nome')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('categories.index') }}" 
               class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg transition">
                Cancelar
            </a>
            <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">
                Atualizar Categoria
            </button>
        </div>
    </form>
</div>
@endsection