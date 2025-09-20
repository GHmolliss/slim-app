<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\ValueObjects;

use App\Domain\ValueObjects\Token;
use App\Domain\DomainException\DomainException;
use Codeception\Test\Unit;
use Tests\Support\UnitTester;

class TokenTest extends Unit
{
    protected UnitTester $tester;

    public function testValidToken(): void
    {
        $value = 'VEVVNE1zMDlid2RwQWdIWTRPaW9EUT09Ojo2+U+kFusUaVbGrd40KLir';

        $token = new Token($value, "token");

        $this->tester->assertSame($value, $token->get());
    }

    /**
     * @dataProvider invalidTokenProvider
     */
    public function testInvalidToken($value): void
    {
        $this->expectException(DomainException::class);

        new Token($value, "token");
    }

    public function invalidTokenProvider(): array
    {
        return [
            [''],
            ['short'],
            [null],
            ['123'],
        ];
    }
}
