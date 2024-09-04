-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2024 at 05:50 PM
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
-- Database: `vogue_ventures2`
--

-- --------------------------------------------------------

--
-- Table structure for table `a_details`
--

CREATE TABLE `a_details` (
  `aid` int(10) NOT NULL,
  `a_name` varchar(150) NOT NULL,
  `a_email` varchar(150) NOT NULL,
  `a_pass` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `a_details`
--

INSERT INTO `a_details` (`aid`, `a_name`, `a_email`, `a_pass`) VALUES
(2, 'kavindu', 'chelaka560@gmail.com', '$2y$10$zGwNlcyPpn3jaE9Lq87zm.uoqCzFNXm1g.87DFJkyZtRKer.BLshi'),
(5, 'menuka', 'menukathejan2001@gmail.com', '$2y$10$7uuSERrYTjYIVxHgj5vqreno9xNn4B4UffC9jsNuUWU71Na8umIJ6'),
(6, 'thisaru', 'thisaru@gmail.com', '$2y$10$5n2bTorotGPyk1gal0Ib5uXfyX4LQZ3YNJQU86NqeAFvQ8LzPsHKy'),
(7, 'tharindra', 'tharindra@gmail.com', '$2y$10$whsaws4LG2Ey0tdjOPRgvuJ0HWVy7quHlHWd92jjYRm4GMGqm1rW.'),
(8, 'praveen', 'praveen@gmail.com', '$2y$10$ClNpnTNwx8BPfATlt9LaLuLmoEBlI4kDNijhvqA9X6DIDGJffpk9W'),
(9, 'dilsahn', 'dilshan@gmail.com', '$2y$10$gGZsHCPfZWSqlcJm61bNY.9ni56OAlBh48PJK4jLPACwQJVf9RssW'),
(10, 'admin', 'admin@gmail.com', '$2y$10$INdYthmbHOOcHvI6IidRdup38vW5wYXaF074bJwaPKCbYtHJ41UvC');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`) VALUES
(1, 'Nike'),
(2, 'Under Armour'),
(3, 'Adidas'),
(4, 'Puma'),
(5, 'Fila'),
(6, 'Vans'),
(7, 'New Balance');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`) VALUES
(1, 'Men'),
(2, 'Women'),
(3, 'Kids');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `c_details`
--

