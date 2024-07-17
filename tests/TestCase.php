<?php

declare(strict_types=1);

namespace Scanifly\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Response as HttpResponse;
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

    protected function assertOk(Response $response): void
    {
        $this->assertSame(HttpResponse::HTTP_OK, $response->status());
    }

    protected function getPackageProviders($app): array
    {
        return [
            ScaniflyServiceProvider::class,
        ];
    }
}
