<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['id_transaksi', 'menu_id'];
    public function order()
    {
        return $this->belongsTo(Order::class, 'menu_id', 'id');
    }
}
