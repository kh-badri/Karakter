<?php helper('form'); ?>
<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="min-h-screen bg-[#EAEAEA] py-10 px-4 font-sans text-gray-800">
    <div class="container mx-auto max-w-7xl">

        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="text-gray-500 font-bold text-sm uppercase tracking-wide">Detail History</span>
                    <span class="text-gray-400">|</span>
                    <span class="text-gray-500 text-sm"><?= date('d F Y H:i', strtotime($tanggal_simpan)) ?></span>
                </div>
                <h1 class="text-3xl font-extrabold text-[#2DAA9E]">Laporan Prediksi SES</h1>
            </div>

            <a href="<?= base_url('history') ?>" class="bg-white text-gray-600 px-5 py-3 rounded-xl font-bold shadow-sm border border-gray-200 hover:bg-gray-50 transition-all flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Kembali ke Daftar
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-[#2DAA9E] rounded-2xl p-6 shadow-lg text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-white opacity-10 blur-2xl"></div>
                <p class="text-[#E3D2C3] font-bold text-xs uppercase tracking-wider mb-2">Prediksi (Ft+1)</p>
                <div class="flex items-baseline gap-2">
                    <h2 class="text-5xl font-black mb-2"><?= $prediksi_next ?></h2>
                    <span class="text-sm font-medium opacity-80">Pasang</span>
                </div>
                <div class="mt-2 text-xs bg-white/20 inline-block px-2 py-1 rounded">
                    Target: <?= $periode_target ?>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-md border-b-4 border-[#66D2CE] flex flex-col justify-center">
                <div class="flex justify-between border-b border-gray-100 pb-2 mb-2">
                    <span class="text-gray-500 font-bold text-sm">Alpha (α)</span>
                    <span class="text-[#2DAA9E] font-black text-lg"><?= $alpha ?></span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-500 font-bold text-sm">Akurasi</span>
                    <span class="text-[#2DAA9E] font-black text-lg"><?= $akurasi ?>%</span>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-md border-b-4 border-[#E3D2C3] flex flex-col justify-center">
                <p class="text-gray-400 font-bold text-xs uppercase tracking-wider mb-1">Rata-rata Error (MAPE)</p>
                <h2 class="text-4xl font-bold text-gray-700 mb-1"><?= $mape ?>%</h2>
                <span class="text-xs text-gray-400">Semakin kecil semakin baik.</span>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-[#E3D2C3]/50">
            <h3 class="font-bold text-gray-700 mb-4 flex items-center gap-2">
                <span class="w-2 h-6 bg-[#2DAA9E] rounded-full"></span>
                Grafik Historis
            </h3>
            <div class="relative h-80 w-full">
                <canvas id="historyChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-[#E3D2C3]/50">
            <div class="px-8 py-6 bg-white border-b-2 border-[#EAEAEA]">
                <h3 class="font-bold text-gray-800 text-lg">Rincian Perhitungan</h3>
            </div>

            <div class="overflow-x-auto h-[500px] custom-scrollbar">
                <table class="w-full text-left border-collapse relative">
                    <thead class="sticky top-0 z-10 shadow-sm">
                        <tr class="bg-[#2DAA9E] text-white uppercase text-sm font-bold tracking-wider">
                            <th class="p-4 w-16 text-center">No</th>
                            <th class="p-4">Bulan/Tahun</th>
                            <th class="p-4 text-right">Data Aktual</th>
                            <th class="p-4 text-right bg-[#25968a]">Prediksi</th>
                            <th class="p-4 text-right">Error (APE)</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 font-medium text-sm">
                        <?php if ($hasil_tabel) : ?>
                            <?php foreach ($hasil_tabel as $i => $row) : ?>
                                <tr class="border-b border-[#EAEAEA] hover:bg-[#66D2CE]/10 transition-colors">
                                    <td class="p-4 text-center text-[#2DAA9E] font-bold"><?= $i + 1 ?></td>
                                    <td class="p-4">
                                        <?= DateTime::createFromFormat('!m', $row['bulan'])->format('F') ?> <?= $row['tahun'] ?>
                                    </td>
                                    <td class="p-4 text-right font-bold"><?= $row['aktual'] ?></td>
                                    <td class="p-4 text-right font-bold text-[#2DAA9E] bg-[#66D2CE]/10">
                                        <?= number_format($row['prediksi'], 2) ?>
                                    </td>
                                    <td class="p-4 text-right text-gray-500">
                                        <?= number_format($row['error'], 2) ?>%
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-400">Detail data tidak tersedia untuk history ini.</td>
                            </tr>
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

<script>
    const ctx = document.getElementById('historyChart').getContext('2d');
    const historyChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($chart_labels) ?>,
            datasets: [{
                    label: 'Aktual',
                    data: <?= json_encode($chart_aktual) ?>,
                    borderColor: '#9CA3AF',
                    backgroundColor: '#9CA3AF',
                    borderWidth: 2,
                    pointRadius: 3,
                    tension: 0.1,
                    fill: false
                },
                {
                    label: 'Prediksi',
                    data: <?= json_encode($chart_prediksi) ?>,
                    borderColor: '#2DAA9E',
                    backgroundColor: '#2DAA9E',
                    borderWidth: 3,
                    pointRadius: 4,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#2DAA9E',
                    tension: 0.3,
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            interaction: {
                mode: 'index',
                intersect: false
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#EAEAEA',
                        borderDash: [5, 5]
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
</script>

<?= $this->endSection(); ?>