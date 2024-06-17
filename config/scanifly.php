<?php

declare(strict_types=1);

return [

    'token' => env('SCANIFLY_TOKEN'),

    'fqdn' => env('SCANIFLY_FQDN', 'api.portal.scanifly.com'),

    'endpoint' => env('SCANIFLY_ENDPOINT', '/api/v1'),

    'timeout' => env('SCANIFLY_TIMEOUT', 10),

    'connect_timeout' => env('SCANIFLY_CONNECT_TIMEOUT', 2),

    'debug' => env('SCANIFLY_DEBUG', false),

];
