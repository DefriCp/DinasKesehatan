<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KasusBaruKustaResource\Pages;
use App\Models\KasusBaruKusta;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KasusBaruKustaResource extends Resource
{
    protected static ?string $model = KasusBaruKusta::class;

    protected static ?string $navigationIcon  = 'heroicon-o-finger-print';
    protected static ?string $navigationLabel = 'Kasus Baru Kusta';
    protected static ?string $pluralModelLabel = 'Kasus Baru Kusta';
    protected static ?string $modelLabel       = 'Kasus Baru Kusta';
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

                // PB
                Forms\Components\Section::make('Kasus Baru Kusta Kering (PB)')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('pb_l')
                            ->label('PB L')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('pb_p')
                            ->label('PB P')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('pb_total')
                            ->label('PB L+P')
                            ->numeric()
                            ->default(0)
                            ->helperText('Sesuai kolom PB L+P'),
                    ]),

                // MB
                Forms\Components\Section::make('Kasus Baru Kusta Basah (MB)')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('mb_l')
                            ->label('MB L')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('mb_p')
                            ->label('MB P')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('mb_total')
                            ->label('MB L+P')
                            ->numeric()
                            ->default(0),
                    ]),

                // Total PB+MB
                Forms\Components\Section::make('Total Kasus Baru Kusta (PB + MB)')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('total_l')
                            ->label('Total L')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('total_p')
                            ->label('Total P')
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('total_kasus')
                            ->label('Total L+P')
                            ->numeric()
                            ->default(0),
                    ]),

                Forms\Components\Section::make('NCDR per 100.000 penduduk (opsional)')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('ncdr_l_per100k')
                            ->label('NCDR L / 100.000')
                            ->numeric()
                            ->step(0.01),
                        Forms\Components\TextInput::make('ncdr_p_per100k')
                            ->label('NCDR P / 100.000')
                            ->numeric()
                            ->step(0.01),
                        Forms\Components\TextInput::make('ncdr_total_per100k')
                            ->label('NCDR total / 100.000')
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

                Tables\Columns\TextColumn::make('pb_total')
                    ->label('PB (L+P)')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('mb_total')
                    ->label('MB (L+P)')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_kasus')
                    ->label('Total PB+MB')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('total_l')
                    ->label('Total L')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('total_p')
                    ->label('Total P')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kecamatan')
                    ->options(fn () => KasusBaruKusta::query()
                        ->orderBy('kecamatan')
                        ->pluck('kecamatan', 'kecamatan')
                        ->toArray()
                    ),
                Tables\Filters\SelectFilter::make('tahun')
                    ->options(fn () => KasusBaruKusta::query()
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
            'index'  => Pages\ListKasusBaruKustas::route('/'),
            'create' => Pages\CreateKasusBaruKusta::route('/create'),
            'edit'   => Pages\EditKasusBaruKusta::route('/{record}/edit'),
        ];
    }
}
