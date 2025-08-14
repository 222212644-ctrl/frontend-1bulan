
        <div class="container px-4 py-8 mx-auto font-posterable" x-data="{ isMinimized: false, showPopup: false, popupAlreadyShown: false }" x-init="const updateSidebar = () => {
    if (window.innerWidth >= 768) {
        isMinimized = false;
    }
};
window.addEventListener('resize', updateSidebar);
updateSidebar();">
    <style>
        /* Turunkan z-index semua elemen bawaan Leaflet */
        .leaflet-container,
        .leaflet-pane,
        .leaflet-map-pane,
        .leaflet-tile,
        .leaflet-marker-icon,
        .leaflet-shadow-pane,
        .leaflet-overlay-pane,
        .leaflet-popup-pane,
        .leaflet-tooltip-pane {
            z-index: 0 !important;
        }
    </style>

    <!-- Title -->
    <h1 class="text-2xl sm:text-3xl md:text-6xl text-center text-[#456438] font-bold mb-2">
        Daftar Usaha Kota Medan
    </h1>
    <p class="mb-2 text-base text-center text-green-600 sm:text-lg md:text-2xl">
        BPS Kota Medan
    </p>
    <p class="text-[#F18317] text-base sm:text-lg md:text-2xl text-center mb-2">
        Pemetaan Wilayah Usaha
    </p>
<div class="flex justify-end py-2 px-0">
    <a href="/tabeldinamis">
    <button style= "background-color : #F18317;" class="text-white font-bold py-1 px-4 rounded-lg border-2 border-[#F18317] hover:bg-white hover:text-[#74706d] transition duration-300">
        + Buat Tabel Dinamis
    </button>
    </a>
