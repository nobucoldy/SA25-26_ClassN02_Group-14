<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Phenikaa University - Portal</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Instrument Sans', sans-serif; }
            .glass { background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(10px); }
            .dark .glass { background: rgba(22, 22, 21, 0.8); }
        </style>
    </head>
    <body class="bg-[#F4F4F5] dark:bg-[#09090b] text-[#18181b] dark:text-[#f4f4f5] antialiased">
        
        <header class="fixed top-0 w-full glass z-50 border-b border-[#e4e4e7] dark:border-[#27272a]">
            <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-[#f53003] rounded-lg flex items-center justify-center text-white font-bold">P</div>
                    <span class="font-bold text-lg tracking-tight">PHENIKAA UNI</span>
                </div>
                
                @if (Route::has('login'))
                    <nav class="flex items-center gap-2">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-medium px-4 py-2 rounded-md bg-[#18181b] text-white dark:bg-[#f4f4f5] dark:text-[#18181b] hover:opacity-90 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium px-4 py-2 hover:bg-[#e4e4e7] dark:hover:bg-[#27272a] rounded-md transition">Đăng nhập</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-sm font-medium px-4 py-2 bg-[#f53003] text-white rounded-md hover:bg-[#d42a02] transition shadow-lg shadow-red-500/20">Đăng ký</a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>

        <main class="pt-32 pb-16 px-6">
            <div class="max-w-5xl mx-auto grid lg:grid-cols-2 gap-12 items-center">
                
                <div class="space-y-8">
                    <div class="space-y-4">
                        <span class="px-3 py-1 text-xs font-bold tracking-widest text-[#f53003] uppercase bg-red-100 dark:bg-red-900/30 rounded-full">Quyết định 1439/QĐ-ĐHP-ĐT</span>
                        <h1 class="text-5xl font-extrabold leading-tight">Quản lý Thực tập & Đồ án Tốt nghiệp</h1>
                        <p class="text-lg text-[#71717a] dark:text-[#a1a1aa] leading-relaxed">
                            Chào mừng cậu đến với hệ thống quản lý đào tạo. Dưới đây là tóm tắt điều kiện quan trọng từ Quy định của Trường Phenikaa.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 gap-4">
                        <div class="p-4 rounded-xl border border-[#e4e4e7] dark:border-[#27272a] hover:shadow-md transition">
                            <h3 class="font-bold text-red-500 italic">Điều kiện Thực tập (TTTN)</h3>
                            <p class="text-sm opacity-80">Tích lũy ≥ 80% tín chỉ CTĐT và hoàn thành các môn chuyên ngành bắt buộc[cite: 68, 69].</p>
                        </div>
                        <div class="p-4 rounded-xl border border-[#e4e4e7] dark:border-[#27272a] hover:shadow-md transition">
                            <h3 class="font-bold text-red-500 italic">Điều kiện Đồ án (ĐATN)</h3>
                            <p class="text-sm opacity-80">Phải đạt học phần TTTN trước khi được giao đề tài Đồ án/Khóa luận[cite: 77].</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <button class="px-8 py-3 bg-[#18181b] dark:bg-[#f4f4f5] text-white dark:text-[#18181b] rounded-lg font-semibold shadow-xl hover:-translate-y-0.5 transition active:scale-95">
                            Bắt đầu ngay
                        </button>
                        <a href="#" class="text-sm font-semibold underline underline-offset-4 hover:text-[#f53003]">Xem toàn bộ Quy định</a>
                    </div>
                </div>

                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-red-600 to-orange-400 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                    <div class="relative bg-white dark:bg-[#161615] rounded-2xl border border-[#e4e4e7] dark:border-[#27272a] overflow-hidden shadow-2xl">
                        <div class="p-8 space-y-6">
                            <div class="flex items-center justify-between">
                                <div class="flex gap-1.5">
                                    <div class="w-3 h-3 rounded-full bg-[#ff5f56]"></div>
                                    <div class="w-3 h-3 rounded-full bg-[#ffbd2e]"></div>
                                    <div class="w-3 h-3 rounded-full bg-[#27c93f]"></div>
                                </div>
                                <span class="text-[10px] font-mono opacity-40 uppercase tracking-widest">Portal Preview</span>
                            </div>
                            <div class="space-y-4">
                                <div class="h-4 bg-[#f4f4f5] dark:bg-[#27272a] rounded-md w-3/4"></div>
                                <div class="h-4 bg-[#f4f4f5] dark:bg-[#27272a] rounded-md w-full"></div>
                                <div class="h-4 bg-[#f4f4f5] dark:bg-[#27272a] rounded-md w-5/6"></div>
                                <div class="pt-4 flex gap-2">
                                    <div class="h-10 bg-red-50 dark:bg-red-900/20 rounded-md flex-1 border border-red-100 dark:border-red-900/30"></div>
                                    <div class="h-10 bg-[#f4f4f5] dark:bg-[#27272a] rounded-md flex-1"></div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-[#18181b] p-6 text-white font-mono text-xs italic">
                            <p class="text-green-400">// Kết quả học tập</p>
                            <p>Tín chỉ tích lũy: 85% - <span class="text-yellow-400">Đủ điều kiện TTTN</span></p>
                        </div>
                    </div>
                </div>

            </div>
        </main>

        <footer class="mt-auto py-8 text-center text-sm text-[#71717a]">
            <p>© 2025 Phenikaa University - Hệ thống quản lý đào tạo theo tín chỉ [cite: 6]</p>
        </footer>
    </body>
</html>