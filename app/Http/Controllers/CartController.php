<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\CartLine;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller{
    protected $cartService;

    public function __construct(CartService $cartService){
        $this->cartService = $cartService;
    }

    public function index(){
        $cart = $this->cartService->getCartWithItems();

        return view('cart.index', compact('cart'));
    }

    public function add(Request $request, Item $item){
        $request->validate([
            'quantity' => 'sometimes|integer|min:1',
        ]);

        $quantity = $request->input('quantity', 1);

        if ($item->quantity < $quantity) {
            return redirect()->back()
                ->with('error', 'Not enough stock available.');
        }

        $this->cartService->addItem($item, $quantity);

        return redirect()->route('cart.index')
            ->with('success', "{$item->name} added to cart.");
    }

    public function update(Request $request, CartLine $cartLine){
        $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        $quantity = $request->input('quantity');

        if ($quantity > $cartLine->item->quantity) {
            return redirect()->back()
                ->with('error', 'Not enough stock available.');
        }

        $this->cartService->updateQuantity($cartLine, $quantity);

        return redirect()->route('cart.index')
            ->with('success', 'Cart updated.');
    }

    public function remove(CartLine $cartLine){
        $this->cartService->removeItem($cartLine);

        return redirect()->route('cart.index')
            ->with('success', 'Item removed from cart.');
    }

    public function clear(){
        $this->cartService->clear();

        return redirect()->route('cart.index')
            ->with('success', 'Cart cleared.');
    }
}