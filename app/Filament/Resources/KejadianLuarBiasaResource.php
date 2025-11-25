<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KejadianLuarBiasaResource\Pages;
use App\Models\KejadianLuarBiasa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KejadianLuarBiasaResource extends Resource
{
    protected static ?string $model = KejadianLuarBiasa::class;

    protected static ?string $navigationIcon  = 'heroicon-o-bell-alert';
    protected static ?string $navigationLabel = 'Kejadian Luar Biasa (KLB)';
    protected static ?string $pluralModelLabel = 'Kejadian Luar Biasa (KLB)';
    protected static ?string $modelLabel       = 'Kejadian Luar Biasa';
    protected static ?string $navigationGroup  = 'Surveilans & KLB';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Info dasar KLB
                Forms\Components\Section::make('Informasi KLB')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('jenis_klb')
                            ->label('Jenis KLB')
                            ->placeholder('misal: Keracunan makanan, Pertusis, suspek HFMD')
                            ->required()
                            ->maxLength(150),

                        Forms\Components\TextInput::make('jumlah_kec')
                            ->label('Jumlah kecamatan')
                            ->numeric()
                            ->default(1),

                        Forms\Components\TextInput::make('jumlah_desa_kel')
                            ->label('Jumlah desa/kel')
                            ->numeric()
                            ->default(1),
                    ]),

                // Waktu kejadian
                Forms\Components\Section::make('Waktu Kejadian')
                    ->columns(3)
                    ->schema([
                        Forms\Components\DatePicker::make('tanggal_diketahui')
                            ->label('Tanggal diketahui'),
                        Forms\Components\DatePicker::make('tanggal_ditanggulangi')
                            ->label('Tanggal ditanggulangi'),
                        Forms\Components\DatePicker::make('tanggal_akhir')
                            ->label('Tanggal akhir KLB'),
                    ]),

                // Jumlah penderita
                Forms\Components\Section::make('Jumlah Penderita')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('penderita_l')
                            ->label('Penderita L')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('penderita_p')
                            ->label('Penderita P')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('penderita_total')
                            ->label('Penderita L+P')
                            ->numeric()
                            ->default(0),
                    ]),

                // Kelompok umur
                Forms\Components\Section::make('Kelompok Umur Penderita')
                    ->columns(4)
                    ->schema([
                        Forms\Components\TextInput::make('umur_0_7_hari')->label('0–7 hari')->numeric()->default(0),
                        Forms\Components\TextInput::make('umur_8_28_hari')->label('8–28 hari')->numeric()->default(0),
                        Forms\Components\TextInput::make('umur_1_11_bln')->label('1–11 bln')->numeric()->default(0),
                        Forms\Components\TextInput::make('umur_1_4_thn')->label('1–4 thn')->numeric()->default(0),

                        Forms\Components\TextInput::make('umur_5_9_thn')->label('5–9 thn')->numeric()->default(0),
                        Forms\Components\TextInput::make('umur_10_14_thn')->label('10–14 thn')->numeric()->default(0),
                        Forms\Components\TextInput::make('umur_15_19_thn')->label('15–19 thn')->numeric()->default(0),
                        Forms\Components\TextInput::make('umur_20_44_thn')->label('20–44 thn')->numeric()->default(0),

                        Forms\Components\TextInput::make('umur_45_54_thn')->label('45–54 thn')->numeric()->default(0),
                        Forms\Components\TextInput::make('umur_55_59_thn')->label('55–59 thn')->numeric()->default(0),
                        Forms\Components\TextInput::make('umur_60_69_thn')->label('60–69 thn')->numeric()->default(0),
                        Forms\Components\TextInput::make('umur_70_plus_thn')->label('70+ thn')->numeric()->default(0),
                    ]),

                // Kematian & penduduk terancam
                Forms\Components\Section::make('Kematian & Penduduk Terancam')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('kematian_l')
                            ->label('Kematian L')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('kematian_p')
                            ->label('Kematian P')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('kematian_total')
                            ->label('Kematian L+P')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('penduduk_terancam_l')
                            ->label('Penduduk terancam L')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('penduduk_terancam_p')
                            ->label('Penduduk terancam P')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('penduduk_terancam_total')
                            ->label('Penduduk terancam L+P')
                            ->numeric()
                            ->default(0),
                    ]),

                // Attack rate & CFR
                Forms\Components\Section::make('Attack Rate & CFR')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('attack_rate_l_persen')
                            ->label('Attack Rate L (%)')
                            ->numeric()
                            ->step(0.01),
                        Forms\Components\TextInput::make('attack_rate_p_persen')
                            ->label('Attack Rate P (%)')
                            ->numeric()
                            ->step(0.01),
                        Forms\Components\TextInput::make('attack_rate_total_persen')
                            ->label('Attack Rate total (%)')
                            ->numeric()
                            ->step(0.01),

                        Forms\Components\TextInput::make('cfr_l_persen')
                            ->label('CFR L (%)')
                            ->numeric()
                            ->step(0.01),
                        Forms\Components\TextInput::make('cfr_p_persen')
                            ->label('CFR P (%)')
                            ->numeric()
                            ->step(0.01),
                        Forms\Components\TextInput::make('cfr_total_persen')
                            ->label('CFR total (%)')
                            ->numeric()
                            ->step(0.01),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('jenis_klb')
                    ->label('Jenis KLB')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tanggal_diketahui')
                    ->label('Tgl diketahui')
                    ->date('d-m-Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('penderita_total')
                    ->label('Penderita L+P')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('kematian_total')
                    ->label('Kematian L+P')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('attack_rate_total_persen')
                    ->label('Attack Rate total (%)')
                    ->formatStateUsing(fn ($s) => $s !== null ? number_format($s, 1) . '%' : '-')
                    ->sortable(),

                Tables\Columns\TextColumn::make('cfr_total_persen')
                    ->label('CFR total (%)')
                    ->formatStateUsing(fn ($s) => $s !== null ? number_format($s, 1) . '%' : '-')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenis_klb')
                    ->options(fn () => KejadianLuarBiasa::query()
                        ->orderBy('jenis_klb')
                        ->pluck('jenis_klb', 'jenis_klb')
                        ->toArray()
                    ),
            ])
            ->defaultSort('tanggal_diketahui', 'asc')
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

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListKejadianLuarBiasas::route('/'),
            'create' => Pages\CreateKejadianLuarBiasa::route('/create'),
            'edit'   => Pages\EditKejadianLuarBiasa::route('/{record}/edit'),
        ];
    }
}
