-- ============================================
-- OPCIÓN 1: SQL SIMPLE (Si te da error, usa esto)
-- ============================================

DROP TABLE IF EXISTS barberos;

CREATE TABLE barberos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    telefono VARCHAR(15) NOT NULL,
    especialidad VARCHAR(100) NOT NULL,
    experiencia INT,
    estado INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_email (email)
);

-- ============================================
-- VERIFICAR QUE LA TABLA SE CREÓ
-- ============================================

-- Corre esto después para verificar:
-- SELECT * FROM barberos;
-- DESCRIBE barberos;

-- ============================================
-- SI NECESITAS BORRAR Y EMPEZAR DE NUEVO
-- ============================================

-- DROP TABLE barberos;
