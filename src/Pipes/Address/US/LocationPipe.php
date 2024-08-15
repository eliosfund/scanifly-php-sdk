<?php

declare(strict_types=1);

namespace Scanifly\Pipes\Address\US;

use Closure;
use Illuminate\Support\Str;
use Scanifly\Data\Address\US\AddressData;

class LocationPipe
{
    public function handle(AddressData $data, Closure $next): AddressData
    {
        if ($data->street !== null) {
            $data->location .= "$data->street, ";
        }

        if ($data->city !== null) {
            $data->location .= "$data->city, ";
        }

        if ($data->state !== null) {
            $data->location .= $data->state;
        }

        if ($data->zipCode !== null) {
            $data->location .= " $data->zipCode";
        }

        $data->location = Str::of($data->location)
            ->squish()
            ->replace(', ,', ',')
            ->trim(', ')
            ->toString();

        return $next($data);
    }
}
