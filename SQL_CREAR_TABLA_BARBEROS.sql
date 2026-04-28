-- ============================================
-- TABLA: BARBEROS
-- ============================================
-- Ejecuta este SQL en phpMyAdmin para crear la tabla de barberos

CREATE TABLE IF NOT EXISTS barberos (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telefono VARCHAR(15) NOT NULL,
    especialidad VARCHAR(100) NOT NULL,
    experiencia INT DEFAULT 0,
    estado BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Índices para mejorar búsquedas
CREATE INDEX idx_email ON barberos(email);
CREATE INDEX idx_estado ON barberos(estado);

-- Mensaje de éxito
-- ¡Tabla creada exitosamente!
