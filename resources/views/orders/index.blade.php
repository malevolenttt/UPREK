<!DOCTYPE html>
<html>
<head>
    <title>Orders List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">

    <div class="container">
        <h1 class="mb-4">Orders List</h1>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Table Number</th>
                    <th>Total Price</th>
                    <th>Created At</th>
                    <th>Items</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>{{ $order->table_number }}</td>
                        <td>@currency($order->total_price)</td>
                        <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                        <td>
                            <ul>
                                @foreach ($order->items as $item)
                                    <li>
                                        {{ $item->menu->name }} (x{{ $item->quantity }})
                                        - @currency($item->subtotal)
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
