<?php

declare(strict_types=1);

namespace Scanifly\Pipes\Address\US;

use Closure;
use Illuminate\Support\Str;
use Scanifly\Data\Address\US\AddressData;

class ZipCodePipe
{
    public function handle(AddressData $data, Closure $next): AddressData
    {
        $value = Str::of($data->zipCode)
            ->replaceMatches('/\D/', '')
            ->substr(0, 5);

        if ($value->length() === 5) {
            $data->zipCode = $value->toString();
        } else {
            $data->zipCode = null;
        }

        return $next($data);
    }
}
