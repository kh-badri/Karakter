<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="min-h-screen bg-[#EBD5AB]/20 py-10 px-4 font-sans text-[#1B211A]">
    <div class="container mx-auto max-w-4xl">

        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-700 tracking-tight"><?= $title ?></h1>
            <p class="text-gray-700 font-semibold mt-2 text-lg">Jalankan Algoritma Naive Bayes pada Data Latih</p>
        </div>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="bg-red-100 border-l-4 border-[#1B211A] text-red-800 px-6 py-4 rounded-lg shadow-md mb-8 relative" role="alert">
                <strong class="font-bold">Gagal!</strong>
                <span class="block sm:inline"><?= session()->getFlashdata('error') ?></span>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-2xl shadow-xl border border-[#8BAE66]/40 overflow-hidden relative">
            <div class="h-4 bg-[#628141] w-full"></div>

            <div class="p-10 flex flex-col items-center justify-center text-center">

                <div class="bg-[#EBD5AB]/30 p-6 rounded-full mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-[#628141]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>

                <h3 class="text-2xl font-bold text-[#1B211A] mb-3">Siap Melakukan Analisis?</h3>
                <p class="text-gray-600 mb-8 max-w-lg">
                    Sistem akan mengambil seluruh dataset dari database, melatih model Naive Bayes (Gaussian/Categorical), dan menghitung akurasi serta matriks evaluasi.
                </p>

                <form action="<?= base_url('analisis/proses') ?>" method="post" onsubmit="showLoading()">
                    <?= csrf_field() ?>
                    <button type="submit" class="group relative bg-[#628141] hover:bg-[#1B211A] text-white font-bold py-4 px-10 rounded-xl shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                        <span class="flex items-center gap-3 text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 group-hover:animate-spin" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Mulai Analisis Sekarang
                        </span>
                    </button>
                </form>

                <p class="mt-6 text-sm text-[#8BAE66] font-medium flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Proses mungkin memakan waktu beberapa detik tergantung jumlah data.
                </p>
            </div>
        </div>

    </div>
</div>

<div id="loadingOverlay" class="fixed inset-0 bg-[#1B211A] bg-opacity-90 z-50 hidden flex flex-col items-center justify-center text-white">
    <div class="animate-spin rounded-full h-20 w-20 border-t-4 border-b-4 border-[#8BAE66] mb-4"></div>
    <h2 class="text-2xl font-bold mb-2">Sedang Menganalisis...</h2>
    <p class="text-[#EBD5AB]">Mohon jangan tutup halaman ini.</p>
</div>

<script>
    function showLoading() {
        document.getElementById('loadingOverlay').classList.remove('hidden');
    }
</script>

<?= $this->endSection(); ?>