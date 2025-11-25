<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DeteksiHepatitisBumilResource\Pages;
use App\Models\DeteksiHepatitisBumil;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DeteksiHepatitisBumilResource extends Resource
{
    protected static ?string $model = DeteksiHepatitisBumil::class;

    protected static ?string $navigationIcon  = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationLabel = 'Deteksi Hepatitis B (Bumil)';
    protected static ?string $pluralModelLabel = 'Deteksi Dini Hepatitis B pada Ibu Hamil';
    protected static ?string $modelLabel       = 'Deteksi Hepatitis B Bumil';
    protected static ?string $navigationGroup  = 'KIA & Imunisasi';

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

                Forms\Components\Section::make('Ibu Hamil dan Pemeriksaan Hepatitis B')
                    ->columns(3)
                    ->schema([
                        Forms\Components\TextInput::make('jumlah_ibu_hamil')
                            ->label('Jumlah ibu hamil')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('ibu_hamil_diperiksa_reaktif')
                            ->label('Bumil reaktif')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('ibu_hamil_diperiksa_nonreaktif')
                            ->label('Bumil non reaktif')
                            ->numeric()
                            ->default(0),

                        Forms\Components\TextInput::make('ibu_hamil_diperiksa_total')
                            ->label('Total bumil diperiksa')
                            ->numeric()
                            ->default(0)
                            ->helperText('Sesuai kolom TOTAL (reaktif + non reaktif)'),
                    ]),

                Forms\Components\Section::make('Persentase')
                    ->columns(2)
                    ->schema([
                        Forms\Components\TextInput::make('persen_bumil_diperiksa')
                            ->label('% bumil diperiksa')
                            ->numeric()
                            ->step(0.1)
                            ->helperText('Jumlah diperiksa / jumlah bumil x 100'),

                        Forms\Components\TextInput::make('persen_bumil_reaktif')
                            ->label('% bumil reaktif')
                            ->numeric()
                            ->step(0.1)
                            ->helperText('Reaktif / diperiksa x 100'),
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

                Tables\Columns\TextColumn::make('jumlah_ibu_hamil')
                    ->label('Jumlah bumil')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('ibu_hamil_diperiksa_total')
                    ->label('Bumil diperiksa')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('persen_bumil_diperiksa')
                    ->label('% bumil diperiksa')
                    ->formatStateUsing(fn ($s) => $s !== null ? number_format($s, 1) . '%' : '-')
                    ->sortable(),

                Tables\Columns\TextColumn::make('ibu_hamil_diperiksa_reaktif')
                    ->label('Bumil reaktif')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('persen_bumil_reaktif')
                    ->label('% bumil reaktif')
                    ->formatStateUsing(fn ($s) => $s !== null ? number_format($s, 1) . '%' : '-')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kecamatan')
                    ->options(fn () => DeteksiHepatitisBumil::query()
                        ->orderBy('kecamatan')
                        ->pluck('kecamatan', 'kecamatan')
                        ->toArray()
                    ),

                Tables\Filters\SelectFilter::make('tahun')
                    ->options(fn () => DeteksiHepatitisBumil::query()
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
            'index'  => Pages\ListDeteksiHepatitisBumils::route('/'),
            'create' => Pages\CreateDeteksiHepatitisBumil::route('/create'),
            'edit'   => Pages\EditDeteksiHepatitisBumil::route('/{record}/edit'),
        ];
    }
}
