<?php

declare(strict_types=1);

namespace App\Domain\User\Auth;

use App\Domain\ValueObjects\Email;
use App\Domain\ValueObjects\NumberPositive;
use App\Domain\ValueObjects\Token;
use App\Domain\ValueObjects\UserLastName;
use App\Domain\ValueObjects\UserPassword;
use App\Entity\User;

final class UserAuthFacade extends UserAuthBuilder
{
    // public function find(): ?User
    // {
    //     return $this->buildUserAuthManager()->find();
    // }

    // public function findByToken(
    //     Token $token,
    // ): ?User {
    //     return $this->buildUserAuthManager()->findByToken($token);
    // }

    public function register(
        UserLastName $lastName,
        Email $email,
        UserPassword $password,
    ): NumberPositive {
        return $this->buildUserAuthManager()->register(
            $lastName,
            $email,
            $password,
        );
    }

    public function login(
        Email $email,
        UserPassword $password,
    ): string {
        return $this->buildUserAuthManager()->login(
            $email,
            $password,
        );
    }

    // public function verifyEmail(
    //     Token $token,
    // ): void {
    //     $this->buildUserAuthManager()->verifyEmail(
    //         $token,
    //     );
    // }

    // public function passwordForgot(
    //     string $email,
    // ): void {
    //     $this->buildUserAuthManager()->passwordForgot(
    //         $email,
    //     );
    // }

    // public function passwordReset(
    //     string $password,
    //     Token $token,
    // ): void {
    //     $this->buildUserAuthManager()->passwordReset(
    //         $password,
    //         $token,
    //     );
    // }

    // public function deleteExpiredActivationEmail(): void
    // {
    //     $this->buildUserAuthManager()->deleteExpiredActivationEmail();
    // }

    // public function deleteExpiredActivationPassword(): void
    // {
    //     $this->buildUserAuthManager()->deleteExpiredActivationPassword();
    // }
}
