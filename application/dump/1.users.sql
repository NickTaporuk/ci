CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT 'no-name',
  `email` varchar(200) DEFAULT 'no-mail',
  `age` int(11) DEFAULT NULL,
  `passw` varchar(45) DEFAULT NULL,
  `last_tc` time DEFAULT NULL,
  `activate` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8