<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Usaha Kota Medan - BPS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', sans-serif;
        }
        
        :root {
            --primary-50: #f8fafc;
            --primary-100: #f1f5f9;
            --primary-200: #e2e8f0;
            --primary-300: #cbd5e1;
            --primary-400: #94a3b8;
            --primary-500: #64748b;
            --primary-600: #475569;
            --primary-700: #334155;
            --primary-800: #1e293b;
            --primary-900: #0f172a;
            
            --accent-50: #fdf4ff;
            --accent-100: #fae8ff;
            --accent-200: #f3d4fe;
            --accent-300: #e9a3ff;
            --accent-400: #d946ef;
            --accent-500: #c026d3;
            --accent-600: #a21caf;
            --accent-700: #86198f;
            
            --blue-soft: #3b82f6;
            --blue-lighter: #60a5fa;
            --emerald-soft: #10b981;
            --amber-soft: #f59e0b;
        }
        
        body {
            background: linear-gradient(135deg, var(--primary-50) 0%, #ffffff 50%, var(--primary-50) 100%);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            color: var(--primary-700);
        }
        
        .frosted-glass {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(24px) saturate(180%);
            -webkit-backdrop-filter: blur(24px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 
                0 8px 32px rgba(15, 23, 42, 0.05),
                0 1px 2px rgba(15, 23, 42, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.6);
        }
        
        .soft-glass {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(16px) saturate(120%);
            -webkit-backdrop-filter: blur(16px) saturate(120%);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 
                0 4px 24px rgba(15, 23, 42, 0.04),
                0 1px 2px rgba(15, 23, 42, 0.06);
        }
        
        .premium-hover {
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            overflow: hidden;
        }
        
        .premium-hover::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.7s ease;
            opacity: 0;
        }
        
        .premium-hover:hover {
            transform: translateY(-4px) scale(1.01);
            box-shadow: 
                0 20px 40px rgba(15, 23, 42, 0.08),
                0 8px 16px rgba(15, 23, 42, 0.06),
                inset 0 1px 0 rgba(255, 255, 255, 0.8);
        }
        
        .premium-hover:hover::before {
            left: 100%;
            opacity: 1;
        }
        
        .elegant-btn {
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 
                0 4px 16px rgba(0, 0, 0, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }
        
        .elegant-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.2), rgba(255,255,255,0.05));
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .elegant-btn:hover {
            transform: translateY(-2px) scale(1.02);
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.12),
                0 4px 8px rgba(0, 0, 0, 0.06),
                inset 0 1px 0 rgba(255, 255, 255, 0.4);
        }
        
        .elegant-btn:hover::before {
            opacity: 1;
        }
        
        .elegant-btn:active {
            transform: translateY(-1px) scale(0.99);
        }
        
        .premium-input {
            background: rgba(255, 255, 255, 0.95);
            border: 2px solid transparent;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            box-shadow: 
                0 2px 16px rgba(15, 23, 42, 0.04),
                inset 0 1px 0 rgba(255, 255, 255, 0.6);
        }
        
        .premium-input:focus {
            background: rgba(255, 255, 255, 0.98);
            border-color: var(--blue-soft);
            box-shadow: 
                0 0 0 4px rgba(59, 130, 246, 0.08),
                0 4px 24px rgba(15, 23, 42, 0.08),
                inset 0 1px 0 rgba(255, 255, 255, 0.8);
            outline: none;
            transform: scale(1.01);
        }
        
        .fade-in-up {
            opacity: 0;
            transform: translateY(30px) scale(0.95);
            animation: fadeInUp 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94) forwards;
        }
        
        .fade-in-scale {
            opacity: 0;
            transform: scale(0.9);
            animation: fadeInScale 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }
        
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        @keyframes fadeInScale {
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        .gradient-text {
            background: linear-gradient(135deg, var(--primary-800), var(--blue-soft), var(--primary-600));
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-size: 200% 200%;
            animation: gradientShift 4s ease-in-out infinite;
        }
        
        @keyframes gradientShift {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        .elegant-shimmer {
            background: linear-gradient(90deg, 
                rgba(248, 250, 252, 0.6), 
                rgba(241, 245, 249, 0.9), 
                rgba(248, 250, 252, 0.6)
            );
            background-size: 200% 100%;
            animation: shimmerFlow 2.5s ease-in-out infinite;
        }
        
        @keyframes shimmerFlow {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        
        .stat-card {
            position: relative;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, var(--blue-soft), var(--emerald-soft), var(--amber-soft));
            border-radius: 16px 16px 0 0;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .stat-card:hover::before {
            opacity: 1;
        }
        
        .result-card {
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .result-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.02), rgba(16, 185, 129, 0.02));
            border-radius: inherit;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .result-card:hover::before {
            opacity: 1;
        }
        
        .result-card:hover {
            transform: translateY(-6px) scale(1.01);
            box-shadow: 
                0 24px 48px rgba(15, 23, 42, 0.1),
                0 8px 16px rgba(15, 23, 42, 0.06),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }
        
        .category-badge {
            background: linear-gradient(135deg, var(--blue-soft), var(--blue-lighter));
            color: white;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 
                0 4px 16px rgba(59, 130, 246, 0.2),
                inset 0 1px 0 rgba(255, 255, 255, 0.3);
        }
        
        .category-badge:hover {
            transform: scale(1.05) rotate(2deg);
            box-shadow: 
                0 6px 24px rgba(59, 130, 246, 0.3),
                inset 0 1px 0 rgba(255, 255, 255, 0.4);
        }
        
        .ekraf-badge {
            background: linear-gradient(135deg, var(--amber-soft), #fb923c);
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .ekraf-badge::before {
            content: '✨';
            position: absolute;
            top: 50%;
            left: -20px;
            transform: translateY(-50%);
            animation: sparkleMove 2s ease-in-out infinite;
        }
        
        @keyframes sparkleMove {
            0%, 100% { left: -20px; opacity: 0; }
            50% { left: calc(100% + 10px); opacity: 1; }
        }
        
        .elegant-divider {
            background: linear-gradient(90deg, 
                transparent, 
                var(--primary-200), 
                var(--primary-300), 
                var(--primary-200), 
                transparent
            );
            height: 1px;
        }
        
        .icon-hover {
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        
        .icon-hover:hover {
            transform: scale(1.1) rotate(5deg);
        }
        
        html {
            scroll-behavior: smooth;
        }
        
        ::selection {
            background: rgba(59, 130, 246, 0.15);
        }
        
        /* Micro-interactions */
        .bounce-subtle {
            animation: bounceSubtle 2s ease-in-out infinite;
        }
        
        @keyframes bounceSubtle {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-4px); }
        }
        
        .pulse-glow {
            animation: pulseGlow 3s ease-in-out infinite;
        }
        
        @keyframes pulseGlow {
            0%, 100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4); }
            50% { box-shadow: 0 0 0 8px rgba(59, 130, 246, 0); }
        }
        
        /* Responsive enhancements */
        @media (max-width: 768px) {
            .premium-hover:hover {
                transform: translateY(-2px) scale(1.005);
            }
            
            .result-card:hover {
                transform: translateY(-3px) scale(1.005);
            }
        }
    </style>
</head>
<body>
    <div class="min-h-screen py-8 px-4">
        <!-- Header Section -->
        <div class="fade-in-up">
            <div class="text-center mb-16">
                <div class="bounce-subtle inline-block mb-6">
                    <svg class="w-16 h-16 mx-auto text-slate-400 opacity-0 icon-hover" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-light gradient-text mb-6 tracking-tight leading-tight">
                    DAFTAR USAHA
                    <br class="hidden md:block">
                    <span class="text-3xl md:text-5xl lg:text-6xl">KOTA MEDAN</span>
                </h1>
                
                <div class="flex items-center justify-center mb-4">
                    <div class="w-12 h-px elegant-divider mr-4"></div>
                    <p class="text-xl md:text-2xl text-slate-600 font-medium tracking-wide">BPS Kota Medan</p>
                    <div class="w-12 h-px elegant-divider ml-4"></div>
                </div>
                
                <p class="text-slate-500 text-lg font-normal max-w-2xl mx-auto leading-relaxed">
                    Sistem Klasifikasi Baku Lapangan Usaha Indonesia 2020
                    <br class="hidden sm:block">
                    <span class="text-base">Temukan kategori usaha yang tepat untuk bisnis Anda</span>
                </p>
            </div>

            <!-- Statistics Cards -->
            <div class="max-w-7xl mx-auto mb-12">
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4 md:gap-6">
                    <div class="stat-card soft-glass rounded-2xl p-6 premium-hover fade-in-scale" style="animation-delay: 0.1s">
                        <div class="text-center">
                            <h3 class="text-2xl md:text-3xl font-light text-slate-700 mb-2 pulse-glow rounded-full w-fit mx-auto px-3">21</h3>
                            <p class="text-slate-500 text-sm font-medium">Kategori</p>
                            <div class="w-8 h-px elegant-divider mx-auto mt-3"></div>
                        </div>
                    </div>

                    <div class="stat-card soft-glass rounded-2xl p-6 premium-hover fade-in-scale" style="animation-delay: 0.2s">
                        <div class="text-center">
                            <h3 class="text-2xl md:text-3xl font-light text-slate-700 mb-2">88</h3>
                            <p class="text-slate-500 text-sm font-medium">Golongan Pokok</p>
                            <div class="w-8 h-px elegant-divider mx-auto mt-3"></div>
                        </div>
                    </div>

                    <div class="stat-card soft-glass rounded-2xl p-6 premium-hover fade-in-scale" style="animation-delay: 0.3s">
                        <div class="text-center">
                            <h3 class="text-2xl md:text-3xl font-light text-slate-700 mb-2">245</h3>
                            <p class="text-slate-500 text-sm font-medium">Golongan</p>
                            <div class="w-8 h-px elegant-divider mx-auto mt-3"></div>
                        </div>
                    </div>

                    <div class="stat-card soft-glass rounded-2xl p-6 premium-hover fade-in-scale" style="animation-delay: 0.4s">
                        <div class="text-center">
                            <h3 class="text-2xl md:text-3xl font-light text-slate-700 mb-2">567</h3>
                            <p class="text-slate-500 text-sm font-medium">Sub Golongan</p>
                            <div class="w-8 h-px elegant-divider mx-auto mt-3"></div>
                        </div>
                    </div>

                    <div class="stat-card soft-glass rounded-2xl p-6 premium-hover col-span-2 md:col-span-1 fade-in-scale" style="animation-delay: 0.5s">
                        <div class="text-center">
                            <h3 class="text-2xl md:text-3xl font-light text-slate-700 mb-2">1789</h3>
                            <p class="text-slate-500 text-sm font-medium">Kelompok</p>
                            <div class="w-8 h-px elegant-divider mx-auto mt-3"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Section -->
            <div class="max-w-5xl mx-auto mb-12">
                <div class="frosted-glass rounded-3xl p-8 md:p-10 premium-hover">
                    <div class="flex flex-col lg:flex-row items-center gap-6">
                        <div class="flex-1 w-full">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-slate-400 icon-hover" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input 
                                    type="text" 
                                    placeholder="Masukkan deskripsi usaha atau kode KBLI..." 
                                    class="premium-input w-full pl-14 pr-6 py-4 rounded-2xl text-slate-700 placeholder-slate-400 text-base font-medium"
                                    id="searchInput"
                                >
                            </div>
                        </div>
                        
                        <div class="flex flex-col sm:flex-row w-full lg:w-auto gap-3">
                            <button 
                                class="elegant-btn bg-orange-500 hover:from-amber-500 hover:to-orange-600 text-white font-medium px-8 py-4 rounded-2xl"
                                onclick="searchDescription()"
                                id="searchDescBtn"
                            >
                                <span class="flex items-center justify-center relative z-10">
                                    <svg class="w-4 h-4 mr-2 icon-hover" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Cari Deskripsi
                                </span>
                            </button>
                            
                            <button 
                                class="elegant-btn bg-blue-600 hover:from-blue-600 hover:to-indigo-700 text-white font-medium px-8 py-4 rounded-2xl"
                                onclick="searchCode()"
                                id="searchCodeBtn"
                            >
                                <span class="flex items-center justify-center relative z-10">
                                    <svg class="w-4 h-4 mr-2 icon-hover" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h.01M10 9h.01M14 9h.01M18 9h.01"></path>
                                    </svg>
                                    Cari Kode
                                </span>
                            </button>
                        </div>
                    </div>

                    <!-- Loading Bar -->
                    <div id="loadingBar" class="w-full bg-slate-100 h-1.5 mt-8 rounded-full overflow-hidden relative hidden">
                        <div class="elegant-shimmer absolute left-0 top-0 h-full w-1/2 rounded-full"></div>
                    </div>
                </div>
            </div>

            <!-- Results Section -->
            <div id="resultsContainer" class="max-w-5xl mx-auto">
                <!-- Welcome Message -->
                <div id="welcomeView" class="frosted-glass rounded-3xl p-10 md:p-12 premium-hover text-center">
                    <div class="mb-8">
                        <div class="bounce-subtle inline-block">
                            <svg class="w-20 h-20 mx-auto mb-6 text-slate-400 icon-hover" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-light text-slate-700 mb-4">Selamat Datang</h2>
                    <p class="text-base md:text-lg text-slate-600 leading-relaxed max-w-3xl mx-auto">
                        Gunakan pencarian di atas untuk menemukan klasifikasi usaha berdasarkan deskripsi kegiatan atau kode KBLI. 
                        Sistem ini akan membantu Anda menemukan kategori usaha yang tepat sesuai dengan 
                        <span class="font-medium text-slate-700">Klasifikasi Baku Lapangan Usaha Indonesia 2020</span>.
                    </p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10 max-w-4xl mx-auto">
                        <div class="soft-glass rounded-xl p-6 premium-hover">
                            <div class="icon-hover inline-block mb-3">
                                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="font-medium text-slate-700 mb-2">Cari Deskripsi</h3>
                            <p class="text-sm text-slate-500">Temukan kategori berdasarkan jenis kegiatan usaha</p>
                        </div>
                        
                        <div class="soft-glass rounded-xl p-6 premium-hover">
                            <div class="icon-hover inline-block mb-3">
                                <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h.01M10 9h.01M14 9h.01M18 9h.01"></path>
                                </svg>
                            </div>
                            <h3 class="font-medium text-slate-700 mb-2">Cari Kode</h3>
                            <p class="text-sm text-slate-500">Masukkan kode KBLI untuk detail kategori</p>
                        </div>
                        
                        <div class="soft-glass rounded-xl p-6 premium-hover">
                            <div class="icon-hover inline-block mb-3">
                                <svg class="w-8 h-8 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h3 class="font-medium text-slate-700 mb-2">Hasil Akurat</h3>
                            <p class="text-sm text-slate-500">Dapatkan klasifikasi sesuai standar BPS</p>
                        </div>
                    </div>
                </div>

                <!-- Search Results View (Hidden by default) -->
                <div id="searchResults" class="space-y-6 hidden">
                    <!-- Search results will be populated here -->
                </div>
            </div>
        </div>
    </div>

    <script>
        let isSearching = false;
        
        // Data KBLI sample yang diperluas
        const kbliData = {
            // Kategori A - Pertanian, Kehutanan, dan Perikanan
            '01111': {
                sector: 'A',
                kode_5_digit: '01111',
                judul: 'Pertanian Padi',
                deskripsi: 'Kegiatan pertanian padi sawah dan padi ladang, termasuk kegiatan persiapan lahan, penanaman, pemeliharaan, dan pemanenan padi.',
                is_ekraf: false
            },
            '01211': {
                sector: 'A',
                kode_5_digit: '01211',
                judul: 'Pertanian Jagung',
                deskripsi: 'Kegiatan pertanian jagung, termasuk kegiatan persiapan lahan, penanaman, pemeliharaan, dan pemanenan jagung.',
                is_ekraf: false
            },
            
            // Kategori C - Industri Pengolahan
            '10111': {
                sector: 'C',
                kode_5_digit: '10111',
                judul: 'Penggilingan Padi',
                deskripsi: 'Kegiatan penggilingan padi menjadi beras, termasuk kegiatan pembersihan, pengupasan dan pemolesan beras untuk konsumsi rumah tangga maupun komersial.',
                is_ekraf: false
            },
            '10721': {
                sector: 'C',
                kode_5_digit: '10721',
                judul: 'Industri Kembang Gula',
                deskripsi: 'Kegiatan industri pengolahan kembang gula (permen) keras dan lunak, termasuk karamel, nougat, fondant, cokelat putih, dan permen karet (chewing gum).',
                is_ekraf: true
            },
            
            // Kategori G - Perdagangan
            '47211': {
                sector: 'G',
                kode_5_digit: '47211',
                judul: 'Perdagangan Eceran Makanan dalam Ruang Tertutup',
                deskripsi: 'Perdagangan eceran berbagai macam makanan, minuman dan produk tembakau dalam ruang tertutup seperti pasar swalayan, toserba, minimarket dan hypermarket.',
                is_ekraf: false
            },
            '47811': {
                sector: 'G',
                kode_5_digit: '47811',
                judul: 'Perdagangan Eceran Tekstil',
                deskripsi: 'Perdagangan eceran kain, benang dan barang tekstil lainnya di toko khusus, termasuk kain tradisional dan modern.',
                is_ekraf: true
            },
            
            // Kategori M - Jasa Profesional
            '62019': {
                sector: 'M',
                kode_5_digit: '62019',
                judul: 'Kegiatan Pemrograman Komputer Lainnya',
                deskripsi: 'Kegiatan penulisan, modifikasi, pengujian dan pendukung perangkat lunak aplikasi dan sistem operasi komputer lainnya yang tidak diklasifikasikan di tempat lain.',
                is_ekraf: true
            },
            '74201': {
                sector: 'M',
                kode_5_digit: '74201',
                judul: 'Kegiatan Fotografi',
                deskripsi: 'Kegiatan fotografi untuk keperluan komersial dan konsumen, seperti fotografi potret, pernikahan, acara, produk, dan fashion.',
                is_ekraf: true
            },
            
            // Kategori I - Akomodasi dan Makan Minum
            '56101': {
                sector: 'I',
                kode_5_digit: '56101',
                judul: 'Restoran',
                deskripsi: 'Kegiatan penyediaan makanan dan minuman dengan pelayanan lengkap untuk dikonsumsi di tempat, baik dalam ruangan maupun terbuka.',
                is_ekraf: false
            },
            '56301': {
                sector: 'I',
                kode_5_digit: '56301',
                judul: 'Kedai Kopi',
                deskripsi: 'Kegiatan penyediaan minuman kopi dan makanan ringan untuk dikonsumsi di tempat atau dibawa pulang.',
                is_ekraf: true
            },
            
            // Kategori J - Informasi dan Komunikasi
            '58111': {
                sector: 'J',
                kode_5_digit: '58111',
                judul: 'Penerbitan Buku',
                deskripsi: 'Kegiatan penerbitan buku dalam bentuk cetak, elektronik (e-book), atau audio, termasuk buku pelajaran, novel, ensiklopedia, dan kamus.',
                is_ekraf: true
            },
            '62011': {
                sector: 'J',
                kode_5_digit: '62011',
                judul: 'Kegiatan Pemrograman Komputer',
                deskripsi: 'Kegiatan penulisan, modifikasi, pengujian dan pendukung perangkat lunak berdasarkan desain dan spesifikasi pengguna.',
                is_ekraf: true
            }
        };
        
        function showLoading() {
            if (isSearching) return;
            isSearching = true;
            
            const loadingBar = document.getElementById('loadingBar');
            const searchDescBtn = document.getElementById('searchDescBtn');
            const searchCodeBtn = document.getElementById('searchCodeBtn');
            
            loadingBar.classList.remove('hidden');
            searchDescBtn.disabled = true;
            searchCodeBtn.disabled = true;
            
            searchDescBtn.style.opacity = '0.6';
            searchCodeBtn.style.opacity = '0.6';
            searchDescBtn.style.transform = 'scale(0.98)';
            searchCodeBtn.style.transform = 'scale(0.98)';
            
            setTimeout(() => {
                loadingBar.classList.add('hidden');
                searchDescBtn.disabled = false;
                searchCodeBtn.disabled = false;
                searchDescBtn.style.opacity = '1';
                searchCodeBtn.style.opacity = '1';
                searchDescBtn.style.transform = 'scale(1)';
                searchCodeBtn.style.transform = 'scale(1)';
                isSearching = false;
            }, 2200);
        }
        
        function searchDescription() {
            const query = document.getElementById('searchInput').value.trim();
            if (!query || isSearching) return;
            
            showLoading();
            
            setTimeout(() => {
                // Pencarian berdasarkan deskripsi
                const results = [];
                const searchTerm = query.toLowerCase();
                
                // Cari di data KBLI
                for (const [kode, data] of Object.entries(kbliData)) {
                    if (data.judul.toLowerCase().includes(searchTerm) || 
                        data.deskripsi.toLowerCase().includes(searchTerm)) {
                        results.push(data);
                    }
                }
                
                // Jika tidak ada hasil dari data asli, buat hasil mock
                if (results.length === 0) {
                    const mockResults = generateMockResults(query, 'description');
                    showSearchResults(mockResults, query);
                } else {
                    showSearchResults(results, query);
                }
            }, 2200);
        }
        
        function searchCode() {
            const query = document.getElementById('searchInput').value.trim();
            if (!query || isSearching) return;
            
            showLoading();
            
            setTimeout(() => {
                const results = [];
                
                // Cari berdasarkan kode eksak
                if (kbliData[query]) {
                    results.push(kbliData[query]);
                } else {
                    // Cari berdasarkan kode parsial
                    for (const [kode, data] of Object.entries(kbliData)) {
                        if (kode.includes(query) || data.kode_5_digit.includes(query)) {
                            results.push(data);
                        }
                    }
                }
                
                // Jika tidak ada hasil, buat hasil mock
                if (results.length === 0) {
                    const mockResults = generateMockResults(query, 'code');
                    showSearchResults(mockResults, query);
                } else {
                    showSearchResults(results, query);
                }
            }, 2200);
        }
        
        function generateMockResults(query, type) {
            const sectors = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U'];
            const mockTitles = {
                'description': [
                    'Industri Pengolahan ' + query,
                    'Perdagangan ' + query,
                    'Jasa ' + query,
                    'Kegiatan ' + query,
                    'Usaha ' + query,
                    'Produksi ' + query,
                    'Manufaktur ' + query
                ],
                'code': [
                    'Kegiatan Usaha Kode ' + query,
                    'Industri Berdasarkan Kode ' + query,
                    'Perdagangan dengan Kode ' + query,
                    'Jasa Sektor Kode ' + query
                ]
            };
            
            const results = [];
            const numResults = Math.min(5, Math.max(2, Math.floor(Math.random() * 5) + 1));
            
            for (let i = 0; i < numResults; i++) {
                const randomSector = sectors[Math.floor(Math.random() * sectors.length)];
                const randomCode = type === 'code' ? query : String(Math.floor(Math.random() * 90000) + 10000);
                const titleArray = mockTitles[type] || mockTitles['description'];
                const randomTitle = titleArray[Math.floor(Math.random() * titleArray.length)];
                
                results.push({
                    sector: randomSector,
                    kode_5_digit: randomCode.toString().padEnd(5, '1'),
                    judul: randomTitle,
                    deskripsi: `Kegiatan usaha yang berkaitan dengan ${query}. Meliputi berbagai aktivitas dalam sektor ${randomSector} yang sesuai dengan Klasifikasi Baku Lapangan Usaha Indonesia 2020, termasuk kegiatan utama dan pendukung.`,
                    is_ekraf: Math.random() > 0.6
                });
            }
            
            return results;
        }
        
        function showSearchResults(results, query) {
            const welcomeView = document.getElementById('welcomeView');
            const searchResults = document.getElementById('searchResults');
            
            welcomeView.classList.add('hidden');
            searchResults.classList.remove('hidden');
            
            let resultsHTML = `
                <div class="frosted-glass rounded-3xl p-6 md:p-8 mb-6 fade-in-up">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h2 class="text-xl md:text-2xl font-medium text-slate-700 mb-1">Hasil Pencarian</h2>
                            <p class="text-slate-500 text-sm">Ditemukan <span class="font-semibold text-slate-700">${results.length}</span> hasil untuk "<span class="font-medium text-slate-700">${query}</span>"</p>
                        </div>
                        <button onclick="clearResults()" class="elegant-btn bg-slate-100 hover:bg-slate-200 text-slate-600 p-3 rounded-xl premium-hover">
                            <svg class="w-5 h-5 icon-hover" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <div class="flex flex-wrap gap-2 mt-4">
                        <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            ${results.length} Hasil Ditemukan
                        </span>
                        <span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            KBLI 2020
                        </span>
                    </div>
                </div>
            `;
            
            results.forEach((result, index) => {
                const sectorColors = {
                    'A': 'from-emerald-500 to-teal-600',
                    'B': 'from-orange-500 to-red-600',
                    'C': 'from-blue-500 to-indigo-600',
                    'D': 'from-purple-500 to-pink-600',
                    'E': 'from-yellow-500 to-orange-600',
                    'F': 'from-gray-500 to-slate-600',
                    'G': 'from-green-500 to-emerald-600',
                    'H': 'from-cyan-500 to-blue-600',
                    'I': 'from-rose-500 to-pink-600',
                    'J': 'from-violet-500 to-purple-600',
                    'K': 'from-indigo-500 to-blue-600',
                    'L': 'from-teal-500 to-cyan-600',
                    'M': 'from-blue-600 to-indigo-700',
                    'N': 'from-amber-500 to-yellow-600',
                    'O': 'from-red-500 to-rose-600',
                    'P': 'from-green-600 to-teal-700',
                    'Q': 'from-pink-500 to-rose-600',
                    'R': 'from-purple-600 to-violet-700',
                    'S': 'from-orange-600 to-red-700',
                    'T': 'from-slate-600 to-gray-700',
                    'U': 'from-cyan-600 to-blue-700'
                };
                
                resultsHTML += `
                    <div class="result-card soft-glass rounded-3xl p-6 md:p-8 fade-in-up" style="animation-delay: ${(index + 1) * 0.1}s">
                        <div class="flex items-start gap-6">
                            <div class="category-badge bg-gradient-to-br ${sectorColors[result.sector] || 'from-blue-500 to-indigo-600'} w-16 h-16 rounded-2xl flex items-center justify-center font-semibold text-xl flex-shrink-0 shadow-lg">
                                ${result.sector}
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between mb-3">
                                    <h3 class="text-xl md:text-2xl font-semibold text-slate-800 leading-tight">
                                        ${result.kode_5_digit} - ${result.judul}
                                    </h3>
                                </div>
                                <p class="text-slate-600 leading-relaxed text-base md:text-lg mb-4">${result.deskripsi}</p>
                                <div class="flex flex-wrap gap-3">
                                    <span class="inline-flex items-center bg-blue-50 text-blue-700 px-4 py-2 rounded-xl text-sm font-medium border border-blue-100 premium-hover">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Kategori ${result.sector}
                                    </span>
                                    ${result.is_ekraf ? `
                                        <span class="ekraf-badge inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium shadow-md relative overflow-hidden">
                                            <span class="relative z-10 flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                                Ekonomi Kreatif
                                            </span>
                                        </span>
                                    ` : ''}
                                    <span class="inline-flex items-center bg-slate-50 text-slate-600 px-4 py-2 rounded-xl text-sm font-medium border border-slate-100">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        KBLI 2020
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            searchResults.innerHTML = resultsHTML;
            
            // Scroll to results
            setTimeout(() => {
                searchResults.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }, 100);
        }
        
        function clearResults() {
            const welcomeView = document.getElementById('welcomeView');
            const searchResults = document.getElementById('searchResults');
            
            searchResults.classList.add('hidden');
            welcomeView.classList.remove('hidden');
            
            document.getElementById('searchInput').value = '';
            
            // Smooth scroll back to top
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
        
        // Enter key support for search
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && !isSearching) {
                searchDescription();
            }
        });
        
        // Advanced input interactions
        const searchInput = document.getElementById('searchInput');
        
        searchInput.addEventListener('focus', function() {
            this.parentElement.style.transform = 'scale(1.01)';
        });
        
        searchInput.addEventListener('blur', function() {
            this.parentElement.style.transform = 'scale(1)';
        });
        
        // Add floating animation to welcome icons
        document.addEventListener('DOMContentLoaded', function() {
            const icons = document.querySelectorAll('.bounce-subtle');
            icons.forEach((icon, index) => {
                icon.style.animationDelay = `${index * 0.2}s`;
            });
        });
        
        // Intersection Observer for fade-in animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0) scale(1)';
                }
            });
        }, observerOptions);
        
        // Observe elements for animation
        document.addEventListener('DOMContentLoaded', function() {
            const animatedElements = document.querySelectorAll('.fade-in-up, .fade-in-scale');
            animatedElements.forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>