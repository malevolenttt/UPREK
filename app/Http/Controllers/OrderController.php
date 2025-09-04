<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = \App\Models\Order::with('items.menu')->latest()->get();

        return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'table_number' => 'required|integer',
            'items' => 'required|array',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $order = Order::create([
            'customer_name' => $request->customer_name,
            'table_number' => $request->table_number,
            'total_price' => 0,
        ]);

        $total = 0;
        foreach ($request->items as $item) {
            $menu = Menu::find($item['menu_id']);
            $subtotal = $menu->price * $item['quantity'];
            $total += $subtotal;

            $order->items()->create([
                'menu_id' => $menu->id,
                'quantity' => $item['quantity'],
                'subtotal' => $subtotal,
            ]);
        }

        $order->update(['total_price' => $total]);

        return $order->load('items.menu');
    }
}

