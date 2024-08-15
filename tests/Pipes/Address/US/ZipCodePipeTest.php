<?php

declare(strict_types=1);

namespace Scanifly\Tests\Pipes\Address\US;

use Scanifly\Data\Address\US\AddressData;
use Scanifly\Pipes\Address\US\ZipCodePipe;
use Scanifly\Tests\TestCase;

class ZipCodePipeTest extends TestCase
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
            ['123', null],
            ['12345', '12345'],
            [' 1 2 3 4 5 ', '12345'],
            ['12345 - 6789', '12345'],
        ];
    }

    /**
     * @dataProvider pipeData
     */
    public function test_pipe(?string $value, ?string $expected): void
    {
        $data = new AddressData(zipCode: $value);

        $address = (new ZipCodePipe())
            ->handle($data, static fn (AddressData $data): AddressData => $data);

        $this->assertSame($expected, $address->zipCode);
    }
}
