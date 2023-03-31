-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-01-2023 a las 23:24:47
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `admin_integra`
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
  `venta_cafe_nv` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `autoincrement_comprobante`
--

INSERT INTO `autoincrement_comprobante` (`idautoincrement_comprobante`, `compra_producto_f`, `compra_producto_b`, `compra_producto_nv`, `venta_producto_f`, `venta_producto_b`, `venta_producto_nv`, `compra_cafe_f`, `compra_cafe_b`, `compra_cafe_nv`, `venta_cafe_f`, `venta_cafe_n`, `venta_cafe_nv`) VALUES
(1, 0, 0, 0, 0, 3, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bancos`
--

CREATE TABLE `bancos` (
  `idbancos` int(11) NOT NULL,
  `nombre` varchar(65) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `alias` varchar(65) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `formato_cta` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `formato_cci` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `formato_detracciones` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `icono` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL COMMENT '.png, .svg, jpg, etc...',
  `estado` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `estado_delete` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
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
(1, 'SIN BANCO', NULL, '00-00-00-00', '00-00-00-00', '00-00-00-00', 'logo-sin-banco.svg', '1', '1', '2022-09-27 00:20:47', '2022-09-27 00:20:47', NULL, NULL, NULL, NULL),
(2, 'BBVA', NULL, '04-04-10-00', '03-03-12-02', '04-04-04-04', 'logo-bbva.svg', '1', '1', '2022-09-27 00:20:47', '2022-09-27 00:20:47', NULL, NULL, NULL, NULL),
(3, 'SCOTIA BANK', NULL, '04-04-10-00', '04-04-10-00', '04-04-04-04', 'logo-scotiabank.svg', '1', '1', '2022-09-27 00:20:47', '2022-09-27 00:20:47', NULL, NULL, NULL, NULL),
(4, 'INTERBANK', NULL, '04-04-10-00', '04-04-10-00', '04-04-04-04', 'icono-interbank.svg', '1', '1', '2022-09-27 00:20:47', '2022-09-27 00:20:47', NULL, NULL, NULL, NULL),
(5, 'NACIÓN', NULL, '04-04-10-00', '04-04-10-00', '04-04-04-04', 'icono-banco-nacion.svg', '1', '1', '2022-09-27 00:20:47', '2022-09-27 00:20:47', NULL, NULL, NULL, NULL),
(6, 'CAJA PIURA', NULL, '02-03-06-00', '10-00-00-00', '04-04-04-04', 'icono-caja-piura.svg', '1', '1', '2022-09-27 00:20:47', '2022-09-27 00:20:47', NULL, NULL, NULL, NULL),
(7, 'BCP', '', '03-08-01-02', '03-03-12-02', '04-04-04-04', 'icono-bcp.svg', '1', '1', '2022-09-27 00:20:47', '2022-09-27 00:20:47', NULL, NULL, NULL, NULL),
(8, '11111', 'aaa', '23-45-43-54', '00-00-00-00', '00-00-00-00', '', '1', '1', '2022-09-27 00:20:47', '2023-01-13 16:50:19', 6, 6, 6, 1),
(9, 'rrrrr', 'rrrrr', '33-33-33-34', '03-07-00-00', '00-00-00-00', '', '1', '0', '2023-01-13 16:50:54', '2023-01-13 16:51:08', NULL, 1, 1, NULL);

--
-- Disparadores `bancos`
--
DELIMITER $$
CREATE TRIGGER `bancos_BEFORE_UPDATE` BEFORE UPDATE ON `bancos` FOR EACH ROW BEGIN
SET new.updated_at = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora_bd`
--

CREATE TABLE `bitacora_bd` (
  `idbitacora_bd` int(11) NOT NULL,
  `nombre_tabla` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `id_tabla` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `accion` varchar(200) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `id_user` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `estado_delete` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `bitacora_bd`
--

INSERT INTO `bitacora_bd` (`idbitacora_bd`, `nombre_tabla`, `id_tabla`, `accion`, `id_user`, `estado`, `estado_delete`, `created_at`, `updated_at`) VALUES
(1, 'usuario', '1', 'Editamos los campos del usuario', '1', '1', '1', '2022-09-20 18:05:32', '2022-09-20 18:05:32'),
(2, 'usuario_permiso', '', 'Borando definitivamente registros de permisos para volver a registrar', '1', '1', '1', '2022-09-20 18:05:32', '2022-09-20 18:05:32'),
(3, 'trabajador', '3', 'Registro Nuevo Trabajador', '1', '1', '1', '2022-09-27 01:25:50', '2022-09-27 01:25:50'),
(4, 'trabajador', '4', 'Registro Nuevo Trabajador', '1', '1', '1', '2022-09-27 01:30:05', '2022-09-27 01:30:05'),
(5, 'trabajador', '5', 'Registro Nuevo Trabajador', '1', '1', '1', '2022-09-27 05:49:38', '2022-09-27 05:49:38'),
(6, 'trabajador', '6', 'Registro Nuevo Trabajador', '1', '1', '1', '2022-09-27 05:55:01', '2022-09-27 05:55:01'),
(7, 'trabajador', '7', 'Registro Nuevo Trabajador', '1', '1', '1', '2022-09-27 06:10:31', '2022-09-27 06:10:31'),
(8, 'trabajador', '8', 'Registro Nuevo Trabajador', '1', '1', '1', '2022-09-27 06:11:55', '2022-09-27 06:11:55'),
(9, 'trabajador', '12', 'Registro Nuevo Trabajador', '1', '1', '1', '2022-09-27 06:29:31', '2022-09-27 06:29:31'),
(10, 'trabajador', '13', 'Registro Nuevo Trabajador', '1', '1', '1', '2022-09-27 06:36:17', '2022-09-27 06:36:17'),
(11, 'trabajador', '14', 'Registro Nuevo Trabajador', '1', '1', '1', '2022-09-27 06:46:29', '2022-09-27 06:46:29'),
(12, 'trabajador', '15', 'Registro Nuevo Trabajador', '1', '1', '1', '2022-09-27 07:15:57', '2022-09-27 07:15:57'),
(13, 'trabajador', '3', 'Editamos el registro Trabajador', '1', '1', '1', '2022-09-27 14:51:10', '2022-09-27 14:51:10'),
(14, 'trabajador', '3', 'Editamos el registro Trabajador', '1', '1', '1', '2022-09-27 14:53:24', '2022-09-27 14:53:24'),
(15, 'trabajador', '.3.', 'Desativar el registro Trabajador', '1', '1', '1', '2022-09-27 15:05:02', '2022-09-27 15:05:02'),
(16, 'trabajador', '.13.', 'Eliminar registro Trabajador', '1', '1', '1', '2022-09-27 15:05:06', '2022-09-27 15:05:06'),
(17, 'trabajador', '.5.', 'Desativar el registro Trabajador', '1', '1', '1', '2022-09-27 15:10:35', '2022-09-27 15:10:35'),
(18, 'trabajador', '.7.', 'Eliminar registro Trabajador', '1', '1', '1', '2022-09-27 15:10:43', '2022-09-27 15:10:43'),
(19, 'trabajador', '.4.', 'Desativar el registro Trabajador', '1', '1', '1', '2022-09-27 15:10:46', '2022-09-27 15:10:46'),
(20, 'trabajador', '15', 'Editamos el registro Trabajador', '1', '1', '1', '2022-09-27 15:20:20', '2022-09-27 15:20:20'),
(21, 'trabajador', '15', 'Editamos el registro Trabajador', '1', '1', '1', '2022-09-27 15:21:58', '2022-09-27 15:21:58'),
(22, 'trabajador', '16', 'Registro Nuevo Trabajador', '1', '1', '1', '2022-09-28 18:01:22', '2022-09-28 18:01:22'),
(23, 'trabajador', '19', 'Registro Nuevo Trabajador', '1', '1', '1', '2022-09-28 18:08:48', '2022-09-28 18:08:48'),
(24, 'usuario', '2', 'Registrar', '1', '1', '1', '2022-09-28 18:10:30', '2022-09-28 18:10:30'),
(25, 'usuario', '3', 'Registrar', '1', '1', '1', '2022-09-28 18:10:44', '2022-09-28 18:10:44'),
(26, 'usuario', '4', 'Registrar', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(27, 'usuario_permiso', '51', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(28, 'usuario_permiso', '52', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(29, 'usuario_permiso', '53', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(30, 'usuario_permiso', '54', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(31, 'usuario_permiso', '55', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(32, 'usuario_permiso', '56', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(33, 'usuario_permiso', '57', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(34, 'usuario_permiso', '58', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(35, 'usuario_permiso', '59', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(36, 'usuario_permiso', '60', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(37, 'usuario_permiso', '61', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(38, 'usuario_permiso', '62', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(39, 'usuario_permiso', '63', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(40, 'usuario_permiso', '64', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(41, 'usuario_permiso', '65', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(42, 'usuario_permiso', '66', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(43, 'usuario_permiso', '67', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(44, 'usuario_permiso', '68', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(45, 'usuario_permiso', '69', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(46, 'usuario_permiso', '70', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(47, 'usuario_permiso', '71', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(48, 'usuario_permiso', '72', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(49, 'usuario_permiso', '73', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(50, 'usuario_permiso', '74', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(51, 'usuario_permiso', '75', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(52, 'usuario_permiso', '76', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(53, 'usuario_permiso', '77', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(54, 'usuario_permiso', '78', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(55, 'usuario_permiso', '79', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(56, 'usuario_permiso', '80', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(57, 'usuario_permiso', '81', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(58, 'usuario_permiso', '82', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(59, 'usuario_permiso', '83', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:36:47', '2022-09-28 19:36:47'),
(60, 'usuario', '5', 'Registrar', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(61, 'usuario_permiso', '84', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(62, 'usuario_permiso', '85', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(63, 'usuario_permiso', '86', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(64, 'usuario_permiso', '87', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(65, 'usuario_permiso', '88', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(66, 'usuario_permiso', '89', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(67, 'usuario_permiso', '90', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(68, 'usuario_permiso', '91', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(69, 'usuario_permiso', '92', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(70, 'usuario_permiso', '93', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(71, 'usuario_permiso', '94', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(72, 'usuario_permiso', '95', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(73, 'usuario_permiso', '96', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(74, 'usuario_permiso', '97', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(75, 'usuario_permiso', '98', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(76, 'usuario_permiso', '99', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(77, 'usuario_permiso', '100', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(78, 'usuario_permiso', '101', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(79, 'usuario_permiso', '102', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(80, 'usuario_permiso', '103', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(81, 'usuario_permiso', '104', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(82, 'usuario_permiso', '105', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(83, 'usuario_permiso', '106', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(84, 'usuario_permiso', '107', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(85, 'usuario_permiso', '108', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(86, 'usuario_permiso', '109', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(87, 'usuario_permiso', '110', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(88, 'usuario_permiso', '111', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(89, 'usuario_permiso', '112', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(90, 'usuario_permiso', '113', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(91, 'usuario_permiso', '114', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(92, 'usuario_permiso', '115', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(93, 'usuario_permiso', '116', 'Registrar permisos', '1', '1', '1', '2022-09-28 19:38:19', '2022-09-28 19:38:19'),
(94, 'usuario', '3', 'Editamos los campos del usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(95, 'usuario_permiso', '117', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(96, 'usuario_permiso', '118', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(97, 'usuario_permiso', '119', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(98, 'usuario_permiso', '120', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(99, 'usuario_permiso', '121', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(100, 'usuario_permiso', '122', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(101, 'usuario_permiso', '123', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(102, 'usuario_permiso', '124', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(103, 'usuario_permiso', '125', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(104, 'usuario_permiso', '126', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(105, 'usuario_permiso', '127', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(106, 'usuario_permiso', '128', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(107, 'usuario_permiso', '129', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(108, 'usuario_permiso', '130', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(109, 'usuario_permiso', '131', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(110, 'usuario_permiso', '132', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(111, 'usuario_permiso', '133', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(112, 'usuario_permiso', '134', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(113, 'usuario_permiso', '135', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(114, 'usuario_permiso', '136', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(115, 'usuario_permiso', '137', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(116, 'usuario_permiso', '138', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(117, 'usuario_permiso', '139', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(118, 'usuario_permiso', '140', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(119, 'usuario_permiso', '141', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(120, 'usuario_permiso', '142', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(121, 'usuario_permiso', '143', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(122, 'usuario_permiso', '144', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(123, 'usuario_permiso', '145', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(124, 'usuario_permiso', '146', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(125, 'usuario_permiso', '147', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(126, 'usuario_permiso', '148', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(127, 'usuario_permiso', '149', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:22', '2022-09-29 01:30:22'),
(128, 'usuario', '3', 'Editamos los campos del usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(129, 'usuario_permiso', '150', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(130, 'usuario_permiso', '151', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(131, 'usuario_permiso', '152', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(132, 'usuario_permiso', '153', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(133, 'usuario_permiso', '154', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(134, 'usuario_permiso', '155', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(135, 'usuario_permiso', '156', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(136, 'usuario_permiso', '157', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(137, 'usuario_permiso', '158', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(138, 'usuario_permiso', '159', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(139, 'usuario_permiso', '160', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(140, 'usuario_permiso', '161', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(141, 'usuario_permiso', '162', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(142, 'usuario_permiso', '163', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(143, 'usuario_permiso', '164', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(144, 'usuario_permiso', '165', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(145, 'usuario_permiso', '166', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(146, 'usuario_permiso', '167', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(147, 'usuario_permiso', '168', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(148, 'usuario_permiso', '169', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(149, 'usuario_permiso', '170', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(150, 'usuario_permiso', '171', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(151, 'usuario_permiso', '172', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(152, 'usuario_permiso', '173', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(153, 'usuario_permiso', '174', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(154, 'usuario_permiso', '175', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(155, 'usuario_permiso', '176', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(156, 'usuario_permiso', '177', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(157, 'usuario_permiso', '178', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(158, 'usuario_permiso', '179', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(159, 'usuario_permiso', '180', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(160, 'usuario_permiso', '181', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(161, 'usuario_permiso', '182', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:30:59', '2022-09-29 01:30:59'),
(162, 'usuario', '3', 'Editamos los campos del usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(163, 'usuario_permiso', '183', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(164, 'usuario_permiso', '184', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(165, 'usuario_permiso', '185', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(166, 'usuario_permiso', '186', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(167, 'usuario_permiso', '187', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(168, 'usuario_permiso', '188', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(169, 'usuario_permiso', '189', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(170, 'usuario_permiso', '190', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(171, 'usuario_permiso', '191', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(172, 'usuario_permiso', '192', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(173, 'usuario_permiso', '193', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(174, 'usuario_permiso', '194', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(175, 'usuario_permiso', '195', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(176, 'usuario_permiso', '196', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(177, 'usuario_permiso', '197', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(178, 'usuario_permiso', '198', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(179, 'usuario_permiso', '199', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(180, 'usuario_permiso', '200', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(181, 'usuario_permiso', '201', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(182, 'usuario_permiso', '202', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(183, 'usuario_permiso', '203', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(184, 'usuario_permiso', '204', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(185, 'usuario_permiso', '205', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(186, 'usuario_permiso', '206', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(187, 'usuario_permiso', '207', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(188, 'usuario_permiso', '208', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(189, 'usuario_permiso', '209', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(190, 'usuario_permiso', '210', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(191, 'usuario_permiso', '211', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(192, 'usuario_permiso', '212', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(193, 'usuario_permiso', '213', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(194, 'usuario_permiso', '214', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(195, 'usuario_permiso', '215', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 01:31:21', '2022-09-29 01:31:21'),
(196, 'usuario', '3', 'Editamos los campos del usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(197, 'usuario_permiso', '216', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(198, 'usuario_permiso', '217', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(199, 'usuario_permiso', '218', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(200, 'usuario_permiso', '219', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(201, 'usuario_permiso', '220', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(202, 'usuario_permiso', '221', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(203, 'usuario_permiso', '222', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(204, 'usuario_permiso', '223', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(205, 'usuario_permiso', '224', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(206, 'usuario_permiso', '225', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(207, 'usuario_permiso', '226', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(208, 'usuario_permiso', '227', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(209, 'usuario_permiso', '228', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(210, 'usuario_permiso', '229', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(211, 'usuario_permiso', '230', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(212, 'usuario_permiso', '231', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(213, 'usuario_permiso', '232', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(214, 'usuario_permiso', '233', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(215, 'usuario_permiso', '234', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(216, 'usuario_permiso', '235', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(217, 'usuario_permiso', '236', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(218, 'usuario_permiso', '237', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(219, 'usuario_permiso', '238', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(220, 'usuario_permiso', '239', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(221, 'usuario_permiso', '240', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(222, 'usuario_permiso', '241', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(223, 'usuario_permiso', '242', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(224, 'usuario_permiso', '243', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(225, 'usuario_permiso', '244', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(226, 'usuario_permiso', '245', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(227, 'usuario_permiso', '246', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(228, 'usuario_permiso', '247', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(229, 'usuario_permiso', '248', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 02:13:10', '2022-09-29 02:13:10'),
(230, 'usuario', '5', 'Editamos los campos del usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(231, 'usuario_permiso', '249', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(232, 'usuario_permiso', '250', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(233, 'usuario_permiso', '251', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(234, 'usuario_permiso', '252', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(235, 'usuario_permiso', '253', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(236, 'usuario_permiso', '254', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(237, 'usuario_permiso', '255', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(238, 'usuario_permiso', '256', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(239, 'usuario_permiso', '257', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(240, 'usuario_permiso', '258', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(241, 'usuario_permiso', '259', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(242, 'usuario_permiso', '260', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(243, 'usuario_permiso', '261', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(244, 'usuario_permiso', '262', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(245, 'usuario_permiso', '263', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(246, 'usuario_permiso', '264', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(247, 'usuario_permiso', '265', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(248, 'usuario_permiso', '266', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(249, 'usuario_permiso', '267', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(250, 'usuario_permiso', '268', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(251, 'usuario_permiso', '269', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(252, 'usuario_permiso', '270', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(253, 'usuario_permiso', '271', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(254, 'usuario_permiso', '272', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(255, 'usuario_permiso', '273', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(256, 'usuario_permiso', '274', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(257, 'usuario_permiso', '275', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(258, 'usuario_permiso', '276', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(259, 'usuario_permiso', '277', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(260, 'usuario_permiso', '278', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(261, 'usuario_permiso', '279', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(262, 'usuario_permiso', '280', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(263, 'usuario_permiso', '281', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 04:20:38', '2022-09-29 04:20:38'),
(264, 'usuario', '5', 'Editamos los campos del usuario', '1', '1', '1', '2022-09-29 05:32:09', '2022-09-29 05:32:09'),
(265, 'usuario_permiso', '282', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 05:32:09', '2022-09-29 05:32:09'),
(266, 'usuario_permiso', '283', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 05:32:09', '2022-09-29 05:32:09'),
(267, 'usuario', '5', 'Editamos los campos del usuario', '1', '1', '1', '2022-09-29 05:32:40', '2022-09-29 05:32:40'),
(268, 'usuario_permiso', '284', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 05:32:40', '2022-09-29 05:32:40'),
(269, 'usuario_permiso', '285', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 05:32:40', '2022-09-29 05:32:40'),
(270, 'usuario', '5', 'Editamos los campos del usuario', '1', '1', '1', '2022-09-29 06:23:46', '2022-09-29 06:23:46'),
(271, 'usuario_permiso', '', 'Borando definitivamente registros de permisos para volver a registrar', '1', '1', '1', '2022-09-29 06:23:46', '2022-09-29 06:23:46'),
(272, 'usuario', '5', 'Editamos los campos del usuario', '1', '1', '1', '2022-09-29 06:23:56', '2022-09-29 06:23:56'),
(273, 'usuario_permiso', '286', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:23:56', '2022-09-29 06:23:56'),
(274, 'usuario_permiso', '287', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:23:56', '2022-09-29 06:23:56'),
(275, 'usuario', '5', 'Editamos los campos del usuario', '1', '1', '1', '2022-09-29 06:26:38', '2022-09-29 06:26:38'),
(276, 'usuario_permiso', '288', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:26:38', '2022-09-29 06:26:38'),
(277, 'usuario_permiso', '289', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:26:38', '2022-09-29 06:26:38'),
(278, 'usuario', '3', 'Editamos los campos del usuario', '1', '1', '1', '2022-09-29 06:34:19', '2022-09-29 06:34:19'),
(279, 'usuario_permiso', '', 'Borando definitivamente registros de permisos para volver a registrar', '1', '1', '1', '2022-09-29 06:34:19', '2022-09-29 06:34:19'),
(280, 'usuario', '3', 'Editamos los campos del usuario', '1', '1', '1', '2022-09-29 06:34:42', '2022-09-29 06:34:42'),
(281, 'usuario_permiso', '290', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:34:42', '2022-09-29 06:34:42'),
(282, 'usuario_permiso', '291', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:34:42', '2022-09-29 06:34:42'),
(283, 'usuario_permiso', '292', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:34:42', '2022-09-29 06:34:42'),
(284, 'usuario_permiso', '293', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:34:42', '2022-09-29 06:34:42'),
(285, 'usuario', '3', 'Editamos los campos del usuario', '1', '1', '1', '2022-09-29 06:36:45', '2022-09-29 06:36:45'),
(286, 'usuario_permiso', '294', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:36:45', '2022-09-29 06:36:45'),
(287, 'usuario_permiso', '295', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:36:45', '2022-09-29 06:36:45'),
(288, 'usuario_permiso', '296', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:36:45', '2022-09-29 06:36:45'),
(289, 'usuario', '3', 'Editamos los campos del usuario', '1', '1', '1', '2022-09-29 06:36:54', '2022-09-29 06:36:54'),
(290, 'usuario_permiso', '297', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:36:54', '2022-09-29 06:36:54'),
(291, 'usuario_permiso', '298', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:36:54', '2022-09-29 06:36:54'),
(292, 'usuario', '3', 'Editamos los campos del usuario', '1', '1', '1', '2022-09-29 06:38:33', '2022-09-29 06:38:33'),
(293, 'usuario_permiso', '299', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:38:33', '2022-09-29 06:38:33'),
(294, 'usuario_permiso', '300', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:38:33', '2022-09-29 06:38:33'),
(295, 'usuario', '5', 'Editamos los campos del usuario', '1', '1', '1', '2022-09-29 06:54:55', '2022-09-29 06:54:55'),
(296, 'usuario_permiso', '301', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:54:55', '2022-09-29 06:54:55'),
(297, 'usuario_permiso', '302', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:54:55', '2022-09-29 06:54:55'),
(298, 'usuario_permiso', '303', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:54:55', '2022-09-29 06:54:55'),
(299, 'usuario_permiso', '304', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:54:55', '2022-09-29 06:54:55'),
(300, 'usuario', '5', 'Editamos los campos del usuario', '1', '1', '1', '2022-09-29 06:55:06', '2022-09-29 06:55:06'),
(301, 'usuario_permiso', '305', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:55:06', '2022-09-29 06:55:06'),
(302, 'usuario_permiso', '306', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:55:06', '2022-09-29 06:55:06'),
(303, 'usuario_permiso', '307', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:55:06', '2022-09-29 06:55:06'),
(304, 'usuario_permiso', '308', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:55:06', '2022-09-29 06:55:06'),
(305, 'usuario_permiso', '309', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:55:06', '2022-09-29 06:55:06'),
(306, 'usuario_permiso', '310', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:55:06', '2022-09-29 06:55:06'),
(307, 'usuario', '5', 'Editamos los campos del usuario', '1', '1', '1', '2022-09-29 06:55:14', '2022-09-29 06:55:14'),
(308, 'usuario_permiso', '311', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:55:14', '2022-09-29 06:55:14'),
(309, 'usuario_permiso', '312', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:55:14', '2022-09-29 06:55:14'),
(310, 'usuario_permiso', '313', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:55:14', '2022-09-29 06:55:14'),
(311, 'usuario_permiso', '314', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:55:14', '2022-09-29 06:55:14'),
(312, 'usuario', '5', 'Editamos los campos del usuario', '1', '1', '1', '2022-09-29 06:58:43', '2022-09-29 06:58:43'),
(313, 'usuario_permiso', '315', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:58:43', '2022-09-29 06:58:43'),
(314, 'usuario_permiso', '316', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:58:43', '2022-09-29 06:58:43'),
(315, 'usuario_permiso', '317', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:58:43', '2022-09-29 06:58:43'),
(316, 'usuario_permiso', '318', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:58:43', '2022-09-29 06:58:43'),
(317, 'usuario', '5', 'Editamos los campos del usuario', '1', '1', '1', '2022-09-29 06:58:52', '2022-09-29 06:58:52'),
(318, 'usuario_permiso', '319', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:58:52', '2022-09-29 06:58:52'),
(319, 'usuario_permiso', '320', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:58:52', '2022-09-29 06:58:52'),
(320, 'usuario_permiso', '321', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:58:52', '2022-09-29 06:58:52'),
(321, 'usuario_permiso', '322', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:58:52', '2022-09-29 06:58:52'),
(322, 'usuario_permiso', '323', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:58:52', '2022-09-29 06:58:52'),
(323, 'usuario', '5', 'Editamos los campos del usuario', '1', '1', '1', '2022-09-29 06:59:11', '2022-09-29 06:59:11'),
(324, 'usuario_permiso', '324', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:59:11', '2022-09-29 06:59:11'),
(325, 'usuario_permiso', '325', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:59:11', '2022-09-29 06:59:11'),
(326, 'usuario_permiso', '326', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:59:11', '2022-09-29 06:59:11'),
(327, 'usuario_permiso', '327', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:59:11', '2022-09-29 06:59:11'),
(328, 'usuario_permiso', '328', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 06:59:11', '2022-09-29 06:59:11'),
(329, 'usuario_permiso', '5', 'Registro desactivado', '1', '1', '1', '2022-09-29 07:09:29', '2022-09-29 07:09:29'),
(330, 'usuario', '3', 'Editamos los campos del usuario', '1', '1', '1', '2022-09-29 07:09:37', '2022-09-29 07:09:37'),
(331, 'usuario_permiso', '329', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 07:09:37', '2022-09-29 07:09:37'),
(332, 'usuario_permiso', '330', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 07:09:37', '2022-09-29 07:09:37'),
(333, 'usuario_permiso', '331', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 07:09:37', '2022-09-29 07:09:37'),
(334, 'usuario_permiso', '332', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-09-29 07:09:37', '2022-09-29 07:09:37'),
(335, 'usuario_permiso', '3', 'Registro Eliminado', '1', '1', '1', '2022-09-29 07:09:42', '2022-09-29 07:09:42'),
(336, 'trabajador', '3', 'Editamos el registro Trabajador', '1', '1', '1', '2022-09-29 17:37:13', '2022-09-29 17:37:13'),
(337, 'persona', '5', 'Registro Nuevo persona', '1', '1', '1', '2022-09-30 20:30:54', '2022-09-30 20:30:54'),
(338, 'persona', '6', 'Registro Nuevo persona', '1', '1', '1', '2022-09-30 20:32:58', '2022-09-30 20:32:58'),
(339, 'persona', '7', 'Registro Nuevo persona', '1', '1', '1', '2022-09-30 21:32:02', '2022-09-30 21:32:02'),
(340, 'persona', '7', 'Editamos el registro persona', '1', '1', '1', '2022-09-30 21:32:19', '2022-09-30 21:32:19'),
(341, 'persona', '3', 'Editamos el registro persona', '1', '1', '1', '2022-09-30 22:08:28', '2022-09-30 22:08:28'),
(342, 'persona', '3', 'Editamos el registro persona', '1', '1', '1', '2022-09-30 22:08:51', '2022-09-30 22:08:51'),
(343, 'persona', '7', 'Editamos el registro persona', '1', '1', '1', '2022-09-30 22:09:29', '2022-09-30 22:09:29'),
(344, 'persona', '3', 'Editamos el registro persona', '1', '1', '1', '2022-09-30 22:10:32', '2022-09-30 22:10:32'),
(345, 'persona', '4', 'Editamos el registro persona', '1', '1', '1', '2022-09-30 22:13:58', '2022-09-30 22:13:58'),
(346, 'persona', '8', 'Registro Nuevo persona', '1', '1', '1', '2022-09-30 22:34:29', '2022-09-30 22:34:29'),
(347, 'persona', '9', 'Registro Nuevo persona', '1', '1', '1', '2022-09-30 22:42:29', '2022-09-30 22:42:29'),
(348, 'persona', '9', 'Editamos el registro persona', '1', '1', '1', '2022-09-30 22:44:08', '2022-09-30 22:44:08'),
(349, 'persona', '6', 'Editamos el registro persona', '1', '1', '1', '2022-09-30 22:56:51', '2022-09-30 22:56:51'),
(350, 'persona', '8', 'Editamos el registro persona', '1', '1', '1', '2022-09-30 22:57:02', '2022-09-30 22:57:02'),
(351, 'persona', '4', 'Editamos el registro persona', '1', '1', '1', '2022-09-30 23:04:54', '2022-09-30 23:04:54'),
(352, 'persona', '3', 'Editamos el registro persona', '1', '1', '1', '2022-10-07 05:51:11', '2022-10-07 05:51:11'),
(353, 'unidad_medida', '1', 'Nueva unidad medida registrada', '1', '1', '1', '2022-10-07 06:57:40', '2022-10-07 06:57:40'),
(354, 'unidad_medida', '2', 'Nueva unidad medida registrada', '1', '1', '1', '2022-10-07 06:58:11', '2022-10-07 06:58:11'),
(355, 'unidad_medida', '2', 'Unidad medida editada', '1', '1', '1', '2022-10-07 06:58:19', '2022-10-07 06:58:19'),
(356, 'tipo_persona', '4', 'Nuevo tipo trabajador registrado', '1', '1', '1', '2022-10-07 06:58:29', '2022-10-07 06:58:29'),
(357, 'tipo_persona', '5', 'Nuevo tipo trabajador registrado', '1', '1', '1', '2022-10-07 06:58:34', '2022-10-07 06:58:34'),
(358, 'tipo_persona', '6', 'Nuevo tipo trabajador registrado', '1', '1', '1', '2022-10-07 06:58:36', '2022-10-07 06:58:36'),
(359, 'tipo_persona', '7', 'Nuevo tipo trabajador registrado', '1', '1', '1', '2022-10-07 06:58:40', '2022-10-07 06:58:40'),
(360, 'cargo_trabajador', '2', 'Cargo trabajador editado', '1', '1', '1', '2022-10-07 07:00:23', '2022-10-07 07:00:23'),
(361, 'cargo_trabajador', '4', 'Cargo trabajador editado', '1', '1', '1', '2022-10-07 07:00:28', '2022-10-07 07:00:28'),
(362, 'cargo_trabajador', '1', 'Cargo trabajador Eliminado', '1', '1', '1', '2022-10-07 07:00:40', '2022-10-07 07:00:40'),
(363, 'unidad_medida', '2', 'Unidad medida editada', '1', '1', '1', '2022-10-07 07:00:54', '2022-10-07 07:00:54'),
(364, 'unidad_medida', '2', 'Unidad de medida Eliminaao', '1', '1', '1', '2022-10-07 07:00:58', '2022-10-07 07:00:58'),
(365, 'unidad_medida', '1', 'Unidad de medida desactivada', '1', '1', '1', '2022-10-07 07:01:02', '2022-10-07 07:01:02'),
(366, 'tipo_persona', '7', 'Tipo trabajador Eliminado', '1', '1', '1', '2022-10-07 07:01:08', '2022-10-07 07:01:08'),
(367, 'tipo_persona', '6', 'Tipo trabajador desactivado', '1', '1', '1', '2022-10-07 07:01:11', '2022-10-07 07:01:11'),
(368, 'categoria_producto', '1', 'Nueva categoría de insumos registrada', '1', '1', '1', '2022-10-07 07:01:21', '2022-10-07 07:01:21'),
(369, 'categoria_producto', '2', 'Nueva categoría de insumos registrada', '1', '1', '1', '2022-10-07 07:01:28', '2022-10-07 07:01:28'),
(370, 'categoria_producto', '3', 'Nueva categoría de insumos registrada', '1', '1', '1', '2022-10-07 07:01:35', '2022-10-07 07:01:35'),
(371, 'categoria_producto', '2', 'Categoría de insumos editada', '1', '1', '1', '2022-10-07 07:01:46', '2022-10-07 07:01:46'),
(372, 'trabajador', '2', 'Categoría de insumos Eliminado', '1', '1', '1', '2022-10-07 07:01:49', '2022-10-07 07:01:49'),
(373, 'categoria_producto', '3', 'Categoría de insumos desactivado', '1', '1', '1', '2022-10-07 07:01:54', '2022-10-07 07:01:54'),
(374, 'categoria_producto', '4', 'Nueva categoría de insumos registrada', '1', '1', '1', '2022-10-07 07:02:07', '2022-10-07 07:02:07'),
(375, 'tipo_persona', '5', 'Tipo trabajador Eliminado', '1', '1', '1', '2022-10-07 07:02:13', '2022-10-07 07:02:13'),
(376, 'tipo_persona', '1', 'Tipo trabajador desactivado', '1', '1', '1', '2022-10-07 07:02:16', '2022-10-07 07:02:16');
INSERT INTO `bitacora_bd` (`idbitacora_bd`, `nombre_tabla`, `id_tabla`, `accion`, `id_user`, `estado`, `estado_delete`, `created_at`, `updated_at`) VALUES
(377, 'producto', '1', 'Nuevo producto registrado', '1', '1', '1', '2022-10-07 07:05:50', '2022-10-07 07:05:50'),
(378, 'producto', '2', 'Nuevo producto registrado', '1', '1', '1', '2022-10-07 07:12:23', '2022-10-07 07:12:23'),
(379, 'producto', '2', 'Producto editado', '1', '1', '1', '2022-10-07 07:12:54', '2022-10-07 07:12:54'),
(380, 'producto', '2', 'Producto editado', '1', '1', '1', '2022-10-07 07:13:05', '2022-10-07 07:13:05'),
(381, 'producto', '3', 'Nuevo producto registrado', '1', '1', '1', '2022-10-07 07:13:24', '2022-10-07 07:13:24'),
(382, 'producto', '1', 'Producto editado', '1', '1', '1', '2022-10-07 07:16:25', '2022-10-07 07:16:25'),
(383, 'producto', '4', 'Nuevo producto registrado', '1', '1', '1', '2022-10-07 07:17:46', '2022-10-07 07:17:46'),
(384, 'producto', '4', 'Producto Eliminado', '1', '1', '1', '2022-10-07 07:28:58', '2022-10-07 07:28:58'),
(385, 'producto', '3', 'Producto desactivado', '1', '1', '1', '2022-10-07 07:29:02', '2022-10-07 07:29:02'),
(386, 'tipo_persona', '4', 'Tipo trabajador editado', '1', '1', '1', '2022-10-07 18:23:14', '2022-10-07 18:23:14'),
(387, 'tipo_persona', '3', 'Tipo trabajador editado', '1', '1', '1', '2022-10-07 18:23:26', '2022-10-07 18:23:26'),
(388, 'tipo_persona', '2', 'Tipo trabajador editado', '1', '1', '1', '2022-10-07 18:23:38', '2022-10-07 18:23:38'),
(389, 'cargo_trabajador', '2', 'Cargo trabajador editado', '1', '1', '1', '2022-10-07 18:23:54', '2022-10-07 18:23:54'),
(390, 'usuario', '1', 'Editamos los campos del usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(391, 'usuario_permiso', '333', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(392, 'usuario_permiso', '334', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(393, 'usuario_permiso', '335', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(394, 'usuario_permiso', '336', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(395, 'usuario_permiso', '337', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(396, 'usuario_permiso', '338', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(397, 'usuario_permiso', '339', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(398, 'usuario_permiso', '340', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(399, 'usuario_permiso', '341', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(400, 'usuario_permiso', '342', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(401, 'usuario_permiso', '343', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(402, 'usuario_permiso', '344', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(403, 'usuario_permiso', '345', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(404, 'usuario_permiso', '346', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(405, 'usuario_permiso', '347', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(406, 'usuario_permiso', '348', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(407, 'usuario_permiso', '349', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(408, 'usuario_permiso', '350', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(409, 'usuario_permiso', '351', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(410, 'usuario_permiso', '352', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(411, 'usuario_permiso', '353', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(412, 'usuario_permiso', '354', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(413, 'usuario_permiso', '355', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(414, 'usuario_permiso', '356', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(415, 'usuario_permiso', '357', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(416, 'usuario_permiso', '358', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(417, 'usuario_permiso', '359', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(418, 'usuario_permiso', '360', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(419, 'usuario_permiso', '361', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(420, 'usuario_permiso', '362', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(421, 'usuario_permiso', '363', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(422, 'usuario_permiso', '364', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(423, 'usuario_permiso', '365', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2022-10-09 02:54:01', '2022-10-09 02:54:01'),
(424, 'compra_grano', '1', 'Agregar compra grano', '1', '1', '1', '2022-10-09 05:48:02', '2022-10-09 05:48:02'),
(425, 'compra_grano', '2', 'Agregar compra grano', '1', '1', '1', '2022-10-09 05:50:01', '2022-10-09 05:50:01'),
(426, 'compra_grano', '3', 'Agregar compra grano', '1', '1', '1', '2022-10-09 05:52:14', '2022-10-09 05:52:14'),
(427, 'compra_grano', '4', 'Agregar compra grano', '1', '1', '1', '2022-10-09 05:53:43', '2022-10-09 05:53:43'),
(428, 'compra_grano', '5', 'Agregar compra grano', '1', '1', '1', '2022-10-09 05:55:04', '2022-10-09 05:55:04'),
(429, 'compra_grano', '6', 'Agregar compra grano', '1', '1', '1', '2022-10-09 05:55:39', '2022-10-09 05:55:39'),
(430, 'detalle_compra_grano', '1', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 05:55:39', '2022-10-09 05:55:39'),
(431, 'detalle_compra_grano', '2', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 05:55:39', '2022-10-09 05:55:39'),
(432, 'detalle_compra_grano', '3', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 05:55:39', '2022-10-09 05:55:39'),
(433, 'detalle_compra_grano', '4', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 05:55:39', '2022-10-09 05:55:39'),
(434, 'compra_grano', '7', 'Agregar compra grano', '1', '1', '1', '2022-10-09 05:56:20', '2022-10-09 05:56:20'),
(435, 'detalle_compra_grano', '5', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 05:56:20', '2022-10-09 05:56:20'),
(436, 'detalle_compra_grano', '6', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 05:56:20', '2022-10-09 05:56:20'),
(437, 'detalle_compra_grano', '7', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 05:56:20', '2022-10-09 05:56:20'),
(438, 'detalle_compra_grano', '8', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 05:56:20', '2022-10-09 05:56:20'),
(439, 'compra_grano', '8', 'Agregar compra grano', '1', '1', '1', '2022-10-09 06:13:10', '2022-10-09 06:13:10'),
(440, 'detalle_compra_grano', '9', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 06:13:10', '2022-10-09 06:13:10'),
(441, 'detalle_compra_grano', '10', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 06:13:10', '2022-10-09 06:13:10'),
(442, 'detalle_compra_grano', '11', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 06:13:10', '2022-10-09 06:13:10'),
(443, 'detalle_compra_grano', '12', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 06:13:10', '2022-10-09 06:13:10'),
(444, 'detalle_compra_grano', '13', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 06:13:10', '2022-10-09 06:13:10'),
(445, 'compra_grano', '8', 'Editar compra grano', '1', '1', '1', '2022-10-09 14:33:23', '2022-10-09 14:33:23'),
(446, 'detalle_compra_grano', '14', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 14:33:23', '2022-10-09 14:33:23'),
(447, 'detalle_compra_grano', '15', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 14:33:23', '2022-10-09 14:33:23'),
(448, 'detalle_compra_grano', '16', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 14:33:23', '2022-10-09 14:33:23'),
(449, 'detalle_compra_grano', '17', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 14:33:23', '2022-10-09 14:33:23'),
(450, 'compra_grano', '8', 'Editar compra grano', '1', '1', '1', '2022-10-09 14:33:45', '2022-10-09 14:33:45'),
(451, 'detalle_compra_grano', '18', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 14:33:45', '2022-10-09 14:33:45'),
(452, 'detalle_compra_grano', '19', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 14:33:45', '2022-10-09 14:33:45'),
(453, 'detalle_compra_grano', '20', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 14:33:45', '2022-10-09 14:33:45'),
(454, 'detalle_compra_grano', '21', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 14:33:45', '2022-10-09 14:33:45'),
(455, 'compra_grano', '3', 'Editar compra grano', '1', '1', '1', '2022-10-09 15:26:14', '2022-10-09 15:26:14'),
(456, 'detalle_compra_grano', '22', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 15:26:14', '2022-10-09 15:26:14'),
(457, 'compra_grano', '8', 'Compra desactivada', '1', '1', '1', '2022-10-09 15:31:11', '2022-10-09 15:31:11'),
(458, 'compra_grano', '4', 'Compra Eliminada', '1', '1', '1', '2022-10-09 15:31:17', '2022-10-09 15:31:17'),
(459, 'compra_grano', '5', 'Compra Eliminada', '1', '1', '1', '2022-10-09 15:31:20', '2022-10-09 15:31:20'),
(460, 'compra_grano', '6', 'Compra Eliminada', '1', '1', '1', '2022-10-09 15:31:23', '2022-10-09 15:31:23'),
(461, 'compra_grano', '7', 'Compra Eliminada', '1', '1', '1', '2022-10-09 15:31:26', '2022-10-09 15:31:26'),
(462, 'compra_grano', '1', 'Compra desactivada', '1', '1', '1', '2022-10-09 15:31:28', '2022-10-09 15:31:28'),
(463, 'persona', '8', 'Editamos el registro persona', '1', '1', '1', '2022-10-09 17:19:02', '2022-10-09 17:19:02'),
(464, 'persona', '8', 'Editamos el registro persona', '1', '1', '1', '2022-10-09 17:22:21', '2022-10-09 17:22:21'),
(465, 'persona', '8', 'Editamos el registro persona', '1', '1', '1', '2022-10-09 17:22:25', '2022-10-09 17:22:25'),
(466, 'persona', '8', 'Editamos el registro persona', '1', '1', '1', '2022-10-09 17:23:01', '2022-10-09 17:23:01'),
(467, 'persona', '8', 'Editamos el registro persona', '1', '1', '1', '2022-10-09 17:28:15', '2022-10-09 17:28:15'),
(468, 'persona', '5', 'Editamos el registro persona', '1', '1', '1', '2022-10-09 17:31:36', '2022-10-09 17:31:36'),
(469, 'persona', '5', 'Editamos el registro persona', '1', '1', '1', '2022-10-09 17:31:39', '2022-10-09 17:31:39'),
(470, 'persona', '8', 'Editamos el registro persona', '1', '1', '1', '2022-10-09 17:34:43', '2022-10-09 17:34:43'),
(471, 'persona', '8', 'Editamos el registro persona', '1', '1', '1', '2022-10-09 17:38:22', '2022-10-09 17:38:22'),
(472, 'persona', '5', 'Editamos el registro persona', '1', '1', '1', '2022-10-09 17:39:09', '2022-10-09 17:39:09'),
(473, 'persona', '5', 'Editamos el registro persona', '1', '1', '1', '2022-10-09 17:39:19', '2022-10-09 17:39:19'),
(474, 'persona', '5', 'Editamos el registro persona', '1', '1', '1', '2022-10-09 17:39:25', '2022-10-09 17:39:25'),
(475, 'compra_grano', '2', 'Editar compra grano', '1', '1', '1', '2022-10-09 17:43:30', '2022-10-09 17:43:30'),
(476, 'detalle_compra_grano', '23', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 17:43:30', '2022-10-09 17:43:30'),
(477, 'detalle_compra_grano', '24', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 17:43:30', '2022-10-09 17:43:30'),
(478, 'detalle_compra_grano', '25', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 17:43:30', '2022-10-09 17:43:30'),
(479, 'detalle_compra_grano', '26', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 17:43:30', '2022-10-09 17:43:30'),
(480, 'detalle_compra_grano', '27', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 17:43:30', '2022-10-09 17:43:30'),
(481, 'compra_grano', '2', 'Editar compra grano', '1', '1', '1', '2022-10-09 17:43:44', '2022-10-09 17:43:44'),
(482, 'detalle_compra_grano', '28', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 17:43:44', '2022-10-09 17:43:44'),
(483, 'detalle_compra_grano', '29', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 17:43:44', '2022-10-09 17:43:44'),
(484, 'detalle_compra_grano', '30', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 17:43:44', '2022-10-09 17:43:44'),
(485, 'detalle_compra_grano', '31', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 17:43:45', '2022-10-09 17:43:45'),
(486, 'detalle_compra_grano', '32', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 17:43:45', '2022-10-09 17:43:45'),
(487, 'compra_grano', '3', 'Editar compra grano', '1', '1', '1', '2022-10-09 18:16:37', '2022-10-09 18:16:37'),
(488, 'detalle_compra_grano', '33', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 18:16:37', '2022-10-09 18:16:37'),
(489, 'detalle_compra_grano', '34', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 18:16:37', '2022-10-09 18:16:37'),
(490, 'detalle_compra_grano', '35', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 18:16:37', '2022-10-09 18:16:37'),
(491, 'detalle_compra_grano', '36', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 18:16:37', '2022-10-09 18:16:37'),
(492, 'detalle_compra_grano', '37', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 18:16:37', '2022-10-09 18:16:37'),
(493, 'detalle_compra_grano', '38', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 18:16:37', '2022-10-09 18:16:37'),
(494, 'compra_grano', '9', 'Agregar compra grano', '1', '1', '1', '2022-10-09 18:40:52', '2022-10-09 18:40:52'),
(495, 'detalle_compra_grano', '39', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 18:40:52', '2022-10-09 18:40:52'),
(496, 'detalle_compra_grano', '40', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 18:40:52', '2022-10-09 18:40:52'),
(497, 'compra_grano', '10', 'Agregar compra grano', '1', '1', '1', '2022-10-09 23:10:55', '2022-10-09 23:10:55'),
(498, 'detalle_compra_grano', '41', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:10:55', '2022-10-09 23:10:55'),
(499, 'compra_grano', '11', 'Agregar compra grano', '1', '1', '1', '2022-10-09 23:11:23', '2022-10-09 23:11:23'),
(500, 'detalle_compra_grano', '42', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:11:23', '2022-10-09 23:11:23'),
(501, 'detalle_compra_grano', '43', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:11:23', '2022-10-09 23:11:23'),
(502, 'compra_grano', '10', 'Editar compra grano', '1', '1', '1', '2022-10-09 23:14:30', '2022-10-09 23:14:30'),
(503, 'detalle_compra_grano', '44', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:14:30', '2022-10-09 23:14:30'),
(504, 'compra_grano', '2', 'Editar compra grano', '1', '1', '1', '2022-10-09 23:14:52', '2022-10-09 23:14:52'),
(505, 'detalle_compra_grano', '45', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:14:52', '2022-10-09 23:14:52'),
(506, 'detalle_compra_grano', '46', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:14:52', '2022-10-09 23:14:52'),
(507, 'detalle_compra_grano', '47', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:14:52', '2022-10-09 23:14:52'),
(508, 'detalle_compra_grano', '48', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:14:52', '2022-10-09 23:14:52'),
(509, 'detalle_compra_grano', '49', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:14:52', '2022-10-09 23:14:52'),
(510, 'compra_grano', '3', 'Editar compra grano', '1', '1', '1', '2022-10-09 23:15:31', '2022-10-09 23:15:31'),
(511, 'detalle_compra_grano', '50', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:15:31', '2022-10-09 23:15:31'),
(512, 'detalle_compra_grano', '51', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:15:31', '2022-10-09 23:15:31'),
(513, 'detalle_compra_grano', '52', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:15:31', '2022-10-09 23:15:31'),
(514, 'detalle_compra_grano', '53', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:15:31', '2022-10-09 23:15:31'),
(515, 'detalle_compra_grano', '54', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:15:31', '2022-10-09 23:15:31'),
(516, 'detalle_compra_grano', '55', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:15:31', '2022-10-09 23:15:31'),
(517, 'compra_grano', '12', 'Agregar compra grano', '1', '1', '1', '2022-10-09 23:17:01', '2022-10-09 23:17:01'),
(518, 'detalle_compra_grano', '56', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:17:01', '2022-10-09 23:17:01'),
(519, 'compra_grano', '13', 'Agregar compra grano', '1', '1', '1', '2022-10-09 23:17:56', '2022-10-09 23:17:56'),
(520, 'detalle_compra_grano', '57', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:17:56', '2022-10-09 23:17:56'),
(521, 'compra_grano', '4', 'Editar compra grano', '1', '1', '1', '2022-10-09 23:24:54', '2022-10-09 23:24:54'),
(522, 'detalle_compra_grano', '58', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:24:54', '2022-10-09 23:24:54'),
(523, 'compra_grano', '5', 'Editar compra grano', '1', '1', '1', '2022-10-09 23:25:12', '2022-10-09 23:25:12'),
(524, 'detalle_compra_grano', '59', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:25:12', '2022-10-09 23:25:12'),
(525, 'compra_grano', '6', 'Editar compra grano', '1', '1', '1', '2022-10-09 23:26:30', '2022-10-09 23:26:30'),
(526, 'detalle_compra_grano', '60', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:26:30', '2022-10-09 23:26:30'),
(527, 'detalle_compra_grano', '61', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:26:30', '2022-10-09 23:26:30'),
(528, 'detalle_compra_grano', '62', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:26:30', '2022-10-09 23:26:30'),
(529, 'detalle_compra_grano', '63', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:26:30', '2022-10-09 23:26:30'),
(530, 'compra_grano', '8', 'Editar compra grano', '1', '1', '1', '2022-10-09 23:27:27', '2022-10-09 23:27:27'),
(531, 'detalle_compra_grano', '64', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:27:27', '2022-10-09 23:27:27'),
(532, 'detalle_compra_grano', '65', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:27:27', '2022-10-09 23:27:27'),
(533, 'detalle_compra_grano', '66', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:27:27', '2022-10-09 23:27:27'),
(534, 'detalle_compra_grano', '67', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:27:27', '2022-10-09 23:27:27'),
(535, 'compra_grano', '7', 'Editar compra grano', '1', '1', '1', '2022-10-09 23:28:54', '2022-10-09 23:28:54'),
(536, 'detalle_compra_grano', '68', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:28:54', '2022-10-09 23:28:54'),
(537, 'detalle_compra_grano', '69', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:28:54', '2022-10-09 23:28:54'),
(538, 'detalle_compra_grano', '70', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:28:54', '2022-10-09 23:28:54'),
(539, 'detalle_compra_grano', '71', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:28:54', '2022-10-09 23:28:54'),
(540, 'compra_grano', '7', 'Editar compra grano', '1', '1', '1', '2022-10-09 23:29:30', '2022-10-09 23:29:30'),
(541, 'detalle_compra_grano', '72', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:29:30', '2022-10-09 23:29:30'),
(542, 'detalle_compra_grano', '73', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:29:30', '2022-10-09 23:29:30'),
(543, 'detalle_compra_grano', '74', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:29:30', '2022-10-09 23:29:30'),
(544, 'detalle_compra_grano', '75', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-09 23:29:30', '2022-10-09 23:29:30'),
(545, 'unidad_medida', '3', 'Nueva unidad medida registrada', '1', '1', '1', '2022-10-10 16:31:43', '2022-10-10 16:31:43'),
(546, 'compra_producto', '1', 'Nueva compra', '1', '1', '1', '2022-10-10 16:34:41', '2022-10-10 16:34:41'),
(547, 'detalle_compra_producto', '1', 'Detalle compra', '1', '1', '1', '2022-10-10 16:34:41', '2022-10-10 16:34:41'),
(548, 'detalle_compra_producto', '2', 'Detalle compra', '1', '1', '1', '2022-10-10 16:34:41', '2022-10-10 16:34:41'),
(549, 'compra_grano', '14', 'Agregar compra grano', '1', '1', '1', '2022-10-10 16:41:05', '2022-10-10 16:41:05'),
(550, 'detalle_compra_grano', '76', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-10 16:41:05', '2022-10-10 16:41:05'),
(551, 'compra_grano', '4', 'Compra desactivada', '1', '1', '1', '2022-10-10 16:42:38', '2022-10-10 16:42:38'),
(552, 'compra_grano', '2', 'Compra Eliminada', '1', '1', '1', '2022-10-10 16:42:40', '2022-10-10 16:42:40'),
(553, 'compra_grano', '1', 'Editar compra grano', '1', '1', '1', '2022-10-10 18:13:49', '2022-10-10 18:13:49'),
(554, 'detalle_compra_grano', '77', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-10 18:13:49', '2022-10-10 18:13:49'),
(555, 'detalle_compra_grano', '78', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-10 18:13:49', '2022-10-10 18:13:49'),
(556, 'detalle_compra_grano', '79', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-10 18:13:49', '2022-10-10 18:13:49'),
(557, 'compra_grano', '15', 'Agregar compra grano', '1', '1', '1', '2022-10-10 19:08:50', '2022-10-10 19:08:50'),
(558, 'detalle_compra_grano', '80', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-10 19:08:50', '2022-10-10 19:08:50'),
(559, 'detalle_compra_grano', '81', 'Agregar Detalle compra grano', '1', '1', '1', '2022-10-10 19:08:50', '2022-10-10 19:08:50'),
(560, 'persona', '5', 'Editamos el registro persona', '1', '1', '1', '2022-10-11 13:41:00', '2022-10-11 13:41:00'),
(561, 'persona', '6', 'Editamos el registro persona', '1', '1', '1', '2022-10-11 13:41:25', '2022-10-11 13:41:25'),
(562, 'persona', '8', 'Editamos el registro persona', '1', '1', '1', '2022-10-11 14:03:38', '2022-10-11 14:03:38'),
(563, 'persona', '4', 'Editamos el registro persona', '1', '1', '1', '2022-10-11 14:04:01', '2022-10-11 14:04:01'),
(564, 'compra_grano', '16', 'Agregar compra cafe', '1', '1', '1', '2022-10-11 14:10:38', '2022-10-11 14:10:38'),
(565, 'pago_compra_grano', '17', 'Agregar pago cafe', '1', '1', '1', '2022-10-11 14:10:38', '2022-10-11 14:10:38'),
(566, 'detalle_compra_grano', '82', 'Agregar detalle compra cafe', '1', '1', '1', '2022-10-11 14:10:38', '2022-10-11 14:10:38'),
(567, 'compra_grano', '18', 'Agregar compra cafe', '1', '1', '1', '2022-10-11 14:20:10', '2022-10-11 14:20:10'),
(568, 'pago_compra_grano', '1', 'Agregar pago cafe', '1', '1', '1', '2022-10-11 14:20:10', '2022-10-11 14:20:10'),
(569, 'detalle_compra_grano', '83', 'Agregar detalle compra cafe', '1', '1', '1', '2022-10-11 14:20:10', '2022-10-11 14:20:10'),
(570, 'detalle_compra_grano', '84', 'Agregar detalle compra cafe', '1', '1', '1', '2022-10-11 14:20:10', '2022-10-11 14:20:10'),
(571, 'compra_grano', '1', 'Editar compra cafe', '1', '1', '1', '2022-10-11 14:27:56', '2022-10-11 14:27:56'),
(572, 'detalle_compra_grano', '85', 'Agregar Detalle compra cafe', '1', '1', '1', '2022-10-11 14:27:56', '2022-10-11 14:27:56'),
(573, 'detalle_compra_grano', '86', 'Agregar Detalle compra cafe', '1', '1', '1', '2022-10-11 14:27:56', '2022-10-11 14:27:56'),
(574, 'detalle_compra_grano', '87', 'Agregar Detalle compra cafe', '1', '1', '1', '2022-10-11 14:27:56', '2022-10-11 14:27:56'),
(575, 'pago_compra_grano', '1', 'Pago compra papelera', '1', '1', '1', '2022-10-16 05:39:14', '2022-10-16 05:39:14'),
(576, 'pago_compra_grano', '2', 'Pago compra papelera', '1', '1', '1', '2022-10-16 05:43:00', '2022-10-16 05:43:00'),
(577, 'pago_compra_grano', '2', 'Pago compra papelera', '1', '1', '1', '2022-10-16 05:49:27', '2022-10-16 05:49:27'),
(578, 'pago_compra_grano', '2', 'Pago compra papelera', '1', '1', '1', '2022-10-16 05:57:15', '2022-10-16 05:57:15'),
(579, 'pago_compra_grano', '3', 'Pago compra papelera', '1', '1', '1', '2022-10-16 05:57:19', '2022-10-16 05:57:19'),
(580, 'pago_compra_grano', '3', 'Pago compra papelera', '1', '1', '1', '2022-10-16 06:00:02', '2022-10-16 06:00:02'),
(581, 'pago_compra_grano', '2', 'Pago compra papelera', '1', '1', '1', '2022-10-16 06:00:06', '2022-10-16 06:00:06'),
(582, 'pago_compra_grano', '4', 'Pago compra papelera', '1', '1', '1', '2022-10-16 06:00:40', '2022-10-16 06:00:40'),
(583, 'pago_compra_grano', '5', 'Pago compra papelera', '1', '1', '1', '2022-10-16 06:50:52', '2022-10-16 06:50:52'),
(584, 'compra_grano', '19', 'Agregar compra cafe', '1', '1', '1', '2022-10-16 15:58:48', '2022-10-16 15:58:48'),
(585, 'compra_grano', '20', 'Agregar compra cafe', '1', '1', '1', '2022-10-16 16:01:57', '2022-10-16 16:01:57'),
(586, 'pago_compra_grano', '9', 'Agregar pago cafe', '1', '1', '1', '2022-10-16 16:01:57', '2022-10-16 16:01:57'),
(587, 'detalle_compra_grano', '88', 'Agregar detalle compra cafe', '1', '1', '1', '2022-10-16 16:01:57', '2022-10-16 16:01:57'),
(588, 'compra_producto', '2', 'Nueva compra', '1', '1', '1', '2022-12-15 22:40:47', '2022-12-15 22:40:47'),
(589, 'detalle_compra_producto', '3', 'Detalle compra', '1', '1', '1', '2022-12-15 22:40:47', '2022-12-15 22:40:47'),
(590, 'detalle_compra_producto', '4', 'Detalle compra', '1', '1', '1', '2022-12-15 22:40:47', '2022-12-15 22:40:47'),
(591, 'persona', '12', 'Registro Nuevo persona', '1', '1', '1', '2022-12-15 23:00:21', '2022-12-15 23:00:21'),
(592, 'persona', '13', 'Registro Nuevo persona', '1', '1', '1', '2022-12-15 23:44:52', '2022-12-15 23:44:52'),
(593, 'persona', '13', 'Editamos el registro persona', '1', '1', '1', '2022-12-15 23:45:05', '2022-12-15 23:45:05'),
(594, 'persona', '13', 'Editamos el registro persona', '1', '1', '1', '2022-12-15 23:45:10', '2022-12-15 23:45:10'),
(595, 'categoria_producto', '5', 'Nueva categoría de insumos registrada', '1', '1', '1', '2022-12-16 19:07:15', '2022-12-16 19:07:15'),
(596, 'categoria_producto', '4', 'Categoría de insumos editada', '1', '1', '1', '2022-12-16 19:08:58', '2022-12-16 19:08:58'),
(597, 'categoria_producto', '6', 'Nueva categoría de insumos registrada', '1', '1', '1', '2022-12-16 19:10:12', '2022-12-16 19:10:12'),
(598, 'categoria_producto', '7', 'Nueva categoría de insumos registrada', '1', '1', '1', '2022-12-16 19:12:26', '2022-12-16 19:12:26'),
(599, 'categoria_producto', '7', 'Categoría de insumos editada', '1', '1', '1', '2022-12-16 19:12:38', '2022-12-16 19:12:38'),
(600, 'categoria_producto', '7', 'Categoría de insumos editada', '1', '1', '1', '2022-12-16 19:12:55', '2022-12-16 19:12:55'),
(601, 'categoria_producto', '6', 'Categoría de insumos editada', '1', '1', '1', '2022-12-16 19:13:05', '2022-12-16 19:13:05'),
(602, 'categoria_producto', '4', 'Categoría de insumos editada', '1', '1', '1', '2022-12-16 19:13:16', '2022-12-16 19:13:16'),
(603, 'categoria_producto', '8', 'Nueva categoría de insumos registrada', '1', '1', '1', '2022-12-16 19:13:43', '2022-12-16 19:13:43'),
(604, 'categoria_producto', '8', 'Categoría de insumos editada', '1', '1', '1', '2022-12-16 19:13:54', '2022-12-16 19:13:54'),
(605, 'producto', '1', 'Producto editado', '1', '1', '1', '2022-12-16 19:15:23', '2022-12-16 19:15:23'),
(606, 'producto', '2', 'Producto editado', '1', '1', '1', '2022-12-16 19:15:30', '2022-12-16 19:15:30'),
(607, 'producto', '5', 'Nuevo producto registrado', '1', '1', '1', '2022-12-16 19:15:52', '2022-12-16 19:15:52'),
(608, 'producto', '6', 'Nuevo producto registrado', '1', '1', '1', '2022-12-16 19:16:09', '2022-12-16 19:16:09'),
(609, 'producto', '7', 'Nuevo producto registrado', '1', '1', '1', '2022-12-16 19:16:27', '2022-12-16 19:16:27'),
(610, 'producto', '8', 'Nuevo producto registrado', '1', '1', '1', '2022-12-16 19:16:56', '2022-12-16 19:16:56'),
(611, 'producto', '9', 'Nuevo producto registrado', '1', '1', '1', '2022-12-16 19:17:21', '2022-12-16 19:17:21'),
(612, 'producto', '10', 'Nuevo producto registrado', '1', '1', '1', '2022-12-16 19:17:41', '2022-12-16 19:17:41'),
(613, 'producto', '11', 'Nuevo producto registrado', '1', '1', '1', '2022-12-16 19:18:08', '2022-12-16 19:18:08'),
(614, 'producto', '12', 'Nuevo producto registrado', '1', '1', '1', '2022-12-16 19:18:41', '2022-12-16 19:18:41'),
(615, 'producto', '13', 'Nuevo producto registrado', '1', '1', '1', '2022-12-16 19:19:13', '2022-12-16 19:19:13'),
(616, 'producto', '14', 'Nuevo producto registrado', '1', '1', '1', '2022-12-16 19:19:31', '2022-12-16 19:19:31'),
(617, 'compra_producto', '3', 'Nueva compra', '1', '1', '1', '2022-12-19 03:17:29', '2022-12-19 03:17:29'),
(618, 'detalle_compra_producto', '5', 'Detalle compra', '1', '1', '1', '2022-12-19 03:17:29', '2022-12-19 03:17:29'),
(619, 'detalle_compra_producto', '6', 'Detalle compra', '1', '1', '1', '2022-12-19 03:17:29', '2022-12-19 03:17:29'),
(620, 'detalle_compra_producto', '7', 'Detalle compra', '1', '1', '1', '2022-12-19 03:17:29', '2022-12-19 03:17:29'),
(621, 'compra_producto', '4', 'Nueva compra', '1', '1', '1', '2022-12-19 03:46:48', '2022-12-19 03:46:48'),
(622, 'detalle_compra_producto', '8', 'Detalle compra', '1', '1', '1', '2022-12-19 03:46:48', '2022-12-19 03:46:48'),
(623, 'producto', '8', 'Producto editado', '1', '1', '1', '2022-12-19 23:51:51', '2022-12-19 23:51:51'),
(624, 'producto', '6', 'Producto editado', '1', '1', '1', '2022-12-19 23:52:44', '2022-12-19 23:52:44'),
(625, 'producto', '7', 'Producto editado', '1', '1', '1', '2022-12-19 23:53:37', '2022-12-19 23:53:37'),
(626, 'producto', '11', 'Producto editado', '1', '1', '1', '2022-12-20 00:24:42', '2022-12-20 00:24:42'),
(627, 'producto', '12', 'Producto editado', '1', '1', '1', '2022-12-20 00:26:06', '2022-12-20 00:26:06'),
(628, 'producto', '9', 'Producto editado', '1', '1', '1', '2022-12-20 00:27:37', '2022-12-20 00:27:37'),
(629, 'producto', '2', 'Producto editado', '1', '1', '1', '2022-12-20 18:53:37', '2022-12-20 18:53:37'),
(630, 'producto', '10', 'Producto editado', '1', '1', '1', '2022-12-20 18:54:01', '2022-12-20 18:54:01'),
(631, 'producto', '14', 'Producto editado', '1', '1', '1', '2022-12-20 18:54:47', '2022-12-20 18:54:47'),
(632, 'producto', '13', 'Producto editado', '1', '1', '1', '2022-12-20 18:55:20', '2022-12-20 18:55:20'),
(633, 'producto', '5', 'Producto editado', '1', '1', '1', '2022-12-20 18:55:46', '2022-12-20 18:55:46'),
(634, 'compra_producto', '5', 'Nueva compra', '1', '1', '1', '2022-12-20 19:11:10', '2022-12-20 19:11:10'),
(635, 'detalle_compra_producto', '9', 'Detalle compra', '1', '1', '1', '2022-12-20 19:11:10', '2022-12-20 19:11:10'),
(636, 'detalle_compra_producto', '10', 'Detalle compra', '1', '1', '1', '2022-12-20 19:11:10', '2022-12-20 19:11:10'),
(637, 'detalle_compra_producto', '11', 'Detalle compra', '1', '1', '1', '2022-12-20 19:11:10', '2022-12-20 19:11:10'),
(638, 'detalle_compra_producto', '12', 'Detalle compra', '1', '1', '1', '2022-12-20 19:11:10', '2022-12-20 19:11:10'),
(639, 'compra_producto', '6', 'Nueva compra', '1', '1', '1', '2022-12-20 19:12:18', '2022-12-20 19:12:18'),
(640, 'detalle_compra_producto', '13', 'Detalle compra', '1', '1', '1', '2022-12-20 19:12:18', '2022-12-20 19:12:18'),
(641, 'detalle_compra_producto', '14', 'Detalle compra', '1', '1', '1', '2022-12-20 19:12:18', '2022-12-20 19:12:18'),
(642, 'categoria_producto', '2', 'Categoría de insumos editada', '1', '1', '1', '2022-12-21 05:00:13', '2022-12-21 05:00:13'),
(643, 'categoria_producto', '3', 'Categoría de insumos editada', '1', '1', '1', '2022-12-21 05:00:20', '2022-12-21 05:00:20'),
(644, 'venta_producto', '1', 'Nueva venta', '1', '1', '1', '2022-12-23 04:43:26', '2022-12-23 04:43:26'),
(645, 'detalle_venta_producto', '1', 'Detalle compra', '1', '1', '1', '2022-12-23 04:43:26', '2022-12-23 04:43:26'),
(646, 'detalle_venta_producto', '2', 'Detalle compra', '1', '1', '1', '2022-12-23 04:43:26', '2022-12-23 04:43:26'),
(647, 'detalle_venta_producto', '3', 'Detalle compra', '1', '1', '1', '2022-12-23 04:43:26', '2022-12-23 04:43:26'),
(648, 'venta_producto', '2', 'Nueva venta', '1', '1', '1', '2022-12-23 18:21:37', '2022-12-23 18:21:37'),
(649, 'detalle_venta_producto', '4', 'Detalle compra', '1', '1', '1', '2022-12-23 18:21:37', '2022-12-23 18:21:37'),
(650, 'detalle_venta_producto', '5', 'Detalle compra', '1', '1', '1', '2022-12-23 18:21:37', '2022-12-23 18:21:37'),
(651, 'detalle_venta_producto', '6', 'Detalle compra', '1', '1', '1', '2022-12-23 18:21:37', '2022-12-23 18:21:37'),
(652, 'detalle_venta_producto', '7', 'Detalle compra', '1', '1', '1', '2022-12-23 18:21:37', '2022-12-23 18:21:37'),
(653, 'detalle_venta_producto', '8', 'Detalle compra', '1', '1', '1', '2022-12-23 18:21:37', '2022-12-23 18:21:37'),
(654, 'venta_producto', '3', 'Nueva venta', '1', '1', '1', '2022-12-23 19:09:21', '2022-12-23 19:09:21'),
(655, 'detalle_venta_producto', '9', 'Detalle compra', '1', '1', '1', '2022-12-23 19:09:21', '2022-12-23 19:09:21'),
(656, 'detalle_venta_producto', '10', 'Detalle compra', '1', '1', '1', '2022-12-23 19:09:21', '2022-12-23 19:09:21'),
(657, 'venta_producto', '4', 'Nueva venta', '1', '1', '1', '2022-12-26 00:33:50', '2022-12-26 00:33:50'),
(658, 'detalle_venta_producto', '11', 'Detalle compra', '1', '1', '1', '2022-12-26 00:33:50', '2022-12-26 00:33:50'),
(659, 'detalle_venta_producto', '12', 'Detalle compra', '1', '1', '1', '2022-12-26 00:33:50', '2022-12-26 00:33:50'),
(660, 'venta_producto', '5', 'Nueva venta', '1', '1', '1', '2022-12-26 01:03:47', '2022-12-26 01:03:47'),
(661, 'venta_producto', '6', 'Nueva venta', '1', '1', '1', '2022-12-26 01:11:52', '2022-12-26 01:11:52'),
(662, 'pago_venta_producto', '1', 'Agregar pago venta', '1', '1', '1', '2022-12-26 01:11:52', '2022-12-26 01:11:52'),
(663, 'detalle_venta_producto', '13', 'Detalle compra', '1', '1', '1', '2022-12-26 01:11:52', '2022-12-26 01:11:52'),
(664, 'detalle_venta_producto', '14', 'Detalle compra', '1', '1', '1', '2022-12-26 01:11:52', '2022-12-26 01:11:52'),
(665, 'detalle_venta_producto', '15', 'Detalle compra', '1', '1', '1', '2022-12-26 01:11:52', '2022-12-26 01:11:52'),
(666, 'venta_producto', '7', 'Nueva venta', '1', '1', '1', '2022-12-26 01:54:59', '2022-12-26 01:54:59'),
(667, 'pago_venta_producto', '2', 'Agregar pago venta', '1', '1', '1', '2022-12-26 01:54:59', '2022-12-26 01:54:59'),
(668, 'detalle_venta_producto', '16', 'Detalle compra', '1', '1', '1', '2022-12-26 01:54:59', '2022-12-26 01:54:59'),
(669, 'detalle_venta_producto', '17', 'Detalle compra', '1', '1', '1', '2022-12-26 01:54:59', '2022-12-26 01:54:59'),
(670, 'venta_producto', '8', 'Nueva venta', '1', '1', '1', '2022-12-26 03:11:12', '2022-12-26 03:11:12'),
(671, 'pago_venta_producto', '3', 'Agregar pago venta', '1', '1', '1', '2022-12-26 03:11:12', '2022-12-26 03:11:12'),
(672, 'detalle_venta_producto', '18', 'Detalle compra', '1', '1', '1', '2022-12-26 03:11:12', '2022-12-26 03:11:12'),
(673, 'detalle_venta_producto', '19', 'Detalle compra', '1', '1', '1', '2022-12-26 03:11:12', '2022-12-26 03:11:12'),
(674, 'detalle_venta_producto', '20', 'Detalle compra', '1', '1', '1', '2022-12-26 03:11:12', '2022-12-26 03:11:12'),
(675, 'pago_compra_grano', '8', 'Pago compra papelera', '1', '1', '1', '2022-12-26 15:35:13', '2022-12-26 15:35:13'),
(676, 'pago_venta_producto', '1', 'Se edito este registro', '1', '1', '1', '2022-12-27 02:53:29', '2022-12-27 02:53:29'),
(677, 'pago_venta_producto', '15', 'Se envio a papelera.', '1', '1', '1', '2022-12-27 03:09:57', '2022-12-27 03:09:57'),
(678, 'pago_venta_producto', '14', 'Se Eliminado este registro.', '1', '1', '1', '2022-12-27 03:10:22', '2022-12-27 03:10:22'),
(679, 'pago_venta_producto', '13', 'Se envio a papelera.', '1', '1', '1', '2022-12-27 03:11:12', '2022-12-27 03:11:12'),
(680, 'pago_venta_producto', '12', 'Se Eliminado este registro.', '1', '1', '1', '2022-12-27 03:13:44', '2022-12-27 03:13:44'),
(681, 'pago_venta_producto', '7', 'Se envio a papelera.', '1', '1', '1', '2022-12-27 03:15:01', '2022-12-27 03:15:01'),
(682, 'pago_venta_producto', '8', 'Se envio a papelera.', '1', '1', '1', '2022-12-27 03:15:07', '2022-12-27 03:15:07'),
(683, 'pago_venta_producto', '6', 'Se envio a papelera.', '1', '1', '1', '2022-12-27 03:15:15', '2022-12-27 03:15:15'),
(684, 'pago_venta_producto', '1', 'Se edito este registro', '1', '1', '1', '2022-12-27 03:25:20', '2022-12-27 03:25:20'),
(685, 'pago_venta_producto', '1', 'Se edito este registro', '1', '1', '1', '2022-12-27 03:25:47', '2022-12-27 03:25:47'),
(686, 'pago_venta_producto', '1', 'Se edito este registro', '1', '1', '1', '2022-12-27 03:27:39', '2022-12-27 03:27:39'),
(687, 'pago_venta_producto', '16', 'Se creo nuevo registro', '1', '1', '1', '2022-12-27 03:40:34', '2022-12-27 03:40:34'),
(688, 'pago_venta_producto', '1', 'Se edito este registro', '1', '1', '1', '2022-12-27 05:11:28', '2022-12-27 05:11:28'),
(689, 'pago_venta_producto', '1', 'Se edito este registro', '1', '1', '1', '2022-12-27 05:11:39', '2022-12-27 05:11:39'),
(690, 'pago_venta_producto', '1', 'Se edito este registro', '1', '1', '1', '2022-12-27 05:11:49', '2022-12-27 05:11:49'),
(691, 'pago_venta_producto', '1', 'Se edito este registro', '1', '1', '1', '2022-12-27 05:12:29', '2022-12-27 05:12:29'),
(692, 'compra_producto', '7', 'Nueva compra', '1', '1', '1', '2022-12-28 04:49:42', '2022-12-28 04:49:42'),
(693, 'detalle_compra_producto', '15', 'Detalle compra', '1', '1', '1', '2022-12-28 04:49:42', '2022-12-28 04:49:42'),
(694, 'detalle_compra_producto', '16', 'Detalle compra', '1', '1', '1', '2022-12-28 04:49:42', '2022-12-28 04:49:42'),
(695, 'detalle_compra_producto', '17', 'Detalle compra', '1', '1', '1', '2022-12-28 04:49:42', '2022-12-28 04:49:42'),
(696, 'detalle_compra_producto', '18', 'Detalle compra', '1', '1', '1', '2022-12-28 04:49:42', '2022-12-28 04:49:42'),
(697, 'detalle_compra_producto', '19', 'Detalle compra', '1', '1', '1', '2022-12-28 04:49:42', '2022-12-28 04:49:42'),
(698, 'venta_producto', '9', 'Nueva venta', '1', '1', '1', '2022-12-28 04:58:35', '2022-12-28 04:58:35'),
(699, 'pago_venta_producto', '17', 'Agregar pago venta', '1', '1', '1', '2022-12-28 04:58:35', '2022-12-28 04:58:35'),
(700, 'detalle_venta_producto', '21', 'Detalle compra', '1', '1', '1', '2022-12-28 04:58:35', '2022-12-28 04:58:35'),
(701, 'detalle_venta_producto', '22', 'Detalle compra', '1', '1', '1', '2022-12-28 04:58:35', '2022-12-28 04:58:35'),
(702, 'detalle_venta_producto', '23', 'Detalle compra', '1', '1', '1', '2022-12-28 04:58:36', '2022-12-28 04:58:36'),
(703, 'detalle_venta_producto', '24', 'Detalle compra', '1', '1', '1', '2022-12-28 04:58:36', '2022-12-28 04:58:36'),
(704, 'detalle_venta_producto', '25', 'Detalle compra', '1', '1', '1', '2022-12-28 04:58:36', '2022-12-28 04:58:36'),
(705, 'venta_producto', '10', 'Nueva venta', '1', '1', '1', '2022-12-28 05:10:14', '2022-12-28 05:10:14'),
(706, 'pago_venta_producto', '18', 'Agregar pago venta', '1', '1', '1', '2022-12-28 05:10:14', '2022-12-28 05:10:14'),
(707, 'detalle_venta_producto', '26', 'Detalle compra', '1', '1', '1', '2022-12-28 05:10:14', '2022-12-28 05:10:14'),
(708, 'detalle_venta_producto', '27', 'Detalle compra', '1', '1', '1', '2022-12-28 05:10:14', '2022-12-28 05:10:14'),
(709, 'detalle_venta_producto', '28', 'Detalle compra', '1', '1', '1', '2022-12-28 05:10:14', '2022-12-28 05:10:14'),
(710, 'detalle_venta_producto', '29', 'Detalle compra', '1', '1', '1', '2022-12-28 05:10:14', '2022-12-28 05:10:14'),
(711, 'detalle_venta_producto', '30', 'Detalle compra', '1', '1', '1', '2022-12-28 05:10:14', '2022-12-28 05:10:14'),
(712, 'venta_producto', '9', 'Editar compra', '1', '1', '1', '2022-12-28 06:24:38', '2022-12-28 06:24:38'),
(713, 'detalle_venta_producto', '31', 'Detalle editado compra', '1', '1', '1', '2022-12-28 06:24:38', '2022-12-28 06:24:38'),
(714, 'detalle_venta_producto', '32', 'Detalle editado compra', '1', '1', '1', '2022-12-28 06:24:38', '2022-12-28 06:24:38'),
(715, 'detalle_venta_producto', '33', 'Detalle editado compra', '1', '1', '1', '2022-12-28 06:24:38', '2022-12-28 06:24:38'),
(716, 'detalle_venta_producto', '34', 'Detalle editado compra', '1', '1', '1', '2022-12-28 06:24:38', '2022-12-28 06:24:38'),
(717, 'detalle_venta_producto', '35', 'Detalle editado compra', '1', '1', '1', '2022-12-28 06:24:38', '2022-12-28 06:24:38'),
(718, 'compra_producto', '8', 'Nueva compra', '1', '1', '1', '2022-12-28 16:14:42', '2022-12-28 16:14:42'),
(719, 'detalle_compra_producto', '20', 'Detalle compra', '1', '1', '1', '2022-12-28 16:14:42', '2022-12-28 16:14:42'),
(720, 'detalle_compra_producto', '21', 'Detalle compra', '1', '1', '1', '2022-12-28 16:14:42', '2022-12-28 16:14:42'),
(721, 'detalle_compra_producto', '22', 'Detalle compra', '1', '1', '1', '2022-12-28 16:14:42', '2022-12-28 16:14:42'),
(722, 'detalle_compra_producto', '23', 'Detalle compra', '1', '1', '1', '2022-12-28 16:14:42', '2022-12-28 16:14:42'),
(723, 'detalle_compra_producto', '24', 'Detalle compra', '1', '1', '1', '2022-12-28 16:14:42', '2022-12-28 16:14:42'),
(724, 'venta_producto', '11', 'Nueva venta', '1', '1', '1', '2022-12-28 16:33:44', '2022-12-28 16:33:44'),
(725, 'pago_venta_producto', '19', 'Agregar pago venta', '1', '1', '1', '2022-12-28 16:33:44', '2022-12-28 16:33:44'),
(726, 'detalle_venta_producto', '36', 'Detalle compra', '1', '1', '1', '2022-12-28 16:33:44', '2022-12-28 16:33:44'),
(727, 'detalle_venta_producto', '37', 'Detalle compra', '1', '1', '1', '2022-12-28 16:33:44', '2022-12-28 16:33:44'),
(728, 'detalle_venta_producto', '38', 'Detalle compra', '1', '1', '1', '2022-12-28 16:33:44', '2022-12-28 16:33:44'),
(729, 'detalle_venta_producto', '39', 'Detalle compra', '1', '1', '1', '2022-12-28 16:33:44', '2022-12-28 16:33:44'),
(730, 'detalle_venta_producto', '40', 'Detalle compra', '1', '1', '1', '2022-12-28 16:33:44', '2022-12-28 16:33:44'),
(731, 'venta_producto', '11', 'Editar compra', '1', '1', '1', '2022-12-28 16:56:25', '2022-12-28 16:56:25'),
(732, 'detalle_venta_producto', '41', 'Detalle editado compra', '1', '1', '1', '2022-12-28 16:56:25', '2022-12-28 16:56:25'),
(733, 'detalle_venta_producto', '42', 'Detalle editado compra', '1', '1', '1', '2022-12-28 16:56:25', '2022-12-28 16:56:25'),
(734, 'detalle_venta_producto', '43', 'Detalle editado compra', '1', '1', '1', '2022-12-28 16:56:25', '2022-12-28 16:56:25'),
(735, 'detalle_venta_producto', '44', 'Detalle editado compra', '1', '1', '1', '2022-12-28 16:56:25', '2022-12-28 16:56:25'),
(736, 'detalle_venta_producto', '45', 'Detalle editado compra', '1', '1', '1', '2022-12-28 16:56:25', '2022-12-28 16:56:25'),
(737, 'compra_producto', '9', 'Nueva compra', '1', '1', '1', '2022-12-28 17:05:37', '2022-12-28 17:05:37'),
(738, 'detalle_compra_producto', '25', 'Detalle compra', '1', '1', '1', '2022-12-28 17:05:37', '2022-12-28 17:05:37'),
(739, 'detalle_compra_producto', '26', 'Detalle compra', '1', '1', '1', '2022-12-28 17:05:37', '2022-12-28 17:05:37'),
(740, 'detalle_compra_producto', '27', 'Detalle compra', '1', '1', '1', '2022-12-28 17:05:37', '2022-12-28 17:05:37'),
(741, 'detalle_compra_producto', '28', 'Detalle compra', '1', '1', '1', '2022-12-28 17:05:37', '2022-12-28 17:05:37'),
(742, 'detalle_compra_producto', '29', 'Detalle compra', '1', '1', '1', '2022-12-28 17:05:37', '2022-12-28 17:05:37'),
(743, 'venta_producto', '12', 'Nueva venta', '1', '1', '1', '2022-12-28 17:06:37', '2022-12-28 17:06:37'),
(744, 'pago_venta_producto', '20', 'Agregar pago venta', '1', '1', '1', '2022-12-28 17:06:37', '2022-12-28 17:06:37'),
(745, 'detalle_venta_producto', '46', 'Detalle compra', '1', '1', '1', '2022-12-28 17:06:37', '2022-12-28 17:06:37'),
(746, 'detalle_venta_producto', '47', 'Detalle compra', '1', '1', '1', '2022-12-28 17:06:37', '2022-12-28 17:06:37'),
(747, 'detalle_venta_producto', '48', 'Detalle compra', '1', '1', '1', '2022-12-28 17:06:37', '2022-12-28 17:06:37'),
(748, 'detalle_venta_producto', '49', 'Detalle compra', '1', '1', '1', '2022-12-28 17:06:37', '2022-12-28 17:06:37'),
(749, 'detalle_venta_producto', '50', 'Detalle compra', '1', '1', '1', '2022-12-28 17:06:37', '2022-12-28 17:06:37'),
(750, 'venta_producto', '12', 'Editar compra', '1', '1', '1', '2022-12-28 17:08:40', '2022-12-28 17:08:40'),
(751, 'detalle_venta_producto', '51', 'Detalle editado compra', '1', '1', '1', '2022-12-28 17:08:40', '2022-12-28 17:08:40'),
(752, 'detalle_venta_producto', '52', 'Detalle editado compra', '1', '1', '1', '2022-12-28 17:08:40', '2022-12-28 17:08:40'),
(753, 'detalle_venta_producto', '53', 'Detalle editado compra', '1', '1', '1', '2022-12-28 17:08:40', '2022-12-28 17:08:40'),
(754, 'detalle_venta_producto', '54', 'Detalle editado compra', '1', '1', '1', '2022-12-28 17:08:40', '2022-12-28 17:08:40'),
(755, 'detalle_venta_producto', '55', 'Detalle editado compra', '1', '1', '1', '2022-12-28 17:08:40', '2022-12-28 17:08:40'),
(756, 'venta_producto', '12', 'Se envio a papelera.', '1', '1', '1', '2022-12-28 22:34:51', '2022-12-28 22:34:51'),
(757, 'venta_producto', '11', 'Se elimino este registro.', '1', '1', '1', '2022-12-28 22:36:54', '2022-12-28 22:36:54'),
(758, 'venta_producto', '2', 'Se envio a papelera.', '1', '1', '1', '2022-12-28 22:36:57', '2022-12-28 22:36:57'),
(759, 'venta_producto', '1', 'Se elimino este registro.', '1', '1', '1', '2022-12-28 22:37:00', '2022-12-28 22:37:00'),
(760, 'venta_producto', '8', 'Se elimino este registro.', '1', '1', '1', '2022-12-28 22:37:05', '2022-12-28 22:37:05'),
(761, 'venta_producto', '4', 'Se elimino este registro.', '1', '1', '1', '2022-12-28 22:37:07', '2022-12-28 22:37:07'),
(762, 'venta_producto', '7', 'Se elimino este registro.', '1', '1', '1', '2022-12-28 22:37:09', '2022-12-28 22:37:09'),
(763, 'venta_producto', '3', 'Se envio a papelera.', '1', '1', '1', '2022-12-28 22:37:12', '2022-12-28 22:37:12'),
(764, 'venta_producto', '5', 'Se elimino este registro.', '1', '1', '1', '2022-12-28 22:37:14', '2022-12-28 22:37:14'),
(765, 'venta_producto', '6', 'Se elimino este registro.', '1', '1', '1', '2022-12-28 22:37:17', '2022-12-28 22:37:17'),
(766, 'venta_producto', '9', 'Se elimino este registro.', '1', '1', '1', '2022-12-28 22:37:20', '2022-12-28 22:37:20'),
(767, 'venta_producto', '10', 'Se elimino este registro.', '1', '1', '1', '2022-12-28 22:37:23', '2022-12-28 22:37:23'),
(768, 'compra_producto', '10', 'Nueva compra', '1', '1', '1', '2022-12-28 22:49:20', '2022-12-28 22:49:20'),
(769, 'detalle_compra_producto', '30', 'Detalle compra', '1', '1', '1', '2022-12-28 22:49:20', '2022-12-28 22:49:20'),
(770, 'detalle_compra_producto', '31', 'Detalle compra', '1', '1', '1', '2022-12-28 22:49:20', '2022-12-28 22:49:20'),
(771, 'detalle_compra_producto', '32', 'Detalle compra', '1', '1', '1', '2022-12-28 22:49:20', '2022-12-28 22:49:20'),
(772, 'detalle_compra_producto', '33', 'Detalle compra', '1', '1', '1', '2022-12-28 22:49:20', '2022-12-28 22:49:20'),
(773, 'detalle_compra_producto', '34', 'Detalle compra', '1', '1', '1', '2022-12-28 22:49:20', '2022-12-28 22:49:20'),
(774, 'detalle_compra_producto', '35', 'Detalle compra', '1', '1', '1', '2022-12-28 22:49:20', '2022-12-28 22:49:20'),
(775, 'detalle_compra_producto', '36', 'Detalle compra', '1', '1', '1', '2022-12-28 22:49:20', '2022-12-28 22:49:20'),
(776, 'detalle_compra_producto', '37', 'Detalle compra', '1', '1', '1', '2022-12-28 22:49:20', '2022-12-28 22:49:20'),
(777, 'detalle_compra_producto', '38', 'Detalle compra', '1', '1', '1', '2022-12-28 22:49:20', '2022-12-28 22:49:20'),
(778, 'detalle_compra_producto', '39', 'Detalle compra', '1', '1', '1', '2022-12-28 22:49:20', '2022-12-28 22:49:20'),
(779, 'producto', '1', 'Producto editado', '1', '1', '1', '2022-12-28 22:51:19', '2022-12-28 22:51:19'),
(780, 'venta_producto', '13', 'Nueva venta', '1', '1', '1', '2022-12-28 22:53:30', '2022-12-28 22:53:30'),
(781, 'pago_venta_producto', '21', 'Agregar pago venta', '1', '1', '1', '2022-12-28 22:53:30', '2022-12-28 22:53:30'),
(782, 'detalle_venta_producto', '56', 'Detalle compra', '1', '1', '1', '2022-12-28 22:53:30', '2022-12-28 22:53:30'),
(783, 'detalle_venta_producto', '57', 'Detalle compra', '1', '1', '1', '2022-12-28 22:53:30', '2022-12-28 22:53:30'),
(784, 'detalle_venta_producto', '58', 'Detalle compra', '1', '1', '1', '2022-12-28 22:53:30', '2022-12-28 22:53:30'),
(785, 'detalle_venta_producto', '59', 'Detalle compra', '1', '1', '1', '2022-12-28 22:53:30', '2022-12-28 22:53:30'),
(786, 'detalle_venta_producto', '60', 'Detalle compra', '1', '1', '1', '2022-12-28 22:53:30', '2022-12-28 22:53:30'),
(787, 'venta_producto', '13', 'Editar compra', '1', '1', '1', '2022-12-28 22:54:21', '2022-12-28 22:54:21'),
(788, 'detalle_venta_producto', '61', 'Detalle editado compra', '1', '1', '1', '2022-12-28 22:54:21', '2022-12-28 22:54:21'),
(789, 'detalle_venta_producto', '62', 'Detalle editado compra', '1', '1', '1', '2022-12-28 22:54:21', '2022-12-28 22:54:21'),
(790, 'detalle_venta_producto', '63', 'Detalle editado compra', '1', '1', '1', '2022-12-28 22:54:21', '2022-12-28 22:54:21'),
(791, 'detalle_venta_producto', '64', 'Detalle editado compra', '1', '1', '1', '2022-12-28 22:54:21', '2022-12-28 22:54:21'),
(792, 'detalle_venta_producto', '65', 'Detalle editado compra', '1', '1', '1', '2022-12-28 22:54:21', '2022-12-28 22:54:21');
INSERT INTO `bitacora_bd` (`idbitacora_bd`, `nombre_tabla`, `id_tabla`, `accion`, `id_user`, `estado`, `estado_delete`, `created_at`, `updated_at`) VALUES
(793, 'venta_producto', '13', 'Se envio a papelera.', '1', '1', '1', '2022-12-28 22:54:39', '2022-12-28 22:54:39'),
(794, 'venta_producto', '14', 'Nueva venta', '1', '1', '1', '2022-12-28 23:42:45', '2022-12-28 23:42:45'),
(795, 'pago_venta_producto', '22', 'Agregar pago venta', '1', '1', '1', '2022-12-28 23:42:45', '2022-12-28 23:42:45'),
(796, 'detalle_venta_producto', '66', 'Detalle compra', '1', '1', '1', '2022-12-28 23:42:45', '2022-12-28 23:42:45'),
(797, 'detalle_venta_producto', '67', 'Detalle compra', '1', '1', '1', '2022-12-28 23:42:45', '2022-12-28 23:42:45'),
(798, 'detalle_venta_producto', '68', 'Detalle compra', '1', '1', '1', '2022-12-28 23:42:45', '2022-12-28 23:42:45'),
(799, 'detalle_venta_producto', '69', 'Detalle compra', '1', '1', '1', '2022-12-28 23:42:45', '2022-12-28 23:42:45'),
(800, 'detalle_venta_producto', '70', 'Detalle compra', '1', '1', '1', '2022-12-28 23:42:45', '2022-12-28 23:42:45'),
(801, 'detalle_venta_producto', '71', 'Detalle compra', '1', '1', '1', '2022-12-28 23:42:45', '2022-12-28 23:42:45'),
(802, 'detalle_venta_producto', '72', 'Detalle compra', '1', '1', '1', '2022-12-28 23:42:45', '2022-12-28 23:42:45'),
(803, 'venta_producto', '15', 'Nueva venta', '1', '1', '1', '2022-12-28 23:55:04', '2022-12-28 23:55:04'),
(804, 'pago_venta_producto', '23', 'Agregar pago venta', '1', '1', '1', '2022-12-28 23:55:04', '2022-12-28 23:55:04'),
(805, 'detalle_venta_producto', '73', 'Detalle compra', '1', '1', '1', '2022-12-28 23:55:04', '2022-12-28 23:55:04'),
(806, 'venta_producto', '15', 'Editar compra', '1', '1', '1', '2022-12-28 23:55:27', '2022-12-28 23:55:27'),
(807, 'detalle_venta_producto', '74', 'Detalle editado compra', '1', '1', '1', '2022-12-28 23:55:27', '2022-12-28 23:55:27'),
(808, 'venta_producto', '16', 'Nueva venta', '1', '1', '1', '2022-12-30 06:28:43', '2022-12-30 06:28:43'),
(809, 'pago_venta_producto', '24', 'Agregar pago venta', '1', '1', '1', '2022-12-30 06:28:43', '2022-12-30 06:28:43'),
(810, 'detalle_venta_producto', '75', 'Detalle compra', '1', '1', '1', '2022-12-30 06:28:43', '2022-12-30 06:28:43'),
(811, 'detalle_venta_producto', '76', 'Detalle compra', '1', '1', '1', '2022-12-30 06:28:43', '2022-12-30 06:28:43'),
(812, 'detalle_venta_producto', '77', 'Detalle compra', '1', '1', '1', '2022-12-30 06:28:43', '2022-12-30 06:28:43'),
(813, 'detalle_venta_producto', '78', 'Detalle compra', '1', '1', '1', '2022-12-30 06:28:43', '2022-12-30 06:28:43'),
(814, 'detalle_venta_producto', '79', 'Detalle compra', '1', '1', '1', '2022-12-30 06:28:43', '2022-12-30 06:28:43'),
(815, 'detalle_venta_producto', '80', 'Detalle compra', '1', '1', '1', '2022-12-30 06:28:43', '2022-12-30 06:28:43'),
(816, 'detalle_venta_producto', '81', 'Detalle compra', '1', '1', '1', '2022-12-30 06:28:43', '2022-12-30 06:28:43'),
(817, 'detalle_venta_producto', '82', 'Detalle compra', '1', '1', '1', '2022-12-30 06:28:43', '2022-12-30 06:28:43'),
(818, 'detalle_venta_producto', '83', 'Detalle compra', '1', '1', '1', '2022-12-30 06:28:43', '2022-12-30 06:28:43'),
(819, 'detalle_venta_producto', '84', 'Detalle compra', '1', '1', '1', '2022-12-30 06:28:43', '2022-12-30 06:28:43'),
(820, 'venta_producto', '17', 'Nueva venta', '1', '1', '1', '2022-12-31 00:27:23', '2022-12-31 00:27:23'),
(821, 'pago_venta_producto', '25', 'Agregar pago venta', '1', '1', '1', '2022-12-31 00:27:23', '2022-12-31 00:27:23'),
(822, 'detalle_venta_producto', '85', 'Detalle compra', '1', '1', '1', '2022-12-31 00:27:23', '2022-12-31 00:27:23'),
(823, 'detalle_venta_producto', '86', 'Detalle compra', '1', '1', '1', '2022-12-31 00:27:23', '2022-12-31 00:27:23'),
(824, 'detalle_venta_producto', '87', 'Detalle compra', '1', '1', '1', '2022-12-31 00:27:23', '2022-12-31 00:27:23'),
(825, 'detalle_venta_producto', '88', 'Detalle compra', '1', '1', '1', '2022-12-31 00:27:23', '2022-12-31 00:27:23'),
(826, 'detalle_venta_producto', '89', 'Detalle compra', '1', '1', '1', '2022-12-31 00:27:23', '2022-12-31 00:27:23'),
(827, 'detalle_venta_producto', '90', 'Detalle compra', '1', '1', '1', '2022-12-31 00:27:23', '2022-12-31 00:27:23'),
(828, 'detalle_venta_producto', '91', 'Detalle compra', '1', '1', '1', '2022-12-31 00:27:23', '2022-12-31 00:27:23'),
(829, 'detalle_venta_producto', '92', 'Detalle compra', '1', '1', '1', '2022-12-31 00:27:23', '2022-12-31 00:27:23'),
(830, 'detalle_venta_producto', '93', 'Detalle compra', '1', '1', '1', '2022-12-31 00:27:23', '2022-12-31 00:27:23'),
(831, 'detalle_venta_producto', '94', 'Detalle compra', '1', '1', '1', '2022-12-31 00:27:23', '2022-12-31 00:27:23'),
(832, 'venta_producto', '14', 'Se envio a papelera.', '1', '1', '1', '2022-12-31 00:33:39', '2022-12-31 00:33:39'),
(833, 'venta_producto', '17', 'Se envio a papelera.', '1', '1', '1', '2022-12-31 00:33:42', '2022-12-31 00:33:42'),
(834, 'venta_producto', '15', 'Se envio a papelera.', '1', '1', '1', '2022-12-31 00:33:44', '2022-12-31 00:33:44'),
(835, 'venta_producto', '16', 'Se envio a papelera.', '1', '1', '1', '2022-12-31 00:33:48', '2022-12-31 00:33:48'),
(836, 'venta_producto', '18', 'Nueva venta', '1', '1', '1', '2022-12-31 02:03:36', '2022-12-31 02:03:36'),
(837, 'pago_venta_producto', '26', 'Agregar pago venta', '1', '1', '1', '2022-12-31 02:03:36', '2022-12-31 02:03:36'),
(838, 'detalle_venta_producto', '95', 'Detalle compra', '1', '1', '1', '2022-12-31 02:03:36', '2022-12-31 02:03:36'),
(839, 'detalle_venta_producto', '96', 'Detalle compra', '1', '1', '1', '2022-12-31 02:03:36', '2022-12-31 02:03:36'),
(840, 'detalle_venta_producto', '97', 'Detalle compra', '1', '1', '1', '2022-12-31 02:03:36', '2022-12-31 02:03:36'),
(841, 'detalle_venta_producto', '98', 'Detalle compra', '1', '1', '1', '2022-12-31 02:03:36', '2022-12-31 02:03:36'),
(842, 'detalle_venta_producto', '99', 'Detalle compra', '1', '1', '1', '2022-12-31 02:03:36', '2022-12-31 02:03:36'),
(843, 'detalle_venta_producto', '100', 'Detalle compra', '1', '1', '1', '2022-12-31 02:03:36', '2022-12-31 02:03:36'),
(844, 'detalle_venta_producto', '101', 'Detalle compra', '1', '1', '1', '2022-12-31 02:03:36', '2022-12-31 02:03:36'),
(845, 'detalle_venta_producto', '102', 'Detalle compra', '1', '1', '1', '2022-12-31 02:03:36', '2022-12-31 02:03:36'),
(846, 'detalle_venta_producto', '103', 'Detalle compra', '1', '1', '1', '2022-12-31 02:03:36', '2022-12-31 02:03:36'),
(847, 'detalle_venta_producto', '104', 'Detalle compra', '1', '1', '1', '2022-12-31 02:03:36', '2022-12-31 02:03:36'),
(848, 'venta_producto', '19', 'Nueva venta', '1', '1', '1', '2022-12-31 03:36:21', '2022-12-31 03:36:21'),
(849, 'pago_venta_producto', '27', 'Agregar pago venta', '1', '1', '1', '2022-12-31 03:36:21', '2022-12-31 03:36:21'),
(850, 'detalle_venta_producto', '105', 'Detalle compra', '1', '1', '1', '2022-12-31 03:36:21', '2022-12-31 03:36:21'),
(851, 'detalle_venta_producto', '106', 'Detalle compra', '1', '1', '1', '2022-12-31 03:36:21', '2022-12-31 03:36:21'),
(852, 'detalle_venta_producto', '107', 'Detalle compra', '1', '1', '1', '2022-12-31 03:36:21', '2022-12-31 03:36:21'),
(853, 'detalle_venta_producto', '108', 'Detalle compra', '1', '1', '1', '2022-12-31 03:36:21', '2022-12-31 03:36:21'),
(854, 'detalle_venta_producto', '109', 'Detalle compra', '1', '1', '1', '2022-12-31 03:36:21', '2022-12-31 03:36:21'),
(855, 'detalle_venta_producto', '110', 'Detalle compra', '1', '1', '1', '2022-12-31 03:36:21', '2022-12-31 03:36:21'),
(856, 'detalle_venta_producto', '111', 'Detalle compra', '1', '1', '1', '2022-12-31 03:36:21', '2022-12-31 03:36:21'),
(857, 'detalle_venta_producto', '112', 'Detalle compra', '1', '1', '1', '2022-12-31 03:36:21', '2022-12-31 03:36:21'),
(858, 'detalle_venta_producto', '113', 'Detalle compra', '1', '1', '1', '2022-12-31 03:36:21', '2022-12-31 03:36:21'),
(859, 'venta_producto', '20', 'Nueva venta', '1', '1', '1', '2022-12-31 03:37:13', '2022-12-31 03:37:13'),
(860, 'pago_venta_producto', '28', 'Agregar pago venta', '1', '1', '1', '2022-12-31 03:37:13', '2022-12-31 03:37:13'),
(861, 'detalle_venta_producto', '114', 'Detalle compra', '1', '1', '1', '2022-12-31 03:37:14', '2022-12-31 03:37:14'),
(862, 'detalle_venta_producto', '115', 'Detalle compra', '1', '1', '1', '2022-12-31 03:37:14', '2022-12-31 03:37:14'),
(863, 'detalle_venta_producto', '116', 'Detalle compra', '1', '1', '1', '2022-12-31 03:37:14', '2022-12-31 03:37:14'),
(864, 'detalle_venta_producto', '117', 'Detalle compra', '1', '1', '1', '2022-12-31 03:37:14', '2022-12-31 03:37:14'),
(865, 'detalle_venta_producto', '118', 'Detalle compra', '1', '1', '1', '2022-12-31 03:37:14', '2022-12-31 03:37:14'),
(866, 'detalle_venta_producto', '119', 'Detalle compra', '1', '1', '1', '2022-12-31 03:37:14', '2022-12-31 03:37:14'),
(867, 'detalle_venta_producto', '120', 'Detalle compra', '1', '1', '1', '2022-12-31 03:37:14', '2022-12-31 03:37:14'),
(868, 'detalle_venta_producto', '121', 'Detalle compra', '1', '1', '1', '2022-12-31 03:37:14', '2022-12-31 03:37:14'),
(869, 'detalle_venta_producto', '122', 'Detalle compra', '1', '1', '1', '2022-12-31 03:37:14', '2022-12-31 03:37:14'),
(870, 'venta_producto', '21', 'Nueva venta', '1', '1', '1', '2022-12-31 05:49:11', '2022-12-31 05:49:11'),
(871, 'pago_venta_producto', '29', 'Agregar pago venta', '1', '1', '1', '2022-12-31 05:49:11', '2022-12-31 05:49:11'),
(872, 'detalle_venta_producto', '123', 'Detalle compra', '1', '1', '1', '2022-12-31 05:49:11', '2022-12-31 05:49:11'),
(873, 'detalle_venta_producto', '124', 'Detalle compra', '1', '1', '1', '2022-12-31 05:49:11', '2022-12-31 05:49:11'),
(874, 'detalle_venta_producto', '125', 'Detalle compra', '1', '1', '1', '2022-12-31 05:49:11', '2022-12-31 05:49:11'),
(875, 'detalle_venta_producto', '126', 'Detalle compra', '1', '1', '1', '2022-12-31 05:49:11', '2022-12-31 05:49:11'),
(876, 'detalle_venta_producto', '127', 'Detalle compra', '1', '1', '1', '2022-12-31 05:49:11', '2022-12-31 05:49:11'),
(877, 'detalle_venta_producto', '128', 'Detalle compra', '1', '1', '1', '2022-12-31 05:49:11', '2022-12-31 05:49:11'),
(878, 'detalle_venta_producto', '129', 'Detalle compra', '1', '1', '1', '2022-12-31 05:49:11', '2022-12-31 05:49:11'),
(879, 'detalle_venta_producto', '130', 'Detalle compra', '1', '1', '1', '2022-12-31 05:49:11', '2022-12-31 05:49:11'),
(880, 'detalle_venta_producto', '131', 'Detalle compra', '1', '1', '1', '2022-12-31 05:49:11', '2022-12-31 05:49:11'),
(881, 'detalle_venta_producto', '132', 'Detalle compra', '1', '1', '1', '2022-12-31 05:49:11', '2022-12-31 05:49:11'),
(882, 'venta_producto', '19', 'Se elimino este registro.', '1', '1', '1', '2023-01-01 03:45:52', '2023-01-01 03:45:52'),
(883, 'venta_producto', '21', 'Se elimino este registro.', '1', '1', '1', '2023-01-01 03:55:36', '2023-01-01 03:55:36'),
(884, 'venta_producto', '22', 'Nueva venta', '1', '1', '1', '2023-01-01 03:59:26', '2023-01-01 03:59:26'),
(885, 'pago_venta_producto', '30', 'Agregar pago venta', '1', '1', '1', '2023-01-01 03:59:26', '2023-01-01 03:59:26'),
(886, 'detalle_venta_producto', '133', 'Detalle compra', '1', '1', '1', '2023-01-01 03:59:26', '2023-01-01 03:59:26'),
(887, 'detalle_venta_producto', '134', 'Detalle compra', '1', '1', '1', '2023-01-01 03:59:26', '2023-01-01 03:59:26'),
(888, 'detalle_venta_producto', '135', 'Detalle compra', '1', '1', '1', '2023-01-01 03:59:26', '2023-01-01 03:59:26'),
(889, 'detalle_venta_producto', '136', 'Detalle compra', '1', '1', '1', '2023-01-01 03:59:26', '2023-01-01 03:59:26'),
(890, 'detalle_venta_producto', '137', 'Detalle compra', '1', '1', '1', '2023-01-01 03:59:26', '2023-01-01 03:59:26'),
(891, 'detalle_venta_producto', '138', 'Detalle compra', '1', '1', '1', '2023-01-01 03:59:26', '2023-01-01 03:59:26'),
(892, 'detalle_venta_producto', '139', 'Detalle compra', '1', '1', '1', '2023-01-01 03:59:26', '2023-01-01 03:59:26'),
(893, 'detalle_venta_producto', '140', 'Detalle compra', '1', '1', '1', '2023-01-01 03:59:26', '2023-01-01 03:59:26'),
(894, 'detalle_venta_producto', '141', 'Detalle compra', '1', '1', '1', '2023-01-01 03:59:26', '2023-01-01 03:59:26'),
(895, 'detalle_venta_producto', '142', 'Detalle compra', '1', '1', '1', '2023-01-01 03:59:26', '2023-01-01 03:59:26'),
(896, 'venta_producto', '23', 'Nueva venta', '1', '1', '1', '2023-01-01 04:00:36', '2023-01-01 04:00:36'),
(897, 'pago_venta_producto', '31', 'Agregar pago venta', '1', '1', '1', '2023-01-01 04:00:36', '2023-01-01 04:00:36'),
(898, 'detalle_venta_producto', '143', 'Detalle compra', '1', '1', '1', '2023-01-01 04:00:36', '2023-01-01 04:00:36'),
(899, 'detalle_venta_producto', '144', 'Detalle compra', '1', '1', '1', '2023-01-01 04:00:36', '2023-01-01 04:00:36'),
(900, 'detalle_venta_producto', '145', 'Detalle compra', '1', '1', '1', '2023-01-01 04:00:36', '2023-01-01 04:00:36'),
(901, 'venta_producto', '24', 'Nueva venta', '1', '1', '1', '2023-01-01 04:01:04', '2023-01-01 04:01:04'),
(902, 'pago_venta_producto', '32', 'Agregar pago venta', '1', '1', '1', '2023-01-01 04:01:04', '2023-01-01 04:01:04'),
(903, 'detalle_venta_producto', '146', 'Detalle compra', '1', '1', '1', '2023-01-01 04:01:04', '2023-01-01 04:01:04'),
(904, 'detalle_venta_producto', '147', 'Detalle compra', '1', '1', '1', '2023-01-01 04:01:04', '2023-01-01 04:01:04'),
(905, 'detalle_venta_producto', '148', 'Detalle compra', '1', '1', '1', '2023-01-01 04:01:04', '2023-01-01 04:01:04'),
(906, 'detalle_venta_producto', '149', 'Detalle compra', '1', '1', '1', '2023-01-01 04:01:04', '2023-01-01 04:01:04'),
(907, 'detalle_venta_producto', '150', 'Detalle compra', '1', '1', '1', '2023-01-01 04:01:04', '2023-01-01 04:01:04'),
(908, 'detalle_venta_producto', '151', 'Detalle compra', '1', '1', '1', '2023-01-01 04:01:04', '2023-01-01 04:01:04'),
(909, 'detalle_venta_producto', '152', 'Detalle compra', '1', '1', '1', '2023-01-01 04:01:04', '2023-01-01 04:01:04'),
(910, 'detalle_venta_producto', '153', 'Detalle compra', '1', '1', '1', '2023-01-01 04:01:04', '2023-01-01 04:01:04'),
(911, 'detalle_venta_producto', '154', 'Detalle compra', '1', '1', '1', '2023-01-01 04:01:04', '2023-01-01 04:01:04'),
(912, 'detalle_venta_producto', '155', 'Detalle compra', '1', '1', '1', '2023-01-01 04:01:04', '2023-01-01 04:01:04'),
(913, 'compra_producto', '11', 'Nueva compra', '1', '1', '1', '2023-01-01 04:55:33', '2023-01-01 04:55:33'),
(914, 'detalle_compra_producto', '40', 'Detalle compra', '1', '1', '1', '2023-01-01 04:55:33', '2023-01-01 04:55:33'),
(915, 'detalle_compra_producto', '41', 'Detalle compra', '1', '1', '1', '2023-01-01 04:55:33', '2023-01-01 04:55:33'),
(916, 'detalle_compra_producto', '42', 'Detalle compra', '1', '1', '1', '2023-01-01 04:55:33', '2023-01-01 04:55:33'),
(917, 'detalle_compra_producto', '43', 'Detalle compra', '1', '1', '1', '2023-01-01 04:55:33', '2023-01-01 04:55:33'),
(918, 'detalle_compra_producto', '44', 'Detalle compra', '1', '1', '1', '2023-01-01 04:55:33', '2023-01-01 04:55:33'),
(919, 'detalle_compra_producto', '45', 'Detalle compra', '1', '1', '1', '2023-01-01 04:55:33', '2023-01-01 04:55:33'),
(920, 'detalle_compra_producto', '46', 'Detalle compra', '1', '1', '1', '2023-01-01 04:55:33', '2023-01-01 04:55:33'),
(921, 'detalle_compra_producto', '47', 'Detalle compra', '1', '1', '1', '2023-01-01 04:55:33', '2023-01-01 04:55:33'),
(922, 'detalle_compra_producto', '48', 'Detalle compra', '1', '1', '1', '2023-01-01 04:55:33', '2023-01-01 04:55:33'),
(923, 'detalle_compra_producto', '49', 'Detalle compra', '1', '1', '1', '2023-01-01 04:55:33', '2023-01-01 04:55:33'),
(924, 'compra_producto', '10', 'Compra desactivada', '1', '1', '1', '2023-01-01 05:02:56', '2023-01-01 05:02:56'),
(925, 'compra_producto', '8', 'Compra Eliminada', '1', '1', '1', '2023-01-01 05:22:06', '2023-01-01 05:22:06'),
(926, 'compra_producto', '1', 'Compra Eliminada', '1', '1', '1', '2023-01-01 05:28:55', '2023-01-01 05:28:55'),
(927, 'compra_producto', '12', 'Nueva compra', '1', '1', '1', '2023-01-01 05:31:05', '2023-01-01 05:31:05'),
(928, 'detalle_compra_producto', '50', 'Detalle compra', '1', '1', '1', '2023-01-01 05:31:05', '2023-01-01 05:31:05'),
(929, 'detalle_compra_producto', '51', 'Detalle compra', '1', '1', '1', '2023-01-01 05:31:05', '2023-01-01 05:31:05'),
(930, 'detalle_compra_producto', '52', 'Detalle compra', '1', '1', '1', '2023-01-01 05:31:05', '2023-01-01 05:31:05'),
(931, 'detalle_compra_producto', '53', 'Detalle compra', '1', '1', '1', '2023-01-01 05:31:05', '2023-01-01 05:31:05'),
(932, 'detalle_compra_producto', '54', 'Detalle compra', '1', '1', '1', '2023-01-01 05:31:05', '2023-01-01 05:31:05'),
(933, 'compra_producto', '13', 'Nueva compra', '1', '1', '1', '2023-01-01 05:32:26', '2023-01-01 05:32:26'),
(934, 'detalle_compra_producto', '55', 'Detalle compra', '1', '1', '1', '2023-01-01 05:32:26', '2023-01-01 05:32:26'),
(935, 'detalle_compra_producto', '56', 'Detalle compra', '1', '1', '1', '2023-01-01 05:32:26', '2023-01-01 05:32:26'),
(936, 'detalle_compra_producto', '57', 'Detalle compra', '1', '1', '1', '2023-01-01 05:32:26', '2023-01-01 05:32:26'),
(937, 'detalle_compra_producto', '58', 'Detalle compra', '1', '1', '1', '2023-01-01 05:32:26', '2023-01-01 05:32:26'),
(938, 'detalle_compra_producto', '59', 'Detalle compra', '1', '1', '1', '2023-01-01 05:32:26', '2023-01-01 05:32:26'),
(939, 'venta_producto', '25', 'Nueva venta', '1', '1', '1', '2023-01-02 01:46:30', '2023-01-02 01:46:30'),
(940, 'pago_venta_producto', '33', 'Agregar pago venta', '1', '1', '1', '2023-01-02 01:46:30', '2023-01-02 01:46:30'),
(941, 'detalle_venta_producto', '156', 'Detalle compra', '1', '1', '1', '2023-01-02 01:46:30', '2023-01-02 01:46:30'),
(942, 'detalle_venta_producto', '157', 'Detalle compra', '1', '1', '1', '2023-01-02 01:46:30', '2023-01-02 01:46:30'),
(943, 'detalle_venta_producto', '158', 'Detalle compra', '1', '1', '1', '2023-01-02 01:46:30', '2023-01-02 01:46:30'),
(944, 'detalle_venta_producto', '159', 'Detalle compra', '1', '1', '1', '2023-01-02 01:46:30', '2023-01-02 01:46:30'),
(945, 'detalle_venta_producto', '160', 'Detalle compra', '1', '1', '1', '2023-01-02 01:46:30', '2023-01-02 01:46:30'),
(946, 'detalle_venta_producto', '161', 'Detalle compra', '1', '1', '1', '2023-01-02 01:46:30', '2023-01-02 01:46:30'),
(947, 'detalle_venta_producto', '162', 'Detalle compra', '1', '1', '1', '2023-01-02 01:46:30', '2023-01-02 01:46:30'),
(948, 'detalle_venta_producto', '163', 'Detalle compra', '1', '1', '1', '2023-01-02 01:46:30', '2023-01-02 01:46:30'),
(949, 'detalle_venta_producto', '164', 'Detalle compra', '1', '1', '1', '2023-01-02 01:46:30', '2023-01-02 01:46:30'),
(950, 'detalle_venta_producto', '165', 'Detalle compra', '1', '1', '1', '2023-01-02 01:46:30', '2023-01-02 01:46:30'),
(951, 'venta_producto', '26', 'Nueva venta', '1', '1', '1', '2023-01-02 01:46:49', '2023-01-02 01:46:49'),
(952, 'pago_venta_producto', '34', 'Agregar pago venta', '1', '1', '1', '2023-01-02 01:46:49', '2023-01-02 01:46:49'),
(953, 'detalle_venta_producto', '166', 'Detalle compra', '1', '1', '1', '2023-01-02 01:46:49', '2023-01-02 01:46:49'),
(954, 'detalle_venta_producto', '167', 'Detalle compra', '1', '1', '1', '2023-01-02 01:46:49', '2023-01-02 01:46:49'),
(955, 'detalle_venta_producto', '168', 'Detalle compra', '1', '1', '1', '2023-01-02 01:46:49', '2023-01-02 01:46:49'),
(956, 'detalle_venta_producto', '169', 'Detalle compra', '1', '1', '1', '2023-01-02 01:46:49', '2023-01-02 01:46:49'),
(957, 'detalle_venta_producto', '170', 'Detalle compra', '1', '1', '1', '2023-01-02 01:46:49', '2023-01-02 01:46:49'),
(958, 'detalle_venta_producto', '171', 'Detalle compra', '1', '1', '1', '2023-01-02 01:46:49', '2023-01-02 01:46:49'),
(959, 'detalle_venta_producto', '172', 'Detalle compra', '1', '1', '1', '2023-01-02 01:46:49', '2023-01-02 01:46:49'),
(960, 'detalle_venta_producto', '173', 'Detalle compra', '1', '1', '1', '2023-01-02 01:46:49', '2023-01-02 01:46:49'),
(961, 'detalle_venta_producto', '174', 'Detalle compra', '1', '1', '1', '2023-01-02 01:46:49', '2023-01-02 01:46:49'),
(962, 'detalle_venta_producto', '175', 'Detalle compra', '1', '1', '1', '2023-01-02 01:46:49', '2023-01-02 01:46:49'),
(963, 'venta_producto', '27', 'Nueva venta', '1', '1', '1', '2023-01-02 01:55:47', '2023-01-02 01:55:47'),
(964, 'pago_venta_producto', '35', 'Agregar pago venta', '1', '1', '1', '2023-01-02 01:55:47', '2023-01-02 01:55:47'),
(965, 'detalle_venta_producto', '176', 'Detalle compra', '1', '1', '1', '2023-01-02 01:55:47', '2023-01-02 01:55:47'),
(966, 'detalle_venta_producto', '177', 'Detalle compra', '1', '1', '1', '2023-01-02 01:55:47', '2023-01-02 01:55:47'),
(967, 'detalle_venta_producto', '178', 'Detalle compra', '1', '1', '1', '2023-01-02 01:55:47', '2023-01-02 01:55:47'),
(968, 'detalle_venta_producto', '179', 'Detalle compra', '1', '1', '1', '2023-01-02 01:55:47', '2023-01-02 01:55:47'),
(969, 'detalle_venta_producto', '180', 'Detalle compra', '1', '1', '1', '2023-01-02 01:55:47', '2023-01-02 01:55:47'),
(970, 'detalle_venta_producto', '181', 'Detalle compra', '1', '1', '1', '2023-01-02 01:55:47', '2023-01-02 01:55:47'),
(971, 'detalle_venta_producto', '182', 'Detalle compra', '1', '1', '1', '2023-01-02 01:55:47', '2023-01-02 01:55:47'),
(972, 'venta_producto', '28', 'Nueva venta', '1', '1', '1', '2023-01-02 02:05:24', '2023-01-02 02:05:24'),
(973, 'pago_venta_producto', '36', 'Agregar pago venta', '1', '1', '1', '2023-01-02 02:05:24', '2023-01-02 02:05:24'),
(974, 'detalle_venta_producto', '183', 'Detalle compra', '1', '1', '1', '2023-01-02 02:05:24', '2023-01-02 02:05:24'),
(975, 'detalle_venta_producto', '184', 'Detalle compra', '1', '1', '1', '2023-01-02 02:05:24', '2023-01-02 02:05:24'),
(976, 'detalle_venta_producto', '185', 'Detalle compra', '1', '1', '1', '2023-01-02 02:05:24', '2023-01-02 02:05:24'),
(977, 'detalle_venta_producto', '186', 'Detalle compra', '1', '1', '1', '2023-01-02 02:05:24', '2023-01-02 02:05:24'),
(978, 'pago_venta_producto', '1', 'Se edito este registro', '1', '1', '1', '2023-01-02 02:06:30', '2023-01-02 02:06:30'),
(979, 'compra_grano', '21', 'Agregar compra cafe', '1', '1', '1', '2023-01-02 03:55:59', '2023-01-02 03:55:59'),
(980, 'pago_compra_grano', '13', 'Agregar pago cafe', '1', '1', '1', '2023-01-02 03:55:59', '2023-01-02 03:55:59'),
(981, 'detalle_compra_grano', '89', 'Agregar detalle compra cafe', '1', '1', '1', '2023-01-02 03:55:59', '2023-01-02 03:55:59'),
(982, 'usuario', '1', 'Editamos los campos del usuario', '1', '1', '1', '2023-01-02 04:25:26', '2023-01-02 04:25:26'),
(983, 'usuario_permiso', '1', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-02 04:25:26', '2023-01-02 04:25:26'),
(984, 'usuario_permiso', '2', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-02 04:25:26', '2023-01-02 04:25:26'),
(985, 'usuario_permiso', '3', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-02 04:25:26', '2023-01-02 04:25:26'),
(986, 'usuario_permiso', '4', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-02 04:25:26', '2023-01-02 04:25:26'),
(987, 'usuario_permiso', '5', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-02 04:25:26', '2023-01-02 04:25:26'),
(988, 'usuario_permiso', '6', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-02 04:25:26', '2023-01-02 04:25:26'),
(989, 'usuario_permiso', '7', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-02 04:25:26', '2023-01-02 04:25:26'),
(990, 'usuario_permiso', '8', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-02 04:25:26', '2023-01-02 04:25:26'),
(991, 'usuario_permiso', '9', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-02 04:25:26', '2023-01-02 04:25:26'),
(992, 'usuario', '4', 'Editamos los campos del usuario', '1', '1', '1', '2023-01-02 04:25:31', '2023-01-02 04:25:31'),
(993, 'usuario_permiso', '10', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-02 04:25:31', '2023-01-02 04:25:31'),
(994, 'usuario_permiso', '11', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-02 04:25:31', '2023-01-02 04:25:31'),
(995, 'usuario_permiso', '12', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-02 04:25:31', '2023-01-02 04:25:31'),
(996, 'usuario_permiso', '13', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-02 04:25:31', '2023-01-02 04:25:31'),
(997, 'usuario_permiso', '14', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-02 04:25:31', '2023-01-02 04:25:31'),
(998, 'usuario_permiso', '15', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-02 04:25:31', '2023-01-02 04:25:31'),
(999, 'usuario_permiso', '16', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-02 04:25:31', '2023-01-02 04:25:31'),
(1000, 'usuario_permiso', '17', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-02 04:25:31', '2023-01-02 04:25:31'),
(1001, 'usuario_permiso', '18', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-02 04:25:31', '2023-01-02 04:25:31'),
(1002, 'usuario', '2', 'Editamos los campos del usuario', '1', '1', '1', '2023-01-02 04:25:34', '2023-01-02 04:25:34'),
(1003, 'usuario', '2', 'Editamos los campos del usuario', '1', '1', '1', '2023-01-02 04:25:36', '2023-01-02 04:25:36'),
(1004, 'usuario_permiso', '19', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-02 04:25:36', '2023-01-02 04:25:36'),
(1005, 'usuario_permiso', '20', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-02 04:25:36', '2023-01-02 04:25:36'),
(1006, 'usuario_permiso', '21', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-02 04:25:36', '2023-01-02 04:25:36'),
(1007, 'usuario_permiso', '22', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-02 04:25:36', '2023-01-02 04:25:36'),
(1008, 'usuario_permiso', '23', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-02 04:25:36', '2023-01-02 04:25:36'),
(1009, 'usuario_permiso', '24', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-02 04:25:36', '2023-01-02 04:25:36'),
(1010, 'usuario_permiso', '25', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-02 04:25:36', '2023-01-02 04:25:36'),
(1011, 'usuario_permiso', '26', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-02 04:25:36', '2023-01-02 04:25:36'),
(1012, 'usuario_permiso', '27', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-02 04:25:36', '2023-01-02 04:25:36'),
(1013, 'usuario', '6', 'Registrar', '1', '1', '1', '2023-01-03 17:27:43', '2023-01-03 17:27:43'),
(1014, 'usuario_permiso', '28', 'Registrar permisos', '1', '1', '1', '2023-01-03 17:27:43', '2023-01-03 17:27:43'),
(1015, 'usuario_permiso', '29', 'Registrar permisos', '1', '1', '1', '2023-01-03 17:27:43', '2023-01-03 17:27:43'),
(1016, 'usuario_permiso', '30', 'Registrar permisos', '1', '1', '1', '2023-01-03 17:27:43', '2023-01-03 17:27:43'),
(1017, 'usuario_permiso', '31', 'Registrar permisos', '1', '1', '1', '2023-01-03 17:27:43', '2023-01-03 17:27:43'),
(1018, 'usuario_permiso', '32', 'Registrar permisos', '1', '1', '1', '2023-01-03 17:27:43', '2023-01-03 17:27:43'),
(1019, 'usuario_permiso', '33', 'Registrar permisos', '1', '1', '1', '2023-01-03 17:27:43', '2023-01-03 17:27:43'),
(1020, 'usuario_permiso', '34', 'Registrar permisos', '1', '1', '1', '2023-01-03 17:27:43', '2023-01-03 17:27:43'),
(1021, 'usuario_permiso', '35', 'Registrar permisos', '1', '1', '1', '2023-01-03 17:27:43', '2023-01-03 17:27:43'),
(1022, 'usuario_permiso', '36', 'Registrar permisos', '1', '1', '1', '2023-01-03 17:27:43', '2023-01-03 17:27:43'),
(1023, 'usuario', '7', 'Registrar', '1', '1', '1', '2023-01-03 19:20:27', '2023-01-03 19:20:27'),
(1024, 'usuario_permiso', '37', 'Registrar permisos', '1', '1', '1', '2023-01-03 19:20:27', '2023-01-03 19:20:27'),
(1025, 'usuario_permiso', '38', 'Registrar permisos', '1', '1', '1', '2023-01-03 19:20:27', '2023-01-03 19:20:27'),
(1026, 'usuario_permiso', '39', 'Registrar permisos', '1', '1', '1', '2023-01-03 19:20:27', '2023-01-03 19:20:27'),
(1027, 'usuario_permiso', '40', 'Registrar permisos', '1', '1', '1', '2023-01-03 19:20:27', '2023-01-03 19:20:27'),
(1028, 'usuario_permiso', '41', 'Registrar permisos', '1', '1', '1', '2023-01-03 19:20:27', '2023-01-03 19:20:27'),
(1029, 'usuario_permiso', '42', 'Registrar permisos', '1', '1', '1', '2023-01-03 19:20:27', '2023-01-03 19:20:27'),
(1030, 'usuario_permiso', '43', 'Registrar permisos', '1', '1', '1', '2023-01-03 19:20:27', '2023-01-03 19:20:27'),
(1031, 'usuario_permiso', '44', 'Registrar permisos', '1', '1', '1', '2023-01-03 19:20:27', '2023-01-03 19:20:27'),
(1032, 'usuario_permiso', '45', 'Registrar permisos', '1', '1', '1', '2023-01-03 19:20:27', '2023-01-03 19:20:27'),
(1033, 'usuario_permiso', '4', 'Registro Eliminado', '1', '1', '1', '2023-01-03 19:22:17', '2023-01-03 19:22:17'),
(1034, 'usuario_permiso', '1', 'Registro desactivado', '1', '1', '1', '2023-01-03 19:22:20', '2023-01-03 19:22:20'),
(1035, 'usuario_permiso', '2', 'Registro Eliminado', '1', '1', '1', '2023-01-03 19:22:25', '2023-01-03 19:22:25'),
(1036, 'usuario', '4', 'Editamos los campos del usuario', '1', '1', '1', '2023-01-03 19:59:03', '2023-01-03 19:59:03'),
(1037, 'usuario_permiso', '46', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-03 19:59:03', '2023-01-03 19:59:03'),
(1038, 'usuario', '4', 'Editamos los campos del usuario', '1', '1', '1', '2023-01-03 19:59:17', '2023-01-03 19:59:17'),
(1039, 'usuario_permiso', '47', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-03 19:59:17', '2023-01-03 19:59:17'),
(1040, 'usuario_permiso', '48', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-03 19:59:17', '2023-01-03 19:59:17'),
(1041, 'usuario_permiso', '49', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-03 19:59:17', '2023-01-03 19:59:17'),
(1042, 'usuario_permiso', '50', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-03 19:59:17', '2023-01-03 19:59:17'),
(1043, 'usuario_permiso', '51', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-03 19:59:17', '2023-01-03 19:59:17'),
(1044, 'usuario_permiso', '52', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-03 19:59:17', '2023-01-03 19:59:17'),
(1045, 'usuario_permiso', '53', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-03 19:59:17', '2023-01-03 19:59:17'),
(1046, 'usuario_permiso', '54', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-03 19:59:17', '2023-01-03 19:59:17'),
(1047, 'usuario_permiso', '55', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-03 19:59:17', '2023-01-03 19:59:17'),
(1048, 'persona', '12', 'Editamos el registro persona', '1', '1', '1', '2023-01-03 20:50:30', '2023-01-03 20:50:30'),
(1049, 'persona', '23', 'Registro Nuevo persona', '1', '1', '1', '2023-01-03 22:07:20', '2023-01-03 22:07:20'),
(1050, 'persona', '24', 'Registro Nuevo persona', '1', '1', '1', '2023-01-03 22:11:45', '2023-01-03 22:11:45'),
(1051, 'persona', '.24.', 'Eliminar registro persona', '1', '1', '1', '2023-01-03 22:11:58', '2023-01-03 22:11:58'),
(1052, 'persona', '25', 'Registro Nuevo persona', '1', '1', '1', '2023-01-03 22:23:56', '2023-01-03 22:23:56'),
(1053, 'persona', '25', 'Editamos el registro persona', '1', '1', '1', '2023-01-03 22:25:31', '2023-01-03 22:25:31'),
(1054, 'persona', '13', 'Editamos el registro persona', '1', '1', '1', '2023-01-11 05:09:45', '2023-01-11 05:09:45'),
(1055, 'persona', '17', 'Editamos el registro persona', '1', '1', '1', '2023-01-11 05:09:56', '2023-01-11 05:09:56'),
(1056, 'persona', '18', 'Editamos el registro persona', '1', '1', '1', '2023-01-11 05:10:22', '2023-01-11 05:10:22'),
(1057, 'persona', '19', 'Editamos el registro persona', '1', '1', '1', '2023-01-11 05:10:50', '2023-01-11 05:10:50'),
(1058, 'persona', '19', 'Editamos el registro persona', '1', '1', '1', '2023-01-11 05:11:48', '2023-01-11 05:11:48'),
(1059, 'persona', '19', 'Editamos el registro persona', '1', '1', '1', '2023-01-11 05:12:03', '2023-01-11 05:12:03'),
(1060, 'persona', '4', 'Editamos el registro persona', '1', '1', '1', '2023-01-11 05:12:26', '2023-01-11 05:12:26'),
(1061, 'persona', '23', 'Editamos el registro persona', '1', '1', '1', '2023-01-11 06:40:45', '2023-01-11 06:40:45'),
(1062, 'persona', '23', 'Editamos el registro persona', '1', '1', '1', '2023-01-11 06:42:32', '2023-01-11 06:42:32'),
(1063, 'persona', '17', 'Editamos el registro persona', '1', '1', '1', '2023-01-11 17:13:27', '2023-01-11 17:13:27'),
(1064, 'persona', '17', 'Editamos el registro persona', '1', '1', '1', '2023-01-11 17:22:09', '2023-01-11 17:22:09'),
(1065, 'persona', '28', 'Registro Nuevo persona', '1', '1', '1', '2023-01-11 17:37:29', '2023-01-11 17:37:29'),
(1066, 'persona', '29', 'Registro Nuevo persona', '1', '1', '1', '2023-01-11 17:55:00', '2023-01-11 17:55:00'),
(1067, 'persona', '17', 'Editamos el registro persona', '1', '1', '1', '2023-01-11 18:11:28', '2023-01-11 18:11:28'),
(1068, 'persona', '17', 'Editamos el registro persona', '1', '1', '1', '2023-01-11 18:11:37', '2023-01-11 18:11:37'),
(1069, 'persona', '30', 'Registro Nuevo persona', '1', '1', '1', '2023-01-11 18:13:10', '2023-01-11 18:13:10'),
(1070, 'persona', '30', 'Editamos el registro persona', '1', '1', '1', '2023-01-11 18:13:22', '2023-01-11 18:13:22'),
(1071, 'producto', '6', 'Producto editado', '1', '1', '1', '2023-01-11 23:09:27', '2023-01-11 23:09:27'),
(1072, 'producto', '7', 'Producto editado', '1', '1', '1', '2023-01-11 23:22:00', '2023-01-11 23:22:00'),
(1073, 'producto', '11', 'Producto editado', '1', '1', '1', '2023-01-11 23:24:19', '2023-01-11 23:24:19'),
(1074, 'producto', '11', 'Producto editado', '1', '1', '1', '2023-01-11 23:24:24', '2023-01-11 23:24:24'),
(1075, 'producto', '12', 'Producto editado', '1', '1', '1', '2023-01-11 23:25:50', '2023-01-11 23:25:50'),
(1076, 'producto', '12', 'Producto editado', '1', '1', '1', '2023-01-11 23:26:19', '2023-01-11 23:26:19'),
(1077, 'producto', '12', 'Producto editado', '1', '1', '1', '2023-01-11 23:28:20', '2023-01-11 23:28:20'),
(1078, 'persona', '31', 'Registro Nuevo persona', '1', '1', '1', '2023-01-12 00:52:54', '2023-01-12 00:52:54'),
(1079, 'persona', '32', 'Registro Nuevo persona', '1', '1', '1', '2023-01-12 01:32:06', '2023-01-12 01:32:06'),
(1080, 'persona', '33', 'Registro Nuevo persona', '1', '1', '1', '2023-01-12 02:03:11', '2023-01-12 02:03:11'),
(1081, 'persona', '34', 'Registro Nuevo persona', '1', '1', '1', '2023-01-12 17:36:31', '2023-01-12 17:36:31'),
(1082, 'persona', '34', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 17:37:13', '2023-01-12 17:37:13'),
(1083, 'persona', '34', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 17:37:20', '2023-01-12 17:37:20'),
(1084, 'producto', '1', 'Producto editado', '1', '1', '1', '2023-01-12 18:36:57', '2023-01-12 18:36:57'),
(1085, 'producto', '1', 'Producto editado', '1', '1', '1', '2023-01-12 18:39:50', '2023-01-12 18:39:50'),
(1086, 'producto', '1', 'Producto editado', '1', '1', '1', '2023-01-12 18:39:57', '2023-01-12 18:39:57'),
(1087, 'producto', '1', 'Producto editado', '1', '1', '1', '2023-01-12 18:40:12', '2023-01-12 18:40:12'),
(1088, 'producto', '8', 'Producto editado', '1', '1', '1', '2023-01-12 18:40:23', '2023-01-12 18:40:23'),
(1089, 'producto', '6', 'Producto editado', '1', '1', '1', '2023-01-12 18:41:00', '2023-01-12 18:41:00'),
(1090, 'producto', '7', 'Producto editado', '1', '1', '1', '2023-01-12 18:41:14', '2023-01-12 18:41:14'),
(1091, 'producto', '11', 'Producto editado', '1', '1', '1', '2023-01-12 18:41:19', '2023-01-12 18:41:19'),
(1092, 'producto', '12', 'Producto editado', '1', '1', '1', '2023-01-12 18:41:24', '2023-01-12 18:41:24'),
(1093, 'producto', '1', 'Producto editado', '1', '1', '1', '2023-01-12 19:01:50', '2023-01-12 19:01:50'),
(1094, 'producto', '1', 'Producto editado', '1', '1', '1', '2023-01-12 19:05:31', '2023-01-12 19:05:31'),
(1095, 'persona', '17', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:07:25', '2023-01-12 19:07:25'),
(1096, 'persona', '17', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:07:27', '2023-01-12 19:07:27'),
(1097, 'persona', '23', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:07:38', '2023-01-12 19:07:38'),
(1098, 'persona', '26', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:07:45', '2023-01-12 19:07:45'),
(1099, 'persona', '30', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:07:52', '2023-01-12 19:07:52'),
(1100, 'persona', '30', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:07:54', '2023-01-12 19:07:54'),
(1101, 'persona', '31', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:08:01', '2023-01-12 19:08:01'),
(1102, 'persona', '31', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:08:02', '2023-01-12 19:08:02'),
(1103, 'persona', '32', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:08:09', '2023-01-12 19:08:09'),
(1104, 'persona', '32', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:08:09', '2023-01-12 19:08:09'),
(1105, 'persona', '13', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:08:16', '2023-01-12 19:08:16'),
(1106, 'persona', '18', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:08:23', '2023-01-12 19:08:23'),
(1107, 'persona', '19', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:08:31', '2023-01-12 19:08:31'),
(1108, 'persona', '27', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:08:37', '2023-01-12 19:08:37'),
(1109, 'persona', '33', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:09:00', '2023-01-12 19:09:00'),
(1110, 'persona', '33', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:09:02', '2023-01-12 19:09:02'),
(1111, 'persona', '5', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:09:10', '2023-01-12 19:09:10'),
(1112, 'persona', '5', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:09:11', '2023-01-12 19:09:11'),
(1113, 'persona', '7', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:09:18', '2023-01-12 19:09:18'),
(1114, 'persona', '8', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:09:25', '2023-01-12 19:09:25'),
(1115, 'persona', '8', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:09:27', '2023-01-12 19:09:27'),
(1116, 'persona', '9', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:09:36', '2023-01-12 19:09:36'),
(1117, 'persona', '9', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:09:37', '2023-01-12 19:09:37'),
(1118, 'persona', '12', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:09:48', '2023-01-12 19:09:48'),
(1119, 'persona', '24', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:09:56', '2023-01-12 19:09:56'),
(1120, 'persona', '24', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:09:57', '2023-01-12 19:09:57'),
(1121, 'persona', '25', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:10:11', '2023-01-12 19:10:11'),
(1122, 'persona', '25', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:10:12', '2023-01-12 19:10:12'),
(1123, 'persona', '3', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:10:30', '2023-01-12 19:10:30'),
(1124, 'persona', '3', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:10:31', '2023-01-12 19:10:31'),
(1125, 'persona', '6', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:10:43', '2023-01-12 19:10:43'),
(1126, 'persona', '6', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:10:44', '2023-01-12 19:10:44'),
(1127, 'persona', '4', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:10:56', '2023-01-12 19:10:56'),
(1128, 'persona', '4', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:10:58', '2023-01-12 19:10:58'),
(1129, 'persona', '13', 'Editamos el registro persona', '1', '1', '1', '2023-01-12 19:20:20', '2023-01-12 19:20:20'),
(1130, 'compra_producto', '1', 'Nueva compra', '1', '1', '1', '2023-01-12 19:26:33', '2023-01-12 19:26:33'),
(1131, 'detalle_compra_producto', '1', 'Detalle compra', '1', '1', '1', '2023-01-12 19:26:33', '2023-01-12 19:26:33'),
(1132, 'detalle_compra_producto', '2', 'Detalle compra', '1', '1', '1', '2023-01-12 19:26:33', '2023-01-12 19:26:33'),
(1133, 'detalle_compra_producto', '3', 'Detalle compra', '1', '1', '1', '2023-01-12 19:26:33', '2023-01-12 19:26:33'),
(1134, 'detalle_compra_producto', '4', 'Detalle compra', '1', '1', '1', '2023-01-12 19:26:33', '2023-01-12 19:26:33'),
(1135, 'detalle_compra_producto', '5', 'Detalle compra', '1', '1', '1', '2023-01-12 19:26:33', '2023-01-12 19:26:33'),
(1136, 'detalle_compra_producto', '6', 'Detalle compra', '1', '1', '1', '2023-01-12 19:26:33', '2023-01-12 19:26:33'),
(1137, 'detalle_compra_producto', '7', 'Detalle compra', '1', '1', '1', '2023-01-12 19:26:33', '2023-01-12 19:26:33'),
(1138, 'detalle_compra_producto', '8', 'Detalle compra', '1', '1', '1', '2023-01-12 19:26:33', '2023-01-12 19:26:33'),
(1139, 'detalle_compra_producto', '9', 'Detalle compra', '1', '1', '1', '2023-01-12 19:26:33', '2023-01-12 19:26:33'),
(1140, 'detalle_compra_producto', '10', 'Detalle compra', '1', '1', '1', '2023-01-12 19:26:33', '2023-01-12 19:26:33'),
(1141, 'detalle_compra_producto', '11', 'Detalle compra', '1', '1', '1', '2023-01-12 19:26:33', '2023-01-12 19:26:33'),
(1142, 'detalle_compra_producto', '12', 'Detalle compra', '1', '1', '1', '2023-01-12 19:26:33', '2023-01-12 19:26:33'),
(1143, 'compra_producto', '2', 'Nueva compra', '1', '1', '1', '2023-01-12 22:56:46', '2023-01-12 22:56:46'),
(1144, 'detalle_compra_producto', '13', 'Detalle compra', '1', '1', '1', '2023-01-12 22:56:46', '2023-01-12 22:56:46'),
(1145, 'detalle_compra_producto', '14', 'Detalle compra', '1', '1', '1', '2023-01-12 22:56:46', '2023-01-12 22:56:46'),
(1146, 'detalle_compra_producto', '15', 'Detalle compra', '1', '1', '1', '2023-01-12 22:56:46', '2023-01-12 22:56:46'),
(1147, 'detalle_compra_producto', '16', 'Detalle compra', '1', '1', '1', '2023-01-12 22:56:46', '2023-01-12 22:56:46'),
(1148, 'detalle_compra_producto', '17', 'Detalle compra', '1', '1', '1', '2023-01-12 22:56:46', '2023-01-12 22:56:46'),
(1149, 'detalle_compra_producto', '18', 'Detalle compra', '1', '1', '1', '2023-01-12 22:56:47', '2023-01-12 22:56:47'),
(1150, 'detalle_compra_producto', '19', 'Detalle compra', '1', '1', '1', '2023-01-12 22:56:47', '2023-01-12 22:56:47'),
(1151, 'detalle_compra_producto', '20', 'Detalle compra', '1', '1', '1', '2023-01-12 22:56:47', '2023-01-12 22:56:47'),
(1152, 'detalle_compra_producto', '21', 'Detalle compra', '1', '1', '1', '2023-01-12 22:56:47', '2023-01-12 22:56:47'),
(1153, 'detalle_compra_producto', '22', 'Detalle compra', '1', '1', '1', '2023-01-12 22:56:47', '2023-01-12 22:56:47'),
(1154, 'detalle_compra_producto', '23', 'Detalle compra', '1', '1', '1', '2023-01-12 22:56:47', '2023-01-12 22:56:47'),
(1155, 'detalle_compra_producto', '24', 'Detalle compra', '1', '1', '1', '2023-01-12 22:56:47', '2023-01-12 22:56:47'),
(1156, 'compra_producto', '3', 'Nueva compra', '1', '1', '1', '2023-01-13 00:22:47', '2023-01-13 00:22:47'),
(1157, 'detalle_compra_producto', '25', 'Detalle compra', '1', '1', '1', '2023-01-13 00:22:47', '2023-01-13 00:22:47'),
(1158, 'detalle_compra_producto', '26', 'Detalle compra', '1', '1', '1', '2023-01-13 00:22:47', '2023-01-13 00:22:47'),
(1159, 'venta_producto', '1', 'Nueva venta', '1', '1', '1', '2023-01-13 00:41:43', '2023-01-13 00:41:43'),
(1160, 'pago_venta_producto', '1', 'Agregar pago venta', '1', '1', '1', '2023-01-13 00:41:43', '2023-01-13 00:41:43'),
(1161, 'detalle_venta_producto', '1', 'Detalle compra', '1', '1', '1', '2023-01-13 00:41:43', '2023-01-13 00:41:43'),
(1162, 'detalle_venta_producto', '2', 'Detalle compra', '1', '1', '1', '2023-01-13 00:41:43', '2023-01-13 00:41:43'),
(1163, 'detalle_venta_producto', '3', 'Detalle compra', '1', '1', '1', '2023-01-13 00:41:43', '2023-01-13 00:41:43'),
(1164, 'venta_producto', '2', 'Nueva venta', '1', '1', '1', '2023-01-13 01:46:16', '2023-01-13 01:46:16'),
(1165, 'pago_venta_producto', '2', 'Agregar pago venta', '1', '1', '1', '2023-01-13 01:46:16', '2023-01-13 01:46:16'),
(1166, 'venta_producto', '3', 'Nueva venta', '1', '1', '1', '2023-01-13 01:47:39', '2023-01-13 01:47:39'),
(1167, 'pago_venta_producto', '3', 'Agregar pago venta', '1', '1', '1', '2023-01-13 01:47:39', '2023-01-13 01:47:39'),
(1168, 'venta_producto', '4', 'Nueva venta', '1', '1', '1', '2023-01-13 01:52:41', '2023-01-13 01:52:41'),
(1169, 'pago_venta_producto', '4', 'Agregar pago venta', '1', '1', '1', '2023-01-13 01:52:41', '2023-01-13 01:52:41'),
(1170, 'venta_producto', '5', 'Nueva venta', '1', '1', '1', '2023-01-13 01:57:41', '2023-01-13 01:57:41'),
(1171, 'pago_venta_producto', '5', 'Agregar pago venta', '1', '1', '1', '2023-01-13 01:57:41', '2023-01-13 01:57:41'),
(1172, 'detalle_venta_producto', '4', 'Detalle compra', '1', '1', '1', '2023-01-13 01:57:41', '2023-01-13 01:57:41'),
(1173, 'detalle_venta_producto', '5', 'Detalle compra', '1', '1', '1', '2023-01-13 01:57:41', '2023-01-13 01:57:41'),
(1174, 'detalle_venta_producto', '6', 'Detalle compra', '1', '1', '1', '2023-01-13 01:57:41', '2023-01-13 01:57:41'),
(1175, 'venta_producto', '6', 'Nueva venta', '1', '1', '1', '2023-01-13 03:32:34', '2023-01-13 03:32:34'),
(1176, 'pago_venta_producto', '6', 'Agregar pago venta', '1', '1', '1', '2023-01-13 03:32:34', '2023-01-13 03:32:34'),
(1177, 'detalle_venta_producto', '7', 'Detalle compra', '1', '1', '1', '2023-01-13 03:32:34', '2023-01-13 03:32:34'),
(1178, 'detalle_venta_producto', '8', 'Detalle compra', '1', '1', '1', '2023-01-13 03:32:34', '2023-01-13 03:32:34'),
(1179, 'detalle_venta_producto', '9', 'Detalle compra', '1', '1', '1', '2023-01-13 03:32:34', '2023-01-13 03:32:34'),
(1180, 'detalle_venta_producto', '10', 'Detalle compra', '1', '1', '1', '2023-01-13 03:32:34', '2023-01-13 03:32:34'),
(1181, 'detalle_venta_producto', '11', 'Detalle compra', '1', '1', '1', '2023-01-13 03:32:34', '2023-01-13 03:32:34'),
(1182, 'detalle_venta_producto', '12', 'Detalle compra', '1', '1', '1', '2023-01-13 03:32:34', '2023-01-13 03:32:34'),
(1183, 'detalle_venta_producto', '13', 'Detalle compra', '1', '1', '1', '2023-01-13 03:32:34', '2023-01-13 03:32:34'),
(1184, 'detalle_venta_producto', '14', 'Detalle compra', '1', '1', '1', '2023-01-13 03:32:34', '2023-01-13 03:32:34'),
(1185, 'detalle_venta_producto', '15', 'Detalle compra', '1', '1', '1', '2023-01-13 03:32:34', '2023-01-13 03:32:34'),
(1186, 'detalle_venta_producto', '16', 'Detalle compra', '1', '1', '1', '2023-01-13 03:32:34', '2023-01-13 03:32:34'),
(1187, 'detalle_venta_producto', '17', 'Detalle compra', '1', '1', '1', '2023-01-13 03:32:34', '2023-01-13 03:32:34'),
(1188, 'detalle_venta_producto', '18', 'Detalle compra', '1', '1', '1', '2023-01-13 03:32:34', '2023-01-13 03:32:34'),
(1189, 'venta_producto', '7', 'Nueva venta', '1', '1', '1', '2023-01-13 17:33:44', '2023-01-13 17:33:44'),
(1190, 'pago_venta_producto', '7', 'Agregar pago venta', '1', '1', '1', '2023-01-13 17:33:44', '2023-01-13 17:33:44'),
(1191, 'detalle_venta_producto', '19', 'Detalle compra', '1', '1', '1', '2023-01-13 17:33:44', '2023-01-13 17:33:44'),
(1192, 'detalle_venta_producto', '20', 'Detalle compra', '1', '1', '1', '2023-01-13 17:33:44', '2023-01-13 17:33:44'),
(1193, 'detalle_venta_producto', '21', 'Detalle compra', '1', '1', '1', '2023-01-13 17:33:44', '2023-01-13 17:33:44'),
(1194, 'detalle_venta_producto', '22', 'Detalle compra', '1', '1', '1', '2023-01-13 17:33:44', '2023-01-13 17:33:44'),
(1195, 'detalle_venta_producto', '23', 'Detalle compra', '1', '1', '1', '2023-01-13 17:33:44', '2023-01-13 17:33:44'),
(1196, 'compra_producto', '4', 'Nueva compra', '1', '1', '1', '2023-01-13 17:35:21', '2023-01-13 17:35:21'),
(1197, 'detalle_compra_producto', '27', 'Detalle compra', '1', '1', '1', '2023-01-13 17:35:21', '2023-01-13 17:35:21'),
(1198, 'detalle_compra_producto', '28', 'Detalle compra', '1', '1', '1', '2023-01-13 17:35:21', '2023-01-13 17:35:21'),
(1199, 'detalle_compra_producto', '29', 'Detalle compra', '1', '1', '1', '2023-01-13 17:35:21', '2023-01-13 17:35:21'),
(1200, 'detalle_compra_producto', '30', 'Detalle compra', '1', '1', '1', '2023-01-13 17:35:21', '2023-01-13 17:35:21'),
(1201, 'detalle_compra_producto', '31', 'Detalle compra', '1', '1', '1', '2023-01-13 17:35:21', '2023-01-13 17:35:21'),
(1202, 'detalle_compra_producto', '32', 'Detalle compra', '1', '1', '1', '2023-01-13 17:35:21', '2023-01-13 17:35:21'),
(1203, 'detalle_compra_producto', '33', 'Detalle compra', '1', '1', '1', '2023-01-13 17:35:21', '2023-01-13 17:35:21'),
(1204, 'detalle_compra_producto', '34', 'Detalle compra', '1', '1', '1', '2023-01-13 17:35:21', '2023-01-13 17:35:21'),
(1205, 'detalle_compra_producto', '35', 'Detalle compra', '1', '1', '1', '2023-01-13 17:35:21', '2023-01-13 17:35:21'),
(1206, 'detalle_compra_producto', '36', 'Detalle compra', '1', '1', '1', '2023-01-13 17:35:21', '2023-01-13 17:35:21'),
(1207, 'detalle_compra_producto', '37', 'Detalle compra', '1', '1', '1', '2023-01-13 17:35:21', '2023-01-13 17:35:21'),
(1208, 'detalle_compra_producto', '38', 'Detalle compra', '1', '1', '1', '2023-01-13 17:35:21', '2023-01-13 17:35:21'),
(1209, 'compra_producto', '5', 'Nueva compra', '1', '1', '1', '2023-01-13 17:35:56', '2023-01-13 17:35:56'),
(1210, 'detalle_compra_producto', '39', 'Detalle compra', '1', '1', '1', '2023-01-13 17:35:56', '2023-01-13 17:35:56'),
(1211, 'detalle_compra_producto', '40', 'Detalle compra', '1', '1', '1', '2023-01-13 17:35:56', '2023-01-13 17:35:56'),
(1212, 'detalle_compra_producto', '41', 'Detalle compra', '1', '1', '1', '2023-01-13 17:35:56', '2023-01-13 17:35:56'),
(1213, 'detalle_compra_producto', '42', 'Detalle compra', '1', '1', '1', '2023-01-13 17:35:56', '2023-01-13 17:35:56'),
(1214, 'detalle_compra_producto', '43', 'Detalle compra', '1', '1', '1', '2023-01-13 17:35:56', '2023-01-13 17:35:56'),
(1215, 'detalle_compra_producto', '44', 'Detalle compra', '1', '1', '1', '2023-01-13 17:35:56', '2023-01-13 17:35:56'),
(1216, 'detalle_compra_producto', '45', 'Detalle compra', '1', '1', '1', '2023-01-13 17:35:56', '2023-01-13 17:35:56');
INSERT INTO `bitacora_bd` (`idbitacora_bd`, `nombre_tabla`, `id_tabla`, `accion`, `id_user`, `estado`, `estado_delete`, `created_at`, `updated_at`) VALUES
(1217, 'detalle_compra_producto', '46', 'Detalle compra', '1', '1', '1', '2023-01-13 17:35:56', '2023-01-13 17:35:56'),
(1218, 'detalle_compra_producto', '47', 'Detalle compra', '1', '1', '1', '2023-01-13 17:35:56', '2023-01-13 17:35:56'),
(1219, 'detalle_compra_producto', '48', 'Detalle compra', '1', '1', '1', '2023-01-13 17:35:56', '2023-01-13 17:35:56'),
(1220, 'detalle_compra_producto', '49', 'Detalle compra', '1', '1', '1', '2023-01-13 17:35:56', '2023-01-13 17:35:56'),
(1221, 'detalle_compra_producto', '50', 'Detalle compra', '1', '1', '1', '2023-01-13 17:35:56', '2023-01-13 17:35:56'),
(1222, 'venta_producto', '8', 'Nueva venta', '1', '1', '1', '2023-01-13 18:07:10', '2023-01-13 18:07:10'),
(1223, 'pago_venta_producto', '8', 'Agregar pago venta', '1', '1', '1', '2023-01-13 18:07:10', '2023-01-13 18:07:10'),
(1224, 'detalle_venta_producto', '24', 'Detalle compra', '1', '1', '1', '2023-01-13 18:07:10', '2023-01-13 18:07:10'),
(1225, 'detalle_venta_producto', '25', 'Detalle compra', '1', '1', '1', '2023-01-13 18:07:10', '2023-01-13 18:07:10'),
(1226, 'detalle_venta_producto', '26', 'Detalle compra', '1', '1', '1', '2023-01-13 18:07:10', '2023-01-13 18:07:10'),
(1227, 'detalle_venta_producto', '27', 'Detalle compra', '1', '1', '1', '2023-01-13 18:07:10', '2023-01-13 18:07:10'),
(1228, 'detalle_venta_producto', '28', 'Detalle compra', '1', '1', '1', '2023-01-13 18:07:10', '2023-01-13 18:07:10'),
(1229, 'detalle_venta_producto', '29', 'Detalle compra', '1', '1', '1', '2023-01-13 18:07:10', '2023-01-13 18:07:10'),
(1230, 'producto', '2', 'Producto editado', '1', '1', '1', '2023-01-13 18:22:03', '2023-01-13 18:22:03'),
(1231, 'usuario', '13', 'Registrar', '1', '1', '1', '2023-01-13 18:38:45', '2023-01-13 18:38:45'),
(1232, 'usuario_permiso', '56', 'Registrar permisos', '1', '1', '1', '2023-01-13 18:38:45', '2023-01-13 18:38:45'),
(1233, 'usuario_permiso', '57', 'Registrar permisos', '1', '1', '1', '2023-01-13 18:38:45', '2023-01-13 18:38:45'),
(1234, 'usuario_permiso', '58', 'Registrar permisos', '1', '1', '1', '2023-01-13 18:38:45', '2023-01-13 18:38:45'),
(1235, 'usuario_permiso', '59', 'Registrar permisos', '1', '1', '1', '2023-01-13 18:38:45', '2023-01-13 18:38:45'),
(1236, 'usuario_permiso', '60', 'Registrar permisos', '1', '1', '1', '2023-01-13 18:38:45', '2023-01-13 18:38:45'),
(1237, 'usuario_permiso', '61', 'Registrar permisos', '1', '1', '1', '2023-01-13 18:38:45', '2023-01-13 18:38:45'),
(1238, 'usuario_permiso', '62', 'Registrar permisos', '1', '1', '1', '2023-01-13 18:38:45', '2023-01-13 18:38:45'),
(1239, 'usuario_permiso', '63', 'Registrar permisos', '1', '1', '1', '2023-01-13 18:38:45', '2023-01-13 18:38:45'),
(1240, 'usuario_permiso', '64', 'Registrar permisos', '1', '1', '1', '2023-01-13 18:38:45', '2023-01-13 18:38:45'),
(1241, 'usuario', '13', 'Editamos los campos del usuario', '1', '1', '1', '2023-01-13 18:38:57', '2023-01-13 18:38:57'),
(1242, 'usuario_permiso', '65', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-13 18:38:57', '2023-01-13 18:38:57'),
(1243, 'usuario_permiso', '66', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-13 18:38:57', '2023-01-13 18:38:57'),
(1244, 'usuario_permiso', '67', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-13 18:38:57', '2023-01-13 18:38:57'),
(1245, 'usuario_permiso', '68', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-13 18:38:57', '2023-01-13 18:38:57'),
(1246, 'usuario_permiso', '69', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-13 18:38:57', '2023-01-13 18:38:57'),
(1247, 'usuario_permiso', '70', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-13 18:38:57', '2023-01-13 18:38:57'),
(1248, 'usuario_permiso', '71', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-13 18:38:57', '2023-01-13 18:38:57'),
(1249, 'usuario_permiso', '72', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-13 18:38:57', '2023-01-13 18:38:57'),
(1250, 'usuario_permiso', '73', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-13 18:38:57', '2023-01-13 18:38:57'),
(1251, 'usuario', '4', 'Editamos los campos del usuario', '1', '1', '1', '2023-01-13 18:39:12', '2023-01-13 18:39:12'),
(1252, 'usuario_permiso', '74', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-13 18:39:12', '2023-01-13 18:39:12'),
(1253, 'usuario', '4', 'Editamos los campos del usuario', '1', '1', '1', '2023-01-13 18:39:18', '2023-01-13 18:39:18'),
(1254, 'usuario_permiso', '75', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-13 18:39:18', '2023-01-13 18:39:18'),
(1255, 'usuario_permiso', '76', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-13 18:39:18', '2023-01-13 18:39:18'),
(1256, 'usuario_permiso', '77', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-13 18:39:18', '2023-01-13 18:39:18'),
(1257, 'usuario_permiso', '78', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-13 18:39:18', '2023-01-13 18:39:18'),
(1258, 'usuario_permiso', '79', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-13 18:39:18', '2023-01-13 18:39:18'),
(1259, 'usuario_permiso', '80', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-13 18:39:18', '2023-01-13 18:39:18'),
(1260, 'usuario_permiso', '81', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-13 18:39:18', '2023-01-13 18:39:18'),
(1261, 'usuario_permiso', '82', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-13 18:39:18', '2023-01-13 18:39:18'),
(1262, 'usuario_permiso', '83', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-13 18:39:18', '2023-01-13 18:39:18'),
(1263, 'usuario', '4', 'Editamos los campos del usuario', '1', '1', '1', '2023-01-13 18:39:33', '2023-01-13 18:39:33'),
(1264, 'usuario_permiso', '84', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-13 18:39:33', '2023-01-13 18:39:33'),
(1265, 'usuario_permiso', '85', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-13 18:39:33', '2023-01-13 18:39:33'),
(1266, 'usuario_permiso', '86', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-13 18:39:33', '2023-01-13 18:39:33'),
(1267, 'usuario_permiso', '87', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-13 18:39:33', '2023-01-13 18:39:33'),
(1268, 'usuario_permiso', '88', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-13 18:39:33', '2023-01-13 18:39:33'),
(1269, 'usuario_permiso', '89', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-13 18:39:33', '2023-01-13 18:39:33'),
(1270, 'usuario_permiso', '90', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-13 18:39:33', '2023-01-13 18:39:33'),
(1271, 'usuario_permiso', '91', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-13 18:39:33', '2023-01-13 18:39:33'),
(1272, 'persona', '5', 'Editamos el registro persona', '1', '1', '1', '2023-01-13 18:42:38', '2023-01-13 18:42:38'),
(1273, 'persona', '18', 'Editamos el registro persona', '1', '1', '1', '2023-01-13 18:43:08', '2023-01-13 18:43:08'),
(1274, 'persona', '18', 'Editamos el registro persona', '1', '1', '1', '2023-01-13 18:43:20', '2023-01-13 18:43:20'),
(1275, 'persona', '17', 'Editamos el registro persona', '1', '1', '1', '2023-01-13 18:43:46', '2023-01-13 18:43:46'),
(1276, 'producto', '2', 'Producto editado', '1', '1', '1', '2023-01-13 18:45:25', '2023-01-13 18:45:25'),
(1277, 'producto', '2', 'Producto editado', '1', '1', '1', '2023-01-13 18:45:41', '2023-01-13 18:45:41'),
(1278, 'producto', '15', 'Nuevo producto registrado', '1', '1', '1', '2023-01-13 18:48:48', '2023-01-13 18:48:48'),
(1279, 'bancos', '8', 'Banco editado', '1', '1', '1', '2023-01-13 18:50:19', '2023-01-13 18:50:19'),
(1280, 'bancos', '9', 'Nuevo banco registrado', '1', '1', '1', '2023-01-13 18:50:54', '2023-01-13 18:50:54'),
(1281, 'bancos', '9', 'Banco Eliminado', '1', '1', '1', '2023-01-13 18:51:08', '2023-01-13 18:51:08'),
(1282, 'unidad_medida', '2', 'Unidad medida editada', '1', '1', '1', '2023-01-13 18:51:29', '2023-01-13 18:51:29'),
(1283, 'unidad_medida', '4', 'Nueva unidad medida registrada', '1', '1', '1', '2023-01-13 18:51:39', '2023-01-13 18:51:39'),
(1284, 'unidad_medida', '4', 'Unidad de medida Eliminaao', '1', '1', '1', '2023-01-13 18:51:43', '2023-01-13 18:51:43'),
(1285, 'tipo_persona', '5', 'Nuevo tipo trabajador registrado', '1', '1', '1', '2023-01-13 18:51:52', '2023-01-13 18:51:52'),
(1286, 'tipo_persona', '5', 'Tipo trabajador Eliminado', '1', '1', '1', '2023-01-13 18:52:03', '2023-01-13 18:52:03'),
(1287, 'cargo_trabajador', '5', 'Nuevo cargo trabajador registrado', '1', '1', '1', '2023-01-13 18:52:10', '2023-01-13 18:52:10'),
(1288, 'cargo_trabajador', '5', 'Cargo trabajador editado', '1', '1', '1', '2023-01-13 18:52:18', '2023-01-13 18:52:18'),
(1289, 'cargo_trabajador', '5', 'Cargo trabajador Eliminado', '1', '1', '1', '2023-01-13 18:52:22', '2023-01-13 18:52:22'),
(1290, 'categoria_producto', '3', 'Categoría de insumos editada', '1', '1', '1', '2023-01-13 18:52:33', '2023-01-13 18:52:33'),
(1291, 'persona', '35', 'Registro Nuevo persona', '1', '1', '1', '2023-01-15 18:24:45', '2023-01-15 18:24:45'),
(1292, 'persona', '36', 'Registro Nuevo persona', '1', '1', '1', '2023-01-15 18:45:03', '2023-01-15 18:45:03'),
(1293, 'persona', '37', 'Registro Nuevo persona', '1', '1', '1', '2023-01-15 18:47:58', '2023-01-15 18:47:58'),
(1294, 'persona', '38', 'Registro Nuevo persona', '1', '1', '1', '2023-01-15 21:32:12', '2023-01-15 21:32:12'),
(1295, 'usuario', '4', 'Editamos los campos del usuario', '1', '1', '1', '2023-01-15 22:58:07', '2023-01-15 22:58:07'),
(1296, 'usuario_permiso', '92', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-15 22:58:07', '2023-01-15 22:58:07'),
(1297, 'usuario_permiso', '93', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-15 22:58:07', '2023-01-15 22:58:07'),
(1298, 'usuario_permiso', '94', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-15 22:58:07', '2023-01-15 22:58:07'),
(1299, 'usuario_permiso', '95', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-15 22:58:07', '2023-01-15 22:58:07'),
(1300, 'usuario_permiso', '96', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-15 22:58:07', '2023-01-15 22:58:07'),
(1301, 'usuario_permiso', '97', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-15 22:58:07', '2023-01-15 22:58:07'),
(1302, 'usuario_permiso', '98', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-15 22:58:07', '2023-01-15 22:58:07'),
(1303, 'usuario_permiso', '99', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-15 22:58:07', '2023-01-15 22:58:07'),
(1304, 'usuario', '7', 'Editamos los campos del usuario', '1', '1', '1', '2023-01-15 23:34:36', '2023-01-15 23:34:36'),
(1305, 'usuario_permiso', '100', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-15 23:34:36', '2023-01-15 23:34:36'),
(1306, 'usuario_permiso', '101', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-15 23:34:36', '2023-01-15 23:34:36'),
(1307, 'usuario', '7', 'Editamos los campos del usuario', '1', '1', '1', '2023-01-15 23:35:01', '2023-01-15 23:35:01'),
(1308, 'usuario_permiso', '102', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-15 23:35:01', '2023-01-15 23:35:01'),
(1309, 'usuario_permiso', '103', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-15 23:35:01', '2023-01-15 23:35:01'),
(1310, 'usuario', '7', 'Editamos los campos del usuario', '1', '1', '1', '2023-01-15 23:35:51', '2023-01-15 23:35:51'),
(1311, 'usuario_permiso', '104', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-15 23:35:51', '2023-01-15 23:35:51'),
(1312, 'usuario_permiso', '105', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-15 23:35:51', '2023-01-15 23:35:51'),
(1313, 'usuario', '4', 'Editamos los campos del usuario', '1', '1', '1', '2023-01-15 23:40:51', '2023-01-15 23:40:51'),
(1314, 'usuario_permiso', '106', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-15 23:40:51', '2023-01-15 23:40:51'),
(1315, 'usuario_permiso', '107', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-15 23:40:51', '2023-01-15 23:40:51'),
(1316, 'usuario_permiso', '108', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-15 23:40:51', '2023-01-15 23:40:51'),
(1317, 'usuario_permiso', '109', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-15 23:40:51', '2023-01-15 23:40:51'),
(1318, 'usuario_permiso', '110', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-15 23:40:51', '2023-01-15 23:40:51'),
(1319, 'usuario_permiso', '111', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-15 23:40:51', '2023-01-15 23:40:51'),
(1320, 'usuario_permiso', '112', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-15 23:40:51', '2023-01-15 23:40:51'),
(1321, 'usuario_permiso', '113', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-15 23:40:51', '2023-01-15 23:40:51'),
(1322, 'usuario', '3', 'Editamos los campos del usuario', '1', '1', '1', '2023-01-16 00:17:10', '2023-01-16 00:17:10'),
(1323, 'usuario_permiso', '114', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:17:10', '2023-01-16 00:17:10'),
(1324, 'usuario', '4', 'Editamos los campos del usuario', '1', '1', '1', '2023-01-16 00:17:49', '2023-01-16 00:17:49'),
(1325, 'usuario_permiso', '115', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:17:49', '2023-01-16 00:17:49'),
(1326, 'usuario_permiso', '116', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:17:49', '2023-01-16 00:17:49'),
(1327, 'usuario_permiso', '117', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:17:49', '2023-01-16 00:17:49'),
(1328, 'usuario_permiso', '118', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:17:49', '2023-01-16 00:17:49'),
(1329, 'usuario_permiso', '119', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:17:49', '2023-01-16 00:17:49'),
(1330, 'usuario_permiso', '120', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:17:49', '2023-01-16 00:17:49'),
(1331, 'usuario_permiso', '121', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:17:49', '2023-01-16 00:17:49'),
(1332, 'usuario_permiso', '122', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:17:49', '2023-01-16 00:17:49'),
(1333, 'usuario', '4', 'Editamos los campos del usuario', '1', '1', '1', '2023-01-16 00:32:58', '2023-01-16 00:32:58'),
(1334, 'usuario_permiso', '123', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:32:58', '2023-01-16 00:32:58'),
(1335, 'usuario_permiso', '124', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:32:58', '2023-01-16 00:32:58'),
(1336, 'usuario_permiso', '125', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:32:58', '2023-01-16 00:32:58'),
(1337, 'usuario_permiso', '126', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:32:58', '2023-01-16 00:32:58'),
(1338, 'usuario_permiso', '127', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:32:58', '2023-01-16 00:32:58'),
(1339, 'usuario_permiso', '128', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:32:58', '2023-01-16 00:32:58'),
(1340, 'usuario_permiso', '129', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:32:58', '2023-01-16 00:32:58'),
(1341, 'usuario_permiso', '130', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:32:58', '2023-01-16 00:32:58'),
(1342, 'usuario', '5', 'Editamos los campos del usuario', '1', '1', '1', '2023-01-16 00:37:11', '2023-01-16 00:37:11'),
(1343, 'usuario', '5', 'Editamos los campos del usuario', '1', '1', '1', '2023-01-16 00:38:20', '2023-01-16 00:38:20'),
(1344, 'usuario', '5', 'Editamos los campos del usuario', '1', '1', '1', '2023-01-16 00:38:23', '2023-01-16 00:38:23'),
(1345, 'usuario_permiso', '131', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:38:23', '2023-01-16 00:38:23'),
(1346, 'usuario', '5', 'Editamos los campos del usuario', '1', '1', '1', '2023-01-16 00:39:19', '2023-01-16 00:39:19'),
(1347, 'usuario_permiso', '132', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:39:19', '2023-01-16 00:39:19'),
(1348, 'usuario', '5', 'Editamos los campos del usuario', '1', '1', '1', '2023-01-16 00:40:00', '2023-01-16 00:40:00'),
(1349, 'usuario_permiso', '133', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:40:00', '2023-01-16 00:40:00'),
(1350, 'usuario', '13', 'Editamos los campos del usuario', '1', '1', '1', '2023-01-16 00:42:54', '2023-01-16 00:42:54'),
(1351, 'usuario_permiso', '134', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:42:54', '2023-01-16 00:42:54'),
(1352, 'usuario_permiso', '135', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:42:54', '2023-01-16 00:42:54'),
(1353, 'usuario_permiso', '136', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:42:54', '2023-01-16 00:42:54'),
(1354, 'usuario_permiso', '137', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:42:54', '2023-01-16 00:42:54'),
(1355, 'usuario_permiso', '138', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:42:54', '2023-01-16 00:42:54'),
(1356, 'usuario_permiso', '139', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:42:54', '2023-01-16 00:42:54'),
(1357, 'usuario_permiso', '140', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:42:54', '2023-01-16 00:42:54'),
(1358, 'usuario_permiso', '141', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:42:54', '2023-01-16 00:42:54'),
(1359, 'usuario_permiso', '142', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:42:54', '2023-01-16 00:42:54'),
(1360, 'usuario', '4', 'Editamos los campos del usuario', '1', '1', '1', '2023-01-16 00:51:46', '2023-01-16 00:51:46'),
(1361, 'usuario_permiso', '143', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:51:46', '2023-01-16 00:51:46'),
(1362, 'usuario_permiso', '144', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:51:46', '2023-01-16 00:51:46'),
(1363, 'usuario_permiso', '145', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:51:46', '2023-01-16 00:51:46'),
(1364, 'usuario_permiso', '146', 'Asigamos nuevos persmisos cuando editamos usuario', '1', '1', '1', '2023-01-16 00:51:46', '2023-01-16 00:51:46'),
(1365, 'usuario', '4', 'Editamos los campos del usuario', '4', '1', '1', '2023-01-16 00:52:21', '2023-01-16 00:52:21'),
(1366, 'usuario_permiso', '147', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:52:21', '2023-01-16 00:52:21'),
(1367, 'usuario_permiso', '148', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:52:22', '2023-01-16 00:52:22'),
(1368, 'usuario_permiso', '149', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:52:22', '2023-01-16 00:52:22'),
(1369, 'usuario_permiso', '150', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:52:22', '2023-01-16 00:52:22'),
(1370, 'usuario', '7', 'Editamos los campos del usuario', '4', '1', '1', '2023-01-16 00:52:31', '2023-01-16 00:52:31'),
(1371, 'usuario_permiso', '151', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:52:31', '2023-01-16 00:52:31'),
(1372, 'usuario_permiso', '152', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:52:31', '2023-01-16 00:52:31'),
(1373, 'usuario', '3', 'Editamos los campos del usuario', '4', '1', '1', '2023-01-16 00:52:42', '2023-01-16 00:52:42'),
(1374, 'usuario_permiso', '153', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:52:42', '2023-01-16 00:52:42'),
(1375, 'usuario', '2', 'Editamos los campos del usuario', '4', '1', '1', '2023-01-16 00:52:52', '2023-01-16 00:52:52'),
(1376, 'usuario_permiso', '154', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:52:52', '2023-01-16 00:52:52'),
(1377, 'usuario_permiso', '155', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:52:52', '2023-01-16 00:52:52'),
(1378, 'usuario_permiso', '156', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:52:52', '2023-01-16 00:52:52'),
(1379, 'usuario_permiso', '157', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:52:52', '2023-01-16 00:52:52'),
(1380, 'usuario_permiso', '158', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:52:52', '2023-01-16 00:52:52'),
(1381, 'usuario_permiso', '159', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:52:52', '2023-01-16 00:52:52'),
(1382, 'usuario_permiso', '160', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:52:52', '2023-01-16 00:52:52'),
(1383, 'usuario_permiso', '161', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:52:52', '2023-01-16 00:52:52'),
(1384, 'usuario_permiso', '162', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:52:52', '2023-01-16 00:52:52'),
(1385, 'usuario', '13', 'Editamos los campos del usuario', '4', '1', '1', '2023-01-16 00:53:03', '2023-01-16 00:53:03'),
(1386, 'usuario_permiso', '163', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:03', '2023-01-16 00:53:03'),
(1387, 'usuario_permiso', '164', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:03', '2023-01-16 00:53:03'),
(1388, 'usuario_permiso', '165', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:03', '2023-01-16 00:53:03'),
(1389, 'usuario_permiso', '166', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:03', '2023-01-16 00:53:03'),
(1390, 'usuario_permiso', '167', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:03', '2023-01-16 00:53:03'),
(1391, 'usuario_permiso', '168', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:03', '2023-01-16 00:53:03'),
(1392, 'usuario_permiso', '169', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:03', '2023-01-16 00:53:03'),
(1393, 'usuario_permiso', '170', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:03', '2023-01-16 00:53:03'),
(1394, 'usuario_permiso', '171', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:03', '2023-01-16 00:53:03'),
(1395, 'usuario', '6', 'Editamos los campos del usuario', '4', '1', '1', '2023-01-16 00:53:13', '2023-01-16 00:53:13'),
(1396, 'usuario_permiso', '172', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:13', '2023-01-16 00:53:13'),
(1397, 'usuario_permiso', '173', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:13', '2023-01-16 00:53:13'),
(1398, 'usuario_permiso', '174', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:13', '2023-01-16 00:53:13'),
(1399, 'usuario_permiso', '175', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:13', '2023-01-16 00:53:13'),
(1400, 'usuario_permiso', '176', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:13', '2023-01-16 00:53:13'),
(1401, 'usuario_permiso', '177', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:13', '2023-01-16 00:53:13'),
(1402, 'usuario_permiso', '178', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:13', '2023-01-16 00:53:13'),
(1403, 'usuario_permiso', '179', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:13', '2023-01-16 00:53:13'),
(1404, 'usuario_permiso', '180', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:13', '2023-01-16 00:53:13'),
(1405, 'usuario', '6', 'Editamos los campos del usuario', '4', '1', '1', '2023-01-16 00:53:26', '2023-01-16 00:53:26'),
(1406, 'usuario_permiso', '181', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:26', '2023-01-16 00:53:26'),
(1407, 'usuario_permiso', '182', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:26', '2023-01-16 00:53:26'),
(1408, 'usuario_permiso', '183', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:26', '2023-01-16 00:53:26'),
(1409, 'usuario_permiso', '184', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:26', '2023-01-16 00:53:26'),
(1410, 'usuario_permiso', '185', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:26', '2023-01-16 00:53:26'),
(1411, 'usuario_permiso', '186', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:26', '2023-01-16 00:53:26'),
(1412, 'usuario_permiso', '187', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:26', '2023-01-16 00:53:26'),
(1413, 'usuario_permiso', '188', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:26', '2023-01-16 00:53:26'),
(1414, 'usuario_permiso', '189', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:26', '2023-01-16 00:53:26'),
(1415, 'usuario', '5', 'Editamos los campos del usuario', '4', '1', '1', '2023-01-16 00:53:35', '2023-01-16 00:53:35'),
(1416, 'usuario_permiso', '190', 'Asigamos nuevos persmisos cuando editamos usuario', '4', '1', '1', '2023-01-16 00:53:35', '2023-01-16 00:53:35'),
(1417, 'producto', '1', 'Producto editado', '1', '1', '1', '2023-01-16 01:10:25', '2023-01-16 01:10:25'),
(1418, 'producto', '16', 'Nuevo producto registrado', '1', '1', '1', '2023-01-16 01:15:23', '2023-01-16 01:15:23'),
(1419, 'producto', '16', 'Producto editado', '1', '1', '1', '2023-01-16 01:16:06', '2023-01-16 01:16:06'),
(1420, 'producto', '16', 'Producto editado', '1', '1', '1', '2023-01-16 01:19:38', '2023-01-16 01:19:38'),
(1421, 'producto', '17', 'Nuevo producto registrado', '1', '1', '1', '2023-01-16 01:26:50', '2023-01-16 01:26:50');

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
  `nombre` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `estado_delete` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
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
(4, 'Logisticas', '1', '1', '2022-09-27 05:52:53', '2022-10-07 07:00:28', NULL, NULL, NULL, 1),
(5, 'hhhh', '1', '0', '2023-01-13 16:52:10', '2023-01-13 16:52:22', NULL, 1, 1, 1);

--
-- Disparadores `cargo_trabajador`
--
DELIMITER $$
CREATE TRIGGER `cargo_trabajador_BEFORE_UPDATE` BEFORE UPDATE ON `cargo_trabajador` FOR EACH ROW BEGIN
SET new.updated_at = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_producto`
--

CREATE TABLE `categoria_producto` (
  `idcategoria_producto` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `estado_delete` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `categoria_producto`
--

INSERT INTO `categoria_producto` (`idcategoria_producto`, `nombre`, `descripcion`, `estado`, `estado_delete`, `created_at`, `updated_at`, `user_trash`, `user_delete`, `user_created`, `user_updated`) VALUES
(1, 'NINGUNO', '2222', '1', '1', '2022-10-07 07:01:21', '2022-12-21 03:07:34', NULL, NULL, 1, NULL),
(2, 'VENENO', 'eee', '1', '1', '2022-10-07 07:01:28', '2022-12-21 03:00:13', NULL, 1, 1, 1),
(3, 'FOLIAR', 'tthhh', '1', '1', '2022-10-07 07:01:35', '2023-01-13 16:52:33', 1, NULL, 1, 1),
(4, 'HERVISIDA', 'matan o inhiben el crecimiento de plantas no deseadas, también conocidas como malas hierbas.', '1', '1', '2022-10-07 07:02:07', '2022-12-16 17:13:16', NULL, NULL, 1, 1),
(5, 'ABONOS', 'Compras de abonos', '1', '1', '2022-12-16 17:07:15', '2022-12-16 17:07:15', NULL, NULL, 1, NULL),
(6, 'FUNGICIDAS', 'para controlar problemas con hongos como el moho, verdín y óxido.', '1', '1', '2022-12-16 17:10:12', '2022-12-16 17:13:05', NULL, NULL, 1, 1),
(7, 'INSECTISIDAS', 'para controlar insectos.', '1', '1', '2022-12-16 17:12:26', '2022-12-16 17:12:55', NULL, NULL, 1, 1),
(8, 'REPELENTES', 'para repeler las plagas no deseadas, a menudo por el gusto o el olfato.', '1', '1', '2022-12-16 17:13:43', '2022-12-16 17:13:54', NULL, NULL, 1, 1);

--
-- Disparadores `categoria_producto`
--
DELIMITER $$
CREATE TRIGGER `categoria_producto_BEFORE_UPDATE` BEFORE UPDATE ON `categoria_producto` FOR EACH ROW BEGIN
SET new.updated_at = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_grano`
--

CREATE TABLE `compra_grano` (
  `idcompra_grano` int(11) NOT NULL,
  `idpersona` int(11) NOT NULL,
  `fecha_compra` date DEFAULT NULL,
  `establecimiento` varchar(200) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tipo_comprobante` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `numero_comprobante` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `val_igv` decimal(11,2) DEFAULT NULL,
  `subtotal_compra` decimal(11,2) DEFAULT NULL,
  `igv_compra` decimal(11,2) DEFAULT NULL,
  `total_compra` decimal(11,2) DEFAULT NULL,
  `tipo_gravada` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL COMMENT 'val_igv>0 gravada, val_igv=0 no-gravada	',
  `descripcion` text COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `metodo_pago` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_proximo_pago` date DEFAULT NULL,
  `estado` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `estado_delete` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `compra_grano`
--

INSERT INTO `compra_grano` (`idcompra_grano`, `idpersona`, `fecha_compra`, `establecimiento`, `tipo_comprobante`, `numero_comprobante`, `val_igv`, `subtotal_compra`, `igv_compra`, `total_compra`, `tipo_gravada`, `descripcion`, `metodo_pago`, `fecha_proximo_pago`, `estado`, `estado_delete`, `created_at`, `updated_at`, `user_trash`, `user_delete`, `user_created`, `user_updated`) VALUES
(1, 5, '2022-10-04', NULL, 'Ninguno', '', '0.00', '360.00', '0.00', '360.00', 'NO GRAVADA', '', 'CREDITO', '2022-02-24', '1', '1', '2022-10-09 03:48:02', '2022-10-11 12:27:56', 1, NULL, NULL, 1),
(2, 5, '2022-10-04', NULL, 'Ninguno', '', '0.00', '5113.00', '0.00', '5113.00', 'NO GRAVADA', '', 'CREDITO', NULL, '1', '0', '2022-10-09 03:50:01', '2022-10-10 14:42:40', NULL, 1, NULL, 1),
(3, 5, '2022-08-17', NULL, 'Boleta', '435453', '0.00', '9348.00', '0.00', '9348.00', 'NO GRAVADA', '', 'CREDITO', NULL, '1', '1', '2022-10-09 03:52:14', '2022-10-09 21:15:31', NULL, NULL, NULL, 1),
(4, 6, '2022-10-05', NULL, 'Ninguno', '', '0.00', '234.00', '0.00', '234.00', 'NO GRAVADA', '', 'CONTADO', NULL, '0', '1', '2022-10-09 03:53:43', '2022-10-10 14:42:38', 1, 1, NULL, 1),
(5, 6, '2022-08-17', NULL, 'Ninguno', '', '0.00', '276.00', '0.00', '276.00', 'NO GRAVADA', '', 'CONTADO', NULL, '1', '1', '2022-10-09 03:55:04', '2022-10-09 21:25:12', NULL, 1, NULL, 1),
(6, 6, '2022-04-21', NULL, 'Ninguno', '', '0.00', '10500.00', '0.00', '10500.00', 'NO GRAVADA', '', 'CONTADO', NULL, '1', '1', '2022-10-09 03:55:39', '2022-10-09 21:26:30', NULL, 1, NULL, 1),
(7, 6, '2022-07-22', NULL, 'Ninguno', '', '0.00', '15500.00', '0.00', '15500.00', 'NO GRAVADA', '', 'CONTADO', NULL, '1', '1', '2022-10-09 03:56:20', '2022-10-09 21:29:30', NULL, 1, NULL, 1),
(8, 8, '2022-05-26', NULL, 'Factura', 'F5345-34242', '0.18', '3853.39', '693.61', '4547.00', 'GRAVADA', 'SES EFWF EWF WEF WEF', 'CONTADO', NULL, '1', '1', '2022-10-09 04:13:10', '2022-10-09 21:27:27', 1, NULL, NULL, 1),
(9, 9, '2022-09-29', NULL, 'Boleta', '32432432', '0.00', '410.00', '0.00', '410.00', 'NO GRAVADA', '42343254324324234', 'CONTADO', NULL, '1', '1', '2022-10-09 16:40:52', '2022-10-09 16:40:52', NULL, NULL, NULL, NULL),
(10, 6, '2022-01-04', NULL, 'Ninguno', '', '0.00', '2175.00', '0.00', '2175.00', 'NO GRAVADA', '', 'CONTADO', NULL, '1', '1', '2022-10-09 21:10:55', '2022-10-09 21:14:30', NULL, NULL, NULL, 1),
(11, 5, '2022-02-08', NULL, 'Boleta', '45634', '0.00', '1120.00', '0.00', '1120.00', 'NO GRAVADA', '4545ytb345y 5', 'CONTADO', NULL, '1', '1', '2022-10-09 21:11:23', '2022-10-09 21:11:23', NULL, NULL, NULL, NULL),
(12, 9, '2022-04-17', NULL, 'Boleta', 'fdsf', '0.00', '3450.00', '0.00', '3450.00', 'NO GRAVADA', 'sfasf', 'CONTADO', NULL, '1', '1', '2022-10-09 21:17:01', '2022-10-09 21:17:01', NULL, NULL, NULL, NULL),
(13, 8, '2022-06-22', NULL, 'Boleta', 'rtret', '0.00', '1632.00', '0.00', '1632.00', 'NO GRAVADA', '', 'CONTADO', NULL, '1', '1', '2022-10-09 21:17:56', '2022-10-09 21:17:56', NULL, NULL, NULL, NULL),
(14, 9, '2022-09-29', NULL, 'Boleta', '', '0.00', '478.00', '0.00', '478.00', 'NO GRAVADA', '', 'CREDITO', NULL, '1', '1', '2022-10-10 14:41:05', '2022-10-10 14:41:05', NULL, NULL, NULL, NULL),
(15, 1, '2022-10-10', NULL, 'Ninguno', '', '0.00', '2200.00', '0.00', '2200.00', 'NO GRAVADA', '', 'CONTADO', NULL, '1', '1', '2022-10-10 17:08:50', '2022-10-10 17:08:50', NULL, NULL, NULL, NULL),
(16, 6, '2022-10-11', NULL, 'Boleta', '34324', '0.00', '1100.00', '0.00', '1100.00', 'NO GRAVADA', '', 'CONTADO', '2022-10-11', '1', '1', '2022-10-11 12:10:38', '2022-10-11 12:10:38', NULL, NULL, 1, NULL),
(17, 6, '2022-10-11', NULL, 'Boleta', '34324', '0.00', '1100.00', '0.00', '1100.00', 'NO GRAVADA', '', 'CONTADO', '2022-10-11', '1', '1', '2022-10-11 12:10:38', '2022-10-11 12:10:38', NULL, NULL, 1, NULL),
(18, 5, '2022-10-11', NULL, 'Boleta', 'B-4353', '0.00', '3451.00', '0.00', '3451.00', 'NO GRAVADA', '', 'CONTADO', '2022-10-11', '1', '1', '2022-10-11 12:20:10', '2022-10-11 12:20:10', NULL, NULL, 1, NULL),
(19, 5, '2022-10-16', NULL, 'Factura', '343243', '0.18', '3864.41', '695.59', '4560.00', 'GRAVADA', '334543', 'CONTADO', '2022-10-16', '1', '1', '2022-10-16 13:58:48', '2022-10-16 13:58:48', NULL, NULL, 1, NULL),
(20, 5, '2022-10-16', NULL, 'Factura', '343243324', '0.18', '3864.41', '695.59', '4560.00', 'GRAVADA', '334543', 'CONTADO', '2022-10-16', '1', '1', '2022-10-16 14:01:57', '2022-10-16 14:01:57', NULL, NULL, 1, NULL),
(21, 5, '2023-01-01', NULL, 'Boleta', 'B-000001', '0.00', '4560.00', '0.00', '4560.00', 'NO GRAVADA', '334543', 'CONTADO', '2023-01-01', '1', '1', '2023-01-02 01:55:59', '2023-01-02 01:55:59', NULL, NULL, 1, NULL);

--
-- Disparadores `compra_grano`
--
DELIMITER $$
CREATE TRIGGER `compra_grano_BEFORE_UPDATE` BEFORE UPDATE ON `compra_grano` FOR EACH ROW BEGIN
SET new.updated_at = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_producto`
--

CREATE TABLE `compra_producto` (
  `idcompra_producto` int(11) NOT NULL,
  `idpersona` int(11) NOT NULL,
  `fecha_compra` date DEFAULT NULL,
  `tipo_comprobante` varchar(60) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `serie_comprobante` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `val_igv` decimal(11,2) DEFAULT NULL COMMENT '0.18',
  `subtotal` decimal(11,2) DEFAULT NULL,
  `igv` decimal(11,2) DEFAULT NULL COMMENT 'subtotal * val_igv = igv',
  `total` decimal(11,2) DEFAULT NULL COMMENT 'subtotal + igv = total',
  `tipo_gravada` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL COMMENT 'val_igv>0 gravada, val_igv=0 no-gravada	',
  `descripcion` text COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `comprobante` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL COMMENT '.png, .doc, .pdf, etc...',
  `estado` char(10) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `estado_delete` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `compra_producto`
--

INSERT INTO `compra_producto` (`idcompra_producto`, `idpersona`, `fecha_compra`, `tipo_comprobante`, `serie_comprobante`, `val_igv`, `subtotal`, `igv`, `total`, `tipo_gravada`, `descripcion`, `comprobante`, `estado`, `estado_delete`, `created_at`, `updated_at`, `user_trash`, `user_delete`, `user_created`, `user_updated`) VALUES
(1, 13, '2023-01-04', 'Boleta', 'NB-00043', '0.00', '404.00', '0.00', '404.00', 'NO GRAVADA', 'COMPRA BRITAL', NULL, '1', '1', '2023-01-12 17:26:33', '2023-01-12 17:26:33', NULL, NULL, NULL, NULL),
(2, 18, '2023-01-04', 'Boleta', 'NB-00043', '0.00', '3636.00', '0.00', '3636.00', 'NO GRAVADA', 'COMPRA BRITAL', NULL, '1', '1', '2023-01-12 20:56:46', '2023-01-12 20:56:46', NULL, NULL, NULL, NULL),
(3, 19, '2023-01-04', 'Boleta', 'NB-00043', '0.00', '550.00', '0.00', '550.00', 'NO GRAVADA', 'COMPRA BRITAL', NULL, '1', '1', '2023-01-12 22:22:47', '2023-01-12 22:22:47', NULL, NULL, NULL, NULL),
(4, 33, '2023-01-04', 'Boleta', 'NB-00043', '0.00', '4848.00', '0.00', '4848.00', 'NO GRAVADA', 'COMPRA BRITAL', NULL, '1', '1', '2023-01-13 15:35:21', '2023-01-13 15:35:21', NULL, NULL, NULL, NULL),
(5, 34, '2023-01-04', 'Boleta', 'NB-00043', '0.00', '6060.00', '0.00', '6060.00', 'NO GRAVADA', 'COMPRA BRITAL', NULL, '1', '1', '2023-01-13 15:35:56', '2023-01-13 15:35:56', NULL, NULL, NULL, NULL);

--
-- Disparadores `compra_producto`
--
DELIMITER $$
CREATE TRIGGER `compra_producto_BEFORE_UPDATE` BEFORE UPDATE ON `compra_producto` FOR EACH ROW BEGIN
SET new.updated_at = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra_grano`
--

CREATE TABLE `detalle_compra_grano` (
  `iddetalle_compra_grano` int(11) NOT NULL,
  `idcompra_grano` int(11) NOT NULL,
  `tipo_grano` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `unidad_medida` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `peso_bruto` decimal(11,2) DEFAULT NULL,
  `dcto_humedad` decimal(11,2) DEFAULT NULL,
  `porcentaje_cascara` decimal(11,2) DEFAULT NULL,
  `dcto_embase` decimal(11,2) DEFAULT NULL,
  `peso_neto` decimal(11,2) DEFAULT NULL,
  `precio_sin_igv` decimal(11,2) DEFAULT NULL,
  `precio_igv` decimal(11,2) DEFAULT NULL,
  `precio_con_igv` decimal(11,2) DEFAULT NULL,
  `descuento_adicional` decimal(11,2) DEFAULT NULL,
  `subtotal` decimal(11,2) DEFAULT NULL,
  `estado` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `estado_delete` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_compra_grano`
--

INSERT INTO `detalle_compra_grano` (`iddetalle_compra_grano`, `idcompra_grano`, `tipo_grano`, `unidad_medida`, `peso_bruto`, `dcto_humedad`, `porcentaje_cascara`, `dcto_embase`, `peso_neto`, `precio_sin_igv`, `precio_igv`, `precio_con_igv`, `descuento_adicional`, `subtotal`, `estado`, `estado_delete`, `created_at`, `updated_at`, `user_trash`, `user_delete`, `user_created`, `user_updated`) VALUES
(39, 9, 'PERGAMINO', 'KILO', '124.00', '0.00', '0.00', '0.00', '124.00', '1.00', '0.00', '1.00', '0.00', '124.00', '1', '1', '2022-10-09 16:40:52', '2022-10-09 16:40:52', NULL, NULL, NULL, NULL),
(40, 9, 'COCO', 'KILO', '13.00', '0.00', '0.00', '0.00', '13.00', '22.00', '0.00', '22.00', '0.00', '286.00', '1', '1', '2022-10-09 16:40:52', '2022-10-09 16:40:52', NULL, NULL, NULL, NULL),
(42, 11, 'PERGAMINO', 'KILO', '56.00', '0.00', '0.00', '0.00', '56.00', '10.00', '0.00', '10.00', '0.00', '560.00', '1', '1', '2022-10-09 21:11:23', '2022-10-09 21:11:23', NULL, NULL, NULL, NULL),
(43, 11, 'PERGAMINO', 'KILO', '56.00', '0.00', '0.00', '0.00', '56.00', '10.00', '0.00', '10.00', '0.00', '560.00', '1', '1', '2022-10-09 21:11:23', '2022-10-09 21:11:23', NULL, NULL, NULL, NULL),
(44, 10, 'COCO', 'KILO', '435.00', '0.00', '0.00', '0.00', '435.00', '5.00', '0.00', '5.00', '0.00', '2175.00', '1', '1', '2022-10-09 21:14:30', '2022-10-09 21:14:30', NULL, NULL, NULL, NULL),
(45, 2, 'COCO', 'KILO', '123.00', '0.00', '0.00', '0.00', '123.00', '2.00', '0.00', '2.00', '0.00', '246.00', '1', '1', '2022-10-09 21:14:52', '2022-10-09 21:14:52', NULL, NULL, NULL, NULL),
(46, 2, 'COCO', 'KILO', '23.00', '0.00', '0.00', '0.00', '23.00', '3.00', '0.00', '3.00', '0.00', '69.00', '1', '1', '2022-10-09 21:14:52', '2022-10-09 21:14:52', NULL, NULL, NULL, NULL),
(47, 2, 'COCO', 'KILO', '567.00', '0.00', '0.00', '0.00', '567.00', '6.00', '0.00', '6.00', '0.00', '3402.00', '1', '1', '2022-10-09 21:14:52', '2022-10-09 21:14:52', NULL, NULL, NULL, NULL),
(48, 2, 'PERGAMINO', 'KILO', '566.00', '0.00', '0.00', '0.00', '566.00', '2.00', '0.00', '2.00', '0.00', '1132.00', '1', '1', '2022-10-09 21:14:52', '2022-10-09 21:14:52', NULL, NULL, NULL, NULL),
(49, 2, 'PERGAMINO', 'KILO', '66.00', '0.00', '0.00', '0.00', '66.00', '4.00', '0.00', '4.00', '0.00', '264.00', '1', '1', '2022-10-09 21:14:52', '2022-10-09 21:14:52', NULL, NULL, NULL, NULL),
(50, 3, 'PERGAMINO', 'KILO', '466.00', '12.00', '12.00', '3.00', '439.00', '9.00', '0.00', '9.00', '500.00', '3451.00', '1', '1', '2022-10-09 21:15:31', '2022-10-09 21:15:31', NULL, NULL, NULL, NULL),
(51, 3, 'COCO', 'KILO', '345.00', '0.00', '0.00', '0.00', '345.00', '10.00', '0.00', '10.00', '0.00', '3450.00', '1', '1', '2022-10-09 21:15:31', '2022-10-09 21:15:31', NULL, NULL, NULL, NULL),
(52, 3, 'PERGAMINO', 'KILO', '435.00', '0.00', '0.00', '0.00', '435.00', '3.00', '0.00', '3.00', '0.00', '1305.00', '1', '1', '2022-10-09 21:15:31', '2022-10-09 21:15:31', NULL, NULL, NULL, NULL),
(53, 3, 'COCO', 'KILO', '45.00', '0.00', '0.00', '0.00', '45.00', '5.00', '0.00', '5.00', '0.00', '225.00', '1', '1', '2022-10-09 21:15:31', '2022-10-09 21:15:31', NULL, NULL, NULL, NULL),
(54, 3, 'PERGAMINO', 'KILO', '64.00', '0.00', '0.00', '0.00', '64.00', '8.00', '0.00', '8.00', '0.00', '512.00', '1', '1', '2022-10-09 21:15:31', '2022-10-09 21:15:31', NULL, NULL, NULL, NULL),
(55, 3, 'PERGAMINO', 'KILO', '45.00', '0.00', '0.00', '0.00', '45.00', '9.00', '0.00', '9.00', '0.00', '405.00', '1', '1', '2022-10-09 21:15:31', '2022-10-09 21:15:31', NULL, NULL, NULL, NULL),
(56, 12, 'COCO', 'KILO', '345.00', '0.00', '0.00', '0.00', '345.00', '10.00', '0.00', '10.00', '0.00', '3450.00', '1', '1', '2022-10-09 21:17:01', '2022-10-09 21:17:01', NULL, NULL, NULL, NULL),
(57, 13, 'PERGAMINO', 'KILO', '544.00', '0.00', '0.00', '0.00', '544.00', '3.00', '0.00', '3.00', '0.00', '1632.00', '1', '1', '2022-10-09 21:17:56', '2022-10-09 21:17:56', NULL, NULL, NULL, NULL),
(58, 4, 'PERGAMINO', 'KILO', '234.00', '0.00', '0.00', '0.00', '234.00', '1.00', '0.00', '1.00', '0.00', '234.00', '1', '1', '2022-10-09 21:24:54', '2022-10-09 21:24:54', NULL, NULL, NULL, NULL),
(59, 5, 'PERGAMINO', 'KILO', '23.00', '0.00', '0.00', '0.00', '23.00', '12.00', '0.00', '12.00', '0.00', '276.00', '1', '1', '2022-10-09 21:25:12', '2022-10-09 21:25:12', NULL, NULL, NULL, NULL),
(60, 6, 'PERGAMINO', 'KILO', '500.00', '0.00', '0.00', '0.00', '500.00', '4.00', '0.00', '4.00', '0.00', '2000.00', '1', '1', '2022-10-09 21:26:30', '2022-10-09 21:26:30', NULL, NULL, NULL, NULL),
(61, 6, 'COCO', 'KILO', '500.00', '0.00', '0.00', '0.00', '500.00', '3.00', '0.00', '3.00', '0.00', '1500.00', '1', '1', '2022-10-09 21:26:30', '2022-10-09 21:26:30', NULL, NULL, NULL, NULL),
(62, 6, 'PERGAMINO', 'KILO', '500.00', '0.00', '0.00', '0.00', '500.00', '4.00', '0.00', '4.00', '0.00', '2000.00', '1', '1', '2022-10-09 21:26:30', '2022-10-09 21:26:30', NULL, NULL, NULL, NULL),
(63, 6, 'COCO', 'KILO', '500.00', '0.00', '0.00', '0.00', '500.00', '10.00', '0.00', '10.00', '0.00', '5000.00', '1', '1', '2022-10-09 21:26:30', '2022-10-09 21:26:30', NULL, NULL, NULL, NULL),
(64, 8, 'PERGAMINO', 'KILO', '123.00', '0.00', '0.00', '0.00', '123.00', '1.69', '0.31', '2.00', '0.00', '246.00', '1', '1', '2022-10-09 21:27:27', '2022-10-09 21:27:27', NULL, NULL, NULL, NULL),
(65, 8, 'COCO', 'KILO', '345.00', '0.00', '0.00', '0.00', '345.00', '5.93', '1.07', '7.00', '0.00', '2415.00', '1', '1', '2022-10-09 21:27:27', '2022-10-09 21:27:27', NULL, NULL, NULL, NULL),
(66, 8, 'PERGAMINO', 'KILO', '23.00', '0.00', '0.00', '0.00', '23.00', '5.93', '1.07', '7.00', '0.00', '161.00', '1', '1', '2022-10-09 21:27:27', '2022-10-09 21:27:27', NULL, NULL, NULL, NULL),
(67, 8, 'COCO', 'KILO', '345.00', '0.00', '0.00', '0.00', '345.00', '4.24', '0.76', '5.00', '0.00', '1725.00', '1', '1', '2022-10-09 21:27:27', '2022-10-09 21:27:27', NULL, NULL, NULL, NULL),
(72, 7, 'PERGAMINO', 'KILO', '500.00', '0.00', '0.00', '0.00', '500.00', '4.00', '0.00', '4.00', '0.00', '2000.00', '1', '1', '2022-10-09 21:29:30', '2022-10-09 21:29:30', NULL, NULL, NULL, NULL),
(73, 7, 'COCO', 'KILO', '500.00', '0.00', '0.00', '0.00', '500.00', '3.00', '0.00', '3.00', '0.00', '1500.00', '1', '1', '2022-10-09 21:29:30', '2022-10-09 21:29:30', NULL, NULL, NULL, NULL),
(74, 7, 'PERGAMINO', 'KILO', '500.00', '0.00', '0.00', '0.00', '500.00', '4.00', '0.00', '4.00', '0.00', '2000.00', '1', '1', '2022-10-09 21:29:30', '2022-10-09 21:29:30', NULL, NULL, NULL, NULL),
(75, 7, 'COCO', 'KILO', '500.00', '0.00', '0.00', '0.00', '500.00', '20.00', '0.00', '20.00', '0.00', '10000.00', '1', '1', '2022-10-09 21:29:30', '2022-10-09 21:29:30', NULL, NULL, NULL, NULL),
(76, 14, 'COCO', 'KILO', '100.00', '1.00', '1.00', '0.20', '97.80', '10.00', '0.00', '10.00', '500.00', '478.00', '1', '1', '2022-10-10 14:41:05', '2022-10-10 14:41:05', NULL, NULL, NULL, NULL),
(80, 15, 'PERGAMINO', 'KILO', '110.00', '0.00', '0.00', '0.00', '110.00', '10.00', '0.00', '10.00', '0.00', '1100.00', '1', '1', '2022-10-10 17:08:50', '2022-10-10 17:08:50', NULL, NULL, NULL, NULL),
(81, 15, 'PERGAMINO', 'KILO', '110.00', '0.00', '0.00', '0.00', '110.00', '10.00', '0.00', '10.00', '0.00', '1100.00', '1', '1', '2022-10-10 17:08:50', '2022-10-10 17:08:50', NULL, NULL, NULL, NULL),
(82, 16, 'PERGAMINO', 'KILO', '110.00', '0.00', '0.00', '0.00', '110.00', '10.00', '0.00', '10.00', '0.00', '1100.00', '1', '1', '2022-10-11 12:10:38', '2022-10-11 12:10:38', NULL, NULL, NULL, NULL),
(83, 18, 'COCO', 'KILO', '203.00', '0.00', '0.00', '0.00', '203.00', '10.00', '0.00', '10.00', '0.00', '2030.00', '1', '1', '2022-10-11 12:20:10', '2022-10-11 12:20:10', NULL, NULL, NULL, NULL),
(84, 18, 'PERGAMINO', 'KILO', '203.00', '0.00', '0.00', '0.00', '203.00', '7.00', '0.00', '7.00', '0.00', '1421.00', '1', '1', '2022-10-11 12:20:10', '2022-10-11 12:20:10', NULL, NULL, NULL, NULL),
(85, 1, 'PERGAMINO', 'KILO', '10.00', '0.00', '0.00', '0.00', '10.00', '1.00', '0.00', '1.00', '0.00', '10.00', '1', '1', '2022-10-11 12:27:56', '2022-10-11 12:27:56', NULL, NULL, NULL, NULL),
(86, 1, 'PERGAMINO', 'KILO', '10.00', '0.00', '0.00', '0.00', '10.00', '2.00', '0.00', '2.00', '0.00', '20.00', '1', '1', '2022-10-11 12:27:56', '2022-10-11 12:27:56', NULL, NULL, NULL, NULL),
(87, 1, 'PERGAMINO', 'KILO', '110.00', '0.00', '0.00', '0.00', '110.00', '3.00', '0.00', '3.00', '0.00', '330.00', '1', '1', '2022-10-11 12:27:56', '2022-10-11 12:27:56', NULL, NULL, NULL, NULL),
(88, 20, 'PERGAMINO', 'KILO', '456.00', '0.00', '0.00', '0.00', '456.00', '8.47', '1.53', '10.00', '0.00', '4560.00', '1', '1', '2022-10-16 14:01:57', '2022-10-16 14:01:57', NULL, NULL, NULL, NULL),
(89, 21, 'PERGAMINO', 'KILO', '456.00', '0.00', '0.00', '0.00', '456.00', '10.00', '0.00', '10.00', '0.00', '4560.00', '1', '1', '2023-01-02 01:55:59', '2023-01-02 01:55:59', NULL, NULL, NULL, NULL);

--
-- Disparadores `detalle_compra_grano`
--
DELIMITER $$
CREATE TRIGGER `detalle_compra_grano_BEFORE_UPDATE` BEFORE UPDATE ON `detalle_compra_grano` FOR EACH ROW BEGIN
SET new.updated_at = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra_producto`
--

CREATE TABLE `detalle_compra_producto` (
  `iddetalle_compra_producto` int(11) NOT NULL,
  `idcompra_producto` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `unidad_medida` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `categoria` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `cantidad` decimal(11,2) DEFAULT NULL,
  `precio_sin_igv` decimal(11,2) DEFAULT NULL,
  `igv` decimal(11,2) DEFAULT NULL COMMENT 'precio_sin_igv * 0.18 = igv',
  `precio_con_igv` decimal(11,2) DEFAULT NULL COMMENT 'precio_sin_igv + igv = precio_con_igv',
  `precio_venta` decimal(11,2) DEFAULT NULL,
  `descuento` decimal(11,2) DEFAULT NULL,
  `subtotal` decimal(11,2) DEFAULT NULL COMMENT 'precio_con_igv - descuento = subtotal',
  `estado` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `estado_delete` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_compra_producto`
--

INSERT INTO `detalle_compra_producto` (`iddetalle_compra_producto`, `idcompra_producto`, `idproducto`, `unidad_medida`, `categoria`, `cantidad`, `precio_sin_igv`, `igv`, `precio_con_igv`, `precio_venta`, `descuento`, `subtotal`, `estado`, `estado_delete`, `created_at`, `updated_at`, `user_trash`, `user_delete`, `user_created`, `user_updated`) VALUES
(1, 1, 1, 'Kilogramo', 'ABONOS', '1.00', '13.00', '0.00', '13.00', '48.00', '0.00', '13.00', '1', '1', '2023-01-12 17:26:33', '2023-01-12 17:26:33', NULL, NULL, 1, NULL),
(2, 1, 8, 'litro', 'FOLIAR', '1.00', '16.00', '0.00', '16.00', '94.00', '0.00', '16.00', '1', '1', '2023-01-12 17:26:33', '2023-01-12 17:26:33', NULL, NULL, 1, NULL),
(3, 1, 6, 'litro', 'ABONOS', '1.00', '25.00', '0.00', '25.00', '84.00', '0.00', '25.00', '1', '1', '2023-01-12 17:26:33', '2023-01-12 17:26:33', NULL, NULL, 1, NULL),
(4, 1, 7, 'cajas', 'ABONOS', '1.00', '34.00', '0.00', '34.00', '73.00', '0.00', '34.00', '1', '1', '2023-01-12 17:26:33', '2023-01-12 17:26:33', NULL, NULL, 1, NULL),
(5, 1, 11, 'cajas', 'FUNGICIDAS', '1.00', '46.00', '0.00', '46.00', '95.00', '0.00', '46.00', '1', '1', '2023-01-12 17:26:33', '2023-01-12 17:26:33', NULL, NULL, 1, NULL),
(6, 1, 12, 'cajas', 'FOLIAR', '1.00', '75.00', '0.00', '75.00', '97.00', '0.00', '75.00', '1', '1', '2023-01-12 17:26:33', '2023-01-12 17:26:33', NULL, NULL, 1, NULL),
(7, 1, 9, 'Kilogramo', 'INSECTISIDAS', '1.00', '23.00', '0.00', '23.00', '85.00', '0.00', '23.00', '1', '1', '2023-01-12 17:26:33', '2023-01-12 17:26:33', NULL, NULL, 1, NULL),
(8, 1, 2, 'Kilogramo', 'NINGUNO', '1.00', '27.00', '0.00', '27.00', '64.00', '0.00', '27.00', '1', '1', '2023-01-12 17:26:33', '2023-01-12 17:26:33', NULL, NULL, 1, NULL),
(9, 1, 10, 'litro', 'ABONOS', '1.00', '56.00', '0.00', '56.00', '74.00', '0.00', '56.00', '1', '1', '2023-01-12 17:26:33', '2023-01-12 17:26:33', NULL, NULL, 1, NULL),
(10, 1, 14, 'Kilogramo', 'FUNGICIDAS', '1.00', '34.00', '0.00', '34.00', '75.00', '0.00', '34.00', '1', '1', '2023-01-12 17:26:33', '2023-01-12 17:26:33', NULL, NULL, 1, NULL),
(11, 1, 13, 'Kilogramo', 'FUNGICIDAS', '1.00', '37.00', '0.00', '37.00', '64.00', '0.00', '37.00', '1', '1', '2023-01-12 17:26:33', '2023-01-12 17:26:33', NULL, NULL, 1, NULL),
(12, 1, 5, 'litro', 'INSECTISIDAS', '1.00', '18.00', '0.00', '18.00', '53.00', '0.00', '18.00', '1', '1', '2023-01-12 17:26:33', '2023-01-12 17:26:33', NULL, NULL, 1, NULL),
(13, 2, 1, 'Kilogramo', 'ABONOS', '9.00', '13.00', '0.00', '13.00', '48.00', '0.00', '117.00', '1', '1', '2023-01-12 20:56:46', '2023-01-12 20:56:46', NULL, NULL, 1, NULL),
(14, 2, 9, 'Kilogramo', 'INSECTISIDAS', '9.00', '23.00', '0.00', '23.00', '85.00', '0.00', '207.00', '1', '1', '2023-01-12 20:56:46', '2023-01-12 20:56:46', NULL, NULL, 1, NULL),
(15, 2, 2, 'Kilogramo', 'NINGUNO', '9.00', '27.00', '0.00', '27.00', '64.00', '0.00', '243.00', '1', '1', '2023-01-12 20:56:46', '2023-01-12 20:56:46', NULL, NULL, 1, NULL),
(16, 2, 14, 'Kilogramo', 'FUNGICIDAS', '9.00', '34.00', '0.00', '34.00', '75.00', '0.00', '306.00', '1', '1', '2023-01-12 20:56:46', '2023-01-12 20:56:46', NULL, NULL, 1, NULL),
(17, 2, 13, 'Kilogramo', 'FUNGICIDAS', '9.00', '37.00', '0.00', '37.00', '64.00', '0.00', '333.00', '1', '1', '2023-01-12 20:56:46', '2023-01-12 20:56:46', NULL, NULL, 1, NULL),
(18, 2, 7, 'cajas', 'ABONOS', '9.00', '34.00', '0.00', '34.00', '73.00', '0.00', '306.00', '1', '1', '2023-01-12 20:56:47', '2023-01-12 20:56:47', NULL, NULL, 1, NULL),
(19, 2, 11, 'cajas', 'FUNGICIDAS', '9.00', '46.00', '0.00', '46.00', '95.00', '0.00', '414.00', '1', '1', '2023-01-12 20:56:47', '2023-01-12 20:56:47', NULL, NULL, 1, NULL),
(20, 2, 12, 'cajas', 'FOLIAR', '9.00', '75.00', '0.00', '75.00', '97.00', '0.00', '675.00', '1', '1', '2023-01-12 20:56:47', '2023-01-12 20:56:47', NULL, NULL, 1, NULL),
(21, 2, 8, 'litro', 'FOLIAR', '9.00', '16.00', '0.00', '16.00', '94.00', '0.00', '144.00', '1', '1', '2023-01-12 20:56:47', '2023-01-12 20:56:47', NULL, NULL, 1, NULL),
(22, 2, 6, 'litro', 'ABONOS', '9.00', '25.00', '0.00', '25.00', '84.00', '0.00', '225.00', '1', '1', '2023-01-12 20:56:47', '2023-01-12 20:56:47', NULL, NULL, 1, NULL),
(23, 2, 10, 'litro', 'ABONOS', '9.00', '56.00', '0.00', '56.00', '74.00', '0.00', '504.00', '1', '1', '2023-01-12 20:56:47', '2023-01-12 20:56:47', NULL, NULL, 1, NULL),
(24, 2, 5, 'litro', 'INSECTISIDAS', '9.00', '18.00', '0.00', '18.00', '53.00', '0.00', '162.00', '1', '1', '2023-01-12 20:56:47', '2023-01-12 20:56:47', NULL, NULL, 1, NULL),
(25, 3, 13, 'Kilogramo', 'FUNGICIDAS', '10.00', '37.00', '0.00', '37.00', '64.00', '0.00', '370.00', '1', '1', '2023-01-12 22:22:47', '2023-01-12 22:22:47', NULL, NULL, 1, NULL),
(26, 3, 5, 'litro', 'INSECTISIDAS', '10.00', '18.00', '0.00', '18.00', '53.00', '0.00', '180.00', '1', '1', '2023-01-12 22:22:47', '2023-01-12 22:22:47', NULL, NULL, 1, NULL),
(27, 4, 2, 'Kilogramo', 'NINGUNO', '12.00', '27.00', '0.00', '27.00', '64.00', '0.00', '324.00', '1', '1', '2023-01-13 15:35:21', '2023-01-13 15:35:21', NULL, NULL, 1, NULL),
(28, 4, 1, 'Kilogramo', 'ABONOS', '12.00', '13.00', '0.00', '13.00', '48.00', '0.00', '156.00', '1', '1', '2023-01-13 15:35:21', '2023-01-13 15:35:21', NULL, NULL, 1, NULL),
(29, 4, 13, 'Kilogramo', 'FUNGICIDAS', '12.00', '37.00', '0.00', '37.00', '64.00', '0.00', '444.00', '1', '1', '2023-01-13 15:35:21', '2023-01-13 15:35:21', NULL, NULL, 1, NULL),
(30, 4, 14, 'Kilogramo', 'FUNGICIDAS', '12.00', '34.00', '0.00', '34.00', '75.00', '0.00', '408.00', '1', '1', '2023-01-13 15:35:21', '2023-01-13 15:35:21', NULL, NULL, 1, NULL),
(31, 4, 9, 'Kilogramo', 'INSECTISIDAS', '12.00', '23.00', '0.00', '23.00', '85.00', '0.00', '276.00', '1', '1', '2023-01-13 15:35:21', '2023-01-13 15:35:21', NULL, NULL, 1, NULL),
(32, 4, 12, 'cajas', 'FOLIAR', '12.00', '75.00', '0.00', '75.00', '97.00', '0.00', '900.00', '1', '1', '2023-01-13 15:35:21', '2023-01-13 15:35:21', NULL, NULL, 1, NULL),
(33, 4, 7, 'cajas', 'ABONOS', '12.00', '34.00', '0.00', '34.00', '73.00', '0.00', '408.00', '1', '1', '2023-01-13 15:35:21', '2023-01-13 15:35:21', NULL, NULL, 1, NULL),
(34, 4, 11, 'cajas', 'FUNGICIDAS', '12.00', '46.00', '0.00', '46.00', '95.00', '0.00', '552.00', '1', '1', '2023-01-13 15:35:21', '2023-01-13 15:35:21', NULL, NULL, 1, NULL),
(35, 4, 8, 'litro', 'FOLIAR', '12.00', '16.00', '0.00', '16.00', '94.00', '0.00', '192.00', '1', '1', '2023-01-13 15:35:21', '2023-01-13 15:35:21', NULL, NULL, 1, NULL),
(36, 4, 6, 'litro', 'ABONOS', '12.00', '25.00', '0.00', '25.00', '84.00', '0.00', '300.00', '1', '1', '2023-01-13 15:35:21', '2023-01-13 15:35:21', NULL, NULL, 1, NULL),
(37, 4, 10, 'litro', 'ABONOS', '12.00', '56.00', '0.00', '56.00', '74.00', '0.00', '672.00', '1', '1', '2023-01-13 15:35:21', '2023-01-13 15:35:21', NULL, NULL, 1, NULL),
(38, 4, 5, 'litro', 'INSECTISIDAS', '12.00', '18.00', '0.00', '18.00', '53.00', '0.00', '216.00', '1', '1', '2023-01-13 15:35:21', '2023-01-13 15:35:21', NULL, NULL, 1, NULL),
(39, 5, 2, 'Kilogramo', 'NINGUNO', '15.00', '27.00', '0.00', '27.00', '64.00', '0.00', '405.00', '1', '1', '2023-01-13 15:35:56', '2023-01-13 15:35:56', NULL, NULL, 1, NULL),
(40, 5, 1, 'Kilogramo', 'ABONOS', '15.00', '13.00', '0.00', '13.00', '48.00', '0.00', '195.00', '1', '1', '2023-01-13 15:35:56', '2023-01-13 15:35:56', NULL, NULL, 1, NULL),
(41, 5, 13, 'Kilogramo', 'FUNGICIDAS', '15.00', '37.00', '0.00', '37.00', '64.00', '0.00', '555.00', '1', '1', '2023-01-13 15:35:56', '2023-01-13 15:35:56', NULL, NULL, 1, NULL),
(42, 5, 14, 'Kilogramo', 'FUNGICIDAS', '15.00', '34.00', '0.00', '34.00', '75.00', '0.00', '510.00', '1', '1', '2023-01-13 15:35:56', '2023-01-13 15:35:56', NULL, NULL, 1, NULL),
(43, 5, 9, 'Kilogramo', 'INSECTISIDAS', '15.00', '23.00', '0.00', '23.00', '85.00', '0.00', '345.00', '1', '1', '2023-01-13 15:35:56', '2023-01-13 15:35:56', NULL, NULL, 1, NULL),
(44, 5, 12, 'cajas', 'FOLIAR', '15.00', '75.00', '0.00', '75.00', '97.00', '0.00', '1125.00', '1', '1', '2023-01-13 15:35:56', '2023-01-13 15:35:56', NULL, NULL, 1, NULL),
(45, 5, 7, 'cajas', 'ABONOS', '15.00', '34.00', '0.00', '34.00', '73.00', '0.00', '510.00', '1', '1', '2023-01-13 15:35:56', '2023-01-13 15:35:56', NULL, NULL, 1, NULL),
(46, 5, 11, 'cajas', 'FUNGICIDAS', '15.00', '46.00', '0.00', '46.00', '95.00', '0.00', '690.00', '1', '1', '2023-01-13 15:35:56', '2023-01-13 15:35:56', NULL, NULL, 1, NULL),
(47, 5, 8, 'litro', 'FOLIAR', '15.00', '16.00', '0.00', '16.00', '94.00', '0.00', '240.00', '1', '1', '2023-01-13 15:35:56', '2023-01-13 15:35:56', NULL, NULL, 1, NULL),
(48, 5, 6, 'litro', 'ABONOS', '15.00', '25.00', '0.00', '25.00', '84.00', '0.00', '375.00', '1', '1', '2023-01-13 15:35:56', '2023-01-13 15:35:56', NULL, NULL, 1, NULL),
(49, 5, 10, 'litro', 'ABONOS', '15.00', '56.00', '0.00', '56.00', '74.00', '0.00', '840.00', '1', '1', '2023-01-13 15:35:56', '2023-01-13 15:35:56', NULL, NULL, 1, NULL),
(50, 5, 5, 'litro', 'INSECTISIDAS', '15.00', '18.00', '0.00', '18.00', '53.00', '0.00', '270.00', '1', '1', '2023-01-13 15:35:56', '2023-01-13 15:35:56', NULL, NULL, 1, NULL);

--
-- Disparadores `detalle_compra_producto`
--
DELIMITER $$
CREATE TRIGGER `detalle_compra_producto_BEFORE_UPDATE` BEFORE UPDATE ON `detalle_compra_producto` FOR EACH ROW BEGIN
SET new.updated_at = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta_grano`
--

CREATE TABLE `detalle_venta_grano` (
  `iddetalle_venta_grano` int(11) NOT NULL,
  `idventa_grano` int(11) NOT NULL,
  `estado` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `estado_delete` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Disparadores `detalle_venta_grano`
--
DELIMITER $$
CREATE TRIGGER `detalle_venta_grano_BEFORE_UPDATE` BEFORE UPDATE ON `detalle_venta_grano` FOR EACH ROW BEGIN
SET new.updated_at = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_venta_producto`
--

CREATE TABLE `detalle_venta_producto` (
  `iddetalle_venta_producto` int(11) NOT NULL,
  `idventa_producto` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `unidad_medida` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `categoria` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `cantidad` decimal(11,2) DEFAULT NULL,
  `precio_sin_igv` decimal(11,2) DEFAULT NULL,
  `igv` decimal(11,2) DEFAULT NULL COMMENT 'precio_sin_igv * 0.18 = igv',
  `precio_con_igv` decimal(11,2) DEFAULT NULL COMMENT 'precio_sin_igv + igv = precio_con_igv',
  `precio_compra` decimal(11,2) DEFAULT NULL,
  `descuento` decimal(11,2) DEFAULT NULL,
  `subtotal` decimal(11,2) DEFAULT NULL COMMENT 'precio_con_igv - descuento = subtotal',
  `estado` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `estado_delete` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_venta_producto`
--

INSERT INTO `detalle_venta_producto` (`iddetalle_venta_producto`, `idventa_producto`, `idproducto`, `unidad_medida`, `categoria`, `cantidad`, `precio_sin_igv`, `igv`, `precio_con_igv`, `precio_compra`, `descuento`, `subtotal`, `estado`, `estado_delete`, `created_at`, `updated_at`, `user_trash`, `user_delete`, `user_created`, `user_updated`) VALUES
(7, 6, 1, 'Kilogramo', 'ABONOS', '3.00', '48.00', '0.00', '48.00', '13.00', '0.00', '144.00', '1', '1', '2023-01-13 01:32:34', '2023-01-13 01:32:34', NULL, NULL, 1, NULL),
(8, 6, 8, 'Litro', 'FOLIAR', '3.00', '94.00', '0.00', '94.00', '16.00', '0.00', '282.00', '1', '1', '2023-01-13 01:32:34', '2023-01-13 01:32:34', NULL, NULL, 1, NULL),
(9, 6, 6, 'Litro', 'ABONOS', '2.00', '84.00', '0.00', '84.00', '25.00', '0.00', '168.00', '1', '1', '2023-01-13 01:32:34', '2023-01-13 01:32:34', NULL, NULL, 1, NULL),
(10, 6, 7, 'Cajas', 'ABONOS', '8.00', '73.00', '0.00', '73.00', '34.00', '0.00', '584.00', '1', '1', '2023-01-13 01:32:34', '2023-01-13 01:32:34', NULL, NULL, 1, NULL),
(11, 6, 11, 'Cajas', 'FUNGICIDAS', '8.00', '95.00', '0.00', '95.00', '46.00', '0.00', '760.00', '1', '1', '2023-01-13 01:32:34', '2023-01-13 01:32:34', NULL, NULL, 1, NULL),
(12, 6, 12, 'Cajas', 'FOLIAR', '7.00', '97.00', '0.00', '97.00', '75.00', '0.00', '679.00', '1', '1', '2023-01-13 01:32:34', '2023-01-13 01:32:34', NULL, NULL, 1, NULL),
(13, 6, 9, 'Kilogramo', 'INSECTISIDAS', '8.00', '85.00', '0.00', '85.00', '23.00', '0.00', '680.00', '1', '1', '2023-01-13 01:32:34', '2023-01-13 01:32:34', NULL, NULL, 1, NULL),
(14, 6, 2, 'Kilogramo', 'NINGUNO', '7.00', '64.00', '0.00', '64.00', '27.00', '0.00', '448.00', '1', '1', '2023-01-13 01:32:34', '2023-01-13 01:32:34', NULL, NULL, 1, NULL),
(15, 6, 10, 'Litro', 'ABONOS', '8.00', '74.00', '0.00', '74.00', '56.00', '0.00', '592.00', '1', '1', '2023-01-13 01:32:34', '2023-01-13 01:32:34', NULL, NULL, 1, NULL),
(16, 6, 14, 'Kilogramo', 'FUNGICIDAS', '4.00', '75.00', '0.00', '75.00', '34.00', '0.00', '300.00', '1', '1', '2023-01-13 01:32:34', '2023-01-13 01:32:34', NULL, NULL, 1, NULL),
(17, 6, 13, 'Kilogramo', 'FUNGICIDAS', '2.00', '64.00', '0.00', '64.00', '37.00', '0.00', '128.00', '1', '1', '2023-01-13 01:32:34', '2023-01-13 01:32:34', NULL, NULL, 1, NULL),
(18, 6, 5, 'Litro', 'INSECTISIDAS', '3.00', '53.00', '0.00', '53.00', '18.00', '0.00', '159.00', '1', '1', '2023-01-13 01:32:34', '2023-01-13 01:32:34', NULL, NULL, 1, NULL),
(19, 7, 9, 'Kilogramo', 'INSECTISIDAS', '1.00', '85.00', '0.00', '85.00', '23.00', '0.00', '85.00', '1', '1', '2023-01-13 15:33:44', '2023-01-13 15:33:44', NULL, NULL, 1, NULL),
(20, 7, 2, 'Kilogramo', 'NINGUNO', '2.00', '64.00', '0.00', '64.00', '27.00', '0.00', '128.00', '1', '1', '2023-01-13 15:33:44', '2023-01-13 15:33:44', NULL, NULL, 1, NULL),
(21, 7, 11, 'Cajas', 'FUNGICIDAS', '1.00', '95.00', '0.00', '95.00', '46.00', '0.00', '95.00', '1', '1', '2023-01-13 15:33:44', '2023-01-13 15:33:44', NULL, NULL, 1, NULL),
(22, 7, 12, 'Cajas', 'FOLIAR', '1.00', '97.00', '0.00', '97.00', '75.00', '0.00', '97.00', '1', '1', '2023-01-13 15:33:44', '2023-01-13 15:33:44', NULL, NULL, 1, NULL),
(23, 7, 10, 'Litro', 'ABONOS', '1.00', '74.00', '0.00', '74.00', '56.00', '0.00', '74.00', '1', '1', '2023-01-13 15:33:44', '2023-01-13 15:33:44', NULL, NULL, 1, NULL),
(24, 8, 1, 'Kilogramo', 'ABONOS', '2.00', '48.00', '0.00', '48.00', '13.00', '0.00', '96.00', '1', '1', '2023-01-13 16:07:10', '2023-01-13 16:07:10', NULL, NULL, 1, NULL),
(25, 8, 8, 'Litro', 'FOLIAR', '3.00', '94.00', '0.00', '94.00', '16.00', '0.00', '282.00', '1', '1', '2023-01-13 16:07:10', '2023-01-13 16:07:10', NULL, NULL, 1, NULL),
(26, 8, 6, 'Litro', 'ABONOS', '3.00', '84.00', '0.00', '84.00', '25.00', '0.00', '252.00', '1', '1', '2023-01-13 16:07:10', '2023-01-13 16:07:10', NULL, NULL, 1, NULL),
(27, 8, 7, 'Cajas', 'ABONOS', '4.00', '73.00', '0.00', '73.00', '34.00', '0.00', '292.00', '1', '1', '2023-01-13 16:07:10', '2023-01-13 16:07:10', NULL, NULL, 1, NULL),
(28, 8, 11, 'Cajas', 'FUNGICIDAS', '5.00', '95.00', '0.00', '95.00', '46.00', '0.00', '475.00', '1', '1', '2023-01-13 16:07:10', '2023-01-13 16:07:10', NULL, NULL, 1, NULL),
(29, 8, 12, 'Cajas', 'FOLIAR', '3.00', '97.00', '0.00', '97.00', '75.00', '0.00', '291.00', '1', '1', '2023-01-13 16:07:10', '2023-01-13 16:07:10', NULL, NULL, 1, NULL);

--
-- Disparadores `detalle_venta_producto`
--
DELIMITER $$
CREATE TRIGGER `detalle_venta_producto_BEFORE_UPDATE` BEFORE UPDATE ON `detalle_venta_producto` FOR EACH ROW BEGIN
SET new.updated_at = CURRENT_TIMESTAMP;
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
  `mes_nombre` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `anio` year(4) DEFAULT NULL,
  `estado` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `estado_delete` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `mes_pago_trabajador`
--

INSERT INTO `mes_pago_trabajador` (`idmes_pago_trabajador`, `idpersona`, `mes_nombre`, `anio`, `estado`, `estado_delete`, `created_at`, `updated_at`, `user_trash`, `user_delete`, `user_created`, `user_updated`) VALUES
(1, 8, 'Enero', 2023, '1', '1', '2023-01-10 15:46:21', '2023-01-10 15:46:21', NULL, NULL, NULL, NULL),
(2, 5, 'Enero', 2023, '1', '1', '2023-01-10 17:00:54', '2023-01-10 17:00:54', NULL, NULL, NULL, NULL);

--
-- Disparadores `mes_pago_trabajador`
--
DELIMITER $$
CREATE TRIGGER `mes_pago_trabajador_BEFORE_UPDATE` BEFORE UPDATE ON `mes_pago_trabajador` FOR EACH ROW BEGIN
SET new.updated_at = CURRENT_TIMESTAMP;
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
  `tipo_comprobante` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `numero_comprobante` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `forma_de_pago` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `precio_sin_igv` decimal(11,2) DEFAULT NULL,
  `precio_igv` decimal(11,2) DEFAULT NULL,
  `val_igv` decimal(11,2) DEFAULT NULL,
  `precio_con_igv` decimal(11,2) DEFAULT NULL,
  `tipo_gravada` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `comprobante` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `estado_delete` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `otro_ingreso`
--

INSERT INTO `otro_ingreso` (`idotro_ingreso`, `idpersona`, `fecha_ingreso`, `tipo_comprobante`, `numero_comprobante`, `forma_de_pago`, `precio_sin_igv`, `precio_igv`, `val_igv`, `precio_con_igv`, `tipo_gravada`, `descripcion`, `comprobante`, `estado`, `estado_delete`, `created_at`, `updated_at`, `user_trash`, `user_delete`, `user_created`, `user_updated`) VALUES
(1, 3, '2023-01-02', 'Factura', '', 'Efectivo', '123.00', '0.00', '0.18', '123.00', 'GRAVADA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi urna dolor, porta vitae fermentum malesuada, suscipit nec massa. Pellentesque consequat quam quis mattis aliquet. Nulla id aliquet ante, a gravida nisl. Nulla facilisi. Donec pharetra vitae ligula ut interdum. Etiam porttitor nulla risus, id dignissim ex venenatis eu. Aliquam odio libero, consectetur id leo at, scelerisque ultrices libero. Cras a risus iaculis, dignissim lacus eu, consectetur arcu. Pellentesque tristique faucibus tristique. Mauris lacinia pretium dui. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Integer sit amet euismod quam.', '02-01-2023 09.06.44 AM 2167266840531.png', '1', '1', '2023-01-02 14:06:44', '2023-01-02 18:20:28', NULL, NULL, NULL, NULL),
(2, 3, '2023-01-02', 'Ninguno', '', 'Efectivo', '123.00', '0.00', NULL, '123.00', 'NO GRAVADA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi urna dolor, porta vitae fermentum malesuada, suscipit nec massa. Pellentesque consequat quam quis mattis aliquet. Nulla id aliquet ante, a gravida nisl. Nulla facilisi. Donec pharetra vitae ligula ut interdum. Etiam porttitor nulla risus, id dignissim ex venenatis eu. Aliquam odio libero, consectetur id leo at, scelerisque ultrices libero. Cras a risus iaculis, dignissim lacus eu, consectetur arcu. Pellentesque tristique faucibus tristique. Mauris lacinia pretium dui. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Integer sit amet euismod quam.', '02-01-2023 09.06.44 AM 2167266840531.png', '1', '0', '2023-01-02 14:06:44', '2023-01-02 14:09:27', NULL, NULL, NULL, NULL),
(3, 12, '2023-01-02', 'Factura', '876-540', 'Transferencia', '7990.91', '799.09', '0.10', '8790.00', 'GRAVADA', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,molestiae quas vel sint commodi repudiandae consequuntur voluptatum', '02-01-2023 12.17.57 PM 5167267987821.jpg', '1', '1', '2023-01-02 17:17:57', '2023-01-02 18:22:01', NULL, NULL, NULL, NULL),
(4, 13, '2023-01-02', 'Factura', '876-549', 'Crédito', '1000.00', '180.00', '0.18', '1180.00', 'GRAVADA', 'fffggg ggggggggggggggg', '02-01-2023 01.14.25 PM 10167268326627.jpg', '1', '1', '2023-01-02 18:14:25', '2023-01-02 18:21:41', NULL, NULL, NULL, NULL),
(5, 9, '2023-01-02', 'Factura', '876-543', 'Efectivo', '10256.41', '1743.59', '0.17', '12000.00', 'GRAVADA', 'hhhhhhhhhhhhhh hhhhhhhhhhhhhhh hhhhhhhhh', '', '1', '1', '2023-01-02 18:16:50', '2023-01-02 18:20:14', NULL, NULL, NULL, NULL),
(6, 27, '2023-01-04', 'Factura', '', 'Efectivo', '292.37', '52.63', '0.18', '345.00', 'GRAVADA', 'dasdsadfsfafsafs', '', '1', '1', '2023-01-10 17:21:58', '2023-01-10 17:21:58', NULL, NULL, NULL, NULL);

--
-- Disparadores `otro_ingreso`
--
DELIMITER $$
CREATE TRIGGER `otro_ingreso_BEFORE_UPDATE` BEFORE UPDATE ON `otro_ingreso` FOR EACH ROW BEGIN
SET new.updated_at = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_compra_grano`
--

CREATE TABLE `pago_compra_grano` (
  `idpago_compra_grano` int(11) NOT NULL,
  `idcompra_grano` int(11) NOT NULL,
  `forma_pago` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_pago` date DEFAULT NULL,
  `monto` decimal(11,2) DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `comprobante` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `estado_delete` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `pago_compra_grano`
--

INSERT INTO `pago_compra_grano` (`idpago_compra_grano`, `idcompra_grano`, `forma_pago`, `fecha_pago`, `monto`, `descripcion`, `comprobante`, `estado`, `estado_delete`, `created_at`, `updated_at`, `user_trash`, `user_delete`, `user_created`, `user_updated`) VALUES
(1, 18, 'EFECTIVO', '2022-10-11', '3451.00', '', '', '1', '1', '2022-10-11 12:20:10', '2022-10-16 03:47:29', 1, NULL, 1, NULL),
(2, 16, 'Transferencia', '2022-10-11', '100.00', 'dasasd asd asdasd', '', '0', '1', '2022-10-16 02:48:30', '2022-10-16 04:00:06', 1, NULL, NULL, NULL),
(3, 16, 'Transferencia', '2022-10-19', '100.00', '', '15-10-2022 10.48.02 PM 8166589208321.pdf', '0', '1', '2022-10-16 03:48:02', '2022-10-16 04:00:02', 1, NULL, NULL, NULL),
(4, 16, 'Transferencia', '2022-10-13', '300.00', '', '', '0', '1', '2022-10-16 03:59:12', '2022-10-16 04:00:40', 1, NULL, NULL, NULL),
(5, 16, 'Efectivo', '2022-10-18', '200.00', 'tjfjf', '', '0', '1', '2022-10-16 04:07:52', '2022-10-16 04:50:52', 1, NULL, NULL, NULL),
(6, 16, 'Efectivo', '2022-10-20', '1000.00', 'glkghjklg', '15-10-2022 11.08.17 PM 10166589329736.pdf', '1', '1', '2022-10-16 04:08:17', '2022-10-16 04:51:53', NULL, NULL, NULL, NULL),
(7, 7, 'Efectivo', '2022-10-19', '5500.00', '', '16-10-2022 08.49.32 AM 15166592817230.jpeg', '1', '1', '2022-10-16 13:46:33', '2022-10-16 13:49:32', NULL, NULL, NULL, NULL),
(8, 16, 'Transferencia', '2022-10-06', '500.00', 'df efd sf', '16-10-2022 08.56.02 AM 10166592856334.jpg', '0', '1', '2022-10-16 13:56:02', '2022-12-26 13:35:13', 1, NULL, NULL, NULL),
(9, 20, 'EFECTIVO', '2022-10-16', '4560.00', '', '', '1', '1', '2022-10-16 14:01:57', '2022-10-16 14:01:57', NULL, NULL, 1, NULL),
(10, 7, 'Efectivo', '2022-12-13', '10000.00', 'se pago completo', '', '1', '1', '2022-12-15 01:48:10', '2022-12-15 01:48:10', NULL, NULL, NULL, NULL),
(11, 17, 'Efectivo', '2022-12-22', '1100.00', 'dasdsad', '', '1', '1', '2022-12-25 21:32:54', '2022-12-25 21:32:54', NULL, NULL, NULL, NULL),
(12, 15, 'Efectivo', '2022-12-08', '2200.00', '', '', '1', '1', '2022-12-25 21:33:37', '2022-12-25 21:33:37', NULL, NULL, NULL, NULL),
(13, 21, 'EFECTIVO', '2023-01-01', '4560.00', '', '', '1', '1', '2023-01-02 01:55:59', '2023-01-02 01:55:59', NULL, NULL, 1, NULL);

--
-- Disparadores `pago_compra_grano`
--
DELIMITER $$
CREATE TRIGGER `pago_compra_grano_BEFORE_UPDATE` BEFORE UPDATE ON `pago_compra_grano` FOR EACH ROW BEGIN
SET new.updated_at = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_compra_producto`
--

CREATE TABLE `pago_compra_producto` (
  `idpago_compra_producto` int(11) NOT NULL,
  `idcompra_producto` int(11) NOT NULL,
  `forma_pago` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tipo_pago` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_pago` date DEFAULT NULL,
  `numero_operacion` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `monto` decimal(11,2) DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `comprobante` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `estado_delete` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Disparadores `pago_compra_producto`
--
DELIMITER $$
CREATE TRIGGER `pago_compra_producto_BEFORE_UPDATE` BEFORE UPDATE ON `pago_compra_producto` FOR EACH ROW BEGIN
SET new.updated_at = CURRENT_TIMESTAMP;
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
  `nombre_mes` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `monto` decimal(11,2) DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `comprobante` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `estado_delete` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `pago_trabajador`
--

INSERT INTO `pago_trabajador` (`idpago_trabajador`, `idmes_pago_trabajador`, `fecha_pago`, `nombre_mes`, `monto`, `descripcion`, `comprobante`, `estado`, `estado_delete`, `created_at`, `updated_at`, `user_trash`, `user_delete`, `user_created`, `user_updated`) VALUES
(3, 1, '2023-01-19', 'Enero', '1000.00', '', '10-01-2023 10.48.01 AM 0167336568228.png', '1', '1', '2023-01-10 15:48:01', '2023-01-10 15:48:01', NULL, NULL, NULL, NULL),
(4, 1, '2023-01-19', 'Enero', '1000.00', 'sdsadasfsafsaf', '10-01-2023 10.50.39 AM 3167336583928.pdf', '1', '1', '2023-01-10 15:50:39', '2023-01-10 15:50:39', NULL, NULL, NULL, NULL),
(5, 2, '2023-01-20', 'Enero', '319.00', '', '', '1', '1', '2023-01-10 17:01:11', '2023-01-10 17:01:11', NULL, NULL, NULL, NULL),
(6, 2, '2023-01-18', 'Enero', '56.00', '', '', '1', '1', '2023-01-10 17:04:03', '2023-01-10 17:04:03', NULL, NULL, NULL, NULL),
(7, 2, '2023-01-14', 'Enero', '100.00', '', '', '1', '1', '2023-01-10 17:05:58', '2023-01-10 17:05:58', NULL, NULL, NULL, NULL);

--
-- Disparadores `pago_trabajador`
--
DELIMITER $$
CREATE TRIGGER `pago_trabajador_BEFORE_UPDATE` BEFORE UPDATE ON `pago_trabajador` FOR EACH ROW BEGIN
SET new.updated_at = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_venta_producto`
--

CREATE TABLE `pago_venta_producto` (
  `idpago_venta_producto` int(11) NOT NULL,
  `idventa_producto` int(11) NOT NULL,
  `forma_pago` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tipo_pago` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_pago` date DEFAULT NULL,
  `numero_operacion` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `monto` decimal(11,2) DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `comprobante` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `estado_delete` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `pago_venta_producto`
--

INSERT INTO `pago_venta_producto` (`idpago_venta_producto`, `idventa_producto`, `forma_pago`, `tipo_pago`, `fecha_pago`, `numero_operacion`, `monto`, `descripcion`, `comprobante`, `estado`, `estado_delete`, `created_at`, `updated_at`, `user_trash`, `user_delete`, `user_created`, `user_updated`) VALUES
(6, 6, 'EFECTIVO', NULL, '2023-01-09', NULL, '4924.00', '', '', '1', '1', '2023-01-13 01:32:34', '2023-01-13 01:32:34', NULL, NULL, 1, NULL),
(7, 7, 'EFECTIVO', NULL, '2023-01-09', NULL, '479.00', '', '', '1', '1', '2023-01-13 15:33:44', '2023-01-13 15:33:44', NULL, NULL, 1, NULL),
(8, 8, 'EFECTIVO', NULL, '2023-01-09', NULL, '1688.00', '', '', '1', '1', '2023-01-13 16:07:10', '2023-01-13 16:07:10', NULL, NULL, 1, NULL);

--
-- Disparadores `pago_venta_producto`
--
DELIMITER $$
CREATE TRIGGER `pago_venta_producto_BEFORE_UPDATE` BEFORE UPDATE ON `pago_venta_producto` FOR EACH ROW BEGIN
SET new.updated_at = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permiso`
--

CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `icono` varchar(500) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `estado_delete` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
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
(2, 'Accesos', '<i class=\"fas fa-shield-alt\"></i>', '1', '1', '2022-09-21 03:53:07', '2022-09-21 03:53:07', NULL, NULL, NULL, NULL),
(3, 'Recursos', '<i class=\"fas fa-project-diagram\"></i>', '1', '1', '2022-09-21 03:53:07', '2022-09-21 03:53:07', NULL, NULL, NULL, NULL),
(4, 'Papelera', '<i class=\"fas fa-trash-alt\"></i>', '1', '1', '2022-09-21 03:53:07', '2022-09-21 03:53:07', NULL, NULL, NULL, NULL),
(5, 'Alamacen de Abono', '<i class=\"fa-solid fa-boxes-stacked\"></i>', '1', '1', '2022-09-21 03:53:07', '2022-09-21 03:53:07', NULL, NULL, NULL, NULL),
(6, 'Venta de Abono', '<i class=\"fas fa-shopping-cart nav-icon\"></i>', '1', '1', '2022-09-21 03:53:07', '2022-09-21 03:53:07', NULL, NULL, NULL, NULL),
(7, 'Compras grano', '<img src=\"../dist/svg/negro-grano-cafe-ico.svg\" class=\"nav-icon\" alt=\"\" style=\"width: 15px !important;\" >', '1', '1', '2022-09-21 03:53:07', '2022-09-21 03:53:07', NULL, NULL, NULL, NULL),
(8, 'Pago Trabajador', '<i class=\"fas fa-dollar-sign nav-icon\"></i>', '1', '1', '2022-09-21 03:53:07', '2022-09-21 03:53:07', NULL, NULL, NULL, NULL),
(9, 'Otro Ingreso', '<i class=\"nav-icon fas fa-hand-holding-usd\"></i>', '1', '1', '2022-09-21 03:53:07', '2022-09-21 03:53:07', NULL, NULL, NULL, NULL);

--
-- Disparadores `permiso`
--
DELIMITER $$
CREATE TRIGGER `permiso_BEFORE_UPDATE` BEFORE UPDATE ON `permiso` FOR EACH ROW BEGIN
SET new.updated_at = CURRENT_TIMESTAMP;
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
  `nombres` varchar(200) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tipo_documento` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `numero_documento` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `celular` varchar(15) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `direccion` varchar(200) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `correo` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `cuenta_bancaria` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `cci` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `titular_cuenta` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `es_socio` char(1) COLLATE utf8mb4_spanish_ci DEFAULT NULL COMMENT '1=si-socio, 2=no-socio',
  `sueldo_mensual` decimal(11,2) DEFAULT NULL,
  `sueldo_diario` decimal(11,2) DEFAULT NULL,
  `foto_perfil` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `estado_delete` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
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
(1, 1, 1, 1, 'CLIENTES VARIOS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', NULL, NULL, NULL, '1', '1', '2022-09-29 18:19:53', '2023-01-12 20:45:28', NULL, NULL, NULL, NULL),
(3, 4, 2, 3, 'DAVID MELVIN REQUEJO SANTA CRUZ', 'DNI', '74535601', '0000-00-00', 0, '097-867-564', 'Jr San Martin barrio la ribera S/N', 'requejodavidmelvin@gmail.com', '8765-4334-567_______', '765-432-1435________-__', 'DAVID MELVIN REQUEJO SANTA CRUZ', '1', '0.00', '0.00', '12-01-2023 12.10.31 PM 19167354343132.jpg', '1', '1', '2022-09-29 19:50:09', '2023-01-12 17:10:31', NULL, NULL, NULL, 1),
(4, 4, 6, 4, 'Maria Requejo', 'DNI', '74535601', '1996-06-19', 26, '921-305-769', 'Jr San Martin barrio la ribera S/N', 'requejodavidmelvin@gmail.com', '87-654-329999', '1234569999', '', '1', '3421.00', '114.00', '12-01-2023 12.10.58 PM 9167354345832.jpg', '1', '1', '2022-09-29 19:50:22', '2023-01-12 17:10:58', NULL, NULL, NULL, 1),
(5, 4, 2, 2, 'GRACIELA CHAPARRO', 'DNI', '75898721', '2005-01-13', 18, '987-654-324', 'Jr San Martin barrio la ribera S/N', 'juniorcercado@upeu.edu.pe', '0869-8989-7878768787', '', 'GRACIELA ALEJANDRA HUAMAN CHAPARRO', '1', '0.00', '0.00', '12-01-2023 12.09.11 PM 17167354335231.jpg', '1', '1', '2022-09-30 20:30:54', '2023-01-13 16:42:38', NULL, NULL, 1, 1),
(6, 4, 2, 3, 'CARLA LISETH GALAN MASS', 'DNI', '75898727', '0000-00-00', 0, '987-654-324', 'Jr San Martin barrio la ribera S/N', 'juniorcercado@upeu.edu.pe', '8986-7564-5342324567', '908-976-543245674567-89', 'CARLA LISETH GALAN MASS', '1', '0.00', '0.00', '12-01-2023 12.10.44 PM 5167354344539.jpg', '1', '1', '2022-09-30 20:32:58', '2023-01-12 17:10:44', NULL, NULL, 1, 1),
(7, 4, 7, 2, 'RAMON REQUEJO GUEVARA', 'DNI', '27701215', '0000-00-00', 0, '987-654-324', 'Jr San Martin barrio la ribera S/N', 'requejodavidmelvin@gmail.com', '123-45678909-8-76', '123-456-787654321345-60', 'RAMON REQUEJO GUEVARA', '1', '0.00', '0.00', '12-01-2023 12.09.18 PM 10167354335823.jpg', '1', '1', '2022-09-30 21:32:02', '2023-01-12 17:09:18', NULL, NULL, 1, 1),
(8, 4, 2, 2, 'ALEXITO CHUQUIHUANGA CUNYA', 'DNI', '02864992', '0000-00-00', 0, '089-786-564', 'Jr San Martin barrio la ribera S/N', 'requejodavidmelvin@gmail.com', '3467-8654-321346____', '435-678-908765432678-97', 'ALEX BAUTISTA CHUQUIHUANGA CUNYA', '1', '0.00', '0.00', '12-01-2023 12.09.27 PM 4167354336730.jpg', '1', '1', '2022-09-30 22:34:29', '2023-01-12 17:09:27', NULL, NULL, 1, 1),
(9, 4, 7, 2, 'GERVACIO RIVERA MIJA', 'DNI', '03081417', '0000-00-00', 0, '921-305-769', 'Jr San Martin barrio la ribera S/N', 'juniorcercado@upeu.edu.pe', '090-87654356-7-89', '908-765-654343546789-75', 'GERVACIO RIVERA MIJA', '1', '0.00', '0.00', '12-01-2023 12.09.37 PM 19167354337733.jpg', '1', '1', '2022-09-30 22:42:29', '2023-01-12 17:09:37', NULL, NULL, 1, 1),
(12, 4, 7, 2, 'PAPEL Y TIJERAS E.I.R.L.', 'RUC', '20601902762', '0000-00-00', 0, '921-487-276', 'CAL. OCOÑA NRO. 109 HIGUERETA 6', 'juniorcercado@upeu.edu.pe', '', '', 'PAPEL Y TIJERAS E.I.R.L.', '1', '0.00', '0.00', '12-01-2023 12.09.48 PM 14167354338927.jpg', '1', '1', '2022-12-15 21:00:21', '2023-01-12 17:09:48', NULL, NULL, 1, 1),
(13, 3, 7, 1, 'HILOS & ESTILOS S.A.C.', 'RUC', '20521972956', '2001-06-07', 21, '921-487-276', 'AV. GUILLERMO DANSEY NRO. 2225 LIMA LIMA LIMA', 'juniorcercado@upeu.edu.pe', '454-35454545-_-__', '634-634-6344________-__', 'HILOS & ESTILOS S.A.C.', '0', '0.00', '0.00', '12-01-2023 12.08.16 PM 10167354329732.jpg', '1', '1', '2022-12-15 21:44:52', '2023-01-12 17:20:20', NULL, NULL, 1, 1),
(17, 2, 6, 1, 'KEITY MIREY GUERRERO CASTILLO', 'DNI', '74535602', '2003-06-25', 19, '921-487-276', 'Perufdghtrgrst b', 'juniorcercado@upeu.edu.pe', '09-876-543232', '3333333333', 'KEITY MIREY GUERRERO CASTILLO', '0', '0.00', '0.00', '12-01-2023 12.07.27 PM 8167354324824.jpg', '1', '1', '2023-01-02 17:27:03', '2023-01-13 16:43:46', NULL, NULL, NULL, 1),
(18, 3, 4, 1, 'YELSEN GUERRERO CASTILLO', 'DNI', '74535603', '2002-06-13', 20, '921-487-276', 'Perusdsdsd', 'guerrero@upeu.edu.pe', '0987-6543-2878909808', '5678-9874-3788997894', 'YELSEN GUERRERO CASTILLO', '', '0.00', '0.00', '12-01-2023 12.08.23 PM 3167354330434.jpg', '1', '1', '2023-01-02 17:40:11', '2023-01-13 16:43:20', NULL, NULL, NULL, 1),
(19, 3, 6, 1, 'SAMUEL AMADOR ALANIA SABINO', 'DNI', '23150497', '1997-06-18', 25, '921-487-276', 'Jr San Martin barrio la ribera S/N', 'sabino@upeu.edu.pe', '09-876-543213', '5678965432', 'SAMUEL AMADOR ALANIA SABINO', '', '0.00', '0.00', '12-01-2023 12.08.31 PM 16167354331129.jpg', '1', '1', '2023-01-02 17:52:21', '2023-01-12 17:08:31', NULL, NULL, NULL, 1),
(23, 2, 6, 1, 'ANTONIO RAMOS TAYPE', 'DNI', '76535342', '2001-02-08', 21, '921-305-769', 'Jr San Martin barrio la ribera S/N', 'davidrequejo@upeu.edu.pe', '98-765-432123', '6543234567', 'ANTONIO RAMOS TAYPE', '1', '0.00', '0.00', '12-01-2023 12.07.38 PM 11167354325837.jpg', '1', '1', '2023-01-03 20:07:20', '2023-01-12 17:07:38', NULL, NULL, 1, 1),
(24, 4, 5, 2, 'probandodddddd', 'DNI', '76535345', '2004-01-03', 19, '987-654-324', 'Jr San Martin barrio la ribera S/N', 'davidrequejo@upeu.edu.pe', '9876-5432-123456____', '4356-7456-7896543213', 'REQUEJO GUEVARA RAMON', '1', '3500.00', '116.70', '12-01-2023 12.09.57 PM 15167354339722.jpg', '1', '1', '2023-01-03 20:11:45', '2023-01-12 17:09:57', NULL, 1, 1, 1),
(25, 4, 6, 2, 'nombre 12334', 'DNI', '11010101', '2001-02-07', 21, '987-654-321', 'Jr San Martin barrio la ribera S/N', 'keny17274@gmail.com', '09-876-543212', '0987654321', 'nombre 1233456', '0', '12300.00', '410.00', '12-01-2023 12.10.12 PM 9167354341330.jpg', '1', '1', '2023-01-03 20:23:56', '2023-01-12 17:10:12', NULL, NULL, 1, 1),
(26, 2, 6, 1, 'MAURICIO BRUNO RIOFRIO', 'DNI', '03375801', '0000-00-00', 0, '921-487-276', 'Jr. los carmines #423', '', '98-768-567345', '4543543543', 'MAURICIO BRUNO RIOFRIO', '', '0.00', '0.00', '12-01-2023 12.07.45 PM 0167354326640.jpg', '1', '1', '2023-01-10 17:13:08', '2023-01-12 17:07:45', NULL, NULL, NULL, 1),
(27, 3, 6, 1, 'CESAR AUGUSTO CASTILLO GUTIERREZ', 'DNI', '03378284', '0000-00-00', 0, '921-487-276', 'Jr. las neces de filagrata #532', '', '43-434-353454', '4543543543', 'CESAR AUGUSTO CASTILLO GUTIERREZ', '', '0.00', '0.00', '12-01-2023 12.08.37 PM 12167354331830.jpg', '1', '1', '2023-01-10 17:21:16', '2023-01-12 17:08:37', NULL, NULL, NULL, 1),
(28, 1, 7, 1, 'YANETT CHERO REYES', 'DNI', '03379808', '1997-01-29', 25, '921-487-276', 'Jr. el camesi d los divnos', 'reyes@upeu.edu.pe', '534-54354363-4-52', '546-435-654653463457-__', 'YANETT CHERO REYES', '1', '0.00', '0.00', '11-01-2023 10.37.29 AM 15167345144929.png', '1', '1', '2023-01-11 15:37:29', '2023-01-12 20:13:46', NULL, NULL, 1, NULL),
(29, 1, 6, 1, 'ALOYS SALAZAR LINGAN', 'DNI', '16693944', '2003-06-24', 19, '921-487-276', 'Jr. los camersis de la rinconada', 'lingan@upeu.edu.pe', '84-635-345345', '5465437756', 'ALOYS SALAZAR LINGAN', '1', '0.00', '0.00', '11-01-2023 10.55.00 AM 7167345250031.jpg', '1', '1', '2023-01-11 15:55:00', '2023-01-12 20:13:50', NULL, NULL, 1, NULL),
(30, 2, 4, 1, 'EDWIN EDUARDO GONZÁLES DÁVILA', 'DNI', '16716048', '1997-12-07', 25, '921-487-276', 'Jr. los carmesis', 'davila@upeu.edu.pe', '4624-5234-234_______', '3463-4534-67________', 'EDWIN EDUARDO GONZÁLES DÁVILA', '0', '0.00', '0.00', '12-01-2023 12.07.54 PM 17167354327430.jpg', '1', '1', '2023-01-11 16:13:10', '2023-01-12 17:07:54', NULL, NULL, 1, 1),
(31, 2, 2, 1, 'ABONOS VIVOS S.A.C', 'RUC', '20601932394', '0000-00-00', 0, '921-487-276', 'CAL. GRIMALDO DEL SOLAR NRO. 162 DPTO. 1003 URB. LEURO LIMA LIMA MIRAFLORES', 'vivos@upeu.edu.pe', '3432-4324-3243243252', '235-235-235325352352-__', 'ABONOS VIVOS S.A.C', '0', '0.00', '0.00', '12-01-2023 12.08.02 PM 17167354328333.jpg', '1', '1', '2023-01-11 22:52:54', '2023-01-12 17:08:02', NULL, NULL, 1, 1),
(32, 2, 7, 1, 'FERTILIZANTES, ABONOS ORGANICOS Y SERVICIOS DE CARGA AHM E.I.R.L.', 'RUC', '20604796629', '1996-01-30', 26, '921-487-276', 'AV. CHICLAYO NRO. SN LAMBAYEQUE CHICLAYO JOSE LEONARDO ORTIZ', 'organicos@upeu.edu.pe', '432-43253243-2-42', '324-235-325234313234-24', 'FERTILIZANTES, ABONOS ORGANICOS Y SERVICIOS D', '0', '0.00', '0.00', '12-01-2023 12.08.09 PM 16167354329023.jpg', '1', '1', '2023-01-11 23:32:06', '2023-01-12 17:08:09', NULL, NULL, 1, 1),
(33, 3, 2, 1, 'AGRO ANIBAL PERU S.A.C.', 'RUC', '20606346329', '1998-01-06', 25, '921-487-276', 'JR. TOCACHE NRO. 559 INT. A SAN MARTIN TOCACHE TOCACHE', 'agroanibal@upeu.edu.pe', '6453-6243-642_______', '786-789-7897________-__', 'AGRO ANIBAL PERU S.A.C.', '0', '0.00', '0.00', '12-01-2023 12.09.02 PM 13167354334227.jpg', '1', '1', '2023-01-12 00:03:11', '2023-01-12 17:09:02', NULL, NULL, 1, 1),
(34, 3, 7, 1, 'GRUPO AGRO PERU S.A.C.', 'RUC', '20604839816', '2001-05-31', 21, '921-487-276', 'AV. LA CULTURA NRO. 808 INT. B-65 GRAN MERCADO MAYORISTA DE LIMA LIMA SANTA ANITA', 'grupo@upeu.edu.pe', '325-32533242-3-42', '423-423-423423423523-54', 'GRUPO AGRO PERU S.A.C.', '0', '0.00', '0.00', '12-01-2023 10.36.31 AM 19167353779124.jpg', '1', '1', '2023-01-12 15:36:31', '2023-01-12 15:37:20', NULL, NULL, 1, 1),
(35, 2, 2, 1, 'JOSE BURE QUIROGA', 'DNI', '03200965', '2001-02-06', 21, '921-487-276', 'Jr. l,o ñatos de carmen', 'quiroga@upeu.edu.pe', '3523-4234-2343253243', '234-324-3243253232__-__', 'JOSE BURE QUIROGA', '0', '0.00', '0.00', '', '1', '1', '2023-01-15 16:24:45', '2023-01-15 16:24:45', NULL, NULL, 1, NULL),
(36, 4, 2, 1, 'EUSEBIO GUERRERO PINTADO', 'DNI', '03201798', '2005-01-06', 18, '921-487-276', 'fdsf dfsdafdas fsd df dsf dsf', 'quiroga@upeu.edu.pe', '4543-5435-4354534543', '454-354-354562352343-25', 'EUSEBIO GUERRERO PINTADO', '0', '0.00', '0.00', ' 9167380110331.png', '1', '1', '2023-01-15 16:45:03', '2023-01-15 16:45:03', NULL, NULL, 1, NULL),
(37, 4, 2, 1, 'ELMER GUSTAVO NEIRA CRUZ', 'DNI', '03209586', '2005-01-06', 18, '921-487-276', 'fdsf dfsdafdas fsd df dsf dsf', 'quiroga@upeu.edu.pe', '4543-5435-4354534543', '454-354-354562352343-25', 'ELMER GUSTAVO NEIRA CRUZ', '0', '0.00', '0.00', '15-01-2023 11.47.58 AM 13167380127840.png', '1', '1', '2023-01-15 16:47:58', '2023-01-15 16:47:58', NULL, NULL, 1, NULL),
(38, 4, 6, 3, 'SULMIRA CORREA BERMEO', 'DNI', '03200791', '2005-01-06', 18, '921-487-276', 'CPM. NUEVO BAMBAMARCA', 'eduardo@gmail.com', '21-432-532432', '4342343243', 'SULMIRA CORREA BERMEO', '0', '2500.00', '83.33', '', '1', '1', '2023-01-15 19:32:12', '2023-01-15 19:32:12', NULL, NULL, 1, NULL);

--
-- Disparadores `persona`
--
DELIMITER $$
CREATE TRIGGER `persona_BEFORE_UPDATE` BEFORE UPDATE ON `persona` FOR EACH ROW BEGIN
SET new.updated_at = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` int(11) NOT NULL,
  `idcategoria_producto` int(11) NOT NULL,
  `idunidad_medida` int(11) NOT NULL,
  `nombre` varchar(250) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `marca` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `contenido_neto` decimal(11,2) DEFAULT NULL,
  `precio_unitario` decimal(11,2) DEFAULT 0.00,
  `precio_compra_actual` decimal(11,2) DEFAULT NULL,
  `stock` decimal(11,2) DEFAULT 0.00,
  `descripcion` text COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `imagen` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `estado_delete` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `idcategoria_producto`, `idunidad_medida`, `nombre`, `marca`, `contenido_neto`, `precio_unitario`, `precio_compra_actual`, `stock`, `descripcion`, `imagen`, `estado`, `estado_delete`, `created_at`, `updated_at`, `user_trash`, `user_delete`, `user_created`, `user_updated`) VALUES
(1, 5, 1, 'Amistar 50 WGaaaaa', '', '1.00', '48.00', '13.00', '28.00', '222reedcf', '28-12-2022 03.51.19 PM 7167226068023.webp', '1', '1', '2022-10-07 07:05:50', '2023-01-15 23:10:25', NULL, NULL, 1, 1),
(2, 1, 1, 'Elosan 720 SCv', '', '1.00', '64.00', '27.00', '28.00', 'Botella Blancov', '20-12-2022 11.53.37 AM 16167155521724.jpg', '1', '1', '2022-10-07 07:12:23', '2023-01-13 16:45:41', NULL, NULL, 1, 1),
(3, 4, 2, 'producto 3', '333', '1.00', '0.00', '0.00', '0.00', '', '', '0', '1', '2022-10-07 07:13:24', '2023-01-11 22:08:10', 1, NULL, 1, NULL),
(4, 1, 1, 'producto 4', 'marca 2', '12.00', '0.00', '0.00', '0.00', 'descrpcion', '', '1', '0', '2022-10-07 07:17:46', '2023-01-11 22:08:10', NULL, 1, 1, NULL),
(5, 7, 3, 'Top-sul SC', 'WQE', '3.00', '53.00', '18.00', '44.00', '', '20-12-2022 11.55.46 AM 16167155534721.png', '1', '1', '2022-12-16 17:15:52', '2023-01-13 15:35:56', NULL, NULL, 1, 1),
(6, 5, 3, 'Benomil 50W', 'EWRWE', '3.00', '84.00', '25.00', '28.00', 'REWRWE', '19-12-2022 04.52.44 PM 7167148676431.png', '1', '1', '2022-12-16 17:16:09', '2023-01-13 16:07:10', NULL, NULL, 1, 1),
(7, 5, 2, 'Bezil 50WP', 'BEZ', '3.00', '73.00', '34.00', '25.00', 'FSDFSD', '19-12-2022 04.53.37 PM 17167148681727.jpg', '1', '1', '2022-12-16 17:16:27', '2023-01-13 16:07:10', NULL, NULL, 1, 1),
(8, 3, 3, 'Bavistin 500 SC', 'DSFS', '1.00', '94.00', '16.00', '27.00', 'DSFSD', '19-12-2022 04.51.51 PM 7167148671232.jpeg', '1', '1', '2022-12-16 17:16:56', '2023-01-13 16:07:10', NULL, NULL, 1, 1),
(9, 7, 1, 'Derosal 500 SC', 'DFSD', '3.00', '85.00', '23.00', '28.00', 'FSAFAS', '19-12-2022 05.27.37 PM 19167148885841.jpg', '1', '1', '2022-12-16 17:17:21', '2023-01-13 15:35:56', NULL, NULL, 1, 1),
(10, 5, 3, 'Equation PRO', 'EREW', '3.00', '74.00', '56.00', '28.00', '', '20-12-2022 11.54.01 AM 2167155524235.jpg', '1', '1', '2022-12-16 17:17:41', '2023-01-13 15:35:56', NULL, NULL, 1, 1),
(11, 6, 2, 'Curathane', 'EWRF', '2.00', '95.00', '46.00', '23.00', 'CXZCX', '19-12-2022 05.24.42 PM 13167148868222.png', '1', '1', '2022-12-16 17:18:08', '2023-01-13 16:07:10', NULL, NULL, 1, 1),
(12, 3, 2, 'Curzate M8', 'FDS', '3.00', '97.00', '75.00', '26.00', 'ASDASDASD', '11-01-2023 04.28.20 PM 6167347250138.jpg', '1', '1', '2022-12-16 17:18:41', '2023-01-13 16:07:10', NULL, NULL, 1, 1),
(13, 6, 1, 'Fitoraz WP 76', 'DSFDSF', '3.00', '64.00', '37.00', '45.00', 'CDXCC', '20-12-2022 11.55.20 AM 9167155532022.jpg', '1', '1', '2022-12-16 17:19:13', '2023-01-13 15:35:56', NULL, NULL, 1, 1),
(14, 6, 1, 'Euparen WP 50', 'FEFEWF', '4.00', '75.00', '34.00', '33.00', 'EWFEWFF', '20-12-2022 11.54.47 AM 3167155528831.webp', '1', '1', '2022-12-16 17:19:31', '2023-01-13 15:35:56', NULL, NULL, 1, 1),
(15, 5, 1, 'dfgfdg', '', '1.00', '0.00', NULL, '0.00', '555rfd', '13-01-2023 11.48.48 AM 10167362852925.png', '1', '1', '2023-01-13 16:48:48', '2023-01-13 16:48:48', NULL, NULL, 1, NULL),
(16, 5, 1, 'Bio Organic 5kg', '', '5.00', '0.00', NULL, '0.00', 'Abono orgánico enriquecido con algas marinas y fertilizantes de gran acogida por todo tipo de plantas. Abonos Orgánicos Naturales. Sulfato de Calcio Acidificado. Nitrógeno Total. Algas Marinas. Elementos menores.\r\n\r\nEste abono puede ser usado en cualquier etapa de desarrollo aportando siempre lo necesario para el correcto crecimiento.\r\n\r\nEn la preparación y/o en la reincorporación de tierra del terreno: Aplicar 2Kg de producto x 10Kg de tierra preparada. Para Mantenimiento: usar de 1 a 2 Kg x 20m2 al voleo.', '15-01-2023 06.19.38 PM 5167382477932.jfif', '1', '1', '2023-01-15 23:15:23', '2023-01-15 23:19:38', NULL, NULL, 1, 1),
(17, 6, 3, 'ABAMEX 1.8%', '', '1.00', '0.00', NULL, '0.00', 'ABAMEX, es un insecticida acaricida biológico de acción translaminar, para el control de todo tipo de ácaros e insectos minadores en los diferentes cultivos. ABAMEX, es de amplio espectro que inactiva a las especies de artrápodos (ácaros ) y otros insectos.\r\n\r\nEste producto no está disponible porque no quedan existencias.\r\n\r\nCategories: Abamectina 1.8%, Acaricida, Acaro del tostado, Acaro hialino, Acaros, Agroquímicos, Alcachofa, Erinosis de la vid, Holantao, Ingredientes activos, Limón, Mandarina, Mosca Minadora, Palta, Papa, Pimiento, Vid Código SKU: No aplica', '15-01-2023 06.26.50 PM 12167382521134.jpg', '1', '1', '2023-01-15 23:26:50', '2023-01-15 23:26:50', NULL, NULL, 1, NULL);

--
-- Disparadores `producto`
--
DELIMITER $$
CREATE TRIGGER `producto_BEFORE_UPDATE` BEFORE UPDATE ON `producto` FOR EACH ROW BEGIN
SET new.updated_at = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_persona`
--

CREATE TABLE `tipo_persona` (
  `idtipo_persona` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `estado_delete` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
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
(2, 'PRODUCTOR', 'Clientes que nos venden cafe', '1', '1', '2022-09-29 20:47:35', '2022-10-11 11:54:13', NULL, NULL, NULL, 1),
(3, 'PROVEEDOR', 'Proveedore que nos venden abonos y hervicida', '1', '1', '2022-09-29 20:47:35', '2022-10-07 16:23:26', NULL, NULL, NULL, 1),
(4, 'TRABAJADOR', 'Clientes que nos venden cafee', '1', '1', '2022-10-07 04:58:29', '2022-12-30 01:19:59', NULL, NULL, 1, 1),
(5, 'jjj', 'jjhj', '1', '0', '2023-01-13 16:51:52', '2023-01-13 16:52:03', NULL, 1, 1, NULL);

--
-- Disparadores `tipo_persona`
--
DELIMITER $$
CREATE TRIGGER `tipo_persona_BEFORE_UPDATE` BEFORE UPDATE ON `tipo_persona` FOR EACH ROW BEGIN
SET new.updated_at = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_medida`
--

CREATE TABLE `unidad_medida` (
  `idunidad_medida` int(11) NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `abreviatura` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `estado_delete` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `unidad_medida`
--

INSERT INTO `unidad_medida` (`idunidad_medida`, `nombre`, `abreviatura`, `descripcion`, `estado`, `estado_delete`, `created_at`, `updated_at`, `user_trash`, `user_delete`, `user_created`, `user_updated`) VALUES
(1, 'Kilogramo', 'KG', 'Unidad de medida de peso', '1', '1', '2022-10-07 06:57:40', '2023-01-12 22:09:30', 1, NULL, 1, NULL),
(2, 'Cajas', 'Cajas', 'Unidad de medida de unidad', '1', '1', '2022-10-07 06:58:11', '2023-01-13 16:51:29', NULL, 1, 1, 1),
(3, 'Litro', 'L\n', 'Unidad de medida de liquido', '1', '1', '2022-10-10 14:31:43', '2023-01-12 22:10:34', NULL, NULL, 1, NULL),
(4, 'gg', 'ggg', 'gg', '1', '0', '2023-01-13 16:51:39', '2023-01-13 16:51:43', NULL, 1, 1, NULL);

--
-- Disparadores `unidad_medida`
--
DELIMITER $$
CREATE TRIGGER `unidad_medida_BEFORE_UPDATE` BEFORE UPDATE ON `unidad_medida` FOR EACH ROW BEGIN
SET new.updated_at = CURRENT_TIMESTAMP;
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
  `login` varchar(20) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `password` varchar(65) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `last_sesion` timestamp NULL DEFAULT NULL,
  `estado` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `estado_delete` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
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
(1, 3, 'admin', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', '2023-01-16 15:24:41', '1', '1', '2022-09-20 17:43:52', '2023-01-16 15:24:41', 1, NULL, NULL, 1),
(2, 4, 'requejo', 'e17518987d968675a705da37b34550f68ff63892061521515e5c40a68219f509', '2023-01-02 23:34:39', '1', '1', '2022-09-28 18:10:30', '2023-01-15 22:52:52', NULL, 1, 1, 4),
(3, 5, 'chaparro', 'f68a30400fb5be69676c562bf69f6cabcd04a0275e6be4332bfe074b136150bb', '2023-01-15 22:18:18', '1', '1', '2022-09-28 18:10:44', '2023-01-15 22:52:42', NULL, 1, 1, 4),
(4, 6, 'liss', '48a22f634ac821029a784724d9873fa0eab33f516959ac131b23e8c759b93e75', '2023-01-15 22:52:05', '1', '1', '2022-09-28 19:36:47', '2023-01-15 22:52:21', NULL, 1, 1, 4),
(5, 7, 'david', '07d046d5fac12b3f82daf5035b9aae86db5adc8275ebfbf05ec83005a4a8ba3e', '2023-01-15 22:53:44', '1', '1', '2022-09-28 19:38:19', '2023-01-15 22:53:44', 1, NULL, 1, 4),
(6, 12, 'papel', 'abd0f5b700fc5b56d8fd69397ba45b336d24e1ef0ac8db8ac5db9a68247311e1', '2023-01-02 23:34:39', '1', '1', '2023-01-03 15:27:43', '2023-01-15 22:53:25', NULL, NULL, 1, 4),
(7, 9, 'rivera', '8ba35ebe3d5c74320285c75c019a06197837d4b53ea93a3f6834d725be957117', NULL, '1', '1', '2023-01-03 17:20:27', '2023-01-15 22:52:31', NULL, NULL, 1, 4),
(13, 25, 'alexito', 'd53a29a873d0bf93345b9bc21160a09c97031395476aa0f67251e6d0772bfcf7', NULL, '1', '1', '2023-01-13 16:38:45', '2023-01-15 22:53:03', NULL, NULL, 1, 4);

--
-- Disparadores `usuario`
--
DELIMITER $$
CREATE TRIGGER `usuario_BEFORE_UPDATE` BEFORE UPDATE ON `usuario` FOR EACH ROW BEGIN
SET new.updated_at = CURRENT_TIMESTAMP;
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
  `estado` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `estado_delete` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
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
(1, 1, 1, '1', '1', '2023-01-02 02:25:26', '2023-01-02 02:25:26', NULL, NULL, 1, NULL),
(2, 1, 2, '1', '1', '2023-01-02 02:25:26', '2023-01-02 02:25:26', NULL, NULL, 1, NULL),
(3, 1, 3, '1', '1', '2023-01-02 02:25:26', '2023-01-02 02:25:26', NULL, NULL, 1, NULL),
(4, 1, 4, '1', '1', '2023-01-02 02:25:26', '2023-01-02 02:25:26', NULL, NULL, 1, NULL),
(5, 1, 5, '1', '1', '2023-01-02 02:25:26', '2023-01-02 02:25:26', NULL, NULL, 1, NULL),
(6, 1, 6, '1', '1', '2023-01-02 02:25:26', '2023-01-02 02:25:26', NULL, NULL, 1, NULL),
(7, 1, 7, '1', '1', '2023-01-02 02:25:26', '2023-01-02 02:25:26', NULL, NULL, 1, NULL),
(8, 1, 8, '1', '1', '2023-01-02 02:25:26', '2023-01-02 02:25:26', NULL, NULL, 1, NULL),
(9, 1, 9, '1', '1', '2023-01-02 02:25:26', '2023-01-02 02:25:26', NULL, NULL, 1, NULL),
(147, 4, 2, '1', '1', '2023-01-15 22:52:21', '2023-01-15 22:52:21', NULL, NULL, 4, NULL),
(148, 4, 3, '1', '1', '2023-01-15 22:52:21', '2023-01-15 22:52:21', NULL, NULL, 4, NULL),
(149, 4, 5, '1', '1', '2023-01-15 22:52:22', '2023-01-15 22:52:22', NULL, NULL, 4, NULL),
(150, 4, 9, '1', '1', '2023-01-15 22:52:22', '2023-01-15 22:52:22', NULL, NULL, 4, NULL),
(151, 7, 5, '1', '1', '2023-01-15 22:52:31', '2023-01-15 22:52:31', NULL, NULL, 4, NULL),
(152, 7, 9, '1', '1', '2023-01-15 22:52:31', '2023-01-15 22:52:31', NULL, NULL, 4, NULL),
(153, 3, 9, '1', '1', '2023-01-15 22:52:42', '2023-01-15 22:52:42', NULL, NULL, 4, NULL),
(154, 2, 1, '1', '1', '2023-01-15 22:52:52', '2023-01-15 22:52:52', NULL, NULL, 4, NULL),
(155, 2, 2, '1', '1', '2023-01-15 22:52:52', '2023-01-15 22:52:52', NULL, NULL, 4, NULL),
(156, 2, 3, '1', '1', '2023-01-15 22:52:52', '2023-01-15 22:52:52', NULL, NULL, 4, NULL),
(157, 2, 4, '1', '1', '2023-01-15 22:52:52', '2023-01-15 22:52:52', NULL, NULL, 4, NULL),
(158, 2, 5, '1', '1', '2023-01-15 22:52:52', '2023-01-15 22:52:52', NULL, NULL, 4, NULL),
(159, 2, 6, '1', '1', '2023-01-15 22:52:52', '2023-01-15 22:52:52', NULL, NULL, 4, NULL),
(160, 2, 7, '1', '1', '2023-01-15 22:52:52', '2023-01-15 22:52:52', NULL, NULL, 4, NULL),
(161, 2, 8, '1', '1', '2023-01-15 22:52:52', '2023-01-15 22:52:52', NULL, NULL, 4, NULL),
(162, 2, 9, '1', '1', '2023-01-15 22:52:52', '2023-01-15 22:52:52', NULL, NULL, 4, NULL),
(163, 13, 1, '1', '1', '2023-01-15 22:53:03', '2023-01-15 22:53:03', NULL, NULL, 4, NULL),
(164, 13, 2, '1', '1', '2023-01-15 22:53:03', '2023-01-15 22:53:03', NULL, NULL, 4, NULL),
(165, 13, 3, '1', '1', '2023-01-15 22:53:03', '2023-01-15 22:53:03', NULL, NULL, 4, NULL),
(166, 13, 4, '1', '1', '2023-01-15 22:53:03', '2023-01-15 22:53:03', NULL, NULL, 4, NULL),
(167, 13, 5, '1', '1', '2023-01-15 22:53:03', '2023-01-15 22:53:03', NULL, NULL, 4, NULL),
(168, 13, 6, '1', '1', '2023-01-15 22:53:03', '2023-01-15 22:53:03', NULL, NULL, 4, NULL),
(169, 13, 7, '1', '1', '2023-01-15 22:53:03', '2023-01-15 22:53:03', NULL, NULL, 4, NULL),
(170, 13, 8, '1', '1', '2023-01-15 22:53:03', '2023-01-15 22:53:03', NULL, NULL, 4, NULL),
(171, 13, 9, '1', '1', '2023-01-15 22:53:03', '2023-01-15 22:53:03', NULL, NULL, 4, NULL),
(181, 6, 1, '1', '1', '2023-01-15 22:53:26', '2023-01-15 22:53:26', NULL, NULL, 4, NULL),
(182, 6, 2, '1', '1', '2023-01-15 22:53:26', '2023-01-15 22:53:26', NULL, NULL, 4, NULL),
(183, 6, 3, '1', '1', '2023-01-15 22:53:26', '2023-01-15 22:53:26', NULL, NULL, 4, NULL),
(184, 6, 4, '1', '1', '2023-01-15 22:53:26', '2023-01-15 22:53:26', NULL, NULL, 4, NULL),
(185, 6, 5, '1', '1', '2023-01-15 22:53:26', '2023-01-15 22:53:26', NULL, NULL, 4, NULL),
(186, 6, 6, '1', '1', '2023-01-15 22:53:26', '2023-01-15 22:53:26', NULL, NULL, 4, NULL),
(187, 6, 7, '1', '1', '2023-01-15 22:53:26', '2023-01-15 22:53:26', NULL, NULL, 4, NULL),
(188, 6, 8, '1', '1', '2023-01-15 22:53:26', '2023-01-15 22:53:26', NULL, NULL, 4, NULL),
(189, 6, 9, '1', '1', '2023-01-15 22:53:26', '2023-01-15 22:53:26', NULL, NULL, 4, NULL),
(190, 5, 9, '1', '1', '2023-01-15 22:53:35', '2023-01-15 22:53:35', NULL, NULL, 4, NULL);

--
-- Disparadores `usuario_permiso`
--
DELIMITER $$
CREATE TRIGGER `usuario_permiso_BEFORE_UPDATE` BEFORE UPDATE ON `usuario_permiso` FOR EACH ROW BEGIN
SET new.updated_at = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_grano`
--

CREATE TABLE `venta_grano` (
  `idventa_grano` int(11) NOT NULL,
  `idpersona` int(11) NOT NULL,
  `estado` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `estado_delete` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Disparadores `venta_grano`
--
DELIMITER $$
CREATE TRIGGER `venta_grano_BEFORE_UPDATE` BEFORE UPDATE ON `venta_grano` FOR EACH ROW BEGIN
SET new.updated_at = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_producto`
--

CREATE TABLE `venta_producto` (
  `idventa_producto` int(11) NOT NULL,
  `idpersona` int(11) NOT NULL,
  `fecha_venta` date DEFAULT NULL,
  `establecimiento` varchar(200) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tipo_comprobante` varchar(60) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `serie_comprobante` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `val_igv` decimal(11,2) DEFAULT NULL COMMENT '0.18',
  `subtotal` decimal(11,2) DEFAULT NULL,
  `igv` decimal(11,2) DEFAULT NULL COMMENT 'subtotal * val_igv = igv',
  `total` decimal(11,2) DEFAULT NULL COMMENT 'subtotal + igv = total',
  `tipo_gravada` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `metodo_pago` varchar(45) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `fecha_proximo_pago` date DEFAULT NULL,
  `comprobante` varchar(100) COLLATE utf8mb4_spanish_ci DEFAULT NULL COMMENT '.png, .doc, .pdf, etc...',
  `estado` char(10) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `estado_delete` char(1) COLLATE utf8mb4_spanish_ci DEFAULT '1',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user_trash` int(11) DEFAULT NULL,
  `user_delete` int(11) DEFAULT NULL,
  `user_created` int(11) DEFAULT NULL,
  `user_updated` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `venta_producto`
--

INSERT INTO `venta_producto` (`idventa_producto`, `idpersona`, `fecha_venta`, `establecimiento`, `tipo_comprobante`, `serie_comprobante`, `val_igv`, `subtotal`, `igv`, `total`, `tipo_gravada`, `descripcion`, `metodo_pago`, `fecha_proximo_pago`, `comprobante`, `estado`, `estado_delete`, `created_at`, `updated_at`, `user_trash`, `user_delete`, `user_created`, `user_updated`) VALUES
(6, 23, '2023-01-09', NULL, 'Boleta', 'B-000001', '0.00', '4924.00', '0.00', '4924.00', 'NO GRAVADA', '', 'CONTADO', '2023-01-12', NULL, '1', '1', '2023-01-13 01:32:34', '2023-01-13 01:32:34', NULL, NULL, 1, NULL),
(7, 23, '2023-01-09', NULL, 'Boleta', 'B-000002', '0.00', '479.00', '0.00', '479.00', 'NO GRAVADA', '', 'CONTADO', '2023-01-13', NULL, '1', '1', '2023-01-13 15:33:44', '2023-01-13 15:33:44', NULL, NULL, 1, NULL),
(8, 23, '2023-01-09', NULL, 'Boleta', 'B-000003', '0.00', '1688.00', '0.00', '1688.00', 'NO GRAVADA', '', 'CONTADO', '2023-01-13', NULL, '1', '1', '2023-01-13 16:07:10', '2023-01-13 16:07:10', NULL, NULL, 1, NULL);

--
-- Disparadores `venta_producto`
--
DELIMITER $$
CREATE TRIGGER `venta_producto_BEFORE_UPDATE` BEFORE UPDATE ON `venta_producto` FOR EACH ROW BEGIN
SET new.updated_at = CURRENT_TIMESTAMP;
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
  ADD PRIMARY KEY (`idbitacora_bd`);

--
-- Indices de la tabla `cargo_trabajador`
--
ALTER TABLE `cargo_trabajador`
  ADD PRIMARY KEY (`idcargo_trabajador`);

--
-- Indices de la tabla `categoria_producto`
--
ALTER TABLE `categoria_producto`
  ADD PRIMARY KEY (`idcategoria_producto`);

--
-- Indices de la tabla `compra_grano`
--
ALTER TABLE `compra_grano`
  ADD PRIMARY KEY (`idcompra_grano`),
  ADD KEY `fk_compra_grano_persona1_idx` (`idpersona`);

--
-- Indices de la tabla `compra_producto`
--
ALTER TABLE `compra_producto`
  ADD PRIMARY KEY (`idcompra_producto`),
  ADD KEY `fk_compra_producto_persona1_idx` (`idpersona`);

--
-- Indices de la tabla `detalle_compra_grano`
--
ALTER TABLE `detalle_compra_grano`
  ADD PRIMARY KEY (`iddetalle_compra_grano`),
  ADD KEY `fk_detalle_compra_grano_compra_grano1_idx` (`idcompra_grano`);

--
-- Indices de la tabla `detalle_compra_producto`
--
ALTER TABLE `detalle_compra_producto`
  ADD PRIMARY KEY (`iddetalle_compra_producto`),
  ADD KEY `fk_detalle_compra_producto_compra_producto1_idx` (`idcompra_producto`),
  ADD KEY `fk_detalle_compra_producto_producto1_idx` (`idproducto`);

--
-- Indices de la tabla `detalle_venta_grano`
--
ALTER TABLE `detalle_venta_grano`
  ADD PRIMARY KEY (`iddetalle_venta_grano`),
  ADD KEY `fk_detalle_venta_grano_venta_grano1_idx` (`idventa_grano`);

--
-- Indices de la tabla `detalle_venta_producto`
--
ALTER TABLE `detalle_venta_producto`
  ADD PRIMARY KEY (`iddetalle_venta_producto`),
  ADD KEY `fk_detalle_venta_producto_venta_producto1_idx` (`idventa_producto`),
  ADD KEY `fk_detalle_venta_producto_producto1_idx` (`idproducto`);

--
-- Indices de la tabla `mes_pago_trabajador`
--
ALTER TABLE `mes_pago_trabajador`
  ADD PRIMARY KEY (`idmes_pago_trabajador`),
  ADD KEY `fk_mes_pago_trabajador_persona1_idx` (`idpersona`);

--
-- Indices de la tabla `otro_ingreso`
--
ALTER TABLE `otro_ingreso`
  ADD PRIMARY KEY (`idotro_ingreso`),
  ADD KEY `fk_otro_ingreso_persona1_idx` (`idpersona`);

--
-- Indices de la tabla `pago_compra_grano`
--
ALTER TABLE `pago_compra_grano`
  ADD PRIMARY KEY (`idpago_compra_grano`),
  ADD KEY `fk_pago_compra_grano_compra_grano1_idx` (`idcompra_grano`);

--
-- Indices de la tabla `pago_compra_producto`
--
ALTER TABLE `pago_compra_producto`
  ADD PRIMARY KEY (`idpago_compra_producto`),
  ADD KEY `fk_pago_compra_producto_compra_producto1_idx` (`idcompra_producto`);

--
-- Indices de la tabla `pago_trabajador`
--
ALTER TABLE `pago_trabajador`
  ADD PRIMARY KEY (`idpago_trabajador`),
  ADD KEY `fk_pago_trabajador_mes_pago_trabajador1_idx` (`idmes_pago_trabajador`);

--
-- Indices de la tabla `pago_venta_producto`
--
ALTER TABLE `pago_venta_producto`
  ADD PRIMARY KEY (`idpago_venta_producto`),
  ADD KEY `fk_pago_venta_producto_venta_producto1_idx` (`idventa_producto`);

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
  ADD KEY `fk_persona_bancos1_idx` (`idbancos`),
  ADD KEY `fk_persona_tipo_persona1_idx` (`idtipo_persona`),
  ADD KEY `fk_persona_cargo_trabajador1_idx` (`idcargo_trabajador`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `fk_producto_categoria_producto1_idx` (`idcategoria_producto`),
  ADD KEY `fk_producto_unidad_medida1_idx` (`idunidad_medida`);

--
-- Indices de la tabla `tipo_persona`
--
ALTER TABLE `tipo_persona`
  ADD PRIMARY KEY (`idtipo_persona`);

--
-- Indices de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  ADD PRIMARY KEY (`idunidad_medida`);

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
  ADD KEY `fk_usuario_permiso_usuario_idx` (`idusuario`),
  ADD KEY `fk_usuario_permiso_permiso1_idx` (`idpermiso`);

--
-- Indices de la tabla `venta_grano`
--
ALTER TABLE `venta_grano`
  ADD PRIMARY KEY (`idventa_grano`),
  ADD KEY `fk_venta_grano_persona1_idx` (`idpersona`);

--
-- Indices de la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  ADD PRIMARY KEY (`idventa_producto`),
  ADD KEY `fk_venta_producto_persona1_idx` (`idpersona`);

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
  MODIFY `idbancos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `bitacora_bd`
--
ALTER TABLE `bitacora_bd`
  MODIFY `idbitacora_bd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1422;

--
-- AUTO_INCREMENT de la tabla `cargo_trabajador`
--
ALTER TABLE `cargo_trabajador`
  MODIFY `idcargo_trabajador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `categoria_producto`
--
ALTER TABLE `categoria_producto`
  MODIFY `idcategoria_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `compra_grano`
--
ALTER TABLE `compra_grano`
  MODIFY `idcompra_grano` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `compra_producto`
--
ALTER TABLE `compra_producto`
  MODIFY `idcompra_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `detalle_compra_grano`
--
ALTER TABLE `detalle_compra_grano`
  MODIFY `iddetalle_compra_grano` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT de la tabla `detalle_compra_producto`
--
ALTER TABLE `detalle_compra_producto`
  MODIFY `iddetalle_compra_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `detalle_venta_grano`
--
ALTER TABLE `detalle_venta_grano`
  MODIFY `iddetalle_venta_grano` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_venta_producto`
--
ALTER TABLE `detalle_venta_producto`
  MODIFY `iddetalle_venta_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `mes_pago_trabajador`
--
ALTER TABLE `mes_pago_trabajador`
  MODIFY `idmes_pago_trabajador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `otro_ingreso`
--
ALTER TABLE `otro_ingreso`
  MODIFY `idotro_ingreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `pago_compra_grano`
--
ALTER TABLE `pago_compra_grano`
  MODIFY `idpago_compra_grano` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `pago_compra_producto`
--
ALTER TABLE `pago_compra_producto`
  MODIFY `idpago_compra_producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pago_trabajador`
--
ALTER TABLE `pago_trabajador`
  MODIFY `idpago_trabajador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pago_venta_producto`
--
ALTER TABLE `pago_venta_producto`
  MODIFY `idpago_venta_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `permiso`
--
ALTER TABLE `permiso`
  MODIFY `idpermiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idpersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `tipo_persona`
--
ALTER TABLE `tipo_persona`
  MODIFY `idtipo_persona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `unidad_medida`
--
ALTER TABLE `unidad_medida`
  MODIFY `idunidad_medida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `usuario_permiso`
--
ALTER TABLE `usuario_permiso`
  MODIFY `idusuario_permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT de la tabla `venta_grano`
--
ALTER TABLE `venta_grano`
  MODIFY `idventa_grano` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `venta_producto`
--
ALTER TABLE `venta_producto`
  MODIFY `idventa_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `compra_grano`
--
ALTER TABLE `compra_grano`
  ADD CONSTRAINT `fk_compra_grano_persona1` FOREIGN KEY (`idpersona`) REFERENCES `persona` (`idpersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `compra_producto`
--
ALTER TABLE `compra_producto`
  ADD CONSTRAINT `fk_compra_producto_persona1` FOREIGN KEY (`idpersona`) REFERENCES `persona` (`idpersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_compra_grano`
--
ALTER TABLE `detalle_compra_grano`
  ADD CONSTRAINT `fk_detalle_compra_grano_compra_grano1` FOREIGN KEY (`idcompra_grano`) REFERENCES `compra_grano` (`idcompra_grano`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_compra_producto`
--
ALTER TABLE `detalle_compra_producto`
  ADD CONSTRAINT `fk_detalle_compra_producto_compra_producto1` FOREIGN KEY (`idcompra_producto`) REFERENCES `compra_producto` (`idcompra_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_compra_producto_producto1` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_venta_grano`
--
ALTER TABLE `detalle_venta_grano`
  ADD CONSTRAINT `fk_detalle_venta_grano_venta_grano1` FOREIGN KEY (`idventa_grano`) REFERENCES `venta_grano` (`idventa_grano`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `detalle_venta_producto`
--
ALTER TABLE `detalle_venta_producto`
  ADD CONSTRAINT `fk_detalle_venta_producto_producto1` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`idproducto`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_detalle_venta_producto_venta_producto1` FOREIGN KEY (`idventa_producto`) REFERENCES `venta_producto` (`idventa_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mes_pago_trabajador`
--
ALTER TABLE `mes_pago_trabajador`
  ADD CONSTRAINT `fk_mes_pago_trabajador_persona1` FOREIGN KEY (`idpersona`) REFERENCES `persona` (`idpersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `otro_ingreso`
--
ALTER TABLE `otro_ingreso`
  ADD CONSTRAINT `fk_otro_ingreso_persona1` FOREIGN KEY (`idpersona`) REFERENCES `persona` (`idpersona`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pago_compra_grano`
--
ALTER TABLE `pago_compra_grano`
  ADD CONSTRAINT `fk_pago_compra_grano_compra_grano1` FOREIGN KEY (`idcompra_grano`) REFERENCES `compra_grano` (`idcompra_grano`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pago_compra_producto`
--
ALTER TABLE `pago_compra_producto`
  ADD CONSTRAINT `fk_pago_compra_producto_compra_producto1` FOREIGN KEY (`idcompra_producto`) REFERENCES `compra_producto` (`idcompra_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pago_venta_producto`
--
ALTER TABLE `pago_venta_producto`
  ADD CONSTRAINT `fk_pago_venta_producto_venta_producto1` FOREIGN KEY (`idventa_producto`) REFERENCES `venta_producto` (`idventa_producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
