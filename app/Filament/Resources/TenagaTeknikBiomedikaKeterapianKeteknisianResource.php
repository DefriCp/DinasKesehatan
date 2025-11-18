<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TenagaTeknikBiomedikaKeterapianKeteknisianResource\Pages;
use App\Models\TenagaTeknikBiomedikaKeterapianKeteknisian;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Section;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class TenagaTeknikBiomedikaKeterapianKeteknisianResource extends Resource
{
    protected static ?string $model = TenagaTeknikBiomedikaKeterapianKeteknisian::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';
    protected static ?string $navigationGroup = 'SDM Kesehatan';

    public static function getNavigationLabel(): string
    {
        return 'Teknik Biomedika & Keteknisian';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Unit Kerja')->schema([
                TextInput::make('unit_kerja')->required(),
            ]),

            Section::make('ATL (Lab Medik)')->schema([
                TextInput::make('atl_l')->numeric(),
                TextInput::make('atl_p')->numeric(),
                TextInput::make('atl_total')->numeric(),
            ])->columns(3),

            Section::make('Teknik Biomedika')->schema([
                TextInput::make('biomedika_l')->numeric(),
                TextInput::make('biomedika_p')->numeric(),
                TextInput::make('biomedika_total')->numeric(),
            ])->columns(3),

            Section::make('Keterapian Fisik')->schema([
                TextInput::make('keterapian_l')->numeric(),
                TextInput::make('keterapian_p')->numeric(),
                TextInput::make('keterapian_total')->numeric(),
            ])->columns(3),

            Section::make('Keteknisian Medis')->schema([
                TextInput::make('keteknisian_l')->numeric(),
                TextInput::make('keteknisian_p')->numeric(),
                TextInput::make('keteknisian_total')->numeric(),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('unit_kerja')->sortable()->searchable(),

            TextColumn::make('atl_total')->label('ATL'),
            TextColumn::make('biomedika_total')->label('Biomedika'),
            TextColumn::make('keterapian_total')->label('Keterapian'),
            TextColumn::make('keteknisian_total')->label('Keteknisian'),
        ])
        ->actions([Tables\Actions\EditAction::make()])
        ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTenagaTeknikBiomedikaKeterapianKeteknisian::route('/'),
            'create' => Pages\CreateTenagaTeknikBiomedikaKeterapianKeteknisian::route('/create'),
            'edit'   => Pages\EditTenagaTeknikBiomedikaKeterapianKeteknisian::route('/{record}/edit'),
        ];
    }
}
