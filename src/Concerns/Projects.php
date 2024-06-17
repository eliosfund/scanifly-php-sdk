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
trait Projects
{
    /**
     * Get project by ID.
     */
    public function getProjectById(string $projectId): Response
    {
        return $this->get("projects/$projectId");
    }

    /**
     * Get projects.
     */
    public function getProjects(): Response
    {
        return $this->get('projects');
    }
}
