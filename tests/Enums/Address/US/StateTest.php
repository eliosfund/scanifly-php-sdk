<?php

declare(strict_types=1);

namespace Scanifly\Tests\Enums\Address\US;

use Illuminate\Support\ItemNotFoundException;
use Scanifly\Enums\Address\US\State;
use Scanifly\Tests\TestCase;

class StateTest extends TestCase
{
    public function test_it_can_return_a_collection(): void
    {
        $this->assertCount(50, State::collect());
    }

    public function test_it_can_get_the_enum_from_a_state_code(): void
    {
        $this->assertSame(State::AK, State::fromCode('AK'));
    }

    public function test_it_can_get_the_enum_from_a_lower_case_state_code(): void
    {
        $this->assertSame(State::AK, State::fromCode('ak'));
    }

    public function test_it_can_throw_an_exception_from_an_invalid_state_code(): void
    {
        $this->expectException(ItemNotFoundException::class);

        State::fromCode('XX');
    }

    public function test_it_can_get_the_enum_from_a_state_name(): void
    {
        $this->assertSame(State::AK, State::fromName('Alaska'));
    }

    public function test_it_can_get_the_enum_from_a_lower_case_state_name(): void
    {
        $this->assertSame(State::AK, State::fromName('alaska'));
    }

    public function test_it_can_get_the_enum_from_a_lower_case_state_name_with_spaces(): void
    {
        $this->assertSame(State::NY, State::fromName('new york'));
    }

    public function test_it_can_throw_an_exception_from_an_invalid_state_name(): void
    {
        $this->expectException(ItemNotFoundException::class);

        State::fromName('Invalid');
    }

    public function test_it_can_resolve_the_enum(): void
    {
        $this->assertSame(State::AK, State::resolve('AK'));
        $this->assertSame(State::AK, State::resolve('Alaska'));
        $this->assertSame(State::AK, State::resolve(State::AK));
    }

    public function test_it_can_throw_an_exception_when_resolving_an_invalid_state_code(): void
    {
        $this->expectException(ItemNotFoundException::class);

        State::resolve('XX');
    }

    public function test_it_can_throw_an_exception_when_resolving_an_invalid_state_name(): void
    {
        $this->expectException(ItemNotFoundException::class);

        State::resolve('Invalid');
    }

    public function test_it_can_get_the_code_from_the_enum(): void
    {
        $this->assertSame('AK', State::AK->toCode());
    }

    public function test_it_can_get_the_name_from_the_enum(): void
    {
        $this->assertSame('Alaska', State::AK->toName());
    }
}
