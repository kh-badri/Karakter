<?php helper('form'); ?>
<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="min-h-screen bg-[#EAEAEA] py-4 px-4 font-sans text-gray-800">
    <div class="container mx-auto max-w-7xl">

        <div class="flex flex-col md:flex-row justify-between items-end mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-[#2DAA9E] tracking-tight"><?= $title ?></h1>
                <p class="text-gray-600 mt-1 font-medium">Arsip hasil perhitungan peramalan nikah.</p>
            </div>

            <div class="bg-white border-l-4 border-[#2DAA9E] px-6 py-3 rounded shadow-sm flex items-center gap-4">
                <div class="text-right">
                    <span class="block text-xs font-bold uppercase text-gray-400">Total Arsip</span>
                    <span class="text-2xl font-black text-[#2DAA9E]"><?= count($riwayat) ?></span>
                </div>
                <div class="p-2 bg-[#E3D2C3]/30 rounded-lg text-[#2DAA9E]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="auto-dismiss-alert bg-[#66D2CE]/30 border-l-4 border-[#2DAA9E] text-[#2DAA9E] px-4 py-3 rounded shadow-sm mb-6 flex items-center gap-3">
                <span class="font-bold"><?= session()->getFlashdata('success') ?></span>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-[#E3D2C3]/50">
            <div class="px-8 py-5 bg-white border-b-2 border-[#EAEAEA] flex justify-between items-center">
                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#2DAA9E]" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                    </svg>
                    Daftar Riwayat
                </h3>
                <?php if (!empty($riwayat)) : ?>
                    <form action="<?= base_url('history/hapus-semua') ?>" method="get" onsubmit="return confirm('Hapus SEMUA riwayat?');">
                        <button type="submit" class="text-xs font-bold text-red-500 hover:text-red-700 hover:bg-red-50 px-3 py-2 rounded transition-colors uppercase tracking-wider">
                            Hapus Semua
                        </button>
                    </form>
                <?php endif; ?>
            </div>

            <div class="overflow-x-auto h-[600px] custom-scrollbar">
                <table class="w-full text-left border-collapse relative">
                    <thead class="sticky top-0 z-10 shadow-sm">
                        <tr class="bg-[#2DAA9E] text-white uppercase text-xs font-bold tracking-wider">
                            <th class="p-5 text-center w-16">No</th>
                            <th class="p-5">Waktu Simpan</th>
                            <th class="p-5">Target Periode</th>
                            <th class="p-5 text-center">Alpha</th>
                            <th class="p-5 text-right">Hasil (Ft+1)</th>
                            <th class="p-5 text-center">MAPE</th>
                            <th class="p-5 text-center">Akurasi</th>
                            <th class="p-5 text-center w-32 bg-[#1f7a70]">Opsi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 font-medium text-sm">
                        <?php if (empty($riwayat)) : ?>
                            <tr>
                                <td colspan="8" class="p-16 text-center text-gray-400 bg-[#EAEAEA]/30">Belum ada riwayat tersimpan.</td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($riwayat as $i => $row) : ?>
                                <tr class="border-b border-[#EAEAEA] hover:bg-[#66D2CE]/10 transition-colors">
                                    <td class="p-5 text-center text-[#2DAA9E] font-bold"><?= $i + 1 ?></td>
                                    <td class="p-5">
                                        <div class="font-bold"><?= date('d M Y', strtotime($row['tanggal_simpan'])) ?></div>
                                        <div class="text-xs text-gray-500"><?= date('H:i', strtotime($row['tanggal_simpan'])) ?> WIB</div>
                                    </td>
                                    <td class="p-5">
                                        <span class="bg-[#E3D2C3]/40 px-3 py-1 rounded-md font-bold border border-[#E3D2C3]"><?= $row['periode_target'] ?></span>
                                    </td>
                                    <td class="p-5 text-center font-bold text-gray-600"><?= $row['alpha'] ?></td>
                                    <td class="p-5 text-right">
                                        <span class="text-lg font-black text-[#2DAA9E]"><?= $row['hasil_prediksi'] ?></span>
                                    </td>
                                    <td class="p-5 text-center">
                                        <?php $mape = $row['mape'];
                                        $bg = $mape < 20 ? 'bg-green-100 text-green-700' : ($mape < 50 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700'); ?>
                                        <span class="px-2 py-1 rounded font-bold text-xs <?= $bg ?>"><?= number_format($mape, 2) ?>%</span>
                                    </td>
                                    <td class="p-5 text-center font-bold"><?= number_format($row['akurasi'], 2) ?>%</td>
                                    <td class="p-5 text-center flex justify-center gap-2">
                                        <a href="<?= base_url('history/detail/' . $row['id']) ?>" class="bg-[#2DAA9E] text-white p-2 rounded-lg hover:bg-[#1f7a70] transition-colors shadow-sm" title="Lihat Detail">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                        <a href="<?= base_url('history/delete/' . $row['id']) ?>" onclick="return confirm('Hapus?');" class="bg-white border border-gray-200 text-gray-400 p-2 rounded-lg hover:text-red-500 hover:bg-red-50 transition-colors shadow-sm" title="Hapus">
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

<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #E3D2C3;
        border-radius: 0 0 8px 0;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: #2DAA9E;
        border-radius: 10px;
        border: 2px solid #E3D2C3;
    }

    .custom-scrollbar {
        scrollbar-width: thin;
        scrollbar-color: #2DAA9E #E3D2C3;
    }
</style>

<?= $this->endSection(); ?>