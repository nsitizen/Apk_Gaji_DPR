<?php

namespace App\Models;

use CodeIgniter\Model;

class KomponenGajiModel extends Model
{
    protected $table            = 'komponen_gaji';
    protected $primaryKey       = 'id_komponen_gaji';
    protected $allowedFields    = [
        'id_komponen_gaji',
        'nama_komponen',
        'kategori',
        'jabatan',
        'nominal',
        'satuan'
    ];
}