<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['nama', 'kode'];
    public function menu(){
        return $this->hasMany(Menu::class);
}
}