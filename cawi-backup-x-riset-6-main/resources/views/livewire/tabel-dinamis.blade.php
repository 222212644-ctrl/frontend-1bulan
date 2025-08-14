<div class="container px-4 py-8 mx-auto font-posterable" x-data="{ isMinimized: false }" x-init="const updateSidebar = () => {
    if (window.innerWidth >= 768) {
        isMinimized = false;
    }
};
window.addEventListener('resize', updateSidebar);
updateSidebar();">

    <!-- Title -->
    <h1 class="text-2xl sm:text-3xl md:text-6xl text-center text-[#456438] font-bold mb-2">
        Praktik Kerja Lapangan
    </h1>
    <p class="mb-2 text-base text-center text-green-600 sm:text-lg md:text-2xl">
        Politeknik Statistika STIS T.A 2024/2025
    </p>
    <p class="text-[#F18317] text-base sm:text-lg md:text-2xl text-center mb-2">
        Pemetaan Wilayah Usaha
    </p>

    <head>
        <link rel="stylesheet" href="{{ asset('css/cssTabelDinamis.css') }}">
    </head>
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
            <div class="flex-1 p-4 space-y-4 transition-all duration-300" :class="{
                    'opacity-0 pointer-events-none': isMinimized && window.innerWidth < 768,
                    'opacity-100 pointer-events-auto': !isMinimized || window.innerWidth >= 768
                }" x-cloak>

                <div id="filter-jenis">
                    <label class="form-control block text-sm font-medium text-[#F18317] mb-1">Jenis Data</label>
                    <select id="filter_jenis"
                        class="w-full px-3 py-2 text-gray-500 border rounded-md focus:outline-none focus:ring-1 focus:ring-custom">
                        <option value="">- All -</option>
                        <option value="usaha">Prelist</option>
                        <option value="ruta">Listing</option>
                    </select>
                </div>

                <div id="filter-sumber" class="mt-4">
                    <label class="form-control block text-sm font-medium text-[#F18317] mb-1">Sumber Data</label>
                    <select id="filter_sumber"
                        class="w-full px-3 py-2 text-gray-500 border rounded-md focus:outline-none focus:ring-1 focus:ring-custom">
                        <option value="">- All -</option>
                        <option value="Listing">Listing</option>
                        <option value="Listing + Pencacahan">Pencacahan</option>
                        <option value="Listing + Gmaps">Match Listing dan Gmaps</option>
                        <option value="Pencacahan + Gmaps">Match Pencacahan dan Gmaps</option>
                        <option value="GMAPS">Google Maps</option>
                        <option value="SBR">SBR</option>
                        <option value="GMAPS+SBR">Match Google Maps dan SBR</option>
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
                            <div class="flex justify-between items-center px-3 py-2 mr-4">
                                <button id="select-all" class="bttn">Select All</button>
                                <button id="deselect-all" class="bttn">Deselect All</button>
                            </div>
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
            <!--
            <div class="p-4 overflow-y-auto border-t max-h-64" x-show="!isMinimized || window.innerWidth >= 768"
                x-cloak>
                <h3 class="font-medium mb-4 text-[#F18317]">Daftar Nama Usaha</h3>
                <ul id="list_usaha" class="space-y-2 text-sm text-gray-600">
                </ul>
            </div> -->
        </div>

        <!-- Bagian Tabel -->
        <div class="relative flex flex-col w-full bg-white rounded-lg shadow-lg">
            <div class="relative flex-none overflow-hidden rounded-lg">
                <h3 class="mt-2 mb-2 text-base text-center text-green-600 sm:text-lg md:text-2xl">Tabel Data
                    PKL Politeknik Statistika STIS LXIV</h3>
                <!-- Tabel -->
                <!-- Toolbar -->
                <div class="flex flex-wrap items-center justify-between px-4 pt-2 pb-3 gap-2">
                    <div class="flex items-center gap-2">
                        <!-- Dropdown halaman -->
                        <select id="entriesPerPage"
                            style="padding: 4px 28px 4px 12px; font-size: 14px; border: 1px solid #ccc; border-radius: 6px; margin-right: "
                            class="rounded-md focus:outline-none focus:ring-1 focus:ring-custom">


                            <option value="10">10 per halaman</option>

                            <option value="25">25 per halaman</option>
                            <option value="50">50 per halaman</option>
                            <option value="500">500 per halaman</option>
                        </select>


                        {{-- <!-- Tombol Kolom -->
                        <button
                            class="flex items-center px-3 py-1 text-sm font-medium text-white bg-gray-700 rounded hover:bg-gray-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            Kolom
                        </button> --}}

                        <!-- Tombol Export -->
                        <button onclick="openExportModal()"
                            class="flex items-center px-3 py-1 text-sm font-medium text-white bg-[rgb(22,163,74)] rounded hover:bg-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5 5-5M12 15V3" />
                            </svg>
                            Export
                        </button>

                        <!-- Modal untuk Memilih Kolom -->
                        <div id="exportModal"
                            class="fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center hidden z-50">
                            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                                <h2 class="text-lg font-semibold mb-4">Pilih Kolom untuk Diekspor</h2>
                                <div class="grid grid-cols-2 gap-y-2 text-sm">
                                    {{-- <label><input type="checkbox" class="col-select" value="0" checked>
                                        No</label>
                                    <label><input type="checkbox" class="col-select" value="1" checked> Nama
                                        Usaha</label>
                                    <label><input type="checkbox" class="col-select" value="3" checked>
                                        KBLI</label>
                                    <label><input type="checkbox" class="col-select" value="4" checked>
                                        SLS</label>
                                    <label><input type="checkbox" class="col-select" value="5" checked>
                                        Kelurahan</label>
                                    <label><input type="checkbox" class="col-select" value="6" checked>
                                        Kecamatan</label>
                                    <label><input type="checkbox" class="col-select" value="7" checked>
                                        Kabupaten</label> --}}
                                </div>
                                <div class="mt-4 flex justify-end gap-2">
                                    <button onclick="exportTableToExcel()"
                                        class="bg-blue-500 text-white px-4 py-2 rounded">Excel</button>
                                    <button onclick="exportTableToCSV()"
                                        class="bg-green-600 hover:bg-green-500 text-white px-4 py-2 rounded">CSV</button>
                                    <button onclick="closeExportModal()"
                                        class="bg-red-500 text-white px-4 py-2 rounded">Tutup</button>
                                </div>
                            </div>
                        </div>

                        <button id="column-toggle-btn"
                            class="flex items-center px-3 py-1 text-sm font-medium text-white bg-gray-700 rounded hover:bg-gray-800"
                            onclick="openColumnModal()">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            Kelola Kolom
                        </button>

                        <!-- Modal untuk pengelolaan kolom -->
                        <div id="columnModal"
                            class="fixed inset-0 bg-black bg-opacity-40 flex justify-center items-center hidden z-50">
                            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
                                <h2 class="text-lg font-semibold mb-4">Pilih Kolom untuk Ditampilkan</h2>
                                <div class="grid grid-cols-2 gap-y-2 text-sm">


                                </div>
                                <div class="mt-4 flex justify-end gap-2">
                                    <button onclick="updateVisibleColumns()"
                                        class="bg-green-600 hover:bg-green-500 text-white px-4 py-2 rounded">Terapkan</button>
                                    <button onclick="closeColumnModal()"
                                        class="bg-red-500 text-white px-4 py-2 rounded">Tutup</button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- Input Cari -->
                <!--
            <div>
                <input type="text" placeholder="Cari..." class="px-3 py-1 text-sm border rounded-md focus:outline-none focus:ring-1 focus:ring-custom" />
            </div> -->
            </div>



            <!-- Tabel -->
            <div class="overflow-x-auto w-full px-4 pb-4">
                <table class="w-full text-sm text-left text-gray-500 border border-gray-200">
                    <thead class="text-xs text-gray-700 uppercase bg-orange-100">
                        <tr>
                            {{-- <th class="px-4 py-3 border font-bold">No</th>
                            <th class="px-4 py-3 border font-bold">Nama Usaha</th>
                            <th class="px-4 py-3 border font-bold">KBLI</th>
                            <th class="px-4 py-3 border font-bold">SLS</th>
                            <th class="px-4 py-3 border font-bold">Kelurahan</th>
                            <th class="px-4 py-3 border font-bold">Kecamatan</th>
                            <th class="px-4 py-3 border font-bold">Kabupaten</th> --}}
                        </tr>
                    </thead>
                    <tbody id="data-body" class="bg-white">
                        <!-- Data akan ditambahkan di sini via JavaScript -->
                    </tbody>
                </table>
            </div>
            <div style="margin-top: 1rem; margin-bottom: 1rem; display: flex; justify-content: center; gap: 1.5rem;">
                <button id="prevBtn"
                    style="padding: 10px 18px; background-color: #eee; border-radius: 8px; border: none; font-size: 24px; font-weight: bold; font-family: monospace; cursor: pointer;">&lt;</button>
                <button id="nextBtn"
                    style="padding: 10px 18px; background-color: #eee; border-radius: 8px; border: none; font-size: 24px; font-weight: bold; font-family: monospace; cursor: pointer;">&gt;</button>
            </div>

        </div>
