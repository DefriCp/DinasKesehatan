<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TenagaKeperawatandanTenagaKebidananResource\Pages;
use App\Models\TenagaKeperawatandanTenagaKebidanan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class TenagaKeperawatandanTenagaKebidananResource extends Resource
{
    protected static ?string $model = TenagaKeperawatandanTenagaKebidanan::class;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static ?string $navigationGroup = 'SDM Kesehatan';
    protected static ?int $navigationSort = 20;

    public static function getNavigationLabel(): string
    {
        return 'Perawat & Bidan';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Tenaga Keperawatan & Kebidanan';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Unit Kerja')
                ->schema([
                    TextInput::make('unit_kerja')
                        ->label('Unit Kerja')
                        ->required()
                        ->maxLength(255),
                ]),

            Section::make('Tenaga Keperawatan')
                ->schema([
                    TextInput::make('perawat_l')
                        ->label('L')
                        ->numeric()
                        ->default(0),

                    TextInput::make('perawat_p')
                        ->label('P')
                        ->numeric()
                        ->default(0),

                    TextInput::make('perawat_total')
                        ->label('L + P')
                        ->numeric()
                        ->default(0),
                ])
                ->columns(3),

            Section::make('Tenaga Kebidanan')
                ->schema([
                    TextInput::make('bidan_total')
                        ->label('Total Bidan')
                        ->numeric()
                        ->default(0),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('unit_kerja')
                    ->label('Unit Kerja')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('perawat_total')
                    ->label('Perawat (L+P)')
                    ->sortable(),

                TextColumn::make('bidan_total')
                    ->label('Bidan')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTenagaKeperawatandanTenagaKebidanan::route('/'),
            'create' => Pages\CreateTenagaKeperawatandanTenagaKebidanan::route('/create'),
            'edit' => Pages\EditTenagaKeperawatandanTenagaKebidanan::route('/{record}/edit'),
        ];
    }
}
