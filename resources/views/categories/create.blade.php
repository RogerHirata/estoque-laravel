@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold text-gray-700 mb-6">Cadastrar Nova Categoria</h2>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="nome" class="block text-gray-700 font-bold mb-2">Nome da Categoria:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500">
        </div>

        <div class="flex justify-end space-x-3">
            <a href="{{ route('categories.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                Cancelar
            </a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Salvar Categoria
            </button>
        </div>
    </form>
</div>
@endsection