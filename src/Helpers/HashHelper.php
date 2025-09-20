<?php

declare(strict_types=1);

namespace App\Helpers;

final class HashHelper
{
    private const CIPHER_METHOD = 'aes-256-cbc';

    /**
     * RENYcWxuaGl2T2ZhMExqUTJWMmh4QT09OjpFNt5SeOAdy7juXJKxDx1k
     **/
    public static function userTokenEncode(string $userId): string
    {
        $key = hash('sha256', EnvHelper::getAppSecret());

        $ivLength = openssl_cipher_iv_length(self::CIPHER_METHOD);
        $iv = openssl_random_pseudo_bytes($ivLength);

        $encryptedText = openssl_encrypt($userId, self::CIPHER_METHOD, $key, 0, $iv);
        $encryptedTextWithIv = base64_encode($encryptedText . '::' . $iv);

        return $encryptedTextWithIv;
    }

    /**
     * 1
     **/
    public static function userTokenDecode(string $token): ?string
    {
        $key = hash('sha256', EnvHelper::getAppSecret());

        list($encrypted_data, $iv) = explode('::', base64_decode($token), 2);

        $userId = openssl_decrypt($encrypted_data, self::CIPHER_METHOD, $key, 0, $iv);

        if ($userId === false) {
            return null;
        }

        return $userId;
    }
}
