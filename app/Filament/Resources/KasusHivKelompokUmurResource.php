<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KasusHivKelompokUmurResource\Pages;
use App\Models\KasusHivKelompokUmur;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KasusHivKelompokUmurResource extends Resource
{
    protected static ?string $model = KasusHivKelompokUmur::class;

    protected static ?string $navigationIcon  = 'heroicon-o-beaker';
    protected static ?string $navigationLabel = 'Kasus HIV (Umur)';
    protected static ?string $pluralModelLabel = 'Kasus HIV per Kelompok Umur';
    protected static ?string $modelLabel       = 'Kasus HIV per Kelompok Umur';
    protected static ?string $navigationGroup  = 'P2P & Penyakit Menular';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Kelompok Umur')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('tahun')
                            ->numeric()
                            ->minValue(2000)
                            ->maxValue(2100)
                            ->default(now()->year),

                        Forms\Components\TextInput::make('kelompok_umur')
                            ->label('Kelompok umur')
                            ->placeholder('contoh: 25 - 49 TAHUN')
                            ->required()
                            ->maxLength(50),

                        Forms\Components\TextInput::make('proporsi_kelompok_umur_persen')
                            ->label('Proporsi kelompok umur (%)')
                            ->numeric()
                            ->step(0.1)
                            ->helperText('Sesuai kolom proporsi kelompok umur di tabel'),
                    ]),

                Forms\Components\Section::make('Kasus HIV')
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
                            ->default(0)
                            ->helperText('Bisa isi manual atau hasil penjumlahan L + P'),
                    ]),

                Forms\Components\Section::make('Indikator Kab/Kota (opsional)')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('estimasi_orang_berisiko')
                            ->label('Estimasi orang berisiko HIV')
                            ->numeric()
                            ->helperText('Misal: 43792 (untuk kabupaten, bisa diisi di 1 baris saja)'),

                        Forms\Components\TextInput::make('berisiko_dapat_pelayanan')
                            ->label('Orang berisiko yang mendapat pelayanan')
                            ->numeric()
                            ->helperText('Misal: 31259'),

                        Forms\Components\TextInput::make('persen_berisiko_dapat_pelayanan')
                            ->label('% berisiko yang mendapat pelayanan')
                            ->numeric()
                            ->step(0.1)
                            ->helperText('Misal: 71,4'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('tahun')
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('kelompok_umur')
                    ->label('Kelompok umur')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('kasus_l')
                    ->label('Kasus L')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('kasus_p')
                    ->label('Kasus P')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('kasus_total')
                    ->label('Kasus L+P')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('proporsi_kelompok_umur_persen')
                    ->label('Proporsi kelompok umur (%)')
                    ->formatStateUsing(fn ($s) => $s !== null ? number_format($s, 1) . '%' : '-')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tahun')
                    ->options(fn () => KasusHivKelompokUmur::query()
                        ->select('tahun')
                        ->distinct()
                        ->orderBy('tahun', 'desc')
                        ->pluck('tahun', 'tahun')
                        ->filter()
                        ->toArray()
                    ),
            ])
            ->defaultSort('kelompok_umur')
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
            'index'  => Pages\ListKasusHivKelompokUmurs::route('/'),
            'create' => Pages\CreateKasusHivKelompokUmur::route('/create'),
            'edit'   => Pages\EditKasusHivKelompokUmur::route('/{record}/edit'),
        ];
    }
}
