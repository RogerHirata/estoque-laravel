<?php

namespace App\Livewire\Orders;

use App\Models\Order;
use Livewire\Component;
use Carbon\Carbon;

class OrderSearch extends Component
{
    public string $search = '';

    public function render()
    {
        $search = trim($this->search);

        $orders = Order::with(['customer', 'items.product'])
            ->when($search !== '', function ($query) use ($search) {

                $query->where(function ($q) use ($search) {

                    // 1. Pesquisar pelo ID do pedido
                    if (ctype_digit($search)) {
                        $q->orWhere('id', (int) $search);
                    }

                    // 2. Pesquisar pelo nome do cliente
                    $q->orWhereHas('customer', function ($customer) use ($search) {
                        $customer->where(
                            'name',
                            'like',
                            '%' . $search . '%'
                        );
                    });

                    // 3. Pesquisar pelos produtos do pedido
                    $q->orWhereHas('items.product', function ($product) use ($search) {
                        $product->where(
                            'name',
                            'like',
                            '%' . $search . '%'
                        );
                    });

                    // 4. Pesquisar pelo valor total
                    // Aceita 150,00 ou 150.00
                    $valor = str_replace(',', '.', $search);

                    if (preg_match('/^\d+(\.\d{1,2})?$/', $valor)) {
                        $q->orWhere('valor_total', (float) $valor);
                    }

                    // 5. Pesquisar pela data brasileira
                    // Formato: 22/10/2026
                    try {
                        $data = Carbon::createFromFormat('!d/m/Y', $search);

                        if ($data && $data->format('d/m/Y') === $search) {
                            $q->orWhereDate(
                                'created_at',
                                $data->format('Y-m-d')
                            );
                        }
                    } catch (\Exception $e) {
                        // Pesquisa não é uma data válida
                    }

                    // 6. Pesquisar pela data e horário
                    // Formato: 22/10/2026 14:30
                    try {
                        $dataHora = Carbon::createFromFormat(
                            '!d/m/Y H:i',
                            $search
                        );

                        if ($dataHora &&
                            $dataHora->format('d/m/Y H:i') === $search) {

                            $q->orWhereBetween('created_at', [
                                $dataHora->copy()->startOfMinute(),
                                $dataHora->copy()->endOfMinute()
                            ]);
                        }
                    } catch (\Exception $e) {
                        // Pesquisa não é uma data e hora válida
                    }

                });
            })
            ->orderByDesc('id')
            ->get();

        return view('livewire.orders.order-search', [
            'orders' => $orders,
        ]);
    }
}
