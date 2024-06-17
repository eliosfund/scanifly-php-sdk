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
trait Checklist
{
    /**
     * Get checklists by project ID.
     */
    public function getChecklistsByProjectId(string $projectId): Response
    {
        return $this->get("checklist/$projectId");
    }

    /**
     * Get checklist by ID.
     */
    public function getChecklistById(string $projectId, string $checklistId): Response
    {
        return $this->get("checklist/$projectId/$checklistId");
    }
}
