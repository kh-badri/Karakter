<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\HistoryModel;

class Analisis extends BaseController
{
    protected $historyModel;
    protected $db;
    protected $session;

    // --- KONFIGURASI PYTHON ---
    // Sesuaikan path python di komputer Anda
    // Windows XAMPP contoh: "C:\\Users\\User\\AppData\\Local\\Programs\\Python\\Python311\\python.exe"
    // Linux/Mac contoh: "python3"
    protected $pythonCommand = 'python';

    public function __construct()
    {
        $this->historyModel = new HistoryModel();
        $this->db = \Config\Database::connect();
        $this->session = session();
    }

    public function index()
    {
        $data = [
            'title'       => 'Analisis Prediksi Naive Bayes',
            'active_menu' => 'analisis'
        ];
        return view('analisis/index', $data);
    }

    public function proses()
    {
        try {
            // [PERUBAHAN DI SINI] 
            // Mengarah ke folder: writable/python/run_analysis_nb.py
            $scriptPath = WRITEPATH . 'python' . DIRECTORY_SEPARATOR . 'run_analysis_nb.py';

            // Validasi keberadaan file
            if (!file_exists($scriptPath)) {
                throw new \Exception("File script Python tidak ditemukan di: " . $scriptPath . "<br>Pastikan Anda sudah menyimpannya di folder 'writable/python/'.");
            }

            // Siapkan Argumen Database
            $dbHost = escapeshellarg($this->db->hostname);
            $dbUser = escapeshellarg($this->db->username);
            $dbPass = escapeshellarg($this->db->password);
            $dbName = escapeshellarg($this->db->database);

            // Jalankan Perintah
            $command = "{$this->pythonCommand} \"{$scriptPath}\" {$dbHost} {$dbUser} {$dbPass} {$dbName} 2>&1";

            $output = [];
            $returnCode = 0;
            exec($command, $output, $returnCode);

            $rawOutput = implode("\n", $output);

            if ($returnCode !== 0) {
                throw new \Exception("Gagal menjalankan script Python.<br>Error: " . nl2br($rawOutput));
            }

            // Decode JSON
            $hasil = json_decode($rawOutput, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception("Output Python bukan JSON valid.<br>Output: " . nl2br($rawOutput));
            }

            if (isset($hasil['status']) && $hasil['status'] === 'error') {
                throw new \Exception("Error Logic Python: " . $hasil['message']);
            }

            // Simpan sementara ke session
            $this->session->set('hasil_analisis_temp', $hasil);

            $data = [
                'title'       => 'Hasil Analisis Naive Bayes',
                'active_menu' => 'analisis',
                'hasil'       => $hasil
            ];

            return view('analisis/hasil', $data);
        } catch (\Exception $e) {
            return redirect()->to('/analisis')->with('error', $e->getMessage());
        }
    }

    public function simpan()
    {
        $hasil = $this->session->get('hasil_analisis_temp');

        if (!$hasil) {
            return redirect()->to('/analisis')->with('error', 'Data tidak ditemukan (Session expired). Ulangi analisis.');
        }

        try {
            $dataSimpan = [
                'tanggal'               => date('Y-m-d H:i:s'),
                'akurasi'               => $hasil['evaluasi']['accuracy'],
                'total_data'            => $hasil['evaluasi']['total_data'],
                'confusion_matrix'      => json_encode($hasil['evaluasi']['confusion_matrix']),
                'classification_report' => json_encode($hasil['evaluasi']['classification_report']),
                'class_probabilities'   => json_encode($hasil['analisis']['class_probabilities'])
            ];

            $this->historyModel->insert($dataSimpan);
            $this->session->remove('hasil_analisis_temp');

            return redirect()->to('/history')->with('success', 'Berhasil disimpan ke Riwayat!');
        } catch (\Exception $e) {
            return redirect()->to('/analisis')->with('error', 'Gagal database: ' . $e->getMessage());
        }
    }
}
