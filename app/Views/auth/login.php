<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Klasifikasi Karakter Siswa</title>

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
                    },
                    boxShadow: {
                        'flat': '8px 8px 0px 0px #CFAB8D',
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-color-3 min-h-screen flex items-center justify-center p-6 font-sans relative overflow-hidden">

    <!-- Abstract Background Elements (Flat, No Gradient) -->
    <div class="absolute top-[-10%] left-[-5%] w-96 h-96 bg-color-4 rounded-full mix-blend-multiply opacity-60"></div>
    <div
        class="absolute bottom-[-10%] right-[-5%] w-[30rem] h-[30rem] bg-color-2 rounded-full mix-blend-multiply opacity-50">
    </div>
    <div class="absolute top-[20%] right-[15%] w-24 h-24 bg-color-1 rounded-lg rotate-12 opacity-40"></div>

    <?php if (session()->getFlashdata('success')): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= esc(session()->getFlashdata('success'), 'js') ?>',
                timer: 2000,
                showConfirmButton: false,
                confirmButtonColor: '#CFAB8D'
            });
        </script>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: '<?= esc(session()->getFlashdata('error'), 'js') ?>',
                confirmButtonColor: '#CFAB8D'
            });
        </script>
    <?php endif; ?>

    <!-- Single Centered Container -->
    <div class="w-full max-w-sm bg-white p-6 md:p-8 rounded-[1.5rem] shadow-xl relative z-10 border-2 border-white">

        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-14 h-14 bg-color-1/10 text-color-1 rounded-full flex items-center justify-center mx-auto mb-4 border border-color-1/20 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-7 h-7">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                </svg>
            </div>
            <h1 class="text-2xl font-extrabold text-gray-900 tracking-tight mb-1">Selamat Datang</h1>
            <p class="text-[11px] text-gray-500 font-medium">Sistem Klasifikasi Karakter Siswa</p>
        </div>

        <!-- Form -->
        <form action="<?= base_url('/login') ?>" method="post" class="space-y-6">
            <?= csrf_field() ?>

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1.5">Username</label>
                <input type="text" name="username" required
                    class="w-full px-4 py-3 bg-color-3/30 border-2 border-transparent rounded-lg text-sm text-gray-800 focus:outline-none focus:border-color-1 focus:bg-white transition-all font-medium placeholder-gray-400"
                    placeholder="Masukkan username">
            </div>

            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1.5">Password</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 bg-color-3/30 border-2 border-transparent rounded-lg text-sm text-gray-800 focus:outline-none focus:border-color-1 focus:bg-white transition-all font-medium placeholder-gray-400"
                    placeholder="••••••••">
            </div>

            <button type="submit"
                class="w-full bg-color-1 hover:bg-[#b89578] text-white font-bold py-3 rounded-lg transition-colors flex justify-center items-center gap-2 mt-4 text-sm shadow-sm shadow-color-1/30">
                Masuk ke Dashboard
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                        clip-rule="evenodd" />
                </svg>
            </button>
        </form>

        <!-- Footer -->
        <div class="mt-8 text-center">
            <p class="text-sm text-gray-500 font-medium">
                Belum memiliki akses?
                <a href="<?= site_url('register') ?>"
                    class="text-color-1 font-bold hover:underline transition-colors ml-1">Buat Akun</a>
            </p>
        </div>

    </div>

</body>

</html>