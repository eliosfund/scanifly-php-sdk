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
trait Designs
{
    /**
     * Get project designs.
     */
    public function getProjectDesigns(): Response
    {
        return $this->get('designs');
    }

    /**
     * Get designs by project ID.
     */
    public function getDesignsByProjectId(string $projectId): Response
    {
        return $this->get("designs/$projectId");
    }
}