CREATE TABLE `c_details` (
  `cid` int(10) NOT NULL,
  `c_name` varchar(150) NOT NULL,
  `c_email` varchar(150) NOT NULL,
  `c_pass` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `c_details`
--

INSERT INTO `c_details` (`cid`, `c_name`, `c_email`, `c_pass`) VALUES
(1, 'menuka perera', 'menukathejan2001@gmail.com', '$2y$10$.iOwu.5mKXK/2tihQ4R2/e4rj81eENcXVbTVSyFjXiUBd3QvzeKBC');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('Pending','Processing','Completed','Cancelled') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ordertest`
--

CREATE TABLE `ordertest` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `newsletter` tinyint(1) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `s_address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `shipping` decimal(10,2) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `terms` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `color` varchar(50) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `topselling_id` tinyint(1) DEFAULT NULL,
  `sale_id` tinyint(1) DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT 0,
  `image_url1` varchar(255) DEFAULT NULL,
  `image_url2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `description`, `price`, `color`, `brand_id`, `category_id`, `topselling_id`, `sale_id`, `stock_quantity`, `image_url1`, `image_url2`) VALUES
(8, 'Nike Pegasus 41', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 75.00, '#008185', 1, 1, 2, 1, 10, 'images/AIR+ZOOM+PEGASUS+41.jpeg', 'images/AIR+ZOOM+PEGASUS+41.png'),
(9, 'Nike KD17 Men\'s Basketball Shoes', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 75.00, '#5f4176', 1, 1, 1, 1, 15, 'images/KD17.jpeg', 'images/KD17 (1).jpeg'),
(10, 'UA Bandit Trail 3 Men\'s Running Shoes', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 75.00, '#4e4e4e', 2, 1, 1, 1, 15, 'images/UA.jpg', 'images/ua22.jpg'),
(11, 'UA Magnetico Elite 4 FG Men\'s UA Soccer Cleats', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 75.00, '#e4a92b', 2, 1, 1, 1, 10, 'images/ua1.jpg', 'images/ua2.jpg'),
(12, 'Nike Air Max 270 Men\'s Road Running Shoes', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 75.00, '#c8cacb', 1, 1, 2, 1, 12, 'images/AIR+MAX+270.png', 'images/AIR+MAX+270 (1).png'),
(13, 'Nike Air Max 1 Men\'s Road Running Shoes', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 75.00, '#b0b5ba', 1, 1, 1, 1, 10, 'images/NIKE+AIR+MAX+1.png', 'images/NIKE+AIR+MAX+1 (1).png'),
(14, 'Nike Dunk Low Men\'s Running Shoes', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 75.00, '#42321e', 1, 1, 1, 1, 14, 'images/NIKE+DUNK+LOW+NN (1).png', 'images/NIKE+DUNK+LOW+NN.png'),
(15, 'Nike Zoom Vomero 5 Men\'s UA Soccer Cleats', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 75.00, '#7e3405', 1, 1, 2, 1, 15, 'images/NIKE+ZOOM+VOMERO+5.jpeg', 'images/NIKE+ZOOM+VOMERO+5 (1).jpeg'),
(16, 'Nike W AF1 Shadow Women\'s Casual Shoes', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 75.00, '#e1377d', 1, 2, 1, 1, 10, 'images/W+AF1+SHADOW.png', 'images/W+AF1+SHADOW (1).png'),
(20, 'Nike Pegasus Plus Women\'s Road Running Shoes', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 75.00, '#ff7581', 1, 2, 1, 1, 15, 'images/W+PEGASUS+PLUS.png', 'images/W+PEGASUS+PLUS (1).png'),
(21, 'W Air Force 1 Casual Shoes', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 75.00, '#c6bcbc', 1, 2, 1, 1, 12, 'images/W+AIR+FORCE+1+\'07+FLYEASE.png', 'images/W+AIR+FORCE+1+\'07+FLYEASE (1).png'),
(22, 'W Nike Metcon Women\'s Shoe', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 75.00, '#fa6b33', 1, 2, 1, 1, 14, 'images/W+NIKE+FREE+METCON+6.png', 'images/W+NIKE+FREE+METCON+6.jpeg'),
(23, 'W Nike Journey Women Running Shoe', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 75.00, '#ff94a0', 1, 2, 2, 1, 13, 'images/W+NIKE+JOURNEY+RUN.png', 'images/W+NIKE+JOURNEY+RUN (1).png'),
(24, 'W Nike P-6000 Women\'s Road Running Shoes', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 75.00, '#dbd8cd', 1, 2, 1, 1, 11, 'images/W+NIKE+P-6000+PRM.png', 'images/W+NIKE+P-6000+PRM (1).png'),
(25, 'W Renew TR 12 Women\'s Running Shoes', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 75.00, '#6c5662', 1, 2, 1, 1, 10, 'images/W+RENEW+IN-SEASON+TR+12+PRM.jpeg', 'images/W+RENEW+IN-SEASON+TR+12+PRM (1).jpeg'),
(26, 'W Nike Air Max Casual Shoe', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 75.00, '#c1bea4', 1, 2, 1, 1, 15, 'images/WMNS+NIKE+AIR+MAX+SC.png', 'images/WMNS+NIKE+AIR+MAX+SC (1).png'),
(28, 'Air Jordan 3 Retro Kids Casual Shoes', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 75.00, '#1d1d1d', 1, 3, 1, 1, 15, 'images/AIR+JORDAN+3+RETRO+(GS).jpeg', 'images/AIR+JORDAN+3+RETRO+(GS).png'),
(29, 'Giannis Freak Kids Casual Shoes', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 75.00, '#b9383f', 1, 3, 1, 1, 15, 'images/GIANNIS+FREAK+6+(GS).png', 'images/GIANNIS+FREAK+6+(GS) (1).png'),
(30, 'Giannis Immortality Kids Casual Shoes', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 75.00, '#e8ebef', 1, 3, 1, 1, 14, 'images/GIANNIS+IMMORTALITY+4+(PS).png', 'images/GIANNIS+IMMORTALITY+4+(PS) (1).png'),
(31, 'Jordan 1 Kids Casual Shoes', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 75.00, '#2e2d2f', 1, 3, 1, 1, 12, 'images/JORDAN+1+CRIB+BOOTIE.png', 'images/JORDAN+1+CRIB+BOOTIE (1).png'),
(32, 'Jordan 3 Retro Kids Sneaker', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 75.00, '#d0d1cc', 1, 3, 1, 1, 13, 'images/JORDAN+3+RETRO+(PS).png', 'images/JORDAN+3+RETRO+(PS) (1).png'),
(33, 'Kobe VIII Kids Casual Shoes', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 75.00, '#c5002e', 1, 3, 1, 1, 10, 'images/KOBE+VIII+(GS).jpeg', 'images/KOBE+VIII+(GS) (1).jpeg'),
(34, 'Kobe VIII PS Kids Casual Shoes', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 75.00, '#141216', 1, 3, 1, 1, 11, 'images/KOBE+VIII+(PS).png', 'images/KOBE+VIII+(PS) (1).png'),
(35, 'Nike Dunk Kids Casual Shoes', 'Experience the ultimate fusion of style and comfort with Nike kids’ casual shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Nike kids’ casual shoes.', 75.00, '#f55c9e', 1, 3, 1, 1, 14, 'images/NIKE+DUNK+LOW+(TDE).png', 'images/NIKE+DUNK+LOW+(TDE) (1).png'),
(36, 'Air Jordan 4 Men\'s casual Shoes', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 100.00, '#181818', 1, 1, 1, 2, 3, 'images/AIR+JORDAN+4+RM.jpeg', 'images/AIR+JORDAN+4+RM.png'),
(37, 'Air Jordan 4 Men\'s casual Shoes', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 100.00, '#151417', 1, 1, 1, 2, 4, 'images/AIR+FORCE+1+\'07+LV8.jpeg', 'images/AIR+FORCE+1+\'07+LV8.png'),
(38, 'Air Jordan 3 Retro', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 125.00, '#efefef', 1, 1, 1, 2, 2, 'images/AIR+JORDAN+3+RETRO.png', 'images/AIR+JORDAN+3+RETRO (1).png'),
(39, 'Air Force 1 Men\'s casual Shoes', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 90.00, '#d9dcdd', 1, 1, 1, 2, 2, 'images/AIR+FORCE+1+\'07.png', 'images/AIR+FORCE+1+\'07 (1).png'),
(40, 'Jordan Spizik E Men\'s casual Shoes', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 120.00, '#bebec0', 1, 1, 1, 2, 5, 'images/JORDAN+SPIZIKE+LOW.png', 'images/JORDAN+SPIZIKE+LOW (1).png'),
(41, 'Air Vapromax Men\'s casual Shoes', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 100.00, '#363638', 1, 1, 1, 2, 3, 'images/AIR+VAPORMAX+2023+FK+SE.png', 'images/AIR+VAPORMAX+2023+FK+SE.jpeg'),
(42, 'Nike Cortez Women\'s casual shoes', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 100.00, '#ada69a', 1, 2, 1, 2, 5, 'images/W+NIKE+CORTEZ+VNTG.png', 'images/W+NIKE+CORTEZ+VNTG (1).png'),
(43, 'Nike Metcon Women\'s running shoes', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 150.00, '#f86519', 1, 2, 1, 2, 3, 'images/W+NIKE+FREE+METCON+6.png', 'images/W+NIKE+FREE+METCON+6.jpeg'),
(44, 'Nike Journey Women\'s running shoes', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 90.00, '#ffa2a2', 1, 2, 1, 2, 6, 'images/W+NIKE+JOURNEY+RUN.png', 'images/W+NIKE+JOURNEY+RUN (1).png'),
(45, 'Nike Renew Women\'s Casual Shoes', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 95.00, '#5b4a58', 1, 2, 1, 2, 4, 'images/W+RENEW+IN-SEASON+TR+12+PRM.jpeg', 'images/W+RENEW+IN-SEASON+TR+12+PRM (1).jpeg'),
(46, 'Nike Blazer Women\'s Casual Shoes', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 110.00, '#d7d5cf', 1, 2, 1, 2, 4, 'images/W+NIKE+BLAZER+MID+VICTORY.png', 'images/W+NIKE+BLAZER+MID+VICTORY (1).png'),
(47, 'Nike ReactX Infinity Women\'s running shoes', 'Experience the ultimate fusion of style and comfort with Adidas men’s casual walking shoes. Discover a collection of versatile sneakers designed to elevate your everyday look while providing unmatched comfort. Step into fashion-forward footwear that complements your lifestyle with Adidas men’s casual walking shoes.', 140.00, '#abad99', 1, 2, 1, 2, 5, 'images/W+NKE+REACTX+INFINITY+RN+4+GTX.png', 'images/W+NKE+REACTX+INFINITY+RN+4+GTX (1).png');

-- --------------------------------------------------------

--
-- Table structure for table `product_sizes`
--

CREATE TABLE `product_sizes` (
  `size_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_sizes`
--

INSERT INTO `product_sizes` (`size_id`, `product_id`, `size`) VALUES
(22, 8, '8'),
(23, 8, '9'),
(24, 8, '10'),
(25, 9, '8'),
(26, 9, '9'),
(27, 9, '10'),
(28, 10, '8'),
(29, 10, '9'),
(30, 10, '10'),
(31, 11, '8'),
(32, 11, '9'),
(33, 11, '10'),
(34, 12, '8'),
(35, 12, '9'),
(36, 12, '10'),
(37, 13, '8'),
(38, 13, '9'),
(39, 13, '10'),
(40, 14, '8'),
(41, 14, '9'),
(42, 14, '10'),
(43, 15, '8'),
(44, 15, '9'),
(45, 15, '10'),
(46, 16, '8'),
(47, 16, '9'),
(48, 16, '10'),
(58, 20, '8'),
(59, 20, '9'),
(60, 20, '10'),
(61, 21, '8'),
(62, 21, '9'),
(63, 21, '10'),
(64, 22, '8'),
(65, 22, '9'),
(66, 22, '10'),
(67, 23, '8'),
(68, 23, '9'),
(69, 23, '10'),
(70, 24, '8'),
(71, 24, '9'),
(72, 24, '10'),
(73, 25, '8'),
(74, 25, '9'),
(75, 25, '10'),
(76, 26, '8'),
(77, 26, '9'),
(78, 26, '10'),
(82, 28, '8'),
(83, 28, '9'),
(84, 28, '10'),
(85, 29, '8'),
(86, 29, '9'),
(87, 29, '10'),
(88, 30, '8'),
(89, 30, '9'),
(90, 30, '10'),
(91, 31, '8'),
(92, 31, '9'),
(93, 31, '10'),
(94, 32, '8'),
(95, 32, '9'),
(96, 32, '10'),
(97, 33, '8'),
(98, 33, '9'),
(99, 33, '10'),
(100, 34, '8'),
(101, 34, '9'),
(102, 34, '10'),
(103, 35, '8'),
(104, 35, '9'),
(105, 35, '10'),
(106, 36, '8'),
(107, 36, '9'),
(108, 36, '10'),
(109, 37, '8'),
(110, 37, '9'),
(111, 37, '10'),
(112, 38, '8'),
(113, 38, '9'),
(114, 38, '10'),
(115, 39, '8'),
(116, 39, '9'),
(117, 39, '10'),
(118, 40, '8'),
(119, 40, '9'),
(120, 40, '10'),
(121, 41, '8'),
(122, 41, '9'),
(123, 41, '10'),
(124, 42, '8'),
(125, 42, '9'),
(126, 42, '10'),
(127, 43, '8'),
(128, 43, '9'),
(129, 43, '10'),
(130, 44, '8'),
(131, 44, '9'),
(132, 44, '10'),
(133, 45, '8'),
(134, 45, '9'),
(135, 45, '10'),
(136, 46, '8'),
(137, 46, '9'),
(138, 46, '10'),
(139, 47, '8'),
(140, 47, '9'),
(141, 47, '10');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `sale_id` tinyint(1) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`sale_id`, `status`) VALUES
(1, 'No'),
(2, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `top_selling`
--

CREATE TABLE `top_selling` (
  `topselling_id` tinyint(1) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `top_selling`
--

INSERT INTO `top_selling` (`topselling_id`, `status`) VALUES
(1, 'No'),
(2, 'Yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `a_details`
--
ALTER TABLE `a_details`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `c_details`
--
ALTER TABLE `c_details`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `ordertest`
--
ALTER TABLE `ordertest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `category_id_2` (`category_id`),
  ADD KEY `fk_topselling` (`topselling_id`),
  ADD KEY `fk_sale` (`sale_id`);

--
-- Indexes for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD PRIMARY KEY (`size_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `top_selling`
--
ALTER TABLE `top_selling`
  ADD PRIMARY KEY (`topselling_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `a_details`
--
ALTER TABLE `a_details`
  MODIFY `aid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `c_details`
--
ALTER TABLE `c_details`
  MODIFY `cid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ordertest`
--
ALTER TABLE `ordertest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `product_sizes`
--
ALTER TABLE `product_sizes`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=154;

--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `sale_id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `top_selling`
--
ALTER TABLE `top_selling`
  MODIFY `topselling_id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_sale` FOREIGN KEY (`sale_id`) REFERENCES `sale` (`sale_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_topselling` FOREIGN KEY (`topselling_id`) REFERENCES `top_selling` (`topselling_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_sizes`
--
ALTER TABLE `product_sizes`
  ADD CONSTRAINT `product_sizes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
