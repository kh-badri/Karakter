<!DOCTYPE html>
<html lang="id" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Klasifikasi Karakteristik Siswa') ?></title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
                        'danger': '#FF5656',
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
            background-color: #ECEEDF;
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: opacity 0.5s, visibility 0.5s;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #D9C4B0;
            border-top-color: #CFAB8D;
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
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #D9C4B0;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #CFAB8D;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="h-full bg-color-3 text-gray-800 font-sans antialiased selection:bg-color-1 selection:text-white"
    x-data="{ sidebarOpen: false }">

    <div id="page-loader">
        <div class="text-center">
            <div class="spinner mx-auto mb-3"></div>
            <p class="text-color-1 text-xs tracking-widest uppercase animate-pulse font-bold">Memuat Sistem...</p>
        </div>
    </div>

    <!-- Mobile Header -->
    <div
        class="md:hidden flex items-center justify-between bg-white border-b-2 border-white p-3 sticky top-0 z-40 shadow-sm">
        <div class="flex items-center gap-2">
            <div class="w-7 h-7 bg-color-1 text-white rounded-md flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                </svg>
            </div>
            <span class="text-sm font-extrabold text-gray-900 tracking-tight">Karakter<span
                    class="text-color-1">Siswa</span></span>
        </div>
        <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 hover:text-color-1 focus:outline-none">
            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>
    </div>

    <div class="flex h-screen overflow-hidden">

        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-900/50 z-40 md:hidden" x-cloak></div>

        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-100 transition-transform duration-300 ease-in-out md:relative md:translate-x-0 flex flex-col shadow-xl md:shadow-none">

            <div class="flex items-center gap-3 px-6 h-20 border-b border-color-3/50 bg-white">
                <div class="w-10 h-10 shrink-0 flex items-center justify-center bg-color-1/10 text-color-1 rounded-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.26 10.147a60.436 60.436 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                    </svg>
                </div>
                <div class="overflow-hidden">
                    <h1 class="text-[13px] font-extrabold text-gray-900 leading-tight">Aplikasi Data Mining</h1>
                    <p class="text-[9px] text-color-1 uppercase tracking-widest font-bold mt-1 leading-normal">
                        Klasifikasi Karakter Siswa
                    </p>
                </div>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
                <?php
                function sidebarItem($href, $label, $activeMenu, $menuName, $iconPath)
                {
                    $isActive = ($activeMenu ?? '') === $menuName;
                    $classes = $isActive
                        ? 'bg-color-1 text-white shadow-sm shadow-color-1/30'
                        : 'text-gray-500 hover:bg-color-3/50 hover:text-gray-900';

                    echo '<a href="' . base_url($href) . '" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-[13px] font-semibold transition-all duration-200 group ' . $classes . '">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-[18px] w-[18px] transition-transform group-hover:scale-110" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                ' . $iconPath . '
                            </svg>
                            ' . $label . '
                          </a>';
                }

                // 1. Dashboard
                sidebarItem('/', 'Dashboard', $active_menu ?? '', 'home', '<path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />');

                // 2. Data Karakter
                sidebarItem('/data-karakter', 'Dataset Siswa', $active_menu ?? '', 'data_karakter', '<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />');

                // 3. Prediksi/Klasifikasi
                sidebarItem('/klasifikasi', 'Klasifikasi', $active_menu ?? '', 'klasifikasi', '<path stroke-linecap="round" stroke-linejoin="round" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />');

                // 4. Riwayat
                sidebarItem('/history', 'Riwayat Hasil', $active_menu ?? '', 'history', '<path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />');
                ?>
            </nav>

            <div class="p-5 border-t border-color-3/50 bg-white">
                <?php if (session()->get('isLoggedIn')): ?>
                    <div class="flex items-center gap-3 mb-4">
                        <img class="h-9 w-9 rounded-xl object-cover border border-color-1/30"
                            src="<?= base_url('uploads/foto_profil/' . (session()->get('foto') ?: 'default.jpg')) ?>"
                            alt="User"
                            onerror="this.src='https://ui-avatars.com/api/?name=Admin&background=CFAB8D&color=fff'">
                        <div class="overflow-hidden">
                            <p class="text-xs font-bold text-gray-900 truncate"><?= esc(session()->get('username')) ?></p>
                            <p class="text-[10px] text-color-1 truncate font-medium">Administrator</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-2">
                        <a href="<?= base_url('/akun') ?>"
                            class="flex items-center justify-center gap-1 px-2.5 py-2 text-[11px] font-bold text-gray-700 bg-color-3/30 rounded-lg hover:bg-color-2/20 hover:text-color-1 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                    clip-rule="evenodd" />
                            </svg>
                            Akun
                        </a>
                        <a href="<?= site_url('logout') ?>"
                            class="flex items-center justify-center gap-1 px-2.5 py-2 text-[11px] font-bold text-danger bg-red-50 rounded-lg hover:bg-danger hover:text-white transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z"
                                    clip-rule="evenodd" />
                            </svg>
                            Keluar
                        </a>
                    </div>
                <?php else: ?>
                    <a href="<?= site_url('login') ?>"
                        class="block w-full text-center py-2.5 bg-color-1 text-white rounded-lg text-sm font-bold hover:bg-[#b89578] transition-colors">Masuk
                        Sistem</a>
                <?php endif; ?>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col h-screen overflow-hidden relative">
            <div class="flex-1 overflow-y-auto bg-color-3 custom-scrollbar p-5 md:p-8">

                <?= $this->renderSection('content') ?>

                <footer class="mt-8 py-4 text-center text-xs text-gray-500 font-medium">
                    <p>&copy; <?= date('Y') ?> <span class="text-color-1 font-bold">Data Mining Siswa</span>. All rights
                        reserved.</p>
                </footer>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Loader Logic
        window.addEventListener('load', function () {
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
        <?php if ($success = session()->getFlashdata('success')): ?>
            Toast.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '<?= esc($success, 'js') ?>',
                iconColor: '#CFAB8D'
            });
        <?php endif; ?>

        <?php if ($error = session()->getFlashdata('error')): ?>
            Swal.fire({
                icon: 'error',
                title: 'Perhatian',
                text: '<?= esc($error, 'js') ?>',
                confirmButtonColor: '#CFAB8D',
                background: '#ffffff',
                color: '#1f2937'
            });
        <?php endif; ?>
    </script>
</body>

</html>