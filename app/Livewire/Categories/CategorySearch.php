<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Component;
class CategorySearch extends Component
{
    public string $search = '';

    public function render()
    {
        $categories = Category::query()
            ->when(trim($this->search) !== '', function ($query) {
                $query->where(
                    'name',
                    'like',
                    '%' . trim($this->search) . '%'
                );
            })
            ->orderBy('id')
            ->get();

        return view('livewire.categories.category-search', [
            'categories' => $categories,
        ]);
    }
}
