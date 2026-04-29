<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Helpers\Sanitizer;
use App\Validators\TurnoValidator;
use Turno;

/**
 * Controlador de Turnos
 * Maneja todas las operaciones relacionadas con turnos
 */
class TurnoController
{
    /**
     * Mostrar formulario de nuevo turno (GET /turnos/nuevo)
     */
    public static function nuevo()
    {
        include __DIR__ . '/../../views/nuevo_turno.php';
    }

    /**
     * Procesar creación de nuevo turno (POST /turnos)
     */
    public static function crear()
    {
        header('Content-Type: application/json');

        $datosLimpios = Sanitizer::turno($_POST);
        $errores = TurnoValidator::validarTurno($datosLimpios);

        if (empty($errores)) {
            try {
                // GUARDAR EN BASE DE DATOS
                $nuevoTurno = Turno::create($datosLimpios);

                http_response_code(201);
                echo json_encode([
                    "ok" => true,
                    "message" => "Turno guardado con exito",
                    "id" => $nuevoTurno->id,
                    "item" => $datosLimpios
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
     * Listar todos los turnos (GET /turnos)
     */
    public static function listar()
    {
        header('Content-Type: application/json');
        $turnos = Turno::with('barbero')->orderBy('fecha', 'desc')->get();
        
        // Transformar los datos para incluir el nombre del barbero
        $turnosConBarbero = $turnos->map(function($turno) {
            return [
                'id' => $turno->id,
                'clienteNombre' => $turno->clienteNombre,
                'clienteTelefono' => $turno->clienteTelefono,
                'barberoId' => $turno->barberoId,
                'nombreBarbero' => $turno->barbero ? $turno->barbero->nombre : 'Barbero no asignado',
                'fecha' => $turno->fecha,
                'hora' => $turno->hora,
                'servicio' => $turno->servicio
            ];
        });
        
        echo json_encode($turnosConBarbero, JSON_UNESCAPED_UNICODE);
    }
}
