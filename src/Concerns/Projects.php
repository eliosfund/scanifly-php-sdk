<?php

declare(strict_types=1);

namespace Scanifly\Concerns;

use Illuminate\Http\Client\Response;
use Scanifly\Data\Address\US\AddressData;
use Scanifly\Enums\Address\US\State;
use Scanifly\ScaniflyService;

/**
 * @phpstan-require-extends ScaniflyService
 *
 * @mixin ScaniflyService
 */
trait Projects
{
    /**
     * Get project by ID.
     */
    public function getProjectById(string $projectId): Response
    {
        return $this->get("projects/$projectId");
    }

    /**
     * Get projects.
     */
    public function getProjects(): Response
    {
        return $this->get('projects');
    }

    /**
     * Filter projects by address.
     */
    public function filterProjectsByAddress(
        ?string $street = null,
        ?string $city = null,
        State|string|null $state = null,
        ?string $zipCode = null
    ): Response {
        $address = new AddressData(
            street: $street,
            city: $city,
            state: $state,
            zipCode: $zipCode
        );

        return $this->get('projects', [
            'filterBy[address]' => $address->toString(),
        ]);
    }

    /**
     * Filter projects by city and state.
     */
    public function filterProjectsByCityAndState(string $city, State|string $state): Response
    {
        $address = new AddressData(
            city: $city,
            state: $state
        );

        return $this->get('projects', [
            'filterBy[address]' => $address->toString(),
        ]);
    }

    /**
     * Filter projects by state.
     */
    public function filterProjectsByState(State|string $state): Response
    {
        $address = new AddressData(
            state: $state
        );

        return $this->get('projects', [
            'filterBy[address]' => $address->toString(),
        ]);
    }

    /**
     * Filter projects by ZIP Code.
     */
    public function filterProjectsByZipCode(string $zipCode): Response
    {
        $address = new AddressData(
            zipCode: $zipCode
        );

        return $this->get('projects', [
            'filterBy[address]' => $address->toString(),
        ]);
    }
}
