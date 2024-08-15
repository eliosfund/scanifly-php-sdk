<?php

declare(strict_types=1);

namespace Scanifly\Tests\Pipes\Address\US;

use Scanifly\Data\Address\US\AddressData;
use Scanifly\Pipes\Address\US\StreetPipe;
use Scanifly\Tests\TestCase;

class StreetPipeTest extends TestCase
{
    /**
     * @return array<int, array<int, string>>
     */
    public static function pipeData(): array
    {
        return [
            [null, null],
            ['', null],
            [' ', null],
            ['123', '123'],
            ['123 Main St', '123 Main St'],
            [' 123  Main  St ', '123 Main St'],
            ['123 Main St', '123 Main St'],
            [' 123  Main  St ', '123 Main St'],
        ];
    }

    /**
     * @dataProvider pipeData
     */
    public function test_pipe(?string $value, ?string $expected): void
    {
        $data = new AddressData(street: $value);

        $address = (new StreetPipe())
            ->handle($data, static fn (AddressData $data): AddressData => $data);

        $this->assertSame($expected, $address->street);
    }
}
