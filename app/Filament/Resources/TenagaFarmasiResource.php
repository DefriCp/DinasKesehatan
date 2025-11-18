<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TenagaFarmasiResource\Pages;
use App\Models\TenagaFarmasi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class TenagaFarmasiResource extends Resource
{
    protected static ?string $model = TenagaFarmasi::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';
    protected static ?string $navigationGroup = 'SDM Kesehatan';

    public static function getNavigationLabel(): string
    {
        return 'Tenaga Farmasi';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Unit Kerja')->schema([
                TextInput::make('unit_kerja')
                    ->label('Unit Kerja')
                    ->required()
                    ->maxLength(255),
            ]),

            Section::make('Tenaga Teknis Kefarmasian (TTK)')->schema([
                TextInput::make('ttk_l')->label('L')->numeric(),
                TextInput::make('ttk_p')->label('P')->numeric(),
                TextInput::make('ttk_total')->label('L + P')->numeric(),
            ])->columns(3),

            Section::make('Apoteker')->schema([
                TextInput::make('apoteker_l')->label('L')->numeric(),
                TextInput::make('apoteker_p')->label('P')->numeric(),
                TextInput::make('apoteker_total')->label('L + P')->numeric(),
            ])->columns(3),

            Section::make('Total Tenaga Farmasi')->schema([
                TextInput::make('total_l')->label('L')->numeric(),
                TextInput::make('total_p')->label('P')->numeric(),
                TextInput::make('total_total')->label('L + P')->numeric(),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('unit_kerja')
                ->label('Unit Kerja')
                ->sortable()
                ->searchable(),

            TextColumn::make('ttk_total')->label('TTK')->sortable(),
            TextColumn::make('apoteker_total')->label('Apoteker')->sortable(),
            TextColumn::make('total_total')->label('Total Farmasi')->sortable(),
        ])
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
            'index'  => Pages\ListTenagaFarmasis::route('/'),
            'create' => Pages\CreateTenagaFarmasi::route('/create'),
            'edit'   => Pages\EditTenagaFarmasi::route('/{record}/edit'),
        ];
    }
}
