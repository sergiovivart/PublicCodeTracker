SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `trackers` (
  `id` int(11) NOT NULL,
  `fecha_on` varchar(255) NOT NULL,
  `fecha_close` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `usuario` varchar(255) NOT NULL,
  `typo` varchar(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `limite` varchar(255) NOT NULL,
  `grupo` varchar(255) NOT NULL,
  `solucion` text NOT NULL,
  `captura` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `pass`) VALUES
('asd', 'asd', 'asd@gmail.com', '$2y$10$bRX/pSxXzXJHJvgJUpMUnOlWEHYGd0geCmpSgj0Wuwlr1ScaxVKfy');
-- IMPORTANT : everything is asd including password
--
-- AUTO_INCREMENT de la tabla `trackers`
--
ALTER TABLE `trackers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;
