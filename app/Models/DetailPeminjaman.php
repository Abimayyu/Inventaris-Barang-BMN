<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeminjaman extends Model
{
    use HasFactory;
    protected $table = 'detail_data_peminjaman';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function dataBarang()
    {
        return $this->belongsTo(DetailDataBarang::class, 'id_barang');
    }

    public function dataPeminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman');
    }
}
