<?php

declare(strict_types=1);

namespace Scanifly\Tests\Facades;

use Random\RandomException;
use Scanifly\Facades\Scanifly;
use Scanifly\Tests\TestCase;

class ScaniflyTest extends TestCase
{
    public function test_it_can_fake_a_response(): void
    {
        Scanifly::fake();

        $this->assertOk(Scanifly::get('/'));
    }

    public function test_it_can_build_a_url(): void
    {
        $expected = 'https://api.portal.scanifly.com/api/v1/test?access_token=00000000-0000-0000-0000-000000000000';

        $url = Scanifly::buildUrl('/test');

        $this->assertSame($expected, $url);
    }

    public function test_it_can_build_a_url_with_query(): void
    {
        $expected = 'https://api.portal.scanifly.com/api/v1/test?access_token=00000000-0000-0000-0000-000000000000&foo=bar';

        $url = Scanifly::buildUrl('/test', [
            'foo' => 'bar',
        ]);

        $this->assertSame($expected, $url);
    }

    public function test_it_can_get_the_base_uri(): void
    {
        $uri = Scanifly::baseUri();

        $this->assertSame('https', $uri->getScheme());
        $this->assertSame('api.portal.scanifly.com', $uri->getHost());
        $this->assertSame('/api/v1', $uri->getPath());
    }

    public function test_it_can_get_the_client(): void
    {
        $expected = [
            'connect_timeout' => config('scanifly.connect_timeout'),
            'http_errors' => false,
            'timeout' => config('scanifly.timeout'),
            'headers' => [
                'Accept' => 'application/json',
            ],
        ];

        $options = Scanifly::client()->getOptions();

        $this->assertSame($expected, $options);
    }

    public function test_get_boundary(): void
    {
        $boundaryId = $this->generateDataObjectId();

        Scanifly::fake("/boundaries/$boundaryId");

        $this->assertOk(Scanifly::getBoundary(
            boundaryId: $boundaryId
        ));
    }

    public function test_get_boundary_by_project_id(): void
    {
        $projectId = $this->generateDataObjectId();

        Scanifly::fake("/boundaries/project/$projectId");

        $this->assertOk(Scanifly::getBoundaryByProjectId(
            projectId: $projectId
        ));
    }

    public function test_get_checklists_by_project_id(): void
    {
        $projectId = $this->generateDataObjectId();

        Scanifly::fake("/checklist/$projectId");

        $this->assertOk(Scanifly::getChecklistsByProjectId(
            projectId: $projectId
        ));
    }

    public function test_get_checklist_by_id(): void
    {
        $projectId = $this->generateDataObjectId();
        $checklistId = $this->generateDataObjectId();

        Scanifly::fake("/checklist/$projectId/$checklistId");

        $this->assertOk(Scanifly::getChecklistById(
            projectId: $projectId,
            checklistId: $checklistId
        ));
    }

    public function test_checklist_templates(): void
    {
        $companyId = $this->generateDataObjectId();

        Scanifly::fake('/checklist-template', [
            'companyId' => $companyId,
        ]);

        $this->assertOk(Scanifly::getChecklistTemplates(
            companyId: $companyId
        ));
    }

    public function test_checklist_template(): void
    {
        $templateId = $this->generateDataObjectId();

        Scanifly::fake("/checklist-template/$templateId");

        $this->assertOk(Scanifly::getChecklistTemplate(
            templateId: $templateId
        ));
    }

    public function test_get_current_users_company(): void
    {
        Scanifly::fake('/companies/current');

        $this->assertOk(Scanifly::getCurrentUsersCompany());
    }

    public function test_get_current_users_company_members(): void
    {
        Scanifly::fake('/companies/current/members');

        $this->assertOk(Scanifly::getCurrentUsersCompanyMembers());
    }

    public function test_get_project_designs(): void
    {
        Scanifly::fake('/designs');

        $this->assertOk(Scanifly::getProjectDesigns());
    }

    public function test_get_designs_by_project_id(): void
    {
        $projectId = $this->generateDataObjectId();

        Scanifly::fake("/designs/$projectId");

        $this->assertOk(Scanifly::getDesignsByProjectId(
            projectId: $projectId
        ));
    }

    public function test_get_folder(): void
    {
        $folderId = $this->generateDataObjectId();

        Scanifly::fake("/folders/$folderId");

        $this->assertOk(Scanifly::getFolder(
            folderId: $folderId
        ));
    }

    public function test_get_folders_for_current_company(): void
    {
        Scanifly::fake('/folders/current');

        $this->assertOk(Scanifly::getFoldersForCurrentCompany());
    }

    public function test_get_media_by_category_id(): void
    {
        $projectId = $this->generateDataObjectId();
        $categoryId = $this->generateDataObjectId();

        Scanifly::fake("/media/$projectId/$categoryId");

        $this->assertOk(Scanifly::getMediaByCategoryId(
            projectId: $projectId,
            categoryId: $categoryId
        ));
    }

    public function test_get_media_by_id(): void
    {
        $projectId = $this->generateDataObjectId();
        $categoryId = $this->generateDataObjectId();
        $mediaId = $this->generateDataObjectId();

        Scanifly::fake("/media/$projectId/$categoryId/$mediaId");

        $this->assertOk(Scanifly::getMediaById(
            projectId: $projectId,
            categoryId: $categoryId,
            mediaId: $mediaId
        ));
    }

    public function test_get_media_categories_for_project(): void
    {
        $projectId = $this->generateDataObjectId();

        Scanifly::fake("/media-categories/$projectId");

        $this->assertOk(Scanifly::getMediaCategoriesForProject(
            projectId: $projectId
        ));
    }

    public function test_get_users_module_library(): void
    {
        $userId = $this->generateDataObjectId();

        Scanifly::fake("/module-library/$userId");

        $this->assertOk(Scanifly::getUsersModuleLibrary(
            userId: $userId
        ));
    }

    public function test_get_company_module_library(): void
    {
        $projectUserId = $this->generateDataObjectId();

        Scanifly::fake("/module-library/combined/$projectUserId");

        $this->assertOk(Scanifly::getCompanyModuleLibrary(
            projectUserId: $projectUserId
        ));
    }

    public function test_get_project_by_id(): void
    {
        $projectId = $this->generateDataObjectId();

        Scanifly::fake("/projects/$projectId");

        $this->assertOk(Scanifly::getProjectById(
            projectId: $projectId
        ));
    }

    public function test_get_projects(): void
    {
        Scanifly::fake('/projects');

        $this->assertOk(Scanifly::getProjects());
    }

    public function test_get_service_request(): void
    {
        $projectId = $this->generateDataObjectId();

        Scanifly::fake("/serviceRequests/project/$projectId");

        $this->assertOk(Scanifly::getServiceRequest(
            projectId: $projectId
        ));
    }

    public function test_get_available_user_positions(): void
    {
        Scanifly::fake('/users/positions');

        $this->assertOk(Scanifly::getAvailableUserPositions());
    }

    protected function generateDataObjectId(): string
    {
        try {
            return bin2hex(random_bytes(12));
        } catch (RandomException) {
            return '000000000000000000000000';
        }
    }
}
