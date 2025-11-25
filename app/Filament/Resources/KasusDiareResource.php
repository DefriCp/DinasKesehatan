<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KasusDiareResource\Pages;
use App\Models\KasusDiare;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KasusDiareResource extends Resource
{
    protected static ?string $model = KasusDiare::class;

    protected static ?string $navigationIcon  = 'heroicon-o-cloud';
    protected static ?string $navigationLabel = 'Kasus Diare';
    protected static ?string $pluralModelLabel = 'Kasus Diare yang Dilayani';
    protected static ?string $modelLabel       = 'Kasus Diare';
    protected static ?string $navigationGroup  = 'Program Anak & Balita';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Lokasi & periode
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

                // Penduduk & target
                Forms\Components\Section::make('Penduduk & Target Penemuan Diare')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('jumlah_penduduk')
                            ->label('Jumlah penduduk')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('target_penemuan_semua_umur')
                            ->label('Target penemuan diare (semua umur)')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('target_penemuan_balita')
                            ->label('Target penemuan diare (balita)')
                            ->numeric()
                            ->default(0),
                    ]),

                // Diare dilayani
                Forms\Components\Section::make('Diare Dilayani')
                    ->columns(4)
                    ->schema([
                        Forms\Components\TextInput::make('diare_dilayani_semua_jumlah')
                            ->label('Diare dilayani (semua umur) - jumlah')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('diare_dilayani_semua_persen')
                            ->label('Diare dilayani (semua umur) - %')
                            ->numeric()
                            ->step(0.1),
                        Forms\Components\TextInput::make('diare_dilayani_balita_jumlah')
                            ->label('Diare dilayani (balita) - jumlah')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('diare_dilayani_balita_persen')
                            ->label('Diare dilayani (balita) - %')
                            ->numeric()
                            ->step(0.1),
                    ]),

                // Mendapat oralit
                Forms\Components\Section::make('Mendapat Oralit')
                    ->columns(4)
                    ->schema([
                        Forms\Components\TextInput::make('oralit_semua_jumlah')
                            ->label('Oralit (semua umur) - jumlah')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('oralit_semua_persen')
                            ->label('Oralit (semua umur) - %')
                            ->numeric()
                            ->step(0.1),
                        Forms\Components\TextInput::make('oralit_balita_jumlah')
                            ->label('Oralit (balita) - jumlah')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('oralit_balita_persen')
                            ->label('Oralit (balita) - %')
                            ->numeric()
                            ->step(0.1),
                    ]),

                // Zinc & oralit+zinc
                Forms\Components\Section::make('Zinc & Oralit + Zinc pada Balita')
                    ->columns(4)
                    ->schema([
                        Forms\Components\TextInput::make('zinc_balita_jumlah')
                            ->label('Zinc balita - jumlah')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('zinc_balita_persen')
                            ->label('Zinc balita - %')
                            ->numeric()
                            ->step(0.1),
                        Forms\Components\TextInput::make('oralit_zinc_balita_jumlah')
                            ->label('Oralit + Zinc balita - jumlah')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('oralit_zinc_balita_persen')
                            ->label('Oralit + Zinc balita - %')
                            ->numeric()
                            ->step(0.1),
                    ]),

                // Angka kesakitan (opsional kab/kota)
                Forms\Components\Section::make('Angka Kesakitan Diare per 1.000 Penduduk (opsional)')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('angka_kesakitan_semua_per1000')
                            ->label('Semua umur per 1.000 penduduk')
                            ->numeric()
                            ->step(0.01),
                        Forms\Components\TextInput::make('angka_kesakitan_balita_per1000')
                            ->label('Balita per 1.000 balita')
                            ->numeric()
                            ->step(0.01),
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

                Tables\Columns\TextColumn::make('jumlah_penduduk')
                    ->label('Penduduk')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('diare_dilayani_semua_jumlah')
                    ->label('Diare dilayani (semua umur)')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('diare_dilayani_semua_persen')
                    ->label('% diare dilayani (semua umur)')
                    ->formatStateUsing(fn ($s) => $s !== null ? number_format($s, 1) . '%' : '-')
                    ->sortable(),

                Tables\Columns\TextColumn::make('oralit_balita_jumlah')
                    ->label('Balita mendapat oralit')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('oralit_zinc_balita_jumlah')
                    ->label('Balita mendapat oralit + zinc')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kecamatan')
                    ->options(fn () => KasusDiare::query()
                        ->orderBy('kecamatan')
                        ->pluck('kecamatan', 'kecamatan')
                        ->toArray()),

                Tables\Filters\SelectFilter::make('tahun')
                    ->options(fn () => KasusDiare::query()
                        ->select('tahun')
                        ->distinct()
                        ->orderBy('tahun', 'desc')
                        ->pluck('tahun', 'tahun')
                        ->filter()
                        ->toArray()),
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
            'index'  => Pages\ListKasusDiares::route('/'),
            'create' => Pages\CreateKasusDiare::route('/create'),
            'edit'   => Pages\EditKasusDiare::route('/{record}/edit'),
        ];
    }
}
