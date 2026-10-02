<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun | Klasifikasi Karakter Siswa</title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'color-1': '#CFAB8D',
                        'color-2': '#D9C4B0',
                        'color-3': '#ECEEDF',
                        'color-4': '#BBDCE5',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-color-3 min-h-screen flex items-center justify-center p-6 font-sans relative overflow-hidden">

    <!-- Abstract Background Elements (Flat, No Gradient) -->
    <div class="absolute top-[-10%] right-[-5%] w-96 h-96 bg-color-2 rounded-full mix-blend-multiply opacity-60"></div>
    <div class="absolute bottom-[-10%] left-[-5%] w-[30rem] h-[30rem] bg-color-4 rounded-full mix-blend-multiply opacity-50"></div>
    <div class="absolute top-[20%] left-[15%] w-24 h-24 bg-color-1 rounded-lg -rotate-12 opacity-40"></div>

    <!-- Single Centered Container -->
    <div class="w-full max-w-sm bg-white p-6 md:p-8 rounded-[1.5rem] shadow-xl relative z-10 border-2 border-white">
        
        <!-- Header -->
        <div class="text-center mb-6">
            <div class="w-14 h-14 bg-color-1/10 text-color-1 rounded-full flex items-center justify-center mx-auto mb-4 border border-color-1/20 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                </svg>
            </div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight mb-1">Buat Akun</h1>
            <p class="text-[11px] text-gray-500 font-medium">Lengkapi data untuk mendaftar sebagai Admin</p>
        </div>

        <?php $validation = \Config\Services::validation(); ?>
        <?php if (session()->getFlashdata('error') || $validation->getErrors()) : ?>
            <div class="bg-red-50 text-red-600 p-4 mb-6 rounded-xl text-sm border border-red-100">
                <strong class="block mb-1 font-bold">Terjadi Kesalahan:</strong>
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
        <?php endif; ?>

        <!-- Form -->
        <form action="<?= site_url('register') ?>" method="post" class="space-y-4">
            <?= csrf_field() ?>

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1.5">Username</label>
                <input type="text" name="username" required value="<?= old('username') ?>"
                    class="w-full px-4 py-3 bg-color-3/30 border-2 border-transparent rounded-lg text-sm text-gray-800 focus:outline-none focus:border-color-1 focus:bg-white transition-all font-medium placeholder-gray-400"
                    placeholder="Masukkan username">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1.5">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 bg-color-3/30 border-2 border-transparent rounded-lg text-sm text-gray-800 focus:outline-none focus:border-color-1 focus:bg-white transition-all font-medium placeholder-gray-400"
                        placeholder="Min. 6 karakter">
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1.5">Konfirmasi</label>
                    <input type="password" name="password_confirm" required
                        class="w-full px-4 py-3 bg-color-3/30 border-2 border-transparent rounded-lg text-sm text-gray-800 focus:outline-none focus:border-color-1 focus:bg-white transition-all font-medium placeholder-gray-400"
                        placeholder="Ulangi password">
                </div>
            </div>

            <button type="submit"
                class="w-full bg-color-1 hover:bg-[#b89578] text-white font-bold py-3 rounded-lg transition-colors flex justify-center items-center gap-2 mt-4 text-sm shadow-sm shadow-color-1/30">
                Daftar Sekarang
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
            </button>
        </form>

        <!-- Footer -->
        <div class="mt-8 text-center border-t border-gray-100 pt-6">
            <p class="text-sm text-gray-500 font-medium">
                Sudah memiliki akun? 
                <a href="<?= site_url('login') ?>" class="text-color-1 font-bold hover:underline transition-colors ml-1">Masuk ke Sistem</a>
            </p>
        </div>

    </div>

</body>

</html>