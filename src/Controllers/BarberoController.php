<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Helpers\BarberoSanitizer;
use App\Validators\BarberoValidator;
use Barbero;

/**
 * Controlador de Barberos
 * Maneja registro y gestión de barberos
 */
class BarberoController
{
    /**
     * Mostrar vista de bienvenida (GET /)
     */
    public static function bienvenida()
    {
        include __DIR__ . '/../../views/welcome.php';
    }

    /**
     * Mostrar formulario de registro (GET /barberos/registro)
     */
    public static function formularioRegistro()
    {
        include __DIR__ . '/../../views/registro_barbero.php';
    }

    /**
     * Procesar registro de barbero (POST /barberos)
     */
    public static function registrar()
    {
        header('Content-Type: application/json');

        $datosLimpios = BarberoSanitizer::registro($_POST);
        $errores = BarberoValidator::validarRegistro($datosLimpios);

        if (empty($errores)) {
            try {
                // Verificar que el email no esté duplicado
                $existente = Barbero::where('email', $datosLimpios['email'])->first();
                if ($existente) {
                    http_response_code(400);
                    echo json_encode([
                        "ok" => false,
                        "errors" => ["El email ya está registrado."]
                    ], JSON_UNESCAPED_UNICODE);
                    return;
                }

                // GUARDAR EN BASE DE DATOS
                $nuevoBarbero = Barbero::create($datosLimpios);

                http_response_code(201);
                echo json_encode([
                    "ok" => true,
                    "message" => "Barbero registrado exitosamente",
                    "id" => $nuevoBarbero->id,
                    "data" => $datosLimpios
                ], JSON_UNESCAPED_UNICODE);
            } catch (\Exception $e) {
                http_response_code(500);
                echo json_encode([
                    "ok" => false,
                    "error" => "Error al guardar en la base de datos: " . $e->getMessage()
                ]);
            }
        } else {
            http_response_code(400);
            echo json_encode(["ok" => false, "errors" => $errores], JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * Listar todos los barberos (GET /barberos)
     */
    public static function listar()
    {
        header('Content-Type: application/json');
        $barberos = Barbero::where('estado', true)->get();
        echo json_encode($barberos, JSON_UNESCAPED_UNICODE);
    }
}
