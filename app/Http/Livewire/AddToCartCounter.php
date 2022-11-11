<?php

namespace App\Http\Livewire;

use App\Models\AddToCart;
use Illuminate\Support\Facades\Auth;
use Jenssegers\Agent\Agent;
use Livewire\Component;

class AddToCartCounter extends Component
{
    public $cardCount = 0;

    protected $listeners = ['updateAddToCartCount' => 'getAddToCartProductCount'];

    public function getAddToCartProductCount()
    {
        $agent = new Agent();

        $this->cardCount = Auth::check() ? AddToCart::whereUserId(auth()->user()->id)
            ->where('status', '!=', \constPayPalStatus::SUCCESS)
            ->count() : AddToCart::whereBrowserName($agent->browser())
            ->where('status', '!=', \constPayPalStatus::SUCCESS)
            ->count();
    }

    public function render()
    {
        $this->getAddToCartProductCount();

        return view('livewire.add-to-cart-counter');
    }
}
