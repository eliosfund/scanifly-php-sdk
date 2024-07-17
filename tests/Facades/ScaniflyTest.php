<?php

declare(strict_types=1);

namespace Scanifly\Tests\Facades;

use GuzzleHttp\Psr7\Uri;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Random\RandomException;
use Scanifly\Facades\Scanifly;
use Scanifly\Tests\TestCase;

class ScaniflyTest extends TestCase
{
    public function test_get_boundary(): void
    {
        $boundaryId = $this->generateDataObjectId();

        $this->fakeScanifly("/boundaries/$boundaryId");

        $this->assertOk(Scanifly::getBoundary(
            boundaryId: $boundaryId
        ));
    }

    public function test_get_boundary_by_project_id(): void
    {
        $projectId = $this->generateDataObjectId();

        $this->fakeScanifly("/boundaries/project/$projectId");

        $this->assertOk(Scanifly::getBoundaryByProjectId(
            projectId: $projectId
        ));
    }

    public function test_get_checklists_by_project_id(): void
    {
        $projectId = $this->generateDataObjectId();

        $this->fakeScanifly("/checklist/$projectId");

        $this->assertOk(Scanifly::getChecklistsByProjectId(
            projectId: $projectId
        ));
    }

    public function test_get_checklist_by_id(): void
    {
        $projectId = $this->generateDataObjectId();
        $checklistId = $this->generateDataObjectId();

        $this->fakeScanifly("/checklist/$projectId/$checklistId");

        $this->assertOk(Scanifly::getChecklistById(
            projectId: $projectId,
            checklistId: $checklistId
        ));
    }

    public function test_checklist_templates(): void
    {
        $companyId = $this->generateDataObjectId();

        $this->fakeScanifly('/checklist-template', [
            'companyId' => $companyId,
        ]);

        $this->assertOk(Scanifly::getChecklistTemplates(
            companyId: $companyId
        ));
    }

    public function test_checklist_template(): void
    {
        $templateId = $this->generateDataObjectId();

        $this->fakeScanifly("/checklist-template/$templateId");

        $this->assertOk(Scanifly::getChecklistTemplate(
            templateId: $templateId
        ));
    }

    public function test_get_current_users_company(): void
    {
        $this->fakeScanifly('/companies/current');

        $this->assertOk(Scanifly::getCurrentUsersCompany());
    }

    public function test_get_current_users_company_members(): void
    {
        $this->fakeScanifly('/companies/current/members');

        $this->assertOk(Scanifly::getCurrentUsersCompanyMembers());
    }

    public function test_get_project_designs(): void
    {
        $this->fakeScanifly('/designs');

        $this->assertOk(Scanifly::getProjectDesigns());
    }

    public function test_get_designs_by_project_id(): void
    {
        $projectId = $this->generateDataObjectId();

        $this->fakeScanifly("/designs/$projectId");

        $this->assertOk(Scanifly::getDesignsByProjectId(
            projectId: $projectId
        ));
    }

    public function test_get_folder(): void
    {
        $folderId = $this->generateDataObjectId();

        $this->fakeScanifly("/folders/$folderId");

        $this->assertOk(Scanifly::getFolder(
            folderId: $folderId
        ));
    }

    public function test_get_folders_for_current_company(): void
    {
        $this->fakeScanifly('/folders/current');

        $this->assertOk(Scanifly::getFoldersForCurrentCompany());
    }

    public function test_get_media_by_category_id(): void
    {
        $projectId = $this->generateDataObjectId();
        $categoryId = $this->generateDataObjectId();

        $this->fakeScanifly("/media/$projectId/$categoryId");

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

        $this->fakeScanifly("/media/$projectId/$categoryId/$mediaId");

        $this->assertOk(Scanifly::getMediaById(
            projectId: $projectId,
            categoryId: $categoryId,
            mediaId: $mediaId
        ));
    }

    public function test_get_media_categories_for_project(): void
    {
        $projectId = $this->generateDataObjectId();

        $this->fakeScanifly("/media-categories/$projectId");

        $this->assertOk(Scanifly::getMediaCategoriesForProject(
            projectId: $projectId
        ));
    }

    public function test_get_users_module_library(): void
    {
        $userId = $this->generateDataObjectId();

        $this->fakeScanifly("/module-library/$userId");

        $this->assertOk(Scanifly::getUsersModuleLibrary(
            userId: $userId
        ));
    }

    public function test_get_company_module_library(): void
    {
        $projectUserId = $this->generateDataObjectId();

        $this->fakeScanifly("/module-library/combined/$projectUserId");

        $this->assertOk(Scanifly::getCompanyModuleLibrary(
            projectUserId: $projectUserId
        ));
    }

    public function test_get_project_by_id(): void
    {
        $projectId = $this->generateDataObjectId();

        $this->fakeScanifly("/projects/$projectId");

        $this->assertOk(Scanifly::getProjectById(
            projectId: $projectId
        ));
    }

    public function test_get_projects(): void
    {
        $this->fakeScanifly('/projects');

        $this->assertOk(Scanifly::getProjects());
    }

    public function test_get_service_request(): void
    {
        $projectId = $this->generateDataObjectId();

        $this->fakeScanifly("/serviceRequests/project/$projectId");

        $this->assertOk(Scanifly::getServiceRequest(
            projectId: $projectId
        ));
    }

    public function test_get_available_user_positions(): void
    {
        $this->fakeScanifly('/users/positions');

        $this->assertOk(Scanifly::getAvailableUserPositions());
    }

    protected function fakeScanifly(string $path, ?array $query = null): void
    {
        $url = (string) (new Uri())->withScheme(
            scheme: 'https'
        )->withHost(
            host: config('scanifly.fqdn')
        )->withPath(
            path: config('scanifly.endpoint').Str::start($path, '/')
        )->withQuery(
            query: http_build_query(array_merge(
                ['access_token' => config('scanifly.token')],
                $query ?? []
            ))
        );

        Http::fake([
            $url => Http::response(),
        ]);
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
