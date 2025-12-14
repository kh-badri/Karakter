<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun | Prediksi Nikah KUA</title>

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

    <div class="bg-white rounded-3xl shadow-2xl w-full max-w-5xl overflow-hidden flex flex-col md:flex-row border border-cream-accent/50 min-h-[600px]">

        <div class="hidden md:block md:w-5/12 relative bg-gray-100">
            <img src="<?= base_url('public/nikah2.png') ?>" alt="Ilustrasi Nikah" class="absolute inset-0 w-full h-full object-cover">

            <div class="absolute inset-0 bg-gradient-to-b from-teal-main/80 to-teal-light/90 mix-blend-multiply"></div>

            <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-10 text-white z-10">
                <div class="bg-white/20 backdrop-blur-sm p-4 rounded-full mb-6 border border-white/30 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>

                <h2 class="text-2xl font-bold mb-3 drop-shadow-md">Bergabung Bersama Kami</h2>
                <p class="text-white/90 text-sm leading-relaxed drop-shadow-sm font-medium">
                    Daftarkan akun admin baru untuk mulai mengelola data prediksi pernikahan.
                </p>
            </div>
        </div>

        <div class="md:w-7/12 p-8 lg:p-12 flex flex-col justify-center relative">

            <div class="mb-6">
                <h1 class="text-2xl lg:text-3xl font-extrabold text-gray-800">Buat Akun Baru</h1>
                <p class="text-gray-500 mt-1 text-sm">Lengkapi data berikut untuk pendaftaran.</p>
            </div>

            <?php $validation = \Config\Services::validation(); ?>
            <?php if (session()->getFlashdata('error') || $validation->getErrors()) : ?>
                <div class="bg-red-50 border-l-4 border-danger p-4 mb-6 rounded-r-xl">
                    <div class="flex">
                        <div class="shrink-0">
                            <svg class="h-5 w-5 text-danger" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-bold text-red-800">Terdapat kesalahan:</h3>
                            <div class="mt-1 text-xs text-red-700 font-medium">
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

            <form action="<?= site_url('register') ?>" method="post" class="space-y-4">
                <?= csrf_field() ?>

                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1 uppercase tracking-wide">Username</label>
                    <input type="text" name="username" required value="<?= old('username') ?>"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-main focus:border-transparent transition-all placeholder-gray-400 font-medium"
                        placeholder="Contoh: admin_kua">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1 uppercase tracking-wide">Password</label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-main focus:border-transparent transition-all placeholder-gray-400 font-medium"
                            placeholder="Minimal 6 karakter">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-700 mb-1 uppercase tracking-wide">Konfirmasi</label>
                        <input type="password" name="password_confirm" required
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:outline-none focus:ring-2 focus:ring-teal-main focus:border-transparent transition-all placeholder-gray-400 font-medium"
                            placeholder="Ulangi password">
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-teal-main hover:bg-[#25968a] text-white font-bold py-3.5 rounded-xl shadow-lg shadow-teal-main/30 hover:shadow-teal-main/50 transition-all duration-300 transform hover:-translate-y-0.5 mt-4 flex justify-center items-center gap-2">
                    <span>Daftar Sekarang</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>

                <div class="text-center pt-4 border-t border-gray-100 mt-6">
                    <p class="text-sm text-gray-500">
                        Sudah punya akun?
                        <a href="<?= site_url('login') ?>" class="text-teal-main font-bold hover:underline transition ml-1">
                            Login disini
                        </a>
                    </p>
                </div>
            </form>
        </div>

    </div>

</body>

</html>