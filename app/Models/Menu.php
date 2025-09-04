<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['name', 'category', 'price', 'description'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}

