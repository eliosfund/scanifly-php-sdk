<?php

declare(strict_types=1);

namespace Scanifly;

use Illuminate\Contracts\Support\DeferrableProvider;
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

        $this->app->singleton(
            abstract: ScaniflyService::class,
            concrete: static fn (): ScaniflyService => new ScaniflyService()
        );
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
