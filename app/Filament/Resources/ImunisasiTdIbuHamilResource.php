<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImunisasiTdIbuHamilResource\Pages;
use App\Models\ImunisasiTdIbuHamil;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ImunisasiTdIbuHamilResource extends Resource
{
    protected static ?string $model = ImunisasiTdIbuHamil::class;

    protected static ?string $navigationIcon = 'heroicon-o-shield-check';
    protected static ?string $navigationGroup = 'KIA & Imunisasi';

    public static function getNavigationLabel(): string
    {
        return 'Imunisasi Td Ibu Hamil';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Lokasi')->schema([
                TextInput::make('kecamatan')->required(),
                TextInput::make('puskesmas')->required(),
                TextInput::make('jumlah_ibu_hamil')
                    ->label('Jumlah Ibu Hamil')
                    ->numeric()
                    ->required(),
            ])->columns(3),

            Section::make('Imunisasi Td')->schema([
                Grid::make(3)->schema([
                    TextInput::make('td1')->label('Td1 (Jlh)')->numeric(),
                    TextInput::make('td1_persen')->label('Td1 (%)')->numeric()->step('0.1')->suffix('%'),

                    TextInput::make('td2')->label('Td2 (Jlh)')->numeric(),
                    TextInput::make('td2_persen')->label('Td2 (%)')->numeric()->step('0.1')->suffix('%'),

                    TextInput::make('td3')->label('Td3 (Jlh)')->numeric(),
                    TextInput::make('td3_persen')->label('Td3 (%)')->numeric()->step('0.1')->suffix('%'),

                    TextInput::make('td4')->label('Td4 (Jlh)')->numeric(),
                    TextInput::make('td4_persen')->label('Td4 (%)')->numeric()->step('0.1')->suffix('%'),

                    TextInput::make('td5')->label('Td5 (Jlh)')->numeric(),
                    TextInput::make('td5_persen')->label('Td5 (%)')->numeric()->step('0.1')->suffix('%'),

                    TextInput::make('td2_plus')->label('Td2+ (Jlh)')->numeric(),
                    TextInput::make('td2_plus_persen')->label('Td2+ (%)')->numeric()->step('0.1')->suffix('%'),
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

                TextColumn::make('jumlah_ibu_hamil')->label('Ibu Hamil')->numeric(),

                TextColumn::make('td1_persen')->label('Td1 (%)')
                    ->formatStateUsing(fn ($v) => number_format($v, 1) . ' %'),

                TextColumn::make('td2_persen')->label('Td2 (%)')
                    ->formatStateUsing(fn ($v) => number_format($v, 1) . ' %'),

                TextColumn::make('td3_persen')->label('Td3 (%)')
                    ->formatStateUsing(fn ($v) => number_format($v, 1) . ' %'),

                TextColumn::make('td4_persen')->label('Td4 (%)')
                    ->formatStateUsing(fn ($v) => number_format($v, 1) . ' %'),

                TextColumn::make('td5_persen')->label('Td5 (%)')
                    ->formatStateUsing(fn ($v) => number_format($v, 1) . ' %'),

                TextColumn::make('td2_plus_persen')->label('Td2+ (%)')
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
            'index'  => Pages\ListImunisasiTdIbuHamils::route('/'),
            'create' => Pages\CreateImunisasiTdIbuHamil::route('/create'),
            'edit'   => Pages\EditImunisasiTdIbuHamil::route('/{record}/edit'),
        ];
    }
}
