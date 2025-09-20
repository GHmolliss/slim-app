<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\ValueObjects;

use App\Domain\ValueObjects\UserPassword;
use App\Domain\DomainException\DomainException;
use Codeception\Test\Unit;
use Tests\Support\UnitTester;

class UserPasswordTest extends Unit
{
    protected UnitTester $tester;

    public function testValidPassword(): void
    {
        $value = "StrongPass123!";

        $password = new UserPassword($value);

        $this->tester->assertSame($value, $password->get());
    }

    /**
     * @dataProvider invalidPasswordProvider
     */
    public function testInvalidPassword($value): void
    {
        $this->expectException(DomainException::class);

        new UserPassword($value);
    }

    public function invalidPasswordProvider(): array
    {
        return [
            [''],
            [null],
            ['short'],
            ['123'],
        ];
    }
}
