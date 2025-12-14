<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryModel extends Model
{
    protected $table            = 'history_prediksi';
    protected $primaryKey       = 'id';
    protected $allowedFields = ['alpha', 'periode_target', 'hasil_prediksi', 'mape', 'akurasi', 'tanggal_simpan', 'detail_json'];
}
