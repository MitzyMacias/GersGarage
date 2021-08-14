-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Aug 12, 2021 at 09:35 PM
-- Server version: 5.7.30
-- PHP Version: 7.4.9

SET SQL_MODE
= "NO_AUTO_VALUE_ON_ZERO";
SET time_zone
= "+00:00";

--
-- Database: `garage`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins`
(
  `id_mech` int
(255) NOT NULL,
  `username` varchar
(20) NOT NULL,
  `psw` varchar
(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`
id_mech`,
`username
`, `psw`) VALUES
(1, 'ger', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings`
(
  `id_booking` int
(255) NOT NULL,
  `id_cust` int
(255) NOT NULL,
  `id_mech` int
(255) DEFAULT NULL,
  `lic_plate` varchar
(50) NOT NULL,
  `comments` mediumtext,
  `type_serv` varchar
(50) NOT NULL,
  `adm_time` time NOT NULL,
  `adm_date` date NOT NULL,
  `status` varchar
(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`
id_booking`,
`id_cust
`, `id_mech`, `lic_plate`, `comments`, `type_serv`, `adm_time`, `adm_date`, `status`) VALUES
(8, 21, 3, '182D1111', 'please check the high lights.', 'annual', '09:00:00', '2021-07-31', 'completed'),
(9, 21, 1, '182D1111', 'please check the high lights.', 'major repair', '00:00:00', '2021-08-08', 'cancelled'),
(10, 25, 3, '190D5821', 'Please check the windshields.', 'major', '09:00:00', '2021-08-10', 'completed'),
(11, 21, 2, '182D1111', 'ok nothing ', 'major', '09:00:00', '2021-08-15', 'cancelled'),
(12, 21, 3, '182D1111', 'please check the high lights.', 'fault repair', '09:00:00', '2021-08-05', 'unrepairable'),
(13, 25, 5, '213D1982', 'please do not wash', 'major', '09:00:00', '2021-07-18', 'completed'),
(14, 26, 2, '092D1982', 'Please check the brakes', 'fault repair', '09:00:00', '2021-07-24', 'cancelled'),
(15, 25, 2, '213D1982', 'LIGHTS PLEASE', 'FAULT REPAIR', '09:00:00', '2021-08-31', 'booked'),
(17, 21, NULL, '182D1111', 'ALL OK2', 'MAJOR', '09:00:00', '2021-08-31', 'BOOKED'),
(18, 21, NULL, '200D1981', 'NOT YET', 'ANNUAL', '09:00:00', '2021-08-31', 'BOOKED'),
(19, 21, NULL, '200D1981', 'NOOO', 'ANNUAL', '09:00:00', '2021-08-31', 'BOOKED'),
(25, 21, 2, '213D1988', 'PLEASE DO NOT WASH IT.', 'ANNUAL', '09:00:00', '2021-09-01', 'booked'),
(26, 21, NULL, '200D1981', 'ASDASD', 'ANNUAL', '09:00:00', '2021-08-30', 'BOOKED'),
(36, 25, NULL, '213D1982', 'ALL OK', 'ANNUAL', '12:00:00', '2021-08-31', 'BOOKED'),
(37, 25, NULL, '213D1982', 'NOTHING', 'ANNUAL', '12:00:00', '2021-08-31', 'BOOKED');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers`
(
  `id_cust` int
(255) NOT NULL,
  `first_name` varchar
(50) NOT NULL,
  `last_name` varchar
(50) NOT NULL,
  `address` varchar
(200) NOT NULL,
  `DOB` date NOT NULL,
  `mobile` varchar
(10) NOT NULL,
  `email` varchar
(200) NOT NULL,
  `username` varchar
(20) NOT NULL,
  `psw` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`
id_cust`,
`first_name
`, `last_name`, `address`, `DOB`, `mobile`, `email`, `username`, `psw`) VALUES
(1, 'Mitzy', 'Macias', 'Portobello', '1988-12-12', '0834264619', 'mitzynela@gmail.com', 'mitzynela', 'test'),
(3, 'Pancho', 'Lopez', 'Portmarnock', '1988-01-12', '083425544', 'pancholopez@gmail.com', 'pancholopez', 'test'),
(4, 'Octavio', 'Rodriguez', 'Stamer', '1983-01-19', '083525544', 'riusland@gmail.com', 'roro', 'test'),
(5, 'Annie', 'Macias', 'Lomas', '1983-05-13', '3121351330', 'annie@gmail.com', 'annie', 'hola'),
(6, 'Aida', 'Tower', 'River', '1959-02-02', '3121318201', 'aida@gmail.com', 'aida', 'hola'),
(7, 'Antonia', 'Allie', 'Yield', '1981-05-20', '0834264646', 'antony@gmail.com', 'antony', 'test'),
(8, 'Allie', 'Nathan', 'Ashtown', '1989-12-18', '0831231258', 'allie@gmail.com', 'allie', 'test'),
(9, 'Label', 'Martins', 'Vancouver', '1936-11-02', '0834251177', 'labelle@ross.com', 'labelle', 'ross'),
(10, 'Mary', 'Quinn', 'Portobello', '1935-10-10', '0852551144', 'geoghegan06@gmail.com', 'maryg', 'plenty'),
(12, 'Kevin', 'Roldan', '23 Stamer Street Portobello', '1986-06-06', '0851245896', 'kevinwashere@outlook.com', 'kevin', '$2y$04$ogI.5ZwKZ3DawfZaEo3xcujmywvNwskZdB9UX1jILvGauwMA4.EiO'),
(13, 'Keep', 'Itdown', 'Keept it down', '1955-08-01', '0871234444', 'keepit@down.com', 'keepitdown', '$2y$04$SSTdF2TDyyAlOElRT/upJ.Jkwsd9wL5CXzj/Qlm00DchVH2wp4Wee'),
(19, 'John', 'Cars', 'Booling', '0001-02-04', '0882452154', 'johnhere@here.com', 'john', '$2y$04$dwk7us6echAKoG04I2B6GO.K/SV0I.EU4pm3l1Ukg3p7l9WzZ4QXy'),
(20, 'Olaf', 'Garreth', 'Henry Street', '1950-01-20', '0835228844', 'olafgarreth25@gmail.com', 'olafgarreth', '$2y$04$2FKNKwntQ18nenoJGPX/BuQj5I6V9yRtxZF4XKwVJSFDPWNeVEKna'),
(21, 'MITZY', 'MACIAS', '25 BLOOMFIELD AVENUE', '1999-12-01', '0834264619', 'mitzynela4@gmail.com', 'mitzy', '$2y$04$r.Oul6eHVmWE.fvSWqcjJOERkP5QRZ6HObdircD0GHPf0J9K3WhOm'),
(22, 'Mitzy', 'Mac', 'Joasd', '1994-04-04', '082456456', 'mitzyland@holalcom.com', 'mitzyland', '$2y$04$QJ8LOPPsNVo8xwjYs2oAiOHII2I38htCljjE7T3GEMy1MEADIz70C'),
(24, 'Ger', 'McGuiness', 'Dublin', '1990-01-01', '0853552555', 'geradmin@gmail.com', 'admin', '$2y$04$JAr8/aP1sJ/k8mcD0YwYJOyjst9IsgJBDZdi4qKiiJiqmCH7fU9pO'),
(25, 'Octavio', 'Rius', 'Stamer', '1988-01-13', '0833552622', 'rius@rius.com', 'rius', '$2y$04$klQo/l/i8NC2ZjWb/.ra5e2J5WwfblXGQ1lkKyHPqtI3WeumY2Wxy'),
(26, 'Anna', 'Blooming', 'Rathfarnham', '1982-01-25', '0852589645', 'anna@anna.com', 'anna', '$2y$04$ta9iQK8rtYG2yZDne81kzet3ySoMPCEVsMsZYCiaVIIZDEmUnPER6');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices`
(
  `id_invoice` int
(255) NOT NULL,
  `id_mech` int
(255) NOT NULL,
  `id_service` int
(255) DEFAULT NULL,
  `id_part` varchar
(50) DEFAULT NULL,
  `date_issue` date NOT NULL,
  `id_cust` int
(255) NOT NULL,
  `lic_plate` varchar
(50) NOT NULL,
  `total` decimal
(8,2) NOT NULL,
  `status` int
(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`
id_invoice`,
`id_mech
`, `id_service`, `id_part`, `date_issue`, `id_cust`, `lic_plate`, `total`, `status`) VALUES
(1, 3, 1, 'BAT001', '2021-08-11', 25, '213D1982', '900.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mechanics`
--

CREATE TABLE `mechanics`
(
  `id_mech` int
(255) NOT NULL,
  `first_name` varchar
(50) NOT NULL,
  `last_name` varchar
(50) NOT NULL,
  `address` varchar
(200) NOT NULL,
  `DOB` date NOT NULL,
  `mobile` varchar
(10) NOT NULL,
  `email` varchar
(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mechanics`
--

INSERT INTO `mechanics` (`
id_mech`,
`first_name
`, `last_name`, `address`, `DOB`, `mobile`, `email`) VALUES
(1, 'Ger', 'McCarthy', 'Stamer Street', '1970-01-01', '0833552224', 'ger@gersgarage.com'),
(2, 'Patrick', 'Murphy', 'Cork Street', '1975-10-21', '0833251224', 'patrick@gersgarage.com'),
(3, 'Bryan', 'Varadkar', 'Synge Street', '1980-05-21', '0834223678', 'bryan@gersgarage.com'),
(4, 'James', 'Corden', 'Bradshaw Street', '1988-11-05', '0834263680', 'james@gersgarage.com'),
(5, 'Noah', 'Gallagher', 'Fairview Street', '1979-08-03', '0834223118', 'noah@gersgarage.com');

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts`
(
  `id_part` varchar
(50) NOT NULL,
  `id_invoice` int
(255) DEFAULT NULL,
  `concept` varchar
(100) NOT NULL,
  `price` decimal
(6,2) NOT NULL,
  `qty` int
(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`
id_part`,
`id_invoice
`, `concept`, `price`, `qty`) VALUES
('ACC001', NULL, 'AC COMPRESSOR', '100.00', 5),
('ALT001', NULL, 'ALTERNATOR', '650.00', 10),
('ARB001', NULL, 'AIR BAG', '1500.00', 2),
('ARC001', NULL, 'AIR CONDITIONING', '200.00', 0),
('ARF001', NULL, 'AIR FILTER', '40.00', 5),
('ARF002', NULL, 'AIR FUEL CABIN FILTER', '25.00', 0),
('BAT001', NULL, 'BATTERY', '700.00', 0),
('BBM001', NULL, 'BACK BUMPERS', '550.00', 0),
('BRK001', NULL, 'BRAKES', '200.00', 0),
('CAR123', NULL, 'CAR DOOR', '50.00', 2),
('CHM001', NULL, 'CHASSIS CONTROL MODULE', '30.00', 0),
('CYL001', NULL, 'CYLINDERS', '250.00', 0),
('DOR001', NULL, 'DOOR', '1000.00', 0),
('ENC001', NULL, 'ENGINE COOLING', '200.00', 0),
('ENM001', NULL, 'ENGINE/MOTOR CONTROL MODULE', '625.00', 0),
('ENO001', NULL, 'ENGINE OIL', '45.00', 0),
('FBM001', NULL, 'FRONT BUMPERS', '670.00', 0),
('FEL001', NULL, 'FENDER LINERS', '220.00', 0),
('FLF001', NULL, 'FUEL FILTER', '70.00', 0),
('FWP001', NULL, 'FRONT WIPERS', '20.00', 0),
('GRL001', NULL, 'GRILLE', '350.00', 0),
('HDL001', NULL, 'HEAD LAMP', '37.00', 0),
('HET001', NULL, 'HEATING', '25.00', 0),
('HND001', NULL, 'HANDLE', '45.00', 0),
('HOD001', NULL, 'HOOD', '600.00', 0),
('ODS001', NULL, 'OIL DRAIN SUMP PLUG', '300.00', 0),
('OIF001', NULL, 'OIL FILTER', '15.00', 0),
('OUM001', NULL, 'OUTSIDE MIRROR', '99.00', 0),
('PIS001', NULL, 'PISTONS', '25.00', 100),
('PIS002', NULL, 'PISTONS EUROPE', '25.50', 25),
('PLF001', NULL, 'POLLEN FILTER', '50.00', 0),
('PSP001', NULL, 'POWER STEERING PUMP/MOTOR', '150.00', 0),
('RAD001', NULL, 'RADIATOR', '300.00', 0),
('RAD002', NULL, 'RADIATOR SUPPORT', '20.00', 0),
('RVM001', NULL, 'REAR-VIEW MIRROR', '20.00', 0),
('SET001', NULL, 'SEATS', '450.00', 0),
('SKN001', NULL, 'SPINDLE KNUCKLE', '68.00', 0),
('SMP001', NULL, 'SUMP PLUG', '140.00', 0),
('SPH001', NULL, 'SPEEDOMETER HEAD', '65.00', 0),
('SPP001', NULL, 'SPARK PLUGS', '20.00', 0),
('SVM001', NULL, 'SIDE VIEW MIRROR', '12.00', 0),
('TAB001', NULL, 'TAILGATE/BOOT', '25.00', 0),
('TAL001', NULL, 'TAIL LAMP', '150.00', 0),
('TBO001', NULL, 'TURBO', '250.00', 0),
('TNS001', NULL, 'TURN SIGNAL', '10.00', 0),
('TYR001', NULL, 'TYRES', '200.00', 20),
('WDS001', NULL, 'WINDSHIELD', '97.00', 0),
('WDW001', NULL, 'WINDOW', '75.00', 0),
('WHL001', NULL, 'WHEEL', '100.00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services`
(
  `id_service` int
(255) NOT NULL,
  `id_invoice` int
(255) DEFAULT NULL,
  `concept` varchar
(255) NOT NULL,
  `price` decimal
(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`
id_service`,
`id_invoice
`, `concept`, `price`) VALUES
(1, NULL, 'ANNUAL SERVICE', '200.00'),
(2, NULL, 'MAJOR SERVICE', '300.00'),
(3, NULL, 'REPAIR FAULT', '150.00'),
(4, NULL, 'MAJOR REPAIR', '300.00'),
(6, NULL, 'MOTOR DEEP CLEANING', '150.00');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles`
(
  `lic_plate` varchar
(50) NOT NULL,
  `id_cust` int
(255) NOT NULL,
  `type_veh` varchar
(50) NOT NULL,
  `engine_type` varchar
(50) NOT NULL,
  `make` varchar
(50) NOT NULL,
  `colour` varchar
(50) NOT NULL,
  `veh_year` varchar
(4) NOT NULL,
  `mileage` int
(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`
lic_plate`,
`id_cust
`, `type_veh`, `engine_type`, `make`, `colour`, `veh_year`, `mileage`) VALUES
('092D1982', 26, 'pick-up', 'Petrol', 'rover', 'Grey', '2009', 95000),
('182D1111', 21, 'VAN', 'PETROL', 'NISSAN', 'RED', '2000', 90000),
('190D5821', 25, 'Sedan', 'Petrol', 'nissan', 'White', '2009', 95580),
('200D1981', 21, 'VAN', 'Petrol', 'nicola', 'Grey', '2010', 85200),
('213D1982', 25, 'sedan', 'Petrol', 'toyota', 'Silver', '2010', 10000),
('213D1988', 21, 'SEDAN', 'PETROL', 'MINI', 'BLACK', '2010', 15000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
ADD KEY `fk_admin_mechanic`
(`id_mech`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
ADD PRIMARY KEY
(`id_booking`),
ADD KEY `fk_booking_customer`
(`id_cust`),
ADD KEY `fk_booking_mechanic`
(`id_mech`),
ADD KEY `fk_booking_vehicle`
(`lic_plate`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
ADD PRIMARY KEY
(`id_cust`),
ADD UNIQUE KEY `uq_email`
(`email`),
ADD UNIQUE KEY `uq_username`
(`username`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
ADD PRIMARY KEY
(`id_invoice`),
ADD KEY `fk_invoice_mechanic`
(`id_mech`),
ADD KEY `fk_invoice_customer`
(`id_cust`),
ADD KEY `fk_invoice_vehicle`
(`lic_plate`),
ADD KEY `fk_invoice_part`
(`id_part`),
ADD KEY `fk_invoice_service`
(`id_service`);

--
-- Indexes for table `mechanics`
--
ALTER TABLE `mechanics`
ADD PRIMARY KEY
(`id_mech`),
ADD UNIQUE KEY `uq_mechanic`
(`id_mech`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
ADD PRIMARY KEY
(`id_part`),
ADD UNIQUE KEY `uq_part`
(`id_part`),
ADD KEY `fk_part_invoice`
(`id_invoice`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
ADD PRIMARY KEY
(`id_service`),
ADD UNIQUE KEY `uq_service`
(`id_service`),
ADD KEY `fk_service_invoice`
(`id_invoice`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
ADD PRIMARY KEY
(`lic_plate`),
ADD KEY `fk_vehicle_customer`
(`id_cust`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id_booking` int
(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id_cust` int
(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id_invoice` int
(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mechanics`
--
ALTER TABLE `mechanics`
  MODIFY `id_mech` int
(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id_service` int
(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admins`
--
ALTER TABLE `admins`
ADD CONSTRAINT `fk_admin_mechanic` FOREIGN KEY
(`id_mech`) REFERENCES `mechanics`
(`id_mech`);

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
ADD CONSTRAINT `fk_booking_customer` FOREIGN KEY
(`id_cust`) REFERENCES `customers`
(`id_cust`),
ADD CONSTRAINT `fk_booking_mechanic` FOREIGN KEY
(`id_mech`) REFERENCES `mechanics`
(`id_mech`),
ADD CONSTRAINT `fk_booking_vehicle` FOREIGN KEY
(`lic_plate`) REFERENCES `vehicles`
(`lic_plate`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
ADD CONSTRAINT `fk_invoice_customer` FOREIGN KEY
(`id_cust`) REFERENCES `customers`
(`id_cust`),
ADD CONSTRAINT `fk_invoice_mechanic` FOREIGN KEY
(`id_mech`) REFERENCES `mechanics`
(`id_mech`),
ADD CONSTRAINT `fk_invoice_part` FOREIGN KEY
(`id_part`) REFERENCES `parts`
(`id_part`),
ADD CONSTRAINT `fk_invoice_service` FOREIGN KEY
(`id_service`) REFERENCES `services`
(`id_service`),
ADD CONSTRAINT `fk_invoice_vehicle` FOREIGN KEY
(`lic_plate`) REFERENCES `vehicles`
(`lic_plate`);

--
-- Constraints for table `parts`
--
ALTER TABLE `parts`
ADD CONSTRAINT `fk_part_invoice` FOREIGN KEY
(`id_invoice`) REFERENCES `invoices`
(`id_invoice`);

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
ADD CONSTRAINT `fk_vehicle_customer` FOREIGN KEY
(`id_cust`) REFERENCES `customers`
(`id_cust`);
