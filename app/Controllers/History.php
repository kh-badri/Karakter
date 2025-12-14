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
            'title'   => 'Riwayat Prediksi',
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

        // Decode JSON kembali menjadi Array
        $hasil_tabel = json_decode($riwayat['detail_json'], true);

        // Siapkan data untuk Chart
        $chart_labels = [];
        $chart_aktual = [];
        $chart_prediksi = [];

        if ($hasil_tabel) {
            foreach ($hasil_tabel as $row) {
                $chart_labels[] = $row['bulan'] . '-' . $row['tahun'];
                $chart_aktual[] = $row['aktual'];
                $chart_prediksi[] = $row['prediksi'];
            }
        }

        $data = [
            'title'          => 'Detail Riwayat',
            'alpha'          => $riwayat['alpha'],
            'periode_target' => $riwayat['periode_target'],
            'prediksi_next'  => $riwayat['hasil_prediksi'],
            'mape'           => $riwayat['mape'],
            'akurasi'        => $riwayat['akurasi'],
            'tanggal_simpan' => $riwayat['tanggal_simpan'],
            'hasil_tabel'    => $hasil_tabel,
            'chart_labels'   => $chart_labels,
            'chart_aktual'   => $chart_aktual,
            'chart_prediksi' => $chart_prediksi
        ];

        return view('history/detail', $data);
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
