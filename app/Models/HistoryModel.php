<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryModel extends Model
{
    protected $table            = 'history';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = [
        'tanggal',
        'akurasi',
        'total_data',
        'confusion_matrix',
        'classification_report',
        'class_probabilities'
    ];
}
