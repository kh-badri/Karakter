<?php helper('form'); ?>
<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="min-h-screen bg-[#EAEAEA] py-8 font-sans text-gray-800">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-[#2DAA9E]">Dashboard</h1>
        <p class="text-gray-600 mt-1">Selamat datang kembali, Berikut adalah ringkasan data pernikahan.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <div class="bg-white rounded-2xl p-6 shadow-sm border-l-4 border-[#2DAA9E] flex items-center justify-between group hover:shadow-md transition-all">
            <div>
                <p class="text-gray-400 font-bold text-xs uppercase tracking-wider mb-1">Total Data Masuk</p>
                <h2 class="text-3xl font-black text-gray-800"><?= $total_data ?></h2>
                <a href="<?= base_url('data-nikah') ?>" class="text-xs text-[#2DAA9E] font-bold hover:underline mt-1 inline-block">Lihat Detail &rarr;</a>
            </div>
            <div class="p-3 bg-[#E3D2C3]/30 rounded-xl text-[#2DAA9E] group-hover:bg-[#2DAA9E] group-hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border-l-4 border-[#66D2CE] flex items-center justify-between group hover:shadow-md transition-all">
            <div>
                <p class="text-gray-400 font-bold text-xs uppercase tracking-wider mb-1">Total Peramalan</p>
                <h2 class="text-3xl font-black text-gray-800"><?= $total_history ?></h2>
                <a href="<?= base_url('history') ?>" class="text-xs text-[#66D2CE] font-bold hover:underline mt-1 inline-block">Lihat Riwayat &rarr;</a>
            </div>
            <div class="p-3 bg-[#E3D2C3]/30 rounded-xl text-[#66D2CE] group-hover:bg-[#66D2CE] group-hover:text-white transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
            </div>
        </div>

        <div class="bg-[#2DAA9E] rounded-2xl p-6 shadow-lg text-white relative overflow-hidden group">
            <div class="absolute top-0 right-0 -mr-6 -mt-6 w-24 h-24 rounded-full bg-white opacity-10 group-hover:scale-110 transition-transform"></div>

            <p class="text-[#E3D2C3] font-bold text-xs uppercase tracking-wider mb-2">Prediksi Terakhir</p>
            <div class="flex items-baseline gap-2">
                <h2 class="text-4xl font-black"><?= $last_prediksi ?></h2>
                <span class="text-sm opacity-80">Pasang</span>
            </div>
            <p class="text-xs mt-2 bg-white/20 inline-block px-2 py-1 rounded">
                Target: <?= $last_target ?>
            </p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-[#E3D2C3]/50 p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-gray-800 flex items-center gap-2">
                    <span class="w-2 h-6 bg-[#2DAA9E] rounded-full"></span>
                    Grafik Tren Data Pernikahan
                </h3>
                <span class="text-xs text-gray-400 bg-[#EAEAEA] px-2 py-1 rounded">Data Aktual</span>
            </div>

            <div class="relative h-80 w-full">
                <canvas id="mainChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-[#E3D2C3]/50 overflow-hidden flex flex-col">
            <div class="p-6 border-b border-[#EAEAEA] bg-[#fdfbf7]">
                <h3 class="font-bold text-gray-800">Aktivitas Terbaru</h3>
                <p class="text-xs text-gray-500">5 Perhitungan terakhir</p>
            </div>

            <div class="flex-1 overflow-y-auto custom-scrollbar p-2">
                <?php if (empty($recent_history)) : ?>
                    <div class="text-center py-10 text-gray-400">
                        <p class="text-sm">Belum ada aktivitas.</p>
                        <a href="<?= base_url('prediksi') ?>" class="text-[#2DAA9E] text-xs font-bold hover:underline">Mulai Prediksi Sekarang</a>
                    </div>
                <?php else : ?>
                    <div class="space-y-2">
                        <?php foreach ($recent_history as $row) : ?>
                            <div class="flex items-center justify-between p-3 hover:bg-[#EAEAEA]/40 rounded-xl transition-colors border border-transparent hover:border-[#E3D2C3]">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-[#E3D2C3]/40 text-[#2DAA9E] flex items-center justify-center font-bold text-xs">
                                        <?= substr($row['periode_target'], 0, 3) ?>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-700"><?= $row['periode_target'] ?></p>
                                        <p class="text-[10px] text-gray-400"><?= date('d M H:i', strtotime($row['tanggal_simpan'])) ?></p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-black text-[#2DAA9E]"><?= $row['hasil_prediksi'] ?></p>
                                    <p class="text-[10px] text-gray-500">MAPE: <?= number_format($row['mape'], 1) ?>%</p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="p-3 border-t border-[#EAEAEA] text-center">
                <a href="<?= base_url('history') ?>" class="text-xs font-bold text-[#66D2CE] hover:text-[#2DAA9E] uppercase tracking-wide">Lihat Semua Riwayat</a>
            </div>
        </div>
    </div>
</div>

<script>
    const ctx = document.getElementById('mainChart').getContext('2d');

    // Gradien Warna untuk Chart
    let gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(45, 170, 158, 0.2)'); // #2DAA9E opacity 0.2
    gradient.addColorStop(1, 'rgba(45, 170, 158, 0)');

    const mainChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($chart_labels) ?>,
            datasets: [{
                label: 'Jumlah Nikah',
                data: <?= json_encode($chart_values) ?>,
                borderColor: '#2DAA9E',
                backgroundColor: gradient,
                borderWidth: 2,
                pointBackgroundColor: '#fff',
                pointBorderColor: '#2DAA9E',
                pointRadius: 3,
                pointHoverRadius: 6,
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(27, 33, 26, 0.8)',
                    titleColor: '#EBD5AB',
                    padding: 10,
                    cornerRadius: 8,
                    displayColors: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#f3f4f6'
                    },
                    ticks: {
                        font: {
                            size: 10
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 10
                        },
                        maxRotation: 0,
                        autoSkip: true,
                        maxTicksLimit: 8
                    }
                }
            }
        }
    });
</script>

<?= $this->endSection(); ?>