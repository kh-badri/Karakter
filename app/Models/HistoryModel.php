<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryModel extends Model
{
    protected $table            = 'history_klasifikasi';
    protected $primaryKey       = 'id';
    protected $allowedFields = [
        'nama_siswa', 'bersosialisasi', 'berpendapat', 
        'kestabilan_emosi', 'kedisiplinan', 'kepedulian', 
        'kebersihan', 'hasil_nb', 'hasil_rf', 'tanggal_simpan'
    ];
}
