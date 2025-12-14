<?php helper('form'); ?>
<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="min-h-screen bg-[#EAEAEA] py-4 px-4 font-sans text-gray-800 flex items-center justify-center">
    <div class="container max-w-xl">

        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-[#2DAA9E] mb-2">Mulai Prediksi</h1>
            <p class="text-gray-600">Masukkan parameter Alpha untuk menghitung peramalan.</p>
        </div>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm" role="alert">
                <p class="font-bold">Error</p>
                <p><?= session()->getFlashdata('error') ?></p>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="bg-[#66D2CE]/30 border-l-4 border-[#2DAA9E] text-[#2DAA9E] p-4 mb-6 rounded shadow-sm" role="alert">
                <p class="font-bold">Sukses</p>
                <p><?= session()->getFlashdata('success') ?></p>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-[#E3D2C3]">
            <div class="bg-[#2DAA9E] px-8 py-6">
                <h3 class="text-xl font-bold text-white flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    Parameter SES
                </h3>
            </div>

            <form action="<?= base_url('prediksi/proses') ?>" method="post" class="p-8">
                <?= csrf_field() ?>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">
                        Nilai Alpha (α)
                    </label>
                    <div class="relative">
                        <input type="number" step="0.1" min="0.1" max="0.9" name="alpha" class="block w-full rounded-xl border-2 border-[#EAEAEA] bg-[#EAEAEA]/30 shadow-sm focus:border-[#2DAA9E] focus:ring focus:ring-[#2DAA9E]/20 text-gray-800 font-bold  p-4 text-lg" placeholder="Contoh: 0.5" required>
                        <div class="absolute right-10 top-6 text-gray-400 text-sm font-medium">0.1 - 0.9</div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2 ml-1">Semakin besar alpha, semakin responsif terhadap perubahan data terbaru.</p>
                </div>

                <button type="submit" class="w-full py-4 rounded-xl bg-[#2DAA9E] text-white font-bold shadow-lg hover:shadow-xl hover:bg-[#1f7a70] transition-all transform hover:-translate-y-1 flex justify-center items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                    Hitung Prediksi
                </button>
            </form>
        </div>

    </div>
</div>
<?= $this->endSection(); ?>