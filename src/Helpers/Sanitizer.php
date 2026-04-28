<?php

declare(strict_types=1);

namespace App\Helpers;

/**
 * Clase encargada de sanitizar entrada de datos
 */
class Sanitizer
{
    public static function turno(array $input): array
    {
        return [
            'clienteNombre'   => self::string($input['clienteNombre']   ?? ''),
            'clienteTelefono' => self::telefono($input['clienteTelefono'] ?? ''),
            'barberoId'       => self::entero($input['barberoId']       ?? 0),
            'fecha'           => self::string($input['fecha']           ?? ''),
            'hora'            => self::string($input['hora']            ?? ''),
            'servicio'        => self::string($input['servicio']        ?? ''),
        ];
    }

    private static function string(string $valor): string
    {
        return htmlspecialchars(trim($valor), ENT_QUOTES, 'UTF-8');
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
