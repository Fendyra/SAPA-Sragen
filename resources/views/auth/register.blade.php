<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun Baru - SAPA SRAGEN</title>
    @vite('resources/js/app.js')
</head>
<body class="min-h-screen bg-slate-50 antialiased">
    <div class="mx-auto max-w-6xl px-4 py-10 md:py-14">
        <div class="grid overflow-hidden rounded-3xl bg-white shadow-xl ring-1 ring-black/5 md:grid-cols-2">
            <!-- Left Panel -->
            <div class="relative hidden md:block">
                <div class="absolute inset-0 bg-gradient-to-br from-teal-500 to-sky-900"></div>
                <div class="relative h-full p-10 text-white">
                    <div class="mb-8 flex items-center gap-3">
                        <span class="inline-flex h-10 w-10 items-center justify-center rounded-lg">
                            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="logo h-8 sm:h-12"/>
                        </span>
                        <h1 class="text-2xl font-semibold tracking-tight">SAPA SRAGEN</h1>
                    </div>
                    <h2 class="text-3xl font-extrabold leading-tight">Layanan Aspirasi Masyarakat Sragen</h2>
                    <p class="mt-3 max-w-md text-white/80">Sampaikan aspirasi, keluhan, dan saran Anda untuk kemajuan Kabupaten Sragen. Kami siap mendengar dan menindaklanjuti.</p>

                    <ul class="mt-8 space-y-5">
                        <li class="flex items-center gap-4">
                            <span class="inline-flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full">
                                <img src="{{ asset('assets/images/login-icon1.png') }}" alt="Icon" class="h-6 w-6 object-contain"/>
                            </span>
                            <span class="font-medium">Data Terjamin Aman</span>
                        </li>
                        <li class="flex items-center gap-4">
                            <span class="inline-flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full">
                                <img src="{{ asset('assets/images/login-icon2.png') }}" alt="Icon" class="h-6 w-6 object-contain"/>
                            </span>
                            <span class="font-medium">Tindak Lanjut Cepat</span>
                        </li>
                        <li class="flex items-center gap-4">
                            <span class="inline-flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full">
                                <img src="{{ asset('assets/images/login-icon1.png') }}" alt="Icon" class="h-6 w-6 object-contain"/>
                            </span>
                            <span class="font-medium">Transparan untuk Publik</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Right Form Panel -->
            <div class="p-8 sm:p-10 md:p-12">
                <div class="mb-6 md:mb-8">
                    <h2 class="text-2xl font-extrabold tracking-tight md:text-3xl" style="color: #0E3B6B;">Buat Akun Baru</h2>
                    <p class="mt-2 text-slate-500">Mari bergabung untuk Sragen yang lebih baik.</p>
                </div>

                @if($errors->any())
                    <div class="mb-6 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-rose-700 text-sm">
                        <ul class="list-inside list-disc space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register.process') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <!-- NIK & Nama -->
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label for="nik" class="mb-1 block text-sm font-medium text-slate-700">
                                NIK (Nomor Induk Kependudukan) <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" id="nik" name="nik" value="{{ old('nik') }}" required maxlength="16" pattern="[0-9]{16}" placeholder="16 digit NIK sesuai KTP" class="block w-full rounded-xl border border-slate-300 px-3 py-2.5 text-slate-900 placeholder-slate-400 shadow-sm outline-none transition focus:border-sky-600 focus:ring-2 focus:ring-sky-600/20" />
                            @error('nik')
                                <span class="mt-1 text-xs text-rose-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="name" class="mb-1 block text-sm font-medium text-slate-700">
                                Nama Lengkap <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Sesuai KTP" class="block w-full rounded-xl border border-slate-300 px-3 py-2.5 text-slate-900 placeholder-slate-400 shadow-sm outline-none transition focus:border-sky-600 focus:ring-2 focus:ring-sky-600/20" />
                            @error('name')
                                <span class="mt-1 text-xs text-rose-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Email & Telepon -->
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label for="email" class="mb-1 block text-sm font-medium text-slate-700">
                                Alamat Email <span class="text-rose-500">*</span>
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="email@contoh.com" class="block w-full rounded-xl border border-slate-300 px-3 py-2.5 text-slate-900 placeholder-slate-400 shadow-sm outline-none transition focus:border-sky-600 focus:ring-2 focus:ring-sky-600/20" />
                            @error('email')
                                <span class="mt-1 text-xs text-rose-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="phone_number" class="mb-1 block text-sm font-medium text-slate-700">
                                Nomor Telepon/WA
                            </label>
                            <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" placeholder="08xxxxxxxxxx" class="block w-full rounded-xl border border-slate-300 px-3 py-2.5 text-slate-900 placeholder-slate-400 shadow-sm outline-none transition focus:border-sky-600 focus:ring-2 focus:ring-sky-600/20" />
                            @error('phone_number')
                                <span class="mt-1 text-xs text-rose-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Upload KTP -->
                    <div>
                        <label for="ktp_photo" class="mb-1 block text-sm font-medium text-slate-700">
                            Unggah Foto KTP <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <label for="ktp_photo" class="flex cursor-pointer flex-col items-center justify-center rounded-xl border-2 border-dashed border-teal-300 bg-teal-50/30 px-6 py-8 transition hover:border-teal-400 hover:bg-teal-50/50">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-10 w-10 text-teal-600">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                </svg>
                                <p class="mt-2 text-sm font-medium text-slate-700">Klik untuk unggah atau tarik file ke sini</p>
                                <p class="mt-1 text-xs text-slate-500">Format JPG/PNG, Maks. 2MB. Pastikan data terbaca jelas.</p>
                                <input type="file" id="ktp_photo" name="ktp_photo" accept="image/jpeg,image/png,image/jpg" required class="hidden" onchange="document.getElementById('file-name').textContent = this.files[0]?.name || 'Tidak ada file dipilih'" />
                            </label>
                            <p id="file-name" class="mt-2 text-xs text-slate-600 italic">Tidak ada file dipilih</p>
                        </div>
                        @error('ktp_photo')
                            <span class="mt-1 text-xs text-rose-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label for="password" class="mb-1 block text-sm font-medium text-slate-700">
                                Kata Sandi <span class="text-rose-500">*</span>
                            </label>
                            <input type="password" id="password" name="password" required placeholder="Minimal 8 karakter" class="block w-full rounded-xl border border-slate-300 px-3 py-2.5 text-slate-900 placeholder-slate-400 shadow-sm outline-none transition focus:border-sky-600 focus:ring-2 focus:ring-sky-600/20" />
                            @error('password')
                                <span class="mt-1 text-xs text-rose-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="password_confirmation" class="mb-1 block text-sm font-medium text-slate-700">
                                Konfirmasi Kata Sandi <span class="text-rose-500">*</span>
                            </label>
                            <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Ulangi kata sandi" class="block w-full rounded-xl border border-slate-300 px-3 py-2.5 text-slate-900 placeholder-slate-400 shadow-sm outline-none transition focus:border-sky-600 focus:ring-2 focus:ring-sky-600/20" />
                        </div>
                    </div>

                    <button type="submit" class="group relative mt-2 inline-flex w-full items-center justify-center gap-1 rounded-xl px-4 py-3 font-semibold text-white shadow-sm transition focus:outline-none focus:ring-2 focus:ring-slate-900/20" style="background-color: #0E3B6B;" onmouseover="this.style.backgroundColor='#0a2a4d'" onmouseout="this.style.backgroundColor='#0E3B6B'">
                        Daftar Akun
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-slate-600">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="font-semibold hover:underline" style="color: #009D85;">Masuk sekarang</a>
                </p>
            </div>
        </div>

        <p class="mt-8 text-center text-sm text-slate-500">
            &copy; {{ date('Y') }} Pemerintah Kabupaten Sragen. Bekerja sama dengan Diskominfo Sragen
        </p>
    </div>
</body>
</html>