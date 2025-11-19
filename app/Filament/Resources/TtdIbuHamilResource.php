<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TtdIbuHamilResource\Pages;
use App\Models\TtdIbuHamil;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Grid;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class TtdIbuHamilResource extends Resource
{
    protected static ?string $model = TtdIbuHamil::class;

    protected static ?string $navigationGroup = 'KIA & Imunisasi';
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    public static function getNavigationLabel(): string
    {
        return 'TTD Ibu Hamil (90 Tablet)';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Lokasi')->schema([
                TextInput::make('kecamatan')->required(),
                TextInput::make('puskesmas')->required(),
                TextInput::make('jumlah_ibu_hamil')->numeric()->required(),
            ])->columns(3),

            Section::make('Tablet Tambah Darah (TTD)')->schema([
                Grid::make(2)->schema([
                    TextInput::make('dapat_ttd')->numeric()->label('Ibu Mendapatkan TTD'),
                    TextInput::make('dapat_ttd_persen')->numeric()->step('0.1')->suffix('%'),

                    TextInput::make('konsumsi_ttd')->numeric()->label('Ibu Mengonsumsi TTD'),
                    TextInput::make('konsumsi_ttd_persen')->numeric()->step('0.1')->suffix('%'),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('kecamatan')->sortable()->searchable(),
                TextColumn::make('puskesmas')->sortable()->searchable(),

                TextColumn::make('jumlah_ibu_hamil')->label('Ibu Hamil'),

                TextColumn::make('dapat_ttd_persen')->label('Dapat TTD (%)')
                    ->formatStateUsing(fn ($v) => number_format($v, 1) . ' %'),

                TextColumn::make('konsumsi_ttd_persen')->label('Konsumsi TTD (%)')
                    ->formatStateUsing(fn ($v) => number_format($v, 1) . ' %'),
            ])
            ->defaultSort('kecamatan')
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTtdIbuHamils::route('/'),
            'create' => Pages\CreateTtdIbuHamil::route('/create'),
            'edit'   => Pages\EditTtdIbuHamil::route('/{record}/edit'),
        ];
    }
}
