<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - SAPA SRAGEN</title>
    @vite('resources/js/app.js')
</head>
<body class="min-h-screen bg-slate-50 antialiased">
    <div class="mx-auto max-w-6xl px-4 py-10 md:py-14">
        <div class="grid overflow-hidden rounded-3xl bg-white shadow-xl ring-1 ring-black/5 md:grid-cols-2">
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

            <div class="p-8 sm:p-10 md:p-12">
                <div class="mb-8 md:mb-10">
                    <h2 class="text-2xl font-extrabold tracking-tight text-slate-900 md:text-3xl" style="color: #0E3B6B;">Selamat Datang Kembali!</h2>
                    <p class="mt-2 text-slate-500">Silakan masuk untuk mengelola aduan Anda.</p>
                </div>

                @if(session('success'))
                    <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-emerald-700 text-sm">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="mb-6 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-rose-700 text-sm">
                        <ul class="list-inside list-disc space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login.process') }}" method="POST" class="space-y-5">
                    @csrf

                    <div>
                        <label for="email" class="mb-1 block text-sm font-medium text-slate-700">Email atau NIK</label>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                </svg>
                            </span>
                            <input type="text" id="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="Contoh: 3314xxxxxxxx0001" class="block w-full rounded-xl border border-slate-300 py-3 pl-10 pr-3 text-slate-900 placeholder-slate-400 shadow-sm outline-none transition focus:border-sky-600 focus:ring-2 focus:ring-sky-600/20" />
                        </div>
                    </div>

                    <div>
                        <div class="mb-1 flex items-center justify-between">
                            <label for="password" class="block text-sm font-medium text-slate-700">Kata Sandi</label>
                            <a href="{{ \Illuminate\Support\Facades\Route::has('password.request') ? route('password.request') : '#' }}" class="text-sm font-medium hover:underline" style="color: #009D85;">Lupa Kata Sandi?</a>
                        </div>
                        <div class="relative">
                            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                                </svg>
                            </span>
                            <input type="password" id="password" name="password" required autocomplete="current-password" placeholder="Masukkan kata sandi Anda" class="block w-full rounded-xl border border-slate-300 py-3 pl-10 pr-3 text-slate-900 placeholder-slate-400 shadow-sm outline-none transition focus:border-sky-600 focus:ring-2 focus:ring-sky-600/20" />
                        </div>
                    </div>

                    <button type="submit" class="group relative inline-flex w-full items-center justify-center gap-1 rounded-xl px-4 py-3 font-semibold text-white shadow-sm transition focus:outline-none focus:ring-2 focus:ring-slate-900/20" style="background-color: #0E3B6B;" onmouseover="this.style.backgroundColor='#0a2a4d'" onmouseout="this.style.backgroundColor='#0E3B6B'">
                        Masuk Sekarang
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.5 12h15m0 0l-5.625-6m5.625 6l-5.625 6" />
                        </svg>                    
                    </button>
                </form>

                <p class="mt-8 text-center text-sm text-slate-600">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="font-semibold text-emerald-700 hover:underline" style="color: #009D85;">Daftar di sini</a>
                </p>
            </div>
        </div>
        
        <p class="mt-8 text-center text-sm text-slate-500">
            &copy; {{ date('Y') }} Pemerintah Kabupaten Sragen. Bekerja sama dengan Diskominfo Sragen
        </p>
    </div>
</body>
</html>
