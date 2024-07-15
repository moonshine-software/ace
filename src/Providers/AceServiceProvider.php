<?php

declare(strict_types=1);

namespace MoonShine\Ace\Providers;

use Illuminate\Support\ServiceProvider;

final class AceServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'moonshine-ace');

        $this->publishes([
            __DIR__ . '/../../config/moonshine_ace.php' => config_path('moonshine_ace.php'),
        ], ['moonshine-ace-config']);

        $this->mergeConfigFrom(
            __DIR__ . '/../../config/moonshine_ace.php',
            'moonshine_ace'
        );

        $this->publishes([
            __DIR__ . '/../../public' => public_path('vendor/moonshine/packages/ace'),
        ], ['moonshine-ace-assets', 'moonshine-assets', 'laravel-assets']);
    }
}
