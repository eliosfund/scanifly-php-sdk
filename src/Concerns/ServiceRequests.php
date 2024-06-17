<?php

declare(strict_types=1);

namespace Scanifly\Concerns;

use Illuminate\Http\Client\Response;
use Scanifly\ScaniflyService;

/**
 * @phpstan-require-extends ScaniflyService
 *
 * @mixin ScaniflyService
 */
trait ServiceRequests
{
    /**
     * Get service request.
     */
    public function getServiceRequest(string $projectId): Response
    {
        return $this->get("serviceRequests/project/$projectId");
    }
}
