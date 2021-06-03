<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    //
    protected $fillable = [
        'nama_sekolah',
        'kode_sekolah',
        'nama_kepala',
    ];
}
