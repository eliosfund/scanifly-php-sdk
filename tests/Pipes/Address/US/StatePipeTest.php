<?php

declare(strict_types=1);

namespace Scanifly\Tests\Pipes\Address\US;

use Scanifly\Data\Address\US\AddressData;
use Scanifly\Enums\Address\US\State;
use Scanifly\Pipes\Address\US\StatePipe;
use Scanifly\Tests\TestCase;

class StatePipeTest extends TestCase
{
    /**
     * @return array<int, array<int, State|string>>
     */
    public static function pipeData(): array
    {
        return [
            [null, null],
            ['', null],
            [' ', null],
            ['invalid', null],
            [State::NY, 'New York'],
            ['ny', 'New York'],
            ['NY', 'New York'],
            ['new york', 'New York'],
            ['New York', 'New York'],
            [' New  York ', 'New York'],
        ];
    }

    /**
     * @dataProvider pipeData
     */
    public function test_pipe(State|string|null $value, ?string $expected): void
    {
        $data = new AddressData(state: $value);

        $address = (new StatePipe())
            ->handle($data, static fn (AddressData $data): AddressData => $data);

        $this->assertSame($expected, $address->state);
    }
}
