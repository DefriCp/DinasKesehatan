<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PneumoniaBalitaResource\Pages;
use App\Models\PneumoniaBalita;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PneumoniaBalitaResource extends Resource
{
    protected static ?string $model = PneumoniaBalita::class;

    protected static ?string $navigationIcon  = 'heroicon-o-cloud';
    protected static ?string $navigationLabel = 'Pneumonia Balita';
    protected static ?string $pluralModelLabel = 'Penemuan Kasus Pneumonia Balita';
    protected static ?string $modelLabel       = 'Pneumonia Balita';
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

                // Jumlah balita
                Forms\Components\Section::make('Populasi Balita')
                    ->schema([
                        Forms\Components\TextInput::make('jumlah_balita')
                            ->label('Jumlah balita')
                            ->numeric()
                            ->default(0),
                    ]),

                // Balita batuk / sesak
                Forms\Components\Section::make('Balita Batuk / Kesukaran Bernapas')
                    ->columns(4)
                    ->schema([
                        Forms\Components\TextInput::make('balita_batuk_kunjungan')
                            ->label('Jumlah kunjungan')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('balita_batuk_tatalaksana_l')
                            ->label('Diberi tatalaksana standar - L')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('balita_batuk_tatalaksana_p')
                            ->label('Diberi tatalaksana standar - P')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('balita_batuk_tatalaksana_persen')
                            ->label('% tatalaksana standar')
                            ->numeric()
                            ->step(0.1)
                            ->helperText('Sesuai kolom persentase di tabel'),
                    ]),

                // Perkiraan pneumonia balita
                Forms\Components\Section::make('Perkiraan Pneumonia Balita')
                    ->schema([
                        Forms\Components\TextInput::make('perkiraan_pneumonia_balita')
                            ->label('Perkiraan pneumonia balita')
                            ->numeric()
                            ->default(0),
                    ]),

                // Realisasi Pneumonia
                Forms\Components\Section::make('Realisasi Penemuan Pneumonia pada Balita')
                    ->columns(3)
                    ->schema([
                        Forms\Components\Fieldset::make('Pneumonia')
                            ->columns(2)
                            ->schema([
                                Forms\Components\TextInput::make('pneumonia_l')
                                    ->label('L')
                                    ->numeric()
                                    ->default(0),
                                Forms\Components\TextInput::make('pneumonia_p')
                                    ->label('P')
                                    ->numeric()
                                    ->default(0),
                            ]),

                        Forms\Components\Fieldset::make('Pneumonia Berat')
                            ->columns(2)
                            ->schema([
                                Forms\Components\TextInput::make('pneumonia_berat_l')
                                    ->label('L')
                                    ->numeric()
                                    ->default(0),
                                Forms\Components\TextInput::make('pneumonia_berat_p')
                                    ->label('P')
                                    ->numeric()
                                    ->default(0),
                            ]),

                        Forms\Components\Fieldset::make('Jumlah Pneumonia (L + P)')
                            ->columns(3)
                            ->schema([
                                Forms\Components\TextInput::make('jumlah_pneumonia_l')
                                    ->label('L')
                                    ->numeric()
                                    ->default(0),
                                Forms\Components\TextInput::make('jumlah_pneumonia_p')
                                    ->label('P')
                                    ->numeric()
                                    ->default(0),
                                Forms\Components\TextInput::make('jumlah_pneumonia_total')
                                    ->label('Total (L+P)')
                                    ->numeric()
                                    ->default(0),
                            ]),
                        Forms\Components\TextInput::make('penemuan_pneumonia_persen')
                            ->label('% penemuan pneumonia')
                            ->numeric()
                            ->step(0.1),
                    ]),

                // Batuk bukan pneumonia
                Forms\Components\Section::make('Batuk Bukan Pneumonia')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('batuk_non_pneumonia_l')
                            ->label('L')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('batuk_non_pneumonia_p')
                            ->label('P')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('batuk_non_pneumonia_total')
                            ->label('Total (L+P)')
                            ->numeric()
                            ->default(0),
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

                Tables\Columns\TextColumn::make('jumlah_balita')
                    ->label('Balita')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('balita_batuk_kunjungan')
                    ->label('Batuk / sesak (kunj.)')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('balita_batuk_tatalaksana_persen')
                    ->label('% tatalaksana standar')
                    ->formatStateUsing(fn ($s) => $s !== null ? number_format($s, 1).'%' : '-')
                    ->sortable(),

                Tables\Columns\TextColumn::make('perkiraan_pneumonia_balita')
                    ->label('Perkiraan pneumonia')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('jumlah_pneumonia_total')
                    ->label('Kasus pneumonia (L+P)')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kecamatan')
                    ->options(fn () => PneumoniaBalita::query()
                        ->orderBy('kecamatan')
                        ->pluck('kecamatan', 'kecamatan')
                        ->toArray()
                    ),
                Tables\Filters\SelectFilter::make('tahun')
                    ->options(fn () => PneumoniaBalita::query()
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
            'index'  => Pages\ListPneumoniaBalitas::route('/'),
            'create' => Pages\CreatePneumoniaBalita::route('/create'),
            'edit'   => Pages\EditPneumoniaBalita::route('/{record}/edit'),
        ];
    }
}
