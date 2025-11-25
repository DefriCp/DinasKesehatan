<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PelayananKesehatanOdgjBeratResource\Pages;
use App\Models\PelayananKesehatanOdgjBerat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PelayananKesehatanOdgjBeratResource extends Resource
{
    protected static ?string $model = PelayananKesehatanOdgjBerat::class;

    protected static ?string $navigationIcon  = 'heroicon-o-heart';
    protected static ?string $navigationLabel = 'Pelayanan ODGJ Berat';
    protected static ?string $modelLabel      = 'Pelayanan Kesehatan ODGJ Berat';
    protected static ?string $pluralModelLabel = 'Pelayanan Kesehatan ODGJ Berat';
    protected static ?string $navigationGroup = 'Kesehatan Jiwa';

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

                Forms\Components\Section::make('Sasaran ODGJ Berat')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('sasaran_odgj_berat')
                            ->label('Sasaran ODGJ Berat')
                            ->numeric()
                            ->required()
                            ->helperText('Sesuai kolom SASARAN ODGJ BERAT di tabel'),
                    ]),

                Forms\Components\Section::make('Kasus Skizofrenia')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('skizo_0_14')
                            ->label('0-14 th')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('skizo_15_59')
                            ->label('15-59 th')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('skizo_60_plus')
                            ->label('≥ 60 th')
                            ->numeric()
                            ->default(0),
                    ]),

                Forms\Components\Section::make('Kasus Psikotik Akut')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('psikotik_0_14')
                            ->label('0-14 th')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('psikotik_15_59')
                            ->label('15-59 th')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('psikotik_60_plus')
                            ->label('≥ 60 th')
                            ->numeric()
                            ->default(0),
                    ]),

                Forms\Components\Section::make('Total ODGJ Berat Mendapat Pelayanan')
                    ->columns(4)
                    ->schema([
                        Forms\Components\TextInput::make('total_0_14')
                            ->label('Total 0-14 th')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('total_15_59')
                            ->label('Total 15-59 th')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('total_60_plus')
                            ->label('Total ≥ 60 th')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('pelayanan_jumlah')
                            ->label('Jumlah Pelayanan (JUMLAH)')
                            ->numeric()
                            ->required()
                            ->helperText('Kolom JUMLAH (total semua umur)'),
                    ]),

                Forms\Components\Section::make('Cakupan Pelayanan')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('pelayanan_persen')
                            ->label('Cakupan Pelayanan (%)')
                            ->numeric()
                            ->step(0.1)
                            ->helperText('Sesuai kolom % di tabel (misal 96,9)'),
                    ]),

                Forms\Components\Section::make('Catatan')
                    ->schema([
                        Forms\Components\Textarea::make('catatan')
                            ->rows(2),
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

                Tables\Columns\TextColumn::make('sasaran_odgj_berat')
                    ->label('Sasaran')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('pelayanan_jumlah')
                    ->label('Mendapat Pelayanan')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('pelayanan_persen')
                    ->label('Cakupan (%)')
                    ->formatStateUsing(fn ($state) => $state !== null ? number_format($state, 1) . '%' : '-')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kecamatan')
                    ->options(fn () => PelayananKesehatanOdgjBerat::query()
                        ->orderBy('kecamatan')
                        ->pluck('kecamatan', 'kecamatan')
                        ->toArray()
                    ),

                Tables\Filters\SelectFilter::make('tahun')
                    ->options(fn () => PelayananKesehatanOdgjBerat::query()
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
            'index'  => Pages\ListPelayananKesehatanOdgjBerats::route('/'),
            'create' => Pages\CreatePelayananKesehatanOdgjBerat::route('/create'),
            'edit'   => Pages\EditPelayananKesehatanOdgjBerat::route('/{record}/edit'),
        ];
    }
}
