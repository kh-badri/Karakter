<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Klasifikasi Honda</title>

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

    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl overflow-hidden flex flex-col md:flex-row border border-c-cream/60">

        <div class="md:w-1/2 p-8 lg:p-12 flex flex-col justify-center order-2 md:order-1">

            <div class="mb-6">
                <h1 class="text-2xl font-bold text-c-dark">Buat Akun Baru</h1>
                <p class="text-gray-500 text-sm mt-1">Daftar untuk mulai menggunakan sistem prediksi.</p>
            </div>

            <?php $validation = \Config\Services::validation(); ?>
            <?php if (session()->getFlashdata('error') || $validation->getErrors()) : ?>
                <div class="bg-red-50 border-l-4 border-c-red p-4 mb-6 rounded-r-lg">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-c-red" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan:</h3>
                            <div class="mt-1 text-sm text-red-700">
                                <ul class="list-disc list-inside space-y-1">
                                    <?php if (session()->getFlashdata('error')) : ?>
                                        <li><?= session()->getFlashdata('error') ?></li>
                                    <?php else : ?>
                                        <?php foreach ($validation->getErrors() as $error) : ?>
                                            <li><?= esc($error) ?></li>
                                        <?php endforeach ?>
                                    <?php endif; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('register') ?>" method="post" class="space-y-5">
                <?= csrf_field() ?>

                <div>
                    <label class="block text-sm font-bold text-c-dark mb-1">Username</label>
                    <input type="text" name="username" required value="<?= old('username') ?>"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-c-dark focus:outline-none focus:ring-2 focus:ring-c-green focus:border-transparent transition placeholder-gray-400"
                        placeholder="Contoh: admin_honda">
                </div>

                <div>
                    <label class="block text-sm font-bold text-c-dark mb-1">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-c-dark focus:outline-none focus:ring-2 focus:ring-c-green focus:border-transparent transition placeholder-gray-400"
                        placeholder="Minimal 6 karakter">
                </div>

                <div>
                    <label class="block text-sm font-bold text-c-dark mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirm" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg text-c-dark focus:outline-none focus:ring-2 focus:ring-c-green focus:border-transparent transition placeholder-gray-400"
                        placeholder="Ulangi password">
                </div>

                <button type="submit"
                    class="w-full bg-c-green hover:bg-c-dark text-white font-bold py-3.5 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5 mt-2">
                    Daftar Akun
                </button>

                <div class="text-center pt-2">
                    <p class="text-sm text-gray-500">
                        Sudah punya akun?
                        <a href="<?= site_url('login') ?>" class="text-c-green font-bold hover:underline transition">
                            Login di sini
                        </a>
                    </p>
                </div>
            </form>
        </div>

        <div class="md:w-1/2 bg-c-dark p-8 lg:p-12 flex flex-col items-center justify-center text-center relative overflow-hidden order-1 md:order-2">

            <div class="absolute top-0 left-0 w-full h-full opacity-10">
                <div class="absolute top-10 right-10 w-32 h-32 bg-c-sage rounded-full blur-3xl"></div>
                <div class="absolute bottom-10 left-10 w-40 h-40 bg-c-green rounded-full blur-3xl"></div>
            </div>

            <div class="relative z-10">
                <div class="bg-white/5 p-5 rounded-2xl inline-block mb-6 backdrop-blur-sm border border-white/10 shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-c-sage" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>

                <h2 class="text-2xl font-bold text-white mb-3">Bergabunglah Sekarang</h2>
                <p class="text-c-cream/80 text-sm leading-relaxed max-w-xs mx-auto">
                    Daftarkan akun Anda untuk mengakses fitur lengkap <span class="text-white font-semibold">Klasifikasi Tingkat Pembelian Motor Honda</span>.
                </p>

                <div class="mt-8 grid grid-cols-2 gap-4 text-xs text-c-cream/60">
                    <div class="flex flex-col items-center">
                        <span class="font-bold text-white text-lg">85%+</span>
                        <span>Akurasi Model</span>
                    </div>
                    <div class="flex flex-col items-center">
                        <span class="font-bold text-white text-lg">Cepat</span>
                        <span>Proses Analisis</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>