<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\MataKuliah;

class Program extends Model
{
    // use HasFactory;

    protected $table = 'program';

    // public $timestamps = false;

    protected $fillable = [
                'id',
                'kode',
                'program',
                'id_mata_kuliah',
                'semester',
                'tahun_ajaran',
                'keterangan'
            ];


    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'id_mata_kuliah');
    }
}
