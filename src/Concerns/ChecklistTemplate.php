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
trait ChecklistTemplate
{
    /**
     * Get checklist templates.
     */
    public function getChecklistTemplates(string $companyId): Response
    {
        return $this->get('checklist-template', [
            'companyId' => $companyId,
        ]);
    }

    /**
     * Get checklist template by ID.
     */
    public function getChecklistTemplate(string $templateId): Response
    {
        return $this->get("checklist-template/$templateId");
    }
}
