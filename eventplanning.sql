-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2020 at 09:07 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventplanning`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `AdminID` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `BillID` int(255) NOT NULL,
  `RegID` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `Start_Date` date NOT NULL,
  `End_Date` date NOT NULL,
  `Total` int(20) NOT NULL,
  `CurrencyID` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `CurrencyID` int(255) NOT NULL,
  `C_Name` varchar(255) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Value` int(10) NOT NULL,
  `Local_Currency_Value` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `eventss`
--

CREATE TABLE `eventss` (
  `EventID` int(255) NOT NULL,
  `Title` varchar(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Start_Date` date NOT NULL,
  `End_Date` date NOT NULL,
  `Cost` int(255) NOT NULL,
  `CurrencyID` int(255) DEFAULT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `LocationID` int(255) NOT NULL,
  `SponsorID` int(255) NOT NULL,
  `TypeID` int(255) NOT NULL,
  `UserID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `event_registration`
--

CREATE TABLE `event_registration` (
  `RegID` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `num_people` int(255) NOT NULL,
  `Cost` int(255) NOT NULL,
  `total` int(255) NOT NULL,
  `Start_Datee` date NOT NULL,
  `End_Datee` date NOT NULL,
  `CurrencyID` int(255) DEFAULT NULL,
  `EventID` int(255) NOT NULL,
  `UserID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `event_type`
--

CREATE TABLE `event_type` (
  `TypeID` int(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `Min_People` int(3) NOT NULL,
  `Max_People` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `LocationID` int(255) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `L_Address` varchar(200) NOT NULL,
  `MaxCapacity` int(30) NOT NULL,
  `ManagerID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `managers`
--

CREATE TABLE `managers` (
  `ManagerID` int(255) NOT NULL,
  `M_Name` varchar(50) NOT NULL,
  `Number` varchar(30) NOT NULL,
  `M_Address` varchar(255) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `OfferID` int(255) NOT NULL,
  `SponsorID` int(255) NOT NULL,
  `EventID` int(255) NOT NULL,
  `CurrencyID` int(255) NOT NULL,
  `Price` int(20) NOT NULL,
  `OfferDescription` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

CREATE TABLE `privileges` (
  `PrivilegeID` int(255) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `ScreenID` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `RoleID` int(255) NOT NULL,
  `Description` varchar(255) NOT NULL,
  `PrivilegeID` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `screens`
--

CREATE TABLE `screens` (
  `ScreenID` int(30) NOT NULL,
  `Description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sponsors`
--

CREATE TABLE `sponsors` (
  `SponsorID` int(255) NOT NULL,
  `S_Name` varchar(50) NOT NULL,
  `Number` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` varchar(100) NOT NULL,
  `Activated` tinyint(1) NOT NULL,
  `Start_Date` date NOT NULL,
  `End_Date` date NOT NULL,
  `RoleID` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `verify`
--

CREATE TABLE `verify` (
  `VerifyID` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `RoleID` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`BillID`),
  ADD KEY `reg_id` (`RegID`),
  ADD KEY `currency_id_f` (`CurrencyID`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`CurrencyID`);

--
-- Indexes for table `eventss`
--
ALTER TABLE `eventss`
  ADD PRIMARY KEY (`EventID`),
  ADD KEY `currency_id_f2` (`CurrencyID`),
  ADD KEY `sponsor_id_f2` (`SponsorID`),
  ADD KEY `type_id_f2` (`TypeID`),
  ADD KEY `user_id_f2` (`UserID`),
  ADD KEY `location_id_f2` (`LocationID`);

--
-- Indexes for table `event_registration`
--
ALTER TABLE `event_registration`
  ADD PRIMARY KEY (`RegID`),
  ADD KEY `currency_id_fff` (`CurrencyID`),
  ADD KEY `event_id_f1` (`EventID`),
  ADD KEY `user_id_ff4` (`UserID`);

--
-- Indexes for table `event_type`
--
ALTER TABLE `event_type`
  ADD PRIMARY KEY (`TypeID`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`LocationID`),
  ADD KEY `Manager_id_F` (`ManagerID`);

--
-- Indexes for table `managers`
--
ALTER TABLE `managers`
  ADD PRIMARY KEY (`ManagerID`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`OfferID`),
  ADD KEY `f_sponsor_id` (`SponsorID`),
  ADD KEY `currency_id_ff` (`CurrencyID`),
  ADD KEY `event_id_ff` (`EventID`);

--
-- Indexes for table `privileges`
--
ALTER TABLE `privileges`
  ADD PRIMARY KEY (`PrivilegeID`),
  ADD KEY `Foreign Key` (`ScreenID`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`RoleID`),
  ADD KEY `ForeignKey` (`PrivilegeID`);

--
-- Indexes for table `screens`
--
ALTER TABLE `screens`
  ADD PRIMARY KEY (`ScreenID`);

--
-- Indexes for table `sponsors`
--
ALTER TABLE `sponsors`
  ADD PRIMARY KEY (`SponsorID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `role_id_f` (`RoleID`);

--
-- Indexes for table `verify`
--
ALTER TABLE `verify`
  ADD PRIMARY KEY (`VerifyID`),
  ADD KEY `role_id_fff` (`RoleID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `AdminID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `BillID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `CurrencyID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `eventss`
--
ALTER TABLE `eventss`
  MODIFY `EventID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_registration`
--
ALTER TABLE `event_registration`
  MODIFY `RegID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_type`
--
ALTER TABLE `event_type`
  MODIFY `TypeID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `LocationID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `managers`
--
ALTER TABLE `managers`
  MODIFY `ManagerID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `OfferID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privileges`
--
ALTER TABLE `privileges`
  MODIFY `PrivilegeID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `RoleID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `screens`
--
ALTER TABLE `screens`
  MODIFY `ScreenID` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sponsors`
--
ALTER TABLE `sponsors`
  MODIFY `SponsorID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verify`
--
ALTER TABLE `verify`
  MODIFY `VerifyID` int(255) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `currency_id_f` FOREIGN KEY (`CurrencyID`) REFERENCES `currencies` (`CurrencyID`),
  ADD CONSTRAINT `reg_id` FOREIGN KEY (`RegID`) REFERENCES `event_registration` (`RegID`);

--
-- Constraints for table `eventss`
--
ALTER TABLE `eventss`
  ADD CONSTRAINT `currency_id_f2` FOREIGN KEY (`CurrencyID`) REFERENCES `currencies` (`CurrencyID`),
  ADD CONSTRAINT `location_id_f2` FOREIGN KEY (`LocationID`) REFERENCES `locations` (`LocationID`),
  ADD CONSTRAINT `sponsor_id_f2` FOREIGN KEY (`SponsorID`) REFERENCES `sponsors` (`SponsorID`),
  ADD CONSTRAINT `type_id_f2` FOREIGN KEY (`TypeID`) REFERENCES `event_type` (`TypeID`),
  ADD CONSTRAINT `user_id_f2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `event_registration`
--
ALTER TABLE `event_registration`
  ADD CONSTRAINT `currency_id_fff` FOREIGN KEY (`CurrencyID`) REFERENCES `currencies` (`CurrencyID`),
  ADD CONSTRAINT `event_id_f1` FOREIGN KEY (`EventID`) REFERENCES `eventss` (`EventID`),
  ADD CONSTRAINT `user_id_ff4` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `Manager_id_F` FOREIGN KEY (`ManagerID`) REFERENCES `managers` (`ManagerID`);

--
-- Constraints for table `offers`
--
ALTER TABLE `offers`
  ADD CONSTRAINT `currency_id_ff` FOREIGN KEY (`CurrencyID`) REFERENCES `currencies` (`CurrencyID`),
  ADD CONSTRAINT `event_id_ff` FOREIGN KEY (`EventID`) REFERENCES `eventss` (`EventID`),
  ADD CONSTRAINT `f_sponsor_id` FOREIGN KEY (`SponsorID`) REFERENCES `sponsors` (`SponsorID`);

--
-- Constraints for table `privileges`
--
ALTER TABLE `privileges`
  ADD CONSTRAINT `Foreign Key` FOREIGN KEY (`ScreenID`) REFERENCES `screens` (`ScreenID`);

--
-- Constraints for table `roles`
--
ALTER TABLE `roles`
  ADD CONSTRAINT `ForeignKey` FOREIGN KEY (`PrivilegeID`) REFERENCES `privileges` (`PrivilegeID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `role_id_f` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`);

--
-- Constraints for table `verify`
--
ALTER TABLE `verify`
  ADD CONSTRAINT `role_id_fff` FOREIGN KEY (`RoleID`) REFERENCES `roles` (`RoleID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
