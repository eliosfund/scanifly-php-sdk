<?php

declare(strict_types=1);

namespace Scanifly\Concerns;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Scanifly\ScaniflyService;

/**
 * @phpstan-require-extends ScaniflyService
 *
 * @mixin ScaniflyService
 */
trait SendsRequests
{
    public function __construct(
        protected PendingRequest $client
    ) {
    }

    /**
     * Issue a `GET` request to the given path.
     */
    public function get(string $path, ?array $query = null): Response
    {
        return $this->client->get($path, array_merge([
            'access_token' => config('scanifly.token'),
        ], $query ?? []));
    }
}
