<div class="font-posterable container mx-auto px-4 py-8">
    <!-- Title -->
    <h1 class="text-3xl lg:text-6xl text-center text-[#456438] font-bold mb-2">
        Praktik Kerja Lapangan
    </h1>
    <p class="text-lg lg:text-2xl text-center text-green-600 mb-2">
        Politeknik Statistika STIS T.A 2024/2025
    </p>
    <p class="text-[#F18317] text-lg lg:text-2xl text-center mb-2">
        Klasifikasi Baku Lapangan Usaha Indonesia 2020
    </p>

    <div class="max-w-6xl mx-auto mb-4">
        <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 bg-gray-100 rounded-lg shadow-md p-4">
            <!-- First 4 cards remain the same -->
            <div class="bg-white rounded-md p-4">
                <h3 class="text-center text-[#456438] text-xl font-bold">21</h3>
                <p class="text-center text-green-600 text-sm font-medium">Kategori</p>
            </div>

            <div class="bg-white rounded-md p-4">
                <h3 class="text-center text-xl text-[#456438] font-bold">88</h3>
                <p class="text-center text-green-600 text-sm font-medium">Golongan Pokok</p>
            </div>

            <div class="bg-white rounded-md p-4">
                <h3 class="text-center text-xl text-[#456438] font-bold">245</h3>
                <p class="text-center text-green-600 text-sm font-medium">Golongan</p>
            </div>

            <div class="bg-white rounded-md p-4">
                <h3 class="text-center text-xl text-[#456438] font-bold">567</h3>
                <p class="text-center text-green-600 text-sm font-medium">Sub Golongan</p>
            </div>

            <!-- Last card with responsive col-span -->
            <div class="bg-white rounded-md p-4 col-span-2 lg:col-span-1">
                <h3 class="text-center text-xl text-[#456438] font-bold">1789</h3>
                <p class="text-center text-green-600 text-sm font-medium">Kelompok</p>
            </div>
        </div>
    </div>

    {{-- Template Search --}}
    <div class="font-posterable max-w-6xl mx-auto mb-4"> <!-- Tambahkan padding untuk HP -->
        <!-- Search Section -->
        <div class="w-full max-w-6xl max-h-2xl bg-white p-4 md:p-6 rounded-lg shadow-md mx-auto">
            <div class="flex flex-col md:flex-row items-center gap-4">
                <!-- Input -->
                <input type="text" placeholder="Masukkan Deskripsi Usaha" wire:model="query"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500">

                <!-- Tombol dalam flex untuk kontrol tampilan -->
                <div class="flex flex-col md:flex-row w-full md:w-auto gap-2">
                    <button wire:click="search"
                        class="bg-orange-500 hover:bg-orange-600 text-white text-sm px-8 py-2 rounded-xl w-full md:w-auto">
                        Cari Deskripsi
                    </button>
                    <button wire:click="searchKode"
                        class="bg-orange-500 hover:bg-orange-600 text-white text-sm px-8 py-2 rounded-xl w-full md:w-auto">
                        Cari Kode
                    </button>
                </div>
            </div>

            <!-- Animated Loading Bar -->
            <div wire:loading wire:target="query"
                class="w-full bg-gray-200 h-2 mt-4 rounded-lg overflow-hidden relative">
                <div class="absolute left-0 top-0 h-full bg-blue-500 w-1/3 animate-progress"></div>
            </div>
        </div>
    </div>


    <!-- Search Results -->
    @if (!empty($query) && $searchResult)
        @foreach ($searchResult as $result)
            <div class="font-montserrat mt-2 w-full max-w-6xl mx-auto bg-white rounded-lg shadow-md">
                <button wire:click="Digit5Search('{{ $result['kode_5_digit'] }}')" class="text-left">
                    <div class="flex items-start gap-4 p-4 border-b border-gray-200">
                        <!-- Sector Letter -->
                        @php
                            $background = $result['is_ekraf'] ? 'bg-[#4BB74C] text-black' : 'bg-blue-900';
                            if ($result['sector'] == 'A' || $result['sector'] == 'O' || $result['sector'] == 'T') {
                                $background = 'bg-red-700';
                            }
                        @endphp
                        <div
                            class="w-12 h-12 rounded-lg flex items-center justify-center text-white font-bold text-lg shadow-md {{ $background }}">
                            {{ $result['sector'] }}
                        </div>
                        <!-- Details -->
                        <div class="flex-1">
                            <h2 class="text-lg font-bold border-b-2 border-gray-300 pb-1 mb-2">
                                {{ $result['kode_5_digit'] }} - {{ $result['judul'] }}
                            </h2>
                            <p class="text-sm text-gray-700">
                                {{ $result['deskripsi'] }}
                            </p>
                        </div>
                    </div>
                </button>
            </div>
        @endforeach
    @else
        @if (!$selectedSector)
            <div class="font-montserrat w-full max-w-6xl max-h-2xl bg-white p-6 rounded-lg shadow-md mx-auto my-2">
                @foreach ($sectors as $sector)
                    <button wire:click="sektorDetail('{{ $sector->kode_sektor }}')"
                        class="w-full text-left my-1 bg-gray-100 border border-gray-300 p-3 rounded-lg hover:bg-gray-200">
                        <strong>{{ $sector->kode_sektor }}</strong> - {{ $sector->judul }}
                    </button>
                @endforeach
            </div>
        @endif

        @if ($selectedSector && !$selectedKode2Digit)
            <div class="w-full max-w-6xl max-h-2xl bg-white p-6 rounded-lg shadow-md mx-auto my-2 font-montserrat">
                {{-- Kembali Ke Daftar Sektor --}}
                <button wire:click="goBack('sector')"
                    class="bg-gray-200 text-gray-800 p-2 rounded-md mb-4 hover:bg-gray-300">
                    Kembali ke Sektor
                </button>
                <h3 class="text-lg font-semibold">{{ $selectedSector }} - {{ $judul[0] }}</h3>
                <p class="mb-4">{{ $deskripsi[0] }}</p>

                {{-- Daftar Kode Turunan 2 Digit --}}
                <h3 class="text-lg font-semibold">Golongan Pokok</h3>
                @foreach ($kode2Digit as $items)
                    <div>
                        <button wire:click="Digit2Detail('{{ $items['kode_2_digit'] }}')"
                            class="w-full text-left my-1 bg-gray-100 border border-gray-300 p-3 rounded-lg hover:bg-gray-200 flex items-center">
                            <div
                                class= "bg-orange-400 rounded-lg flex items-center justify-center text-white font-bold mr-4 w-12 h-8 flex-shrink-0">
                                {{ $items['kode_2_digit'] }}
                            </div>
                            <span>{{ $items['judul'] }}</span>
                        </button>
                    </div>
                @endforeach
            </div>
        @endif

        @if ($selectedKode2Digit && !$selectedKode3Digit)
            <div class="w-full max-w-6xl max-h-2xl bg-white p-6 rounded-lg shadow-md mx-auto my-2 font-montserrat">
                {{-- Kembali Ke Daftar Sektor --}} <button wire:click="goBack('sector')"
                    class="bg-gray-200 text-gray-800 p-2 rounded-md mb-4 hover:bg-gray-300">
                    Kembali ke Sektor
                </button>
                <h3 class="text-lg font-semibold">{{ $selectedKode2Digit }} - {{ $judul[1] }}</h3>
                <p class="mb-4">{{ $deskripsi[1] }}</p>

                {{-- Daftar Kode Sebelumnya --}}
                <h3 class="text-lg font-semibold">Kategori</h3>

                <div>
                    <button wire:click="goBack('kode2digit')"
                        class="w-full text-left my-1 bg-gray-100 border border-gray-300 p-3 rounded-lg hover:bg-gray-200 flex items-center">
                        <div
                            class="w-12 h-8 bg-orange-400 rounded-lg flex flex-shrink-0 items-center justify-center text-white font-bold mr-4">
                            {{ $selectedSector }}
                        </div>
                        <span>{{ $judul[0] }}</span>
                    </button>
                </div>

                {{-- Daftar Kode Turunan 3 Digit --}}
                <h3 class="text-lg font-semibold">Golongan</h3>
                @foreach ($kode3Digit as $items)
                    <div>
                        <button wire:click="Digit3Detail('{{ $items['kode_3_digit'] }}')"
                            class="w-full text-left my-1 bg-gray-100 border border-gray-300 p-3 rounded-lg hover:bg-gray-200 flex items-center">
                            <div
                                class="w-12 h-8 bg-orange-400 rounded-lg flex flex-shrink-0 items-center justify-center text-white font-bold mr-4">
                                {{ $items['kode_3_digit'] }}
                            </div>
                            <span>{{ $items['judul'] }}</span>
                        </button>
                    </div>
                @endforeach
            </div>
        @endif

        @if ($selectedKode3Digit && !$selectedKode4Digit)
            <div class="w-full max-w-6xl max-h-2xl bg-white p-6 rounded-lg shadow-md mx-auto my-2 font-montserrat">
                {{-- Kembali Ke Daftar Sektor --}} <button wire:click="goBack('sector')"
                    class="bg-gray-200 text-gray-800 p-2 rounded-md mb-4 hover:bg-gray-300">
                    Kembali ke Sektor
                </button>
                <h3 class="text-lg font-semibold">{{ $selectedKode3Digit }} - {{ $judul[2] }}</h3>
                <p class="mb-4">{{ $deskripsi[2] }}</p>

                {{-- Daftar Kode Sebelumnya --}}
                <h3 class="text-lg font-semibold">Kategori</h3>

                <div>
                    <button wire:click="goBack('kode2digit')"
                        class="w-full text-left my-1 bg-gray-100 border border-gray-300 p-3 rounded-lg hover:bg-gray-200 flex items-center">
                        <div
                            class="w-12 h-8 bg-orange-400 rounded-lg flex flex-shrink-0 items-center justify-center text-white font-bold mr-4">
                            {{ $selectedSector }}
                        </div>
                        <span>{{ $judul[0] }}</span>
                    </button>

                    <h3 class="text-lg font-semibold">Golongan Pokok</h3>
                    <button wire:click="goBack('kode3digit')"
                        class="w-full text-left my-1 bg-gray-100 border border-gray-300 p-3 rounded-lg hover:bg-gray-200 flex items-center">
                        <div
                            class="w-12 h-8 bg-orange-400 rounded-lg flex flex-shrink-0 items-center justify-center text-white font-bold mr-4">
                            {{ $selectedKode2Digit }}
                        </div>
                        <span>{{ $judul[1] }}</span>
                    </button>
                </div>

                {{-- Daftar Kode Turunan 4 Digit --}}
                <h3 class="text-lg font-semibold">Sub Golongan</h3>
                @foreach ($kode4Digit as $items)
                    <div>
                        <button wire:click="Digit4Detail('{{ $items['kode_4_digit'] }}')"
                            class="w-full text-left my-1 bg-gray-100 border border-gray-300 p-3 rounded-lg hover:bg-gray-200 flex items-center">
                            <div
                                class="w-12 h-8 bg-orange-400 rounded-lg flex flex-shrink-0 items-center justify-center text-white font-bold mr-4">
                                {{ $items['kode_4_digit'] }}
                            </div>
                            <span>{{ $items['judul'] }}</span>
                        </button>
                    </div>
                @endforeach
            </div>
        @endif

        @if ($selectedKode4Digit && !$selectedKode5Digit)
            <div class="w-full max-w-6xl max-h-2xl bg-white p-6 rounded-lg shadow-md mx-auto my-2 font-montserrat">

                {{-- Kembali Ke Daftar Sektor --}}
                <button wire:click="goBack('sector')"
                    class="bg-gray-200 text-gray-800 p-2 rounded-md mb-4 hover:bg-gray-300">
                    Kembali ke Sektor
                </button>

                <h3 class="text-lg font-semibold">{{ $selectedKode4Digit }} - {{ $judul[3] }}</h3>
                <p class="mb-4">{{ $deskripsi[3] }}</p>

                {{-- Daftar Kode Sebelumnya --}}
                <div>
                    <h3 class="text-lg font-semibold">Kategori</h3>
                    <button wire:click="goBack('kode2digit')"
                        class="w-full text-left my-1 bg-gray-100 border border-gray-300 p-3 rounded-lg hover:bg-gray-200 flex items-center">
                        <div
                            class="w-12 h-8 bg-orange-400 rounded-lg flex flex-shrink-0 items-center justify-center text-white font-bold mr-4">
                            {{ $selectedSector }}
                        </div>
                        <span>{{ $judul[0] }}</span>
                    </button>

                    <h3 class="text-lg font-semibold">Golongan Pokok</h3>
                    <button wire:click="goBack('kode3digit')"
                        class="w-full text-left my-1 bg-gray-100 border border-gray-300 p-3 rounded-lg hover:bg-gray-200 flex items-center">
                        <div
                            class="w-12 h-8 bg-orange-400 rounded-lg flex flex-shrink-0 items-center justify-center text-white font-bold mr-4">
                            {{ $selectedKode2Digit }}
                        </div>
                        <span>{{ $judul[1] }}</span>
                    </button>

                    <h3 class="text-lg font-semibold">Golongan</h3>
                    <button wire:click="goBack('kode4digit')"
                        class="w-full text-left my-1 bg-gray-100 border border-gray-300 p-3 rounded-lg hover:bg-gray-200 flex items-center">
                        <div
                            class="w-12 h-8 bg-orange-400 rounded-lg flex flex-shrink-0 items-center justify-center text-white font-bold mr-4">
                            {{ $selectedKode3Digit }}
                        </div>
                        <span>{{ $judul[2] }}</span>
                    </button>
                </div>

                {{-- Daftar Kode Turunan 5 Digit --}}
                <h3 class="text-lg font-semibold">Kelompok</h3>
                @foreach ($kode5Digit as $items)
                    <div>
                        <button wire:click="Digit5Detail('{{ $items['kode_5_digit'] }}')"
                            class="w-full text-left my-1 bg-gray-100 border border-gray-300 p-3 rounded-lg hover:bg-gray-200 flex items-center">
                            <div
                                class="w-12 h-8 bg-orange-400 rounded-lg flex flex-shrink-0 items-center justify-center text-white font-bold mr-4">
                                {{ $items['kode_5_digit'] }}
                            </div>
                            <span>{{ $items['judul'] }}</span>
                        </button>
                    </div>
                @endforeach
            </div>
        @endif

        @if ($selectedKode5Digit)
            <div class="w-full max-w-6xl max-h-2xl bg-white p-6 rounded-lg shadow-md mx-auto my-2 font-montserrat">
                {{-- Kembali Ke Daftar Sektor --}}
                <button wire:click="goBack('sector')"
                    class="bg-gray-200 text-gray-800 p-2 rounded-md mb-4 hover:bg-gray-300">
                    Kembali ke Sektor
                </button>
                @if ($dummySearchResult)
                    <button wire:click="backToSearchResult"
                        class="bg-gray-200 text-gray-800 p-2 rounded-md mb-4 hover:bg-gray-300">
                        Kembali ke Hasil Search
                    </button>
                @endif
                {{-- Kode 5 Digit --}}
                <h3 class="text-lg font-semibold">{{ $selectedKode5Digit }} - {{ $judul[4] }}</h3>
                <p class="mb-4">{{ $deskripsi[4] }}</p>

                {{-- Daftar Kode Sebelumnya --}}
                <div>
                    <h3 class="text-lg font-semibold">Kategori</h3>
                    <button wire:click="goBack('kode2digit')"
                        class="w-full text-left my-1 bg-gray-100 border border-gray-300 p-3 rounded-lg hover:bg-gray-200 flex items-center">
                        <div
                            class="w-12 h-8 bg-orange-400 rounded-lg flex flex-shrink-0 items-center justify-center text-white font-bold mr-4">
                            {{ $selectedSector }}
                        </div>
                        <span>{{ $judul[0] }}</span>
                    </button>

                    <h3 class="text-lg font-semibold">Golongan Pokok</h3>
                    <button wire:click="goBack('kode3digit')"
                        class="w-full text-left my-1 bg-gray-100 border border-gray-300 p-3 rounded-lg hover:bg-gray-200 flex items-center">
                        <div
                            class="w-12 h-8 bg-orange-400 rounded-lg flex flex-shrink-0 items-center justify-center text-white font-bold mr-4">
                            {{ $selectedKode2Digit }}
                        </div>
                        <span>{{ $judul[1] }}</span>
                    </button>

                    <h3 class="text-lg font-semibold">Golongan</h3>
                    <button wire:click="goBack('kode4digit')"
                        class="w-full text-left my-1 bg-gray-100 border border-gray-300 p-3 rounded-lg hover:bg-gray-200 flex items-center">
                        <div
                            class="w-12 h-8 bg-orange-400 rounded-lg flex flex-shrink-0 items-center justify-center text-white font-bold mr-4">
                            {{ $selectedKode3Digit }}
                        </div>
                        <span>{{ $judul[2] }}</span>
                    </button>

                    <h3 class="text-lg font-semibold">Sub Golongan</h3>
                    <button wire:click="goBack('kode5digit')"
                        class="w-full text-left my-1 bg-gray-100 border border-gray-300 p-3 rounded-lg hover:bg-gray-200 flex items-center">
                        <div
                            class="w-12 h-8 bg-orange-400 rounded-lg flex flex-shrink-0 items-center justify-center text-white font-bold mr-4">
                            {{ $selectedKode4Digit }}
                        </div>
                        <span>{{ $judul[3] }}</span>
                    </button>
                </div>
            </div>
        @endif
    @endif

</div>
