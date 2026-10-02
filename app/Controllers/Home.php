<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Home extends BaseController
{
    public function index()
    {
        $karakterModel = new \App\Models\KarakterModel();
        $historyModel = new \App\Models\HistoryModel();

        // Get total data
        $totalDataset = $karakterModel->countAllResults();
        $totalRiwayat = $historyModel->countAllResults();

        // Get recent history
        $recentRiwayat = $historyModel->orderBy('id', 'DESC')->findAll(3);

        $data = [
            'title' => 'Dashboard Utama',
            'active_menu' => 'home',
            'total_dataset' => $totalDataset,
            'total_riwayat' => $totalRiwayat,
            'recent_riwayat' => $recentRiwayat
        ];

        return view('home/index', $data);
    }
}
