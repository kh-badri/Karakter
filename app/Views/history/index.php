<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="min-h-screen bg-[#EBD5AB]/20 py-10 px-4 font-sans text-[#1B211A]">
    <div class="container mx-auto max-w-6xl">

        <div class="flex flex-col md:flex-row justify-between items-end mb-6 gap-4">
            <div>
                <h1 class="text-3xl font-bold text-[#1B211A]"><?= $title ?></h1>
                <p class="text-[#628141] font-medium mt-1">Daftar hasil analisis yang tersimpan</p>
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
            <div class="auto-dismiss-alert bg-red-100 border-l-4 border-[#1B211A] text-red-800 px-4 py-3 rounded shadow-sm mb-6 flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-800" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-semibold"><?= session()->getFlashdata('error') ?></span>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-xl shadow-lg border border-[#EBD5AB]/50 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-[#1B211A] text-[#EBD5AB] uppercase text-sm font-bold tracking-wider leading-normal">
                            <th class="p-5">No</th>
                            <th class="p-5">Tanggal & Waktu</th>
                            <th class="p-5">Total Data</th>
                            <th class="p-5">Akurasi</th>
                            <th class="p-5 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="text-[#1B211A] font-medium">
                        <?php if (empty($history)) : ?>
                            <tr>
                                <td colspan="5" class="p-10 text-center bg-[#EBD5AB]/10 text-[#628141]">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-4 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-xl font-bold">Belum Ada Riwayat</p>
                                    <p class="font-normal text-sm mt-1">Lakukan analisis baru untuk menyimpan hasil di sini.</p>
                                </td>
                            </tr>
                        <?php else : ?>
                            <?php foreach ($history as $i => $h) : ?>
                                <tr class="border-b border-gray-100 hover:bg-[#8BAE66]/10 transition-colors duration-150">

                                    <td class="p-5 text-[#628141] font-bold"><?= $i + 1 ?></td>

                                    <td class="p-5">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-lg text-[#1B211A]"><?= date('d M Y', strtotime($h['tanggal'])) ?></span>
                                            <span class="text-xs text-[#628141] font-semibold flex items-center gap-1">
                                            </span>
                                        </div>
                                    </td>

                                    <td class="p-5">
                                        <span class="bg-[#EBD5AB]/30 text-[#1B211A] border border-[#EBD5AB] py-1 px-3 rounded-full text-sm font-bold">
                                            <?= number_format($h['total_data']) ?> Baris
                                        </span>
                                    </td>

                                    <td class="p-5">
                                        <?php
                                        // Warna badge akurasi sesuai logika
                                        $acc = $h['akurasi'] * 100;
                                        $bgAcc = '';

                                        if ($acc >= 80) {
                                            $bgAcc = 'bg-[#628141] text-white ring-2 ring-[#628141]/20';
                                        } elseif ($acc >= 60) {
                                            $bgAcc = 'bg-[#8BAE66] text-[#1B211A] ring-1 ring-[#1B211A]/10';
                                        } else {
                                            $bgAcc = 'bg-red-100 text-red-800 border border-red-200';
                                        }
                                        ?>
                                        <span class="<?= $bgAcc ?> py-1.5 px-3 rounded-md text-sm font-bold shadow-sm inline-block min-w-[80px] text-center">
                                            <?= round($acc, 1) ?>%
                                        </span>
                                    </td>

                                    <td class="p-5 text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="<?= base_url('history/detail/' . $h['id']) ?>"
                                                class="bg-[#8BAE66] hover:bg-[#628141] text-white p-2.5 rounded-lg transition shadow-sm border border-transparent hover:border-[#1B211A]/20"
                                                title="Lihat Detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                    <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                                </svg>
                                            </a>

                                            <form action="<?= base_url('history/delete/' . $h['id']) ?>" method="post" onsubmit="return confirm('APAKAH ANDA YAKIN?\nData riwayat ini akan dihapus permanen.');">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit"
                                                    class="bg-white text-red-600 hover:bg-red-50 hover:text-red-700 border border-red-200 p-2.5 rounded-lg transition shadow-sm"
                                                    title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </form>
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

<script>
    // Auto dismiss alert
    document.addEventListener('DOMContentLoaded', () => {
        const alerts = document.querySelectorAll('.auto-dismiss-alert');
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(() => alert.remove(), 500);
            }, 3000);
        });
    });
</script>

<?= $this->endSection(); ?>