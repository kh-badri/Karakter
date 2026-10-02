<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="max-w-7xl mx-auto font-sans text-gray-800">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-6">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="px-2 py-0.5 bg-color-1/10 text-color-1 rounded text-[10px] font-bold uppercase tracking-wider">
                    Manajemen Data
                </span>
            </div>
            <h1 class="text-xl md:text-2xl font-extrabold text-gray-800 tracking-tight">
                Riwayat Hasil <span class="text-transparent bg-clip-text bg-gradient-to-r from-color-1 to-[#9c7d63]">Klasifikasi</span>
            </h1>
            <p class="text-xs text-gray-500 font-medium mt-1">Data hasil perhitungan klasifikasi karakter siswa yang telah disimpan.</p>
        </div>
        
        <?php if (!empty($riwayat)) : ?>
            <button onclick="confirmHapusSemua()" class="bg-red-50 hover:bg-red-100 text-red-600 border border-red-200 px-3 py-1.5 rounded-md text-xs font-bold shadow-sm transition-colors flex items-center gap-1.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Bersihkan Riwayat
            </button>
        <?php endif; ?>
    </div>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="bg-green-50 border-l-4 border-green-500 p-3 rounded-lg mb-4 flex items-center gap-2 shadow-sm">
            <div class="bg-green-100 p-1 rounded-full text-green-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
            </div>
            <p class="text-xs font-bold text-green-800"><?= session()->getFlashdata('success') ?></p>
        </div>
    <?php endif; ?>

    <!-- Table Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-100">
                        <th class="px-4 py-3 text-[10px] font-extrabold text-gray-500 uppercase tracking-widest w-12 text-center">No</th>
                        <th class="px-4 py-3 text-[10px] font-extrabold text-gray-500 uppercase tracking-widest">Waktu Simpan</th>
                        <th class="px-4 py-3 text-[10px] font-extrabold text-gray-500 uppercase tracking-widest">Nama Siswa</th>
                        <th class="px-4 py-3 text-[10px] font-extrabold text-gray-500 uppercase tracking-widest text-center">Data 6 Atribut (1-5)</th>
                        <th class="px-4 py-3 text-[10px] font-extrabold text-gray-500 uppercase tracking-widest text-center border-l border-gray-100">Hasil NB</th>
                        <th class="px-4 py-3 text-[10px] font-extrabold text-gray-500 uppercase tracking-widest text-center">Hasil RF</th>
                        <th class="px-4 py-3 text-[10px] font-extrabold text-gray-500 uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <?php if (empty($riwayat)) : ?>
                        <tr>
                            <td colspan="7" class="px-4 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-3 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                    </svg>
                                    <p class="text-sm font-bold text-gray-500">Belum Ada Riwayat Tersimpan</p>
                                    <p class="text-xs text-gray-400 mt-1">Lakukan klasifikasi lalu klik tombol "Simpan Hasil".</p>
                                </div>
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php $no = 1; foreach ($riwayat as $row) : ?>
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-4 py-3 text-xs font-bold text-gray-400 text-center"><?= $no++ ?></td>
                                <td class="px-4 py-3 text-xs text-gray-600 font-medium">
                                    <?= date('d M Y', strtotime($row['tanggal_simpan'])) ?><br>
                                    <span class="text-[10px] text-gray-400"><?= date('H:i', strtotime($row['tanggal_simpan'])) ?> WIB</span>
                                </td>
                                <td class="px-4 py-3 text-xs font-extrabold text-gray-800">
                                    <?= esc($row['nama_siswa']) ?>
                                </td>
                                <td class="px-4 py-3 text-[10px] text-gray-500 font-mono text-center">
                                    <span title="Sosial"><?= $row['bersosialisasi'] ?></span> -
                                    <span title="Pendapat"><?= $row['berpendapat'] ?></span> -
                                    <span title="Emosi"><?= $row['kestabilan_emosi'] ?></span> -
                                    <span title="Disiplin"><?= $row['kedisiplinan'] ?></span> -
                                    <span title="Peduli"><?= $row['kepedulian'] ?></span> -
                                    <span title="Bersih"><?= $row['kebersihan'] ?></span>
                                </td>
                                <td class="px-4 py-3 text-xs font-bold text-center border-l border-gray-100">
                                    <span class="px-2 py-0.5 bg-blue-50 text-blue-700 rounded border border-blue-100">
                                        <?= esc($row['hasil_nb']) ?>
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-xs font-bold text-center">
                                    <span class="px-2 py-0.5 bg-green-50 text-green-700 rounded border border-green-100">
                                        <?= esc($row['hasil_rf']) ?>
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="<?= base_url('history/detail/' . $row['id']) ?>" class="p-1.5 text-gray-400 hover:text-blue-500 hover:bg-blue-50 rounded-md transition-colors inline-flex" title="Lihat Detail Klasifikasi">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <button onclick="confirmDelete(<?= $row['id'] ?>)" class="p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-md transition-colors inline-flex" title="Hapus Riwayat">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Hapus Riwayat?',
        text: "Data yang dihapus tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#9ca3af',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '<?= base_url('history/delete/') ?>' + id;
        }
    })
}

function confirmHapusSemua() {
    Swal.fire({
        title: 'Bersihkan Semua Riwayat?',
        text: "Seluruh data riwayat klasifikasi akan dihapus permanen!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#9ca3af',
        confirmButtonText: 'Ya, Bersihkan!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '<?= base_url('history/hapus-semua') ?>';
        }
    })
}
</script>

<?= $this->endSection(); ?>