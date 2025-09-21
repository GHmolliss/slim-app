<?php

declare(strict_types=1);

namespace Tests\Unit\Interface\API\Auth\Register;

use App\Domain\User\Auth\UserAuthFacade;
use App\Domain\ValueObjects\NumberPositive;
use App\Exception;
use App\Interface\API\Auth\Register\ApiRegisterInterface;
use App\Interface\API\Auth\Register\ApiRegisterRequestDto;
use App\Interface\API\Auth\Register\ApiRegisterValidator;
use Codeception\Test\Unit;
use Tests\Support\UnitTester;

class ApiRegisterInterfaceTest extends Unit
{
    protected UnitTester $tester;

    private ApiRegisterInterface $apiRegisterInterface;

    protected function _before(): void
    {
        $apiRegisterValidator = new ApiRegisterValidator();
        $userAuthFacade = $this->createMock(UserAuthFacade::class);
        $userAuthFacade
            ->method('register')
            ->willReturn(new NumberPositive(1, 'id'));

        /**
         * @var UserAuthFacade $userAuthFacade
         */
        $this->apiRegisterInterface = new ApiRegisterInterface(
            $apiRegisterValidator,
            $userAuthFacade,
        );
    }

    public function testSuccess(): void
    {
        $requestDto = new ApiRegisterRequestDto([
            ApiRegisterRequestDto::LAST_NAME => 'Doe',
            ApiRegisterRequestDto::EMAIL => 'test@example.com',
            ApiRegisterRequestDto::PASSWORD => 'Password123!',
        ]);

        $responseDto = $this->apiRegisterInterface->get($requestDto);

        $this->tester->assertSame([
            'id' => 1,
        ], $responseDto->toArray());
    }

    /**
     * @dataProvider errorProvider
     */
    public function testError(
        $lastName,
        $email,
        $password,
    ): void {
        $this->expectException(Exception::class);

        $requestDto = new ApiRegisterRequestDto([
            ApiRegisterRequestDto::LAST_NAME => $lastName,
            ApiRegisterRequestDto::EMAIL => $email,
            ApiRegisterRequestDto::PASSWORD => $password,
        ]);

        $this->apiRegisterInterface->get($requestDto);
    }

    public function errorProvider(): array
    {
        return [
            // Empty fields
            ['', '', ''],
            // Invalid last name
            ['123', 'test@example.com', 'Password123!'],
            // Invalid email
            ['Doe', 'invalid-email', 'Password123!'],
            // Invalid password
            ['Doe', 'test@example.com', 'short'],
        ];
    }
}
