<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TenagaKesmasKeslingdanGiziResource\Pages;
use App\Models\TenagaKesmasKeslingdanGizi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class TenagaKesmasKeslingdanGiziResource extends Resource
{
    protected static ?string $model = TenagaKesmasKeslingdanGizi::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'SDM Kesehatan';

    public static function getNavigationLabel(): string
    {
        return 'Kesmas, Kesling & Gizi';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Unit Kerja')->schema([
                TextInput::make('unit_kerja')->required(),
            ]),

            Section::make('Tenaga Kesmas')->schema([
                TextInput::make('kesmas_l')->numeric(),
                TextInput::make('kesmas_p')->numeric(),
                TextInput::make('kesmas_total')->numeric(),
            ])->columns(3),

            Section::make('Tenaga Kesling')->schema([
                TextInput::make('kesling_l')->numeric(),
                TextInput::make('kesling_p')->numeric(),
                TextInput::make('kesling_total')->numeric(),
            ])->columns(3),

            Section::make('Tenaga Gizi')->schema([
                TextInput::make('gizi_l')->numeric(),
                TextInput::make('gizi_p')->numeric(),
                TextInput::make('gizi_total')->numeric(),
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

            TextColumn::make('kesmas_total')->label('Kesmas')->sortable(),
            TextColumn::make('kesling_total')->label('Kesling')->sortable(),
            TextColumn::make('gizi_total')->label('Gizi')->sortable(),
        ])
        ->actions([Tables\Actions\EditAction::make()])
        ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListTenagaKesmasKeslingdanGizi::route('/'),
            'create' => Pages\CreateTenagaKesmasKeslingdanGizi::route('/create'),
            'edit'   => Pages\EditTenagaKesmasKeslingdanGizi::route('/{record}/edit'),
        ];
    }
}
