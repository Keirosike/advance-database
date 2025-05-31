-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2025 at 09:10 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dnsc_events`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllUsers` ()   BEGIN
    SELECT 
        user_id,
        CONCAT(first_name, ' ', last_name) AS full_name,
        email,
        contact_number,
        profile_image,
        status,
        last_active,
        account_created
    FROM user;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `purchase_ticket` (IN `p_user_id` INT, IN `p_event_id` INT, IN `p_quantity` INT, IN `p_payment_method` VARCHAR(50), OUT `p_result` VARCHAR(255))   BEGIN
    DECLARE v_ticket_price DECIMAL(10,2);
    DECLARE v_available INT;
    DECLARE v_total_price DECIMAL(10,2);
    DECLARE v_ticket_code VARCHAR(50);

    -- Start a transaction
    START TRANSACTION;

    -- Lock the event row to prevent race conditions
    SELECT ticket_price, ticket_quantity
    INTO v_ticket_price, v_available
    FROM events
    WHERE event_id = p_event_id
    FOR UPDATE;

    -- Check ticket availability
    IF v_available < p_quantity THEN
        SET p_result = 'Not enough tickets available';
        ROLLBACK;
    ELSE
        -- Calculate total price
        SET v_total_price = v_ticket_price * p_quantity;
        SET v_ticket_code = CONCAT('TCKT-', UUID());

        -- Insert ticket purchase record
        INSERT INTO ticket_purchase (
            user_id, event_id, quantity, total_price, order_date, ticket_code, payment_method
        ) VALUES (
            p_user_id, p_event_id, p_quantity, v_total_price, NOW(), v_ticket_code, p_payment_method
        );

        -- Update event: decrease available, increase sold
        UPDATE events
        SET 
            ticket_quantity = ticket_quantity - p_quantity,
            tickets_sold = tickets_sold + p_quantity
        WHERE event_id = p_event_id;

        -- Set result and commit
        SET p_result = 'Success';
        COMMIT;
    END IF;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `first_name`, `last_name`, `email`, `password`) VALUES
(123, 'admin', '123', 'admin123@gmail.com', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(255) DEFAULT NULL,
  `event_image` varchar(255) DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `event_start_time` time DEFAULT NULL,
  `event_end_time` time DEFAULT NULL,
  `event_type` varchar(100) DEFAULT NULL,
  `event_location` varchar(255) DEFAULT NULL,
  `event_description` text DEFAULT NULL,
  `ticket_price` decimal(10,2) DEFAULT NULL,
  `ticket_quantity` int(11) DEFAULT NULL,
  `tickets_sold` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`event_id`, `event_name`, `event_image`, `event_date`, `event_start_time`, `event_end_time`, `event_type`, `event_location`, `event_description`, `ticket_price`, `ticket_quantity`, `tickets_sold`) VALUES
