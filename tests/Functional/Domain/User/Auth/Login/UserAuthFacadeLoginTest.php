<?php

declare(strict_types=1);

namespace Tests\Functional\Domain\User\Auth\Login;

use App\Domain\DomainException\DomainException;
use App\Domain\User\Auth\UserAuthFacade;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\UserPassword;

class UserAuthFacadeLoginTest extends \Codeception\Test\Unit
{
    private UserAuthFacade $authFacade;

    protected function _before()
    {
        $app = createSlimApp();

        $container = $app->getContainer();

        $this->authFacade = $container->get(UserAuthFacade::class);
    }

    public function testLoginSuccess()
    {
        $email = new Email('user@example.com');
        $password = new UserPassword('8GVbh&6I7silgDXN');

        $token = $this->authFacade->login($email, $password);

        $this->assertIsString($token);
        $this->assertNotEmpty($token);
    }

    public function testLoginInvalidPassword()
    {
        $email = new Email('user@example.com');
        $password = new UserPassword('WrongPassword');

        $this->expectException(DomainException::class);

        $this->authFacade->login($email, $password);
    }

    public function testLoginInvalidEmail()
    {
        $email = new Email('notfound@example.com');
        $password = new UserPassword('Password123!');

        $this->expectException(DomainException::class);

        $this->authFacade->login($email, $password);
    }
}
