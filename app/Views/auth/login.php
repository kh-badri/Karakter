<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Prediksi Nikah KUA</title>

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
                        'teal-light': '#66D2CE',
                        'teal-main': '#2DAA9E',
                        'gray-bg': '#EAEAEA',
                        'cream-accent': '#E3D2C3',
                        'danger': '#FF5656',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-bg min-h-screen flex items-center justify-center p-4 lg:p-8">

    <?php if (session()->getFlashdata('success')) : ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= esc(session()->getFlashdata('success'), 'js') ?>',
                timer: 2000,
                showConfirmButton: false,
                confirmButtonColor: '#2DAA9E'
            });
        </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: '<?= esc(session()->getFlashdata('error'), 'js') ?>',
                confirmButtonColor: '#2DAA9E'
            });
        </script>
    <?php endif; ?>

    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-5xl overflow-hidden flex flex-col md:flex-row h-auto md:h-[600px] border border-cream-accent/50">

        <div class="md:w-1/2 p-8 lg:p-12 flex flex-col justify-center relative">

            <div class="mb-8">
                <div class="inline-flex items-center gap-2 mb-2 px-3 py-1 rounded-full bg-teal-light/10 text-teal-main text-xs font-bold uppercase tracking-wider">
                    <span class="w-2 h-2 rounded-full bg-teal-main"></span>
                    Sistem Prediksi
                </div>
                <h1 class="text-3xl lg:text-4xl font-extrabold text-gray-800">Selamat Datang</h1>
                <p class="text-gray-500 mt-2">Masuk untuk mengelola data pernikahan KUA.</p>
            </div>

            <form action="<?= base_url('/login') ?>" method="post" class="space-y-5">
                <?= csrf_field() ?>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Username</label>
                    <div class="relative">
                        <input type="text" name="username" required
                            class="w-full pl-10 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-main focus:border-transparent transition-all placeholder-gray-400 font-medium"
                            placeholder="username">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" name="password" required
                            class="w-full pl-10 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-main focus:border-transparent transition-all placeholder-gray-400 font-medium"
                            placeholder="••••••••">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-teal-main hover:bg-[#25968a] text-white font-bold py-3.5 rounded-xl shadow-lg shadow-teal-main/30 hover:shadow-teal-main/50 transition-all duration-300 transform hover:-translate-y-0.5 flex justify-center items-center gap-2 mt-4">
                    <span>Masuk Aplikasi</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>

                <div class="text-center mt-6">
                    <p class="text-sm text-gray-500">
                        Belum terdaftar?
                        <a href="<?= site_url('register') ?>" class="text-teal-main font-bold hover:underline transition">
                            Buat Akun
                        </a>
                    </p>
                </div>
            </form>

            <div class="mt-auto pt-8 text-center text-xs text-gray-400">
                &copy; <?= date('Y') ?> KUA Tanjung Tiram. All rights reserved.
            </div>
        </div>

        <div class="hidden md:block md:w-1/2 relative bg-gray-100">
            <img src="<?= base_url('public/nikah1.png') ?>" alt="Ilustrasi Nikah" class="absolute inset-0 w-full h-full object-cover">

            <div class="absolute inset-0 bg-gradient-to-t from-teal-main/90 to-teal-light/70 mix-blend-multiply"></div>

            <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-12 text-white z-10">
                <div class="bg-white/20 backdrop-blur-md p-4 rounded-full mb-6 border border-white/30 shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>

                <h2 class="text-3xl font-bold mb-4 drop-shadow-md">Prediksi Pernikahan</h2>
                <p class="text-white/90 text-lg leading-relaxed max-w-sm drop-shadow-sm font-medium">
                    Sistem informasi untuk meramalkan jumlah pernikahan di masa mendatang menggunakan metode <span class="font-bold text-white underline decoration-cream-accent underline-offset-4">Time Series</span>.
                </p>

                <div class="flex gap-2 mt-8">
                    <div class="w-2 h-2 rounded-full bg-white"></div>
                    <div class="w-2 h-2 rounded-full bg-white/50"></div>
                    <div class="w-2 h-2 rounded-full bg-white/50"></div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>