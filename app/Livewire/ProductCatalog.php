<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Data\ProductData;
use App\Models\Product;
use Livewire\Component;

class ProductCatalog extends Component
{
    public function render()
    {
        $result = Product::paginate(9);

        $products = ProductData::collect($result);

        return view('livewire.product-catalog', compact('products'));
    }
}
