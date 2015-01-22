CREATE TABLE `multi_level_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT 'no-name',
  `lang` varchar(5) DEFAULT 'ru',
  `level` varchar(45) DEFAULT '0',
  `serial_number` int(11) DEFAULT '0',
  `comment` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8