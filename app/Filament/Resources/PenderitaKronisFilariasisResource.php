<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PenderitaKronisFilariasisResource\Pages;
use App\Models\PenderitaKronisFilariasis;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PenderitaKronisFilariasisResource extends Resource
{
    protected static ?string $model = PenderitaKronisFilariasis::class;

    protected static ?string $navigationIcon  = 'heroicon-o-finger-print';
    protected static ?string $navigationLabel = 'Kronis Filariasis';
    protected static ?string $modelLabel      = 'Penderita Kronis Filariasis';
    protected static ?string $pluralModelLabel = 'Penderita Kronis Filariasis';
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

                // Kasus kronis tahun sebelumnya
                Forms\Components\Section::make('Kasus Kronis Tahun Sebelumnya')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('sebelumnya_l')
                            ->label('L')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('sebelumnya_p')
                            ->label('P')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('sebelumnya_total')
                            ->label('L + P')
                            ->numeric()
                            ->default(0),
                    ]),

                // Kasus kronis baru ditemukan
                Forms\Components\Section::make('Kasus Kronis Baru Ditemukan')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('baru_l')
                            ->label('L')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('baru_p')
                            ->label('P')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('baru_total')
                            ->label('L + P')
                            ->numeric()
                            ->default(0),
                    ]),

                // Kasus kronis pindah
                Forms\Components\Section::make('Kasus Kronis Pindah')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('pindah_l')
                            ->label('L')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('pindah_p')
                            ->label('P')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('pindah_total')
                            ->label('L + P')
                            ->numeric()
                            ->default(0),
                    ]),

                // Kasus kronis meninggal
                Forms\Components\Section::make('Kasus Kronis Meninggal')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('meninggal_l')
                            ->label('L')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('meninggal_p')
                            ->label('P')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('meninggal_total')
                            ->label('L + P')
                            ->numeric()
                            ->default(0),
                    ]),

                // Jumlah seluruh kasus kronis
                Forms\Components\Section::make('Jumlah Seluruh Kasus Kronis')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('jumlah_l')
                            ->label('L')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('jumlah_p')
                            ->label('P')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('jumlah_total')
                            ->label('L + P')
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

                Tables\Columns\TextColumn::make('sebelumnya_total')
                    ->label('Kronis thn lalu (L+P)')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('baru_total')
                    ->label('Kronis baru (L+P)')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('meninggal_total')
                    ->label('Kronis meninggal (L+P)')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('jumlah_total')
                    ->label('Total kronis (L+P)')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kecamatan')
                    ->options(fn () => PenderitaKronisFilariasis::query()
                        ->orderBy('kecamatan')
                        ->pluck('kecamatan', 'kecamatan')
                        ->toArray()
                    ),

                Tables\Filters\SelectFilter::make('tahun')
                    ->options(fn () => PenderitaKronisFilariasis::query()
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

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListPenderitaKronisFilariasis::route('/'),
            'create' => Pages\CreatePenderitaKronisFilariasis::route('/create'),
            'edit'   => Pages\EditPenderitaKronisFilariasis::route('/{record}/edit'),
        ];
    }
}
