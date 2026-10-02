<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="max-w-7xl mx-auto font-sans text-gray-800">
    <!-- Header -->
    <div class="flex items-center justify-between mb-5">
        <div>
            <div class="flex items-center gap-2 mb-1">
                <span class="px-2 py-0.5 bg-color-1/10 text-color-1 rounded text-[10px] font-bold uppercase tracking-wider">
                    Modul Data Mining
                </span>
                <span class="px-2 py-0.5 bg-green-100 text-green-700 rounded text-[10px] font-bold uppercase tracking-wider flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                    Selesai Dihitung
                </span>
            </div>
            <h1 class="text-xl md:text-2xl font-extrabold text-gray-800 tracking-tight">
                Laporan Hasil <span class="text-transparent bg-clip-text bg-gradient-to-r from-color-1 to-[#9c7d63]">Klasifikasi</span>
            </h1>
        </div>
        <div class="flex items-center gap-3">
            <?php if (isset($is_history) && $is_history): ?>
                <a href="<?= base_url('history') ?>" class="bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 px-3 py-1.5 rounded-md text-xs font-bold shadow-sm transition-colors flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Riwayat
                </a>
            <?php else: ?>
                <a href="<?= base_url('klasifikasi') ?>" class="bg-white hover:bg-gray-50 border border-gray-200 text-gray-700 px-3 py-1.5 rounded-md text-xs font-bold shadow-sm transition-colors flex items-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
                
                <form action="<?= base_url('klasifikasi/simpan') ?>" method="post" class="m-0">
                    <?= csrf_field() ?>
                    <input type="hidden" name="nama_siswa" value="<?= esc($input['nama_siswa']) ?>">
                    <input type="hidden" name="bersosialisasi" value="<?= esc($input['bersosialisasi']) ?>">
                    <input type="hidden" name="berpendapat" value="<?= esc($input['berpendapat']) ?>">
                    <input type="hidden" name="kestabilan_emosi" value="<?= esc($input['kestabilan_emosi']) ?>">
                    <input type="hidden" name="kedisiplinan" value="<?= esc($input['kedisiplinan']) ?>">
                    <input type="hidden" name="kepedulian" value="<?= esc($input['kepedulian']) ?>">
                    <input type="hidden" name="kebersihan" value="<?= esc($input['kebersihan']) ?>">
                    <input type="hidden" name="hasil_nb" value="<?= esc($nb_results['predicted_class']) ?>">
                    <input type="hidden" name="hasil_rf" value="<?= esc($rf_results['final_prediction']) ?>">
                    
                    <button type="submit" class="bg-color-1 hover:bg-[#b89578] text-white px-3 py-1.5 rounded-md text-xs font-bold shadow-sm transition-colors flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                        </svg>
                        Simpan Hasil
                    </button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <!-- Data Input Siswa -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 mb-5">
        <h2 class="text-xs font-extrabold text-gray-400 uppercase tracking-widest mb-3">Data Input: <span class="text-gray-900"><?= esc($input['nama_siswa']) ?></span></h2>
        <div class="grid grid-cols-3 md:grid-cols-6 gap-3">
            <?php 
            $labels = [
                'bersosialisasi' => 'Sosial', 
                'berpendapat' => 'Pendapat', 
                'kestabilan_emosi' => 'Emosi', 
                'kedisiplinan' => 'Disiplin', 
                'kepedulian' => 'Peduli', 
                'kebersihan' => 'Bersih'
            ];
            foreach($labels as $key => $title): 
            ?>
            <div class="bg-color-3/30 p-2 rounded-lg border border-gray-50 text-center">
                <p class="text-[9px] text-gray-500 font-bold uppercase tracking-wider mb-0.5"><?= $title ?></p>
                <p class="text-base font-black text-gray-800"><?= $input[$key] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Section: Penjabaran Naive Bayes -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-5">
        <div class="bg-color-4/20 px-5 py-3 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-sm font-extrabold text-gray-800 flex items-center gap-2">
                <div class="w-6 h-6 rounded-md bg-white text-color-1 flex items-center justify-center shadow-sm text-xs">1</div>
                Penjabaran Manual Naive Bayes
            </h2>
            <span class="text-[10px] font-bold text-gray-500">P(C|X) = (P(X|C) × P(C)) / P(X)</span>
        </div>
        <div class="p-5">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                <?php foreach($nb_results['manual_steps'] as $label => $step): ?>
                <div class="border border-gray-100 rounded-xl p-4 hover:border-color-1 transition-colors relative">
                    <?php if ($label === $nb_results['predicted_class']): ?>
                        <div class="absolute -top-2.5 -right-2.5 w-6 h-6 bg-green-500 rounded-full border-2 border-white flex items-center justify-center text-white" title="Probabilitas Tertinggi">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                        </div>
                    <?php endif; ?>
                    
                    <h3 class="text-xs font-black text-gray-900 mb-3 border-b border-gray-100 pb-1.5">Kelas: <span class="text-color-1"><?= $label ?></span></h3>
                    
                    <div class="space-y-2 text-[10px] font-medium text-gray-600 font-mono">
                        <div class="flex justify-between items-center bg-gray-50 p-1.5 rounded">
                            <span>Prior P(C):</span>
                            <span class="font-bold text-gray-900"><?= $step['prior_text'] ?> = <?= number_format($step['prior_val'], 4) ?></span>
                        </div>
                        
                        <div class="pt-1">
                            <p class="text-[9px] uppercase tracking-wider text-gray-400 mb-1.5 font-sans font-bold">Likelihood P(X|C) (Laplace):</p>
                            <?php foreach($step['features'] as $feat => $fData): ?>
                            <div class="flex justify-between items-center mb-0.5">
                                <span>P(<?= $labels[$feat] ?>=<?= $input[$feat] ?>|C)</span>
                                <span><?= $fData['formula'] ?> = <strong class="text-gray-900"><?= number_format($fData['val'], 4) ?></strong></span>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <div class="flex justify-between items-center bg-color-1/10 p-2 rounded text-xs mt-3 border border-color-1/20">
                            <span class="font-bold text-gray-700 font-sans">Posterior P(C|X):</span>
                            <span class="font-black text-color-1"><?= number_format($step['posterior'], 6) ?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="mt-5 bg-green-50 border border-green-100 rounded-lg p-3 flex items-center gap-2">
                <div class="bg-green-100 text-green-700 p-1.5 rounded-full"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg></div>
                <div>
                    <p class="text-[10px] font-bold text-green-800">Kesimpulan Naive Bayes:</p>
                    <p class="text-xs font-medium text-green-700">Berdasarkan nilai Posterior tertinggi (<strong><?= number_format($nb_results['posteriors'][$nb_results['predicted_class']], 6) ?></strong>), siswa diklasifikasikan ke kelas <strong class="font-black uppercase tracking-wider text-green-900">"<?= $nb_results['predicted_class'] ?>"</strong>.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Section: Penjabaran Random Forest -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-5">
        <div class="bg-color-4/20 px-5 py-3 border-b border-gray-100 flex items-center justify-between">
            <h2 class="text-sm font-extrabold text-gray-800 flex items-center gap-2">
                <div class="w-6 h-6 rounded-md bg-white text-color-1 flex items-center justify-center shadow-sm text-xs">2</div>
                Penjabaran Manual Random Forest
            </h2>
            <span class="text-[10px] font-bold text-gray-500">Y = Mode (T1, T2, T3... Tn)</span>
        </div>
        <div class="p-5">
            <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
                <?php foreach($rf_results['trees'] as $tree): ?>
                <div class="border border-gray-100 rounded-xl p-3 text-center">
                    <h3 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mb-1.5 border-b border-gray-50 pb-1">Tree <?= $tree['tree_id'] ?></h3>
                    <p class="text-[9px] text-gray-500 mb-1.5 h-6 flex items-center justify-center">Split acak: <?= implode(', ', array_map(function($f) use ($labels) { return $labels[$f]; }, $tree['features_used'])) ?></p>
                    <div class="bg-gray-50 py-1.5 rounded-lg text-[11px] font-black text-gray-800 uppercase">
                        <?= $tree['prediction'] ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <div class="mt-5 flex flex-col md:flex-row gap-5 items-center bg-gray-50 p-4 rounded-xl border border-gray-100">
                <div class="flex-1">
                    <h4 class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">Voting Kelas (Mode)</h4>
                    <div class="flex flex-wrap gap-3">
                        <?php foreach($rf_results['vote_counts'] as $class => $count): ?>
                        <div class="flex items-center gap-1.5">
                            <span class="px-2 py-0.5 bg-white border border-gray-200 rounded text-[10px] font-bold text-gray-700"><?= $class ?></span>
                            <span class="text-xs font-black text-color-1"><?= $count ?> Suara</span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="w-full md:w-auto bg-green-50 border border-green-100 rounded-lg p-3 flex items-center gap-2">
                    <div class="bg-green-100 text-green-700 p-1.5 rounded-full"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg></div>
                    <div>
                        <p class="text-[10px] font-bold text-green-800">Kesimpulan Random Forest:</p>
                        <p class="text-xs font-medium text-green-700">Berdasarkan suara terbanyak (Mode), siswa diklasifikasikan sebagai <strong class="font-black uppercase tracking-wider text-green-900">"<?= $rf_results['final_prediction'] ?>"</strong>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>