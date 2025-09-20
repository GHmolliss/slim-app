<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\ValueObjects;

use App\Domain\ValueObjects\DirPath;
use App\Domain\DomainException\DomainException;
use App\Helpers\PathHelper;
use Codeception\Test\Unit;
use Tests\Support\UnitTester;

class DirPathTest extends Unit
{
    protected UnitTester $tester;

    public function testValidDirPath(): void
    {
        $value = PathHelper::getTestsSupportDataPath();

        $dirPath = new DirPath($value, "dir");

        $this->tester->assertSame($value, $dirPath->get());
    }

    /**
     * @dataProvider invalidDirPathProvider
     */
    public function testInvalidDirPath($value): void
    {
        $this->expectException(DomainException::class);

        new DirPath($value, "dir");
    }

    public function invalidDirPathProvider(): array
    {
        return [
            [''],
            ['/not/existing/path'],
            ['string'],
            [null],
            ['/etc/passwd'],
        ];
    }
}
