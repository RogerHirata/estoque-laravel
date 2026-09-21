@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-md border border-gray-100">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Cadastrar Novo Cliente</h2>
        <a href="{{ route('customers.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition">Voltar</a>
    </div>

    <form action="{{ route('customers.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Nome</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-medium mb-2">E-mail</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label for="phone" class="block text-gray-700 font-medium mb-2">Telefone</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('customers.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg transition">Cancelar</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">Salvar Cliente</button>
        </div>
    </form>
</div>
@endsection