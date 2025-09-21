<?php

declare(strict_types=1);

namespace Tests\Functional\Domain\User\Auth\Login;

use App\Domain\User\Auth\UserAuthFacade;
use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\UserPassword;
use Codeception\Util\Fixtures;
use Tests\FunctionalTester;

class UserAuthFacadeLoginTest extends \Codeception\Test\Unit
{
    /** @var UserAuthFacade */
    private $authFacade;

    protected function _before()
    {
        // Получаем фасад из DI-контейнера Slim
        $app = \createSlimApp();
        $container = $app->getContainer();
        $this->authFacade = $container->get(\App\Domain\User\Auth\UserAuthFacade::class);
    }

    public function testLoginSuccess()
    {
        $email = new Email('user@example.com');
        $password = new UserPassword('8GVbh&6I7silgDXN'); // пароль должен совпадать с хешем в дампе

        $token = $this->authFacade->login($email, $password);
        $this->assertIsString($token);
        $this->assertNotEmpty($token);
    }

    public function testLoginInvalidPassword()
    {
        $email = new Email('user@example.com');
        $password = new UserPassword('WrongPassword');

        $this->expectException(\App\Domain\DomainException\DomainException::class);
        $this->authFacade->login($email, $password);
    }

    public function testLoginInvalidEmail()
    {
        $email = new Email('notfound@example.com');
        $password = new UserPassword('Password123!');

        $this->expectException(\App\Domain\DomainException\DomainException::class);
        $this->authFacade->login($email, $password);
    }
}
