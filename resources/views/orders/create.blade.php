@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto bg-white p-6 rounded-xl shadow-md border border-gray-100">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Novo Pedido</h2>
        <a href="{{ route('orders.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded-lg transition">Voltar</a>
    </div>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="customer_id" class="block text-gray-700 font-medium mb-2">Cliente</label>
            <select name="customer_id" id="customer_id" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                <option value="" disabled selected>Selecione um cliente...</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                        {{ $customer->name }} ({{ $customer->email }})
                    </option>
                @endforeach
            </select>
            @error('customer_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="product_id" class="block text-gray-700 font-medium mb-2">Produto</label>
            <select name="product_id" id="product_id" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                <option value="" disabled selected>Selecione um produto...</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->name }} - R$ {{ number_format($product->preco, 2, ',', '.') }} (Estoque: {{ $product->estoque }})
                    </option>
                @endforeach
            </select>
            @error('product_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label for="quantity" class="block text-gray-700 font-medium mb-2">Quantidade</label>
            <input type="number" name="quantity" id="quantity" value="{{ old('quantity', 1) }}" min="1" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('quantity') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="flex justify-end gap-2">
            <a href="{{ route('orders.index') }}" class="bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium py-2 px-4 rounded-lg transition">Cancelar</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">Finalizar Pedido</button>
        </div>
    </form>
</div>
@endsection