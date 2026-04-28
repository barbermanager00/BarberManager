<?php

declare(strict_types=1);

namespace App\Validators;

/**
 * Validador de reglas de negocio para Barberos
 */
class BarberoValidator
{
    public static function validarRegistro(array $data): array
    {
        $errores = [];

        // Validar nombre
        if (empty($data['nombre']) || strlen($data['nombre']) < 3) {
            $errores[] = "El nombre debe tener al menos 3 caracteres.";
        }

        // Validar email
        if (empty($data['email'])) {
            $errores[] = "El email es obligatorio.";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errores[] = "El email no tiene un formato válido.";
        }

        // Validar teléfono
        $largoTel = strlen($data['telefono']);
        if ($largoTel < 8 || $largoTel > 15) {
            $errores[] = "El teléfono debe tener entre 8 y 15 dígitos.";
        }

        // Validar especialidad
        if (empty($data['especialidad']) || strlen($data['especialidad']) < 2) {
            $errores[] = "La especialidad es obligatoria (mínimo 2 caracteres).";
        }

        // Validar experiencia
        $experiencia = (int) $data['experiencia'];
        if ($experiencia < 0 || $experiencia > 70) {
            $errores[] = "Los años de experiencia deben estar entre 0 y 70.";
        }

        return $errores;
    }
}
