<?php

namespace App\Models;

use CodeIgniter\Model;

class NikahModel extends Model
{
    protected $table            = 'data_nikah';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['tahun', 'bulan', 'jumlah_nikah'];
    protected $useTimestamps    = true; // Agar created_at otomatis terisi

    // Fungsi khusus untuk mengambil data terurut (Penting untuk Time Series)
    public function getOrderedData()
    {
        return $this->orderBy('tahun', 'ASC')
            ->orderBy('bulan', 'ASC')
            ->findAll();
    }

    // Fungsi untuk mengosongkan tabel (Truncate)
    public function emptyTable()
    {
        return $this->truncate();
    }
}
