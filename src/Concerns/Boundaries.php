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
trait Boundaries
{
    /**
     * Get boundary.
     */
    public function getBoundary(string $boundaryId): Response
    {
        return $this->get("boundaries/$boundaryId");
    }

    /**
     * Get boundary by project ID.
     */
    public function getBoundaryByProjectId(string $projectId): Response
    {
        return $this->get("boundaries/project/$projectId");
    }
}
