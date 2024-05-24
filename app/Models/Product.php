<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'produk';

    public function category()
    {
        return $this->belongsTo(Category::class,'id_kategori','id');
    }
    // public function cart()
    // {
    //     return $this->hasMany(Cart::class);
    // }

}
