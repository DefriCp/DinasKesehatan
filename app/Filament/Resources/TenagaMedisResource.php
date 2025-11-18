<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TenagaMedisResource\Pages;
use App\Models\TenagaMedis;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class TenagaMedisResource extends Resource
{
    protected static ?string $model = TenagaMedis::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'SDM Kesehatan';
    protected static ?int $navigationSort = 20;

    public static function getNavigationLabel(): string
    {
        return 'Tenaga Medis';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Tenaga Medis';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Unit Kerja')
                ->schema([
                    TextInput::make('unit_kerja')->required(),
                ]),

            Section::make('Dokter Spesialis')
                ->schema([
                    TextInput::make('sp_l')->numeric(),
                    TextInput::make('sp_p')->numeric(),
                    TextInput::make('sp_total')->numeric(),
                ])->columns(3),

            Section::make('Dokter Umum')
                ->schema([
                    TextInput::make('dr_l')->numeric(),
                    TextInput::make('dr_p')->numeric(),
                    TextInput::make('dr_total')->numeric(),
                ])->columns(3),

            Section::make('Total Dokter')
                ->schema([
                    TextInput::make('dokter_l')->numeric(),
                    TextInput::make('dokter_p')->numeric(),
                    TextInput::make('dokter_total')->numeric(),
                ])->columns(3),

            Section::make('Dokter Gigi')
                ->schema([
                    TextInput::make('gigi_l')->numeric(),
                    TextInput::make('gigi_p')->numeric(),
                    TextInput::make('gigi_total')->numeric(),
                ])->columns(3),

            Section::make('Dokter Gigi Spesialis')
                ->schema([
                    TextInput::make('gigis_l')->numeric(),
                    TextInput::make('gigis_p')->numeric(),
                    TextInput::make('gigis_total')->numeric(),
                ])->columns(3),

            Section::make('Total Dokter Gigi')
                ->schema([
                    TextInput::make('jumlah_gigi_l')->numeric(),
                    TextInput::make('jumlah_gigi_p')->numeric(),
                    TextInput::make('jumlah_gigi_total')->numeric(),
                ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('unit_kerja')->sortable()->searchable(),
            TextColumn::make('dokter_total')->label('Total Dokter'),
            TextColumn::make('gigi_total')->label('Dokter Gigi'),
            TextColumn::make('jumlah_gigi_total')->label('Total Gigi'),
        ])
        ->actions([Tables\Actions\EditAction::make()])
        ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTenagaMedis::route('/'),
            'create' => Pages\CreateTenagaMedis::route('/create'),
            'edit' => Pages\EditTenagaMedis::route('/{record}/edit'),
        ];
    }
}
