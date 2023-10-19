<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        FilamentColor::register([
            'blue' => Color::hex('#2969cf'),
            'green' => Color::hex('#29cf45'),
            'red' => Color::hex('#29cf45'),
            'yellow' => Color::hex('#cfcf29'),
            'cyan' => Color::hex('#29c9cf'),
            'purple' => Color::hex('#b329cf'),
        ]);
    }
}
