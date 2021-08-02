-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2020 at 02:53 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acme`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryId` int(10) UNSIGNED NOT NULL,
  `categoryName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Category classifications of inventory items';

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`) VALUES
(1, 'Cannon'),
(2, 'Explosive'),
(3, 'Misc'),
(4, 'Rocket'),
(5, 'Trap');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comments`) VALUES
(2, 'Sunday', 'Onwuchekwa', 'donsonde@gmail.com', '$2y$10$FSkwrGOT7QuXyRGNe./OE.iAv8bCT0IDwgKxv7AkPLhua/w7JeAte', '1', NULL),
(3, 'Sampson', 'Ekow', 'donsonde@aol.com', '$2y$10$9MbtE3SCBCnxNUgAttzRC.OzLLMX/I2BwO01J/ihKVnH/HrbbQAGy', '1', NULL),
(6, 'Martha', 'Offei', 'donsonde@yahoo.com', '$2y$10$pBB.4zhfDpNfNDW6U71c2.3rWKzb8FRJwva3b0btmg9wIsHxM.dPK', '1', NULL),
(7, 'Christopher', 'Adjin', 'talk2donsonde@yahoo.com', '$2y$10$80DVBJPCZasJi3uewaj/aO2DBoudwyZ.NHVZlzG7qKcj1qNB61ita', '1', NULL),
(8, 'Thelma', 'Tannor', 'ttannor@ssnit.org.gh', '$2y$10$zxcxV7KILnLggTdZka5y5Oauq3nGIOdDBB0LQb/IqzFN.PAlL65hW', '1', NULL),
(9, 'Admin', 'User', 'admin@cit336.net', '$2y$10$WI7dk6v6B0AW4xdmmRIWnu.2EECBsIOslCNn9KzWIQHKRKISjZ1l.', '3', NULL),
(10, 'Barbara', 'Cobblah', 'bibicobb@yahoo.com', '$2y$10$1h2ldS5iJ4ZoTMSb3r4vJ.LEw7c/HR.lWbTOw8N8cLy9yZPItwbXK', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(10) UNSIGNED NOT NULL,
  `invId` int(10) UNSIGNED NOT NULL,
  `imgName` varchar(100) CHARACTER SET latin1 NOT NULL,
  `imgPath` varchar(150) CHARACTER SET latin1 NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`) VALUES
