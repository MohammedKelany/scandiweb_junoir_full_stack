-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2025 at 11:13 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scandiweb_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` int(11) NOT NULL,
  `displayValue` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `set_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `displayValue`, `value`, `set_id`) VALUES
(1, '40', '40', 1),
(2, '41', '41', 1),
(3, '42', '42', 1),
(4, '43', '43', 1),
(5, 'S', 'S', 2),
(6, 'M', 'M', 2),
(7, 'L', 'L', 2),
(8, 'XL', 'XL', 2),
(9, '#44FF03', '#44FF03', 3),
(10, '#03FFF7', '#03FFF7', 3),
(11, '#030BFF', '#030BFF', 3),
(12, '#000000', '#000000', 3),
(13, '#FFFFFF', '#FFFFFF', 3),
(14, '512G', '512G', 4),
(15, '1T', '1T', 4),
(16, '#44FF03', '#44FF03', 5),
(17, '#03FFF7', '#03FFF7', 5),
(18, '#030BFF', '#030BFF', 5),
(19, '#000000', '#000000', 5),
(20, '#FFFFFF', '#FFFFFF', 5),
(21, '512G', '512G', 6),
(22, '1T', '1T', 6),
(23, '256GB', '256GB', 7),
(24, '512GB', '512GB', 7),
(25, 'Yes', 'Yes', 8),
(26, 'No', 'No', 8),
(27, 'Yes', 'Yes', 9),
(28, 'No', 'No', 9),
(29, '512G', '512G', 10),
(30, '1T', '1T', 10),
(31, '#44FF03', '#44FF03', 11),
(32, '#03FFF7', '#03FFF7', 11),
(33, '#030BFF', '#030BFF', 11),
(34, '#000000', '#000000', 11),
(35, '#FFFFFF', '#FFFFFF', 11);

-- --------------------------------------------------------

--
-- Table structure for table `attribute_sets`
--

CREATE TABLE `attribute_sets` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attribute_sets`
--

INSERT INTO `attribute_sets` (`id`, `name`, `type`, `product_id`, `created_at`) VALUES
(1, 'Size', 'text', 'huarache-x-stussy-le', '2025-05-19 09:03:19'),
(2, 'Size', 'text', 'jacket-canada-goosee', '2025-05-19 09:03:19'),
(3, 'Color', 'swatch', 'ps-5', '2025-05-19 09:03:19'),
(4, 'Capacity', 'text', 'ps-5', '2025-05-19 09:03:19'),
(5, 'Color', 'swatch', 'xbox-series-s', '2025-05-19 09:03:19'),
(6, 'Capacity', 'text', 'xbox-series-s', '2025-05-19 09:03:19'),
(7, 'Capacity', 'text', 'apple-imac-2021', '2025-05-19 09:03:19'),
(8, 'With USB 3 ports', 'text', 'apple-imac-2021', '2025-05-19 09:03:19'),
(9, 'Touch ID in keyboard', 'text', 'apple-imac-2021', '2025-05-19 09:03:19'),
(10, 'Capacity', 'text', 'apple-iphone-12-pro', '2025-05-19 09:03:19'),
(11, 'Color', 'swatch', 'apple-iphone-12-pro', '2025-05-19 09:03:19');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`) VALUES
(1, 'all', '2025-05-19 09:03:19'),
(2, 'clothes', '2025-05-19 09:03:19'),
(3, 'tech', '2025-05-19 09:03:19');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `label` varchar(10) NOT NULL,
  `symbol` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `label`, `symbol`, `created_at`) VALUES
(1, 'USD', '$', '2025-05-19 09:03:19'),
(2, 'USD', '$', '2025-05-19 09:03:19'),
(3, 'USD', '$', '2025-05-19 09:03:19'),
(4, 'USD', '$', '2025-05-19 09:03:19'),
(5, 'USD', '$', '2025-05-19 09:03:19'),
(6, 'USD', '$', '2025-05-19 09:03:19'),
(7, 'USD', '$', '2025-05-19 09:03:19'),
(8, 'USD', '$', '2025-05-19 09:03:19');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(11) NOT NULL,
  `migration` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `created_at`) VALUES
