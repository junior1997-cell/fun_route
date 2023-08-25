-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 25-08-2023 a las 00:53:29
-- Versión del servidor: 10.3.39-MariaDB
-- Versión de PHP: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `jdlpe_fun_route`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autoincrement_comprobante`
--

CREATE TABLE `autoincrement_comprobante` (
  `idautoincrement_comprobante` int(11) NOT NULL,
  `compra_producto_f` int(11) DEFAULT NULL,
  `compra_producto_b` int(11) DEFAULT NULL,
  `compra_producto_nv` int(11) DEFAULT NULL,
  `venta_producto_f` int(11) DEFAULT NULL,
  `venta_producto_b` int(11) DEFAULT NULL,
  `venta_producto_nv` int(11) DEFAULT NULL,
  `compra_cafe_f` int(11) DEFAULT NULL,
  `compra_cafe_b` int(11) DEFAULT NULL,
  `compra_cafe_nv` int(11) DEFAULT NULL,
  `venta_cafe_f` int(11) DEFAULT NULL,
  `venta_cafe_n` int(11) DEFAULT NULL,
  `venta_cafe_nv` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `autoincrement_comprobante`
--

INSERT INTO `autoincrement_comprobante` (`idautoincrement_comprobante`, `compra_producto_f`, `compra_producto_b`, `compra_producto_nv`, `venta_producto_f`, `venta_producto_b`, `venta_producto_nv`, `compra_cafe_f`, `compra_cafe_b`, `compra_cafe_nv`, `venta_cafe_f`, `venta_cafe_n`, `venta_cafe_nv`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 0, 0, 3, 0, 0, 0, 0, 0, 0, 0, '2023-08-23 14:51:19', '2023-08-23 14:51:19');

--
-- Disparadores `autoincrement_comprobante`
--
DELIMITER $$
CREATE TRIGGER `autoincrement_comprobante_BEFORE_INSERT` BEFORE INSERT ON `autoincrement_comprobante` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `autoincrement_comprobante_BEFORE_UPDATE` BEFORE UPDATE ON `autoincrement_comprobante` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bancos`
--

