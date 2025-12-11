<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Klasifikasi Honda</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'c-dark': '#1B211A', // Teks Utama
                        'c-green': '#628141', // Tombol/Aksen
                        'c-sage': '#8BAE66', // Aksen Lembut
                        'c-cream': '#EBD5AB', // Background
                        'c-red': '#FF5656', // Error
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-c-cream/20 min-h-screen flex items-center justify-center p-4 selection:bg-c-green selection:text-white">

    <?php if (session()->getFlashdata('success')) : ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= esc(session()->getFlashdata('success'), 'js') ?>',
                timer: 2000,
                showConfirmButton: false,
                background: '#1B211A',
                color: '#EBD5AB',
                iconColor: '#628141'
            });
        </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: '<?= esc(session()->getFlashdata('error'), 'js') ?>',
                background: '#1B211A',
                color: '#EBD5AB',
                confirmButtonColor: '#FF5656'
            });
        </script>
    <?php endif; ?>


    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl overflow-hidden flex flex-col md:flex-row border border-c-cream/60">

        <div class="md:w-1/2 p-8 lg:p-12 flex flex-col justify-center">

            <div class="mb-8">
                <div class="w-12 h-12 bg-c-green rounded-xl flex items-center justify-center mb-4 shadow-lg shadow-c-green/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-c-dark">Selamat Datang</h1>
                <p class="text-gray-500 mt-2 text-sm">Silakan login untuk mengakses dashboard admin.</p>
            </div>

            <form action="<?= base_url('/login') ?>" method="post" class="space-y-6">
                <?= csrf_field() ?>

                <div>
                    <label class="block text-sm font-bold text-c-dark mb-2">Username</label>
                    <input type="text" name="username" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-c-dark focus:outline-none focus:ring-2 focus:ring-c-green focus:border-transparent transition placeholder-gray-400"
                        placeholder="Masukkan username Anda">
                </div>

                <div>
                    <label class="block text-sm font-bold text-c-dark mb-2">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-c-dark focus:outline-none focus:ring-2 focus:ring-c-green focus:border-transparent transition placeholder-gray-400"
                        placeholder="••••••••">
                </div>

                <button type="submit"
                    class="w-full bg-c-green hover:bg-c-dark text-white font-bold py-3.5 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5">
                    Masuk ke Sistem
                </button>

                <div class="text-center pt-2">
                    <p class="text-sm text-gray-500">
                        Belum punya akun?
                        <a href="<?= site_url('register') ?>" class="text-c-green font-bold hover:underline transition">
                            Daftar Sekarang
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <div class="md:w-1/2 bg-c-dark p-8 lg:p-12 flex flex-col items-center justify-center text-center relative overflow-hidden">

            <div class="absolute top-0 right-0 w-64 h-64 bg-c-green opacity-10 rounded-full blur-3xl transform translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-c-sage opacity-10 rounded-full blur-2xl transform -translate-x-1/2 translate-y-1/2"></div>

            <div class="relative z-10">
                <div class="bg-white/5 p-6 rounded-full inline-block mb-6 backdrop-blur-sm border border-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 text-c-sage" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>

                <h2 class="text-2xl font-bold text-white mb-3">Klasifikasi Penjualan Honda</h2>
                <p class="text-c-cream/80 text-sm leading-relaxed max-w-xs mx-auto">
                    Sistem cerdas untuk memprediksi tingkat pembelian motor Honda menggunakan algoritma <span class="text-c-sage font-bold">Naive Bayes</span>.
                </p>

                <div class="mt-8 flex gap-2 justify-center">
                    <div class="w-2 h-2 rounded-full bg-c-green"></div>
                    <div class="w-2 h-2 rounded-full bg-c-sage"></div>
                    <div class="w-2 h-2 rounded-full bg-c-cream"></div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>