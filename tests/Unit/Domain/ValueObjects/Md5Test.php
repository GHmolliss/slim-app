<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\ValueObjects;

use App\Domain\ValueObjects\Md5;
use App\Domain\DomainException\DomainException;
use Codeception\Test\Unit;
use Tests\Support\UnitTester;

class Md5Test extends Unit
{
    protected UnitTester $tester;

    public function testValidMd5(): void
    {
        $value = md5("test");

        $md5 = new Md5($value, "md5");

        $this->tester->assertSame($value, $md5->get());
    }

    /**
     * @dataProvider invalidMd5Provider
     */
    public function testInvalidMd5($value): void
    {
        $this->expectException(DomainException::class);

        new Md5($value, "md5");
    }

    public function invalidMd5Provider(): array
    {
        return [
            [''],
            ['not-md5-hash'],
            ['123'],
            [null],
            ['zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz'],
        ];
    }
}
