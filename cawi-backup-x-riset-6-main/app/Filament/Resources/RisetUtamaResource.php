<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RisetUtamaResource\Pages;
use App\Models\RisetUtama;
use Illuminate\Support\Facades\Http;
use Filament\Forms;
use Filament\Forms\Components\Radio;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Forms\Components\Fieldset;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextArea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Set;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Forms\Get;
use App\Models\Kecamatan;
use Illuminate\Support\Str;
use \Illuminate\Support\HtmlString;

class RisetUtamaResource extends Resource
{
    protected static ?string $model = RisetUtama::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Kuisioner Riset Utama';

    public static ?string $label = 'Kuisioner Riset Utama';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('BLOK I. KETERANGAN TEMPAT')
                        ->icon('heroicon-o-map')
                        ->schema([
                            Section::make('100')
                                ->columns(1)
                                ->schema([
                                    DatePicker::make('tanggal_pencacahan')
                                        ->label('a. Tanggal Pencacahan')
                                        ->displayFormat('d-m-Y')
                                    //->required()
                                    ,

                                    TimePicker::make('waktu_mulai_pencacahan')
                                        ->label('b. Jam Mulai Wawancara')
                                        //->required()
                                        ->format('H:i:s'),

                                    TimePicker::make('waktu_selesai_pencacahan')
                                        ->label('c. Jam Selesai Wawancara')
                                        //->required()
                                        ->format('H:i:s')
                                        ->after('waktu_mulai_pencacahan'),
                                ]),

                            Section::make('101')
                                ->schema([
                                    Select::make('provinsi')
                                        ->label('Provinsi')
                                        ->options([
                                            '16' => 'SUMATERA SELATAN'
                                        ])
                                        ->default('16')
                                        ->disabled()
                                    // ->required()
                                ])
                                ->columns(1),

                            // 102. Kabupaten/Kota
                            Section::make('102')
                                ->schema([
                                    Select::make('kab_kota')
                                        ->label('Kabupaten/Kota')
                                        ->options([
                                            '1602' => 'Ogan Komering Ilir',
                                            '1610' => 'Ogan Ilir',
                                            '1671' => 'Palembang',
                                            '1672' => 'Prabumulih'
                                        ])
                                        ->reactive()
                                    // ->required()
                                ])
                                ->columns(1),

                            // 103. Kecamatan
                            Section::make('103')
                                ->schema([
                                    Select::make('kecamatan')
                                        ->label('Kecamatan')
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
                                                return [];
                                            }
                                        })
                                        ->reactive()
                                    // ->required()
                                ])
                                ->columns(1),

                            // 104. Kelurahan/Desa
                            Section::make('104')
                                ->schema([
                                    Select::make('kel_des')
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
                                                return [];
                                            }
                                        })
                                        ->reactive()
                                    // ->required()
                                ])
                                ->columns(1),

                            // 105. Nomor SLS
                            Section::make('105')
                                ->schema([
                                    Select::make('nomor_sls')
                                        ->label('Nomor Satuan Lingkungan Setempat (SLS)')
                                        ->options(function (callable $get) {
                                            $kelurahan = $get('kelurahan');
                                            $blokSensus = [
                                                '1602010001' => [
                                                    'BS01' => 'Blok Sensus 01',
                                                    'BS02' => 'Blok Sensus 02',
                                                ],
                                                '1602010002' => [
                                                    'BS03' => 'Blok Sensus 03',
                                                    'BS04' => 'Blok Sensus 04',
                                                ],
                                            ];
                                            return $blokSensus[$kelurahan] ?? [];
                                        })
                                        ->reactive()
                                    // ->required()
                                ])
                                ->columns(1),

                            // 106. Nama SLS
                            Section::make('106')
                                ->schema([
                                    TextInput::make('nama_sls')
                                        ->label('Nama Satuan Lingkungan Setempat (SLS)')
                                    // ->required()
                                ])
                                ->columns(1),

                            // 107. Nomor Urut Sampel
                            Section::make('107')
                                ->schema([
                                    TextInput::make('nomor_urut_sampel_pencacahan')
                                        ->label('Nomor Urut Sampel (NUS) Pencacahan')
                                        ->maxLength(3)
                                    // ->required()
                                ])
                                ->columns(1),

                            // 108. Jumlah UMK Selain Kategori "A", "O", atau "T" dalam RTU
                            Section::make('108')
                                ->schema([
                                    TextInput::make('jumlah_umk_selain_aot')
                                        ->label('Jumlah UMK Selain Kategori "A", "O", atau "T" dalam RTU')
                                        ->maxLength(2)
                                    // ->required()
                                ])
                                ->columns(1),

                            // 109. Nama Lengkap Usaha
                            Section::make('109')
                                ->schema([
                                    TextInput::make('nama_lengkap_usaha')
                                        ->label('Nama Lengkap Usaha')
                                        ->maxLength(255)
                                    // ->required()
                                ])
                                ->columns(1),

                            Section::make('110')
                                ->schema([
                                    Textarea::make('alamat_lengkap_usaha')
                                        ->label('a. Alamat Lengkap Usaha')
                                    // ->required()
                                    ,

                                    Grid::make(3)
                                        ->schema([
                                            TextInput::make('rt')
                                                ->label('RT')
                                                //->required()
                                                ->maxLength(3),
                                            TextInput::make('rw')
                                                ->label('RW')
                                                //->required()
                                                ->maxLength(3),
                                            TextInput::make('kode_pos')
                                                ->label('Kode Pos')
                                                //->required()
                                                ->maxLength(5),
                                        ]),

                                    TextInput::make('telepon_hp')
                                        ->label('b. Telepon/HP')
                                        ->tel()
                                        ->prefix('628')
                                        ->helperText('Gunakan format 628xxxxx (12-14 digit)')
                                        //->required()
                                        ->maxLength(15),

                                    TextInput::make('faksimile')
                                        ->label('c. Faksimile')
                                    // ->required()
                                    ,

                                    TextInput::make('email')
                                        ->label('d. E-Mail')
                                        //->required()
                                        ->email(),

                                    TextInput::make('website')
                                        ->label('e. Website')
                                        //->required()
                                        ->url(),
                                ]),
                        ]),

                    Step::make('BLOK II. KETERANGAN PEMBERI JAWABAN DAN PETUGAS')
                        ->icon('heroicon-o-users')
                        ->schema([
                            // Uraian 201: Nama
                            Section::make('201')
                                ->columns(1)
                                ->schema([
                                    TextInput::make('nama_responden')
                                        ->label('Nama Responden')
                                        //->required()
                                        ->maxLength(255),

                                    TextInput::make('nama_pencacah')
                                        ->label('Nama Pencacah')
                                        //->required()
                                        ->maxLength(255),

                                    TextInput::make('nama_koordinator')
                                        ->label('Nama Koordinator Tim')
                                        //->required()
                                        ->maxLength(255),
                                ]),

                            // Uraian 202: Telepon/HP
                            Section::make('202')
                                ->columns(1)
                                ->schema([
                                    TextInput::make('telepon_hp_responden')
                                        ->label('Telepon/HP Responden')
                                        ->tel()
                                        ->prefix('628')
                                        //->required()
                                        ->helperText('Gunakan format 628xxxxx (12-14 digit)')
                                        ->maxLength(14)
                                        ->regex('/^628\d{9,12}$/'),

                                    TextInput::make('telepon_hp_pencacah')
                                        ->label('Telepon/HP Pencacah')
                                        ->tel()
                                        ->prefix('628')
                                        //->required()
                                        ->helperText('Gunakan format 628xxxxx (12-14 digit)')
                                        ->maxLength(14)
                                        ->regex('/^628\d{9,12}$/'),

                                    TextInput::make('telepon_hp_koordinator')
                                        ->label('Telepon/HP  Tim')
                                        ->tel()
                                        ->prefix('628')
                                        //->required()
                                        ->helperText('Gunakan format 628xxxxx (12-14 digit)')
                                        ->maxLength(14)
                                        ->regex('/^628\d{9,12}$/'),
                                ]),

                            // Uraian 203: NIM
                            Section::make('203')
                                ->columns(1)
                                ->schema([
                                    TextInput::make('nim_pencacah')
                                        ->label('NIM Pencacah')
                                        //->required()
                                        ->maxLength(9)
                                        ->helperText('Harus diawali dengan 2222, 2122, 2121, 2221, 1122, atau 1121')
                                        ->regex('/^(2222|2122|2121|2221|1122|1121)\d{4}$/'),

                                    TextInput::make('nim_koordinator')
                                        ->label('NIM Koordinator Tim')
                                        //->required()
                                        ->maxLength(9)
                                        ->helperText('Harus diawali dengan 1122 atau 1121')
                                        ->regex('/^(1122|1121)\d{4}$/'),
                                ]),
                        ]),

                    Step::make('BLOK III. KARAKTERISTIK USAHA')
                        ->icon('heroicon-o-building-storefront')
                        ->schema([
                            Section::make('301')
                                ->schema([
                                    Placeholder::make('')
                                        ->content('Pengusaha atau Penanggung Jawab Usaha'),

                                    TextInput::make('nama_pemilik_usaha')
                                        ->label('a. Nama')
                                        //->required()
                                        ->maxLength(255),

                                    Radio::make('jenis_kelamin_pemilik')
                                        ->label('b. Jenis Kelamin')
                                        ->options([
                                            '1' => 'Laki-laki',
                                            '2' => 'Perempuan'
                                        ])
                                    //->required()
                                    ,

                                    TextInput::make('umur_pemilik')
                                        ->label('c. Umur')
                                        //->required()
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(150)
                                        ->suffix('tahun')
                                        ->helperText('(dibulatkan ke bawah)'),

                                    Select::make('pendidikan_pemilik')
                                        ->label('d. Jenjang Pendidikan Tertinggi yang Ditamatkan')
                                        ->options([
                                            '1' => 'Tidak Tamat SD',
                                            '2' => 'SD dan Sederajat',
                                            '3' => 'SMP dan Sederajat',
                                            '4' => 'SMA dan Sederajat',
                                            '5' => 'Perguruan Tinggi'
                                        ])
                                    //->required()
                                    ,
                                ])
                                ->columns(1),

                            Section::make('302 ')
                                ->schema([
                                    Textarea::make('jenis_kegiatan_utama')
                                        ->label('a. Tuliskan secara lengkap jenis kegiatan utama')
                                        //->required()
                                        ->helperText(new HtmlString('
                                        <div class="space-y-3 text-sm">
                                            <p class="text-base">Untuk usaha yang mempunyai kegiatan:</p>

                                            <div class="space-y-2 ml-4">
                                                <p class="font-medium">1. Pemeriksaan kegiatan diamati berdasarkan:</p>
                                                <p class="font-small">- Kegiatan yang nilai produksinya/omsetnya/pendapatannya terbesar</p>
                                                <p class="font-small">- Jika butir 1 sama besar, maka penentuan berdasarkan waktu terbesar</p>
                                                <p class="font-small">- Jika butir 1 dan 2 sama besar, maka penentuan berdasarkan bahan baku terbesar</p>
                                                <p class="font-small">-  Jika butir 1, 2, dan 3 sama besar, maka penentuan oleh responden</p>
                                            </div>

                                            <div>
                                                <p class="flex gap-1 items-start">
                                                    <span class="font-medium">Catatan:</span>
                                                    <span>Khusus usaha "bengkel" dan "salon", ditentukan berdasarkan natural/biasa.</span>
                                                </p>
                                            </div>
                                        </div>
                                        '))
                                        ->rows(3),

                                    grid::make(1)
                                        ->schema([
                                            TextInput::make('kategori_kbli')
                                                ->label('b. Kategori')
                                                //->required()
                                                ->maxLength(1),

                                            TextInput::make('kode_kbli')
                                                ->label('c. Kode KBLI')
                                                //->required()
                                                ->helperText('(diisi oleh petugas)')
                                                ->maxLength(5),
                                        ]),
                                ])
                                ->columns(1),

                            Section::make('303')
                                ->schema([
                                    Textarea::make('produk_utama')
                                        ->label('a. Produk utama (barang atau jasa) yang dihasilkan/dijual')
                                        //->required()
                                        ->rows(2),

                                    Radio::make('klasifikasi_produk')
                                        ->label('b. Klasifikasi produk utama')
                                        ->options([
                                            '1' => 'Barang',
                                            '2' => 'Jasa'
                                        ])
                                    //->required()
                                    ,
                                ])
                                ->columns(1),

                            Section::make('304')
                                ->schema([
                                    Select::make('jenis_usaha')
                                        ->label('Apa jenis usaha ini?')
                                        ->options([
                                            '1' => 'Usaha di dalam bangunan tempat tinggal',
                                            '2' => 'Usaha keliling',
                                            '3' => 'Usaha di luar bangunan tempat tinggal dengan lokasi tetap dan perlengkapan usaha dipindah/dibongkar pasang',
                                            '4' => 'Usaha konstruksi-perorangan, usaha pertambangan, dan penggalian perorangan',
                                            '5' => 'Usaha persewaan rumah/kantor'
                                        ])
                                    //->required()
                                    ,
                                ])
                                ->columns(1),

                            Section::make('305')
                                ->schema([
                                    TextInput::make('bulan_tahun_mulai_operasi')
                                        ->label('Bulan dan Tahun Mulai Beroperasi Secara Komersial')
                                        //->required()
                                        ->placeholder('MM/YYYY')
                                        ->mask('99/9999'),
                                ])
                                ->columns(1),

                            Section::make('306')
                                ->schema([
                                    Radio::make('status_badan_usaha')
                                        ->label('a. Status Badan Usaha')
                                        ->options([
                                            '1' => 'Berbadan Usaha',
                                            '2' => 'Tidak Berbadan Usaha'
                                        ])
                                        ->reactive(),

                                    Placeholder::make('')
                                        ->content('b. Rincian Badan Usaha')
                                        ->visible(fn(Get $get) => $get('status_badan_usaha') === '1')
                                        ->reactive(),

                                    Radio::make('memiliki_akta_usaha')
                                        ->label('1) Apakah usaha ini mempunyai akta atau surat keterangan usaha?')
                                        ->options([
                                            '1' => 'Ya',
                                            '2' => 'Tidak'
                                        ])
                                        ->visible(fn(Get $get) => $get('status_badan_usaha') === '1')
                                        ->reactive(),


                                    Radio::make('anggota_asosiasi')
                                        ->label('2) Apakah usaha ini menjadi anggota asosiasi?')
                                        ->options([
                                            '1' => 'Ya',
                                            '2' => 'Tidak'
                                        ])
                                        ->visible(fn(Get $get) => $get('status_badan_usaha') === '1')
                                        ->reactive(),

                                    TextInput::make('nama_asosiasi')
                                        ->label('3) Apa nama asosiasinya?')
                                        ->reactive()
                                        ->visible(fn(Get $get) => $get('anggota_asosiasi') === '1'),

                                    Radio::make('anggota_koperasi')
                                        ->label('4) Apakah usaha ini sedang menjadi anggota koperasi?')
                                        ->options([
                                            '1' => 'Ya',
                                            '2' => 'Tidak'
                                        ])
                                        ->visible(fn(Get $get) => $get('anggota_asosiasi') === '2')
                                        ->reactive(),

                                    CheckboxList::make('pelayanan_koperasi')
                                        ->label('5) Jenis pelayanan dari koperasi yang pernah diterima usaha ini? (pilih semua jawaban yang sesuai)')
                                        ->options([
                                            'pinjaman' => 'Pinjaman uang/barang modal',
                                            'pengadaan' => 'Pengadaan bahan baku/barang dagangan',
                                            'pemasaran' => 'Pemasaran',
                                            'bimbingan' => 'Bimbingan/pelatihan/penyuluhan',
                                            'lainnya' => 'Lainnya, sebutkan:'
                                        ])
                                        ->visible(fn(Get $get) => $get('anggota_koperasi') === '1')
                                        ->reactive(),

                                    TextInput::make('pelayanan_koperasi_lainnya')
                                        ->label('Sebutkan:')
                                        ->reactive()
                                        ->visible(fn(Get $get) => in_array('lainnya', (array) $get('pelayanan_koperasi')) && $get('anggota_koperasi') === '1'),
                                ])
                                ->columns(1)
                                ->reactive()
                        ]),

                    Step::make('BLOK IV. KENDALA DAN PROSPEK USAHA')
                        ->icon('heroicon-o-chart-bar-square')
                        ->schema([
                            Section::make('401')
                                ->schema([
                                    CheckboxList::make('kendala_usaha')
                                        ->label('Dalam setahun terakhir, apa kendala yang dialami [nama usaha]? (pilih semua jawaban yang sesuai)')
                                        ->options([
                                            'kendala_permodalan' => 'Permodalan/likuiditas',
                                            'kendala_bahan_baku' => 'Bahan baku/barang dagangan',
                                            'kendala_pemasaran' => 'Pemasaran',
                                            'kendala_bbm_energi' => 'Bahan Bakar Minyak (BBM) dan energi',
                                            'kendala_infrastruktur' => 'Infrastruktur (jalan, air, komunikasi, dan lainnya)',
                                            'kendala_tenaga_kerja' => 'Tenaga kerja',
                                            'kendala_peraturan_birokrasi' => 'Peraturan dan birokrasi pemerintah',
                                            'kendala_pungli' => 'Pungutan liar',
                                            'kendala_pesaing' => 'Adanya pesaing',
                                            'kendala_lainnya' => 'Lainnya, sebutkan:'
                                        ])->reactive(),

                                    TextInput::make('kendala_lainnya_tuliskan')
                                        ->label('Sebutkan:')
                                        ->maxLength(255)
                                        ->reactive()
                                        ->visible(fn(Get $get) => in_array('kendala_lainnya', (array) $get('kendala_usaha'))),
                                ])
                                ->reactive()
                                ->columns(1),

                            Section::make('402')
                                ->schema([
                                    Radio::make('pernah_terima_kredit')
                                        ->label('a. Dalam sebulan terakhir, apakah [nama usaha] pernah menerima kredit di lembaga keuangan?')
                                        ->options([
                                            '1' => 'Pernah',
                                            '2' => 'Tidak Pernah'
                                        ])
                                        // ->required()
                                        ->reactive(),

                                    Radio::make('alasan_tidak_terima_kredit')
                                        ->label('b. Maka alasan utamanya adalah:')
                                        ->options([
                                            '1' => 'Tidak tahu prosedur',
                                            '2' => 'Prosedur sulit',
                                            '3' => 'Tidak ada agunan',
                                            '4' => 'Suku bunga tinggi',
                                            '5' => 'Usulan ditolak',
                                            '6' => 'Lainnya'
                                        ])
                                        ->visible(fn(Get $get) => $get('pernah_terima_kredit') === '2')
                                        // ->required(fn(Get $get) => $get('pernah_terima_kredit') === '2')
                                        ->reactive(),

                                    TextInput::make('alasan_tidak_terima_kredit_lainnya')
                                        ->label('Lainnya, sebutkan:')
                                        ->maxLength(255)
                                        ->reactive()
                                        ->visible(fn(Get $get) => $get('alasan_tidak_terima_kredit') === '6' && $get('pernah_terima_kredit') === '2')
                                    // ->required(fn(Get $get) => $get('alasan_tidak_terima_kredit') === '6' && $get('pernah_terima_kredit') === '2')
                                    ,
                                ]),

                            Section::make('403')
                                ->schema([
                                    Radio::make('prospek_usaha')
                                        ->label('Bagaimana prospek usaha ini pada masa yang akan datang?')
                                        ->options([
                                            '1' => 'Lebih baik',
                                            '2' => 'Sama baik',
                                            '3' => 'Sama buruk',
                                            '4' => 'Lebih buruk'
                                        ])
                                    // ->required()
                                    ,
                                ]),

                            Section::make('404')
                                ->schema([
                                    Radio::make('rencana_pengembangan')
                                        ->label('a. Apakah [nama pengusaha] ada rencana untuk mengembangkan/memperluas usaha ini pada masa yang akan datang?')
                                        ->options([
                                            '1' => 'Ya',
                                            '2' => 'Tidak'
                                        ])
                                        // ->required()
                                        ->reactive(),

                                    CheckboxList::make('rencana_pengembangan_perluas')
                                        ->label('b. Rencana yang akan dilakukan? (pilih semua jawaban yang sesuai)')
                                        ->options([
                                            'rencana_perluas_tempat' => 'Memperluas tempat usaha',
                                            'rencana_buka_cabang' => 'Membuka cabang',
                                            'rencana_tingkatkan_keahlian' => 'Meningkatkan keahlian',
                                            'rencana_diversifikasi' => 'Diversifikasi (penganekaragaman) produk',
                                            'rencana_lainnya' => 'Lainnya, sebutkan:'
                                        ])
                                        ->visible(fn(Get $get) => $get('rencana_pengembangan') === '1')
                                        ->reactive(),

                                    TextInput::make('rencana_lainnya_tuliskan')
                                        ->label('Sebutkan:')
                                        ->reactive()
                                        ->visible(fn(Get $get) => in_array('rencana_lainnya', (array) $get('rencana_pengembangan_perluas')) && $get('rencana_pengembangan') === '1'),


                                    Radio::make('alasan_tidak_kembang')
                                        ->label('c. Maka alasan utama adalah:')
                                        ->options([
                                            '1' => 'Kekurangan modal',
                                            '2' => 'Kesulitan pemasaran',
                                            '3' => 'Kurang keahlian',
                                            '4' => 'Lainnya'
                                        ])
                                        ->visible(fn(Get $get) => $get('rencana_pengembangan') === '2')
                                        // ->required(fn(Get $get) => $get('rencana_pengembangan') === '2')
                                        ->reactive(),

                                    TextInput::make('alasan_tidak_kembang_lainnya')
                                        ->label('Lainnya, sebutkan:')
                                        ->maxLength(255)
                                        ->reactive()
                                        ->visible(fn(Get $get) => $get('alasan_tidak_kembang') === '4' && $get('rencana_pengembangan') === '2')
                                    // ->required(fn(Get $get) => $get('alasan_tidak_kembang') === '4' && $get('rencana_pengembangan') === '2')
                                    ,
                                ]),
                        ]),

                        Step::make('BLOK V. KETENAGAKERJAAN')
                        ->icon('heroicon-o-user-group') // Icon representing employment/workforce
                        ->schema([
                            Section::make('501')
                                ->schema([
                                    Placeholder::make('')
                                        ->content('Dalam satu bulan, berapa rata-rata banyaknya pekerja tetap dan tidak tetap? (termasuk pemilik usaha)'),
                                    grid::make(1)
                                        ->schema([
                                            TextInput::make('pekerja_tetap')
                                                ->label('a. Pekerja Tetap')
                                                ->suffix('orang')
                                                ->numeric()
                                                ->minValue(0)
                                                // ->required()
                                                ->helperText('Masukkan jumlah pekerja tetap (termasuk pemilik usaha)'),

                                            TextInput::make('pekerja_tidak_tetap')
                                                ->label('b. Pekerja Tidak Tetap')
                                                ->suffix('orang')
                                                ->numeric()
                                                ->minValue(0)
                                                // ->required()
                                                ->helperText('Masukkan jumlah pekerja tidak tetap'),
                                        ]),
                                ]),

                            Section::make('502')
                                ->schema([
                                    Placeholder::make('')
                                        ->content('Selama sebulan terakhir atau bulan terakhir yang ada kegiatannya, berapa banyaknya tenaga kerja tetap dan tidak tetap menurut jenjang pendidikan yang ditamatkan, kelompok umur, dan jenis kelamin?'),

                                    Section::make('1. Jenjang Pendidikan')
                                       ->schema([
                                           TextInput::make('pendidikan.tidak_tamat_sd.tetap')
                                               ->label('Tidak Tamat SD - Tetap')
                                               ->numeric()
                                               ->minValue(0)
                                               ->live()
                                               ->afterStateUpdated(function (Set $set, Get $get) {
                                                   $total_tetap = array_sum([
                                                       $get('pendidikan.tidak_tamat_sd.tetap') ?? 0,
                                                       $get('pendidikan.sd.tetap') ?? 0,
                                                       $get('pendidikan.smp.tetap') ?? 0,
                                                       $get('pendidikan.sma.tetap') ?? 0,
                                                       $get('pendidikan.pt.tetap') ?? 0
                                                   ]);
                                                   $set('pendidikan.total_tetap', $total_tetap);
                                               }),

                                           TextInput::make('pendidikan.tidak_tamat_sd.tidak_tetap')
                                               ->label('Tidak Tamat SD - Tidak Tetap')
                                               ->numeric()
                                               ->minValue(0)
                                               ->live()
                                               ->afterStateUpdated(function (Set $set, Get $get) {
                                                   $total_tidak_tetap = array_sum([
                                                       $get('pendidikan.tidak_tamat_sd.tidak_tetap') ?? 0,
                                                       $get('pendidikan.sd.tidak_tetap') ?? 0,
                                                       $get('pendidikan.smp.tidak_tetap') ?? 0,
                                                       $get('pendidikan.sma.tidak_tetap') ?? 0,
                                                       $get('pendidikan.pt.tidak_tetap') ?? 0
                                                   ]);
                                                   $set('pendidikan.total_tidak_tetap', $total_tidak_tetap);
                                               }),

                                           TextInput::make('pendidikan.sd.tetap')
                                               ->label('SD - Tetap')
                                               ->numeric()
                                               ->minValue(0)
                                               ->live()
                                               ->afterStateUpdated(function (Set $set, Get $get) {
                                                   $total_tetap = array_sum([
                                                       $get('pendidikan.tidak_tamat_sd.tetap') ?? 0,
                                                       $get('pendidikan.sd.tetap') ?? 0,
                                                       $get('pendidikan.smp.tetap') ?? 0,
                                                       $get('pendidikan.sma.tetap') ?? 0,
                                                       $get('pendidikan.pt.tetap') ?? 0
                                                   ]);
                                                   $set('pendidikan.total_tetap', $total_tetap);
                                               }),

                                           TextInput::make('pendidikan.sd.tidak_tetap')
                                               ->label('SD - Tidak Tetap')
                                               ->numeric()
                                               ->minValue(0)
                                               ->live()
                                               ->afterStateUpdated(function (Set $set, Get $get) {
                                                   $total_tidak_tetap = array_sum([
                                                       $get('pendidikan.tidak_tamat_sd.tidak_tetap') ?? 0,
                                                       $get('pendidikan.sd.tidak_tetap') ?? 0,
                                                       $get('pendidikan.smp.tidak_tetap') ?? 0,
                                                       $get('pendidikan.sma.tidak_tetap') ?? 0,
                                                       $get('pendidikan.pt.tidak_tetap') ?? 0
                                                   ]);
                                                   $set('pendidikan.total_tidak_tetap', $total_tidak_tetap);
                                               }),

                                           TextInput::make('pendidikan.smp.tetap')
                                               ->label('SMP - Tetap')
                                               ->numeric()
                                               ->minValue(0)
                                               ->live()
                                               ->afterStateUpdated(function (Set $set, Get $get) {
                                                   $total_tetap = array_sum([
                                                       $get('pendidikan.tidak_tamat_sd.tetap') ?? 0,
                                                       $get('pendidikan.sd.tetap') ?? 0,
                                                       $get('pendidikan.smp.tetap') ?? 0,
                                                       $get('pendidikan.sma.tetap') ?? 0,
                                                       $get('pendidikan.pt.tetap') ?? 0
                                                   ]);
                                                   $set('pendidikan.total_tetap', $total_tetap);
                                               }),

                                           TextInput::make('pendidikan.smp.tidak_tetap')
                                               ->label('SMP - Tidak Tetap')
                                               ->numeric()
                                               ->minValue(0)
                                               ->live()
                                               ->afterStateUpdated(function (Set $set, Get $get) {
                                                   $total_tidak_tetap = array_sum([
                                                       $get('pendidikan.tidak_tamat_sd.tidak_tetap') ?? 0,
                                                       $get('pendidikan.sd.tidak_tetap') ?? 0,
                                                       $get('pendidikan.smp.tidak_tetap') ?? 0,
                                                       $get('pendidikan.sma.tidak_tetap') ?? 0,
                                                       $get('pendidikan.pt.tidak_tetap') ?? 0
                                                   ]);
                                                   $set('pendidikan.total_tidak_tetap', $total_tidak_tetap);
                                               }),

                                           TextInput::make('pendidikan.sma.tetap')
                                               ->label('SMA - Tetap')
                                               ->numeric()
                                               ->minValue(0)
                                               ->live()
                                               ->afterStateUpdated(function (Set $set, Get $get) {
                                                   $total_tetap = array_sum([
                                                       $get('pendidikan.tidak_tamat_sd.tetap') ?? 0,
                                                       $get('pendidikan.sd.tetap') ?? 0,
                                                       $get('pendidikan.smp.tetap') ?? 0,
                                                       $get('pendidikan.sma.tetap') ?? 0,
                                                       $get('pendidikan.pt.tetap') ?? 0
                                                   ]);
                                                   $set('pendidikan.total_tetap', $total_tetap);
                                               }),

                                           TextInput::make('pendidikan.sma.tidak_tetap')
                                               ->label('SMA - Tidak Tetap')
                                               ->numeric()
                                               ->minValue(0)
                                               ->live()
                                               ->afterStateUpdated(function (Set $set, Get $get) {
                                                   $total_tidak_tetap = array_sum([
                                                       $get('pendidikan.tidak_tamat_sd.tidak_tetap') ?? 0,
                                                       $get('pendidikan.sd.tidak_tetap') ?? 0,
                                                       $get('pendidikan.smp.tidak_tetap') ?? 0,
                                                       $get('pendidikan.sma.tidak_tetap') ?? 0,
                                                       $get('pendidikan.pt.tidak_tetap') ?? 0
                                                   ]);
                                                   $set('pendidikan.total_tidak_tetap', $total_tidak_tetap);
                                               }),

                                           TextInput::make('pendidikan.pt.tetap')
                                               ->label('Perguruan Tinggi - Tetap')
                                               ->numeric()
                                               ->minValue(0)
                                               ->live()
                                               ->afterStateUpdated(function (Set $set, Get $get) {
                                                   $total_tetap = array_sum([
                                                       $get('pendidikan.tidak_tamat_sd.tetap') ?? 0,
                                                       $get('pendidikan.sd.tetap') ?? 0,
                                                       $get('pendidikan.smp.tetap') ?? 0,
                                                       $get('pendidikan.sma.tetap') ?? 0,
                                                       $get('pendidikan.pt.tetap') ?? 0
                                                   ]);
                                                   $set('pendidikan.total_tetap', $total_tetap);
                                               }),

                                           TextInput::make('pendidikan.pt.tidak_tetap')
                                               ->label('Perguruan Tinggi - Tidak Tetap')
                                               ->numeric()
                                               ->minValue(0)
                                               ->live()
                                               ->afterStateUpdated(function (Set $set, Get $get) {
                                                   $total_tidak_tetap = array_sum([
                                                       $get('pendidikan.tidak_tamat_sd.tidak_tetap') ?? 0,
                                                       $get('pendidikan.sd.tidak_tetap') ?? 0,
                                                       $get('pendidikan.smp.tidak_tetap') ?? 0,
                                                       $get('pendidikan.sma.tidak_tetap') ?? 0,
                                                       $get('pendidikan.pt.tidak_tetap') ?? 0
                                                   ]);
                                                   $set('pendidikan.total_tidak_tetap', $total_tidak_tetap);
                                               }),

                                           TextInput::make('pendidikan.total_tetap')
                                               ->label('Total Pekerja Tetap')
                                               ->numeric()
                                               ->disabled()
                                               ->live()
                                               ->dehydrated(false)
                                               ->validationAttribute('Total Pekerja Tetap')
                                               ->rules([
                                                    function () {
                                                        return function ($attribute, $value, $fail) {
                                                            $pekerja_tetap_501 = request()->input('pekerja_tetap');
                                                            if ($value != $pekerja_tetap_501) {
                                                                $fail("Total pekerja tetap harus sama dengan jumlah di bagian 501");
                                                            }
                                                        };
                                                    }
                                               ]),

                                           TextInput::make('pendidikan.total_tidak_tetap')
                                               ->label('Total Pekerja Tidak Tetap')
                                               ->numeric()
                                               ->disabled()
                                               ->live()
                                               ->dehydrated(false)
                                               ->validationAttribute('Total Pekerja Tidak Tetap')
                                               ->rules([
                                                    function () {
                                                        return function ($attribute, $value, $fail) {
                                                            $pekerja_tidak_tetap_501 = request()->input('pekerja_tidak_tetap');
                                                            if ($value != $pekerja_tidak_tetap_501) {
                                                                $fail("Total pekerja tidak tetap harus sama dengan jumlah di bagian 501");
                                                            }
                                                        };
                                                    }
                                               ]),
                                       ]),

                                    Section::make('2. Kelompok Umur')
                                        ->schema([
                                            // Kurang dari 15 tahun
                                            TextInput::make('umur.kurang_15.tetap')
                                                ->label('Kurang dari 15 Tahun - Tetap')
                                                ->numeric()
                                                ->minValue(0)
                                                ->live()
                                                ->afterStateUpdated(function (Set $set, Get $get) {
                                                    $total = array_sum([
                                                        $get('umur.kurang_15.tetap'),
                                                        $get('umur.15_64.tetap'),
                                                        $get('umur.lebih_64.tetap')
                                                    ]);
                                                    $set('umur.total_tetap', $total);
                                                }),

                                            TextInput::make('umur.kurang_15.tidak_tetap')
                                                ->label('Kurang dari 15 Tahun - Tidak Tetap')
                                                ->numeric()
                                                ->minValue(0)
                                                ->live()
                                                ->afterStateUpdated(function (Set $set, Get $get) {
                                                    $total = array_sum([
                                                        $get('umur.kurang_15.tidak_tetap'),
                                                        $get('umur.15_64.tidak_tetap'),
                                                        $get('umur.lebih_64.tidak_tetap')
                                                    ]);
                                                    $set('umur.total_tidak_tetap', $total);
                                                }),

                                            // 15-64 tahun
                                            TextInput::make('umur.15_64.tetap')
                                                ->label('15-64 Tahun - Tetap')
                                                ->numeric()
                                                ->minValue(0)
                                                ->live()
                                                ->afterStateUpdated(function (Set $set, Get $get) {
                                                    $total = array_sum([
                                                        $get('umur.kurang_15.tetap'),
                                                        $get('umur.15_64.tetap'),
                                                        $get('umur.lebih_64.tetap')
                                                    ]);
                                                    $set('umur.total_tetap', $total);
                                                }),

                                            TextInput::make('umur.15_64.tidak_tetap')
                                                ->label('15-64 Tahun - Tidak Tetap')
                                                ->numeric()
                                                ->minValue(0)
                                                ->live()
                                                ->afterStateUpdated(function (Set $set, Get $get) {
                                                    $total = array_sum([
                                                        $get('umur.kurang_15.tidak_tetap'),
                                                        $get('umur.15_64.tidak_tetap'),
                                                        $get('umur.lebih_64.tidak_tetap')
                                                    ]);
                                                    $set('umur.total_tidak_tetap', $total);
                                                }),

                                            // Lebih dari 64 tahun
                                            TextInput::make('umur.lebih_64.tetap')
                                                ->label('Lebih dari 64 Tahun - Tetap')
                                                ->numeric()
                                                ->minValue(0)
                                                ->live()
                                                ->afterStateUpdated(function (Set $set, Get $get) {
                                                    $total = array_sum([
                                                        $get('umur.kurang_15.tetap'),
                                                        $get('umur.15_64.tetap'),
                                                        $get('umur.lebih_64.tetap')
                                                    ]);
                                                    $set('umur.total_tetap', $total);
                                                }),

                                            TextInput::make('umur.lebih_64.tidak_tetap')
                                                ->label('Lebih dari 64 Tahun - Tidak Tetap')
                                                ->numeric()
                                                ->minValue(0)
                                                ->live()
                                                ->afterStateUpdated(function (Set $set, Get $get) {
                                                    $total = array_sum([
                                                        $get('umur.kurang_15.tidak_tetap'),
                                                        $get('umur.15_64.tidak_tetap'),
                                                        $get('umur.lebih_64.tidak_tetap')
                                                    ]);
                                                    $set('umur.total_tidak_tetap', $total);
                                                }),

                                            TextInput::make('umur.total_tetap')
                                                ->label('Total Pekerja Tetap')
                                                ->numeric()
                                                ->disabled()
                                                ->live()
                                                ->dehydrated(false)
                                                ->validationAttribute('Total Pekerja Tetap')
                                                ->rules([
                                                     function () {
                                                         return function ($attribute, $value, $fail) {
                                                             $pekerja_tetap_501 = request()->input('pekerja_tetap');
                                                             if ($value != $pekerja_tetap_501) {
                                                                 $fail("Total pekerja tetap harus sama dengan jumlah di bagian 501");
                                                             }
                                                         };
                                                     }
                                                ]),

                                            TextInput::make('umur.total_tidak_tetap')
                                                ->label('Total Pekerja Tidak Tetap')
                                                ->numeric()
                                                ->disabled()
                                                ->live()
                                                ->dehydrated(false)
                                                ->validationAttribute('Total Pekerja Tidak Tetap')
                                                ->rules([
                                                     function () {
                                                         return function ($attribute, $value, $fail) {
                                                             $pekerja_tidak_tetap_501 = request()->input('pekerja_tidak_tetap');
                                                             if ($value != $pekerja_tidak_tetap_501) {
                                                                 $fail("Total pekerja tidak tetap harus sama dengan jumlah di bagian 501");
                                                             }
                                                         };
                                                     }
                                                ]),
                                        ]),

                                    // Bagian Jenis Kelamin
                                    Section::make('3. Jenis Kelamin')
                                        ->schema([
                                            TextInput::make('kelamin.laki_laki.tetap')
                                                ->label('Laki-laki - Tetap')
                                                ->numeric()
                                                ->minValue(0)
                                                ->live()
                                                ->afterStateUpdated(function (Set $set, Get $get) {
                                                    $total = ($get('kelamin.laki_laki.tetap') ?? 0) + ($get('kelamin.perempuan.tetap') ?? 0);
                                                    $set('kelamin.total_tetap', $total);
                                                }),

                                            TextInput::make('kelamin.laki_laki.tidak_tetap')
                                                ->label('Laki-laki - Tidak Tetap')
                                                ->numeric()
                                                ->minValue(0)
                                                ->live()
                                                ->afterStateUpdated(function (Set $set, Get $get) {
                                                    $total = ($get('kelamin.laki_laki.tidak_tetap') ?? 0) + ($get('kelamin.perempuan.tidak_tetap') ?? 0);
                                                    $set('kelamin.total_tidak_tetap', $total);
                                                }),

                                            TextInput::make('kelamin.perempuan.tetap')
                                                ->label('Perempuan - Tetap')
                                                ->numeric()
                                                ->minValue(0)
                                                ->live()
                                                ->afterStateUpdated(function (Set $set, Get $get) {
                                                    $total = ($get('kelamin.laki_laki.tetap') ?? 0) + ($get('kelamin.perempuan.tetap') ?? 0);
                                                    $set('kelamin.total_tetap', $total);
                                                }),

                                            TextInput::make('kelamin.perempuan.tidak_tetap')
                                                ->label('Perempuan - Tidak Tetap')
                                                ->numeric()
                                                ->minValue(0)
                                                ->live()
                                                ->afterStateUpdated(function (Set $set, Get $get) {
                                                    $total = ($get('kelamin.laki_laki.tidak_tetap') ?? 0) + ($get('kelamin.perempuan.tidak_tetap') ?? 0);
                                                    $set('kelamin.total_tidak_tetap', $total);
                                                }),

                                            TextInput::make('kelamin.total_tetap')
                                                ->label('Total Pekerja Tetap')
                                                ->numeric()
                                                ->disabled()
                                                ->live()
                                                ->dehydrated(false)
                                                ->validationAttribute('Total Pekerja Tetap')
                                                ->rules([
                                                     function () {
                                                         return function ($attribute, $value, $fail) {
                                                             $pekerja_tetap_501 = request()->input('pekerja_tetap');
                                                             if ($value != $pekerja_tetap_501) {
                                                                 $fail("Total pekerja tetap harus sama dengan jumlah di bagian 501");
                                                             }
                                                         };
                                                     }
                                                ]),

                                            TextInput::make('kelamin.total_tidak_tetap')
                                                ->label('Total Pekerja Tidak Tetap')
                                                ->numeric()
                                                ->disabled()
                                                ->live()
                                                ->dehydrated(false)
                                                ->validationAttribute('Total Pekerja Tidak Tetap')
                                                ->rules([
                                                     function () {
                                                         return function ($attribute, $value, $fail) {
                                                             $pekerja_tidak_tetap_501 = request()->input('pekerja_tidak_tetap');
                                                             if ($value != $pekerja_tidak_tetap_501) {
                                                                 $fail("Total pekerja tidak tetap harus sama dengan jumlah di bagian 501");
                                                             }
                                                         };
                                                     }
                                                ]),
                                        ]),
                                ]),


                            Section::make('503')
                                ->schema([
                                    TextInput::make('hari_operasional')
                                        ->label('a. Dalam satu pekan, berapa hari operasional untuk berusaha?')
                                        // ->required()
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(7)
                                        ->suffix('hari')
                                        ->step(1),

                                    TextInput::make('rata_rata_jam_kerja')
                                        ->label('b. Dalam satu hari, berapa rata-rata jam kerja operasional usaha?')
                                        // ->required()
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(24)
                                        ->suffix('jam')
                                        ->step(0.5)
                                ]),

                            Section::make('504')
                                ->schema([
                                    Radio::make('pernah_pelatihan_al')
                                        ->label('a. Setahun yang lalu, apakah usaha ini pernah/sedang mengikuti penyuluhan/pelatihan/bimbingan terkait aktivitas lingkungan yang melibatkan pekerja?')
                                        ->helperText('contoh: penyuluhan cara pengolahan limbah hasil produksi, pelatihan mendaur ulang plastik sisa')
                                        ->options([
                                            '1' => 'Ya',
                                            '2' => 'Tidak'
                                        ])
                                        // ->required()
                                        ->reactive(),

                                    TextInput::make('jumlah_pekerja_pelatihan_al')
                                        ->label('b. Setahun yang lalu, Berapa jumlah pekerja (termasuk pemilik) yang pernah/sedang mengikuti enyuluhan/pelatihan/bimbingan aktivitas lingkungan?')
                                        ->numeric()
                                        ->minValue(0)
                                        ->suffix('orang')
                                        ->reactive()
                                        ->visible(fn(Get $get) => $get('pernah_pelatihan_al') === '1')
                                    // ->required(fn(Get $get) => $get('pernah_pelatihan_ti') === '1')
                                ]),

                            Section::make('505')
                                ->schema([
                                    Radio::make('pernah_pelatihan_ti')
                                        ->label('a. Sampai saat ini, apakah usaha ini pernah/sedang mengikuti pelatihan terkait pemanfaatan teknologi digital yang melibatkan pekerja?')
                                        ->helperText('contoh: pelatihan pemasaran/promosi online, penggunaan marketplace seperti shopee. gojek, dll')
                                        ->options([
                                            '1' => 'Ya',
                                            '2' => 'Tidak'
                                        ])
                                        ->reactive(),

                                    Fieldset::make('b. Pelatihan Teknologi Digital')
                                        ->schema([
                                            TextInput::make('jumlah_pelatihan_pemerintah')
                                                ->label('b.1. Jumlah pelatihan teknologi digital dari pemerintah')
                                                ->numeric()
                                                ->minValue(0)
                                                ->suffix('kali')
                                                ->reactive(),

                                            TextInput::make('jumlah_pelatihan_swasta')
                                                ->label('b.2. Jumlah pelatihan teknologi digital dari swasta')
                                                ->numeric()
                                                ->minValue(0)
                                                ->suffix('kali')
                                                ->reactive()
                                        ])
                                        ->visible(fn(Get $get) => $get('pernah_pelatihan_ti') === '1'),

                                    TextInput::make('jumlah_pekerja_pelatihan_ti')
                                        ->label('c. Sampai saat ini, Berapa jumlah pekerja (termasuk pemilik) yang telah mengikuti pelatihan teknologi digital?')
                                        ->numeric()
                                        ->minValue(0)
                                        ->suffix('orang')
                                        ->reactive()
                                        ->visible(fn(Get $get) => $get('pernah_pelatihan_ti') === '1')
                                ]),

                            Section::make('506')
                                ->schema([
                                    TextInput::make('jumlah_pekerja_komputer_internet')
                                        ->label('Banyaknya tenaga kerja yang rutin menggunakan perangkat komputer yang terhubung internet dalam pekerjaannya (termasuk PC, laptop, notebook, tablet)')
                                        // ->required()
                                        ->numeric()
                                        ->minValue(0)
                                        ->suffix('orang'),
                                ]),
                        ]),

                    Step::make('BLOK VI. Output')
                        ->icon('heroicon-o-building-office')
                        ->schema([
                            Section::make('601')
                                ->schema([
                                    Fieldset::make('a. Tuliskan produk yang dijual, produk yang disimpan sebagai stok, produk yang digunakan sendiri, dan produk yang diberikan kepada pihak lain ( sebulan yang lalu )')
                                        ->schema([
                                            Repeater::make('produk_list')
                                                ->label('Daftar Produk')
                                                ->schema([
                                                    TextInput::make('semua_produk')
                                                        ->label('Produk')
                                                        ->placeholder('Masukkan nama produk')
                                                        // ->required()
                                                        ,

                                                    TextInput::make('nilai_produk')
                                                        ->label('Nilai (Rupiah)')
                                                        ->numeric()
                                                        // ->required()
                                                        ->live() // Memastikan perubahan langsung bereaksi
                                                ])
                                                ->addAction(fn($action) => $action->label('Tambah Produk'))
                                                ->afterStateUpdated(function ($state, $set) {
                                                    $totalNilai = collect($state)->sum('nilai_produk');
                                                    $set('total_nilai_produk', $totalNilai);
                                                }),

                                            TextInput::make('total_nilai_produk')
                                                ->label('Total Nilai Produk (Rupiah)')
                                                ->numeric()
                                                ->readOnly()
                                        ]),

                                    Fieldset::make('b. Tuliskan produk yang dijual, tidak termasuk produk yang disimpan sebagai stok, produk yang digunakan sendiri, dan produk yang diberikan kepada pihak lain ( sebulan yang lalu )')
                                        ->schema([
                                            Repeater::make('sold_produk_list')
                                                ->label('Daftar Produk')
                                                ->schema([
                                                    TextInput::make('semua_sold_produk')
                                                        ->label('Produk')
                                                        ->placeholder('Masukkan nama produk')
                                                        // ->required()
                                                        ,

                                                    TextInput::make('nilai_sold_produk')
                                                        ->label('Nilai (Rupiah)')
                                                        ->numeric()
                                                        // ->required()
                                                        ->live() // Memastikan perubahan langsung bereaksi
                                                ])
                                                ->addAction(fn($action) => $action->label('Tambah Produk'))
                                                ->afterStateUpdated(function ($state, $set) {
                                                    $totalNilai = collect($state)->sum('nilai_produk');
                                                    $set('total_nilai_produk', $totalNilai);
                                                }),

                                            TextInput::make('total_nilai_sold_produk')
                                                ->label('Total Nilai Produk (Rupiah)')
                                                ->numeric()
                                                ->readOnly()
                                        ]),

                                    TextInput::make('laba_usaha')
                                        ->label('c. Sebulan yang lalu, berapa laba atau keuntungan yang diperoleh')
                                        ->numeric()
                                        ->minValue(0)
                                        ->prefix('RP')
                                        ->reactive(),

                                    TextInput::make('rata_rata_jumlah_transaksi')
                                        ->label('d. Dalam satu pekan, berapa rata-rata jumlah transaksi dalam usaha ini?')
                                        ->numeric()
                                        ->minValue(0)
                                        ->suffix('kali')
                                        ->reactive(),

                                    Radio::make('diskon_atau_retur')
                                        ->label('e. Apakah isian pada R601.b sudah dipotong dengan pemberian diskon atau menerima retur dari konsumen?')
                                        ->options([
                                            '1' => 'Ya',
                                            '2' => 'Tidak'
                                        ])
                                        ->reactive(),

                                    TextInput::make('potongan_atau_kerugian')
                                        ->label('f. Berapa besaran potongan dari diskon atau kerugian akibat retur yang dilakukan?')
                                        ->numeric()
                                        ->minValue(0)
                                        ->prefix('RP')
                                        ->reactive()
                                        ->visible(fn(Get $get) => $get('diskon_atau_retur') === '1'),

                                    TextInput::make('omzet_usaha')
                                        ->label('g. Pada dua bulan yang lalu, berapa total omzet yang diterima usaha ini?')
                                        ->numeric()
                                        ->minValue(0)
                                        ->prefix('RP')
                                        ->reactive(),
                                ]),

                            Section::make('602')
                                ->schema([
                                    Placeholder::make('sales_percentage_label')
                                        ->label('Selama setahun yang lalu, persentase nilai barang/jasa dijual ke:'),

                                    TextInput::make('persentase_penjualan_dalam_wilayah')
                                        ->label('a. Dalam wilayah asal (kabupaten/kota)')
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->suffix('%')
                                        ->live()
                                        ->afterStateUpdated(function (Get $get, Set $set) {
                                            $dalam = (float) ($get('persentase_penjualan_dalam_wilayah') ?? 0);
                                            $luar = (float) ($get('persentase_penjualan_luar_wilayah') ?? 0);
                                            if ($dalam + $luar !== 100) {
                                                $set('persentase_penjualan_luar_wilayah', 100 - $dalam);
                                            }
                                        }),

                                    TextInput::make('persentase_penjualan_luar_wilayah')
                                        ->label('b. Luar wilayah asal')
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->suffix('%')
                                        ->live()
                                        ->afterStateUpdated(function (Get $get, Set $set) {
                                            $dalam = (float) ($get('persentase_penjualan_dalam_wilayah') ?? 0);
                                            $luar = (float) ($get('persentase_penjualan_luar_wilayah') ?? 0);
                                            if ($dalam + $luar !== 100) {
                                                $set('persentase_penjualan_dalam_wilayah', 100 - $luar);
                                            }
                                        }),

                                    Placeholder::make('total_persentase')
                                        ->label('Jumlah')
                                        ->content(function (Get $get): string {
                                            $dalam = (float) ($get('persentase_penjualan_dalam_wilayah') ?? 0);
                                            $luar = (float) ($get('persentase_penjualan_luar_wilayah') ?? 0);
                                            return $dalam + $luar . '%';
                                        }),

                                    Placeholder::make('penjualan_ke_label')
                                        ->label('c. Penjualan ke'),

                                    TextInput::make('penjualan_konsumen_akhir')
                                        ->label('c1. Konsumen Akhir')
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->suffix('%')
                                        ->live()
                                        ->afterStateUpdated(function (Get $get, Set $set) {
                                            $this->validateTotalPercentage($get, $set);
                                        }),

                                    TextInput::make('penjualan_pedagang_eceran')
                                        ->label('c2. Pedagang Eceran')
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->suffix('%')
                                        ->live()
                                        ->afterStateUpdated(function (Get $get, Set $set) {
                                            $this->validateTotalPercentage($get, $set);
                                        }),

                                    TextInput::make('penjualan_pedagang_besar')
                                        ->label('c3. Pedagang Besar')
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->suffix('%')
                                        ->live()
                                        ->afterStateUpdated(function (Get $get, Set $set) {
                                            $this->validateTotalPercentage($get, $set);
                                        }),

                                    TextInput::make('penjualan_industri_komersial')
                                        ->label('c4. Industri dan Pelaku Komersial Lainnya')
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->suffix('%')
                                        ->live()
                                        ->afterStateUpdated(function (Get $get, Set $set) {
                                            $this->validateTotalPercentage($get, $set);
                                        }),

                                    TextInput::make('penjualan_institusi_pemerintah')
                                        ->label('c5. Institusi Pemerintah')
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->suffix('%')
                                        ->live()
                                        ->afterStateUpdated(function (Get $get, Set $set) {
                                            $this->validateTotalPercentage($get, $set);
                                        }),

                                    Placeholder::make('total_penjualan_berdasarkan_konsumen')
                                        ->label('Jumlah Total')
                                        ->content(function (Get $get): string {
                                            $total =
                                                (float) ($get('penjualan_konsumen_akhir') ?? 0) +
                                                (float) ($get('penjualan_pedagang_eceran') ?? 0) +
                                                (float) ($get('penjualan_pedagang_besar') ?? 0) +
                                                (float) ($get('penjualan_industri_komersial') ?? 0) +
                                                (float) ($get('penjualan_institusi_pemerintah') ?? 0);
                                            return $total . '%';
                                        })
                                ])
                        ]),

                        Step::make('BLOK VII. PENGELUARAN KEGIATAN USAHA')
                        ->icon('heroicon-o-currency-dollar')
                        ->schema([
                            Section::make('701')
                                ->schema([
                                Section::make('a. Tuliskan bahan baku utama, bahan baku penolong/lainnya, dan bahan energi yang digunakan (sebulan yang lalu)')
                                    ->schema([
                                    Section::make('1. Bahan Baku Utama')
                                        ->schema([
                                            Repeater::make('bahan_baku_utama')
                                                ->schema([
                                                    Grid::make(2)
                                                        ->schema([
                                                            TextInput::make('nama_bahan')
                                                                ->label('Nama Bahan')
                                                                ->columnSpan(1)
                                                                ->maxLength(255),

                                                            TextInput::make('nilai')
                                                                ->label('Nilai (Rupiah)')
                                                                ->numeric()
                                                                ->prefix('Rp')
                                                                ->columnSpan(1),
                                                        ]),
                                                ])
                                                ->columns(1)
                                                ->maxItems(6)
                                                ->defaultItems(1)
                                                ->addActionLabel('Tambah Bahan Baku')
                                                ->reorderableWithButtons(),
                                        ]),

                                    Section::make('2. Bahan Energi')
                                        ->schema([
                                            Repeater::make('bahan_energi')
                                                ->schema([
                                                    Grid::make(2)
                                                        ->schema([
                                                            TextInput::make('nama_bahan')
                                                                ->label('Nama Bahan')
                                                                ->columnSpan(1)
                                                                ->maxLength(255),

                                                            TextInput::make('nilai')
                                                                ->label('Nilai (Rupiah)')
                                                                ->numeric()
                                                                ->prefix('Rp')
                                                                ->columnSpan(1),
                                                        ]),
                                                ])
                                                ->columns(1)
                                                ->maxItems(6)
                                                ->defaultItems(1)
                                                ->addActionLabel('Tambah Bahan Energi')
                                                ->reorderableWithButtons(),
                                        ]),
                                    ]),
                                ]),
                            Section::make('702. Sebulan yang lalu, berapa persentase bahan baku utama/penolong/lainnya yang digunakan berasal dari:')
                                ->schema([

                                    TextInput::make('persentase_bahan_baku_dalam_wilayah')
                                        ->label('a. Dalam wilayah asal (kabupaten/kota)')
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->suffix('%')
                                        ->live()
                                        ->afterStateUpdated(function (Get $get, Set $set) {
                                            $dalam = (float) ($get('persentase_bahan_baku_dalam_wilayah') ?? 0);
                                            $luar = (float) ($get('persentase_bahan_baku_luar_wilayah') ?? 0);
                                            if ($dalam + $luar !== 100) {
                                                $set('persentase_bahan_baku_luar_wilayah', 100 - $dalam);
                                            }
                                        }),

                                    TextInput::make('persentase_bahan_baku_luar_wilayah')
                                        ->label('b. Luar wilayah asal')
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->suffix('%')
                                        ->live()
                                        ->afterStateUpdated(function (Get $get, Set $set) {
                                            $dalam = (float) ($get('persentase_bahan_baku_dalam_wilayah') ?? 0);
                                            $luar = (float) ($get('persentase_bahan_baku_luar_wilayah') ?? 0);
                                            if ($dalam + $luar !== 100) {
                                                $set('persentase_bahan_baku_dalam_wilayah', 100 - $luar);
                                            }
                                        }),

                                    Placeholder::make('total_persentase')
                                        ->label('Jumlah')
                                        ->content(function (Get $get): string {
                                            $dalam = (float) ($get('persentase_bahan_baku_dalam_wilayah') ?? 0);
                                            $luar = (float) ($get('persentase_bahan_baku_luar_wilayah') ?? 0);
                                            return $dalam + $luar . '%';
                                        }),
                                ]),
                            Section::make('703')
                                ->schema([
                                    TextInput::make('rata_rata_biaya_pekerja')
                                        ->label('Dalam sebulan, berapa rata-rata biaya untuk balas jasa pekerja tetap dan tidak tetap?')
                                        ->numeric()
                                        ->minValue(0)
                                        ->prefix('RP')
                                        ->reactive(),
                                ]),
                            Section::make('704')
                                ->schema([
                                    TextInput::make('rata_rata_biaya_internet')
                                        ->label('Dalam sebulan, berapa rata-rata biaya untuk internet dalam kegiatan usaha?')
                                        ->numeric()
                                        ->minValue(0)
                                        ->prefix('RP')
                                        ->reactive(),
                                ]),
                        ]),
                    Step::make('BLOK VIII. MODAL USAHA')
                        ->icon('heroicon-o-banknotes')
                        ->schema([
                            Section::make('801. Komposisi Permodalan Usaha')
                                ->schema([
                                    Placeholder::make('')
                                        ->content('(Diisi dengan modal usaha yang digunakan sejak awal pendirian usaha)'),
                                    TextInput::make('modal.milik_sendiri')
                                        ->label('a. Milik Sendiri')
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->suffix('%')
                                        ->live()
                                        ->afterStateUpdated(function (Get $get, Set $set) {
                                            $total = 0;
                                            $fields = ['milik_sendiri', 'pinjaman_bank', 'pinjaman_lembaga', 'pinjaman_perorangan'];
                                            foreach ($fields as $field) {
                                                $total += (float) ($get("modal.{$field}") ?? 0);
                                            }
                                            if ($total > 100) {
                                                $set('modal.milik_sendiri', 100 - ($total - (float) ($get('modal.milik_sendiri') ?? 0)));
                                            }
                                        }),

                                    TextInput::make('modal.pinjaman_bank')
                                        ->label('b. Pinjaman dari bank')
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->suffix('%')
                                        ->live()
                                        ->afterStateUpdated(function (Get $get, Set $set) {
                                            $total = 0;
                                            $fields = ['milik_sendiri', 'pinjaman_bank', 'pinjaman_lembaga', 'pinjaman_perorangan'];
                                            foreach ($fields as $field) {
                                                $total += (float) ($get("modal.{$field}") ?? 0);
                                            }
                                            if ($total > 100) {
                                                $set('modal.pinjaman_bank', 100 - ($total - (float) ($get('modal.pinjaman_bank') ?? 0)));
                                            }
                                        }),

                                    TextInput::make('modal.pinjaman_lembaga')
                                        ->label('c. Pinjaman/penyertaan modal dari lembaga keuangan bukan bank (koperasi, modal ventura, PNM Mekaar)')
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->suffix('%')
                                        ->live()
                                        ->afterStateUpdated(function (Get $get, Set $set) {
                                            $total = 0;
                                            $fields = ['milik_sendiri', 'pinjaman_bank', 'pinjaman_lembaga', 'pinjaman_perorangan'];
                                            foreach ($fields as $field) {
                                                $total += (float) ($get("modal.{$field}") ?? 0);
                                            }
                                            if ($total > 100) {
                                                $set('modal.pinjaman_lembaga', 100 - ($total - (float) ($get('modal.pinjaman_lembaga') ?? 0)));
                                            }
                                        }),

                                    TextInput::make('modal.pinjaman_perorangan')
                                        ->label('d. Pinjaman dari perorangan, keluarga, dan lainnya')
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->suffix('%')
                                        ->live()
                                        ->afterStateUpdated(function (Get $get, Set $set) {
                                            $total = 0;
                                            $fields = ['milik_sendiri', 'pinjaman_bank', 'pinjaman_lembaga', 'pinjaman_perorangan'];
                                            foreach ($fields as $field) {
                                                $total += (float) ($get("modal.{$field}") ?? 0);
                                            }
                                            if ($total > 100) {
                                                $set('modal.pinjaman_perorangan', 100 - ($total - (float) ($get('modal.pinjaman_perorangan') ?? 0)));
                                            }
                                        }),
                                    Placeholder::make('modal.total')
                                        ->label('Jumlah')
                                        ->content(function (Get $get): string {
                                            $total = 0;
                                            $fields = ['milik_sendiri', 'pinjaman_bank', 'pinjaman_lembaga', 'pinjaman_perorangan'];
                                            foreach ($fields as $field) {
                                                $total += (float) ($get("modal.{$field}") ?? 0);
                                            }
                                            return $total . '%';
                                        }),
                                ]),
                            Section::make('802. Jumlah dan frekuensi penggunaan mesin dan peralatan')
                                ->schema([
                                    Placeholder::make('')
                                        ->content('Tuliskan nama mesin/peralatan yang digunakan. Beri remark jika tidak ada mesin/peralatan yang digunakan'),
                                    Repeater::make('daftar_mesin_peralatan')
                                        ->schema([
                                            Grid::make(3)
                                                ->schema([
                                                    TextInput::make('nama_mesin')
                                                        ->label('Nama Mesin dan Peralatan')
                                                        ->columnSpan(1)
                                                        ->maxLength(255),

                                                    TextInput::make('jumlah')
                                                        ->label('Jumlah (dalam unit)')
                                                        ->numeric()
                                                        ->minValue(0)
                                                        ->columnSpan(1),

                                                    TextInput::make('frekuensi_penggunaan')
                                                        ->label('Frekuensi Penggunaan (Jam per Pekan)')
                                                        ->numeric()
                                                        ->minValue(0)
                                                        ->maxValue(168)
                                                        ->columnSpan(1),
                                                ]),
                                        ])
                                        ->columns(1)
                                        ->maxItems(10)
                                        ->defaultItems(1)
                                        ->addActionLabel('Tambah Mesin/Peralatan')
                                        ->reorderableWithButtons()
                                        ->reactive(),
                                ]),
                        ]),
                    // Step::make('BLOK IX. PRODUKSI')
                    //     ->icon('heroicon-o-shopping-cart')
                    //     ->schema([
                    //         Section::make('901')
                    //             ->schema([
                    //                 Placeholder::make('')
                    //                     ->content('Produksi pada sebulan terakhir*)'),
                    //                 Section::make('a. Produk yang Dijual')
                    //                     ->description('Tuliskan produk yang dijual, produk yang disimpan sebagai stok, produk yang digunakan sendiri, dan produk yang diberikan kepada pihak lain')
                    //                     ->schema([
                    //                         Repeater::make('produk_terjual')
                    //                             ->schema([
                    //                                 Grid::make(4)
                    //                                     ->schema([
                    //                                         TextInput::make('produk')
                    //                                             ->label('Produk')
                    //                                             ->columnSpan(1)
                    //                                             ->maxLength(255),

                    //                                         TextInput::make('satuan')
                    //                                             ->label('Satuan Standar')
                    //                                             ->columnSpan(1)
                    //                                             ->maxLength(50),

                    //                                         TextInput::make('banyaknya')
                    //                                             ->label('Banyaknya')
                    //                                             ->numeric()
                    //                                             ->minValue(0)
                    //                                             ->columnSpan(1),

                    //                                         TextInput::make('nilai')
                    //                                             ->label('Nilai (Rupiah)')
                    //                                             ->numeric()
                    //                                             ->minValue(0)
                    //                                             ->prefix('Rp')
                    //                                             ->columnSpan(1),
                    //                                     ]),
                    //                             ])
                    //                             ->defaultItems(1)
                    //                             ->maxItems(11)
                    //                             ->itemLabel(fn(array $state): ?string => $state['produk'] ?? null)
                    //                             ->collapsible()
                    //                             ->reorderableWithButtons()
                    //                             ->addActionLabel('Tambah Produk'),
                    //                     ]),

                    //                 Section::make('b. Produk yang Dijual Tidak Termasuk')
                    //                     ->description('Tuliskan produk yang dijual tidak termasuk produk yang disimpan sebagai stok, produk yang digunakan sendiri, dan produk yang diberikan kepada pihak lain')
                    //                     ->schema([
                    //                         Repeater::make('produk_tidak_terjual')
                    //                             ->schema([
                    //                                 Grid::make(4)
                    //                                     ->schema([
                    //                                         TextInput::make('produk')
                    //                                             ->label('Produk')
                    //                                             ->columnSpan(1)
                    //                                             ->maxLength(255),

                    //                                         TextInput::make('satuan')
                    //                                             ->label('Satuan Standar')
                    //                                             ->columnSpan(1)
                    //                                             ->maxLength(50),

                    //                                         TextInput::make('banyaknya')
                    //                                             ->label('Banyaknya')
                    //                                             ->numeric()
                    //                                             ->minValue(0)
                    //                                             ->columnSpan(1),

                    //                                         TextInput::make('nilai')
                    //                                             ->label('Nilai (Rupiah)')
                    //                                             ->numeric()
                    //                                             ->minValue(0)
                    //                                             ->prefix('Rp')
                    //                                             ->columnSpan(1),
                    //                                     ]),
                    //                             ])
                    //                             ->defaultItems(1)
                    //                             ->maxItems(11)
                    //                             ->itemLabel(fn(array $state): ?string => $state['produk'] ?? null)
                    //                             ->collapsible()
                    //                             ->reorderableWithButtons()
                    //                             ->addActionLabel('Tambah Produk'),
                    //                     ]),
                    //             ]),
                    //         Section::make('902')
                    //             ->schema([
                    //                 TextInput::make('penjualan_dalam_wilayah')
                    //                     ->label('a. Dalam wilayah asal (kabupaten)')
                    //                     ->numeric()
                    //                     ->minValue(0)
                    //                     ->maxValue(100)
                    //                     ->suffix('%')
                    //                     ->live()
                    //                     ->afterStateUpdated(function (Get $get, Set $set) {
                    //                         $dalam = (float) ($get('penjualan_dalam_wilayah') ?? 0);
                    //                         $luar = (float) ($get('penjualan_luar_wilayah') ?? 0);
                    //                         if ($dalam + $luar !== 100) {
                    //                             $set('penjualan_luar_wilayah', 100 - $dalam);
                    //                         }
                    //                     }),

                    //                 TextInput::make('penjualan_luar_wilayah')
                    //                     ->label('b. Luar wilayah asal')
                    //                     ->numeric()
                    //                     ->minValue(0)
                    //                     ->maxValue(100)
                    //                     ->suffix('%')
                    //                     ->live()
                    //                     ->afterStateUpdated(function (Get $get, Set $set) {
                    //                         $dalam = (float) ($get('penjualan_dalam_wilayah') ?? 0);
                    //                         $luar = (float) ($get('penjualan_luar_wilayah') ?? 0);
                    //                         if ($dalam + $luar !== 100) {
                    //                             $set('penjualan_dalam_wilayah', 100 - $luar);
                    //                         }
                    //                     }),

                    //                 Placeholder::make('total_penjualan')
                    //                     ->label('Jumlah')
                    //                     ->content(function (Get $get): string {
                    //                         $dalam = (float) ($get('penjualan_dalam_wilayah') ?? 0);
                    //                         $luar = (float) ($get('penjualan_luar_wilayah') ?? 0);
                    //                         return $dalam + $luar . '%';
                    //                     }),

                    //                 Placeholder::make('penjualan_ke_label')
                    //                     ->label('')
                    //                     ->content('c. Penjualan ke'),

                    //                 TextInput::make('penjualan_konsumen_akhir')
                    //                     ->label('1) Konsumen akhir (rumah tangga)')
                    //                     ->numeric()
                    //                     ->minValue(0)
                    //                     ->maxValue(100)
                    //                     ->suffix('%'),

                    //                 TextInput::make('penjualan_pedagang_eceran')
                    //                     ->label('2) Pedagang eceran')
                    //                     ->numeric()
                    //                     ->minValue(0)
                    //                     ->maxValue(100)
                    //                     ->suffix('%'),

                    //                 TextInput::make('penjualan_pedagang_besar')
                    //                     ->label('3) Pedagang besar')
                    //                     ->numeric()
                    //                     ->minValue(0)
                    //                     ->maxValue(100)
                    //                     ->suffix('%'),

                    //                 TextInput::make('penjualan_industri')
                    //                     ->label('4) Industri dan pelaku komersial lainnya')
                    //                     ->numeric()
                    //                     ->minValue(0)
                    //                     ->maxValue(100)
                    //                     ->suffix('%'),

                    //                 TextInput::make('penjualan_pemerintah')
                    //                     ->label('5) Pemerintah/institusi')
                    //                     ->numeric()
                    //                     ->minValue(0)
                    //                     ->maxValue(100)
                    //                     ->suffix('%'),

                    //                 Placeholder::make('total_penjualan_distribusi')
                    //                     ->label('Jumlah')
                    //                     ->content(function (Get $get): string {
                    //                         $total = 0;
                    //                         $fields = [
                    //                             'penjualan_konsumen_akhir',
                    //                             'penjualan_pedagang_eceran',
                    //                             'penjualan_pedagang_besar',
                    //                             'penjualan_industri',
                    //                             'penjualan_pemerintah'
                    //                         ];
                    //                         foreach ($fields as $field) {
                    //                             $total += (float) ($get($field) ?? 0);
                    //                         }
                    //                         return $total . '%';
                    //                     }),
                    //             ]),
                    //         Section::make('903')
                    //             ->schema([
                    //                 Placeholder::make('')
                    //                     ->content('NOTE: Khusus untuk kategori "S" Aktivitas Jasa Lainnya'),

                    //                 TextInput::make('pendapatan_jasa')
                    //                     ->label('a. Dalam sebulan, berapa rata-rata pendapatan dari penjualan jasa di [nama usaha]?')
                    //                     ->numeric()
                    //                     ->prefix('Rp')
                    //                     ->minValue(0),

                    //                 TextInput::make('diskon_jasa')
                    //                     ->label('b. Dalam sebulan terakhir, berapa diskon atau potongan harga (dalam Rupiah) yang diberikan kepada konsumen')
                    //                     ->numeric()
                    //                     ->prefix('Rp')
                    //                     ->minValue(0),
                    //             ]),
                    //     ]),
                    Step::make('BLOK IX. INOVASI')
                        ->icon('heroicon-o-light-bulb')
                        ->schema([
                            Section::make('901')
                                ->schema([
                                    Placeholder::make('')
                                        ->content('Apakah [nama usaha] pernah melakukan inovasi produk'),

                                    Radio::make('diversifikasi_produk')
                                        ->label('a. Diversifikasi Produk')
                                        ->options([
                                            1 => 'Ya',
                                            2 => 'Tidak'
                                        ])
                                        ->inline(),

                                    Radio::make('modifikasi_produk')
                                        ->label('b. Modifikasi Produk')
                                        ->options([
                                            1 => 'Ya',
                                            2 => 'Tidak'
                                        ])
                                        ->inline(),
                                ]),

                            Section::make('902')
                                ->schema([
                                    Placeholder::make('')
                                        ->content('Apakah [nama usaha] pernah melakukan inovasi proses?'),

                                    Radio::make('mesin_peralatan')
                                        ->label('a. Menambah/memperbaharui mesin dan peralatan')
                                        ->options([
                                            1 => 'Ya',
                                            2 => 'Tidak'
                                        ])
                                        ->inline(),

                                    Radio::make('metode_baru')
                                        ->label('b. Menggunakan metode atau teknik baru')
                                        ->options([
                                            1 => 'Ya',
                                            2 => 'Tidak'
                                        ])
                                        ->inline(),
                                ]),
                            Section::make('903')
                                ->schema([
                                    Placeholder::make('')
                                        ->content('Apakah [nama usaha] pernah melakukan inovasi pemasaran?'),

                                    Radio::make('media_sosial')
                                        ->label('a. Pemasaran melalui media sosial (facebook, instagram, whatsapp, dan lain lain)')
                                        ->options([
                                            1 => 'Ya',
                                            2 => 'Tidak'
                                        ])
                                        ->inline(),

                                    Radio::make('ecommerce')
                                        ->label('b. Penjualan melalui e-commerce (gojek, shopee, grab, lazada, tokopedia, dan lain lain)')
                                        ->options([
                                            1 => 'Ya',
                                            2 => 'Tidak'
                                        ])
                                        ->inline(),

                                    Radio::make('desain_kemasan')
                                        ->label('c. Desain kemasan')
                                        ->options([
                                            1 => 'Ya',
                                            2 => 'Tidak'
                                        ])
                                        ->inline(),

                                    Radio::make('diskon')
                                        ->label('d. Pemberian diskon/potongan harga')
                                        ->options([
                                            1 => 'Ya',
                                            2 => 'Tidak'
                                        ])
                                        ->inline(),
                                ]),

                            Section::make('904')
                                ->schema([
                                    Placeholder::make('')
                                        ->content('Apakah [nama usaha] pernah melakukan inovasi perusahaan?'),

                                    Radio::make('pemisahan_keuangan')
                                        ->label('a. Memisahkan keuangan usaha dan pribadi')
                                        ->options([
                                            1 => 'Ya',
                                            2 => 'Tidak'
                                        ])
                                        ->inline(),

                                    Radio::make('pembukuan_keuangan')
                                        ->label('b. Melakukan pembukuan keuangan')
                                        ->options([
                                            1 => 'Ya',
                                            2 => 'Tidak'
                                        ])
                                        ->inline(),
                                ]),
                        ]),

                    Step::make('BLOK X. TEKNOLOGI JARINGAN, INFORMASI, DAN KOMUNIKASI')
                        ->icon('heroicon-o-globe-alt')
                        ->schema([
                            Section::make('1001')
                                ->schema([
                                    Radio::make('pembelian_internet')
                                        ->label('Dalam sebulan terakhir, apakah usaha ini melakukan pembelian bahan baku, material, atau barang dagangan menggunakan internet?')
                                        ->options([
                                            '1' => 'Ya',
                                            '2' => 'Tidak'
                                        ])
                                        ->reactive()
                                ]),

                            Section::make('1002')
                                ->schema([
                                    Grid::make(1)
                                        ->schema([
                                            Checkbox::make('alasan_tidak_internet.kurang_pengetahuan')
                                                ->label('1. Kurangnya pengetahuan mengenai teknologi yang tersedia'),

                                            Checkbox::make('alasan_tidak_internet.tidak_diperlukan')
                                                ->label('2. Tidak diperlukan'),

                                            Checkbox::make('alasan_tidak_internet.biaya_mahal')
                                                ->label('3. Biaya jasa maupun peralatan mahal'),

                                            Checkbox::make('alasan_tidak_internet.kurang_tenaga_ahli')
                                                ->label('4. Kurangnya tenaga ahli'),

                                            Checkbox::make('alasan_tidak_internet.masalah_keamanan')
                                                ->label('5. Masalah keamanan atau privasi'),

                                            Checkbox::make('alasan_tidak_internet.tidak_sesuai_software')
                                                ->label('6. Tidak sesuai dengan peralatan atau software yang sudah ada'),

                                            Checkbox::make('alasan_tidak_internet.masalah_hukum')
                                                ->label('7. Masalah hukum'),

                                            Grid::make(1)
                                                ->schema([
                                                    Checkbox::make('alasan_tidak_internet.lainnya')
                                                        ->label('8. Lainnya')
                                                        ->live(),

                                                    TextInput::make('alasan_tidak_internet.lainnya_tuliskan')
                                                        ->label('Sebutkan:')
                                                        ->reactive()
                                                        ->visible(fn(Get $get): bool => $get('alasan_tidak_internet.lainnya') === true)
                                                ])
                                        ])
                                ])
                                ->reactive()
                                ->visible(fn(Get $get) => $get('pembelian_internet') === '2'),

                            Section::make('1003')
                                ->schema([
                                    TextInput::make('persentase_pembelian_online')
                                        ->label('Berapa persen aktivitas pemesanan atau pembelian bahan baku, material, atau barang dagangan untuk keperluan usaha menggunakan internet terhadap total pemesanan keseluruhan?')
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->suffix('%')
                                ]),

                            Section::make('1004')
                                ->schema([
                                    Grid::make(1)
                                        ->schema([
                                            Checkbox::make('aktivitas_internet.email')
                                                ->label('1. Mengirim dan menerima e-mail'),

                                            Checkbox::make('aktivitas_internet.voip')
                                                ->label('2. Telepon melalui Voice over Internet Protocol (VoIP) atau Video Confercing'),

                                            Checkbox::make('aktivitas_internet.terima_pesanan')
                                                ->label('3. Menerima pesanan/menjual barang dan atau jasa'),

                                            Checkbox::make('aktivitas_internet.pesan_barang')
                                                ->label('4. Memesan/membeli barang dan atau jasa'),

                                            Checkbox::make('aktivitas_internet.media_sosial')
                                                ->label('5. Penggunaan layanan pesan instan dan media sosial (contoh: WhatsApp, LINE Messenger, FB Messenger, Facebook, Twitter, Instagram, dll.)'),

                                            Checkbox::make('aktivitas_internet.cari_info')
                                                ->label('6. Mencari informasi mengenai produk barang dan atau jasa'),

                                            Checkbox::make('aktivitas_internet.pemerintah')
                                                ->label('8. Berinteraksi dengan lembaga pemerintah (misalnya portal beberapa instansi, mengurus perizinan, registrasi, e-procurement, SPT online)'),

                                            Checkbox::make('aktivitas_internet.internet_banking')
                                                ->label('9. Transaksi perbankan melalui internet (internet banking)'),

                                            Checkbox::make('aktivitas_internet.financial')
                                                ->label('10. Mengakses fasilitas finansial lainnya (contoh: payment gateway, perdagangan saham, dll.)'),

                                            Checkbox::make('aktivitas_internet.produk_online')
                                                ->label('11. Delivering Produk Online (contoh: e-book, software, games, musik/ringtone, e-ticket, dll.)'),

                                            Grid::make(1)
                                                ->schema([
                                                    Checkbox::make('aktivitas_internet.lainnya')
                                                        ->label('12. Lainnya')
                                                        ->live(),

                                                    TextInput::make('aktivitas_internet.lainnya_tuliskan')
                                                        ->label('Sebutkan:')
                                                        ->reactive()
                                                        ->visible(fn(Get $get): bool => $get('aktivitas_internet.lainnya') === true)
                                                ])
                                        ])
                                ]),
                            Section::make('1005')
                                ->schema([
                                    Radio::make('pembayaran_nontunai_supplier')
                                        ->label('Dalam sebulan terakhir, apakah [nama usaha] melakukan pembayaran nontunai kepada pemasok/supplier?')
                                        ->options([
                                            '1' => 'Ya',
                                            '2' => 'Tidak'
                                        ])
                                        ->reactive(),
                                ]),

                            Section::make('1006')
                                ->schema([
                                    Placeholder::make('')
                                        ->content('Jika tidak melakukan pembayaran nontunai, apa alasannya? (pilih semua jawaban yang sesuai)'),

                                    Grid::make(1)
                                        ->schema([
                                            Checkbox::make('alasan_tidak_nontunai.kurang_pengetahuan')
                                                ->label('Kurangnya pengetahuan mengenai teknologi yang tersedia')
                                                ->reactive()
                                                ->visible(fn(Get $get) => $get('pembayaran_nontunai_supplier') === '2'),

                                            Checkbox::make('alasan_tidak_nontunai.tidak_diperlukan')
                                                ->label('Tidak diperlukan')
                                                ->reactive()
                                                ->visible(fn(Get $get) => $get('pembayaran_nontunai_supplier') === '2'),

                                            Checkbox::make('alasan_tidak_nontunai.biaya_mahal')
                                                ->label('Biaya jasa maupun peralatan mahal')
                                                ->reactive()
                                                ->visible(fn(Get $get) => $get('pembayaran_nontunai_supplier') === '2'),

                                            Checkbox::make('alasan_tidak_nontunai.kurang_tenaga_ahli')
                                                ->label('Kurangnya tenaga ahli')
                                                ->reactive()
                                                ->visible(fn(Get $get) => $get('pembayaran_nontunai_supplier') === '2'),

                                            Checkbox::make('alasan_tidak_nontunai.masalah_keamanan')
                                                ->label('Masalah keamanan atau privasi')
                                                ->reactive()
                                                ->visible(fn(Get $get) => $get('pembayaran_nontunai_supplier') === '2'),

                                            Checkbox::make('alasan_tidak_nontunai.tidak_sesuai_peralatan')
                                                ->label('Tidak sesuai dengan peralatan atau software yang sudah ada')
                                                ->reactive()
                                                ->visible(fn(Get $get) => $get('pembayaran_nontunai_supplier') === '2'),

                                            Checkbox::make('alasan_tidak_nontunai.masalah_hukum')
                                                ->label('Masalah hukum')
                                                ->reactive()
                                                ->visible(fn(Get $get) => $get('pembayaran_nontunai_supplier') === '2'),

                                            Grid::make(1)
                                                ->schema([
                                                    Checkbox::make('alasan_tidak_nontunai.lainnya')
                                                        ->label('Lainnya')
                                                        ->reactive()
                                                        ->visible(fn(Get $get) => $get('pembayaran_nontunai_supplier') === '2'),

                                                    TextInput::make('alasan_tidak_nontunai_lainnya')
                                                        ->label('Sebutkan:')
                                                        ->visible(
                                                            fn(Get $get) =>
                                                            $get('pembayaran_nontunai_supplier') === '2' &&
                                                            $get('alasan_tidak_nontunai.lainnya') === true
                                                        ),
                                                ]),
                                        ]),
                                ])
                                ->reactive()
                                ->visible(fn(Get $get) => $get('pembayaran_nontunai_supplier') === '2'),

                            Section::make('1007')
                                ->schema([
                                    TextInput::make('persentase_pembayaran_nontunai')
                                        ->label('Berapa persentase pembayaran nontunai kepada pemasok dalam aktivitas bisnis?')
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->suffix('%'),
                                ])
                                ->reactive()
                                ->visible(fn(Get $get) => $get('pembayaran_nontunai_supplier') === '1'),

                            Section::make('1008')
                                ->schema([
                                    Radio::make('penjualan_online')
                                        ->label('a. Dalam sebulan terakhir, apakah usaha ini melakukan kegiatan menerima pesanan atau penjualan barang dan atau jasa menggunakan internet (penjualan online)?')
                                        ->options([
                                            '1' => 'Ya',
                                            '2' => 'Tidak'
                                        ])
                                        ->reactive(),

                                    Section::make('b. Jika menjawab "Ya" pada pertanyaan sebelumnya:')
                                        ->schema([
                                            Radio::make('menggunakan_website')
                                                ->label('1) Apakah usaha ini menggunakan website?')
                                                ->options([
                                                    '1' => 'Ya',
                                                    '2' => 'Tidak'
                                                ])
                                                ->reactive(),

                                            TextInput::make('tautan_website')
                                                ->label('2) Jika menggunakan website, tuliskan tautan website yang digunakan dalam kegiatan usaha:')
                                                ->reactive()
                                                ->visible(fn(Get $get) => $get('menggunakan_website') === '1'),

                                            Radio::make('menggunakan_email')
                                                ->label('3) Apakah usaha ini menggunakan E-Mail?')
                                                ->options([
                                                    '1' => 'Ya',
                                                    '2' => 'Tidak'
                                                ]),

                                            Radio::make('menggunakan_pesan_instan')
                                                ->label('4) Apakah usaha ini menggunakan aplikasi pesan instan?')
                                                ->options([
                                                    '1' => 'Ya',
                                                    '2' => 'Tidak'
                                                ])
                                                ->reactive(),

                                            Placeholder::make('label_aplikasi_pesan')
                                                ->label('5) Jika menggunakan aplikasi pesan instan, apa saja aplikasi pesan instan yang digunakan dalam kegiatan usaha? (pilih semua jawaban yang sesuai)')
                                                ->content(''),

                                            Grid::make(1)
                                                ->schema([
                                                    Checkbox::make('jenis_aplikasi_pesan.whatsapp')
                                                        ->label('WhatsApp'),

                                                    Checkbox::make('jenis_aplikasi_pesan.line')
                                                        ->label('LINE'),

                                                    Checkbox::make('jenis_aplikasi_pesan.telegram')
                                                        ->label('Telegram'),

                                                    Grid::make(1)
                                                        ->schema([
                                                            Checkbox::make('jenis_aplikasi_pesan.lainnya')
                                                                ->label('Lainnya')
                                                                ->reactive(),

                                                            TextInput::make('jenis_aplikasi_pesan_lainnya')
                                                                ->label('Sebutkan:')
                                                                ->reactive()
                                                                ->visible(fn(Get $get) => $get('jenis_aplikasi_pesan.lainnya') === true),
                                                        ]),
                                                ])
                                                ->reactive()
                                                ->visible(fn(Get $get) => $get('menggunakan_pesan_instan') === '1'),

                                            Radio::make('menggunakan_media_sosial')
                                                ->label('6) Apakah usaha ini menggunakan media sosial?')
                                                ->options([
                                                    '1' => 'Ya',
                                                    '2' => 'Tidak'
                                                ])
                                                ->reactive(),

                                            Placeholder::make('label_media_sosial')
                                                ->label('7) Jika menggunakan media sosial, apa saja media sosial yang digunakan? (pilih semua jawaban yang sesuai)')
                                                ->content(''),

                                            Grid::make(1)
                                                ->schema([
                                                    Checkbox::make('jenis_media_sosial.facebook')
                                                        ->label('Facebook'),

                                                    Checkbox::make('jenis_media_sosial.twitter')
                                                        ->label('Twitter'),

                                                    Checkbox::make('jenis_media_sosial.instagram')
                                                        ->label('Instagram'),

                                                    Grid::make(1)
                                                        ->schema([
                                                            Checkbox::make('jenis_media_sosial.lainnya')
                                                                ->label('Lainnya')
                                                                ->reactive(),

                                                            TextInput::make('jenis_media_sosial_lainnya')
                                                                ->label('Sebutkan:')
                                                                ->reactive()
                                                                ->visible(fn(Get $get) => $get('jenis_media_sosial.lainnya') === true),
                                                        ]),
                                                ])
                                                ->reactive()
                                                ->visible(fn(Get $get) => $get('menggunakan_media_sosial') === '1'),

                                            TextInput::make('jumlah_media_sosial')
                                                ->label('8) Banyaknya media sosial yang digunakan (diisi oleh petugas)')
                                                ->numeric()
                                                ->minValue(0)
                                                ->reactive()
                                                ->visible(fn(Get $get) => $get('menggunakan_media_sosial') === '1'),

                                            Radio::make('menggunakan_marketplace')
                                                ->label('9) Apakah usaha ini menggunakan Marketplace/Platform Digital?')
                                                ->options([
                                                    '1' => 'Ya',
                                                    '2' => 'Tidak'
                                                ])
                                                ->reactive(),

                                            Placeholder::make('label_marketplace')
                                                ->label('10) Jika menggunakan Marketplace/Platform Digital, apa saja yang digunakan? (pilih semua jawaban yang sesuai)')
                                                ->content(''),

                                            Grid::make(1)
                                                ->schema([
                                                    Grid::make(1)
                                                        ->schema([
                                                            Checkbox::make('jenis_marketplace.tokopedia')
                                                                ->label('Tokopedia'),

                                                            Checkbox::make('jenis_marketplace.pegipegi')
                                                                ->label('Pegipegi'),

                                                            Checkbox::make('jenis_marketplace.shopee')
                                                                ->label('Shopee'),

                                                            Checkbox::make('jenis_marketplace.traveloka')
                                                                ->label('Traveloka'),

                                                            Checkbox::make('jenis_marketplace.bukalapak')
                                                                ->label('Bukalapak'),

                                                            Checkbox::make('jenis_marketplace.agoda')
                                                                ->label('Agoda'),

                                                            Checkbox::make('jenis_marketplace.gojek')
                                                                ->label('Gojek'),

                                                            Checkbox::make('jenis_marketplace.tiktok_shop')
                                                                ->label('TikTok Shop'),

                                                            Checkbox::make('jenis_marketplace.grab')
                                                                ->label('Grab'),

                                                            Checkbox::make('jenis_marketplace.lazada')
                                                                ->label('Lazada'),
                                                        ]),

                                                    Grid::make(1)
                                                        ->schema([
                                                            Checkbox::make('jenis_marketplace.lainnya')
                                                                ->label('Lainnya')
                                                                ->reactive(),

                                                            TextInput::make('jenis_marketplace_lainnya')
                                                                ->label('Sebutkan:')
                                                                ->visible(fn(Get $get) => $get('jenis_marketplace.lainnya') === true),
                                                        ]),
                                                ])
                                                ->visible(fn(Get $get) => $get('menggunakan_marketplace') === '1'),

                                            TextInput::make('jumlah_marketplace')
                                                ->label('11) Banyaknya marketplace/platform digital yang digunakan (diisi oleh petugas)')
                                                ->numeric()
                                                ->minValue(0)
                                                ->reactive()
                                                ->visible(fn(Get $get) => $get('menggunakan_marketplace') === '1'),

                                        ])
                                        ->reactive()
                                        ->visible(fn(Get $get) => $get('penjualan_online') === '1'),
                                ]),

                            Section::make('1009')
                                ->schema([
                                    Placeholder::make('')
                                        ->content('Apa alasan [nama usaha] tidak melakukan kegiatan menerima pesanan atau penjualan barang dan atau jasa menggunakan internet?'),

                                    Grid::make(1)
                                        ->schema([
                                            Checkbox::make('alasan_tidak_terima_nontunai.kurang_pengetahuan')
                                                ->label('1. Kurangnya pengetahuan mengenai teknologi yang tersedia'),

                                            Checkbox::make('alasan_tidak_terima_nontunai.tidak_diperlukan')
                                                ->label('2. Tidak diperlukan'),

                                            Checkbox::make('alasan_tidak_terima_nontunai.biaya_mahal')
                                                ->label('3. Biaya jasa maupun peralatan mahal'),

                                            Checkbox::make('alasan_tidak_terima_nontunai.kurang_tenaga_ahli')
                                                ->label('4. Kurangnya tenaga ahli'),

                                            Checkbox::make('alasan_tidak_terima_nontunai.masalah_keamanan')
                                                ->label('5. Masalah keamanan atau privasi'),

                                            Checkbox::make('alasan_tidak_terima_nontunai.tidak_sesuai_peralatan')
                                                ->label('6. Tidak sesuai dengan peralatan atau software yang sudah ada'),

                                            Checkbox::make('alasan_tidak_terima_nontunai.masalah_hukum')
                                                ->label('7. Masalah hukum'),

                                            Grid::make(1)
                                                ->schema([
                                                    Checkbox::make('alasan_tidak_terima_nontunai.lainnya')
                                                        ->label('8. Lainnya')
                                                        ->reactive(),

                                                    TextInput::make('alasan_tidak_terima_nontunai_lainnya')
                                                        ->label('Sebutkan:')
                                                        ->reactive()
                                                        ->visible(fn(Get $get) => $get('alasan_tidak_terima_nontunai.lainnya') === true),
                                                ]),
                                        ]),
                                ])
                                ->reactive()
                                ->visible(fn(Get $get) => $get('penjualan_online') === '2'),

                            Section::make('1010')
                                ->schema([
                                    TextInput::make('tahun_mulai_penjualan_online')
                                        ->label('Pada tahun berapa usaha ini mulai menerima pesanan atau melakukan penjualan barang dan atau jasa menggunakan internet?')
                                        ->numeric()
                                        ->minValue(1900)
                                        ->maxValue(now()->year)
                                ])
                                ->reactive()
                                ->visible(fn(Get $get) => $get('penjualan_online') === '1'),

                            Section::make('1011')
                                ->schema([
                                    TextInput::make('frekuensi_penjualan_online')
                                        ->label('Dalam sebulan, berapa kali jumlah aktivitas menerima pesanan atau melakukan penjualan barang dan atau jasa menggunakan internet?')
                                        ->numeric()
                                        ->minValue(0)
                                        ->suffix('kali')
                                ])
                                ->reactive()
                                ->visible(fn(Get $get) => $get('penjualan_online') === '1'),

                            Section::make('1012')
                                ->schema([
                                    TextInput::make('persentase_pendapatan_online')
                                        ->label('Dalam sebulan, berapa persen dari total pendapatan [nama usaha] yang diperoleh dari kegiatan menerima pesanan atau melakukan penjualan barang dan atau jasa menggunakan internet?')
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->suffix('%')
                                ])
                                ->reactive()
                                ->visible(fn(Get $get) => $get('penjualan_online') === '1'),

                            Section::make('1013')
                                ->schema([
                                    Grid::make(1)
                                        ->schema([
                                            Checkbox::make('aktivitas_ecommerce.email')
                                                ->label('1. Mengirim dan menerima e-mail'),

                                            Checkbox::make('aktivitas_ecommerce.voip')
                                                ->label('2. Telepon melalui Voice over Internet Protocol (VoIP) atau Video Confercing'),

                                            Checkbox::make('aktivitas_ecommerce.terima_pesanan')
                                                ->label('3. Menerima pesanan/menjual barang dan atau jasa'),

                                            Checkbox::make('aktivitas_ecommerce.pesan_barang')
                                                ->label('4. Memesan/membeli barang dan atau jasa'),

                                            Checkbox::make('aktivitas_ecommerce.media_sosial')
                                                ->label('5. Penggunaan layanan pesan instan dan media sosial (contoh: WhatsApp, LINE Messenger, FB Messenger, Facebook, Twitter, Instagram, dll.)'),

                                            Checkbox::make('aktivitas_ecommerce.cari_info')
                                                ->label('6. Mencari informasi mengenai produk barang dan atau jasa'),

                                            Checkbox::make('aktivitas_ecommerce.internet_banking')
                                                ->label('9. Transaksi perbankan melalui internet (internet banking)'),

                                            Checkbox::make('aktivitas_ecommerce.finansial')
                                                ->label('10. Mengakses fasilitas finansial lainnya (contoh: payment gateway, perdagangan saham, dll.)'),

                                            Checkbox::make('aktivitas_ecommerce.produk_online')
                                                ->label('11. Delivering Produk Online (contoh: e-book, software, games, musik/ringtone, e-ticket, dll.)'),

                                            Grid::make(1)
                                                ->schema([
                                                    Checkbox::make('aktivitas_ecommerce.lainnya')
                                                        ->label('12. Lainnya')
                                                        ->reactive(),

                                                    TextInput::make('aktivitas_ecommerce_lainnya')
                                                        ->label('Sebutkan:')
                                                        ->reactive()
                                                        ->visible(fn(Get $get) => $get('aktivitas_ecommerce.lainnya') === true),
                                                ]),
                                        ]),
                                ])
                                ->reactive()
                                ->visible(fn(Get $get) => $get('penjualan_online') === '1'),
                            Section::make('1014')
                                ->schema([
                                    Placeholder::make('')
                                        ->content('Dalam sebulan terakhir, apakah usaha ini melakukan kegiatan pemasaran produk menggunakan internet?'),

                                    Radio::make('pemasaran_online')
                                        ->options([
                                            '1' => 'Ya',
                                            '2' => 'Tidak'
                                        ])
                                        ->reactive(),
                                ]),

                            Section::make('1015')
                                ->schema([
                                    Placeholder::make('')
                                        ->content('Apa alasan [nama usaha] tidak melakukan kegiatan pemasaran, produk menggunakan internet?'),

                                    Grid::make(1)
                                        ->schema([
                                            Checkbox::make('alasan_tidak_pemasaran_online.kurang_pengetahuan')
                                                ->label('Kurangnya pengetahuan mengenai teknologi yang tersedia'),

                                            Checkbox::make('alasan_tidak_pemasaran_online.tidak_diperlukan')
                                                ->label('Tidak diperlukan'),

                                            Checkbox::make('alasan_tidak_pemasaran_online.biaya_mahal')
                                                ->label('Biaya jasa maupun peralatan mahal'),

                                            Checkbox::make('alasan_tidak_pemasaran_online.kurang_tenaga_ahli')
                                                ->label('Kurangnya tenaga ahli'),

                                            Checkbox::make('alasan_tidak_pemasaran_online.masalah_keamanan')
                                                ->label('Masalah keamanan atau privasi'),

                                            Checkbox::make('alasan_tidak_pemasaran_online.tidak_sesuai_software')
                                                ->label('Tidak sesuai dengan peralatan atau software yang sudah ada'),

                                            Checkbox::make('alasan_tidak_pemasaran_online.masalah_hukum')
                                                ->label('Masalah hukum'),

                                            Grid::make(1)
                                                ->schema([
                                                    Checkbox::make('alasan_tidak_pemasaran_online.lainnya')
                                                        ->label('Lainnya')
                                                        ->reactive(),

                                                    TextInput::make('alasan_tidak_pemasaran_online_lainnya')
                                                        ->label('Sebutkan:')
                                                        ->reactive()
                                                        ->visible(fn(Get $get) => $get('alasan_tidak_pemasaran_online.lainnya') === true),
                                                ]),
                                        ]),
                                ])
                                ->reactive()
                                ->visible(fn(Get $get) => $get('pemasaran_online') === '2'),

                            Section::make('1016')
                                ->schema([
                                    Placeholder::make('')
                                        ->content('Dalam sebulan terakhir, apa saja yang dilakukan [nama usaha] ketika menggunakan internet dalam kegiatan pemasaran menggunakan internet? (E-Marketing)'),

                                    Grid::make(1)
                                        ->schema([
                                            Checkbox::make('aktivitas_emarketing.email')
                                                ->label('1. Mengirim dan menerima e-mail'),

                                            Checkbox::make('aktivitas_emarketing.voip')
                                                ->label('2. Telepon melalui Voice over Internet Protocol (VoIP) atau Video Confercing'),

                                            Checkbox::make('aktivitas_emarketing.media_sosial')
                                                ->label('5. Penggunaan layanan pesan instan dan media sosial (contoh: WhatsApp, LINE Messenger, FB Messenger, Facebook, Twitter, Instagram, dll.)'),

                                            Checkbox::make('aktivitas_emarketing.cari_info')
                                                ->label('6. Mencari informasi mengenai produk barang dan atau jasa'),

                                            Grid::make(1)
                                                ->schema([
                                                    Checkbox::make('aktivitas_emarketing.lainnya')
                                                        ->label('7. Lainnya')
                                                        ->reactive(),

                                                    TextInput::make('aktivitas_emarketing_lainnya')
                                                        ->label('Sebutkan:')
                                                        ->reactive()
                                                        ->visible(fn(Get $get) => $get('aktivitas_emarketing.lainnya') === true),
                                                ]),
                                        ]),
                                ])
                                ->reactive()
                                ->visible(fn(Get $get) => $get('pemasaran_online') === '1'),

                            Section::make('1017')
                                ->schema([
                                    TextInput::make('frekuensi_update_media_sosial')
                                        ->label('Dalam sebulan terakhir, berapa kali [nama usaha] memperbarui informasi tentang produk/jasa [nama usaha] di media sosial?')
                                        ->numeric()
                                        ->minValue(0)
                                        ->suffix('kali')
                                ]),

                            Section::make('1018')
                                ->schema([
                                    TextInput::make('rata_rata_waktu_interaksi')
                                        ->label('Berapa rata-rata waktu pada hari operasional (dalam jam) yang pemilik usaha/pegawai gunakan untuk berinteraksi dengan konsumen di media sosial, baik komentar, percakapan lewat pesan, dan penilaian terhadap UMK?')
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(24)
                                        ->suffix('jam')
                                ]),

                            Section::make('1019')
                                ->schema([
                                    TextInput::make('biaya_promosi')
                                        ->label('Dalam sebulan, berapa biaya yang dikeluarkan oleh [nama usaha] untuk melakukan promosi?')
                                        ->numeric()
                                        ->minValue(0)
                                        ->prefix('Rp')
                                ]),

                            Section::make('1020')
                                ->schema([
                                    Radio::make('menyediakan_pembayaran_nontunai')
                                        ->label('Apakah usaha ini menyediakan pembayaran secara nontunai?')
                                        ->options([
                                            '1' => 'Ya',
                                            '2' => 'Tidak'
                                        ])
                                        ->reactive()
                                ]),
                            Section::make('1021')
                                ->schema([
                                    Placeholder::make('')
                                        ->content('Jika tidak menyediakan pembayaran secara nontunai, apa alasannya? (pilih semua jawaban yang sesuai)'),

                                    Grid::make(1)
                                        ->schema([
                                            Checkbox::make('alasan_tidak_menyediakan_nontunai.kurang_pengetahuan')
                                                ->label('Kurangnya pengetahuan mengenai teknologi yang tersedia'),

                                            Checkbox::make('alasan_tidak_menyediakan_nontunai.tidak_diperlukan')
                                                ->label('Tidak diperlukan'),

                                            Checkbox::make('alasan_tidak_menyediakan_nontunai.biaya_mahal')
                                                ->label('Biaya jasa maupun peralatan mahal'),

                                            Checkbox::make('alasan_tidak_menyediakan_nontunai.kurang_tenaga_ahli')
                                                ->label('Kurangnya tenaga ahli'),

                                            Checkbox::make('alasan_tidak_menyediakan_nontunai.masalah_keamanan')
                                                ->label('Masalah keamanan atau privasi'),

                                            Checkbox::make('alasan_tidak_menyediakan_nontunai.tidak_sesuai_peralatan')
                                                ->label('Tidak sesuai dengan peralatan atau software yang sudah ada'),

                                            Checkbox::make('alasan_tidak_menyediakan_nontunai.masalah_hukum')
                                                ->label('Masalah hukum'),

                                            Grid::make(1)
                                                ->schema([
                                                    Checkbox::make('alasan_tidak_menyediakan_nontunai.lainnya')
                                                        ->label('Lainnya')
                                                        ->reactive(),

                                                    TextInput::make('alasan_tidak_menyediakan_nontunai_lainnya')
                                                        ->label('Sebutkan:')
                                                        ->reactive()
                                                        ->visible(fn(Get $get) => $get('alasan_tidak_menyediakan_nontunai.lainnya') === true),
                                                ]),
                                        ]),
                                ])
                                ->reactive()
                                ->visible(fn(Get $get) => $get('menyediakan_pembayaran_nontunai') === '2'),

                            Section::make('1022')
                                ->schema([
                                    TextInput::make('persentase_transaksi_nontunai')
                                        ->label('Berapa persen aktivitas transaksi pembayaran nontunai yang diterima oleh usaha dibandingkan dengan keseluruhan transaksi?')
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->suffix('%'),
                                ])
                                ->reactive()
                                ->visible(fn(Get $get) => $get('menyediakan_pembayaran_nontunai') === '1'),

                            Section::make('1023')
                                ->schema([
                                    TextInput::make('persentase_pendapatan_nontunai')
                                        ->label('Dalam sebulan, berapa persen dari total pendapatan [nama usaha] yang diperoleh dari pembayaran nontunai dibandingkan dengan keseluruhan transaksi?')
                                        ->numeric()
                                        ->minValue(0)
                                        ->maxValue(100)
                                        ->suffix('%'),
                                ])
                                ->reactive()
                                ->visible(fn(Get $get) => $get('menyediakan_pembayaran_nontunai') === '1'),

                            Section::make('1024')
                                ->schema([
                                    Placeholder::make('')
                                        ->content('Metode pembayaran nontunai apa saja yang disediakan oleh [nama usaha]? (pilih semua jawaban yang sesuai)'),

                                    Grid::make(1)
                                        ->schema([
                                            Checkbox::make('metode_pembayaran_nontunai.transfer_bank')
                                                ->label('Transfer Bank (ATM, Internet Banking, Mobile Banking)'),

                                            Checkbox::make('metode_pembayaran_nontunai.kartu')
                                                ->label('Kartu (Debit, Kredit, Kartu Uang Elektronik)'),

                                            Checkbox::make('metode_pembayaran_nontunai.qris')
                                                ->label('QRIS'),

                                            Checkbox::make('metode_pembayaran_nontunai.ewallet')
                                                ->label('E-Wallet (OVO, DANA, GoPay, LinkAja, Kredivo, dsb.)'),

                                            Grid::make(1)
                                                ->schema([
                                                    Checkbox::make('metode_pembayaran_nontunai.lainnya')
                                                        ->label('Lainnya')
                                                        ->reactive(),

                                                    TextInput::make('metode_pembayaran_nontunai_lainnya')
                                                        ->label('Sebutkan:')
                                                        ->reactive()
                                                        ->visible(fn(Get $get) => $get('metode_pembayaran_nontunai.lainnya') === true),
                                                ]),
                                        ]),
                                ])
                                ->reactive()
                                ->visible(fn(Get $get) => $get('menyediakan_pembayaran_nontunai') === '1'),

                            Section::make('1025')
                                ->schema([
                                    Radio::make('menggunakan_aplikasi_kasir')
                                        ->label('a. Apakah usaha ini menggunakan aplikasi kasir digital dalam kegiatan usaha?')
                                        ->options([
                                            '1' => 'Ya',
                                            '2' => 'Tidak'
                                        ])
                                        ->reactive(),

                                    Placeholder::make('fitur_aplikasi_kasir')
                                        ->label('b. Fitur apa saja yang digunakan [nama usaha] untuk memanfaatkan aplikasi kasir digital dalam kegiatan usaha?')
                                        ->content('')
                                        ->reactive()
                                        ->visible(fn(Get $get) => $get('menggunakan_aplikasi_kasir') === '1'),

                                    Grid::make(1)
                                        ->schema([
                                            Checkbox::make('fitur_aplikasi_kasir.pencatatan_transaksi')
                                                ->label('Pencatatan transaksi penjualan'),

                                            Checkbox::make('fitur_aplikasi_kasir.pencetakan_struk')
                                                ->label('Pencetakan struk'),

                                            Checkbox::make('fitur_aplikasi_kasir.pencatatan_stok')
                                                ->label('Pencatatan stok masuk dan keluar'),

                                            Checkbox::make('fitur_aplikasi_kasir.laporan_transaksi')
                                                ->label('Laporan transaksi harian'),

                                            Checkbox::make('fitur_aplikasi_kasir.dashboard')
                                                ->label('Dashboard'),

                                            Checkbox::make('fitur_aplikasi_kasir.informasi_barang')
                                                ->label('Informasi barang'),

                                            Grid::make(1)
                                                ->schema([
                                                    Checkbox::make('fitur_aplikasi_kasir.lainnya')
                                                        ->label('Lainnya')
                                                        ->reactive(),

                                                    TextInput::make('fitur_aplikasi_kasir_lainnya')
                                                        ->label('Sebutkan:')
                                                        ->reactive()
                                                        ->visible(fn(Get $get) => $get('fitur_aplikasi_kasir.lainnya') === true),
                                                ]),
                                        ])
                                        ->reactive()
                                        ->visible(fn(Get $get) => $get('menggunakan_aplikasi_kasir') === '1'),
                                ]),

                            Section::make('1026')
                                ->schema([
                                    Grid::make(1)
                                        ->schema([
                                            Checkbox::make('alasan_tidak_kasir_digital.kurang_pengetahuan')
                                                ->label('Kurangnya pengetahuan mengenai teknologi yang tersedia'),

                                            Checkbox::make('alasan_tidak_kasir_digital.tidak_diperlukan')
                                                ->label('Tidak diperlukan'),

                                            Checkbox::make('alasan_tidak_kasir_digital.biaya_mahal')
                                                ->label('Biaya jasa maupun peralatan mahal'),

                                            Checkbox::make('alasan_tidak_kasir_digital.kurang_tenaga_ahli')
                                                ->label('Kurangnya tenaga ahli'),

                                            Checkbox::make('alasan_tidak_kasir_digital.masalah_keamanan')
                                                ->label('Masalah keamanan atau privasi'),

                                            Checkbox::make('alasan_tidak_kasir_digital.tidak_sesuai_peralatan')
                                                ->label('Tidak sesuai dengan peralatan atau software yang sudah ada'),

                                            Checkbox::make('alasan_tidak_kasir_digital.masalah_hukum')
                                                ->label('Masalah hukum'),

                                            Grid::make(1)
                                                ->schema([
                                                    Checkbox::make('alasan_tidak_kasir_digital.lainnya')
                                                        ->label('Lainnya')
                                                        ->reactive(),

                                                    TextInput::make('alasan_tidak_kasir_digital_lainnya')
                                                        ->label('Sebutkan:')
                                                        ->reactive()
                                                        ->visible(fn(Get $get) => $get('alasan_tidak_kasir_digital.lainnya') === true),
                                                ]),
                                        ]),
                                ])
                                ->reactive()
                                ->visible(fn(Get $get) => $get('menggunakan_aplikasi_kasir') === '2'),
                            Section::make('1027')
                                ->schema([
                                    TextInput::make('biaya_aplikasi_kasir')
                                        ->label('Dalam sebulan terakhir, berapa biaya yang dikeluarkan oleh [nama usaha] untuk berlangganan sistem aplikasi kasir digital?')
                                        ->prefix('Rp')
                                        ->numeric()
                                ])
                                ->reactive()
                                ->visible(fn(Get $get) => $get('menggunakan_aplikasi_kasir') === '1'),

                            Section::make('1028')
                                ->schema([
                                    Grid::make(1)
                                        ->schema([
                                            Placeholder::make('koneksi_internet_label')
                                                ->label('Selama setahun terakhir, apa koneksi internet yang digunakan oleh usaha ini?')
                                                ->content('(pilih semua jawaban yang sesuai)'),

                                            Checkbox::make('koneksi_internet.fixed_broadband')
                                                ->label('Fixed Broadband (First Media, Indihome, MyRepublic, BaliFiber, dsb.)')
                                                ->columnSpanFull(),

                                            Checkbox::make('koneksi_internet.mobile_broadband')
                                                ->label('Mobile Broadband (Indosat, XL, Telkomsel, GPRS, EDGE, HSDPA, HPSA, 2G-5G)')
                                                ->columnSpanFull(),

                                            Checkbox::make('koneksi_internet.vsat')
                                                ->label('VSAT (Very Small Aperture Terminal) (Metrasat (Telkom Indonesia), Lintasarta IP VSAT (PT. Aplikanusa Lintasarta), dsb.)')
                                                ->columnSpanFull(),

                                            Grid::make(1)
                                                ->schema([
                                                    Checkbox::make('koneksi_internet.lainnya')
                                                        ->label('Lainnya')
                                                        ->reactive(),

                                                    TextInput::make('koneksi_internet_lainnya')
                                                        ->label('Sebutkan:')
                                                        ->reactive()
                                                        ->visible(fn(Get $get) => $get('koneksi_internet.lainnya') === true),
                                                ]),
                                        ]),
                                ]),

                            Section::make('1029')
                                ->schema([
                                    Grid::make(1)
                                        ->schema([
                                            Placeholder::make('perangkat_digital_label')
                                                ->label('Apa saja perangkat digital yang digunakan untuk usaha ini? Berapa banyaknya?'),

                                            Grid::make(1)
                                                ->schema([
                                                    Checkbox::make('perangkat_digital.pc')
                                                        ->label('PC')
                                                        ->reactive(),
                                                    TextInput::make('jumlah_pc')
                                                        ->label('unit')
                                                        ->numeric()
                                                        ->minValue(0)
                                                        ->live()
                                                        ->default(0)
                                                        ->afterStateUpdated(function (Set $set, Get $get) {
                                                            $total = 0;
                                                            $total += (int) ($get('jumlah_pc') ?? 0);
                                                            $total += (int) ($get('jumlah_laptop') ?? 0);
                                                            $total += (int) ($get('jumlah_tablet') ?? 0);
                                                            $total += (int) ($get('jumlah_smartphone') ?? 0);
                                                            $total += (int) ($get('jumlah_lainnya') ?? 0);
                                                            $set('total_perangkat_digital', $total);
                                                        })
                                                        ->reactive()
                                                        ->visible(fn(Get $get) => $get('perangkat_digital.pc') === true),

                                                    Checkbox::make('perangkat_digital.laptop')
                                                        ->label('Laptop')
                                                        ->reactive(),
                                                    TextInput::make('jumlah_laptop')
                                                        ->label('unit')
                                                        ->numeric()
                                                        ->minValue(0)
                                                        ->live()
                                                        ->default(0)
                                                        ->afterStateUpdated(function (Set $set, Get $get) {
                                                            $total = 0;
                                                            $total += (int) ($get('jumlah_pc') ?? 0);
                                                            $total += (int) ($get('jumlah_laptop') ?? 0);
                                                            $total += (int) ($get('jumlah_tablet') ?? 0);
                                                            $total += (int) ($get('jumlah_smartphone') ?? 0);
                                                            $total += (int) ($get('jumlah_lainnya') ?? 0);
                                                            $set('total_perangkat_digital', $total);
                                                        })
                                                        ->reactive()
                                                        ->visible(fn(Get $get) => $get('perangkat_digital.laptop') === true),

                                                    Checkbox::make('perangkat_digital.tablet')
                                                        ->label('Tablet')
                                                        ->reactive(),
                                                    TextInput::make('jumlah_tablet')
                                                        ->label('unit')
                                                        ->numeric()
                                                        ->minValue(0)
                                                        ->live()
                                                        ->default(0)
                                                        ->afterStateUpdated(function (Set $set, Get $get) {
                                                            $total = 0;
                                                            $total += (int) ($get('jumlah_pc') ?? 0);
                                                            $total += (int) ($get('jumlah_laptop') ?? 0);
                                                            $total += (int) ($get('jumlah_tablet') ?? 0);
                                                            $total += (int) ($get('jumlah_smartphone') ?? 0);
                                                            $total += (int) ($get('jumlah_lainnya') ?? 0);
                                                            $set('total_perangkat_digital', $total);
                                                        })
                                                        ->reactive()
                                                        ->visible(fn(Get $get) => $get('perangkat_digital.tablet') === true),

                                                    Checkbox::make('perangkat_digital.smartphone')
                                                        ->label('Smartphone')
                                                        ->reactive(),
                                                    TextInput::make('jumlah_smartphone')
                                                        ->label('unit')
                                                        ->numeric()
                                                        ->minValue(0)
                                                        ->live()
                                                        ->default(0)
                                                        ->afterStateUpdated(function (Set $set, Get $get) {
                                                            $total = 0;
                                                            $total += (int) ($get('jumlah_pc') ?? 0);
                                                            $total += (int) ($get('jumlah_laptop') ?? 0);
                                                            $total += (int) ($get('jumlah_tablet') ?? 0);
                                                            $total += (int) ($get('jumlah_smartphone') ?? 0);
                                                            $total += (int) ($get('jumlah_lainnya') ?? 0);
                                                            $set('total_perangkat_digital', $total);
                                                        })
                                                        ->reactive()
                                                        ->visible(fn(Get $get) => $get('perangkat_digital.smartphone') === true),

                                                    Grid::make(1)
                                                        ->schema([
                                                            Checkbox::make('perangkat_digital.lainnya')
                                                                ->label('Lainnya')
                                                                ->reactive(),
                                                            TextInput::make('jumlah_lainnya')
                                                                ->label('unit')
                                                                ->numeric()
                                                                ->minValue(0)
                                                                ->live()
                                                                ->default(0)
                                                                ->afterStateUpdated(function (Set $set, Get $get) {
                                                                    $total = 0;
                                                                    $total += (int) ($get('jumlah_pc') ?? 0);
                                                                    $total += (int) ($get('jumlah_laptop') ?? 0);
                                                                    $total += (int) ($get('jumlah_tablet') ?? 0);
                                                                    $total += (int) ($get('jumlah_smartphone') ?? 0);
                                                                    $total += (int) ($get('jumlah_lainnya') ?? 0);
                                                                    $set('total_perangkat_digital', $total);
                                                                })
                                                                ->reactive()
                                                                ->visible(fn(Get $get) => $get('perangkat_digital.lainnya') === true),

                                                            TextInput::make('perangkat_digital_lainnya')
                                                                ->label('Sebutkan:')
                                                                ->columnSpanFull()
                                                                ->reactive()
                                                                ->visible(fn(Get $get) => $get('perangkat_digital.lainnya') === true),
                                                        ]),
                                                ]),
                                        ]),
                                ]),

                            Section::make('1030')
                                ->schema([
                                    TextInput::make('total_perangkat_digital')
                                        ->label('Jumlah perangkat digital yang digunakan untuk usaha ini? (diisi oleh petugas)')
                                        ->helperText('(PC + Laptop + Tablet + Smartphone + Lainnya)')
                                        ->suffix('unit')
                                        ->numeric()
                                        ->minValue(0)
                                        ->disabled()
                                        ->default(0)
                                        ->dehydrated(false)
                                ])
                        ]),

                        Step::make('BLOK XI. AKTIVITAS PERLINDUNGAN LINGKUNGAN')
                        ->icon('heroicon-o-globe-alt')
                        ->schema([
                            Section::make('1101')
                                ->schema([
                                    Radio::make('hasil_limbah')
                                        ->label('Sebulan yang lalu, apakah usaha ini menghasilkan limbah hasil kegiatan usaha?')
                                        ->options([
                                            '1' => 'Ya',
                                            '2' => 'Tidak'
                                        ])
                                        ->reactive(),
                                ]),

                            Section::make('Hasil Limbah')
                                ->schema([
                                    Grid::make(1)
                                        ->schema([
                                            Section::make('1102.a. Jenis limbah yang dihasilkan oleh kegiatan usaha:')
                                                ->schema([
                                                    Radio::make('limbah_padat')
                                                        ->label('1) Limbah Padat')
                                                        ->options([
                                                            '1' => 'Ya',
                                                            '2' => 'Tidak'
                                                        ])
                                                        ->reactive(),
                                                    Radio::make('limbah_cair')
                                                        ->label('2) Limbah Cair')
                                                        ->options([
                                                            '1' => 'Ya',
                                                            '2' => 'Tidak'
                                                        ])
                                                        ->reactive(),
                                                ]),

                                            Section::make('1102.b. Cara Pengelolaan Limbah Padat yang Dilakukan')
                                                ->schema([
                                                    CheckboxList::make('pengelolaan_limbah_padat')
                                                        ->label('Pilih semua yang sesuai')
                                                        ->options([
                                                            '1' => 'Diangkut petugas',
                                                            '2' => 'Dibuang ke Tempat Penampungan Sementara (TPS)',
                                                            '3' => 'Didaur ulang',
                                                            '4' => 'Dibuat kompos/pupuk',
                                                            '5' => 'Disetor ke bank sampah',
                                                            '6' => 'Dibuang ke sungai/got/selokan',
                                                            '7' => 'Dibakar',
                                                            '8' => 'Ditimbun/dikubur',
                                                            '9' => 'Dibuang sembarangan',
                                                            '10' => 'Lainnya',
                                                        ])
                                                        ->reactive(),
                                                    TextInput::make('pengelolaan_limbah_padat_lainnya')
                                                        ->label('Sebutkan jika lainnya:')
                                                        ->visible(fn(Get $get) => in_array('10', (array) $get('pengelolaan_limbah_padat'))),
                                                ])
                                                ->visible(fn(Get $get) => $get('limbah_padat') === '1'),

                                            TextInput::make('pengelolaan_tersering')
                                                ->label('1102.c. Pengelolaan limbah padat paling sering dilakukan (tuliskan nomornya)')
                                                ->visible(fn(Get $get) => !empty($get('pengelolaan_limbah_padat'))),

                                            Radio::make('tempat_pembuangan_limbah_cair')
                                                ->label('1102.d. Tempat/Saluran Pembuangan Sebagian Besar Limbah Cair')
                                                ->options([
                                                    '1' => 'Lubang resapan',
                                                    '2' => 'Drainase (got/selokan)',
                                                    '3' => 'Sungai/saluran irigasi/danau/laut',
                                                    '4' => 'Dalam lubang/tanah terbuka',
                                                    '5' => 'Lainnya',
                                                ])
                                                ->reactive()
                                                ->visible(fn(Get $get) => $get('limbah_cair') === '1'),

                                            TextInput::make('tempat_pembuangan_limbah_cair_lainnya')
                                                ->label('Sebutkan jika lainnya:')
                                                ->visible(fn(Get $get) => $get('tempat_pembuangan_limbah_cair') === '5'),

                                            Grid::make(2)
                                                ->schema([
                                                    TextInput::make('jumlah_limbah_padat')
                                                        ->label('1102.e. Rata-rata jumlah limbah padat per hari (kg)')
                                                        ->numeric()
                                                        ->suffix('kg'),
                                                    TextInput::make('jumlah_limbah_cair')
                                                        ->label('Rata-rata jumlah limbah cair per hari (liter)')
                                                        ->numeric()
                                                        ->suffix('liter'),
                                                ])
                                                ->visible(fn(Get $get) => $get('limbah_padat') === '1' || $get('limbah_cair') === '1'),

                                            Section::make('1103. Limbah Bahan Berbahaya dan Beracun (B3)')
                                                ->schema([
                                                    Radio::make('limbah_b3')
                                                        ->label('a. Apakah usaha ini menghasilkan limbah B3?')
                                                        ->helperText('contoh: : baterai bekas, bensin, oli, kaca, PVC, aluminium foil, minyak tanah, sampah dapur, dsb.')
                                                        ->options([
                                                            '1' => 'Ya',
                                                            '2' => 'Tidak'
                                                        ])
                                                        ->reactive(),

                                                    Radio::make('pemisahan_b3')
                                                        ->label('b. Apakah usaha ini melakukan pemisahan limbah B3 dan limbah biasa?')
                                                        ->options([
                                                            '1' => 'Ya',
                                                            '2' => 'Tidak'
                                                        ])
                                                        ->visible(fn(Get $get) => $get('limbah_b3') === '1'),

                                                    Radio::make('pembakaran_b3')
                                                        ->label('c. Apakah usaha ini tidak pernah melakukan pembakaran limbah B3?')
                                                        ->options([
                                                            '1' => 'Ya',
                                                            '2' => 'Tidak'
                                                        ])
                                                        ->visible(fn(Get $get) => $get('limbah_b3') === '1'),
                                                ]),
                                            //1104
                                            Section::make('1104. Penyediaan Tempat Pembuangan Limbah')
                                                ->schema([
                                                    Radio::make('tempat_pembuangan')
                                                        ->label('Apakah usaha ini menyediakan tempat pembuangan limbah?')
                                                        ->helperText('contoh: kotak sampah, trash bag')
                                                        ->options([
                                                            '1' => 'Ya',
                                                            '2' => 'Tidak'
                                                        ]),
                                                ]),

                                            // 1105
                                            Section::make('1105. Limbah Organik dan Nonorganik')
                                                ->schema([
                                                    Radio::make('limbah_organik')
                                                        ->label('a. Apakah usaha ini menghasilkan limbah organik dan nonorganik?')
                                                        ->helperText('contoh: sisa makanan dan plastik')
                                                        ->options([
                                                            '1' => 'Ya',
                                                            '2' => 'Tidak'
                                                        ])
                                                        ->reactive(),

                                                    Radio::make('pemisahan_organik')
                                                        ->label('b. Apakah usaha ini melakukan pemisahan antara limbah organik dan nonorganik?')
                                                        ->options([
                                                            '1' => 'Ya',
                                                            '2' => 'Tidak'
                                                        ])
                                                        ->visible(fn(Get $get) => $get('limbah_organik') === '1'),
                                                ]),

                                            Section::make('1106. Penggunaan Teknologi untuk Pengolahan Limbah')
                                                ->schema([
                                                    Radio::make('penggunaan_teknologi')
                                                        ->label('Apakah usaha ini menggunakan teknologi untuk mengolah limbah?')
                                                        ->options([
                                                            '1' => 'Ya',
                                                            '2' => 'Tidak'
                                                        ]),
                                                ]),

                                            Section::make('1107. Upaya Pengurangan Limbah')
                                                ->schema([
                                                    Radio::make('pengurangan_limbah')
                                                        ->label('Apakah usaha ini telah melakukan upaya pengurangan limbah?')
                                                        ->helperText('contoh: mengubah/mengganti metode produksi untuk mengurangi produksi limbah, mengadopsi mesin
yang menggunakan bahan baku lebih efisien dan menghasilkan limbah lebih sedikit')
                                                        ->options([
                                                            '1' => 'Ya',
                                                            '2' => 'Tidak'
                                                        ]),
                                                ]),

                                            Section::make('1108. Upaya Penggunaan Kembali Limbah')
                                                ->schema([
                                                    Radio::make('penggunaan_kembali')
                                                        ->label('Apakah usaha ini telah melakukan upaya penggunaan kembali limbah yang dihasilkan?')
                                                        ->helperText('contoh: mengolah limbah menjadi barang yang bernilai')
                                                        ->options([
                                                            '1' => 'Ya',
                                                            '2' => 'Tidak'
                                                        ]),
                                                ]),
                                        ]),

                                ])
                                ->visible(fn(Get $get) => $get('hasil_limbah') === '1'),

                            Section::make('1109. Penggunaan Plastik Sekali Pakai')
                                ->schema([
                                    Radio::make('plastik_sekali_pakai')
                                        ->label('a. Apakah usaha ini menggunakan plastik sekali pakai?')
                                        ->helperText('contoh: kantong plastik kresek, trash bag, plastik 1/4 kg')
                                        ->options([
                                            '1' => 'Ya',
                                            '2' => 'Tidak'
                                        ])
                                        ->reactive(),

                                    Radio::make('pengurangan_plastik')
                                        ->label('b. Apakah usaha ini sudah mengurangi penggunaan plastik sekali pakai?')
                                        ->helperText('contoh: menggunakan paper bag/menawarkan totebag')
                                        ->options([
                                            '1' => 'Ya',
                                            '2' => 'Tidak'
                                        ])
                                        ->visible(fn(Get $get) => $get('plastik_sekali_pakai') === '1'),
                                ]),

                            // 1110
                            Section::make('1110. Produksi Barang/Jasa Ramah Lingkungan')
                                ->schema([
                                    Radio::make('produk_ramah_lingkungan')
                                        ->label('Apakah usaha ini memproduksi barang/jasa ramah lingkungan? (ramah lingkungan/hemat sumber daya/efisien dalam penggunaan bahan)')
                                        ->helperText('contoh: memproduksi produk dari bahan daur ulang, jasa pengolahan sampah, jasa pengumpul sampah')
                                        ->options([
                                            '1' => 'Ya, seluruhnya',
                                            '2' => 'Ya, sebagian',
                                            '3' => 'Tidak sama sekali'
                                        ]),
                                ]),

                            // 1111
                            Section::make('1111. Penggunaan Air dalam Kegiatan Usaha')
                                ->schema([
                                    Radio::make('penggunaan_air')
                                        ->label('a. Apakah usaha ini menggunakan air dalam kegiatan usaha?')
                                        ->options([
                                            '1' => 'Ya',
                                            '2' => 'Tidak'
                                        ])
                                        ->reactive(),

                                    CheckboxList::make('sumber_air')
                                        ->label('b. Sumber perolehan air yang digunakan:')
                                        ->options([
                                            '1' => 'Air tanah',
                                            '2' => 'Air kemasan/isi ulang',
                                            '3' => 'Usaha/perusahaan air minum (PDAM/PAM)',
                                            '4' => 'Usaha/perusahaan air baku',
                                            '5' => 'Sungai/danau/waduk',
                                            '6' => 'Lainnya',
                                        ])
                                        ->reactive()
                                        ->visible(fn(Get $get) => $get('penggunaan_air') === '1'),

                                    TextInput::make('sumber_air_lainnya')
                                        ->label('Sebutkan jika lainnya:')
                                        ->visible(fn(Get $get) => in_array('6', (array) $get('sumber_air'))),

                                    Radio::make('pembuangan_air')
                                        ->label('c. Apakah air sisa produksi dibuang sembarangan?')
                                        ->options([
                                            '1' => 'Ya',
                                            '2' => 'Tidak'
                                        ])
                                        ->visible(fn(Get $get) => $get('penggunaan_air') === '1'),

                                    Radio::make('penghematan_air')
                                        ->label('d. Apakah usaha ini menggunakan air seperlunya?')
                                        ->helperText('(contoh: mematikan air keran jika tidak digunakan)')
                                        ->options([
                                            '1' => 'Ya',
                                            '2' => 'Tidak'
                                        ])
                                        ->visible(fn(Get $get) => $get('penggunaan_air') === '1'),
                                ]),

                            // 1112
                            Section::make('1112. Penggunaan Energi dalam Kegiatan Usaha')
                                ->schema([
                                    Radio::make('penggunaan_energi')
                                        ->label('a. Apakah usaha ini menggunakan energi dalam kegiatan usaha?')
                                        ->helperText('contoh: penggunaan bensin, solar, tenaga surya, dsb.')
                                        ->options([
                                            '1' => 'Ya',
                                            '2' => 'Tidak'
                                        ])
                                        ->reactive(),

                                    Radio::make('pengecekan_energi')
                                        ->label('b. Apakah usaha ini mengecek penggunaan energi secara rutin?')
                                        ->options([
                                            '1' => 'Ya',
                                            '2' => 'Tidak'
                                        ])
                                        ->visible(fn(Get $get) => $get('penggunaan_energi') === '1'),

                                    Radio::make('energi_terbarukan_dulu')
                                        ->label('c. Apakah usaha ini pernah menggunakan energi terbarukan?')
                                        ->helperText('contoh: pernah menggunakan kompor bertenaga kayu bakar dalam mengolah produk usaha')
                                        ->options([
                                            '1' => 'Ya',
                                            '2' => 'Tidak'
                                        ])
                                        ->visible(fn(Get $get) => $get('penggunaan_energi') === '1'),

                                    Radio::make('energi_terbarukan_sekarang')
                                        ->label('d. Apakah usaha ini masih menggunakan energi terbarukan?')
                                        ->options([
                                            '1' => 'Ya',
                                            '2' => 'Tidak'
                                        ])
                                        ->reactive()
                                        ->visible(fn(Get $get) => $get('energi_terbarukan_dulu') === '1'),

                                    CheckboxList::make('alasan_tidak_pakai_energi_terbarukan')
                                        ->label('e. Jika tidak, apa alasan usaha ini tidak menggunakan energi terbarukan?')
                                        ->options([
                                            '1' => 'Mahal',
                                            '2' => 'Akses dan infrastruktur terbatas',
                                            '3' => 'Tidak mengetahui energi terbarukan',
                                            '4' => 'Lainnya',
                                        ])
                                        ->reactive()
                                        ->visible(fn(Get $get) => $get('energi_terbarukan_sekarang') === '2'),

                                    TextInput::make('alasan_tidak_pakai_energi_terbarukan_lainnya')
                                        ->label('Sebutkan jika lainnya:')
                                        ->visible(fn(Get $get) => in_array('4', (array) $get('alasan_tidak_pakai_energi_terbarukan'))),
                                ]),
                            Section::make('1113. Penggunaan dan Penghematan Listrik')
                                ->schema([
                                    Radio::make('penggunaan_listrik')
                                        ->label('a. Sebulan yang lalu, apakah usaha ini menggunakan listrik dalam kegiatan usaha?')
                                        ->options([
                                            '1' => 'Ya',
                                            '2' => 'Tidak'
                                        ])
                                        ->reactive(),
                                    Radio::make('penghematan_listrik')
                                        ->label('b. Sebulan yang lalu, apakah usaha ini menghemat listrik yang digunakan untuk kegiatan usaha?')
                                        ->helperText('Contoh: mematikan lampu jika tidak digunakan.')
                                        ->options([
                                            '1' => 'Ya',
                                            '2' => 'Tidak'
                                        ])
                                        ->visible(fn(Get $get) => $get('penggunaan_listrik') === '1'),
                                ]),

                            Section::make('1114. Pengeluaran untuk Perlindungan Lingkungan')
                                ->schema([
                                    Radio::make('pengeluaran_perlindungan_lingkungan')
                                        ->label('Apakah usaha ini mengeluarkan biaya untuk perlindungan lingkungan?')
                                        ->helperText('Contoh: iuran rutin, pengeluaran untuk panel surya, kendaraan hemat bahan bakar, peralatan hemat listrik, atau hasil daur ulang.')
                                        ->options([
                                            '1' => 'Ya',
                                            '2' => 'Tidak (Lanjut ke Blok XII)',
                                        ])
                                        ->reactive(),
                                ]),

                            Section::make('1115. Pengeluaran Perlindungan Lingkungan')
                                ->schema([
                                    Section::make('a. Pengeluaran Operasional Eksternal')
                                        ->schema([
                                            TextInput::make('iuran_rutin')
                                                ->label('1) Iuran rutin (misal: persetujuan pembuangan limbah)')
                                                ->numeric()
                                                ->prefix('Rp')
                                                ->live(),

                                            TextInput::make('pembuangan_limbah_tidak_berbahaya')
                                                ->label('2) Pengeluaran untuk pembuangan limbah padat tidak berbahaya')
                                                ->numeric()
                                                ->prefix('Rp')
                                                ->live(),

                                            TextInput::make('pembuangan_limbah_berbahaya')
                                                ->label('3) Pengeluaran untuk pembuangan limbah padat khusus/berbahaya')
                                                ->numeric()
                                                ->prefix('Rp')
                                                ->live(),

                                            TextInput::make('pengelolaan_limbah_cair')
                                                ->label('4) Pengeluaran untuk pengelolaan limbah cair')
                                                ->numeric()
                                                ->prefix('Rp')
                                                ->live(),

                                            TextInput::make('pembuangan_limbah_cair')
                                                ->label('5) Pengeluaran untuk pembuangan limbah cair')
                                                ->numeric()
                                                ->prefix('Rp')
                                                ->live(),

                                            TextInput::make('pengeluaran_lainnya')
                                                ->label('6) Lainnya, sebutkan:')
                                                ->reactive(),

                                            TextInput::make('pengeluaran_lainnya_nilai')
                                                ->label('Nilai (Rp)')
                                                ->numeric()
                                                ->prefix('Rp')
                                                ->live()
                                                ->visible(fn(Get $get) => !empty($get('pengeluaran_lainnya'))),

                                            TextInput::make('total_pengeluaran')
                                                ->label('Total Pengeluaran (Rp)')
                                                ->prefix('Rp')
                                                ->disabled()
                                                ->dehydrated(false)
                                                ->live()
                                                ->afterStateUpdated(
                                                    fn(Set $set, Get $get) =>
                                                    $set('total_pengeluaran', array_sum(array_filter([
                                                        $get('iuran_rutin'),
                                                        $get('pembuangan_limbah_tidak_berbahaya'),
                                                        $get('pembuangan_limbah_berbahaya'),
                                                        $get('pengelolaan_limbah_cair'),
                                                        $get('pembuangan_limbah_cair'),
                                                        $get('pengeluaran_lainnya_nilai'),
                                                    ], fn($value) => !empty($value) && is_numeric($value))))
                                                ),
                                        ]),

                                    Section::make('b. Barang/Peralatan Habis Pakai untuk Tempat Penampungan Limbah')
                                        ->schema([
                                            Repeater::make('barang_habis_pakai')
                                                ->label('Daftar Barang')
                                                ->schema([
                                                    TextInput::make('nama_barang')
                                                        ->label('Nama Peralatan')
                                                        // ->required()
                                                        ,
                                                    TextInput::make('jumlah_barang')
                                                        ->label('Jumlah (unit)')
                                                        ->numeric()
                                                        // ->required()
                                                        ,
                                                    TextInput::make('nilai_barang')
                                                        ->label('Nilai (Rp)')
                                                        ->numeric()
                                                        ->prefix('Rp')
                                                        // ->required()
                                                        ,
                                                ])
                                                ->afterStateUpdated(function (Set $set, Get $get) {
                                                    $set('total_nilai_barang', array_sum(array_column($get('barang_habis_pakai') ?? [], 'nilai_barang')));
                                                }),

                                            TextInput::make('total_nilai_barang')
                                                ->label('Total Nilai Barang (Rp)')
                                                ->prefix('Rp')
                                                ->disabled()
                                                ->dehydrated(false),
                                        ]),
                                ])
                                ->visible(fn(Get $get) => $get('pengeluaran_perlindungan_lingkungan') === '1'),
                        ]),

                    Step::make('BLOK XII. PENGETAHUAN AKTIVITAS LINGKUNGAN')
                        ->icon('heroicon-o-academic-cap')
                        ->schema([
                            Section::make('1201')
                                ->schema([
                                    Radio::make('1201')
                                        ->label('Semua jenis limbah dapat langsung dibuang ke tempat pembuangan akhir tanpa harus diolah terlebih dahulu.')
                                        ->options([
                                            '1' => 'Benar',
                                            '2' => 'Salah'
                                        ])
                                ]),

                            Section::make('1202')
                                ->schema([
                                    Radio::make('1202')
                                        ->label('Mendaur ulang limbah dapat mengurangi sampah kegiatan usaha.')
                                        ->options([
                                            '1' => 'Benar',
                                            '2' => 'Salah'
                                        ])
                                ]),

                            Section::make('1203')
                                ->schema([
                                    Radio::make('1203')
                                        ->label('Mengolah limbah cair yang dihasilkan sebelum dibuang dapat mengurangi dampak buruk terhadap lingkungan.')
                                        ->options([
                                            '1' => 'Benar',
                                            '2' => 'Salah'
                                        ])
                                ]),
                            Section::make('1204')
                                ->schema([
                                    Radio::make('1204')
                                        ->label('Limbah yang mengandung Bahan Berbahaya dan Beracun tidak perlu dipisahkan dengan limbah biasa.')
                                        ->options([
                                            '1' => 'Benar',
                                            '2' => 'Salah'
                                        ])
                                ]),
                            Section::make('1205')
                                ->schema([
                                    Radio::make('1205')
                                        ->label('Mengolah limbah menjadi produk yang bermanfaat dapat meningkatkan keuntungan usaha.')
                                        ->options([
                                            '1' => 'Benar',
                                            '2' => 'Salah'
                                        ])
                                ]),
                            Section::make('1206')
                                ->schema([
                                    Radio::make('1206')
                                        ->label('Penghematan penggunaan energi dapat mendorong inovasi Usaha Mikro dan Kecil.')
                                        ->helperText('contoh : mengganti motor biasa menjadi motor listrik')
                                        ->options([
                                            '1' => 'Benar',
                                            '2' => 'Salah'
                                        ])
                                ]),
                            Section::make('1207')
                                ->schema([
                                    Radio::make('1207')
                                        ->label('Penggunaan BBM secara hemat dapat mengurangi kelangkaan BBM di masa depan.')
                                        ->helperText('contoh: solar, pertalite, pertamax')
                                        ->options([
                                            '1' => 'Benar',
                                            '2' => 'Salah'
                                        ])
                                ]),
                            Section::make('1208')
                                ->schema([
                                    Radio::make('1208')
                                        ->label(' Menanam pohon di sekitar lokasi usaha adalah salah satu cara menjaga lingkungan.')
                                        ->options([
                                            '1' => 'Benar',
                                            '2' => 'Salah'
                                        ])
                                ]),
                            Section::make('1209')
                                ->schema([
                                    Radio::make('1209')
                                        ->label('Menjaga kelestarian lingkungan sekitar kurang sesuai dengan Usaha Mikro dan Kecil.')
                                        ->options([
                                            '1' => 'Benar',
                                            '2' => 'Salah'
                                        ])
                                ]),
                            Section::make('1210')
                                ->schema([
                                    Radio::make('1210')
                                        ->label('Sudah ada peraturan yang membahas tentang menjaga lingkungan.')
                                        ->options([
                                            '1' => 'Benar',
                                            '2' => 'Salah'
                                        ])
                                ]),
                            Section::make('1211')
                                ->schema([
                                    Radio::make('1211')
                                        ->label('Peraturan menjaga lingkungan dapat membantu keberlangsungan usaha.')
                                        ->options([
                                            '1' => 'Benar',
                                            '2' => 'Salah'
                                        ])
                                ]),
                            Section::make('1212')
                                ->schema([
                                    Radio::make('1212')
                                        ->label('Usaha Mikro dan Kecil dapat bekerja sama dengan pemerintah setempat untuk mendapatkan bantuan mengelola limbah.')
                                        ->options([
                                            '1' => 'Benar',
                                            '2' => 'Salah'
                                        ])
                                ]),
                            Section::make('1213')
                                ->schema([
                                    Radio::make('1213')
                                        ->label('Pelatihan menjaga lingkungan hanya membuang waktu dan uang bagi Usaha Mikro dan Kecil.')
                                        ->options([
                                            '1' => 'Benar',
                                            '2' => 'Salah'
                                        ])
                                ]),
                            Section::make('1214')
                                ->schema([
                                    Radio::make('1214')
                                        ->label('Usaha Mikro dan Kecil tidak wajib menggunakan teknologi ramah lingkungan karena tidak berdampak terhadap lingkungan.')
                                        ->options([
                                            '1' => 'Benar',
                                            '2' => 'Salah'
                                        ])
                                ]),
                            Section::make('1215')
                                ->schema([
                                    Radio::make('1215')
                                        ->label('Edukasi terkait mengelola limbah sangat penting untuk meningkatkan keberlangsungan usaha.')
                                        ->options([
                                            '1' => 'Benar',
                                            '2' => 'Salah'
                                        ])
                                ]),
                        ]),

                    Step::make('BLOK XIII. DAFTAR USAHA')
                        ->icon('heroicon-o-building-office')
                        ->schema([
                            Section::make('1301')
                                ->schema([
                                    Radio::make('memiliki_usaha_sebelumnya')
                                        ->label('a. Apakah [nama pengusaha] memiliki usaha lain yang dijalankan sebelumnya?')
                                        ->options([
                                            '1' => 'Ya',
                                            '2' => 'Tidak'
                                        ])
                                        // ->required()
                                        ->reactive(),

                                    Forms\Components\Repeater::make('daftar_usaha_sebelumnya')
                                        ->schema([
                                            TextInput::make('nama_usaha')
                                                ->label('Nama Usaha')
                                                // ->required()
                                                ->maxLength(255)
                                                ->columnSpan('full'),

                                            grid::make(1)
                                                ->schema([
                                                    TextInput::make('waktu_pendirian')
                                                        ->label('Waktu Pendirian')
                                                        ->placeholder('MM/YYYY')
                                                        ->mask('99/9999')
                                                        // ->required()
                                                        ->validationAttribute('waktu pendirian')
                                                        ->regex('/^(0[1-9]|1[0-2])\/([0-9]{4})$/'),

                                                    TextInput::make('waktu_berhenti')
                                                        ->label('Waktu Berhenti')
                                                        ->placeholder('MM/YYYY')
                                                        ->mask('99/9999')
                                                        // ->required()
                                                        ->validationAttribute('waktu berhenti')
                                                        ->regex('/^(0[1-9]|1[0-2])\/([0-9]{4})$/'),
                                                ]),

                                            Textarea::make('kegiatan_utama')
                                                ->label('Tuliskan secara lengkap Jenis Jegiatan Utama')
                                                // ->required()
                                                ->maxLength(255)
                                                ->rows(3)
                                                ->columnSpan('full'),

                                            TextInput::make('kode_kbli')
                                                ->label('Kode KBLI')
                                                // ->required()
                                                ->maxLength(5)
                                                ->numeric()
                                                ->columnSpan('full'),
                                        ])
                                        ->columns(1)
                                        ->itemLabel(fn(array $state): ?string => $state['nama_usaha'] ?? null)
                                        ->collapsible()
                                        ->collapsed()
                                        ->defaultItems(1)
                                        ->addActionLabel('Tambah Usaha Sebelumnya')
                                        ->deletable(true)
                                        ->reorderable(true)
                                        ->cloneable(false)
                                        ->reactive()
                                        ->visible(fn(Get $get): bool => $get('memiliki_usaha_sebelumnya') === '1'),
                                ]),
                        ]),

                    Step::make('Blok XIV. CATATAN')
                        ->icon('heroicon-o-book-open')
                        ->schema([
                            Textarea::make('catatan_wawancara')
                                ->label('CATATAN')
                                ->placeholder('Catat hal penting selama wawancara...')
                                ->rows(5)
                                ->columnSpanFull(),
                        ]),

                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_usaha')
                    ->label('Nama Usaha'),

                TextColumn::make('waktu_pendirian')
                    ->label('Waktu Pendirian'),

                TextColumn::make('waktu_berhenti')
                    ->label('Waktu Berhenti'),

                TextColumn::make('kegiatan_utama')
                    ->label('Kegiatan Utama'),

                TextColumn::make('kode_kbli')
                    ->label('Kode KBLI'),

                TextColumn::make('created_at')
                    ->label('Dibuat Pada'),

                TextColumn::make('updated_at')
                    ->label('Diubah Pada'),
            ])
            ->actions([
                EditAction::make(),
                ViewAction::make(),
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
            'index' => Pages\ListRisetUtamas::route('/'),
            'create' => Pages\CreateRisetUtama::route('/create'),
            'edit' => Pages\EditRisetUtama::route('/{record}/edit'),
        ];
    }
}
