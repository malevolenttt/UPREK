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
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($order->id); ?></td>
                        <td><?php echo e($order->customer_name); ?></td>
                        <td><?php echo e($order->table_number); ?></td>
                        <td>@currency($order->total_price)</td>
                        <td><?php echo e($order->created_at->format('d M Y H:i')); ?></td>
                        <td>
                            <ul>
                                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <?php echo e($item->menu->name); ?> (x<?php echo e($item->quantity); ?>)
                                        - @currency($item->subtotal)
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

</body>
</html>
<?php /**PATH C:\Users\Nur Zaman\magied_tes\resources\views/orders/index.blade.php ENDPATH**/ ?>