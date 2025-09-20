<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\ValueObjects;

use App\Domain\DomainException\DomainException;
use App\Domain\ValueObjects\NumberPositive;
use Codeception\Test\Unit;
use Tests\Support\UnitTester;

class NumberPositiveTest extends Unit
{
    protected UnitTester $tester;

    public function testPositiveSuccess(): void
    {
        $value = 1;

        $primaryKey = new NumberPositive($value, 'id');

        $this->tester->assertSame($value, $primaryKey->get());
    }

    /**
     * @dataProvider invalidDataProvider
     */
    public function testInvalid($value): void
    {
        $this->expectException(DomainException::class);

        new NumberPositive($value, 'id');
    }

    public function invalidDataProvider(): array
    {
        return [
            'string empty' => [''],
            'string' => ['string'],
            'string number' => ['1'],
            'null' => [null],
            'array' => [[]],
            'negative number' => [-1],
            'float' => [1.1],
            'zero' => [0],
            'bool false' => [false],
        ];
    }
}
