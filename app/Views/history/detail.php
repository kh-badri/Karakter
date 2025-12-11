<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<?php
// --- LOGIKA BISNIS UNTUK VIEW ---
if (isset($hasil) && $hasil['status'] == 'success') {
    $eval = $hasil['evaluasi'];
    $analisis = $hasil['analisis'];

    // 1. Akurasi
    $accuracyPct = round($eval['accuracy'] * 100, 1);

    // 2. Tren Dominan
    $probs = $analisis['class_probabilities'];
    $trend_label = array_keys($probs, max($probs))[0]; // Label dengan probabilitas tertinggi
    $trend_value = max($probs) * 100;

    // 3. Rekomendasi Strategi (Sama dengan halaman Analisis)
    $saran_judul = "";
    $saran_desc = "";
    $icon_saran = "";

    if (strtolower($trend_label) == 'tinggi') {
        $saran_judul = "Genjot Stok & Pengiriman";
        $saran_desc = "Prediksi menunjukkan daya beli konsumen sangat kuat. Pastikan stok unit Fast Moving (Beat, Vario, Scoopy) aman dan siapkan tim pengiriman ekstra.";
        $icon_saran = "🚀";
    } elseif (strtolower($trend_label) == 'sedang') {
        $saran_judul = "Pertahankan Layanan";
        $saran_desc = "Pasar stabil. Fokus pada Customer Retention dan layanan servis bengkel (AHASS) untuk menjaga loyalitas konsumen Honda.";
        $icon_saran = "⚖️";
    } else { // Rendah
        $saran_judul = "Aktifkan Promo & Diskon";
        $saran_desc = "Daya beli terdeteksi lemah. Disarankan meluncurkan promo 'DP Ringan', 'Potongan Tenor', atau diskon oli untuk memancing minat beli.";
        $icon_saran = "📢";
    }
}
?>

