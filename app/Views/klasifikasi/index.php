<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="max-w-7xl mx-auto font-sans text-gray-800">
    <!-- Header -->
    <div class="mb-5">
        <div class="flex items-center gap-2 mb-1">
            <span class="px-2 py-0.5 bg-color-1/10 text-color-1 rounded text-[10px] font-bold uppercase tracking-wider">
                Modul Data Mining
            </span>
            <span class="px-2 py-0.5 bg-color-4/20 text-gray-600 rounded text-[10px] font-bold uppercase tracking-wider">
                Klasifikasi
            </span>
        </div>
        <h1 class="text-xl md:text-2xl font-extrabold text-gray-800 tracking-tight">
            Klasifikasi <span class="text-transparent bg-clip-text bg-gradient-to-r from-color-1 to-[#9c7d63]">Karakter Siswa</span>
        </h1>
        <p class="text-xs text-gray-500 font-medium mt-1 max-w-2xl">
            Masukkan nilai karakteristik siswa untuk diprediksi menggunakan algoritma Naive Bayes dan Random Forest berdasarkan dataset yang telah diunggah.
        </p>
    </div>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="bg-red-50 border-l-4 border-danger p-3 rounded-lg mb-4 flex items-center gap-2 shadow-sm">
            <div class="bg-red-100 p-1 rounded-full text-danger">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                </svg>
            </div>
            <p class="text-xs font-bold text-red-800"><?= session()->getFlashdata('error') ?></p>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        <!-- Kolom Form Input -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-color-4/20 rounded-full blur-2xl -translate-y-1/2 translate-x-1/2"></div>
            
            <h2 class="text-sm font-extrabold text-gray-800 mb-4 flex items-center gap-2">
                <div class="w-6 h-6 rounded-md bg-color-1/10 text-color-1 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                </div>
                Data Siswa Baru
            </h2>

            <form action="<?= base_url('klasifikasi/proses') ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="mb-4">
                    <label class="block text-[10px] font-bold text-gray-600 mb-1 uppercase tracking-wider">Nama Lengkap Siswa</label>
                    <input type="text" name="nama_siswa" class="w-full rounded-md border border-gray-200 focus:border-color-1 focus:ring-0 bg-gray-50 text-gray-800 p-2 text-xs transition-colors font-medium" placeholder="Contoh: Budi Santoso" required>
                </div>

                <div class="mb-2">
                    <label class="block text-[9px] font-bold text-color-1 mb-2 uppercase tracking-widest border-b border-gray-100 pb-1.5">Penilaian Karakteristik (Skala 1-5)</label>
                </div>

                <div class="grid grid-cols-2 gap-3 mb-5">
                    <?php 
                    $vars = [
                        'bersosialisasi' => 'Bersosialisasi', 
                        'berpendapat' => 'Berpendapat', 
                        'kestabilan_emosi' => 'Kestabilan Emosi', 
                        'kedisiplinan' => 'Kedisiplinan', 
                        'kepedulian' => 'Kepedulian', 
                        'kebersihan' => 'Kebersihan'
                    ];
                    foreach($vars as $key => $label): 
                    ?>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-600 mb-1 truncate" title="<?= $label ?>"><?= $label ?></label>
                        <select name="<?= $key ?>" class="w-full rounded-md border border-gray-200 focus:border-color-1 focus:ring-0 bg-gray-50 text-gray-800 p-2 text-xs transition-colors cursor-pointer appearance-none font-semibold" required>
                            <option value="" disabled selected>Pilih Nilai</option>
                            <option value="1">1 - Sangat Kurang</option>
                            <option value="2">2 - Kurang</option>
                            <option value="3">3 - Cukup</option>
                            <option value="4">4 - Baik</option>
                            <option value="5">5 - Sangat Baik</option>
                        </select>
                    </div>
                    <?php endforeach; ?>
                </div>

                <button type="submit" class="w-full rounded-md bg-color-1 py-2.5 text-white font-extrabold hover:bg-[#b89578] transition-all shadow-sm text-xs flex items-center justify-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
                    </svg>
                    Jalankan Klasifikasi
                </button>
            </form>
        </div>

        <!-- Kolom Informasi Rumus -->
        <div class="flex flex-col gap-4">
            <!-- Rumus Naive Bayes -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <h2 class="text-xs font-extrabold text-gray-800 mb-3 flex items-center gap-2 border-b border-gray-100 pb-2">
                    <span class="w-5 h-5 rounded-full bg-color-4/20 text-gray-600 flex items-center justify-center text-[10px]">1</span>
                    Metode Naive Bayes
                </h2>
                <div class="bg-gray-50 rounded-lg p-3 border border-gray-100 mb-3 text-center">
                    <div class="font-serif text-[15px] font-bold text-gray-900 tracking-wide mb-1">
                        P(C | X) = <span class="inline-block align-middle"><div class="border-b border-gray-900 px-2 pb-0.5">P(X | C) &times; P(C)</div><div class="px-2 pt-0.5">P(X)</div></span>
                    </div>
                </div>
                <div class="text-[10px] text-gray-600 space-y-1">
                    <p class="font-bold text-gray-800 mb-0.5">Keterangan:</p>
                    <p><span class="font-bold w-12 inline-block">P(C | X)</span> = probabilitas kelas C berdasarkan data X.</p>
                    <p><span class="font-bold w-12 inline-block">P(X | C)</span> = probabilitas data X apabila diketahui termasuk ke dalam kelas C.</p>
                    <p><span class="font-bold w-12 inline-block">P(C)</span> = probabilitas awal atau probabilitas kelas C.</p>
                    <p><span class="font-bold w-12 inline-block">P(X)</span> = probabilitas kemunculan data X.</p>
                </div>
            </div>

            <!-- Rumus Random Forest -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5">
                <h2 class="text-xs font-extrabold text-gray-800 mb-3 flex items-center gap-2 border-b border-gray-100 pb-2">
                    <span class="w-5 h-5 rounded-full bg-color-4/20 text-gray-600 flex items-center justify-center text-[10px]">2</span>
                    Metode Random Forest
                </h2>
                <div class="bg-gray-50 rounded-lg p-3 border border-gray-100 mb-3 text-center">
                    <div class="font-serif text-[15px] font-bold text-gray-900 tracking-wide">
                        Y = Mode ( T1(x), T2(x), T3(x), ..., Tn(x) )
                    </div>
                </div>
                <div class="text-[10px] text-gray-600 space-y-1">
                    <p class="font-bold text-gray-800 mb-0.5">Keterangan:</p>
                    <p><span class="font-bold w-12 inline-block">Y</span> = hasil klasifikasi akhir.</p>
                    <p><span class="font-bold w-12 inline-block">T1..Tn(x)</span> = hasil prediksi dari masing-masing <em>Decision Tree</em>.</p>
                    <p><span class="font-bold w-12 inline-block">n</span> = jumlah <em>Decision Tree</em>.</p>
                    <p><span class="font-bold w-12 inline-block">Mode</span> = kelas yang paling banyak muncul.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>