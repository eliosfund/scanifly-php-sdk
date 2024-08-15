<?php

declare(strict_types=1);

namespace Scanifly\Tests\Pipelines\Address\US;

use Scanifly\Data\Address\US\AddressData;
use Scanifly\Pipelines\Address\US\AddressPipeline;
use Scanifly\Tests\TestCase;

class AddressPipelineTest extends TestCase
{
    public function test_it_can_be_invoked(): void
    {
        $this->expectNotToPerformAssertions();

        $pipeline = new AddressPipeline();

        $pipeline(new AddressData());
    }
}
