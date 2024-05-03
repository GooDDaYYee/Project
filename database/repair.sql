# Host: localhost  (Version 8.0.17)
# Date: 2020-10-29 14:33:25
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "detail"
#

DROP TABLE IF EXISTS `detail`;
CREATE TABLE `detail` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `machine` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `category` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(6) DEFAULT NULL,
  `cause` varchar(255) DEFAULT NULL,
  `numberphone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

#
# Data for table "detail"
#


#
# Structure for table "user"
#

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

#
# Data for table "user"
#

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','7c222fb2927d828af22f592134e8932480637c0d','admin','admin','0','1');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
