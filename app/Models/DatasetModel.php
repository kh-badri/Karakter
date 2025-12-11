<?php

namespace App\Models;

use CodeIgniter\Model;

class DatasetModel extends Model
{
    protected $table            = 'dataset';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'usia',
        'pekerjaan',
        'penghasilan_rata_rata',
        'frekuensi_pembelian',
        'total_nilai_transaksi',
        'jenis_motor',
        'tingkat_pembelian'
    ];
}
