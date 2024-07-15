<?php

namespace MoonShine\Ace\Tests;

use MoonShine\Laravel\Providers\MoonShineServiceProvider;
use MoonShine\Ace\Providers\AceServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app): array
    {
        return [
            MoonShineServiceProvider::class,
            AceServiceProvider::class,
        ];
    }
}
