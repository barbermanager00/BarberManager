-- ============================================
-- TABLA: BARBEROS
-- ============================================
-- Ejecuta este SQL en phpMyAdmin para crear la tabla de barberos
-- Si te da error, ejecuta cada sección por separado

-- 1. CREAR LA TABLA
CREATE TABLE IF NOT EXISTS barberos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telefono VARCHAR(15) NOT NULL,
    especialidad VARCHAR(100) NOT NULL,
    experiencia INT DEFAULT 0,
    estado TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. CREAR ÍNDICE (opcional, pero recomendado)
ALTER TABLE barberos ADD INDEX idx_estado (estado);

-- Mensaje de éxito
-- ¡Tabla creada exitosamente!
