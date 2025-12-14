<?php helper('form'); ?>
<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="min-h-screen bg-[#EAEAEA] py-10 px-4 font-sans text-gray-800">
    <div class="container mx-auto max-w-7xl">

        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-[#2DAA9E]">Hasil Prediksi SES</h1>
                <div class="flex items-center gap-3 mt-1">
                    <span class="bg-[#E3D2C3] text-[#2DAA9E] px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider">
                        Alpha: <?= $alpha ?>
                    </span>
                    <span class="text-gray-500 text-sm font-medium">
                        Target: <?= $periode_target ?>
                    </span>
                </div>
            </div>

            <div class="flex gap-3">
                <button onclick="openModal('modalRumus')" class="bg-[#E3D2C3] text-[#2DAA9E] px-5 py-3 rounded-xl font-bold shadow-sm border border-[#2DAA9E]/30 hover:bg-[#d4c3b3] transition-all flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" />
                        <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" />
                    </svg>
                    Lihat Cara Hitung
                </button>

                <a href="<?= base_url('prediksi') ?>" class="bg-white text-gray-600 px-5 py-3 rounded-xl font-bold shadow-sm border border-gray-200 hover:bg-gray-50 transition-all flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Hitung Ulang
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <div class="bg-[#2DAA9E] rounded-2xl p-6 shadow-lg text-white relative overflow-hidden group hover:scale-[1.02] transition-transform duration-300">
                <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-white opacity-10 blur-2xl"></div>

                <p class="text-[#E3D2C3] font-bold text-xs uppercase tracking-wider mb-2">Prediksi Bulan Depan</p>
                <div class="flex items-baseline gap-2">
                    <h2 class="text-5xl font-black mb-2"><?= $prediksi_next ?></h2>
                    <span class="text-sm font-medium opacity-80">Pasang</span>
                </div>
                <div class="mt-2 text-xs bg-white/20 inline-block px-2 py-1 rounded">
                    Periode: <?= $periode_target ?>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-md border-b-4 border-[#66D2CE]">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-400 font-bold text-xs uppercase tracking-wider mb-2">Rata-rata Error (MAPE)</p>
                        <h2 class="text-4xl font-bold text-gray-700"><?= $mape ?>%</h2>
                    </div>
                    <div class="p-2 bg-[#EAEAEA] rounded-lg text-[#2DAA9E]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="px-2 py-1 rounded text-xs font-bold <?= $mape < 20 ? 'bg-green-100 text-green-700' : ($mape < 50 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') ?>">
                        Kriteria: <?= $mape < 10 ? 'Sangat Baik' : ($mape < 20 ? 'Baik' : ($mape < 50 ? 'Cukup' : 'Buruk')) ?>
                    </span>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-md border-b-4 border-[#E3D2C3] flex flex-col justify-between">
                <div>
                    <p class="text-gray-400 font-bold text-xs uppercase tracking-wider mb-1">Tingkat Akurasi</p>
                    <h2 class="text-3xl font-bold text-[#2DAA9E]"><?= $akurasi ?>%</h2>
                </div>

                <form action="<?= base_url('prediksi/simpan') ?>" method="post" class="mt-4">
                    <?= csrf_field() ?>
                    <input type="hidden" name="alpha" value="<?= $alpha ?>">
                    <input type="hidden" name="periode_target" value="<?= $periode_target ?>">
                    <input type="hidden" name="hasil_prediksi" value="<?= $prediksi_next ?>">
                    <input type="hidden" name="mape" value="<?= $mape ?>">
                    <input type="hidden" name="akurasi" value="<?= $akurasi ?>">
                    <input type="hidden" name="detail_json" value='<?= json_encode($hasil_tabel) ?>'>

                    <button type="submit" class="w-full py-2.5 rounded-lg bg-[#66D2CE] hover:bg-[#2DAA9E] text-white font-bold transition-all shadow hover:shadow-md flex justify-center items-center gap-2 text-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M7.707 10.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V6h5a2 2 0 012 2v7a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2h5v5.586l-1.293-1.293zM9 4a1 1 0 012 0v2H9V4z" />
                        </svg>
                        Simpan ke History
                    </button>
                </form>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-[#E3D2C3]/50">
            <h3 class="font-bold text-gray-700 mb-4 flex items-center gap-2">
                <span class="w-2 h-6 bg-[#2DAA9E] rounded-full"></span>
                Grafik Perbandingan Aktual vs Prediksi
            </h3>
            <div class="relative h-80 w-full">
                <canvas id="predictionChart"></canvas>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-[#E3D2C3]/50">
            <div class="px-8 py-6 bg-white border-b-2 border-[#EAEAEA] flex justify-between items-center">
                <div>
                    <h3 class="font-bold text-gray-800 text-lg">Detail Perhitungan</h3>
                    <p class="text-sm text-gray-400">Rincian perhitungan per periode (Scroll kebawah).</p>
                </div>
                <div class="hidden md:block">
                    <span class="text-xs font-mono bg-[#EAEAEA] px-2 py-1 rounded text-gray-600">F<sub>t+1</sub> = αX<sub>t</sub> + (1-α)F<sub>t</sub></span>
                </div>
            </div>

            <div class="overflow-x-auto h-[500px] custom-scrollbar">
                <table class="w-full text-left border-collapse relative">
                    <thead class="sticky top-0 z-10 shadow-sm">
                        <tr class="bg-[#2DAA9E] text-white uppercase text-sm font-bold tracking-wider">
                            <th class="p-4 w-16 text-center">No</th>
                            <th class="p-4">Bulan/Tahun</th>
                            <th class="p-4 text-right">Data Aktual (Xt)</th>
                            <th class="p-4 text-right bg-[#25968a]">Prediksi (Ft)</th>
                            <th class="p-4 text-right">Error (APE)</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 font-medium text-sm">
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

                        <tr class="bg-[#E3D2C3]/30 border-t-2 border-[#2DAA9E] font-bold">
                            <td class="p-4 text-center text-[#2DAA9E]"><?= count($hasil_tabel) + 1 ?></td>
                            <td class="p-4 text-[#2DAA9E] flex items-center gap-2">
                                <?= $periode_target ?>
                                <span class="bg-[#2DAA9E] text-white text-[10px] px-2 py-0.5 rounded-full uppercase">Target</span>
                            </td>
                            <td class="p-4 text-right text-gray-400">-</td>
                            <td class="p-4 text-right text-white bg-[#2DAA9E] shadow-inner text-lg">
                                <?= $prediksi_next ?>
                            </td>
                            <td class="p-4 text-right text-gray-400">-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="modalRumus" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="fixed inset-0 bg-gray-900/70 backdrop-blur-sm transition-opacity" onclick="closeModal('modalRumus')"></div>

        <div class="bg-white rounded-3xl overflow-hidden shadow-2xl transform transition-all sm:max-w-3xl w-full relative z-10">
            <div class="bg-[#2DAA9E] px-8 py-6 flex justify-between items-center">
                <h3 class="text-xl font-bold text-white flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 36v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    Simulasi Perhitungan Manual
                </h3>
                <button onclick="closeModal('modalRumus')" class="text-white/70 hover:text-white text-3xl leading-none">&times;</button>
            </div>

            <div class="p-8 h-[600px] overflow-y-auto custom-scrollbar">

                <div class="mb-8">
                    <h4 class="font-bold text-gray-800 text-lg mb-2 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-[#66D2CE] text-white flex items-center justify-center text-sm">1</span>
                        Rumus Single Exponential Smoothing
                    </h4>
                    <div class="bg-[#EAEAEA] p-6 rounded-xl text-center border border-gray-300 shadow-inner">
                        <div class="text-2xl font-serif font-bold text-gray-800 tracking-wide">
                            F<sub>t+1</sub> = α . X<sub>t</sub> + (1 - α) . F<sub>t</sub>
                        </div>
                    </div>
                    <div class="mt-4 grid grid-cols-2 gap-4 text-sm text-gray-600 bg-white border border-[#E3D2C3] p-4 rounded-xl">
                        <div>
                            <span class="font-bold text-[#2DAA9E]">F<sub>t+1</sub></span> : Nilai Ramalan periode berikutnya
                        </div>
                        <div>
                            <span class="font-bold text-[#2DAA9E]">X<sub>t</sub></span> : Data Aktual periode saat ini
                        </div>
                        <div>
                            <span class="font-bold text-[#2DAA9E]">α (Alpha)</span> : Konstanta (<?= $alpha ?>)
                        </div>
                        <div>
                            <span class="font-bold text-[#2DAA9E]">F<sub>t</sub></span> : Nilai Ramalan periode saat ini
                        </div>
                    </div>
                </div>

                <?php if (count($hasil_tabel) >= 2): ?>
                    <div class="mb-8">
                        <h4 class="font-bold text-gray-800 text-lg mb-4 flex items-center gap-2">
                            <span class="w-8 h-8 rounded-full bg-[#66D2CE] text-white flex items-center justify-center text-sm">2</span>
                            Langkah Inisialisasi (Bulan Pertama)
                        </h4>
                        <div class="bg-white border-l-4 border-[#2DAA9E] p-4 shadow-sm rounded-r-xl bg-[#EAEAEA]/20">
                            <p class="text-gray-700 mb-2">
                                Pada periode pertama, belum ada data peramalan sebelumnya. Maka nilai peramalan disamakan dengan data aktual pertama.
                            </p>
                            <div class="font-mono bg-white p-3 rounded border border-gray-200 inline-block text-[#2DAA9E] font-bold">
                                F<sub>1</sub> = X<sub>1</sub> = <?= $hasil_tabel[0]['aktual'] ?>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h4 class="font-bold text-gray-800 text-lg mb-4 flex items-center gap-2">
                            <span class="w-8 h-8 rounded-full bg-[#66D2CE] text-white flex items-center justify-center text-sm">3</span>
                            Contoh Perhitungan: Periode Ke-2
                        </h4>
                        <div class="bg-white border border-[#E3D2C3] rounded-xl p-5 shadow-sm relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-16 h-16 bg-[#E3D2C3] rounded-bl-full opacity-50"></div>

                            <p class="text-sm text-gray-500 mb-4">Mencari nilai prediksi periode ke-2 (F<sub>2</sub>) menggunakan data periode 1.</p>

                            <div class="space-y-3 font-mono text-sm md:text-base text-gray-700">
                                <div class="flex flex-col md:flex-row gap-2 border-b border-dashed border-gray-200 pb-2">
                                    <span class="font-bold w-24">Rumus:</span>
                                    <span>F<sub>2</sub> = α . X<sub>1</sub> + (1 - α) . F<sub>1</sub></span>
                                </div>
                                <div class="flex flex-col md:flex-row gap-2 border-b border-dashed border-gray-200 pb-2">
                                    <span class="font-bold w-24">Substitusi:</span>
                                    <span>F<sub>2</sub> = <?= $alpha ?> . <?= $hasil_tabel[0]['aktual'] ?> + (1 - <?= $alpha ?>) . <?= $hasil_tabel[0]['prediksi'] ?></span>
                                </div>
                                <div class="flex flex-col md:flex-row gap-2 border-b border-dashed border-gray-200 pb-2">
                                    <span class="font-bold w-24">Hitung:</span>
                                    <span>F<sub>2</sub> = <?= $alpha * $hasil_tabel[0]['aktual'] ?> + <?= (1 - $alpha) * $hasil_tabel[0]['prediksi'] ?></span>
                                </div>
                                <div class="flex flex-col md:flex-row gap-2 bg-[#2DAA9E]/10 p-2 rounded text-[#2DAA9E]">
                                    <span class="font-bold w-24">Hasil:</span>
                                    <span class="font-bold">F<sub>2</sub> = <?= number_format(($alpha * $hasil_tabel[0]['aktual']) + ((1 - $alpha) * $hasil_tabel[0]['prediksi']), 2) ?></span>
                                </div>
                            </div>
                            <p class="text-xs text-gray-400 mt-2 italic">*Nilai ini akan muncul pada kolom Prediksi baris ke-2.</p>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="mb-4">
                    <h4 class="font-bold text-gray-800 text-lg mb-4 flex items-center gap-2">
                        <span class="w-8 h-8 rounded-full bg-[#66D2CE] text-white flex items-center justify-center text-sm">4</span>
                        Menghitung Target: <?= $periode_target ?>
                    </h4>

                    <?php
                    $lastIdx = count($hasil_tabel) - 1;
                    $lastRow = $hasil_tabel[$lastIdx];
                    ?>

                    <div class="bg-[#2DAA9E] text-white rounded-xl p-6 shadow-lg relative">
                        <p class="mb-4 opacity-90 text-sm">
                            Menggunakan data terakhir (Bulan ke-<?= count($hasil_tabel) ?>) untuk meramal masa depan:
                        </p>

                        <div class="grid grid-cols-2 gap-4 mb-4 text-center">
                            <div class="bg-white/20 p-2 rounded">
                                <div class="text-xs uppercase opacity-70">Data Aktual Terakhir (X<sub>t</sub>)</div>
                                <div class="font-bold text-xl"><?= $lastRow['aktual'] ?></div>
                            </div>
                            <div class="bg-white/20 p-2 rounded">
                                <div class="text-xs uppercase opacity-70">Prediksi Terakhir (F<sub>t</sub>)</div>
                                <div class="font-bold text-xl"><?= number_format($lastRow['prediksi'], 2) ?></div>
                            </div>
                        </div>

                        <div class="font-mono text-sm space-y-2 bg-black/20 p-4 rounded-lg">
                            <div>F<sub>next</sub> = (<?= $alpha ?> × <?= $lastRow['aktual'] ?>) + ((1 - <?= $alpha ?>) × <?= number_format($lastRow['prediksi'], 2) ?>)</div>
                            <div>F<sub>next</sub> = <?= $alpha * $lastRow['aktual'] ?> + <?= number_format((1 - $alpha) * $lastRow['prediksi'], 2) ?></div>
                            <div class="text-xl font-bold border-t border-white/30 pt-2 mt-2">
                                F<sub>next</sub> = <?= $prediksi_next ?>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="bg-gray-50 px-8 py-4 text-right border-t border-gray-100">
                <button onclick="closeModal('modalRumus')" class="bg-[#2DAA9E] text-white px-8 py-2 rounded-lg font-bold hover:bg-[#1f7a70] transition-all shadow-md">Tutup Penjelasan</button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling Scrollbar */
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
    // 1. Script Modal
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.body.style.overflow = 'hidden'; // Disable scroll body
    }

    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.body.style.overflow = 'auto'; // Enable scroll body
    }

    // 2. Script Grafik Chart.js
    const ctx = document.getElementById('predictionChart').getContext('2d');
    const predictionChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?= json_encode($chart_labels) ?>,
            datasets: [{
                    label: 'Data Aktual',
                    data: <?= json_encode($chart_aktual) ?>,
                    borderColor: '#9CA3AF', // Gray (Neutral)
                    backgroundColor: '#9CA3AF',
                    borderWidth: 2,
                    pointRadius: 3,
                    tension: 0.1,
                    fill: false
                },
                {
                    label: 'Hasil Prediksi',
                    data: <?= json_encode($chart_prediksi) ?>,
                    borderColor: '#2DAA9E', // Teal Utama
                    backgroundColor: '#2DAA9E',
                    borderWidth: 3,
                    pointRadius: 4,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#2DAA9E',
                    tension: 0.3, // Smooth curve
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        font: {
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(45, 170, 158, 0.9)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    padding: 10,
                    cornerRadius: 8,
                    displayColors: false
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
                    },
                    ticks: {
                        color: '#6B7280'
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#6B7280'
                    }
                }
            }
        }
    });
</script>

<?= $this->endSection(); ?>