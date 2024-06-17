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
trait Media
{
    /**
     * Get media by category ID.
     */
    public function getMediaByCategoryId(string $projectId, string $categoryId): Response
    {
        return $this->get("media/$projectId/$categoryId");
    }

    /**
     * Get media by ID.
     */
    public function getMediaById(string $projectId, string $categoryId, string $mediaId): Response
    {
        return $this->get("media/$projectId/$categoryId/$mediaId");
    }
}
