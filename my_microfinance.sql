-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2024 at 02:18 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_microfinance`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_account`
--

CREATE TABLE `bank_account` (
  `ba_id` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pin` varchar(4) NOT NULL,
  `balance` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bank_account`
--

INSERT INTO `bank_account` (`ba_id`, `fname`, `lname`, `email`, `pin`, `balance`) VALUES
(1, 'Safia', 'Shuaib', 'ss@gmail.com', '1234', 5000.00),
(2, 'George', 'Amfo', 'ga@gmail.com', '1234', 5000.00),
(3, 'Yakubu', 'Asanka', 'ya@gmail.com', '1234', 5000.00);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `c_id` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `amount_loaned_to` decimal(11,2) NOT NULL,
  `interest_rate` decimal(11,2) NOT NULL,
  `repayment_method` varchar(20) NOT NULL,
  `date_granted_loan` date NOT NULL,
  `due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`c_id`, `rid`, `client_name`, `email`, `amount_loaned_to`, `interest_rate`, `repayment_method`, `date_granted_loan`, `due_date`) VALUES
(33, 4, 'George Amfo', 'ga@gmail.com', 4500.00, 43.78, 'MOMO', '2024-07-23', '2024-07-27'),
(36, 4, 'Adam Anvil', 'aa@gmail.com', 2000.00, 15.00, 'MOMO', '2024-07-30', '2024-08-31'),
(37, 4, 'Bismark Amissah', 'ba@gmail.com', 2500.00, 20.00, 'Bank-Account', '2024-07-30', '2024-08-31'),
(38, 4, 'Candace Andrew', 'ca@gmail.com', 3000.00, 25.00, 'MOMO', '2024-07-30', '2024-08-31'),
(39, 4, 'Dennis Armah', 'da@gmail.com', 2000.00, 15.00, 'Bank-Account', '2024-07-30', '2024-08-31'),
(40, 4, 'Essel Ahmed', 'ea@gmail.com', 2500.00, 20.00, 'MOMO', '2024-07-30', '2024-08-31'),
(41, 4, 'Fatima Alhassan', 'fa@gmail.com', 3000.00, 25.00, 'Bank-Account', '2024-07-30', '2024-08-31'),
(42, 4, 'Grace Ampofo', 'ha@gmail.com', 2000.00, 15.00, 'MOMO', '2024-07-30', '2024-08-31'),
(43, 4, 'Isaac Appiah', 'ia@gmail.com', 2500.00, 20.00, 'Bank-Account', '2024-07-30', '2024-08-31'),
(44, 4, 'Janet Acquah', 'ja@gmail.com', 3000.00, 25.00, 'MOMO', '2024-07-30', '2024-08-31'),
(45, 4, 'Kelvin Asamoah', 'ka@gmail.com', 2000.00, 15.00, 'Bank-Account', '2024-07-30', '2024-08-31'),
(46, 4, 'Linda Appau', 'la@gmail.com', 2500.00, 20.00, 'MOMO', '2024-07-30', '2024-08-31'),
(47, 4, 'Manaf Aminu', 'ma@gmail.com', 3000.00, 25.00, 'Bank-Account', '2024-07-30', '2024-08-31'),
(48, 4, 'Nasir Ayaan', 'na@gmail.com', 2000.00, 15.00, 'MOMO', '2024-07-30', '2024-08-31'),
(49, 4, 'Opare Amoah', 'oa@gmail.com', 2500.00, 20.00, 'Bank-Account', '2024-07-30', '2024-08-31'),
(50, 4, 'Paul Afiriyie', 'pa@gmail.com', 3000.00, 25.00, 'MOMO', '2024-07-30', '2024-08-31'),
(51, 4, 'Safia Shuaib', 'ss@gmail.com', 3000.00, 50.00, 'MOMO', '2024-07-30', '2024-08-31');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `cu_id` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`cu_id`, `rid`, `fname`, `lname`, `email`, `message`) VALUES
(3, 3, 'Joseph', 'Antwi', 'user@gmail.com', 'Please, where can I locate your headquaters?');

-- --------------------------------------------------------

--
-- Table structure for table `loan_application`
--

CREATE TABLE `loan_application` (
  `la_id` int(11) NOT NULL,
  `rid` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `purpose` varchar(1000) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `passwd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loan_application`
--

INSERT INTO `loan_application` (`la_id`, `rid`, `fname`, `lname`, `email`, `phone`, `address`, `amount`, `purpose`, `gender`, `passwd`) VALUES
(12, 4, 'Safia', 'Shuaib', 'ss@gmail.com', '0000000005', 'Dome', 3000.00, 'Start-up Business', 'female', '$2y$10$K9scriXIPJpvQX0GXz2nIuMb7THhdyJpCRSBCzkXb93vnJzvtfQX6'),
(18, 4, 'George', 'Amfo', 'ga@gmail.com', '0000000006', 'Berekuso', 4500.00, 'Business Investment', 'male', '$2y$10$r/pYiu.Vw7eOUiovYV1LiOsmwflCwfRqNBFdrjrfs8hnuFM3tSUqG'),
(19, 3, 'Yakubu', 'Asanka', 'ya@gmail.com', '0000000007', 'Taifa', 2000.00, 'School Fees', 'male', '$2y$10$l46HNtb8bA.lxkT/8WwTAOI2N.CvMJen4MPKz6fpa7JLojMC3/enC'),
(20, 4, 'Adam', 'Anvil', 'aa@gmail.com', '0000000008', 'Koloeman', 2000.00, 'School Fees', 'male', '$2y$10$elLDHN6njtSA31bSKFAiPOIX.sBSQmNyjmrSX795o3FYZsrr6d66e'),
(21, 4, 'Bismark', 'Amissah', 'ba@gmail.com', '0000000009', 'Aburi', 2500.00, 'Business Investment', 'male', '$2y$10$rH1N.xyycX337oi9qzmkr.6jOrVWCREconJDHbqTvgL89aiTaVxnu'),
(22, 4, 'Candace', 'Andrew', 'ca@gmail.com', '0000000010', 'Tafi', 3000.00, 'Start-up Business', 'female', '$2y$10$SKmpWz6UegbYJV.ToBGOA.a5EWeX51FrOpOvhuiaZhfILmR/nsroC'),
(23, 4, 'Dennis', 'Armah', 'da@gmail.com', '0000000011', 'Elmina', 2000.00, 'School Fees', 'male', '$2y$10$dSNfzjD67R.gqm6.Nk3Zr.kck1d9aBEgih9kuc0dJwi.MVVKi3QGq'),
(24, 4, 'Essel', 'Ahmed', 'ea@gmail.com', '0000000012', 'Manhyia', 2500.00, 'Business Investment', 'male', '$2y$10$Ot/CS5iauxjVRWYB3XOLBe6PKZICXEJThAur0YeDMoF6.4PY/uTqe'),
(25, 4, 'Fatima', 'Alhassan', 'fa@gmail.com', '0000000013', 'Bobiri', 3000.00, 'Start-up Business', 'female', '$2y$10$Nw/t.XsI9BGpk5LUYVjjYeHOR0vqZ.pw5YZhEtYqn2ajRurYXn8Au'),
(26, 4, 'Grace', 'Ampofo', 'ha@gmail.com', '0000000014', 'Obuasi', 2000.00, 'School Fees', 'female', '$2y$10$b/wJ1BDLzmTfzrWjvMIRSeIlfeRZFx89R.3pDA1rvyO1FgZ6cwCXm'),
(27, 4, 'Isaac', 'Appiah', 'ia@gmail.com', '0000000015', 'Tano', 2500.00, 'Business Investment', 'male', '$2y$10$5Kw5OrOoZc85slh7vvOZ..LVGAyglO0UvWE95b4MMtdSr/yzHe3wa'),
(28, 4, 'Janet', 'Acquah', 'ja@gmail.com', '0000000016', 'Kintampo', 3000.00, 'Start-up Business', 'female', '$2y$10$8d00bZxz/WjWTXbwYbcnXetgbV/8pROXXQQw4ccdhJ48eWsPgE.dG'),
(29, 4, 'Kelvin', 'Asamoah', 'ka@gmail.com', '0000000017', 'Nungua', 2000.00, 'School Fees', 'male', '$2y$10$IptYUrZ083EqRvIZPVHPG.OEiJ.oLlVSnpg8TK2CLf44yhLHfhk6a'),
(30, 4, 'Linda', 'Appau', 'la@gmail.com', '0000000018', 'Kasoa', 2500.00, 'Business Investment', 'female', '$2y$10$6R7qkjefpGFOxvD2B7Edcetw2X/luE3cGdyfGKQFuIQGqU3HUh43W'),
(31, 4, 'Manaf', 'Aminu', 'ma@gmail.com', '0000000019', 'Ejura', 3000.00, 'Start-up Business', 'male', '$2y$10$LutpoqtjMGC88P3dDId2Mu.PPYrQfu.231o5ZVpbMZfB3dVoKG6mO'),
(32, 4, 'Nasir', 'Ayaan', 'na@gmail.com', '0000000020', 'Gbawe', 2000.00, 'School Fees', 'male', '$2y$10$5iYQuYZXvhtxP9jCI3vYLuAqwDAZO.soG7mAX57pYhDfGeDO3Ouwa'),
(33, 4, 'Opare', 'Amoah', 'oa@gmail.com', '0000000021', 'Agona Swedru', 2500.00, 'Business Investement', 'female', '$2y$10$8thXpLh0bW70l9r7uhAmpeyyOwdtDrhz8q84DTcyD.Qe6nxOnPUP6'),
(34, 4, 'Paul', 'Afiriyie', 'pa@gmail.com', '0000000022', 'Berekum', 3000.00, 'Start-up Business', 'male', '$2y$10$Go.KeKYKLZ482Rsq1yKPh.NTpz5DEK38RZBsHfexvYv3/m2kBzkdi'),
(35, 3, 'Queen', 'Abayie', 'qa@gmail.com', '0000000023', 'Yendi', 2000.00, 'School Fees', 'female', '$2y$10$XMGRppaWhhfaS8lMxOJMAuD4yx/5CxQKVGZdkPpg9CfQgfWIvCLEW'),
(36, 3, 'Rashid', 'Amir', 'ra@gmail.com', '0000000024', 'Suhum', 2500.00, 'Business Investment', 'male', '$2y$10$dZOcSsBLF2w4ZmvkqOd/hupE0vUWjaWrIF7981jeRZiZ9DC2ghWpW'),
(37, 3, 'Samuel', 'Arthur', 'sa@gmail.com', '0000000025', 'Nsawam', 3000.00, 'Start-up Business', 'male', '$2y$10$n6oNBYNKB9bBUri9JpodQODtJ58QjdisGwQLb48Eh6mANdlgx25dG'),
(38, 3, 'Thomas', 'Addison', 'ta@gmail.com', '0000000026', 'Tarkwa', 2000.00, 'School Fees', 'male', '$2y$10$/zZDBDstL1iKCAbKSYQEaO6ckdlwLPF9LW320Jh1rvPTMeOjUjTLC'),
(39, 3, 'Ursula', 'Aiden', 'ua@gmail.com', '0000000027', 'Kpandu', 2500.00, 'Business Investment', 'female', '$2y$10$AMi1mVmERuTjQ157Re3tp..ncPCnY/m80P1S9LedgAK0SFsyHn0gq'),
(40, 3, 'Vera', 'Amankwah', 'va@gmail.com', '0000000028', 'Apam', 3000.00, 'Start-up Business', 'female', '$2y$10$BtYmt91sstOXiEzf6qCUu.g9gRg9Np.i.QPmyxxLdvrPTosy2gg.C'),
(41, 3, 'William', 'Affum', 'wa@gmail.com', '0000000029', 'Salaga', 2000.00, 'School Fees', 'male', '$2y$10$We6TUAx2wyLy7J6FkmQcHOdwH51c/0K.3NqhB/PvC/ndsU4yV1.7G'),
(42, 3, 'Xilinx', 'Amivado', 'xa@gmail.com', '0000000030', 'Keta', 2500.00, 'Business Investment', 'male', '$2y$10$IHlsUwHcqOXUDMCYw1zhn.J6qmS6rJoNpoSphFSok1KnczPKHaK3.'),
(43, 3, 'Zara', 'Avery', 'za@gmail.com', '0000000031', 'Kibi', 3000.00, 'Start-up Business', 'female', '$2y$10$XkTg7S5Zv6QBCOFY0ECuROSUSp/9IAkeWherDhv6TWVCmwwBVAXCW');

-- --------------------------------------------------------

--
-- Table structure for table `momo_account`
--

CREATE TABLE `momo_account` (
  `ma_id` int(11) NOT NULL,
  `fname` varchar(20) NOT NULL,
  `lname` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pin` varchar(5) NOT NULL,
  `balance` decimal(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `momo_account`
--

INSERT INTO `momo_account` (`ma_id`, `fname`, `lname`, `email`, `pin`, `balance`) VALUES
(1, 'Safia', 'Shuaib', 'ss@gmail.com', '1234', 5000.00),
(2, 'George', 'Amfo', 'ga@gmail.com', '1234', 5000.00),
(3, 'Yakubu', 'Asanka', 'ya@gmail.com', '1234', 5000.00);

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `pid` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `password` varchar(250) NOT NULL,
  `rid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`pid`, `fname`, `lname`, `email`, `phone`, `dob`, `gender`, `password`, `rid`) VALUES
(21, 'Asmawu', 'Ibrahim', 'superadmin@gmail.com', '0000000001', '2024-05-01', 'female', '$2y$10$Yw3EIPT3QhQu5aMJRlNDx.q//DnYMJGkro/DOW2as8sNgGak2L1nm', 1),
(22, 'Joseph', 'Antwi', 'user@gmail.com', '0000000002', '2024-05-03', 'male', '$2y$10$ueDpBZVopHK08RNMl44mxubH/eVKGlfp1EgjYBEv6LqKJf.bMqadK', 5),
(23, 'Iddris', 'Ibrahim', 'admin@gmail.com', '0000000003', '2024-06-01', 'female', '$2y$10$TRO7QpfLX57Av79Bd1JWtOegV2AJzDML4WTgtGCrEAwBSFs4lD/mW', 2),
(26, 'Gentle', 'Jack', 'user2@gmail.com', '0000000004', '2024-07-10', 'male', '$2y$10$QHQ31GiM4fgYdzCstcxgq.i4WEJQUaOcyU0ujxP9SOC2e/2EreCtu', 3);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `rid` int(11) NOT NULL,
  `rname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`rid`, `rname`) VALUES
(1, 'super_admin'),
(2, 'admin'),
(3, 'standard_user'),
(4, 'client'),
(5, 'loan_applicant');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `sid` int(11) NOT NULL,
  `sname` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`sid`, `sname`) VALUES
