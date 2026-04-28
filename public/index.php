<?php

/**
 * 1. SANITIZACIÓN: Limpia los datos de entrada
 */
class Sanitizer
{
    public static function turno(array $input): array
    {
        return [
            // Sanitiza strings, números y limpia caracteres peligrosos
            'clienteNombre'   => self::string($input['clienteNombre']   ?? ''),
            'clienteTelefono' => self::telefono($input['clienteTelefono'] ?? ''),
            'barberoId'       => self::entero($input['barberoId']       ?? 0),
            'fecha'           => self::string($input['fecha']           ?? ''),
            'hora'            => self::string($input['hora']           ?? ''),
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
 * 2. VALIDACIÓN: Verifica que los datos limpios cumplan las reglas
 */
function validarTurno($data)
{
    $errores = [];

    // Validamos nombre [cite: 18, 19]
    if (empty($data['clienteNombre'])) {
        $errores[] = "Campo obligatorio: clienteNombre";
    } elseif (strlen($data['clienteNombre']) < 3) {
        $errores[] = "El nombre es muy corto";
    }

    // Validamos teléfono [cite: 20, 22]
    if (empty($data['clienteTelefono'])) {
        $errores[] = "Campo obligatorio: clienteTelefono";
    } elseif (strlen($data['clienteTelefono']) < 8) {
        $errores[] = "El teléfono debe tener al menos 8 dígitos";
    }

    // Validamos fecha y barbero [cite: 23, 28]
    if (empty($data['fecha'])) {
        $errores[] = "Campo obligatorio: fecha";
    }
    if ($data['barberoId'] <= 0) {
        $errores[] = "Seleccione un barbero válido";
    }

    return $errores;
}

// --- LÓGICA DE CONTROL ---

header('Content-Type: application/json');

// Detectamos la ruta para que no interfiera con otros ejercicios
$proyecto_path = '/Barber_Manager';
$ruta_limpia = str_replace($proyecto_path, '', $_SERVER['REQUEST_URI']);

if ($ruta_limpia === '/health') {
    echo json_encode(["status" => "ok"]);
    exit;
}

// Si la ruta es para guardar un turno (ej: /guardar)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datosLimpios = Sanitizer::turno($_POST);
    $errores = validarTurno($datosLimpios);

    if (empty($errores)) {
        http_response_code(201);
        echo json_encode(["ok" => true, "item" => $datosLimpios]);
    } else {
        http_response_code(400);
        echo json_encode(["ok" => false, "errors" => $errores]);
    }
} else {
    // Si entras por GET (navegador normal) a la raíz
    echo json_encode([
        "mensaje" => "Servidor activo. Para validar, envía un POST.",
        "tu_ruta_actual" => $ruta_limpia
    ]);
}
