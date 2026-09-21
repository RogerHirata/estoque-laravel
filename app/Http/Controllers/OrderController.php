<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['customer', 'items.product'])->latest()->get(); //[cite: 10]
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $products = Product::where('estoque', '>', 0)->get();
        return view('orders.create', compact('customers', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'product_id'  => 'required|exists:products,id',
            'quantity'    => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->estoque < $request->quantity) {
            return back()->withErrors(['quantity' => 'Quantidade em estoque insuficiente. Disponível: ' . $product->estoque])->withInput();
        }

        DB::transaction(function () use ($request, $product) {
            $total = $product->preco * $request->quantity;

            $order = Order::create([
                'customer_id'  => $request->customer_id,
                'valor_total' => $total,
                'status'       => 'completed',
            ]);

            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $product->id,
                'quantidade'   => $request->quantity,
                'preco_unitario'      => $product->preco,
            ]);

            // Baixa automática no estoque
            $product->decrement('estoque', $request->quantity);
        });

        return redirect()->route('orders.index')->with('success', 'Pedido realizado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Pedido excluído com sucesso!');
    }
}
