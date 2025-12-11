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
            'title'       => 'Riwayat Analisis Naive Bayes',
            'history'     => $this->historyModel->orderBy('tanggal', 'DESC')->findAll(),
            'active_menu' => 'history',
        ];

        return view('history/index', $data);
    }

    public function detail($id = null)
    {
        if ($id === null) {
            return redirect()->to('history')->with('error', 'ID tidak valid.');
        }

        $item = $this->historyModel->find($id);

        if (!$item) {
            return redirect()->to('history')->with('error', 'Data riwayat tidak ditemukan.');
        }

        try {
            // DECODE JSON DARI DATABASE
            // Kita kembalikan strukturnya mirip dengan output Python agar view bisa reuse kode

            $probs = json_decode($item['class_probabilities'], true);

            // Trik: Ambil nama kelas (Rendah, Sedang, Tinggi) dari keys probabilitas
            $classes = array_keys($probs);

            $hasil_rekonstruksi = [
                'status' => 'success',
                'evaluasi' => [
                    'accuracy'              => $item['akurasi'],
                    'total_data'            => $item['total_data'],
                    'confusion_matrix'      => json_decode($item['confusion_matrix'], true),
                    'classification_report' => json_decode($item['classification_report'], true),
                    'classes'               => $classes
                ],
                'analisis' => [
                    'class_probabilities' => $probs
                ]
            ];

            $data = [
                'title'   => 'Detail Riwayat',
                'tanggal' => $item['tanggal'],
                'hasil'   => $hasil_rekonstruksi
            ];

            return view('history/detail', $data);
        } catch (\Exception $e) {
            return redirect()->to('history')->with('error', 'Data korup/error: ' . $e->getMessage());
        }
    }

    public function delete($id = null)
    {
        if ($id === null) return redirect()->to('history');

        $this->historyModel->delete($id);
        return redirect()->to('history')->with('success', 'Data riwayat berhasil dihapus.');
    }
}
