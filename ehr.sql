-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 30, 2023 at 11:26 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ehr`
--

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `cats_name` varchar(255) NOT NULL,
  `owners_name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `allergy` varchar(255) DEFAULT NULL,
  `vaccination` varchar(255) DEFAULT NULL,
  `sprayed_neutered` enum('yes','no') NOT NULL,
  `notes` text DEFAULT NULL,
  `record_date` date NOT NULL,
  `vet_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `cats_name`, `owners_name`, `phone_number`, `birth_date`, `weight`, `gender`, `allergy`, `vaccination`, `sprayed_neutered`, `notes`, `record_date`, `vet_id`) VALUES
(1, 'Persik', 'Mariia Shakalova', '01752348765', '2020-01-15', '6.00', 'male', 'none', 'up to date', 'yes', 'Happy healthy ginger cat', '2023-01-24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`) VALUES
(1, 'Assiya Kakimova', 'asy1', 'asy@gmail.com', '$2y$10$bMxJLFBneWMWIzG3RWgNpOq3DGHtEp2NMXohPB28gf5Sg2gSh7.Se'),
(10, 'Tamara Petrovna', 'tama1', 'tamara@gmail.com', '$2y$10$WYV99/CNrNI2pdLxZydBf.YxIcc1cgunxxLoa46fCcYX4wVrPMJ2K');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vet_id` (`vet_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`vet_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
