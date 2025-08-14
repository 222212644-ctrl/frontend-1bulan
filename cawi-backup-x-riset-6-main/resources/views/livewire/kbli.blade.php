<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Usaha Kota Medan - BPS</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * {
            font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Display', 'SF Pro Text', 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }
        
        body {
            background: radial-gradient(ellipse at top, rgba(59, 130, 246, 0.04) 0%, transparent 50%), 
                        linear-gradient(135deg, #f8faff 0%, #eff6ff 100%);
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 8px 40px rgba(59, 130, 246, 0.08);
        }
        
        .card-hover {
            transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-12px) scale(1.015);
            box-shadow: 0 32px 64px -12px rgba(59, 130, 246, 0.2);
        }
        
        .button-modern {
            transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        
        .button-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            transition: left 0.8s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        
        .button-modern:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 32px rgba(59, 130, 246, 0.25);
        }
        
        .button-modern:hover::before {
            left: 100%;
        }
        
        .button-modern:active {
            transform: translateY(-1px);
            transition-duration: 0.1s;
        }
        
        .animate-fade-in {
            animation: fadeInSmooth 1.2s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
            opacity: 0;
        }
        
        .animate-slide-up {
            animation: slideUpSmooth 1.2s cubic-bezier(0.165, 0.84, 0.44, 1) forwards;
            opacity: 0;
        }
        
        @keyframes fadeInSmooth {
            from { 
                opacity: 0; 
                transform: scale(0.98);
            }
            to { 
                opacity: 1; 
                transform: scale(1);
            }
        }
        
        @keyframes slideUpSmooth {
            from { 
                opacity: 0; 
                transform: translateY(40px) scale(0.98);
            }
            to { 
                opacity: 1; 
                transform: translateY(0) scale(1);
            }
        }
        
        .gradient-text {
            background: linear-gradient(135deg, #1d4ed8, #3b82f6, #ea580c, #f97316);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-size: 400% 100%;
            animation: gradientShiftSmooth 8s ease-in-out infinite;
        }
        
        @keyframes gradientShiftSmooth {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }
        
        .loading-bar {
            background: linear-gradient(90deg, #3b82f6, #1d4ed8, #ea580c, #f97316, #3b82f6);
            background-size: 400% 100%;
            animation: shimmerSmooth 2.5s cubic-bezier(0.4, 0, 0.2, 1) infinite;
        }
        
        @keyframes shimmerSmooth {
            0% { background-position: -400% 0; }
            100% { background-position: 400% 0; }
        }
        
        .search-input {
            transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }
        
        .search-input:focus {
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15), 0 12px 32px rgba(59, 130, 246, 0.2);
            border-color: #3b82f6;
            background: rgba(255, 255, 255, 0.98);
            transform: scale(1.02);
        }
        
        .stats-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.8));
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 6px 32px rgba(59, 130, 246, 0.06);
        }
        
        .stats-number {
            background: linear-gradient(135deg, #1d4ed8, #3b82f6, #ea580c);
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        .stats-divider {
            background: linear-gradient(90deg, transparent, #3b82f6, #ea580c, transparent);
        }
        
        .result-card {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.92), rgba(255, 255, 255, 0.88));
            border: 1px solid rgba(255, 255, 255, 0.4);
            transition: all 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        
        .result-card:hover {
            transform: translateY(-8px) scale(1.01);
            box-shadow: 0 24px 48px rgba(59, 130, 246, 0.12);
            border-color: rgba(59, 130, 246, 0.4);
        }
        
        .sector-badge {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        }
        
        .sector-badge:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 24px rgba(59, 130, 246, 0.5);
        }
        
        .creative-badge {
            background: linear-gradient(135deg, #ea580c, #f97316);
            animation: pulseSmooth 3s ease-in-out infinite;
            box-shadow: 0 6px 20px rgba(234, 88, 12, 0.4);
        }
        
        @keyframes pulseSmooth {
            0%, 100% { 
                opacity: 1; 
                transform: scale(1);
            }
            50% { 
                opacity: 0.9; 
                transform: scale(1.02);
            }
        }
        
        .floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
            z-index: -1;
        }
        
        /* Statistical Chart Elements */
        .floating-chart {
            position: absolute;
            animation: floatChart 10s ease-in-out infinite;
        }
        
        .chart-bar {
            width: 6px;
            background: linear-gradient(180deg, rgba(59, 130, 246, 0.8), rgba(59, 130, 246, 0.3));
            border-radius: 3px;
            margin: 0 2px;
            animation: barGrow 4s ease-in-out infinite;
        }
        
        .chart-pie {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: conic-gradient(
                rgba(59, 130, 246, 0.8) 0deg 120deg,
                rgba(234, 88, 12, 0.8) 120deg 240deg,
                rgba(16, 185, 129, 0.8) 240deg 360deg
            );
            animation: rotatePie 8s linear infinite;
            box-shadow: 0 8px 32px rgba(59, 130, 246, 0.3);
        }
        
        .chart-line {
            width: 120px;
            height: 80px;
            background: linear-gradient(
                45deg,
                transparent 48%,
                rgba(59, 130, 246, 0.8) 49%,
                rgba(59, 130, 246, 0.8) 51%,
                transparent 52%
            );
            background-size: 20px 20px;
            animation: lineChart 6s ease-in-out infinite;
            border-radius: 8px;
            box-shadow: 0 8px 24px rgba(234, 88, 12, 0.2);
        }
        
        .gauge-chart {
            width: 100px;
            height: 60px;
            border: 8px solid transparent;
            border-top-color: rgba(59, 130, 246, 0.3);
            border-right-color: rgba(234, 88, 12, 0.6);
            border-left-color: rgba(16, 185, 129, 0.4);
            border-radius: 100px 100px 0 0;
            animation: gaugeRotate 5s ease-in-out infinite;
            position: relative;
        }
        
        .gauge-chart::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 25px;
            background: rgba(239, 68, 68, 0.8);
            border-radius: 2px;
            animation: needleMove 5s ease-in-out infinite;
        }
        
        .floating-chart:nth-child(1) {
            top: 15%;
            left: 8%;
            animation-delay: 0s;
        }
        
        .floating-chart:nth-child(2) {
            top: 55%;
            right: 15%;
            animation-delay: 3s;
        }
        
        .floating-chart:nth-child(3) {
            bottom: 25%;
            left: 65%;
            animation-delay: 6s;
        }
        
        .floating-chart:nth-child(4) {
            top: 30%;
            right: 35%;
            animation-delay: 4s;
        }
        
        .floating-chart:nth-child(5) {
            bottom: 45%;
            left: 15%;
            animation-delay: 7s;
        }
        
        @keyframes floatChart {
            0%, 100% { 
                transform: translateY(0px) translateX(0px) rotate(0deg);
                opacity: 0.6;
            }
            33% { 
                transform: translateY(-20px) translateX(10px) rotate(3deg);
                opacity: 0.8;
            }
            66% { 
                transform: translateY(-10px) translateX(-5px) rotate(-2deg);
                opacity: 0.9;
            }
        }
        
        @keyframes barGrow {
            0%, 100% { height: 20px; }
            50% { height: 40px; }
        }
        
        @keyframes rotatePie {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @keyframes lineChart {
            0%, 100% { 
                background-position: 0 0;
                opacity: 0.6;
            }
            50% { 
                background-position: 20px 20px;
                opacity: 0.9;
            }
        }
        
        @keyframes gaugeRotate {
            0%, 100% { transform: rotate(-15deg); }
            50% { transform: rotate(15deg); }
        }
        
        @keyframes needleMove {
            0%, 100% { transform: translateX(-50%) rotate(-30deg); }
            50% { transform: translateX(-50%) rotate(30deg); }
        }
        
        .micro-interaction {
            transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        
        .micro-interaction:active {
            transform: scale(0.98);
        }
        
        /* Enhanced smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
        
        /* Custom selection colors */
        ::selection {
            background: rgba(59, 130, 246, 0.3);
            color: #1d4ed8;
        }
        
        ::-moz-selection {
            background: rgba(59, 130, 246, 0.3);
            color: #1d4ed8;
        }
        
        /* Enhanced focus states */
        .focus-ring:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.5);
        }
    </style>
