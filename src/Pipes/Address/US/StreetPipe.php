<?php

declare(strict_types=1);

namespace Scanifly\Pipes\Address\US;

use Closure;
use Illuminate\Support\Str;
use Scanifly\Data\Address\US\AddressData;

class StreetPipe
{
    public function handle(AddressData $data, Closure $next): AddressData
    {
        $value = Str::of($data->street)->squish();

        $data->street = $value->isNotEmpty()
            ? $value->toString()
            : null;

        return $next($data);
    }
}
