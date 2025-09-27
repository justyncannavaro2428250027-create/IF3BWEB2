<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['nama', 'kode','kategori_id'];
    public function menu(){
        return $this->belongsTo(Menu::class,'kategori_id','id');
    }
}
