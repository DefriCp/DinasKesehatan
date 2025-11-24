<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CakupanPelayananKesehatanUsiaLanjutResource\Pages;
use App\Models\CakupanPelayananKesehatanUsiaLanjut;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CakupanPelayananKesehatanUsiaLanjutResource extends Resource
{
    protected static ?string $model = CakupanPelayananKesehatanUsiaLanjut::class;

    protected static ?string $navigationIcon  = 'heroicon-o-user';
    protected static ?string $navigationLabel = 'Pelayanan Lansia 60+';
    protected static ?string $pluralModelLabel = 'Cakupan Pelayanan Kesehatan Usia Lanjut';
    protected static ?string $modelLabel       = 'Pelayanan Kesehatan Usia Lanjut';
    protected static ?string $navigationGroup  = 'Pelayanan Kesehatan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Lokasi & Periode')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('kecamatan')
                            ->required()
                            ->maxLength(100),

                        Forms\Components\TextInput::make('puskesmas')
                            ->required()
                            ->maxLength(100),

                        Forms\Components\TextInput::make('tahun')
                            ->numeric()
                            ->minValue(2000)
                            ->maxValue(2100)
                            ->default(now()->year),
                    ]),

                Forms\Components\Section::make('Usia Lanjut 60+ (Penduduk)')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('lansia_laki_laki')
                            ->label('Laki-laki')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('lansia_perempuan')
                            ->label('Perempuan')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('lansia_total')
                            ->label('Total')
                            ->numeric()
                            ->default(0)
                            ->helperText('Bisa isi manual atau hasil penjumlahan L + P'),
                    ]),

                Forms\Components\Section::make('Mendapat Skrining Kesehatan Sesuai Standar')
                    ->columns(3)
                    ->schema([
                        Forms\Components\Fieldset::make('Laki-laki')
                            ->columns(2)
                            ->schema([
                                Forms\Components\TextInput::make('skrining_laki_laki_jumlah')
                                    ->label('Jumlah')
                                    ->numeric()
                                    ->default(0),
                                Forms\Components\TextInput::make('skrining_laki_laki_persen')
                                    ->label('%')
                                    ->numeric()
                                    ->step(0.1),
                            ]),

                        Forms\Components\Fieldset::make('Perempuan')
                            ->columns(2)
                            ->schema([
                                Forms\Components\TextInput::make('skrining_perempuan_jumlah')
                                    ->label('Jumlah')
                                    ->numeric()
                                    ->default(0),
                                Forms\Components\TextInput::make('skrining_perempuan_persen')
                                    ->label('%')
                                    ->numeric()
                                    ->step(0.1),
                            ]),

                        Forms\Components\Fieldset::make('Laki-laki + Perempuan')
                            ->columns(2)
                            ->schema([
                                Forms\Components\TextInput::make('skrining_total_jumlah')
                                    ->label('Jumlah')
                                    ->numeric()
                                    ->default(0),
                                Forms\Components\TextInput::make('skrining_total_persen')
                                    ->label('%')
                                    ->numeric()
                                    ->step(0.1),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kecamatan')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('puskesmas')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tahun')
                    ->sortable()
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('lansia_total')
                    ->label('Lansia 60+')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('skrining_total_jumlah')
                    ->label('Skrining (jml)')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('skrining_total_persen')
                    ->label('Skrining (%)')
                    ->formatStateUsing(fn ($state) => $state !== null ? number_format($state, 1) . '%' : '-')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kecamatan')
                    ->options(fn () => CakupanPelayananKesehatanUsiaLanjut::query()
                        ->orderBy('kecamatan')
                        ->pluck('kecamatan', 'kecamatan')
                        ->toArray()
                    ),

                Tables\Filters\SelectFilter::make('tahun')
                    ->options(fn () => CakupanPelayananKesehatanUsiaLanjut::query()
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
            'index'  => Pages\ListCakupanPelayananKesehatanUsiaLanjuts::route('/'),
            'create' => Pages\CreateCakupanPelayananKesehatanUsiaLanjut::route('/create'),
            'edit'   => Pages\EditCakupanPelayananKesehatanUsiaLanjut::route('/{record}/edit'),
        ];
    }
}
