<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Sistem Prediksi Nikah') ?></title>

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
                        'teal-light': '#66D2CE', // Hover / Aksen Terang
                        'teal-main': '#2DAA9E', // Warna Utama / Active
                        'gray-bg': '#EAEAEA', // Background Halaman
                        'cream-accent': '#E3D2C3', // Border / Aksen Lembut
                        'danger': '#FF5656', // Merah untuk logout/hapus
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
            background-color: #EAEAEA;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.5s, visibility 0.5s;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #E3D2C3;
            border-top-color: #2DAA9E;
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
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #EAEAEA;
        }

        ::-webkit-scrollbar-thumb {
            background: #E3D2C3;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #2DAA9E;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="h-full bg-gray-bg text-gray-800 font-sans antialiased selection:bg-teal-main selection:text-white" x-data="{ sidebarOpen: false }">

    <div id="page-loader">
        <div class="text-center">
            <div class="spinner mx-auto mb-4"></div>
            <p class="text-teal-main text-sm tracking-widest uppercase animate-pulse font-bold">Memuat Sistem...</p>
        </div>
    </div>

    <div class="md:hidden flex items-center justify-between bg-white border-b border-cream-accent p-4 sticky top-0 z-40 shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 shrink-0">
                <img src="<?= base_url('public/nikah2.png') ?>" alt="Logo Nikah" class="w-full h-full object-contain">
            </div>
            <span class="font-bold text-teal-main">Prediksi<span class="text-gray-400">KUA</span></span>
        </div>
        <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 hover:text-teal-main focus:outline-none">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
    </div>

    <div class="flex h-screen overflow-hidden">

        <div x-show="sidebarOpen" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-gray-900/50 z-40 md:hidden" x-cloak></div>

        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-cream-accent transition-transform duration-300 ease-in-out md:relative md:translate-x-0 flex flex-col shadow-xl md:shadow-none">

            <div class="flex items-center gap-3 px-6 h-24 border-b border-cream-accent bg-gray-50/50">
                <div class="w-16 h-16 shrink-0 flex items-center justify-center bg-white rounded-full shadow-sm border border-cream-accent p-1">
                    <img src="<?= base_url('public/nikah2.png') ?>" alt="Logo Nikah" class="w-full h-full object-contain">
                </div>
                <div class="overflow-hidden">
                    <h1 class="text-base font-bold text-gray-800 leading-tight">Prediksi Pernikahan KUA</h1>
                    <p class="text-[10px] text-teal-main uppercase tracking-widest font-bold mt-1">Metode Time Series</p>
                </div>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                <?php
                function sidebarItem($href, $label, $activeMenu, $menuName, $iconPath)
                {
                    $isActive = ($activeMenu ?? '') === $menuName;
                    $classes = $isActive
                        ? 'bg-teal-main text-white shadow-md shadow-teal-main/30'
                        : 'text-gray-600 hover:bg-teal-light/10 hover:text-teal-main';

                    echo '<a href="' . base_url($href) . '" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all duration-200 group ' . $classes . '">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                ' . $iconPath . '
                            </svg>
                            ' . $label . '
                          </a>';
                }

                // 1. Dashboard
                sidebarItem('/', 'Dashboard', $active_menu ?? '', 'home', '<path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />');

                // 2. Data Nikah
                sidebarItem('/data-nikah', 'Data Nikah', $active_menu ?? '', 'data_nikah', '<path stroke-linecap="round" stroke-linejoin="round" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />');

                // 3. Prediksi
                sidebarItem('/prediksi', 'Prediksi', $active_menu ?? '', 'prediksi', '<path stroke-linecap="round" stroke-linejoin="round" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />');

                // 4. Riwayat Prediksi
                sidebarItem('/history', 'Riwayat Prediksi', $active_menu ?? '', 'history', '<path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />');
                ?>
            </nav>

            <div class="p-4 border-t border-cream-accent bg-gray-50/50">
                <?php if (session()->get('isLoggedIn')) : ?>
                    <div class="flex items-center gap-3 mb-3">
                        <img class="h-10 w-10 rounded-full object-cover ring-2 ring-teal-light"
                            src="<?= base_url('uploads/foto_profil/' . (session()->get('foto') ?: 'default.jpg')) ?>"
                            alt="User"
                            onerror="this.src='https://ui-avatars.com/api/?name=Admin+KUA&background=2DAA9E&color=fff'">
                        <div class="overflow-hidden">
                            <p class="text-sm font-bold text-gray-800 truncate"><?= esc(session()->get('username')) ?></p>
                            <p class="text-xs text-teal-main truncate">Administrator</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <a href="<?= base_url('/akun') ?>" class="flex items-center justify-center gap-1 px-3 py-2 text-xs font-bold text-gray-600 bg-white border border-cream-accent rounded-lg hover:bg-teal-light/10 hover:text-teal-main transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
                            </svg>
                            Akun
                        </a>
                        <a href="<?= site_url('logout') ?>" class="flex items-center justify-center gap-1 px-3 py-2 text-xs font-bold text-danger bg-white border border-cream-accent rounded-lg hover:bg-danger hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
                            </svg>
                            Keluar
                        </a>
                    </div>
                <?php else: ?>
                    <a href="<?= site_url('login') ?>" class="block w-full text-center py-2 bg-teal-main text-white rounded-lg font-bold hover:bg-teal-main/90">Login</a>
                <?php endif; ?>
            </div>
        </aside>

        <div class="flex-1 flex flex-col h-screen overflow-hidden relative">

            <div class="flex-1 overflow-y-auto bg-gray-bg custom-scrollbar p-4 md:p-8">
                <?= $this->renderSection('content') ?>

                <footer class="mt-10 py-6 text-center text-sm text-gray-400 border-t border-cream-accent/50">
                    <p>&copy; <?= date('Y') ?> <span class="text-teal-main font-bold">Sistem Prediksi Pernikahan KUA</span>.</p>
                </footer>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Loader Logic
        window.addEventListener('load', function() {
            const loader = document.getElementById('page-loader');
            if (loader) {
                loader.style.opacity = '0';
                setTimeout(() => loader.remove(), 500);
            }
        });

        // Toast Config
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: '#ffffff',
            color: '#1f2937',
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
                iconColor: '#2DAA9E' // teal-main
            });
        <?php endif; ?>

        <?php if ($error = session()->getFlashdata('error')) : ?>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '<?= esc($error, 'js') ?>',
                confirmButtonColor: '#2DAA9E', // teal-main
                background: '#ffffff',
                color: '#1f2937'
            });
        <?php endif; ?>
    </script>
</body>

</html>f