-- ============================================
-- Base de Datos: conjunto_inteligente_db
-- Proyecto: Tu Conjunto Inteligente
-- Versión: 1.0 Dinámica
-- Autor: Proyecto Educativo
-- Fecha: 2025
-- ============================================

-- Crear base de datos
CREATE DATABASE IF NOT EXISTS `conjunto_inteligente_db` 
DEFAULT CHARACTER SET utf8mb4 
COLLATE utf8mb4_general_ci;

USE `conjunto_inteligente_db`;

-- ============================================
-- TABLA: usuarios
-- Descripción: Almacena información de usuarios (residentes/administradores)
-- ============================================
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `unidad` varchar(50) DEFAULT NULL COMMENT 'Torre-Apartamento',
  `tipo_usuario` enum('residente','administrador','seguridad') DEFAULT 'residente',
  `estado` enum('activo','inactivo','pendiente') DEFAULT 'activo',
  `fecha_registro` datetime DEFAULT CURRENT_TIMESTAMP,
  `ultima_conexion` datetime DEFAULT NULL,
  `token_recuperacion` varchar(100) DEFAULT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_email` (`email`),
  KEY `idx_tipo_usuario` (`tipo_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertar usuarios de ejemplo
INSERT INTO `usuarios` (`nombre`, `apellido`, `email`, `password`, `telefono`, `unidad`, `tipo_usuario`, `estado`) VALUES
('Admin', 'Sistema', 'admin@ejemplo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3001234567', 'Administración', 'administrador', 'activo'),
('Juan', 'Pérez', 'juan.perez@ejemplo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3107654321', 'Torre A-302', 'residente', 'activo'),
('María', 'González', 'maria.gonzalez@ejemplo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3209876543', 'Torre B-105', 'residente', 'activo');
-- Contraseña para todos: admin123

-- ============================================
-- TABLA: contactos
-- Descripción: Libreta de direcciones/contactos
-- ============================================
CREATE TABLE IF NOT EXISTS `contactos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(200) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `unidad` varchar(50) DEFAULT NULL,
  `notas` text DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_actualizacion` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertar contactos de ejemplo
INSERT INTO `contactos` (`usuario_id`, `nombre_completo`, `email`, `telefono`, `direccion`, `unidad`, `tipo_contacto`, `notas`) VALUES
(1, 'Portería Principal', 'porteria@conjunto.com', '6012345678', 'Entrada Principal', 'Portería', 'otro', 'Disponible 24/7'),
(1, 'Administración', 'admin@conjunto.com', '6018765432', 'Oficina Administrativa', 'Admin', 'otro', 'Horario: Lunes a Viernes 8am-5pm'),
(2, 'Pedro Martínez', 'pedro.martinez@ejemplo.com', '3151234567', 'Torre A, Apto 405', 'Torre A-405', 'residente', 'Vecino del 4to piso');

-- ============================================
-- TABLA: pqrs
-- Descripción: Peticiones, Quejas, Reclamos y Sugerencias
-- ============================================
CREATE TABLE IF NOT EXISTS `pqrs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `tipo` enum('peticion','queja','reclamo','sugerencia') NOT NULL,
  `asunto` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `estado` enum('pendiente','en_proceso','resuelto','cerrado') DEFAULT 'pendiente',
  `prioridad` enum('baja','media','alta','urgente') DEFAULT 'media',
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_respuesta` datetime DEFAULT NULL,
  `respuesta` text DEFAULT NULL,
  `administrador_asignado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_usuario_id` (`usuario_id`),
  KEY `idx_estado` (`estado`),
  KEY `idx_prioridad` (`prioridad`),
  CONSTRAINT `fk_pqrs_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `fk_pqrs_admin` FOREIGN KEY (`administrador_asignado`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertar PQRS de ejemplo
INSERT INTO `pqrs` (`usuario_id`, `tipo`, `asunto`, `descripcion`, `estado`, `prioridad`) VALUES
(2, 'peticion', 'Solicitud de reserva salón comunal', 'Solicito reservar el salón comunal para el 20 de diciembre', 'pendiente', 'media'),
(3, 'queja', 'Ruido excesivo en la torre B', 'Durante las noches hay música muy fuerte en el apartamento 205', 'en_proceso', 'alta');

-- ============================================
-- TABLA: pagos
-- Descripción: Registro de pagos de administración
-- ============================================
CREATE TABLE IF NOT EXISTS `pagos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(11) NOT NULL,
  `periodo` varchar(20) NOT NULL COMMENT 'Mes-Año: 01-2025',
  `concepto` varchar(255) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `fecha_pago` datetime DEFAULT NULL,
  `metodo_pago` enum('efectivo','transferencia','tarjeta','pse') DEFAULT NULL,
  `referencia` varchar(100) DEFAULT NULL,
  `estado` enum('pendiente','pagado','vencido','anulado') DEFAULT 'pendiente',
  `comprobante` varchar(255) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_usuario_id` (`usuario_id`),
  KEY `idx_estado` (`estado`),
  KEY `idx_periodo` (`periodo`),
  CONSTRAINT `fk_pago_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertar pagos de ejemplo
INSERT INTO `pagos` (`usuario_id`, `periodo`, `concepto`, `monto`, `fecha_vencimiento`, `estado`) VALUES
(2, '11-2025', 'Administración Noviembre 2025', 150000.00, '2025-11-05', 'pagado'),
(3, '11-2025', 'Administración Noviembre 2025', 150000.00, '2025-11-05', 'pendiente');

-- ============================================
-- TABLA: comunicados
-- Descripción: Avisos y comunicados del conjunto
-- ============================================
CREATE TABLE IF NOT EXISTS `comunicados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `contenido` text NOT NULL,
  `tipo` enum('informativo','urgente','mantenimiento','evento') DEFAULT 'informativo',
  `dirigido_a` varchar(50) DEFAULT 'todos' COMMENT 'todos, torre-A, torre-B, etc',
  `autor_id` int(11) NOT NULL,
  `fecha_publicacion` datetime DEFAULT CURRENT_TIMESTAMP,
  `fecha_vencimiento` date DEFAULT NULL,
  `activo` tinyint(1) DEFAULT 1,
  `adjunto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_tipo` (`tipo`),
  KEY `idx_activo` (`activo`),
  KEY `idx_autor_id` (`autor_id`),
  CONSTRAINT `fk_comunicado_autor` FOREIGN KEY (`autor_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertar comunicados de ejemplo
INSERT INTO `comunicados` (`titulo`, `contenido`, `tipo`, `autor_id`) VALUES
('Mantenimiento de piscina', 'Se informa que la piscina estará cerrada del 15 al 17 de noviembre por mantenimiento preventivo.', 'mantenimiento', 1),
('Asamblea General', 'Se convoca a todos los residentes a la asamblea general el 25 de noviembre a las 6:00 PM en el salón comunal.', 'evento', 1);

-- ============================================
-- DATOS DE PRUEBA ADICIONALES
-- ============================================

-- Más usuarios de prueba
INSERT INTO `usuarios` (`nombre`, `apellido`, `email`, `password`, `telefono`, `unidad`, `tipo_usuario`) VALUES
('Carlos', 'Rodríguez', 'carlos.rodriguez@ejemplo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3158765432', 'Torre C-201', 'residente'),
('Ana', 'López', 'ana.lopez@ejemplo.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3167654321', 'Torre A-101', 'residente');

-- ============================================
-- FIN DEL SCRIPT
-- ============================================

SELECT 'Base de datos creada exitosamente!' as Mensaje;
