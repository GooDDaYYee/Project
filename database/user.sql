SELECT * FROM repair.user LIMIT 0, 25;
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `lv` char(1) NOT NULL DEFAULT '1' COMMENT '1=user,0=admin',
  `status` char(1) NOT NULL DEFAULT '1' COMMENT '1=ใช้งาน,0=แบน',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','123','admin','admin','0','1');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;