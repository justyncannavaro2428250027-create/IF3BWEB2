<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
        protected $fillable = ['nama', 'kode'];
    public function kategori(){
        return $this->hasMany(Kategori::class);
}
}
