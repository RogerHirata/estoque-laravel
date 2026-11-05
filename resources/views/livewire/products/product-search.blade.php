
<div>
    <!-- Cabeçalho -->
    <div class="flex flex-col md:flex-row md:items-center gap-4 mb-6 border-b pb-4">

        <h2 class="text-2xl font-bold text-gray-800 md:mr-auto">
            Produtos
        </h2>

        <!-- Pesquisa -->
        <div class="relative w-full md:w-80">
            <svg
                class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2"
                      d="m21 21-4.35-4.35M19 11a8 8 0 1 1-16 0 8 8 0 0 1 16 0Z"/>
            </svg>

            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Pesquisar produtos..."
                class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg bg-gray-50 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
            >
        </div>

        <!-- Novo Produto -->
        <a href="{{ route('products.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg shadow-sm transition inline-flex items-center justify-center gap-2 whitespace-nowrap">

            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>

            Novo Produto
        </a>
    </div>

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
                    <tr wire:key="product-{{ $product->id }}"
                        class="hover:bg-gray-50 transition duration-150">

                        <td class="py-3 px-4 text-center font-bold text-gray-500">
                            #{{ $product->id }}
                        </td>

                        <td class="py-3 px-4 text-gray-800 font-medium">
                            {{ $product->name }}
                        </td>

                        <td class="py-3 px-4">
                            <span class="bg-gray-100 text-gray-700 text-xs font-semibold px-2.5 py-1 rounded border border-gray-200">
                                {{ $product->category->name ?? 'Sem Categoria' }}
                            </span>
                        </td>

                        <td class="py-3 px-4 text-center text-gray-800 font-bold">
                            R$ {{ number_format($product->preco, 2, ',', '.') }}
                        </td>

                        <td class="py-3 px-4 text-center">
                            <span class="{{ $product->estoque > 0 ? 'text-green-600 font-bold' : 'text-red-500 font-bold' }}">
                                {{ $product->estoque }}
                            </span>
                        </td>

                        <td class="py-3 px-4 text-center">
                            <div class="flex justify-center items-center gap-2">

                                <a href="{{ route('products.edit', $product->id) }}"
                                   class="bg-amber-500 hover:bg-amber-600 text-white text-xs font-semibold px-3 py-1.5 rounded transition">
                                    Editar
                                </a>

                                <form action="{{ route('products.destroy', $product->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Deseja excluir este produto?');">

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
                            Nenhum produto encontrado.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
