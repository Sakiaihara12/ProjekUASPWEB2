<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.menu')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('orders.history', compact('orders'));
    }

    public function reorder(Order $order)
    {
        foreach ($order->items as $item) {
            \App\Models\Cart::create([
                'user_id' => Auth::id(),
                'menu_id' => $item->menu_id,
                'quantity' => $item->quantity,
                'status' => 'pending',
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Pesanan berhasil dimasukkan kembali ke keranjang!');
    }
}