</div>
    <main class="flex flex-col gap-4 md:flex-row">
        <!-- Sidebar -->
        <div class="flex flex-col max-h-screen transition-all duration-300 bg-white rounded-lg shadow-lg md:w-80"
            :class="{
                'h-12 overflow-hidden': isMinimized && window.innerWidth < 768,
                'h-auto': !isMinimized || window
                    .innerWidth >= 768
            }">
            <div class="flex items-center justify-between p-4 border-b">
                <h3 class="text-base text-center text-green-600 sm:text-lg md:text-2xl">
                    Cari Data Berdasarkan Wilayah
                </h3>
                <!-- Toggle Button (Mobile Only) -->
                <button class="text-[#F18317] hover:text-[#F18317] font-bold text-lg md:hidden"
                    @click="isMinimized = !isMinimized">
                    <span x-show="!isMinimized">⏶</span>
                    <span x-show="isMinimized">⏷</span>
                </button>
            </div>
            <div class="flex-1 p-4 space-y-4 transition-all duration-300"
                :class="{
                    'opacity-0 pointer-events-none': isMinimized && window.innerWidth < 768,
                    'opacity-100 pointer-events-auto': !isMinimized || window.innerWidth >= 768
                }"
                x-cloak>

                <div id="filter-jenis" x-data="{ selected: '' }">
                    <label class="form-control block text-sm font-medium text-[#F18317] mb-1">Jenis Peta</label>
                    <select 
                        id="filter_jenis_peta" 
                        x-model="selected" 
                        @change="
                            if (selected === 'ruta' && !popupAlreadyShown) {
                                showPopup = true;
                                popupAlreadyShown = true;
                            }
                        "
                        class="w-full px-3 py-2 text-gray-500 border rounded-md focus:outline-none focus:ring-1 focus:ring-custom">
                        <option value="usaha">Prelist</option>
                        <option value="ruta">Listing</option>
                    </select>
                </div>

                 <div id="filter-kategori">
                    <label class="block text-sm font-medium text-[#F18317] mb-1">Kategori Usaha</label>
                
                    <!-- Custom Dropdown Trigger -->
                    <div id="custom-select" 
                         class="w-full px-4 py-2 text-gray-500 bg-white border-2 border-black rounded-md cursor-pointer flex justify-between items-center hover:border-[#F18317] transition focus:outline-none focus:ring-1 focus:ring-custom">
                        <span id="selected-value">- All -</span>
                        <svg class="w-4 h-4 ml-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                
                    <!-- Dropdown Content -->
                    <div id="dropdown-content" 
                         class="relative z-20 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg hidden transition-all duration-200 ease-in-out max-h-64 overflow-y-auto">
                        <div class="p-3 space-y-2">
                            <!-- Checkbox Items -->
                            <div class="checkbox-container">
                                <label><input type="checkbox" class="filter-checkbox" value="A" checked>A</label>
                                <label><input type="checkbox" class="filter-checkbox" value="B" checked>B</label>
                                <label><input type="checkbox" class="filter-checkbox" value="C" checked>C</label>
                                <label><input type="checkbox" class="filter-checkbox" value="D" checked>D</label>
                                <label><input type="checkbox" class="filter-checkbox" value="E" checked>E</label>
                                <label><input type="checkbox" class="filter-checkbox" value="F" checked>F</label>
                                <label><input type="checkbox" class="filter-checkbox" value="G" checked>G</label>
                                <label><input type="checkbox" class="filter-checkbox" value="H" checked>H</label>
                                <label><input type="checkbox" class="filter-checkbox" value="I" checked>I</label>
                                <label><input type="checkbox" class="filter-checkbox" value="J" checked>J</label>
                                <label><input type="checkbox" class="filter-checkbox" value="K" checked>K</label>
                                <label><input type="checkbox" class="filter-checkbox" value="L" checked>L</label>
                                <label><input type="checkbox" class="filter-checkbox" value="M" checked>M</label>
                                <label><input type="checkbox" class="filter-checkbox" value="N" checked>N</label>
                                <label><input type="checkbox" class="filter-checkbox" value="O" checked>O</label>
                                <label><input type="checkbox" class="filter-checkbox" value="P" checked>P</label>
                                <label><input type="checkbox" class="filter-checkbox" value="Q" checked>Q</label>
                                <label><input type="checkbox" class="filter-checkbox" value="R" checked>R</label>
                                <label><input type="checkbox" class="filter-checkbox" value="S" checked>S</label>
                                <label><input type="checkbox" class="filter-checkbox" value="T" checked>T</label>
                                <label><input type="checkbox" class="filter-checkbox" value="U" checked>U</label>
                            </div>
                            <!-- Tambahkan sesuai kebutuhan -->
                        </div>
                        {{-- <div class="flex space-x-2 mb-2">
                            <button id="select-all" class="bttn primary text-xs px-2 py-1">Select All</button>
                            <button id="deselect-all" class="bttn text-xs px-2 py-1">Deselect All</button>
                        </div> --}}
                        <div class="flex justify-between items-center px-3 py-2 mr-4">
                            <button id="select-all" class="bttn">Select All</button>
                            <button id="deselect-all" class="bttn">Deselect All</button>
                        </div>
                    </div>
                </div>
                
                <div id="filter-kabupaten">
                    <label class="form-control block text-sm font-medium text-[#F18317] mb-1">Kabupaten/Kota</label>
                    <select id="filter_kabupaten_kota" wire:model="kabupaten_kota"
                        class="w-full px-3 py-2 text-gray-500 border rounded-md focus:outline-none focus:ring-1 focus:ring-custom">
                        <option value="">- All -</option>
                        @foreach ($kabupatenOptions as $kabupaten)
                            <option value="{{ $kabupaten['kode'] }}">{{ $kabupaten['nama'] }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="filter-kecamatan">
                    <label class="form-control block text-sm font-medium text-[#F18317] mb-1">Kecamatan</label>
                    <select id="filter_kecamatan"
                        class="w-full px-3 py-2 text-gray-500 border rounded-md focus:outline-none focus:ring-1 focus:ring-custom">
                        <option value="">- All -</option>
                    </select>
                </div>

                <div id="filter-kelurahan">
                    <label class="form-control block text-sm font-medium text-[#F18317] mb-1">Kelurahan/Desa</label>
                    <select id="filter_kelurahan"
                        class="w-full px-3 py-2 text-gray-500 border rounded-md focus:outline-none focus:ring-1 focus:ring-custom">
                        <option value="">- All -</option>
                    </select>
                </div>

                <div id="filter-blok-sensus" style="display: none">
                    <label class="form-control block text-sm font-medium text-[#F18317] mb-1">Blok Sensus</label>
                    <select id="filter_blok_sensus"
                        class="w-full px-3 py-2 text-gray-500 border rounded-md focus:outline-none focus:ring-1 focus:ring-custom">
                        <option value="">- All -</option>
                    </select>
                </div>

                <div id="filter-sls">
                    <label class="form-control block text-sm font-medium text-[#F18317] mb-1">Satuan Lingkungan
                        Setempat</label>
                    <select id="filter_sls"
                        class="w-full px-3 py-2 text-gray-500 border rounded-md focus:outline-none focus:ring-1 focus:ring-custom">
                        <option value="">- All -</option>
                    </select>
                </div>

                <div class="flex justify-end space-x-2">
                    <button onclick="resetFilter()"
                        class="px-3 py-2 text-xs text-gray-800 bg-gray-200 rounded-md md:text-sm hover:bg-gray-300">
                        Reset
                    </button>
                </div>
            </div>

            <!-- Daftar Nama Usaha -->
            <div id="list-usaha" class="p-4 overflow-y-auto border-t max-h-64" x-show="!isMinimized || window.innerWidth >= 768"
                x-cloak>
                <h3 class="font-medium mb-4 text-[#F18317]">Daftar Nama Usaha</h3>
                <ul id="list_usaha" class="space-y-2 text-sm text-gray-600">
                </ul>
            </div>
        </div>

        <!-- Map Area -->
        <div class="relative flex flex-col w-full bg-white rounded-lg shadow-lg">
            <div class="relative flex-1 overflow-hidden rounded-lg">
                <button id="setting" class="setting z-10 p-2 text-gray-500 hover:text-gray-700 focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
                <h3 class="mt-2 mb-2 text-base text-center text-green-600 sm:text-lg md:text-2xl">
                    Peta
                </h3>

                <!-- Peta Leaflet -->
                <div 
                    id="map" 
                    class="relative z-0 w-full h-64 bg-center bg-cover md:h-full"
                ></div>
            </div>
        </div>
        
    </main>
        <!-- Popup Informasi Penting -->
        <div 
            x-show="showPopup" 
            x-transition 
            class="fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-60"
        >
            <div class="bg-white rounded-xl shadow-xl w-13/14 max-w-4xl p-6 border-t-8 border-[#F18317] mx-4 md:mx-0">
                <h2 class="text-3xl md:text-5xl font-bold text-[#456438] mb-5 text-center">INFORMASI PENTING</h2>
                <p class="text-lg md:text-xl text-gray-700 text-justify mb-5">
                    Data yang Anda lihat bukan merupakan representasi dari seluruh Provinsi Sumatera Selatan. Informasi yang ditampilkan berasal dari kabupaten/kota yang dipilih sebagai sampel dalam kegiatan listing, sesuai dengan metodologi survei yang digunakan. Oleh karena itu, hasil ini bersifat parsial dan tidak mencerminkan keseluruhan kondisi provinsi. Silahkan perhatikan konteks penggunaan data ini sebelum mengambil kesimpulan.
                </p>
                <div class="text-center">
                    <button 
                    @click="showPopup = false" 
                    class="hover:bg-white text-white hover:text-[#74706d] font-semibold py-2 px-6 rounded border-2 border-[#F18317] transition duration-300"
                    style="background-color: #F18317 !important;"
                >
                    Oke, saya mengerti
                </button>
                </div>
            </div>
        </div>
    
        <div id="settings-popup" class="fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-60 hidden">
            <div class="bg-white rounded-xl shadow-xl w-11/12 max-w-md p-6 border-t-8 border-[#F18317] mx-4">
                <h2 class="text-2xl font-bold text-[#456438] mb-4">Pengaturan Peta</h2>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between" id="set-cluster">
                        <label class="text-gray-700 mr-4">Cluster berdasarkan batas wilayah</label>
                        <label class="toggle-switch ml-4">
                            <input type="checkbox" id="setting-cluster" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="flex items-center justify-between" id="set-lokus">
                        <label class="text-gray-700 mr-4">Highlight lokus pkl</label>
                        <label class="toggle-switch ml-4">
                            <input type="checkbox" id="setting-lokus">
                            <span class="slider"></span>
                        </label>
                    </div>
                    <div class="flex items-center justify-between" id="set-markers">
                        <label class="text-gray-700 mr-4">Tampilkan semua titik usaha</label>
                        <label class="toggle-switch ml-4">
                            <input type="checkbox" id="setting-markers">
                            <span class="slider"></span>
                        </label>
                    </div>
                    
                    <!-- Tombol Aksi -->
                    <div class="flex justify-center space-x-3 pt-4">
                        <button id="cancel-settings" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div id="warning-popup" class="fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-60 hidden" >
            <div class="bg-white rounded-xl shadow-xl w-11/12 max-w-md p-6 border-t-8 border-[#F18317] mx-4">
                <h2 class="text-2xl font-bold text-center text-red-500 mb-4">Peringatan</h2>
                <p class="text-center">Anda akan menampilkan puluhan ribu titik sekaligus di peta.
                    Ini dapat menyebabkan kinerja aplikasi menjadi lambat, browser tidak responsif, atau bahkan gagal memuat peta.
                    Disarankan untuk menampilkan titik secara bertahap, menggunakan filter atau zoom klaster.</p>
                <div class="space-y-4">
                    <!-- Tombol Aksi -->
                    <div class="flex justify-center space-x-2 pt-4">
                        <button id="cancel-warning" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 mr-4 ml-4">
                            Batal
                        </button>
                        <button id="go-warning" class="px-4 py-2 text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 mr-4 ml-4">
                            Lanjutkan
                        </button>
                    </div>
                </div>
            </div>
        </div>

</div>



{{-- <script src="{{ asset('js/geojson_bs.js') }}"></script> --}}
{{-- <script src="{{ asset('js/geojson_sls.js') }}"></script> --}}

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const customSelect = document.getElementById('custom-select');
        const dropdownContent = document.getElementById('dropdown-content');

        customSelect.addEventListener('click', () => {
            dropdownContent.classList.toggle('hidden');
        });

        // Close when clicking outside
        document.addEventListener('click', (e) => {
            if (!customSelect.contains(e.target) && !dropdownContent.contains(e.target)) {
                dropdownContent.classList.add('hidden');
            }
        });

        // Optional: Update label based on selected checkboxes
        // const checkboxes = document.querySelectorAll('.filter-checkbox');
        // const selectedValue = document.getElementById('selected-value');

        // checkboxes.forEach(cb => {
        //     cb.addEventListener('change', () => {
        //         const selected = Array.from(checkboxes)
        //             .filter(c => c.checked)
        //             .map(c => c.value)
        //             .join(', ');
        //         selectedValue.textContent = selected || 'Pilih Kategori';
        //     });
        // });

        const settingButton = document.getElementById('setting');
        const settingsPopup = document.getElementById('settings-popup');
        const cancelButton = document.getElementById('cancel-settings');
        
        // Toggle popup
        settingButton.addEventListener('click', function() {
            settingsPopup.classList.toggle('hidden');
        });
        
        // Tutup popup
        cancelButton.addEventListener('click', function() {
            settingsPopup.classList.add('hidden');
        });

        const jenis_peta = document.getElementById("filter_jenis_peta");
        jenis_peta.value = "usaha";
        jenis_peta.dispatchEvent(new Event("change")); 
    });

    let kabData, kecData, kelData, bsData, slsData, titikDataUsaha, rutaData, usahaData, lokusData;
    var layerBs, layerSls, layerLokus;
    var kbliA = L.layerGroup();
    var kbliB = L.layerGroup();
    var kbliC = L.layerGroup();
    var kbliD = L.layerGroup();
    var kbliE = L.layerGroup();
    var kbliF = L.layerGroup();
    var kbliG = L.layerGroup();
    var kbliH = L.layerGroup();
    var kbliI = L.layerGroup();
    var kbliJ = L.layerGroup();
    var kbliK = L.layerGroup();
    var kbliL = L.layerGroup();
    var kbliM = L.layerGroup();
    var kbliN = L.layerGroup();
    var kbliO = L.layerGroup();
    var kbliP = L.layerGroup();
    var kbliQ = L.layerGroup();
    var kbliR = L.layerGroup();
    var kbliS = L.layerGroup();
    var kbliT = L.layerGroup();
    var kbliU = L.layerGroup();
    // Initialize map with Google Maps
    var map = L.map('map').setView([-3.4, 105.1], 9);

    // Google Maps Regular tiles
    var googleStreets = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        attribution: '&copy; Google Maps'
    }).addTo(map);

    // Google Maps Satellite tiles
    var googleSat = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 20,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3'],
        attribution: '&copy; Google Maps'
    });

    // Add layer control
    var baseMaps = {
        "Google Streets": googleStreets,
        "Google Satellite": googleSat
    };

    L.control.layers(baseMaps).addTo(map);

    var wilayahTerkecilGroup = L.layerGroup().addTo(map);
    var wilayah_terkecil = "sls";

    document.addEventListener('DOMContentLoaded', async () => {
        kabData = await loadGeoJSON('kab');
        if (kabData) {
            geojson = L.geoJson(kabData, {
                style: style,
                onEachFeature: onEachFeature
            }).addTo(map);
        }
    });

    function style(feature) {
        return {
            fillColor: "#3388ff",
            weight: 2,
            opacity: 1,
            color: 'white',
            dashArray: '3',
            fillOpacity: 0.1
        };
    }

    function styleKec(feature) {
        return {
            fillColor: "#3388ff",
            weight: 2,
            opacity: 1,
            color: 'white',
            dashArray: '3',
            fillOpacity: 0.1
        };
    }

    function styleKel(feature) {
        return {
            fillColor: "#3388ff",
            weight: 2,
            opacity: 1,
            color: 'white',
            dashArray: '3',
            fillOpacity: 0.1
        };
    }

    function styleSls(feature) {
        return {
            fillColor: 'green',
            weight: 2,
            opacity: 1,
            color: 'white',
            dashArray: '3',
            fillOpacity: 0.1
        };
    }

    function styleLokus(feature) {
        return {
            fillColor: 'orange',
            weight: 2,
            opacity: 1,
            color: 'white',
            dashArray: '3',
            fillOpacity: 1
        };
    }

    function highlightFeature(e) {
        var layer = e.target;

        layer.setStyle({
            weight: 5,
            color: '#666',
            dashArray: '',
            fillOpacity: 0.1
        });

        layer.bringToFront();
        info.update(layer.feature.properties);
    }

    function highlightFeatureKel(e) {
        var layer = e.target;

        layer.setStyle({
            weight: 5,
            color: '#666',
            dashArray: '',
            fillOpacity: 0.1
        });

        layer.bringToFront();
        info.update(layer.feature.properties);
    }

    function resetHighlight(e) {
        geojson.resetStyle(e.target);
        info.update();
    }

    function zoomToFeature(e) {
        map.fitBounds(e.target.getBounds());
    }

    function zoomToFeatureKec(e) {
        map.fitBounds(e.target.getBounds());
        geojson = L.geoJson(filterWilayah(kecData, 'kodekab', feature.properties.kodekab), {
            style: style,
            onEachFeature: onEachFeature
        }).addTo(map);
    }

    function onEachFeature(feature, layer) {
        layer.on({
            mouseover: highlightFeature,
            mouseout: resetHighlight,
            click: function(e) {
                document.getElementById('filter_kabupaten_kota').value = feature.properties.kodekab;
                document.getElementById('filter_kabupaten_kota').dispatchEvent(new Event('change'));
            }
        });
    }

    function onEachFeatureKec(feature, layer) {
        layer.on({
            mouseover: highlightFeature,
            mouseout: resetHighlight,
            click: function(e) {
                document.getElementById('filter_kecamatan').value = feature.properties.kodekec;
                document.getElementById('filter_kecamatan').dispatchEvent(new Event('change'));
            }
        });
    }

    function onEachFeatureKel(feature, layer) {
        layer.on({
            mouseover: highlightFeatureKel,
            mouseout: resetHighlight,
            click: function(e) {
                document.getElementById('filter_kelurahan').value = feature.properties.kodekel;
                document.getElementById('filter_kelurahan').dispatchEvent(new Event('change'));
            }
        });
    }

    function onEachFeatureBs(feature, layer) {
        layer.on({
            mouseover: highlightFeatureKel,
            mouseout: resetHighlight,
            click: function(e) {
                document.getElementById('filter_blok_sensus').value = feature.properties.kodebs;
                document.getElementById('filter_blok_sensus').dispatchEvent(new Event('change'));
            }
        });
    }

    function onEachFeatureLokus(feature, layer) {
        layer.on({
            mouseover: highlightFeatureKel,
            mouseout: resetHighlight,
            // click: function(e) {
            //     document.getElementById('filter_blok_sensus').value = feature.properties.kodebs;
            //     document.getElementById('filter_blok_sensus').dispatchEvent(new Event('change'));
            // }
        });
    }

    function onEachFeatureSls(feature, layer) {
        layer.on({
            mouseover: highlightFeatureKel,
            mouseout: resetHighlight,
            click: function(e) {
                document.getElementById('filter_sls').value = feature.properties.idsls;
                document.getElementById('filter_sls').dispatchEvent(new Event('change'));
            }
        });
    }

    // geojson = L.geoJson(kabData, {
    //     style: style,
    //     onEachFeature: onEachFeature
    // }).addTo(map);

    var info = L.control();

    info.onAdd = function(map) {
        this._div = L.DomUtil.create('div', 'info');
        this.update();
        return this._div;
    };

    info.update = function(props) {
        this._div.innerHTML = (props ? '<h4>Nama ' + props.type_wilayah : '') + '</h4>' + (props ?
            '<b>' + props.nama_wilayah + '</b>' :
            '');
    };

    info.addTo(map);

    function filterWilayah(data, property, code) {
        return {
            type: "FeatureCollection",
            features: data.features.filter(function(feature) {
                return feature.properties[property] === code;
            }),
        };
    }

    function filterWilayahKbli(data, property, code) {
        return {
            type: "FeatureCollection",
            features: data.features.filter(function(feature) {
                const value = feature.properties[property];
                const kbli = feature.properties.kode_kbli;
                return value === code && kbli !== null;
            }),
        };
    }

    function filterNotWilayah(data, property, code) {
        return {
            type: "FeatureCollection",
            features: data.features.filter(function(feature) {
                return feature.properties[property] != code;
            }),
        };
    }

    let userMarker, userAccuracyCircle;
    let isTracking = false;
    let watchId = null;

    var locateControl = L.control({
        position: 'topleft'
    });

    var manIcon = L.icon({
        iconUrl: '{{ asset('img/Srika.webp') }}',
        shadowUrl: null,
        iconSize: [40, 60],
        iconAnchor: [20, 40],
        popupAnchor: [0, -40]
    });

    locateControl.onAdd = function() {
        var div = L.DomUtil.create('div', 'leaflet-bar');
        var button = L.DomUtil.create('a', '', div);
        button.href = '#';
        button.innerHTML = '📍';
        button.title = 'Aktifkan/Nonaktifkan Live Tracking';
        button.style.backgroundColor = 'white';

        button.onclick = function(e) {
            e.preventDefault();
            if (!isTracking) {
                startTracking();
                button.style.backgroundColor = '#4CAF50';
                button.title = 'Nonaktifkan Live Tracking';
            } else {
                stopTracking();
                button.style.backgroundColor = 'white';
                button.title = 'Aktifkan Live Tracking';
            }
        };

        return div;
    };

    function startTracking() {
        if (!isTracking) {
            isTracking = true;
            if ("geolocation" in navigator) {
                watchId = navigator.geolocation.watchPosition(
                    function(position) {
                        updatePosition(position);
                    },
                    function(error) {
                        console.error("Error getting location:", error);
                        alert("Tidak dapat mengakses lokasi Anda. Pastikan GPS aktif dan izin lokasi diberikan.");
                        stopTracking();
                    }, {
                        enableHighAccuracy: true,
                        maximumAge: 0,
                        timeout: 5000
                    }
                );
            } else {
                alert("Browser Anda tidak mendukung geolocation");
                stopTracking();
            }
        }
    }

    function updatePosition(position) {
        const latlng = [position.coords.latitude, position.coords.longitude];
        const accuracy = position.coords.accuracy;

        // Hapus marker dan circle yang lama jika ada
        if (userMarker) {
            map.removeLayer(userMarker);
        }
        if (userAccuracyCircle) {
            map.removeLayer(userAccuracyCircle);
        }

        // Buat marker baru
        userMarker = L.marker(latlng, {
            icon: manIcon
        }).addTo(map);

        // Buat circle akurasi baru
        userAccuracyCircle = L.circle(latlng, {
            radius: accuracy,
            color: '#4CAF50',
            fillColor: '#4CAF50',
            fillOpacity: 0.15,
            weight: 2
        }).addTo(map);

        // Update popup
        userMarker.bindPopup(`Akurasi: ${Math.round(accuracy)} meter`).openPopup();

        // Center map pada posisi pertama
        if (!userMarker._popup._isOpen) {
            map.setView(latlng, 16);
        }
    }

    function stopTracking() {
        if (isTracking) {
            isTracking = false;
            if (watchId !== null) {
                navigator.geolocation.clearWatch(watchId);
                watchId = null;
            }
            if (userMarker) {
                map.removeLayer(userMarker);
                userMarker = null;
            }
            if (userAccuracyCircle) {
                map.removeLayer(userAccuracyCircle);
                userAccuracyCircle = null;
            }
        }
    }

    // Tambahkan control ke map
    locateControl.addTo(map);

    // Cleanup ketika halaman unload
    window.addEventListener('unload', function() {
        if (isTracking) {
            stopTracking();
        }
    });

    document.getElementById('filter_kabupaten_kota').addEventListener('change', async function(e) {
        const selectedKab = e.target.value;
        
        if (selectedKab) {
            let loadingBar;
            if (selectedKab && !kecData) {
                loadingBar = showLoading('filter_kecamatan');
                try {
                    kecData = await loadGeoJSON('kec');
                } finally {
                    hideLoading(loadingBar);
                }
            }
            document.getElementById('filter_kecamatan').innerHTML = '<option value="">- All -</option>';
            document.getElementById('filter_kelurahan').innerHTML =
                '<option disabled selected value="">- All -</option>';
            document.getElementById('filter_blok_sensus').innerHTML =
                '<option disabled selected value="">- All -</option>';
            document.getElementById('filter_sls').innerHTML =
                '<option disabled selected value="">- All -</option>';
            document.getElementById('list_usaha').innerHTML = 'List usaha muncul ketika sudah di sls atau bs';

            var geojsonData = filterWilayah(kecData, 'kodekab', selectedKab);
            const kecamatanSelect = document.getElementById('filter_kecamatan');

            layerKab = L.geoJson(geojsonData, {
                style: styleKec,
                onEachFeature: onEachFeatureKec
            })


            if (layerKab.getBounds().isValid()) {
                map.fitBounds(layerKab.getBounds());
            }

            geojson = L.geoJson(geojsonData, {
                style: styleKec,
                onEachFeature: onEachFeatureKec
            }).addTo(map);

            geojsonData.features
                .sort((a, b) => a.properties.nama_wilayah.localeCompare(b.properties.nama_wilayah))
                .forEach(feature => {
                    const option = document.createElement('option');
                    option.value = feature.properties.kodekec;
                    option.textContent = feature.properties.nama_wilayah;
                    kecamatanSelect.appendChild(option);
                });
            if(document.getElementById('filter_jenis_peta').value == "usaha") {
            } else if (document.getElementById('filter_jenis_peta').value == "ruta") {
                
            }
        } else {
            if (map.hasLayer(rutaMatchClusterGroup)) {
                map.removeLayer(rutaMatchClusterGroup);
            }
            map.setView([-3.4, 105.1], 9);
        }
    });

    
    function createFontAwesomeIcon(color) {
        return L.divIcon({
            className: 'custom-fa-marker',
            html: `<i class="fa-sharp fa-solid fa-location-dot" style="color: ${color}; font-size: 24px;"></i>`,
            // html: `<i class="fa-solid fa-location-dot" style="color: ${color}; font-size: 24px;"></i>`,
            iconSize: [24, 24],
            iconAnchor: [12, 24],
            popupAnchor: [0, -24]
        });
    }

    let markerClusterGroup;
    let rutaMatchClusterGroup; // Satu cluster untuk ruta dan match

    // 2. Inisialisasi cluster groups di awal aplikasi
    function initializeClusterGroups() {
        markerClusterGroup = L.markerClusterGroup({
            chunkedLoading: true,
            maxClusterRadius: 50,
            spiderfyOnMaxZoom: true,
            showCoverageOnHover: false,
            zoomToBoundsOnClick: true,
            disableClusteringAtZoom: 17,
        });
        
        rutaMatchClusterGroup = L.markerClusterGroup({
            chunkedLoading: true,
            maxClusterRadius: 50,
            spiderfyOnMaxZoom: true,
            showCoverageOnHover: false,
            zoomToBoundsOnClick: true,
            disableClusteringAtZoom: 17,
            iconCreateFunction: function(cluster) {
                var childCount = cluster.getChildCount();
                var maxCount = 5000;

                // Hitung proporsi (maksimal 1)
                var intensity = Math.min(childCount / maxCount, 1);

                // Lightness makin kecil = makin tua warnanya
                var lightness = 80 - intensity * 50; // dari 80% (paling muda) ke 30% (paling tua)

                // HSL untuk warna ungu (Hue = 280 derajat)
                var bgColor = `hsl(280, 70%, ${lightness}%)`;

                return new L.DivIcon({
                    html: `<div style="background-color:${bgColor}; border: 2px solid ${bgColor};"><span>${childCount}</span></div>`,
                    className: 'marker-cluster',
                    iconSize: new L.Point(40, 40)
                });
            }
        });
        usahaMatchClusterGroup = L.markerClusterGroup({
            chunkedLoading: true,
            maxClusterRadius: 50,
            spiderfyOnMaxZoom: true,
            showCoverageOnHover: false,
            zoomToBoundsOnClick: true,
            disableClusteringAtZoom: 17,
            iconCreateFunction: function(cluster) {
                var childCount = cluster.getChildCount();
                var maxCount = 5000;

                // Hitung proporsi (maksimal 1)
                var intensity = Math.min(childCount / maxCount, 1);

                // Lightness makin kecil = makin tua warnanya
                var lightness = 80 - intensity * 50; // dari 80% (paling muda) ke 30% (paling tua)

                // HSL untuk warna ungu (Hue = 280 derajat)
                var bgColor = `hsl(280, 70%, ${lightness}%)`;

                return new L.DivIcon({
                    html: `<div style="background-color:${bgColor}"><span>${childCount}</span></div>`,
                    className: 'marker-cluster',
                    iconSize: new L.Point(40, 40)
                });
            }
        });
        rutaMatchClusterPrabumulih = L.markerClusterGroup({
            chunkedLoading: true,
            maxClusterRadius: 50,
            spiderfyOnMaxZoom: true,
            showCoverageOnHover: false,
            zoomToBoundsOnClick: true,
            disableClusteringAtZoom: 17,
            iconCreateFunction: function(cluster) {
                var childCount = cluster.getChildCount();
                var maxCount = 5000;

                // Hitung proporsi (maksimal 1)
                var intensity = Math.min(childCount / maxCount, 1);

                // Lightness makin kecil = makin tua warnanya
                var lightness = 80 - intensity * 50; // dari 80% (paling muda) ke 30% (paling tua)

                // HSL untuk warna ungu (Hue = 280 derajat)
                var bgColor = `hsl(280, 70%, ${lightness}%)`;

                return new L.DivIcon({
                    html: `<div style="background-color:${bgColor}"><span>${childCount}</span></div>`,
                    className: 'marker-cluster',
                    iconSize: new L.Point(40, 40)
                });
            }
        });
        rutaMatchClusterPalembang = L.markerClusterGroup({
            chunkedLoading: true,
            maxClusterRadius: 50,
            spiderfyOnMaxZoom: true,
            showCoverageOnHover: false,
            zoomToBoundsOnClick: true,
            disableClusteringAtZoom: 17,
            iconCreateFunction: function(cluster) {
                var childCount = cluster.getChildCount();
                var maxCount = 5000;

                // Hitung proporsi (maksimal 1)
                var intensity = Math.min(childCount / maxCount, 1);

                // Lightness makin kecil = makin tua warnanya
                var lightness = 80 - intensity * 50; // dari 80% (paling muda) ke 30% (paling tua)

                // HSL untuk warna ungu (Hue = 280 derajat)
                var bgColor = `hsl(280, 70%, ${lightness}%)`;

                return new L.DivIcon({
                    html: `<div style="background-color:${bgColor}"><span>${childCount}</span></div>`,
                    className: 'marker-cluster',
                    iconSize: new L.Point(40, 40)
                });
            }
        });
        rutaMatchClusterOKI = L.markerClusterGroup({
            chunkedLoading: true,
            maxClusterRadius: 200,
            spiderfyOnMaxZoom: true,
            showCoverageOnHover: false,
            zoomToBoundsOnClick: true,
            disableClusteringAtZoom: 17,
            iconCreateFunction: function(cluster) {
                var childCount = cluster.getChildCount();
                var maxCount = 5000;

                // Hitung proporsi (maksimal 1)
                var intensity = Math.min(childCount / maxCount, 1);

                // Lightness makin kecil = makin tua warnanya
                var lightness = 80 - intensity * 50; // dari 80% (paling muda) ke 30% (paling tua)

                // HSL untuk warna ungu (Hue = 280 derajat)
                var bgColor = `hsl(280, 70%, ${lightness}%)`;

                return new L.DivIcon({
                    html: `<div style="background-color:${bgColor}"><span>${childCount}</span></div>`,
                    className: 'marker-cluster',
                    iconSize: new L.Point(40, 40)
                });
            }
        });
        rutaMatchClusterOI = L.markerClusterGroup({
            chunkedLoading: true,
            maxClusterRadius: 90,
            spiderfyOnMaxZoom: true,
            showCoverageOnHover: false,
            zoomToBoundsOnClick: true,
            disableClusteringAtZoom: 17,
            iconCreateFunction: function(cluster) {
                var childCount = cluster.getChildCount();
                var maxCount = 5000;

                // Hitung proporsi (maksimal 1)
                var intensity = Math.min(childCount / maxCount, 1);

                // Lightness makin kecil = makin tua warnanya
                var lightness = 80 - intensity * 50; // dari 80% (paling muda) ke 30% (paling tua)

                // HSL untuk warna ungu (Hue = 280 derajat)
                var bgColor = `hsl(280, 70%, ${lightness}%)`;

                return new L.DivIcon({
                    html: `<div style="background-color:${bgColor}"><span>${childCount}</span></div>`,
                    className: 'marker-cluster',
                    iconSize: new L.Point(40, 40)
                });
            }
        });

        usahaMatchClusterPrabumulih = L.markerClusterGroup({
            chunkedLoading: true,
            maxClusterRadius: 100,
            spiderfyOnMaxZoom: true,
            showCoverageOnHover: false,
            zoomToBoundsOnClick: true,
            disableClusteringAtZoom: 17,
            iconCreateFunction: function(cluster) {
                var childCount = cluster.getChildCount();
                var maxCount = 5000;

                // Hitung proporsi (maksimal 1)
                var intensity = Math.min(childCount / maxCount, 1);

                // Lightness makin kecil = makin tua warnanya
                var lightness = 80 - intensity * 50; // dari 80% (paling muda) ke 30% (paling tua)

                // HSL untuk warna ungu (Hue = 280 derajat)
                var bgColor = `hsl(280, 70%, ${lightness}%)`;

                return new L.DivIcon({
                    html: `<div style="background-color:${bgColor}"><span>${childCount}</span></div>`,
                    className: 'marker-cluster',
                    iconSize: new L.Point(40, 40)
                });
            }
        });
        usahaMatchClusterPalembang = L.markerClusterGroup({
            chunkedLoading: true,
            maxClusterRadius: 50,
            spiderfyOnMaxZoom: true,
            showCoverageOnHover: false,
            zoomToBoundsOnClick: true,
            disableClusteringAtZoom: 17,
            iconCreateFunction: function(cluster) {
                var childCount = cluster.getChildCount();
                var maxCount = 5000;

                // Hitung proporsi (maksimal 1)
                var intensity = Math.min(childCount / maxCount, 1);

                // Lightness makin kecil = makin tua warnanya
                var lightness = 80 - intensity * 50; // dari 80% (paling muda) ke 30% (paling tua)

                // HSL untuk warna ungu (Hue = 280 derajat)
                var bgColor = `hsl(280, 70%, ${lightness}%)`;

                return new L.DivIcon({
                    html: `<div style="background-color:${bgColor}"><span>${childCount}</span></div>`,
                    className: 'marker-cluster',
                    iconSize: new L.Point(40, 40)
                });
            }
        });
        usahaMatchClusterOKI = L.markerClusterGroup({
            chunkedLoading: true,
            maxClusterRadius: 400,
            spiderfyOnMaxZoom: true,
            showCoverageOnHover: false,
            zoomToBoundsOnClick: true,
            disableClusteringAtZoom: 17,
            iconCreateFunction: function(cluster) {
                var childCount = cluster.getChildCount();
                var maxCount = 5000;

                // Hitung proporsi (maksimal 1)
                var intensity = Math.min(childCount / maxCount, 1);

                // Lightness makin kecil = makin tua warnanya
                var lightness = 80 - intensity * 50; // dari 80% (paling muda) ke 30% (paling tua)

                // HSL untuk warna ungu (Hue = 280 derajat)
                var bgColor = `hsl(280, 70%, ${lightness}%)`;

                return new L.DivIcon({
                    html: `<div style="background-color:${bgColor}"><span>${childCount}</span></div>`,
                    className: 'marker-cluster',
                    iconSize: new L.Point(40, 40)
                });
            }
        });
        usahaMatchClusterOI = L.markerClusterGroup({
            chunkedLoading: true,
            maxClusterRadius: 200,
            spiderfyOnMaxZoom: true,
            showCoverageOnHover: false,
            zoomToBoundsOnClick: true,
            disableClusteringAtZoom: 17,
            iconCreateFunction: function(cluster) {
                var childCount = cluster.getChildCount();
                var maxCount = 5000;

                // Hitung proporsi (maksimal 1)
                var intensity = Math.min(childCount / maxCount, 1);

                // Lightness makin kecil = makin tua warnanya
                var lightness = 80 - intensity * 50; // dari 80% (paling muda) ke 30% (paling tua)

                // HSL untuk warna ungu (Hue = 280 derajat)
                var bgColor = `hsl(280, 70%, ${lightness}%)`;

                return new L.DivIcon({
                    html: `<div style="background-color:${bgColor}"><span>${childCount}</span></div>`,
                    className: 'marker-cluster',
                    iconSize: new L.Point(40, 40)
                });
            }
        });
    }

    
    function getColorByFlag(flag) {
        var colors = {
            'Listing': 'orange', 
            'Listing + Gmaps': 'green', 
            'Listing + Pencacahan': 'yellow',
            'Pencacahan + Gmaps': 'blue',
            'default': '#95A5A6'
        };
        
        // Ambil huruf pertama dari kode flag
        var kategori = flag ? flag : 'default';
        return colors[kategori] || colors['default'];
    }

    function getColorByFlagUsaha(flag) {
        var colors = {
            'GMAPS': 'orange', 
            'SBR': 'yellow', 
            'GMAPS+SBR': 'green',
            'default': '#95A5A6'
        };
        
        // Ambil huruf pertama dari kode flag
        var kategori = flag ? flag : 'default';
        return colors[kategori] || colors['default'];
    }

    function getLabelByFlagUsaha(flag) {
        var labels = {
            'GMAPS': 'Google Maps', 
            'SBR': 'SBR', 
            'GMAPS+SBR': 'Google Maps + SBR',
            'default': ''
        };
        
        // Ambil huruf pertama dari kode flag
        var kategori = flag ? flag : 'default';
        return labels[kategori] || labels['default'];
    }

    

    document.getElementById('filter_kecamatan').addEventListener('change', async function(e) {
        const selectedKec = e.target.value;
        let loadingBar;
        if (selectedKec && !kelData) {
            loadingBar = showLoading('filter_kelurahan');
            try {
                kelData = await loadGeoJSON('kel');
            } finally {
                hideLoading(loadingBar);
            }
        }
        document.getElementById('filter_kelurahan').innerHTML = '<option value="">- All -</option>';
        document.getElementById('filter_blok_sensus').innerHTML =
            '<option disabled selected value="">- All -</option>';
        document.getElementById('filter_sls').innerHTML =
            '<option disabled selected value="">- All -</option>';
        document.getElementById('list_usaha').innerHTML = 'List usaha muncul ketika sudah di sls atau bs';

        if (selectedKec) {
            var geojsonData = filterWilayah(kelData, 'kodekec', selectedKec)

            const kelurahanSelect = document.getElementById('filter_kelurahan');

            layerKec = L.geoJson(geojsonData, {
                style: styleKel,
                onEachFeature: onEachFeatureKel
            })

            if (layerKec.getBounds().isValid()) {
                map.fitBounds(layerKec.getBounds());
            }

            geojson = L.geoJson(geojsonData, {
                style: styleKel,
                onEachFeature: onEachFeatureKel
            }).addTo(map);

            geojsonData.features
                .sort((a, b) => a.properties.nama_wilayah.localeCompare(b.properties.nama_wilayah))
                .forEach(feature => {
                    const option = document.createElement('option');
                    option.value = feature.properties.kodekel;
                    option.textContent = feature.properties.nama_wilayah;
                    kelurahanSelect.appendChild(option);
                });
        } else {
            map.fitBounds(layerKab.getBounds());
        }
    });

    document.getElementById('filter_kelurahan').addEventListener('change', async function(e) {
        document.getElementById('filter_blok_sensus').innerHTML = '<option value="">- All -</option>';
        document.getElementById('filter_sls').innerHTML = '<option value="">- All -</option>';
        document.getElementById('list_usaha').innerHTML = 'List usaha muncul ketika sudah di sls atau bs';
        if (wilayah_terkecil == "bs") {
            const selectedKel = e.target.value;
            let loadingBar;
            if (selectedKel && !bsData) {
                loadingBar = showLoading('filter_blok_sensus');
                try {
                    bsData = await loadGeoJSON('bs');
                } finally {
                    hideLoading(loadingBar);
                }
            }
            if (selectedKel) {
                var geojsonData = filterWilayah(bsData, 'kodekel', selectedKel)

                const bsSelect = document.getElementById('filter_blok_sensus');

                layerKel = L.geoJson(geojsonData, {
                    style: styleKel,
                    onEachFeature: onEachFeatureBs
                })

                if (layerKel.getBounds().isValid()) {
                    map.fitBounds(layerKel.getBounds());
                }

                geojson = L.geoJson(geojsonData, {
                    style: styleKel,
                    onEachFeature: onEachFeatureBs
                }).addTo(map);
                wilayahTerkecilGroup.addLayer(geojson);

                geojsonData.features
                    .sort((a, b) => a.properties.nama_wilayah.localeCompare(b.properties.nama_wilayah))
                    .forEach(feature => {
                        const option = document.createElement('option');
                        option.value = feature.properties.kodebs;
                        option.textContent = feature.properties.nama_wilayah;
                        bsSelect.appendChild(option);
                    });
            } else {
                map.fitBounds(layerKec.getBounds());
            }
        } else {
            // document.getElementById('bsButton').disabled = true;
            // document.getElementById('bsButton').classList.add('disabled');
            const selectedKel = e.target.value.replace(/\./g, '');
            let loadingBar;
            if (selectedKel && !slsData) {
                loadingBar = showLoading('filter_sls');
                try {
                    slsData = await loadGeoJSON('sls');
                } finally {
                    hideLoading(loadingBar);
                }
            }
            if (selectedKel) {
                var geojsonData = filterWilayah(slsData, 'iddesa', selectedKel)

                const slsSelect = document.getElementById('filter_sls');

                layerKel = L.geoJson(geojsonData, {
                    style: styleKel,
                    onEachFeature: onEachFeatureSls
                })

                if (layerKel.getBounds().isValid()) {
                    map.fitBounds(layerKel.getBounds());
                }

                geojson = L.geoJson(geojsonData, {
                    style: styleKel,
                    onEachFeature: onEachFeatureSls
                }).addTo(map);
                wilayahTerkecilGroup.addLayer(geojson);

                geojsonData.features
                    .sort((a, b) => a.properties.nama_wilayah.localeCompare(b.properties.nama_wilayah))
                    .forEach(feature => {
                        const option = document.createElement('option');
                        option.value = feature.properties.idsls;
                        option.textContent = feature.properties.nama_wilayah;
                        slsSelect.appendChild(option);
                    });
            } else {
                map.fitBounds(layerKec.getBounds());
            }
        }
    });

    var titikGroup = L.layerGroup();
    var rutaGroup = L.layerGroup();
    var rutaLayerGroup = L.layerGroup();
    var titikLayerGroup = L.layerGroup();
    var kategoriLayers = {};
    var kategoriLayersPalembang = {};
    var kategoriLayersPrabumulih = {};
    var kategoriLayersOKI = {};
    var kategoriLayersOI = {};
    var kategoriLayersUsaha = {};
    var kategoriLayersPalembangUsaha = {};
    var kategoriLayersPrabumulihUsaha = {};
    var kategoriLayersOKIUsaha = {};
    var kategoriLayersOIUsaha = {};
    let markerMapUsaha = {};
    // "A": A,
    // "B": B,
    // "C": C,
    // "D": D,
    // "E": E,
    // "F": F,
    // "G": G,
    // "H": H,
    // "I": I,
    // "J": J,
    // "K": K,
    // "L": L,
    // "M": M,
    // "N": N,
    // "O": O,
    // "P": P,
    // "Q": Q,
    // "R": R,
    // "S": S,
    // "T": T,
    // "U": U,

    var jenis_peta = "usaha";
    document.getElementById('filter_jenis_peta').addEventListener('change', async function(e) {
        jenis_peta = e.target.value;
        // console.log(jenis_peta);
        // if(jenis_peta == 'usaha' && titikGroup.getLayers().length > 0) {
        //     titikGroup.addTo(map);
        //     map.removeLayer(rutaLayerGroup);
        //     // rutaLayerGroup.clearLayers();
        //     // kategoriLayers = {};
        // }
        // if(jenis_peta == 'ruta' && rutaLayerGroup.getLayers().length > 0) {
        //     rutaLayerGroup.addTo(map);
        //     updateLayers();
        //     map.removeLayer(titikGroup);
        // }
        if(jenis_peta == 'usaha') {
            document.getElementById("filter-kategori").style.display = "block";
            map.removeControl(legend_ikon);
            document.getElementById('filter-kecamatan').style.display = "block";
            document.getElementById('filter-kelurahan').style.display = "block";
            document.getElementById('list-usaha').style.display = "block";
            if(wilayah_terkecil=="sls") {
                document.getElementById('filter-sls').style.display = "block";
            }
            if(wilayah_terkecil=="bs") {
                document.getElementById('filter-blok-sensus').style.display = "block";
            }
            document.getElementById('slsButton').style.display = "inline";
            document.getElementById('bsButton').style.display = "inline";

            // map.removeLayer(rutaLayerGroup);
            // let selectElement = document.getElementById('filter_kabupaten_kota');
            // if(selectElement.value) {
            //     let event = new Event('change');
            //     selectElement.dispatchEvent(event);
            // }          
            // titikGroup.addTo(map); 

            let loadingBar;
            if (!usahaData) {
                loadingBar = showLoading('filter_jenis_peta');
                try {
                    usahaData = await loadGeoJSON('usaha');
                    // matchData = await loadGeoJSON('matching');
                } finally {
                    hideLoading(loadingBar);
                }
            }
            legend_ikon_usaha.addTo(map);

            if (map.hasLayer(rutaMatchClusterGroup)) {
                map.removeLayer(rutaMatchClusterGroup);
            }
            if (map.hasLayer(rutaMatchClusterPalembang)) {
                map.removeLayer(rutaMatchClusterPalembang);
            }
            if (map.hasLayer(rutaMatchClusterPrabumulih)) {
                map.removeLayer(rutaMatchClusterPrabumulih);
            }
            if (map.hasLayer(rutaMatchClusterOKI)) {
                map.removeLayer(rutaMatchClusterOKI);
            }
            if (map.hasLayer(rutaMatchClusterOI)) {
                map.removeLayer(rutaMatchClusterOI);
            }

            rutaMatchClusterGroup.clearLayers();
            rutaMatchClusterPalembang.clearLayers();
            rutaMatchClusterPrabumulih.clearLayers();
            rutaMatchClusterOKI.clearLayers();
            rutaMatchClusterOI.clearLayers();

            if (map.hasLayer(usahaMatchClusterGroup)) {
                map.removeLayer(usahaMatchClusterGroup);
            }
            if (map.hasLayer(usahaMatchClusterPalembang)) {
                map.removeLayer(usahaMatchClusterPalembang);
            }
            if (map.hasLayer(usahaMatchClusterPrabumulih)) {
                map.removeLayer(usahaMatchClusterPrabumulih);
            }
            if (map.hasLayer(usahaMatchClusterOKI)) {
                map.removeLayer(usahaMatchClusterOKI);
            }
            if (map.hasLayer(usahaMatchClusterOI)) {
                map.removeLayer(usahaMatchClusterOI);
            }

            titikLayerGroup.clearLayers();
            usahaMatchClusterGroup.clearLayers();
            usahaMatchClusterPalembang.clearLayers();
            usahaMatchClusterPrabumulih.clearLayers();
            usahaMatchClusterOKI.clearLayers();
            usahaMatchClusterOI.clearLayers();
            kategoriLayersUsaha = {};
            kategoriLayersPalembangUsaha = {};
            kategoriLayersPrabumulihUsaha = {};
            kategoriLayersOKIUsaha = {};
            kategoriLayersOIUsaha = {};
            // rutaLayerGroup.clearLayers();
            // kategoriLayers = {};
            // var geojsonDataTemp = filterWilayah(kabData, 'kodekab', selectedKab);
            var allMarkers = [];
            var PalembangMarkers = [];
            var PrabumulihMarkers = [];
            var OKIMarkers = [];
            var OIMarkers = [];

            var geojsonDataUsaha = usahaData
            geojsonDataUsaha.features.forEach(feature => {
                var color = getColorByFlagUsaha(feature.properties.Flag);
                var marker = L.marker([feature.geometry.coordinates[1], feature.geometry.coordinates[0]], {
                    icon: createFontAwesomeIcon(color)
                });
                
                // Add data source identifier
                marker.dataSource = 'usaha';

                // if(!feature.properties.kbli) {
                //     feature.properties.kbli = "A";
                // }
                
                // Create popup content
                let popupContent = `<div class="popup-header"></div>`;
                if (feature.properties.nama_usaha) {
                    popupContent += `<h4>${feature.properties.nama_usaha}</h4>`;
                }
                if (feature.properties.alamat_usaha) {
                    popupContent += `<p>Alamat: ${feature.properties.alamat_usaha}</p>`;
                }
                if (feature.properties.deskripsi_usaha) {
                    popupContent += `<p>Deskripsi Usaha: ${feature.properties.deskripsi_usaha}</p>`;
                }
                // if (feature.properties.kode_kbli) {
                //     popupContent += `<p>Kategori KBLI: ${feature.properties.kode_kbli}</p>`;
                // }
                // if (feature.properties.kbli) {
                //     popupContent += `<p>Kategori KBLI: ${feature.properties.kbli}</p>`;
                // }
                if (feature.properties.kode_kbli_label) {
                    popupContent += `<p>Kategori KBLI: ${feature.properties.kbli_label}</p>`;
                }
                
                marker.bindPopup(popupContent);

                if (feature.properties.kode_usaha) {
                    markerMapUsaha[feature.properties.kode_usaha] = marker;
                }
                
                // Handle kategori layers
                if (!kategoriLayersUsaha[feature.properties.kode_kbli]) {
                    kategoriLayersUsaha[feature.properties.kode_kbli] = L.layerGroup();
                }
                kategoriLayersUsaha[feature.properties.kode_kbli].addLayer(marker);
                allMarkers.push(marker);     

                if(feature.properties.kodekab == "16.02") {
                    if (!kategoriLayersOKIUsaha[feature.properties.kode_kbli]) {
                        kategoriLayersOKIUsaha[feature.properties.kode_kbli] = L.layerGroup();
                    }
                    kategoriLayersOKIUsaha[feature.properties.kode_kbli].addLayer(marker);
                    OKIMarkers.push(marker)
                }
                else if(feature.properties.kodekab == "16.10") {
                    if (!kategoriLayersOIUsaha[feature.properties.kode_kbli]) {
                        kategoriLayersOIUsaha[feature.properties.kode_kbli] = L.layerGroup();
                    }
                    kategoriLayersOIUsaha[feature.properties.kode_kbli].addLayer(marker);
                    OIMarkers.push(marker)
                }
                else if(feature.properties.kodekab == "16.72") {
                    if (!kategoriLayersPrabumulihUsaha[feature.properties.kode_kbli]) {
                        kategoriLayersPrabumulihUsaha[feature.properties.kode_kbli] = L.layerGroup();
                    }
                    kategoriLayersPrabumulihUsaha[feature.properties.kode_kbli].addLayer(marker);
                    PrabumulihMarkers.push(marker)
                }
                else if(feature.properties.kodekab == "16.71") {
                    if (!kategoriLayersPalembangUsaha[feature.properties.kode_kbli]) {
                        kategoriLayersPalembangUsaha[feature.properties.kode_kbli] = L.layerGroup();
                    }
                    kategoriLayersPalembangUsaha[feature.properties.kode_kbli].addLayer(marker);
                    PalembangMarkers.push(marker)
                }
                           
            });

            // Add semua markers ke satu cluster group
            usahaMatchClusterGroup.addLayers(allMarkers);
            allMarkers.forEach(marker => {
                titikLayerGroup.addLayer(marker);
            });
            usahaMatchClusterPalembang.addLayers(PalembangMarkers);
            usahaMatchClusterPrabumulih.addLayers(PrabumulihMarkers);
            usahaMatchClusterOKI.addLayers(OKIMarkers);
            usahaMatchClusterOI.addLayers(OIMarkers);
            
            // Add cluster group to map
            if(document.getElementById("setting-cluster").checked){
                map.addLayer(usahaMatchClusterPalembang);
                map.addLayer(usahaMatchClusterPrabumulih);
                map.addLayer(usahaMatchClusterOKI);
                map.addLayer(usahaMatchClusterOI);
            } else {
                map.addLayer(usahaMatchClusterGroup);
            }
            
            updateLayersUsaha();

            let selectElement = document.getElementById('filter_sls');
            if(selectElement.value) {
                let event = new Event('change');
                selectElement.dispatchEvent(event);
            }      

        }
        if(jenis_peta == 'ruta') {
            map.removeControl(legend_ikon_usaha);
            document.getElementById("filter-kategori").style.display = "block";
            map.removeLayer(titikGroup);
            // document.getElementById('filter-kecamatan').style.display = "none";
            // document.getElementById('filter-kelurahan').style.display = "none";
            // document.getElementById('list-usaha').style.display = "none";
            // if(wilayah_terkecil=="sls") {
            //     document.getElementById('filter-sls').style.display = "none";
            // }
            // if(wilayah_terkecil=="bs") {
            //     document.getElementById('filter-blok-sensus').style.display = "none";
            // }
            document.getElementById('slsButton').style.display = "none";
            document.getElementById('bsButton').style.display = "none";


           let loadingBar;
            if (!rutaData) {
                loadingBar = showLoading('filter_jenis_peta');
                try {
                    rutaData = await loadGeoJSON('pencacahan');
                    matchData = await loadGeoJSON('matching');
                } finally {
                    hideLoading(loadingBar);
                }
            }

            // let selectElement = document.getElementById('filter_kabupaten_kota');
            // selectElement.value = '16.71';
            // let event = new Event('change');
            // selectElement.dispatchEvent(event);
            legend_ikon.addTo(map);

            if (map.hasLayer(rutaMatchClusterGroup)) {
                map.removeLayer(rutaMatchClusterGroup);
            }
            if (map.hasLayer(rutaMatchClusterPalembang)) {
                map.removeLayer(rutaMatchClusterPalembang);
            }
            if (map.hasLayer(rutaMatchClusterPrabumulih)) {
                map.removeLayer(rutaMatchClusterPrabumulih);
            }
            if (map.hasLayer(rutaMatchClusterOKI)) {
                map.removeLayer(rutaMatchClusterOKI);
            }
            if (map.hasLayer(rutaMatchClusterOI)) {
                map.removeLayer(rutaMatchClusterOI);
            }
            rutaLayerGroup.clearLayers();
            rutaMatchClusterGroup.clearLayers();
            rutaMatchClusterPalembang.clearLayers();
            rutaMatchClusterPrabumulih.clearLayers();
            rutaMatchClusterOKI.clearLayers();
            rutaMatchClusterOI.clearLayers();

            if (map.hasLayer(usahaMatchClusterGroup)) {
                map.removeLayer(usahaMatchClusterGroup);
            }
            if (map.hasLayer(usahaMatchClusterPalembang)) {
                map.removeLayer(usahaMatchClusterPalembang);
            }
            if (map.hasLayer(usahaMatchClusterPrabumulih)) {
                map.removeLayer(usahaMatchClusterPrabumulih);
            }
            if (map.hasLayer(usahaMatchClusterOKI)) {
                map.removeLayer(usahaMatchClusterOKI);
            }
            if (map.hasLayer(usahaMatchClusterOI)) {
                map.removeLayer(usahaMatchClusterOI);
            }

            usahaMatchClusterGroup.clearLayers();
            usahaMatchClusterPalembang.clearLayers();
            usahaMatchClusterPrabumulih.clearLayers();
            usahaMatchClusterOKI.clearLayers();
            usahaMatchClusterOI.clearLayers();

            kategoriLayers = {};
            kategoriLayersPalembang = {};
            kategoriLayersPrabumulih = {};
            kategoriLayersOKI = {};
            kategoriLayersOI = {};
            // rutaLayerGroup.clearLayers();
            // kategoriLayers = {};
            // var geojsonDataTemp = filterWilayah(kabData, 'kodekab', selectedKab);
            var allMarkers = [];
            var PalembangMarkers = [];
            var PrabumulihMarkers = [];
            var OKIMarkers = [];
            var OIMarkers = [];

            // layerKabTemp = L.geoJson(geojsonDataTemp, {
            //     style: style,
            //     onEachFeature: onEachFeature
            // })


            // if (layerKabTemp.getBounds().isValid()) {
            //     map.fitBounds(layerKabTemp.getBounds());
            // }

            // var geojsonDataRuta = filterWilayah(rutaData, 'kodekab', selectedKab)
            var geojsonDataRuta = rutaData
            geojsonDataRuta.features.forEach(feature => {
                var color = getColorByFlag(feature.properties.Flag);
                var marker = L.marker([feature.geometry.coordinates[1], feature.geometry.coordinates[0]], {
                    icon: createFontAwesomeIcon(color)
                });
                
                // Add data source identifier
                marker.dataSource = 'ruta';
                
                // Create popup content
                let popupContent = `<div class="popup-header"></div>`;
                if (feature.properties.nama_usaha) {
                    popupContent += `<h4>${feature.properties.nama_usaha}</h4>`;
                }
                if (feature.properties.alamat_usaha) {
                    popupContent += `<p>Alamat: ${feature.properties.alamat_usaha}</p>`;
                }
                if (feature.properties.deskripsi_usaha) {
                    popupContent += `<p>Deskripsi Usaha: ${feature.properties.deskripsi_usaha}</p>`;
                }
                if (feature.properties.kbli_label) {
                    popupContent += `<p>Kategori KBLI: ${feature.properties.kbli_label}</p>`;
                }
                if (feature.properties.kode_kbli_label) {
                    popupContent += `<p>Kode KBLI: ${feature.properties.kode_kbli_label}</p>`;
                }
                
                marker.bindPopup(popupContent);

                if (feature.properties.kode_usaha) {
                    markerMapUsaha[feature.properties.kode_usaha] = marker;
                }
                
                // Handle kategori layers
                if (!kategoriLayers[feature.properties.kbli]) {
                    kategoriLayers[feature.properties.kbli] = L.layerGroup();
                }
                kategoriLayers[feature.properties.kbli].addLayer(marker);

                if(feature.properties.kodekab == "16.02") {
                    if (!kategoriLayersOKI[feature.properties.kbli]) {
                        kategoriLayersOKI[feature.properties.kbli] = L.layerGroup();
                    }
                    kategoriLayersOKI[feature.properties.kbli].addLayer(marker);
                    OKIMarkers.push(marker)
                }
                else if(feature.properties.kodekab == "16.10") {
                    if (!kategoriLayersOI[feature.properties.kbli]) {
                        kategoriLayersOI[feature.properties.kbli] = L.layerGroup();
                    }
                    kategoriLayersOI[feature.properties.kbli].addLayer(marker);
                    OIMarkers.push(marker)
                }
                else if(feature.properties.kodekab == "16.72") {
                    if (!kategoriLayersPrabumulih[feature.properties.kbli]) {
                        kategoriLayersPrabumulih[feature.properties.kbli] = L.layerGroup();
                    }
                    kategoriLayersPrabumulih[feature.properties.kbli].addLayer(marker);
                    PrabumulihMarkers.push(marker)
                }
                else if(feature.properties.kodekab == "16.71") {
                    if (!kategoriLayersPalembang[feature.properties.kbli]) {
                        kategoriLayersPalembang[feature.properties.kbli] = L.layerGroup();
                    }
                    kategoriLayersPalembang[feature.properties.kbli].addLayer(marker);
                    PalembangMarkers.push(marker)
                }
                allMarkers.push(marker);
            });

            // Process MATCH data
            // var geojsonDataMatch = filterWilayah(matchData, 'kodekab', selectedKab);
            var geojsonDataMatch = matchData;
            geojsonDataMatch.features.forEach(feature => {
                var color = getColorByFlag(feature.properties.Flag);
                var marker = L.marker([feature.geometry.coordinates[1], feature.geometry.coordinates[0]], {
                    icon: createFontAwesomeIcon(color)
                });
                
                // Add data source identifier
                marker.dataSource = 'match';
                
                // Create popup content
                let popupContent = `<div class="popup-header"></div>`;
                if (feature.properties.nama_usaha) {
                    popupContent += `<h4>${feature.properties.nama_usaha}</h4>`;
                }
                if (feature.properties.alamat_usaha) {
                    popupContent += `<p>Alamat: ${feature.properties.alamat_usaha}</p>`;
                }
                if (feature.properties.deskripsi_usaha) {
                    popupContent += `<p>Deskripsi Usaha: ${feature.properties.deskripsi_usaha}</p>`;
                }
                if (feature.properties.kbli_label) {
                    popupContent += `<p>Kategori KBLI: ${feature.properties.kbli_label}</p>`;
                }
                if (feature.properties.kode_kbli_label) {
                    popupContent += `<p>Kode KBLI: ${feature.properties.kode_kbli_label}</p>`;
                }
                if (feature.properties.nama_usaha_gmaps) {
                    popupContent += `<p>Match dengan usaha GMAPS: ${feature.properties.nama_usaha_gmaps}</p>`;
                }
                
                marker.bindPopup(popupContent);

                if (feature.properties.kode_usaha) {
                    markerMapUsaha[feature.properties.kode_usaha] = marker;
                }
                
                // Handle kategori layers
                if (!kategoriLayers[feature.properties.kbli]) {
                    kategoriLayers[feature.properties.kbli] = L.layerGroup();
                }
                kategoriLayers[feature.properties.kbli].addLayer(marker);
                
                if(feature.properties.kodekab == "16.02") {
                    if (!kategoriLayersOKI[feature.properties.kbli]) {
                        kategoriLayersOKI[feature.properties.kbli] = L.layerGroup();
                    }
                    kategoriLayersOKI[feature.properties.kbli].addLayer(marker);
                    OKIMarkers.push(marker)
                }
                else if(feature.properties.kodekab == "16.10") {
                    if (!kategoriLayersOI[feature.properties.kbli]) {
                        kategoriLayersOI[feature.properties.kbli] = L.layerGroup();
                    }
                    kategoriLayersOI[feature.properties.kbli].addLayer(marker);
                    OIMarkers.push(marker)
                }
                else if(feature.properties.kodekab == "16.72") {
                    if (!kategoriLayersPrabumulih[feature.properties.kbli]) {
                        kategoriLayersPrabumulih[feature.properties.kbli] = L.layerGroup();
                    }
                    kategoriLayersPrabumulih[feature.properties.kbli].addLayer(marker);
                    PrabumulihMarkers.push(marker)
                }
                else if(feature.properties.kodekab == "16.71") {
                    if (!kategoriLayersPalembang[feature.properties.kbli]) {
                        kategoriLayersPalembang[feature.properties.kbli] = L.layerGroup();
                    }
                    kategoriLayersPalembang[feature.properties.kbli].addLayer(marker);
                    PalembangMarkers.push(marker)
                }
                allMarkers.push(marker);
                
            });
            
            // Add semua markers ke satu cluster group
            rutaMatchClusterGroup.addLayers(allMarkers);
            allMarkers.forEach(marker => {
                rutaLayerGroup.addLayer(marker);
            });
            rutaMatchClusterPalembang.addLayers(PalembangMarkers);
            rutaMatchClusterPrabumulih.addLayers(PrabumulihMarkers);
            rutaMatchClusterOKI.addLayers(OKIMarkers);
            rutaMatchClusterOI.addLayers(OIMarkers);
            
            // Add cluster group to map
            if(document.getElementById("setting-cluster").checked){
                map.addLayer(rutaMatchClusterPalembang);
                map.addLayer(rutaMatchClusterPrabumulih);
                map.addLayer(rutaMatchClusterOKI);
                map.addLayer(rutaMatchClusterOI);
            } else {
                map.addLayer(rutaMatchClusterGroup);
            }
            
            
            updateLayers();

            let selectElement = document.getElementById('filter_sls');
            if(selectElement.value) {
                let event = new Event('change');
                selectElement.dispatchEvent(event);
            }      


        }
    });

    function getSelectedCategories() {
        return Array.from(document.querySelectorAll('.filter-checkbox:checked')).map(cb => 'total_' + cb.value);
    }

    function getColor(value, max) {
        if (value === 0) return '#fff7ec'; // Warna untuk nol (paling terang)

        const startColor = [255, 247, 236]; // #fff7ec (orange muda terang)
        const endColor = [217, 72, 1];      // #d94801 (orange tua)

        const ratio = Math.min(value / max, 1); // Hindari rasio > 1

        const r = Math.round(startColor[0] + (endColor[0] - startColor[0]) * ratio);
        const g = Math.round(startColor[1] + (endColor[1] - startColor[1]) * ratio);
        const b = Math.round(startColor[2] + (endColor[2] - startColor[2]) * ratio);

        return `rgb(${r},${g},${b})`;
    }



    function getCombinedValue(props, selectedKeys) {
        return selectedKeys.reduce((sum, key) => sum + (props[key] || 0), 0);
    }

    function getMaxCombined(data, selectedKeys) {
        // return 3943;
        return Math.max(...data.features.map(f => getCombinedValue(f.properties, selectedKeys)));
    }

    function styleFeature(feature, selectedKeys, max) {
        const value = getCombinedValue(feature.properties, selectedKeys);
        return {
        fillColor: getColor(value, max),
        weight: 1,
        color: 'white',
        dashArray: '2',
        fillOpacity: 0.7
        };
    }

    function renderMap(data) {
        if (geojson) {
            map.removeLayer(geojson);
        }
        const selectedKeys = getSelectedCategories();
        const maxVal = getMaxCombined(data, selectedKeys);

        geojson = L.geoJSON(kabData, {
        style: feature => styleFeature(feature, selectedKeys, maxVal),
        onEachFeature: function (feature, layer) {
            const value = getCombinedValue(feature.properties, selectedKeys);
            layer.bindPopup(`${feature.properties.nama_wilayah}<br/>Total Usaha: ${value}`);
        }
        }).addTo(map);
    }

    // Event listener saat checkbox berubah
    // document.querySelectorAll('.filter-checkbox').forEach(cb => {
    //     cb.addEventListener('change', () => {
    //     renderMap(kabData);
    //     });
    // });

    function updateKategori() {
        if(jenis_peta == "usaha") {
            updateLayersUsaha();
        } else if (jenis_peta == "ruta") {
            updateLayers();
        }
        const checkboxes = document.querySelectorAll('.filter-checkbox');
        const selectedValue = document.getElementById('selected-value');
        const checked = Array.from(checkboxes).filter(c => c.checked);
        if (checked.length === checkboxes.length) {
            selectedValue.textContent = '- ALL -';
        } else if (checked.length === 0) {
            selectedValue.textContent = 'Pilih Kategori';
        } else {
            selectedValue.textContent = checked.map(c => c.value).join(', ');
        }
    }

    function updateLayers() {
        // Clear dan rebuild cluster berdasarkan checkbox yang dipilih
        rutaMatchClusterGroup.clearLayers();
        rutaMatchClusterPalembang.clearLayers();
        rutaMatchClusterPrabumulih.clearLayers();
        rutaMatchClusterOKI.clearLayers();
        rutaMatchClusterOI.clearLayers();
        
        
        var selectedPalembangMarkers = [];
        var selectedPrabumulihMarkers = [];
        var selectedOKIMarkers = [];
        var selectedOIMarkers = [];
        var selectedMarkers = [];
        document.querySelectorAll(".filter-checkbox").forEach(checkbox => {
            if (checkbox.checked) {
                // Ambil semua marker dari kategori yang dipilih
                // kategoriLayers[checkbox.value].eachLayer(function(layer) {
                //     selectedMarkers.push(layer);
                // });
                if(kategoriLayers[checkbox.value]) {
                    kategoriLayers[checkbox.value].eachLayer(function(layer) {
                        selectedMarkers.push(layer);
                    });
                }
                if(kategoriLayersPalembang[checkbox.value]) {
                    kategoriLayersPalembang[checkbox.value].eachLayer(function(layer) {
                        selectedPalembangMarkers.push(layer);
                    });
                }
                if(kategoriLayersPrabumulih[checkbox.value]) {
                     kategoriLayersPrabumulih[checkbox.value].eachLayer(function(layer) {
                        selectedPrabumulihMarkers.push(layer);
                    });
                }
                if(kategoriLayersOKI[checkbox.value]) {  
                    kategoriLayersOKI[checkbox.value].eachLayer(function(layer) {
                        selectedOKIMarkers.push(layer);
                    });
                }
                if(kategoriLayersOI[checkbox.value]) {    
                    kategoriLayersOI[checkbox.value].eachLayer(function(layer) {
                        selectedOIMarkers.push(layer);
                    });
                }
               
            }
        });
        
        // Tambahkan marker yang dipilih ke cluster group
        if (selectedMarkers.length > 0) {
            rutaMatchClusterGroup.addLayers(selectedMarkers);
        }
        if (selectedPalembangMarkers.length > 0) {
            rutaMatchClusterPalembang.addLayers(selectedPalembangMarkers);
            // rutaMatchClusterGroup.addLayers(selectedMarkers);
        }
        if (selectedPrabumulihMarkers.length > 0) {
            rutaMatchClusterPrabumulih.addLayers(selectedPrabumulihMarkers);
            // rutaMatchClusterGroup.addLayers(selectedMarkers);
        }
        if (selectedOKIMarkers.length > 0) {
            rutaMatchClusterOKI.addLayers(selectedOKIMarkers);
            // rutaMatchClusterGroup.addLayers(selectedMarkers);
        }
        if (selectedOIMarkers.length > 0) {
            rutaMatchClusterOI.addLayers(selectedOIMarkers);
            // rutaMatchClusterGroup.addLayers(selectedMarkers);
        }
    }

    function updateLayersUsaha() {
        // Clear dan rebuild cluster berdasarkan checkbox yang dipilih
        usahaMatchClusterGroup.clearLayers();
        usahaMatchClusterPalembang.clearLayers();
        usahaMatchClusterPrabumulih.clearLayers();
        usahaMatchClusterOKI.clearLayers();
        usahaMatchClusterOI.clearLayers();
        
        
        var selectedPalembangMarkers = [];
        var selectedPrabumulihMarkers = [];
        var selectedOKIMarkers = [];
        var selectedOIMarkers = [];
        var selectedMarkers = [];
        document.querySelectorAll(".filter-checkbox").forEach(checkbox => {
            if (checkbox.checked) {
                // Ambil semua marker dari kategori yang dipilih
                // kategoriLayers[checkbox.value].eachLayer(function(layer) {
                //     selectedMarkers.push(layer);
                // });
                if(kategoriLayersUsaha[checkbox.value]) {
                    kategoriLayersUsaha[checkbox.value].eachLayer(function(layer) {
                        selectedMarkers.push(layer);
                    });
                }
                if(kategoriLayersPalembangUsaha[checkbox.value]) {
                    kategoriLayersPalembangUsaha[checkbox.value].eachLayer(function(layer) {
                        selectedPalembangMarkers.push(layer);
                    });
                }
                if(kategoriLayersPrabumulihUsaha[checkbox.value]) {
                     kategoriLayersPrabumulihUsaha[checkbox.value].eachLayer(function(layer) {
                        selectedPrabumulihMarkers.push(layer);
                    });
                }
                if(kategoriLayersOKIUsaha[checkbox.value]) {  
                    kategoriLayersOKIUsaha[checkbox.value].eachLayer(function(layer) {
                        selectedOKIMarkers.push(layer);
                    });
                }
                if(kategoriLayersOIUsaha[checkbox.value]) {    
                    kategoriLayersOIUsaha[checkbox.value].eachLayer(function(layer) {
                        selectedOIMarkers.push(layer);
                    });
                }
               
            }
        });

        if (selectedMarkers.length > 0) {
            usahaMatchClusterGroup.addLayers(selectedMarkers);
        }
        
        // Tambahkan marker yang dipilih ke cluster group
        if (selectedPalembangMarkers.length > 0) {
            usahaMatchClusterPalembang.addLayers(selectedPalembangMarkers);
            // usahaClusterGroup.addLayers(selectedMarkers);
        }
        if (selectedPrabumulihMarkers.length > 0) {
            usahaMatchClusterPrabumulih.addLayers(selectedPrabumulihMarkers);
            // usahaClusterGroup.addLayers(selectedMarkers);
        }
        if (selectedOKIMarkers.length > 0) {
            usahaMatchClusterOKI.addLayers(selectedOKIMarkers);
            // usahaClusterGroup.addLayers(selectedMarkers);
        }
        if (selectedOIMarkers.length > 0) {
            usahaMatchClusterOI.addLayers(selectedOIMarkers);
            // usahaClusterGroup.addLayers(selectedMarkers);
        }
    }

    // function updateLayers() {
    //     rutaLayerGroup.clearLayers();
    //     document.querySelectorAll(".filter-checkbox").forEach(checkbox => {
    //         if (checkbox.checked && kategoriLayers[checkbox.value]) {
    //             rutaLayerGroup.addLayer(kategoriLayers[checkbox.value]);
    //         }
    //     });
    // }

    // Tambahkan event listener ke semua checkbox
    document.querySelectorAll(".filter-checkbox").forEach(checkbox => {
        checkbox.addEventListener("change", updateKategori);
    });

    const warningPopup = document.getElementById('warning-popup');
    const cancelWarning = document.getElementById('cancel-warning');
    const goWarning = document.getElementById('go-warning');
    cancelWarning.addEventListener('click', function() {
        warningPopup.classList.add('hidden');
        document.getElementById("setting-markers").checked = false;
    });
    goWarning.addEventListener('click', async function() {
        warningPopup.classList.add('hidden');
        if (map.hasLayer(rutaMatchClusterGroup)) {
            map.removeLayer(rutaMatchClusterGroup);
        }
        if (map.hasLayer(rutaMatchClusterPalembang)) {
            map.removeLayer(rutaMatchClusterPalembang);
        }
        if (map.hasLayer(rutaMatchClusterPrabumulih)) {
            map.removeLayer(rutaMatchClusterPrabumulih);
        }
        if (map.hasLayer(rutaMatchClusterOKI)) {
            map.removeLayer(rutaMatchClusterOKI);
        }
        if (map.hasLayer(rutaMatchClusterOI)) {
            map.removeLayer(rutaMatchClusterOI);
        }
        if (map.hasLayer(usahaMatchClusterGroup)) {
            map.removeLayer(usahaMatchClusterGroup);
        }
        if (map.hasLayer(usahaMatchClusterPalembang)) {
            map.removeLayer(usahaMatchClusterPalembang);
        }
        if (map.hasLayer(usahaMatchClusterPrabumulih)) {
            map.removeLayer(usahaMatchClusterPrabumulih);
        }
        if (map.hasLayer(usahaMatchClusterOKI)) {
            map.removeLayer(usahaMatchClusterOKI);
        }
        if (map.hasLayer(usahaMatchClusterOI)) {
            map.removeLayer(usahaMatchClusterOI);
        }
        if(document.getElementById("filter_jenis_peta").value == "usaha") {
        loadingBar = showLoading('set-markers');
        await new Promise(resolve => setTimeout(resolve, 100));
        map.addLayer(titikLayerGroup);
        hideLoading(loadingBar);
        }
        else if(document.getElementById("filter_jenis_peta").value == "ruta") {
        loadingBar = showLoading('set-markers');
        await new Promise(resolve => setTimeout(resolve, 100));
        map.addLayer(rutaLayerGroup);
        hideLoading(loadingBar);
        }
    });
    
    document.getElementById("setting-markers").addEventListener("change", async function () {
        if (this.checked) {
            warningPopup.classList.remove('hidden');
        } else {
            if (map.hasLayer(titikLayerGroup)) {
                map.removeLayer(titikLayerGroup);
            }
            if (map.hasLayer(rutaLayerGroup)) {
                map.removeLayer(rutaLayerGroup);
            }
            if(document.getElementById("filter_jenis_peta").value == "usaha") {
                if(document.getElementById("setting-cluster").checked){
                    map.addLayer(usahaMatchClusterPalembang);
                    map.addLayer(usahaMatchClusterPrabumulih);
                    map.addLayer(usahaMatchClusterOKI);
                    map.addLayer(usahaMatchClusterOI);
                } else {
                    map.addLayer(usahaMatchClusterGroup);
                }
            }
            else if(document.getElementById("filter_jenis_peta").value == "ruta") {
                if(document.getElementById("setting-cluster").checked){
                    map.addLayer(rutaMatchClusterPalembang);
                    map.addLayer(rutaMatchClusterPrabumulih);
                    map.addLayer(rutaMatchClusterOKI);
                    map.addLayer(rutaMatchClusterOI);
                } else {
                    map.addLayer(rutaMatchClusterGroup);
                }
            }
        }
    });

    document.getElementById("setting-cluster").addEventListener("change", async function () {
        if (this.checked) {
            if (!lokusData) {
                loadingBar = showLoading('set-lokus');
                try {
                    lokusData = await loadGeoJSON('lokus');
                } finally {
                    hideLoading(loadingBar);
                }
            }
            if (map.hasLayer(rutaMatchClusterGroup)) {
                map.removeLayer(rutaMatchClusterGroup);
            }
            if (map.hasLayer(rutaMatchClusterPalembang)) {
                map.removeLayer(rutaMatchClusterPalembang);
            }
            if (map.hasLayer(rutaMatchClusterPrabumulih)) {
                map.removeLayer(rutaMatchClusterPrabumulih);
            }
            if (map.hasLayer(rutaMatchClusterOKI)) {
                map.removeLayer(rutaMatchClusterOKI);
            }
            if (map.hasLayer(rutaMatchClusterOI)) {
                map.removeLayer(rutaMatchClusterOI);
            }
            if (map.hasLayer(usahaMatchClusterGroup)) {
                map.removeLayer(usahaMatchClusterGroup);
            }
            if (map.hasLayer(usahaMatchClusterPalembang)) {
                map.removeLayer(usahaMatchClusterPalembang);
            }
            if (map.hasLayer(usahaMatchClusterPrabumulih)) {
                map.removeLayer(usahaMatchClusterPrabumulih);
            }
            if (map.hasLayer(usahaMatchClusterOKI)) {
                map.removeLayer(usahaMatchClusterOKI);
            }
            if (map.hasLayer(usahaMatchClusterOI)) {
                map.removeLayer(usahaMatchClusterOI);
            }
            if (map.hasLayer(titikLayerGroup)) {
                map.removeLayer(titikLayerGroup);
            }
            if (map.hasLayer(rutaLayerGroup)) {
                map.removeLayer(rutaLayerGroup);
            }
           if(document.getElementById("filter_jenis_peta").value == "usaha") {
            loadingBar = showLoading('set-cluster');
            await new Promise(resolve => setTimeout(resolve, 100));
            map.addLayer(usahaMatchClusterPalembang);
            map.addLayer(usahaMatchClusterPrabumulih);
            map.addLayer(usahaMatchClusterOKI);
            map.addLayer(usahaMatchClusterOI);
            hideLoading(loadingBar);
           }
           else if(document.getElementById("filter_jenis_peta").value == "ruta") {
            loadingBar = showLoading('set-cluster');
            await new Promise(resolve => setTimeout(resolve, 100));
            map.addLayer(rutaMatchClusterPalembang);
            map.addLayer(rutaMatchClusterPrabumulih);
            map.addLayer(rutaMatchClusterOKI);
            map.addLayer(rutaMatchClusterOI);
            hideLoading(loadingBar);
           }
        } else {
           if (map.hasLayer(rutaMatchClusterGroup)) {
                map.removeLayer(rutaMatchClusterGroup);
            }
            if (map.hasLayer(rutaMatchClusterPalembang)) {
                map.removeLayer(rutaMatchClusterPalembang);
            }
            if (map.hasLayer(rutaMatchClusterPrabumulih)) {
                map.removeLayer(rutaMatchClusterPrabumulih);
            }
            if (map.hasLayer(rutaMatchClusterOKI)) {
                map.removeLayer(rutaMatchClusterOKI);
            }
            if (map.hasLayer(rutaMatchClusterOI)) {
                map.removeLayer(rutaMatchClusterOI);
            }
            if (map.hasLayer(usahaMatchClusterGroup)) {
                map.removeLayer(usahaMatchClusterGroup);
            }
            if (map.hasLayer(usahaMatchClusterPalembang)) {
                map.removeLayer(usahaMatchClusterPalembang);
            }
            if (map.hasLayer(usahaMatchClusterPrabumulih)) {
                map.removeLayer(usahaMatchClusterPrabumulih);
            }
            if (map.hasLayer(usahaMatchClusterOKI)) {
                map.removeLayer(usahaMatchClusterOKI);
            }
            if (map.hasLayer(usahaMatchClusterOI)) {
                map.removeLayer(usahaMatchClusterOI);
            }
            if (map.hasLayer(titikLayerGroup)) {
                map.removeLayer(titikLayerGroup);
            }
            if (map.hasLayer(rutaLayerGroup)) {
                map.removeLayer(rutaLayerGroup);
            }
           if(document.getElementById("filter_jenis_peta").value == "usaha") {
            loadingBar = showLoading('set-cluster');
            await new Promise(resolve => setTimeout(resolve, 100));
            map.addLayer(usahaMatchClusterGroup);
            hideLoading(loadingBar);
           }
           else if(document.getElementById("filter_jenis_peta").value == "ruta") {
            loadingBar = showLoading('set-cluster');
            await new Promise(resolve => setTimeout(resolve, 100));
            map.addLayer(rutaMatchClusterGroup);
            hideLoading(loadingBar);
           }
            
        }
    });

    document.getElementById("setting-lokus").addEventListener("change", async function () {
        if (this.checked) {
            if (!lokusData) {
                loadingBar = showLoading('set-lokus');
                try {
                    lokusData = await loadGeoJSON('lokus');
                } finally {
                    hideLoading(loadingBar);
                }
            }
            layerLokus = L.geoJson(lokusData, {
                style: styleLokus,
                onEachFeature: onEachFeatureLokus
            }).addTo(map)
        } else {
            map.removeLayer(layerLokus);
        }
    });

    // document.getElementById('select-all').addEventListener('click', function () {
    //     document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
    //         checkbox.checked = true;
    //         checkbox.dispatchEvent(new Event('change')); // Trigger onchange
    //     });
    // });

    // document.getElementById('deselect-all').addEventListener('click', function () {
    //     document.querySelectorAll('.filter-checkbox').forEach(checkbox => {
    //         checkbox.checked = false;
    //         checkbox.dispatchEvent(new Event('change')); // Trigger onchange
    //     });
    // });
    document.getElementById('select-all').addEventListener('click', function () {
        document.querySelectorAll('.filter-checkbox').forEach(checkbox => checkbox.checked = true);
        updateKategori();
    });

    document.getElementById('deselect-all').addEventListener('click', function () {
        document.querySelectorAll('.filter-checkbox').forEach(checkbox => checkbox.checked = false);
        updateKategori();
    });

    var titikLayer = [];
    document.getElementById('filter_blok_sensus').addEventListener('change', async function(e) {
        const selectedBs = e.target.value;
        document.getElementById('list_usaha').innerHTML = '';

        if (selectedBs) {
            
            let loadingBar;
            if (selectedSls && !titikDataUsaha) {
                loadingBar = showLoading('filter_sls');
                try {
                    titikDataUsaha = await loadGeoJSON('usaha');
                } finally {
                    hideLoading(loadingBar);
                }
            }

            if (!rutaData || !matchData) {
                loadingBar = showLoading('filter_jenis_peta');
                try {
                    rutaData = await loadGeoJSON('pencacahan');
                    matchData = await loadGeoJSON('matching');
                } finally {
                    hideLoading(loadingBar);
                }
            }
            var geojsonDataUsaha = filterWilayah(titikDataUsaha, 'idsls', selectedSls);
            var geojsonDataRuta = filterWilayah(rutaData, 'idsls', selectedSls);
            var geojsonDataMatch = filterWilayah(matchData, 'idsls', selectedSls);
            var geojsonDataBs = filterWilayah(bsData, 'kodebs', selectedBs);
            if (layerBs) {
                map.removeLayer(layerBs);
            }
            layerBs = L.geoJson(geojsonDataBs, {
                style: styleSls,
                onEachFeature: onEachFeatureBs
            }).addTo(map)
            wilayahTerkecilGroup.addLayer(layerBs);

            if (layerBs.getBounds().isValid()) {
                map.fitBounds(layerBs.getBounds());
            }
            

            // Layer GeoJSON Titik
            // var titik = L.geoJson(geojsonData, {
            //     onEachFeature: function(feature, layer) {
            //         layer.bindPopup(`
            //             <h4>${feature.properties.nama_usaha}</h4>
            //             <p>Alamat: ${feature.properties.alamat_usaha}</p>
            //         `);
            //     }
            // }).addTo(titikGroup); // Tambahkan ke grup

            // Layer GeoJSON Pencacahan
            // var ruta = L.geoJson(geojsonDataRuta, {
            //     onEachFeature: function(feature, layer) {
            //         layer.bindPopup(`
            //             <h4>${feature.properties.nama_usaha}</h4>
            //             <p>Alamat: ${feature.properties.alamat_usaha}</p>
            //             <p>Deskripsi Usaha: ${feature.properties.deskripsi_usaha}</p>
            //             <p>Kategori KBLI: ${feature.properties.kbli_label}</p>
            //             <p>Kode KBLI: ${feature.properties.kode_kbli_label}</p>
            //         `);
            //         if (!kategoriLayers[feature.properties.kbli]) {
            //             kategoriLayers[feature.properties.kbli] = L.layerGroup();
            //         }
            //         kategoriLayers[feature.properties.kbli].addLayer(layer);
            //     }
            // }); // Tambahkan ke grup
            // // }).addTo(rutaGroup); // Tambahkan ke grup

            // Tambahkan salah satu grup sebagai default (misalnya titikGroup)
            // titikGroup.addTo(map);
            

            if(jenis_peta == 'usaha') {
                // titikGroup.addTo(map);
                if (geojsonDataUsaha.features.length > 0) {
                    geojsonDataUsaha.features
                        .sort((a, b) => a.properties.nama_usaha.localeCompare(b.properties.nama_usaha))
                        .forEach(feature => {
                            const listItem = document.createElement('li');
                            listItem.className = 'flex items-center space-x-2 cursor-pointer';
    
                            const icon = document.createElement('i');
                            icon.className = 'fas fa-building text-[#F18317]';
    
                            const text = document.createElement('span');
                            text.textContent = feature.properties.nama_usaha;
    
                            listItem.appendChild(icon);
                            listItem.appendChild(text);
    
                            listItem.addEventListener('click', () => {
                                const marker = markerMapUsaha[feature.properties.kode_usaha];
                                if (marker) {
                                    // map.setView(marker.getLatLng(), 15); // zoom ke marker
                                    marker.openPopup(); // buka popup
                                }
                            });
    
                            document.getElementById('list_usaha').appendChild(listItem);
                        });
                    }
                    else {
                        const listKosong = document.createElement('li');
                        listKosong.className = 'flex items-center space-x-2';
                        const text = document.createElement('span');
                        text.textContent = "Tidak ditemukan data usaha di wilayah ini";
                        text.style = 'color: red';

                        listKosong.appendChild(text);
                        document.getElementById('list_usaha').appendChild(listKosong);
                    }
                }
            if (jenis_peta == 'ruta') {
                const listingFeatures = [
                    ...(geojsonDataRuta.features || []),
                    ...(geojsonDataMatch.features || [])
                ].filter(feature => feature.properties.kode_kbli);
                
                // titikGroup.addTo(map);
                if (listingFeatures.length > 0) {
                    listingFeatures
                        .sort((a, b) => a.properties.nama_usaha.localeCompare(b.properties.nama_usaha))
                        .forEach(feature => {
                            const listItem = document.createElement('li');
                            listItem.className = 'flex items-center space-x-2 cursor-pointer';
    
                            const icon = document.createElement('i');
                            icon.className = 'fas fa-building text-[#F18317]';
    
                            const text = document.createElement('span');
                            text.textContent = feature.properties.nama_usaha;

                            if(feature.properties.kode_kbli) {
                                listItem.appendChild(icon);
                                listItem.appendChild(text);
        
                                listItem.addEventListener('click', () => {
                                    const marker = markerMapUsaha[feature.properties.kode_usaha];
                                    if (marker) {
                                        // map.setView(marker.getLatLng(), 15); // zoom ke marker
                                        marker.openPopup(); // buka popup
                                    }
                                    // console.log(feature.properties.kode_usaha)
                                });
        
                                document.getElementById('list_usaha').appendChild(listItem);
                            }
                        });
                    }
                else {
                    const listKosong = document.createElement('li');
                    listKosong.className = 'flex items-center space-x-2';
                    const text = document.createElement('span');
                    text.textContent = "Tidak ditemukan data usaha di wilayah ini";
                    text.style = 'color: red';

                    listKosong.appendChild(text);
                    document.getElementById('list_usaha').appendChild(listKosong);
                }
            }

        } else {
            map.fitBounds(layerKel.getBounds());
        }
    });

    document.getElementById('filter_sls').addEventListener('change', async function(e) {
        const selectedSls = e.target.value;
        document.getElementById('list_usaha').innerHTML = '';
        // listUsaha.innerHTML = '<div class="loading">Loading data...</div>';

        if (selectedSls) {
                
                let loadingBar;
                if (selectedSls && !titikDataUsaha) {
                    loadingBar = showLoading('filter_sls');
                    try {
                        titikDataUsaha = await loadGeoJSON('usaha');
                    } finally {
                        hideLoading(loadingBar);
                    }
                }

                if (!rutaData || !matchData) {
                    loadingBar = showLoading('filter_jenis_peta');
                    try {
                        rutaData = await loadGeoJSON('pencacahan');
                        matchData = await loadGeoJSON('matching');
                    } finally {
                        hideLoading(loadingBar);
                    }
                }
                var geojsonDataUsaha = filterWilayah(titikDataUsaha, 'idsls', selectedSls);
                var geojsonDataRuta = filterWilayah(rutaData, 'idsls', selectedSls);
                var geojsonDataMatch = filterWilayah(matchData, 'idsls', selectedSls);
                var geojsonDataSls = filterWilayah(slsData, 'idsls', selectedSls);
                if (layerSls) {
                    map.removeLayer(layerSls);
                }
                layerSls = L.geoJson(geojsonDataSls, {
                    style: styleSls,
                    onEachFeature: onEachFeatureSls
                }).addTo(map)
                wilayahTerkecilGroup.addLayer(layerSls);
    
                if (layerSls.getBounds().isValid()) {
                    map.fitBounds(layerSls.getBounds());
                }
    
                // Layer GeoJSON Titik
                // var titik = L.geoJson(geojsonDataUsaha, {
                //     onEachFeature: function(feature, layer) {
                //         layer.bindPopup(`
                //             <h4>${feature.properties.nama_usaha}</h4>
                //             <p>Alamat: ${feature.properties.alamat_usaha}</p>
                //         `);
                //     }
                // }).addTo(titikGroup); // Tambahkan ke grup
    
                // // Layer GeoJSON ruta
                // var ruta = L.geoJson(geojsonDataUsahaRuta, {
                //     onEachFeature: function(feature, layer) {
                //         layer.bindPopup(`
                //             <h4>${feature.properties.nama_usaha}</h4>
                //             <p>Alamat: ${feature.properties.alamat_usaha}</p>
                //             <p>Deskripsi Usaha: ${feature.properties.deskripsi_usaha}</p>
                //             <p>Kategori KBLI: ${feature.properties.kbli_label}</p>
                //             <p>Kode KBLI: ${feature.properties.kode_kbli_label}</p>
                //         `);
                //         if (!kategoriLayers[feature.properties.kbli]) {
                //             kategoriLayers[feature.properties.kbli] = L.layerGroup();
                //         }
                //         kategoriLayers[feature.properties.kbli].addLayer(layer);
                //     }
                // }); // Tambahkan ke grup
                // // }).addTo(rutaGroup); // Tambahkan ke grup
    
                // Tambahkan salah satu grup sebagai default (misalnya titikGroup)
                if(jenis_peta == 'usaha') {
                    // titikGroup.addTo(map);
                    if (geojsonDataUsaha.features.length > 0) {
                        geojsonDataUsaha.features
                            .sort((a, b) => a.properties.nama_usaha.localeCompare(b.properties.nama_usaha))
                            .forEach(feature => {
                                const listItem = document.createElement('li');
                                listItem.className = 'flex items-center space-x-2 cursor-pointer';
        
                                const icon = document.createElement('i');
                                icon.className = 'fas fa-building text-[#F18317]';
        
                                const text = document.createElement('span');
                                text.textContent = feature.properties.nama_usaha;
        
                                listItem.appendChild(icon);
                                listItem.appendChild(text);
        
                                listItem.addEventListener('click', () => {
                                    const marker = markerMapUsaha[feature.properties.kode_usaha];
                                    if (marker) {
                                        // map.setView(marker.getLatLng(), 15); // zoom ke marker
                                        marker.openPopup(); // buka popup
                                    }
                                });
        
                                document.getElementById('list_usaha').appendChild(listItem);
                            });
                        }
                        else {
                            const listKosong = document.createElement('li');
                            listKosong.className = 'flex items-center space-x-2';
                            const text = document.createElement('span');
                            text.textContent = "Tidak ditemukan data usaha di wilayah ini";
                            text.style = 'color: red';
    
                            listKosong.appendChild(text);
                            document.getElementById('list_usaha').appendChild(listKosong);
                        }
                    }
                if (jenis_peta == 'ruta') {
                    const listingFeatures = [
                        ...(geojsonDataRuta.features || []),
                        ...(geojsonDataMatch.features || [])
                    ].filter(feature => feature.properties.kode_kbli);
                    
                    // titikGroup.addTo(map);
                    if (listingFeatures.length > 0) {
                        listingFeatures
                            .sort((a, b) => a.properties.nama_usaha.localeCompare(b.properties.nama_usaha))
                            .forEach(feature => {
                                const listItem = document.createElement('li');
                                listItem.className = 'flex items-center space-x-2 cursor-pointer';
        
                                const icon = document.createElement('i');
                                icon.className = 'fas fa-building text-[#F18317]';
        
                                const text = document.createElement('span');
                                text.textContent = feature.properties.nama_usaha;

                                if(feature.properties.kode_kbli) {
                                    listItem.appendChild(icon);
                                    listItem.appendChild(text);
            
                                    listItem.addEventListener('click', () => {
                                        const marker = markerMapUsaha[feature.properties.kode_usaha];
                                        if (marker) {
                                            // map.setView(marker.getLatLng(), 15); // zoom ke marker
                                            marker.openPopup(); // buka popup
                                        }
                                        // console.log(feature.properties.kode_usaha)
                                    });
            
                                    document.getElementById('list_usaha').appendChild(listItem);
                                }
                            });
                        }
                    else {
                        const listKosong = document.createElement('li');
                        listKosong.className = 'flex items-center space-x-2';
                        const text = document.createElement('span');
                        text.textContent = "Tidak ditemukan data usaha di wilayah ini";
                        text.style = 'color: red';
    
                        listKosong.appendChild(text);
                        document.getElementById('list_usaha').appendChild(listKosong);
                    }
                    // if (geojsonDataRuta.features.length > 0) {
                    //     geojsonDataRuta.features
                    //         .sort((a, b) => a.properties.nama_usaha.localeCompare(b.properties.nama_usaha))
                    //         .forEach(feature => {
                    //             const listItem = document.createElement('li');
                    //             listItem.className = 'flex items-center space-x-2 cursor-pointer';
        
                    //             const icon = document.createElement('i');
                    //             icon.className = 'fas fa-building text-[#F18317]';
        
                    //             const text = document.createElement('span');
                    //             text.textContent = feature.properties.nama_usaha;

                    //             if(feature.properties.kode_kbli) {
                    //                 listItem.appendChild(icon);
                    //                 listItem.appendChild(text);
            
                    //                 listItem.addEventListener('click', () => {
                    //                     const marker = markerMapUsaha[feature.properties.kode_usaha];
                    //                     if (marker) {
                    //                         // map.setView(marker.getLatLng(), 15); // zoom ke marker
                    //                         marker.openPopup(); // buka popup
                    //                     }
                    //                     // console.log(feature.properties.kode_usaha)
                    //                 });
            
                    //                 document.getElementById('list_usaha').appendChild(listItem);
                    //             }
                    //         });
                    //     }
                    // else {
                    //     const listKosong = document.createElement('li');
                    //     listKosong.className = 'flex items-center space-x-2';
                    //     const text = document.createElement('span');
                    //     text.textContent = "Tidak ditemukan data usaha di wilayah ini";
                    //     text.style = 'color: red';
    
                    //     listKosong.appendChild(text);
                    //     document.getElementById('list_usaha').appendChild(listKosong);
                    // }
                    // if (geojsonDataMatch.features.length > 0) {
                    //     geojsonDataMatch.features
                    //         .sort((a, b) => a.properties.nama_usaha.localeCompare(b.properties.nama_usaha))
                    //         .forEach(feature => {
                    //             const listItem = document.createElement('li');
                    //             listItem.className = 'flex items-center space-x-2 cursor-pointer';
        
                    //             const icon = document.createElement('i');
                    //             icon.className = 'fas fa-building text-[#F18317]';
        
                    //             const text = document.createElement('span');
                    //             text.textContent = feature.properties.nama_usaha;

                    //             if(feature.properties.kode_kbli) {
                    //                 listItem.appendChild(icon);
                    //                 listItem.appendChild(text);
            
                    //                 listItem.addEventListener('click', () => {
                    //                     const marker = markerMapUsaha[feature.properties.kode_usaha];
                    //                     if (marker) {
                    //                         // map.setView(marker.getLatLng(), 15); // zoom ke marker
                    //                         marker.openPopup(); // buka popup
                    //                     }
                    //                     // console.log(feature.properties.kode_usaha)
                    //                 });
            
                    //                 document.getElementById('list_usaha').appendChild(listItem);
                    //             }
                    //         });
                    //     }
                    // else {
                    //     const listKosong = document.createElement('li');
                    //     listKosong.className = 'flex items-center space-x-2';
                    //     const text = document.createElement('span');
                    //     text.textContent = "Tidak ditemukan data usaha di wilayah ini";
                    //     text.style = 'color: red';
    
                    //     listKosong.appendChild(text);
                    //     document.getElementById('list_usaha').appendChild(listKosong);
                    // }
                }
            

        } else {
            map.fitBounds(layerKel.getBounds());
        }
    });

    function resetFilter() {
        document.getElementById('select-all').dispatchEvent(new Event('click'));
        document.getElementById('filter_kabupaten_kota').value = '';
        document.getElementById('filter_kecamatan').innerHTML = '<option value="">- All -</option>';
        document.getElementById('filter_kelurahan').innerHTML = '<option value="">- All -</option>';
        document.getElementById('filter_blok_sensus').innerHTML = '<option value="">- All -</option>';
        document.getElementById('filter_sls').innerHTML = '<option value="">- All -</option>';
        document.getElementById('list_usaha').innerHTML = '';
        map.setView([-3.4, 105.1], 9);
    }

    var mapControl = L.control({
        position: 'bottomleft'
    });

    mapControl.onAdd = function() {
        var div = L.DomUtil.create('div', 'leaflet-bar');
        div.innerHTML = `
            <button id="slsButton" class="bttn primary">Sls</button>
            <button id="bsButton" class="bttn">Blok Sensus</button>
        `;
        return div;
    };

    mapControl.addTo(map);

    document.getElementById('slsButton').addEventListener('click', function() {
        if(jenis_peta=="usaha") {

            if (wilayah_terkecil != "sls") {
                document.getElementById('filter-sls').style.display = 'block';
                document.getElementById('filter-blok-sensus').style.display = 'none';
                if (document.getElementById('filter_blok_sensus').value) {
                    document.getElementById('filter_blok_sensus').value = '';
                    document.getElementById('filter_blok_sensus').dispatchEvent(new Event('change'));
                }
                removeWilayahTerkecilLayers();
                wilayah_terkecil = "sls";
                if (document.getElementById('filter_kelurahan').value) {
                    document.getElementById('filter_kelurahan').dispatchEvent(new Event('change'));
                }                
                setActiveButton(this);
            }
        }
    });

    document.getElementById('bsButton').addEventListener('click', function() {
        if(jenis_peta == "usaha") {

            if (wilayah_terkecil != "bs") {
                document.getElementById('filter-blok-sensus').style.display = 'block';
                document.getElementById('filter-sls').style.display = 'none';
                if (document.getElementById('filter_sls').value) {
                    document.getElementById('filter_sls').value = '';
                    document.getElementById('filter_sls').dispatchEvent(new Event('change'));
                }
                removeWilayahTerkecilLayers();
                wilayah_terkecil = "bs";
                if (document.getElementById('filter_kelurahan').value) {
                    document.getElementById('filter_kelurahan').dispatchEvent(new Event('change'));
                }
                setActiveButton(this);
            }
        }
    });

    function setActiveButton(button) {
        const buttons = document.querySelectorAll('#slsButton, #bsButton');
        buttons.forEach(btn => btn.classList.remove('primary'));

        button.classList.add('primary');
    }

    function removeWilayahTerkecilLayers() {
        // wilayahTerkecilGroup.removeLayer(geojson);
        // wilayahTerkecilGroup.removeLayer(titik);
        wilayahTerkecilGroup.eachLayer(function(layer) {
            // Hapus semua layer GeoJSON
            if (layer instanceof L.GeoJSON) {
                wilayahTerkecilGroup.removeLayer(layer);
            }
            // Hapus semua marker (titik)
            if (layer instanceof L.Marker) {
                wilayahTerkecilGroup.removeLayer(layer);
            }
        });
    }
    async function loadGeoJSON(type) {
        try {
            const response = await fetch(`/js/geojson_${type}.js`);
            const text = await response.text(); // Read response as text

            // Assuming the data is wrapped in "var kabDat = ...;"
            const jsonStart = text.indexOf('{'); // Find the start of the JSON object
            const jsonEnd = text.lastIndexOf('}') + 1; // Find the end of the JSON object
            const jsonString = text.slice(jsonStart, jsonEnd); // Extract the JSON part

            const geoJSONData = JSON.parse(jsonString); // Parse the extracted JSON

            return geoJSONData;
        } catch (error) {
            console.error(`Error loading ${type} data:`, error);
            return null;
        }
    }

    const loadingBarStyles = document.createElement('style');
        loadingBarStyles.textContent = `
        .geo-loading-bar {
            width: 100%;
            height: 4px;
            background: #f0f0f0;
            margin: 8px 0;
            border-radius: 2px;
            overflow: hidden;
        }
        .geo-loading-progress {
            width: 30%;
            height: 100%;
            background: #2196F3;
            animation: geoLoading 1s infinite linear;
            border-radius: 2px;
        }
        @keyframes geoLoading {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(400%); }
        }
    `;
    document.head.appendChild(loadingBarStyles);

    // Reusable loading functions
    function createLoadingBar() {
        const loadingBar = document.createElement('div');
        loadingBar.className = 'geo-loading-bar';
        loadingBar.innerHTML = '<div class="geo-loading-progress"></div>';
        return loadingBar;
    }

    function showLoading(elementId) {
        const element = document.getElementById(elementId);
        const loadingBar = createLoadingBar();
        element.parentNode.insertBefore(loadingBar, element.nextSibling);
        return loadingBar;
    }

    function hideLoading(loadingBar) {
        if (loadingBar && loadingBar.parentNode) {
            loadingBar.parentNode.removeChild(loadingBar);
        }
    }

    var legend_ikon = L.control({ position: 'bottomright' });

    legend_ikon.onAdd = function (map) {
        var div = L.DomUtil.create('div', 'info legend_ikon');
        var flags = ['Listing', 'Listing + Pencacahan', 'Listing + Gmaps', 'Pencacahan + Gmaps'];

        let labels = flags.map(flag => {
            let color = getColorByFlag(flag);
            return `
                <div style="margin-bottom: 5px;">
                    <i class="fa-sharp fa-solid fa-location-dot" style="color:${color}; font-size: 18px;"></i>
                    <span style="margin-left: 8px;">${flag}</span>
                </div>`;
        });

        // Tambahan legend gradasi cluster
        labels.push(`
            <div style="margin-top: 10px;">
                <div style="font-weight: bold; margin-bottom: 5px;">Kepadatan Ruta Usaha:</div>
                <div style="background: linear-gradient(to right, hsl(280, 70%, 80%), hsl(280, 70%, 30%)); height: 15px; border-radius: 5px;"></div>
                <div style="display: flex; justify-content: space-between; font-size: 12px; margin-top: 2px;">
                    <span>Rendah</span><span>Tinggi</span>
                </div>
            </div>
        `);

        div.innerHTML = labels.join('');
        return div;
    };

    var legend_ikon_usaha = L.control({ position: 'bottomright' });

    legend_ikon_usaha.onAdd = function (map) {
        var div = L.DomUtil.create('div', 'info legend_ikon');
        var flags = ['GMAPS', 'SBR', 'GMAPS+SBR'];

        let labels = flags.map(flag => {
            let color = getColorByFlagUsaha(flag);
            let label = getLabelByFlagUsaha(flag);
            return `
                <div style="margin-bottom: 5px;">
                    <i class="fa-sharp fa-solid fa-location-dot" style="color:${color}; font-size: 18px;"></i>
                    <span style="margin-left: 8px;">${label}</span>
                </div>`;
        });

        // Tambahan legend gradasi cluster
        labels.push(`
            <div style="margin-top: 10px;">
                <div style="font-weight: bold; margin-bottom: 5px;">Kepadatan Ruta Usaha:</div>
                <div style="background: linear-gradient(to right, hsl(280, 70%, 80%), hsl(280, 70%, 30%)); height: 15px; border-radius: 5px;"></div>
                <div style="display: flex; justify-content: space-between; font-size: 12px; margin-top: 2px;">
                    <span>Rendah</span><span>Tinggi</span>
                </div>
            </div>
        `);

        div.innerHTML = labels.join('');
        return div;
    };


    document.addEventListener('DOMContentLoaded', function() {
        initializeClusterGroups();
    });

</script>
