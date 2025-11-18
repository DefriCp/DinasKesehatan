<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PelayananKesehatanIbuResource\Pages;
use App\Models\PelayananKesehatanIbu;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class PelayananKesehatanIbuResource extends Resource
{
    protected static ?string $model = PelayananKesehatanIbu::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Pelayanan Kesehatan Ibu & Anak';

    public static function getNavigationLabel(): string
    {
        return 'Cakupan Pelayanan Ibu (Kec/Puskesmas)';
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make('Lokasi')->schema([
                TextInput::make('kecamatan')->required(),
                TextInput::make('puskesmas')->required(),
            ])->columns(2),

            Section::make('Ibu Hamil')->schema([
                TextInput::make('ibu_hamil_jumlah')->label('Jumlah Ibu Hamil')->numeric(),

                TextInput::make('k1_jumlah')->label('K1 (Jlh)')->numeric(),
                TextInput::make('k1_persen')->label('K1 (%)')->numeric()->step('0.1')->suffix('%'),

                TextInput::make('k4_jumlah')->label('K4 (Jlh)')->numeric(),
                TextInput::make('k4_persen')->label('K4 (%)')->numeric()->step('0.1')->suffix('%'),

                TextInput::make('k6_jumlah')->label('K6 (Jlh)')->numeric(),
                TextInput::make('k6_persen')->label('K6 (%)')->numeric()->step('0.1')->suffix('%'),
            ])->columns(3),

            Section::make('Ibu Bersalin & Nifas')->schema([
                TextInput::make('ibu_bersalin_jumlah')->label('Jumlah Ibu Bersalin/Nifas')->numeric(),

                TextInput::make('persalinan_fasyankes_jumlah')->label('Persalinan di Fasyankes (Jlh)')->numeric(),
                TextInput::make('persalinan_fasyankes_persen')->label('Persalinan di Fasyankes (%)')->numeric()->step('0.1')->suffix('%'),

                TextInput::make('kf1_jumlah')->label('KF1 (Jlh)')->numeric(),
                TextInput::make('kf1_persen')->label('KF1 (%)')->numeric()->step('0.1')->suffix('%'),

                TextInput::make('kf_lengkap_jumlah')->label('KF Lengkap (Jlh)')->numeric(),
                TextInput::make('kf_lengkap_persen')->label('KF Lengkap (%)')->numeric()->step('0.1')->suffix('%'),

                TextInput::make('nifas_vita_jumlah')->label('Ibu Nifas Vit A (Jlh)')->numeric(),
                TextInput::make('nifas_vita_persen')->label('Ibu Nifas Vit A (%)')->numeric()->step('0.1')->suffix('%'),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('kecamatan')->sortable()->searchable(),
            TextColumn::make('puskesmas')->sortable()->searchable(),

            TextColumn::make('ibu_hamil_jumlah')->label('Ibu Hamil')->sortable(),

            TextColumn::make('k1_persen')
                ->label('K1 (%)')
                ->formatStateUsing(fn ($v) => number_format($v, 1) . ' %'),

            TextColumn::make('k4_persen')
                ->label('K4 (%)')
                ->formatStateUsing(fn ($v) => number_format($v, 1) . ' %'),

            TextColumn::make('k6_persen')
                ->label('K6 (%)')
                ->formatStateUsing(fn ($v) => number_format($v, 1) . ' %'),

            TextColumn::make('persalinan_fasyankes_persen')
                ->label('Persalinan Fasyankes (%)')
                ->formatStateUsing(fn ($v) => number_format($v, 1) . ' %'),

            TextColumn::make('kf_lengkap_persen')
                ->label('KF Lengkap (%)')
                ->formatStateUsing(fn ($v) => number_format($v, 1) . ' %'),

            TextColumn::make('nifas_vita_persen')
                ->label('Nifas Vit A (%)')
                ->formatStateUsing(fn ($v) => number_format($v, 1) . ' %'),
        ])
        ->defaultSort('kecamatan')
        ->filters([])
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
            'index'  => Pages\ListPelayananKesehatanIbus::route('/'),
            'create' => Pages\CreatePelayananKesehatanIbu::route('/create'),
            'edit'   => Pages\EditPelayananKesehatanIbu::route('/{record}/edit'),
        ];
    }
}
