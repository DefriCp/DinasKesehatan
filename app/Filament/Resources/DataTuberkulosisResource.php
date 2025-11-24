<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DataTuberkulosisResource\Pages;
use App\Models\DataTuberkulosis;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DataTuberkulosisResource extends Resource
{
    protected static ?string $model = DataTuberkulosis::class;

    protected static ?string $navigationIcon  = 'heroicon-o-heart';
    protected static ?string $navigationLabel = 'Program TB';
    protected static ?string $pluralModelLabel = 'Data Tuberkulosis';
    protected static ?string $modelLabel       = 'Data Tuberkulosis';
    protected static ?string $navigationGroup  = 'P2P & Penyakit Menular';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Lokasi & Periode')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('kecamatan')
                            ->maxLength(100)
                            ->helperText('Untuk RS boleh dikosongkan'),

                        Forms\Components\TextInput::make('puskesmas')
                            ->required()
                            ->maxLength(150),

                        Forms\Components\TextInput::make('tahun')
                            ->numeric()
                            ->minValue(2000)
                            ->maxValue(2100)
                            ->default(now()->year),
                    ]),

                Forms\Components\Section::make('Terduga Tuberkulosis')
                    ->columns(1)
                    ->schema([
                        Forms\Components\TextInput::make('jumlah_terduga_tb_pelayanan')
                            ->label('Jumlah terduga TB yang dilayani sesuai standar')
                            ->numeric()
                            ->default(0),
                    ]),

                Forms\Components\Section::make('Semua Kasus Tuberkulosis')
                    ->columns(3)
                    ->schema([
                        Forms\Components\Fieldset::make('Laki-laki')
                            ->columns(2)
                            ->schema([
                                Forms\Components\TextInput::make('kasus_tb_laki_laki_jumlah')
                                    ->label('Jumlah')
                                    ->numeric()
                                    ->default(0),
                                Forms\Components\TextInput::make('kasus_tb_laki_laki_persen')
                                    ->label('%')
                                    ->numeric()
                                    ->step(0.1),
                            ]),

                        Forms\Components\Fieldset::make('Perempuan')
                            ->columns(2)
                            ->schema([
                                Forms\Components\TextInput::make('kasus_tb_perempuan_jumlah')
                                    ->label('Jumlah')
                                    ->numeric()
                                    ->default(0),
                                Forms\Components\TextInput::make('kasus_tb_perempuan_persen')
                                    ->label('%')
                                    ->numeric()
                                    ->step(0.1),
                            ]),

                        Forms\Components\Fieldset::make('Total L + P')
                            ->columns(1)
                            ->schema([
                                Forms\Components\TextInput::make('kasus_tb_total_jumlah')
                                    ->label('Total kasus')
                                    ->numeric()
                                    ->default(0),
                            ]),
                    ]),

                Forms\Components\Section::make('Kasus Tuberkulosis Anak (0–14 tahun)')
                    ->columns(1)
                    ->schema([
                        Forms\Components\TextInput::make('kasus_tb_anak_0_14_jumlah')
                            ->label('Jumlah kasus TB anak')
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

                Tables\Columns\TextColumn::make('jumlah_terduga_tb_pelayanan')
                    ->label('Terduga TB dilayani')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('kasus_tb_total_jumlah')
                    ->label('Total kasus TB')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('kasus_tb_anak_0_14_jumlah')
                    ->label('Kasus TB anak 0–14 th')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kecamatan')
                    ->options(fn () => DataTuberkulosis::query()
                        ->whereNotNull('kecamatan')
                        ->orderBy('kecamatan')
                        ->pluck('kecamatan', 'kecamatan')
                        ->toArray()
                    ),

                Tables\Filters\SelectFilter::make('tahun')
                    ->options(fn () => DataTuberkulosis::query()
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
            'index'  => Pages\ListDataTuberkulosis::route('/'),
            'create' => Pages\CreateDataTuberkulosis::route('/create'),
            'edit'   => Pages\EditDataTuberkulosis::route('/{record}/edit'),
        ];
    }
}
