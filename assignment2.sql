-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2016 at 08:52 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment2`
--
CREATE DATABASE IF NOT EXISTS `assignment2` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `assignment2`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `addConsole`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `addConsole` (IN `myid` INT, IN `myconsole` VARCHAR(60))  BEGIN
	INSERT INTO consoles (`console_id`, `console_name`) VALUES
(myid, myconsole);
END$$

DROP PROCEDURE IF EXISTS `addController`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `addController` (IN `myid` INT, IN `mycontroller` VARCHAR(60), IN `myprice` DOUBLE)  BEGIN
	INSERT INTO controllers (`controller_id`, `controller_name`, `controller_price`) VALUES
(myid, mycontroller, myprice);
END$$

DROP PROCEDURE IF EXISTS `adduser`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `adduser` (IN `myid` INT, IN `myemail` VARCHAR(60), IN `myusername` VARCHAR(30), IN `mypassword` VARCHAR(30))  BEGIN
	INSERT INTO usertable (`user_id`, `email`, `username`, `userpassword`) VALUES
(myid, myemail, myusername, mypassword);
END$$

DROP PROCEDURE IF EXISTS `ConsoleTable`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ConsoleTable` ()  SELECT console_name from consoles$$

DROP PROCEDURE IF EXISTS `ControllerTable`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `ControllerTable` ()  select controller_name, controller_price from controllers$$

DROP PROCEDURE IF EXISTS `deleteConsole`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteConsole` (IN `myconsole` VARCHAR(60))  BEGIN
DELETE FROM consoles WHERE console_name = myconsole;
END$$

DROP PROCEDURE IF EXISTS `deleteController`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteController` (IN `mycontroller` VARCHAR(60))  BEGIN
DELETE FROM controllers WHERE controller_name = mycontroller;
END$$

DROP PROCEDURE IF EXISTS `login`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `login` (IN `myusername` VARCHAR(30), IN `mypassword` VARCHAR(30))  BEGIN
SELECT user_id FROM usertable WHERE username = myusername and userpassword = mypassword;
END$$

DROP PROCEDURE IF EXISTS `logTable`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `logTable` ()  select * from logtable$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `consoles`
--

