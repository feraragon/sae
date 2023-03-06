-- sae.empresas: tabla donde se guardan los registros de las empresas

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `fecha_constitucion` date NOT NULL,
  `tipo_empresa` enum('Distribuidor','Mayorista','Usuario final') NOT NULL,
  `comentarios` varchar(1020) DEFAULT NULL,
  `estado` enum('Activo','Eliminado') NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

-- bitacora_agregar: Trigger para registrar los movimientos cuando se agrega una nueva empresa
CREATE DEFINER=`root`@`localhost` TRIGGER `bitacora_agregar` AFTER INSERT ON `empresas` FOR EACH ROW INSERT INTO empresa_bitacora (`id_empresa`, `nombre`, `fecha_constitucion`, `tipo_empresa`, `comentarios`, `estado`, `updated_at`, `accion`) VALUES (NEW.id,NEW.nombre,NEW.fecha_constitucion, NEW.tipo_empresa ,NEW.comentarios, NEW.estado, now(), 'agregar');

-- bitacora_editar: Trigger para registrar los movimientos cuando se edita una empresa
CREATE DEFINER=`root`@`localhost` TRIGGER `bitacora_editar` AFTER UPDATE ON `empresas` FOR EACH ROW INSERT INTO empresa_bitacora (`id_empresa`, `nombre`, `fecha_constitucion`, `tipo_empresa`, `comentarios`, `estado`, `updated_at`, `accion`) VALUES (NEW.id,NEW.nombre,NEW.fecha_constitucion, NEW.tipo_empresa ,NEW.comentarios, NEW.estado, now(), 'editar');


-- sae.empresa_bitacora: tabla donde se guardan los movimientos de los registros de empresas

CREATE TABLE `empresa_bitacora` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `fecha_constitucion` date NOT NULL,
  `tipo_empresa` varchar(50) NOT NULL,
  `comentarios` varchar(1020) DEFAULT NULL,
  `estado` varchar(50) NOT NULL,
  `updated_at` datetime NOT NULL,
  `accion` enum('agregar','editar','eliminar') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

