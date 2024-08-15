<?php

declare(strict_types=1);

namespace Scanifly\Tests\Data\Address\US;

use Scanifly\Data\Address\US\AddressData;
use Scanifly\Tests\TestCase;

class AddressDataTest extends TestCase
{
    public function test_it_can_pipe(): void
    {
        $address = (new AddressData())->pipe();

        $this->assertNull($address->street);
        $this->assertNull($address->city);
        $this->assertNull($address->state);
        $this->assertNull($address->zipCode);
        $this->assertSame('', $address->location);
    }

    public function test_it_can_get_the_string_representation(): void
    {
        $address = new AddressData();

        $this->assertSame('', (string) $address);
        $this->assertSame('', $address->toString());
        $this->assertSame('', $address->__toString());
    }
}