</div>
</main>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {

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
    })
    let geojsonData = [];
    let filterOn = false;
    let allChecked = true;

    function filterWilayah(data, property, code) {
        return {
            type: "FeatureCollection",
            features: data.features.filter(function (feature) {
                return feature.properties[property] === code;
            }),
        };
    }

    async function loadGeoJSONData() {
        try {
            const res = await fetch('/js/geojson_pencacahan.js');
            const text = await res.text(); // Read response as text

            // Assuming the data is wrapped in "var kabDat = ...;"
            const jsonStart = text.indexOf('{'); // Find the start of the JSON object
            const jsonEnd = text.lastIndexOf('}') + 1; // Find the end of the JSON object
            const jsonString = text.slice(jsonStart, jsonEnd); // Extract the JSON part

            const geoJSONData = JSON.parse(jsonString); // Parse the extracted JSON;

            geojsonData = geoJSONData;
            // console.log('geojsonData dalam fungsi :', geojsonData);
            filteredData = geojsonData;
            renderTable();
        } catch (err) {
            console.error("Gagal memuat data GeoJSON:", err);
        }
    }

    async function loadDataListing() {
        try {
            // Fetch kedua file GeoJSON
            const [res1, res2, res3] = await Promise.all([
                fetch('/js/geojson_pencacahan.js'),
                fetch('/js/geojson_matching.js'),
                fetch('/js/geojson_usaha.js')
            ]);

            const [text1, text2, text3] = await Promise.all([
                res1.text(),
                res2.text(),
                res3.text()
            ]);

            // Ekstrak JSON dari masing-masing file
            const jsonStart1 = text1.indexOf('{');
            const jsonEnd1 = text1.lastIndexOf('}') + 1;
            const geoJSON1 = JSON.parse(text1.slice(jsonStart1, jsonEnd1));

            const jsonStart2 = text2.indexOf('{');
            const jsonEnd2 = text2.lastIndexOf('}') + 1;
            const geoJSON2 = JSON.parse(text2.slice(jsonStart2, jsonEnd2));

            const jsonStart3 = text3.indexOf('{');
            const jsonEnd3 = text3.lastIndexOf('}') + 1;
            const geoJSON3 = JSON.parse(text3.slice(jsonStart3, jsonEnd3));

            geoJSON1.features.forEach(f => f.properties.jenis = "ruta");
            geoJSON2.features.forEach(f => f.properties.jenis = "ruta");
            geoJSON3.features.forEach(f => f.properties.jenis = "usaha");

            // Gabungkan features
            const combinedGeoJSON = {
                type: "FeatureCollection",
                features: [...geoJSON1.features, ...geoJSON2.features, ...geoJSON3.features]
            };

            geojsonData = combinedGeoJSON;
            filteredData = geojsonData;
            renderTable();
        } catch (err) {
            console.error("Gagal memuat data GeoJSON:", err);
        }
    }


    loadDataListing();

    function hidePrevNextBtn(dataShown) {
        if (!(currentPage < Math.ceil(dataShown.features.length / entriesPerPage))) {

            nextBtn.style.display = 'none';
        } else {
            nextBtn.style.display = 'inline';
        }

        if (currentPage == 1) {
            prevBtn.style.display = 'none';
        } else {
            prevBtn.style.display = 'inline';
        }
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
    // Ambil semua elemen filter
    const kabupatenFilter = document.getElementById("filter_kabupaten_kota");
    const kecamatanFilter = document.getElementById("filter_kecamatan");
    const kelurahanFilter = document.getElementById("filter_kelurahan");
    const SlsFilter = document.getElementById("filter_sls");
    const jenisFilter = document.getElementById("filter_jenis");
    const sumberFilter = document.getElementById("filter_sumber");
    const kategoriCheckboxes = document.querySelectorAll(".filter-checkbox");


    function readFilter() {
        filteredData = geojsonData;
        console.log("ab")
        if (kabupatenFilter.value) {
            console.log(kabupatenFilter.value)
            filteredDataSumber = {
                ...filteredData,
                features: filteredData.features.filter(feature => feature.properties.kodekab ==
                    kabupatenFilter.value)
            };
            filteredData = filteredDataSumber;
        }
        if (kecamatanFilter.value) {
            filteredDataSumber = {
                ...filteredData,
                features: filteredData.features.filter(feature => feature.properties.kodekec ==
                    kecamatanFilter.value)
            };
            filteredData = filteredDataSumber;
        }
        if (kelurahanFilter.value) {
            filteredDataSumber = {
                ...filteredData,
                features: filteredData.features.filter(feature => feature.properties.kodekel ==
                    kelurahanFilter.value)
            };
            filteredData = filteredDataSumber;
        }
        if (SlsFilter.value) {
            filteredDataSumber = {
                ...filteredData,
                features: filteredData.features.filter(feature => feature.properties.idsls ==
                    SlsFilter.value)
            };
            filteredData = filteredDataSumber;
        }
        if (sumberFilter.value) {
            filteredDataSumber = {
                ...filteredData,
                features: filteredData.features.filter(feature => feature.properties.Flag ==
                    sumberFilter.value)
            };
            filteredData = filteredDataSumber;
        }
        if (jenisFilter.value) {
            console.log("jalan")
            filteredDataSumber = {
                ...filteredData,
                features: filteredData.features.filter(feature => feature.properties.jenis ==
                    jenisFilter.value)
            };
            filteredData = filteredDataSumber;
        }
        kategoriFilter();


    }

    // Event listener untuk semua filter
    //   [kabupatenFilter, kecamatanFilter, kelurahanFilter, SlsFilter].forEach(filter => {
    //       filter.addEventListener("change", kategoriFilter);
    //   });
    let kecData, kelData, filteredData, slsData, filteredDataCat;

    sumberFilter.addEventListener('change', async function (e) {
        readFilter()
        renderTable();

    });

    jenisFilter.addEventListener('change', async function (e) {
        readFilter()
        renderTable();

    });

    kabupatenFilter.addEventListener('change', async function (e) {
        kecamatanFilter.value = "";
        kelurahanFilter.value = "";
        SlsFilter.value = ";"
        readFilter();
        const selectedKab = e.target.value;
        let loadingBar;
        if (selectedKab && !kecData) {
            loadingBar = showLoading('filter_kecamatan');
            try {
                kecData = await loadGeoJSON('kec');
            } finally {
                hideLoading(loadingBar);
            }
        }
        kecamatanFilter.innerHTML = '<option value="">- All -</option>';
        kelurahanFilter.innerHTML =
            '<option disabled selected value="">- All -</option>';
        SlsFilter.innerHTML =
            '<option disabled selected value="">- All -</option>';


        if (selectedKab) {
            var listKecamatan = filterWilayah(kecData, 'kodekab', selectedKab)

            const kecamatanSelect = document.getElementById('filter_kecamatan');


            listKecamatan.features
                .sort((a, b) => a.properties.nama_wilayah.localeCompare(b.properties.nama_wilayah))
                .forEach(feature => {
                    const option = document.createElement('option');
                    option.value = feature.properties.kodekec;
                    option.textContent = feature.properties.nama_wilayah;
                    kecamatanSelect.appendChild(option);
                });

            // // Filter Terhadap tabel
            // filteredDataKab = {
            //     ...geojsonData,
            //     features: geojsonData.features.filter(feature => feature.properties.kodekab ==
            //         selectedKab)
            // };

            // filteredData = filteredDataKab
        }
        renderTable();
    });


    kecamatanFilter.addEventListener('change', async function (e) {
        kelurahanFilter.value = "";
        SlsFilter.value = ";"
        readFilter();
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
        kelurahanFilter.innerHTML = '<option value="">- All -</option>';
        SlsFilter.innerHTML =
            '<option disabled selected value="">- All -</option>';

        if (selectedKec) {
            var kelTerpilih = filterWilayah(kelData, 'kodekec', selectedKec)

            const kelurahanSelect = document.getElementById('filter_kelurahan');

            kelTerpilih.features
                .sort((a, b) => a.properties.nama_wilayah.localeCompare(b.properties.nama_wilayah))
                .forEach(feature => {
                    const option = document.createElement('option');
                    option.value = feature.properties.kodekel;
                    option.textContent = feature.properties.nama_wilayah;
                    kelurahanSelect.appendChild(option);
                });
        }
        renderTable();
    });

    kelurahanFilter.addEventListener('change', async function (e) {
        SlsFilter.value = ";"
        readFilter();
        const selectedKel = e.target.value
        SlsFilter.innerHTML = '<option value="">- All -</option>';
        if (selectedKel && !slsData) {
            loadingBar = showLoading('filter_sls');
            try {
                slsData = await loadGeoJSON('sls');
            } finally {
                hideLoading(loadingBar);
            }
        }
        if (selectedKel) {
            var selectedKelFormat = e.target.value.replace(/\./g, '');
            var slsTerpilih = filterWilayah(slsData, 'iddesa', selectedKelFormat)

            const slsSelect = document.getElementById('filter_sls');
            slsTerpilih.features
                .sort((a, b) => a.properties.nama_wilayah.localeCompare(b.properties.nama_wilayah))
                .forEach(feature => {
                    const option = document.createElement('option');
                    option.value = feature.properties.idsls;
                    option.textContent = feature.properties.nama_wilayah;
                    slsSelect.appendChild(option);
                });
        }
        renderTable();

    });

    SlsFilter.addEventListener('change', async function (e) {
        readFilter()
        const selectedSls = e.target.value;

        renderTable();
    })
    const tbody = document.getElementById("data-body");
    let currentPage = 1;
    let entriesPerPage = 10;

    const textKategori = document.getElementById('selected-value')

    kategoriCheckboxes.forEach(checkbox => {
        checkbox.addEventListener("change", () => {
            readFilter();
            renderTable()
        });
    });

    function kategoriFilter() {

        const selectedCategories = Array.from(kategoriCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        if (selectedCategories.length == kategoriCheckboxes.length) {
            allChecked = true;

        } else {

            allChecked = false;
            filteredDataCat = {
                ...filteredData,
                features: filteredData.features.filter(feature => {
                    return selectedCategories.includes(feature.properties.kode_kbli);
                })
            };
        }

        if (allChecked) {
            textKategori.textContent = "- All -"
        } else {
            const selected = Array.from(kategoriCheckboxes)
                .filter(c => c.checked)
                .map(c => c.value)
                .join(', ');
            textKategori.textContent = selected
        }
    }


    document.getElementById('select-all').addEventListener('click', function () {
        document.querySelectorAll('.filter-checkbox').forEach(checkbox => checkbox.checked = true);
        readFilter();
        renderTable();
    });

    document.getElementById('deselect-all').addEventListener('click', function () {
        document.querySelectorAll('.filter-checkbox').forEach(checkbox => checkbox.checked = false);
        readFilter();
        renderTable();
    });

    // Reset button
    window.resetFilter = function () {
        jenisFilter.value = "";
        sumberFilter.value = "";
        kabupatenFilter.value = "";
        kecamatanFilter.value = "";
        kelurahanFilter.value = "";
        SlsFilter.value = "";
        kategoriCheckboxes.forEach(cb => cb.checked = true);
        textKategori.textContent = "- All -"
        allChecked = true;
        filterOn = false;
        renderTable();
    };

    // Jalankan filter pertama kali





    // <!-- Script Funsi Generate Tabel -->




    const entriesSelect = document.getElementById("entriesPerPage");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");

    entriesSelect.addEventListener("change", () => {
        entriesPerPage = parseInt(entriesSelect.value);
        currentPage = 1;
        renderTable();
    });

    prevBtn.addEventListener("click", () => {
        if (currentPage > 1) {
            currentPage--;
            renderTable();
        }
    });

    nextBtn.addEventListener("click", () => {

        if (currentPage < Math.ceil(geojsonData.features.length / entriesPerPage)) {
            currentPage++;
            renderTable();
        }
    });

    function filterCheck() {
        if (!allChecked) {
            kategoriFilter();
        }
    }

    function kabLabel(kodekab) {
        if (kodekab == "16.02") {
            return ("Ogan Komering Ilir");
        }
        else if (kodekab == "16.10") {
            return ("Ogan Ilir");
        }
        else if (kodekab == "16.72") {
            return ("Prabumulih");
        }
        else if (kodekab == "16.71") {
            return ("Palembang");
        }
        return ("-");
    }

    function sumberLabel(flag) {
        if (flag == "Listing + Pencacahan") {
            return ("Pencacahan");
        }
        else if (flag == "Listing + Gmaps") {
            return ("Match Listing dan Gmaps");
        }
        else if (flag == "Pencacahan + Gmaps") {
            return ("Match Pencacahan dan Gmaps");
        }
        else if (flag == "GMAPS+SBR") {
            return ("Match Google Maps dan SBR");
        }
        return (flag);
    }

    const columnsConfig = [
        {
            id: 'no',
            name: 'No',
            visible: true,
            exportKey: '0',
            dataKey: null, // Akan diisi oleh index
            render: (data, index) => index + 1
        },
        {
            id: 'nama_usaha',
            name: 'Nama Usaha',
            visible: true,
            exportKey: '1',
            dataKey: 'nama_usaha',
            render: (data) => data.nama_usaha || '-'
        },
        {
            id: 'kode_kbli',
            name: 'KBLI',
            visible: true,
            exportKey: '3',
            dataKey: 'kode_kbli',
            render: (data) => data.kode_kbli || '-'
        },
        {
            id: 'label_kbli',
            name: 'Label KBLI',
            visible: false,
            exportKey: '7',
            dataKey: 'kbli_label',
            render: (data) => data.kbli_label || '-'
        },
        {
            id: 'nama_sls',
            name: 'SLS',
            visible: true,
            exportKey: '4',
            dataKey: 'nama_sls',
            render: (data) => data.nama_sls?.trim() || '-'
        },
        {
            id: 'kode_sls',
            name: 'Kode SLS',
            visible: false,
            exportKey: '4',
            dataKey: 'idsls',
            render: (data) => data.idsls || '-'
        },
        {
            id: 'nmdesa',
            name: 'Kelurahan',
            visible: true,
            exportKey: '5',
            dataKey: 'nmdesa',
            render: (data) => data.nmdesa || '-'
        },
        {
            id: 'kode_kelurahan',
            name: 'Kode Kelurahan',
            visible: false,
            exportKey: '5',
            dataKey: 'kodekel',
            render: (data) => data.kodekel || '-'
        },
        {
            id: 'nmkec',
            name: 'Kecamatan',
            visible: true,
            exportKey: '6',
            dataKey: 'nmkec',
            render: (data) => data.nmkec || '-'
        },
        {
            id: 'kode_kecamatan',
            name: 'Kode Kecamatan',
            visible: false,
            exportKey: '6',
            dataKey: 'kodekec',
            render: (data) => data.kodekec || '-'
        },
        {
            id: 'kabupaten',
            name: 'Kabupaten',
            visible: true,
            exportKey: '7',
            dataKey: 'namakab',
            render: (data) => kabLabel(data.kodekab) || '-'
        },
        {
            id: 'kode_kabupaten',
            name: 'Kode Kabupaten',
            visible: false,
            exportKey: '7',
            dataKey: 'kodekab',
            render: (data) => data.kodekab || '-'
        },
        {
            id: 'jenis_data',
            name: 'Jenis Data',
            visible: false,
            exportKey: '7',
            dataKey: 'jenis',
            render: (data) => data.jenis === 'usaha' ? 'Prelist' : 'Listing'
        },
        {
            id: 'sumber_data',
            name: 'Sumber Data',
            visible: false,
            exportKey: '7',
            dataKey: 'Flag',
            render: (data) => sumberLabel(data.Flag) || '-'
        }
    ];

    function renderColumnModal() {
        const modalContent = document.querySelector('#columnModal .grid');
        modalContent.innerHTML = '';

        columnsConfig.forEach((column, index) => {
            const checkboxId = `col-${column.id}`;
            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.id = checkboxId;
            checkbox.className = 'col-select';
            checkbox.value = column.dataKey;
            checkbox.checked = column.visible;
            checkbox.dataset.columnId = column.id;

            const label = document.createElement('label');
            label.htmlFor = checkboxId;
            label.appendChild(checkbox);
            label.appendChild(document.createTextNode(' ' + column.name));

            const container = document.createElement('div');
            container.appendChild(label);

            modalContent.appendChild(container);
        });
    }

    function renderExportModal() {
        const modalContent = document.querySelector('#exportModal .grid');
        modalContent.innerHTML = '';

        columnsConfig.forEach((column, index) => {
            const checkboxId = `col-exp-${column.id}`;
            const checkbox = document.createElement('input');
            checkbox.type = 'checkbox';
            checkbox.id = checkboxId;
            checkbox.className = 'col-exp-select';
            checkbox.value = column.dataKey;
            checkbox.checked = column.visible;
            checkbox.dataset.columnId = column.id;

            const label = document.createElement('label');
            label.htmlFor = checkboxId;
            label.appendChild(checkbox);
            label.appendChild(document.createTextNode(' ' + column.name));

            const container = document.createElement('div');
            container.appendChild(label);

            modalContent.appendChild(container);
        });
    }

    function updateVisibleColumns() {
        document.querySelectorAll('#columnModal .col-select').forEach(checkbox => {
            const columnId = checkbox.dataset.columnId;
            const column = columnsConfig.find(col => col.id === columnId);
            if (column) {
                column.visible = checkbox.checked;
            }
        });
        renderTable();
        closeColumnModal();
    }

    function renderTable() {
        tbody.innerHTML = "";
        const start = (currentPage - 1) * entriesPerPage;
        const end = start + entriesPerPage;
        var pageData;
        if (!allChecked) {
            console.log("1");
            kategoriFilter();
            pageData = filteredDataCat.features.slice(start, end);
            hidePrevNextBtn(filteredDataCat)
        } else {
            console.log("2");
            pageData = filteredData.features.slice(start, end);
            hidePrevNextBtn(filteredData)

        }
        // else {
        //     console.log("3");
        //     pageData = geojsonData.features.slice(start, end);
        //     hidePrevNextBtn(geojsonData)
        // }

        const headerRow = document.querySelector('thead tr');
        headerRow.innerHTML = '';

        columnsConfig.forEach(column => {
            if (column.visible) {
                const th = document.createElement('th');
                th.className = 'px-4 py-3 border font-bold';
                th.textContent = column.name;
                headerRow.appendChild(th);
            }
        });

        pageData.forEach((feature, index) => {
            const row = document.createElement('tr');
            row.className = index % 2 === 0 ? 'odd:bg-white' : 'even:bg-orange-50';

            columnsConfig.forEach(column => {
                if (column.visible) {
                    const td = document.createElement('td');
                    td.className = 'px-4 py-2 border';
                    td.textContent = column.render(feature.properties, start + index);
                    row.appendChild(td);
                }
            });

            tbody.appendChild(row);
        });

        // pageData.forEach((f, i) => {
        //     const p = f.properties;
        //     const row = `<tr class="${i % 2 === 0 ? 'odd:bg-white' : 'even:bg-orange-50'}">
        //   <td class="px-4 py-2 border">${start + i + 1}</td>
        //   <td class="px-4 py-2 border">${p.nama_usaha || '-'}</td>
        //   <td class="px-4 py-2 border">${p.kode_kbli || '-'}</td>
        //   <td class="px-4 py-2 border">${p.nama_sls?.trim() || '-'}</td>
        //   <td class="px-4 py-2 border">${p.nmdesa || '-'}</td>
        //   <td class="px-4 py-2 border">${p.nmkec || '-'}</td>
        //   <td class="px-4 py-2 border">${kabLabel(p.kodekab) || '-'}</td>
        // </tr>`;
        //     tbody.innerHTML += row;
        // });
    }
</script>

<script src="https://cdn.tailwindcss.com"></script>

{{--
<script src="{{ asset('js/geojson_bs.js') }}"></script> --}}
{{--
<script src="{{ asset('js/geojson_sls.js') }}"></script> --}}

<!-- SheetJS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<!-- Export Functions -->
<script>
    function openExportModal() {
        renderExportModal();
        document.getElementById('exportModal').classList.remove('hidden');
    }

    function closeExportModal() {
        document.getElementById('exportModal').classList.add('hidden');
    }

    function openColumnModal() {
        renderColumnModal();
        document.getElementById('columnModal').classList.remove('hidden');
    }

    function closeColumnModal() {
        document.getElementById('columnModal').classList.add('hidden');
    }

    function getSelectedColumns() {
        return Array.from(document.querySelectorAll('.col-select:checked')).map(cb => parseInt(cb.value));
    }

    function exportTableToExcel(filename = 'data_usaha.xlsx') {
        const selectedColumns = columnsConfig.filter(col =>
            Array.from(document.querySelectorAll('.col-exp-select:checked'))
                .some(checkbox => checkbox.value === col.dataKey)
        );

        const workbook = XLSX.utils.book_new();
        const worksheetData = [
            selectedColumns.map(col => col.name)
        ];

        filteredData.features.forEach(feature => {
            const row = selectedColumns.map(col =>
                col.render(feature.properties, worksheetData.length)
            );
            worksheetData.push(row);
        });

        const worksheet = XLSX.utils.aoa_to_sheet(worksheetData);
        XLSX.utils.book_append_sheet(workbook, worksheet, "Data Usaha");
        XLSX.writeFile(workbook, filename);
        closeColumnModal();
    }

    // function exportTableToExcel(filename = 'data_usaha.xlsx') {
    //     const columnsToExport = getSelectedColumns();

    //     // Buat tabel sementara
    //     const tempTable = document.createElement('table');

    //     // Buat baris header
    //     const headerLabels = [
    //         "No", "Nama Usaha", "KBLI",
    //         "SLS", "Kelurahan", "Kecamatan", "Kabupaten"
    //     ];

    //     const headerRow = document.createElement('tr');
    //     columnsToExport.forEach(index => {
    //         const th = document.createElement('th');
    //         th.textContent = headerLabels[index];
    //         headerRow.appendChild(th);
    //     });
    //     tempTable.appendChild(headerRow);

    //     // Isi semua data dari geojsonData (bukan dari <tbody>)
    //     geojsonData.features.forEach((f, i) => {
    //         const p = f.properties;
    //         const row = document.createElement('tr');

    //         const values = [
    //             i + 1,
    //             p.nama_usaha || '-',
    //             p.kode_kbli || '-',
    //             (p.nama_sls || '').trim(),
    //             p.nmdesa || '-',
    //             p.nmkec || '-',
    //             p.nmkab || '-'
    //         ];

    //         columnsToExport.forEach(index => {
    //             const td = document.createElement('td');
    //             td.textContent = values[index];
    //             row.appendChild(td);
    //         });

    //         tempTable.appendChild(row);
    //     });

    //     const workbook = XLSX.utils.table_to_book(tempTable, {
    //         sheet: "Data Usaha"
    //     });
    //     XLSX.writeFile(workbook, filename);
    //     closeExportModal();
    // }

    function exportTableToCSV(filename = 'data_usaha.csv') {
        // Dapatkan kolom yang dipilih
        const selectedColumns = columnsConfig.filter(col =>
            Array.from(document.querySelectorAll('.col-exp-select:checked'))
                .some(checkbox => checkbox.value === col.dataKey)
        );

        // Siapkan header CSV
        const csvRows = [];
        const headers = selectedColumns.map(col => `"${col.name.replace(/"/g, '""')}"`);
        csvRows.push(headers.join(','));

        // Tambahkan data
        filteredData.features.forEach(feature => {
            const row = selectedColumns.map(col => {
                // Escape nilai untuk CSV (ganti " dengan "" dan tambahkan quotes)
                const value = col.render(feature.properties, csvRows.length);
                return `"${String(value).replace(/"/g, '""')}"`;
            });
            csvRows.push(row.join(','));
        });

        // Buat file CSV
        const csvContent = csvRows.join('\n');
        const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });

        // Buat link unduh
        const link = document.createElement('a');
        const url = URL.createObjectURL(blob);
        link.setAttribute('href', url);
        link.setAttribute('download', filename);
        link.style.visibility = 'hidden';

        // Trigger unduhan
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        // Tutup modal setelah ekspor
        closeColumnModal();
    }

    // function exportTableToCSV(filename = 'data_usaha.csv') {
    //     const columnsToExport = getSelectedColumns();

    //     const headerLabels = [
    //         "No", "Nama Usaha", "KBLI",
    //         "SLS", "Kelurahan", "Kecamatan", "Kabupaten"
    //     ];

    //     // Baris Header
    //     const csvRows = [];
    //     const selectedHeaders = columnsToExport.map(index => headerLabels[index]); // gunakan headerLabels dengan benar
    //     csvRows.push(selectedHeaders.join(','));

    //     // Data Baris
    //     geojsonData.features.forEach((f, i) => { // pastikan menggunakan geojsonData.features
    //         const p = f.properties;
    //         const values = [
    //             i + 1,
    //             p.nama_usaha || '-',
    //             p.kode_kbli || '-',
    //             (p.nama_sls || '').trim(),
    //             p.nmdesa || '-',
    //             p.nmkec || '-',
    //             p.nmkab || '-'
    //         ];

    //         const row = columnsToExport.map(index => {
    //             const value = values[index];
    //             return `"${String(value).replace(/"/g, '""')}"`; // escape double quotes dengan benar
    //         });

    //         csvRows.push(row.join(','));
    //     });

    //     // Buat dan unduh file CSV
    //     const csvContent = csvRows.join('\n');
    //     const blob = new Blob([csvContent], {
    //         type: 'text/csv;charset=utf-8;'
    //     });
    //     const url = URL.createObjectURL(blob);

    //     const a = document.createElement('a');
    //     a.href = url;
    //     a.download = filename;
    //     a.style.display = 'none';

    //     document.body.appendChild(a);
    //     a.click();
    //     document.body.removeChild(a);
    //     URL.revokeObjectURL(url);

    //     closeExportModal();
    // }



    // Mendapatkan kolom yang dipilih untuk diekspor
    function getSelectedColumns() {
        const checkboxes = document.querySelectorAll('.col-select:checked');
        const selectedColumns = Array.from(checkboxes).map(checkbox => parseInt(checkbox.value));
        return selectedColumns;
    }
</script>