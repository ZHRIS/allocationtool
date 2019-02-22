-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 22, 2019 at 08:06 PM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `allocationtool`
--

-- --------------------------------------------------------

--
-- Table structure for table `demand`
--

CREATE TABLE `demand` (
  `Location` varchar(255) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Demand` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `demand_location`
--

CREATE TABLE `demand_location` (
  `demand_location_id` int(4) NOT NULL,
  `penalty_unfulfilled_demand` int(4) DEFAULT NULL,
  `location_budget` float NOT NULL DEFAULT '0',
  `demand_location_name` varchar(255) NOT NULL,
  `demand_longitude_coordinate` varchar(80) DEFAULT NULL,
  `demand_latitude_coordinate` varchar(80) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `distance`
--

CREATE TABLE `distance` (
  `distance_id` int(11) NOT NULL,
  `demand_location_id` int(4) NOT NULL,
  `location_id` int(4) NOT NULL,
  `road_distance` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `general`
--

CREATE TABLE `general` (
  `Setting` varchar(255) NOT NULL,
  `Value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `graduate`
--

CREATE TABLE `graduate` (
  `graduate_id` int(4) NOT NULL,
  `graduate_no` int(6) DEFAULT NULL,
  `first_name` varchar(800) DEFAULT NULL,
  `location_id` int(4) DEFAULT NULL,
  `worker_type_id` int(11) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `worker_level_id` int(4) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `adjusted_salary` varchar(10) DEFAULT NULL,
  `potential_fixed_location_id` int(4) DEFAULT NULL,
  `do_not_assign_outside_preferences` varchar(3) DEFAULT NULL,
  `assigned_to_fixed_location` varchar(3) DEFAULT NULL,
  `upload_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(4) NOT NULL,
  `location_name` varchar(255) DEFAULT NULL,
  `longitude_coordinate` varchar(10) DEFAULT NULL,
  `latitude_coordinate` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `Location` varchar(255) NOT NULL,
  `Budget` varchar(255) NOT NULL,
  `Penalty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `ip_address`, `login`, `time`) VALUES
(2, '::1', 'dhlakama', 1550852968),
(3, '::1', 'dhlakama', 1550853037),
(6, '::1', 'dhlakama', 1550857177),
(7, '::1', 'tdhlakama', 1550857489),
(8, '::1', 'tdhlakama', 1550857498),
(9, '::1', 'tdhlakama', 1550857625),
(14, '::1', 'admin', 1550858031);

-- --------------------------------------------------------

--
-- Table structure for table `preference`
--

CREATE TABLE `preference` (
  `preference_id` int(11) NOT NULL,
  `demand_location_id` int(11) NOT NULL,
  `graduate_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE `preferences` (
  `Worker` int(10) NOT NULL,
  `Location` varchar(255) NOT NULL,
  `Weight` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `results_x`
--

CREATE TABLE `results_x` (
  `graduate_id` int(10) NOT NULL,
  `demand_location_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL,
  `maximum_running_time` float NOT NULL,
  `optimality_gap` float NOT NULL,
  `harvesine_formula` float NOT NULL,
  `maximum_weight` float NOT NULL,
  `total_budget` double NOT NULL,
  `default_penalty_unfulfilled_demand` int(4) NOT NULL,
  `number_of_preferences_allowed` int(2) NOT NULL,
  `date_modified` date NOT NULL,
  `errors_found` int(11) NOT NULL DEFAULT '0',
  `tool_currency` varchar(255) NOT NULL,
  `platform` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`setting_id`, `maximum_running_time`, `optimality_gap`, `harvesine_formula`, `maximum_weight`, `total_budget`, `default_penalty_unfulfilled_demand`, `number_of_preferences_allowed`, `date_modified`, `errors_found`, `tool_currency`, `platform`) VALUES
(100, 10, 0.1, 1, 3, 0, 40, 3, '2019-02-22', 0, 'ZMK', 'Linux');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `Type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `upload_id` int(11) NOT NULL,
  `upload_date` datetime NOT NULL,
  `records_uploaded` int(10) DEFAULT NULL,
  `upload_by` varchar(20) NOT NULL,
  `records_notuploaded` int(10) DEFAULT NULL,
  `reasons` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(254) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', '$2y$08$N9cCrG13.StuIyftC2Gsu.dUUanrwrho2XBtw73jP9xhHGFjcerJ.', '', 'administrator', '', NULL, NULL, NULL, 1268889823, 1550858578, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(12, '::1', '$2y$08$zLnuBvYIXQumZdlrbfKieuXjV4krA1e8tb7oEDTwPyNagaTsR6ZRu', NULL, 'tdhlakama@gmail.com', NULL, NULL, NULL, NULL, 1550857433, 1550858046, 1, 'Takunda L', 'Dhlakama', 'tdhlakama', '773053726'),
(13, '::1', '$2y$08$zXbodlXWSslF/K0S8LrHIel7m7smW07bkt0WZDoVrmrUJ0gBzrrF6', NULL, 'fwamambo@gmail.com', NULL, NULL, NULL, NULL, 1550858443, 1550858537, 1, 'Takunda L', 'Dhlakama', 'tdhlakama', '773203783');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(13, 12, 1),
(14, 13, 2);

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `Worker` int(20) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Salary` int(20) NOT NULL,
  `Fixed` tinyint(1) NOT NULL,
  `FixedLocation` varchar(255) NOT NULL,
  `OnlyPreferences` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `worker_demand`
--

CREATE TABLE `worker_demand` (
  `worker_demand_id` int(5) NOT NULL,
  `worker_type_id` int(4) NOT NULL,
  `demand_location_id` int(4) NOT NULL,
  `total` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `worker_level`
--

CREATE TABLE `worker_level` (
  `worker_level_name` varchar(255) DEFAULT NULL,
  `worker_level_id` int(1) NOT NULL,
  `worker_level_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `worker_salary`
--

CREATE TABLE `worker_salary` (
  `worker_level_id` int(4) NOT NULL,
  `worker_salary_id` int(11) NOT NULL,
  `salary` float NOT NULL,
  `worker_type_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `worker_type`
--

CREATE TABLE `worker_type` (
  `worker_type_id` int(4) NOT NULL,
  `worker_type_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `demand_location`
--
ALTER TABLE `demand_location`
  ADD PRIMARY KEY (`demand_location_id`),
  ADD UNIQUE KEY `demand_location_name` (`demand_location_name`);

--
-- Indexes for table `distance`
--
ALTER TABLE `distance`
  ADD PRIMARY KEY (`distance_id`);

--
-- Indexes for table `graduate`
--
ALTER TABLE `graduate`
  ADD UNIQUE KEY `graduate_id` (`graduate_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD UNIQUE KEY `location_id` (`location_id`),
  ADD UNIQUE KEY `location_name` (`location_name`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preference`
--
ALTER TABLE `preference`
  ADD PRIMARY KEY (`preference_id`),
  ADD UNIQUE KEY `preference_id` (`preference_id`);

--
-- Indexes for table `results_x`
--
ALTER TABLE `results_x`
  ADD UNIQUE KEY `graduate_id` (`graduate_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`upload_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  ADD KEY `fk_users_groups_users1_idx` (`user_id`),
  ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers`
  ADD UNIQUE KEY `Worker` (`Worker`);

--
-- Indexes for table `worker_demand`
--
ALTER TABLE `worker_demand`
  ADD PRIMARY KEY (`worker_demand_id`),
  ADD UNIQUE KEY `worker_demand_id` (`worker_demand_id`);

--
-- Indexes for table `worker_level`
--
ALTER TABLE `worker_level`
  ADD UNIQUE KEY `worker_level_id` (`worker_level_id`),
  ADD UNIQUE KEY `worker_level_name` (`worker_level_name`);

--
-- Indexes for table `worker_salary`
--
ALTER TABLE `worker_salary`
  ADD PRIMARY KEY (`worker_salary_id`),
  ADD UNIQUE KEY `worker_salary_id` (`worker_salary_id`);

--
-- Indexes for table `worker_type`
--
ALTER TABLE `worker_type`
  ADD KEY `worker_type_id` (`worker_type_id`),
  ADD KEY `worker_type_id_2` (`worker_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `demand_location`
--
ALTER TABLE `demand_location`
  MODIFY `demand_location_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=435;
--
-- AUTO_INCREMENT for table `distance`
--
ALTER TABLE `distance`
  MODIFY `distance_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `graduate`
--
ALTER TABLE `graduate`
  MODIFY `graduate_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=583;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `preference`
--
ALTER TABLE `preference`
  MODIFY `preference_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=868;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `upload`
--
ALTER TABLE `upload`
  MODIFY `upload_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users_groups`
--
ALTER TABLE `users_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `worker_demand`
--
ALTER TABLE `worker_demand`
  MODIFY `worker_demand_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1725;
--
-- AUTO_INCREMENT for table `worker_level`
--
ALTER TABLE `worker_level`
  MODIFY `worker_level_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `worker_salary`
--
ALTER TABLE `worker_salary`
  MODIFY `worker_salary_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `worker_type`
--
ALTER TABLE `worker_type`
  MODIFY `worker_type_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
