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
trait MediaCategories
{
    /**
     * Get media categories for a project.
     */
    public function getMediaCategoriesForProject(string $projectId): Response
    {
        return $this->get("media-categories/$projectId");
    }
}
