-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2025 at 09:01 AM
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
  `department_id` varchar(255) DEFAULT NULL,
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
(1, 'pehita', 'qirepehita@mailinator.com', '4fc333e0a029154c9437ab17980b9661', NULL, 1, 'aaaa', '3333', 'Inactive', 4, '2025-01-05', '2025-01-08 16:17:08'),
(5, '', 'lezi@mailinator.com', '25d55ad283aa400af464c76d713c07ad', '4', 2, 'Illo veniam minim r', '754535435435', 'Active', 1, '2025-01-06', '2025-01-09 06:44:42'),
(6, 'toxuwy34', 'nugaqyzi@mailinator.com', '25d55ad283aa400af464c76d713c07ad', '3', 2, 'Quaerat eum est vel', '44', 'Inactive', NULL, '2025-01-06', '2025-01-08 18:19:30'),
(10, 'admin', 'admin@gmail.com', '25d55ad283aa400af464c76d713c07ad', NULL, 1, 'admin', '4343434', 'Active', NULL, '2025-01-08', '2025-01-09 08:00:27');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `module_name` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `module_name`, `action`) VALUES
(14, 'delete_employee', 'employee', 'delete'),
(15, 'delete_permission', 'permission', 'delete'),
(16, 'view_permission', 'permission', 'view'),
(17, 'update_permission', 'permission', 'update'),
(18, '', 'employee', 'update'),
(20, '', 'role', 'add'),
(21, '', 'permission', 'add'),
(26, '', 'role', 'delete'),
(27, '', 'role', 'view'),
(28, '', 'role', 'update'),
(33, '', 'user', 'add'),
(34, '', 'user', 'delete'),
(35, '', 'user', 'view'),
(36, '', 'user', 'update'),
(37, '', 'task', 'add'),
(38, '', 'task', 'delete'),
(39, '', 'task', 'view'),
(40, '', 'task', 'update'),
(41, '', 'department', 'add'),
(42, '', 'department', 'delete'),
(43, '', 'department', 'view'),
(44, '', 'department', 'update'),
(48, '', 'activitylogs', 'delete'),
(49, '', 'activitylogs', 'view'),
(50, '', 'employee', 'view'),
(52, '', 'employee', 'add');

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
(2, 'Manager');

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
(9, 2, 14),
(10, 2, 17),
(289, 1, 14),
(290, 1, 18),
(291, 1, 50),
(292, 1, 52),
(293, 1, 15),
(294, 1, 17),
(295, 1, 21),
(296, 1, 20),
(297, 1, 26),
(298, 1, 27),
(299, 1, 28),
(300, 1, 33),
(301, 1, 34),
(302, 1, 35),
(303, 1, 36),
(304, 1, 37),
(305, 1, 38),
(306, 1, 39),
(307, 1, 40),
(308, 1, 41),
(309, 1, 42),
(310, 1, 43),
(311, 1, 44),
(312, 1, 48),
(313, 1, 49);

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
  `createby` varchar(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `title`, `description`, `assigned_tos`, `department_id`, `to_assigned`, `priority`, `status`, `created_by`, `createby`, `created_at`, `updated_at`) VALUES
(19, 'sadasdasd', NULL, NULL, 3, '', 'Low', 'Pending', NULL, NULL, '2025-01-07 11:42:24', '2025-01-09 06:45:15'),
(22, 'Quae ipsa veniam a', NULL, NULL, 3, '6', 'Medium', 'In Progress', NULL, NULL, '2025-01-07 13:38:14', '2025-01-09 06:55:09'),
(23, 'Pariatur Veniam eo', NULL, NULL, 3, '1', 'Medium', 'Pending', NULL, NULL, '2025-01-08 16:20:18', '2025-01-09 06:54:23'),
(24, 'Omnis expedita quia ', 'Autem distinctio Pr', NULL, NULL, '1', 'Medium', 'Pending', NULL, NULL, '2025-01-08 16:21:39', '2025-01-08 16:21:39'),
(26, 'Ex adipisci occaecat', 'Dolor est reiciendis', NULL, NULL, '9', 'Medium', 'Completed', NULL, '8', '2025-01-08 16:26:40', '2025-01-08 16:26:40'),
(31, 'Ad consequatur In s', 'Odio deleniti ullam ', NULL, NULL, '6', 'Medium', 'Pending', NULL, '8', '2025-01-08 18:03:53', '2025-01-08 18:03:53');

-- --------------------------------------------------------

--
-- Table structure for table `task_activity_log`
--

CREATE TABLE `task_activity_log` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) DEFAULT NULL,
  `task_id` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task_activity_log`
--

INSERT INTO `task_activity_log` (`id`, `user_id`, `task_id`, `status`, `created_date`, `updated_date`) VALUES
(6, '10', '19', 'edit', '2025-01-08 18:23:20', '0000-00-00 00:00:00'),
(7, '10', '19', 'edit', '2025-01-09 06:45:15', '0000-00-00 00:00:00'),
(8, '10', '23', 'edit', '2025-01-09 06:54:23', NULL),
(9, '10', '22', 'edit', '2025-01-09 06:55:09', '2025-01-09 06:55:09');

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
  ADD KEY `role_permissions_ibfk_2` (`permission_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assigned_to` (`assigned_tos`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `task_activity_log`
--
ALTER TABLE `task_activity_log`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=314;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `task_activity_log`
--
ALTER TABLE `task_activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD CONSTRAINT `role_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `role_permissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

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
