<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\NikahModel;

class DataNikah extends BaseController
{
    protected $nikahModel;

    public function __construct()
    {
        $this->nikahModel = new NikahModel();
    }

    public function index()
    {
        $data = [
            'title'       => 'Data Historis Pernikahan',
            // Menggunakan getOrderedData agar urutan tahun/bulan rapi
            'dataset'     => $this->nikahModel->getOrderedData(),
            'active_menu' => 'data_nikah'
        ];

        return view('data_nikah/index', $data);
    }

    // 1. FITUR INPUT MANUAL
    public function save()
    {
        // Validasi Input
        $rules = [
            'tahun'        => 'required|numeric|exact_length[4]',
            'bulan'        => 'required|numeric|greater_than[0]|less_than[13]',
            'jumlah_nikah' => 'required|numeric'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/data-nikah')->withInput()->with('error', 'Validasi gagal. Pastikan Tahun (4 digit) dan Bulan (1-12) benar.');
        }

        // Simpan ke Database
        $this->nikahModel->save([
            'tahun'        => $this->request->getPost('tahun'),
            'bulan'        => $this->request->getPost('bulan'),
            'jumlah_nikah' => $this->request->getPost('jumlah_nikah'),
        ]);

        return redirect()->to('/data-nikah')->with('success', 'Data berhasil ditambahkan manual!');
    }

    // 2. FITUR IMPORT CSV
    public function upload()
    {
        // A. Validasi File
        $validationRule = [
            'file_csv' => [
                'label' => 'File CSV',
                'rules' => 'uploaded[file_csv]|ext_in[file_csv,csv]|max_size[file_csv,2048]',
            ],
        ];

        if (!$this->validate($validationRule)) {
            return redirect()->to('/data-nikah')->withInput()->with('error', $this->validator->getErrors()['file_csv']);
        }

        $file = $this->request->getFile('file_csv');
        if (!$file->isValid() || $file->hasMoved()) {
            return redirect()->to('/data-nikah')->with('error', 'Terjadi masalah saat membaca file.');
        }

        // B. Baca File
        $filePath = $file->getRealPath();
        $fileContent = file($filePath);
        $csvData = array_map('str_getcsv', $fileContent);

        // Hapus Header (Baris pertama: tahun, bulan, jumlah)
        // Asumsi CSV punya header. Jika CSV polos tanpa header, hapus baris ini.
        if (count($csvData) > 0) {
            array_shift($csvData);
        }

        $dataToInsert = [];
        $insertedCount = 0;

        foreach ($csvData as $row) {
            // Pastikan baris memiliki minimal 3 kolom (Tahun, Bulan, Jumlah)
            if (count($row) < 3) {
                continue;
            }

            // MAPPING DATA CSV KE DATABASE
            $dataToInsert[] = [
                'tahun'        => trim($row[0]), // Kolom 1 di CSV
                'bulan'        => trim($row[1]), // Kolom 2 di CSV
                'jumlah_nikah' => trim($row[2]), // Kolom 3 di CSV
            ];
        }

        // C. Insert Batch (Sekaligus banyak agar cepat)
        if (!empty($dataToInsert)) {
            try {
                $insertedCount = $this->nikahModel->insertBatch($dataToInsert);
            } catch (\Exception $e) {
                return redirect()->to('/data-nikah')->with('error', 'Error Database: ' . $e->getMessage());
            }
        }

        return redirect()->to('/data-nikah')->with('success', "Import Selesai! {$insertedCount} data berhasil masuk.");
    }

    // 3. FITUR HAPUS SEMUA (Reset Data)
    public function hapusSemua()
    {
        try {
            $this->nikahModel->emptyTable();
            // Reset Auto Increment agar id kembali ke 1
            $this->nikahModel->query("ALTER TABLE data_nikah AUTO_INCREMENT = 1");
            return redirect()->to('/data-nikah')->with('success', "Semua data berhasil dihapus (Reset).");
        } catch (\Exception $e) {
            return redirect()->to('/data-nikah')->with('error', 'Gagal reset: ' . $e->getMessage());
        }
    }

    // 4. FITUR HAPUS PER ITEM
    public function delete($id = null)
    {
        $this->nikahModel->delete($id);
        return redirect()->to('/data-nikah')->with('success', 'Data berhasil dihapus.');
    }
}
