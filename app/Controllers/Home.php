<?php

namespace App\Controllers;

use App\Models\DatasetModel;
use App\Models\HistoryModel;

class Home extends BaseController
{
    protected $datasetModel;
    protected $historyModel;

    public function __construct()
    {
        $this->datasetModel = new DatasetModel();
        $this->historyModel = new HistoryModel();
    }

    public function index()
    {
        // 1. Ambil Statistik Dasar
        $totalData = $this->datasetModel->countAll();
        $totalRiwayat = $this->historyModel->countAll();

        // 2. Ambil Akurasi Terakhir (jika ada)
        // Pastikan nama kolom 'tanggal' atau 'created_at' sesuai database history Anda
        $lastAnalysis = $this->historyModel->orderBy('id', 'DESC')->first();

        $latestAccuracy = 0;
        $lastUpdate = '-';

        if ($lastAnalysis) {
            $latestAccuracy = round($lastAnalysis['akurasi'] * 100, 1);
            $lastUpdate = date('d M Y', strtotime($lastAnalysis['tanggal']));
        }

        $data = [
            'title'          => 'Dashboard Utama',
            'active_menu'    => 'home',
            'total_data'     => $totalData,
            'total_riwayat'  => $totalRiwayat,
            'latest_accuracy' => $latestAccuracy,
            'last_update'    => $lastUpdate
        ];

        return view('home/index', $data);
    }
}
