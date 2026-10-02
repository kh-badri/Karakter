<?php helper('form'); ?>
<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="font-sans text-gray-800">
    <div class="max-w-7xl mx-auto">

        <!-- HEADER SECTION -->
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-4 mb-6">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="px-2 py-0.5 bg-color-1/10 text-color-1 rounded text-[10px] font-bold uppercase tracking-wider">
                        Modul Data Mining
                    </span>
                    <span class="px-2 py-0.5 bg-color-4/20 text-gray-600 rounded text-[10px] font-bold uppercase tracking-wider flex items-center gap-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-color-4"></span>
                        Terhubung
                    </span>
                </div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-gray-800 tracking-tight leading-tight">
                    Dataset Karakteristik<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-color-1 to-[#9c7d63]">Karakter Siswa</span>
                </h1>
            </div>

            <!-- Total Data Badge -->
            <div class="bg-white px-4 py-3 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 min-w-[200px]">
                <div class="w-10 h-10 bg-color-3 rounded-lg flex items-center justify-center text-color-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                    </svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-0.5">Total Dataset</p>
                    <p class="text-xl font-black text-gray-800"><?= count($dataset) ?> <span class="text-xs font-medium text-gray-500">Siswa</span></p>
                </div>
            </div>
        </div>

        <!-- ALERTS -->
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="auto-dismiss-alert bg-white border-l-4 border-color-1 shadow-sm px-4 py-3 rounded-lg mb-5 flex items-center gap-3">
                <div class="bg-green-100 p-1.5 rounded-full text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <p class="text-sm font-bold text-gray-800"><?= session()->getFlashdata('success') ?></p>
            </div>
        <?php endif; ?>

        <!-- ACTION TOOLBAR -->
        <div class="bg-white p-2 rounded-xl shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-center gap-3 mb-6">
            <div class="flex flex-wrap gap-2 w-full md:w-auto">
                <button onclick="openModal('modalManual')" class="flex-1 md:flex-none bg-color-4 hover:bg-[#a6cbd5] text-gray-800 px-4 py-2.5 rounded-lg font-bold transition-all flex items-center justify-center gap-1.5 text-xs shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Tambah Siswa
                </button>
                <button onclick="openModal('modalUpload')" class="flex-1 md:flex-none bg-color-1 hover:bg-[#b89578] text-white px-4 py-2.5 rounded-lg font-bold transition-all flex items-center justify-center gap-1.5 text-xs shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    Upload CSV
                </button>
            </div>
            
            <div class="flex items-center gap-3 w-full md:w-auto px-2">
                <button onclick="toggleInfo()" class="text-xs font-bold text-gray-500 hover:text-color-1 flex items-center gap-1.5 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Info Atribut
                </button>
                <div class="w-px h-5 bg-gray-200"></div>
                <form action="<?= base_url('data-karakter/hapus-semua') ?>" method="get" onsubmit="return confirm('Kosongkan semua data? Tindakan ini tidak bisa dibatalkan.');">
                    <button type="submit" class="text-xs font-bold text-danger hover:text-red-700 flex items-center gap-1.5 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        Reset Database
                    </button>
                </form>
            </div>
        </div>

        <!-- INFO PANEL -->
        <div id="infoPanel" class="hidden mb-6 transform transition-all duration-300 origin-top">
            <div class="bg-color-2 rounded-xl p-5 text-gray-800 shadow-sm relative overflow-hidden border border-white">
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/20 rounded-full blur-2xl -translate-y-1/2 translate-x-1/3"></div>
                <h3 class="text-sm font-bold mb-4 flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-white flex items-center justify-center text-color-1 text-xs">i</span>
                    Struktur Dataset
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 relative z-10">
                    <div>
                        <p class="text-white font-bold text-[10px] uppercase tracking-wider mb-1">Penilaian</p>
                        <p class="text-xs text-gray-700 leading-relaxed font-medium">Atribut dinilai skala 1 (Sangat Kurang) s/d 5 (Sangat Baik).</p>
                    </div>
                    <div>
                        <p class="text-white font-bold text-[10px] uppercase tracking-wider mb-1">Atribut Prediktor</p>
                        <ul class="text-xs text-gray-700 space-y-0.5 font-medium">
                            <li>• Bersosialisasi & Berpendapat</li>
                            <li>• Kestabilan Emosi & Kedisiplinan</li>
                            <li>• Kepedulian & Kebersihan</li>
                        </ul>
                    </div>
                    <div>
                        <p class="text-white font-bold text-[10px] uppercase tracking-wider mb-1">Label Target</p>
                        <p class="text-xs text-gray-700 leading-relaxed font-medium">Kelas keluaran (misal: Ekstrover, Introver, Disiplin).</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- THE DATA TABLE -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto h-[600px] custom-scrollbar">
                <table class="w-full text-left border-collapse min-w-[900px] text-xs">
                    <thead class="sticky top-0 z-10 bg-white/90 backdrop-blur-md">
                        <tr>
                            <th class="px-4 py-3 font-bold text-gray-500 border-b-2 border-gray-100 w-12">No</th>
                            <th class="px-4 py-3 font-bold text-gray-500 border-b-2 border-gray-100">Nama Siswa</th>
                            <th class="px-4 py-3 font-bold text-gray-500 border-b-2 border-gray-100 text-center" title="Bersosialisasi">Sosial</th>
                            <th class="px-4 py-3 font-bold text-gray-500 border-b-2 border-gray-100 text-center" title="Berpendapat">Pendapat</th>
                            <th class="px-4 py-3 font-bold text-gray-500 border-b-2 border-gray-100 text-center" title="Kestabilan Emosi">Emosi</th>
                            <th class="px-4 py-3 font-bold text-gray-500 border-b-2 border-gray-100 text-center" title="Kedisiplinan">Disiplin</th>
                            <th class="px-4 py-3 font-bold text-gray-500 border-b-2 border-gray-100 text-center" title="Kepedulian">Peduli</th>
                            <th class="px-4 py-3 font-bold text-gray-500 border-b-2 border-gray-100 text-center" title="Kebersihan">Bersih</th>
                            <th class="px-4 py-3 font-bold text-gray-500 border-b-2 border-gray-100 text-center">Label Target</th>
                            <th class="px-4 py-3 font-bold text-gray-500 border-b-2 border-gray-100 text-center w-24">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-800">
                        <?php if (empty($dataset)) : ?>
                            <tr>
                                <td colspan="10" class="p-16 text-center">
                                    <div class="inline-flex items-center justify-center w-12 h-12 bg-color-3 rounded-full mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-color-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                    </div>
                                    <p class="text-lg font-bold text-gray-800 mb-1">Belum ada data</p>
                                    <p class="text-gray-500 font-medium">Tambahkan data manual atau upload file CSV.</p>
                                </td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($dataset as $i => $d) : ?>
                                <tr class="hover:bg-color-3/30 transition-colors">
                                    <td class="px-4 py-3 border-b border-gray-50 text-gray-400 font-medium"><?= $i + 1 ?></td>
                                    <td class="px-4 py-3 border-b border-gray-50 font-bold text-gray-800 text-sm"><?= esc($d['nama_siswa']) ?></td>
                                    <td class="px-4 py-3 border-b border-gray-50 text-center font-semibold text-gray-600"><?= $d['bersosialisasi'] ?></td>
                                    <td class="px-4 py-3 border-b border-gray-50 text-center font-semibold text-gray-600"><?= $d['berpendapat'] ?></td>
                                    <td class="px-4 py-3 border-b border-gray-50 text-center font-semibold text-gray-600"><?= $d['kestabilan_emosi'] ?></td>
                                    <td class="px-4 py-3 border-b border-gray-50 text-center font-semibold text-gray-600"><?= $d['kedisiplinan'] ?></td>
                                    <td class="px-4 py-3 border-b border-gray-50 text-center font-semibold text-gray-600"><?= $d['kepedulian'] ?></td>
                                    <td class="px-4 py-3 border-b border-gray-50 text-center font-semibold text-gray-600"><?= $d['kebersihan'] ?></td>
                                    <td class="px-4 py-3 border-b border-gray-50 text-center">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-[10px] font-bold bg-gray-100 text-gray-700">
                                            <?= esc($d['label_karakter']) ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 border-b border-gray-50 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button onclick='openEditModal(<?= json_encode($d) ?>)' class="p-1 text-gray-400 hover:text-color-1 transition-colors bg-white hover:bg-gray-50 rounded border border-transparent hover:border-gray-200" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                                </svg>
                                            </button>
                                            
                                            <a href="<?= base_url('data-karakter/delete/' . $d['id']) ?>" onclick="return confirm('Hapus data siswa ini?');" class="p-1 text-gray-400 hover:text-danger transition-colors bg-white hover:bg-red-50 rounded border border-transparent hover:border-red-100" title="Hapus">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        </div>
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

<!-- Modal Tambah Data -->
<div id="modalManual" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity" onclick="closeModal('modalManual')"></div>
        <div class="relative bg-white rounded-2xl w-full max-w-xl shadow-xl">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-color-4/20 rounded-t-2xl">
                <h3 class="text-lg font-bold text-gray-800">Tambah Data Baru</h3>
                <button onclick="closeModal('modalManual')" class="w-6 h-6 flex items-center justify-center rounded-md bg-white text-gray-500 hover:bg-gray-100 transition-colors shadow-sm">&times;</button>
            </div>
            <form action="<?= base_url('data-karakter/save') ?>" method="post" class="p-6 text-sm">
                <?= csrf_field() ?>
                
                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-600 mb-1">Nama Lengkap Siswa</label>
                    <input type="text" name="nama_siswa" class="block w-full rounded-lg border border-gray-200 focus:border-color-1 focus:ring-0 bg-gray-50 text-gray-800 p-2.5 transition-colors" required>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                    <?php 
                    $vars = ['bersosialisasi' => 'Bersosialisasi', 'berpendapat' => 'Berpendapat', 'kestabilan_emosi' => 'Emosi', 'kedisiplinan' => 'Kedisiplinan', 'kepedulian' => 'Kepedulian', 'kebersihan' => 'Kebersihan'];
                    foreach($vars as $key => $label): 
                    ?>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1 truncate" title="<?= $label ?>"><?= $label ?></label>
                        <select name="<?= $key ?>" class="block w-full rounded-lg border border-gray-200 focus:border-color-1 focus:ring-0 bg-gray-50 text-gray-800 p-2.5 transition-colors appearance-none cursor-pointer" required>
                            <option value="1">1 - Sangat Kurang</option>
                            <option value="2">2 - Kurang</option>
                            <option value="3" selected>3 - Cukup</option>
                            <option value="4">4 - Baik</option>
                            <option value="5">5 - Sangat Baik</option>
                        </select>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-600 mb-1">Label Karakter</label>
                    <input type="text" name="label_karakter" class="block w-full rounded-lg border border-gray-200 focus:border-color-1 focus:ring-0 bg-gray-50 text-gray-800 p-2.5 transition-colors" placeholder="Contoh: Ekstrover" required>
                </div>

                <button type="submit" class="w-full rounded-lg bg-color-1 py-3 text-white font-bold hover:bg-[#b89578] transition-colors shadow-sm">Simpan Ke Database</button>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Data -->
<div id="modalEdit" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity" onclick="closeModal('modalEdit')"></div>
        <div class="relative bg-white rounded-2xl w-full max-w-xl shadow-xl">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-color-4/20 rounded-t-2xl">
                <h3 class="text-lg font-bold text-gray-800">Perbarui Data</h3>
                <button onclick="closeModal('modalEdit')" class="w-6 h-6 flex items-center justify-center rounded-md bg-white text-gray-500 hover:bg-gray-100 transition-colors shadow-sm">&times;</button>
            </div>
            
            <form id="formEdit" action="" method="post" class="p-6 text-sm">
                <?= csrf_field() ?>
                
                <div class="mb-4">
                    <label class="block text-xs font-bold text-gray-600 mb-1">Nama Lengkap Siswa</label>
                    <input type="text" id="edit_nama" name="nama_siswa" class="block w-full rounded-lg border border-gray-200 focus:border-color-1 focus:ring-0 bg-gray-50 text-gray-800 p-2.5 transition-colors" required>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-4">
                    <?php foreach($vars as $key => $label): ?>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1 truncate" title="<?= $label ?>"><?= $label ?></label>
                        <select id="edit_<?= $key ?>" name="<?= $key ?>" class="block w-full rounded-lg border border-gray-200 focus:border-color-1 focus:ring-0 bg-gray-50 text-gray-800 p-2.5 transition-colors appearance-none cursor-pointer" required>
                            <option value="1">1 - Sangat Kurang</option>
                            <option value="2">2 - Kurang</option>
                            <option value="3">3 - Cukup</option>
                            <option value="4">4 - Baik</option>
                            <option value="5">5 - Sangat Baik</option>
                        </select>
                    </div>
                    <?php endforeach; ?>
                </div>

                <div class="mb-6">
                    <label class="block text-xs font-bold text-gray-600 mb-1">Label Karakter</label>
                    <input type="text" id="edit_label" name="label_karakter" class="block w-full rounded-lg border border-gray-200 focus:border-color-1 focus:ring-0 bg-gray-50 text-gray-800 p-2.5 transition-colors" required>
                </div>
                
                <button type="submit" class="w-full rounded-lg bg-color-1 py-3 text-white font-bold hover:bg-[#b89578] transition-colors shadow-sm">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>

<!-- Modal Upload -->
<div id="modalUpload" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity" onclick="closeModal('modalUpload')"></div>
        <div class="relative bg-white rounded-2xl w-full max-w-sm shadow-xl overflow-hidden">
            <div class="p-6 pb-4 text-center bg-color-4/10">
                <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-3 shadow-sm border border-gray-100">
                    <svg class="h-8 w-8 text-color-1" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800">Upload Dataset</h3>
                <p class="text-xs text-gray-500 mt-1">Pastikan file CSV memiliki tepat 8 kolom.</p>
            </div>
            <form action="<?= base_url('data-karakter/upload') ?>" method="post" enctype="multipart/form-data" class="p-6 pt-4">
                <?= csrf_field() ?>
                
                <div class="mb-6">
                    <input type="file" name="file_csv" class="block w-full text-xs text-gray-600 file:mr-3 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-bold file:bg-color-4 file:text-gray-800 hover:file:bg-[#a6cbd5] cursor-pointer bg-gray-50 rounded-lg transition-all border border-gray-200" required accept=".csv">
                </div>
                
                <div class="flex gap-3">
                    <button type="button" onclick="closeModal('modalUpload')" class="w-1/3 rounded-lg border border-gray-200 py-2.5 bg-white text-gray-600 text-sm font-bold hover:bg-gray-50 transition-colors">Batal</button>
                    <button type="submit" class="w-2/3 rounded-lg bg-color-1 py-2.5 text-white text-sm font-bold hover:bg-[#b89578] transition-colors shadow-sm">Mulai Proses</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleInfo() {
        const panel = document.getElementById('infoPanel');
        if(panel.classList.contains('hidden')) {
            panel.classList.remove('hidden');
            setTimeout(() => {
                panel.classList.remove('scale-y-0', 'opacity-0');
                panel.classList.add('scale-y-100', 'opacity-100');
            }, 10);
        } else {
            panel.classList.remove('scale-y-100', 'opacity-100');
            panel.classList.add('scale-y-0', 'opacity-0');
            setTimeout(() => {
                panel.classList.add('hidden');
            }, 300);
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const panel = document.getElementById('infoPanel');
        panel.classList.add('scale-y-0', 'opacity-0');
    });

    function openModal(modalId) {
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    function openEditModal(data) {
        document.getElementById('edit_nama').value = data.nama_siswa;
        document.getElementById('edit_bersosialisasi').value = data.bersosialisasi;
        document.getElementById('edit_berpendapat').value = data.berpendapat;
        document.getElementById('edit_kestabilan_emosi').value = data.kestabilan_emosi;
        document.getElementById('edit_kedisiplinan').value = data.kedisiplinan;
        document.getElementById('edit_kepedulian').value = data.kepedulian;
        document.getElementById('edit_kebersihan').value = data.kebersihan;
        document.getElementById('edit_label').value = data.label_karakter;
        
        const form = document.getElementById('formEdit');
        form.action = '<?= base_url('data-karakter/update') ?>/' + data.id;
        
        openModal('modalEdit');
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

<style>
    .custom-scrollbar::-webkit-scrollbar { width: 6px; height: 6px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #e5e7eb; border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background-color: #d1d5db; }
</style>

<?= $this->endSection(); ?>