@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded-xl shadow-md border border-gray-100">
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Pedidos</h2>
        <a href="{{ route('orders.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg shadow-sm transition flex items-center gap-1">
            + Novo Pedido
        </a>
    </div>

    @if(session('success'))
        <div id="alert-message" class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm flex justify-between items-center">
            <p class="font-medium">{{ session('success') }}</p>
            <button onclick="document.getElementById('alert-message').remove()" class="text-green-700 font-bold px-2">&times;</button>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-sm uppercase font-semibold">
                    <th class="py-3 px-4 text-center w-16">ID</th>
                    <th class="py-3 px-4">Cliente</th>
                    <th class="py-3 px-4">Itens</th>
                    <th class="py-3 px-4 text-center">Total</th>
                    <th class="py-3 px-4 text-center">Data</th>
                    <th class="py-3 px-4 text-center w-32">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($orders as $order)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="py-3 px-4 text-center font-bold text-gray-500">#{{ $order->id }}</td>
                        <td class="py-3 px-4 text-gray-800 font-medium">{{ $order->customer->name ?? 'Cliente Removido' }}</td>
                        <td class="py-3 px-4 text-gray-600 text-sm">
                           @foreach($order->items as $item)
                                <div>{{ $item->quantidade }}x {{ $item->product->name ?? 'Produto' }} (R$ {{ number_format($item->preco_unitario, 2, ',', '.') }})</div>
                            @endforeach
                        </td>
                        <td class="py-3 px-4 text-center font-bold text-gray-800">R$ {{ number_format($order->valor_total, 2, ',', '.') }}</td>
                        <td class="py-3 px-4 text-center text-gray-500 text-sm">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                        <td class="py-3 px-4 text-center">
                            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Deseja excluir este pedido?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-xs font-semibold px-3 py-1.5 rounded transition">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-gray-400">Nenhum pedido realizado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection