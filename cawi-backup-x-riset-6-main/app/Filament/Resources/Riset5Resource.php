<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Riset5Resource\Pages;
use App\Filament\Resources\Riset5Resource\RelationManagers;
use App\Models\Riset5;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Radio;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Forms\Components\Section;

class Riset5Resource extends Resource
{
    protected static ?string $model = Riset5::class;

    protected static ?string $navigationIcon = 'heroicon-o-device-phone-mobile';

    protected static ?string $navigationLabel = 'Kuisioner Riset 5';

    public static ?string $label = 'Kuisioner Riset 5';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Wizard::make([
                    Step::make('BLOK I: Identitas')
                        ->schema([
                            Section::make('ID1. Jenis Kelamin')
                                ->schema([
                                    Select::make('jenis_kelamin')
                                        ->label('Jenis Kelamin')
                                        ->options([
                                            'L' => 'Laki-laki',
                                            'P' => 'Perempuan',
                                        ])
                                        // ->required()
                                        ->placeholder('Pilih jenis kelamin'),
                                ]),
                            Section::make('ID2. Kelas')
                                ->schema([
                                    Select::make('kelas')
                                        ->label('Kelas')
                                        ->options([
                                            '3D31' => '3D31',
                                            '3D32' => '3D32',
                                            '3D33' => '3D33',
                                            '3SD1' => '3SD1',
                                            '3SD2' => '3SD2',
                                            '3SI1' => '3SI1',
                                            '3SI2' => '3SI2',
                                            '3SE1' => '3SE1',
                                            '3SE2' => '3SE2',
                                            '3SE3' => '3SE3',
                                            '3SE4' => '3SE4',
                                            '3SK1' => '3SK1',
                                            '3SK2' => '3SK2',
                                            '3SK3' => '3SK3',
                                            '3SK4' => '3SK4',
                                        ])
                                        // ->required()
                                        ->placeholder('Pilih Kelas'),
                                ]),
                            Section::make('ID3. Pengalaman CAPI/PAPI')
                                ->schema([
                                    Radio::make('pengalaman_capi/papi')
                                        ->label('Apakah anda pernah melakukan pencacahan melalui interview (CAPI dan PAPI)?')
                                        ->options([
                                            'capi' => 'Pernah CAPI Saja',
                                            'papi' => 'Pernah PAPI Saja',
                                            'both' => 'Pernah Keduanya',
                                            'none' => 'Tidak Pernah Keduanya',
                                        ])
                                        // ->required()
                                ])
                        ]),

                    Step::make('BLOK II: Information Quality')
                        ->schema([
                            Section::make('INQ1. Informasi Relevan')
                                ->schema([
                                    Radio::make('informasi_relevan')
                                        ->label('Aplikasi memberikan informasi yang relevan sesuai dengan kebutuhan')
                                        ->helperText('Mohon berikan penilaian berdasarkan pengalaman menggunakan CAPI pada FASIH bukan berdasarkan desain kuisioner')
                                        ->options([
                                            1 => 'Sangat Tidak Setuju',
                                            2 => 'Tidak Setuju',
                                            3 => 'Netral',
                                            4 => 'Setuju',
                                            5 => 'Sangat Setuju',
                                        ])
                                        // ->required()
                                ]),
                            Section::make('INQ2. Inforamsi Up to Date')
                                ->schema([
                                    Radio::make('informasi_up_to_date')
                                        ->label('Aplikasi memberikan informasi yang up to date')
                                        ->helperText('Mohon berikan penilaian berdasarkan pengalaman menggunakan CAPI pada FASIH bukan berdasarkan desain kuisioner')
                                        ->options([
                                            1 => 'Sangat Tidak Setuju',
                                            2 => 'Tidak Setuju',
                                            3 => 'Netral',
                                            4 => 'Setuju',
                                            5 => 'Sangat Setuju',
                                        ])
                                        // ->required()
                                ]),
                            Section::make('INQ3. Progress Pencacahan')
                                ->schema([
                                    Radio::make('progress_pencacahan')
                                        ->label('Saya dapat mengetahui progress pencacahan yang telah saya kerjakan melalui aplikasi')
                                        ->helperText('Mohon berikan penilaian berdasarkan pengalaman menggunakan CAPI pada FASIH bukan berdasarkan desain kuisioner')
                                        ->options([
                                            1 => 'Sangat Tidak Setuju',
                                            2 => 'Tidak Setuju',
                                            3 => 'Netral',
                                            4 => 'Setuju',
                                            5 => 'Sangat Setuju',
                                        ])
                                        // ->required()
                                ]),
                            Section::make('INQ4. Output Tidak Ambigu')
                                ->schema([
                                    Radio::make('output_tidak_ambigu')
                                        ->label('Aplikasi memberikan output yang tidak ambigu, konsisten, dan dapat dipercaya')
                                        ->helperText('Mohon berikan penilaian berdasarkan pengalaman menggunakan CAPI pada FASIH bukan berdasarkan desain kuisioner')
                                        ->options([
                                            1 => 'Sangat Tidak Setuju',
                                            2 => 'Tidak Setuju',
                                            3 => 'Netral',
                                            4 => 'Setuju',
                                            5 => 'Sangat Setuju',
                                        ])
                                        // ->required()
                                ]),
                        ]),

                    Step::make('BLOK III: System Quality')
                        ->schema([
                            Section::make('SYQ1. Fitur Mendukung')
                                ->schema([
                                    Radio::make('fitur_mendukung')
                                        ->label('Aplikasi ini menyediakan fitur yang saya butuhkan untuk mendukung kegiatan pencacahan')
                                        ->helperText('Mohon berikan penilaian berdasarkan pengalaman menggunakan CAPI pada FASIH bukan berdasarkan desain kuisioner')
                                        ->options([
                                            1 => 'Sangat Tidak Setuju',
                                            2 => 'Tidak Setuju',
                                            3 => 'Netral',
                                            4 => 'Setuju',
                                            5 => 'Sangat Setuju',
                                        ])
                                        // ->required()
                                ]),
                            Section::make('SYQ2. Mudah Digunakan')
                                ->schema([
                                    Radio::make('mudah_digunakan')
                                        ->label('Aplikasi mudah untuk digunakan kapan saja dan dimana saja selama kegiatan pencacahan')
                                        ->helperText('Mohon berikan penilaian berdasarkan pengalaman menggunakan CAPI pada FASIH bukan berdasarkan desain kuisioner')
                                        ->options([
                                            1 => 'Sangat Tidak Setuju',
                                            2 => 'Tidak Setuju',
                                            3 => 'Netral',
                                            4 => 'Setuju',
                                            5 => 'Sangat Setuju',
                                        ])
                                        // ->required()
                                ]),
                            Section::make('SYQ3. Respon Cepat')
                                ->schema([
                                    Radio::make('respon_cepat')
                                        ->label('Aplikasi memiliki waktu respon yang cepat ketika diakses')
                                        ->helperText('Mohon berikan penilaian berdasarkan pengalaman menggunakan CAPI pada FASIH bukan berdasarkan desain kuisioner')
                                        ->options([
                                            1 => 'Sangat Tidak Setuju',
                                            2 => 'Tidak Setuju',
                                            3 => 'Netral',
                                            4 => 'Setuju',
                                            5 => 'Sangat Setuju',
                                        ])
                                        // ->required()
                                ]),
                            Section::make('SYQ4. Pengisian Mudah')
                                ->schema([
                                    Radio::make('pengisian_mudah')
                                        ->label('Cara pengisian kuesioner pada aplikasi mudah dipahami')
                                        ->helperText('Mohon berikan penilaian berdasarkan pengalaman menggunakan CAPI pada FASIH bukan berdasarkan desain kuisioner')
                                        ->options([
                                            1 => 'Sangat Tidak Setuju',
                                            2 => 'Tidak Setuju',
                                            3 => 'Netral',
                                            4 => 'Setuju',
                                            5 => 'Sangat Setuju',
                                        ])
                                        // ->required()
                                ]),
                        ]),

                    Step::make('BLOK IV. Service Quality')
                        ->schema([
                            Section::make('SVQ1. Help Desk')
                                ->schema([
                                    Radio::make('help_desk')
                                        ->label('Aplikasi memiliki fasilitas untuk menghubungi teknisi (help desk) jika terdapat masalah dengan sistem')
                                        ->helperText('Mohon berikan penilaian berdasarkan pengalaman menggunakan CAPI pada FASIH bukan berdasarkan desain kuisioner')
                                        ->options([
                                            1 => 'Sangat Tidak Setuju',
                                            2 => 'Tidak Setuju',
                                            3 => 'Netral',
                                            4 => 'Setuju',
                                            5 => 'Sangat Setuju',
                                        ])
                                        // ->required()
                                ]),
                            Section::make('SVQ2. Petunjuk Jelas')
                                ->schema([
                                    Radio::make('petunjuk_jelas')
                                        ->label('Terdapat petunjuk yang cukup jelas tentang cara menggunakan aplikasi')
                                        ->helperText('Mohon berikan penilaian berdasarkan pengalaman menggunakan CAPI pada FASIH bukan berdasarkan desain kuisioner')
                                        ->options([
                                            1 => 'Sangat Tidak Setuju',
                                            2 => 'Tidak Setuju',
                                            3 => 'Netral',
                                            4 => 'Setuju',
                                            5 => 'Sangat Setuju',
                                        ])
                                        // ->required()
                                ]),
                            Section::make('SVQ3. Kenyamanan')
                                ->schema([
                                    Radio::make('kenyamanan')
                                        ->label('Pengguna merasa nyaman saat menggunakan aplikasi')
                                        ->helperText('Mohon berikan penilaian berdasarkan pengalaman menggunakan CAPI pada FASIH bukan berdasarkan desain kuisioner')
                                        ->options([
                                            1 => 'Sangat Tidak Setuju',
                                            2 => 'Tidak Setuju',
                                            3 => 'Netral',
                                            4 => 'Setuju',
                                            5 => 'Sangat Setuju',
                                        ])
                                        // ->required()
                                ]),
                        ]),

                    Step::make('BLOK V: Content')
                        ->schema([
                            Section::make('CON1. Isi Lengkap')
                                ->schema([
                                    Radio::make('isi_lengkap')
                                        ->label('Isi dari aplikasi sudah lengkap dan jelas')
                                        ->helperText('Mohon berikan penilaian berdasarkan pengalaman menggunakan CAPI pada FASIH bukan berdasarkan desain kuisioner')
                                        ->options([
                                            1 => 'Sangat Tidak Setuju',
                                            2 => 'Tidak Setuju',
                                            3 => 'Netral',
                                            4 => 'Setuju',
                                            5 => 'Sangat Setuju',
                                        ])
                                        // ->required()
                                ]),
                            Section::make('CON2. Inforamsi Benar')
                                ->schema([
                                    Radio::make('informasi_benar')
                                        ->label('Aplikasi saat ini selalu memberikan informasi yang benar')
                                        ->helperText('Mohon berikan penilaian berdasarkan pengalaman menggunakan CAPI pada FASIH bukan berdasarkan desain kuisioner')
                                        ->options([
                                            1 => 'Sangat Tidak Setuju',
                                            2 => 'Tidak Setuju',
                                            3 => 'Netral',
                                            4 => 'Setuju',
                                            5 => 'Sangat Setuju',
                                        ])
                                        // ->required()
                                ]),
                            Section::make('CON3. Informasi Presisi')
                                ->schema([
                                    Radio::make('informasi_presisi')
                                        ->label('Aplikasi menyediakan informasi yang presisi sesuai yang saya butuhkan')
                                        ->helperText('Mohon berikan penilaian berdasarkan pengalaman menggunakan CAPI pada FASIH bukan berdasarkan desain kuisioner')
                                        ->options([
                                            1 => 'Sangat Tidak Setuju',
                                            2 => 'Tidak Setuju',
                                            3 => 'Netral',
                                            4 => 'Setuju',
                                            5 => 'Sangat Setuju',
                                        ])
                                        // ->required()
                                ]),
                            Section::make('CON4. Mudah Dipahami')
                                ->schema([
                                    Radio::make('mudah_dipahami')
                                        ->label('Aplikasi memberikan informasi yang mudah dipahami')
                                        ->helperText('Mohon berikan penilaian berdasarkan pengalaman menggunakan CAPI pada FASIH bukan berdasarkan desain kuisioner')
                                        ->options([
                                            1 => 'Sangat Tidak Setuju',
                                            2 => 'Tidak Setuju',
                                            3 => 'Netral',
                                            4 => 'Setuju',
                                            5 => 'Sangat Setuju',
                                        ])
                                        // ->required()
                                ]),
                        ]),

                    Step::make('BLOK VI: Format')
                        ->schema([
                            Section::make('FOR1. Desain Menarik')
                                ->schema([
                                    Radio::make('desain_menarik')
                                        ->label('Tampilan aplikasi memiliki desain yang menarik')
                                        ->helperText('Mohon berikan penilaian berdasarkan pengalaman menggunakan CAPI pada FASIH bukan berdasarkan desain kuisioner')
                                        ->options([
                                            1 => 'Sangat Tidak Setuju',
                                            2 => 'Tidak Setuju',
                                            3 => 'Netral',
                                            4 => 'Setuju',
                                            5 => 'Sangat Setuju',
                                        ])
                                        // ->required()
                                ]),
                            Section::make('FOR2. Tata Letak Baik')
                                ->schema([
                                    Radio::make('tata_letak_baik')
                                        ->label('Tampilan aplikasi memiliki tata letak yang memudahkan pengguna memahami fungsi aplikasi')
                                        ->helperText('Mohon berikan penilaian berdasarkan pengalaman menggunakan CAPI pada FASIH bukan berdasarkan desain kuisioner')
                                        ->options([
                                            1 => 'Sangat Tidak Setuju',
                                            2 => 'Tidak Setuju',
                                            3 => 'Netral',
                                            4 => 'Setuju',
                                            5 => 'Sangat Setuju',
                                        ])
                                        // ->required()
                                ]),
                            Section::make('FOR3. Menu Teratur')
                                ->schema([
                                    Radio::make('menu_teratur')
                                        ->label('Aplikasi memiliki struktur dan tata letak menu yang teratur dan rapi')
                                        ->helperText('Mohon berikan penilaian berdasarkan pengalaman menggunakan CAPI pada FASIH bukan berdasarkan desain kuisioner')
                                        ->options([
                                            1 => 'Sangat Tidak Setuju',
                                            2 => 'Tidak Setuju',
                                            3 => 'Netral',
                                            4 => 'Setuju',
                                            5 => 'Sangat Setuju',
                                        ])
                                        // ->required()
                                ]),
                        ]),

                    Step::make('BLOK VII: User Satisfaction')
                        ->schema([
                            Section::make('USF1. Puas Data')
                                ->schema([
                                    Radio::make('puas_data')
                                        ->label('Saya puas dengan data dan informasi yang didapat')
                                        ->helperText('Mohon berikan penilaian berdasarkan pengalaman menggunakan CAPI pada FASIH bukan berdasarkan desain kuisioner')
                                        ->options([
                                            1 => 'Sangat Tidak Setuju',
                                            2 => 'Tidak Setuju',
                                            3 => 'Netral',
                                            4 => 'Setuju',
                                            5 => 'Sangat Setuju',
                                        ])
                                        // ->required()
                                ]),
                            Section::make('USF2. Puas Efektivitas')
                                ->schema([
                                    Radio::make('puas_efektivitas')
                                        ->label('Saya puas dengan efektifitas (Tidak ada eror yang mengganggu kinerja) sistem')
                                        ->helperText('Mohon berikan penilaian berdasarkan pengalaman menggunakan CAPI pada FASIH bukan berdasarkan desain kuisioner')
                                        ->options([
                                            1 => 'Sangat Tidak Setuju',
                                            2 => 'Tidak Setuju',
                                            3 => 'Netral',
                                            4 => 'Setuju',
                                            5 => 'Sangat Setuju',
                                        ])
                                        // ->required()
                                ]),
                            Section::make('USF3. Puas Efisiensi')
                                ->schema([
                                    Radio::make('puas_efisiensi')
                                        ->label('Saya puas dengan efisiensi aplikasi ini (Pekerjaan lebih cepat)')
                                        ->helperText('Mohon berikan penilaian berdasarkan pengalaman menggunakan CAPI pada FASIH bukan berdasarkan desain kuisioner')
                                        ->options([
                                            1 => 'Sangat Tidak Setuju',
                                            2 => 'Tidak Setuju',
                                            3 => 'Netral',
                                            4 => 'Setuju',
                                            5 => 'Sangat Setuju',
                                        ])
                                        // ->required()
                                ]),
                            Section::make('USF4. Puas Umum')
                                ->schema([
                                    Radio::make('puas_umum')
                                        ->label('Secara umum Saya puas dengan aplikasi ini')
                                        ->helperText('Mohon berikan penilaian berdasarkan pengalaman menggunakan CAPI pada FASIH bukan berdasarkan desain kuisioner')
                                        ->options([
                                            1 => 'Sangat Tidak Setuju',
                                            2 => 'Tidak Setuju',
                                            3 => 'Netral',
                                            4 => 'Setuju',
                                            5 => 'Sangat Setuju',
                                        ])
                                        // ->required()
                                ]),
                        ]),

                    Step::make('BLOK VIII: Net Benefits')
                        ->schema([
                            Section::make('NET1. Kinerja Lebih Baik')
                                ->schema([
                                    Radio::make('kinerja_lebih_baik')
                                        ->label('Saya merasa kinerja saya dalam mengumpulkan data lebih baik saat menggunakan sistem')
                                        ->helperText('Mohon berikan penilaian berdasarkan pengalaman menggunakan CAPI pada FASIH bukan berdasarkan desain kuisioner')
                                        ->options([
                                            1 => 'Sangat Tidak Setuju',
                                            2 => 'Tidak Setuju',
                                            3 => 'Netral',
                                            4 => 'Setuju',
                                            5 => 'Sangat Setuju',
                                        ])
                                        // ->required()
                                ]),
                            Section::make('NET2. Lebih Mudah')
                                ->schema([
                                    Radio::make('lebih_mudah')
                                        ->label('Saya menilai pengumpulan data lebih mudah dengan menggunakan sistem')
                                        ->helperText('Mohon berikan penilaian berdasarkan pengalaman menggunakan CAPI pada FASIH bukan berdasarkan desain kuisioner')
                                        ->options([
                                            1 => 'Sangat Tidak Setuju',
                                            2 => 'Tidak Setuju',
                                            3 => 'Netral',
                                            4 => 'Setuju',
                                            5 => 'Sangat Setuju',
                                        ])
                                        // ->required()
                                ]),
                        ])
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('jenis_kelamin')
                    ->searchable(),
                TextColumn::make('kelas')
                    ->searchable(),
                TextColumn::make('pengalaman_capi/papi')
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRiset5s::route('/'),
            'create' => Pages\CreateRiset5::route('/create'),
            'edit' => Pages\EditRiset5::route('/{record}/edit'),
        ];
    }
}
