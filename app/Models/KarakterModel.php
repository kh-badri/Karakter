<?php

namespace App\Models;

use CodeIgniter\Model;

class KarakterModel extends Model
{
    protected $table            = 'data_karakter';
    protected $primaryKey       = 'id';
    protected $allowedFields    = [
        'nama_siswa', 
        'bersosialisasi', 
        'berpendapat', 
        'kestabilan_emosi', 
        'kedisiplinan', 
        'kepedulian', 
        'kebersihan', 
        'label_karakter'
    ];
    protected $useTimestamps    = true; // created_at dan updated_at otomatis terisi

    // Fungsi untuk mengambil semua data
    public function getAllData()
    {
        return $this->orderBy('id', 'ASC')->findAll();
    }

    // Fungsi untuk mengosongkan tabel (Truncate)
    public function emptyTable()
    {
        return $this->db->table($this->table)->truncate();
    }
}
