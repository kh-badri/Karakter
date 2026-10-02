<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HistoryModel;

class History extends BaseController
{
    protected $historyModel;

    public function __construct()
    {
        $this->historyModel = new HistoryModel();
    }

    public function index()
    {
        $data = [
            'title'   => 'Riwayat Hasil Klasifikasi',
            'active_menu' => 'history',
            'riwayat' => $this->historyModel->orderBy('id', 'DESC')->findAll()
        ];
        return view('history/index', $data);
    }

    public function detail($id)
    {
        $riwayat = $this->historyModel->find($id);

        if (!$riwayat) {
            return redirect()->to('/history')->with('error', 'Data tidak ditemukan.');
        }

        // Kita gunakan ulang fungsi klasifikasi untuk menjabarkan rinciannya
        $klasifikasi = new \App\Controllers\Klasifikasi();
        
        // Load KarakterModel manual karena di-load di base controller Klasifikasi
        $db = \Config\Database::connect();
        $dataset = $db->table('data_karakter')->get()->getResultArray();

        $nb_results = $klasifikasi->calculateNaiveBayes($dataset, $riwayat);
        $rf_results = $klasifikasi->calculateRandomForest($dataset, $riwayat, 5);

        $data = [
            'title'          => 'Detail Riwayat Klasifikasi',
            'active_menu'    => 'history',
            'input'          => $riwayat,
            'nb_results'     => $nb_results,
            'rf_results'     => $rf_results,
            'is_history'     => true
        ];

        return view('klasifikasi/hasil', $data);
    }

    public function delete($id)
    {
        $this->historyModel->delete($id);
        return redirect()->to('/history')->with('success', 'Data riwayat berhasil dihapus.');
    }

    public function hapusSemua()
    {
        $this->historyModel->truncate();
        return redirect()->to('/history')->with('success', 'Seluruh riwayat berhasil dibersihkan.');
    }
}
