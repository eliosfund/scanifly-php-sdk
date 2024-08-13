<?php

declare(strict_types=1);

namespace Scanifly\Enums\Address\US;

use Illuminate\Support\Collection;
use Illuminate\Support\ItemNotFoundException;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

enum State: string
{
    case AL = 'Alabama';
    case AK = 'Alaska';
    case AZ = 'Arizona';
    case AR = 'Arkansas';
    case CA = 'California';
    case CO = 'Colorado';
    case CT = 'Connecticut';
    case DE = 'Delaware';
    case FL = 'Florida';
    case GA = 'Georgia';
    case HI = 'Hawaii';
    case ID = 'Idaho';
    case IL = 'Illinois';
    case IN = 'Indiana';
    case IA = 'Iowa';
    case KS = 'Kansas';
    case KY = 'Kentucky';
    case LA = 'Louisiana';
    case ME = 'Maine';
    case MD = 'Maryland';
    case MA = 'Massachusetts';
    case MI = 'Michigan';
    case MN = 'Minnesota';
    case MS = 'Mississippi';
    case MO = 'Missouri';
    case MT = 'Montana';
    case NE = 'Nebraska';
    case NV = 'Nevada';
    case NH = 'New Hampshire';
    case NJ = 'New Jersey';
    case NM = 'New Mexico';
    case NY = 'New York';
    case NC = 'North Carolina';
    case ND = 'North Dakota';
    case OH = 'Ohio';
    case OK = 'Oklahoma';
    case OR = 'Oregon';
    case PA = 'Pennsylvania';
    case RI = 'Rhode Island';
    case SC = 'South Carolina';
    case SD = 'South Dakota';
    case TN = 'Tennessee';
    case TX = 'Texas';
    case UT = 'Utah';
    case VT = 'Vermont';
    case VA = 'Virginia';
    case WA = 'Washington';
    case WV = 'West Virginia';
    case WI = 'Wisconsin';
    case WY = 'Wyoming';

    public static function collect(): Collection
    {
        return collect(self::cases());
    }

    /**
     * @throws ItemNotFoundException
     */
    public static function fromCode(string $code): self
    {
        return self::collect()->where('name', Str::upper($code))->sole();
    }

    /**
     * @throws ItemNotFoundException
     */
    public static function fromName(string $name): self
    {
        return self::collect()->where('value', Str::headline($name))->sole();
    }

    /**
     * @throws ItemNotFoundException
     */
    public static function resolve(Stringable|self|string $value): self
    {
        if ($value instanceof self) {
            return $value;
        }

        if ($value instanceof Stringable) {
            $value = $value->toString();
        }

        return Str::length($value) === 2
            ? self::fromCode($value)
            : self::fromName($value);
    }

    public function toCode(): string
    {
        return $this->name;
    }

    public function toName(): string
    {
        return $this->value;
    }
}
