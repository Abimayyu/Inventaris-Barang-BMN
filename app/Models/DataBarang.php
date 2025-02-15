<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBarang extends Model
{
    use HasFactory;
    protected $table = 'data_barang';
    protected $guarded = ['id'];
    public $timestamps = false;

    public function unitVerif()
    {
        return $this->hasMany(DetailDataBarang::class, 'id_data_barang', 'id')->where('status', 1);
    }

    public function unitNonVerif()
    {
        return $this->hasMany(DetailDataBarang::class, 'id_data_barang', 'id')->where('status', 0);
    }

    public function allUnit()
    {
        return $this->hasMany(DetailDataBarang::class, 'id_data_barang', 'id');
    }

}
