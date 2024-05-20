<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    function orderItems()
    {
        return $this->hasMany(OrderItems::class)->with('product:id,title');
    }
}
