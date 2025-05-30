<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    //
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'nama_barang',
        'harga_pcs',
        'harga_2pcs',
        'jenis_barang',
        'foto_barang',
        'deleted_at'
    ];
}