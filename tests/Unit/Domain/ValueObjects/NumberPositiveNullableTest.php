<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\ValueObjects;

use App\Domain\DomainException\DomainException;
use App\Domain\ValueObjects\NumberPositiveNullable;
use Codeception\Test\Unit;
use Tests\Support\UnitTester;

class NumberPositiveNullableTest extends Unit
{
    protected UnitTester $tester;

    /**
     * @dataProvider validDataProvider
     */
    public function testValid($value): void
    {
        $id = new NumberPositiveNullable($value, 'id');

        $this->tester->assertSame($value, $id->get());
    }

    /**
     * @dataProvider invalidDataProvider
     */
    public function testInvalid($value): void
    {
        $this->expectException(DomainException::class);

        new NumberPositiveNullable($value, 'id');
    }

    public function validDataProvider(): array
    {
        return [
            'null' => [null],
            'positive number' => [1],
        ];
    }

    public function invalidDataProvider(): array
    {
        return [
            'string empty' => [''],
            'string' => ['string'],
            'string number' => ['1'],
            'array' => [[]],
            'negative number' => [-1],
            'float' => [1.1],
            'zero' => [0],
            'bool false' => [false],
        ];
    }
}
