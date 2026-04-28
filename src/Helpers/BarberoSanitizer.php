<?php

declare(strict_types=1);

namespace App\Helpers;

/**
 * Sanitizador para datos de Barberos
 */
class BarberoSanitizer
{
    public static function registro(array $input): array
    {
        return [
            'nombre'       => self::string($input['nombre'] ?? ''),
            'email'        => self::email($input['email'] ?? ''),
            'telefono'     => self::telefono($input['telefono'] ?? ''),
            'especialidad' => self::string($input['especialidad'] ?? ''),
            'experiencia'  => self::entero($input['experiencia'] ?? 0),
            'estado'       => true, // Nuevos barberos activos por defecto
        ];
    }

    private static function string(string $valor): string
    {
        return htmlspecialchars(trim($valor), ENT_QUOTES, 'UTF-8');
    }

    private static function email(string $valor): string
    {
        return strtolower(trim($valor));
    }

    private static function telefono(string $valor): string
    {
        return preg_replace('/\D/', '', trim($valor));
    }

    private static function entero(mixed $valor): int
    {
        return (int) filter_var($valor, FILTER_SANITIZE_NUMBER_INT);
    }
}
