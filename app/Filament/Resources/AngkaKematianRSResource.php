<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AngkaKematianRSResource\Pages;
use App\Models\AngkaKematianRS;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;

class AngkaKematianRSResource extends Resource
{
    protected static ?string $model = AngkaKematianRS::class;

    protected static ?string $navigationIcon = 'heroicon-o-x-circle';

    public static function getNavigationLabel(): string
    {
        return 'Angka Kematian RS';
    }

    public static function getModelLabel(): string
    {
        return 'Angka Kematian RS';
    }

    public static function getPluralModelLabel(): string
    {
        return 'Angka Kematian Rumah Sakit';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Identitas Rumah Sakit')
                    ->schema([
                        TextInput::make('nama_rs')
                            ->label('Nama Rumah Sakit')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('tempat_tidur')
                            ->label('Jumlah Tempat Tidur')
                            ->numeric()
                            ->required(),
                    ])
                    ->columns(2),

                Section::make('Pasien Keluar (Hidup + Mati)')
                    ->schema([
                        TextInput::make('pk_l')
                            ->label('L')
                            ->numeric(),

                        TextInput::make('pk_p')
                            ->label('P')
                            ->numeric(),

                        TextInput::make('pk_total')
                            ->label('L + P')
                            ->numeric(),
                    ])
                    ->columns(3),

                Section::make('Pasien Keluar Mati')
                    ->schema([
                        TextInput::make('m_l')
                            ->label('L')
                            ->numeric(),

                        TextInput::make('m_p')
                            ->label('P')
                            ->numeric(),

                        TextInput::make('m_total')
                            ->label('L + P')
                            ->numeric(),
                    ])
                    ->columns(3),

                Section::make('Mati ≥ 48 Jam Dirawat')
                    ->schema([
                        TextInput::make('m48_l')
                            ->label('L')
                            ->numeric(),

                        TextInput::make('m48_p')
                            ->label('P')
                            ->numeric(),

                        TextInput::make('m48_total')
                            ->label('L + P')
                            ->numeric(),
                    ])
                    ->columns(3),

                Section::make('Gross Death Rate (GDR)')
                    ->schema([
                        TextInput::make('gdr_l')
                            ->label('L (%)')
                            ->numeric(),

                        TextInput::make('gdr_p')
                            ->label('P (%)')
                            ->numeric(),

                        TextInput::make('gdr_total')
                            ->label('Total (%)')
                            ->numeric(),
                    ])
                    ->columns(3),

                Section::make('Net Death Rate (NDR)')
                    ->schema([
                        TextInput::make('ndr_l')
                            ->label('L (%)')
                            ->numeric(),

                        TextInput::make('ndr_p')
                            ->label('P (%)')
                            ->numeric(),

                        TextInput::make('ndr_total')
                            ->label('Total (%)')
                            ->numeric(),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_rs')
                    ->label('Rumah Sakit')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('tempat_tidur')
                    ->label('Tempat Tidur')
                    ->sortable(),

                TextColumn::make('pk_total')
                    ->label('Pasien Keluar')
                    ->sortable(),

                TextColumn::make('m_total')
                    ->label('Mati')
                    ->sortable(),

                TextColumn::make('m48_total')
                    ->label('Mati ≥ 48 Jam')
                    ->sortable(),

                TextColumn::make('gdr_total')
                    ->label('GDR (%)')
                    ->sortable(),

                TextColumn::make('ndr_total')
                    ->label('NDR (%)')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListAngkaKematianRS::route('/'),
            'create' => Pages\CreateAngkaKematianRS::route('/create'),
            'edit' => Pages\EditAngkaKematianRS::route('/{record}/edit'),
        ];
    }
}
