<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\ValueObjects;

use App\Domain\ValueObjects\UserLastName;
use App\Domain\DomainException\DomainException;
use Codeception\Test\Unit;
use Tests\Support\UnitTester;

class UserLastNameTest extends Unit
{
    protected UnitTester $tester;

    public function testValidLastName(): void
    {
        $value = "Иван";

        $lastName = new UserLastName($value);

        $this->tester->assertSame($value, $lastName->get());
    }

    /**
     * @dataProvider invalidLastNameProvider
     */
    public function testInvalidLastName($value): void
    {
        $this->expectException(DomainException::class);

        new UserLastName($value);
    }

    public function invalidLastNameProvider(): array
    {
        return [
            [''],
            [null],
            ['123'],
            ['!@#$'],
        ];
    }
}
