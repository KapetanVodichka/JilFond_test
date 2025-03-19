<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function store()
    {
        $user = Auth::user();
        $cartProducts = CartProduct::where('user_id', $user->id)->with('product')->get();

        if ($cartProducts->isEmpty()) {
            return redirect()->back()->with('error', 'Корзина пуста');
        }

        $total = $cartProducts->sum(fn($item) => $item->product->price * $item->quantity);

        if ($user->balance < $total) {
            return redirect()->back()->with('error', 'Недостаточно средств на балансе');
        }

        DB::transaction(function () use ($user, $cartProducts, $total) {
            $user->balance -= $total;
            $user->save();

            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $total,
            ]);

            foreach ($cartProducts as $item) {
                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            CartProduct::where('user_id', $user->id)->delete();
        });

        return redirect()->route('orders.index')->with('success', 'Заказ успешно оформлен');
    }

    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)
            ->with('orderProducts.product')
            ->get();
        $totalOrdersPrice = $orders->sum('total_price');

        return view('orders.index', compact('orders', 'totalOrdersPrice'));
    }

    public function destroy(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Недостаточно прав');
        }

        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Заказ удален');
    }
}

