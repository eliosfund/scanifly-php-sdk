<?php

declare(strict_types=1);

namespace Scanifly\Tests\Pipes\Address\US;

use Scanifly\Data\Address\US\AddressData;
use Scanifly\Pipes\Address\US\LocationPipe;
use Scanifly\Tests\TestCase;

class LocationPipeTest extends TestCase
{
    /**
     * @return array<int, array<int, string|null>>
     */
    public static function pipeData(): array
    {
        return [
            [
                '123 Main St', 'New York', 'New York', '12345',
                '123 Main St, New York, New York 12345',
            ],
            [
                '123 Main St', 'New York', 'New York', '',
                '123 Main St, New York, New York',
            ],
            [
                '123 Main St', 'New York', '', '12345',
                '123 Main St, New York, 12345',
            ],
            [
                '123 Main St', 'New York', '', '',
                '123 Main St, New York',
            ],
            [
                '123 Main St', '', 'New York', '12345',
                '123 Main St, New York 12345',
            ],
            [
                '123 Main St', '', 'New York', '',
                '123 Main St, New York',
            ],
            [
                '123 Main St', '', '', '12345', '123 Main St, 12345',
            ],
            [
                '123 Main St', '', '', '',
                '123 Main St',
            ],
            [
                '', 'New York', 'New York', '12345',
                'New York, New York 12345',
            ],
            [
                '', 'New York', 'New York', '',
                'New York, New York',
            ],
            [
                '', 'New York', '', '12345',
                'New York, 12345',
            ],
            [
                '', 'New York', '', '',
                'New York',
            ],
            [
                '', '', 'New York', '12345',
                'New York 12345',
            ],
            [
                '', '', 'New York', '',
                'New York',
            ],
            [
                '', '', '', '12345',
                '12345',
            ],
            ['', '', '', '', ''],
        ];
    }

    /**
     * @dataProvider pipeData
     */
    public function test_pipe(
        ?string $street,
        ?string $city,
        ?string $state,
        ?string $zipCode,
        string $expected
    ): void {
        $data = new AddressData(
            street: $street,
            city: $city,
            state: $state,
            zipCode: $zipCode
        );

        $address = (new LocationPipe())
            ->handle($data, static fn (AddressData $data): AddressData => $data);

        $this->assertSame($expected, $address->location);
    }
}
