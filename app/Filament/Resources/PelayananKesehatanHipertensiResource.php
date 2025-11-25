<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PelayananKesehatanHipertensiResource\Pages;
use App\Models\PelayananKesehatanHipertensi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PelayananKesehatanHipertensiResource extends Resource
{
    protected static ?string $model = PelayananKesehatanHipertensi::class;

    protected static ?string $navigationIcon  = 'heroicon-o-heart';
    protected static ?string $navigationLabel = 'Pelayanan Hipertensi';
    protected static ?string $modelLabel      = 'Pelayanan Kesehatan Hipertensi';
    protected static ?string $pluralModelLabel = 'Pelayanan Kesehatan Hipertensi';
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

                // Estimasi penderita hipertensi
                Forms\Components\Section::make('Estimasi Penderita Hipertensi (≥ 15 tahun)')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('estimasi_l')
                            ->label('Laki-laki')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('estimasi_p')
                            ->label('Perempuan')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('estimasi_total')
                            ->label('L + P')
                            ->numeric()
                            ->default(0),
                    ]),

                // Mendapat pelayanan kesehatan
                Forms\Components\Section::make('Mendapat Pelayanan Kesehatan')
                    ->columns(3)
                    ->schema([
                        // Laki-laki
                        Forms\Components\Fieldset::make('Laki-laki')
                            ->schema([
                                Forms\Components\TextInput::make('pelayanan_l_jumlah')
                                    ->label('Jumlah L')
                                    ->numeric()
                                    ->default(0),
                                Forms\Components\TextInput::make('pelayanan_l_persen')
                                    ->label('% L')
                                    ->numeric()
                                    ->step(0.1)
                                    ->helperText('Sesuai kolom % laki-laki di tabel'),
                            ]),

                        // Perempuan
                        Forms\Components\Fieldset::make('Perempuan')
                            ->schema([
                                Forms\Components\TextInput::make('pelayanan_p_jumlah')
                                    ->label('Jumlah P')
                                    ->numeric()
                                    ->default(0),
                                Forms\Components\TextInput::make('pelayanan_p_persen')
                                    ->label('% P')
                                    ->numeric()
                                    ->step(0.1),
                            ]),

                        // Total
                        Forms\Components\Fieldset::make('Laki-laki + Perempuan')
                            ->schema([
                                Forms\Components\TextInput::make('pelayanan_total_jumlah')
                                    ->label('Jumlah L + P')
                                    ->numeric()
                                    ->default(0),
                                Forms\Components\TextInput::make('pelayanan_total_persen')
                                    ->label('% L + P')
                                    ->numeric()
                                    ->step(0.1)
                                    ->helperText('Cakupan pelayanan terhadap estimasi'),
                            ]),
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

                Tables\Columns\TextColumn::make('estimasi_total')
                    ->label('Estimasi (L+P)')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('pelayanan_total_jumlah')
                    ->label('Dilayani (L+P)')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('pelayanan_total_persen')
                    ->label('Cakupan (%)')
                    ->formatStateUsing(fn ($state) => $state !== null ? number_format($state, 1) . '%' : '-')
                    ->sortable(),

                Tables\Columns\TextColumn::make('pelayanan_l_jumlah')
                    ->label('L dilayani')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('pelayanan_p_jumlah')
                    ->label('P dilayani')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kecamatan')
                    ->options(fn () => PelayananKesehatanHipertensi::query()
                        ->orderBy('kecamatan')
                        ->pluck('kecamatan', 'kecamatan')
                        ->toArray()
                    ),

                Tables\Filters\SelectFilter::make('tahun')
                    ->options(fn () => PelayananKesehatanHipertensi::query()
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
            'index'  => Pages\ListPelayananKesehatanHipertensis::route('/'),
            'create' => Pages\CreatePelayananKesehatanHipertensi::route('/create'),
            'edit'   => Pages\EditPelayananKesehatanHipertensi::route('/{record}/edit'),
        ];
    }
}
