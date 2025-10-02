<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['nama', 'kode','kategori_id'];
    public function kategori(){
        return $this->belongsTo(Kategori::class,'kategori_id','id');
    }

}