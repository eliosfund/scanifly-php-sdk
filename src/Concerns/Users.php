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
trait Users
{
    /**
     * Get available user positions.
     */
    public function getAvailableUserPositions(): Response
    {
        return $this->get('users/positions');
    }
}
