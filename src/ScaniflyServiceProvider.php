<?php

declare(strict_types=1);

namespace Scanifly;

use GuzzleHttp\Psr7\Uri;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class ScaniflyServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public function boot(): void
    {
        $this->publishes([
            $this->configPath() => config_path('scanifly.php'),
        ], 'scanifly-config');
    }

    public function register(): void
    {
        if (is_file($configPath = $this->configPath())) {
            $this->mergeConfigFrom($configPath, 'scanifly');
        }

        $this->app->singleton(ScaniflyService::class, static fn (): ScaniflyService => new ScaniflyService(
            client: Http::acceptJson()->baseUrl(
                url: (string) (new Uri())->withScheme(
                    scheme: 'https'
                )->withHost(
                    host: config('scanifly.fqdn')
                )->withPath(
                    path: config('scanifly.endpoint')
                )
            )->timeout(
                seconds: config('scanifly.timeout')
            )->connectTimeout(
                seconds: config('scanifly.connect_timeout')
            )
        ));
    }

    /**
     * @return array<int, class-string>
     */
    public function provides(): array
    {
        return [ScaniflyService::class];
    }

    protected function configPath(): string
    {
        return __DIR__.'/../config/scanifly.php';
    }
}
