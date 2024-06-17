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
trait Companies
{
    /**
     * Get current user's company.
     */
    public function getCurrentUsersCompany(): Response
    {
        return $this->get('companies/current');
    }

    /**
     * Get current user's company members.
     */
    public function getCurrentUsersCompanyMembers(): Response
    {
        return $this->get('companies/current/members');
    }
}
