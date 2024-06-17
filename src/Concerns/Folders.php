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
trait Folders
{
    /**
     * Get folder.
     */
    public function getFolder(string $folderId): Response
    {
        return $this->get("folders/$folderId");
    }

    /**
     * Get folders for current company.
     */
    public function getFoldersForCurrentCompany(): Response
    {
        return $this->get('folders/current');
    }
}
