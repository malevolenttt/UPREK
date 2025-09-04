<!DOCTYPE html>
<html>
<head>
    <title>Restaurant Menu</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 2rem; }
        table { border-collapse: collapse; width: 100%; margin-bottom: 2rem; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background: #f4f4f4; }
        .success { background: #d4edda; padding: 10px; margin-bottom: 20px; border: 1px solid #c3e6cb; color: #155724; }
    </style>
</head>
<body>

    <h1>Restaurant Menu</h1>

    <?php if(session('success')): ?>
        <div class="success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <form method="POST" action="/orders">
        <?php echo csrf_field(); ?>
        <label>Customer Name:</label>
        <input type="text" name="customer_name" required>
        <br><br>
        <label>Table Number:</label>
        <input type="number" name="table_number" required>
        <br><br>

        <table>
            <thead>
                <tr>
                    <th>Menu Item</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($menu->name); ?></td>
                        <td><?php echo e($menu->category); ?></td>
                        <td><?php echo e(\App\Helpers\CurrencyHelper::format($menu->price)); ?></td>
                        <td>
                            <input type="number" name="items[<?php echo e($menu->id); ?>]" min="0" value="0">
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <button type="submit">Place Order</button>
    </form>

</body>
</html>
<?php /**PATH C:\Users\Nur Zaman\magied_tes\resources\views/menu.blade.php ENDPATH**/ ?>