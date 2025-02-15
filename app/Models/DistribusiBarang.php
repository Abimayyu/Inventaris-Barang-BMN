<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistribusiBarang extends Model
{
    use HasFactory;
    protected $table = 'distribusi_barang';
    protected $guarded = ['id'];
    public $timestamps = false;

   
    public function detailDistribusi()
    {
        return $this->hasMany(DetailDistribusiBarang::class, 'id_distribusi', 'id');
    }
    public function dataLokasi()
    {
        return $this->belongsTo(Lokasi::class, 'ruangan');
    }
}
