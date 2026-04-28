<?php

declare(strict_types=1);

// 1. CARGA DE DEPENDENCIAS Y CONFIGURACIÓN
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload de Composer (Eloquent)
require_once __DIR__ . '/../config/database.php'; // Conexión a la DB
require_once __DIR__ . '/../models/Turno.php';    // Modelo de la tabla turnos

/**
 * 2. SANITIZACIÓN: Limpia los datos de entrada
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

/**
 * 3. VALIDACIÓN: Reglas de negocio
 */
function validarTurno(array $data): array
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

// --- ROUTER ---

$method = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];
$proyecto_path = '/Barber_Manager';
$path = str_replace($proyecto_path, '', $requestUri);
$path = parse_url($path, PHP_URL_PATH);

// RUTA: Formulario de alta (GET)
if ($method === 'GET' && $path === '/turnos/nuevo') {
    include __DIR__ . '/../views/nuevo_turno.php';
    exit;
}

// RUTA: Procesar alta (POST)
if ($method === 'POST' && $path === '/turnos') {
    header('Content-Type: application/json');

    $datosLimpios = Sanitizer::turno($_POST);
    $errores = validarTurno($datosLimpios);

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
    exit;
}

// RUTA: Listar turnos (GET) - PASO 7 DEL CHECKLIST
if ($method === 'GET' && $path === '/turnos') {
    header('Content-Type: application/json');
    $turnos = Turno::all(); // Trae todos los turnos de la DB
    echo json_encode($turnos, JSON_UNESCAPED_UNICODE);
    exit;
}

// 404
http_response_code(404);
echo json_encode(["error" => "Ruta no encontrada"]);
