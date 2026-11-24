CREATE DATABASE empresa_db;
USE empresa_db;

CREATE TABLE usuarios (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(100) NOT NULL,
    rol VARCHAR(50) NOT NULL
);


CREATE TABLE departamentos (
    id_depto INT AUTO_INCREMENT PRIMARY KEY,
    nombre_depto VARCHAR(100) NOT NULL,
    ubicacion VARCHAR(100) NOT NULL
);

CREATE TABLE trabajadores (
    id_trabajador INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    puesto VARCHAR(100) NOT NULL,
    salario DECIMAL(10,2) NOT NULL,
    id_depto INT NOT NULL,
    FOREIGN KEY (id_depto) REFERENCES departamentos(id_depto)
);

-- Cuentas de prueba para probar la redirección por rol
INSERT INTO usuarios (nombre, email, password, rol) VALUES 
('Administrador General', 'admin@empresa.com', '1234', 'Admin'),
('Laura Supervisor', 'laura@empresa.com', 'abcd', 'Supervisor'),
('Carlos Trabajador', 'carlos@empresa.com', '1111', 'Trabajador');

-- Departamentos iniciales
INSERT INTO departamentos (nombre_depto, ubicacion) VALUES 
('Sistemas', 'Piso 2'),
('Recursos Humanos', 'Planta Baja'),
('Ventas', 'Piso 1'),
('Contabilidad', 'Piso 2');

-- Trabajadores iniciales
INSERT INTO trabajadores (nombre, apellido, puesto, salario, id_depto) VALUES 
('Carlos', 'Mendoza', 'Trabajador', 18500.00, 1),
('Laura', 'Gómez', 'Supervisor', 24000.00, 3);