-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 17, 2024 at 04:17 PM
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
-- Database: `FinancialApp`
--

-- --------------------------------------------------------

--
-- Table structure for table `budgets`
--

CREATE TABLE `budgets` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `total_amount` decimal(15,2) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT curtime(),
  `user_id` int(11) NOT NULL,
  `goal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT curtime(),
  `user_id` int(11) NOT NULL,
  `budget_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `target_amount` decimal(15,2) NOT NULL,
  `target_date` date DEFAULT NULL,
  `risk_tolerance` enum('low','medium','high') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT curtime(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `goals`
--

INSERT INTO `goals` (`id`, `name`, `target_amount`, `target_date`, `risk_tolerance`, `created_at`, `user_id`) VALUES
(3, 'place', 2003000.00, '2024-07-11', 'high', '2024-07-10 17:00:39', 3),
(11, 'Whilemina Burns', 54.00, '2003-07-31', 'medium', '2024-07-13 17:55:21', 7),
(21, 'Ria Simmons', 20.00, '1998-03-16', 'high', '2024-07-16 16:31:30', 2),
(22, 'Nero kko', 20.00, '2010-10-23', 'medium', '2024-07-16 16:31:36', 2),
(24, 'Tasha Palmer', 5.00, '1989-07-03', 'medium', '2024-07-17 14:03:33', 2);

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `amount` decimal(18,2) DEFAULT NULL,
  `type` enum('salary','bonuns','interest') NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE `rules` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `antecedent` varchar(255) NOT NULL,
  `consequent` varchar(255) NOT NULL,
  `support` decimal(5,4) NOT NULL,
  `confidence` decimal(5,4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `simulations`
--

CREATE TABLE `simulations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `goal_id` int(11) NOT NULL,
  `portfolio_value` decimal(15,2) NOT NULL,
  `expected_return` decimal(5,4) NOT NULL,
  `risk` decimal(5,4) NOT NULL,
  `simulation_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `transaction_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT curtime()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'Victoria Nixon', 'hygegen@mailinator.com', '$2y$10$VNDMmrww5rUbujFgPa/FCu4P2IjxhE9BMgtHeUnn2nGU1F8VBaojC', '2024-07-07 00:23:18'),
(2, 'sajit panta', 'pantasajit@gmail.com', '$2y$10$8SqDePxhrl8P/qpHqlvSOu4xFh2uGQqIG1jwa8rmixKWqzQplvXLS', '2024-07-07 00:30:56'),
(3, 'FinancialApp', 'pantasajit31@gmail.com', '$2y$10$Cq6DPdf5hoXW8tuCKq/Y4u2jN7RG0vEMrCEW8JvshPaeM6R6jupAW', '2024-07-07 11:34:15'),
(5, 'Keegan Jarvis', 'jyzaxog@mailinator.com', '$2y$10$utwsdVO6kNoFRtfbWZpmmOiGBNhKqROysINPeB3P5x04FKFeLtouu', '2024-07-09 04:10:45'),
(6, 'Quentin Park', 'huroqemaq@mailinator.com', '$2y$10$bQLeEhRZvvrsdUQ4FvRzs.GDHAr1YYrDonodknU1F8b3npoXJoLVK', '2024-07-09 04:11:20'),
(7, 'satish bista', 'bistasatish@gmail.com', '$2y$10$PH/j.qjQs/4jCUwuHLIir.QixJpQ.Mw8x2k1eE0XsG8sb.sIvemZu', '2024-07-13 17:54:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `budgets`
--
ALTER TABLE `budgets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `goal_id` (`goal_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `budget_id` (`budget_id`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `simulations`
--
ALTER TABLE `simulations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `goal_id` (`goal_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `budgets`
--
ALTER TABLE `budgets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `simulations`
--
ALTER TABLE `simulations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `budgets`
--
ALTER TABLE `budgets`
  ADD CONSTRAINT `budgets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `budgets_ibfk_2` FOREIGN KEY (`goal_id`) REFERENCES `goals` (`id`);

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `expenses_ibfk_2` FOREIGN KEY (`budget_id`) REFERENCES `budgets` (`id`);

--
-- Constraints for table `goals`
--
ALTER TABLE `goals`
  ADD CONSTRAINT `goals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `incomes`
--
ALTER TABLE `incomes`
  ADD CONSTRAINT `incomes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `rules`
--
ALTER TABLE `rules`
  ADD CONSTRAINT `rules_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `simulations`
--
ALTER TABLE `simulations`
  ADD CONSTRAINT `simulations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `simulations_ibfk_2` FOREIGN KEY (`goal_id`) REFERENCES `goals` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
