<?php

declare(strict_types=1);

/**
 * 1. SANITIZACIÓN: Limpia los datos para evitar XSS y caracteres basura
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

    public static function string(string $valor): string
    {
        return htmlspecialchars(trim($valor), ENT_QUOTES, 'UTF-8');
    }

    public static function telefono(string $valor): string
    {
        return preg_replace('/\D/', '', trim($valor));
    }

    public static function entero(mixed $valor): int
    {
        return (int) filter_var($valor, FILTER_SANITIZE_NUMBER_INT);
    }
}

/**
 * 2. VALIDACIÓN: Verifica que los datos cumplan las reglas de negocio
 */
function validarTurno(array $data): array
{
    $errores = [];

    // Validamos nombre
    if (empty($data['clienteNombre']) || strlen($data['clienteNombre']) < 3) {
        $errores[] = "El nombre del cliente es obligatorio y debe tener al menos 3 caracteres.";
    }

    // Validamos teléfono (mínimo 8 y máximo 10 dígitos)
    $largoTelefono = strlen($data['clienteTelefono']);
    if (empty($data['clienteTelefono'])) {
        $errores[] = "El telefono es obligatorio.";
    } elseif ($largoTelefono < 8 || $largoTelefono > 10) {
        $errores[] = "El telefono debe tener entre 8 y 10 digitos.";
    }

    // Validamos fecha y hora (que no sean pasadas)
    if (empty($data['fecha']) || empty($data['hora'])) {
        $errores[] = "La fecha y la hora son campos obligatorios.";
    } else {
        // Creamos objetos de fecha para comparar
        $ahora = new DateTime();
        $fechaTurno = new DateTime($data['fecha'] . ' ' . $data['hora']);

        if ($fechaTurno < $ahora) {
            $errores[] = "No se puede sacar un turno para una fecha o de un horario que ya paso.";
        }
    }

    // Validamos barbero
    if ($data['barberoId'] <= 0) {
        $errores[] = "Debe seleccionar un barbero valido.";
    }

    return $errores;
}

// --- LÓGICA DEL ROUTER ---

$method = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

// Limpiamos la ruta para manejar subcarpetas (Barber_Manager)
$proyecto_path = '/Barber_Manager';
$path = str_replace($proyecto_path, '', $requestUri);
$path = parse_url($path, PHP_URL_PATH);

// RUTA 1: Health Check
if ($method === 'GET' && $path === '/health') {
    header('Content-Type: application/json');
    echo json_encode(["status" => "ok", "message" => "Servidor funcionando"]);
    exit;
}

// RUTA 2: Mostrar el Formulario (GET)
if ($method === 'GET' && $path === '/turnos/nuevo') {
    // Aquí NO enviamos JSON, enviamos el HTML de la vista
    include __DIR__ . '/../views/nuevo_turno.php';
    exit;
}

// RUTA 3: Procesar el Formulario o Petición API (POST)
if ($method === 'POST' && $path === '/turnos') {
    header('Content-Type: application/json');

    // Tomamos los datos de $_POST (del formulario)
    $datosLimpios = Sanitizer::turno($_POST);
    $errores = validarTurno($datosLimpios);

    if (empty($errores)) {
        http_response_code(201);
        echo json_encode([
            "ok" => true,
            "message" => "Turno creado con exito",
            "item" => $datosLimpios
        ]);
    } else {
        http_response_code(400);
        echo json_encode([
            "ok" => false,
            "errors" => $errores
        ]);
    }
    exit;
}

// RUTA POR DEFECTO: 404 Not Found
header('Content-Type: application/json');
http_response_code(404);
echo json_encode(["error" => "Ruta no encontrada", "path" => $path]);
