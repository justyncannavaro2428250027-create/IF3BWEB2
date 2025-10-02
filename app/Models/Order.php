<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['kode_order', 'payment_method','total_price','menu_id'];
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }
}