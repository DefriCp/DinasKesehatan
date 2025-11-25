<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KasusFluBurungResource\Pages;
use App\Models\KasusFluBurung;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KasusFluBurungResource extends Resource
{
    protected static ?string $model = KasusFluBurung::class;

    protected static ?string $navigationIcon  = 'heroicon-o-sparkles';
    protected static ?string $navigationLabel = 'Kasus Flu Burung';
    protected static ?string $modelLabel      = 'Kasus Flu Burung';
    protected static ?string $pluralModelLabel = 'Kasus Flu Burung';
    protected static ?string $navigationGroup = 'Penyakit Menular';

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
                            ->maxLength(150),

                        Forms\Components\TextInput::make('tahun')
                            ->numeric()
                            ->minValue(2000)
                            ->maxValue(2100)
                            ->default(now()->year),
                    ]),

                Forms\Components\Section::make('Kasus Flu Burung')
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
                            ->label('Kasus L + P')
                            ->numeric()
                            ->required()
                            ->helperText('Jumlah total kasus L + P'),
                    ]),

                Forms\Components\Section::make('Kematian Flu Burung')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('kematian_l')
                            ->label('Kematian L')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('kematian_p')
                            ->label('Kematian P')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('kematian_total')
                            ->label('Kematian L + P')
                            ->numeric()
                            ->default(0)
                            ->helperText('Jumlah total kematian L + P'),
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

                Tables\Columns\TextColumn::make('kasus_total')
                    ->label('Kasus Flu Burung')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('kematian_total')
                    ->label('Kematian')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('cfr')
                    ->label('CFR (%)')
                    ->formatStateUsing(function ($state) {
                        return $state === null ? '-' : number_format($state, 1) . '%';
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kecamatan')
                    ->options(fn () => KasusFluBurung::query()
                        ->orderBy('kecamatan')
                        ->pluck('kecamatan', 'kecamatan')
                        ->toArray()
                    ),

                Tables\Filters\SelectFilter::make('tahun')
                    ->options(fn () => KasusFluBurung::query()
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
            'index'  => Pages\ListKasusFluBurungs::route('/'),
            'create' => Pages\CreateKasusFluBurung::route('/create'),
            'edit'   => Pages\EditKasusFluBurung::route('/{record}/edit'),
        ];
    }
}
