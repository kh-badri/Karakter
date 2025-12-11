<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Sistem Klasifikasi Honda') ?></title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        'c-dark': '#1B211A', // Hitam Kehijauan (Teks Utama/Navbar)
                        'c-green': '#628141', // Hijau Tua (Tombol/Aksen Kuat)
                        'c-sage': '#8BAE66', // Hijau Sage (Aksen Lembut/Alert)
                        'c-cream': '#EBD5AB', // Krem (Background/Teks Navbar)
                        'c-red': '#FF5656', // Merah (Error/Hapus)
                    }
                }
            }
        }
    </script>

    <style>
        /* Loading Screen Style */
        #page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #1B211A;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.5s, visibility 0.5s;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(235, 213, 171, 0.1);
            /* c-cream transparan */
            border-top-color: #628141;
            /* c-green */
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #1B211A;
        }

        ::-webkit-scrollbar-thumb {
            background: #628141;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #8BAE66;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="h-full bg-c-cream/20 text-c-dark font-sans antialiased flex flex-col selection:bg-c-green selection:text-white">

    <div id="page-loader">
        <div class="text-center">
            <div class="spinner mx-auto mb-4"></div>
            <p class="text-c-cream text-sm tracking-widest uppercase animate-pulse">Memuat Sistem...</p>
        </div>
    </div>

    <header x-data="{ mobileMenuOpen: false }" class="bg-c-dark border-b-4 border-c-green sticky top-0 z-50 shadow-lg">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">

                <div class="flex items-center gap-3">
                    <div class="bg-c-green p-2 rounded-lg shadow-md shadow-c-green/20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-white leading-none">Klasifikasi <span class="text-c-sage">Honda</span></h1>
                        <p class="text-[10px] text-c-cream/60 uppercase tracking-widest font-medium">Metode Naive Bayes</p>
                    </div>
                </div>

                <nav class="hidden md:flex space-x-2">
                    <?php
                    function navItem($href, $label, $activeMenu, $menuName)
                    {
                        $isActive = ($activeMenu ?? '') === $menuName;
                        $classes = $isActive
                            ? 'bg-c-green text-white shadow-md'
                            : 'text-c-cream/80 hover:bg-white/10 hover:text-white';

                        echo '<a href="' . base_url($href) . '" class="px-4 py-2.5 rounded-lg text-sm font-bold transition-all duration-200 ' . $classes . '">
                                ' . $label . '
                              </a>';
                    }

                    navItem('/', 'Dashboard', $active_menu ?? '', 'home');
                    navItem('/dataset', 'Dataset', $active_menu ?? '', 'dataset');
                    navItem('/analisis', 'Mulai Analisis', $active_menu ?? '', 'analisis');
                    navItem('/history', 'Riwayat', $active_menu ?? '', 'history');
                    ?>
                </nav>

                <div class="hidden md:flex items-center gap-4">
                    <div class="h-8 w-px bg-white/10"></div> <?php if (session()->get('isLoggedIn')) : ?>
                        <div class="flex items-center gap-3">
                            <a href="<?= base_url('/akun') ?>" class="text-right hidden lg:block hover:opacity-80 transition-opacity group">
                                <p class="text-sm font-bold text-white leading-tight group-hover:text-c-sage transition-colors"><?= esc(session()->get('username')) ?></p>
                                <p class="text-[10px] text-c-sage">Administrator</p>
                            </a>

                            <a href="<?= base_url('/akun') ?>" class="block hover:opacity-90 transition-opacity">
                                <img class="h-10 w-10 rounded-lg object-cover ring-2 ring-c-green bg-white hover:ring-c-sage transition-all"
                                    src="<?= base_url('uploads/foto_profil/' . (session()->get('foto') ?: 'default.jpg')) ?>"
                                    alt="User"
                                    onerror="this.src='https://ui-avatars.com/api/?name=User&background=628141&color=fff'">
                            </a>
                        </div>
                        <a href="<?= site_url('logout') ?>" class="p-2 text-c-red hover:bg-c-red/10 rounded-lg transition-colors" title="Keluar">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </a>
                    <?php else: ?>
                        <a href="<?= site_url('login') ?>" class="text-c-cream hover:text-white font-bold text-sm">Login</a>
                    <?php endif; ?>
                </div>

                <div class="flex md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-c-cream hover:text-white p-2">
                        <svg class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="mobileMenuOpen"
            x-transition
            class="md:hidden bg-c-dark border-t border-white/10" x-cloak>
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <?php
                // Mobile Nav Helper
                function mobileNavItem($href, $label, $activeMenu, $menuName)
                {
                    $isActive = ($activeMenu ?? '') === $menuName;
                    $classes = $isActive
                        ? 'bg-c-green text-white'
                        : 'text-c-cream hover:bg-white/10 hover:text-white';
                    echo '<a href="' . base_url($href) . '" class="block px-3 py-3 rounded-md text-base font-medium ' . $classes . '">' . $label . '</a>';
                }
                mobileNavItem('/', 'Dashboard', $active_menu ?? '', 'home');
                mobileNavItem('/dataset', 'Dataset', $active_menu ?? '', 'dataset');
                mobileNavItem('/analisis', 'Mulai Analisis', $active_menu ?? '', 'analisis');
                mobileNavItem('/history', 'Riwayat', $active_menu ?? '', 'history');
                ?>
                <a href="<?= base_url('/akun') ?>" class="block px-3 py-3 rounded-md text-base font-medium text-c-cream hover:bg-white/10 hover:text-white">Pengaturan Akun</a>

                <div class="border-t border-white/10 my-2 pt-2">
                    <a href="<?= site_url('logout') ?>" class="block px-3 py-3 rounded-md text-base font-medium text-c-red hover:bg-c-red/10">Keluar Aplikasi</a>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow">
        <?= $this->renderSection('content') ?>
    </main>

    <footer class="bg-c-dark text-c-cream/60 py-6 border-t border-white/5 mt-auto">
        <div class="container mx-auto px-4 text-center">
            <p class="text-sm">
                &copy; <?= date('Y') ?> <span class="text-c-cream font-bold">Sistem Klasifikasi Honda</span>.
                Dibuat dengan Metode Naive Bayes.
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Hapus loader saat halaman siap
        window.addEventListener('load', function() {
            const loader = document.getElementById('page-loader');
            if (loader) {
                loader.style.opacity = '0';
                setTimeout(() => loader.remove(), 500);
            }
        });

        // Config Toast Notification
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: '#1B211A', // c-dark
            color: '#EBD5AB', // c-cream
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        // Flash Messages
        <?php if ($success = session()->getFlashdata('success')) : ?>
            Toast.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= esc($success, 'js') ?>',
                iconColor: '#628141' // c-green
            });
        <?php endif; ?>

        <?php if ($error = session()->getFlashdata('error')) : ?>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: '<?= esc($error, 'js') ?>',
                background: '#1B211A',
                color: '#EBD5AB',
                confirmButtonColor: '#FF5656',
                confirmButtonText: 'Tutup'
            });
        <?php endif; ?>
    </script>

</body>

</html>