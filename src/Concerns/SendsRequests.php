<?php

declare(strict_types=1);

namespace Scanifly\Concerns;

use GuzzleHttp\Psr7\Uri;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Scanifly\ScaniflyService;

/**
 * @phpstan-require-extends ScaniflyService
 *
 * @mixin ScaniflyService
 */
trait SendsRequests
{
    public function buildUrl(string $path, ?array $query = null): string
    {
        $url = $this->baseUri();

        $url = $url->withPath(
            path: $url->getPath().Str::start($path, '/')
        )->withQuery(
            query: http_build_query(array_merge(
                ['access_token' => config('scanifly.token')],
                $query ?? []
            ))
        );

        return (string) $url;
    }

    public function baseUri(): Uri
    {
        return (new Uri())->withScheme(
            scheme: 'https'
        )->withHost(
            host: config('scanifly.fqdn')
        )->withPath(
            path: config('scanifly.endpoint')
        );
    }

    public function client(): PendingRequest
    {
        return Http::acceptJson()->baseUrl(
            url: (string) $this->baseUri()
        )->timeout(
            seconds: config('scanifly.timeout')
        )->connectTimeout(
            seconds: config('scanifly.connect_timeout')
        );
    }

    /**
     * Issue a `GET` request to the given path.
     */
    public function get(string $path, ?array $query = null): Response
    {
        return $this->client()->get($path, array_merge([
            'access_token' => config('scanifly.token'),
        ], $query ?? []));
    }
}
