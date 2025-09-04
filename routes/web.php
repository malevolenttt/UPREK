<?php

use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;

Route::get('/', function () {
    $menus = Menu::all();
    return view('menu', compact('menus'));
});

Route::post('/orders', function (Request $request) {
    $request->validate([
        'customer_name' => 'required|string',
        'table_number' => 'required|integer',
        'items' => 'required|array',
        'items.*' => 'integer|min:1',
    ]);

    $order = Order::create([
        'customer_name' => $request->customer_name,
        'table_number' => $request->table_number,
        'total_price' => 0,
    ]);

    $total = 0;
    foreach ($request->items as $menuId => $qty) {
        if ($qty > 0) {
            $menu = Menu::find($menuId);
            $subtotal = $menu->price * $qty;
            $total += $subtotal;

            $order->items()->create([
                'menu_id' => $menuId,
                'quantity' => $qty,
                'subtotal' => $subtotal,
            ]);
        }
    }

    $order->update(['total_price' => $total]);

    return redirect('/')->with('success', 'Order placed successfully!');
});

use App\Http\Controllers\OrderController;

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
