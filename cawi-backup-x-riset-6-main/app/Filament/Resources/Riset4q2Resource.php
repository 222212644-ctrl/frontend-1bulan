<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Riset4q2Resource\Pages;
use App\Filament\Resources\Riset4q2Resource\RelationManagers;
use App\Models\Riset4q2;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class Riset4q2Resource extends Resource
{
    protected static ?string $model = Riset4q2::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Kuisioner 2 - Riset 4';

    public static ?string $label = 'Kuisioner 2 - Riset 4';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('Blok 1: Wilayah Tugas')
                        ->schema([
                            Section::make('101. Provinsi')
                                ->schema([
                                    Select::make('provinsi')
                                        ->label('Provinsi')
                                        ->options([
                                            '16' => 'SUMATERA SELATAN'
                                        ])
                                        ->default('16')
                                        ->disabled(),
                                ]),

                            Section::make('102. Kabupaten/Kota')
                                ->schema([
                                    Select::make('kab_kota')
                                        ->label('Kabupaten/Kota')
                                        ->options([
                                            '1602' => 'Ogan Komering Ilir',
                                            '1610' => 'Ogan Ilir',
                                            '1671' => 'Palembang',
                                            '1672' => 'Prabumulih',
                                        ])
                                        ->reactive()
                                        ->searchable()
                                        ->placeholder('Pilih Kabupaten/Kota')
                                    // ->required(),
                                ]),

                            Section::make('103. Kecamatan')
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
                                                return $response->successful()
                                                    ? collect($response->json())
                                                        ->map(fn($item) => [
                                                            'id' => $item['id'],
                                                            'name' => Str::title(strtolower($item['name']))
                                                        ])
                                                        ->pluck('name', 'id')
                                                        ->toArray()
                                                    : [];
                                            } catch (\Exception $e) {
                                                return [];
                                            }
                                        })
                                        ->reactive()
                                        // ->required()
                                        ->placeholder('Pilih Kecamatan'),
                                ]),

                            Section::make('105. Klasifikasi Wilayah')
                                ->schema([
                                    Select::make('klasifikasi_wilayah')
                                        // ->required()
                                        ->label('Klasifikasi Wilayah')
                                        ->options([
                                            'Perdesaan' => 'Perdesaan',
                                            'Perkotaan' => 'Perkotaan',
                                        ])
                                        ->placeholder('Pilih Klasifikasi Wilayah'),
                                ]),
                            Section::make('106. Nomor Blok Sensus')
                                ->schema([
                                    TextInput::make('nomor_blok_sensus')
                                        // ->required()
                                        ->label('Nomor Blok Sensus')
                                        ->placeholder('Masukkan nomor blok sensus'),
                                ])
                        ]),

                    Step::make('Blok 2: Identitas PCL')
                        ->schema([
                            Section::make('201. Nama PCL')
                                ->schema([
                                    TextInput::make('pcl_nama')
                                        // ->required()
                                        ->label('Nama')
                                        ->placeholder('Masukkan nama PCL'),
                                ]),
                            Section::make('202. NIM PCL')
                                ->schema([
                                    TextInput::make('pcl_nim')
                                        // ->required()
                                        ->label('NIM')
                                        ->numeric()
                                        ->placeholder('Masukkan NIM PCL'),
                                ]),
                            Section::make('203. Jenis Kelamin PCL')
                                ->schema([
                                    Select::make('pcl_jenis_kelamin')
                                        ->label('Jenis Kelamin')
                                        ->options([
                                            'L' => 'Laki-laki',
                                            'P' => 'Perempuan',
                                        ])
                                        // ->required()
                                        ->placeholder('Pilih jenis kelamin'),
                                ]),
                        ]),

                    Step::make('Blok 3: Identitas Kortim')
                        ->schema([
                            Section::make('301. Nama Kortim')
                                ->schema([
                                    TextInput::make('kortim_nama')
                                        ->label('Nama')
                                        ->placeholder('Masukkan nama Kortim'),
                                ]),
                            Section::make('302. NIM Kortim')
                                ->schema([
                                    TextInput::make('kortim_nim')
                                        ->label('NIM')
                                        ->numeric()
                                        ->placeholder('Masukkan NIM Kortim'),
                                ]),
                            Section::make('303. Jenis Kelamin Kortim')
                                ->schema([
                                    Select::make('kortim_jenis_kelamin')
                                        ->label('Jenis Kelamin')
                                        ->options([
                                            'L' => 'Laki-laki',
                                            'P' => 'Perempuan',
                                        ])
                                        ->placeholder('Pilih jenis kelamin'),
                                ]),
                        ]),

                    Step::make('Blok 4: Penjaminan Kualitas Pencacahan')
                        ->schema([
                            Section::make('401. Kelengkapan Dokumen')
                                ->schema([
                                    Select::make('kd_peta')
                                        ->label('a. Apakah PCL telah membawa Peta WA?')
                                        ->options([
                                            '1' => 'Ya',
                                            '0' => 'Tidak',
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                    Select::make('kd_daftar_sls')
                                        ->label('b. Apakah PCL telah membawa daftar SLS terpilih?')
                                        ->options([
                                            '1' => 'Ya',
                                            '0' => 'Tidak',
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                    Select::make('kd_daftar_sampel_sls')
                                        ->label('c. Apakah PCL telah membawa kuesioner pencacahan unit rumah tangga UMK?')
                                        ->options([
                                            '1' => 'Ya',
                                            '0' => 'Tidak',
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                    Select::make('kd_bukped_listing')
                                        ->label('d. Apakah PCL telah membawa buku pedoman pencacahan unit rumah tangga UMK?')
                                        ->options([
                                            '1' => 'Ya',
                                            '0' => 'Tidak',
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                    Select::make('kd_surat_tugas')
                                        ->label('e. Apakah PCL telah membawa surat tugas?')
                                        ->options([
                                            '1' => 'Ya',
                                            '0' => 'Tidak',
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                    Select::make('kd_surat_izin')
                                        ->label('f. Apakah PCL telah membawa Surat Izin dari DPMPTSP ?')
                                        ->options([
                                            '1' => 'Ya',
                                            '0' => 'Tidak',
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                ]),
                            Section::make('402. Kelengkapan Instrumen')
                                ->schema([
                                    Select::make('kelengkapan_instrumen')
                                        ->label('Apakah PCL sudah membawa keseluruhan perlengkapan instrumen listing?')
                                        ->helperText('Perlengkapan instrumen terdiri dari: 1. Badge dan/atau lanyard, jaket PKL 2. Alat tulis, jas hujan, obat-obatan, dan perlengkapan pelengkap lainnya')
                                        ->options([
                                            '1' => 'Ya',
                                            '0' => 'Tidak',
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                ]),
                            Section::make('403. Salam Pembuka')
                                ->schema([
                                    Select::make('salam_pembuka')
                                        ->label('Apakah PCL sudah mengucapkan salam saat memulai kegiatan pencacahan?')
                                        ->options([
                                            '1' => 'Ya',
                                            '0' => 'Tidak',
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                ]),
                            Section::make('404. Kesediaan Responden')
                                ->schema([
                                    Select::make('kesediaan_responden')
                                        ->label('Apakah PCL sudah menanyakan kesediaan responden untuk diwawancara?')
                                        ->options([
                                            '1' => 'Ya',
                                            '0' => 'Tidak',
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                ]),
                            Section::make('405. Perkenalan')
                                ->schema([
                                    Select::make('perkenalan')
                                        ->label('Apakah PCL telah memperkenalkan diri dan menunjukkan identitas kepada responden?')
                                        ->options([
                                            '1' => 'Ya',
                                            '0' => 'Tidak',
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                ]),
                            Section::make('406. Tujuan Wawancara')
                                ->schema([
                                    Select::make('tujuan_wawancara')
                                        ->label('Apakah tujuan wawancara sudah tersampaikan dengan jelas kepada responden?')
                                        ->options([
                                            '1' => 'Ya',
                                            '0' => 'Tidak',
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                ]),
                            Section::make('407. Surat Tugas')
                                ->schema([
                                    Select::make('surat_tugas')
                                        ->label('Apakah PCL sudah menunjukkan surat tugas?')
                                        ->options([
                                            '1' => 'Ya',
                                            '0' => 'Tidak',
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                ]),
                            Section::make('408. Jaminan Kerahasiaan')
                                ->schema([
                                    Select::make('jaminan_kerahasiaan')
                                        ->label('Apakah PCL telah memberitahu penjaminan kerahasiaan dari data yang diberikan oleh responden?')
                                        ->options([
                                            '1' => 'Ya',
                                            '0' => 'Tidak',
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                ]),
                            Section::make('409. Kondisi Lingkungan')
                                ->schema([
                                    Select::make('kondisi_lingkungan')
                                        ->label('Apakah PCL memastikan kondisi lingkungan wawancara sudah kondusif untuk melakukan wawancara?')
                                        ->options([
                                            '1' => 'Ya',
                                            '0' => 'Tidak',
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                ]),
                            Section::make('410. Probing')
                                ->schema([
                                    Select::make('probing')
                                        ->label('Apakah PCL melakukan probing pada poin pertanyaan yang harus/disarankan dilakukan probing?')
                                        ->options([
                                            '0' => 'Tidak',
                                            '1' => 'Sebagian kecil',
                                            '2' => 'Sebagian besar',
                                            '3' => 'Seluruhnya',
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                ]),
                            Section::make('411. Konfirmasi Ulang')
                                ->schema([
                                    Select::make('konfirmasi_ulang')
                                        ->label('Apakah PCL sudah melakukan konfirmasi ulang jawaban yang telah diberikan responden? (khusus pada pertanyaan yang memerlukan probing)')
                                        ->options([
                                            '0' => 'Tidak melakukan konfirmasi',
                                            '1' => 'Sebagian kecil melakukan konfirmasi',
                                            '2' => 'Sebagian besar melakukan konfirmasi',
                                            '3' => 'Melakukan konfirmasi sepenuhnya',
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                ]),
                            Section::make('412. Pemahaman Konsep dan Definisi')
                                ->schema([
                                    Select::make('pemahaman_konsep_dan_definisi')
                                        ->label('Apakah PCL sudah menjelaskan konsep dan definisi terkait pertanyaan menggunakan bahasa yang mudah dipahami oleh responden?')
                                        ->options([
                                            '1' => 'Ya telah menyampaikan',
                                            '0' => 'Tidak menyampaikan',
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                ]),
                            Section::make('413. Leading')
                                ->schema([
                                    Select::make('leading')
                                        ->label('Apakah PCL melakukan leading dalam memperoleh jawaban pada blok tertentu?')
                                        ->options([
                                            '1' => 'Ya',
                                            '0' => 'Tidak',
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                ]),
                            Section::make('414. Pertanyaan Interogatif')
                                ->schema([
                                    Select::make('pertanyaan_interogatif')
                                        ->label('Apakah PCL bertanya secara interogatif pada blok tertentu?')
                                        ->options([
                                            '1' => 'Ya',
                                            '0' => 'Tidak',
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                ]),
                            Section::make('415. Pengulangan Pertanyaan')
                                ->schema([
                                    TextInput::make('pengulangan_pertanyaan')
                                        // ->required()
                                        ->label('Berapa kali (total) responden meminta pengulangan pertanyaan kepada PCL selama proses wawancara?')
                                        ->numeric()
                                        ->placeholder('Masukkan jawaban')
                                        ->minValue(0),
                                ]),
                            Section::make('416. Metode Bertanya')
                                ->schema([
                                    CheckboxList::make('metode_bertanya')
                                        // ->required()
                                        ->label('Apa saja metode bertanya yang digunakan PCL?')
                                        ->options([
                                            '0' => 'Membaca dengan tepat seperti yang tertulis',
                                            '1' => 'Melakukan perubahan kecil pada kata-kata',
                                            '2' => 'Melakukan perubahan besar pada kata-kata',
                                        ]),
                                ]),
                            Section::make('417. Kewajaran')
                                ->schema([
                                    Select::make('kewajaran')
                                        // ->required()
                                        ->label('Apakah PCL telah melakukan pengecekan kewajaran isian data responden di sesi akhir wawancara?')
                                        ->options([
                                            '1' => 'Ya',
                                            '0' => 'Tidak',
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                ]),
                            Section::make('418. Pemberitahuan Revisit')
                                ->schema([
                                    Select::make('pemberitahuan_revisit')
                                        // ->required()
                                        ->label('Apakah PCL telah memberitahukan kemungkinan kunjungan ulang atau revisit?')
                                        ->options([
                                            '1' => 'Ya',
                                            '0' => 'Tidak',
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                ]),
                            Section::make('419. Penutup Wawancara')
                                ->schema([
                                    Select::make('penutup_wawancara')
                                        // ->required()
                                        ->label('Apakah PCL menutup wawancara secara sopan dengan ucapan terima kasih?')
                                        ->options([
                                            '1' => 'Ya',
                                            '0' => 'Tidak',
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                ]),
                            Section::make('420. Waktu')
                                ->schema([
                                    TextInput::make('waktu')
                                        // ->required()
                                        ->label('Berapa lama waktu yang dibutuhkan untuk wawancara?')
                                        ->numeric()
                                        ->placeholder('Masukkan waktu dalam menit')
                                        ->minValue(0),
                                ]),
                        ])
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('provinsi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kabupaten_kota')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kecamatan')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nomor_blok_sensus')
                    ->searchable(),
                Tables\Columns\TextColumn::make('pcl_nama')
                    ->label('PCL')
                    ->searchable(),
                Tables\Columns\TextColumn::make('kortim_nama')
                    ->label('Kortim')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListRiset4q2s::route('/'),
            'create' => Pages\CreateRiset4q2::route('/create'),
            'edit' => Pages\EditRiset4q2::route('/{record}/edit'),
        ];
    }
}
