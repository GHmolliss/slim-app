<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\ValueObjects;

use App\Domain\ValueObjects\UrlPath;
use App\Domain\DomainException\DomainException;
use Codeception\Test\Unit;
use Tests\Support\UnitTester;

class UrlPathTest extends Unit
{
    protected UnitTester $tester;

    public function testValidUrl(): void
    {
        $value = "https://example.com";

        $obj = new UrlPath($value, "url");

        $this->tester->assertSame($value, $obj->get());
    }

    /**
     * @dataProvider invalidUrlProvider
     */
    public function testInvalidUrl($value): void
    {
        $this->expectException(DomainException::class);

        new UrlPath($value, "url");
    }

    public function invalidUrlProvider(): array
    {
        return [
            [''],
            ['not-a-url'],
            ['ftp://invalid-url'],
            [null],
            ['plainstring'],
        ];
    }
}
