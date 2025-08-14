<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Riset4q1Resource\Pages;
use App\Filament\Resources\Riset4q1Resource\RelationManagers;
use App\Models\Riset4q1;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class Riset4q1Resource extends Resource
{
    protected static ?string $model = Riset4q1::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';

    protected static ?string $navigationLabel = 'Kuisioner 1 - Riset 4';

    public static ?string $label = 'Kuisioner 1 - Riset 4';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('BLOK I: WILAYAH TUGAS Listing')
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
                                    Select::make('kabupaten_kota')
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
                                ]),

                            Section::make('103. Kecamatan')
                                ->schema([
                                    Select::make('kecamatan')
                                        ->label('Kecamatan')
                                        ->options(function (callable $get) {
                                            $kabKota = $get('kabupaten_kota');
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
                                        ->placeholder('Pilih Kecamatan'),
                                ]),

                            Section::make('105. Klasifikasi Wilayah')
                                ->schema([
                                    Select::make('klasifikasi_wilayah')
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
                                        ->label('Nomor Blok Sensus')
                                        ->placeholder('Masukkan nomor blok sensus'),
                                ]),

                            Section::make('107. Kode SLS/Non SLS')
                                ->schema([
                                    Select::make('kode_sls')
                                        ->label('Kode SLS/Non SLS')
                                        ->options(function () {
                                            return \DB::table('sls')->pluck('sls', 'sls');
                                        })
                                        ->searchable()
                                        ->live()
                                        ->afterStateUpdated(function ($state, callable $set) {
                                            $nmSls = \DB::table('sls')
                                                ->where('sls', $state)
                                                ->value('nm_sls');
                                            $set('nama_sls', $nmSls);
                                        })
                                        ->placeholder('Pilih Kode SLS/Non SLS'),
                                ]),

                            Section::make('107. Nama SLS/Non SLS')
                                ->schema([
                                    Select::make('nama_sls')
                                        ->label('Nama SLS/Non SLS')
                                        ->options(function () {
                                            return \DB::table('sls')->pluck('nm_sls', 'nm_sls');
                                        })
                                        ->searchable()
                                        ->live()
                                        ->afterStateUpdated(function ($state, callable $set) {
                                            $sls = \DB::table('sls')
                                                ->where('nm_sls', $state)
                                                ->value('sls');
                                            $set('kode_sls', $sls);
                                        })
                                        ->placeholder('Pilih Nama SLS/Non SLS'),
                                ]),
                        ]),

                    Step::make('BLOK II. IDENTITAS PETUGAS')
                        ->schema([
                            Section::make('201. Nama PCL')
                                ->schema([
                                    TextInput::make('pcl_nama')
                                        ->label('Nama')
                                        ->maxLength(50)
                                        ->placeholder('Masukkan nama PCL'),
                                ]),
                            Section::make('202. NIM PCL')
                                ->schema([
                                    TextInput::make('pcl_nim')
                                        ->label('NIM')
                                        ->numeric()
                                        ->length(9)
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
                                        ->placeholder('Pilih jenis kelamin'),
                                ]),
                        ]),

                    Step::make('BLOK III. IDENTITAS KORTIM')
                        ->schema([
                            Section::make('301. Nama Kortim')
                                ->schema([
                                    TextInput::make('kortim_nama')
                                        ->label('Nama')
                                        ->maxLength(50)
                                        ->placeholder('Masukkan nama Kortim'),
                                ]),
                            Section::make('302. NIM Kortim')
                                ->schema([
                                    TextInput::make('kortim_nim')
                                        ->label('NIM')
                                        ->numeric()
                                        ->length(9)
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

                    Step::make('BLOK IV. PENJAMINAN KUALITAS LISTING')
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
                                        ->label('b. Apakah PCL telah membawa daftar sampel SLS terpilih?')
                                        ->options([
                                            '1' => 'Ya',
                                            '0' => 'Tidak',
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                    Select::make('kd_kuesioner_listing')
                                        ->label('c. Apakah PCL telah membawa kuesioner listing unit rumah tangga UMK?')
                                        ->options([
                                            '1' => 'Ya',
                                            '0' => 'Tidak',
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                    Select::make('kd_bukped_listing')
                                        ->label('d. Apakah PCL telah membawa buku pedoman listing unit rumah tangga UMK?')
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
                            Section::make('403. Koordinasi Ketua SLS')
                                ->schema([
                                    Select::make('koordinasi_ketua_sls')
                                        ->label('Apakah PCL dan kortim telah berkoordinasi pada ketua SLS sebelum melakukan listing?')
                                        ->options([
                                            '1' => 'Belum berkoordinasi dengan ketua SLS',
                                            '2' => 'Telah berkoordinasi tetapi bukan dengan ketua SLS',
                                            '3' => 'Telah berkoordinasi dengan ketua SLS'
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                ]),
                            Section::make('404. Proses Penelusuran Wilayah')
                                ->schema([
                                    Select::make('proses_penelusuran_wilayah')
                                        ->label('Apakah PCL sudah melakukan penelusuran wilayah secara langsung di wilayah kerjanya?')
                                        ->options([
                                            '1' => 'Belum melakukan',
                                            '2' => 'Sudah melakukan pada sebagian wilayah SLS',
                                            '3' => 'Sudah melakukan pada seluruh wilayah SLS'
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                ]),
                            Section::make('405. Cakupan Listing')
                                ->schema([
                                    Select::make('cakupan_listing')
                                        ->label('Apakah PCL sudah melakukan listing terhadap seluruh rumah tangga di wilayah SLS?')
                                        ->options([
                                            '1' => 'Belum melakukan',
                                            '2' => 'Sudah melakukan pada sebagian wilayah SLS',
                                            '3' => 'Sudah melakukan pada seluruh wilayah SLS'
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                ]),
                            Section::make('406. geotagging')
                                ->schema([
                                    Select::make('geotagging')
                                        ->label('Apakah PCL sudah menandai batas wilayah atau geotagging?')
                                        ->options([
                                            '1' => 'Belum melakukan geotagging sama sekali',
                                            '2' => 'Sudah melakukan geotagging tetapi belum sepenuhnya',
                                            '3' => 'Telah geotagging sepenuhnya'
                                        ])
                                        ->placeholder('Pilih Jawaban'),
                                ]),
                        ]),
                ])
                ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('provinsi')
                    ->searchable(),
                TextColumn::make('kabupaten_kota')
                    ->searchable(),
                TextColumn::make('kecamatan')
                    ->searchable(),
                TextColumn::make('nomor_blok_sensus')
                    ->searchable(),
                TextColumn::make('kode_sls')
                    ->searchable(),
                TextColumn::make('nama_sls')
                    ->searchable(),
                TextColumn::make('pcl_nama')
                    ->label('PCL')
                    ->searchable(),
                TextColumn::make('kortim_nama')
                    ->label('Kortim')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRiset4q1s::route('/'),
            'create' => Pages\CreateRiset4q1::route('/create'),
            'edit' => Pages\EditRiset4q1::route('/{record}/edit'),
        ];
    }
}
