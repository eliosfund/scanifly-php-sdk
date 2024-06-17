<?php

declare(strict_types=1);

namespace Scanifly;

use Scanifly\Concerns\SendsRequests;

class ScaniflyService
{
    use Concerns\Boundaries;
    use Concerns\Checklist;
    use Concerns\ChecklistTemplate;
    use Concerns\Companies;
    use Concerns\Designs;
    use Concerns\Folders;
    use Concerns\Media;
    use Concerns\MediaCategories;
    use Concerns\ModuleLibrary;
    use Concerns\Projects;
    use Concerns\ServiceRequests;
    use Concerns\Users;
    use SendsRequests;
}
