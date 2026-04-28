<?php

declare(strict_types=1);

namespace App\Validators;

use DateTime;

/**
 * Validador de reglas de negocio para Turnos
 */
class TurnoValidator
{
    public static function validarTurno(array $data): array
    {
        $errores = [];

        if (empty($data['clienteNombre']) || strlen($data['clienteNombre']) < 3) {
            $errores[] = "El nombre debe tener al menos 3 caracteres.";
        }

        $largoTel = strlen($data['clienteTelefono']);
        if ($largoTel < 8 || $largoTel > 10) {
            $errores[] = "El telefono debe tener entre 8 y 10 digitos.";
        }

        if (empty($data['fecha']) || empty($data['hora'])) {
            $errores[] = "Fecha y hora son obligatorios.";
        } else {
            $ahora = new DateTime();
            $fechaTurno = new DateTime($data['fecha'] . ' ' . $data['hora']);
            if ($fechaTurno < $ahora) {
                $errores[] = "No se puede sacar un turno para una fecha o horario que ya paso.";
            }
        }

        if ($data['barberoId'] <= 0) {
            $errores[] = "Debe seleccionar un barbero valido.";
        }

        return $errores;
    }
}
