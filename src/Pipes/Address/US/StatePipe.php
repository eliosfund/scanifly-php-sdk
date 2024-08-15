<?php

declare(strict_types=1);

namespace Scanifly\Pipes\Address\US;

use Closure;
use Illuminate\Support\ItemNotFoundException;
use Illuminate\Support\Str;
use Scanifly\Data\Address\US\AddressData;
use Scanifly\Enums\Address\US\State;

class StatePipe
{
    public function handle(AddressData $data, Closure $next): AddressData
    {
        if ($data->state === null) {
            return $next($data);
        }

        if ($data->state instanceof State) {
            $data->state = $data->state->toName();

            return $next($data);
        }

        $value = Str::of($data->state)->squish();

        try {
            $data->state = State::resolve($value)->toName();
        } catch (ItemNotFoundException) {
            $data->state = null;
        }

        return $next($data);
    }
}