DROP TABLE IF EXISTS `consoles`;
CREATE TABLE `consoles` (
  `console_id` int(11) NOT NULL,
  `console_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `consoles`
--

INSERT INTO `consoles` (`console_id`, `console_name`) VALUES
(1, 'Xbox One'),
(2, 'PS4');

--
-- Triggers `consoles`
--
DROP TRIGGER IF EXISTS `afterAddingConsole`;
DELIMITER $$
CREATE TRIGGER `afterAddingConsole` AFTER INSERT ON `consoles` FOR EACH ROW BEGIN
	INSERT into logtable
    SET action = 'insert',
    console_id = NEW.console_id,
    console_name = NEW.console_name,
    changedate = NOW();
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `afterDeleteConsole`;
DELIMITER $$
CREATE TRIGGER `afterDeleteConsole` AFTER DELETE ON `consoles` FOR EACH ROW BEGIN
	INSERT into logtable
    SET action = 'delete',
    console_id = old.console_id,
    console_name = old.console_name,
    changedate = NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `controllers`
--

DROP TABLE IF EXISTS `controllers`;
CREATE TABLE `controllers` (
  `controller_id` int(11) NOT NULL,
  `controller_name` varchar(60) NOT NULL,
  `controller_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `controllers`
--

INSERT INTO `controllers` (`controller_id`, `controller_name`, `controller_price`) VALUES
(1, 'PS4 controller (red)', 64.99),
(2, 'PS4 controller (blue)', 64.99),
(3, 'PS4 controller', 59.99),
(4, 'Xbox One controller', 59.99),
(5, 'Xbox One controller (white)', 64.99),
(6, 'Xbox One controller (elite)', 129.99);

--
-- Triggers `controllers`
--
DROP TRIGGER IF EXISTS `afterAddingController`;
DELIMITER $$
CREATE TRIGGER `afterAddingController` AFTER INSERT ON `controllers` FOR EACH ROW BEGIN
	INSERT into logtable
    SET action = 'insert',
    controller_id = NEW.controller_id,
    controller_name = NEW.controller_name,
    controller_price = NEW.controller_price,
    changedate = NOW();
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `afterDeletingController`;
DELIMITER $$
CREATE TRIGGER `afterDeletingController` AFTER DELETE ON `controllers` FOR EACH ROW BEGIN
	INSERT into logtable
    SET action = 'delete',
    controller_id = OLD.controller_id,
    controller_name = OLD.controller_name,
    controller_price = OLD.controller_price,
    changedate = NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `logtable`
--

DROP TABLE IF EXISTS `logtable`;
CREATE TABLE `logtable` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `username` varchar(30) NOT NULL,
  `userpassword` varchar(30) NOT NULL,
  `console_id` int(11) NOT NULL,
  `console_name` varchar(60) NOT NULL,
  `controller_id` int(11) NOT NULL,
  `controller_name` varchar(60) NOT NULL,
  `controller_price` double NOT NULL,
  `changedate` datetime NOT NULL,
  `action` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logtable`
--

INSERT INTO `logtable` (`log_id`, `user_id`, `email`, `username`, `userpassword`, `console_id`, `console_name`, `controller_id`, `controller_name`, `controller_price`, `changedate`, `action`) VALUES
(3, 4, '', 'johnd', '1234', 0, '0', 0, '', 0, '2016-12-03 17:02:57', 'insert'),
(4, 5, '', 'janed', '1234', 0, '0', 0, '', 0, '2016-12-03 17:03:20', 'insert'),
(5, 6, '', 'jdoe', 'john1234', 0, '0', 0, '', 0, '2016-12-03 17:03:53', 'insert'),
(6, 7, '', 'JDoe', 'jane1234', 0, '0', 0, '', 0, '2016-12-03 17:04:40', 'insert'),
(7, 32, '', 'JD', 'jd1234', 0, '0', 0, '', 0, '2016-12-03 17:09:47', 'insert'),
(10, 0, '', '', '', 13, 'Xbox 360', 0, '', 0, '2016-12-03 17:20:20', 'insert'),
(11, 0, '', '', '', 13, 'Xbox 360', 0, '', 0, '2016-12-03 17:24:50', 'delete'),
(12, 0, '', '', '', 0, '', 10, 'PS3 controller', 32.99, '2016-12-03 17:30:02', 'insert'),
(13, 0, '', '', '', 0, '', 10, 'PS3 controller', 32.99, '2016-12-03 17:33:16', 'delete'),
(14, 0, '', '', '', 0, '', 9, 'xbox 360 controller', 34.99, '2016-12-03 17:33:35', 'delete'),
(15, 0, '', '', '', 14, 'wii', 0, '', 0, '2016-12-03 21:45:53', 'insert'),
(16, 0, '', '', '', 14, 'wii', 0, '', 0, '2016-12-03 21:46:00', 'delete'),
(17, 33, '', '123', '123', 0, '', 0, '', 0, '2016-12-05 12:19:39', 'insert'),
(18, 34, '1234@gmail.com', '1234', '1234', 0, '', 0, '', 0, '2016-12-05 12:51:25', 'insert'),
(19, 0, '', '', '', 3, 'xbox360', 0, '', 0, '2016-12-05 14:21:19', 'insert'),
(20, 0, '', '', '', 0, '', 7, 'xbox360 controller', 23.99, '2016-12-05 14:21:43', 'insert'),
(21, 0, '', '', '', 0, '', 7, 'xbox360 controller', 23.99, '2016-12-05 14:21:55', 'delete'),
(22, 0, '', '', '', 3, 'xbox360', 0, '', 0, '2016-12-05 14:22:06', 'delete'),
(23, 35, 'conor1@gmail.com', 'conor1', 'conor1', 0, '', 0, '', 0, '2016-12-05 14:23:09', 'insert');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE `sales` (
  `sale_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `controller_id` int(11) NOT NULL,
  `sale_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usertable`
--

DROP TABLE IF EXISTS `usertable`;
CREATE TABLE `usertable` (
  `user_id` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  `username` varchar(30) NOT NULL,
  `userpassword` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `usertable`
--

INSERT INTO `usertable` (`user_id`, `email`, `username`, `userpassword`) VALUES
(1, 'admin@gmail.com', 'admin', 'password'),
(2, 's@gmail.com', 'spartan', '117'),
(3, 'slc@gmail.com', 'slc', 'slc'),
(4, 'johndoe@gmail.com', 'johnd', '1234'),
(5, 'janedoe@gmail.com', 'janed', '1234'),
(6, 'johndoe@hotmail.com', 'jdoe', 'john1234'),
(7, 'janed@hotmail.com', 'JDoe', 'jane1234'),
(32, 'jd@hotmail.com', 'JD', 'jd1234'),
(33, '123@hotmail.com', '123', '123'),
(34, '1234@gmail.com', '1234', '1234'),
(35, 'conor1@gmail.com', 'conor1', 'conor1');

--
-- Triggers `usertable`
--
DROP TRIGGER IF EXISTS `AfterAddingUser`;
DELIMITER $$
CREATE TRIGGER `AfterAddingUser` AFTER INSERT ON `usertable` FOR EACH ROW BEGIN
	INSERT into logtable
    SET action = 'insert',
    user_id = NEW.user_id,
	email = NEW.email,
    username = NEW.username,
    userpassword = NEW.userpassword,
    changedate = NOW();
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `consoles`
--
ALTER TABLE `consoles`
  ADD PRIMARY KEY (`console_id`);

--
-- Indexes for table `controllers`
--
ALTER TABLE `controllers`
  ADD PRIMARY KEY (`controller_id`);

--
-- Indexes for table `logtable`
--
ALTER TABLE `logtable`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_id`),
  ADD KEY `user_id` (`user_id`,`controller_id`),
  ADD KEY `user_id_2` (`user_id`),
  ADD KEY `user_id_3` (`user_id`);

--
-- Indexes for table `usertable`
--
ALTER TABLE `usertable`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `consoles`
--
ALTER TABLE `consoles`
  MODIFY `console_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `controllers`
--
ALTER TABLE `controllers`
  MODIFY `controller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `logtable`
--
ALTER TABLE `logtable`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sale_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usertable`
--
ALTER TABLE `usertable`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
