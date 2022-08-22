SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


CREATE TABLE `about_desc_table` (
  `id` int(11) NOT NULL,
  `about_heading` varchar(255) NOT NULL,
  `about_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `about_desc_table` (`id`, `about_heading`, `about_description`) VALUES
(1, 'Heading', 'Foodies is an online food ordering system for an Hotel which allows customers to easily make food requests and have them get their orders across to them, saving them the stress of ordering food physically as all the available food features on the system as well as their respective prices.');


CREATE TABLE `admin_user_table` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `admin_user_table` (`id`, `username`, `password`, `email`, `status`) VALUES
(1, 'Admin', '608f72eb95bfaefe1a826a7dc97b3cfe', 'iphyze@gmail.com', 1),
(3, 'Actuator', '608f72eb95bfaefe1a826a7dc97b3cfe', 'iphyze@yahoo.com', 0);



CREATE TABLE `categories_tab` (
  `id` int(11) NOT NULL,
  `categories_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



INSERT INTO `categories_tab` (`id`, `categories_name`) VALUES
(1, 'vegetable'),
(2, 'swallow'),
(3, 'drinks'),
(4, 'pasta'),
(5, 'protein'),
(6, 'rice'),
(7, 'Diet Plan Meal');

CREATE TABLE `feedback_table` (
  `id` int(11) NOT NULL,
  `fulname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `heading` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `read_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `feedback_table` (`id`, `fulname`, `email`, `heading`, `message`, `read_status`) VALUES
(1, 'Nzekwue Ifeanyi', 'iphyze@gmail.com', 'Food Prompt', 'Please ensure that delivery of food is done as quickly as possible.<br />\r\nThanks!', 0),
(2, 'Nzekwue Ifeanyi', 'iphyze@gmail.com', 'New Message', 'This is about testing this form!', 0);


CREATE TABLE `food_table` (
  `id` int(11) NOT NULL,
  `food_name` varchar(255) NOT NULL,
  `food_price` varchar(255) NOT NULL,
  `food_image` varchar(255) NOT NULL,
  `food_description` text NOT NULL,
  `food_category` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `trending` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `food_table` (`id`, `food_name`, `food_price`, `food_image`, `food_description`, `food_category`, `status`, `trending`) VALUES
(1, 'Semo', '2000', '1600652880_steak.jpg', 'This is a brief description of the product up for sale', 'swallow', 'available', 'no'),
(2, 'Beans', '1600', 'collection-2.jpg', 'This is a brief description of the product up for sale', 'pasta', 'available', 'yes'),
(3, 'Noodles', '2000', 'collection-4.jpg', 'This is a brief description of the product up for sale', 'pasta', 'available', 'yes'),
(4, 'Salad', '1800', 'home2.jpg', 'This is a light food.', 'vegetable', 'available', 'no'),
(5, 'Spaghetti', '800', 'istockphoto-1087833940-612x612.jpg', 'Jollof Rice and Chicken', 'pasta', 'available', 'no'),
(6, 'Burger', '550', 'collection-1.jpg', 'This is a brief description of the product up for sale', 'pasta', 'available', 'no'),
(7, 'Coca Cola', '250', 'collection-3.jpg', 'This is a brief description of the product up for sale', 'drinks', 'available', 'no'),
(8, 'Jollof Rice', '1500', 'food-6.png', 'This is jollof rice mixed with chicken', 'rice', 'available', 'yes'),
(9, 'Yam & Egg Source', '2500', '1600656600_checken2.jpg', 'This has always remained one of the best meal combos ever, try it hot!!!', 'protein', 'available', 'no');


CREATE TABLE `guest_table` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `guest_table` (`id`, `username`, `email`, `password`, `token`) VALUES
(1, 'Actuator', 'iphyze@gmail.com', '608f72eb95bfaefe1a826a7dc97b3cfe', ''),
(2, 'iphyze', 'jamesbond@gmail.com', '608f72eb95bfaefe1a826a7dc97b3cfe', ''),
(3, 'morayo', 'olaleyefeyishayo7@gmail.com', '7b7726b65cdaa44e8f2c459fbddfc7b2', ''),
(4, 'Lilyindagroup', 'lilianebubeogu@yahoo.com', '827ccb0eea8a706c4c34a16891f84e7b', ''),
(5, 'Buchi', 'buchi@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', ''),
(6, 'david prince', 'iphyze@yahoo.com', 'e807f1fcf82d132f9bb018ca6738a19f', '');



CREATE TABLE `order_list` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `food_id` varchar(255) NOT NULL,
  `food_price` varchar(255) NOT NULL,
  `food_quantity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `order_list` (`id`, `order_id`, `food_id`, `food_price`, `food_quantity`) VALUES
(1, '954268', '2', '1600', '2'),
(2, '954268', '1', '2000', '4'),
(3, '954268', '3', '2200', '3'),
(4, '954268', '4', '1800', '5'),
(5, '234761', '3', '2200', '4'),
(6, '234761', '5', '850', '5'),
(7, '234761', '6', '550', '4'),
(8, '234761', '1', '2000', '3'),
(9, '132940', '4', '1800', '1'),
(10, '487253', '5', '850', '1'),
(11, '487253', '3', '2200', '1'),
(12, '975681', '6', '550', '3'),
(13, '975681', '4', '1800', '1'),
(18, '608931', '1', '2000', '3'),
(20, '386071', '2', '1600', '1'),
(21, '709561', '2', '1600', '1'),
(47, '053769', '4', '1800', '4'),
(48, '053769', '3', '2000', '3'),
(49, '053769', '2', '1600', '6'),
(50, '851320', '9', '2500', '2'),
(52, '571380', '6', '550', '1');


CREATE TABLE `order_table` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `room_number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `order_table` (`id`, `order_id`, `fname`, `lname`, `room_number`, `email`, `phone`, `status`, `username`, `time`) VALUES
(1, '954268', 'Ifeanyi', 'Nzekwue', '202', 'iphyze@gmail.com', '08105342439', '1', 'Actuator', '2021-08-07 04:29:17'),
(2, '234761', 'Ifeanyi', 'Nzekwue', '102', 'iphyze@gmail.com', '08105342439', '0', 'Actuator', '2021-08-07 04:29:17'),
(3, '132940', 'James', 'Bond', '207', 'jamesbond@gmail.com', '08033015449', '0', 'iphyze', '2021-08-07 04:29:17'),
(4, '487253', 'mary', 'olaleye', '201', 'olaleyefeyishayo7@gmail.com', '08132989681', '1', 'morayo', '2021-08-07 04:29:17'),
(5, '975681', 'Lilian', 'Ebubeogu', '200', 'lilianebubeogu@yahoo.com', '08105342439', '0', 'Lilyindagroup', '2021-08-07 05:50:19'),
(8, '608931', 'Buchi', 'Nzekwue', '300', 'buchijenifa@gmail.com', '08105342439', '2', 'Buchi', '2021-08-07 22:12:09'),
(10, '386071', 'Buchi', 'Nzekwue', '322', 'buchijenifa@gmail.com', '08105342439', '1', 'Buchi', '2021-08-07 22:24:35'),
(11, '709561', 'Buchi', 'Nzekwue', '201', 'buchijenifa@gmail.com', '08105342439', '1', 'Buchi', '2021-08-07 22:27:45'),
(26, '053769', 'Ifeanyi', 'Nzekwue', '300', 'iphyze@gmail.com', '08105342439', '0', 'Actuator', '2021-08-08 07:40:46'),
(27, '851320', 'Buchi', 'Nzekwue', '200', 'buchijenifa@gmail.com', '08105342439', '0', 'Buchi', '2021-08-08 21:36:11'),
(29, '571380', 'david', 'prince', '200', 'iphyze@yahoo.com', '08142963106', '0', 'david prince', '2021-08-09 00:06:04');



CREATE TABLE `trending_table` (
  `id` int(11) NOT NULL,
  `food_name` varchar(255) NOT NULL,
  `food_trend` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `trending_table` (`id`, `food_name`, `food_trend`) VALUES
(1, 'Semo', 0),
(2, 'Beans', 7),
(3, 'Noodles', 3),
(4, 'Salad', 4),
(5, 'Spaghetti', 0),
(6, 'Burger', 7),
(7, 'Coca Cola', 16),
(8, 'Jollof Rice', 0),
(9, 'Yam & Egg Source', 4);


ALTER TABLE `about_desc_table`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `admin_user_table`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `categories_tab`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `feedback_table`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `food_table`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `guest_table`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `order_list`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `order_table`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `trending_table`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `about_desc_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `admin_user_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

ALTER TABLE `categories_tab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

ALTER TABLE `feedback_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `food_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

ALTER TABLE `guest_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

ALTER TABLE `order_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

ALTER TABLE `order_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

ALTER TABLE `trending_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;
