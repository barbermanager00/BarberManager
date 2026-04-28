<?php

declare(strict_types=1);

// 1. CARGA DE DEPENDENCIAS Y CONFIGURACIÓN
require_once __DIR__ . '/../vendor/autoload.php';      // Autoload de Composer (Eloquent)
require_once __DIR__ . '/../config/autoload.php';      // Autoload de clases App\*
require_once __DIR__ . '/../config/database.php';      // Conexión a la DB
require_once __DIR__ . '/../models/Turno.php';         // Modelo de la tabla turnos

// Importar controladores
use App\Controllers\TurnoController;


// --- ROUTER ---

$method = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];
$proyecto_path = '/Barber_Manager';
$path = str_replace($proyecto_path, '', $requestUri);
$path = parse_url($path, PHP_URL_PATH);

// RUTA: Formulario de alta (GET /turnos/nuevo)
if ($method === 'GET' && $path === '/turnos/nuevo') {
    TurnoController::nuevo();
    exit;
}

// RUTA: Procesar alta (POST /turnos)
if ($method === 'POST' && $path === '/turnos') {
    TurnoController::crear();
    exit;
}

// RUTA: Listar turnos (GET /turnos)
if ($method === 'GET' && $path === '/turnos') {
    TurnoController::listar();
    exit;
}

// 404
http_response_code(404);
echo json_encode(["error" => "Ruta no encontrada"]);
