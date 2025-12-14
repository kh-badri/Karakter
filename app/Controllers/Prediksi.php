<?php

namespace App\Controllers;

use App\Models\NikahModel;
use App\Models\HistoryModel;

class Prediksi extends BaseController
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
        $data = [
            'title' => 'Halaman Prediksi',
            'active_menu' => 'prediksi',
        ];
        return view('prediksi/index', $data);
    }

    public function proses()
    {
        // 1. Ambil Input Alpha
        $alpha = $this->request->getPost('alpha');

        // 2. Ambil Data Aktual Terurut
        $dataset = $this->nikahModel->getOrderedData();

        if (empty($dataset)) {
            return redirect()->to('/prediksi')->with('error', 'Data latih kosong. Silakan input data nikah terlebih dahulu.');
        }

        // 3. LOGIKA SINGLE EXPONENTIAL SMOOTHING (SES)
        $hasilPerhitungan = [];
        $mapeTotal = 0;
        $jumlahData = count($dataset);

        // Inisialisasi: F1 = X1 (Prediksi pertama = Data aktual pertama)
        $prediksiSebelumnya = $dataset[0]['jumlah_nikah'];

        foreach ($dataset as $key => $row) {
            $aktual = $row['jumlah_nikah'];

            // Hitung Error (Hanya jika bukan data pertama, karena data pertama error=0)
            // Rumus APE: |(Aktual - Prediksi) / Aktual| * 100
            $error = 0;
            if ($aktual != 0) {
                $error = abs(($aktual - $prediksiSebelumnya) / $aktual) * 100;
            }

            // Simpan data untuk tabel
            $hasilPerhitungan[] = [
                'tahun' => $row['tahun'],
                'bulan' => $row['bulan'],
                'aktual' => $aktual,
                'prediksi' => $prediksiSebelumnya, // Ft
                'error' => $error
            ];

            $mapeTotal += $error;

            // Hitung Prediksi Periode Berikutnya (Ft+1) untuk iterasi selanjutnya
            // Rumus: Ft+1 = alpha * Xt + (1-alpha) * Ft
            $prediksiBaru = ($alpha * $aktual) + ((1 - $alpha) * $prediksiSebelumnya);

            // Update variabel penampung
            $prediksiSebelumnya = $prediksiBaru;
        }

        // 4. HASIL AKHIR (Prediksi Masa Depan)
        // Nilai $prediksiSebelumnya sekarang berisi ramalan untuk bulan setelah data terakhir
        $prediksiNext = round($prediksiSebelumnya);

        // Hitung Rata-rata Error (MAPE)
        $mape = $jumlahData > 0 ? $mapeTotal / $jumlahData : 0;
        $akurasi = 100 - $mape;

        // Tentukan Nama Bulan/Tahun Target
        $lastData = end($dataset);
        $lastBulan = $lastData['bulan'];
        $lastTahun = $lastData['tahun'];

        $nextBulanAngka = $lastBulan == 12 ? 1 : $lastBulan + 1;
        $nextTahun = $lastBulan == 12 ? $lastTahun + 1 : $lastTahun;

        $dateObj = \DateTime::createFromFormat('!m', $nextBulanAngka);
        $periodeTarget = $dateObj->format('F') . " " . $nextTahun;

        $data = [
            'title' => 'Hasil Prediksi',
            'alpha' => $alpha,
            'hasil_tabel' => $hasilPerhitungan,
            'prediksi_next' => $prediksiNext,
            'mape' => round($mape, 2),
            'akurasi' => round($akurasi, 2),
            'periode_target' => $periodeTarget,
            // Data untuk Grafik Chart.js
            'chart_labels' => array_map(function ($d) {
                return $d['bulan'] . '-' . $d['tahun'];
            }, $hasilPerhitungan),
            'chart_aktual' => array_column($hasilPerhitungan, 'aktual'),
            'chart_prediksi' => array_column($hasilPerhitungan, 'prediksi')
        ];

        return view('prediksi/hasil', $data);
    }

    public function simpan()
    {
        $this->historyModel->save([
            'alpha'          => $this->request->getPost('alpha'),
            'periode_target' => $this->request->getPost('periode_target'),
            'hasil_prediksi' => $this->request->getPost('hasil_prediksi'),
            'mape'           => $this->request->getPost('mape'),
            'akurasi'        => $this->request->getPost('akurasi'),
            // Simpan data JSON dari input hidden
            'detail_json'    => $this->request->getPost('detail_json'),
        ]);

        return redirect()->to('/history')->with('success', 'Hasil prediksi berhasil disimpan ke History!');
    }
}
