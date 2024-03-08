<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kerangjang extends Model
{
    use HasFactory;
    protected $table = 'keranjang';
    protected $fillable = ['barang_id', 'jumlah'];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'barang_id', 'id');
    }
}
