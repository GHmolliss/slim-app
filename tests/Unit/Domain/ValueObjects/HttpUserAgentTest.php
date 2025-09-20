<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\ValueObjects;

use App\Domain\ValueObjects\HttpUserAgent;
use App\Domain\DomainException\DomainException;
use Codeception\Test\Unit;
use Tests\Support\UnitTester;

class HttpUserAgentTest extends Unit
{
    protected UnitTester $tester;

    public function testValidUserAgent(): void
    {
        $value = "Mozilla/5.0";

        $obj = new HttpUserAgent($value, "userAgent");

        $this->tester->assertSame($value, $obj->get());
    }

    /**
     * @dataProvider invalidUserAgentProvider
     */
    public function testInvalidUserAgent($value): void
    {
        $this->expectException(DomainException::class);

        new HttpUserAgent($value, "userAgent");
    }

    public function invalidUserAgentProvider(): array
    {
        return [
            [''],
            [null],
            [false],
            [[]],
        ];
    }
}
