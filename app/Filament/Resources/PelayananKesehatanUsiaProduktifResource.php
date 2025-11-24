<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PelayananKesehatanUsiaProduktifResource\Pages;
use App\Models\PelayananKesehatanUsiaProduktif;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PelayananKesehatanUsiaProduktifResource extends Resource
{
    protected static ?string $model = PelayananKesehatanUsiaProduktif::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Pelayanan Kesehatan Usia Produktif';

    protected static ?string $modelLabel = 'Pelayanan Usia Produktif';
    protected static ?string $pluralModelLabel = 'Pelayanan Kesehatan Usia Produktif';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Identitas')
                    ->schema([
                        Forms\Components\TextInput::make('kecamatan')
                            ->required()
                            ->maxLength(100),

                        Forms\Components\TextInput::make('puskesmas')
                            ->required()
                            ->maxLength(100),
                    ])->columns(2),

                Forms\Components\Section::make('Penduduk Usia 15–59 Tahun')
                    ->schema([
                        Forms\Components\TextInput::make('penduduk_l')
                            ->numeric()
                            ->label('Laki-laki'),
                        Forms\Components\TextInput::make('penduduk_p')
                            ->numeric()
                            ->label('Perempuan'),
                        Forms\Components\TextInput::make('penduduk_total')
                            ->numeric()
                            ->label('L + P'),
                    ])->columns(3),

                Forms\Components\Section::make('Mendapat Pelayanan Skrining Kesehatan')
                    ->schema([
                        Forms\Components\TextInput::make('skrining_l')
                            ->numeric()
                            ->label('Laki-laki'),
                        Forms\Components\TextInput::make('skrining_l_persen')
                            ->numeric()
                            ->step('0.1')
                            ->label('% L'),

                        Forms\Components\TextInput::make('skrining_p')
                            ->numeric()
                            ->label('Perempuan'),
                        Forms\Components\TextInput::make('skrining_p_persen')
                            ->numeric()
                            ->step('0.1')
                            ->label('% P'),

                        Forms\Components\TextInput::make('skrining_total')
                            ->numeric()
                            ->label('L + P'),
                        Forms\Components\TextInput::make('skrining_total_persen')
                            ->numeric()
                            ->step('0.1')
                            ->label('% L + P'),
                    ])->columns(3),

                Forms\Components\Section::make('Berisiko')
                    ->schema([
                        Forms\Components\TextInput::make('berisiko_l')
                            ->numeric()
                            ->label('Laki-laki'),
                        Forms\Components\TextInput::make('berisiko_l_persen')
                            ->numeric()
                            ->step('0.1')
                            ->label('% L'),

                        Forms\Components\TextInput::make('berisiko_p')
                            ->numeric()
                            ->label('Perempuan'),
                        Forms\Components\TextInput::make('berisiko_p_persen')
                            ->numeric()
                            ->step('0.1')
                            ->label('% P'),

                        Forms\Components\TextInput::make('berisiko_total')
                            ->numeric()
                            ->label('L + P'),
                        Forms\Components\TextInput::make('berisiko_total_persen')
                            ->numeric()
                            ->step('0.1')
                            ->label('% L + P'),
                    ])->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('kecamatan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('puskesmas')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('penduduk_total')
                    ->label('Penduduk 15–59')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('skrining_total')
                    ->label('Skrining (L+P)')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('skrining_total_persen')
                    ->label('Skrining %')
                    ->suffix(' %')
                    ->sortable(),

                Tables\Columns\TextColumn::make('berisiko_total')
                    ->label('Berisiko (L+P)')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('berisiko_total_persen')
                    ->label('Berisiko %')
                    ->suffix(' %')
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPelayananKesehatanUsiaProduktifs::route('/'),
            'create' => Pages\CreatePelayananKesehatanUsiaProduktif::route('/create'),
            'edit' => Pages\EditPelayananKesehatanUsiaProduktif::route('/{record}/edit'),
        ];
    }
}
