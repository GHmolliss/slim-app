<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\ValueObjects;

use App\Domain\ValueObjects\FilePath;
use App\Domain\DomainException\DomainException;
use App\Helpers\PathHelper;
use Codeception\Test\Unit;
use Tests\Support\UnitTester;

class FilePathTest extends Unit
{
    protected UnitTester $tester;

    public function testValidFilePath(): void
    {
        $value = PathHelper::getTestsSupportDataPath() . '/test.txt';

        $filePath = new FilePath($value, "filePath");

        $this->tester->assertSame($value, $filePath->get());
    }

    /**
     * @dataProvider invalidFilePathProvider
     */
    public function testInvalidFilePath($value): void
    {
        $this->expectException(DomainException::class);

        new FilePath($value, "filePath");
    }

    public function invalidFilePathProvider(): array
    {
        return [
            [''],
            ['/not/existing/file.txt'],
            ['string'],
            [null],
            ['/tmp'],
        ];
    }
}
