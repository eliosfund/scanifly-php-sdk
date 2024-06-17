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
trait ModuleLibrary
{
    /**
     * Get user's module library.
     */
    public function getUsersModuleLibrary(string $userId): Response
    {
        return $this->get("module-library/$userId");
    }

    /**
     * Get company module library.
     */
    public function getCompanyModuleLibrary(string $projectUserId): Response
    {
        return $this->get("module-library/combined/$projectUserId");
    }
}
