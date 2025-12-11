<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="min-h-screen bg-[#EBD5AB]/20 py-10 px-4 font-sans text-[#1B211A]">
    <div class="container mx-auto max-w-4xl">

        <div class="bg-white rounded-2xl p-8 mb-8 shadow-xl border-l-8 border-[#628141] flex items-center gap-6">
            <div class="p-4 bg-[#EBD5AB]/40 rounded-full shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-[#628141]" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-1.007 1.11-1.226M10.343 3.94l2.286 2.286c.41.41 1.002.665 1.62.775M10.343 3.94a3.75 3.75 0 01-3.75 3.75m3.75-3.75a3.75 3.75 0 00-3.75 3.75M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-extrabold text-[#1B211A]">Pengaturan Akun</h1>
                <p class="text-gray-500 mt-1">Kelola informasi profil dan keamanan akun Anda.</p>
            </div>
        </div>

        <?php if (session()->getFlashdata('errors')) : ?>
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-6 mb-8 rounded-r-lg shadow-sm" role="alert">
                <p class="font-bold text-lg mb-2">Gagal Memperbarui</p>
                <ul class="list-disc list-inside text-sm space-y-1">
                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="bg-white rounded-2xl shadow-xl border border-[#EBD5AB]/60 overflow-hidden" x-data="{ tab: 'profil' }">

            <div class="bg-gray-50 border-b border-gray-200 px-6 py-4">
                <nav class="flex space-x-4" aria-label="Tabs">
                    <button @click="tab = 'profil'"
                        :class="{'bg-[#628141] text-white shadow-md': tab === 'profil', 'text-gray-500 hover:text-[#1B211A] hover:bg-gray-200': tab !== 'profil'}"
                        class="px-6 py-2.5 rounded-lg font-bold text-sm transition-all duration-200 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Profil Saya
                    </button>

                    <button @click="tab = 'keamanan'"
                        :class="{'bg-[#628141] text-white shadow-md': tab === 'keamanan', 'text-gray-500 hover:text-[#1B211A] hover:bg-gray-200': tab !== 'keamanan'}"
                        class="px-6 py-2.5 rounded-lg font-bold text-sm transition-all duration-200 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Keamanan
                    </button>
                </nav>
            </div>

            <div class="p-8">

                <div x-show="tab === 'profil'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                    <form action="<?= site_url('akun/update_profil') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="flex flex-col md:flex-row items-center gap-8 mb-8 pb-8 border-b border-gray-100">
                            <div class="relative group">
                                <img class="h-32 w-32 rounded-full object-cover border-4 border-[#EBD5AB] shadow-lg group-hover:border-[#628141] transition-colors duration-300"
                                    src="<?= base_url('uploads/foto_profil/' . esc($user['foto'])) ?>"
                                    alt="Foto Profil"
                                    onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode($user['username']) ?>&background=628141&color=fff&size=128'; this.onerror=null;">

                                <div class="absolute bottom-0 right-0 bg-[#628141] p-2 rounded-full border-2 border-white shadow-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                            </div>

                            <div class="flex-1 w-full">
                                <label for="foto" class="block text-sm font-bold text-[#1B211A] mb-2">Ganti Foto Profil</label>
                                <input type="file" name="foto" id="foto" class="block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2.5 file:px-4
                                    file:rounded-full file:border-0
                                    file:text-sm file:font-bold
                                    file:bg-[#EBD5AB] file:text-[#1B211A]
                                    hover:file:bg-[#628141] hover:file:text-white
                                    cursor-pointer border border-gray-200 rounded-lg p-1">
                                <p class="text-xs text-gray-400 mt-2 flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                    Format: PNG, JPG, JPEG (Maks. 1MB)
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="username" class="block text-sm font-bold text-[#1B211A] mb-1">Username</label>
                                <input type="text" id="username" value="<?= esc($user['username']) ?>" class="w-full px-4 py-3 bg-gray-100 border border-gray-300 rounded-lg text-gray-500 font-mono cursor-not-allowed" disabled>
                                <p class="text-xs text-gray-400 mt-1 italic">Username tidak dapat diubah.</p>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-bold text-[#1B211A] mb-1">Alamat Email</label>
                                <input type="email" name="email" id="email" value="<?= esc($user['email']) ?>" class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#628141] focus:border-transparent transition-shadow text-[#1B211A]">
                            </div>

                            <div class="md:col-span-2">
                                <label for="nama_lengkap" class="block text-sm font-bold text-[#1B211A] mb-1">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" id="nama_lengkap" value="<?= esc($user['nama_lengkap']) ?>" class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#628141] focus:border-transparent transition-shadow text-[#1B211A]">
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="bg-[#1B211A] hover:bg-[#628141] text-white font-bold py-3 px-8 rounded-lg shadow-lg transition-all transform hover:-translate-y-1 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                <div x-show="tab === 'keamanan'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                    <form action="<?= site_url('akun/update_sandi') ?>" method="post" class="max-w-2xl mx-auto">
                        <?= csrf_field() ?>

                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6 flex items-start gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600 mt-0.5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                            <p class="text-sm text-yellow-800">Pastikan Anda mengingat password baru Anda. Setelah diubah, Anda harus login ulang dengan password baru.</p>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label for="password_lama" class="block text-sm font-bold text-[#1B211A] mb-1">Password Saat Ini</label>
                                <input type="password" name="password_lama" id="password_lama" class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#628141] transition text-[#1B211A]" placeholder="Masukkan password lama..." required>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="password_baru" class="block text-sm font-bold text-[#1B211A] mb-1">Password Baru</label>
                                    <input type="password" name="password_baru" id="password_baru" class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#628141] transition text-[#1B211A]" placeholder="Minimal 6 karakter" required>
                                </div>
                                <div>
                                    <label for="konfirmasi_password" class="block text-sm font-bold text-[#1B211A] mb-1">Konfirmasi Password</label>
                                    <input type="password" name="konfirmasi_password" id="konfirmasi_password" class="w-full px-4 py-3 bg-white border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#628141] transition text-[#1B211A]" placeholder="Ulangi password baru" required>
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end">
                            <button type="submit" class="bg-[#628141] hover:bg-[#1B211A] text-white font-bold py-3 px-8 rounded-lg shadow-lg transition-all transform hover:-translate-y-1 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                                </svg>
                                Perbarui Password
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>