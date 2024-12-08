<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $table = 'pesanan';

    protected $guarded = [
        'id',
        'user_id',
        'produk_id',
        'bayar_id',
    ];

    public function users() {
        return $this -> belongsTo(User::class);
    }
    public function produk() {
        return $this -> belongsTo(Produk::class);
    }
    public function bayar() {
        return $this -> belongsTo(Bayar::class);
    }
}
