<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderHistoryController extends Controller
{
    // Tampilkan riwayat pesanan user
    public function index()
    {
        $orders = Order::with('items.menu')
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        return view('orders.history', compact('orders'));
    }

    // Fitur pesan kembali (copy item dari order ke cart)
    public function reorder(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        foreach ($order->items as $item) {
            $cart = Cart::where('user_id', Auth::id())
                ->where('menu_id', $item->menu_id)
                ->where('status', 'pending')
                ->first();

            if ($cart) {
                $cart->increment('quantity', $item->quantity);
            } else {
                Cart::create([
                    'user_id' => Auth::id(),
                    'menu_id' => $item->menu_id,
                    'quantity' => $item->quantity,
                    'status' => 'pending',
                ]);
            }
        }

        return redirect()->route('cart.index')->with('success', 'Menu berhasil ditambahkan kembali ke keranjang!');
    }
}
