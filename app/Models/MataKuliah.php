<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';

    public $timestamps = false;

    protected $fillable = [
                'id',
                'kode',
                'mata_kuliah',
                'sks',
                'keterangan'
            ];
}