<div class="min-h-screen bg-[#EBD5AB]/20 py-10 px-4 font-sans text-[#1B211A]">
    <div class="container mx-auto max-w-6xl">

        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <div>
                <a href="<?= base_url('history') ?>" class="text-[#628141] font-bold hover:text-[#1B211A] flex items-center gap-2 mb-2 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Kembali ke Riwayat
                </a>
                <h1 class="text-3xl font-bold text-[#1B211A]">Detail Analisis</h1>
                <p class="text-sm text-gray-500 mt-1">Dianalisis pada: <?= date('d F Y, H:i', strtotime($tanggal)) ?> WIB</p>
            </div>
        </div>

        <?php if (isset($hasil) && $hasil['status'] == 'success') : ?>

            <div class="flex justify-center mb-8">
                <div class="bg-white p-1.5 rounded-xl shadow-sm border border-[#8BAE66]/50 inline-flex">
                    <button onclick="switchTab('awam')" id="btn-awam" class="px-6 py-2.5 rounded-lg text-sm font-bold transition-all bg-[#628141] text-white shadow-md flex items-center gap-2">
                        <span>📊</span> Kesimpulan & Strategi
                    </button>
                    <button onclick="switchTab('teknis')" id="btn-teknis" class="px-6 py-2.5 rounded-lg text-sm font-bold transition-all text-[#1B211A] hover:bg-[#EBD5AB]/30 flex items-center gap-2">
                        <span>⚙️</span> Perhitungan Teknis
                    </button>
                </div>
            </div>

            <div id="tab-awam" class="animate-fade-in-up">

                <div class="bg-white rounded-2xl shadow-xl border-l-8 border-[#628141] overflow-hidden mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-2">

                        <div class="p-8 flex flex-col justify-center bg-gray-50 border-r border-gray-100">
                            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-2">Tingkat Kepercayaan Model</h3>
                            <div class="flex items-end gap-3">
                                <span class="text-6xl font-extrabold text-[#1B211A]"><?= $accuracyPct ?>%</span>
                                <span class="text-sm font-medium text-[#628141] mb-2 bg-[#EBD5AB]/30 px-2 py-1 rounded">Akurasi Pengujian</span>
                            </div>
                            <p class="mt-4 text-sm text-gray-600 leading-relaxed">
                                Model Naive Bayes berhasil memprediksi pola pembelian konsumen Honda dengan tingkat akurasi sebesar <strong><?= $accuracyPct ?>%</strong>.
                            </p>
                        </div>

                        <div class="p-8 flex flex-col justify-center relative bg-white">
                            <h3 class="text-[#628141] font-bold text-sm uppercase tracking-wide mb-1">Prediksi Dominan</h3>
                            <p class="text-[#1B211A] text-2xl font-bold mb-4">
                                Tingkat Pembelian: <span class="px-3 py-1 bg-[#628141] text-white rounded-lg shadow-sm"><?= strtoupper($trend_label) ?></span>
                            </p>

                            <div class="space-y-4">
                                <p class="text-xs text-gray-400 font-bold uppercase">Probabilitas Tiap Kelas:</p>
                                <?php foreach ($analisis['class_probabilities'] as $label => $prob) : ?>
                                    <?php
                                    $width = round($prob * 100, 1);
                                    $barColor = 'bg-gray-300';
                                    if (strtolower($label) == 'tinggi') $barColor = 'bg-[#628141]';
                                    elseif (strtolower($label) == 'sedang') $barColor = 'bg-[#F59E0B]'; // Amber
                                    elseif (strtolower($label) == 'rendah') $barColor = 'bg-[#EF4444]'; // Red
                                    ?>
                                    <div>
                                        <div class="flex justify-between text-xs font-bold text-[#1B211A] mb-1">
                                            <span><?= ucfirst($label) ?></span>
                                            <span><?= $width ?>%</span>
                                        </div>
                                        <div class="w-full bg-gray-100 rounded-full h-3">
                                            <div class="<?= $barColor ?> h-3 rounded-full transition-all duration-1000" style="width: <?= $width ?>%"></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-[#1B211A] rounded-xl p-8 text-[#EBD5AB] shadow-2xl relative overflow-hidden">
                    <div class="absolute right-0 top-0 opacity-10">
                        <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                    </div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="w-12 h-12 bg-[#628141] rounded-full flex items-center justify-center text-2xl shadow-lg">
                                <?= $icon_saran ?>
                            </div>
                            <h3 class="text-2xl font-bold text-white">Rekomendasi Strategi Dealer</h3>
                        </div>
                        <h4 class="text-xl font-bold text-[#628141] mb-2"><?= $saran_judul ?></h4>
                        <p class="text-lg leading-relaxed max-w-3xl text-gray-300">
                            <?= $saran_desc ?>
                        </p>
                    </div>
                </div>

            </div>

            <div id="tab-teknis" class="hidden animate-fade-in-up">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">

                    <div class="bg-white rounded-xl shadow-lg border border-[#EBD5AB] overflow-hidden">
                        <div class="bg-[#1B211A] px-6 py-4 border-b border-[#EBD5AB]">
                            <h3 class="font-bold text-[#EBD5AB] text-lg">Confusion Matrix</h3>
                        </div>
                        <div class="p-6">
                            <p class="text-xs text-gray-500 mb-4 text-center">
                                Tabel perbandingan nilai Aktual vs Prediksi. Warna hijau menunjukkan prediksi yang benar.
                            </p>
                            <div class="overflow-x-auto flex justify-center">
                                <table class="border-collapse w-full text-sm">
                                    <thead>
                                        <tr>
                                            <th class="p-2"></th>
                                            <?php foreach ($eval['classes'] as $label) : ?>
                                                <th class="p-3 bg-[#EBD5AB]/30 text-[#1B211A] border border-gray-200 uppercase rounded-t-lg">Pred: <?= $label ?></th>
                                            <?php endforeach; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($eval['confusion_matrix'] as $index => $row) : ?>
                                            <tr>
                                                <th class="p-3 bg-[#EBD5AB]/30 text-[#1B211A] border border-gray-200 uppercase text-right">Aktual: <?= $eval['classes'][$index] ?></th>
                                                <?php foreach ($row as $colIndex => $cellVal) : ?>
                                                    <?php
                                                    $isDiagonal = ($index == $colIndex);
                                                    $bgCell = $isDiagonal ? 'bg-[#628141] text-white font-bold' : ($cellVal > 0 ? 'bg-red-50 text-red-800' : 'bg-white text-gray-300');
                                                    ?>
                                                    <td class="p-4 border border-gray-200 text-center <?= $bgCell ?>"><?= $cellVal ?></td>
                                                <?php endforeach; ?>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg border border-[#EBD5AB] overflow-hidden">
                        <div class="bg-[#1B211A] px-6 py-4 border-b border-[#EBD5AB]">
                            <h3 class="font-bold text-[#EBD5AB] text-lg">Detail Metrik Naive Bayes</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-gray-50 text-[#628141] uppercase text-xs font-bold">
                                    <tr>
                                        <th class="px-6 py-3">Kelas</th>
                                        <th class="px-6 py-3 text-center">Precision</th>
                                        <th class="px-6 py-3 text-center">Recall</th>
                                        <th class="px-6 py-3 text-center">F1-Score</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 text-sm">
                                    <?php foreach ($eval['classification_report'] as $label => $metrics) : ?>
                                        <?php if (is_array($metrics)) : ?>
                                            <tr class="hover:bg-[#EBD5AB]/10">
                                                <td class="px-6 py-3 font-bold text-[#1B211A] uppercase"><?= $label ?></td>
                                                <td class="px-6 py-3 text-center"><?= round($metrics['precision'], 2) ?></td>
                                                <td class="px-6 py-3 text-center"><?= round($metrics['recall'], 2) ?></td>
                                                <td class="px-6 py-3 text-center"><span class="bg-[#EBD5AB] text-[#1B211A] py-1 px-2 rounded font-bold text-xs"><?= round($metrics['f1-score'], 2) ?></span></td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="p-4 bg-gray-50 border-t text-xs text-gray-500">
                            <strong>Dataset Info:</strong> <?= $eval['total_data'] ?> Data diproses.
                        </div>
                    </div>

                </div>
            </div>

        <?php else : ?>
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-6 rounded-lg">Data detail tidak tersedia atau rusak.</div>
        <?php endif; ?>

    </div>
</div>

<script>
    function switchTab(tabName) {
        const tabAwam = document.getElementById('tab-awam');
        const tabTeknis = document.getElementById('tab-teknis');
        const btnAwam = document.getElementById('btn-awam');
        const btnTeknis = document.getElementById('btn-teknis');

        if (tabName === 'awam') {
            tabAwam.classList.remove('hidden');
            tabTeknis.classList.add('hidden');

            btnAwam.classList.add('bg-[#628141]', 'text-white', 'shadow-md');
            btnAwam.classList.remove('text-[#1B211A]', 'hover:bg-[#EBD5AB]/30');

            btnTeknis.classList.remove('bg-[#628141]', 'text-white', 'shadow-md');
            btnTeknis.classList.add('text-[#1B211A]', 'hover:bg-[#EBD5AB]/30');
        } else {
            tabAwam.classList.add('hidden');
            tabTeknis.classList.remove('hidden');

            btnTeknis.classList.add('bg-[#628141]', 'text-white', 'shadow-md');
            btnTeknis.classList.remove('text-[#1B211A]', 'hover:bg-[#EBD5AB]/30');

            btnAwam.classList.remove('bg-[#628141]', 'text-white', 'shadow-md');
            btnAwam.classList.add('text-[#1B211A]', 'hover:bg-[#EBD5AB]/30');
        }
    }
</script>

<style>
    .animate-fade-in-up {
        animation: fadeInUp 0.5s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<?= $this->endSection(); ?>