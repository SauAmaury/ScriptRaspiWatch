USE mysql;

DROP TABLE IF EXISTS `security`,`membre`;

CREATE TABLE `security` (
  `camera` int(11) DEFAULT NULL,
  `filename` char(80) NOT NULL,
  `frame` int(11) DEFAULT NULL,
  `file_type` int(11) DEFAULT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `event_time_stamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00')
   ENGINE=InnoDB DEFAULT CHARSET=latin1;
   
   CREATE TABLE `membre` (
   `id` int(11) NOT NULL,
   `pseudo` varchar(255) NOT NULL,
   `pass` varchar(255) NOT NULL,
   `date_inscription` date NOT NULL )
  ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
  
  INSERT INTO `mysql`.`membre` (`id`, `pseudo`, `pass`, `date_inscription`) VALUES ('', 'root', '0000', CURDATE());
