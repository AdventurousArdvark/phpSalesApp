<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\CartLine;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class CartService{
    public function getOrCreateCart(){
        return Cart::firstOrCreate(['user_id' => Auth::id()]);
    }

    public function addItem(Item $item, int $quantity = 1){
        $cart = $this->getOrCreateCart();
        $cartLine = $cart->cartLines()->where('item_id', $item->id)->first();

        if ($cartLine) {
            $cartLine->update([
                'quantity' => $cartLine->quantity + $quantity,
            ]);
        } else {
            $cart->cartLines()->create([
                'item_id' => $item->id,
                'quantity' => $quantity,
            ]);
        }

        return $cart->fresh('cartLines.item');
    }

    public function updateQuantity(CartLine $cartLine, int $quantity){
        if ($quantity <= 0) {
            $cartLine->delete();
        } else {
            $cartLine->update(['quantity' => $quantity]);
        }
 
        return $this->getOrCreateCart()->fresh('cartLines.item');
    }

    public function removeItem(CartLine $cartLine){
        $cartLine->delete();

        return $this->getOrCreateCart()->fresh('cartLines.item');
    }

    public function clear(){
        $cart = $this->getOrCreateCart();
        $cart->cartLines()->delete();

        return $cart;
    }

    public function getCartWithItems(){
        return $this->getOrCreateCart()->load('cartLines.item');
    }

    public function getItemCount(){
        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart) {
            return 0;
        }

        return $cart->cartLines()->sum('quantity');
    }
}