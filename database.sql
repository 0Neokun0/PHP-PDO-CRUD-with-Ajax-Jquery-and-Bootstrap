 
--
-- Database: `crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=68 ;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `first_name`, `last_name`) VALUES
(18, 'Joseph', 'Harman'),
(19, 'John', 'Moss'),
(20, 'Lillie', 'Ferrarium'),
(21, 'Yolanda', 'Green'),
(22, 'Cara', 'Gariepy'),
(55, 'Opal', 'Goree'),
(23, 'Christine', 'Johnson'),
(24, 'Alana', 'Decruze'),
(25, 'Krista', 'Correa'),
(26, 'Charles', 'Martin'),
(54, 'Rhonda', 'Ocampo'),
(51, 'Cecilia', 'Roy'),
(52, 'Otto', 'Estes'),
(53, 'Richardson', 'Fishback'),
(56, 'Rudy', 'Buckley');
 