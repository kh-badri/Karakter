<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-10px) rotate(3deg); }
    }
    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
    .animate-float-delayed {
        animation: float 7s ease-in-out infinite;
        animation-delay: 2s;
    }
    
    /* Fade In Up Animation */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .fade-in-up {
        animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
    }
    .delay-100 { animation-delay: 100ms; }
    .delay-200 { animation-delay: 200ms; }
    .delay-300 { animation-delay: 300ms; }
</style>

<div class="max-w-6xl mx-auto font-sans text-gray-800 pb-10">

    <!-- Hero Banner -->
    <div class="relative bg-white rounded-2xl shadow-sm border border-color-2 overflow-hidden mb-6 fade-in-up">
        <!-- Background Decorative SVGs -->
        <!-- Book Icon -->
        <div class="absolute right-[5%] top-[-5%] w-40 h-40 text-color-1/10 animate-float-delayed pointer-events-none transform -rotate-12">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-full">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
            </svg>
        </div>
        <!-- Academic Cap Icon -->
        <div class="absolute right-[25%] bottom-[-15%] w-28 h-28 text-color-1/10 animate-float pointer-events-none transform rotate-12">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-full">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
            </svg>
        </div>
        
        <div class="px-6 py-8 relative z-10">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-gradient-to-br from-color-1 to-[#b89578] rounded-xl flex items-center justify-center text-white shadow-lg shadow-color-1/30 shrink-0 transform transition-transform hover:scale-105">
                    <!-- Academic Cap Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight">
                        Halo, <span class="text-transparent bg-clip-text bg-gradient-to-r from-color-1 to-[#9c7d63]"><?= esc(session()->get('username')) ?>!</span>
                    </h1>
                    <p class="text-[13px] text-gray-500 mt-1 max-w-lg leading-relaxed">
                        Selamat datang di Dasbor <strong class="text-gray-700">Sistem Klasifikasi Karakter</strong>. Pantau metrik data latih Anda dan mulailah melakukan klasifikasi karakter siswa hari ini.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <!-- Card 1 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center justify-between group hover:border-color-1/30 hover:shadow-md transition-all fade-in-up delay-100">
            <div>
                <p class="text-[11px] font-extrabold text-gray-400 uppercase tracking-widest mb-1">Total Data Latih</p>
                <div class="flex items-end gap-2">
                    <span class="text-3xl font-extrabold text-gray-800 tracking-tight" x-data="{ count: 0 }" x-init="
                        let target = <?= esc($total_dataset) ?>;
                        let step = Math.ceil(target / 30);
                        let interval = setInterval(() => {
                            if (count < target) {
                                count += step;
                                if (count > target) count = target;
                            } else {
                                clearInterval(interval);
                            }
                        }, 20);
                    " x-text="count">0</span>
                    <span class="text-xs text-gray-500 font-medium mb-1.5">Baris Data</span>
                </div>
            </div>
            <div class="w-12 h-12 bg-color-4/20 text-color-4 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#72a1af]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                </svg>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 flex items-center justify-between group hover:border-color-1/30 hover:shadow-md transition-all fade-in-up delay-200">
            <div>
                <p class="text-[11px] font-extrabold text-gray-400 uppercase tracking-widest mb-1">Total Klasifikasi</p>
                <div class="flex items-end gap-2">
                    <span class="text-3xl font-extrabold text-gray-800 tracking-tight" x-data="{ count: 0 }" x-init="
                        let target = <?= esc($total_riwayat) ?>;
                        let step = Math.ceil(target / 30);
                        let interval = setInterval(() => {
                            if (count < target) {
                                count += step;
                                if (count > target) count = target;
                            } else {
                                clearInterval(interval);
                            }
                        }, 20);
                    " x-text="count">0</span>
                    <span class="text-xs text-gray-500 font-medium mb-1.5">Tersimpan</span>
                </div>
            </div>
            <div class="w-12 h-12 bg-green-50 text-green-500 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left: Quick Actions -->
        <div class="lg:col-span-1 space-y-4 fade-in-up delay-300">
            <h2 class="text-xs font-extrabold text-gray-500 uppercase tracking-widest pl-1">Aksi Cepat</h2>
            
            <a href="<?= base_url('klasifikasi') ?>" class="block bg-gradient-to-r from-color-1 to-[#c19c7f] p-5 rounded-xl text-white shadow-md shadow-color-1/20 transform transition-transform hover:-translate-y-1 relative overflow-hidden group">
                <div class="absolute right-[-10%] top-[-20%] w-24 h-24 bg-white opacity-10 rounded-full group-hover:scale-150 transition-transform duration-500 ease-out"></div>
                <div class="relative z-10">
                    <!-- Badge Check Icon representing Character Classification -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                    </svg>
                    <h3 class="font-bold text-base mb-1">Mulai Klasifikasi Baru</h3>
                    <p class="text-[11px] text-white/80 leading-relaxed">Input data karakteristik siswa untuk menentukan label karakter.</p>
                </div>
            </a>

            <a href="<?= base_url('data-karakter') ?>" class="block bg-white border border-color-2 p-5 rounded-xl hover:border-color-1 hover:shadow-sm transition-all group">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gray-50 rounded-lg flex items-center justify-center text-gray-400 group-hover:text-color-1 group-hover:bg-color-1/10 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-800 text-sm">Kelola Dataset</h3>
                        <p class="text-[10px] text-gray-500 mt-0.5">Tambah atau hapus data latih.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Right: Recent History -->
        <div class="lg:col-span-2 space-y-4 fade-in-up delay-300">
            <div class="flex items-center justify-between pl-1">
                <h2 class="text-xs font-extrabold text-gray-500 uppercase tracking-widest">Riwayat Terbaru</h2>
                <a href="<?= base_url('history') ?>" class="text-[11px] font-bold text-color-1 hover:underline">Lihat Semua &rarr;</a>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <?php if (empty($recent_riwayat)): ?>
                    <div class="p-8 text-center">
                        <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3 text-gray-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                        </div>
                        <p class="text-sm font-bold text-gray-500">Belum Ada Riwayat</p>
                        <p class="text-[11px] text-gray-400 mt-1">Lakukan klasifikasi untuk melihat data muncul di sini.</p>
                    </div>
                <?php else: ?>
                    <ul class="divide-y divide-gray-50">
                        <?php foreach ($recent_riwayat as $row): ?>
                            <li class="p-4 hover:bg-gray-50/50 transition-colors flex items-center justify-between group">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-color-4/10 text-[#72a1af] rounded-lg flex items-center justify-center shrink-0 border border-color-4/20">
                                        <span class="text-sm font-bold uppercase"><?= substr($row['nama_siswa'], 0, 1) ?></span>
                                    </div>
                                    <div class="overflow-hidden">
                                        <p class="text-sm font-bold text-gray-800 truncate"><?= esc($row['nama_siswa']) ?></p>
                                        <p class="text-[10px] text-gray-400 mt-0.5"><?= date('d M Y, H:i', strtotime($row['tanggal_simpan'])) ?></p>
                                    </div>
                                </div>
                                
                                <div class="flex items-center gap-2 shrink-0">
                                    <div class="hidden sm:block text-right mr-2">
                                        <p class="text-[10px] font-bold text-gray-400 uppercase">Naive Bayes</p>
                                        <p class="text-xs font-bold text-gray-700"><?= esc($row['hasil_nb']) ?></p>
                                    </div>
                                    <a href="<?= base_url('history/detail/' . $row['id']) ?>" class="p-2 text-gray-400 hover:text-color-1 hover:bg-color-1/10 rounded-md transition-colors" title="Lihat Detail">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </a>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection(); ?>