(13, 'DNSC', '853718.png', '2025-06-07', '20:41:00', '20:41:00', 'Sing and Dance', 'DNSC Gymnasium', '123', 12.00, 0, 0),
(14, 'Kali', '339218.png', '2025-06-05', '20:47:00', '23:59:00', 'Conference', 'DNSC AB 3-4', '123', 12.00, 3, 2),
(15, 'Mamahys', '3872.png', '2025-06-07', '20:04:00', '20:04:00', 'Conference', 'DNSC Covered Court', 'about', 0.00, 12, 0),
(16, 'aqe', '317945.png', '2025-06-07', '20:05:00', '20:05:00', 'Sing and Dance', 'DNSC Gymnasium', '123', 1.00, 12, 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_history`
--

CREATE TABLE `purchase_history` (
  `purchase_id` int(11) NOT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `ticket_code` varchar(100) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `purchase_history`
--

INSERT INTO `purchase_history` (`purchase_id`, `ticket_id`, `user_id`, `event_id`, `quantity`, `total_price`, `order_date`, `ticket_code`, `payment_method`, `status`) VALUES
(41, 73, 9, 13, 1, 12.00, '2025-05-30 23:06:48', 'TCKT-700356de-3de5-11f0-b559-507b9d6', 'GCash', 'Completed'),
(42, 74, 9, 13, 1, 12.00, '2025-05-30 23:08:33', 'TCKT-aeb4b0b5-3de5-11f0-b559-507b9d6', 'GCash', 'Completed'),
(43, 75, 9, 13, 1, 12.00, '2025-05-30 23:09:56', 'TCKT-e05fa211-3de5-11f0-b559-507b9d6', 'GCash', 'Completed'),
(44, 76, 9, 13, 1, 12.00, '2025-05-30 23:35:36', 'TCKT-75cae31b-3de9-11f0-b559-507b9d6', 'GCash', 'Completed'),
(45, NULL, 9, 13, 1, 12.00, '2025-05-30 23:35:41', 'TCKT-793a5a2f-3de9-11f0-b559-507b9d6', 'GCash', 'Completed'),
(46, 78, 9, 14, 1, 12.00, '2025-05-30 23:42:02', 'TCKT-5be62ec1-3dea-11f0-b559-507b9d6', '12.00', 'Completed'),
(47, 79, 9, 14, 1, 12.00, '2025-05-30 23:51:22', 'TCKT-a99f72bc-3deb-11f0-b559-507b9d6', '12.00', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `ticket_purchase`
--

CREATE TABLE `ticket_purchase` (
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `ticket_code` varchar(36) NOT NULL,
  `payment_method` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ticket_purchase`
--

INSERT INTO `ticket_purchase` (`ticket_id`, `user_id`, `event_id`, `quantity`, `total_price`, `order_date`, `ticket_code`, `payment_method`) VALUES
(33, 1, 2, 1, 123.00, '2025-05-30 10:36:40', 'TCKT-683927c856d2a', 'GCash'),
(34, 1, 2, 1, 123.00, '2025-05-30 12:51:42', 'TCKT-6839476eba8f1', 'GCash'),
(35, 1, 2, 1, 123.00, '2025-05-30 12:51:56', 'TCKT-6839477cc613d', 'GCash'),
(36, 1, 2, 1, 123.00, '2025-05-30 12:52:02', 'TCKT-68394782e2442', 'GCash'),
(40, 1, 2, 1, 123.00, '2025-05-30 14:57:59', 'TCKT-683965077c3e0', 'GCash'),
(41, 7, 3, 1, 122.00, '2025-05-30 20:38:49', 'TCKT-6839b4e9cd191', 'GCash'),
(65, 8, 2, 1, 123.00, '2025-05-30 23:50:12', 'TCKT-6839e1c487171', 'GCash'),
(66, 8, 2, 1, 123.00, '2025-05-30 23:51:18', 'TCKT-6839e206f17e6', 'GCash'),
(68, 9, 7, 1, 123.00, '2025-05-31 04:31:03', 'TCKT-1009bd41-3dd8-11f0-b559-507b9d6', '123.00'),
(69, 9, 5, 1, 1231.00, '2025-05-31 04:35:51', 'TCKT-bb8262d5-3dd8-11f0-b559-507b9d6', 'GCash'),
(70, 9, 5, 1, 1231.00, '2025-05-31 04:37:33', 'TCKT-f83a14f9-3dd8-11f0-b559-507b9d6', 'GCash'),
(73, 9, 13, 1, 12.00, '2025-05-31 06:06:48', 'TCKT-700356de-3de5-11f0-b559-507b9d6', 'GCash'),
(74, 9, 13, 1, 12.00, '2025-05-31 06:08:33', 'TCKT-aeb4b0b5-3de5-11f0-b559-507b9d6', 'GCash'),
(75, 9, 13, 1, 12.00, '2025-05-31 06:09:56', 'TCKT-e05fa211-3de5-11f0-b559-507b9d6', 'GCash'),
(76, 9, 13, 1, 12.00, '2025-05-31 06:35:36', 'TCKT-75cae31b-3de9-11f0-b559-507b9d6', 'GCash'),
(78, 9, 14, 1, 12.00, '2025-05-31 06:42:02', 'TCKT-5be62ec1-3dea-11f0-b559-507b9d6', '12.00'),
(79, 9, 14, 1, 12.00, '2025-05-31 06:51:22', 'TCKT-a99f72bc-3deb-11f0-b559-507b9d6', '12.00');

--
-- Triggers `ticket_purchase`
--
DELIMITER $$
CREATE TRIGGER `after_ticket_order_insert` AFTER INSERT ON `ticket_purchase` FOR EACH ROW BEGIN
    INSERT INTO purchase_history (
        ticket_id,
        user_id,
        event_id,
        quantity,
        total_price,
        order_date,
        ticket_code,
        payment_method,
        status
    )
    VALUES (
        NEW.ticket_id,
        NEW.user_id,
        NEW.event_id,
        NEW.quantity,
        NEW.total_price,
        NEW.order_date,
        NEW.ticket_code,
        NEW.payment_method,
        'Completed'
    );
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `transaction_view`
-- (See below for the actual view)
--
CREATE TABLE `transaction_view` (
`purchase_id` int(11)
,`full_name` varchar(201)
,`profile_image` varchar(255)
,`email` varchar(255)
,`event_name` varchar(255)
,`event_date` date
,`event_time` varchar(23)
,`total_price` decimal(10,2)
,`payment_method` varchar(50)
,`status` varchar(255)
,`order_date` datetime
,`event_location` varchar(255)
,`ticket_code` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `student_id` varchar(11) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `account_created` datetime DEFAULT current_timestamp(),
  `contact_number` int(11) DEFAULT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Inactive',
  `last_active` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `email`, `password`, `student_id`, `profile_image`, `account_created`, `contact_number`, `status`, `last_active`) VALUES
(9, 'Kurt', 'Robles', '1@gmail.com', '123', 'N/A', '683a736f7de87.jpg', '2025-05-30 18:13:37', 0, 'Inactive', '2025-05-31 00:08:40');

-- --------------------------------------------------------

--
-- Structure for view `transaction_view`
--
DROP TABLE IF EXISTS `transaction_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `transaction_view`  AS SELECT `p`.`purchase_id` AS `purchase_id`, concat(`u`.`first_name`,' ',`u`.`last_name`) AS `full_name`, `u`.`profile_image` AS `profile_image`, `u`.`email` AS `email`, `e`.`event_name` AS `event_name`, `e`.`event_date` AS `event_date`, concat(`e`.`event_start_time`,' - ',`e`.`event_end_time`) AS `event_time`, `p`.`total_price` AS `total_price`, `p`.`payment_method` AS `payment_method`, `p`.`status` AS `status`, `p`.`order_date` AS `order_date`, `e`.`event_location` AS `event_location`, `p`.`ticket_code` AS `ticket_code` FROM ((`purchase_history` `p` join `user` `u` on(`p`.`user_id` = `u`.`user_id`)) join `events` `e` on(`p`.`event_id` = `e`.`event_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `idx_event_name` (`event_name`),
  ADD KEY `idx_event_date` (`event_date`),
  ADD KEY `idx_event_type` (`event_type`),
  ADD KEY `idx_event_location` (`event_location`);

--
-- Indexes for table `purchase_history`
--
ALTER TABLE `purchase_history`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `purchase_history_ibfk_1` (`ticket_id`),
  ADD KEY `purchase_history_ibfk_2` (`user_id`),
  ADD KEY `purchase_history_ibfk_3` (`event_id`);

--
-- Indexes for table `ticket_purchase`
--
ALTER TABLE `ticket_purchase`
  ADD PRIMARY KEY (`ticket_id`),
  ADD UNIQUE KEY `ticket_code` (`ticket_code`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `purchase_history`
--
ALTER TABLE `purchase_history`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `ticket_purchase`
--
ALTER TABLE `ticket_purchase`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchase_history`
--
ALTER TABLE `purchase_history`
  ADD CONSTRAINT `purchase_history_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `ticket_purchase` (`ticket_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `purchase_history_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `purchase_history_ibfk_3` FOREIGN KEY (`event_id`) REFERENCES `events` (`event_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