(5, 8, 'anvil.png', '/acme/images/products/anvil.png', '2020-03-19 22:44:08'),
(6, 8, 'anvil-tn.png', '/acme/images/products/anvil-tn.png', '2020-03-19 22:44:08'),
(7, 3, 'catapult.png', '/acme/images/products/catapult.png', '2020-03-19 22:50:23'),
(8, 3, 'catapult-tn.png', '/acme/images/products/catapult-tn.png', '2020-03-19 22:50:23'),
(9, 14, 'helmet.png', '/acme/images/products/helmet.png', '2020-03-19 22:51:03'),
(10, 14, 'helmet-tn.png', '/acme/images/products/helmet-tn.png', '2020-03-19 22:51:03'),
(11, 4, 'roadrunner.jpg', '/acme/images/products/roadrunner.jpg', '2020-03-19 22:52:49'),
(12, 4, 'roadrunner-tn.jpg', '/acme/images/products/roadrunner-tn.jpg', '2020-03-19 22:52:49'),
(13, 5, 'trap.jpg', '/acme/images/products/trap.jpg', '2020-03-19 22:53:43'),
(14, 5, 'trap-tn.jpg', '/acme/images/products/trap-tn.jpg', '2020-03-19 22:53:43'),
(15, 13, 'piano.jpg', '/acme/images/products/piano.jpg', '2020-03-19 22:55:03'),
(16, 13, 'piano-tn.jpg', '/acme/images/products/piano-tn.jpg', '2020-03-19 22:55:03'),
(17, 6, 'hole.png', '/acme/images/products/hole.png', '2020-03-19 22:55:43'),
(18, 6, 'hole-tn.png', '/acme/images/products/hole-tn.png', '2020-03-19 22:55:43'),
(19, 7, 'no-image.png', '/acme/images/products/no-image.png', '2020-03-19 22:56:29'),
(20, 7, 'no-image-tn.png', '/acme/images/products/no-image-tn.png', '2020-03-19 22:56:29'),
(21, 10, 'mallet.png', '/acme/images/products/mallet.png', '2020-03-19 22:59:32'),
(22, 10, 'mallet-tn.png', '/acme/images/products/mallet-tn.png', '2020-03-19 22:59:32'),
(23, 9, 'rubberband.jpg', '/acme/images/products/rubberband.jpg', '2020-03-19 23:01:05'),
(24, 9, 'rubberband-tn.jpg', '/acme/images/products/rubberband-tn.jpg', '2020-03-19 23:01:05'),
(25, 2, 'mortar.jpg', '/acme/images/products/mortar.jpg', '2020-03-19 23:01:22'),
(26, 2, 'mortar-tn.jpg', '/acme/images/products/mortar-tn.jpg', '2020-03-19 23:01:23'),
(27, 15, 'rope.jpg', '/acme/images/products/rope.jpg', '2020-03-19 23:02:01'),
(28, 15, 'rope-tn.jpg', '/acme/images/products/rope-tn.jpg', '2020-03-19 23:02:01'),
(29, 12, 'seed.jpg', '/acme/images/products/seed.jpg', '2020-03-19 23:03:00'),
(30, 12, 'seed-tn.jpg', '/acme/images/products/seed-tn.jpg', '2020-03-19 23:03:00'),
(31, 1, 'rocket.png', '/acme/images/products/rocket.png', '2020-03-19 23:04:15'),
(32, 1, 'rocket-tn.png', '/acme/images/products/rocket-tn.png', '2020-03-19 23:04:15'),
(33, 17, 'bomb.png', '/acme/images/products/bomb.png', '2020-03-19 23:04:35'),
(34, 17, 'bomb-tn.png', '/acme/images/products/bomb-tn.png', '2020-03-19 23:04:35'),
(35, 16, 'fence.png', '/acme/images/products/fence.png', '2020-03-19 23:05:10'),
(36, 16, 'fence-tn.png', '/acme/images/products/fence-tn.png', '2020-03-19 23:05:10'),
(37, 11, 'tnt.png', '/acme/images/products/tnt.png', '2020-03-19 23:05:26'),
(38, 11, 'tnt-tn.png', '/acme/images/products/tnt-tn.png', '2020-03-19 23:05:26'),
(39, 4, 'duck.0.png', '/acme/images/products/duck.0.png', '2020-03-20 00:33:48'),
(40, 4, 'duck.0-tn.png', '/acme/images/products/duck.0-tn.png', '2020-03-20 00:33:48'),
(41, 7, 'dog.jpg', '/acme/images/products/dog.jpg', '2020-03-20 00:36:23'),
(42, 7, 'dog-tn.jpg', '/acme/images/products/dog-tn.jpg', '2020-03-20 00:36:23'),
(45, 14, 'IMG_7013.jpg', '/acme/images/products/IMG_7013.jpg', '2020-03-20 00:42:26'),
(46, 14, 'IMG_7013-tn.jpg', '/acme/images/products/IMG_7013-tn.jpg', '2020-03-20 00:42:26');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(10) UNSIGNED NOT NULL,
  `invName` varchar(50) NOT NULL DEFAULT '',
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL DEFAULT '',
  `invThumbnail` varchar(50) NOT NULL DEFAULT '',
  `invPrice` decimal(10,2) NOT NULL DEFAULT 0.00,
  `invStock` smallint(6) NOT NULL DEFAULT 0,
  `invSize` smallint(6) NOT NULL DEFAULT 0,
  `invWeight` smallint(6) NOT NULL DEFAULT 0,
  `invLocation` varchar(35) NOT NULL DEFAULT '',
  `categoryId` int(10) UNSIGNED NOT NULL,
  `invVendor` varchar(20) NOT NULL DEFAULT '',
  `invStyle` varchar(20) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Acme Inc. Inventory Table';

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invName`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invSize`, `invWeight`, `invLocation`, `categoryId`, `invVendor`, `invStyle`) VALUES
(1, 'Rocket', 'Rocket for multiple purposes. This can be launched independently to deliver a payload or strapped on to help get you to where you want to be FAST!!! Really Fast!', '/acme/images/products/rocket.png', '/acme/images/products/rocket-tn.png', '1320.00', 5, 60, 90, 'California', 4, 'Goddard', 'metal'),
(2, 'Mortar', 'Our Mortar is very powerful. This cannon can launch a projectile or bomb 3 miles. Made of solid steel and mounted on cement or metal stands [not included].', '/acme/images/products/mortar.jpg', '/acme/images/products/mortar-tn.jpg', '1500.00', 26, 250, 750, 'San Jose', 1, 'Smith & Wesson', 'Metal'),
(3, 'Catapult', 'Our best wooden catapult. Ideal for hurling objects for up to 1000 yards. Payloads of up to 300 lbs.', '/acme/images/products/catapult.png', '/acme/images/products/catapult-tn.png', '2500.00', 4, 1569, 400, 'Cedar Point, IO', 1, 'Wooden Creations', 'Wood'),
(4, 'Female RoadRunner Cutout', 'This carbon fiber backed cutout of a female roadrunner is sure to catch the eye of any male roadrunner.', '/acme/images/products/roadrunner.jpg', '/acme/images/products/roadrunner-tn.jpg', '20.00', 500, 27, 2, 'San Jose', 5, 'Picture Perfect', 'Carbon Fiber'),
(5, 'Giant Mouse Trap', 'Our big mouse trap. This trap is multifunctional. It can be used to catch dogs, mountain lions, road runners or even muskrats. Must be staked for larger varmints [stakes not included] and baited with approptiate bait [sold seperately].\r\n', '/acme/images/products/trap.jpg', '/acme/images/products/trap-tn.jpg', '20.00', 34, 470, 28, 'Cedar Point, IO', 5, 'Rodent Control', 'Wood'),
(6, 'Instant Hole', 'Instant hole - Wonderful for creating the appearance of openings.', '/acme/images/products/hole.png', '/acme/images/products/hole-tn.png', '25.00', 269, 24, 2, 'San Jose', 3, 'Hidden Valley', 'Ether'),
(7, 'Koenigsegg CCX', 'This high performance car is sure to get you where you are going fast. It holds the production car land speed record at an amazing 250mph.', '/acme/images/products/no-image.png', '/acme/images/products/no-image.png', '500000.00', 1, 25000, 3000, 'San Jose', 3, 'Koenigsegg', 'Metal'),
(8, 'Anvil', '50 lb. Anvil - perfect for any task requireing lots of weight. Made of solid, tempered steel.', '/acme/images/products/anvil.png', '/acme/images/products/anvil-tn.png', '150.00', 15, 80, 50, 'San Jose', 5, 'Steel Made', 'Metal'),
(9, 'Monster Rubber Band', 'These are not tiny rubber bands. These are MONSTERS! These bands can stop a train locamotive or be used as a slingshot for cows. Only the best materials are used!', '/acme/images/products/rubberband.jpg', '/acme/images/products/rubberband-tn.jpg', '4.00', 4589, 75, 1, 'Cedar Point, IO', 3, 'Rubbermaid', 'Rubber'),
(10, 'Mallet', 'Ten pound mallet for bonking roadrunners on the head. Can also be used for bunny rabbits.', '/acme/images/products/mallet.png', '/acme/images/products/mallet-tn.png', '25.00', 100, 36, 10, 'Cedar Point, IA', 3, 'Wooden Creations', 'Wood'),
(11, 'TNT', 'The biggest bang for your buck with our nitro-based TNT. Price is per stick.', '/acme/images/products/tnt.png', '/acme/images/products/tnt-tn.png', '10.00', 1000, 25, 2, 'San Jose', 2, 'Nobel Enterprises', 'Plastic'),
(12, 'Roadrunner Custom Bird Seed Mix', 'Our best varmint seed mix - varmints on two or four legs can\'t resist this mix. Contains meat, nuts, cereals and our own special ingredient. Guaranteed to bring them in. Can be used with our monster trap.', '/acme/images/products/seed.jpg', '/acme/images/products/seed-tn.jpg', '8.00', 150, 24, 3, 'San Jose', 5, 'Acme', 'Plastic'),
(13, 'Grand Piano', 'This grand piano is guaranteed to play well and smash anything beneath it if dropped from a height.', '/acme/images/products/piano.jpg', '/acme/images/products/piano-tn.jpg', '3500.00', 36, 500, 1200, 'Cedar Point, IA', 3, 'Wulitzer', 'Wood'),
(14, 'Crash Helmet', 'This carbon fiber and plastic helmet is the ultimate in protection for your head. comes in assorted colors.', '/acme/images/products/helmet.png', '/acme/images/products/helmet-tn.png', '100.00', 25, 48, 9, 'San Jose', 3, 'Suzuki', 'Carbon Fiber'),
(15, 'Nylon Rope', 'This nylon rope is ideal for all uses. Each rope is the highest quality nylon and comes in 100 foot lengths.', '/acme/images/products/rope.jpg', '/acme/images/products/rope-tn.jpg', '15.00', 200, 200, 6, 'San Jose', 3, 'Marina Sales', 'Nylon'),
(16, 'Sticky Fence', 'This fence is covered with Gorilla Glue and is guaranteed to stick to anything that touches it and is sure to hold it tight.', '/acme/images/products/fence.png', '/acme/images/products/fence-tn.png', '75.00', 15, 48, 2, 'San Jose', 3, 'Acme', 'Nylon'),
(17, 'Small Bomb', 'Bomb with a fuse - A little old fashioned, but highly effective. This bomb has the ability to devistate anything within 30 feet.', '/acme/images/products/bomb.png', '/acme/images/products/bomb-tn.png', '275.00', 58, 30, 12, 'San Jose', 2, 'Nobel Enterprises', 'Metal');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(10) UNSIGNED NOT NULL,
  `reviewText` text CHARACTER SET latin1 NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `invId` int(10) UNSIGNED NOT NULL,
  `clientId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(1, 'This is the first review for this product', '2020-03-27 20:31:44', 2, 2),
(4, 'You should change the product image. Do not display a product if there is no image.', '2020-03-28 01:21:25', 7, 3),
(5, 'This is adorable. It is indeed a monster trap. No way in or out.', '2020-03-28 01:22:25', 12, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`),
  ADD UNIQUE KEY `clientEmail` (`clientEmail`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `fk_inv_image` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `FK_reviews_clients` (`clientId`),
  ADD KEY `FK_reviews_inventory` (`invId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `fk_inv_image` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_clients` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_inventory` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
