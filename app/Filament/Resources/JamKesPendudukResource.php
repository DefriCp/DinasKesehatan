<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JamKesPendudukResource\Pages;
use App\Models\JamKesPenduduk;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class JamKesPendudukResource extends Resource
{
    protected static ?string $model = JamKesPenduduk::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationGroup = 'Pembiayaan & Jaminan Kesehatan';

    public static function getNavigationLabel(): string
    {
        return 'Cakupan Jamkes Penduduk';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Data Kepesertaan')->schema([
                TextInput::make('jenis_kepesertaan')
                    ->label('Jenis Kepesertaan')
                    ->required()
                    ->maxLength(255),

                TextInput::make('jumlah')
                    ->label('Jumlah Peserta')
                    ->numeric()
                    ->required(),

                TextInput::make('persentase')
                    ->label('Persentase (%)')
                    ->numeric()
                    ->step('0.01')
                    ->suffix('%')
                    ->required(),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('jenis_kepesertaan')
                ->label('Jenis Kepesertaan')
                ->sortable()
                ->searchable(),

            TextColumn::make('jumlah')
                ->label('Jumlah')
                ->numeric()
                ->sortable(),

            TextColumn::make('persentase')
                ->label('%')
                ->formatStateUsing(fn ($state) => number_format($state, 1) . ' %')
                ->sortable(),
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
            'index'  => Pages\ListJamKesPenduduks::route('/'),
            'create' => Pages\CreateJamKesPenduduk::route('/create'),
            'edit'   => Pages\EditJamKesPenduduk::route('/{record}/edit'),
        ];
    }
}
