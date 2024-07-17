<?php

declare(strict_types=1);

namespace Scanifly\Facades;

use Illuminate\Http\Client\Factory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Http;
use Scanifly\ScaniflyService;

/**
 * @method static \Illuminate\Http\Client\Response getBoundary(string $boundaryId)
 * @method static \Illuminate\Http\Client\Response getBoundaryByProjectId(string $projectId)
 * @method static \Illuminate\Http\Client\Response getChecklistsByProjectId(string $projectId)
 * @method static \Illuminate\Http\Client\Response getChecklistById(string $projectId, string $checklistId)
 * @method static \Illuminate\Http\Client\Response getChecklistTemplates(string $companyId)
 * @method static \Illuminate\Http\Client\Response getChecklistTemplate(string $templateId)
 * @method static \Illuminate\Http\Client\Response getCurrentUsersCompany()
 * @method static \Illuminate\Http\Client\Response getCurrentUsersCompanyMembers()
 * @method static \Illuminate\Http\Client\Response getProjectDesigns()
 * @method static \Illuminate\Http\Client\Response getDesignsByProjectId(string $projectId)
 * @method static \Illuminate\Http\Client\Response getFolder(string $folderId)
 * @method static \Illuminate\Http\Client\Response getFoldersForCurrentCompany()
 * @method static \Illuminate\Http\Client\Response getMediaByCategoryId(string $projectId, string $categoryId)
 * @method static \Illuminate\Http\Client\Response getMediaById(string $projectId, string $categoryId, string $mediaId)
 * @method static \Illuminate\Http\Client\Response getMediaCategoriesForProject(string $projectId)
 * @method static \Illuminate\Http\Client\Response getUsersModuleLibrary(string $userId)
 * @method static \Illuminate\Http\Client\Response getCompanyModuleLibrary(string $projectUserId)
 * @method static \Illuminate\Http\Client\Response getProjectById(string $projectId)
 * @method static \Illuminate\Http\Client\Response getProjects()
 * @method static \Illuminate\Http\Client\Response getServiceRequest(string $projectId)
 * @method static \Illuminate\Http\Client\Response getAvailableUserPositions()
 * @method static string buildUrl(string $path, array|null $query = null)
 * @method static \GuzzleHttp\Psr7\Uri baseUri()
 * @method static \Illuminate\Http\Client\PendingRequest client()
 * @method static \Illuminate\Http\Client\Response get(string $path, array|null $query = null)
 *
 * @see \Scanifly\ScaniflyService
 */
class Scanifly extends Facade
{
    public static function fake(
        string $path = '*',
        ?array $query = null,
        array|null|string $body = null,
        int $status = Response::HTTP_OK
    ): Factory {
        /** @var ScaniflyService $instance */
        $instance = static::getFacadeRoot();

        $url = $instance->buildUrl($path, $query);

        return Http::fake([
            $url => Http::response($body, $status),
        ]);
    }

    protected static function getFacadeAccessor(): string
    {
        return ScaniflyService::class;
    }
}
