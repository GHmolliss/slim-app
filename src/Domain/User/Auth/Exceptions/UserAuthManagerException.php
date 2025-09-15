<?php

declare(strict_types=1);

namespace App\Domain\User\Auth\Exceptions;

use App\Domain\DomainException\DomainException;
use App\Domain\DomainException\DomainExceptionMapper;
use App\Helpers\PathHelper;
use DateTime;
use Fig\Http\Message\StatusCodeInterface;

final class UserAuthManagerException extends DomainException
{
    public const EMAIL_NOT_ACTIVE = 1;
    public const EMAIL_DUPLICATE = 2;
    public const LOGIN_ERROR = 3;
    public const PASSWORD_FORGOT_EMAIL_NOT_FOUND = 4;
    public const PASSWORD_FORGOT_NOT_ACTIVE = 5;
    public const AUTH_USER_NOT_FOUND = 6;
    public const PASSWORD_RESET_DUPLICATE = 7;

    protected const ID = DomainExceptionMapper::UserAuthManager;

    public static function emailNotActive(DateTime $activeEmail): self
    {
        return new self(
            'Вам необходимо подтвердить электронную почту до ' . $activeEmail->format('d.m.Y H:i') . '. Проверьте свой электронный почтовый ящик.',
            self::EMAIL_NOT_ACTIVE,
            StatusCodeInterface::STATUS_BAD_REQUEST,
        );
    }

    // public static function emailDuplicate(): self
    // {
    //     return new self(
    //         'Пользователь уже был создан ранее. Для входа перейдите на страницу <a href="' . PathHelper::getPublicDirectory() . 'login">авторизации</a>',
    //         self::EMAIL_DUPLICATE,
    //         StatusCodeInterface::STATUS_BAD_REQUEST,
    //     );
    // }

    public static function loginError(): self
    {
        // TODO: Возможно заменить на authUserNotFound
        return new self(
            'Пользователь не найден.',
            self::LOGIN_ERROR,
            StatusCodeInterface::STATUS_BAD_REQUEST,
        );
    }

    // public static function passwordForgotEmailNotFound(): self
    // {
    //     // TODO: Возможно заменить на authUserNotFound
    //     return new self(
    //         'Пользователь не найден.',
    //         self::PASSWORD_FORGOT_EMAIL_NOT_FOUND,
    //         StatusCodeInterface::STATUS_BAD_REQUEST,
    //     );
    // }

    // public static function passwordForgotNotActive(DateTime $activePassword): self
    // {
    //     return new self(
    //         'На электронную почту Вам уже было отправлено письмо. Ссылка в письме для смены пароля действительна до ' . $activePassword->format('d.m.Y H:i') . '. Проверьте свой электронный почтовый ящик.',
    //         self::PASSWORD_FORGOT_NOT_ACTIVE,
    //         StatusCodeInterface::STATUS_BAD_REQUEST,
    //     );
    // }

    // public static function authUserNotFound(): self
    // {
    //     return new self(
    //         'Пользователь не найден.',
    //         self::AUTH_USER_NOT_FOUND,
    //         StatusCodeInterface::STATUS_BAD_REQUEST,
    //     );
    // }

    // public static function passwordResetDuplicate(): self
    // {
    //     return new self(
    //         'Новый пароль не может совпадать со старым.',
    //         self::PASSWORD_RESET_DUPLICATE,
    //         StatusCodeInterface::STATUS_BAD_REQUEST,
    //     );
    // }
}
