-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 09-02-2020 a las 20:02:53
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `kool`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blog`
--

CREATE TABLE `blog` (
  `id_blog` int(11) UNSIGNED NOT NULL COMMENT 'ID',
  `lang` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL COMMENT 'Titulo',
  `subtitle` text NOT NULL COMMENT 'Descripción',
  `categories` text NOT NULL COMMENT 'Tipo de trabajo',
  `related` text NOT NULL COMMENT 'Tags',
  `id_file` bigint(20) NOT NULL COMMENT 'Imagen',
  `texto` text NOT NULL COMMENT 'Texto',
  `share_twitter` int(11) NOT NULL DEFAULT '0',
  `share_facebook` int(11) NOT NULL DEFAULT '0',
  `share_instagram` int(11) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `title2` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `blog`
--

INSERT INTO `blog` (`id_blog`, `lang`, `title`, `subtitle`, `categories`, `related`, `id_file`, `texto`, `share_twitter`, `share_facebook`, `share_instagram`, `active`, `title2`, `date`) VALUES
(1, 'es', 'It S Hurricane Season But We Are Visiting Hilton Head Island', 'Integer sem quam, consectetur eu sem porta, aliquam vestibulum nibh. Nulla ut elit at nunc imperdiet malesuada eget ut urna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras auctor rhoncus nulla a eleifend. Morbi viverra, ex nec venenatis cursus, sem urna sodales enim.', '[{\"category\":\"1\"},{\"category\":\"2\"}]', '[{\"related\":\"1\"}]', 140, '<p style=\"text-align: center;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In interdum scelerisque tortor. Praesent id ullamcorper tellus. Quisque elementum tellus non tempor ultrices. Nam dictum lectus non arcu imperdiet, ultricies elementum tellus eleifend. Nullam nisl diam, tincidunt vel lacus nec, consequat pretium diam. Sed quis eros metus. Integer accumsan ut nunc vel lacinia. Phasellus tempus augue rutrum egestas posuere. Sed vel hendrerit felis, in condimentum nisl. In id tincidunt orci, vitae malesuada mauris. Integer sem quam, consectetur eu sem porta, aliquam vestibulum nibh. Nulla ut elit at nunc imperdiet malesuada eget ut urna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras auctor rhoncus nulla a eleifend. Morbi viverra, ex nec venenatis cursus, sem urna sodales enim, id sodales dui erat in diam. Vivamus posuere faucibus sagittis.</p>\r\n\r\n<p style=\"text-align: center;\">Sed a pulvinar sem, non varius nisi. Morbi nunc leo, luctus non volutpat id, pharetra id massa. Quisque non purus nisl. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam rutrum est tortor, non lobortis ex tincidunt non. Sed est dolor, aliquet eu arcu ac, consectetur convallis mauris. Proin imperdiet eget justo sed rhoncus. Mauris volutpat rhoncus mi in vestibulum. Praesent posuere erat ut ipsum porta suscipit.</p>\r\n\r\n<h1 style=\"text-align: center;\">Vivamus nec hendrerit metus. Donec accumsan orci sit amet elit molestie mattis. Quisque in rutrum nisl,</h1>\r\n\r\n<p style=\"text-align: center;\">Vivamus nec hendrerit metus. Donec accumsan orci sit amet elit molestie mattis. Quisque in rutrum nisl, ut tincidunt metus. Nulla facilisi. Vestibulum tempor commodo diam, nec imperdiet justo lacinia vitae. Donec fringilla nisl sit amet mauris dapibus, vel venenatis ante aliquam. Integer id ex fringilla lacus vehicula lobortis at posuere elit. Suspendisse potenti. Proin vulputate, velit vel cursus rutrum, metus magna sodales leo, non accumsan mauris purus quis urna. Sed imperdiet suscipit dui, id tempus metus laoreet et. Cras nulla elit, viverra ac faucibus porttitor, aliquam in augue. Nunc at luctus dolor. Cras ipsum elit, facilisis in urna vitae, elementum euismod augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum euismod mattis nisl, in molestie odio aliquam nec.</p>\r\n\r\n<p style=\"text-align: center;\">[img=141][/img]</p>\r\n\r\n<p style=\"text-align: center;\">Sed ac ex diam. Donec consequat molestie euismod. Curabitur tempus, ligula at tincidunt varius, massa nulla gravida odio, vitae laoreet metus felis sit amet urna. Phasellus volutpat tortor quis consectetur viverra. Aliquam erat volutpat. Mauris vel rutrum massa. In pharetra libero accumsan odio pulvinar, eget vulputate mi ultricies. Mauris feugiat cursus maximus. Sed blandit dui vitae nisl ornare, ornare fermentum urna ultricies. Duis sit amet porta mauris. Nunc rutrum venenatis blandit.</p>\r\n\r\n<p style=\"text-align: center;\">Donec viverra nisl lacus, elementum lacinia magna pellentesque posuere. Integer eleifend facilisis pellentesque. Proin laoreet tortor risus. Aliquam dapibus diam non ultrices volutpat. Suspendisse congue erat enim, non dictum neque pulvinar eget. Curabitur sit amet aliquet sem. Quisque tristique, dui non luctus tempus, nibh nunc laoreet lorem, quis fringilla ex massa et augue.</p>\r\n\r\n<p> </p>', 0, 0, 0, 1, '0', '2020-02-09 15:52:05'),
(2, 'es', 'It S Hurricane Season But We Are Visiting Hilton Head Island', 'Integer sem quam, consectetur eu sem porta, aliquam vestibulum nibh. Nulla ut elit at nunc imperdiet malesuada eget ut urna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras auctor rhoncus nulla a eleifend. Morbi viverra, ex nec venenatis cursus, sem urna sodales enim.', '[{\"category\":\"1\"},{\"category\":\"2\"}]', '[{\"related\":\"1\"}]', 140, '<p style=\"text-align: center;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In interdum scelerisque tortor. Praesent id ullamcorper tellus. Quisque elementum tellus non tempor ultrices. Nam dictum lectus non arcu imperdiet, ultricies elementum tellus eleifend. Nullam nisl diam, tincidunt vel lacus nec, consequat pretium diam. Sed quis eros metus. Integer accumsan ut nunc vel lacinia. Phasellus tempus augue rutrum egestas posuere. Sed vel hendrerit felis, in condimentum nisl. In id tincidunt orci, vitae malesuada mauris. Integer sem quam, consectetur eu sem porta, aliquam vestibulum nibh. Nulla ut elit at nunc imperdiet malesuada eget ut urna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras auctor rhoncus nulla a eleifend. Morbi viverra, ex nec venenatis cursus, sem urna sodales enim, id sodales dui erat in diam. Vivamus posuere faucibus sagittis.</p>\r\n\r\n<p style=\"text-align: center;\">Sed a pulvinar sem, non varius nisi. Morbi nunc leo, luctus non volutpat id, pharetra id massa. Quisque non purus nisl. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam rutrum est tortor, non lobortis ex tincidunt non. Sed est dolor, aliquet eu arcu ac, consectetur convallis mauris. Proin imperdiet eget justo sed rhoncus. Mauris volutpat rhoncus mi in vestibulum. Praesent posuere erat ut ipsum porta suscipit.</p>\r\n\r\n<h1 style=\"text-align: center;\">Vivamus nec hendrerit metus. Donec accumsan orci sit amet elit molestie mattis. Quisque in rutrum nisl,</h1>\r\n\r\n<p style=\"text-align: center;\">Vivamus nec hendrerit metus. Donec accumsan orci sit amet elit molestie mattis. Quisque in rutrum nisl, ut tincidunt metus. Nulla facilisi. Vestibulum tempor commodo diam, nec imperdiet justo lacinia vitae. Donec fringilla nisl sit amet mauris dapibus, vel venenatis ante aliquam. Integer id ex fringilla lacus vehicula lobortis at posuere elit. Suspendisse potenti. Proin vulputate, velit vel cursus rutrum, metus magna sodales leo, non accumsan mauris purus quis urna. Sed imperdiet suscipit dui, id tempus metus laoreet et. Cras nulla elit, viverra ac faucibus porttitor, aliquam in augue. Nunc at luctus dolor. Cras ipsum elit, facilisis in urna vitae, elementum euismod augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum euismod mattis nisl, in molestie odio aliquam nec.</p>\r\n\r\n<p style=\"text-align: center;\">[img=141][/img]</p>\r\n\r\n<p style=\"text-align: center;\">Sed ac ex diam. Donec consequat molestie euismod. Curabitur tempus, ligula at tincidunt varius, massa nulla gravida odio, vitae laoreet metus felis sit amet urna. Phasellus volutpat tortor quis consectetur viverra. Aliquam erat volutpat. Mauris vel rutrum massa. In pharetra libero accumsan odio pulvinar, eget vulputate mi ultricies. Mauris feugiat cursus maximus. Sed blandit dui vitae nisl ornare, ornare fermentum urna ultricies. Duis sit amet porta mauris. Nunc rutrum venenatis blandit.</p>\r\n\r\n<p style=\"text-align: center;\">Donec viverra nisl lacus, elementum lacinia magna pellentesque posuere. Integer eleifend facilisis pellentesque. Proin laoreet tortor risus. Aliquam dapibus diam non ultrices volutpat. Suspendisse congue erat enim, non dictum neque pulvinar eget. Curabitur sit amet aliquet sem. Quisque tristique, dui non luctus tempus, nibh nunc laoreet lorem, quis fringilla ex massa et augue.</p>\r\n\r\n<p> </p>', 0, 0, 0, 1, '0', '2020-02-09 15:52:05'),
(3, 'es', 'It S Hurricane Season But We Are Visiting Hilton Head Island', 'Integer sem quam, consectetur eu sem porta, aliquam vestibulum nibh. Nulla ut elit at nunc imperdiet malesuada eget ut urna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras auctor rhoncus nulla a eleifend. Morbi viverra, ex nec venenatis cursus, sem urna sodales enim.', '[{\"category\":\"1\"},{\"category\":\"2\"}]', '[{\"related\":\"1\"},{\"related\":\"2\"},{\"related\":\"3\"}]', 140, '<p style=\"text-align: center;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In interdum scelerisque tortor. Praesent id ullamcorper tellus. Quisque elementum tellus non tempor ultrices. Nam dictum lectus non arcu imperdiet, ultricies elementum tellus eleifend. Nullam nisl diam, tincidunt vel lacus nec, consequat pretium diam. Sed quis eros metus. Integer accumsan ut nunc vel lacinia. Phasellus tempus augue rutrum egestas posuere. Sed vel hendrerit felis, in condimentum nisl. In id tincidunt orci, vitae malesuada mauris. Integer sem quam, consectetur eu sem porta, aliquam vestibulum nibh. Nulla ut elit at nunc imperdiet malesuada eget ut urna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras auctor rhoncus nulla a eleifend. Morbi viverra, ex nec venenatis cursus, sem urna sodales enim, id sodales dui erat in diam. Vivamus posuere faucibus sagittis.</p>\r\n\r\n<p style=\"text-align: center;\">Sed a pulvinar sem, non varius nisi. Morbi nunc leo, luctus non volutpat id, pharetra id massa. Quisque non purus nisl. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam rutrum est tortor, non lobortis ex tincidunt non. Sed est dolor, aliquet eu arcu ac, consectetur convallis mauris. Proin imperdiet eget justo sed rhoncus. Mauris volutpat rhoncus mi in vestibulum. Praesent posuere erat ut ipsum porta suscipit.</p>\r\n\r\n<h1 style=\"text-align: center;\">Vivamus nec hendrerit metus. Donec accumsan orci sit amet elit molestie mattis. Quisque in rutrum nisl,</h1>\r\n\r\n<p style=\"text-align: center;\">Vivamus nec hendrerit metus. Donec accumsan orci sit amet elit molestie mattis. Quisque in rutrum nisl, ut tincidunt metus. Nulla facilisi. Vestibulum tempor commodo diam, nec imperdiet justo lacinia vitae. Donec fringilla nisl sit amet mauris dapibus, vel venenatis ante aliquam. Integer id ex fringilla lacus vehicula lobortis at posuere elit. Suspendisse potenti. Proin vulputate, velit vel cursus rutrum, metus magna sodales leo, non accumsan mauris purus quis urna. Sed imperdiet suscipit dui, id tempus metus laoreet et. Cras nulla elit, viverra ac faucibus porttitor, aliquam in augue. Nunc at luctus dolor. Cras ipsum elit, facilisis in urna vitae, elementum euismod augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum euismod mattis nisl, in molestie odio aliquam nec.</p>\r\n\r\n<p style=\"text-align: center;\">[img=141][/img]</p>\r\n\r\n<p style=\"text-align: center;\">Sed ac ex diam. Donec consequat molestie euismod. Curabitur tempus, ligula at tincidunt varius, massa nulla gravida odio, vitae laoreet metus felis sit amet urna. Phasellus volutpat tortor quis consectetur viverra. Aliquam erat volutpat. Mauris vel rutrum massa. In pharetra libero accumsan odio pulvinar, eget vulputate mi ultricies. Mauris feugiat cursus maximus. Sed blandit dui vitae nisl ornare, ornare fermentum urna ultricies. Duis sit amet porta mauris. Nunc rutrum venenatis blandit.</p>\r\n\r\n<p style=\"text-align: center;\">Donec viverra nisl lacus, elementum lacinia magna pellentesque posuere. Integer eleifend facilisis pellentesque. Proin laoreet tortor risus. Aliquam dapibus diam non ultrices volutpat. Suspendisse congue erat enim, non dictum neque pulvinar eget. Curabitur sit amet aliquet sem. Quisque tristique, dui non luctus tempus, nibh nunc laoreet lorem, quis fringilla ex massa et augue.</p>\r\n\r\n<p> </p>', 0, 0, 0, 1, '0', '2020-02-09 15:52:05'),
(4, 'es', 'It S Hurricane Season But We Are Visiting Hilton Head Island', 'Integer sem quam, consectetur eu sem porta, aliquam vestibulum nibh. Nulla ut elit at nunc imperdiet malesuada eget ut urna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras auctor rhoncus nulla a eleifend. Morbi viverra, ex nec venenatis cursus, sem urna sodales enim.', '[{\"category\":\"1\"},{\"category\":\"2\"}]', '[{\"related\":\"1\"},{\"related\":\"2\"},{\"related\":\"3\"}]', 140, '<p style=\"text-align: center;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In interdum scelerisque tortor. Praesent id ullamcorper tellus. Quisque elementum tellus non tempor ultrices. Nam dictum lectus non arcu imperdiet, ultricies elementum tellus eleifend. Nullam nisl diam, tincidunt vel lacus nec, consequat pretium diam. Sed quis eros metus. Integer accumsan ut nunc vel lacinia. Phasellus tempus augue rutrum egestas posuere. Sed vel hendrerit felis, in condimentum nisl. In id tincidunt orci, vitae malesuada mauris. Integer sem quam, consectetur eu sem porta, aliquam vestibulum nibh. Nulla ut elit at nunc imperdiet malesuada eget ut urna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras auctor rhoncus nulla a eleifend. Morbi viverra, ex nec venenatis cursus, sem urna sodales enim, id sodales dui erat in diam. Vivamus posuere faucibus sagittis.</p>\r\n\r\n<p style=\"text-align: center;\">Sed a pulvinar sem, non varius nisi. Morbi nunc leo, luctus non volutpat id, pharetra id massa. Quisque non purus nisl. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam rutrum est tortor, non lobortis ex tincidunt non. Sed est dolor, aliquet eu arcu ac, consectetur convallis mauris. Proin imperdiet eget justo sed rhoncus. Mauris volutpat rhoncus mi in vestibulum. Praesent posuere erat ut ipsum porta suscipit.</p>\r\n\r\n<h1 style=\"text-align: center;\">Vivamus nec hendrerit metus. Donec accumsan orci sit amet elit molestie mattis. Quisque in rutrum nisl,</h1>\r\n\r\n<p style=\"text-align: center;\">Vivamus nec hendrerit metus. Donec accumsan orci sit amet elit molestie mattis. Quisque in rutrum nisl, ut tincidunt metus. Nulla facilisi. Vestibulum tempor commodo diam, nec imperdiet justo lacinia vitae. Donec fringilla nisl sit amet mauris dapibus, vel venenatis ante aliquam. Integer id ex fringilla lacus vehicula lobortis at posuere elit. Suspendisse potenti. Proin vulputate, velit vel cursus rutrum, metus magna sodales leo, non accumsan mauris purus quis urna. Sed imperdiet suscipit dui, id tempus metus laoreet et. Cras nulla elit, viverra ac faucibus porttitor, aliquam in augue. Nunc at luctus dolor. Cras ipsum elit, facilisis in urna vitae, elementum euismod augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum euismod mattis nisl, in molestie odio aliquam nec.</p>\r\n\r\n<p style=\"text-align: center;\">[img=141][/img]</p>\r\n\r\n<p style=\"text-align: center;\">Sed ac ex diam. Donec consequat molestie euismod. Curabitur tempus, ligula at tincidunt varius, massa nulla gravida odio, vitae laoreet metus felis sit amet urna. Phasellus volutpat tortor quis consectetur viverra. Aliquam erat volutpat. Mauris vel rutrum massa. In pharetra libero accumsan odio pulvinar, eget vulputate mi ultricies. Mauris feugiat cursus maximus. Sed blandit dui vitae nisl ornare, ornare fermentum urna ultricies. Duis sit amet porta mauris. Nunc rutrum venenatis blandit.</p>\r\n\r\n<p style=\"text-align: center;\">Donec viverra nisl lacus, elementum lacinia magna pellentesque posuere. Integer eleifend facilisis pellentesque. Proin laoreet tortor risus. Aliquam dapibus diam non ultrices volutpat. Suspendisse congue erat enim, non dictum neque pulvinar eget. Curabitur sit amet aliquet sem. Quisque tristique, dui non luctus tempus, nibh nunc laoreet lorem, quis fringilla ex massa et augue.</p>\r\n\r\n<p> </p>', 0, 0, 0, 1, '0', '2020-02-09 15:52:05'),
(5, 'es', 'It S Hurricane Season But We Are Visiting Hilton Head Island', 'Integer sem quam, consectetur eu sem porta, aliquam vestibulum nibh. Nulla ut elit at nunc imperdiet malesuada eget ut urna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras auctor rhoncus nulla a eleifend. Morbi viverra, ex nec venenatis cursus, sem urna sodales enim.', '[{\"category\":\"1\"},{\"category\":\"2\"}]', '[{\"related\":\"1\"},{\"related\":\"2\"},{\"related\":\"3\"}]', 140, '<p style=\"text-align: center;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In interdum scelerisque tortor. Praesent id ullamcorper tellus. Quisque elementum tellus non tempor ultrices. Nam dictum lectus non arcu imperdiet, ultricies elementum tellus eleifend. Nullam nisl diam, tincidunt vel lacus nec, consequat pretium diam. Sed quis eros metus. Integer accumsan ut nunc vel lacinia. Phasellus tempus augue rutrum egestas posuere. Sed vel hendrerit felis, in condimentum nisl. In id tincidunt orci, vitae malesuada mauris. Integer sem quam, consectetur eu sem porta, aliquam vestibulum nibh. Nulla ut elit at nunc imperdiet malesuada eget ut urna. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras auctor rhoncus nulla a eleifend. Morbi viverra, ex nec venenatis cursus, sem urna sodales enim, id sodales dui erat in diam. Vivamus posuere faucibus sagittis.</p>\r\n\r\n<p style=\"text-align: center;\">Sed a pulvinar sem, non varius nisi. Morbi nunc leo, luctus non volutpat id, pharetra id massa. Quisque non purus nisl. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam rutrum est tortor, non lobortis ex tincidunt non. Sed est dolor, aliquet eu arcu ac, consectetur convallis mauris. Proin imperdiet eget justo sed rhoncus. Mauris volutpat rhoncus mi in vestibulum. Praesent posuere erat ut ipsum porta suscipit.</p>\r\n\r\n<h1 style=\"text-align: center;\">Vivamus nec hendrerit metus. Donec accumsan orci sit amet elit molestie mattis. Quisque in rutrum nisl,</h1>\r\n\r\n<p style=\"text-align: center;\">Vivamus nec hendrerit metus. Donec accumsan orci sit amet elit molestie mattis. Quisque in rutrum nisl, ut tincidunt metus. Nulla facilisi. Vestibulum tempor commodo diam, nec imperdiet justo lacinia vitae. Donec fringilla nisl sit amet mauris dapibus, vel venenatis ante aliquam. Integer id ex fringilla lacus vehicula lobortis at posuere elit. Suspendisse potenti. Proin vulputate, velit vel cursus rutrum, metus magna sodales leo, non accumsan mauris purus quis urna. Sed imperdiet suscipit dui, id tempus metus laoreet et. Cras nulla elit, viverra ac faucibus porttitor, aliquam in augue. Nunc at luctus dolor. Cras ipsum elit, facilisis in urna vitae, elementum euismod augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vestibulum euismod mattis nisl, in molestie odio aliquam nec.</p>\r\n\r\n<p style=\"text-align: center;\">[img=141][/img]</p>\r\n\r\n<p style=\"text-align: center;\">Sed ac ex diam. Donec consequat molestie euismod. Curabitur tempus, ligula at tincidunt varius, massa nulla gravida odio, vitae laoreet metus felis sit amet urna. Phasellus volutpat tortor quis consectetur viverra. Aliquam erat volutpat. Mauris vel rutrum massa. In pharetra libero accumsan odio pulvinar, eget vulputate mi ultricies. Mauris feugiat cursus maximus. Sed blandit dui vitae nisl ornare, ornare fermentum urna ultricies. Duis sit amet porta mauris. Nunc rutrum venenatis blandit.</p>\r\n\r\n<p style=\"text-align: center;\">Donec viverra nisl lacus, elementum lacinia magna pellentesque posuere. Integer eleifend facilisis pellentesque. Proin laoreet tortor risus. Aliquam dapibus diam non ultrices volutpat. Suspendisse congue erat enim, non dictum neque pulvinar eget. Curabitur sit amet aliquet sem. Quisque tristique, dui non luctus tempus, nibh nunc laoreet lorem, quis fringilla ex massa et augue.</p>\r\n\r\n<p> </p>', 0, 0, 0, 1, '0', '2020-02-09 15:52:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blog_category`
--

