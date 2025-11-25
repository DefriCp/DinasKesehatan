<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PelayananKesehatanDMResource\Pages;
use App\Models\PelayananKesehatanDM;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PelayananKesehatanDMResource extends Resource
{
    protected static ?string $model = PelayananKesehatanDM::class;

    protected static ?string $navigationIcon  = 'heroicon-o-beaker';
    protected static ?string $navigationLabel = 'Pelayanan DM';
    protected static ?string $modelLabel      = 'Pelayanan Kesehatan DM';
    protected static ?string $pluralModelLabel = 'Pelayanan Kesehatan DM';
    protected static ?string $navigationGroup = 'PTM & Faktor Risiko';

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

                // Data DM
                Forms\Components\Section::make('Pelayanan Kesehatan Penderita DM')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('jumlah_penderita_dm')
                            ->label('Jumlah Penderita DM')
                            ->numeric()
                            ->default(0)
                            ->required(),

                        Forms\Components\TextInput::make('pelayanan_jumlah')
                            ->label('Mendapat Pelayanan')
                            ->numeric()
                            ->default(0)
                            ->required(),

                        Forms\Components\TextInput::make('pelayanan_persen')
                            ->label('Cakupan Pelayanan (%)')
                            ->numeric()
                            ->step(0.1)
                            ->helperText('Sesuai kolom % pada tabel (misal 110,7)'),
                    ]),

                Forms\Components\Section::make('Catatan (opsional)')
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

                Tables\Columns\TextColumn::make('jumlah_penderita_dm')
                    ->label('Penderita DM')
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
                    ->options(fn () => PelayananKesehatanDM::query()
                        ->orderBy('kecamatan')
                        ->pluck('kecamatan', 'kecamatan')
                        ->toArray()
                    ),

                Tables\Filters\SelectFilter::make('tahun')
                    ->options(fn () => PelayananKesehatanDM::query()
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
            'index'  => Pages\ListPelayananKesehatanDMS::route('/'),
            'create' => Pages\CreatePelayananKesehatanDM::route('/create'),
            'edit'   => Pages\EditPelayananKesehatanDM::route('/{record}/edit'),
        ];
    }
}
