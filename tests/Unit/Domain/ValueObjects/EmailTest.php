<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\ValueObjects;

use App\Domain\ValueObjects\Email;
use App\Domain\DomainException\DomainException;
use Codeception\Test\Unit;
use Tests\Support\UnitTester;

class EmailTest extends Unit
{
    protected UnitTester $tester;

    public function testValidEmail(): void
    {
        $value = "test@example.com";

        $obj = new Email($value);

        $this->tester->assertSame($value, $obj->get());
    }

    /**
     * @dataProvider invalidEmailProvider
     */
    public function testInvalidEmail($value): void
    {
        $this->expectException(DomainException::class);

        new Email($value);
    }

    public function invalidEmailProvider(): array
    {
        return [
            [''],
            ['not-an-email'],
            ['@example.com'],
            ['test@'],
            ['test@.com'],
            [null],
            ['plainaddress'],
        ];
    }
}
