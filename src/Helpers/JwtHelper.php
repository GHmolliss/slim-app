<?php

declare(strict_types=1);

namespace App\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use InvalidArgumentException;

class JwtHelper
{
    private static $secret = EnvHelper::getJwtSecret();
    private static $algo = 'HS256';

    public static function generateToken(array $payload, int $exp = 3600): string
    {
        $payload['exp'] = time() + $exp;

        return JWT::encode($payload, self::$secret, self::$algo);
    }

    public static function getBearerToken(string $authHeader): string
    {
        if (!preg_match('/Bearer\s+(\S+)/', $authHeader, $matches)) {
            throw new InvalidArgumentException('Invalid Authorization header format.');
        }

        $token = $matches[1] ?? null;

        if ($token === null) {
            throw new InvalidArgumentException('Invalid Authorization header format.');
        }

        if (empty($token)) {
            throw new InvalidArgumentException('Token is empty.');
        }

        return $token;
    }

    public static function getPayloadByToken(string $token): array
    {
        $decoded = JWT::decode($token, new Key(self::$secret, self::$algo));

        return (array) $decoded;
    }
}
