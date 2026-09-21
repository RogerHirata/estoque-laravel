@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto bg-white p-6 rounded-xl shadow-md border border-gray-100">
    <!-- Cabeçalho -->
    <div class="flex justify-between items-center mb-6 border-b pb-4">
        <h2 class="text-2xl font-bold text-gray-800">Produtos</h2>
        <a href="{{ route('products.create') }}" 
           class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg shadow-sm transition duration-150 ease-in-out flex items-center gap-1">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Novo Produto
        </a>
    </div>

    <!-- Alerta de Sucesso -->
    @if(session('success'))
        <div id="alert-message" class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm flex justify-between items-center transition-opacity duration-500">
            <p class="font-medium">{{ session('success') }}</p>
            <button onclick="document.getElementById('alert-message').remove()" class="text-green-700 font-bold px-2">&times;</button>
        </div>

        <script>
            setTimeout(() => {
                const alert = document.getElementById('alert-message');
                if (alert) {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 500);
                }
            }, 3000);
        </script>
    @endif

    <!-- Tabela de Produtos -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 text-sm uppercase font-semibold">
                    <th class="py-3 px-4 text-center w-16">ID</th>
                    <th class="py-3 px-4">Nome</th>
                    <th class="py-3 px-4">Categoria</th>
                    <th class="py-3 px-4 text-center">Preço</th>
                    <th class="py-3 px-4 text-center">Estoque</th>
                    <th class="py-3 px-4 text-center w-48">Ações</th>
                </tr>
            </thead>
           <tbody class="divide-y divide-gray-100">
                @forelse($products as $product)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="py-3 px-4 text-center font-bold text-gray-500">
                            #{{ $product->id }}
                        </td>
                        
                        {{-- Nome do Produto: mudado de 'nome' para 'name' --}}
                        <td class="py-3 px-4 text-gray-800 font-medium">
                            {{ $product->name }}
                        </td>
                        
                        {{-- Nome da Categoria: mudado de 'nome' para 'name' --}}
                        <td class="py-3 px-4">
                            <span class="bg-gray-100 text-gray-700 text-xs font-semibold px-2.5 py-1 rounded border border-gray-200">
                                {{ $product->category->name ?? 'Sem Categoria' }}
                            </span>
                        </td>
                        
                        {{-- Preço --}}
                        <td class="py-3 px-4 text-center text-gray-800 font-bold">
                            R$ {{ number_format($product->preco, 2, ',', '.') }}
                        </td>
                        
                        {{-- Estoque --}}
                        <td class="py-3 px-4 text-center">
                            <span class="{{ $product->estoque > 0 ? 'text-green-600 font-bold' : 'text-red-500 font-bold' }}">
                                {{ $product->estoque }}
                            </span>
                        </td>
                        
                        {{-- Ações --}}
                        <td class="py-3 px-4 text-center">
                            <div class="flex justify-center items-center gap-2">
                                <a href="{{ route('products.edit', $product->id) }}" 
                                class="bg-amber-500 hover:bg-amber-600 text-white text-xs font-semibold px-3 py-1.5 rounded transition">
                                    Editar
                                </a>

                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Deseja excluir este produto?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-600 hover:bg-red-700 text-white text-xs font-semibold px-3 py-1.5 rounded transition">
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-8 text-center text-gray-400">
                            Nenhum produto cadastrado.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection