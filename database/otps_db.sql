-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2022 at 03:33 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `otps_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `course_list`
--

CREATE TABLE `course_list` (
  `id` int(30) NOT NULL,
  `tutor_id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `experience` varchar(150) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `logo_path` text DEFAULT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_list`
--

INSERT INTO `course_list` (`id`, `tutor_id`, `name`, `description`, `experience`, `status`, `logo_path`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 1, 'PHP', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean blandit leo vel quam ultricies ultrices. Nam sit amet arcu diam. Cras in augue tempor, imperdiet ligula scelerisque, aliquet dolor. Nulla interdum mi at justo condimentum, ac euismod tellus sollicitudin. Ut interdum augue non arcu tincidunt tincidunt. Donec cursus nulla orci, in condimentum metus egestas in. Curabitur rhoncus tincidunt quam. Aliquam erat volutpat.', '5 Years', 1, 'uploads/courses/1.png?v=1652760072', 0, '2022-05-17 12:01:12', '2022-05-17 12:01:12'),
(2, 1, 'MySQL', 'MySQL is an open-source relational database management system. Its name is a combination of \"My\", the name of co-founder Michael Widenius\'s daughter, and \"SQL\", the abbreviation for Structured Query Language.', '5 Years', 1, 'uploads/courses/2.png?v=1652760330', 0, '2022-05-17 12:05:30', '2022-05-17 12:05:30'),
(3, 3, 'Course 101', 'Sample Course 101', '2', 1, NULL, 0, '2022-05-17 14:49:54', '2022-05-17 14:49:54'),
(4, 3, 'Course 102', 'Sample Course 102', '4 Years', 1, NULL, 0, '2022-05-17 14:50:09', '2022-05-17 14:50:09'),
(5, 4, 'PHP', 'Sample COurse 101', '5', 1, 'uploads/courses/5.png?v=1652836443', 0, '2022-05-18 09:14:03', '2022-05-18 09:14:03'),
(6, 4, 'MYSQL', 'Sample Course 102', '5', 0, 'uploads/courses/6.png?v=1652836465', 0, '2022-05-18 09:14:25', '2022-05-18 09:22:28'),
(7, 4, 'Test 123', 'Sample only - updated', '3', 0, NULL, 1, '2022-05-18 09:14:45', '2022-05-18 09:19:09');

-- --------------------------------------------------------

--
-- Table structure for table `inquiry_list`
--

CREATE TABLE `inquiry_list` (
  `id` int(30) NOT NULL,
  `tutor_id` int(30) NOT NULL,
  `course_id` int(30) NOT NULL,
  `fullname` text NOT NULL,
  `email` text NOT NULL,
  `contact` text NOT NULL,
  `message` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inquiry_list`
--

INSERT INTO `inquiry_list` (`id`, `tutor_id`, `course_id`, `fullname`, `email`, `contact`, `message`, `status`, `date_created`, `date_updated`) VALUES
(3, 1, 2, 'Michael Williams', 'mcooper@gmail.com', '09123456789', 'Mauris sit amet facilisis mi. Suspendisse potenti. Cras a accumsan lacus, ut vehicula felis. Aliquam suscipit, odio at varius euismod, lorem erat commodo urna, non consectetur justo lectus nec nunc. In ullamcorper, dui quis convallis volutpat, metus nulla rutrum ex, sed tempus nisl turpis id odio. Proin sit amet tincidunt tellus. In hac habitasse platea dictumst. In vitae nisl in felis consequat interdum. Ut semper velit sed magna placerat molestie. Maecenas varius posuere elit, vitae gravida nunc auctor sed. \r\n\r\nDonec molestie turpis vel massa malesuada, a fermentum diam aliquam. Aenean dolor leo, elementum a vulputate et, cursus eget ligula. Maecenas varius accumsan nisl viverra commodo. Etiam ac neque consectetur, placerat neque non, feugiat tellus. Proin eu auctor mauris. Aliquam gravida elit a velit ultrices hendrerit a eget tortor.', 0, '2022-05-17 16:11:49', '2022-05-17 16:11:49'),
(4, 1, 1, 'Michael Williams', 'mwil@sample.com', '09123456987', 'In elementum lacus in lorem aliquam pharetra. Ut facilisis nisl vitae dui elementum feugiat. Morbi id erat quis sapien egestas luctus. Nulla facilisi. Proin porttitor magna a elit rhoncus aliquam. Vestibulum id arcu porta, volutpat nunc in, bibendum erat. Phasellus dignissim arcu non nisl tempor, sed cursus metus tincidunt. Pellentesque vestibulum magna a dolor volutpat rutrum. Phasellus vulputate vestibulum nisl sit amet posuere.\r\n\r\nEtiam efficitur vitae nisi at congue. Nullam vehicula convallis libero lacinia dignissim. Donec id ligula sit amet massa posuere finibus. Nam eu turpis eu eros convallis placerat vitae eget ex. Ut sed posuere lacus. Morbi mollis urna eget tellus pulvinar maximus. Sed at pellentesque sem. Sed ornare, arcu sed porttitor condimentum, metus velit maximus dolor, sed sagittis neque urna sit amet tellus. Aenean molestie sagittis est nec consequat. Curabitur interdum consectetur risus id mattis. Vivamus id massa vel velit lacinia posuere et at purus.', 1, '2022-05-17 16:12:14', '2022-05-17 16:12:42'),
(6, 4, 5, 'John Smith', 'jsmith@sample.com', '09789654123', 'Sample message onyl', 1, '2022-05-18 09:21:10', '2022-05-18 09:21:41');

-- --------------------------------------------------------

--
-- Table structure for table `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Online Tutorial Portal Site'),
(6, 'short_name', 'OTPS - PHP'),
(11, 'logo', 'uploads/logo.png?v=1652751597'),
(13, 'user_avatar', 'uploads/user_avatar.jpg'),
(14, 'cover', 'uploads/cover.png?v=1652751597');

-- --------------------------------------------------------

--
-- Table structure for table `tutor_list`
--

CREATE TABLE `tutor_list` (
  `id` int(30) NOT NULL,
  `firstname` text NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = Not Validated,\r\n1 = Validated,\r\n2 = Inactive,\r\n3 = Blocked',
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tutor_list`
--

