<?php

declare(strict_types=1);

namespace App\Helpers;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\PasswordStrength;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;

class ConstraintsHelper
{
    public static function numberPositive(): array
    {
        return [
            new NotBlank(),
            new Type('int'),
            new Positive(),
        ];
    }

    public static function authToken(): array
    {
        return [
            new NotBlank(),
            new Type('string'),
            new Length(56),
        ];
    }

    public static function userLastName(): array
    {
        return [
            new NotBlank(),
            new Type('string'),
            new Length(min: 2, max: 20),
            new Regex("/^([a-zа-яё][a-zа-яё -]*)+$/ui"),
        ];
    }

    public static function userEmail(): array
    {
        return [
            new NotBlank(),
            new Type('string'),
            new Length(min: 5, max: 50),
            new Email(mode: 'html5-allow-no-tld'),
        ];
    }

    public static function userPassword(): array
    {
        return [
            new NotBlank(),
            new Type('string'),
            new Length(min: 5, max: 50),
            new PasswordStrength(minScore: PasswordStrength::STRENGTH_WEAK),
        ];
    }
}
