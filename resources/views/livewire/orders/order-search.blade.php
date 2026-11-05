
<div>
    <!-- Cabeçalho -->
    <div class="flex flex-col md:flex-row md:items-center gap-4 mb-6 border-b pb-4">

        <h2 class="text-2xl font-bold text-gray-800 md:mr-auto">
            Pedidos
        </h2>

        <!-- Pesquisa Livewire -->
        <div class="relative w-full md:w-80">
            <svg
                class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="m21 21-4.35-4.35M19 11a8 8 0 1 1-16 0 8 8 0 0 1 16 0Z"/>
            </svg>

            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="Pedido, cliente, item, total ou data..."
                class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg bg-gray-50 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
            >
        </div>

        <!-- Novo Pedido -->
        <a href="{{ route('orders.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg shadow-sm transition inline-flex items-center justify-center gap-2 whitespace-nowrap">

            <svg class="w-5 h-5"
                 fill="none"
                 stroke="currentColor"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 4v16m8-8H4"/>
            </svg>

            Novo Pedido
        </a>
    </div>

    <!-- Tabela de Pedidos -->
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
                    <tr wire:key="order-{{ $order->id }}"
                        class="hover:bg-gray-50 transition duration-150">

                        <!-- ID -->
                        <td class="py-3 px-4 text-center font-bold text-gray-500">
                            #{{ $order->id }}
                        </td>

                        <!-- Cliente -->
                        <td class="py-3 px-4 text-gray-800 font-medium">
                            {{ $order->customer->name ?? 'Cliente Removido' }}
                        </td>

                        <!-- Itens -->
                        <td class="py-3 px-4 text-gray-600 text-sm">
                            @foreach($order->items as $item)
                                <div class="mb-1">
                                    {{ $item->quantidade }}x
                                    {{ $item->product->name ?? 'Produto' }}

                                    <span class="text-gray-400">
                                        (R$ {{ number_format($item->preco_unitario, 2, ',', '.') }})
                                    </span>
                                </div>
                            @endforeach
                        </td>

                        <!-- Total -->
                        <td class="py-3 px-4 text-center font-bold text-gray-800">
                            R$ {{ number_format($order->valor_total, 2, ',', '.') }}
                        </td>

                        <!-- Data -->
                        <td class="py-3 px-4 text-center text-gray-500 text-sm whitespace-nowrap">
                            {{ $order->created_at->format('d/m/Y H:i') }}
                        </td>

                        <!-- Ações -->
                        <td class="py-3 px-4 text-center">
                            <form action="{{ route('orders.destroy', $order->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Deseja excluir este pedido?');">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white text-xs font-semibold px-3 py-1.5 rounded transition">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6"
                            class="py-8 text-center text-gray-400">
                            Nenhum pedido encontrado.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Indicador da pesquisa -->
    <div wire:loading wire:target="search"
         class="mt-3 text-sm text-blue-600">
        Pesquisando pedidos...
    </div>
</div>
