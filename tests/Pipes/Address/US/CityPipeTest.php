<?php

declare(strict_types=1);

namespace Scanifly\Tests\Pipes\Address\US;

use Scanifly\Data\Address\US\AddressData;
use Scanifly\Pipes\Address\US\CityPipe;
use Scanifly\Tests\TestCase;

class CityPipeTest extends TestCase
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
            ['New York', 'New York'],
            [' New  York ', 'New York'],
        ];
    }

    /**
     * @dataProvider pipeData
     */
    public function test_pipe(?string $value, ?string $expected): void
    {
        $data = new AddressData(city: $value);

        $address = (new CityPipe())
            ->handle($data, static fn (AddressData $data): AddressData => $data);

        $this->assertSame($expected, $address->city);
    }
}
