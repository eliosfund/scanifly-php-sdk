<?php

declare(strict_types=1);

namespace Scanifly\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Http;
use Orchestra\Testbench\TestCase as Orchestra;
use Scanifly\ScaniflyServiceProvider;

/**
 * @property Application $app
 */
class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();
    }

    protected function getPackageProviders($app): array
    {
        return [
            ScaniflyServiceProvider::class,
        ];
    }
}
