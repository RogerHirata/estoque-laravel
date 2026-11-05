<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;

class ProductSearch extends Component
{
    public string $search = '';

    public function render()
    {
        $products = Product::with('category')
            ->when($this->search, function ($query) {
                $query->where(
                    'name',
                    'like',
                    '%' . $this->search . '%'
                );
            })
            ->orderBy('id')
            ->get();

        return view('livewire.products.product-search', [
            'products' => $products,
        ]);
    }
}