-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-12-2020 a las 22:24:28
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `_store_`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `Id_admin` int(11) NOT NULL,
  `rol` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`Id_admin`, `rol`) VALUES
(3, 'ventas'),
(25, 'ventas'),
(30, 'ventas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_mensaje`
--

CREATE TABLE `chat_mensaje` (
  `Id_chat_msj` int(11) NOT NULL,
  `Id_usuario` int(11) NOT NULL,
  `chat_msj` text DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `chat_mensaje`
--

INSERT INTO `chat_mensaje` (`Id_chat_msj`, `Id_usuario`, `chat_msj`, `fecha`, `status`) VALUES
(19, 1, 'qwdf', '2020-12-19 04:41:52', 0),
(21, 1, 'qwdf', '2020-12-19 04:48:20', 1),
(22, 1, 'holaa', '2020-12-19 04:49:46', 0),
(23, 1, 'dq', '2020-12-19 04:51:31', 1),
(24, 1, 'soy el admin', '2020-12-19 04:55:57', 1),
(25, 1, 'Hola bb', '2020-12-19 07:02:28', 1),
(26, 16, 'qiubo', '2020-12-19 07:10:32', 0),
(27, 21, 'Hola necesito ayuda!!!!!!!!!!!', '2020-12-19 10:31:14', 0),
(28, 21, 'Buenos días, dígame su duda', '2020-12-19 10:35:48', 1),
(29, 1, 'holaaaa', '2020-12-19 14:13:50', 0),
(30, 1, 'holaaaaaasssd', '2020-12-19 14:15:06', 1),
(31, 21, 'Hoaaaaaa', '2020-12-19 14:15:22', 1),
(32, 1, 'quibo', '2020-12-19 14:17:28', 1),
(33, 1, 'hppspspsp', '2020-12-19 14:17:38', 0),
(34, 1, 'Buenos días, dígame su duda', '2020-12-19 14:17:49', 1),
(35, 1, 'tengo una dudaaa', '2020-12-19 14:18:06', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `Id_cliente` int(11) NOT NULL,
  `gustos` varchar(255) DEFAULT NULL,
  `genero` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`Id_cliente`, `gustos`, `genero`) VALUES
(1, 'playera', 'hombre'),
(16, 'playera', 'hombre'),
(20, 'playera', 'hombre'),
(21, 'playera', 'hombre'),
(22, '', 'hombre'),
(23, '', 'hombre'),
(24, 'playera', 'hombre'),
(26, 'playera', 'hombre'),
(31, 'playera', 'hombre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `Id_cliente` int(11) NOT NULL,
  `Id_producto` int(11) NOT NULL,
  `comentario` text DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`Id_cliente`, `Id_producto`, `comentario`, `fecha`) VALUES
(21, 110, 'Esta muy bonito', '2020-12-19 10:27:43'),
(1, 114, 'amaury romo estuvo aqui', '2020-12-19 14:13:04'),
(1, 114, 'dsdsdsdsdsdsds', '2020-12-19 14:13:20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra`
--

CREATE TABLE `compra` (
  `Id_compra` int(11) NOT NULL,
  `Id_cliente` int(11) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `fecha_compra` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compra`
--

INSERT INTO `compra` (`Id_compra`, `Id_cliente`, `total`, `fecha_compra`) VALUES
(3, 1, '598.00', '2020-12-18 17:56:22'),
(4, 1, '1098.00', '2020-12-18 18:07:49'),
(5, 1, '1098.00', '2020-12-18 18:28:08'),
(6, 1, '1098.00', '2020-12-18 18:29:19'),
(7, 1, '598.00', '2020-12-18 18:32:53'),
(8, 1, '598.00', '2020-12-18 18:44:12'),
(9, 1, '598.00', '2020-12-18 19:16:13'),
(10, 1, '598.00', '2020-12-18 19:17:59'),
(11, 1, '1098.00', '2020-12-18 20:02:06'),
(12, 1, '1098.00', '2020-12-18 20:04:09'),
(13, 1, '1598.00', '2020-12-18 20:07:29'),
(14, 1, '1196.00', '2020-12-18 20:11:10'),
(15, 1, '1794.00', '2020-12-18 20:12:33'),
(16, 1, '1598.00', '2020-12-18 20:17:53'),
(17, 1, '1598.00', '2020-12-18 20:22:55'),
(18, 1, '1196.00', '2020-12-18 20:26:23'),
(19, 21, '8037.00', '2020-12-19 10:28:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `Id_compra` int(11) NOT NULL,
  `Id_producto` int(11) NOT NULL,
  `cantidad` decimal(10,2) NOT NULL,
  `talla` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`Id_compra`, `Id_producto`, `cantidad`, `talla`) VALUES
(3, 110, '3.00', 'XL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE `direcciones` (
  `Id_usuario` int(11) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `ciudad` varchar(255) NOT NULL,
  `colonia` varchar(255) NOT NULL,
  `cod_postal` varchar(255) NOT NULL,
  `calle` varchar(255) NOT NULL,
  `numero` varchar(255) NOT NULL,
  `num_interior` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `direcciones`
--

INSERT INTO `direcciones` (`Id_usuario`, `estado`, `ciudad`, `colonia`, `cod_postal`, `calle`, `numero`, `num_interior`) VALUES
(1, 'dsadsad', 'sdsadsa', 'dsadasd', '20420', 'dsadas', '5', 'a'),
(20, 'Aguascalientes', 'sadsad', 'cxcx', 'xcxcxc', '2036', '22', '3'),
(21, 'Aguascalientes', 'Rincón de Romos', 'escaleras', 'del rosal', '20420', '110', 'A'),
(22, 'Aguascalientes', 'Rincón de Romos', 'lala', 'hola', '20420', '32', '5'),
(23, 'Aguascalientes', 'Rincón de Romos', 'vcvc', 'cvc', '20420', '21', 'a'),
(24, 'Aguascalientes', 'sadsad', 'colo', 'cvcv', '2036', '25', '1'),
(25, 'Aguascalientes', 'Berlin', 'lala', 'sasa', '4098', '125', 's'),
(26, 'Chihuahua', 'Rincón de Romos', 'cxcxc', 'cxcxc', '20420', '125', '2'),
(27, 'Jalisco', 'dfdfdf', 'ggfgfdg', 'dsfdf', '212', '125', '15'),
(28, 'Aguascalientes', 'sadsad', 'springfield', 'siempre viva', '2036', '113', 'a'),
(29, 'Aguascalientes', 'sadsad', 'sdsd', 'sdsdsd', '2036', '105', '5'),
(30, 'Aguascalientes', 'sadsad', 'fdfdf', 'fdfdf', '2036', '152', '12'),
(31, 'Aguascalientes', 'sadsad', 'sepa', 'la', '2036', '123', '2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertas`
--

CREATE TABLE `ofertas` (
  `Id_oferta` int(11) NOT NULL,
  `Id_producto` int(11) NOT NULL,
  `porcentaje` decimal(6,2) NOT NULL,
  `fec_inicio` datetime NOT NULL,
  `fec_fin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ofertas`
--

INSERT INTO `ofertas` (`Id_oferta`, `Id_producto`, `porcentaje`, `fec_inicio`, `fec_fin`) VALUES
(2, 103, '10.00', '2020-12-19 00:00:00', '2020-12-31 00:00:00'),
(3, 118, '20.00', '2020-12-08 00:00:00', '2021-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `ID_producto` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `detalles` longtext DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `marca` varchar(255) DEFAULT NULL,
  `tipo` varchar(30) NOT NULL,
  `tallas` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `Fecha_lanzamiento` date NOT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `imgs` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ID_producto`, `nombre`, `detalles`, `precio`, `marca`, `tipo`, `tallas`, `Fecha_lanzamiento`, `categoria`, `imgs`, `status`) VALUES
(103, 'Blusa Volantesss', 'fruncido todo estampado Elegante', '598.00', 'SHEIN', 'playera', '{\"XS\":10,\"S\":10,\"M\":0,\"L\":10,\"XL\":10}', '2020-12-19', 'mujer', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/11/09/16048900530a1b8c44456c07d817aad5a8e09217d5.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(104, 'Top con ojal', 'trasero de manga farol', '764.00', 'SHEIN', 'playera', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":10}', '2020-12-19', 'Mujer', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/11/19/1605749486189a3a3487d31976f039fd8f9ce17dcc.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(105, 'Blusas Boton', 'Liso Elegante', '585.00', 'SHEIN', 'playera', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":10}', '2020-12-19', 'Mujer', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/09/01/159894791195ea2547e59f8bb296dfacf5cefc86a3.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(107, 'Pantalones deportivos', 'unicolor de cintura con cordon', '777.00', 'SHEIN', 'pantalon', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":10}', '2020-12-19', 'Mujer', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/09/21/16006705315f9cb6eefc5a9e772bc0d7e6ef0223c1.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(108, 'Pantalones con cremallera', 'cremallera trasera con cordon', '2248.00', 'SHEIN', 'pantalon', '{\"XS\":10,\"S\":0,\"M\":10,\"L\":10,\"XL\":0}', '2020-12-19', 'Mujer', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/09/15/160017535503c1c01afe4a3e418cbf8806410218dd.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(110, 'Camiseta de hombres', 'estampado de fuego', '2679.00', 'SHEIN', 'playera', '{\"XS\": 10, \"S\": 10, \"M\": 0, \"L\": 0, \"XL\": 7}', '2020-12-19', 'Hombre', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/05/14/1589453206be52f96c784942fc706faa761d263462.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(111, 'Camiseta con cuello en V', '4 piezas para hombre', '2856.00', 'SHEIN', 'playera', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":10}', '2020-12-19', 'Hombre', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/10/29/1603947629e5c0e76185c847d8ff23dad63941d7fc.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(112, 'Top de terciopelo', 'con labio rojo', '1050.00', 'SHEIN', 'playera', '{\"XS\":10,\"S\":10,\"M\":4,\"L\":5,\"XL\":5}', '2020-12-19', 'Hombre', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/11/30/1606699580628885ae7ed0c4f4bd3050212a7eb7cf.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(113, 'Joggers de cintura', 'con cordon de lado de rayas panel', '1678.00', 'SHEIN', 'pantalon', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":10}', '0000-00-00', 'Hombre', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/11/04/160448243823cda658cab77f0803b53d6ba3a29064.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(114, 'Pantalones para hombre', 'Cordon Monocolor Preppy', '168.00', 'SHEIN', 'pantalon', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":10}', '2020-12-19', 'Hombre', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/09/25/16010054329effdf996c37cf5beba86f6b5b3c432b.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(115, 'Camiseta de niñitas', 'cuello alto con estampado de conejo', '1050.00', 'SHEIN', 'playera', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":10}', '2020-12-19', 'ninos', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2019/11/26/15747581502a52c938c6887177de71329560c23fb0.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(116, 'Camiseta con estampado', 'estampado de corazon', '780.00', 'SHEIN', 'playera', '{\"XS\":10,\"S\":10,\"M\":0,\"L\":0,\"XL\":2}', '2020-12-19', 'ninos', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/11/14/1605332988b94b2c8963232259e2bb42487931386c.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(117, 'Camiseta cortada', 'cosido', '1169.00', 'SHEIN', 'playera', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":10}', '2020-12-19', 'ninos', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/05/07/1588817217cd4434f78ab787dbcf956949f5ead77d.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(118, 'Pantalones con bolsillo', 'con estampado', '2376.00', 'SHEIN', 'pantalon', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":10}', '2020-12-19', 'ninos', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/09/18/16004014655b9051d9dec5fff5d56bb919129068fe.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(119, 'Pantalones de pana', 'cintura con volante', '2800.00', 'SHEIN', 'pantalon', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":10}', '2020-12-19', 'ninos', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/08/19/1597803483df159f0306046fac417ae42deb733eda.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(120, 'Cazadora corta', 'parte delantera abierta floral', '1178.00', 'SHEIN', 'playera', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":0}', '2020-12-19', 'mujer', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/10/17/1602902426fc22759a5eb262da0f21b7e797153d6f.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(121, 'D&M chaqueta', 'PU de manga gigot', '2499.00', 'SHEIN', 'playera', '{\"XS\":0,\"S\":10,\"M\":10,\"L\":10,\"XL\":0}', '2020-12-19', 'mujer', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/10/16/1602834620b5ff8d0aef219e84ba28806e313d1add_thumbnail_600x.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(122, 'SHEIN Cazadora acolchada', 'bajo con cordón con cremallera delantera', '683.00', 'SHEIN', 'chamarra', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":10}', '2020-12-19', 'mujer', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/11/04/16044561688a3ea18f1725ed543360dd8a1699a72c_thumbnail_600x.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(123, 'Conjunto top', 'con capucha con cordón de color combinado con pantalones', '1464.00', 'SHEIN', 'sudadera', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":10}', '2020-12-19', 'mujer', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/08/06/159669939230b02f92ff779c090c18765f2e0f5101_thumbnail_600x.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(124, 'Conjunto sudadera con capucha', 'con cordón de tie dye con pantalones', '763.00', 'SHEIN', 'sudadera', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":10}', '2020-12-19', 'mujer', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/08/06/159669939230b02f92ff779c090c18765f2e0f5101_thumbnail_600x.webp\", \"I2\":\"https://img.ltwebstatic.com/images3_pi/2020/08/06/159669939230b02f92ff779c090c18765f2e0f5101_thumbnail_600x.webp\",\"I3\":\"https://img.ltwebstatic.com/images3_pi/2020/08/06/159669939230b02f92ff779c090c18765f2e0f5101_thumbnail_600x.webp\"}', 1),
(125, 'Chaquetas', 'Doble botonadura Liso Casual', '2543.00', 'SHEIN', 'abrigo', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":10}', '2020-12-19', 'mujer', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/11/09/1604900778f5de9ca668e857d6e7220de17a3f8208_thumbnail_600x.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(126, 'Abrigo de cuello', 'chal con bolsillo', '522.00', 'SHEIN', 'abrigo', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":10}', '2020-12-19', 'mujer', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/09/09/1599615283e8dff46ce473bb654b162c6e3fcbc83c_thumbnail_600x.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(127, 'Chaqueta con bolsillo', 'con parche', '1624.00', 'SHEIN', 'chamarra', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":10}', '2020-12-19', 'hombre', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/09/23/1600857206dc5e9eb2c8f25c5a6df4fbbfe02a1a2a_thumbnail_600x.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(128, 'Chaqueta de bombardero', 'ribete de rayas', '629.00', 'SHEIN', 'chamarra', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":10}', '2020-12-19', 'hombre', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/11/26/1606388583659392961438fc16a9526e90889a2023_thumbnail_600x.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(129, 'Sudadera con parche', 'color combinado', '2382.00', 'SHEIN', 'sudadera', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":10}', '2020-12-19', 'hombre', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/10/10/16023073497bfbc2572fd810f46087ad50814f7f3f_thumbnail_600x.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(130, 'Sudadera de cuello', 'redondo con estampado de navidad', '340.00', 'SHEIN', 'sudadera', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":10}', '2020-12-19', 'hombre', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/09/11/15997936127550407aee1173673fde87d2c27cbb3d_thumbnail_600x.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(131, 'Capucha con cordón', 'color combinado con slogan', '1447.00', 'SHEIN', 'sudadera', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":10}', '2020-12-19', 'hombre', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/09/14/1600078545d537d2c5627b42af7c0f00cb78e41a9a_thumbnail_600x.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(132, 'Capucha con cordón', 'dos colores con estampado de letra china', '504.00', 'SHEIN', 'sudadera', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":10}', '2020-12-19', 'hombre', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/11/21/16059243333bafb72118cf9411a63e98a49910c1a8_thumbnail_600x.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(133, 'Capucha con cordón', 'con estampado de letra', '1486.00', 'SHEIN', 'p', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":10}', '2020-12-19', 'hombre', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/08/26/1598424960f7dd8b1edc278a4c5e56fe7c0fbabf97_thumbnail_600x.webp\", \"I2\":\"https://img.ltwebstatic.com/images3_pi/2020/08/26/1598424960f7dd8b1edc278a4c5e56fe7c0fbabf97_thumbnail_600x.webp\",\"I3\":\"https://img.ltwebstatic.com/images3_pi/2020/08/26/1598424960f7dd8b1edc278a4c5e56fe7c0fbabf97_thumbnail_600x.webp\"}', 1),
(134, 'Abrigo de cuello', 'con solapa con botón', '888.00', 'SHEIN', 'abrigo', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":10}', '2020-12-19', 'hombre', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/11/09/1604888212bf8d0077ab67f2ae94c04d11f71b1819_thumbnail_600x.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(135, 'Chaqueta de pata de gallo', 'con botones de cuello V', '1145.00', 'SHEIN', 'p', '{\"XS\":0,\"S\":10,\"M\":10,\"L\":10,\"XL\":0}', '2020-12-19', 'hombre', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/11/07/1604720082b496c36331fb3fcc98c4ead57c3dd3fb_thumbnail_600x.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(136, 'Chaqueta de parte delantera abierta', 'De niñitas tejida de canalé', '1208.00', 'SHEIN', 'chamarra', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":10}', '2020-12-19', 'ninos', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2019/11/05/1572925840c7a075152b0a9ce28acf125fe73209fe_thumbnail_600x.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(137, 'Chaqueta con pelo sintético', 'De tie dye con capucha con oreja 3D', '2458.00', 'SHEIN', 'chamarra', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":10}', '2020-12-19', 'ninos', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/10/26/16036903715c1f17edb6d095de79197b9ac46c85cb_thumbnail_600x.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(138, 'Chaquetas de niñitos', 'Dibujos animados Dulce', '1312.00', 'SHEIN', 'p', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":0}', '2020-12-19', 'ninos', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/11/12/160515409385c66ae52b378cac154fc8672782a798_thumbnail_600x.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(139, 'Capucha teddy', 'dos colores', '1261.00', 'SHEIN', 'p', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":0,\"XL\":0}', '2020-12-19', 'ninos', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/12/03/1606971964efb47c305060a1f452f2a6b58e157036_thumbnail_600x.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(140, 'SHEIN BASICS Pullover', 'unicolor 3 piezas', '1418.00', 'SHEIN', 'p', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":0}', '2020-12-19', 'ninos', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/10/29/1603955911292242698ea4c9f63201f7015824643c_thumbnail_600x.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(141, 'Abrigo con botón', 'con cinturón fruncido', '1394.00', 'SHEIN', 'abrigo', '{\"XS\":10,\"S\":10,\"M\":10,\"L\":10,\"XL\":10}', '2020-12-19', 'ninos', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/08/25/1598351337f66cecff97116392b028aefec93ab2b0_thumbnail_600x.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(142, 'Chaquetas de niñitos', 'Cremallera Liso Casual', '508.00', 'SHEIN', 'p', '{\"XS\":10,\"S\":10,\"M\":0,\"L\":10,\"XL\":10}', '2020-12-19', 'ninos', '{\"I1\":\"https://img.ltwebstatic.com/images3_pi/2020/10/20/160316527572bd3858e547d16f15f33366e1daee97_thumbnail_600x.webp\", \"I2\":\"\",\"I3\":\"\"}', 1),
(145, 'lala', '', '5000.00', 'shein', 'p', '{\"XS\":7,\"S\":4,\"M\":5,\"L\":5,\"XL\":5}', '0000-00-00', 'ninos', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Id_usuario` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `passw` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `p_nombre` varchar(25) NOT NULL,
  `s_nombre` varchar(25) DEFAULT NULL,
  `ape_pat` varchar(25) NOT NULL,
  `ape_mat` varchar(25) DEFAULT NULL,
  `fec_nac` date NOT NULL,
  `telefono` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id_usuario`, `username`, `passw`, `email`, `p_nombre`, `s_nombre`, `ape_pat`, `ape_mat`, `fec_nac`, `telefono`) VALUES
(1, 'Nourish1', 'hola', 'josemena146@gmail.com', 'Jesus', 'Amaury', 'romo', 'hernandez', '2000-05-02', '5464646'),
(3, 'Nourish99', 'hola', 'amaury@wuu.com', 'Jesus', 'Amaury', 'romo', 'hernandez', '2000-05-02', '5464646'),
(16, 'mondrag', 'hola', 'josemena146@gmail.com', 'Eduardo', 'Jose', 'Mena', 'Mondragon', '2000-09-24', '4491234567'),
(20, 'amaa', 'hola', 'al255798@edu.uaa.mx', 'Amaury', '', 'Romo', '', '2003-02-06', '4498049629'),
(21, 'amaury', '0acc00bf8abac7533d0e07b01b8079fb6ec4b4c5', 'al255798@edu.uaa.mx', 'Amaury', '', 'Romo', 'Hernandez', '2000-02-05', '4498049629'),
(22, 'Elmena', 'a1f297dda7facdc734e4bfa7c19fdba304e6c806', 'al255798@edu.uaa.mx', 'lalo', '', 'mena', '', '2000-02-19', '4498049629'),
(23, 'elyisus', '91223fd10ce86fc852b449583aa2196c304bf6e0', 'al255798@edu.uaa.mx', 'lalo', '', 'uff', '', '2010-02-09', '4498049629'),
(24, 'amauryR', '0acc00bf8abac7533d0e07b01b8079fb6ec4b4c5', 'al255798@edu.uaa.mx', 'Amaury', '', 'Romo', '', '2011-06-19', '4498049629'),
(25, 'Helge', '452bc78a641016e6df8bdd1e0a4c45e05cc3eb40', 'al255798@edu.uaa.mx', 'Helger', 'Guten', 'Morning', 'Reigen', '1987-06-17', '4498049629'),
(26, 'Lelosi', '0f3fde0103dd44077c040215a2fabd09a097aecc', 'al255798@edu.uaa.mx', 'Chupo', 'staciio', 'Manedez', 'Macias', '2009-02-11', '4555111'),
(27, 'putin', '452bc78a641016e6df8bdd1e0a4c45e05cc3eb40', 'arnoldotejeda10@gmail.com', 'Vladimir', 'rosten', 'Kowsky', 'putin', '2006-02-15', '56464'),
(28, 'pepe', '452bc78a641016e6df8bdd1e0a4c45e05cc3eb40', 'al255798@edu.uaa.mx', 'ete', 'Romo', 'sech', '', '2004-03-11', '4498049629'),
(29, 'elmo', '0f3fde0103dd44077c040215a2fabd09a097aecc', 'al255798@edu.uaa.mx', 'Este', 'Romo', 'vato', '', '1999-02-10', '4498049629'),
(30, 'elpepos', '452bc78a641016e6df8bdd1e0a4c45e05cc3eb40', 'al255798@edu.uaa.mx', 'Ete', 'Tejeda', 'secho', '', '2000-06-30', '4498049629'),
(31, 'fj', '4e46dc0969e6621f2d61d2228e3cd91b75cd9edc', 'al255798@edu.uaa.mx', 'Amaury', 'Jose', 'Romo', 'Fernandez', '2004-04-03', '4498049629');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`Id_admin`);

--
-- Indices de la tabla `chat_mensaje`
--
ALTER TABLE `chat_mensaje`
  ADD PRIMARY KEY (`Id_chat_msj`),
  ADD KEY `fk_id_usuario` (`Id_usuario`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`Id_cliente`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD KEY `comentarios_ibfk_1` (`Id_cliente`),
  ADD KEY `comentarios_ibfk_2` (`Id_producto`);

--
-- Indices de la tabla `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`Id_compra`),
  ADD KEY `Id_cliente` (`Id_cliente`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD KEY `Id_compra` (`Id_compra`),
  ADD KEY `Id_producto` (`Id_producto`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD KEY `Id_usuario` (`Id_usuario`);

--
-- Indices de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD PRIMARY KEY (`Id_oferta`),
  ADD KEY `fk_id_producto` (`Id_producto`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`ID_producto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id_usuario`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `chat_mensaje`
--
ALTER TABLE `chat_mensaje`
  MODIFY `Id_chat_msj` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `compra`
--
ALTER TABLE `compra`
  MODIFY `Id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `ofertas`
--
ALTER TABLE `ofertas`
  MODIFY `Id_oferta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `ID_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD CONSTRAINT `administrador_ibfk_1` FOREIGN KEY (`Id_admin`) REFERENCES `usuario` (`Id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `chat_mensaje`
--
ALTER TABLE `chat_mensaje`
  ADD CONSTRAINT `fk_id_usuario` FOREIGN KEY (`Id_usuario`) REFERENCES `usuario` (`Id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`Id_cliente`) REFERENCES `usuario` (`Id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`Id_cliente`) REFERENCES `cliente` (`Id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`Id_producto`) REFERENCES `producto` (`ID_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`Id_cliente`) REFERENCES `cliente` (`Id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD CONSTRAINT `detalle_compra_ibfk_1` FOREIGN KEY (`Id_compra`) REFERENCES `compra` (`Id_compra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_compra_ibfk_2` FOREIGN KEY (`Id_producto`) REFERENCES `producto` (`ID_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD CONSTRAINT `fk_direccion` FOREIGN KEY (`Id_usuario`) REFERENCES `usuario` (`Id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ofertas`
--
ALTER TABLE `ofertas`
  ADD CONSTRAINT `fk_id_producto` FOREIGN KEY (`Id_producto`) REFERENCES `producto` (`ID_producto`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
