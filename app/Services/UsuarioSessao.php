<?php

namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class UsuarioSessao
{
    public function getAutenticado(): bool
    {
        $token = $_SESSION['jwt'] ?? null;
        if (!$token) {
            return false;
        }

        try {
            $decoded = JWT::decode($token, new Key(SECRET_KEY, 'HS256'));
            $now = new \DateTimeImmutable();

            return $decoded->exp >= $now->getTimestamp();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getTempoRestante(): int
    {
        $token = $_SESSION['jwt'] ?? null;
        if (!$token) {
            return 0;
        }

        try {
            $decoded = JWT::decode($token, new Key(SECRET_KEY, 'HS256'));
            return max($decoded->exp - time(), 0);
        } catch (\Exception $e) {
            return 0;
        }
    }
}