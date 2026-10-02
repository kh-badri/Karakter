<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KarakterModel;

class DataKarakter extends BaseController
{
    protected $karakterModel;

    public function __construct()
    {
        $this->karakterModel = new KarakterModel();
    }

    public function index()
    {
        $data = [
            'title'       => 'Dataset Karakteristik Siswa',
            'dataset'     => $this->karakterModel->getAllData(),
            'active_menu' => 'data_karakter'
        ];

        return view('data_karakter/index', $data);
    }

    // 1. FITUR INPUT MANUAL
    public function save()
    {
        // Validasi Input
        $rules = [
            'nama_siswa'       => 'required',
            'bersosialisasi'   => 'required|numeric|greater_than[0]|less_than[6]',
            'berpendapat'      => 'required|numeric|greater_than[0]|less_than[6]',
            'kestabilan_emosi' => 'required|numeric|greater_than[0]|less_than[6]',
            'kedisiplinan'     => 'required|numeric|greater_than[0]|less_than[6]',
            'kepedulian'       => 'required|numeric|greater_than[0]|less_than[6]',
            'kebersihan'       => 'required|numeric|greater_than[0]|less_than[6]',
            'label_karakter'   => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->to('/data-karakter')->withInput()->with('error', 'Validasi gagal. Pastikan semua nilai diisi dengan benar (1-5).');
        }

        // Simpan ke Database
        $this->karakterModel->save([
            'nama_siswa'       => $this->request->getPost('nama_siswa'),
            'bersosialisasi'   => $this->request->getPost('bersosialisasi'),
            'berpendapat'      => $this->request->getPost('berpendapat'),
            'kestabilan_emosi' => $this->request->getPost('kestabilan_emosi'),
            'kedisiplinan'     => $this->request->getPost('kedisiplinan'),
            'kepedulian'       => $this->request->getPost('kepedulian'),
            'kebersihan'       => $this->request->getPost('kebersihan'),
            'label_karakter'   => $this->request->getPost('label_karakter'),
        ]);

        return redirect()->to('/data-karakter')->with('success', 'Data siswa berhasil ditambahkan manual!');
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
            return redirect()->to('/data-karakter')->withInput()->with('error', $this->validator->getErrors()['file_csv']);
        }

        $file = $this->request->getFile('file_csv');
        if (!$file->isValid() || $file->hasMoved()) {
            return redirect()->to('/data-karakter')->with('error', 'Terjadi masalah saat membaca file.');
        }

        // B. Baca File
        $filePath = $file->getRealPath();
        $fileContent = file($filePath);
        $csvData = array_map('str_getcsv', $fileContent);

        // Hapus Header
        if (count($csvData) > 0) {
            array_shift($csvData);
        }

        $dataToInsert = [];
        $insertedCount = 0;

        foreach ($csvData as $row) {
            // Pastikan baris memiliki minimal 8 kolom
            if (count($row) < 8) {
                continue;
            }

            // MAPPING DATA CSV KE DATABASE
            $dataToInsert[] = [
                'nama_siswa'       => trim($row[0]),
                'bersosialisasi'   => trim($row[1]),
                'berpendapat'      => trim($row[2]),
                'kestabilan_emosi' => trim($row[3]),
                'kedisiplinan'     => trim($row[4]),
                'kepedulian'       => trim($row[5]),
                'kebersihan'       => trim($row[6]),
                'label_karakter'   => trim($row[7]),
            ];
        }

        // C. Insert Batch (Sekaligus banyak)
        if (!empty($dataToInsert)) {
            try {
                $insertedCount = $this->karakterModel->insertBatch($dataToInsert);
            } catch (\Exception $e) {
                return redirect()->to('/data-karakter')->with('error', 'Error Database: ' . $e->getMessage());
            }
        }

        return redirect()->to('/data-karakter')->with('success', "Import Selesai! {$insertedCount} data berhasil masuk.");
    }

    // 3. FITUR HAPUS SEMUA (Reset Data)
    public function hapusSemua()
    {
        try {
            $this->karakterModel->emptyTable();
            // Reset Auto Increment agar id kembali ke 1
            $this->karakterModel->query("ALTER TABLE data_karakter AUTO_INCREMENT = 1");
            return redirect()->to('/data-karakter')->with('success', "Semua data berhasil dihapus (Reset).");
        } catch (\Exception $e) {
            return redirect()->to('/data-karakter')->with('error', 'Gagal reset: ' . $e->getMessage());
        }
    }

    public function update($id)
    {
        if (!$this->validate([
            'nama_siswa'       => 'required',
            'bersosialisasi'   => 'required|numeric',
            'berpendapat'      => 'required|numeric',
            'kestabilan_emosi' => 'required|numeric',
            'kedisiplinan'     => 'required|numeric',
            'kepedulian'       => 'required|numeric',
            'kebersihan'       => 'required|numeric',
            'label_karakter'   => 'required'
        ])) {
            return redirect()->to('/data-karakter')->with('error', 'Validasi gagal. Cek kembali inputan.');
        }

        $this->karakterModel->update($id, [
            'nama_siswa'       => $this->request->getPost('nama_siswa'),
            'bersosialisasi'   => $this->request->getPost('bersosialisasi'),
            'berpendapat'      => $this->request->getPost('berpendapat'),
            'kestabilan_emosi' => $this->request->getPost('kestabilan_emosi'),
            'kedisiplinan'     => $this->request->getPost('kedisiplinan'),
            'kepedulian'       => $this->request->getPost('kepedulian'),
            'kebersihan'       => $this->request->getPost('kebersihan'),
            'label_karakter'   => $this->request->getPost('label_karakter'),
        ]);

        return redirect()->to('/data-karakter')->with('success', 'Data berhasil diperbarui.');
    }

    // 4. FITUR HAPUS PER ITEM
    public function delete($id = null)
    {
        $this->karakterModel->delete($id);
        return redirect()->to('/data-karakter')->with('success', 'Data berhasil dihapus.');
    }
}
