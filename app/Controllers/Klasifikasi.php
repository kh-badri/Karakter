<?php

namespace App\Controllers;

use App\Models\KarakterModel;
use App\Models\HistoryModel;

class Klasifikasi extends BaseController
{
    protected $dataKarakterModel;
    protected $historyModel;

    public function __construct()
    {
        $this->dataKarakterModel = new KarakterModel();
        $this->historyModel = new HistoryModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Klasifikasi Karakter',
            'active_menu' => 'klasifikasi',
        ];
        return view('klasifikasi/index', $data);
    }

    public function proses()
    {
        // 1. Ambil Input User
        $input = [
            'nama_siswa' => $this->request->getPost('nama_siswa'),
            'bersosialisasi' => (int)$this->request->getPost('bersosialisasi'),
            'berpendapat' => (int)$this->request->getPost('berpendapat'),
            'kestabilan_emosi' => (int)$this->request->getPost('kestabilan_emosi'),
            'kedisiplinan' => (int)$this->request->getPost('kedisiplinan'),
            'kepedulian' => (int)$this->request->getPost('kepedulian'),
            'kebersihan' => (int)$this->request->getPost('kebersihan'),
        ];

        // 2. Ambil Dataset Training
        $dataset = $this->dataKarakterModel->findAll();
        if (empty($dataset)) {
            return redirect()->to('/klasifikasi')->with('error', 'Dataset kosong. Silakan isi data latih di menu Dataset Siswa.');
        }

        // ==========================================
        // ALGORITMA NAIVE BAYES
        // ==========================================
        $nb_results = $this->calculateNaiveBayes($dataset, $input);

        // ==========================================
        // ALGORITMA RANDOM FOREST
        // ==========================================
        $rf_results = $this->calculateRandomForest($dataset, $input, 5); // 5 Trees

        // 3. Tampilkan Hasil
        $data = [
            'title' => 'Hasil Klasifikasi',
            'active_menu' => 'klasifikasi',
            'input' => $input,
            'nb_results' => $nb_results,
            'rf_results' => $rf_results,
            'total_data' => count($dataset)
        ];

        return view('klasifikasi/hasil', $data);
    }

    public function calculateNaiveBayes($dataset, $input)
    {
        $totalData = count($dataset);
        
        // Hitung frekuensi tiap kelas (Prior)
        $classCounts = [];
        foreach ($dataset as $row) {
            $label = $row['label_karakter'];
            if (!isset($classCounts[$label])) {
                $classCounts[$label] = 0;
            }
            $classCounts[$label]++;
        }

        $priors = [];
        foreach ($classCounts as $label => $count) {
            $priors[$label] = $count / $totalData;
        }

        $features = ['bersosialisasi', 'berpendapat', 'kestabilan_emosi', 'kedisiplinan', 'kepedulian', 'kebersihan'];
        
        // Likelihood P(X|C)
        $likelihoods = [];
        $posteriors = [];
        $manual_steps = []; // Untuk dijabarkan di View

        foreach ($classCounts as $label => $countKelas) {
            $likelihood_product = 1;
            $manual_steps[$label] = [];
            
            $manual_steps[$label]['prior_text'] = "$countKelas / $totalData";
            $manual_steps[$label]['prior_val'] = $priors[$label];
            $manual_steps[$label]['features'] = [];

            foreach ($features as $feat) {
                $valInput = $input[$feat];
                
                // Hitung berapa kali fitur ini bernilai sama dengan input di kelas ini
                $matchCount = 0;
                foreach ($dataset as $row) {
                    if ($row['label_karakter'] == $label && $row[$feat] == $valInput) {
                        $matchCount++;
                    }
                }

                // Laplace Smoothing (tambah 1) untuk mencegah nilai 0
                $p_feature_given_class = ($matchCount + 1) / ($countKelas + 5); // Asumsi 5 kemungkinan nilai (1-5)
                
                $manual_steps[$label]['features'][$feat] = [
                    'match' => $matchCount,
                    'formula' => "($matchCount + 1) / ($countKelas + 5)",
                    'val' => $p_feature_given_class
                ];

                $likelihood_product *= $p_feature_given_class;
            }

            $posterior = $priors[$label] * $likelihood_product;
            $posteriors[$label] = $posterior;
            $manual_steps[$label]['posterior'] = $posterior;
        }

        // Tentukan kelas pemenang
        arsort($posteriors);
        $predicted_class = array_key_first($posteriors);

        return [
            'priors' => $priors,
            'class_counts' => $classCounts,
            'manual_steps' => $manual_steps,
            'posteriors' => $posteriors,
            'predicted_class' => $predicted_class
        ];
    }

    public function calculateRandomForest($dataset, $input, $numTrees = 5)
    {
        $trees = [];
        $predictions = [];
        $features = ['bersosialisasi', 'berpendapat', 'kestabilan_emosi', 'kedisiplinan', 'kepedulian', 'kebersihan'];

        // Tetapkan seed agar hasil konsisten untuk data yang sama
        mt_srand(12345);

        for ($i = 0; $i < $numTrees; $i++) {
            // Bootstrap sampel
            $sample = [];
            for ($j = 0; $j < count($dataset); $j++) {
                $sample[] = $dataset[mt_rand(0, count($dataset) - 1)];
            }
            
            // Random feature subset (ambil 4 fitur random dari 6)
            $rf_features = $features;
            shuffle($rf_features);
            $subset_features = array_slice($rf_features, 0, 4);

            // Bangun Decision Tree sederhana (Max Depth 3 untuk kesederhanaan komputasi & tampilan)
            $tree = $this->buildDecisionTree($sample, $subset_features, 0, 3);
            
            // Prediksi menggunakan tree ini
            $pred = $this->predictTree($tree, $input);
            $trees[] = [
                'tree_id' => $i + 1,
                'features_used' => $subset_features,
                'prediction' => $pred
            ];
            $predictions[] = $pred;
        }

        // Kembalikan seed ke acak
        mt_srand();

        // Hitung Mode (kelas mayoritas)
        $counts = array_count_values($predictions);
        arsort($counts);
        $final_prediction = array_key_first($counts);

        return [
            'trees' => $trees,
            'predictions' => $predictions,
            'vote_counts' => $counts,
            'final_prediction' => $final_prediction
        ];
    }

    // Fungsi rekursif pembangun Decision Tree berbasis Gini Impurity
    public function buildDecisionTree($data, $features, $depth, $maxDepth)
    {
        $labels = array_column($data, 'label_karakter');
        $unique_labels = array_unique($labels);

        // Jika semua data memiliki label sama (pure node)
        if (count($unique_labels) === 1) {
            return ['type' => 'leaf', 'class' => reset($unique_labels)];
        }

        // Jika max depth tercapai atau tidak ada fitur tersisa, kembalikan label mayoritas
        if ($depth >= $maxDepth || empty($features)) {
            $counts = array_count_values($labels);
            arsort($counts);
            return ['type' => 'leaf', 'class' => array_key_first($counts)];
        }

        $best_split = $this->getBestSplit($data, $features);
        
        if (!$best_split) {
            $counts = array_count_values($labels);
            arsort($counts);
            return ['type' => 'leaf', 'class' => array_key_first($counts)];
        }

        $left = $this->buildDecisionTree($best_split['left_data'], $features, $depth + 1, $maxDepth);
        $right = $this->buildDecisionTree($best_split['right_data'], $features, $depth + 1, $maxDepth);

        return [
            'type' => 'node',
            'feature' => $best_split['feature'],
            'value' => $best_split['value'],
            'left' => $left,
            'right' => $right
        ];
    }

    public function getBestSplit($data, $features)
    {
        $best_gini = 999;
        $best_split = null;

        foreach ($features as $feature) {
            $values = array_unique(array_column($data, $feature));
            foreach ($values as $val) {
                $left = [];
                $right = [];
                foreach ($data as $row) {
                    if ($row[$feature] <= $val) {
                        $left[] = $row;
                    } else {
                        $right[] = $row;
                    }
                }

                if (count($left) > 0 && count($right) > 0) {
                    $gini = $this->calculateGiniSplit($left, $right);
                    if ($gini < $best_gini) {
                        $best_gini = $gini;
                        $best_split = [
                            'feature' => $feature,
                            'value' => $val,
                            'left_data' => $left,
                            'right_data' => $right
                        ];
                    }
                }
            }
        }
        return $best_split;
    }

    public function calculateGiniSplit($left, $right)
    {
        $total = count($left) + count($right);
        $gini_left = $this->giniImpurity($left);
        $gini_right = $this->giniImpurity($right);
        return ((count($left) / $total) * $gini_left) + ((count($right) / $total) * $gini_right);
    }

    public function giniImpurity($data)
    {
        $labels = array_column($data, 'label_karakter');
        $counts = array_count_values($labels);
        $total = count($labels);
        $gini = 1.0;
        foreach ($counts as $count) {
            $prob = $count / $total;
            $gini -= ($prob * $prob);
        }
        return $gini;
    }

    public function predictTree($tree, $input)
    {
        if ($tree['type'] === 'leaf') {
            return $tree['class'];
        }
        
        $feature = $tree['feature'];
        $value = $tree['value'];

        if ($input[$feature] <= $value) {
            return $this->predictTree($tree['left'], $input);
        } else {
            return $this->predictTree($tree['right'], $input);
        }
    }

    public function simpan()
    {
        $this->historyModel->save([
            'nama_siswa'       => $this->request->getPost('nama_siswa'),
            'bersosialisasi'   => $this->request->getPost('bersosialisasi'),
            'berpendapat'      => $this->request->getPost('berpendapat'),
            'kestabilan_emosi' => $this->request->getPost('kestabilan_emosi'),
            'kedisiplinan'     => $this->request->getPost('kedisiplinan'),
            'kepedulian'       => $this->request->getPost('kepedulian'),
            'kebersihan'       => $this->request->getPost('kebersihan'),
            'hasil_nb'         => $this->request->getPost('hasil_nb'),
            'hasil_rf'         => $this->request->getPost('hasil_rf'),
            'tanggal_simpan'   => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/history')->with('success', 'Hasil klasifikasi berhasil disimpan ke Riwayat!');
    }
}