(1, 'm1001_making_categories_table.php', '2025-05-19 09:03:17'),
(2, 'm1002_making_products_table.php', '2025-05-19 09:03:17'),
(3, 'm1003_making_attribute_sets_table.php', '2025-05-19 09:03:17'),
(4, 'm1004_making_attributes_table.php', '2025-05-19 09:03:17'),
(5, 'm1005_making_currencies_table.php', '2025-05-19 09:03:17'),
(6, 'm1006_making_prices_table.php', '2025-05-19 09:03:17'),
(7, 'm1007_making_orders_table.php', '2025-05-19 09:03:17'),
(8, 'm1008_making_products_orders_table.php', '2025-05-19 09:03:17');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prices`
--

CREATE TABLE `prices` (
  `id` int(11) NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `currency_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prices`
--

INSERT INTO `prices` (`id`, `product_id`, `currency_id`, `amount`) VALUES
(1, 'huarache-x-stussy-le', 1, '144.69'),
(2, 'jacket-canada-goosee', 2, '518.47'),
(3, 'ps-5', 3, '844.02'),
(4, 'xbox-series-s', 4, '333.99'),
(5, 'apple-imac-2021', 5, '1688.03'),
(6, 'apple-iphone-12-pro', 6, '1000.76'),
(7, 'apple-airpods-pro', 7, '300.23'),
(8, 'apple-airtag', 8, '120.57');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `inStock` tinyint(4) NOT NULL DEFAULT 1,
  `gallery` text NOT NULL,
  `description` text NOT NULL,
  `brand` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `inStock`, `gallery`, `description`, `brand`, `category_id`) VALUES
('apple-airpods-pro', 'AirPods Pro', 0, '[\"https:\\/\\/store.storeimages.cdn-apple.com\\/4982\\/as-images.apple.com\\/is\\/MWP22?wid=572&hei=572&fmt=jpeg&qlt=95&.v=1591634795000\"]', '\n<h3>Magic like you’ve never heard</h3>\n<p>AirPods Pro have been designed to deliver Active Noise Cancellation for immersive sound, Transparency mode so you can hear your surroundings, and a customizable fit for all-day comfort. Just like AirPods, AirPods Pro connect magically to your iPhone or Apple Watch. And they’re ready to use right out of the case.\n\n<h3>Active Noise Cancellation</h3>\n<p>Incredibly light noise-cancelling headphones, AirPods Pro block out your environment so you can focus on what you’re listening to. AirPods Pro use two microphones, an outward-facing microphone and an inward-facing microphone, to create superior noise cancellation. By continuously adapting to the geometry of your ear and the fit of the ear tips, Active Noise Cancellation silences the world to keep you fully tuned in to your music, podcasts, and calls.\n\n<h3>Transparency mode</h3>\n<p>Switch to Transparency mode and AirPods Pro let the outside sound in, allowing you to hear and connect to your surroundings. Outward- and inward-facing microphones enable AirPods Pro to undo the sound-isolating effect of the silicone tips so things sound and feel natural, like when you’re talking to people around you.</p>\n\n<h3>All-new design</h3>\n<p>AirPods Pro offer a more customizable fit with three sizes of flexible silicone tips to choose from. With an internal taper, they conform to the shape of your ear, securing your AirPods Pro in place and creating an exceptional seal for superior noise cancellation.</p>\n\n<h3>Amazing audio quality</h3>\n<p>A custom-built high-excursion, low-distortion driver delivers powerful bass. A superefficient high dynamic range amplifier produces pure, incredibly clear sound while also extending battery life. And Adaptive EQ automatically tunes music to suit the shape of your ear for a rich, consistent listening experience.</p>\n\n<h3>Even more magical</h3>\n<p>The Apple-designed H1 chip delivers incredibly low audio latency. A force sensor on the stem makes it easy to control music and calls and switch between Active Noise Cancellation and Transparency mode. Announce Messages with Siri gives you the option to have Siri read your messages through your AirPods. And with Audio Sharing, you and a friend can share the same audio stream on two sets of AirPods — so you can play a game, watch a movie, or listen to a song together.</p>\n', 'Apple', 3),
('apple-airtag', 'AirTag', 1, '[\"https:\\/\\/store.storeimages.cdn-apple.com\\/4982\\/as-images.apple.com\\/is\\/airtag-double-select-202104?wid=445&hei=370&fmt=jpeg&qlt=95&.v=1617761672000\"]', '\n<h1>Lose your knack for losing things.</h1>\n<p>AirTag is an easy way to keep track of your stuff. Attach one to your keys, slip another one in your backpack. And just like that, they’re on your radar in the Find My app. AirTag has your back.</p>\n', 'Apple', 3),
('apple-imac-2021', 'iMac 2021', 1, '[\"https:\\/\\/store.storeimages.cdn-apple.com\\/4982\\/as-images.apple.com\\/is\\/imac-24-blue-selection-hero-202104?wid=904&hei=840&fmt=jpeg&qlt=80&.v=1617492405000\"]', 'The new iMac!', 'Apple', 3),
('apple-iphone-12-pro', 'iPhone 12 Pro', 1, '[\"https:\\/\\/store.storeimages.cdn-apple.com\\/4982\\/as-images.apple.com\\/is\\/iphone-12-pro-family-hero?wid=940&amp;hei=1112&amp;fmt=jpeg&amp;qlt=80&amp;.v=1604021663000\"]', 'This is iPhone 12. Nothing else to say.', 'Apple', 3),
('huarache-x-stussy-le', 'Nike Air Huarache Le', 1, '[\"https:\\/\\/cdn.shopify.com\\/s\\/files\\/1\\/0087\\/6193\\/3920\\/products\\/DD1381200_DEOA_2_720x.jpg?v=1612816087\",\"https:\\/\\/cdn.shopify.com\\/s\\/files\\/1\\/0087\\/6193\\/3920\\/products\\/DD1381200_DEOA_1_720x.jpg?v=1612816087\",\"https:\\/\\/cdn.shopify.com\\/s\\/files\\/1\\/0087\\/6193\\/3920\\/products\\/DD1381200_DEOA_3_720x.jpg?v=1612816087\",\"https:\\/\\/cdn.shopify.com\\/s\\/files\\/1\\/0087\\/6193\\/3920\\/products\\/DD1381200_DEOA_5_720x.jpg?v=1612816087\",\"https:\\/\\/cdn.shopify.com\\/s\\/files\\/1\\/0087\\/6193\\/3920\\/products\\/DD1381200_DEOA_4_720x.jpg?v=1612816087\"]', '<p>Great sneakers for everyday use!</p>', 'Nike x Stussy', 2),
('jacket-canada-goosee', 'Jacket', 1, '[\"https:\\/\\/images.canadagoose.com\\/image\\/upload\\/w_480,c_scale,f_auto,q_auto:best\\/v1576016105\\/product-image\\/2409L_61.jpg\",\"https:\\/\\/images.canadagoose.com\\/image\\/upload\\/w_480,c_scale,f_auto,q_auto:best\\/v1576016107\\/product-image\\/2409L_61_a.jpg\",\"https:\\/\\/images.canadagoose.com\\/image\\/upload\\/w_480,c_scale,f_auto,q_auto:best\\/v1576016108\\/product-image\\/2409L_61_b.jpg\",\"https:\\/\\/images.canadagoose.com\\/image\\/upload\\/w_480,c_scale,f_auto,q_auto:best\\/v1576016109\\/product-image\\/2409L_61_c.jpg\",\"https:\\/\\/images.canadagoose.com\\/image\\/upload\\/w_480,c_scale,f_auto,q_auto:best\\/v1576016110\\/product-image\\/2409L_61_d.jpg\",\"https:\\/\\/images.canadagoose.com\\/image\\/upload\\/w_1333,c_scale,f_auto,q_auto:best\\/v1634058169\\/product-image\\/2409L_61_o.png\",\"https:\\/\\/images.canadagoose.com\\/image\\/upload\\/w_1333,c_scale,f_auto,q_auto:best\\/v1634058159\\/product-image\\/2409L_61_p.png\"]', '<p>Awesome winter jacket</p>', 'Canada Goose', 2),
('ps-5', 'PlayStation 5', 1, '[\"https:\\/\\/images-na.ssl-images-amazon.com\\/images\\/I\\/510VSJ9mWDL._SL1262_.jpg\",\"https:\\/\\/images-na.ssl-images-amazon.com\\/images\\/I\\/610%2B69ZsKCL._SL1500_.jpg\",\"https:\\/\\/images-na.ssl-images-amazon.com\\/images\\/I\\/51iPoFwQT3L._SL1230_.jpg\",\"https:\\/\\/images-na.ssl-images-amazon.com\\/images\\/I\\/61qbqFcvoNL._SL1500_.jpg\",\"https:\\/\\/images-na.ssl-images-amazon.com\\/images\\/I\\/51HCjA3rqYL._SL1230_.jpg\"]', '<p>A good gaming console. Plays games of PS4! Enjoy if you can buy it mwahahahaha</p>', 'Sony', 3),
('xbox-series-s', 'Xbox Series S 512GB', 0, '[\"https:\\/\\/images-na.ssl-images-amazon.com\\/images\\/I\\/71vPCX0bS-L._SL1500_.jpg\",\"https:\\/\\/images-na.ssl-images-amazon.com\\/images\\/I\\/71q7JTbRTpL._SL1500_.jpg\",\"https:\\/\\/images-na.ssl-images-amazon.com\\/images\\/I\\/71iQ4HGHtsL._SL1500_.jpg\",\"https:\\/\\/images-na.ssl-images-amazon.com\\/images\\/I\\/61IYrCrBzxL._SL1500_.jpg\",\"https:\\/\\/images-na.ssl-images-amazon.com\\/images\\/I\\/61RnXmpAmIL._SL1500_.jpg\"]', '\n<div>\n    <ul>\n        <li><span>Hardware-beschleunigtes Raytracing macht dein Spiel noch realistischer</span></li>\n        <li><span>Spiele Games mit bis zu 120 Bilder pro Sekunde</span></li>\n        <li><span>Minimiere Ladezeiten mit einer speziell entwickelten 512GB NVMe SSD und wechsle mit Quick Resume nahtlos zwischen mehreren Spielen.</span></li>\n        <li><span>Xbox Smart Delivery stellt sicher, dass du die beste Version deines Spiels spielst, egal, auf welcher Konsole du spielst</span></li>\n        <li><span>Spiele deine Xbox One-Spiele auf deiner Xbox Series S weiter. Deine Fortschritte, Erfolge und Freundesliste werden automatisch auf das neue System übertragen.</span></li>\n        <li><span>Erwecke deine Spiele und Filme mit innovativem 3D Raumklang zum Leben</span></li>\n        <li><span>Der brandneue Xbox Wireless Controller zeichnet sich durch höchste Präzision, eine neue Share-Taste und verbesserte Ergonomie aus</span></li>\n        <li><span>Ultra-niedrige Latenz verbessert die Reaktionszeit von Controller zum Fernseher</span></li>\n        <li><span>Verwende dein Xbox One-Gaming-Zubehör -einschließlich Controller, Headsets und mehr</span></li>\n        <li><span>Erweitere deinen Speicher mit der Seagate 1 TB-Erweiterungskarte für Xbox Series X (separat erhältlich) und streame 4K-Videos von Disney+, Netflix, Amazon, Microsoft Movies &amp; TV und mehr</span></li>\n    </ul>\n</div>', 'Microsoft', 3);

-- --------------------------------------------------------

--
-- Table structure for table `products_orders`
--

CREATE TABLE `products_orders` (
  `id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_attributes` text NOT NULL,
  `product_id` varchar(50) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `set_id` (`set_id`);

--
-- Indexes for table `attribute_sets`
--
ALTER TABLE `attribute_sets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prices`
--
ALTER TABLE `prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `currency_id` (`currency_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `products_orders`
--
ALTER TABLE `products_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `attribute_sets`
--
ALTER TABLE `attribute_sets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prices`
--
ALTER TABLE `prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `products_orders`
--
ALTER TABLE `products_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attributes`
--
ALTER TABLE `attributes`
  ADD CONSTRAINT `attributes_ibfk_1` FOREIGN KEY (`set_id`) REFERENCES `attribute_sets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attribute_sets`
--
ALTER TABLE `attribute_sets`
  ADD CONSTRAINT `attribute_sets_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `prices`
--
ALTER TABLE `prices`
  ADD CONSTRAINT `prices_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `prices_ibfk_2` FOREIGN KEY (`currency_id`) REFERENCES `currencies` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products_orders`
--
ALTER TABLE `products_orders`
  ADD CONSTRAINT `products_orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_orders_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
