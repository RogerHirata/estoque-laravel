<?php

namespace App\Livewire\Customers;

use App\Models\Customer;
use Livewire\Component;

class CustomerSearch extends Component
{
    public string $search = '';

    public function render()
    {
        $customers = Customer::query()
            ->when(trim($this->search) !== '', function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . trim($this->search) . '%')
                      ->orWhere('email', 'like', '%' . trim($this->search) . '%')
                      ->orWhere('phone', 'like', '%' . trim($this->search) . '%');
                });
            })
            ->orderBy('id')
            ->get();

        return view('livewire.customers.customer-search', [
            'customers' => $customers,
        ]);
    }
}
