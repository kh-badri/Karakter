<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DatasetModel;

class Dataset extends BaseController
{
    protected $datasetModel;

    public function __construct()
    {
        $this->datasetModel = new DatasetModel();
    }

    public function index()
    {
        $data = [
            'title'   => 'Manajemen Data Latih (Dataset Motor Honda)',
            'dataset' => $this->datasetModel->findAll(),
            'active_menu' => 'dataset'
        ];

        return view('dataset/index', $data);
    }

    public function save()
    {
        // Validasi Sesuai Kategori yang disepakati (Rendah/Sedang/Tinggi, dll)
        $rules = [
            'usia'                  => 'required|in_list[Muda,Dewasa,Tua]',
            'pekerjaan'             => 'required', // Teks bebas atau bisa dibatasi list
            'penghasilan'           => 'required|in_list[Rendah,Sedang,Tinggi]',
            'frekuensi'             => 'required|in_list[Jarang,Sedang,Sering]',
            'total_transaksi'       => 'required|in_list[Rendah,Sedang,Tinggi]',
            'jenis_motor'           => 'required',
            'tingkat_pembelian'     => 'required|in_list[Rendah,Sedang,Tinggi]', // Target
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/dataset')->withInput()->with('error', 'Validasi gagal. Pastikan input sesuai kategori.');
        }

        // Simpan ke Database
        $this->datasetModel->save([
            'usia'                  => $this->request->getPost('usia'),
            'pekerjaan'             => $this->request->getPost('pekerjaan'),
            'penghasilan_rata_rata' => $this->request->getPost('penghasilan'),
            'frekuensi_pembelian'   => $this->request->getPost('frekuensi'),
            'total_nilai_transaksi' => $this->request->getPost('total_transaksi'),
            'jenis_motor'           => $this->request->getPost('jenis_motor'),
            'tingkat_pembelian'     => $this->request->getPost('tingkat_pembelian'),
        ]);

        return redirect()->to('/dataset')->with('success', 'Data berhasil ditambahkan!');
    }

    public function upload()
    {
        // 1. Validasi File
        $validationRule = [
            'dataset_csv' => [
                'label' => 'File CSV',
                'rules' => 'uploaded[dataset_csv]|ext_in[dataset_csv,csv]|max_size[dataset_csv,2048]',
            ],
        ];

        if (!$this->validate($validationRule)) {
            return redirect()->to('/dataset')->withInput()->with('error', $this->validator->getErrors()['dataset_csv']);
        }

        $file = $this->request->getFile('dataset_csv');
        if (!$file->isValid() || $file->hasMoved()) {
            return redirect()->to('/dataset')->with('error', 'Terjadi masalah saat mengupload file.');
        }

        // 2. Baca File
        $filePath = $file->getRealPath();
        $fileContent = file($filePath);
        $csvData = array_map('str_getcsv', $fileContent);

        // Hapus Header (Baris pertama: Usia, Pekerjaan, dll)
        array_shift($csvData);

        $dataToInsert = [];
        $insertedCount = 0;

        foreach ($csvData as $row) {
            // Pastikan baris memiliki minimal 7 kolom
            if (count($row) < 7) {
                continue;
            }

            // MAPPING DATA CSV KE DATABASE
            // Urutan Index [0] s/d [6] sesuai output script Python sebelumnya
            $dataToInsert[] = [
                'usia'                  => trim($row[0]), // Kolom 1
                'pekerjaan'             => trim($row[1]), // Kolom 2
                'penghasilan_rata_rata' => trim($row[2]), // Kolom 3
                'frekuensi_pembelian'   => trim($row[3]), // Kolom 4
                'total_nilai_transaksi' => trim($row[4]), // Kolom 5
                'jenis_motor'           => trim($row[5]), // Kolom 6
                'tingkat_pembelian'     => trim($row[6]), // Kolom 7 (Target)
            ];
        }

        // 3. Insert Batch
        if (!empty($dataToInsert)) {
            try {
                $insertedCount = $this->datasetModel->insertBatch($dataToInsert);
            } catch (\Exception $e) {
                return redirect()->to('/dataset')->with('error', 'Error Database: ' . $e->getMessage());
            }
        }

        return redirect()->to('/dataset')->with('success', "Import Selesai! {$insertedCount} data berhasil masuk.");
    }

    public function hapusSemua()
    {
        // ... (Kode sama persis dengan contoh Anda) ...
        // Agar hemat tempat, logika hapusSemua sama seperti yang Anda kirim
        try {
            $this->datasetModel->emptyTable();
            $this->datasetModel->db->query("ALTER TABLE dataset AUTO_INCREMENT = 1");
            return redirect()->to('/dataset')->with('success', "Semua data berhasil dihapus.");
        } catch (\Exception $e) {
            return redirect()->to('/dataset')->with('error', 'Gagal hapus: ' . $e->getMessage());
        }
    }

    public function delete($id = null)
    {
        // ... (Kode sama persis dengan contoh Anda) ...
        $this->datasetModel->delete($id);
        return redirect()->to('/dataset')->with('success', 'Data berhasil dihapus.');
    }
}
