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
  `date_inscription` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id`, `pseudo`, `pass`, `date_inscription`) VALUES
(3, 'armen', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2016-10-23'),
(4, 'armen1', '011c945f30ce2cbafc452f39840f025693339c42', '2016-10-23'),
(5, 'antonin', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', '2016-10-23'),
(6, 'root', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', '2016-10-23'),
(7, 'amaury', '39dfa55283318d31afe5a3ff4a0e3253e2045e43', '2016-10-24');

