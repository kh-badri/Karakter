<?php

namespace App\Controllers;

use App\Models\NikahModel;
use App\Models\HistoryModel;

class Home extends BaseController
{
    protected $nikahModel;
    protected $historyModel;

    public function __construct()
    {
        $this->nikahModel = new NikahModel();
        $this->historyModel = new HistoryModel();
    }

    public function index()
    {
        // 1. Ambil Statistik
        $totalData = $this->nikahModel->countAll();
        $totalHistory = $this->historyModel->countAll();

        // Ambil riwayat terakhir untuk ditampilkan di card
        $lastHistory = $this->historyModel->orderBy('id', 'DESC')->first();

        // 2. Ambil Data untuk Grafik (Tren Data Aktual)
        $grafikData = $this->nikahModel->getOrderedData();
        $labels = [];
        $values = [];

        foreach ($grafikData as $d) {
            $dateObj = \DateTime::createFromFormat('!m', $d['bulan']);
            $labels[] = $dateObj->format('M') . ' ' . $d['tahun'];
            $values[] = $d['jumlah_nikah'];
        }

        // 3. Ambil 5 Riwayat Terakhir untuk Tabel Mini
        $recentHistory = $this->historyModel->orderBy('id', 'DESC')->findAll(5);

        $data = [
            'title' => 'Dashboard Utama',
            'active_menu' => 'home',
            'total_data' => $totalData,
            'total_history' => $totalHistory,
            'last_prediksi' => $lastHistory ? $lastHistory['hasil_prediksi'] : 0,
            'last_target' => $lastHistory ? $lastHistory['periode_target'] : '-',
            'chart_labels' => $labels,
            'chart_values' => $values,
            'recent_history' => $recentHistory
        ];

        return view('home/index', $data);
    }
}
