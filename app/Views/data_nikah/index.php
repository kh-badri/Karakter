<?php helper('form'); ?>
<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="min-h-screen bg-[#EAEAEA] py-10 px-4 font-sans text-gray-800">
    <div class="container mx-auto max-w-7xl">

        <div class="flex flex-col md:flex-row justify-between items-end mb-6 gap-4">
            <div>
                <h1 class="text-4xl text-[#2DAA9E] font-bold tracking-tight"><?= $title ?></h1>
                <p class="text-gray-600 font-semibold mt-1 text-lg">Sistem Peramalan Jumlah Pernikahan (Time Series - SES)</p>
            </div>

            <div class="bg-white border-r-4 border-[#2DAA9E] px-6 py-4 rounded-l-lg shadow-sm flex items-center gap-4">
                <div class="p-3 bg-[#66D2CE]/20 rounded-full text-[#2DAA9E]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <span class="block text-sm font-medium text-[#2DAA9E]">Total Data Historis</span>
                    <span class="text-3xl font-extrabold text-gray-800"><?= count($dataset) ?> <span class="text-sm font-normal text-gray-500">Bulan</span></span>
                </div>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="auto-dismiss-alert bg-[#66D2CE]/30 border-l-4 border-[#2DAA9E] text-gray-800 px-4 py-3 rounded shadow-sm mb-6 flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#2DAA9E]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-semibold"><?= session()->getFlashdata('success') ?></span>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="auto-dismiss-alert bg-red-100 border-l-4 border-red-600 text-red-800 px-4 py-3 rounded shadow-sm mb-6">
                <span class="font-bold">Perhatian:</span> <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-xl shadow-md border border-[#2DAA9E]/30 p-6 mb-8">
            <div class="flex items-center gap-2 mb-4 border-b border-[#E3D2C3] pb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#2DAA9E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h2 class="text-lg font-bold text-gray-800">Keterangan Variabel Time Series</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-[#E3D2C3]/30 p-4 rounded-lg border border-[#E3D2C3]">
                    <h3 class="font-bold text-sm uppercase text-[#2DAA9E] mb-2">Data Aktual (Xt)</h3>
                    <p class="text-sm text-gray-600">Jumlah angka pernikahan real yang tercatat pada bulan & tahun tertentu.</p>
                </div>
                <div class="bg-[#E3D2C3]/30 p-4 rounded-lg border border-[#E3D2C3]">
                    <h3 class="font-bold text-sm uppercase text-[#2DAA9E] mb-2">Alpha (α)</h3>
                    <p class="text-sm text-gray-600">Parameter pemulusan (0.1 - 0.9) untuk mengatur bobot data masa lalu.</p>
                </div>
                <div class="bg-[#E3D2C3]/30 p-4 rounded-lg border border-[#E3D2C3]">
                    <h3 class="font-bold text-sm uppercase text-[#2DAA9E] mb-2">Forecast (Ft)</h3>
                    <p class="text-sm text-gray-600">Nilai hasil ramalan sistem untuk periode berikutnya.</p>
                </div>
                <div class="bg-[#E3D2C3]/30 p-4 rounded-lg border border-[#E3D2C3]">
                    <h3 class="font-bold text-sm uppercase text-[#2DAA9E] mb-2">Error (MAPE)</h3>
                    <p class="text-sm text-gray-600">Nilai persentase kesalahan untuk mengukur akurasi prediksi.</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-5 rounded-t-xl border-b-2 border-[#E3D2C3] flex flex-wrap gap-4 justify-between items-center shadow-sm">
            <div class="flex gap-3">
                <button onclick="openModal('modalManual')" class="bg-[#2DAA9E] hover:bg-[#1f7a70] text-white px-6 py-2.5 rounded-lg font-bold transition-all shadow hover:shadow-md flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Tambah Data
                </button>
                <button onclick="openModal('modalUpload')" class="bg-[#66D2CE] hover:bg-[#2DAA9E] text-white hover:text-white px-6 py-2.5 rounded-lg font-bold transition-all shadow hover:shadow-md flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    Import CSV
                </button>
            </div>

            <form action="<?= base_url('data-nikah/hapus-semua') ?>" method="get" onsubmit="return confirm('PERINGATAN KERAS!\nSemua data akan dihapus permanen. Anda yakin?');">
                <button type="submit" class="text-gray-600 hover:bg-red-50 hover:text-red-700 hover:border-red-700 font-semibold px-4 py-2 border-2 border-gray-300 rounded-lg transition-all flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Reset Dataset
                </button>
            </form>
        </div>

        <div class="bg-white rounded-b-xl shadow-xl border border-[#E3D2C3] relative">
            <div class="overflow-x-auto overflow-y-auto h-[550px] custom-scrollbar">
                <table class="w-full text-left border-collapse relative">
                    <thead class="sticky top-0 z-10 shadow-md">
                        <tr class="bg-[#2DAA9E] text-white uppercase text-sm font-bold tracking-wider leading-normal">
                            <th class="p-5">No</th>
                            <th class="p-5">Tahun</th>
                            <th class="p-5">Bulan</th>
                            <th class="p-5 text-center">Jumlah Pernikahan</th>
                            <th class="p-5 text-center bg-[#1f7a70]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 font-medium">
                        <?php if (empty($dataset)) : ?>
                            <tr>
                                <td colspan="5" class="p-20 text-center bg-[#E3D2C3]/10 text-[#2DAA9E]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-4 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <p class="text-xl font-bold">Data Kosong</p>
                                    <p class="font-normal">Silakan tambahkan data manual atau import file CSV.</p>
                                </td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($dataset as $i => $d) : ?>
                                <tr class="border-b border-gray-100 hover:bg-[#66D2CE]/10 transition-colors duration-150">
                                    <td class="p-5 text-[#2DAA9E] font-bold"><?= $i + 1 ?></td>
                                    <td class="p-5"><?= $d['tahun'] ?></td>
                                    <td class="p-5">
                                        <?php
                                        // Konversi angka bulan ke nama bulan
                                        $dateObj   = DateTime::createFromFormat('!m', $d['bulan']);
                                        $namaBulan = $dateObj->format('F'); // Januari, Februari, dst (English default)
                                        echo $namaBulan . " (" . $d['bulan'] . ")";
                                        ?>
                                    </td>
                                    <td class="p-5 text-center">
                                        <span class="px-4 py-1.5 rounded-full text-sm font-extrabold shadow-sm bg-[#E3D2C3] text-gray-800 border border-[#E3D2C3]">
                                            <?= $d['jumlah_nikah'] ?> Pasang
                                        </span>
                                    </td>
                                    <td class="p-5 text-center">
                                        <a href="<?= base_url('data-nikah/delete/' . $d['id']) ?>" onclick="return confirm('Hapus data ini?');" class="text-[#2DAA9E] hover:text-red-600 p-2 transition-all inline-block">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="modalManual" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-80 transition-opacity" onclick="closeModal('modalManual')"></div>

        <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border-t-4 border-[#2DAA9E]">
            <div class="bg-[#2DAA9E] px-6 py-4 flex justify-between items-center">
                <h3 class="text-xl font-bold text-white">Input Data Manual</h3>
                <button onclick="closeModal('modalManual')" class="text-[#66D2CE] hover:text-white text-3xl leading-none">&times;</button>
            </div>

            <form action="<?= base_url('data-nikah/save') ?>" method="post" class="p-6 space-y-5">
                <?= csrf_field() ?>
                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Tahun</label>
                        <input type="number" name="tahun" class="block w-full rounded-lg border-[#66D2CE] shadow-sm focus:border-[#2DAA9E] focus:ring focus:ring-[#2DAA9E]/30 bg-[#E3D2C3]/10 text-gray-800 font-medium p-2.5" placeholder="2023" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Bulan</label>
                        <select name="bulan" class="block w-full rounded-lg border-[#66D2CE] shadow-sm focus:border-[#2DAA9E] focus:ring focus:ring-[#2DAA9E]/30 bg-[#E3D2C3]/10 text-gray-800 font-medium p-2.5" required>
                            <?php for ($m = 1; $m <= 12; $m++): ?>
                                <option value="<?= $m ?>"><?= $m ?> - <?= DateTime::createFromFormat('!m', $m)->format('F') ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
                <div class="bg-[#E3D2C3]/30 p-4 rounded-lg border border-[#2DAA9E]/20 mt-4">
                    <label class="block text-sm font-extrabold text-[#2DAA9E] mb-2 uppercase tracking-wide">Jumlah Pernikahan</label>
                    <input type="number" name="jumlah_nikah" class="block w-full rounded-lg border-2 border-[#2DAA9E] shadow-sm focus:ring-[#2DAA9E] bg-white text-gray-800 font-bold p-3 text-lg" placeholder="0" required>
                </div>

                <div class="mt-8 flex gap-3">
                    <button type="button" onclick="closeModal('modalManual')" class="w-1/3 rounded-lg border-2 border-gray-200 px-4 py-3 bg-white text-gray-600 font-bold hover:bg-gray-50">Batal</button>
                    <button type="submit" class="w-2/3 rounded-lg bg-[#2DAA9E] px-4 py-3 text-white font-bold hover:bg-[#1f7a70]">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modalUpload" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-900 bg-opacity-80 transition-opacity" onclick="closeModal('modalUpload')"></div>

        <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border-t-4 border-[#66D2CE]">
            <div class="bg-[#66D2CE] px-6 py-4 flex justify-between items-center">
                <h3 class="text-xl font-bold text-white">Import File CSV</h3>
                <button onclick="closeModal('modalUpload')" class="text-white hover:text-gray-200 text-3xl leading-none">&times;</button>
            </div>

            <form action="<?= base_url('data-nikah/upload') ?>" method="post" enctype="multipart/form-data" class="p-8">
                <?= csrf_field() ?>

                <div class="mb-6 text-center p-6 bg-[#E3D2C3]/20 rounded-xl border-2 border-dashed border-[#2DAA9E]">
                    <svg class="mx-auto h-16 w-16 text-[#2DAA9E]" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <p class="mt-4 text-sm font-medium text-gray-700">Format: <strong>tahun, bulan, jumlah_nikah</strong></p>
                    <p class="text-xs text-gray-500">Klik tombol dibawah untuk memilih file.</p>
                </div>

                <input type="file" name="file_csv" class="block w-full text-sm text-gray-600 file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-[#66D2CE] file:text-white hover:file:bg-[#2DAA9E] cursor-pointer bg-[#E3D2C3]/30 rounded-full transition-all" required accept=".csv">

                <div class="mt-8 flex gap-3">
                    <button type="button" onclick="closeModal('modalUpload')" class="w-1/3 rounded-lg border-2 border-gray-200 px-4 py-3 bg-white text-gray-600 font-bold hover:bg-gray-50">Batal</button>
                    <button type="submit" class="w-2/3 rounded-lg bg-[#2DAA9E] px-4 py-3 text-white font-bold hover:bg-[#1f7a70]">Mulai Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    // Auto dismiss alerts
    document.addEventListener('DOMContentLoaded', (event) => {
        const alerts = document.querySelectorAll('.auto-dismiss-alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    alert.remove();
                }, 500);
            }, 4000);
        });
    });
</script>

<style>
    /* Styling khusus Scrollbar agar sesuai tema */
    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #E3D2C3;
        /* Warna Track (Jalur) Krem */
        border-radius: 0px 0px 8px 0px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: #2DAA9E;
        /* Warna Pegangan (Thumb) Teal Utama */
        border-radius: 10px;
        border: 2px solid #E3D2C3;
        /* Border agar terlihat ada jarak */
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background-color: #1f7a70;
        /* Warna lebih gelap saat hover */
    }

    /* Firefox Support */
    .custom-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: #2DAA9E #E3D2C3;
    }
</style>

<?= $this->endSection(); ?>