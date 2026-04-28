<?php

declare(strict_types=1);

/**
 * Autoloader simple para las clases del proyecto (App namespace)
 */
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $base_dir = __DIR__ . '/../src/';

    // Verificar si la clase usa el namespace App\
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    // Obtener la parte relativa del namespace
    $relative_class = substr($class, $len);

    // Convertir namespace a ruta de archivo
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

    // Si el archivo existe, cargarlo
    if (file_exists($file)) {
        require $file;
    }
});
