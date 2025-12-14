<?= $this->extend('layout/layout'); ?>
<?= $this->section('content'); ?>

<div class="min-h-screen bg-[#EAEAEA] py-10 px-4 font-sans text-gray-800" x-data="{ activeTab: 'profil' }">
    <div class="container mx-auto max-w-5xl">

        <div class="flex items-center gap-4 mb-8">
            <div class="p-3 bg-white rounded-xl shadow-sm border border-[#E3D2C3]">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#2DAA9E]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-extrabold text-[#2DAA9E] tracking-tight">Pengaturan Akun</h1>
                <p class="text-gray-500 font-medium">Kelola profil dan keamanan akun Anda.</p>
            </div>
        </div>

        <?php if (session()->getFlashdata('errors')) : ?>
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-8 rounded shadow-sm flex items-start gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <p class="font-bold text-lg">Periksa Inputan Anda</p>
                    <ul class="list-disc list-inside text-sm mt-1 space-y-1 opacity-90">
                        <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-[#E3D2C3] overflow-hidden sticky top-8">
                    <nav class="flex flex-col p-2 space-y-1">
                        <button @click="activeTab = 'profil'"
                            :class="activeTab === 'profil' ? 'bg-[#2DAA9E] text-white shadow-md' : 'text-gray-600 hover:bg-[#EAEAEA] hover:text-[#2DAA9E]'"
                            class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition-all duration-200 w-full text-left">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profil Saya
                        </button>

                        <button @click="activeTab = 'keamanan'"
                            :class="activeTab === 'keamanan' ? 'bg-[#2DAA9E] text-white shadow-md' : 'text-gray-600 hover:bg-[#EAEAEA] hover:text-[#2DAA9E]'"
                            class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition-all duration-200 w-full text-left">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Keamanan & Sandi
                        </button>
                    </nav>
                </div>
            </div>

            <div class="lg:col-span-3">

                <div x-show="activeTab === 'profil'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                    <div class="bg-white rounded-2xl shadow-lg border border-[#E3D2C3] overflow-hidden">
                        <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
                            <h2 class="text-xl font-bold text-gray-800">Edit Profil</h2>
                            <p class="text-sm text-gray-500">Perbarui informasi pribadi dan foto profil Anda.</p>
                        </div>

                        <div class="p-8">
                            <form action="<?= site_url('akun/update_profil') ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>

                                <div class="flex flex-col sm:flex-row items-center gap-8 mb-10 pb-10 border-b border-dashed border-gray-200">
                                    <div class="relative group shrink-0">
                                        <div class="absolute -inset-1 bg-gradient-to-r from-[#2DAA9E] to-[#66D2CE] rounded-full blur opacity-30 group-hover:opacity-60 transition duration-200"></div>
                                        <img class="relative h-32 w-32 rounded-full object-cover border-4 border-white shadow-xl"
                                            src="<?= base_url('uploads/foto_profil/' . esc($user['foto'])) ?>"
                                            alt="Foto Profil"
                                            onerror="this.src='https://ui-avatars.com/api/?name=<?= urlencode($user['username']) ?>&background=2DAA9E&color=fff&size=128';">
                                    </div>

                                    <div class="flex-1 w-full text-center sm:text-left">
                                        <label class="block text-sm font-bold text-gray-700 mb-2">Unggah Foto Baru</label>
                                        <input type="file" name="foto" class="block w-full text-sm text-gray-500
                                            file:mr-4 file:py-2.5 file:px-4
                                            file:rounded-full file:border-0
                                            file:text-sm file:font-bold
                                            file:bg-[#2DAA9E]/10 file:text-[#2DAA9E]
                                            hover:file:bg-[#2DAA9E] hover:file:text-white
                                            file:transition-colors file:cursor-pointer
                                            cursor-pointer border border-gray-200 rounded-lg p-1 bg-gray-50">
                                        <p class="text-xs text-gray-400 mt-2">JPG, JPEG, PNG. Maksimal 1MB.</p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                                    <div class="col-span-1 md:col-span-2">
                                        <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                                        <input type="text" name="nama_lengkap" value="<?= esc($user['nama_lengkap']) ?>" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#2DAA9E] focus:ring focus:ring-[#2DAA9E]/20 transition-all font-medium text-gray-700">
                                    </div>

                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-2">Username</label>
                                        <div class="relative">
                                            <input type="text" value="<?= esc($user['username']) ?>" class="w-full px-4 py-3 rounded-xl border-2 border-gray-100 bg-gray-100 text-gray-500 font-bold cursor-not-allowed" disabled>
                                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-2">Email</label>
                                        <input type="email" name="email" value="<?= esc($user['email']) ?>" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#2DAA9E] focus:ring focus:ring-[#2DAA9E]/20 transition-all font-medium text-gray-700">
                                    </div>
                                </div>

                                <div class="flex justify-end pt-6 border-t border-gray-100">
                                    <button type="submit" class="bg-[#2DAA9E] hover:bg-[#1f7a70] text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-[#2DAA9E]/30 transition-all transform hover:-translate-y-1 flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                        </svg>
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div x-show="activeTab === 'keamanan'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0" x-cloak>
                    <div class="bg-white rounded-2xl shadow-lg border border-[#E3D2C3] overflow-hidden">
                        <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
                            <h2 class="text-xl font-bold text-gray-800">Ubah Kata Sandi</h2>
                            <p class="text-sm text-gray-500">Pastikan akun Anda tetap aman dengan sandi yang kuat.</p>
                        </div>

                        <div class="p-8">
                            <form action="<?= site_url('akun/update_sandi') ?>" method="post">
                                <?= csrf_field() ?>

                                <div class="bg-yellow-50 border border-yellow-100 rounded-xl p-4 mb-8 flex items-start gap-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div class="text-sm text-yellow-800">
                                        <p class="font-bold">Perhatian</p>
                                        <p>Setelah mengubah kata sandi, Anda akan diminta untuk login kembali di sesi berikutnya.</p>
                                    </div>
                                </div>

                                <div class="space-y-6 max-w-lg">
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-2">Password Lama</label>
                                        <input type="password" name="password_lama" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#2DAA9E] focus:ring focus:ring-[#2DAA9E]/20 transition-all" placeholder="••••••••" required>
                                    </div>

                                    <div class="pt-4 border-t border-gray-100"></div>

                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-2">Password Baru</label>
                                        <input type="password" name="password_baru" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#2DAA9E] focus:ring focus:ring-[#2DAA9E]/20 transition-all" placeholder="Minimal 6 karakter" required>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-2">Konfirmasi Password Baru</label>
                                        <input type="password" name="konfirmasi_password" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#2DAA9E] focus:ring focus:ring-[#2DAA9E]/20 transition-all" placeholder="Ulangi password baru" required>
                                    </div>
                                </div>

                                <div class="flex justify-end pt-8 mt-4">
                                    <button type="submit" class="bg-[#2DAA9E] hover:bg-[#1f7a70] text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-[#2DAA9E]/30 transition-all transform hover:-translate-y-1 flex items-center gap-2">
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
    </div>
</div>

<?= $this->endSection(); ?>