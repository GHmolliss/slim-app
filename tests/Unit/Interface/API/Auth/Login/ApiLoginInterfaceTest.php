<?php

declare(strict_types=1);

namespace Tests\Unit\Interface\API\Auth\Register;

use App\Domain\User\Auth\UserAuthFacade;
use App\Exception;
use App\Interface\API\Auth\Login\ApiLoginInterface;
use App\Interface\API\Auth\Login\ApiLoginRequestDto;
use App\Interface\API\Auth\Login\ApiLoginValidator;
use Codeception\Test\Unit;
use Tests\Support\UnitTester;

class ApiLoginInterfaceTest extends Unit
{
    protected UnitTester $tester;

    private ApiLoginInterface $apiLoginInterface;

    protected function _before(): void
    {
        $apiLoginValidator = new ApiLoginValidator();
        $userAuthFacade = $this->createMock(UserAuthFacade::class);
        $userAuthFacade
            ->method('login')
            ->willReturn('token-string');

        /**
         * @var UserAuthFacade $userAuthFacade
         */
        $this->apiLoginInterface = new ApiLoginInterface(
            $apiLoginValidator,
            $userAuthFacade,
        );
    }

    public function testSuccess(): void
    {
        $requestDto = new ApiLoginRequestDto([
            ApiLoginRequestDto::EMAIL => 'test@example.com',
            ApiLoginRequestDto::PASSWORD => 'Password123!',
        ]);

        $responseDto = $this->apiLoginInterface->get($requestDto);

        $this->tester->assertSame([
            'token' => 'token-string',
        ], $responseDto->toArray());
    }

    /**
     * @dataProvider errorProvider
     */
    public function testError(
        $email,
        $password,
    ): void {
        $this->expectException(Exception::class);

        $requestDto = new ApiLoginRequestDto([
            ApiLoginRequestDto::EMAIL => $email,
            ApiLoginRequestDto::PASSWORD => $password,
        ]);

        $this->apiLoginInterface->get($requestDto);
    }

    public function errorProvider(): array
    {
        return [
            // Empty fields
            ['', ''],
            // Invalid email
            ['Doe', 'invalid-email'],
            // Invalid password
            ['Doe', 'test@example.com', 'short'],
        ];
    }
}
