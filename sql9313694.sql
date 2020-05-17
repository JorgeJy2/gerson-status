-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Servidor: sql9.freemysqlhosting.net
-- Tiempo de generación: 04-12-2019 a las 19:39:49
-- Versión del servidor: 5.5.58-0ubuntu0.14.04.1
-- Versión de PHP: 7.0.33-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sql9313694`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_almacen`
--

CREATE TABLE `t_almacen` (
  `id_almacen` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `entrada` double NOT NULL,
  `salida` double NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_almacen`
--

INSERT INTO `t_almacen` (`id_almacen`, `id_producto`, `entrada`, `salida`, `fecha`) VALUES
(2, 22, 350, 300, '2020-02-02'),
(3, 25, 30, 100, '2019-11-15'),
(4, 27, 350, 300, '2019-11-27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_carrusel`
--

CREATE TABLE `t_carrusel` (
  `id_imagen` int(11) NOT NULL,
  `imagen` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_carrusel`
--

INSERT INTO `t_carrusel` (`id_imagen`, `imagen`) VALUES
(5, 'files/ccc__9ec744.jpeg'),
(6, 'files/ccc__235d9e.png'),
(8, 'files/ccc__216cee.jpeg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_categorias`
--

CREATE TABLE `t_categorias` (
  `id_categoria` int(11) NOT NULL,
  `categoria` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_categorias`
--

INSERT INTO `t_categorias` (`id_categoria`, `categoria`) VALUES
(1, 'Sillas'),
(2, 'Mesas'),
(3, 'Sillones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_cliente`
--

CREATE TABLE `t_cliente` (
  `id_cliente` int(11) NOT NULL,
  `cliente` varchar(255) NOT NULL,
  `contacto` varchar(60) NOT NULL,
  `telefono1` varchar(20) NOT NULL,
  `correo1` varchar(60) NOT NULL,
  `telefono2` varchar(20) NOT NULL,
  `correo2` varchar(60) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `id_colonia` int(11) NOT NULL,
  `id_codpos` int(11) NOT NULL,
  `calle` varchar(40) NOT NULL,
  `Noext` varchar(5) NOT NULL,
  `Noint` varchar(5) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_cliente`
--

INSERT INTO `t_cliente` (`id_cliente`, `cliente`, `contacto`, `telefono1`, `correo1`, `telefono2`, `correo2`, `id_estado`, `id_municipio`, `id_colonia`, `id_codpos`, `calle`, `Noext`, `Noint`, `id_usuario`) VALUES
(4, 'Alma', 'YO jaja', '6545454545', 'alma@gmail.com', '5456465465465', 'jorge.jacobo.francisco.306@gmail.com', 1, 21, 2, 3, 'Estado de MÃ©xico calle tirteo', '21654', '64465', 9),
(5, 'Jorge Jacobo Francisco', 'YO jaja', '6545645454', 'jorge.jacobo.francisco.306@gmail.com', '1212154545', 'jorge.jacobo.francisco.3056@gmail.com', 1, 21, 2, 3, 'Estado de MÃ©xico calle tirteo', '25', '15', 11),
(6, 'alakaks', 'YO jaja', '1651515151515', 'francisco.306@gmail.com', '1212154545', 'jorge.jawdcobo.francisco.306@gmail.com', 1, 21, 2, 3, 'Estado de MÃ©xico calle tirteo', '1515', '1515', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_codpos`
--

CREATE TABLE `t_codpos` (
  `id_codpos` int(11) NOT NULL,
  `codpos` varchar(5) NOT NULL,
  `id_colonia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_codpos`
--

INSERT INTO `t_codpos` (`id_codpos`, `codpos`, `id_colonia`) VALUES
(1, '65438', 1),
(2, '87654', 3),
(3, '12788', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_colonias`
--

CREATE TABLE `t_colonias` (
  `id_colonia` int(11) NOT NULL,
  `colonia` varchar(60) NOT NULL,
  `id_municipio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_colonias`
--

INSERT INTO `t_colonias` (`id_colonia`, `colonia`, `id_municipio`) VALUES
(1, 'San Pedro', 20),
(2, 'Hidalgo', 21),
(3, 'Totoltepec', 23),
(4, 'Otrojajaja', 21),
(5, 'ssa', 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_compras`
--

CREATE TABLE `t_compras` (
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `cantidad` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_estado`
--

CREATE TABLE `t_estado` (
  `id_estado` int(11) NOT NULL,
  `estado` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_estado`
--

INSERT INTO `t_estado` (`id_estado`, `estado`) VALUES
(1, 'Mexico'),
(2, 'Sonora'),
(3, 'Veracruz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_imagenes`
--

CREATE TABLE `t_imagenes` (
  `id_imagenes` int(11) NOT NULL,
  `imagen` varchar(60) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `tipo` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_imagenes`
--

INSERT INTO `t_imagenes` (`id_imagenes`, `imagen`, `id_producto`, `tipo`, `status`) VALUES
(1, 'src', 1, 2, 1),
(2, 'files/sub_img/s_Nuevo_d0f2ff.jpg', 17, 2, 1),
(3, 'files/sub_img/s_Nuevo_22116a.jpg', 17, 2, 1),
(4, 'files/sub_img/s_Nuevo_21a6db.jpg', 17, 2, 1),
(5, 'files/sub_img/s_Nuevo_9f462e.jpg', 17, 2, 1),
(6, 'files/sub_img/s_Nuevo_eb970d.jpg', 17, 2, 1),
(7, 'files/sub_img/s_Nuevo_f42e93.jpg', 17, 2, 1),
(8, 'files/sub_img/s_jxjx ds_e8a921.jpg', 18, 2, 1),
(9, 'files/sub_img/s_jxjx ds_dd4fa3.jpg', 18, 2, 1),
(10, 'files/sub_img/s_jxjx ds_78002d.jpg', 18, 2, 1),
(11, 'files/sub_img/s_jxjx ds_fb1d07.png', 18, 2, 1),
(12, 'files/sub_img/s_jxjx ds_a765b5.jpg', 18, 2, 1),
(16, 'files/sub_img/s_Silla_d98356.jpg', 20, 2, 1),
(19, 'files/sub_img/s_verde_63856f.jpg', 20, 2, 1),
(23, 'files/sub_img/s_Televisor_2daeb3.jpg', 21, 2, 1),
(24, 'files/sub_img/s_Productos_821615.jpg', 22, 2, 1),
(25, 'files/sub_img/s_Productos_f9da04.jpg', 22, 2, 1),
(26, 'files/sub_img/s_Productos_29a141.jpg', 22, 2, 1),
(27, 'files/sub_img/s_Productos_2e6737.jpg', 22, 2, 1),
(28, 'files/sub_img/s_Productos_aaa39c.jpg', 22, 2, 1),
(29, 'files/sub_img/s_Productos_15f1c2.jpg', 22, 2, 1),
(30, 'files/sub_img/s_Productos_9df318.jpg', 22, 2, 1),
(31, 'files/sub_img/s_Productos_4342cd.jpg', 22, 2, 1),
(32, 'files/sub_img/s_Productos_3bd6f2.jpg', 22, 2, 1),
(33, 'files/sub_img/s_Productos_d9d92c.png', 22, 2, 1),
(34, 'files/sub_img/s_Sila roja_2900cd.png', 23, 2, 1),
(35, 'files/sub_img/s_Sila roja_021455.png', 23, 2, 1),
(36, 'files/sub_img/s_Sila roja_30262d.png', 23, 2, 1),
(37, 'files/sub_img/s_Silla de colores_c3c86c.png', 24, 2, 1),
(38, 'files/sub_img/s_Silla de colores_d46380.png', 24, 2, 1),
(39, 'files/sub_img/s_Silla de colores_75bffc.png', 24, 2, 1),
(40, 'files/sub_img/s_Sillon cafe_3bbbb7.png', 25, 2, 1),
(41, 'files/sub_img/s_Sillon cafe_69d8ef.png', 25, 2, 1),
(42, 'files/sub_img/s_Sillon cafe_e1ad53.png', 25, 2, 1),
(43, 'files/sub_img/s_Silla azul_0f70d5.png', 26, 2, 1),
(44, 'files/sub_img/s_Silla azul_7b4ec1.png', 26, 2, 1),
(45, 'files/sub_img/s_Silla azul_1f92b9.png', 26, 2, 1),
(46, 'files/sub_img/s_Mesa_d400c4.png', 27, 2, 1),
(47, 'files/sub_img/s_Mesa_867cf5.png', 27, 2, 1),
(48, 'files/sub_img/s_Mesa_c6b747.png', 27, 2, 1),
(49, 'files/sub_img/s_Mesedora_f00a3a.png', 28, 2, 1),
(50, 'files/sub_img/s_Mesedora_bc2aeb.png', 28, 2, 1),
(51, 'files/sub_img/s_Mesedora_222d3f.png', 28, 2, 1),
(52, 'files/sub_img/s_Silla rosa_f23904.png', 29, 2, 1),
(53, 'files/sub_img/s_Silla rosa_f0498c.png', 29, 2, 1),
(54, 'files/sub_img/s_Silla rosa_ff7471.png', 29, 2, 1),
(55, 'files/sub_img/s_Silla negra_f20664.png', 32, 2, 1),
(56, 'files/sub_img/s_Silla negra_bba437.png', 32, 2, 1),
(57, 'files/sub_img/s_Silla negra_aeb506.png', 32, 2, 1),
(58, 'files/sub_img/s_amanda_cb094c.23', 33, 2, 1),
(59, 'files/sub_img/s_amanda_a2ba9c.23', 33, 2, 1),
(60, 'files/sub_img/s_amanda_905654.23', 33, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_municipio`
--

CREATE TABLE `t_municipio` (
  `id_municipio` int(11) NOT NULL,
  `municipio` varchar(60) NOT NULL,
  `id_estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_municipio`
--

INSERT INTO `t_municipio` (`id_municipio`, `municipio`, `id_estado`) VALUES
(19, 'Nuevos', 3),
(21, 'nuevo', 1),
(23, 'djd', 2),
(24, 'djdk', 1),
(25, 'Tultitlan', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_pedido`
--

CREATE TABLE `t_pedido` (
  `id_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` double NOT NULL,
  `folio` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_pedido`
--

INSERT INTO `t_pedido` (`id_pedido`, `id_producto`, `cantidad`, `folio`, `fecha`) VALUES
(315, 23, 1, 1, '2019-12-04'),
(316, 28, 1, 1, '2019-12-04'),
(317, 25, 1, 1, '2019-12-04'),
(318, 29, 2, 1, '2019-12-04'),
(319, 33, 2, 1, '2019-12-04'),
(320, 23, 4, 1, '2019-12-04'),
(321, 28, 4, 1, '2019-12-04'),
(322, 33, 1, 1, '2019-12-04'),
(326, 26, 1, 1, '2019-12-04'),
(327, 27, 1, 1, '2019-12-04'),
(330, 25, 1, 1, '2019-12-04'),
(331, 26, 1, 1, '2019-12-04'),
(333, 23, 1, 1, '2019-12-04'),
(335, 23, 1, 1, '2019-12-04'),
(336, 27, 1, 1, '2019-12-04'),
(337, 25, 1, 1, '2019-12-04'),
(338, 23, 1, 1, '2019-12-04'),
(339, 25, 1, 1, '2019-12-04'),
(340, 26, 1, 1, '2019-12-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_producto`
--

CREATE TABLE `t_producto` (
  `id_producto` int(11) NOT NULL,
  `producto` varchar(150) NOT NULL,
  `precom` double NOT NULL,
  `preven` double NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(50) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_producto`
--

INSERT INTO `t_producto` (`id_producto`, `producto`, `precom`, `preven`, `descripcion`, `imagen`, `id_categoria`) VALUES
(23, 'sillon rojas', 2000, 2100, 'un sillon rojo', 'files/p_sillon rojas_63dff9.png', 3),
(25, 'Sillon cafe', 2000, 3500, 'Sillon', 'files/p_Sillon cafe_70bd07.png', 3),
(26, 'Silla azul', 1500, 2000, 'silla', 'files/p_Silla azul_d3deb0.png', 1),
(27, 'Mesa', 3000, 4000, 'mesa', 'files/p_Mesa_fb871b.png', 2),
(28, 'Mesedora', 1500, 4000, 'Mesedora', 'files/p_Mesedora_40bcdc.png', 1),
(29, 'Silla rosa jaja', 1500, 2000, 'silla', 'files/p_Silla rosa_bc2970.png', 1),
(32, 'Silla negra', 1500, 2000, 'Una silla chida negra', 'files/p_Silla negra_bb6170.png', 1),
(33, 'amanda', 5000, 5000, 'dsajdsj', 'files/p_amanda_9585b3.jpeg', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_proveedor`
--

CREATE TABLE `t_proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `proveedor` varchar(255) NOT NULL,
  `contacto` varchar(60) NOT NULL,
  `telefono1` varchar(20) NOT NULL,
  `correo1` varchar(60) NOT NULL,
  `telefono2` varchar(20) NOT NULL,
  `correo2` varchar(60) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `id_colonia` int(11) NOT NULL,
  `id_codpos` int(11) NOT NULL,
  `calle` varchar(40) NOT NULL,
  `Noext` varchar(5) NOT NULL,
  `Noint` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_proveedor`
--

INSERT INTO `t_proveedor` (`id_proveedor`, `proveedor`, `contacto`, `telefono1`, `correo1`, `telefono2`, `correo2`, `id_estado`, `id_municipio`, `id_colonia`, `id_codpos`, `calle`, `Noext`, `Noint`) VALUES
(1, 'ALFAWEB', '', '', '', '', '', 0, 0, 0, 0, '', '', ''),
(2, 'IKEA', 'dskjdskjq', '54564564554', '435565', 'sdkjsa@xsjknsank.xo', 'asjsaj@gmail.com', 1, 1, 1, 1, 'mexico', '55', '12'),
(3, 'Gamesa', 'Juan Alvares', '4567898765', 'gamesa@gmail.com', '5678909876', 'gms@hotmail.com', 1, 19, 2, 1, 'Fresno', '198', '20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_usuarios`
--

CREATE TABLE `t_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `correo` varchar(60) NOT NULL,
  `contrapass` varchar(255) NOT NULL,
  `nevel` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_usuarios`
--

INSERT INTO `t_usuarios` (`id_usuario`, `correo`, `contrapass`, `nevel`, `status`) VALUES
(2, 'jorge@gmail.com', 'b488c09212bfa702612d1a0d0fe44968ba0adc2e', 1, 1),
(9, 'alma@gmail.com', '205c190f654fc974d1ea63dd4edaa6ec759f4191', 3, 1),
(10, 'amanda@gmail.com', '7b51061d320e67a1b3fd901ad62cd80f46f562ae', 1, 1),
(11, 'jorge.jacobo.francisco.306@gmail.com', '205c190f654fc974d1ea63dd4edaa6ec759f4191', 3, 1),
(12, 'francisco.306@gmail.com', '205c190f654fc974d1ea63dd4edaa6ec759f4191', 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_ventas`
--

CREATE TABLE `t_ventas` (
  `id_venta` int(11) NOT NULL,
  `facrem` tinyint(4) NOT NULL,
  `monto` double NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `pdfventa` varchar(60) NOT NULL,
  `id_pedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `t_ventas`
--

INSERT INTO `t_ventas` (`id_venta`, `facrem`, `monto`, `id_cliente`, `fecha`, `pdfventa`, `id_pedido`) VALUES
(126, 22, 4000, 4, '2019-12-04', 'pdfs/factura_a031ec.pdf', 316),
(127, 22, 3500, 4, '2019-12-04', 'pdfs/factura_a031ec.pdf', 317),
(128, 22, 2100, 4, '2019-12-04', 'pdfs/factura_a031ec.pdf', 315),
(129, 22, 10000, 4, '2019-12-04', 'pdfs/factura_abe71e.pdf', 319),
(130, 22, 4000, 4, '2019-12-04', 'pdfs/factura_abe71e.pdf', 318),
(131, 22, 16000, 4, '2019-12-04', 'pdfs/factura_eb2bff.pdf', 321),
(132, 22, 8400, 4, '2019-12-04', 'pdfs/factura_eb2bff.pdf', 320),
(133, 22, 5000, 4, '2019-12-04', 'pdfs/factura_b36f57.pdf', 322),
(134, 22, 4000, 4, '2019-12-04', 'pdfs/factura_070026.pdf', 327),
(135, 22, 2000, 4, '2019-12-04', 'pdfs/factura_070026.pdf', 326),
(136, 22, 2100, 4, '2019-12-04', 'pdfs/factura_195a61.pdf', 333),
(137, 22, 4000, 4, '2019-12-04', 'pdfs/factura_0aca15.pdf', 336),
(138, 22, 3500, 4, '2019-12-04', 'pdfs/factura_0aca15.pdf', 337),
(139, 22, 2100, 4, '2019-12-04', 'pdfs/factura_0aca15.pdf', 335),
(140, 22, 4000, 4, '2019-12-04', 'pdfs/factura_d55a91.pdf', 336),
(141, 22, 3500, 4, '2019-12-04', 'pdfs/factura_d55a91.pdf', 337),
(142, 22, 2100, 4, '2019-12-04', 'pdfs/factura_d55a91.pdf', 335),
(143, 22, 2000, 4, '2019-12-04', 'pdfs/factura_7c503b.pdf', 340),
(144, 22, 3500, 4, '2019-12-04', 'pdfs/factura_7c503b.pdf', 339),
(145, 22, 2100, 4, '2019-12-04', 'pdfs/factura_7c503b.pdf', 338);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `t_almacen`
--
ALTER TABLE `t_almacen`
  ADD PRIMARY KEY (`id_almacen`);

--
-- Indices de la tabla `t_carrusel`
--
ALTER TABLE `t_carrusel`
  ADD PRIMARY KEY (`id_imagen`);

--
-- Indices de la tabla `t_categorias`
--
ALTER TABLE `t_categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `t_cliente`
--
ALTER TABLE `t_cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `t_codpos`
--
ALTER TABLE `t_codpos`
  ADD PRIMARY KEY (`id_codpos`);

--
-- Indices de la tabla `t_colonias`
--
ALTER TABLE `t_colonias`
  ADD PRIMARY KEY (`id_colonia`);

--
-- Indices de la tabla `t_compras`
--
ALTER TABLE `t_compras`
  ADD PRIMARY KEY (`id_compra`);

--
-- Indices de la tabla `t_estado`
--
ALTER TABLE `t_estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `t_imagenes`
--
ALTER TABLE `t_imagenes`
  ADD PRIMARY KEY (`id_imagenes`);

--
-- Indices de la tabla `t_municipio`
--
ALTER TABLE `t_municipio`
  ADD PRIMARY KEY (`id_municipio`);

--
-- Indices de la tabla `t_pedido`
--
ALTER TABLE `t_pedido`
  ADD PRIMARY KEY (`id_pedido`);

--
-- Indices de la tabla `t_producto`
--
ALTER TABLE `t_producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `t_proveedor`
--
ALTER TABLE `t_proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `t_usuarios`
--
ALTER TABLE `t_usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `t_ventas`
--
ALTER TABLE `t_ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_pedido` (`id_pedido`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `t_almacen`
--
ALTER TABLE `t_almacen`
  MODIFY `id_almacen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `t_carrusel`
--
ALTER TABLE `t_carrusel`
  MODIFY `id_imagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `t_categorias`
--
ALTER TABLE `t_categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `t_cliente`
--
ALTER TABLE `t_cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `t_codpos`
--
ALTER TABLE `t_codpos`
  MODIFY `id_codpos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `t_colonias`
--
ALTER TABLE `t_colonias`
  MODIFY `id_colonia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `t_compras`
--
ALTER TABLE `t_compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT de la tabla `t_estado`
--
ALTER TABLE `t_estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `t_imagenes`
--
ALTER TABLE `t_imagenes`
  MODIFY `id_imagenes` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT de la tabla `t_municipio`
--
ALTER TABLE `t_municipio`
  MODIFY `id_municipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `t_pedido`
--
ALTER TABLE `t_pedido`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=341;
--
-- AUTO_INCREMENT de la tabla `t_producto`
--
ALTER TABLE `t_producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de la tabla `t_proveedor`
--
ALTER TABLE `t_proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `t_usuarios`
--
ALTER TABLE `t_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `t_ventas`
--
ALTER TABLE `t_ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `t_cliente`
--
ALTER TABLE `t_cliente`
  ADD CONSTRAINT `t_cliente_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `t_usuarios` (`id_usuario`) ON DELETE CASCADE;

--
-- Filtros para la tabla `t_ventas`
--
ALTER TABLE `t_ventas`
  ADD CONSTRAINT `t_ventas_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `t_pedido` (`id_pedido`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
