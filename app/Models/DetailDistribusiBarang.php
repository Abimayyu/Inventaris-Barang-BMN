<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDistribusiBarang extends Model
{
    use HasFactory;
    protected $table = 'detail_distribusi_barang';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function dataBarang()
    {
        return $this->belongsTo(DetailDataBarang::class, 'id_barang');
    }
    public function dataDistribusi()
    {
        return $this->belongsTo(DistribusiBarang::class, 'id_distribusi');
    }
}
