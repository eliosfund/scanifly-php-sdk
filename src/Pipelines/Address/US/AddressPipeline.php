<?php

declare(strict_types=1);

namespace Scanifly\Pipelines\Address\US;

use Illuminate\Support\Facades\Pipeline;
use Scanifly\Data\Address\US\AddressData;
use Scanifly\Pipes\Address;

class AddressPipeline
{
    protected array $pipes = [
        Address\US\StreetPipe::class,
        Address\US\CityPipe::class,
        Address\US\StatePipe::class,
        Address\US\ZipCodePipe::class,
        Address\US\LocationPipe::class,
    ];

    public function __invoke(AddressData $data): AddressData
    {
        /** @var AddressData $data */
        $data = Pipeline::send(
            passable: $data
        )->through(
            pipes: $this->pipes
        )->thenReturn();

        return $data;
    }
}
