-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2025 at 06:56 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `umsem`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `dep_name` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `dep_name`) VALUES
(1, 'Maths dep'),
(3, 'English'),
(4, 'Maths');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `role_id` int(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `contact_info` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `user_id` int(11) DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `username`, `email`, `password`, `department_id`, `role_id`, `designation`, `contact_info`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'aaaaadsdsdsd', 'qirepehita@mailinator.com', '4fc333e0a029154c9437ab17980b9661', 3, 2, 'aaaa', '3333', 'Inactive', 4, '2025-01-05', '2025-01-06 09:19:53'),
(2, 'Thor Porter', 'nuvu@mailinator.com', '83a57780ae70b6aa96b9131b65102a07', 3, 11, 'task manager', '4343434', 'Inactive', 4, '2025-01-05', '2025-01-06 09:20:01'),
(3, 'Maggie Watkins', 'giqeqi@mailinator.com', '9d2076d7e9d1eec72a9e762dc1f2afd9', 1, 1, 'manager', 'sdsd', 'Active', 2, '2025-01-05', '2025-01-07 08:44:17'),
(4, 'Hayfa Avery', 'tekumisiz@mailinator.com', '3148cdcaa34d9312e81f48d6fb755d9c', 3, 9, 'Voluptas libero dese', '98', 'Inactive', 1, '2025-01-05', '2025-01-06 09:20:22'),
(5, 'boqocuqyd', 'lezi@mailinator.com', '25d55ad283aa400af464c76d713c07ad', 3, 2, 'Illo veniam minim r', '754535435435', 'Active', NULL, '2025-01-06', '2025-01-07 16:38:10'),
(6, 'toxuwy', 'nugaqyzi@mailinator.com', '25d55ad283aa400af464c76d713c07ad', 3, 1, 'Quaerat eum est vel', '44', 'Inactive', NULL, '2025-01-06', '2025-01-07 17:11:11'),
(7, 'qedulid', 'dadikytaba@mailinator.com', '3fdd4f1087a7181ea9aa2f5375366cf4', 3, 9, 'Deserunt aliqua Est', '1', 'Active', 2, '2025-01-06', '2025-01-06 10:17:38'),
(8, 'admin', 'admin@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL, 2, '', '', 'Active', NULL, '2025-01-07', '2025-01-07 17:00:55');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `module_name` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `module_name`, `action`) VALUES
(1, 'admin', 'add'),
(2, 'Manager', 'add'),
(3, 'admin', 'view'),
(14, 'permission', 'add'),
(15, 'permission', 'delete'),
(16, 'permission', 'view'),
(17, 'permission', 'update');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Manager'),
(13, 'Role Adding section');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `permission_id`) VALUES
(6, 1, 1),
(7, 1, 2),
(8, 2, 2),
(9, 2, 14),
(10, 2, 17);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `assigned_tos` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `to_assigned` varchar(255) DEFAULT NULL,
  `priority` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `assigned_tos`, `department_id`, `to_assigned`, `priority`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(19, 'sadasdasd', NULL, NULL, NULL, '3', 'Medium', 'In Progress', NULL, '2025-01-07 11:42:24', '2025-01-07 12:56:43'),
(22, 'Quae ipsa veniam a', 'Ut minus omnis qui m', NULL, NULL, '3', 'Medium', 'In Progress', NULL, '2025-01-07 13:38:14', '2025-01-07 13:38:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `department_id` int(255) DEFAULT NULL,
  `role_id` int(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `department_id`, `role_id`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'qytitaref', 3, 8, 'nufu@mailinator.com', 'f3b5c3abc1a62c1a3e4f9719c33b2a4b', 'Inactive', '2025-01-03', '2025-01-04 09:06:05'),
(2, 'coqicapijo', 1, 1, 'kizy@mailinator.com', '707dfeccdd784cf250149588d3a2a4ab', 'Inactive', '2025-01-04', '2025-01-04 07:55:46'),
(3, 'kyxaxoketu', 3, 9, 'cysyhozo@mailinator.com', 'ea49f7b5e993659b4fb5baf9cd082190', 'Inactive', '2025-01-04', '2025-01-05 10:08:59'),
(4, 'wuzubu', 3, 11, 'rudoha@mailinator.com', '3613e93bcb3ab0078eac5aa388ff2e05', 'Active', '2025-01-04', '2025-01-04 09:06:56');

-- --------------------------------------------------------

--
-- Table structure for table `xxadminlogin`
--

CREATE TABLE `xxadminlogin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `xxadminlogin`
--

INSERT INTO `xxadminlogin` (`id`, `email`, `password`, `image`) VALUES
(1, 'admin@gmail.com', '25d55ad283aa400af464c76d713c07ad', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `permission_id` (`permission_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assigned_to` (`assigned_tos`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `xxadminlogin`
--
ALTER TABLE `xxadminlogin`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `xxadminlogin`
--
ALTER TABLE `xxadminlogin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `role_permissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`assigned_tos`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `tasks_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
