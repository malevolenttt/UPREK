<?php

namespace App\Helpers;

class CurrencyHelper
{
    public static function format($amount)
    {
        // Rp 25.000 style
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}
