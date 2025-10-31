-- init.sql - crea la base de datos y tabla users con 3 registros
CREATE DATABASE IF NOT EXISTS appdb CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE appdb;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE
);

INSERT INTO users (nombre, email) VALUES
('Carlos Perez', 'carlos.perez@example.com'),
('María Gómez', 'maria.gomez@example.com'),
('Luis Martínez', 'luis.martinez@example.com')
ON DUPLICATE KEY UPDATE nombre=VALUES(nombre);