CREATE TABLE `bancos` (
  `idbancos` int(11) NOT NULL,
  `nombre` varchar(65) DEFAULT NULL,
  `alias` varchar(65) DEFAULT NULL,
  `formato_cta` varchar(50) DEFAULT NULL,
  `formato_cci` varchar(50) DEFAULT NULL,
  `formato_detracciones` varchar(50) DEFAULT NULL,
  `icono` varchar(100) DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `bancos`
--

INSERT INTO `bancos` (`idbancos`, `nombre`, `alias`, `formato_cta`, `formato_cci`, `formato_detracciones`, `icono`, `estado`, `estado_delete`, `created_at`, `updated_at`, `user_trash`, `user_delete`, `user_created`, `user_updated`) VALUES
(1, 'SIN BANCO', NULL, '00-00-00-00', '00-00-00-00', '00-00-00-00', 'logo-sin-banco.svg', '1', '1', '2021-10-07 01:20:27', '2022-06-01 01:03:33', NULL, NULL, NULL, NULL),
(2, 'BBVA', NULL, '04-04-10-00', '03-03-12-02', '04-04-04-04', 'logo-bbva.svg', '1', '1', '2021-10-07 01:20:27', '2022-06-01 01:03:41', NULL, NULL, NULL, NULL),
(3, 'SCOTIA BANK', NULL, '04-04-10-00', '04-04-10-00', '04-04-04-04', 'logo-scotiabank.svg', '1', '1', '2021-10-07 13:08:30', '2022-06-01 01:03:48', NULL, NULL, NULL, NULL),
(4, 'INTERBANK', NULL, '04-04-10-00', '04-04-10-00', '04-04-04-04', 'icono-interbank.svg', '1', '1', '2021-10-07 13:08:30', '2022-06-01 01:04:06', NULL, NULL, NULL, NULL),
(5, 'NACIÓN', NULL, '04-04-10-00', '04-04-10-00', '04-04-04-04', 'icono-banco-nacion.svg', '1', '1', '2021-10-07 13:08:30', '2022-06-01 01:04:13', NULL, NULL, NULL, NULL),
(6, 'CAJA PIURA', NULL, '02-03-06-00', '10-00-00-00', '04-04-04-04', 'icono-caja-piura.svg', '1', '1', '2022-01-12 05:14:03', '2022-06-01 01:04:27', NULL, NULL, NULL, NULL),
(7, 'BCP', '', '03-08-01-02', '03-03-12-02', '04-04-04-04', 'icono-bcp.svg', '1', '1', '2022-02-19 06:34:06', '2022-06-01 01:04:35', NULL, NULL, NULL, NULL);

--
-- Disparadores `bancos`
--
DELIMITER $$
CREATE TRIGGER `bancos_BEFORE_INSERT` BEFORE INSERT ON `bancos` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `bancos_BEFORE_UPDATE` BEFORE UPDATE ON `bancos` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora_bd`
--

CREATE TABLE `bitacora_bd` (
  `idbitacora_bd` int(11) NOT NULL,
  `idcodigo` int(11) NOT NULL,
  `nombre_tabla` varchar(100) DEFAULT NULL,
  `id_tabla` varchar(45) DEFAULT NULL,
  `sql_d` text DEFAULT NULL,
  `id_user` varchar(45) DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Disparadores `bitacora_bd`
--
DELIMITER $$
CREATE TRIGGER `bitacora_bd_BEFORE_INSERT` BEFORE INSERT ON `bitacora_bd` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `bitacora_bd_BEFORE_UPDATE` BEFORE UPDATE ON `bitacora_bd` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo_trabajador`
--

CREATE TABLE `cargo_trabajador` (
  `idcargo_trabajador` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `cargo_trabajador`
--

INSERT INTO `cargo_trabajador` (`idcargo_trabajador`, `nombre`, `estado`, `estado_delete`, `created_at`, `updated_at`, `user_trash`, `user_delete`, `user_created`, `user_updated`) VALUES
(1, 'Ninguno', '1', '1', '2022-09-20 17:30:06', '2023-01-02 22:29:15', NULL, 1, NULL, NULL),
(2, 'Administrador', '1', '1', '2022-09-27 05:52:30', '2022-10-07 16:23:54', NULL, NULL, NULL, 1),
(3, 'secretaria', '1', '1', '2022-09-27 05:52:44', '2022-09-27 05:52:44', NULL, NULL, NULL, NULL),
(4, 'Logisticas', '1', '1', '2022-09-27 05:52:53', '2022-10-07 07:00:28', NULL, NULL, NULL, 1);

--
-- Disparadores `cargo_trabajador`
--
DELIMITER $$
CREATE TRIGGER `cargo_trabajador_BEFORE_INSERT` BEFORE INSERT ON `cargo_trabajador` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `cargo_trabajador_BEFORE_UPDATE` BEFORE UPDATE ON `cargo_trabajador` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `codigo_bitacora`
--

CREATE TABLE `codigo_bitacora` (
  `idcodigo` int(11) NOT NULL,
  `codigo` varchar(100) DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `codigo_bitacora`
--

INSERT INTO `codigo_bitacora` (`idcodigo`, `codigo`, `mensaje`, `created_at`, `updated_at`) VALUES
(1, 'estado_1', 'Registro recuperado de papelera', '2023-08-23 14:51:19', '2023-08-23 14:51:19'),
(2, 'estado_0', 'Registro enviado a papelera', '2023-08-23 14:51:19', '2023-08-23 14:51:19'),
(3, 'estado_delete_1', 'Registro recuperado de permanentemente', '2023-08-23 14:51:19', '2023-08-23 14:51:19'),
(4, 'estado_delete_0', 'Registro eliminado permanentemente', '2023-08-23 14:51:19', '2023-08-23 14:51:19'),
(5, 'created_at', 'Registro creado', '2023-08-23 14:51:19', '2023-08-23 14:51:19'),
(6, 'updated_at', 'Registro actualizado', '2023-08-23 14:51:19', '2023-08-23 14:51:19');

--
-- Disparadores `codigo_bitacora`
--
DELIMITER $$
CREATE TRIGGER `codigo_bitacora_BEFORE_INSERT` BEFORE INSERT ON `codigo_bitacora` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `codigo_bitacora_BEFORE_UPDATE` BEFORE UPDATE ON `codigo_bitacora` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario_paquete`
--

CREATE TABLE `comentario_paquete` (
  `idcomentario_paquete` int(11) NOT NULL,
  `idpaquete` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `correo` varchar(60) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estrella` int(11) DEFAULT NULL,
  `estado_aceptado` char(1) DEFAULT '0',
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Disparadores `comentario_paquete`
--
DELIMITER $$
CREATE TRIGGER `comentario_paquete_BEFORE_INSERT` BEFORE INSERT ON `comentario_paquete` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `comentario_paquete_BEFORE_UPDATE` BEFORE UPDATE ON `comentario_paquete` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario_tours`
--

CREATE TABLE `comentario_tours` (
  `idcomentario_tours` int(11) NOT NULL,
  `idtours` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `correo` varchar(60) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `estrella` int(11) DEFAULT NULL,
  `estado_aceptado` char(1) DEFAULT '0',
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Disparadores `comentario_tours`
--
DELIMITER $$
CREATE TRIGGER `comentario_tours_BEFORE_INSERT` BEFORE INSERT ON `comentario_tours` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `comentario_tours_BEFORE_UPDATE` BEFORE UPDATE ON `comentario_tours` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_habitacion`
--

CREATE TABLE `detalle_habitacion` (
  `iddetalle_habitacion` int(11) NOT NULL,
  `idhabitacion` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `icono_font` varchar(20) DEFAULT 'fas fa-chevron-right',
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `estado_si_no` char(1) DEFAULT '0' COMMENT ' 0 no tiene\\n1 tiene'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Disparadores `detalle_habitacion`
--
DELIMITER $$
CREATE TRIGGER `detalle_habitacion_BEFORE_INSERT` BEFORE INSERT ON `detalle_habitacion` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `detalle_habitacion_BEFORE_UPDATE` BEFORE UPDATE ON `detalle_habitacion` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galeria_hotel`
--

CREATE TABLE `galeria_hotel` (
  `idgaleria_hotel` int(11) NOT NULL,
  `idhoteles` int(11) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Disparadores `galeria_hotel`
--
DELIMITER $$
CREATE TRIGGER `galeria_hotel_BEFORE_INSERT` BEFORE INSERT ON `galeria_hotel` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `galeria_hotel_BEFORE_UPDATE` BEFORE UPDATE ON `galeria_hotel` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galeria_paquete`
--

CREATE TABLE `galeria_paquete` (
  `idgaleria_paquete` int(11) NOT NULL,
  `idpaquete` int(11) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Disparadores `galeria_paquete`
--
DELIMITER $$
CREATE TRIGGER `galeria_paquete_BEFORE_INSERT` BEFORE INSERT ON `galeria_paquete` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `galeria_paquete_BEFORE_UPDATE` BEFORE UPDATE ON `galeria_paquete` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galeria_tours`
--

CREATE TABLE `galeria_tours` (
  `idgaleria_tours` int(11) NOT NULL,
  `idtours` int(11) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Disparadores `galeria_tours`
--
DELIMITER $$
CREATE TRIGGER `galeria_tours_BEFORE_INSERT` BEFORE INSERT ON `galeria_tours` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `galeria_tours_BEFORE_UPDATE` BEFORE UPDATE ON `galeria_tours` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `habitacion`
--

CREATE TABLE `habitacion` (
  `idhabitacion` int(11) NOT NULL,
  `idhoteles` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Disparadores `habitacion`
--
DELIMITER $$
CREATE TRIGGER `habitacion_BEFORE_INSERT` BEFORE INSERT ON `habitacion` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `habitacion_BEFORE_UPDATE` BEFORE UPDATE ON `habitacion` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hoteles`
--

CREATE TABLE `hoteles` (
  `idhoteles` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `estrellas` decimal(2,1) DEFAULT 0.0,
  `check_in` varchar(10) DEFAULT NULL,
  `check_out` varchar(10) DEFAULT NULL,
  `imagen_perfil` varchar(100) DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Disparadores `hoteles`
--
DELIMITER $$
CREATE TRIGGER `hoteles_BEFORE_INSERT` BEFORE INSERT ON `hoteles` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `hoteles_BEFORE_UPDATE` BEFORE UPDATE ON `hoteles` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `instalaciones_hotel`
--

CREATE TABLE `instalaciones_hotel` (
  `idinstalaciones_hotel` int(11) NOT NULL,
  `idhoteles` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `icono_font` varchar(20) DEFAULT 'fas fa-chevron-right',
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL,
  `estado_si_no` char(1) DEFAULT '0' COMMENT '0 no tiene\\n1 tiene'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Disparadores `instalaciones_hotel`
--
DELIMITER $$
CREATE TRIGGER `instalaciones_hotel_BEFORE_INSERT` BEFORE INSERT ON `instalaciones_hotel` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `instalaciones_hotel_BEFORE_UPDATE` BEFORE UPDATE ON `instalaciones_hotel` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `itinerario`
--

CREATE TABLE `itinerario` (
  `iditinerario` int(11) NOT NULL,
  `idpaquete` int(11) NOT NULL,
  `idtours` int(11) NOT NULL,
  `actividad` text DEFAULT NULL,
  `numero_orden` varchar(45) DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Disparadores `itinerario`
--
DELIMITER $$
CREATE TRIGGER `itinerario_BEFORE_INSERT` BEFORE INSERT ON `itinerario` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `itinerario_BEFORE_UPDATE` BEFORE UPDATE ON `itinerario` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mes_pago_trabajador`
--

CREATE TABLE `mes_pago_trabajador` (
  `idmes_pago_trabajador` int(11) NOT NULL,
  `idpersona` int(11) NOT NULL,
  `mes_nombre` varchar(45) DEFAULT NULL,
  `anio` year(4) DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Disparadores `mes_pago_trabajador`
--
DELIMITER $$
CREATE TRIGGER `mes_pago_trabajador_BEFORE_INSERT` BEFORE INSERT ON `mes_pago_trabajador` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `mes_pago_trabajador_BEFORE_UPDATE` BEFORE UPDATE ON `mes_pago_trabajador` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nosotros`
--

CREATE TABLE `nosotros` (
  `idnosotros` int(11) NOT NULL,
  `nombre_empresa` varchar(100) DEFAULT NULL,
  `ruc` varchar(45) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `telefono_fijo` varchar(45) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `mision` text DEFAULT NULL,
  `vision` text DEFAULT NULL,
  `valores` text DEFAULT NULL,
  `resenia_historica` text DEFAULT NULL,
  `palabras_ceo` text DEFAULT NULL,
  `horario` text DEFAULT NULL,
  `latitud` varchar(100) DEFAULT NULL,
  `longitud` varchar(100) DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `nosotros`
--

INSERT INTO `nosotros` (`idnosotros`, `nombre_empresa`, `ruc`, `direccion`, `celular`, `telefono_fijo`, `correo`, `mision`, `vision`, `valores`, `resenia_historica`, `palabras_ceo`, `horario`, `latitud`, `longitud`, `estado`, `estado_delete`, `created_at`, `updated_at`, `user_trash`, `user_delete`, `user_created`, `user_updated`) VALUES
(1, 'Fun Route', '--------------', '-------', '---------------', '--------', '-------------', '<font color=\"#000000\"><span style=\"font-family: Poppins, sans-serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; text-align: start; text-indent: 0px; text-transform: none; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; float: none; display: inline !important;\"><b>Somos </b></span><span style=\"font-family: Poppins, sans-serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; text-align: start; text-indent: 0px; text-transform: none; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; float: none; display: inline !important;\"><b>una empresa </b></span><span style=\"font-family: Poppins, sans-serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; text-align: start; text-indent: 0px; text-transform: none; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">dedicada al rubro de turismo en la Región San Martin, ofrecemos un servicio personalizado,&nbsp;</span></font><span style=\"color: rgb(0, 0, 0); font-family: Poppins, sans-serif; font-size: 15px;\">innovador, de calidad y </span><span style=\"font-family: Poppins, sans-serif; font-size: 15px;\"><font color=\"#000000\" style=\"\">confiabilidad</font></span><span style=\"color: rgb(0, 0, 0); font-family: Poppins, sans-serif; font-size: 15px;\">, para satisfacer las necesidades de nuestros clientes y puedan llevarse una excelente experiencia al conocer nuestra Región.</span><font color=\"#000000\"><span style=\"font-family: Poppins, sans-serif; font-size: 15px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; text-align: start; text-indent: 0px; text-transform: none; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\"><br></span></font>', '<font color=\"#000000\"><span style=\"text-align: start; text-indent: 0px; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; float: none; display: inline !important;\"><div style=\"\"><font face=\"Poppins, sans-serif\"><span style=\"font-size: 15px;\">Nuestra <b style=\"\">visión es&nbsp;</b>posicionarnos como una empresa líder en el mercado del turismo brindando calidad, excelencia en nuestros servicios, logrando la preferencia y fidelidad de nuestros clientes.</span></font></div></span></font>', '<p><b>La empresa se basa en la honestidad,</b> el respeto mutuo, el trabajo en equipo, la responsabilidad, el profesionalismo, la transparencia en las acciones, el compromiso, el crecimiento, la innovación constante y la importancia de nuestros clientes para la vitalidad de la empresa.</p>', '<p>Fun R<font color=\"#000000\" style=\"\">oute nació de la pasión de un estudiante de turismo; el hoy actual gerente, por descubrir nuevos destinos y compartir experiencias inolvidables con otros viajeros. Desde muy joven, soñaba con tener su propia agencia de turismo, un lugar donde pudiera combinar su pasión por los viajes con su deseo de brindar un servicio excepcional a los aventureros de todo el mundo.</font></p><p>Después de años de estudiar y trabajar en la industria del turismo, el gerente decidió que era el momento de hacer realidad su sueño.</p><p>Lo que hace a Fun Route especial es su enfoque en la diversión y la autenticidad. Creemos firmemente que los viajes deben ser experiencias enriquecedoras y llenas de diversión, y que los turistas deben tener la oportunidad de sumergirse en la cultura y el entorno de cada lugar que visitan.</p><p>Fun Route se destaca por ofrecer itinerarios únicos y personalizados, diseñados para satisfacer los intereses y deseos específicos de cada cliente. Ya sea que alguien esté buscando una aventura en la naturaleza, un viaje cultural o simplemente un escape relajante, Fun Route se asegura de que cada experiencia sea inolvidable.</p><p>Además, Fun Route se compromete con la sostenibilidad y el turismo responsable. entendemos la importancia de preservar los destinos y comunidades locales, y trabajamos en estrecha colaboración con proveedores y socios comprometidos con prácticas responsables.</p><p></p>', '<span style=\"orphans: 2; text-align: left; text-indent: 0px; widows: 2; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; float: none; display: inline !important;\"><div style=\"text-align: center; \"><font face=\"Poppins, sans-serif\">Somos una <b>agencia de viaje</b> a medida con expertos en organizar viajes personalizados a San Martín. San martín ofrece una amplia gama de posibilidades y combinaciones. Puedes definir destinos prioritarios, duración, tipos de servicios y hoteles.</font></div><div style=\"text-align: center; \"><b style=\"font-family: Poppins, sans-serif; font-size: 1rem;\">¡Cuéntanos tu idea!</b><br></div></span>', '--------------', '--------------', '-------------', '1', '1', '2023-06-11 23:49:16', '2023-08-12 16:21:53', NULL, NULL, NULL, NULL);

--
-- Disparadores `nosotros`
--
DELIMITER $$
CREATE TRIGGER `nosotros_BEFORE_INSERT` BEFORE INSERT ON `nosotros` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `nosotros_BEFORE_UPDATE` BEFORE UPDATE ON `nosotros` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `otro_ingreso`
--

CREATE TABLE `otro_ingreso` (
  `idotro_ingreso` int(11) NOT NULL,
  `idpersona` int(11) NOT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `tipo_comprobante` varchar(45) DEFAULT NULL,
  `numero_comprobante` varchar(45) DEFAULT NULL,
  `forma_de_pago` varchar(45) DEFAULT NULL,
  `precio_sin_igv` decimal(11,2) DEFAULT NULL,
  `precio_igv` decimal(11,2) DEFAULT NULL,
  `val_igv` decimal(11,2) DEFAULT NULL,
  `precio_con_igv` decimal(11,2) DEFAULT NULL,
  `tipo_gravada` varchar(45) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `comprobante` varchar(100) DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Disparadores `otro_ingreso`
--
DELIMITER $$
CREATE TRIGGER `otro_ingreso_BEFORE_INSERT` BEFORE INSERT ON `otro_ingreso` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `otro_ingreso_BEFORE_UPDATE` BEFORE UPDATE ON `otro_ingreso` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_trabajador`
--

CREATE TABLE `pago_trabajador` (
  `idpago_trabajador` int(11) NOT NULL,
  `idmes_pago_trabajador` int(11) NOT NULL,
  `fecha_pago` date DEFAULT NULL,
  `nombre_mes` varchar(45) DEFAULT NULL,
  `monto` decimal(11,2) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `comprobante` varchar(100) DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Disparadores `pago_trabajador`
--
DELIMITER $$
CREATE TRIGGER `pago_trabajador_BEFORE_INSERT` BEFORE INSERT ON `pago_trabajador` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `pago_trabajador_BEFORE_UPDATE` BEFORE UPDATE ON `pago_trabajador` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paquete`
--

CREATE TABLE `paquete` (
  `idpaquete` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `cant_dias` varchar(10) DEFAULT NULL,
  `cant_noches` varchar(10) DEFAULT NULL,
  `alimentacion` text DEFAULT NULL,
  `alojamiento` text DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `incluye` text DEFAULT NULL,
  `no_incluye` text DEFAULT NULL,
  `recomendaciones` text DEFAULT NULL,
  `mapa` text DEFAULT NULL,
  `costo` decimal(11,2) DEFAULT NULL,
  `estado_descuento` char(1) DEFAULT '0',
  `porcentaje_descuento` decimal(11,2) DEFAULT NULL,
  `monto_descuento` decimal(11,2) DEFAULT NULL,
  `resumen` text DEFAULT NULL,
  `desc_alojamiento` text DEFAULT NULL,
  `desc_comida` text DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Disparadores `paquete`
--
DELIMITER $$
CREATE TRIGGER `paquete_BEFORE_INSERT` BEFORE INSERT ON `paquete` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `paquete_BEFORE_UPDATE` BEFORE UPDATE ON `paquete` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_paquete`
--

CREATE TABLE `pedido_paquete` (
  `idpedido_paquete` int(11) NOT NULL,
  `idpaquete` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `correo` varchar(60) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `estado_visto` char(1) DEFAULT '0',
  `estado_vendido` char(1) DEFAULT '0',
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Disparadores `pedido_paquete`
--
DELIMITER $$
CREATE TRIGGER `pedido_paquete_BEFORE_INSERT` BEFORE INSERT ON `pedido_paquete` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `pedido_paquete_BEFORE_UPDATE` BEFORE UPDATE ON `pedido_paquete` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_tours`
--

CREATE TABLE `pedido_tours` (
  `idpedido_tours` int(11) NOT NULL,
  `idtours` int(11) NOT NULL,
  `nombre` varchar(200) DEFAULT NULL,
  `correo` varchar(60) DEFAULT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `estado_visto` char(1) DEFAULT '0',
  `estado_vendido` char(1) DEFAULT '0',
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Disparadores `pedido_tours`
--
DELIMITER $$
CREATE TRIGGER `pedido_tours_BEFORE_INSERT` BEFORE INSERT ON `pedido_tours` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `pedido_tours_BEFORE_UPDATE` BEFORE UPDATE ON `pedido_tours` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `icono` varchar(500) DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `permiso`
--

INSERT INTO `permiso` (`idpermiso`, `nombre`, `icono`, `estado`, `estado_delete`, `created_at`, `updated_at`, `user_trash`, `user_delete`, `user_created`, `user_updated`) VALUES
(1, 'Escritorio', '<i class=\"fas fa-th\"></i>', '1', '1', '2022-09-21 03:53:07', '2022-09-21 03:53:07', NULL, NULL, NULL, NULL),
(2, 'Empresa', '<i class=\"nav-icon fa-sharp fa-solid fa-city\"></i>', '1', '1', '2022-09-21 03:53:07', '2023-08-23 17:16:27', NULL, NULL, NULL, NULL),
(3, 'Accesos', '<i class=\"nav-icon fas fa-shield-alt\"></i>', '1', '1', '2022-09-21 03:53:07', '2023-08-23 17:16:58', NULL, NULL, NULL, NULL),
(4, 'Recursos', '<i class=\"nav-icon fas fa-project-diagram\"></i>', '1', '1', '2022-09-21 03:53:07', '2023-08-23 17:17:20', NULL, NULL, NULL, NULL),
(5, 'Papelera', '<i class=\"nav-icon fas fa-trash-alt\"></i>', '1', '1', '2022-09-21 03:53:07', '2023-08-23 17:17:35', NULL, NULL, NULL, NULL),
(6, 'Paquete Definido', '<i class=\"fa-solid fa-boxes-stacked\"></i>', '1', '1', '2022-09-21 03:53:07', '2023-08-23 17:18:02', NULL, NULL, NULL, NULL),
(7, 'Paquete a medida', '<i class=\"fa-solid  fas fa-passport\"></i>', '1', '1', '2022-09-21 03:53:07', '2023-08-23 17:19:48', NULL, NULL, NULL, NULL),
(8, 'Tours', '<i class=\"fa-solid fas fa-sun\"></i>', '1', '1', '2022-09-21 03:53:07', '2023-08-23 17:19:59', NULL, NULL, NULL, NULL),
(9, 'Pedido', '<i class=\"fa-solid  fas fa-dollar-sign\"></i>', '1', '1', '2022-09-21 03:53:07', '2023-08-23 17:20:11', NULL, NULL, NULL, NULL),
(10, 'Reportes', '<i class=\"fa-solid fa-chart-line\"></i>', '1', '1', '2023-08-23 17:14:23', '2023-08-23 17:21:02', NULL, NULL, NULL, NULL),
(11, 'Contable y Financiero', '<i class=\"nav-icon fas fa-hand-holding-usd\"></i>', '1', '1', '2023-08-23 17:19:10', '2023-08-23 17:21:19', NULL, NULL, NULL, NULL);

--
-- Disparadores `permiso`
--
DELIMITER $$
CREATE TRIGGER `permiso_BEFORE_INSERT` BEFORE INSERT ON `permiso` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `permiso_BEFORE_UPDATE` BEFORE UPDATE ON `permiso` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idpersona` int(11) NOT NULL,
  `idtipo_persona` int(11) NOT NULL,
  `idbancos` int(11) NOT NULL,
  `idcargo_trabajador` int(11) NOT NULL,
  `nombres` varchar(200) DEFAULT NULL,
  `tipo_documento` varchar(20) DEFAULT NULL,
  `numero_documento` varchar(20) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `celular` varchar(15) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `cuenta_bancaria` varchar(45) DEFAULT NULL,
  `cci` varchar(45) DEFAULT NULL,
  `titular_cuenta` varchar(45) DEFAULT NULL,
  `es_socio` char(1) DEFAULT NULL COMMENT '1=si-socio, 2=no-socio',
  `sueldo_mensual` decimal(11,2) DEFAULT NULL,
  `sueldo_diario` decimal(11,2) DEFAULT NULL,
  `foto_perfil` varchar(100) DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idpersona`, `idtipo_persona`, `idbancos`, `idcargo_trabajador`, `nombres`, `tipo_documento`, `numero_documento`, `fecha_nacimiento`, `edad`, `celular`, `direccion`, `correo`, `cuenta_bancaria`, `cci`, `titular_cuenta`, `es_socio`, `sueldo_mensual`, `sueldo_diario`, `foto_perfil`, `estado`, `estado_delete`, `created_at`, `updated_at`, `user_trash`, `user_delete`, `user_created`, `user_updated`) VALUES
(1, 1, 1, 1, 'CLIENTES VARIOS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1', '2022-09-29 18:19:53', '2023-08-23 16:59:53', NULL, NULL, NULL, NULL),
(2, 2, 4, 2, '2323', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', '1', '2023-08-25 06:44:08', '2023-08-25 06:44:17', NULL, NULL, NULL, NULL);

--
-- Disparadores `persona`
--
DELIMITER $$
CREATE TRIGGER `persona_BEFORE_INSERT` BEFORE INSERT ON `persona` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `persona_BEFORE_UPDATE` BEFORE UPDATE ON `persona` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `politicas`
--

CREATE TABLE `politicas` (
  `idpoliticas` int(11) NOT NULL,
  `tipo_politica` varchar(45) DEFAULT NULL,
  `condiciones_generales` text DEFAULT NULL,
  `reservas` text DEFAULT NULL,
  `pago` text DEFAULT NULL,
  `cancelacion` text DEFAULT NULL,
  `responsabilidad_cliente` text DEFAULT NULL,
  `responsabilidad_proveedor` text DEFAULT NULL,
  `cancelaiones_proveedor` text DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `politicas`
--

INSERT INTO `politicas` (`idpoliticas`, `tipo_politica`, `condiciones_generales`, `reservas`, `pago`, `cancelacion`, `responsabilidad_cliente`, `responsabilidad_proveedor`, `cancelaiones_proveedor`, `estado`, `estado_delete`, `created_at`, `updated_at`, `user_trash`, `user_delete`, `user_created`, `user_updated`) VALUES
(1, NULL, '<p style=\"box-sizing: border-box; margin: 0px; padding: 8px 0px 4px; font-family: Poppins, sans-serif; font-size: 16px; font-weight: 500; min-width: 100%; color: rgb(33, 37, 41); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><i class=\"fa-solid fa-circle-check espacio\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0.5em 0px 0px; font-family: &quot;Font Awesome 6 Free&quot;; -webkit-font-smoothing: antialiased; display: var(--fa-display, inline-block); font-style: normal; font-variant: normal; line-height: 1; text-rendering: auto; font-weight: 900; font-size: 1.3em; color: rgb(45, 171, 122);\"></i>Esta cotización no representa una reserva válida.</p><p style=\"box-sizing: border-box; margin: 0px; padding: 8px 0px 4px; font-family: Poppins, sans-serif; font-size: 16px; font-weight: 500; min-width: 100%; color: rgb(33, 37, 41); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><i class=\"fa-solid fa-circle-check espacio\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0.5em 0px 0px; font-family: &quot;Font Awesome 6 Free&quot;; -webkit-font-smoothing: antialiased; display: var(--fa-display, inline-block); font-style: normal; font-variant: normal; line-height: 1; text-rendering: auto; font-weight: 900; font-size: 1.3em; color: rgb(45, 171, 122);\"></i>No se realizará ningún tipo de reembolso por servicios no utilizados de forma voluntaria, tampoco podrá ser utilizado en otra oportunidad.</p><p style=\"box-sizing: border-box; margin: 0px; padding: 8px 0px 4px; font-family: Poppins, sans-serif; font-size: 16px; font-weight: 500; min-width: 100%; color: rgb(33, 37, 41); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><i class=\"fa-solid fa-circle-check espacio\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0.5em 0px 0px; font-family: &quot;Font Awesome 6 Free&quot;; -webkit-font-smoothing: antialiased; display: var(--fa-display, inline-block); font-style: normal; font-variant: normal; line-height: 1; text-rendering: auto; font-weight: 900; font-size: 1.3em; color: rgb(45, 171, 122);\"></i>Los niños mayores de 05 años cancelan la tarifa completa, el cual les brinda los mismos beneficios que un adulto.</p><p style=\"box-sizing: border-box; margin: 0px; padding: 8px 0px 4px; font-family: Poppins, sans-serif; font-size: 16px; font-weight: 500; min-width: 100%; color: rgb(33, 37, 41); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><i class=\"fa-solid fa-circle-check espacio\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0.5em 0px 0px; font-family: &quot;Font Awesome 6 Free&quot;; -webkit-font-smoothing: antialiased; display: var(--fa-display, inline-block); font-style: normal; font-variant: normal; line-height: 1; text-rendering: auto; font-weight: 900; font-size: 1.3em; color: rgb(45, 171, 122);\"></i>En caso de discriminación o comportamiento inadecuado, procederemos a cancelar los servicios sin derecho a reembolso.</p><p style=\"box-sizing: border-box; margin: 0px; padding: 8px 0px 4px; font-family: Poppins, sans-serif; font-size: 16px; font-weight: 500; min-width: 100%; color: rgb(33, 37, 41); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><i class=\"fa-solid fa-circle-check espacio\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0.5em 0px 0px; font-family: &quot;Font Awesome 6 Free&quot;; -webkit-font-smoothing: antialiased; display: var(--fa-display, inline-block); font-style: normal; font-variant: normal; line-height: 1; text-rendering: auto; font-weight: 900; font-size: 1.3em; color: rgb(45, 171, 122);\"></i>La empresa se reserva el derecho de hacer modificaciones en el orden de los Tours, debido a condiciones del clima, aumento del caudal del río, o por cualquier otra razón relevante, las mismas que garantizarán su seguridad y el mejor desarrollo de sus tours.</p>', '<p style=\"box-sizing: border-box; margin: 0px; padding: 8px 0px 4px; font-family: Poppins, sans-serif; font-size: 16px; font-weight: 400; color: rgb(33, 37, 41); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><i class=\"fa-solid fa-circle-check espacio\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0.5em 0px 0px; font-family: &quot;Font Awesome 6 Free&quot;; -webkit-font-smoothing: antialiased; display: var(--fa-display, inline-block); font-style: normal; font-variant: normal; line-height: 1; text-rendering: auto; font-weight: 900; color: rgb(45, 171, 122); font-size: 1.3em;\"></i>Las solicitudes de reservas se atenderán por escrito a través de los siguientes contactos: Fun Route:<span>&nbsp;</span><a href=\"https://funroute.jdl.pe/paquetes/escape-tarapoto.html\" style=\"box-sizing: border-box; margin: 0px; padding: 0px; font-family: Poppins, sans-serif; color: var(--bs-link-color); text-decoration: none; transition: all 0.3s ease 0s;\">funroute23@gmail.com</a><span>&nbsp;</span>/<span>&nbsp;</span><b style=\"box-sizing: border-box; margin: 0px; padding: 0px; font-family: Poppins, sans-serif; font-weight: bolder;\">+51 930 637 287</b></p><p style=\"box-sizing: border-box; margin: 0px; padding: 8px 0px 4px; font-family: Poppins, sans-serif; font-size: 16px; font-weight: 400; color: rgb(33, 37, 41); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><i class=\"fa-solid fa-circle-check espacio\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0.5em 0px 0px; font-family: &quot;Font Awesome 6 Free&quot;; -webkit-font-smoothing: antialiased; display: var(--fa-display, inline-block); font-style: normal; font-variant: normal; line-height: 1; text-rendering: auto; font-weight: 900; color: rgb(45, 171, 122); font-size: 1.3em;\"></i>Las solicitudes deben incluir la siguiente información.</p><div class=\"sublista\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 0px 1.5em; font-family: Poppins, sans-serif; color: rgb(33, 37, 41); font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><p style=\"box-sizing: border-box; margin: 0px; padding: 8px 0px 4px; font-family: Poppins, sans-serif; font-size: 1em; font-weight: 400;\"><i class=\"fa-solid fa-check espacio\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0.5em 0px 0px; font-family: &quot;Font Awesome 6 Free&quot;; -webkit-font-smoothing: antialiased; display: var(--fa-display, inline-block); font-style: normal; font-variant: normal; line-height: 1; text-rendering: auto; font-weight: 900; color: rgb(45, 171, 122); font-size: 1.3em;\"></i>Tipo de habitación y cantidad de noches, número de personas, considerar adultos, adultos mayores y niños.</p><p style=\"box-sizing: border-box; margin: 0px; padding: 8px 0px 4px; font-family: Poppins, sans-serif; font-size: 1em; font-weight: 400;\"><i class=\"fa-solid fa-check espacio\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0.5em 0px 0px; font-family: &quot;Font Awesome 6 Free&quot;; -webkit-font-smoothing: antialiased; display: var(--fa-display, inline-block); font-style: normal; font-variant: normal; line-height: 1; text-rendering: auto; font-weight: 900; color: rgb(45, 171, 122); font-size: 1.3em;\"></i>Fecha de Check In y Check Out.</p><p style=\"box-sizing: border-box; margin: 0px; padding: 8px 0px 4px; font-family: Poppins, sans-serif; font-size: 1em; font-weight: 400;\"><i class=\"fa-solid fa-check espacio\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0.5em 0px 0px; font-family: &quot;Font Awesome 6 Free&quot;; -webkit-font-smoothing: antialiased; display: var(--fa-display, inline-block); font-style: normal; font-variant: normal; line-height: 1; text-rendering: auto; font-weight: 900; color: rgb(45, 171, 122); font-size: 1.3em;\"></i>Nombre + apellido.</p><p style=\"box-sizing: border-box; margin: 0px; padding: 8px 0px 4px; font-family: Poppins, sans-serif; font-size: 1em; font-weight: 400;\"><i class=\"fa-solid fa-check espacio\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0.5em 0px 0px; font-family: &quot;Font Awesome 6 Free&quot;; -webkit-font-smoothing: antialiased; display: var(--fa-display, inline-block); font-style: normal; font-variant: normal; line-height: 1; text-rendering: auto; font-weight: 900; color: rgb(45, 171, 122); font-size: 1.3em;\"></i>DNI, CE, Pasaporte.</p><p style=\"box-sizing: border-box; margin: 0px; padding: 8px 0px 4px; font-family: Poppins, sans-serif; font-size: 1em; font-weight: 400;\"><i class=\"fa-solid fa-check espacio\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0.5em 0px 0px; font-family: &quot;Font Awesome 6 Free&quot;; -webkit-font-smoothing: antialiased; display: var(--fa-display, inline-block); font-style: normal; font-variant: normal; line-height: 1; text-rendering: auto; font-weight: 900; color: rgb(45, 171, 122); font-size: 1.3em;\"></i>Teléfono y/o Correo de contacto de líder de grupo.</p><p style=\"box-sizing: border-box; margin: 0px; padding: 8px 0px 4px; font-family: Poppins, sans-serif; font-size: 1em; font-weight: 400;\"><i class=\"fa-solid fa-check espacio\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0.5em 0px 0px; font-family: &quot;Font Awesome 6 Free&quot;; -webkit-font-smoothing: antialiased; display: var(--fa-display, inline-block); font-style: normal; font-variant: normal; line-height: 1; text-rendering: auto; font-weight: 900; color: rgb(45, 171, 122); font-size: 1.3em;\"></i>Itinerario de vuelo para el recojo del aeropuerto.</p><p style=\"box-sizing: border-box; margin: 0px; padding: 8px 0px 4px; font-family: Poppins, sans-serif; font-size: 1em; font-weight: 400;\"><i class=\"fa-solid fa-check espacio\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0.5em 0px 0px; font-family: &quot;Font Awesome 6 Free&quot;; -webkit-font-smoothing: antialiased; display: var(--fa-display, inline-block); font-style: normal; font-variant: normal; line-height: 1; text-rendering: auto; font-weight: 900; color: rgb(45, 171, 122); font-size: 1.3em;\"></i>Informar de alguna consideración especial del pasajero: Adulto Mayor, Dieta alimenticia especial, alergias, habilidad diferente, etc.</p></div>', '<p style=\"box-sizing: border-box; margin: 0px; padding: 8px 0px 4px; font-family: Poppins, sans-serif; font-size: 16px; font-weight: 400; color: rgb(33, 37, 41); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\">Toda Reserva será confirmada con el adelanto del 50% mediante transferencia a la siguiente cuenta:</p><div class=\"sublista\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0px 0px 1.5em; font-family: Poppins, sans-serif; color: rgb(33, 37, 41); font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><h3 style=\"box-sizing: border-box; margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;; font-weight: 500; line-height: 29px; font-size: 24px; color: rgb(0, 0, 0); text-transform: uppercase;\"><b style=\"box-sizing: border-box; margin: 0px; padding: 0px; font-family: Poppins, sans-serif; font-weight: bolder;\">FUN ROUTE SAC</b></h3><p style=\"box-sizing: border-box; margin: 0px; padding: 8px 0px 4px; font-family: Poppins, sans-serif; font-size: 1em; font-weight: 400;\"><i class=\"fa-solid fa-check espacio\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0.5em 0px 0px; font-family: &quot;Font Awesome 6 Free&quot;; -webkit-font-smoothing: antialiased; display: var(--fa-display, inline-block); font-style: normal; font-variant: normal; line-height: 1; text-rendering: auto; font-weight: 900; color: rgb(45, 171, 122); font-size: 1.3em;\"></i><b style=\"box-sizing: border-box; margin: 0px; padding: 0px; font-family: Poppins, sans-serif; font-weight: bolder;\">Cuenta BBVA soles 0011-0310-0201403079</b></p><p style=\"box-sizing: border-box; margin: 0px; padding: 8px 0px 4px; font-family: Poppins, sans-serif; font-size: 1em; font-weight: 400;\"><i class=\"fa-solid fa-check espacio\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0.5em 0px 0px; font-family: &quot;Font Awesome 6 Free&quot;; -webkit-font-smoothing: antialiased; display: var(--fa-display, inline-block); font-style: normal; font-variant: normal; line-height: 1; text-rendering: auto; font-weight: 900; color: rgb(45, 171, 122); font-size: 1.3em;\"></i><b style=\"box-sizing: border-box; margin: 0px; padding: 0px; font-family: Poppins, sans-serif; font-weight: bolder;\">Cuenta interbancaria BBVA soles 011-310-000201403079-01</b></p></div><p style=\"box-sizing: border-box; margin: 0px; padding: 8px 0px 4px; font-family: Poppins, sans-serif; font-size: 16px; font-weight: 400; color: rgb(33, 37, 41); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><i class=\"fa-solid fa-circle-check espacio\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0.5em 0px 0px; font-family: &quot;Font Awesome 6 Free&quot;; -webkit-font-smoothing: antialiased; display: var(--fa-display, inline-block); font-style: normal; font-variant: normal; line-height: 1; text-rendering: auto; font-weight: 900; color: rgb(45, 171, 122); font-size: 1.3em;\"></i>El otro 50% podrá ser cancelado 15 días antes del inicio del paquete. Si no realiza el pago del 1er 50%, la cotización quedará anulada.</p>', '<p style=\"box-sizing: border-box; margin: 0px; padding: 8px 0px 4px; font-family: Poppins, sans-serif; font-size: 16px; font-weight: 400; color: rgb(33, 37, 41); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><i class=\"fa-solid fa-circle-check espacio\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0.5em 0px 0px; font-family: &quot;Font Awesome 6 Free&quot;; -webkit-font-smoothing: antialiased; display: var(--fa-display, inline-block); font-style: normal; font-variant: normal; line-height: 1; text-rendering: auto; font-weight: 900; color: rgb(45, 171, 122); font-size: 1.3em;\"></i>En caso de anularse una reserva debe ser solicitada por correo electrónico con 20 días de anticipación, de lo contrario no tendrá validez.</p><p style=\"box-sizing: border-box; margin: 0px; padding: 8px 0px 4px; font-family: Poppins, sans-serif; font-size: 16px; font-weight: 400; color: rgb(33, 37, 41); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><i class=\"fa-solid fa-circle-check espacio\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0.5em 0px 0px; font-family: &quot;Font Awesome 6 Free&quot;; -webkit-font-smoothing: antialiased; display: var(--fa-display, inline-block); font-style: normal; font-variant: normal; line-height: 1; text-rendering: auto; font-weight: 900; color: rgb(45, 171, 122); font-size: 1.3em;\"></i>Los pagos realizados son NO REEMBOLSABLES. En caso anulen la reserva, podrán utilizar el saldo a favor para futuras reservas.</p><p style=\"box-sizing: border-box; margin: 0px; padding: 8px 0px 4px; font-family: Poppins, sans-serif; font-size: 16px; font-weight: 400; color: rgb(33, 37, 41); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><i class=\"fa-solid fa-circle-check espacio\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0.5em 0px 0px; font-family: &quot;Font Awesome 6 Free&quot;; -webkit-font-smoothing: antialiased; display: var(--fa-display, inline-block); font-style: normal; font-variant: normal; line-height: 1; text-rendering: auto; font-weight: 900; color: rgb(45, 171, 122); font-size: 1.3em;\"></i>No habrá lugar a cancelación o re agendamiento de la reserva cuando el huésped ya se encuentre en el hotel o disfrutando de sus servicios.</p>', NULL, NULL, NULL, '1', '1', '2023-06-11 23:51:00', '2023-07-12 23:57:47', NULL, NULL, NULL, NULL),
(2, NULL, '<p>------------------------<br></p>', '<span style=\"color: rgb(33, 37, 41); font-family: Poppins, sans-serif; font-size: 16px; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 400; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; display: inline !important; float: none;\">Las solicitudes de reservas se atenderán por escrito a través de los siguientes contactos: Fun Route: funroute23@gmail.com / +51 930 637 287<br><br>Para reservar un tour, se requiere el pago completo o un depósito no reembolsable (50%), según lo especificado al momento de la reserva.<br><br>Las reservas están sujetas a disponibilidad y se recomienda hacerlas con anticipación para garantizar la disponibilidad del tour deseado.</span>', '<ol><li>Pago completo: Al momento de la reserva, se requiere el pago completo del costo total del tour. Esto garantiza la confirmación inmediata de la reserva y asegura la disponibilidad de los servicios contratados.<br><br></li><li>Depósito no reembolsable: Como alternativa al pago completo, se puede optar por realizar un depósito no reembolsable del 50% del costo total del tour al momento de la reserva. Este depósito asegura la reserva y cubre los gastos administrativos asociados con la preparación y organización del tour.<br></li></ol>', '<p style=\"box-sizing: border-box; margin: 0px; padding: 8px 0px 4px; font-family: Poppins, sans-serif; font-size: 16px; font-weight: 400; color: rgb(33, 37, 41); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><i class=\"fa-solid fa-circle-check espacio\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0.5em 0px 0px; font-family: &quot;Font Awesome 6 Free&quot;; -webkit-font-smoothing: antialiased; display: var(--fa-display, inline-block); font-style: normal; font-variant: normal; line-height: 1; text-rendering: auto; font-weight: 900; font-size: 1.3em; color: rgb(45, 171, 122);\"></i>Las cancelaciones deben realizarse con un aviso previo de al menos 24 horas antes de la fecha y hora del tour para ser elegibles para un reembolso completo o para transferir la reserva a otra fecha, sujeto a disponibilidad.</p><p style=\"box-sizing: border-box; margin: 0px; padding: 8px 0px 4px; font-family: Poppins, sans-serif; font-size: 16px; font-weight: 400; color: rgb(33, 37, 41); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><i class=\"fa-solid fa-circle-check espacio\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0.5em 0px 0px; font-family: &quot;Font Awesome 6 Free&quot;; -webkit-font-smoothing: antialiased; display: var(--fa-display, inline-block); font-style: normal; font-variant: normal; line-height: 1; text-rendering: auto; font-weight: 900; font-size: 1.3em; color: rgb(45, 171, 122);\"></i>Las cancelaciones realizadas dentro de 24 horas antes del tour no son reembolsables.</p><p style=\"box-sizing: border-box; margin: 0px; padding: 8px 0px 4px; font-family: Poppins, sans-serif; font-size: 16px; font-weight: 400; color: rgb(33, 37, 41); font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; widows: 2; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: rgb(255, 255, 255); text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\"><i class=\"fa-solid fa-circle-check espacio\" style=\"box-sizing: border-box; margin: 0px; padding: 0px 0.5em 0px 0px; font-family: &quot;Font Awesome 6 Free&quot;; -webkit-font-smoothing: antialiased; display: var(--fa-display, inline-block); font-style: normal; font-variant: normal; line-height: 1; text-rendering: auto; font-weight: 900; font-size: 1.3em; color: rgb(45, 171, 122);\"></i>Las modificaciones de la reserva están sujetas a disponibilidad y pueden estar sujetas a cargos adicionales.</p>', NULL, NULL, NULL, '1', '1', '2023-06-12 02:56:41', '2023-07-13 02:52:14', NULL, NULL, NULL, NULL);

--
-- Disparadores `politicas`
--
DELIMITER $$
CREATE TRIGGER `politicas_BEFORE_INSERT` BEFORE INSERT ON `politicas` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `politicas_BEFORE_UPDATE` BEFORE UPDATE ON `politicas` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_persona`
--

CREATE TABLE `tipo_persona` (
  `idtipo_persona` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_persona`
--

INSERT INTO `tipo_persona` (`idtipo_persona`, `nombre`, `descripcion`, `estado`, `estado_delete`, `created_at`, `updated_at`, `user_trash`, `user_delete`, `user_created`, `user_updated`) VALUES
(1, 'NINGUNO', 'NINGUNO', '1', '1', '2022-09-29 20:42:25', '2022-10-07 16:24:53', 1, NULL, NULL, NULL),
(2, 'TRABAJADOR', 'tABAJADORES DE LA EMPRESA', '1', '1', '2022-09-29 20:47:35', '2023-08-23 16:58:53', NULL, NULL, NULL, 1),
(3, 'CLIENTE', 'CLIENTE DEL NEGOCIO', '1', '1', '2022-09-29 20:47:35', '2023-08-23 16:59:01', NULL, NULL, NULL, 1),
(4, 'PROVEEDOR', 'PROVEDORES DE PRODUCTO', '1', '1', '2022-10-07 04:58:29', '2023-08-23 16:59:25', NULL, NULL, 1, 1);

--
-- Disparadores `tipo_persona`
--
DELIMITER $$
CREATE TRIGGER `tipo_persona_BEFORE_INSERT` BEFORE INSERT ON `tipo_persona` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tipo_persona_BEFORE_UPDATE` BEFORE UPDATE ON `tipo_persona` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_tours`
--

CREATE TABLE `tipo_tours` (
  `idtipo_tours` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_tours`
--

INSERT INTO `tipo_tours` (`idtipo_tours`, `nombre`, `descripcion`, `estado`, `estado_delete`, `created_at`, `updated_at`, `user_trash`, `user_delete`, `user_created`, `user_updated`) VALUES
(1, 'Ninguno', NULL, '1', '1', '2023-06-02 01:38:46', '2023-06-02 01:38:46', NULL, NULL, NULL, NULL),
(2, 'Convencional', 'Para todas las personas.', '1', '1', '2023-06-02 01:39:37', '2023-07-13 01:30:28', NULL, NULL, NULL, 1),
(3, 'Económico', 'De acuerdo a tu bolsillo.', '1', '1', '2023-06-02 01:39:37', '2023-07-13 01:30:54', NULL, NULL, NULL, 1);

--
-- Disparadores `tipo_tours`
--
DELIMITER $$
CREATE TRIGGER `tipo_tours_BEFORE_INSERT` BEFORE INSERT ON `tipo_tours` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tipo_tours_BEFORE_UPDATE` BEFORE UPDATE ON `tipo_tours` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tours`
--

CREATE TABLE `tours` (
  `idtours` int(11) NOT NULL,
  `idtipo_tours` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `actividad` text DEFAULT NULL,
  `incluye` text DEFAULT NULL,
  `no_incluye` text DEFAULT NULL,
  `recomendaciones` text DEFAULT NULL,
  `duracion` varchar(100) DEFAULT NULL,
  `alojamiento` int(11) DEFAULT 0 COMMENT '0 = no incluye\\r\\n1 = incluye',
  `resumen_actividad` text DEFAULT NULL,
  `resumen_comida` text DEFAULT NULL,
  `mapa` text DEFAULT NULL,
  `costo` decimal(11,2) DEFAULT NULL,
  `estado_descuento` char(1) DEFAULT '0',
  `porcentaje_descuento` decimal(11,2) DEFAULT NULL,
  `monto_descuento` decimal(11,2) DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Disparadores `tours`
--
DELIMITER $$
CREATE TRIGGER `tours_BEFORE_INSERT` BEFORE INSERT ON `tours` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tours_BEFORE_UPDATE` BEFORE UPDATE ON `tours` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` int(11) NOT NULL,
  `idpersona` int(11) NOT NULL,
  `login` varchar(20) DEFAULT NULL,
  `password` varchar(65) DEFAULT NULL,
  `last_sesion` timestamp NULL DEFAULT NULL,
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `idpersona`, `login`, `password`, `last_sesion`, `estado`, `estado_delete`, `created_at`, `updated_at`, `user_trash`, `user_delete`, `user_created`, `user_updated`) VALUES
(1, 2, 'admin', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2023-08-25 04:35:46', '1', '1', '2022-09-20 17:43:52', '2023-08-25 06:44:26', 1, NULL, NULL, 0);

--
-- Disparadores `usuario`
--
DELIMITER $$
CREATE TRIGGER `usuario_BEFORE_INSERT` BEFORE INSERT ON `usuario` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `usuario_BEFORE_UPDATE` BEFORE UPDATE ON `usuario` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_permiso`
--

CREATE TABLE `usuario_permiso` (
  `idusuario_permiso` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idpermiso` int(11) NOT NULL,
  `estado` char(1) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuario_permiso`
--

INSERT INTO `usuario_permiso` (`idusuario_permiso`, `idusuario`, `idpermiso`, `estado`, `estado_delete`, `created_at`, `updated_at`, `user_trash`, `user_delete`, `user_created`, `user_updated`) VALUES
(209, 1, 1, '1', '1', '2023-08-23 17:44:46', '2023-08-23 17:44:46', NULL, NULL, 0, NULL),
(210, 1, 2, '1', '1', '2023-08-23 17:44:46', '2023-08-23 17:44:46', NULL, NULL, 0, NULL),
(211, 1, 3, '1', '1', '2023-08-23 17:44:46', '2023-08-23 17:44:46', NULL, NULL, 0, NULL),
(212, 1, 4, '1', '1', '2023-08-23 17:44:46', '2023-08-23 17:44:46', NULL, NULL, 0, NULL),
(213, 1, 5, '1', '1', '2023-08-23 17:44:46', '2023-08-23 17:44:46', NULL, NULL, 0, NULL),
(214, 1, 6, '1', '1', '2023-08-23 17:44:46', '2023-08-23 17:44:46', NULL, NULL, 0, NULL),
(215, 1, 7, '1', '1', '2023-08-23 17:44:46', '2023-08-23 17:44:46', NULL, NULL, 0, NULL),
(216, 1, 8, '1', '1', '2023-08-23 17:44:46', '2023-08-23 17:44:46', NULL, NULL, 0, NULL),
(217, 1, 9, '1', '1', '2023-08-23 17:44:46', '2023-08-23 17:44:46', NULL, NULL, 0, NULL),
(218, 1, 10, '1', '1', '2023-08-23 17:44:46', '2023-08-23 17:44:46', NULL, NULL, 0, NULL),
(219, 1, 11, '1', '1', '2023-08-23 17:44:46', '2023-08-23 17:44:46', NULL, NULL, 0, NULL);

--
-- Disparadores `usuario_permiso`
--
DELIMITER $$
CREATE TRIGGER `usuario_permiso_BEFORE_INSERT` BEFORE INSERT ON `usuario_permiso` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `usuario_permiso_BEFORE_UPDATE` BEFORE UPDATE ON `usuario_permiso` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_producto`
--

CREATE TABLE `venta_producto` (
  `idventa_producto` int(11) NOT NULL,
  `fecha_venta` date DEFAULT NULL,
  `establecimiento` varchar(200) DEFAULT NULL,
  `tipo_comprobante` varchar(60) DEFAULT NULL,
  `serie_comprobante` varchar(45) DEFAULT NULL,
  `val_igv` decimal(11,2) DEFAULT NULL COMMENT '0.18',
  `subtotal` decimal(11,2) DEFAULT NULL,
  `igv` decimal(11,2) DEFAULT NULL COMMENT 'subtotal * val_igv = igv',
  `total` decimal(11,2) DEFAULT NULL COMMENT 'subtotal + igv = total',
  `tipo_gravada` varchar(45) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `metodo_pago` varchar(45) DEFAULT NULL,
  `fecha_proximo_pago` date DEFAULT NULL,
  `comprobante` varchar(100) DEFAULT NULL COMMENT '.png, .doc, .pdf, etc...',
  `estado` char(10) DEFAULT '1',
  `estado_delete` char(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Disparadores `venta_producto`
--
DELIMITER $$
CREATE TRIGGER `venta_producto_BEFORE_INSERT` BEFORE INSERT ON `venta_producto` FOR EACH ROW BEGIN
SET new.created_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `venta_producto_BEFORE_UPDATE` BEFORE UPDATE ON `venta_producto` FOR EACH ROW BEGIN
SET new.updated_at = date_add(CURRENT_TIMESTAMP, interval +120 HOUR_MINUTE);
END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autoincrement_comprobante`
--
ALTER TABLE `autoincrement_comprobante`
  ADD PRIMARY KEY (`idautoincrement_comprobante`);

--
-- Indices de la tabla `bancos`
--
ALTER TABLE `bancos`
  ADD PRIMARY KEY (`idbancos`);

--
-- Indices de la tabla `bitacora_bd`
--
ALTER TABLE `bitacora_bd`
  ADD PRIMARY KEY (`idbitacora_bd`),
  ADD KEY `fk_bitacora_bd_codigo_bitacora1_idx` (`idcodigo`);

--
-- Indices de la tabla `cargo_trabajador`
--
ALTER TABLE `cargo_trabajador`
  ADD PRIMARY KEY (`idcargo_trabajador`);

--
-- Indices de la tabla `codigo_bitacora`
--
ALTER TABLE `codigo_bitacora`
  ADD PRIMARY KEY (`idcodigo`);

--
-- Indices de la tabla `comentario_paquete`
--
ALTER TABLE `comentario_paquete`
  ADD PRIMARY KEY (`idcomentario_paquete`),
  ADD KEY `fk_comentario_paquete_paquete1_idx` (`idpaquete`);

--
-- Indices de la tabla `comentario_tours`
--
ALTER TABLE `comentario_tours`
  ADD PRIMARY KEY (`idcomentario_tours`),
  ADD KEY `fk_comentario_tours_tours1_idx` (`idtours`);

--
-- Indices de la tabla `detalle_habitacion`
--
ALTER TABLE `detalle_habitacion`
  ADD PRIMARY KEY (`iddetalle_habitacion`),
  ADD KEY `fk_detalle_habitacion_habitacion1_idx` (`idhabitacion`);

--
-- Indices de la tabla `galeria_hotel`
--
ALTER TABLE `galeria_hotel`
  ADD PRIMARY KEY (`idgaleria_hotel`),
  ADD KEY `fk_galeria_hotel_hoteles1_idx` (`idhoteles`);

--
-- Indices de la tabla `galeria_paquete`
--
ALTER TABLE `galeria_paquete`
  ADD PRIMARY KEY (`idgaleria_paquete`),
  ADD KEY `fk_galeria_paquete_paquete1_idx` (`idpaquete`);

--
-- Indices de la tabla `galeria_tours`
--
ALTER TABLE `galeria_tours`
  ADD PRIMARY KEY (`idgaleria_tours`),
  ADD KEY `fk_galeria_tours_tours1_idx` (`idtours`);

--
-- Indices de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD PRIMARY KEY (`idhabitacion`),
  ADD KEY `fk_habitacion_hoteles1_idx` (`idhoteles`);

--
-- Indices de la tabla `hoteles`
--
ALTER TABLE `hoteles`
  ADD PRIMARY KEY (`idhoteles`);

--
-- Indices de la tabla `instalaciones_hotel`
--
ALTER TABLE `instalaciones_hotel`
  ADD PRIMARY KEY (`idinstalaciones_hotel`),
  ADD KEY `fk_instalaciones_hotel_hoteles1_idx` (`idhoteles`);

--
-- Indices de la tabla `itinerario`
--
ALTER TABLE `itinerario`
  ADD PRIMARY KEY (`iditinerario`),
  ADD KEY `fk_itinerario_paquete1_idx` (`idpaquete`),
  ADD KEY `fk_itinerario_tours1_idx` (`idtours`);

--
-- Indices de la tabla `mes_pago_trabajador`
--
ALTER TABLE `mes_pago_trabajador`
  ADD PRIMARY KEY (`idmes_pago_trabajador`),
  ADD KEY `fk_mes_pago_trabajador_persona1_idx` (`idpersona`);

--
-- Indices de la tabla `nosotros`
--
ALTER TABLE `nosotros`
  ADD PRIMARY KEY (`idnosotros`);

--
-- Indices de la tabla `otro_ingreso`
--
ALTER TABLE `otro_ingreso`
  ADD PRIMARY KEY (`idotro_ingreso`),
  ADD KEY `fk_otro_ingreso_persona1_idx` (`idpersona`);

--
-- Indices de la tabla `pago_trabajador`
--
ALTER TABLE `pago_trabajador`
  ADD PRIMARY KEY (`idpago_trabajador`),
  ADD KEY `fk_pago_trabajador_mes_pago_trabajador1_idx` (`idmes_pago_trabajador`);

--
-- Indices de la tabla `paquete`
--
ALTER TABLE `paquete`
  ADD PRIMARY KEY (`idpaquete`);

--
-- Indices de la tabla `pedido_paquete`
--
ALTER TABLE `pedido_paquete`
  ADD PRIMARY KEY (`idpedido_paquete`),
  ADD KEY `fk_pedido_paquete_paquete1_idx` (`idpaquete`);

--
-- Indices de la tabla `pedido_tours`
--
ALTER TABLE `pedido_tours`
  ADD PRIMARY KEY (`idpedido_tours`),
  ADD KEY `fk_pedido_tours_tours1_idx` (`idtours`);

--
-- Indices de la tabla `permiso`
--
ALTER TABLE `permiso`
  ADD PRIMARY KEY (`idpermiso`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idpersona`),
  ADD KEY `fk_persona_tipo_persona1_idx` (`idtipo_persona`),
  ADD KEY `fk_persona_bancos1_idx` (`idbancos`),
  ADD KEY `fk_persona_cargo_trabajador1_idx` (`idcargo_trabajador`);

--
-- Indices de la tabla `politicas`
--
ALTER TABLE `politicas`
  ADD PRIMARY KEY (`idpoliticas`);

--
-- Indices de la tabla `tipo_persona`
--
ALTER TABLE `tipo_persona`
  ADD PRIMARY KEY (`idtipo_persona`);

--
-- Indices de la tabla `tipo_tours`
--
ALTER TABLE `tipo_tours`
  ADD PRIMARY KEY (`idtipo_tours`);

--
-- Indices de la tabla `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`idtours`),
  ADD KEY `fk_tours_tipo_tours1_idx` (`idtipo_tours`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `fk_usuario_persona1_idx` (`idpersona`);

--
-- Indices de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD PRIMARY KEY (`idusuario_permiso`),
  ADD KEY `fk_usuario_permiso_usuario1_idx` (`idusuario`),
  ADD KEY `fk_usuario_permiso_permiso1_idx` (`idpermiso`);

--
-- Indices de la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  ADD PRIMARY KEY (`idventa_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autoincrement_comprobante`
--
ALTER TABLE `autoincrement_comprobante`
  MODIFY `idautoincrement_comprobante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `bancos`
--
ALTER TABLE `bancos`
  MODIFY `idbancos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `bitacora_bd`
--
ALTER TABLE `bitacora_bd`
  MODIFY `idbitacora_bd` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cargo_trabajador`
--
ALTER TABLE `cargo_trabajador`
  MODIFY `idcargo_trabajador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `codigo_bitacora`
--
ALTER TABLE `codigo_bitacora`
  MODIFY `idcodigo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `comentario_paquete`
--
ALTER TABLE `comentario_paquete`
  MODIFY `idcomentario_paquete` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comentario_tours`
--
ALTER TABLE `comentario_tours`
  MODIFY `idcomentario_tours` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_habitacion`
--
ALTER TABLE `detalle_habitacion`
  MODIFY `iddetalle_habitacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `galeria_hotel`
--
ALTER TABLE `galeria_hotel`
  MODIFY `idgaleria_hotel` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `galeria_paquete`
--
ALTER TABLE `galeria_paquete`
  MODIFY `idgaleria_paquete` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `galeria_tours`
--
ALTER TABLE `galeria_tours`
  MODIFY `idgaleria_tours` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `habitacion`
--
ALTER TABLE `habitacion`
  MODIFY `idhabitacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `hoteles`
--
ALTER TABLE `hoteles`
  MODIFY `idhoteles` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `instalaciones_hotel`
--
ALTER TABLE `instalaciones_hotel`
  MODIFY `idinstalaciones_hotel` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `itinerario`
--
ALTER TABLE `itinerario`
  MODIFY `iditinerario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mes_pago_trabajador`
--
ALTER TABLE `mes_pago_trabajador`
  MODIFY `idmes_pago_trabajador` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `nosotros`
--
ALTER TABLE `nosotros`
  MODIFY `idnosotros` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `otro_ingreso`
--
ALTER TABLE `otro_ingreso`
  MODIFY `idotro_ingreso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pago_trabajador`
--
ALTER TABLE `pago_trabajador`
  MODIFY `idpago_trabajador` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paquete`
--
ALTER TABLE `paquete`
  MODIFY `idpaquete` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido_paquete`
--
ALTER TABLE `pedido_paquete`
  MODIFY `idpedido_paquete` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido_tours`
--
ALTER TABLE `pedido_tours`
  MODIFY `idpedido_tours` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idpersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `politicas`
--
ALTER TABLE `politicas`
  MODIFY `idpoliticas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_persona`
--
ALTER TABLE `tipo_persona`
  MODIFY `idtipo_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tipo_tours`
--
ALTER TABLE `tipo_tours`
  MODIFY `idtipo_tours` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tours`
--
ALTER TABLE `tours`
  MODIFY `idtours` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  MODIFY `idusuario_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT de la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  MODIFY `idventa_producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bitacora_bd`
--
ALTER TABLE `bitacora_bd`
  ADD CONSTRAINT `fk_bitacora_bd_codigo_bitacora1` FOREIGN KEY (`idcodigo`) REFERENCES `codigo_bitacora` (`idcodigo`);

--
-- Filtros para la tabla `comentario_paquete`
--
ALTER TABLE `comentario_paquete`
  ADD CONSTRAINT `fk_comentario_paquete_paquete1` FOREIGN KEY (`idpaquete`) REFERENCES `paquete` (`idpaquete`);

--
-- Filtros para la tabla `comentario_tours`
--
ALTER TABLE `comentario_tours`
  ADD CONSTRAINT `fk_comentario_tours_tours1` FOREIGN KEY (`idtours`) REFERENCES `tours` (`idtours`);

--
-- Filtros para la tabla `detalle_habitacion`
--
ALTER TABLE `detalle_habitacion`
  ADD CONSTRAINT `fk_detalle_habitacion_habitacion1` FOREIGN KEY (`idhabitacion`) REFERENCES `habitacion` (`idhabitacion`);

--
-- Filtros para la tabla `galeria_hotel`
--
ALTER TABLE `galeria_hotel`
  ADD CONSTRAINT `fk_galeria_hotel_hoteles1` FOREIGN KEY (`idhoteles`) REFERENCES `hoteles` (`idhoteles`);

--
-- Filtros para la tabla `galeria_paquete`
--
ALTER TABLE `galeria_paquete`
  ADD CONSTRAINT `fk_galeria_paquete_paquete1` FOREIGN KEY (`idpaquete`) REFERENCES `paquete` (`idpaquete`);

--
-- Filtros para la tabla `galeria_tours`
--
ALTER TABLE `galeria_tours`
  ADD CONSTRAINT `fk_galeria_tours_tours1` FOREIGN KEY (`idtours`) REFERENCES `tours` (`idtours`);

--
-- Filtros para la tabla `habitacion`
--
ALTER TABLE `habitacion`
  ADD CONSTRAINT `fk_habitacion_hoteles1` FOREIGN KEY (`idhoteles`) REFERENCES `hoteles` (`idhoteles`);

--
-- Filtros para la tabla `instalaciones_hotel`
--
ALTER TABLE `instalaciones_hotel`
  ADD CONSTRAINT `fk_instalaciones_hotel_hoteles1` FOREIGN KEY (`idhoteles`) REFERENCES `hoteles` (`idhoteles`);

--
-- Filtros para la tabla `itinerario`
--
ALTER TABLE `itinerario`
  ADD CONSTRAINT `fk_itinerario_paquete1` FOREIGN KEY (`idpaquete`) REFERENCES `paquete` (`idpaquete`),
  ADD CONSTRAINT `fk_itinerario_tours1` FOREIGN KEY (`idtours`) REFERENCES `tours` (`idtours`);

--
-- Filtros para la tabla `mes_pago_trabajador`
--
ALTER TABLE `mes_pago_trabajador`
  ADD CONSTRAINT `fk_mes_pago_trabajador_persona1` FOREIGN KEY (`idpersona`) REFERENCES `persona` (`idpersona`);

--
-- Filtros para la tabla `otro_ingreso`
--
ALTER TABLE `otro_ingreso`
  ADD CONSTRAINT `fk_otro_ingreso_persona1` FOREIGN KEY (`idpersona`) REFERENCES `persona` (`idpersona`);

--
-- Filtros para la tabla `pago_trabajador`
--
ALTER TABLE `pago_trabajador`
  ADD CONSTRAINT `fk_pago_trabajador_mes_pago_trabajador1` FOREIGN KEY (`idmes_pago_trabajador`) REFERENCES `mes_pago_trabajador` (`idmes_pago_trabajador`);

--
-- Filtros para la tabla `pedido_paquete`
--
ALTER TABLE `pedido_paquete`
  ADD CONSTRAINT `fk_pedido_paquete_paquete1` FOREIGN KEY (`idpaquete`) REFERENCES `paquete` (`idpaquete`);

--
-- Filtros para la tabla `pedido_tours`
--
ALTER TABLE `pedido_tours`
  ADD CONSTRAINT `fk_pedido_tours_tours1` FOREIGN KEY (`idtours`) REFERENCES `tours` (`idtours`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `fk_persona_bancos1` FOREIGN KEY (`idbancos`) REFERENCES `bancos` (`idbancos`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_persona_cargo_trabajador1` FOREIGN KEY (`idcargo_trabajador`) REFERENCES `cargo_trabajador` (`idcargo_trabajador`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_persona_tipo_persona1` FOREIGN KEY (`idtipo_persona`) REFERENCES `tipo_persona` (`idtipo_persona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tours`
--
ALTER TABLE `tours`
  ADD CONSTRAINT `fk_tours_tipo_tours1` FOREIGN KEY (`idtipo_tours`) REFERENCES `tipo_tours` (`idtipo_tours`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_persona1` FOREIGN KEY (`idpersona`) REFERENCES `persona` (`idpersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  ADD CONSTRAINT `fk_usuario_permiso_permiso1` FOREIGN KEY (`idpermiso`) REFERENCES `permiso` (`idpermiso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_permiso_usuario1` FOREIGN KEY (`idusuario`) REFERENCES `usuario` (`idusuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
