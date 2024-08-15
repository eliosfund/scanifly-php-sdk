<?php

declare(strict_types=1);

namespace Scanifly\Data\Address\US;

use Scanifly\Enums\Address\US\State;
use Scanifly\Pipelines\Address\US\AddressPipeline;
use Stringable;

final class AddressData implements Stringable
{
    public string $location = '';

    public function __construct(
        public ?string $street = null,
        public ?string $city = null,
        public State|string|null $state = null,
        public ?string $zipCode = null
    ) {}

    public function pipe(): self
    {
        $pipeline = new AddressPipeline();

        return $pipeline($this);
    }

    public function toString(): string
    {
        return $this->__toString();
    }

    public function __toString(): string
    {
        return $this->pipe()->location;
    }
}
