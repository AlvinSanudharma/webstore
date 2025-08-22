<?php

namespace App\Livewire;

use App\Contract\CartServiceInterface;
use Illuminate\Support\Collection;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Cart extends Component
{
    public string $sub_total;

    public string $total;

    public function mount(CartServiceInterface $cart)
    {
        $all = $cart->all();

        $this->sub_total = $all->total_formatted;
        $this->total = $this->sub_total;
    }

    #[Computed]
    public function items(): Collection
    {
        $cart = app(CartServiceInterface::class);

        return $cart->all()->items->toCollection();
    }

    public function render()
    {
        return view('livewire.cart',);
    }
}