</head>
<body>
    <div class="min-h-screen py-12 px-4 relative">
        <!-- Floating Statistical Chart Elements -->
        <div class="floating-elements">
            <div class="floating-chart">
                <div class="flex items-end">
                    <div class="chart-bar" style="height: 25px; animation-delay: 0s;"></div>
                    <div class="chart-bar" style="height: 35px; animation-delay: 0.5s;"></div>
                    <div class="chart-bar" style="height: 20px; animation-delay: 1s;"></div>
                    <div class="chart-bar" style="height: 40px; animation-delay: 1.5s;"></div>
                    <div class="chart-bar" style="height: 30px; animation-delay: 2s;"></div>
                </div>
            </div>
            
            <div class="floating-chart">
                <div class="chart-pie"></div>
            </div>
            
            <div class="floating-chart">
                <div class="chart-line"></div>
            </div>
            
            <div class="floating-chart">
                <div class="gauge-chart"></div>
            </div>
            
            <div class="floating-chart">
                <div class="flex items-end">
                    <div class="chart-bar" style="height: 30px; background: linear-gradient(180deg, rgba(234, 88, 12, 0.8), rgba(234, 88, 12, 0.3)); animation-delay: 2.5s;"></div>
                    <div class="chart-bar" style="height: 25px; background: linear-gradient(180deg, rgba(16, 185, 129, 0.8), rgba(16, 185, 129, 0.3)); animation-delay: 3s;"></div>
                    <div class="chart-bar" style="height: 35px; background: linear-gradient(180deg, rgba(234, 88, 12, 0.8), rgba(234, 88, 12, 0.3)); animation-delay: 3.5s;"></div>
                </div>
            </div>
        </div>

        <!-- Header Section -->
        <div class="animate-fade-in">
            <div class="text-center mb-16">
                <h1 class="text-5xl md:text-7xl lg:text-8xl font-light gradient-text mb-6 tracking-tight">
                    Daftar Usaha Kota Medan
                </h1>
                <div class="flex items-center justify-center mb-4">
                    <div class="w-12 h-0.5 bg-gradient-to-r from-blue-500 to-orange-500 rounded-full mr-4"></div>
                    <p class="text-2xl md:text-3xl text-gray-700 font-medium">BPS Kota Medan</p>
                    <div class="w-12 h-0.5 bg-gradient-to-r from-orange-500 to-blue-500 rounded-full ml-4"></div>
                </div>
                <p class="text-orange-600 text-xl md:text-2xl font-medium opacity-90">
                    Klasifikasi Baku Lapangan Usaha Indonesia 2020
                </p>
            </div>

            <!-- Statistics Cards -->
            <div class="max-w-7xl mx-auto mb-12">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 lg:gap-8">
                    <div class="stats-card rounded-3xl p-8 card-hover animate-slide-up backdrop-blur-xl micro-interaction" style="animation-delay: 0.1s">
                        <div class="text-center">
                            <h3 class="text-4xl font-light stats-number mb-3">21</h3>
                            <p class="text-gray-600 font-medium">Kategori</p>
                            <div class="w-12 h-0.5 stats-divider rounded-full mx-auto mt-3"></div>
                        </div>
                    </div>

                    <div class="stats-card rounded-3xl p-8 card-hover animate-slide-up backdrop-blur-xl micro-interaction" style="animation-delay: 0.2s">
                        <div class="text-center">
                            <h3 class="text-4xl font-light stats-number mb-3">88</h3>
                            <p class="text-gray-600 font-medium">Golongan Pokok</p>
                            <div class="w-12 h-0.5 stats-divider rounded-full mx-auto mt-3"></div>
                        </div>
                    </div>

                    <div class="stats-card rounded-3xl p-8 card-hover animate-slide-up backdrop-blur-xl micro-interaction" style="animation-delay: 0.3s">
                        <div class="text-center">
                            <h3 class="text-4xl font-light stats-number mb-3">245</h3>
                            <p class="text-gray-600 font-medium">Golongan</p>
                            <div class="w-12 h-0.5 stats-divider rounded-full mx-auto mt-3"></div>
                        </div>
                    </div>

                    <div class="stats-card rounded-3xl p-8 card-hover animate-slide-up backdrop-blur-xl micro-interaction" style="animation-delay: 0.4s">
                        <div class="text-center">
                            <h3 class="text-4xl font-light stats-number mb-3">567</h3>
                            <p class="text-gray-600 font-medium">Sub Golongan</p>
                            <div class="w-12 h-0.5 stats-divider rounded-full mx-auto mt-3"></div>
                        </div>
                    </div>

                    <div class="stats-card rounded-3xl p-8 card-hover animate-slide-up col-span-2 md:col-span-3 lg:col-span-1 backdrop-blur-xl micro-interaction" style="animation-delay: 0.5s">
                        <div class="text-center">
                            <h3 class="text-4xl font-light stats-number mb-3">1789</h3>
                            <p class="text-gray-600 font-medium">Kelompok</p>
                            <div class="w-12 h-0.5 stats-divider rounded-full mx-auto mt-3"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Section -->
            <div class="max-w-5xl mx-auto mb-12">
                <div class="glass-effect rounded-3xl p-8 lg:p-12 card-hover backdrop-blur-xl">
                    <div class="flex flex-col lg:flex-row items-center gap-6 lg:gap-8">
                        <div class="flex-1 w-full">
                            <input 
                                type="text" 
                                placeholder="Masukkan deskripsi usaha atau kode..." 
                                class="search-input w-full px-8 py-6 border-2 border-gray-200 rounded-3xl focus:outline-none text-gray-800 placeholder-gray-400 text-lg font-medium focus-ring"
                                id="searchInput"
                            >
                        </div>
                        
                        <div class="flex flex-col sm:flex-row w-full lg:w-auto gap-4">
                            <button 
                                class="button-modern bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-medium px-10 py-6 rounded-3xl shadow-xl micro-interaction focus-ring"
                                onclick="searchDescription()"
                                id="searchDescBtn"
                            >
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                    Cari Deskripsi
                                </span>
                            </button>
                            
                            <button 
                                class="button-modern bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-medium px-10 py-6 rounded-3xl shadow-xl micro-interaction focus-ring"
                                onclick="searchCode()"
                                id="searchCodeBtn"
                            >
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9l-2 0M18 15l2 0"></path>
                                    </svg>
                                    Cari Kode
                                </span>
                            </button>
                        </div>
                    </div>

                    <!-- Loading Bar -->
                    <div id="loadingBar" class="w-full bg-gray-200 h-1.5 mt-8 rounded-full overflow-hidden relative hidden">
                        <div class="loading-bar absolute left-0 top-0 h-full w-1/2 rounded-full"></div>
                    </div>
                </div>
            </div>

            <!-- Results Section -->
            <div id="resultsContainer" class="max-w-5xl mx-auto">
                <!-- Welcome Message -->
                <div id="welcomeView" class="glass-effect rounded-3xl p-12 card-hover text-center backdrop-blur-xl">
                    <div class="mb-8">
                        <svg class="w-24 h-24 mx-auto mb-6 text-blue-400 opacity-60" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-light text-gray-700 mb-4">Selamat Datang</h2>
                    <p class="text-lg text-gray-600 font-light leading-relaxed max-w-2xl mx-auto">
                        Gunakan pencarian di atas untuk menemukan klasifikasi usaha berdasarkan deskripsi kegiatan atau kode KBLI. 
                        Sistem ini akan membantu Anda menemukan kategori usaha yang tepat sesuai dengan Klasifikasi Baku Lapangan Usaha Indonesia 2020.
                    </p>
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
        
        // Data KBLI sample
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
            
            searchDescBtn.style.opacity = '0.7';
            searchCodeBtn.style.opacity = '0.7';
            
            setTimeout(() => {
                loadingBar.classList.add('hidden');
                searchDescBtn.disabled = false;
                searchCodeBtn.disabled = false;
                searchDescBtn.style.opacity = '1';
                searchCodeBtn.style.opacity = '1';
                isSearching = false;
            }, 2500);
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
            }, 2500);
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
            }, 2500);
        }
        
        function generateMockResults(query, type) {
            const sectors = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U'];
            const mockTitles = {
                'description': [
                    'Industri Pengolahan ' + query,
                    'Perdagangan ' + query,
                    'Jasa ' + query,
                    'Kegiatan ' + query,
                    'Usaha ' + query
                ],
                'code': [
                    'Kegiatan Usaha Kode ' + query,
                    'Industri Berdasarkan Kode ' + query,
                    'Perdagangan dengan Kode ' + query
                ]
            };
            
            const results = [];
            const numResults = Math.min(3, Math.max(1, Math.floor(Math.random() * 4)));
            
            for (let i = 0; i < numResults; i++) {
                const randomSector = sectors[Math.floor(Math.random() * sectors.length)];
                const randomCode = type === 'code' ? query : (randomSector.charCodeAt(0) - 64).toString().padStart(2, '0') + Math.floor(Math.random() * 900 + 100);
                const titleArray = mockTitles[type] || mockTitles['description'];
                const randomTitle = titleArray[Math.floor(Math.random() * titleArray.length)];
                
                results.push({
                    sector: randomSector,
                    kode_5_digit: randomCode.padEnd(5, '1'),
                    judul: randomTitle,
                    deskripsi: `Deskripsi kegiatan usaha yang berkaitan dengan ${query}. Kegiatan ini meliputi berbagai aktivitas yang sesuai dengan Klasifikasi Baku Lapangan Usaha Indonesia 2020.`,
                    is_ekraf: Math.random() > 0.5
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
                <div class="glass-effect rounded-3xl p-8 mb-6 backdrop-blur-xl card-hover">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-2xl font-medium text-gray-800">Hasil Pencarian</h2>
                        <button onclick="clearResults()" class="text-gray-500 hover:text-gray-700 transition-colors duration-300 micro-interaction">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <p class="text-gray-600">Ditemukan <strong>${results.length}</strong> hasil untuk "<strong>${query}</strong>"</p>
                </div>
            `;
            
            results.forEach((result, index) => {
                const backgroundColor = result.is_ekraf ? 'creative-badge' : getSectorColorClass(result.sector);
                resultsHTML += `
                    <div class="result-card rounded-3xl p-8 animate-fade-in backdrop-blur-xl micro-interaction" style="animation-delay: ${index * 0.2}s">
                        <div class="flex items-start gap-6">
                            <div class="${backgroundColor} w-20 h-20 rounded-2xl flex items-center justify-center text-white font-medium text-2xl shadow-lg flex-shrink-0">
                                ${result.sector}
                            </div>
                            <div class="flex-1">
                                <h3 class="text-2xl font-medium text-gray-800 mb-3">
                                    ${result.kode_5_digit} - ${result.judul}
                                </h3>
                                <p class="text-gray-700 leading-relaxed text-lg mb-4">${result.deskripsi}</p>
                                <div class="flex flex-wrap gap-3">
                                    <span class="inline-block bg-blue-100 text-blue-800 px-4 py-2 rounded-xl text-sm font-medium">
                                        Kategori ${result.sector}
                                    </span>
                                    ${result.is_ekraf ? '<span class="inline-block bg-orange-100 text-orange-800 px-4 py-2 rounded-xl text-sm font-medium">✨ Ekonomi Kreatif</span>' : ''}
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            });
            
            searchResults.innerHTML = resultsHTML;
        }
        
        function getSectorColorClass(sector) {
            const colors = {
                'A': 'sector-badge bg-gradient-to-br from-green-500 to-green-600',
                'B': 'sector-badge bg-gradient-to-br from-yellow-600 to-orange-600',
                'C': 'sector-badge bg-gradient-to-br from-blue-600 to-blue-700',
                'D': 'sector-badge bg-gradient-to-br from-red-500 to-red-600',
                'E': 'sector-badge bg-gradient-to-br from-cyan-500 to-cyan-600',
                'F': 'sector-badge bg-gradient-to-br from-gray-500 to-gray-600',
                'G': 'sector-badge bg-gradient-to-br from-purple-500 to-purple-600',
                'H': 'sector-badge bg-gradient-to-br from-indigo-500 to-indigo-600',
                'I': 'sector-badge bg-gradient-to-br from-pink-500 to-pink-600',
                'J': 'sector-badge bg-gradient-to-br from-teal-500 to-teal-600',
                'K': 'sector-badge bg-gradient-to-br from-emerald-500 to-emerald-600',
                'L': 'sector-badge bg-gradient-to-br from-lime-500 to-lime-600',
                'M': 'sector-badge bg-gradient-to-br from-blue-500 to-blue-600',
                'N': 'sector-badge bg-gradient-to-br from-violet-500 to-violet-600',
                'O': 'sector-badge bg-gradient-to-br from-rose-500 to-rose-600',
                'P': 'sector-badge bg-gradient-to-br from-amber-500 to-amber-600',
                'Q': 'sector-badge bg-gradient-to-br from-slate-500 to-slate-600',
                'R': 'sector-badge bg-gradient-to-br from-orange-500 to-orange-600',
                'S': 'sector-badge bg-gradient-to-br from-sky-500 to-sky-600',
                'T': 'sector-badge bg-gradient-to-br from-fuchsia-500 to-fuchsia-600',
                'U': 'sector-badge bg-gradient-to-br from-stone-500 to-stone-600'
            };
            return colors[sector] || 'sector-badge bg-gradient-to-br from-blue-500 to-orange-500';
        }
        
        function clearResults() {
            const welcomeView = document.getElementById('welcomeView');
            const searchResults = document.getElementById('searchResults');
            
            searchResults.classList.add('hidden');
            welcomeView.classList.remove('hidden');
            
            document.getElementById('searchInput').value = '';
        }
        
        // Enhanced enter key support for search
        document.getElementById('searchInput').addEventListener('keypress', function(e) {
            if (e.key === 'Enter' && !isSearching) {
                // Default to description search
                searchDescription();
            }
        });
        
        // Auto-detect if input looks like a code
        document.getElementById('searchInput').addEventListener('input', function(e) {
            const value = e.target.value.trim();
            const searchDescBtn = document.getElementById('searchDescBtn');
            const searchCodeBtn = document.getElementById('searchCodeBtn');
            
            // If input contains only numbers or is short and alphanumeric, highlight code search
            if (/^\d+$/.test(value) || (value.length <= 5 && /^[A-Z0-9]+$/i.test(value))) {
                searchCodeBtn.style.transform = 'scale(1.02)';
                searchDescBtn.style.transform = 'scale(1)';
            } else {
                searchDescBtn.style.transform = 'scale(1.02)';
                searchCodeBtn.style.transform = 'scale(1)';
            }
        });
        
        // Reset button transforms when not focused
        document.getElementById('searchInput').addEventListener('blur', function() {
            const searchDescBtn = document.getElementById('searchDescBtn');
            const searchCodeBtn = document.getElementById('searchCodeBtn');
            
            setTimeout(() => {
                searchDescBtn.style.transform = 'scale(1)';
                searchCodeBtn.style.transform = 'scale(1)';
            }, 200);
        });
    </script>
</body>
</html>