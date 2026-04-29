<?php

declare(strict_types=1);

// 1. CARGA DE DEPENDENCIAS Y CONFIGURACIÓN
require_once __DIR__ . '/../vendor/autoload.php';      // Autoload de Composer (Eloquent)
require_once __DIR__ . '/../config/autoload.php';      // Autoload de clases App\*
require_once __DIR__ . '/../config/database.php';      // Conexión a la DB
require_once __DIR__ . '/../models/Turno.php';         // Modelo de la tabla turnos
require_once __DIR__ . '/../models/Barbero.php';       // Modelo de la tabla barberos

// Importar controladores
use App\Controllers\TurnoController;
use App\Controllers\BarberoController;


// --- ROUTER ---

$method = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];
$proyecto_path = '/Barber_Manager';

// Limpiar la ruta
$path = str_replace($proyecto_path, '', $requestUri);
$path = parse_url($path, PHP_URL_PATH);

// Limpiar /public/ de la ruta si está ahí
$path = str_replace('/public/', '/', $path);

// Normalizar la ruta (eliminar barras múltiples)
$path = '/' . trim($path, '/');
if ($path !== '/') {
    $path = rtrim($path, '/');
}

// ============================================
// RUTAS DE BIENVENIDA
// ============================================

// RUTA: Página de inicio (GET /)
if ($method === 'GET' && ($path === '/' || $path === '')) {
    BarberoController::bienvenida();
    exit;
}

// ============================================
// RUTAS DE TURNOS
// ============================================

// RUTA: Formulario de nuevo turno (GET /turnos/nuevo)
if ($method === 'GET' && $path === '/turnos/nuevo') {
    TurnoController::nuevo();
    exit;
}

// RUTA: Crear turno (POST /turnos)
if ($method === 'POST' && $path === '/turnos') {
    TurnoController::crear();
    exit;
}

// RUTA: Listar turnos (GET /turnos)
if ($method === 'GET' && $path === '/turnos') {
    TurnoController::listar();
    exit;
}

// ============================================
// RUTAS DE BARBEROS
// ============================================

// RUTA: Formulario de registro (GET /barberos/registro)
if ($method === 'GET' && $path === '/barberos/registro') {
    BarberoController::formularioRegistro();
    exit;
}

// RUTA: Registrar barbero (POST /barberos)
if ($method === 'POST' && $path === '/barberos') {
    BarberoController::registrar();
    exit;
}

// RUTA: Listar barberos (GET /barberos)
if ($method === 'GET' && $path === '/barberos') {
    BarberoController::listar();
    exit;
}

// 404
http_response_code(404);
echo json_encode(["error" => "Ruta no encontrada"]);
