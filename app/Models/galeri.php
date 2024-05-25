<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class galeri extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $primaryKey = 'id_galeri';
    
    public function product()
    {
        return $this->hasMany(Produk::class);
    }
}
