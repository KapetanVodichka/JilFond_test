<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Models\CartProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(AddToCartRequest $request)
    {
        $user = Auth::user();
        $product = Product::find($request->product_id);

        if (!$product) {
            return back()->with('error', 'Продукт не найден');
        }

        $cartProduct = CartProduct::firstOrCreate(
            ['user_id' => $user->id, 'product_id' => $product->id],
            ['quantity' => 0]
        );
        $cartProduct->increment('quantity', $request->quantity);

        return redirect()->route('cart.index')->with('success', 'Товар добавлен в корзину');
    }

    public function index()
    {
        $user = Auth::user();
        $cartProducts = CartProduct::where('user_id', $user->id)->with('product')->get();
        $total = $cartProducts->sum(fn($item) => $item->product->price * $item->quantity);

        return view('cart.index', compact('cartProducts', 'total'));
    }
}
