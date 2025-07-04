<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Tampilkan isi keranjang pembeli
    public function index()
    {
        $carts = Cart::with('menu')
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->get();

        return view('cart.index', compact('carts'));
    }

    // Tambah menu ke keranjang
    public function addToCart(Request $request, Menu $menu)
    {
        $request->validate([
            'quantity' => 'nullable|integer|min:1',
        ]);

        $quantity = $request->input('quantity', 1);

        $cart = Cart::where('user_id', Auth::id())
            ->where('menu_id', $menu->id)
            ->where('status', 'pending')
            ->first();

        if ($cart) {
            $cart->increment('quantity', $quantity);
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'menu_id' => $menu->id,
                'quantity' => $quantity,
                'status' => 'pending',
            ]);
        }

        return redirect()->back()->with('success', 'Menu berhasil ditambahkan ke keranjang!');
    }

    // Checkout pesanan (langsung simpan ke orders dan order_items dengan metode pembayaran)
    public function checkout(Request $request)
    {
        $request->validate([
            'payment_type' => 'required|in:qris,cash',
        ]);

        $userId = Auth::id();

        $carts = Cart::with('menu')
            ->where('user_id', $userId)
            ->where('status', 'pending')
            ->get();

        if ($carts->isEmpty()) {
            return redirect()->back()->with('error', 'Keranjang kamu kosong!');
        }

        // Hitung total harga
        $total = $carts->sum(function ($cart) {
            return $cart->menu->price * $cart->quantity;
        });

        // Simpan order
        $order = Order::create([
            'user_id' => $userId,
            'total_price' => $total,
            'payment_type' => $request->payment_type,
            'status' => 'pending', // Bisa diganti jadi 'menunggu konfirmasi' kalau mau
        ]);

        // Simpan item satu per satu ke order_items
        foreach ($carts as $cart) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $cart->menu_id,
                'quantity' => $cart->quantity,
                'price' => $cart->menu->price,
            ]);
        }

        // Hapus semua cart yang sudah dipesan
        Cart::where('user_id', $userId)
            ->where('status', 'pending')
            ->delete();

        return redirect()->route('cart.index')->with('success', 'Pesanan berhasil dikonfirmasi!');
    }

    // Hapus item dari keranjang
    public function destroy($id)
    {
        $cart = Cart::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('status', 'pending')
            ->firstOrFail();

        $cart->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}
