<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use Illuminate\Contracts\Support\Htmlable;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static string $view = 'filament.pages.admin-dashboard';

    public function getHeading(): string|Htmlable
    {
        return 'Dashboard Dinas Kesehatan';
    }

    public function getSubheading(): string|Htmlable|null
    {
        $name = auth()->user()?->name ?? 'Admin';

        return "Halo, {$name} 👋";
    }
}
