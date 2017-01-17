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
   
 ALTER TABLE `security` ADD `id` INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`id`);


CREATE TABLE IF NOT EXISTS `membre` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `date_inscription` date NOT NULL,
  `admin` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id`, `pseudo`, `pass`, `date_inscription`, `admin`) VALUES
(6, 'root', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', '2016-10-23', 1);




