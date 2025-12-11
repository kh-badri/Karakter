<?php helper('form'); ?>
<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="min-h-screen bg-[#EBD5AB]/20 py-10 px-4 font-sans text-[#1B211A]">
    <div class="container mx-auto max-w-7xl">

        <div class="flex flex-col md:flex-row justify-between items-end mb-6 gap-4">
            <div>
                <h1 class="text-4xl text-gray-700 font-bold tracking-tight"><?= $title ?></h1>
                <p class="text-gray-700 font-semibold mt-1 text-lg">Sistem Prediksi Penjualan Motor Honda (Naive Bayes)</p>
            </div>
            <div class="bg-white border-r-4 border-[#628141] px-6 py-4 rounded-l-lg shadow-sm flex items-center gap-4">
                <div class="p-3 bg-[#8BAE66]/20 rounded-full text-[#628141]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <div>
                    <span class="block text-sm font-medium text-[#628141]">Total Data Latih</span>
                    <span class="text-3xl font-extrabold text-[#1B211A]"><?= count($dataset) ?></span>
                </div>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="auto-dismiss-alert bg-[#8BAE66]/30 border-l-4 border-[#628141] text-[#1B211A] px-4 py-3 rounded shadow-sm mb-6 flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#628141]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-semibold"><?= session()->getFlashdata('success') ?></span>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="auto-dismiss-alert bg-red-100 border-l-4 border-[#1B211A] text-red-800 px-4 py-3 rounded shadow-sm mb-6">
                <span class="font-bold">Perhatian:</span> <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-xl shadow-md border border-[#8BAE66]/40 p-6 mb-8">
            <div class="flex items-center gap-2 mb-4 border-b border-[#EBD5AB] pb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#628141]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h2 class="text-lg font-bold text-[#1B211A]">Panduan Konversi Data ke Kategori</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-[#EBD5AB]/20 p-4 rounded-lg border border-[#EBD5AB]">
                    <h3 class="font-bold text-sm uppercase text-[#628141] mb-2">Usia</h3>
                    <ul class="text-sm space-y-1 text-[#1B211A]">
                        <li class="flex justify-between"><span>Muda</span> <span class="font-semibold text-[#628141]">&lt; 26 Thn</span></li>
                        <li class="flex justify-between"><span>Dewasa</span> <span class="font-semibold text-[#628141]">26 - 45 Thn</span></li>
                        <li class="flex justify-between"><span>Tua</span> <span class="font-semibold text-[#628141]">&gt; 45 Thn</span></li>
                    </ul>
                </div>
                <div class="bg-[#EBD5AB]/20 p-4 rounded-lg border border-[#EBD5AB]">
                    <h3 class="font-bold text-sm uppercase text-[#628141] mb-2">Penghasilan</h3>
                    <ul class="text-sm space-y-1 text-[#1B211A]">
                        <li class="flex justify-between"><span>Rendah</span> <span class="font-semibold text-[#628141]">&lt; 5 Jt</span></li>
                        <li class="flex justify-between"><span>Sedang</span> <span class="font-semibold text-[#628141]">5 - 10 Jt</span></li>
                        <li class="flex justify-between"><span>Tinggi</span> <span class="font-semibold text-[#628141]">&gt; 10 Jt</span></li>
                    </ul>
                </div>
                <div class="bg-[#EBD5AB]/20 p-4 rounded-lg border border-[#EBD5AB]">
                    <h3 class="font-bold text-sm uppercase text-[#628141] mb-2">Total Transaksi</h3>
                    <ul class="text-sm space-y-1 text-[#1B211A]">
                        <li class="flex justify-between"><span>Rendah</span> <span class="font-semibold text-[#628141]">&lt; 15 Jt</span></li>
                        <li class="flex justify-between"><span>Sedang</span> <span class="font-semibold text-[#628141]">15 - 30 Jt</span></li>
                        <li class="flex justify-between"><span>Tinggi</span> <span class="font-semibold text-[#628141]">&gt; 30 Jt</span></li>
                    </ul>
                </div>
                <div class="bg-[#EBD5AB]/20 p-4 rounded-lg border border-[#EBD5AB]">
                    <h3 class="font-bold text-sm uppercase text-[#628141] mb-2">Frekuensi/Thn</h3>
                    <ul class="text-sm space-y-1 text-[#1B211A]">
                        <li class="flex justify-between"><span>Jarang</span> <span class="font-semibold text-[#628141]">0 - 2 Kali</span></li>
                        <li class="flex justify-between"><span>Sedang</span> <span class="font-semibold text-[#628141]">2 - 4 Kali</span></li>
                        <li class="flex justify-between"><span>Sering</span> <span class="font-semibold text-[#628141]">&gt; 4 Kali</span></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="bg-white p-5 rounded-t-xl border-b-2 border-[#EBD5AB] flex flex-wrap gap-4 justify-between items-center shadow-sm">
            <div class="flex gap-3">
                <button onclick="openModal('modalManual')" class="bg-[#628141] hover:bg-[#1B211A] text-[#EBD5AB] px-6 py-2.5 rounded-lg font-bold transition-all shadow hover:shadow-md flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Tambah Data
                </button>
                <button onclick="openModal('modalUpload')" class="bg-[#8BAE66] hover:bg-[#628141] text-[#1B211A] hover:text-[#EBD5AB] px-6 py-2.5 rounded-lg font-bold transition-all shadow hover:shadow-md flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    Import CSV
                </button>
            </div>
            <form action="<?= base_url('dataset/hapusSemua') ?>" method="post" onsubmit="return confirm('PERINGATAN KERAS!\nSemua data akan dihapus permanen. Anda yakin?');">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="text-[#1B211A] hover:bg-red-50 hover:text-red-700 hover:border-red-700 font-semibold px-4 py-2 border-2 border-[#1B211A]/30 rounded-lg transition-all flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    Reset Dataset
                </button>
            </form>
        </div>

        <div class="bg-white rounded-b-xl shadow-xl border border-[#EBD5AB]/50 relative">
            <div class="overflow-x-auto overflow-y-auto h-[550px] custom-scrollbar">
                <table class="w-full text-left border-collapse relative">
                    <thead class="sticky top-0 z-10 shadow-md">
                        <tr class="bg-[#1B211A] text-[#EBD5AB] uppercase text-sm font-bold tracking-wider leading-normal">
                            <th class="p-5 bg-[#1B211A]">No</th>
                            <th class="p-5 bg-[#1B211A]">Usia</th>
                            <th class="p-5 bg-[#1B211A]">Pekerjaan</th>
                            <th class="p-5 bg-[#1B211A]">Penghasilan</th>
                            <th class="p-5 bg-[#1B211A]">Frekuensi/Thn</th>
                            <th class="p-5 bg-[#1B211A]">Total Transaksi</th>
                            <th class="p-5 bg-[#1B211A]">Jenis Motor</th>
                            <th class="p-5 text-center bg-[#628141] text-white">Target</th>
                            <th class="p-5 text-center bg-[#1B211A]">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-[#1B211A] font-medium">
                        <?php if (empty($dataset)) : ?>
                            <tr>
                                <td colspan="9" class="p-20 text-center bg-[#EBD5AB]/10 text-[#628141]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-4 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                    </svg>
                                    <p class="text-xl font-bold">Data Kosong</p>
                                    <p class="font-normal">Silakan tambahkan data manual atau import file CSV.</p>
                                </td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($dataset as $i => $d) : ?>
                                <tr class="border-b border-gray-100 hover:bg-[#8BAE66]/10 transition-colors duration-150">
                                    <td class="p-5 text-[#628141] font-bold"><?= $i + 1 ?></td>
                                    <td class="p-5"><?= $d['usia'] ?></td>
                                    <td class="p-5"><?= $d['pekerjaan'] ?></td>
                                    <td class="p-5"><?= $d['penghasilan_rata_rata'] ?></td>
                                    <td class="p-5"><?= $d['frekuensi_pembelian'] ?></td>
                                    <td class="p-5"><?= $d['total_nilai_transaksi'] ?></td>
                                    <td class="p-5"><?= $d['jenis_motor'] ?></td>
                                    <td class="p-5 text-center">
                                        <?php
                                        // LOGIKA WARNA BADGE TARGET
                                        $bgClass = 'bg-gray-100 text-gray-800';

                                        if ($d['tingkat_pembelian'] == 'Tinggi') {
                                            // TINGGI = ORANGE
                                            $bgClass = 'bg-orange-200 text-orange-900 border border-orange-300';
                                        } elseif ($d['tingkat_pembelian'] == 'Sedang') {
                                            // SEDANG = KUNING
                                            $bgClass = 'bg-yellow-200 text-yellow-900 border border-yellow-300';
                                        } elseif ($d['tingkat_pembelian'] == 'Rendah') {
                                            // RENDAH = BIRU
                                            $bgClass = 'bg-blue-200 text-blue-900 border border-blue-300';
                                        }
                                        ?>
                                        <span class="px-4 py-1.5 rounded-full text-xs font-extrabold shadow-sm tracking-wide <?= $bgClass ?>">
                                            <?= strtoupper($d['tingkat_pembelian']) ?>
                                        </span>
                                    </td>
                                    <td class="p-5 text-center">
                                        <form action="<?= base_url('dataset/delete/' . $d['id']) ?>" method="post" onsubmit="return confirm('Hapus data?');">
                                            <?= csrf_field() ?>
                                            <input type="hidden" name="_method" value="POST">
                                            <button type="submit" class="text-[#8BAE66] hover:text-red-600 p-2 transition-all">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
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
        <div class="fixed inset-0 bg-[#1B211A] bg-opacity-80 transition-opacity" onclick="closeModal('modalManual')"></div>
        <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border-t-4 border-[#628141]">
            <div class="bg-[#628141] px-6 py-4 flex justify-between items-center">
                <h3 class="text-xl font-bold text-white">Tambah Data Manual</h3>
                <button onclick="closeModal('modalManual')" class="text-[#8BAE66] hover:text-white text-3xl leading-none">&times;</button>
            </div>
            <form action="<?= base_url('dataset/save') ?>" method="post" class="p-6 space-y-5">
                <?= csrf_field() ?>
                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-bold text-[#1B211A] mb-1">Usia</label>
                        <select name="usia" class="block w-full rounded-lg border-[#8BAE66] shadow-sm focus:border-[#628141] focus:ring focus:ring-[#628141]/30 bg-[#EBD5AB]/10 text-[#1B211A] font-medium p-2.5" required>
                            <option value="Muda">Muda (< 26)</option>
                            <option value="Dewasa">Dewasa (26-45)</option>
                            <option value="Tua">Tua (> 45)</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#1B211A] mb-1">Pekerjaan</label>
                        <input type="text" name="pekerjaan" class="block w-full rounded-lg border-[#8BAE66] shadow-sm focus:border-[#628141] focus:ring focus:ring-[#628141]/30 bg-[#EBD5AB]/10 text-[#1B211A] font-medium p-2.5" placeholder="Cth: PNS" required>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-bold text-[#1B211A] mb-1">Penghasilan</label>
                        <select name="penghasilan" class="block w-full rounded-lg border-[#8BAE66] shadow-sm focus:border-[#628141] focus:ring focus:ring-[#628141]/30 bg-[#EBD5AB]/10 text-[#1B211A] font-medium p-2.5" required>
                            <option value="Rendah">Rendah</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Tinggi">Tinggi</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#1B211A] mb-1">Total Transaksi</label>
                        <select name="total_transaksi" class="block w-full rounded-lg border-[#8BAE66] shadow-sm focus:border-[#628141] focus:ring focus:ring-[#628141]/30 bg-[#EBD5AB]/10 text-[#1B211A] font-medium p-2.5" required>
                            <option value="Rendah">Rendah</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Tinggi">Tinggi</option>
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-5">
                    <div>
                        <label class="block text-sm font-bold text-[#1B211A] mb-1">Frekuensi/Thn</label>
                        <select name="frekuensi" class="block w-full rounded-lg border-[#8BAE66] shadow-sm focus:border-[#628141] focus:ring focus:ring-[#628141]/30 bg-[#EBD5AB]/10 text-[#1B211A] font-medium p-2.5" required>
                            <option value="Jarang">Jarang</option>
                            <option value="Sedang">Sedang</option>
                            <option value="Sering">Sering</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-[#1B211A] mb-1">Jenis Motor</label>
                        <input type="text" name="jenis_motor" class="block w-full rounded-lg border-[#8BAE66] shadow-sm focus:border-[#628141] focus:ring focus:ring-[#628141]/30 bg-[#EBD5AB]/10 text-[#1B211A] font-medium p-2.5" placeholder="Cth: Matic" required>
                    </div>
                </div>
                <div class="bg-[#EBD5AB]/30 p-4 rounded-lg border border-[#628141]/20 mt-4">
                    <label class="block text-sm font-extrabold text-[#628141] mb-2 uppercase tracking-wide">TARGET: Tingkat Pembelian</label>
                    <select name="tingkat_pembelian" class="block w-full rounded-lg border-2 border-[#628141] shadow-sm focus:ring-[#628141] bg-white text-[#1B211A] font-bold p-3" required>
                        <option value="">-- Pilih Target --</option>
                        <option value="Rendah">Rendah</option>
                        <option value="Sedang">Sedang</option>
                        <option value="Tinggi">Tinggi</option>
                    </select>
                </div>
                <div class="mt-8 flex gap-3">
                    <button type="button" onclick="closeModal('modalManual')" class="w-1/3 rounded-lg border-2 border-[#1B211A]/20 px-4 py-3 bg-white text-[#1B211A] font-bold hover:bg-gray-50">Batal</button>
                    <button type="submit" class="w-2/3 rounded-lg bg-[#628141] px-4 py-3 text-white font-bold hover:bg-[#1B211A]">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="modalUpload" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-[#1B211A] bg-opacity-80 transition-opacity" onclick="closeModal('modalUpload')"></div>
        <div class="inline-block align-bottom bg-white rounded-xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border-t-4 border-[#8BAE66]">
            <div class="bg-[#8BAE66] px-6 py-4 flex justify-between items-center">
                <h3 class="text-xl font-bold text-[#1B211A]">Import File CSV</h3>
                <button onclick="closeModal('modalUpload')" class="text-[#1B211A] hover:text-white text-3xl leading-none">&times;</button>
            </div>
            <form action="<?= base_url('dataset/upload') ?>" method="post" enctype="multipart/form-data" class="p-8">
                <?= csrf_field() ?>
                <div class="mb-6 text-center p-6 bg-[#EBD5AB]/20 rounded-xl border-2 border-dashed border-[#8BAE66]">
                    <svg class="mx-auto h-16 w-16 text-[#628141]" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <p class="mt-4 text-sm font-medium text-[#1B211A]">Klik tombol dibawah untuk memilih file CSV Anda.</p>
                </div>
                <input type="file" name="dataset_csv" class="block w-full text-sm text-[#1B211A] file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-[#8BAE66] file:text-[#1B211A] hover:file:bg-[#628141] hover:file:text-white cursor-pointer bg-[#EBD5AB]/20 rounded-full transition-all" required>
                <div class="mt-8 flex gap-3">
                    <button type="button" onclick="closeModal('modalUpload')" class="w-1/3 rounded-lg border-2 border-[#1B211A]/20 px-4 py-3 bg-white text-[#1B211A] font-bold hover:bg-gray-50">Batal</button>
                    <button type="submit" class="w-2/3 rounded-lg bg-[#628141] px-4 py-3 text-white font-bold hover:bg-[#1B211A]">Mulai Upload</button>
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

<?= $this->endSection(); ?>