INSERT INTO `tutor_list` (`id`, `firstname`, `middlename`, `lastname`, `email`, `password`, `avatar`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Mark', 'D', 'Cooper', 'mcooper@gmail.com', 'c7162ff89c647f444fcaa5c635dac8c3', 'uploads/avatars/1.png?v=1652754171', 1, 0, '2022-05-17 10:22:51', '2022-05-17 13:22:36'),
(3, 'Claire', 'C', 'Blake', 'cblake@sample.com', '4744ddea876b11dcb1d169fadf494418', 'uploads/tutors/3.png?v=1652770108', 1, 0, '2022-05-17 14:48:28', '2022-05-17 14:50:34'),
(4, 'Samantha Jane', 'C', 'Miller', 'sam23@gmail.com', 'b60367cae35de6594b1a09bf44a3a68b', 'uploads/tutors/4.png?v=1652836335', 1, 0, '2022-05-18 09:12:15', '2022-05-18 09:28:25');

-- --------------------------------------------------------

--
-- Table structure for table `tutor_meta`
--

CREATE TABLE `tutor_meta` (
  `tutor_id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tutor_meta`
--

INSERT INTO `tutor_meta` (`tutor_id`, `meta_field`, `meta_value`) VALUES
(1, 'dob', '1997-06-23'),
(1, 'gender', 'Male'),
(1, 'contact', '09123456789'),
(1, 'address', '518 Evangelista, Manila, Metro Manila'),
(1, 'specialty', 'HTML, CSS, JS, Python, PHP, MYSQL, SQLite, AngularJS, and Node.JS'),
(1, 'description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean blandit leo vel quam ultricies ultrices. Nam sit amet arcu diam. Cras in augue tempor, imperdiet ligula scelerisque, aliquet dolor. Nulla interdum mi at justo condimentum, ac euismod tellus sollicitudin. Ut interdum augue non arcu tincidunt tincidunt.\r\n\r\nDonec cursus nulla orci, in condimentum metus egestas in. Curabitur rhoncus tincidunt quam. Aliquam erat volutpat.'),
(3, 'dob', '1997-10-14'),
(3, 'gender', 'Female'),
(3, 'contact', '09654789123 / 098785466'),
(3, 'address', '469 Gen. Luna St., Hulong Duhat, Malabon, Metro Manila'),
(3, 'specialty', 'Grammar, English, Science, and Mathematics'),
(3, 'description', 'Integer a mi quam. Vivamus et purus sed velit laoreet maximus. Suspendisse erat metus, efficitur sit amet blandit a, imperdiet sed sapien. Praesent lacinia, metus vitae mollis pharetra, enim ex laoreet erat, sit amet egestas nisi diam quis nisi. Praesent luctus eleifend varius. Quisque ut pulvinar quam, vel tempor ipsum. Morbi id dapibus tellus. Praesent vitae libero aliquam, consequat eros a, efficitur sapien. Maecenas ullamcorper velit at purus porttitor, in fermentum orci suscipit. Fusce venenatis blandit vehicula. Quisque non ex eu sapien placerat lobortis nec vitae magna. Aliquam erat volutpat. In at purus erat.'),
(4, 'dob', '1997-06-23'),
(4, 'gender', 'Male'),
(4, 'contact', '09789654123'),
(4, 'address', 'Sample Address only'),
(4, 'specialty', 'PHP, HTML, CSS, JS, and Python.'),
(4, 'description', 'This is a sample description about myself.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='2';

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Adminstrator', '', 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'uploads/avatars/1.png?v=1649834664', NULL, 1, '2021-01-20 14:02:37', '2022-05-16 14:17:49'),
(4, 'Mark', 'D', 'Cooper', 'mcooper', 'c7162ff89c647f444fcaa5c635dac8c3', 'uploads/avatars/4.png?v=1652667135', NULL, 2, '2022-05-16 10:12:15', '2022-05-16 13:44:49'),
(5, 'John', 'D', 'Smith', 'jsmith', '1254737c076cf867dc53d60a0364f38e', NULL, NULL, 2, '2022-05-16 14:19:03', '2022-05-16 14:19:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course_list`
--
ALTER TABLE `course_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tutor_id` (`tutor_id`);

--
-- Indexes for table `inquiry_list`
--
ALTER TABLE `inquiry_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tutor_id` (`tutor_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tutor_list`
--
ALTER TABLE `tutor_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tutor_meta`
--
ALTER TABLE `tutor_meta`
  ADD KEY `tutor_id` (`tutor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `course_list`
--
ALTER TABLE `course_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `inquiry_list`
--
ALTER TABLE `inquiry_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tutor_list`
--
ALTER TABLE `tutor_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course_list`
--
ALTER TABLE `course_list`
  ADD CONSTRAINT `tutor_id_fk_cl` FOREIGN KEY (`tutor_id`) REFERENCES `tutor_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `inquiry_list`
--
ALTER TABLE `inquiry_list`
  ADD CONSTRAINT `course_id_fk_il` FOREIGN KEY (`course_id`) REFERENCES `course_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `tutor_id_fk_il` FOREIGN KEY (`tutor_id`) REFERENCES `tutor_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `tutor_meta`
--
ALTER TABLE `tutor_meta`
  ADD CONSTRAINT `tutor_id_fk_tm` FOREIGN KEY (`tutor_id`) REFERENCES `tutor_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;
