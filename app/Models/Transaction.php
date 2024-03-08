<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = 'transactions';
    public $fillable = [
        'product_id',
        'price',
        'status',
        'snap_token',
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'product_id', 'id');
    }
}
