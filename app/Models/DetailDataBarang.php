<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDataBarang extends Model
{
    use HasFactory;
    protected $table = 'detail_data_barang';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function dataBarang()
    {
        return $this->belongsTo(DataBarang::class, 'id_data_barang');
    }

    public function dataLokasi()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi');
    }

    public function kondisi()
    {
        return $this->belongsTo(Kondisi::class, 'kondisi_barang');
    }

    public function dataPeminjaman()
    {
        return $this->hasMany(DetailPeminjaman::class, 'id_barang', 'id');
    }
    public function dataDistribusi()
    {
        return $this->hasMany(DetailDistribusiBarang::class, 'id_barang', 'id');
    }
}