CREATE TABLE `blog_category` (
  `id_category` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL COMMENT 'Categoría',
  `num` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `lang` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `blog_category`
--

INSERT INTO `blog_category` (`id_category`, `title`, `num`, `active`, `lang`) VALUES
(1, 'Categoría 1', 0, 1, 'es'),
(2, 'Categoría 2', 0, 1, 'es'),
(3, 'Categoría 3', 2, 1, ''),
(4, 'Categoría 4', 0, 1, ''),
(5, 'Categoría 5', 0, 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contact`
--

CREATE TABLE `contact` (
  `id_contact` int(10) UNSIGNED NOT NULL COMMENT 'ID',
  `first_name` varchar(255) DEFAULT NULL COMMENT 'Nombre',
  `last_name` varchar(255) DEFAULT NULL COMMENT 'Apellido',
  `mail` varchar(255) DEFAULT NULL COMMENT 'Mail',
  `phone` varchar(255) DEFAULT NULL COMMENT 'Teléfono',
  `text` text COMMENT 'Comentarios'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contents`
--

CREATE TABLE `contents` (
  `var` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contents`
--

INSERT INTO `contents` (`var`, `data`, `created`) VALUES
('about-call-to-action-btn_es', 'Ver espacios', '0000-00-00 00:00:00'),
('about-call-to-action-title_es', 'Estamos reinventando el futuro del retail. No importa donde tengas tu sede, con Kool siempre tienes a tu disposici&oacute;n un showroom, una red de partners y un espacio formativo en el pleno centro de Madrid.', '0000-00-00 00:00:00'),
('about-circle-images-and-texts-text-1_es', 'Conexi&oacute;n a un ecosistema din&aacute;mico de innovaci&oacute;n<br />\nEstar actualizado de las &uacute;ltimas tendencias del retail<br />\nAcceso a las soluciones tecnol&oacute;gicas m&aacute;s punteras<br />\nFormaciones a medida con nuestro pool de expertos', '0000-00-00 00:00:00'),
('about-circle-images-and-texts-text-2_es', 'Aumentar tu red de contactos y crear sinergias profesionales<br />\nExponer tus soluciones y productos para retail<br />\nPotenciar la visibilidad de tu negocio en el mercado<br />\nReducir costes de alquiler en espacios expositivos', '0000-00-00 00:00:00'),
('about-circle-images-and-texts-text-3_es', 'Investigar y desarrollar nuevos productos y servicios<br />\nAcceso a contenidos de valor y a los mejores expertos<br />\nGenerar un v&iacute;nculo directo con retailers y empresas<br />\nSacar todo el partido a nuestro espacio de coworking', '0000-00-00 00:00:00'),
('about-circle-images-and-texts-title-1_es', 'Marcas', '0000-00-00 00:00:00'),
('about-circle-images-and-texts-title-2_es', 'Empresas', '0000-00-00 00:00:00'),
('about-circle-images-and-texts-title-3_es', 'Talentos', '0000-00-00 00:00:00'),
('about-circle-images-and-texts-title_es', '&iquest;Qu&eacute; beneficios obtienes en Kool?', '0000-00-00 00:00:00'),
('about-intro-contentDescription_es', 'Nuestra comunidad es puro talento y pasi&oacute;n por el retail. Est&aacute; formada por grandes marcas, startups, emprendedores y profesionales independientes. La diversidad de nuestros miembros permite crear conexiones de valor y extraer todo tu potencial.', '0000-00-00 00:00:00'),
('about-intro-contentTitle_es', '&iquest;Qui&eacute;nes forman parte de nuestra comunidad?', '0000-00-00 00:00:00'),
('about-intro-subtitle_es', 'COMUNIDAD', '0000-00-00 00:00:00'),
('about-intro-title_es', 'Be Kool', '0000-00-00 00:00:00'),
('about-textBlock2-description_es', 'Las tiendas se est&aacute;n reinventando para ofrecer mucho m&aacute;s que productos: necesitan ofrecer experiencias. Nosotros hemos perfeccionado los conceptos de <strong>showroom</strong> y de <strong>coworking</strong> para ponerlos al servicio de la cultura comercial de vanguardia. Hemos fusionado espacios expositivos, &aacute;reas de trabajo y un centro de formaci&oacute;n en un &uacute;nico lugar. Co-creamos experiencias de shopping para hacer destacar en el mercado a las marcas que trabajan con nosotros. Somos un hub colaborativo de innovaci&oacute;n.', '0000-00-00 00:00:00'),
('about-textBlock2-title_es', 'Kool nace para crear un ecosistema innovador y colaborativo en torno al mundo del retail.', '0000-00-00 00:00:00'),
('about-textBlock3-description_es', 'Forma parte de un entorno aut&eacute;ntico en el que conectar con las personas adecuadas. Kool es una <strong>comunidad diversa y global</strong> en la que tendr&aacute;s acceso a todo lo necesario para dar una mayor visibilidad a tus productos y servicios orientados al retail. Mantente al d&iacute;a de las &uacute;ltimas tendencias, insp&iacute;rate, participa en formaciones hechas a medida y testea tus productos en nuestro showroom. Todo ello reduciendo costes. Ya no tendr&aacute;s que buscar un nuevo espacio cada vez que necesites exponer o recibir a tus clientes en Madrid.', '0000-00-00 00:00:00'),
('about-textBlock3-title_es', 'Queremos facilitar la gesti&oacute;n de los puntos de venta, ayudar a encontrar soluciones innovadoras y los mejores partners.', '0000-00-00 00:00:00'),
('block-contact-title_es', 'D&eacute;janos tus datos y nuestro equipo te contactar&aacute; en breve.', '0000-00-00 00:00:00'),
('blog-intro-contentDescription_es', 'Mantente al d&iacute;a de todas las novedades Kool, eventos y noticias m&aacute;s destacadas del mundo del retail.', '0000-00-00 00:00:00'),
('blog-intro-contentTitle_es', '', '0000-00-00 00:00:00'),
('blog-intro-subtitle_es', 'BLOG', '0000-00-00 00:00:00'),
('blog-intro-title_es', 'Kool news', '0000-00-00 00:00:00'),
('community-info-table-btn_es', 'Hazte miembro de la Komunidad', '0000-00-00 00:00:00'),
('community-intro-contentDescription_es', 'Nuestra comunidad es puro talento y pasi&oacute;n por el retail. Est&aacute; formada por grandes marcas, startups, emprendedores y profesionales independientes. La diversidad de nuestros miembros permite crear conexiones de valor y extraer todo tu potencial.', '0000-00-00 00:00:00'),
('community-intro-contentTitle_es', '&iquest;Qui&eacute;nes forman parte de nuestra comunidad?', '0000-00-00 00:00:00'),
('community-intro-subtitle_es', 'COMUNIDAD', '0000-00-00 00:00:00'),
('community-intro-title_es', 'Be Kool', '0000-00-00 00:00:00'),
('community-itb-1-description_es', 'Agrupamos a las mejores empresas y profesionales del sector retail para generar una red de iniciativas innovadoras y nuevas l&iacute;neas de negocio. En nuestros espacios <strong>podr&aacute;s investigar y desarrollar nuevos modelos</strong> de productos y servicios. Adem&aacute;s, contar&aacute;s con el feedback de otros profesionales del sector. Convi&eacute;rtete en partner de Kool y participa en la co-creaci&oacute;n del futuro del retail.', '0000-00-00 00:00:00'),
('community-itb-1-title_es', 'Dinamiza tu negocio con la innovaci&oacute;n que necesitas', '0000-00-00 00:00:00'),
('community-itb-2-description_es', 'Nuestras instalaciones en pleno centro comercial de Madrid permiten que tu empresa conecte de una forma distinta con tus clientes y partners potenciales. Deja que huelan, vean y prueben los productos con todos los sentidos. <strong>Dise&ntilde;a experiencias de venta creativas</strong> en nuestro showroom, teniendo en cuenta todos los aspectos de gesti&oacute;n, personal, inventario, comunicaci&oacute;n y marketing. &Uacute;salo como escaparate y laboratorio de pruebas.', '0000-00-00 00:00:00'),
('community-itb-2-title_es', 'Crea experiencias &uacute;nicas que sorprendan a tus clientes', '0000-00-00 00:00:00'),
('community-itb-3-btn_es', '&Uacute;nete a nuestra comunidad', '0000-00-00 00:00:00'),
('community-itb-3-description_es', '&middot; Conectarte a un ecosistema din&aacute;mico de emprendimiento<br />\n&middot; Mantenerte al d&iacute;a de las &uacute;ltimas tendencias del retail<br />\n&middot; Tener acceso a la soluciones tecnol&oacute;gicas m&aacute;s punteras<br />\n&middot; Exponer tus soluciones y productos en un entorno &uacute;nico<br />\n&middot; Potenciar la visibilidad de tu marca<br />\n&middot; Investigar y desarrollar nuevos productos y servicios<br />\n&middot; Generar un v&iacute;nculo directo con retailers y empresas.', '0000-00-00 00:00:00'),
('community-itb-3-title_es', '&iquest;Qu&eacute; ventajas te ofrece ser miembro de Kool Hub?', '0000-00-00 00:00:00'),
('community-vertical-gallery-and-text-btn2_es', '&Uacute;nete a la comunidad', '0000-00-00 00:00:00'),
('community-vertical-gallery-and-text-btn_es', '&Uacute;nete a la comunidad', '0000-00-00 00:00:00'),
('community-vertical-gallery-and-text-description2_es', 'Kool es mucho m&aacute;s que un espacio de coworking con mesas y sillas. Adem&aacute;s de todas las ventajas que te ofrecen nuestros espacios expositivos y el acceso a formaciones especializadas, en nuestra oficina compartida podr&aacute;s conectar con otros miembros. Haz networking, da rienda suelta a tu talento y crea sinergias para desarrollar tu carrera profesional. Puedes elegir entre escritorios fijos y flexibles. Tambi&eacute;n contamos con salas de reuniones.', '0000-00-00 00:00:00'),
('community-vertical-gallery-and-text-description_es', 'Crea una experiencia integral para tus clientes aprovechando todas las posibilidades creativas que te ofrece nuestro showroom. Un espacio flexible y polivalente donde exponer tus soluciones, testar nuevas l&iacute;neas de producto y hacer demos con capacidad de seducir. Renueva tu capacidad de sorprender co-creando con otros miembros para montar exposiciones colaborativas. &iquest;Necesitas montar un evento privado? &iexcl;Cuenta con nosotros!<br />\n<br />\nPuedes alquilar nuestro showroom en Madrid siempre que quieras.', '0000-00-00 00:00:00'),
('community-vertical-gallery-and-text-down2_es', 'Descargar plano', '0000-00-00 00:00:00'),
('community-vertical-gallery-and-text-down_es', 'Descargar plano', '0000-00-00 00:00:00'),
('community-vertical-gallery-and-text-title2_es', 'Coworking', '0000-00-00 00:00:00'),
('community-vertical-gallery-and-text-title_es', 'Showroom', '0000-00-00 00:00:00'),
('comunal-spaces-vgat-description2_es', 'Desconecta en los espacios m&aacute;s cool. Contamos con una cantina equipada con microondas, nevera, cafetera y todo lo necesario para comer a tu aire o tomar un caf&eacute; con estilo. Tambi&eacute;n tenemos peque&ntilde;as zonas de descanso para relajarte, descansar y despertar tu creatividad. &iexcl;Aprovecha todos y cada uno de los rincones de nuestro retail hub!', '0000-00-00 00:00:00'),
('comunal-spaces-vgat-title2_es', 'Espacios comunes', '0000-00-00 00:00:00'),
('contact-intro-contentDescription_es', '&iquest;Tienes preguntas sobre nuestro espacio, planes, precios, disponibilidad o algunos de nuestros servicios? No te quedes con las ganas de saber m&aacute;s. Ponte en contacto con nosotros.', '0000-00-00 00:00:00'),
('contact-intro-contentTitle_es', 'Ingrear &iexcl;Ven a conocernos y descubre un mundo de posibilidades!', '0000-00-00 00:00:00'),
('contact-intro-subtitle_es', 'Contacto', '0000-00-00 00:00:00'),
('contact-intro-title_es', 'To be Kool', '0000-00-00 00:00:00'),
('cowork-members-btn_es', 'Forma parte', '0000-00-00 00:00:00'),
('cowork-members-text_es', 'Conoce al equipo que est&aacute; detr&aacute;s de Kool, esforz&aacute;ndose al m&aacute;ximo cada d&iacute;a para cazar las &uacute;ltimas tendencias, facilitar conexiones y dar vida a nuevas ideas. Ellos son los que est&aacute;n detr&aacute;s de todas esas peque&ntilde;as cosas que facilitan tu d&iacute;a a d&iacute;a en nuestro espacio.', '0000-00-00 00:00:00'),
('cowork-members-title_es', 'Cowork Members', '0000-00-00 00:00:00'),
('home-bloc-text-btn_es', 'M&aacute;s info', '0000-00-00 00:00:00'),
('home-bloc-text-text_es', '<strong>Kool</strong> es la <strong>comunidad que re&uacute;ne marcas, empresas y los mejores profesionales del retail</strong> para <strong>impulsar</strong> conexiones, <strong>crear </strong>colaboraciones y <strong>generar oportunidades</strong> comerciales.', '0000-00-00 00:00:00'),
('home-call-to-action-btn_es', 'Solicitar informaci&oacute;n', '0000-00-00 00:00:00'),
('home-call-to-action-title_es', '&iquest;Quieres formar parte de Kool?', '0000-00-00 00:00:00'),
('home-carousel-title_es', 'Nuestro Partners', '0000-00-00 00:00:00'),
('home-grid-box-text-1_es', 'Nuestra comunidad est&aacute; 100% especializada en el sector retail.', '0000-00-00 00:00:00'),
('home-grid-box-text-2_es', 'Espacio polivalente donde puedes testar tus soluciones de producto.', '0000-00-00 00:00:00'),
('home-grid-box-text-3_es', 'Dinamizamos conexiones efectivas entre los miembros y usuarios.', '0000-00-00 00:00:00'),
('home-grid-box-text-4_es', 'Recreamos experiencias de compra en un escenario real.', '0000-00-00 00:00:00'),
('home-grid-box-text-5_en', 'Ingrear texto', '0000-00-00 00:00:00'),
('home-grid-box-text-5_es', 'Organizamos charlas y workshops con expertos del sector retail.', '0000-00-00 00:00:00'),
('home-grid-box-text-6_en', 'Ingrear texto', '0000-00-00 00:00:00'),
('home-grid-box-text-6_es', 'Estar&aacute;s siempre actualizado sobre las &uacute;ltimas tendencias.', '0000-00-00 00:00:00'),
('home-grid-box-title-1_es', 'We love Retail', '0000-00-00 00:00:00'),
('home-grid-box-title-2_es', 'Showroom Colaborativo', '0000-00-00 00:00:00'),
('home-grid-box-title-3_es', 'Facilitamos Sinergias', '0000-00-00 00:00:00'),
('home-grid-box-title-4_es', 'Shopping Experience', '0000-00-00 00:00:00'),
('home-grid-box-title-5_es', 'Formaci&oacute;n Continua', '0000-00-00 00:00:00'),
('home-grid-box-title-6_es', 'Latest Trends', '0000-00-00 00:00:00'),
('home-grid-boxes-title_es', '&iquest;Qu&eacute; nos hace &uacute;nicos?', '0000-00-00 00:00:00'),
('home-new-grid-btn_es', 'Ver espacios', '0000-00-00 00:00:00'),
('home-news-grid-text_es', 'Mantente al d&iacute;a de todas las novedades Kool, eventos y noticias m&aacute;s destacadas del mundo del retail.', '0000-00-00 00:00:00'),
('home-news-grid-title_es', 'Kool News', '0000-00-00 00:00:00'),
('home-presentation-btn_en', 'Come meet us', '0000-00-00 00:00:00'),
('home-presentation-btn_es', 'Ven a conocernos', '0000-00-00 00:00:00'),
('home-presentation-subtitle_en', 'Kool is a unique, innovative and creative collaborative space, completely focused on retail.', '0000-00-00 00:00:00'),
('home-presentation-subtitle_es', 'Kool es un espacio colaborativo &uacute;nico, innovador y creativo, completamente enfocado al retail.', '0000-00-00 00:00:00'),
('home-presentation-title_', 'Kool<br />\nThe first retail hub in Spain', '0000-00-00 00:00:00'),
('home-presentation-title_en', 'Kool<br />\nThe first retail hub in Spain', '0000-00-00 00:00:00'),
('home-presentation-title_es', 'Kool<br />\nEl primer retail hub de Espa&ntilde;a', '0000-00-00 00:00:00'),
('home-text-and-grid-btn_es', 'Conoce a nuestros miembros', '0000-00-00 00:00:00'),
('home-text-and-grid-text_es', 'Nuestra comunidad es puro talento. Est&aacute; formada por expertos en grandes marcas, startups, empresas y profesionales independientes vinculados al sector del retail. &Uacute;nete a una potente red de partners para crear los productos y soluciones expositivas del futuro. La revoluci&oacute;n del retail ya se ha puesto en marcha.', '0000-00-00 00:00:00'),
('home-text-and-grid-title_es', 'Kool Members', '0000-00-00 00:00:00'),
('instagram_es', 'thekoolhub', '0000-00-00 00:00:00'),
('kool-lounge-vgat-btn2_es', 'Solicita una visita', '0000-00-00 00:00:00'),
('kool-lounge-vgat-description2_es', 'Nuestro lounge es una sala de reuniones con capacidad para hasta 14 personas. Est&aacute; dise&ntilde;ada para que puedas reunirte con tus clientes y partners de una forma fresca y din&aacute;mica. Exprime todas sus posibilidades creando eventos privados, comidas de empresa, sesiones de brainstorming y presentaciones. Todos nuestros miembros y coworkers tienen acceso al lounge. Si a&uacute;n no formas parte de nuestra comunidad, pero quieres alquilarla, &nbsp;cont&aacute;ctanos.', '0000-00-00 00:00:00'),
('kool-lounge-vgat-down2_es', 'Descargar plano', '0000-00-00 00:00:00'),
('kool-lounge-vgat-title2_es', 'Kool lounge', '0000-00-00 00:00:00'),
('map-location-address_es', 'Calle de Silva 14, bajos<br />\n28004 - Madrid', '0000-00-00 00:00:00'),
('map-location-text_es', 'Nuestro retail hub est&aacute; en Callao, en el epicentro comercial de Madrid.', '0000-00-00 00:00:00'),
('phone_es', '+34 111 222 333', '0000-00-00 00:00:00'),
('plan-tarrifs-title_es', 'Tarifas Cowork', '0000-00-00 00:00:00'),
('plan-tarrifsbox1-btn_es', 'Forma parte de la Komunidad', '0000-00-00 00:00:00'),
('plan-tarrifsbox1-text2_es', 'A partir de', '0000-00-00 00:00:00'),
('plan-tarrifsbox1-text3_es', '180,00&euro;&nbsp;', '0000-00-00 00:00:00'),
('plan-tarrifsbox1-text_es', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sodales mauris.', '0000-00-00 00:00:00'),
('plan-tarrifsbox1-title_es', 'Flex', '0000-00-00 00:00:00'),
('skool-grid-box-text-1_es', 'Descubre las &uacute;ltimas tendencias, aprende a detectar estilos emergentes y &uacute;salos en el desarrollo de nuevos productos y en tu estrategia de comunicaci&oacute;n.', '0000-00-00 00:00:00'),
('skool-grid-box-text-2_es', 'Saca el m&aacute;ximo partido a nuestras formaciones presenciales, donde podr&aacute;s conocer personalmente a los facilitadores y crear conexiones con otros profesionales.', '0000-00-00 00:00:00'),
('skool-grid-box-text-3_es', 'Amplia tus conocimientos accediendo c&oacute;modamente, desde cualquier lugar y con total flexibilidad a contenidos de valor que puedas aplicar en el mundo real.', '0000-00-00 00:00:00'),
('skool-grid-box-title-1_es', 'Coolhunting tours', '0000-00-00 00:00:00'),
('skool-grid-box-title-2_es', '&nbsp;Cursos presenciales', '0000-00-00 00:00:00'),
('skool-grid-box-title-3_es', '&nbsp;Cursos online', '0000-00-00 00:00:00'),
('skool-grid-boxes-title_es', '&iquest;Qu&eacute; tipos de formaciones te ofrecemos?', '0000-00-00 00:00:00'),
('skool-intro-contentDescription_es', 'Nos hemos propuesto que sigas creciendo de forma continua tanto en el &aacute;mbito profesional como en el personal. Dise&ntilde;amos nuestras formaciones para cubrir todos los aspectos y conocimientos que necesitas manejar en el sector del retail. &iexcl;T&uacute; tambi&eacute;n tienes mucho que aportar!', '0000-00-00 00:00:00'),
('skool-intro-contentTitle_es', 'Be cool in our school!', '0000-00-00 00:00:00'),
('skool-intro-subtitle_es', 'ESCUELA', '0000-00-00 00:00:00'),
('skool-intro-title_es', 'Skool', '0000-00-00 00:00:00'),
('skool-textBlock1-description_es', 'En nuestra escuela podr&aacute;s desarrollar tu potencial y conectar con el talento emergente gracias a los programas especializados en retail. Te ofrecemos cursos, talleres y c&aacute;psulas de conocimiento para empresas en diferentes formatos. Tambi&eacute;n organizamos workshop y <strong>formaciones a medida</strong>. Si necesitas que dise&ntilde;emos algo espec&iacute;fico para tu equipo, no dudes en contactarnos.', '0000-00-00 00:00:00'),
('skool-textBlock1-title_es', '&iquest;Quieres aprender algo nuevo?', '0000-00-00 00:00:00'),
('skool-textBlock2-description_es', 'Queremos que lo que aprendas en la Skool te aporte valor y te resulte &uacute;til para desarrollar tu negocio. &Uacute;til de verdad. Nos gusta el lado pr&aacute;ctico de la vida. Por eso nuestro espacio formativo est&aacute; equipado como una tienda. As&iacute;, adem&aacute;s de ver la teor&iacute;a, tambi&eacute;n podemos experimentar con el <strong>visual merchandising</strong> y fomentar otras pr&aacute;cticas que ayuden a captar la atenci&oacute;n de los clientes.', '0000-00-00 00:00:00'),
('skool-textBlock2-title_es', 'Experiencias formativas pr&aacute;cticas', '0000-00-00 00:00:00'),
('skool-textBlock3-description_es', 'Todos los cursos, talleres y conferencias son impartidos por <strong>profesionales en activo</strong> que forman parte de Kool. Aqu&iacute; aprender&aacute;s lo que no te explican en la universidad. Nuestros formadores viven y respiran el retail a diario porque es a lo que se dedican. Todos ellos tienen un background, experiencia y contactos en el sector. La gran otra gran ventaja de nuestra escuela es que contamos con expertos en <strong>&aacute;reas muy diversas</strong> con ganas de compartir sus secretos, por lo que cubrimos un amplio abanico de conocimientos.', '0000-00-00 00:00:00'),
('skool-textBlock3-title_es', 'Aprende de los mejores profesionales', '0000-00-00 00:00:00'),
('skool-textBlock4-description_es', 'Las grandes marcas necesitan innovar constantemente, pero a veces resulta dif&iacute;cil debido a complejos procesos administrativos o a la dificultad para mapear talentos. Nosotros conectamos tu marca con el talento emergente que te aportar&aacute; la frescura que necesitas. Por otro lado, en Kool, las startups, dise&ntilde;adores, comunicadores y estudiantes pueden desarrollar sus nuevos productos y servicios de forma colaborativa. En nuestro espacio tienen acceso a partners potenciales, retailers y grandes empresas.&nbsp;', '0000-00-00 00:00:00'),
('skool-textBlock4-title_es', 'Conecta con otras marcas y profesionales', '0000-00-00 00:00:00'),
('skool-vgat-btn2_es', 'Ap&uacute;ntate a los pr&oacute;ximos eventos', '0000-00-00 00:00:00'),
('skool-vgat-btn_es', 'Descubre m&aacute;s sobre Skool', '0000-00-00 00:00:00'),
('skool-vgat-description2_es', 'Contamos con un espacio de formaci&oacute;n especializado en retail que est&aacute; equipado como si fuera una tienda. En &eacute;l, te ofrecemos cursos y workshops a medida, c&aacute;psulas de conocimiento, shopping tours, formaciones pr&aacute;cticas de visual merchandising y mucho m&aacute;s. Todos los programas formativos los imparten expertos en diferentes &aacute;reas del sector y los propios miembros y coworkers de Kool. Queremos contribuir a que alcances tu m&aacute;ximo potencial compartiendo conocimientos.', '0000-00-00 00:00:00'),
('skool-vgat-down2_es', 'Ingrear texto', '0000-00-00 00:00:00'),
('skool-vgat-title2_es', 'Skool', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `info`
--

CREATE TABLE `info` (
  `var` varchar(255) NOT NULL COMMENT 'Variable',
  `data` text NOT NULL COMMENT 'data'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `info`
--

INSERT INTO `info` (`var`, `data`) VALUES
('home-news_es', '{\"related\":[{\"related\":\"1\"},{\"related\":\"4\"},{\"related\":\"2\"}]}'),
('partners-carousel_es', '{\"id_gallery_1\":8,\"id_gallery_1-items\":\"122,123,124\"}'),
('community-itb-1_es', '{\"id_file\":\"125\"}'),
('community-itb-2_es', '{\"id_file\":\"126\"}'),
('community-itb-3_es', '{\"id_file\":\"127\"}'),
('seo_skool_es', '{\"id_file\":\"\"}'),
('sool-textBlock2_es', '{\"id_file\":\"129\"}'),
('sool-textBlock3_es', '{\"id_file\":\"130\"}'),
('seo_about_es', '{\"id_file\":\"\"}'),
('about-imt-1_es', '{\"id_file\":\"133\"}'),
('about-imt-2_es', '{\"id_file\":\"134\"}'),
('about-green-membes_es', '{\"id_file\":\"139\"}'),
('block-contact_es', '{\"id_file\":\"111\"}'),
('translations_es', '{\"data\":[{\"original\":\"asd\",\"replace\":\"\"}]}'),
('seo_home_es', '{\"seo_title\":\"Kool\",\"seo_description\":\"Kool es un espacio colaborativo \\u00fanico, innovador y creativo, completamente enfocado al retail.\",\"id_file_main\":\"\"}'),
('seo_community_es', '{\"seo_title\":\"Be Kool\",\"seo_description\":\"\",\"id_file_main\":\"\"}'),
('home-1_es', '{\"id_file\":\"121\"}'),
('kool-lounge-vgat_es', '{\"id_file_down\":\"\",\"id_gallery_1\":5,\"id_gallery_1-items\":\"115,116\"}'),
('skool-vgat_es', '{\"id_file_down\":\"\",\"id_gallery_1\":6,\"id_gallery_1-items\":\"117,118\"}'),
('comunal-spaces-vgat_es', '{\"id_gallery_1\":7,\"id_gallery_1-items\":\"120\"}'),
('coworking_gallery_es', '{\"id_file_down\":\"96\",\"id_gallery_1\":\"3\",\"id_gallery_1-items\":\"109,101,103\"}'),
('showroom-gallery_es', '{\"id_file_down\":\"108\",\"id_gallery_1\":4,\"id_gallery_1-items\":\"105,106,107\"}'),
('table_services2_es', '{\"info_table\":[{\"col1\":\"Servicios\",\"col2\":\"Gold\",\"col3\":\"Silver\"},{\"col1\":\" Acceso 24\\/7 al espacio de coworking\",\"col2\":\":tick:\",\"col3\":\"\"},{\"col1\":\"Escritorio fijo en open space\",\"col2\":\"\",\"col3\":\":tick:\"},{\"col1\":\"Acceso de Lunes a Viernes de 9h a 18h (3 d\\u00edas a la semana)\",\"col2\":\"\",\"col3\":\":tick:\"},{\"col1\":\"Recepci\\u00f3n de correos y paquetes\",\"col2\":\":tick:\",\"col3\":\":tick:\"},{\"col1\":\"Acceso exclusivo a eventos organizados por Kool\",\"col2\":\":tick:\",\"col3\":\":tick:\"},{\"col1\":\"Acceso a la plataforma digital comunitaria \",\"col2\":\":tick:\",\"col3\":\":tick:\"},{\"col1\":\"Sala de reuni\\u00f3n\",\"col2\":\"8 horas al mes\",\"col3\":\"4 horas al mes\"},{\"col1\":\"Community perks\",\"col2\":\":tick:\",\"col3\":\":tick:\"}]}'),
('table_services_es', '{\"info_table\":{\"0\":{\"col1\":\"Servicios\",\"col2\":\"Gold\",\"col3\":\"Silver\"},\"1\":{\"col1\":\" Espacio expositivo exclusivo en el Showroom\",\"col2\":\"10 veces al mes\",\"col3\":\"5 veces al mes\"},\"2\":{\"col1\":\"Brand Awareness en la web y newsletter de Kool\",\"col2\":\":tick:\",\"col3\":\"\"},\"3\":{\"col1\":\"Post patrocinado  y difusi\\u00f3n en redes sociales\",\"col2\":\":tick:\",\"col3\":\":tick:\"},\"4\":{\"col1\":\"Acceso exclusivo a eventos organizados por Kool\",\"col2\":\":tick:\",\"col3\":\":tick:\"},\"6\":{\"col1\":\"Horas gratis en el Showroom para eventos privados\",\"col2\":\"10 horas al a\\u00f1o\",\"col3\":\"\"},\"7\":{\"col1\":\"Acceso a la plataforma digital comunitaria \",\"col2\":\":tick:\",\"col3\":\":tick:\"},\"8\":{\"col1\":\"Horas gratis en el Kool Lounge\",\"col2\":\"10 horas al mes\",\"col3\":\"5 horas al mes\"},\"9\":{\"col1\":\"Escritorio flexible en el espacio de Coworking\",\"col2\":\"5 d\\u00edas al mes\",\"col3\":\"2 d\\u00edas al mes\"},\"10\":{\"col1\":\"Sala de reuni\\u00f3n\",\"col2\":\"10 horas al mes\",\"col3\":\"5 horas al mes\"},\"11\":{\"col1\":\"Community perks\",\"col2\":\":tick:\",\"col3\":\":tick:\"}}}'),
('table_services_en', '{\"info_table\":[{\"col1\":\"prueba ingles\",\"col2\":\" prueba 2\",\"col3\":\"\"}]}'),
('cogs_es', '{\"id_file_favicon1\":\"\",\"id_file_favicon2\":\"\",\"mail\":\"\",\"header_langs\":[{\"lang\":\"es\",\"text\":\"ES\"},{\"lang\":\"en\",\"text\":\"ENG\"}],\"facebook\":\"\",\"twitter\":\"\",\"instagram\":\"\",\"ga\":\"\",\"fbpixel\":\"\",\"mailchimp_key\":\"\",\"mailchimp_list\":\"\"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `info_pages`
--

CREATE TABLE `info_pages` (
  `id_post` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL COMMENT 'Titulo',
  `text` text NOT NULL COMMENT 'Subtitulo',
  `lang` varchar(50) NOT NULL COMMENT 'Idioma',
  `active` tinyint(1) NOT NULL,
  `id_file` bigint(20) DEFAULT NULL,
  `num` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `info_pages`
--

INSERT INTO `info_pages` (`id_post`, `title`, `text`, `lang`, `active`, `id_file`, `num`) VALUES
(1, 'Som', '<main>\n<section>\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vivamus at augue eget arcu dictum varius. Faucibus pulvinar elementum integer enim neque volutpat ac tincidunt. Magna sit amet purus gravida quis blandit turpis cursus. Suspendisse in est ante in nibh. Dui accumsan sit amet nulla facilisi morbi tempus iaculis. Nec ultrices dui sapien eget mi proin sed libero enim. Sagittis id consectetur purus ut faucibus pulvinar elementum integer. Elementum eu facilisis sed odio. Condimentum lacinia quis vel eros donec. Et netus et malesuada fames ac turpis. In arcu cursus euismod quis viverra. Euismod in pellentesque massa placerat duis ultricies. Non blandit massa enim nec dui nunc mattis enim ut. Nunc congue nisi vitae suscipit tellus mauris a diam maecenas.<br />\n </p>\n\n<p>Non enim praesent elementum facilisis leo. Sagittis orci a scelerisque purus semper eget duis. Sagittis nisl rhoncus mattis rhoncus urna neque. Velit ut tortor pretium viverra. A diam maecenas sed enim ut sem viverra aliquet. Pellentesque adipiscing commodo elit at imperdiet dui accumsan sit. Lacus suspendisse faucibus interdum posuere lorem ipsum dolor sit. Egestas pretium aenean pharetra magna ac placerat vestibulum lectus. Nec ullamcorper sit amet risus. Aenean vel elit scelerisque mauris pellentesque pulvinar pellentesque habitant morbi. Elementum facilisis leo vel fringilla est ullamcorper eget nulla facilisi. Velit aliquet sagittis id consectetur purus ut faucibus.<br />\n </p>\n\n<p>Maecenas accumsan lacus vel facilisis volutpat est velit egestas dui. Condimentum vitae sapien pellentesque habitant morbi tristique senectus. Augue ut lectus arcu bibendum at varius vel pharetra. Nulla facilisi nullam vehicula ipsum a arcu cursus. Elementum facilisis leo vel fringilla est ullamcorper eget nulla. Massa sapien faucibus et molestie ac feugiat sed lectus. Neque laoreet suspendisse interdum consectetur libero. Etiam erat velit scelerisque in dictum non. Sit amet commodo nulla facilisi. Sit amet porttitor eget dolor morbi non arcu. Vitae nunc sed velit dignissim sodales ut eu.<br />\n </p>\n\n<p>Bibendum at varius vel pharetra. Congue quisque egestas diam in arcu cursus. Turpis egestas pretium aenean pharetra magna ac placerat vestibulum. Et odio pellentesque diam volutpat commodo. In massa tempor nec feugiat. Diam maecenas sed enim ut sem viverra aliquet eget sit. Morbi non arcu risus quis varius. Consectetur lorem donec massa sapien. Nisl pretium fusce id velit ut. Leo integer malesuada nunc vel risus. Massa sapien faucibus et molestie ac feugiat. Parturient montes nascetur ridiculus mus mauris vitae.<br />\n </p>\n\n<p>Aenean et tortor at risus viverra adipiscing at in. Egestas sed tempus urna et pharetra pharetra massa massa. Urna molestie at elementum eu facilisis sed odio morbi. Lectus nulla at volutpat diam. Est sit amet facilisis magna etiam tempor orci eu. Ac orci phasellus egestas tellus rutrum. Nulla at volutpat diam ut venenatis tellus in metus. Ipsum a arcu cursus vitae congue. Dignissim diam quis enim lobortis scelerisque fermentum dui faucibus in. Arcu felis bibendum ut tristique et egestas quis ipsum. Leo duis ut diam quam. Risus pretium quam vulputate dignissim suspendisse in est ante. Sit amet nulla facilisi morbi tempus. Orci nulla pellentesque dignissim enim sit amet venenatis urna cursus. Dictum non consectetur a erat nam at lectus urna. Aliquet porttitor lacus luctus accumsan tortor posuere ac ut.</p>\n</section>\n</main>', 'ca', 1, NULL, 1),
(2, 'Press Enquiries', '<main>\r\n<section>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vivamus at augue eget arcu dictum varius. Faucibus pulvinar elementum integer enim neque volutpat ac tincidunt. Magna sit amet purus gravida quis blandit turpis cursus. Suspendisse in est ante in nibh. Dui accumsan sit amet nulla facilisi morbi tempus iaculis. Nec ultrices dui sapien eget mi proin sed libero enim. Sagittis id consectetur purus ut faucibus pulvinar elementum integer. Elementum eu facilisis sed odio. Condimentum lacinia quis vel eros donec. Et netus et malesuada fames ac turpis. In arcu cursus euismod quis viverra. Euismod in pellentesque massa placerat duis ultricies. Non blandit massa enim nec dui nunc mattis enim ut. Nunc congue nisi vitae suscipit tellus mauris a diam maecenas.<br />\r\n </p>\r\n\r\n<p>Non enim praesent elementum facilisis leo. Sagittis orci a scelerisque purus semper eget duis. Sagittis nisl rhoncus mattis rhoncus urna neque. Velit ut tortor pretium viverra. A diam maecenas sed enim ut sem viverra aliquet. Pellentesque adipiscing commodo elit at imperdiet dui accumsan sit. Lacus suspendisse faucibus interdum posuere lorem ipsum dolor sit. Egestas pretium aenean pharetra magna ac placerat vestibulum lectus. Nec ullamcorper sit amet risus. Aenean vel elit scelerisque mauris pellentesque pulvinar pellentesque habitant morbi. Elementum facilisis leo vel fringilla est ullamcorper eget nulla facilisi. Velit aliquet sagittis id consectetur purus ut faucibus.<br />\r\n </p>\r\n\r\n<p>Maecenas accumsan lacus vel facilisis volutpat est velit egestas dui. Condimentum vitae sapien pellentesque habitant morbi tristique senectus. Augue ut lectus arcu bibendum at varius vel pharetra. Nulla facilisi nullam vehicula ipsum a arcu cursus. Elementum facilisis leo vel fringilla est ullamcorper eget nulla. Massa sapien faucibus et molestie ac feugiat sed lectus. Neque laoreet suspendisse interdum consectetur libero. Etiam erat velit scelerisque in dictum non. Sit amet commodo nulla facilisi. Sit amet porttitor eget dolor morbi non arcu. Vitae nunc sed velit dignissim sodales ut eu.<br />\r\n </p>\r\n\r\n<p>Bibendum at varius vel pharetra. Congue quisque egestas diam in arcu cursus. Turpis egestas pretium aenean pharetra magna ac placerat vestibulum. Et odio pellentesque diam volutpat commodo. In massa tempor nec feugiat. Diam maecenas sed enim ut sem viverra aliquet eget sit. Morbi non arcu risus quis varius. Consectetur lorem donec massa sapien. Nisl pretium fusce id velit ut. Leo integer malesuada nunc vel risus. Massa sapien faucibus et molestie ac feugiat. Parturient montes nascetur ridiculus mus mauris vitae.<br />\r\n </p>\r\n\r\n<p>Aenean et tortor at risus viverra adipiscing at in. Egestas sed tempus urna et pharetra pharetra massa massa. Urna molestie at elementum eu facilisis sed odio morbi. Lectus nulla at volutpat diam. Est sit amet facilisis magna etiam tempor orci eu. Ac orci phasellus egestas tellus rutrum. Nulla at volutpat diam ut venenatis tellus in metus. Ipsum a arcu cursus vitae congue. Dignissim diam quis enim lobortis scelerisque fermentum dui faucibus in. Arcu felis bibendum ut tristique et egestas quis ipsum. Leo duis ut diam quam. Risus pretium quam vulputate dignissim suspendisse in est ante. Sit amet nulla facilisi morbi tempus. Orci nulla pellentesque dignissim enim sit amet venenatis urna cursus. Dictum non consectetur a erat nam at lectus urna. Aliquet porttitor lacus luctus accumsan tortor posuere ac ut.</p>\r\n</section>\r\n</main>', 'ca', 1, NULL, 2),
(3, 'Privacy Policy', '<main>\r\n<section>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vivamus at augue eget arcu dictum varius. Faucibus pulvinar elementum integer enim neque volutpat ac tincidunt. Magna sit amet purus gravida quis blandit turpis cursus. Suspendisse in est ante in nibh. Dui accumsan sit amet nulla facilisi morbi tempus iaculis. Nec ultrices dui sapien eget mi proin sed libero enim. Sagittis id consectetur purus ut faucibus pulvinar elementum integer. Elementum eu facilisis sed odio. Condimentum lacinia quis vel eros donec. Et netus et malesuada fames ac turpis. In arcu cursus euismod quis viverra. Euismod in pellentesque massa placerat duis ultricies. Non blandit massa enim nec dui nunc mattis enim ut. Nunc congue nisi vitae suscipit tellus mauris a diam maecenas.<br />\r\n </p>\r\n\r\n<p>Non enim praesent elementum facilisis leo. Sagittis orci a scelerisque purus semper eget duis. Sagittis nisl rhoncus mattis rhoncus urna neque. Velit ut tortor pretium viverra. A diam maecenas sed enim ut sem viverra aliquet. Pellentesque adipiscing commodo elit at imperdiet dui accumsan sit. Lacus suspendisse faucibus interdum posuere lorem ipsum dolor sit. Egestas pretium aenean pharetra magna ac placerat vestibulum lectus. Nec ullamcorper sit amet risus. Aenean vel elit scelerisque mauris pellentesque pulvinar pellentesque habitant morbi. Elementum facilisis leo vel fringilla est ullamcorper eget nulla facilisi. Velit aliquet sagittis id consectetur purus ut faucibus.<br />\r\n </p>\r\n\r\n<p>Maecenas accumsan lacus vel facilisis volutpat est velit egestas dui. Condimentum vitae sapien pellentesque habitant morbi tristique senectus. Augue ut lectus arcu bibendum at varius vel pharetra. Nulla facilisi nullam vehicula ipsum a arcu cursus. Elementum facilisis leo vel fringilla est ullamcorper eget nulla. Massa sapien faucibus et molestie ac feugiat sed lectus. Neque laoreet suspendisse interdum consectetur libero. Etiam erat velit scelerisque in dictum non. Sit amet commodo nulla facilisi. Sit amet porttitor eget dolor morbi non arcu. Vitae nunc sed velit dignissim sodales ut eu.<br />\r\n </p>\r\n\r\n<p>Bibendum at varius vel pharetra. Congue quisque egestas diam in arcu cursus. Turpis egestas pretium aenean pharetra magna ac placerat vestibulum. Et odio pellentesque diam volutpat commodo. In massa tempor nec feugiat. Diam maecenas sed enim ut sem viverra aliquet eget sit. Morbi non arcu risus quis varius. Consectetur lorem donec massa sapien. Nisl pretium fusce id velit ut. Leo integer malesuada nunc vel risus. Massa sapien faucibus et molestie ac feugiat. Parturient montes nascetur ridiculus mus mauris vitae.<br />\r\n </p>\r\n\r\n<p>Aenean et tortor at risus viverra adipiscing at in. Egestas sed tempus urna et pharetra pharetra massa massa. Urna molestie at elementum eu facilisis sed odio morbi. Lectus nulla at volutpat diam. Est sit amet facilisis magna etiam tempor orci eu. Ac orci phasellus egestas tellus rutrum. Nulla at volutpat diam ut venenatis tellus in metus. Ipsum a arcu cursus vitae congue. Dignissim diam quis enim lobortis scelerisque fermentum dui faucibus in. Arcu felis bibendum ut tristique et egestas quis ipsum. Leo duis ut diam quam. Risus pretium quam vulputate dignissim suspendisse in est ante. Sit amet nulla facilisi morbi tempus. Orci nulla pellentesque dignissim enim sit amet venenatis urna cursus. Dictum non consectetur a erat nam at lectus urna. Aliquet porttitor lacus luctus accumsan tortor posuere ac ut.</p>\r\n</section>\r\n</main>', 'ca', 1, NULL, 3),
(4, 'Terms and conditions', '<main>\n<section>\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Vivamus at augue eget arcu dictum varius. Faucibus pulvinar elementum integer enim neque volutpat ac tincidunt. Magna sit amet purus gravida quis blandit turpis cursus. Suspendisse in est ante in nibh. Dui accumsan sit amet nulla facilisi morbi tempus iaculis. Nec ultrices dui sapien eget mi proin sed libero enim. Sagittis id consectetur purus ut faucibus pulvinar elementum integer. Elementum eu facilisis sed odio. Condimentum lacinia quis vel eros donec. Et netus et malesuada fames ac turpis. In arcu cursus euismod quis viverra. Euismod in pellentesque massa placerat duis ultricies. Non blandit massa enim nec dui nunc mattis enim ut. Nunc congue nisi vitae suscipit tellus mauris a diam maecenas.<br />\n&nbsp;</p>\n\n<p>Non enim praesent elementum facilisis leo. Sagittis orci a scelerisque purus semper eget duis. Sagittis nisl rhoncus mattis rhoncus urna neque. Velit ut tortor pretium viverra. A diam maecenas sed enim ut sem viverra aliquet. Pellentesque adipiscing commodo elit at imperdiet dui accumsan sit. Lacus suspendisse faucibus interdum posuere lorem ipsum dolor sit. Egestas pretium aenean pharetra magna ac placerat vestibulum lectus. Nec ullamcorper sit amet risus. Aenean vel elit scelerisque mauris pellentesque pulvinar pellentesque habitant morbi. Elementum facilisis leo vel fringilla est ullamcorper eget nulla facilisi. Velit aliquet sagittis id consectetur purus ut faucibus.<br />\n&nbsp;</p>\n\n<p>Maecenas accumsan lacus vel facilisis volutpat est velit egestas dui. Condimentum vitae sapien pellentesque habitant morbi tristique senectus. Augue ut lectus arcu bibendum at varius vel pharetra. Nulla facilisi nullam vehicula ipsum a arcu cursus. Elementum facilisis leo vel fringilla est ullamcorper eget nulla. Massa sapien faucibus et molestie ac feugiat sed lectus. Neque laoreet suspendisse interdum consectetur libero. Etiam erat velit scelerisque in dictum non. Sit amet commodo nulla facilisi. Sit amet porttitor eget dolor morbi non arcu. Vitae nunc sed velit dignissim sodales ut eu.<br />\n&nbsp;</p>\n\n<p>Bibendum at varius vel pharetra. Congue quisque egestas diam in arcu cursus. Turpis egestas pretium aenean pharetra magna ac placerat vestibulum. Et odio pellentesque diam volutpat commodo. In massa tempor nec feugiat. Diam maecenas sed enim ut sem viverra aliquet eget sit. Morbi non arcu risus quis varius. Consectetur lorem donec massa sapien. Nisl pretium fusce id velit ut. Leo integer malesuada nunc vel risus. Massa sapien faucibus et molestie ac feugiat. Parturient montes nascetur ridiculus mus mauris vitae.<br />\n&nbsp;</p>\n\n<p>Aenean et tortor at risus viverra adipiscing at in. Egestas sed tempus urna et pharetra pharetra massa massa. Urna molestie at elementum eu facilisis sed odio morbi. Lectus nulla at volutpat diam. Est sit amet facilisis magna etiam tempor orci eu. Ac orci phasellus egestas tellus rutrum. Nulla at volutpat diam ut venenatis tellus in metus. Ipsum a arcu cursus vitae congue. Dignissim diam quis enim lobortis scelerisque fermentum dui faucibus in. Arcu felis bibendum ut tristique et egestas quis ipsum. Leo duis ut diam quam. Risus pretium quam vulputate dignissim suspendisse in est ante. Sit amet nulla facilisi morbi tempus. Orci nulla pellentesque dignissim enim sit amet venenatis urna cursus. Dictum non consectetur a erat nam at lectus urna. Aliquet porttitor lacus luctus accumsan tortor posuere ac ut.</p>\n</section>\n</main>', 'ca', 1, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `newsletter`
--

CREATE TABLE `newsletter` (
  `id_newsletter` int(10) UNSIGNED NOT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `bussines` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `lang` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `newsletter`
--

INSERT INTO `newsletter` (`id_newsletter`, `active`, `created`, `mail`, `bussines`, `name`, `lang`) VALUES
(1, 1, '2019-12-11 07:26:57', 'luciano@estoesunaprueba.com', 'asd', 'Luciano Prueba', 'Catalán');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nz_company_secure`
--

CREATE TABLE `nz_company_secure` (
  `id_company` mediumint(8) UNSIGNED NOT NULL COMMENT 'Empresa',
  `id_submenu` mediumint(8) UNSIGNED NOT NULL COMMENT 'Item',
  `view` tinyint(1) UNSIGNED NOT NULL COMMENT 'Ver',
  `edit` tinyint(1) UNSIGNED NOT NULL COMMENT 'Editar',
  `delete` tinyint(1) UNSIGNED NOT NULL COMMENT 'Borrar',
  `special` tinyint(1) UNSIGNED NOT NULL COMMENT 'Especial'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nz_company_secure`
--

INSERT INTO `nz_company_secure` (`id_company`, `id_submenu`, `view`, `edit`, `delete`, `special`) VALUES
(1, 7, 1, 1, 1, 1),
(1, 6, 1, 1, 1, 1),
(1, 5, 1, 1, 1, 1),
(1, 4, 1, 1, 1, 1),
(1, 3, 1, 1, 1, 1),
(1, 2, 1, 1, 1, 1),
(1, 1, 1, 1, 1, 1),
(1, 12, 1, 1, 1, 1),
(1, 11, 1, 1, 1, 1),
(1, 13, 1, 1, 1, 1),
(1, 401, 1, 1, 1, 1),
(1, 400, 1, 1, 1, 1),
(1, 8, 1, 1, 1, 1),
(1, 9, 1, 1, 1, 1),
(26, 400, 1, 1, 1, 1),
(26, 402, 1, 1, 1, 1),
(26, 401, 1, 1, 1, 1),
(26, 405, 1, 1, 1, 1),
(26, 407, 1, 1, 1, 1),
(26, 409, 1, 1, 1, 1),
(26, 408, 1, 1, 1, 1),
(26, 403, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nz_file`
--

CREATE TABLE `nz_file` (
  `id_file` bigint(20) UNSIGNED NOT NULL,
  `id_folder` mediumint(8) NOT NULL DEFAULT '0',
  `id_type` tinyint(3) UNSIGNED NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL COMMENT 'Nombre',
  `alt` varchar(255) DEFAULT NULL,
  `id_user` int(10) UNSIGNED DEFAULT NULL COMMENT 'Usuario',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Fecha',
  `deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nz_file`
--

INSERT INTO `nz_file` (`id_file`, `id_folder`, `id_type`, `file`, `name`, `alt`, `id_user`, `date`, `deleted`) VALUES
(1, 6, 1, '2019/12/ejemplo_trabajo_home_01-copia-4.png', 'Ejemplo_trabajo_home_01 copia 4.png', NULL, 1, '2019-12-07 21:53:27', 0),
(2, 6, 1, '2019/12/ejemplo_trabajo_02.png', 'Ejemplo_trabajo_02.png', NULL, 1, '2019-12-07 21:53:48', 0),
(3, 6, 1, '2019/12/ejemplo_trabajo_03.png', 'Ejemplo_trabajo_03.png', NULL, 1, '2019-12-07 21:53:48', 0),
(4, 6, 1, '2019/12/foto_equipo_miriam.jpg', 'foto_equipo_Miriam.jpg', NULL, 1, '2019-12-07 21:53:48', 0),
(5, 6, 1, '2019/12/foto_equipo_patricia.jpg', 'foto_equipo_Patrícia.jpg', NULL, 1, '2019-12-07 21:53:48', 0),
(6, 6, 1, '2019/12/foto_equipo_raquel.jpg', 'foto_equipo_Raquel.jpg', NULL, 1, '2019-12-07 21:53:49', 0),
(7, 6, 1, '2019/12/tamano_portada_trabajo.png', 'tamaño_portada_trabajo.png', NULL, 1, '2019-12-07 21:54:07', 0),
(8, 8, 1, '2019/12/ejemplo_trabajo_home_01-copia-3.png', 'Ejemplo_trabajo_home_01 copia 3.png', NULL, 1, '2019-12-07 22:24:55', 0),
(9, 7, 1, '2019/12/ejemplo_trabajo_02-1.png', 'Ejemplo_trabajo_02.png', NULL, 1, '2019-12-07 22:35:36', 0),
(10, 7, 1, '2019/12/ejemplo_trabajo_03-1.png', 'Ejemplo_trabajo_03.png', NULL, 1, '2019-12-07 22:35:37', 0),
(11, 7, 1, '2019/12/foto_equipo_miriam-1.jpg', 'foto_equipo_Miriam.jpg', NULL, 1, '2019-12-07 22:35:37', 0),
(12, 7, 1, '2019/12/foto_equipo_patricia-1.jpg', 'foto_equipo_Patrícia.jpg', NULL, 1, '2019-12-07 22:35:37', 0),
(13, 7, 1, '2019/12/foto_equipo_raquel-1.jpg', 'foto_equipo_Raquel.jpg', NULL, 1, '2019-12-07 22:35:37', 0),
(14, 8, 1, '2019/12/foto_equipo_miriam-2.jpg', 'foto_equipo_Miriam.jpg', NULL, 1, '2019-12-08 20:43:25', 0),
(15, 8, 1, '2019/12/foto_equipo_miriam-3.jpg', 'foto_equipo_Miriam.jpg', NULL, 1, '2019-12-08 20:43:49', 0),
(16, 8, 1, '2019/12/foto_equipo_miriam-4.jpg', 'foto_equipo_Miriam.jpg', NULL, 1, '2019-12-08 20:55:03', 0),
(17, 8, 1, '2019/12/foto_equipo_patricia-2.jpg', 'foto_equipo_Patrícia.jpg', NULL, 1, '2019-12-08 20:56:37', 0),
(18, 8, 1, '2019/12/foto_equipo_raquel-2.jpg', 'foto_equipo_Raquel.jpg', NULL, 1, '2019-12-08 20:56:52', 0),
(19, 8, 1, '2019/12/ejemplo_trabajo_home_01-copia-5.png', 'Ejemplo_trabajo_home_01 copia 5.png', NULL, 1, '2019-12-09 14:49:50', 0),
(20, 8, 1, '2019/12/logo_facebook_inferior.png', 'Logo_facebook_inferior.png', NULL, 1, '2019-12-11 01:14:57', 0),
(21, 8, 1, '2019/12/foto_equipo_miriam-5.jpg', 'foto_equipo_Miriam.jpg', NULL, 1, '2019-12-11 01:15:08', 0),
(22, 8, 1, '2019/12/ag-7212.jpeg', 'AG-7212.JPEG', NULL, 51, '2019-12-11 09:19:55', 0),
(23, 8, 1, '2019/12/ejemplo_trabajo_home_01-copia-5-1.png', 'Ejemplo_trabajo_home_01 copia 5.png', NULL, 51, '2019-12-13 14:50:40', 0),
(24, 8, 1, '2019/12/kool_servei_01.jpg', 'kool_servei_01.jpg', NULL, 51, '2019-12-13 14:54:56', 0),
(25, 8, 1, '2019/12/kool_servei_brindar.jpg', 'kool_servei_brindar.jpg', NULL, 51, '2019-12-13 14:57:44', 0),
(26, 8, 1, '2019/12/foto_tipo_cupajar.jpg', 'Foto_tipo_cupajar.jpg', NULL, 51, '2019-12-13 14:59:38', 0),
(27, 8, 1, '2019/12/foto_tipo_creaciondecontingut.jpg', 'Foto_tipo_creaciondecontingut.jpg', NULL, 51, '2019-12-13 15:02:30', 0),
(28, 8, 1, '2019/12/kool_servei_estrategia_digital.jpg', 'kool_servei_estrategia_digital.jpg', NULL, 51, '2019-12-13 15:16:46', 0),
(29, 8, 1, '2019/12/kool_servei_creacio_de_marca.jpg', 'kool_servei_creacio_de_marca.jpg', NULL, 51, '2019-12-13 15:18:22', 0),
(30, 8, 1, '2019/12/ejemplo_trabajo_home_01-copia-4-1.png', 'Ejemplo_trabajo_home_01 copia 4.png', NULL, 100, '2019-12-14 18:59:33', 0),
(31, 8, 1, '2019/12/20191216163954_img_2340.jpg', '20191216163954_IMG_2340.JPG', NULL, 103, '2019-12-17 10:06:15', 0),
(32, 8, 1, '2019/12/_o0a6360s.jpg', '_O0A6360s.jpg', NULL, 103, '2019-12-17 10:09:13', 0),
(33, 8, 1, '2019/12/presentacio-vida-051.jpg', 'Presentacio VIDA 051.jpg', NULL, 103, '2019-12-17 10:15:45', 0),
(34, 6, 1, '2019/12/dsc_1796.jpg', 'DSC_1796.jpg', NULL, 51, '2019-12-19 11:54:08', 0),
(35, 6, 1, '2019/12/img_2511.jpg', 'IMG_2511.JPG', NULL, 51, '2019-12-19 15:06:19', 0),
(36, 6, 1, '2019/12/vins-de-pedra_calc-otada_montblanc_125.jpg', 'Vins-de-Pedra_calçotada_Montblanc_125.jpg', NULL, 51, '2019-12-22 19:02:09', 0),
(37, 6, 1, '2019/12/dscf1354.jpg', 'DSCF1354.jpg', NULL, 51, '2019-12-22 19:06:34', 0),
(38, 6, 1, '2019/12/20191003110839_img_6732.jpg', '20191003110839_IMG_6732.JPG', NULL, 51, '2019-12-22 19:11:51', 0),
(39, 6, 1, '2019/12/vins-de-pedra_calc-otada_montblanc.jpg', 'vins-de-pedra_calc-otada_montblanc.jpg', NULL, 51, '2019-12-22 21:06:02', 0),
(40, 7, 1, '2020/01/ejemplo_trabajo_home_01-copia-3.png', 'Ejemplo_trabajo_home_01 copia 3.png', NULL, 100, '2020-01-09 06:54:07', 0),
(41, 7, 1, '2020/01/ejemplo_trabajo_home_01-copia-3-1.png', 'Ejemplo_trabajo_home_01 copia 3.png', NULL, 100, '2020-01-09 07:00:57', 0),
(42, 6, 1, '2020/01/_a1a7352-127.jpg', '_A1A7352-127.jpg', NULL, 51, '2020-01-13 13:51:17', 0),
(43, 6, 1, '2020/01/_a1a7123-58.jpg', '_A1A7123-58.jpg', NULL, 51, '2020-01-13 13:51:33', 0),
(44, 6, 1, '2020/01/_a1a7057-29.jpg', '_A1A7057-29.jpg', NULL, 51, '2020-01-13 13:51:46', 0),
(45, 6, 1, '2020/01/_a1a6979-5.jpg', '_A1A6979-5.jpg', NULL, 51, '2020-01-13 13:52:21', 0),
(46, 8, 1, '2020/01/ew5b9086.jpg', 'EW5B9086.jpg', NULL, 51, '2020-01-13 14:04:07', 0),
(47, 8, 1, '2020/01/ew5b9102.jpg', 'EW5B9102.jpg', NULL, 51, '2020-01-13 14:04:51', 0),
(48, 8, 1, '2020/01/ew5b9065.jpg', 'EW5B9065.jpg', NULL, 51, '2020-01-13 14:06:38', 0),
(49, 8, 1, '2020/01/408_1040.jpg', '408_1040.jpg', NULL, 51, '2020-01-13 14:14:41', 0),
(50, 8, 1, '2020/01/do-emporda.jpg', 'DO Emporda.jpg', NULL, 51, '2020-01-13 16:06:04', 0),
(51, 6, 1, '2020/01/16-10-20agendavinspalaurobert163.jpg', '16.10.20AgendaVinsPalauRobert163.jpg', NULL, 51, '2020-01-13 17:17:52', 0),
(52, 6, 1, '2020/01/16-10-20agendavinspalaurobert164.jpg', '16.10.20AgendaVinsPalauRobert164.jpg', NULL, 51, '2020-01-13 17:17:52', 0),
(53, 7, 1, '2020/01/img_5083.jpg', 'IMG_5083.JPG', NULL, 51, '2020-01-14 11:47:40', 0),
(54, 7, 1, '2020/01/img_5078.jpg', 'IMG_5078.jpg', NULL, 51, '2020-01-14 11:48:55', 0),
(55, 7, 1, '2020/01/img_5084.jpg', 'IMG_5084.jpg', NULL, 51, '2020-01-14 11:50:10', 0),
(56, 7, 1, '2020/01/img_5083-1.jpg', 'IMG_5083.JPG', NULL, 51, '2020-01-14 11:50:56', 0),
(57, 7, 1, '2020/01/20200114124519_img_4016.jpg', '20200114124519_IMG_4016.JPG', NULL, 51, '2020-01-14 11:53:10', 0),
(58, 7, 1, '2020/01/img_5084-1.jpg', 'IMG_5084.jpg', NULL, 51, '2020-01-14 11:54:57', 0),
(59, 7, 1, '2020/01/img_5078-1.jpg', 'IMG_5078.jpg', NULL, 51, '2020-01-14 11:55:31', 0),
(60, 7, 1, '2020/01/20200114124519_img_4016-1.jpg', '20200114124519_IMG_4016.JPG', NULL, 51, '2020-01-14 11:56:16', 0),
(61, 8, 1, '2020/01/img_5084-2.jpg', 'IMG_5084.jpg', NULL, 51, '2020-01-14 11:57:47', 0),
(62, 7, 1, '2020/01/20200114124519_img_4016-2.jpg', '20200114124519_IMG_4016.JPG', NULL, 51, '2020-01-14 12:08:25', 0),
(63, 8, 1, '2020/01/riedel_kool_gilbertbages_031.jpg', 'riedel_kool_gilbertbages_031.JPG', NULL, 51, '2020-01-14 12:10:03', 0),
(64, 6, 1, '2020/01/bouquet-alella-36.jpg', 'BOUQUET ALELLA 36.jpg', NULL, 51, '2020-01-22 14:21:55', 0),
(65, 6, 1, '2020/01/_a1a6979-5-1.jpg', '_A1A6979-5.jpg', NULL, 51, '2020-01-22 14:23:26', 0),
(66, 6, 1, '2020/01/portada.jpg', 'Portada.jpg', NULL, 51, '2020-01-22 14:36:17', 0),
(67, 6, 1, '2020/01/bouquet-alella-36-1.jpg', 'BOUQUET ALELLA 36.jpg', NULL, 51, '2020-01-22 14:36:48', 0),
(68, 6, 1, '2020/01/do-alella_2018-05-26_gilbertbages_472.jpg', 'DO-Alella_2018-05-26_gilbertbages_472.JPG', NULL, 51, '2020-01-22 14:37:20', 0),
(69, 6, 1, '2020/01/do-alella_2018-05-26_gilbertbages_479.jpg', 'DO-Alella_2018-05-26_gilbertbages_479.JPG', NULL, 51, '2020-01-22 14:37:20', 0),
(70, 6, 1, '2020/01/do-alella_2018-05-26_gilbertbages_556-1.jpg', 'DO-Alella_2018-05-26_gilbertbages_556 (1).JPG', NULL, 51, '2020-01-22 14:37:20', 0),
(71, 6, 1, '2020/01/do-alella_2018-05-26_gilbertbages_575.jpg', 'DO-Alella_2018-05-26_gilbertbages_575.JPG', NULL, 51, '2020-01-22 14:38:01', 0),
(72, 6, 1, '2020/01/do-alella_2018-05-26_gilbertbages_577.jpg', 'DO-Alella_2018-05-26_gilbertbages_577.JPG', NULL, 51, '2020-01-22 14:38:01', 0),
(73, 6, 1, '2020/01/dsc_5893.jpg', 'DSC_5893.jpg', NULL, 51, '2020-01-22 14:51:56', 0),
(74, 6, 1, '2020/01/sentitsbarcelona_kool.jpg', 'SentitsBarcelona_kool.jpg', NULL, 51, '2020-01-22 14:57:00', 0),
(75, 6, 1, '2020/01/electrovi_kool.jpg', 'Electrovi_kool.jpg', NULL, 51, '2020-01-22 14:59:57', 0),
(76, 6, 1, '2020/01/sentitsbarcelona_kool_conreria.jpg', 'SentitsBarcelona_kool_Conreria.JPG', NULL, 51, '2020-01-22 15:00:57', 0),
(77, 6, 1, '2020/01/sentitsbarcelona_kool_larioja.jpg', 'SentitsBarcelona_kool_LaRioja.jpg', NULL, 51, '2020-01-22 15:01:36', 0),
(78, 6, 1, '2020/01/sentitsbarcelona_kool_exibis.jpg', 'SentitsBarcelona_kool_Exibis.jpg', NULL, 51, '2020-01-22 15:03:35', 0),
(79, 6, 1, '2020/01/sentitsbarcelona_kool_10e-aniversari.jpg', 'SentitsBarcelona_kool_10èAniversari.jpg', NULL, 51, '2020-01-22 15:06:22', 0),
(80, 6, 1, '2020/01/sentitsbarcelona_montrubi.jpg', 'SentitsBarcelona_Montrubi.jpg', NULL, 51, '2020-01-22 15:28:34', 0),
(81, 6, 1, '2020/01/do-alella_2018-05-26_gilbertbages_479-1.jpg', 'DO-Alella_2018-05-26_gilbertbages_479.JPG', NULL, 51, '2020-01-22 15:29:54', 0),
(82, 6, 1, '2020/01/do-alella_2018-05-26_gilbertbages_556.jpg', 'DO-Alella_2018-05-26_gilbertbages_556.JPG', NULL, 51, '2020-01-22 15:29:54', 0),
(83, 6, 1, '2020/01/do-alella_2018-05-26_gilbertbages_577-1.jpg', 'DO-Alella_2018-05-26_gilbertbages_577.JPG', NULL, 51, '2020-01-22 15:29:55', 0),
(84, 6, 1, '2020/01/do-alella_2018-05-26_gilbertbages_472-1.jpg', 'DO-Alella_2018-05-26_gilbertbages_472.JPG', NULL, 51, '2020-01-22 15:29:55', 0),
(85, 6, 1, '2020/01/do-alella_2018-05-26_gilbertbages_575-1.jpg', 'DO-Alella_2018-05-26_gilbertbages_575.JPG', NULL, 51, '2020-01-22 15:29:56', 0),
(86, 6, 1, '2020/01/vinsdepedra_kool_1.jpg', 'VinsdePedra_kool_1.JPG', NULL, 51, '2020-01-22 16:14:34', 0),
(87, 6, 1, '2020/01/vinsdepedra_kool_4.jpg', 'VinsdePedra_kool_4.jpg', NULL, 51, '2020-01-22 16:14:34', 0),
(88, 6, 1, '2020/01/vinsdepedra_kool_5.jpg', 'VinsdePedra_kool_5.jpg', NULL, 51, '2020-01-22 16:14:36', 0),
(89, 6, 1, '2020/01/vinsdepedra_kool_2.jpg', 'VinsdePedra_kool_2.jpg', NULL, 51, '2020-01-22 16:17:06', 0),
(90, 6, 1, '2020/01/vinsdepedra_kool.jpg', 'VinsdePedra_kool.jpg', NULL, 51, '2020-01-22 16:17:06', 0),
(91, 6, 1, '2020/01/vinsdepedra_kool_7.jpg', 'VinsdePedra_kool_7.jpg', NULL, 51, '2020-01-22 16:26:15', 0),
(92, 6, 1, '2020/01/vinsdepedra_kool_8.jpg', 'VinsdePedra_kool_8.jpg', NULL, 51, '2020-01-22 16:31:23', 0),
(93, 6, 1, '2020/01/vinsdepedra_kool_10.jpg', 'VinsdePedra_kool_10.jpg', NULL, 51, '2020-01-22 16:36:28', 0),
(94, 6, 1, '2020/01/vinsdepedra_kool_11.jpg', 'VinsdePedra_kool_11.jpg', NULL, 51, '2020-01-22 16:36:28', 0),
(95, 7, 1, '2020/02/kool-hub-final-1.png', 'Kool Hub Final-1.png', NULL, 51, '2020-02-08 17:27:58', 0),
(96, 7, 1, '2020/02/kool-hub-final-2.png', 'Kool Hub Final-2.png', NULL, 51, '2020-02-08 17:28:03', 0),
(97, 7, 1, '2020/02/kool-hub-final-02.png', 'Kool Hub Final-02.png', NULL, 51, '2020-02-08 17:28:24', 0),
(98, 7, 1, '2020/02/kool-hub-final-02-1.png', 'Kool Hub Final-02.png', NULL, 51, '2020-02-08 17:28:32', 0),
(99, 7, 1, '2020/02/background-1.png', 'Background-1.png', NULL, 51, '2020-02-08 17:30:01', 0),
(100, 7, 1, '2020/02/kool-hub-final-00.png', 'Kool Hub Final-00.png', NULL, 51, '2020-02-08 17:30:02', 0),
(101, 7, 1, '2020/02/kool-hub-final-02-2.png', 'Kool Hub Final-02.png', NULL, 51, '2020-02-08 17:33:28', 0),
(102, 7, 1, '2020/02/kool-hub-final-2-1.png', 'Kool Hub Final-2.png', NULL, 51, '2020-02-08 17:33:28', 0),
(103, 7, 1, '2020/02/kool-hub-final-01.png', 'Kool Hub Final-01.png', NULL, 51, '2020-02-08 17:33:28', 0),
(104, 7, 1, '2020/02/kool-hub-final-1-1.png', 'Kool Hub Final-1.png', NULL, 51, '2020-02-08 17:33:28', 0),
(105, 7, 1, '2020/02/kool-hub-final-14.png', 'Kool Hub Final-14.png', NULL, 51, '2020-02-08 17:51:01', 0),
(106, 7, 1, '2020/02/kool-hub-final-16.png', 'Kool Hub Final-16.png', NULL, 51, '2020-02-08 17:51:01', 0),
(107, 7, 1, '2020/02/kool-hub-final-17.png', 'Kool Hub Final-17.png', NULL, 51, '2020-02-08 17:51:01', 0),
(108, 7, 1, '2020/02/kool-hub-final-12.png', 'Kool Hub Final-12.png', NULL, 51, '2020-02-08 17:51:06', 0),
(109, 7, 1, '2020/02/kool-hub-final-30.png', 'Kool Hub Final-30.png', NULL, 51, '2020-02-08 17:51:45', 0),
(110, 7, 1, '2020/02/kool-hub-final-2-2.png', 'Kool Hub Final-2.png', NULL, 51, '2020-02-08 19:42:32', 0),
(111, 7, 1, '2020/02/kool-hub-final-07.png', 'Kool Hub Final-07.png', NULL, 51, '2020-02-08 19:46:25', 0),
(112, 7, 1, '2020/02/rectangulo-80.jpg', 'Rectángulo 80.jpg', NULL, 51, '2020-02-09 16:02:51', 0),
(113, 7, 1, '2020/02/kool-hub-final-00.jpg', 'Kool Hub Final-00.jpg', NULL, 51, '2020-02-09 16:03:21', 0),
(114, 7, 1, '2020/02/kool-hub-final-00-1.jpg', 'Kool Hub Final-00.jpg', NULL, 51, '2020-02-09 16:06:34', 0),
(115, 7, 1, '2020/02/kool-hub-final-12.jpg', 'Kool Hub Final-12.jpg', NULL, 51, '2020-02-09 16:19:17', 0),
(116, 7, 1, '2020/02/kool-hub-final-12-1.jpg', 'Kool Hub Final-12.jpg', NULL, 51, '2020-02-09 16:19:23', 0),
(117, 7, 1, '2020/02/kool-hub-final-10.jpg', 'Kool Hub Final-10.jpg', NULL, 51, '2020-02-09 16:20:13', 0),
(118, 7, 1, '2020/02/kool-hub-final-10-1.jpg', 'Kool Hub Final-10.jpg', NULL, 51, '2020-02-09 16:20:15', 0),
(119, 7, 1, '2020/02/kool-hub-final-11.jpg', 'Kool Hub Final-11.jpg', NULL, 51, '2020-02-09 16:28:31', 0),
(120, 7, 1, '2020/02/kool-hub-final-11-1.jpg', 'Kool Hub Final-11.jpg', NULL, 51, '2020-02-09 16:28:49', 0),
(121, 7, 1, '2020/02/kool-hub-final-00-2.jpg', 'Kool Hub Final-00.jpg', NULL, 51, '2020-02-09 17:37:35', 0),
(122, 7, 1, '2020/02/rectangulo-80-1.jpg', 'Rectángulo 80.jpg', NULL, 51, '2020-02-09 17:58:00', 0),
(123, 7, 1, '2020/02/rectangulo-80-2.jpg', 'Rectángulo 80.jpg', NULL, 51, '2020-02-09 17:58:02', 0),
(124, 7, 1, '2020/02/rectangulo-80-3.jpg', 'Rectángulo 80.jpg', NULL, 51, '2020-02-09 17:58:06', 0),
(125, 7, 1, '2020/02/kool-hub-final-02.jpg', 'Kool Hub Final-02.jpg', NULL, 51, '2020-02-09 18:05:14', 0),
(126, 7, 1, '2020/02/kool-hub-final-12-2.jpg', 'Kool Hub Final-12.jpg', NULL, 51, '2020-02-09 18:05:56', 0),
(127, 7, 1, '2020/02/kool-hub-final-1.jpg', 'Kool Hub Final-1.jpg', NULL, 51, '2020-02-09 18:06:07', 0),
(128, 7, 1, '2020/02/kool-hub-final-1-1.jpg', 'Kool Hub Final-1.jpg', NULL, 51, '2020-02-09 18:10:17', 0),
(129, 7, 1, '2020/02/kool-hub-final-1-2.jpg', 'Kool Hub Final-1.jpg', NULL, 51, '2020-02-09 18:11:24', 0),
(130, 7, 1, '2020/02/kool-hub-final-12-3.jpg', 'Kool Hub Final-12.jpg', NULL, 51, '2020-02-09 18:11:36', 0),
(131, 7, 1, '2020/02/kool-hub-final-02-1.jpg', 'Kool Hub Final-02.jpg', NULL, 51, '2020-02-09 18:33:59', 0),
(132, 7, 1, '2020/02/kool-hub-final-1-3.jpg', 'Kool Hub Final-1.jpg', NULL, 51, '2020-02-09 18:34:11', 0),
(133, 7, 1, '2020/02/kool-hub-final-1-4.jpg', 'Kool Hub Final-1.jpg', NULL, 51, '2020-02-09 18:36:28', 0),
(134, 7, 1, '2020/02/kool-hub-final-11-2.jpg', 'Kool Hub Final-11.jpg', NULL, 51, '2020-02-09 18:36:38', 0),
(135, 7, 1, '2020/02/kool-hub-final-00-3.jpg', 'Kool Hub Final-00.jpg', NULL, 51, '2020-02-09 18:42:37', 0),
(136, 7, 1, '2020/02/kool-hub-final-00-4.jpg', 'Kool Hub Final-00.jpg', NULL, 51, '2020-02-09 18:42:39', 0),
(137, 7, 1, '2020/02/kool-hub-final-00-5.jpg', 'Kool Hub Final-00.jpg', NULL, 51, '2020-02-09 18:42:42', 0),
(138, 7, 1, '2020/02/kool-hub-final-10-2.jpg', 'Kool Hub Final-10.jpg', NULL, 51, '2020-02-09 18:44:46', 0),
(139, 7, 1, '2020/02/image1_1441_1x.jpg', 'image1_1441_1x.jpg', NULL, 51, '2020-02-09 18:46:48', 0),
(140, 6, 1, '2020/02/kool-hub-final-00-6.jpg', 'Kool Hub Final-00.jpg', NULL, 51, '2020-02-09 18:52:35', 0),
(141, 6, 1, '2020/02/kool-hub-final-11-3.jpg', 'Kool Hub Final-11.jpg', NULL, 51, '2020-02-09 18:53:21', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nz_folder`
--

CREATE TABLE `nz_folder` (
  `id_folder` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `id_parent` mediumint(8) NOT NULL DEFAULT '0',
  `id_type` tinyint(3) UNSIGNED NOT NULL DEFAULT '2',
  `id_user` mediumint(8) UNSIGNED DEFAULT NULL,
  `deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nz_folder`
--

INSERT INTO `nz_folder` (`id_folder`, `name`, `id_parent`, `id_type`, `id_user`, `deleted`) VALUES
(1, 'Registro', 0, 1, NULL, 0),
(2, 'Registro', 1, 1, NULL, 0),
(3, 'Artículos', 0, 1, NULL, 0),
(4, 'Artículos', 3, 1, NULL, 0),
(5, 'Proyectos', 0, 1, NULL, 0),
(6, 'Proyectos', 5, 1, NULL, 0),
(7, 'Servicios', 0, 1, NULL, 0),
(8, 'Servicios', 7, 1, NULL, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nz_gallery`
--

CREATE TABLE `nz_gallery` (
  `id_gallery` bigint(20) UNSIGNED NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Creación'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nz_gallery`
--

INSERT INTO `nz_gallery` (`id_gallery`, `created`) VALUES
(1, '2019-12-07 22:35:39'),
(2, '2020-02-08 17:28:04'),
(3, '2020-02-08 17:33:30'),
(4, '2020-02-08 17:51:07'),
(5, '2020-02-09 16:19:25'),
(6, '2020-02-09 16:20:15'),
(7, '2020-02-09 16:28:51'),
(8, '2020-02-09 17:58:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nz_gallery_file`
--

CREATE TABLE `nz_gallery_file` (
  `id_item` bigint(20) UNSIGNED NOT NULL,
  `id_gallery` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Galería',
  `id_file` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'Archivo',
  `num` mediumint(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Orden'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nz_gallery_file`
--

INSERT INTO `nz_gallery_file` (`id_item`, `id_gallery`, `id_file`, `num`) VALUES
(10, 1, 13, 4),
(9, 1, 12, 3),
(8, 1, 11, 2),
(7, 1, 10, 1),
(6, 1, 9, 0),
(11, 2, 95, 0),
(26, 5, 115, 0),
(25, 3, 103, 2),
(24, 3, 101, 1),
(23, 3, 109, 0),
(20, 4, 105, 0),
(21, 4, 106, 1),
(22, 4, 107, 2),
(27, 5, 116, 1),
(28, 6, 117, 0),
(29, 6, 118, 1),
(30, 7, 120, 0),
(31, 8, 122, 0),
(32, 8, 123, 1),
(33, 8, 124, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nz_menu`
--

CREATE TABLE `nz_menu` (
  `id_menu` tinyint(3) UNSIGNED NOT NULL,
  `controller` varchar(50) DEFAULT NULL COMMENT 'Controlador',
  `name` varchar(255) DEFAULT NULL COMMENT 'Nombre',
  `id_ico` mediumint(8) UNSIGNED DEFAULT NULL COMMENT 'Ícono',
  `num` tinyint(4) UNSIGNED DEFAULT NULL COMMENT 'Orden'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nz_menu`
--

INSERT INTO `nz_menu` (`id_menu`, `controller`, `name`, `id_ico`, `num`) VALUES
(1, 'manager', 'Gestión', 281, 100),
(2, 'tickets', 'Incidencias', 228, 99),
(50, 'contents', 'Sitio Web', 478, 1),
(51, 'users', 'Usuarios', 374, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nz_session`
--

CREATE TABLE `nz_session` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(255) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text,
  `url` varchar(255) DEFAULT NULL,
  `robot` tinyint(3) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nz_session`
--

INSERT INTO `nz_session` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`, `url`, `robot`) VALUES
('2a29b75b6377eeca892d78d9cb4b1adb', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 1542038325, 'a:2:{s:7:\"nextUrl\";s:44:\"http://localhost/baur/admin/contents/contact\";s:17:\"udata-chat-active\";i:1;}', 'https://localhost/project/admin/', 0),
('53cebf4ad9d7e1e8f5a334ca59820aaf', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 1541592225, 'a:3:{s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:23:\"luciano@inmediative.com\";s:3:\"uID\";s:1:\"1\";}', 'http://localhost/baur/admin/app/user', 0),
('366f9a5f8a06959d106649983dccb56d', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 1541592597, 'a:3:{s:3:\"url\";s:51:\"http://localhost/baur/admin/contents/home/element/5\";s:7:\"nextUrl\";s:51:\"http://localhost/baur/admin/contents/home/element/5\";s:17:\"udata-chat-active\";i:1;}', 'http://localhost/baur/admin/contents/home/element/5', 0),
('227430b91c05fc50700107bae37d5601', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36', 1542226280, 'a:4:{s:3:\"url\";s:41:\"http://localhost/baur/admin/contents/home\";s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:23:\"luciano@inmediative.com\";s:3:\"uID\";s:1:\"1\";}', 'http://localhost/baur/admin/contents/home', 0),
('c55c13f4a6b71c49526fa27c19444a82', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', 1543241088, 'a:3:{s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:23:\"luciano@inmediative.com\";s:3:\"uID\";s:1:\"1\";}', 'http://localhost/spz/admin/', 0),
('d16eda1be6de95c2e8620c09a918b915', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 1545374268, 'a:3:{s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:23:\"luciano@inmediative.com\";s:3:\"uID\";s:1:\"1\";}', 'http://localhost/spz/admin/', 0),
('15fab6dac7f8a0dcbb6c684c9e33e0ae', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 1549890605, 'a:3:{s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:23:\"luciano@inmediative.com\";s:3:\"uID\";s:1:\"1\";}', 'http://localhost/spz/admin/', 0),
('0c669dad0c68d4495dfc00bb2b18b942', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/71.0.3578.98 Safari/537.36', 1550542034, 'a:4:{s:3:\"url\";s:35:\"http://localhost/spz/admin/app/user\";s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:23:\"luciano@inmediative.com\";s:3:\"uID\";s:1:\"1\";}', 'http://localhost/spz/admin/app/user', 0),
('3df2db6a40363187c392cf5b56baa729', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.109 Safari/537.36', 1551101558, 'a:2:{s:3:\"url\";s:35:\"http://localhost/spz/admin/app/user\";s:17:\"udata-chat-active\";i:1;}', 'http://localhost/spz/admin/app/user', 0),
('56b82e0cc77ad0f9216f0c5ce8fdec8d', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.119 Safari/537.36', 1551392487, 'a:3:{s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:23:\"luciano@inmediative.com\";s:3:\"uID\";s:1:\"1\";}', 'http://localhost/spz/admin/', 0),
('19296588ce26b15913fb80945eb670e5', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', 1560924169, 'a:3:{s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:23:\"luciano@inmediative.com\";s:3:\"uID\";s:1:\"1\";}', 'http://localhost/spz/admin/', 0),
('8607876c49bb49550342a341c48c11f3', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.169 Safari/537.36', 1560931315, 'a:4:{s:3:\"url\";s:40:\"http://localhost/spz/admin/contents/cogs\";s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:23:\"luciano@inmediative.com\";s:3:\"uID\";s:1:\"1\";}', 'http://localhost/spz/admin/contents/cogs', 0),
('ff6d40b0c05fcd49a200d630e46762e2', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.100 Safari/537.36', 1563816395, 'a:4:{s:3:\"url\";s:40:\"http://localhost/spz/admin/manager/users\";s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:23:\"luciano@inmediative.com\";s:3:\"uID\";s:1:\"1\";}', 'http://localhost/spz/admin/manager/users', 0),
('554824d72ca230a30cb0f3beddc72513', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 1564393856, 'a:3:{s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:23:\"luciano@inmediative.com\";s:3:\"uID\";s:1:\"1\";}', 'http://localhost/turodecaldetes/admin/', 0),
('021473a174f2f933f8a00d242065e5d3', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36', 1565074282, 'a:4:{s:3:\"url\";s:51:\"http://localhost/turodecaldetes/admin/contents/cogs\";s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:23:\"luciano@inmediative.com\";s:3:\"uID\";s:1:\"1\";}', 'http://localhost/turodecaldetes/admin/contents/cogs', 0),
('d0335c5f521f2f89b89afb7966bbfcc2', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 1567280858, 'a:4:{s:3:\"url\";s:51:\"http://localhost/turodecaldetes/admin/contents/home\";s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:23:\"luciano@inmediative.com\";s:3:\"uID\";s:1:\"1\";}', 'http://localhost/turodecaldetes/admin/contents/home', 0),
('12c3f6be21cee8deac77b917f381f25e', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 1568203309, 'a:3:{s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:23:\"luciano@inmediative.com\";s:3:\"uID\";s:1:\"1\";}', 'http://localhost/gedo/admin/', 0),
('73746cce91142af61b5862db5e1b66c8', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 1568204507, 'a:3:{s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:23:\"luciano@inmediative.com\";s:3:\"uID\";s:1:\"1\";}', 'http://localhost/gedo/admin/', 0),
('f6c9d5fd7a5ab7d0db915c864394f149', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 1568209445, 'a:4:{s:3:\"url\";s:42:\"http://localhost/gedo/admin/contentes/cogs\";s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:23:\"luciano@inmediative.com\";s:3:\"uID\";s:1:\"1\";}', 'http://localhost/gedo/admin/contentes/cogs', 0),
('1cbcf6513cbd70c196bc3f66a37181ba', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 1568480440, 'a:5:{s:3:\"url\";s:42:\"http://localhost/gedo/admin/contentes/cogs\";s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:23:\"luciano@inmediative.com\";s:3:\"uID\";s:1:\"1\";s:19:\"udata-body-minified\";s:1:\"0\";}', 'http://localhost/gedo/admin/contentes/cogs', 0),
('f0d9bc486bc1d76dd610a7d99d7654e0', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 1568827991, 'a:4:{s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:23:\"luciano@inmediative.com\";s:3:\"uID\";s:1:\"1\";s:19:\"udata-body-minified\";s:1:\"0\";}', 'http://localhost/gedo/admin/', 0),
('4c11296d885a4f1b1078770def705e0c', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 1568993570, 'a:3:{s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:23:\"luciano@inmediative.com\";s:3:\"uID\";s:1:\"1\";}', 'http://localhost/gedo/admin/', 0),
('8ffc7bb99a020eb4f959831d16af1a9b', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 1569434131, 'a:4:{s:3:\"url\";s:52:\"http://localhost/gedo/admin/contents/translations/es\";s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:23:\"luciano@inmediative.com\";s:3:\"uID\";s:1:\"1\";}', 'http://localhost/gedo/admin/contents/translations/es', 0),
('42a6631d9e047dea101bb6ded004549e', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 1569256130, NULL, 'http://localhost/gedo/admin/users/export_registers', 0),
('8e8d9155f6a744a17c10494b70de68d4', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/77.0.3865.120 Safari/537.36', 1572655113, 'a:8:{s:3:\"url\";s:52:\"http://localhost/gedo/admin/contents/translations/es\";s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:23:\"luciano@inmediative.com\";s:3:\"uID\";s:1:\"1\";s:19:\"udata-body-minified\";s:1:\"0\";i:0;s:4:\"lang\";i:1;s:4:\"json\";s:4:\"lang\";s:2:\"es\";}', 'http://localhost/gedo/admin/contents/translations/es', 0),
('aa171c993b21fbe8836118065763e46e', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 1575741690, 'a:3:{s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:23:\"luciano@inmediative.com\";s:3:\"uID\";s:1:\"1\";}', 'http://localhost/kool/admin/', 0),
('c1bd4f168f1e9c964b50181419b5bb19', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 1575758135, 'a:6:{s:3:\"url\";s:46:\"http://localhost/kool/admin/contents/cogs\";s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:23:\"luciano@inmediative.com\";s:3:\"uID\";s:1:\"1\";s:4:\"lang\";s:2:\"ca\";s:19:\"udata-body-minified\";s:1:\"0\";}', 'http://localhost/kool/admin/contents/cogs', 0),
('81f1cf76adcd2a8f0ec3c74e745de2a3', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 1575755365, NULL, 'http://localhost/kool/admin/app/thumb/112', 0),
('bc6b58d173082ca4935ef9caab494dfc', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 1575755409, NULL, 'http://localhost/kool/admin/app/thumb/113', 0),
('3ae46f6c78d630f56f3b990c34b442c1', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 1575755607, NULL, 'http://localhost/kool/admin/app/thumb/1', 0),
('b5adc2cc64e89d4b9012bf07d70c3f6d', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 1575755647, NULL, 'http://localhost/kool/admin/app/thumb/7', 0),
('8e6452a08bfb5f4d8a47cd7121a35eb3', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 1575755711, NULL, 'http://localhost/kool/admin/app/thumb/7', 0),
('b141a60802f4817d2a781a1e08d3e86d', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 1576026908, 'a:4:{s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:23:\"luciano@inmediative.com\";s:3:\"uID\";s:1:\"1\";s:4:\"lang\";s:2:\"ca\";}', 'http://localhost/kool/admin/', 0),
('a748cae4a0e2a24220f65354e8b07dd3', '181.170.34.232', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 1576040197, NULL, 'http://kool.weareidentty.com/admin/', 0),
('3351a7036d90ed803277bac12ba241e3', '181.170.34.232', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 1576040200, NULL, 'http://kool.weareidentty.com/admin/', 0),
('b5f50dcaf00e48194dc736f8ccac2048', '181.170.34.232', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 1576046173, 'a:4:{s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:19:\"antonio@identty.com\";s:3:\"uID\";s:2:\"51\";s:4:\"lang\";s:2:\"ca\";}', 'https://kool.weareidentty.com/admin/', 0),
('0c478ca4317d165b32316dd7951a504f', '200.81.125.4', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 1576042483, 'a:2:{s:3:\"url\";s:49:\"https://kool.weareidentty.com/admin/app/user\";s:17:\"udata-chat-active\";i:1;}', 'https://kool.weareidentty.com/admin/app/user', 0),
('a1a21cbd78a78199f7aaaee103442e01', '181.170.34.232', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 1578553157, 'a:4:{s:3:\"url\";s:58:\"https://kool.weareidentty.com/admin/contents/projects\";s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:19:\"luciano@identty.com\";s:3:\"uID\";s:3:\"100\";}', 'https://kool.weareidentty.com/admin/contents/projects', 0),
('43537b4384b14cf109386b003a02e864', '46.24.115.23', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 1576684139, 'a:3:{s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:19:\"antonio@identty.com\";s:3:\"uID\";s:2:\"51\";}', 'https://kool.weareidentty.com/admin/', 0),
('79c3dcc6e51f074a6921f645dccf7ccc', '46.25.116.127', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 1576598015, 'a:3:{s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:19:\"antonio@identty.com\";s:3:\"uID\";s:2:\"51\";}', 'https://kool.weareidentty.com/admin/', 0),
('512ce2fab69e4abaa5eb0a3f1954190d', '46.25.116.127', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.79 Safari/537.36', 1579714694, 'a:5:{s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:19:\"antonio@identty.com\";s:3:\"uID\";s:2:\"51\";s:24:\"flash:old:post-save-ok-6\";b:1;s:24:\"flash:new:post-save-ok-6\";b:1;}', 'https://kool.weareidentty.com/admin/', 0),
('4b9ccf543da3c1d44e6bdd82a24ca0cc', '185.49.170.197', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.108 Safari/537.36', 1576683676, 'a:2:{s:3:\"url\";s:49:\"https://kool.weareidentty.com/admin/app/user\";s:17:\"udata-chat-active\";i:1;}', 'https://kool.weareidentty.com/admin/app/user', 0),
('d904433599212377efff2943db747710', '54.152.71.47', 'Slackbot-LinkExpanding 1.0 (+https://api.slack.com/robots)', 1576684324, 'a:2:{s:3:\"url\";s:57:\"https://kool.weareidentty.com/admin/contents/clients\";s:7:\"nextUrl\";s:57:\"https://kool.weareidentty.com/admin/contents/clients\";}', 'https://kool.weareidentty.com/admin/contents/clients', 0),
('1503ab99c90e98f39bb81af9c961124b', '54.152.71.47', 'Slackbot-LinkExpanding 1.0 (+https://api.slack.com/robots)', 1576684324, 'a:2:{s:3:\"url\";s:49:\"https://kool.weareidentty.com/admin/app/user\";s:17:\"udata-chat-active\";i:1;}', 'https://kool.weareidentty.com/admin/app/user', 0),
('ea45e81c47bae07958f9d6739e80ecb3', '181.170.34.232', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36', 1577976153, 'a:3:{s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:19:\"luciano@identty.com\";s:3:\"uID\";s:3:\"100\";}', 'https://kool.weareidentty.com/admin/', 0),
('d5e611115ca567adf6bf252cfa750345', '2.137.67.165', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.88 Safari/537.36', 1577048766, 'a:3:{s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:19:\"antonio@identty.com\";s:3:\"uID\";s:2:\"51\";}', 'https://kool.weareidentty.com/admin/', 0),
('2b3e15c97ae95aa9e02cd0e5e5c3349b', '185.210.218.108', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:62.0) Gecko/20100101 Firefox/62.0', 1578440740, NULL, 'https://kool.weareidentty.com/admin/', 0),
('da7443e47965fb272776588da6298782', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 1580996156, 'a:3:{s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:19:\"luciano@identty.com\";s:3:\"uID\";s:2:\"51\";}', 'http://kool.test/admin/', 0),
('5122ad42ad8443d5f25cbefac2893dc4', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 1580995827, 'a:2:{s:3:\"url\";s:37:\"http://kool.test/admin/app/user/login\";s:17:\"udata-chat-active\";i:1;}', 'http://kool.test/admin/app/user/login', 0),
('4fe46f56a7bfcaa625b74572cacb5b4f', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36', 1581170730, 'a:1:{s:17:\"udata-chat-active\";i:1;}', 'http://kool.test/admin/', 0),
('58c2b72affb9ae6b7861b3cc94e8009e', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36', 1581277290, 'a:6:{s:3:\"url\";s:31:\"http://kool.test/admin/app/user\";s:17:\"udata-chat-active\";i:1;s:10:\"prelogmail\";s:19:\"luciano@identty.com\";s:3:\"uID\";s:2:\"51\";s:4:\"lang\";s:2:\"es\";s:19:\"udata-body-minified\";s:1:\"0\";}', 'http://kool.test/admin/app/user', 0),
('2a4fdfaf1ffba6463460de7164e38249', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36', 1581175369, NULL, 'http://kool.test/admin/app/sessiong', 0),
('48674f37d0e31ffa7fc82f15f8158ba4', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36', 1581175374, NULL, 'http://kool.test/admin/app/sessiong', 0),
('e8b64b3c2891e50289e8cbf15cefda0c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36', 1581175380, NULL, 'http://kool.test/admin/app/sessiong', 0),
('9f1b26d4e1a412cac94dadb534b5e4a1', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36', 1581273392, 'a:3:{s:3:\"url\";s:50:\"http://kool.test/admin/contents/one_file/es/home-1\";s:7:\"nextUrl\";s:53:\"http://kool.test/admin/contents/one_file/es/seo_about\";s:17:\"udata-chat-active\";i:1;}', 'http://kool.test/admin/contents/one_file/es/home-1', 0),
('37e394529c194df2912c5276990bfeca', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36', 1581274822, NULL, 'http://kool.test/admin/app/sessiong', 0),
('a7824572db878ed05cad6f743a6899c6', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36', 1581275262, NULL, 'http://kool.test/admin/app/sessiong', 0),
('a2ed6ebd4337f9ddbeb40bac0ba2e386', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36', 1581275264, NULL, 'http://kool.test/admin/app/sessiong', 0),
('9fda6f118d4d1aea1f4a20e6e0eee55c', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36', 1581275267, NULL, 'http://kool.test/admin/app/sessiong', 0),
('41a2a34cfe49f0c52a3d23ab4d8fe214', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36', 1581275318, NULL, 'http://kool.test/admin/app/sessiong', 0),
('b436db6687d17b50f53d68327025dc58', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.87 Safari/537.36', 1581277204, NULL, 'http://kool.test/admin/app/sessiong', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nz_submenu`
--

CREATE TABLE `nz_submenu` (
  `id_submenu` mediumint(8) UNSIGNED NOT NULL,
  `id_menu` tinyint(3) UNSIGNED NOT NULL COMMENT 'Menú',
  `function` varchar(50) DEFAULT NULL COMMENT 'Función',
  `name` varchar(255) DEFAULT NULL COMMENT 'Nombre',
  `num` tinyint(3) UNSIGNED NOT NULL DEFAULT '99' COMMENT 'Orden',
  `root` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Root'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nz_submenu`
--

INSERT INTO `nz_submenu` (`id_submenu`, `id_menu`, `function`, `name`, `num`, `root`) VALUES
(2, 1, 'index', 'Automatización', 2, 1),
(3, 1, 'sql', 'SQL', 3, 1),
(4, 1, 'menu', 'Menú', 4, 1),
(5, 1, 'submenu', 'Submenú', 5, 1),
(6, 1, 'icons', 'Íconos', 6, 1),
(9, 1, 'companies', 'Empresas', 10, 0),
(1, 1, 'actions', 'Acciones', 1, 1),
(7, 1, 'clients', 'Clientes', 7, 0),
(8, 1, 'projects', 'Proyectos', 8, 0),
(10, 1, 'users', 'Usuarios', 11, 0),
(11, 2, 'index', 'Ver Incidencias', 4, 0),
(12, 2, 'categories', 'Categorías', 5, 0),
(13, 2, 'report', 'Reportar', 1, 0),
(400, 50, 'cogs', 'Configuración general', 1, 0),
(402, 50, 'translations', 'Traducciones Generales', 2, 0),
(403, 51, 'newsletter', 'Newsletter', 1, 0),
(405, 50, 'blog', 'Blog', 5, 0),
(409, 50, 'info_pages', 'Páginas de información', 20, 0),
(413, 50, 'liveadmin', 'Editor de contanidos', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nz_user_data`
--

CREATE TABLE `nz_user_data` (
  `id_data` int(10) UNSIGNED NOT NULL,
  `id_user` int(10) UNSIGNED NOT NULL COMMENT 'Usuario',
  `item` varchar(255) NOT NULL COMMENT 'Item',
  `data` text NOT NULL COMMENT 'Data'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nz_user_data`
--

INSERT INTO `nz_user_data` (`id_data`, `id_user`, `item`, `data`) VALUES
(3, 1, 'contents-home', '{\"listSort\":\"num\",\"listSortType\":\"asc\",\"listStart\":\"0\",\"listPagination\":\"10\",\"listColumns\":\"[{\\\"id\\\":\\\"id\\\",\\\"visible\\\":true},{\\\"id\\\":\\\"num\\\",\\\"visible\\\":true},{\\\"id\\\":\\\"home\\\",\\\"visible\\\":true},{\\\"id\\\":\\\"name\\\",\\\"visible\\\":true},{\\\"id\\\":\\\"fm1file\\\",\\\"visible\\\":true},{\\\"id\\\":\\\"color\\\",\\\"visible\\\":true},{\\\"id\\\":\\\"active\\\",\\\"visible\\\":true}]\"}'),
(4, 1, 'manager-submenu', '{\"listSort\":\"id\",\"listSortType\":\"desc\",\"listStart\":\"0\",\"listPagination\":\"10\"}'),
(5, 1, 'contents-brand', '{\"listSort\":\"id\",\"listSortType\":\"desc\",\"listStart\":\"10\",\"listPagination\":\"10\"}'),
(6, 1, 'contents-newsletter', '{\"listSort\":\"id\",\"listSortType\":\"desc\",\"listStart\":\"0\",\"listPagination\":\"10\"}'),
(7, 1, 'contents-blog_post', '{\"listColumns\":\"[{\\\"id\\\":\\\"id\\\",\\\"visible\\\":true},{\\\"id\\\":\\\"id\\\",\\\"visible\\\":true},{\\\"id\\\":\\\"date\\\",\\\"visible\\\":true},{\\\"id\\\":\\\"title\\\",\\\"visible\\\":true},{\\\"id\\\":\\\"subtitle\\\",\\\"visible\\\":true},{\\\"id\\\":\\\"active\\\",\\\"visible\\\":true},{\\\"id\\\":\\\"id\\\",\\\"visible\\\":true}]\"}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nz_user_secure`
--

CREATE TABLE `nz_user_secure` (
  `id_user` mediumint(8) UNSIGNED NOT NULL COMMENT 'Usuario',
  `id_submenu` mediumint(8) UNSIGNED NOT NULL COMMENT 'Item',
  `view` tinyint(1) UNSIGNED NOT NULL COMMENT 'Ver',
  `edit` tinyint(1) UNSIGNED NOT NULL COMMENT 'Editar',
  `delete` tinyint(1) UNSIGNED NOT NULL COMMENT 'Borrar',
  `special` tinyint(1) UNSIGNED NOT NULL COMMENT 'Especial'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `nz_user_secure`
--

INSERT INTO `nz_user_secure` (`id_user`, `id_submenu`, `view`, `edit`, `delete`, `special`) VALUES
(1, 400, 1, 1, 1, 1),
(1, 401, 1, 1, 1, 1),
(1, 7, 1, 1, 1, 0),
(1, 6, 1, 1, 1, 0),
(1, 8, 1, 1, 1, 0),
(103, 403, 1, 1, 1, 1),
(103, 409, 1, 1, 1, 1),
(103, 407, 1, 1, 1, 1),
(103, 408, 1, 1, 1, 1),
(103, 405, 1, 1, 1, 1),
(103, 401, 1, 1, 1, 1),
(103, 402, 1, 1, 1, 1),
(103, 400, 1, 1, 1, 1),
(51, 400, 1, 1, 1, 1),
(51, 401, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services`
--

CREATE TABLE `services` (
  `id_post` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL COMMENT 'Titulo',
  `subtitle` text NOT NULL COMMENT 'Subtitulo',
  `lang` varchar(50) NOT NULL COMMENT 'Idioma',
  `active` tinyint(1) NOT NULL,
  `id_file` bigint(20) DEFAULT NULL,
  `num` int(11) NOT NULL DEFAULT '0',
  `title2` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `services`
--

INSERT INTO `services` (`id_post`, `title`, `subtitle`, `lang`, `active`, `id_file`, `num`, `title2`) VALUES
(9, 'Construcció de marca', 'Dissenyem la teva imatge de marca i establim mecanismes de posicionament dins del sector del vi per fer arribar la teva empresa al seu target adequat.', 'ca', 1, 32, 1, 'EMPELTAR'),
(10, 'Esdeveniments', 'Dissenyem i produïm esdeveniments en funció dels teus objectius. La versatilitat és una actitud, l’experiència una garantia i l’originalitat un segell. Busquem ressò a través de la innovació.', 'ca', 1, 26, 5, 'CUPAJAR'),
(11, 'Assessorament de negoci', 'Explica’ns el teu cas. Comences el teu projecte personal? Les xarxes socials et fan pànic? Vols donar una nova imatge a la teva marca però no saps on acudir? Des de kool fem consultoria en comunicació però també et donem les eines més idònies per ajudar-te a fer el primer pas en el teu negoci vinícola.', 'ca', 1, 24, 6, 'SOBRETAULA'),
(12, 'Relacions públiques 2.0', 'Gràcies a la nostra especialització en el mercat vinícola, comptem amb una àmplia xarxa de contactes que et posem a l’abast. Treballem també per enfortir els teus vincles amb mitjans de premsa especialitzats i influencers.', 'ca', 1, 33, 4, 'BRINDAR'),
(13, 'Creació de contingut', 'Narrem històries per ser consumides. Cada producte, empresa o servei té la seva pròpia, nosaltres t’ajudem a donar-li forma i explicar-la través d\'imatges i paraules que defineixin la teva singularitat i diferenciació. Emocionem al winelover amb conceptes trencadors.', 'ca', 1, 27, 3, 'FERMENTAR'),
(14, 'Estratègia digital / Pàgines web', 'Creem, Gestionem i planifiquem campanyes digitals adaptades a cada plataforma de comunicació. Analitzem el teu cas en clau de vi i dinamitzem la teva marca a través de la gestió de les xarxes socials incrementant la visibilitat, l’audiència i l’engagement de cadascuna de les accions realitzades. També fem pàgines web a mida amb molta cura en el disseny, la seva navegació i usabilitat.', 'ca', 1, 31, 2, 'VEREMAR');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `team`
--

CREATE TABLE `team` (
  `id_post` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL COMMENT 'Titulo',
  `subtitle` text NOT NULL COMMENT 'Subtitulo',
  `text` text NOT NULL COMMENT 'Descipción',
  `lang` varchar(50) NOT NULL COMMENT 'Idioma',
  `active` tinyint(1) NOT NULL,
  `id_file` bigint(20) DEFAULT NULL,
  `num` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `team`
--

INSERT INTO `team` (`id_post`, `title`, `subtitle`, `text`, `lang`, `active`, `id_file`, `num`) VALUES
(4, 'Hola!', '', 'Comuniquem amb passió i creativitat.\nProduïm esdeveniments inoblidables.\nFem estratègies de branding i màrqueting a mida.\nSempre des de l’especialització del món del vi i el seu entorn més proper.\nEl consum del vi pot créixer i la nostra fita és fer-ho a través de la comunicació.', 'ca', 1, 63, 1),
(5, 'L\'art de beure en bona companyia!', '', 'De petits ens van ensenyar a lluitar pels nostres somnis, i ens declarem vencedors. \nSom un equip de professionals formats en el camp de la comunicació i la sumilleria i en constant (r)evolució.\nInterpretem el teu missatge amb positivisme, i el transformem en idees tangibles.\nEls límits se\'ls posa un mateix, i nosaltres et donem les eines per trencar-los. \n\nI recorda que amb nosaltres, \nYou\'ll never wine alone. ', 'ca', 1, 50, 2),
(8, '', '', '', 'ca', 1, 0, 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id_blog`);

--
-- Indices de la tabla `blog_category`
--
ALTER TABLE `blog_category`
  ADD PRIMARY KEY (`id_category`),
  ADD KEY `id_category` (`id_category`);

--
-- Indices de la tabla `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id_contact`);

--
-- Indices de la tabla `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`var`);

--
-- Indices de la tabla `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`var`);

--
-- Indices de la tabla `info_pages`
--
ALTER TABLE `info_pages`
  ADD PRIMARY KEY (`id_post`);

--
-- Indices de la tabla `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`id_newsletter`);

--
-- Indices de la tabla `nz_file`
--
ALTER TABLE `nz_file`
  ADD PRIMARY KEY (`id_file`),
  ADD KEY `id_tabla` (`id_folder`),
  ADD KEY `id_tipo` (`id_type`);

--
-- Indices de la tabla `nz_folder`
--
ALTER TABLE `nz_folder`
  ADD PRIMARY KEY (`id_folder`);

--
-- Indices de la tabla `nz_gallery`
--
ALTER TABLE `nz_gallery`
  ADD PRIMARY KEY (`id_gallery`);

--
-- Indices de la tabla `nz_gallery_file`
--
ALTER TABLE `nz_gallery_file`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_gallery` (`id_gallery`);

--
-- Indices de la tabla `nz_menu`
--
ALTER TABLE `nz_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indices de la tabla `nz_session`
--
ALTER TABLE `nz_session`
  ADD PRIMARY KEY (`session_id`);

--
-- Indices de la tabla `nz_submenu`
--
ALTER TABLE `nz_submenu`
  ADD PRIMARY KEY (`id_submenu`);

--
-- Indices de la tabla `nz_user_data`
--
ALTER TABLE `nz_user_data`
  ADD PRIMARY KEY (`id_data`),
  ADD KEY `id_user` (`id_user`,`item`);

--
-- Indices de la tabla `nz_user_secure`
--
ALTER TABLE `nz_user_secure`
  ADD KEY `id_user` (`id_user`,`id_submenu`);

--
-- Indices de la tabla `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id_post`);

--
-- Indices de la tabla `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id_post`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `blog`
--
ALTER TABLE `blog`
  MODIFY `id_blog` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `blog_category`
--
ALTER TABLE `blog_category`
  MODIFY `id_category` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `contact`
--
ALTER TABLE `contact`
  MODIFY `id_contact` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID';

--
-- AUTO_INCREMENT de la tabla `info_pages`
--
ALTER TABLE `info_pages`
  MODIFY `id_post` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `id_newsletter` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `nz_file`
--
ALTER TABLE `nz_file`
  MODIFY `id_file` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT de la tabla `nz_folder`
--
ALTER TABLE `nz_folder`
  MODIFY `id_folder` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `nz_gallery`
--
ALTER TABLE `nz_gallery`
  MODIFY `id_gallery` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `nz_gallery_file`
--
ALTER TABLE `nz_gallery_file`
  MODIFY `id_item` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `nz_menu`
--
ALTER TABLE `nz_menu`
  MODIFY `id_menu` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `nz_submenu`
--
ALTER TABLE `nz_submenu`
  MODIFY `id_submenu` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=414;

--
-- AUTO_INCREMENT de la tabla `nz_user_data`
--
ALTER TABLE `nz_user_data`
  MODIFY `id_data` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `services`
--
ALTER TABLE `services`
  MODIFY `id_post` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `team`
--
ALTER TABLE `team`
  MODIFY `id_post` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
