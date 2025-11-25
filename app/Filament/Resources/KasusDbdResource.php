<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KasusDbdResource\Pages;
use App\Models\KasusDbd;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KasusDbdResource extends Resource
{
    protected static ?string $model = KasusDbd::class;

    protected static ?string $navigationIcon  = 'heroicon-o-bug-ant';
    protected static ?string $navigationLabel = 'Kasus DBD';
    protected static ?string $pluralModelLabel = 'Kasus DBD';
    protected static ?string $modelLabel       = 'Kasus DBD';
    protected static ?string $navigationGroup  = 'P2P & Penyakit Menular';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Lokasi & tahun
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

                // Jumlah kasus
                Forms\Components\Section::make('Jumlah Kasus DBD')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('kasus_l')
                            ->label('Kasus L')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('kasus_p')
                            ->label('Kasus P')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('kasus_total')
                            ->label('Kasus L+P')
                            ->numeric()
                            ->default(0),
                    ]),

                // Jumlah meninggal
                Forms\Components\Section::make('Jumlah Meninggal')
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
                    ]),

                // CFR
                Forms\Components\Section::make('CFR (%)')
                    ->columns(3)
                    ->schema([
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

                // Angka kesakitan
                Forms\Components\Section::make('Angka Kesakitan DBD (per 100.000 penduduk)')
                    ->schema([
                        Forms\Components\TextInput::make('angka_kesakitan_per100k')
                            ->label('Angka kesakitan per 100.000 penduduk')
                            ->numeric()
                            ->step(0.01)
                            ->helperText('Biasanya diisi pada 1 baris kab/kota, mis: 40,1'),
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

                Tables\Columns\TextColumn::make('kasus_total')
                    ->label('Kasus DBD (L+P)')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('meninggal_total')
                    ->label('Meninggal (L+P)')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('cfr_total_persen')
                    ->label('CFR total (%)')
                    ->formatStateUsing(fn($s) => $s !== null ? number_format($s, 1) . '%' : '-')
                    ->sortable(),

                Tables\Columns\TextColumn::make('angka_kesakitan_per100k')
                    ->label('Angka kesakitan /100.000')
                    ->formatStateUsing(fn($s) => $s !== null ? number_format($s, 1) : '-')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kecamatan')
                    ->options(fn () => KasusDbd::query()
                        ->orderBy('kecamatan')
                        ->pluck('kecamatan', 'kecamatan')
                        ->toArray()
                    ),

                Tables\Filters\SelectFilter::make('tahun')
                    ->options(fn () => KasusDbd::query()
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
            'index'  => Pages\ListKasusDbds::route('/'),
            'create' => Pages\CreateKasusDbd::route('/create'),
            'edit'   => Pages\EditKasusDbd::route('/{record}/edit'),
        ];
    }
}
