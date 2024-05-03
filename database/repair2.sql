SELECT * FROM repair.user;
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