(1, 'Default'),
(2, 'Pending'),
(3, 'Confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_mgt`
--

CREATE TABLE `transaction_mgt` (
  `t_id` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `client_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `principal_amount` decimal(11,2) NOT NULL,
  `interest_rate` decimal(11,2) NOT NULL,
  `date_granted_loan` date NOT NULL,
  `loan_amount` decimal(11,2) NOT NULL,
  `outstanding_balance` decimal(11,2) NOT NULL,
  `total_amount_repaid` decimal(11,2) DEFAULT NULL,
  `amount_repaid` decimal(11,2) DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `transaction_method` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_mgt`
--

INSERT INTO `transaction_mgt` (`t_id`, `sid`, `client_name`, `email`, `principal_amount`, `interest_rate`, `date_granted_loan`, `loan_amount`, `outstanding_balance`, `total_amount_repaid`, `amount_repaid`, `transaction_date`, `transaction_method`) VALUES
(7, 3, 'George Amfo', 'ga@gmail.com', 4500.00, 43.78, '2024-07-23', 6470.10, 5850.10, 620.00, 50.00, '2024-07-29', 'MOMO'),
(9, 1, 'Adam Anvil', 'aa@gmail.com', 2000.00, 15.00, '2024-07-30', 2300.00, 2300.00, NULL, NULL, NULL, NULL),
(10, 1, 'Bismark Amissah', 'ba@gmail.com', 2500.00, 20.00, '2024-07-30', 3000.00, 3000.00, NULL, NULL, NULL, NULL),
(11, 1, 'Candace Andrew', 'ca@gmail.com', 3000.00, 25.00, '2024-07-30', 3750.00, 3750.00, NULL, NULL, NULL, NULL),
(12, 1, 'Dennis Armah', 'da@gmail.com', 2000.00, 15.00, '2024-07-30', 2300.00, 2300.00, NULL, NULL, NULL, NULL),
(13, 1, 'Essel Ahmed', 'ea@gmail.com', 2500.00, 20.00, '2024-07-30', 3000.00, 3000.00, NULL, NULL, NULL, NULL),
(14, 1, 'Fatima Alhassan', 'fa@gmail.com', 3000.00, 25.00, '2024-07-30', 3750.00, 3750.00, NULL, NULL, NULL, NULL),
(15, 1, 'Grace Ampofo', 'ha@gmail.com', 2000.00, 15.00, '2024-07-30', 2300.00, 2300.00, NULL, NULL, NULL, NULL),
(16, 1, 'Isaac Appiah', 'ia@gmail.com', 2500.00, 20.00, '2024-07-30', 3000.00, 3000.00, NULL, NULL, NULL, NULL),
(17, 1, 'Janet Acquah', 'ja@gmail.com', 3000.00, 25.00, '2024-07-30', 3750.00, 3750.00, NULL, NULL, NULL, NULL),
(18, 1, 'Kelvin Asamoah', 'ka@gmail.com', 2000.00, 15.00, '2024-07-30', 2300.00, 2300.00, NULL, NULL, NULL, NULL),
(19, 1, 'Linda Appau', 'la@gmail.com', 2500.00, 20.00, '2024-07-30', 3000.00, 3000.00, NULL, NULL, NULL, NULL),
(20, 1, 'Manaf Aminu', 'ma@gmail.com', 3000.00, 25.00, '2024-07-30', 3750.00, 3750.00, NULL, NULL, NULL, NULL),
(21, 1, 'Nasir Ayaan', 'na@gmail.com', 2000.00, 15.00, '2024-07-30', 2300.00, 2300.00, NULL, NULL, NULL, NULL),
(22, 1, 'Opare Amoah', 'oa@gmail.com', 2500.00, 20.00, '2024-07-30', 3000.00, 3000.00, NULL, NULL, NULL, NULL),
(23, 1, 'Paul Afiriyie', 'pa@gmail.com', 3000.00, 25.00, '2024-07-30', 3750.00, 3750.00, NULL, NULL, NULL, NULL),
(24, 1, 'Safia Shuaib', 'ss@gmail.com', 3000.00, 50.00, '2024-07-30', 4500.00, 4150.00, 350.00, 250.00, '2024-07-30', 'Bank-Account');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_account`
--
ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`ba_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `Foreign(clients_rid)` (`rid`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`cu_id`),
  ADD KEY `Fk(rid)` (`rid`);

--
-- Indexes for table `loan_application`
--
ALTER TABLE `loan_application`
  ADD PRIMARY KEY (`la_id`),
  ADD KEY `Fr` (`rid`);

--
-- Indexes for table `momo_account`
--
ALTER TABLE `momo_account`
  ADD PRIMARY KEY (`ma_id`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`pid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `phone_2` (`phone`),
  ADD KEY `FOREIGN(rid)` (`rid`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`sid`);

--
-- Indexes for table `transaction_mgt`
--
ALTER TABLE `transaction_mgt`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `FOREIGN(rid_t_m)` (`sid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_account`
--
ALTER TABLE `bank_account`
  MODIFY `ba_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `cu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `loan_application`
--
ALTER TABLE `loan_application`
  MODIFY `la_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `momo_account`
--
ALTER TABLE `momo_account`
  MODIFY `ma_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction_mgt`
--
ALTER TABLE `transaction_mgt`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `Foreign(clients_rid)` FOREIGN KEY (`rid`) REFERENCES `role` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD CONSTRAINT `Fk(rid)` FOREIGN KEY (`rid`) REFERENCES `role` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `loan_application`
--
ALTER TABLE `loan_application`
  ADD CONSTRAINT `Fr` FOREIGN KEY (`rid`) REFERENCES `role` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `people`
--
ALTER TABLE `people`
  ADD CONSTRAINT `FOREIGN(rid)` FOREIGN KEY (`rid`) REFERENCES `role` (`rid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction_mgt`
--
ALTER TABLE `transaction_mgt`
  ADD CONSTRAINT `FOREIGN(rid_t_m)` FOREIGN KEY (`sid`) REFERENCES `status` (`sid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
