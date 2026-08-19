-- ============================================
-- Base de datos: db_inventario_mini
-- ============================================

DROP DATABASE IF EXISTS db_inventario_mini;

CREATE DATABASE db_inventario_mini
CHARACTER SET utf8 COLLATE utf8_spanish_ci;

USE db_inventario_mini;

-- ============================================
-- Tabla: inventario
-- ============================================
CREATE TABLE inventario (
    codigo INT AUTO_INCREMENT PRIMARY KEY,
    nom_producto VARCHAR(150) NOT NULL,
    costo DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    porc_venta DECIMAL(5,2) NOT NULL DEFAULT 0.00,
    precio_venta DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    Imagen VARCHAR(255) DEFAULT '',
    stock INT NOT NULL DEFAULT 0,
    Fecha DATE DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ============================================
-- Datos de ejemplo
-- ============================================
INSERT INTO inventario (nom_producto, costo, porc_venta, precio_venta, Imagen, stock, Fecha) VALUES
('Cuaderno universitario', 15.00, 40, 21.00, '', 50, CURDATE()),
('Lapicero azul', 2.50, 60, 4.00, '', 200, CURDATE()),
('Resma de papel bond', 45.00, 30, 58.50, '', 30, CURDATE());
