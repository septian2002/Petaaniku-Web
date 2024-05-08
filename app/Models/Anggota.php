<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Anggota extends Model
{
    protected $table = 'anggota';

    protected $fillable = [
        'nama_anggota',
        'alamat',
        'username',
        'email',
        // 'password'
    ];

    // public function setPasswordAttribute($password)
    // {
    //     $this->attributes['password'] = Hash::make($password);
    // }
}