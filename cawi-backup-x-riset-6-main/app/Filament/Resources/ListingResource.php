<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ListingResource\Pages;
use App\Filament\Resources\ListingResource\RelationManagers;
use App\Models\Kecamatan;
use App\Models\Listing;
use App\Models\SLS;
use Illuminate\Support\Facades\Http;
use Closure;
use Faker\Provider\ar_EG\Text;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Livewire;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\View;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Reactive;

class ListingResource extends Resource
{
    protected static ?string $model = Listing::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Kuisioner Listing';

    public static ?string $label = 'Kuisioner Listing';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make("Keterangan Tempat")
                        ->schema([
                            Select::make("provinsi")
                                ->label("Provinsi")
                                ->options([
                                    '16' => 'Sumatra Selatan'
                                ])
                                ->default('16')
                                ->disabled()->dehydrated(),
                            Select::make("kab_kota")
                                ->label("Kabupaten/Kota")
                                ->options([
                                    '1602' => "Ogan Komering Ilir",
                                    '1610' => "Ogan Ilir",
                                    '1671' => "Palembang",
                                    '1672' => "Prabumulih"
                                ])
                                // ->default('3172')
                                // ->disabled()->dehydrated()
                                ->reactive(),
                            Select::make("kecamatan")
                                ->label("Kecamatan")
                                ->options(function (callable $get) {
                                    $kabKota = $get('kab_kota');
                                    if (!$kabKota) {
                                        return [];
                                    }
                                    try {
                                        $response = Http::get("https://melpyyhh.github.io/api-wilayah-indonesia/api/districts/{$kabKota}.json");
                                        if ($response->successful()) {
                                            return collect($response->json())
                                                ->map(function ($item) {
                                                    return [
                                                        'id' => $item['id'],
                                                        'name' => Str::title(strtolower($item['name']))
                                                    ];
                                                })
                                                ->pluck('name', 'id')
                                                ->toArray();
                                        }
                                        return [];
                                    } catch (\Exception $e) {
                                        // Handle error - bisa ditambahkan logging disini
                                        return [];
                                    }
                                })
                                // ->default('3172060')
                                // ->disabled()->dehydrated()
                                ->reactive(),
                            Select::make("kel_des")
                                ->label('Kelurahan/Desa')
                                ->options(function (callable $get) {
                                    $kecamatan = $get('kecamatan');
                                    if (!$kecamatan) {
                                        return [];
                                    }
                                    try {
                                        $response = Http::get("https://melpyyhh.github.io/api-wilayah-indonesia/api/villages/{$kecamatan}.json");
                                        if ($response->successful()) {
                                            return collect($response->json())
                                                ->map(function ($item) {
                                                    return [
                                                        'id' => $item['id'],
                                                        'name' => Str::title(strtolower($item['name']))
                                                    ];
                                                })
                                                ->pluck('name', 'id')
                                                ->toArray();
                                        }
                                        return [];
                                    } catch (\Exception $e) {
                                        // Handle error - bisa ditambahkan logging disini
                                        return [];
                                    }
                                })
                                // ->default('3172060001')
                                // ->disabled()->dehydrated()
                                ->reactive(),
                            Select::make('nomor_sls')
                                ->label('Nomor Satuan Lingkungan Setempat (SLS)')
                                ->options(function (callable $get) {
                                    // Ambil team_id berdasarkan user yang login
                                    $teamId = Auth::user()->team_id;
                                    // Query ke tabel SLS berdasarkan team_id
                                    return SLS::where('team_id', $teamId)
                                        ->pluck('sls', 'sls'); // 'value' => 'label'
                                })
                                // ->required()
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                    // Ambil nama SLS berdasarkan nomor SLS yang dipilih
                                    $nomorSls = $get('nomor_sls');
                                    $namaSls = SLS::where('sls', $nomorSls)->value('nm_sls');

                                    // Set nilai nama_sls
                                    $set('nama_sls', $namaSls);
                                }),
                            // ->required(),
                            TextInput::make('nama_sls')
                                ->label('Nama Satuan Lingkungan Setempat (SLS)')
                                ->reactive()
                                ->readOnly()
                            // ->required(),
                        ]),
                    Step::make("Identifikasi BSTT")
                        ->schema([
                            TextInput::make('no_bangunan_fisik')
                                ->label('No. Bangunan Fisik')
                                ->numeric(),
                            TextInput::make('no_bangunan_sensus')
                                ->label('No. Bangunan Sensus')
                                ->numeric(),
                            Radio::make('is_bstt')
                                ->label('Apakah termasuk Bangunan Sensus Tempat Tinggal/Campuran')
                                ->options([
                                    '1' => 'Termasuk',
                                    '2' => 'Tidak'
                                ])
                                ->reactive()
                                ->afterStateUpdated(
                                    fn($state, callable $set) =>
                                    $set('show_nama_bangunan', $state === '2')
                                ),
                            TextInput::make('nama_bangunan')
                                ->label('Nama Bangunan')
                                ->visible(fn(callable $get) => $get('show_nama_bangunan'))
                                ->hint('Wajib Diisi')
                        ]),
                    Step::make("Identifikasi RTUMK")
                        ->hidden(fn(callable $get) => $get('is_bstt') === '2')
                        ->schema([
                            TextInput::make('jml_krt')
                                ->label('Jumlah Kartu Keluarga')
                                ->numeric()
                                ->required(),
                            TextInput::make('jml_pengelolaan_makan')
                                ->label('Identifikasi Jumlah Pengelolaan Makan dalam Satu Bangunan Fisik/Sensus')
                                ->numeric()
                                ->required(),
                            TextInput::make('no_urut_rt')
                                ->label('No. Urut Rumah Tangga')
                                ->numeric(),
                            TextInput::make('nama_krt')
                                ->label('Nama Kepala Rumah Tangga')
                                ->required()
                                ->rules(['regex:/^[^0-9]*$/'])
                                ->hint('Gunakan Huruf Kapital'),
                            Textarea::make('alamat_bangunan')
                                ->label('Alamat')
                                ->hint('Gunakan Huruf Kapital')
                                ->required(),
                            Radio::make('is_lebih_dari_1_bulan')
                                ->label('Apakah usaha tersebut sudah berdiri sejak satu bulan yang lalu?')
                                ->required()
                                ->options([
                                    '1' => 'Ya',
                                    '0' => 'Tidak',
                                ])
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $set) {
                                    if ($state === '0') {
                                        $set('is_eligible_rtumk', 2); // Tidak eligible jika usaha belum lebih dari 1 bulan
                                        $set('jumlah_usaha_eligible', null); // Reset jumlah usaha eligible
                                    }
                                }),
                            TextInput::make('jumlah_usaha')
                                ->label('Berapa Jumlah Usaha yang yang telah berjalan minimal satu bulan')
                                ->numeric()
                                ->visible(fn(callable $get) => $get('is_lebih_dari_1_bulan') === '1')
                                ->required(),
                            TextInput::make('jumlah_usaha_eligible')
                                ->label('Dari usaha yang dimiliki tersebut  ,Berapa Jumlah Usaha yang memiliki rata-rata hasil penjualan kurang dari 1.25 Miliar Rupiah atau modal kurang dari 420 Juta Rupiah per bulan ?')
                                ->visible(fn(callable $get) => $get('is_lebih_dari_1_bulan') === '1')
                                ->afterStateUpdated(function ($state, callable $set) {
                                    if ($state < 1) {
                                        $set('is_eligible_rtumk', 2); // Tidak
                                    } else {
                                        $set('is_eligible_rtumk', 1); // Ya
                                    }
                                })
                                ->reactive(),
                            Radio::make('is_eligible_rtumk')
                                ->label('Termasuk Eligible RTUMK')
                                ->reactive()
                                ->options([
                                    1 => 'Ya',
                                    2 => 'Tidak'
                                ])
                                ->default(2)
                                ->disabled()
                        ]),
                    Step::make('Identifikasi Eligible Ruta')
                        ->schema([
                            Radio::make('is_ekonomi_lingkungan_1')
                                ->label('Apakah dari UMK Non-AOT tersebut ada usaha yang menghasilkan produk ramah lingkungan atau jasa untuk perlindungan lingkungan, seperti jasa pengelolaan sampah ?')
                                ->options([
                                    '1' => 'Ya',
                                    '0' => 'Tidak',
                                ])
                                ->afterStateUpdated(function ($set, $get) {
                                    self::calculateEligibility($set, $get);
                                })
                                ->reactive()
                                ->required(fn($get) => $get('is_eligible') === '1')
                                ->visible(fn($get) => $get('is_eligible') === '1'),
                            Radio::make('is_ekonomi_lingkungan_2')
                                ->label('Apakah dari UMK Non-AOT tersebut mengeluarkan biaya untuk produk atau layanan ramah lingkungan, produk menunjang perlindungan, atau jasa pengelolaan sampah ?')
                                ->options([
                                    '1' => 'Ya',
                                    '0' => 'Tidak',
                                ])
                                ->afterStateUpdated(function ($set, $get) {
                                    self::calculateEligibility($set, $get);
                                })
                                ->reactive()
                                ->required(fn($get) => $get('is_eligible') === '1')
                                ->visible(fn($get) => $get('is_eligible') === '1'),
                            Radio::make('is_ekonomi_kreatif_1')
                                ->label('Apakah ada UMK Non-AOT yang termasuk ekraf ?]')
                                ->options([
                                    '1' => 'Ya',
                                    '0' => 'Tidak',
                                ])
                                ->afterStateUpdated(function ($set, $get) {
                                    self::calculateEligibility($set, $get);
                                })
                                ->reactive()
                                ->required(fn($get) => $get('is_eligible') === '1')
                                ->visible(fn($get) => $get('is_eligible') === '1'),
                            Radio::make('is_ekonomi_digital_1')
                                ->label('Apakah internet digunakan dalam melakukan komunikasi dengan pelanggan / pencarian informasi / pemasokan bahan baku / produksi / penjualan produk / pemasaran produknya ?')
                                ->options([
                                    '1' => 'Ya',
                                    '0' => 'Tidak',
                                ])
                                ->afterStateUpdated(function ($set, $get) {
                                    self::calculateEligibility($set, $get);
                                })
                                ->reactive()
                                ->required(fn($get) => $get('is_eligible') === '1')
                                ->visible(fn($get) => $get('is_eligible') === '1'),

                        ]),
                    Step::make('Ringkasan Eligible')
                        ->schema([
                            Radio::make('is_ekonomi_lingkungan_eligible')
                                ->label('Sampel eligible menerapkan aktivitas ekonomi lingkungan')
                                ->options([
                                    '2' => 'Ya',
                                    '1' => 'Tidak',
                                ])
                                ->disabled()->dehydrated() // Tidak bisa diubah langsung oleh pengguna
                                ->reactive()
                                ->default('1')
                                ->required(fn($get) => $get('is_eligible') === '1')
                                ->visible(fn($get) => $get('is_eligible') === '1'),
                            Radio::make('is_ekonomi_digital_eligible')
                                ->label('Sampel eligible ekonomi digital')
                                ->options([
                                    '3' => 'Ya',
                                    '1' => 'Tidak',
                                ])
                                ->disabled()->dehydrated() // Tidak bisa diubah langsung oleh pengguna
                                ->reactive()
                                ->default('1')
                                ->required(fn($get) => $get('is_eligible') === '1')
                                ->visible(fn($get) => $get('is_eligible') === '1'),
                            Radio::make('is_ekonomi_kreatif_eligible')
                                ->label('Sampel eligible ekonomi kreatif')
                                ->options([
                                    '5' => 'Ya',
                                    '1' => 'Tidak',
                                ])
                                ->disabled()->dehydrated() // Tidak bisa diubah langsung oleh pengguna
                                ->reactive()
                                ->default('1')
                                ->required(fn($get) => $get('is_eligible') === '1')
                                ->visible(fn($get) => $get('is_eligible') === '1'),

                        ]),
                    Step::make('Koordinat dan Foto')
                        ->schema([
                            Grid::make(2)
                                ->schema([
                                    TextInput::make('latitude')
                                        ->label("Latitude")
                                        ->numeric()
                                        ->extraAttributes([
                                            'wire:model.defer' => 'data.latitude',
                                            'x-ref' => 'latitude',
                                        ]),
                                    TextInput::make('longitude')
                                        ->label('Longitude')
                                        ->numeric()
                                        ->extraAttributes([
                                            'wire:model.defer' => 'data.longitude',
                                            'x-ref' => 'longitude',
                                        ]),
                                ]),
                            Actions::make([
                                Action::make('ambilLokasi')
                                    ->label('Ambil Lokasi')
                                    ->action(fn() => null)
                                    ->extraAttributes([
                                        'x-on:click' => 'getLocation()'
                                    ])
                            ]),
                            View::make('components.leaflet-map')
                                ->extraAttributes([
                                    'class' => 'w-full h-96 rounded-lg border border-gray-300',
                                    'wire:ignore' => true,
                                ])
                                ->reactive(),
                            Grid::make(2)
                                ->schema([
                                    TextInput::make('backup_latitude')
                                        ->label("Latitude Backup")
                                        ->numeric(),
                                    TextInput::make('backup_longitude')
                                        ->label('Backup Longitude')
                                        ->numeric(),
                                ]),
                            FileUpload::make('gambar_rumah')
                                ->label('Upload Gambar Rumah')
                                ->image()
                                ->maxSize(1024)
                                ->required(),
                            Textarea::make('catatan')
                                ->label('Catatan'),
                        ])
                        ->extraAttributes([
                            'x-data' => '{
                                map: null,
                                marker: null,
                                streetLayer: null,
                                satelliteLayer: null,

                                initializeMap() {
                                    this.$nextTick(() => {
                                        if (!this.map) {
                                            // Initialize map dengan center Indonesia
                                            this.map = L.map("map-container").setView([-3.4, 105.1], 9);

                                            // Create layers
                                            this.streetLayer = L.tileLayer("https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}", {
                                                maxZoom: 20,
                                                subdomains: ["mt0", "mt1", "mt2", "mt3"],
                                                attribution: "&copy; Google Maps"
                                            }).addTo(this.map);

                                            this.satelliteLayer = L.tileLayer("https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}", {
                                                maxZoom: 20,
                                                subdomains: ["mt0", "mt1", "mt2", "mt3"]
                                            });

                                            // Add layer control
                                            const baseMaps = {
                                                "Streets": this.streetLayer,
                                                "Satellite": this.satelliteLayer
                                            };

                                            L.control.layers(baseMaps).addTo(this.map);

                                            // Handle map click events
                                            this.map.on("click", (e) => {
                                                const { lat, lng } = e.latlng;
                                                this.updateLocation(lat, lng);
                                            });
                                        }
                                    });
                                },

                                updateLocation(lat, lng) {
                                    // Update input fields
                                    this.$refs.latitude.value = lat;
                                    this.$refs.longitude.value = lng;

                                    // Update Livewire model
                                    this.$wire.set("data.latitude", lat);
                                    this.$wire.set("data.longitude", lng);

                                    // Update or create marker
                                    if (this.marker) {
                                        this.marker.setLatLng([lat, lng]);
                                    } else {
                                        this.marker = L.marker([lat, lng]).addTo(this.map);
                                    }

                                    // Center map and zoom in
                                    this.map.setView([lat, lng], 17);
                                },

                                getLocation() {
                                    if (!navigator.geolocation) {
                                        alert("Geolocation tidak didukung oleh browser ini.");
                                        return;
                                    }

                                    navigator.geolocation.getCurrentPosition(
                                        (position) => {
                                            const lat = position.coords.latitude;
                                            const lng = position.coords.longitude;

                                            this.updateLocation(lat, lng);

                                            alert("Lokasi berhasil diambil!");
                                        },
                                        (error) => {
                                            alert("Gagal mendapatkan lokasi: " + error.message);
                                        },
                                        {
                                            enableHighAccuracy: true,
                                            timeout: 5000,
                                            maximumAge: 0
                                        }
                                    );
                                }
                            }'
                        ])
                ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_provinsi')->label('Provinsi'),
                TextColumn::make('nama_kabupaten')->label('Kabupaten'),
                TextColumn::make('nama_kecamatan')->label('Kecamatan')
                    ->sortable(),
                TextColumn::make('nama_kelurahan')->label('Kelurahan')
                    ->sortable(),
                TextColumn::make('nomor_sls')->label('Nomor SLS')
                    ->sortable(),
                TextColumn::make('nama_sls')->label('Nama SLS')
                    ->sortable(),
                TextColumn::make('no_bangunan_fisik')->label('Nomor Bangunan Fisik')
                    ->sortable(),
                TextColumn::make('no_bangunan_sensus')->label('Nomor Bangunan Sensus')
                    ->sortable(),
                TextColumn::make('nama_KRT')->label('Nama Kepala Rumah Tangga')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListListings::route('/'),
            'create' => Pages\CreateListing::route('/create'),
            'edit' => Pages\EditListing::route('/{record}/edit'),
        ];
    }

    protected static function calculateEligibility($set, $get): void
    {
        $isHighIncome = $get('is_rata_pendapatan_kotor') === '1';
        $isHighCapital = $get('is_rata_modal_usaha') === '1';
        $isRentingLand = $get('is_modal_sewa_tanah') === '1';
        $noEconomicActivity =
            $get('is_usaha') === '0' &&
            $get('is_jualan') === '0' &&
            $get('is_jasa') === '0';

        if ($isHighIncome && $isHighCapital && $isRentingLand) {
            $set('is_eligible', '0');
        } elseif ($noEconomicActivity) {
            $set('is_eligible', '0');
        } else {
            $set('is_eligible', '1');
        }

        $isLingkunganEligible1 = $get('is_ekonomi_lingkungan_1') === '1';
        $isLingkunganEligible2 = $get('is_ekonomi_lingkungan_2') === '1';
        $isLingkunganEligible3 = $get('is_ekonomi_lingkungan_3') === '1';

        if ($isLingkunganEligible1 || $isLingkunganEligible2 || $isLingkunganEligible3) {
            $set('is_ekonomi_lingkungan_eligible', '2');
        } else {
            $set('is_ekonomi_lingkungan_eligible', '1');
        }

        $isDigitalEligible = $get('is_ekonomi_digital_1') === '1';

        if ($isDigitalEligible) {
            $set('is_ekonomi_digital_eligible', '3');
        } else {
            $set('is_ekonomi_digital_eligible', '1');
        }

        $isKreatifEligible = $get('is_ekonomi_kreatif_1') === '1';

        if ($isKreatifEligible) {
            $set('is_ekonomi_kreatif_eligible', '5');
        } else {
            $set('is_ekonomi_kreatif_eligible', '1');
        }
    }
}
