<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KasusMalariaResource\Pages;
use App\Models\KasusMalaria;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KasusMalariaResource extends Resource
{
    protected static ?string $model = KasusMalaria::class;

    protected static ?string $navigationIcon  = 'heroicon-o-beaker';
    protected static ?string $navigationLabel = 'Kasus Malaria';
    protected static ?string $modelLabel      = 'Kasus Malaria';
    protected static ?string $pluralModelLabel = 'Kasus Malaria';
    protected static ?string $navigationGroup = 'P2P & Penyakit Menular';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Identitas
                Forms\Components\Section::make('Lokasi & Periode')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('kecamatan')
                            ->required()
                            ->maxLength(100),

                        Forms\Components\TextInput::make('puskesmas')
                            ->required()
                            ->maxLength(150),

                        Forms\Components\TextInput::make('tahun')
                            ->numeric()
                            ->minValue(2000)
                            ->maxValue(2100)
                            ->default(now()->year),
                    ]),

                // Suspek & konfirmasi
                Forms\Components\Section::make('Suspek & Konfirmasi Laboratorium')
                    ->columns(4)
                    ->schema([
                        Forms\Components\TextInput::make('suspek')
                            ->label('Suspek')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('konfirmasi_mikroskopis')
                            ->label('Mikroskopis')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('konfirmasi_rdt')
                            ->label('RDT')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('konfirmasi_total')
                            ->label('Total konfirmasi')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('konfirmasi_persen')
                            ->label('% konfirmasi')
                            ->numeric()
                            ->step(0.1)
                            ->helperText('Isi dari tabel: % konfirmasi lab (total / suspek x 100)'),
                    ]),

                // Positif
                Forms\Components\Section::make('Kasus Positif Malaria')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('positif_l')
                            ->label('Positif L')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('positif_p')
                            ->label('Positif P')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('positif_total')
                            ->label('Positif L+P')
                            ->numeric()
                            ->default(0),
                    ]),

                // Pengobatan standar
                Forms\Components\Section::make('Pengobatan Sesuai Standar')
                    ->columns(4)
                    ->schema([
                        Forms\Components\TextInput::make('pengobatan_l')
                            ->label('Diobati L')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('pengobatan_p')
                            ->label('Diobati P')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('pengobatan_total')
                            ->label('Diobati L+P')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('pengobatan_persen')
                            ->label('% pengobatan standar')
                            ->numeric()
                            ->step(0.1)
                            ->helperText('Dari tabel: % pengobatan standar'),
                    ]),

                // Meninggal & CFR
                Forms\Components\Section::make('Meninggal & CFR')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('meninggal_l')
                            ->label('Meninggal L')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('meninggal_p')
                            ->label('Meninggal P')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('meninggal_total')
                            ->label('Meninggal L+P')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('cfr_l_persen')
                            ->label('CFR L (%)')
                            ->numeric()
                            ->step(0.1),

                        Forms\Components\TextInput::make('cfr_p_persen')
                            ->label('CFR P (%)')
                            ->numeric()
                            ->step(0.1),

                        Forms\Components\TextInput::make('cfr_total_persen')
                            ->label('CFR L+P (%)')
                            ->numeric()
                            ->step(0.1),
                    ]),

                // API
                Forms\Components\Section::make('Annual Parasite Incidence (API)')
                    ->schema([
                        Forms\Components\TextInput::make('api_per1000')
                            ->label('API per 1.000 penduduk')
                            ->numeric()
                            ->step(0.01)
                            ->helperText('Biasanya diisi 1 baris kab/kota, misal 0,0'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kecamatan')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('puskesmas')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('tahun')
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('suspek')
                    ->label('Suspek')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('konfirmasi_total')
                    ->label('Konfirmasi lab')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('konfirmasi_persen')
                    ->label('% konfirmasi')
                    ->formatStateUsing(fn($s) => $s !== null ? number_format($s, 1) . '%' : '-')
                    ->sortable(),

                Tables\Columns\TextColumn::make('positif_total')
                    ->label('Positif L+P')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('pengobatan_total')
                    ->label('Diobati L+P')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('pengobatan_persen')
                    ->label('% pengobatan')
                    ->formatStateUsing(fn($s) => $s !== null ? number_format($s, 1) . '%' : '-')
                    ->sortable(),

                Tables\Columns\TextColumn::make('meninggal_total')
                    ->label('Meninggal L+P')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('cfr_total_persen')
                    ->label('CFR total (%)')
                    ->formatStateUsing(fn($s) => $s !== null ? number_format($s, 1) . '%' : '-')
                    ->sortable(),

                Tables\Columns\TextColumn::make('api_per1000')
                    ->label('API /1.000')
                    ->formatStateUsing(fn($s) => $s !== null ? number_format($s, 2) : '-')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kecamatan')
                    ->options(fn () => KasusMalaria::query()
                        ->orderBy('kecamatan')
                        ->pluck('kecamatan', 'kecamatan')
                        ->toArray()
                    ),

                Tables\Filters\SelectFilter::make('tahun')
                    ->options(fn () => KasusMalaria::query()
                        ->select('tahun')
                        ->distinct()
                        ->orderBy('tahun', 'desc')
                        ->pluck('tahun', 'tahun')
                        ->filter()
                        ->toArray()
                    ),
            ])
            ->defaultSort('kecamatan')
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
            'index'  => Pages\ListKasusMalarias::route('/'),
            'create' => Pages\CreateKasusMalaria::route('/create'),
            'edit'   => Pages\EditKasusMalaria::route('/{record}/edit'),
        ];
    }
}
