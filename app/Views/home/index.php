<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="min-h-screen bg-[#EBD5AB]/20 py-10 px-4 font-sans text-[#1B211A]">
    <div class="container mx-auto max-w-6xl">

        <div class="bg-white rounded-2xl shadow-xl border-l-8 border-[#628141] p-8 mb-10 relative overflow-hidden">
            <div class="relative z-10">
                <h1 class="text-4xl font-extrabold text-[#1B211A] mb-2">Sistem Klasifikasi Tingkat Pembelian</h1>
                <p class="text-lg text-[#628141] font-medium max-w-2xl">
                    Implementasi Algoritma Naive Bayes untuk memprediksi tingkat pembelian berdasarkan data historis pelanggan.
                </p>
            </div>
            <div class="absolute right-0 top-0 h-full w-48 bg-gradient-to-l from-[#EBD5AB]/40 to-transparent flex items-center justify-center opacity-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32 text-[#8BAE66]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

            <div class="bg-white p-6 rounded-xl shadow-md border border-[#EBD5AB] hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-[#EBD5AB]/40 rounded-full text-[#1B211A]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Dataset</span>
                </div>
                <h2 class="text-4xl font-extrabold text-[#1B211A]"><?= number_format($total_data) ?></h2>
                <p class="text-sm text-[#628141] mt-1 font-medium">Baris data latih tersedia</p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-md border border-[#EBD5AB] hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-[#8BAE66]/20 rounded-full text-[#628141]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Akurasi Model</span>
                </div>
                <div class="flex items-baseline gap-1">
                    <h2 class="text-4xl font-extrabold text-[#1B211A]"><?= $latest_accuracy ?>%</h2>
                </div>
                <p class="text-sm text-gray-500 mt-1">Update: <?= $last_update ?></p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-md border border-[#EBD5AB] hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-[#EBD5AB]/40 rounded-full text-[#1B211A]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Riwayat</span>
                </div>
                <h2 class="text-4xl font-extrabold text-[#1B211A]"><?= number_format($total_riwayat) ?></h2>
                <p class="text-sm text-[#628141] mt-1 font-medium">Kali analisis dilakukan</p>
            </div>
        </div>

        <h3 class="text-xl font-bold text-gray-200 mb-4 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-200" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd" />
            </svg>
            Menu Cepat
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <a href="<?= base_url('dataset') ?>" class="group block bg-[#1B211A] rounded-xl p-6 text-white shadow-lg hover:bg-[#628141] transition-all transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-xl font-bold mb-2">Kelola Data</h4>
                        <p class="text-[#EBD5AB] text-sm group-hover:text-white opacity-80">Import CSV atau tambah data manual.</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#8BAE66] group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                </div>
            </a>

            <a href="<?= base_url('analisis') ?>" class="group block bg-[#628141] rounded-xl p-6 text-white shadow-lg hover:bg-[#1B211A] transition-all transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-xl font-bold mb-2">Mulai Analisis</h4>
                        <p class="text-white text-sm opacity-90">Jalankan algoritma Naive Bayes.</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </a>

            <a href="<?= base_url('history') ?>" class="group block bg-[#EBD5AB] rounded-xl p-6 text-[#1B211A] shadow-lg border border-[#8BAE66] hover:bg-white transition-all transform hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <h4 class="text-xl font-bold mb-2">Lihat Laporan</h4>
                        <p class="text-[#628141] text-sm font-medium">Cek hasil analisis sebelumnya.</p>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-[#1B211A]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
            </a>

        </div>

    </div>
</div>

<?= $this->endSection(); ?>