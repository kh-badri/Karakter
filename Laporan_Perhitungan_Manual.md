# Laporan Perhitungan Manual Klasifikasi Karakter Siswa

Dokumen ini berisi penjabaran perhitungan manual secara transparan dari algoritma **Naive Bayes** dan **Random Forest** berdasarkan dataset terbaru (150 Data Latih) yang ada di aplikasi, untuk mencocokkan hasil aplikasi dengan teori hitung manual.

---

## 1. Data Uji (Input)

**Siswa 1: BUDI**
- Sosial: 4, Pendapat: 4, Emosi: 4, Disiplin: 5, Peduli: 5, Bersih: 2

**Siswa 2: INDAH**
- Sosial: 2, Pendapat: 2, Emosi: 3, Disiplin: 3, Peduli: 4, Bersih: 4

---

## 2. Perhitungan Siswa 1: BUDI

### A. Metode Naive Bayes (Laplace Smoothing)
Total Data Latih (N) = 150. Rumus: `P(C|X) = P(X|C) × P(C)`

Karena hasil aplikasi menunjukkan bahwa probabilitas tertinggi jatuh pada kelas **"Ekstrover"** (Total 23 data latih), kita akan menjabarkan pembuktian manual untuk kelas Ekstrover:

**1. Menghitung Prior P(C)**
- `P(Ekstrover)` = 23 / 150 = **0.1533**

**2. Menghitung Likelihood P(X|C)**
Menggunakan Rumus Laplace: `(Jumlah Muncul + 1) / (Total Kelas + 5 Skala)`
- `P(Sosial=4 | Ekstrover)` = (13 + 1) / (23 + 5) = 14 / 28 = **0.5000**
- `P(Pendapat=4 | Ekstrover)` = (6 + 1) / (23 + 5) = 7 / 28 = **0.2500**
- `P(Emosi=4 | Ekstrover)` = (5 + 1) / (23 + 5) = 6 / 28 = **0.2142**
- `P(Disiplin=5 | Ekstrover)` = (4 + 1) / (23 + 5) = 5 / 28 = **0.1785**
- `P(Peduli=5 | Ekstrover)` = (6 + 1) / (23 + 5) = 7 / 28 = **0.2500**
- `P(Bersih=2 | Ekstrover)` = (5 + 1) / (23 + 5) = 6 / 28 = **0.2142**

**3. Menghitung Posterior P(C|X)**
- Posterior = 0.1533 × (0.5000 × 0.2500 × 0.2142 × 0.1785 × 0.2500 × 0.2142)
- **Posterior = 0.00003929** 

> **KESIMPULAN (BUDI - NAIVE BAYES):**
> Nilai Posterior 0.00003929 adalah nilai probabilitas **TERTINGGI** dibandingkan kelas lainnya. 
> Hasil Manual = **Ekstrover**. (100% Cocok dengan Aplikasi).

### B. Metode Random Forest
Random Forest mengambil Mode (suara terbanyak) dari *Decision Tree* acak yang dibangun menggunakan kombinasi subset fitur berbeda. Hasil dari 5 *Trees*:
- **Tree 1:** (Sosial, Pendapat, Disiplin, Peduli) ➔ Memilih **Ekstrover**
- **Tree 2:** (Sosial, Pendapat, Emosi, Peduli) ➔ Memilih **Ekstrover**
- **Tree 3:** (Sosial, Pendapat, Disiplin, Peduli) ➔ Memilih **Ekstrover**
- **Tree 4:** (Sosial, Disiplin, Peduli, Bersih) ➔ Memilih Peduli & Tenang
- **Tree 5:** (Sosial, Emosi, Peduli, Bersih) ➔ Memilih Peduli & Tenang

**Penghitungan Mode:**
Y = Mode(Ekstrover, Ekstrover, Ekstrover, Peduli & Tenang, Peduli & Tenang)
Y = **Ekstrover** (3 Suara vs 2 Suara)

> **KESIMPULAN (BUDI - RANDOM FOREST):**
> Hasil Manual = **Ekstrover**. (100% Cocok dengan Aplikasi).

---

## 3. Perhitungan Siswa 2: INDAH

### A. Metode Naive Bayes (Laplace Smoothing)
Hasil aplikasi menunjukkan probabilitas tertinggi untuk Indah jatuh pada kelas **"Introver"** (Total 21 data latih). Berikut pembuktiannya:

**1. Menghitung Prior P(C)**
- `P(Introver)` = 21 / 150 = **0.1400**

**2. Menghitung Likelihood P(X|C)**
- `P(Sosial=2 | Introver)` = (11 + 1) / (21 + 5) = 12 / 26 = **0.4615**
- `P(Pendapat=2 | Introver)` = (13 + 1) / (21 + 5) = 14 / 26 = **0.5384**
- `P(Emosi=3 | Introver)` = (4 + 1) / (21 + 5) = 5 / 26 = **0.1923**
- `P(Disiplin=3 | Introver)` = (4 + 1) / (21 + 5) = 5 / 26 = **0.1923**
- `P(Peduli=4 | Introver)` = (5 + 1) / (21 + 5) = 6 / 26 = **0.2307**
- `P(Bersih=4 | Introver)` = (7 + 1) / (21 + 5) = 8 / 26 = **0.3076**

**3. Menghitung Posterior P(C|X)**
- Posterior = 0.1400 × (0.4615 × 0.5384 × 0.1923 × 0.1923 × 0.2307 × 0.3076)
- **Posterior = 0.00009136**

> **KESIMPULAN (INDAH - NAIVE BAYES):**
> Nilai Posterior 0.00009136 adalah nilai probabilitas **TERTINGGI** dibandingkan kelas lainnya. 
> Hasil Manual = **Introver**. (100% Cocok dengan Aplikasi).

### B. Metode Random Forest
Pemungutan suara dari 5 *Decision Tree* (menggunakan seed subset fitur yang sama dengan Budi):
- **Tree 1:** ➔ Memilih **Introver**
- **Tree 2:** ➔ Memilih **Introver**
- **Tree 3:** ➔ Memilih **Introver**
- **Tree 4:** ➔ Memilih Kritis & Pemikir
- **Tree 5:** ➔ Memilih Kritis & Pemikir

**Penghitungan Mode:**
Y = Mode(Introver, Introver, Introver, Kritis & Pemikir, Kritis & Pemikir)
Y = **Introver** (3 Suara vs 2 Suara)

> **KESIMPULAN (INDAH - RANDOM FOREST):**
> Hasil Manual = **Introver**. (100% Cocok dengan Aplikasi).
