-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2021 at 07:48 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blogsite`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) NOT NULL,
  `datetime` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(30) NOT NULL,
  `headline` varchar(30) NOT NULL,
  `bio` text NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `addedby` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `datetime`, `username`, `password`, `name`, `headline`, `bio`, `image`, `addedby`) VALUES
(1, '22-June-2021 12: 37', 'snehalbera', '5bb5aff891d4f5d841b26a6cb8122156', 'Snehal Bera', 'Undergrad | Web Developer', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'default.jpg', 'snehalbera'),
(2, '22-June-2021 12: 38', 'admin', '0192023a7bbd73250516f069df18b500', 'Admin', 'Headline', '', 'default.jpg', 'snehalbera');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `admin` varchar(30) NOT NULL,
  `datetime` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `admin`, `datetime`) VALUES
(1, 'Technology', 'snehalbera', '17-June-2021 20: 51'),
(2, 'Advance Communication', 'snehalbera', '17-June-2021 20: 51'),
(3, 'Artificial Intelligence', 'snehalbera', '17-June-2021 20: 52'),
(4, 'Music', 'snehalbera', '17-June-2021 20: 52'),
(5, 'Sports', 'snehalbera', '17-June-2021 20: 52'),
(6, 'Software', 'snehalbera', '17-June-2021 20: 52'),
(7, 'Development', 'snehalbera', '17-June-2021 20: 52'),
(8, 'Smart Devices', 'snehalbera', '17-June-2021 20: 53'),
(9, 'Science', 'snehalbera', '17-June-2021 20: 54'),
(10, 'Wildlife', 'snehalbera', '17-June-2021 20: 54'),
(11, 'Entertainment', 'snehalbera', '17-June-2021 20: 54'),
(12, 'Learning', 'snehalbera', '20-June-2021 18: 50');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) NOT NULL,
  `datetime` varchar(30) NOT NULL,
  `commenter` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `comment` text NOT NULL,
  `approvedby` varchar(30) NOT NULL,
  `status` varchar(3) NOT NULL,
  `postid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `datetime`, `commenter`, `email`, `comment`, `approvedby`, `status`, `postid`) VALUES
(1, '22-June-2021 01: 46', 'Anonymous', 'anonymous@mail.com', 'I love the new updates!', 'snehalbera', 'ON', 11),
(3, '22-June-2021 01: 49', 'Anonymous', 'anonymous@mail.com', 'I love these new IphonesðŸ˜ðŸ˜ðŸ˜', 'snehalbera', 'ON', 1),
(4, '22-June-2021 01: 52', 'Anonymous', 'anonymous@mail.com', 'I love these new iPads. They are amazingðŸ˜ðŸ˜ðŸ˜', 'snehalbera', 'ON', 2),
(5, '22-June-2021 18: 48', 'Anonymous', 'anonymous@mail.com', 'Wow!!! I need one.', 'snehalbera', 'ON', 2),
(6, '22-June-2021 18: 56', 'Anonymous', 'anonymous@mail.com', 'Yes. They have also improved its performance and efficiency ðŸ‘Œ', 'snehalbera', 'ON', 11),
(7, '22-June-2021 19: 03', 'Anonymous', 'anonymous@mail.com', 'Apple Ecosystem ðŸ˜', 'None', 'OFF', 3),
(8, '22-June-2021 19: 05', 'Anonymous', 'anonymous@mail.com', 'Work from Home is the new normal.', 'snehalbera', 'ON', 4),
(9, '22-June-2021 20: 52', 'Anonymous', 'anonymous@mail.com', 'Wow!!!', 'snehalbera', 'ON', 12);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) NOT NULL,
  `datetime` varchar(30) NOT NULL,
  `title` text NOT NULL,
  `subtitle` varchar(300) NOT NULL,
  `category` varchar(30) NOT NULL,
  `publisher` varchar(30) NOT NULL,
  `image` varchar(255) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `datetime`, `title`, `subtitle`, `category`, `publisher`, `image`, `content`) VALUES
(1, '17-June-2021 21: 33', 'iPhone 11 Pro review reveals eye-catching upgrade for Apple', 'The new phones are the iPhone 11, the iPhone 11 Pro and the iPhone 11 Pro Max, replacing the iPhone XR, iPhone XS and iPhone XS Max respectively', 'Smart Devices', 'snehalbera', 'iphone 11 pro.jpg', '<p>Apple on September 10, 2019, unveiled its newest flagship iPhones, the iPhone 11 Pro and the iPhone 11 Pro Max, which are being sold alongside the iPhone 11. Apple says that the 5.8-inch and 6.5-inch iPhone 11 Pro and iPhone 11 Pro Max have a new \"Pro\" moniker because the two devices are designed for users who want the very best smartphone that\'s available.</p>\r\n<p>\r\nBoth new iPhones feature Super Retina XDR OLED displays, with the 5.8-inch iPhone 11 Pro offering a 2426 x 1125 resolution and the 6.5-inch iPhone offering a 2688 x 1242 resolution.\r\n</p>\r\n<p>\r\nThe new phones feature HDR support, a 2,000,000:1 contrast ratio, and 800 nits max brightness (1200 for HDR). True Tone is included for matching the white balance of the display to the ambient lighting in the room to make it easier on the eyes, as is wide color for more vivid, true-to-life colors.</p>'),
(2, '20-June-2021 00: 22', 'iPad Pro 2020: All there is to know about Apple\'s new tablet', 'The new iPad Pro 2020 is finally here, and it comes in two flavours: the 11-inch and the 12.9-inch.', 'Smart Devices', 'snehalbera', 'ipad.jpg', '<h2>Introduction</h2>\r\n<p>iPad Pro reviews have confirmed that while the 2020 iPad Pro update itself is minor in scale, the LiDAR Scanner paves the way for new augmented reality capabilities in the future. </p>\r\n<p>The A12Z Bionic chip in the 2020 iPad Pro offers similar performance to the previous-generation A12X chip though it does have enhanced thermal architecture, and the main additions are an ultra wide-angle camera, the aforementioned LiDAR scanner, and improved microphones. </p>\r\n<p>Reviewers were unable to test the LiDAR scanner in-depth because there are few apps that take advantage of it at the current time. <em>The Verge</em> even described it as a \"powerful and interesting sensor\" that is an \"extra thing\" some users may not even use.</p>\r\n<p>In, the 2020 iPad Pro doesn\'t offer enough to entice 2018 iPad Pro owners to upgrade, but it is worth considering for those who have an older iPad Pro model due to the powerful processor, 6GB RAM, WiFi 6, and LiDAR Scanner for enhanced AR.</p>'),
(3, '20-June-2021 00: 26', 'Apple and the myth of the impregnable ecosystem', 'With its locked ecosystem and skilfully orchestrated communications, Apple is fine-tuning its image as the unassailable fortress', 'Smart Devices', 'snehalbera', 'ipad pro.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sollicitudin ut massa sit amet pellentesque. Etiam augue neque, accumsan ultrices convallis non, tincidunt ac quam. Praesent maximus lacus at pellentesque ultrices. Maecenas feugiat rutrum nibh sit amet maximus. Nam vehicula ligula in leo imperdiet maximus. Aliquam eleifend venenatis lacus, ac porttitor elit elementum et. Etiam posuere lorem vitae elementum vestibulum. Proin convallis viverra nisl nec rutrum. Donec commodo ex nisl, sed ullamcorper urna sodales id. Nunc nec arcu dictum, ornare justo ac, vestibulum diam. Nulla ornare nisi non condimentum ultrices. Nullam nec blandit libero, in efficitur enim. Phasellus rhoncus mattis ante, eget placerat justo dignissim ut. Donec id congue augue. Duis sodales justo at porttitor euismod.</p>\r\n\r\n<p>Aliquam ac est vestibulum, mollis magna vel, vehicula lacus. Morbi leo lorem, vehicula eu pretium pharetra, congue vitae velit. Nam porttitor volutpat ante ac maximus. Cras vel lacus ipsum. Morbi faucibus metus quis nisl congue aliquet. Morbi maximus enim ut nulla suscipit mollis at vel quam. Proin euismod purus eget mauris sollicitudin vehicula. Sed sagittis tempor ex, ac fermentum nibh posuere vel. Vivamus venenatis suscipit nulla vitae posuere. Nulla finibus volutpat tincidunt. Pellentesque eu convallis est. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>\r\n\r\n<p>Praesent eros nibh, accumsan a nulla ut, bibendum blandit leo. Aliquam at consequat lacus, vitae porttitor velit. Quisque convallis, ligula id fringilla lacinia, justo eros tincidunt est, sit amet molestie ante metus et mi. Phasellus vestibulum sem in dui vestibulum posuere. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed eget venenatis lacus, sed ornare nulla. Pellentesque quis est vehicula, aliquam augue vel, porttitor elit. Maecenas velit augue, dictum id ipsum a, malesuada placerat metus. Etiam aliquet sodales ex vitae aliquet. Quisque semper in velit et pellentesque. Morbi aliquam placerat lectus, at pharetra ligula venenatis sit amet. Sed pharetra quam vitae mauris lacinia eleifend. Pellentesque cursus fringilla dolor et luctus.</p>\r\n	\r\n<p>Maecenas pulvinar laoreet sapien, a auctor ante tempus vitae. Ut vel mauris sed dui cursus ultricies congue quis metus. Nam in blandit diam, eu lacinia turpis. Ut et porttitor lorem. Donec accumsan, nisl nec gravida vestibulum, magna lorem tristique sapien, ac aliquam risus orci nec nibh. Maecenas purus tortor, eleifend id felis at, ullamcorper blandit nulla. Nullam dictum tempus tortor. In hendrerit eget metus eu volutpat. Aliquam et lobortis justo, non interdum orci. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum nec justo molestie, ultricies ex dapibus, viverra magna. Nulla eu commodo elit.</p>				    '),
(4, '20-June-2021 00: 29', 'This task management tool will help you stay focused while you work from home', 'Task Pigeon is a clean, intuitive task management system that puts your entire work life into perspective at a glance', 'Development', 'snehalbera', 'development.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sollicitudin ut massa sit amet pellentesque. Etiam augue neque, accumsan ultrices convallis non, tincidunt ac quam. Praesent maximus lacus at pellentesque ultrices. Maecenas feugiat rutrum nibh sit amet maximus. Nam vehicula ligula in leo imperdiet maximus. Aliquam eleifend venenatis lacus, ac porttitor elit elementum et. Etiam posuere lorem vitae elementum vestibulum. Proin convallis viverra nisl nec rutrum. Donec commodo ex nisl, sed ullamcorper urna sodales id. Nunc nec arcu dictum, ornare justo ac, vestibulum diam. Nulla ornare nisi non condimentum ultrices. Nullam nec blandit libero, in efficitur enim. Phasellus rhoncus mattis ante, eget placerat justo dignissim ut. Donec id congue augue. Duis sodales justo at porttitor euismod.</p>\r\n\r\n<p>Aliquam ac est vestibulum, mollis magna vel, vehicula lacus. Morbi leo lorem, vehicula eu pretium pharetra, congue vitae velit. Nam porttitor volutpat ante ac maximus. Cras vel lacus ipsum. Morbi faucibus metus quis nisl congue aliquet. Morbi maximus enim ut nulla suscipit mollis at vel quam. Proin euismod purus eget mauris sollicitudin vehicula. Sed sagittis tempor ex, ac fermentum nibh posuere vel. Vivamus venenatis suscipit nulla vitae posuere. Nulla finibus volutpat tincidunt. Pellentesque eu convallis est. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>\r\n\r\n<p>Praesent eros nibh, accumsan a nulla ut, bibendum blandit leo. Aliquam at consequat lacus, vitae porttitor velit. Quisque convallis, ligula id fringilla lacinia, justo eros tincidunt est, sit amet molestie ante metus et mi. Phasellus vestibulum sem in dui vestibulum posuere. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed eget venenatis lacus, sed ornare nulla. Pellentesque quis est vehicula, aliquam augue vel, porttitor elit. Maecenas velit augue, dictum id ipsum a, malesuada placerat metus. Etiam aliquet sodales ex vitae aliquet. Quisque semper in velit et pellentesque. Morbi aliquam placerat lectus, at pharetra ligula venenatis sit amet. Sed pharetra quam vitae mauris lacinia eleifend. Pellentesque cursus fringilla dolor et luctus.</p>\r\n	\r\n<p>Maecenas pulvinar laoreet sapien, a auctor ante tempus vitae. Ut vel mauris sed dui cursus ultricies congue quis metus. Nam in blandit diam, eu lacinia turpis. Ut et porttitor lorem. Donec accumsan, nisl nec gravida vestibulum, magna lorem tristique sapien, ac aliquam risus orci nec nibh. Maecenas purus tortor, eleifend id felis at, ullamcorper blandit nulla. Nullam dictum tempus tortor. In hendrerit eget metus eu volutpat. Aliquam et lobortis justo, non interdum orci. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum nec justo molestie, ultricies ex dapibus, viverra magna. Nulla eu commodo elit.</p>				    '),
(5, '20-June-2021 00: 30', 'GitHub is now free for all developer teams', 'Currently, GitHub has more than 40 million developers on the platform, and it aiming 100 million developers by 2025', 'Development', 'snehalbera', 'default.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sollicitudin ut massa sit amet pellentesque. Etiam augue neque, accumsan ultrices convallis non, tincidunt ac quam. Praesent maximus lacus at pellentesque ultrices. Maecenas feugiat rutrum nibh sit amet maximus. Nam vehicula ligula in leo imperdiet maximus. Aliquam eleifend venenatis lacus, ac porttitor elit elementum et. Etiam posuere lorem vitae elementum vestibulum. Proin convallis viverra nisl nec rutrum. Donec commodo ex nisl, sed ullamcorper urna sodales id. Nunc nec arcu dictum, ornare justo ac, vestibulum diam. Nulla ornare nisi non condimentum ultrices. Nullam nec blandit libero, in efficitur enim. Phasellus rhoncus mattis ante, eget placerat justo dignissim ut. Donec id congue augue. Duis sodales justo at porttitor euismod.</p>\r\n\r\n<p>Aliquam ac est vestibulum, mollis magna vel, vehicula lacus. Morbi leo lorem, vehicula eu pretium pharetra, congue vitae velit. Nam porttitor volutpat ante ac maximus. Cras vel lacus ipsum. Morbi faucibus metus quis nisl congue aliquet. Morbi maximus enim ut nulla suscipit mollis at vel quam. Proin euismod purus eget mauris sollicitudin vehicula. Sed sagittis tempor ex, ac fermentum nibh posuere vel. Vivamus venenatis suscipit nulla vitae posuere. Nulla finibus volutpat tincidunt. Pellentesque eu convallis est. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>\r\n\r\n<p>Praesent eros nibh, accumsan a nulla ut, bibendum blandit leo. Aliquam at consequat lacus, vitae porttitor velit. Quisque convallis, ligula id fringilla lacinia, justo eros tincidunt est, sit amet molestie ante metus et mi. Phasellus vestibulum sem in dui vestibulum posuere. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed eget venenatis lacus, sed ornare nulla. Pellentesque quis est vehicula, aliquam augue vel, porttitor elit. Maecenas velit augue, dictum id ipsum a, malesuada placerat metus. Etiam aliquet sodales ex vitae aliquet. Quisque semper in velit et pellentesque. Morbi aliquam placerat lectus, at pharetra ligula venenatis sit amet. Sed pharetra quam vitae mauris lacinia eleifend. Pellentesque cursus fringilla dolor et luctus.</p>\r\n	\r\n<p>Maecenas pulvinar laoreet sapien, a auctor ante tempus vitae. Ut vel mauris sed dui cursus ultricies congue quis metus. Nam in blandit diam, eu lacinia turpis. Ut et porttitor lorem. Donec accumsan, nisl nec gravida vestibulum, magna lorem tristique sapien, ac aliquam risus orci nec nibh. Maecenas purus tortor, eleifend id felis at, ullamcorper blandit nulla. Nullam dictum tempus tortor. In hendrerit eget metus eu volutpat. Aliquam et lobortis justo, non interdum orci. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum nec justo molestie, ultricies ex dapibus, viverra magna. Nulla eu commodo elit.</p>				    '),
(6, '20-June-2021 00: 30', '2020 to be a \"bumper year\" for data centre M&A - amid Covid-19 - as value surpasses 2019 total', 'According to the latest note from Synergy Research, data centre merger and acquisition deals for the first four months of this year have already surpassed the 2019 total.', 'Advance Communication', 'snehalbera', 'imgix.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sollicitudin ut massa sit amet pellentesque. Etiam augue neque, accumsan ultrices convallis non, tincidunt ac quam. Praesent maximus lacus at pellentesque ultrices. Maecenas feugiat rutrum nibh sit amet maximus. Nam vehicula ligula in leo imperdiet maximus. Aliquam eleifend venenatis lacus, ac porttitor elit elementum et. Etiam posuere lorem vitae elementum vestibulum. Proin convallis viverra nisl nec rutrum. Donec commodo ex nisl, sed ullamcorper urna sodales id. Nunc nec arcu dictum, ornare justo ac, vestibulum diam. Nulla ornare nisi non condimentum ultrices. Nullam nec blandit libero, in efficitur enim. Phasellus rhoncus mattis ante, eget placerat justo dignissim ut. Donec id congue augue. Duis sodales justo at porttitor euismod.</p>\r\n\r\n<p>Aliquam ac est vestibulum, mollis magna vel, vehicula lacus. Morbi leo lorem, vehicula eu pretium pharetra, congue vitae velit. Nam porttitor volutpat ante ac maximus. Cras vel lacus ipsum. Morbi faucibus metus quis nisl congue aliquet. Morbi maximus enim ut nulla suscipit mollis at vel quam. Proin euismod purus eget mauris sollicitudin vehicula. Sed sagittis tempor ex, ac fermentum nibh posuere vel. Vivamus venenatis suscipit nulla vitae posuere. Nulla finibus volutpat tincidunt. Pellentesque eu convallis est. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>\r\n\r\n<p>Praesent eros nibh, accumsan a nulla ut, bibendum blandit leo. Aliquam at consequat lacus, vitae porttitor velit. Quisque convallis, ligula id fringilla lacinia, justo eros tincidunt est, sit amet molestie ante metus et mi. Phasellus vestibulum sem in dui vestibulum posuere. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed eget venenatis lacus, sed ornare nulla. Pellentesque quis est vehicula, aliquam augue vel, porttitor elit. Maecenas velit augue, dictum id ipsum a, malesuada placerat metus. Etiam aliquet sodales ex vitae aliquet. Quisque semper in velit et pellentesque. Morbi aliquam placerat lectus, at pharetra ligula venenatis sit amet. Sed pharetra quam vitae mauris lacinia eleifend. Pellentesque cursus fringilla dolor et luctus.</p>\r\n	\r\n<p>Maecenas pulvinar laoreet sapien, a auctor ante tempus vitae. Ut vel mauris sed dui cursus ultricies congue quis metus. Nam in blandit diam, eu lacinia turpis. Ut et porttitor lorem. Donec accumsan, nisl nec gravida vestibulum, magna lorem tristique sapien, ac aliquam risus orci nec nibh. Maecenas purus tortor, eleifend id felis at, ullamcorper blandit nulla. Nullam dictum tempus tortor. In hendrerit eget metus eu volutpat. Aliquam et lobortis justo, non interdum orci. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum nec justo molestie, ultricies ex dapibus, viverra magna. Nulla eu commodo elit.</p>'),
(7, '20-June-2021 00: 31', 'New iPhone 12: Everything we know about Apple\'s 2020 iPhones', 'The iPhone 12 is set to be announced in September, but what are we expecting from the latest iPhone generation?', 'Smart Devices', 'snehalbera', 'iphone 11 series.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sollicitudin ut massa sit amet pellentesque. Etiam augue neque, accumsan ultrices convallis non, tincidunt ac quam. Praesent maximus lacus at pellentesque ultrices. Maecenas feugiat rutrum nibh sit amet maximus. Nam vehicula ligula in leo imperdiet maximus. Aliquam eleifend venenatis lacus, ac porttitor elit elementum et. Etiam posuere lorem vitae elementum vestibulum. Proin convallis viverra nisl nec rutrum. Donec commodo ex nisl, sed ullamcorper urna sodales id. Nunc nec arcu dictum, ornare justo ac, vestibulum diam. Nulla ornare nisi non condimentum ultrices. Nullam nec blandit libero, in efficitur enim. Phasellus rhoncus mattis ante, eget placerat justo dignissim ut. Donec id congue augue. Duis sodales justo at porttitor euismod.</p>\r\n\r\n<p>Aliquam ac est vestibulum, mollis magna vel, vehicula lacus. Morbi leo lorem, vehicula eu pretium pharetra, congue vitae velit. Nam porttitor volutpat ante ac maximus. Cras vel lacus ipsum. Morbi faucibus metus quis nisl congue aliquet. Morbi maximus enim ut nulla suscipit mollis at vel quam. Proin euismod purus eget mauris sollicitudin vehicula. Sed sagittis tempor ex, ac fermentum nibh posuere vel. Vivamus venenatis suscipit nulla vitae posuere. Nulla finibus volutpat tincidunt. Pellentesque eu convallis est. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>\r\n\r\n<p>Praesent eros nibh, accumsan a nulla ut, bibendum blandit leo. Aliquam at consequat lacus, vitae porttitor velit. Quisque convallis, ligula id fringilla lacinia, justo eros tincidunt est, sit amet molestie ante metus et mi. Phasellus vestibulum sem in dui vestibulum posuere. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed eget venenatis lacus, sed ornare nulla. Pellentesque quis est vehicula, aliquam augue vel, porttitor elit. Maecenas velit augue, dictum id ipsum a, malesuada placerat metus. Etiam aliquet sodales ex vitae aliquet. Quisque semper in velit et pellentesque. Morbi aliquam placerat lectus, at pharetra ligula venenatis sit amet. Sed pharetra quam vitae mauris lacinia eleifend. Pellentesque cursus fringilla dolor et luctus.</p>\r\n	\r\n<p>Maecenas pulvinar laoreet sapien, a auctor ante tempus vitae. Ut vel mauris sed dui cursus ultricies congue quis metus. Nam in blandit diam, eu lacinia turpis. Ut et porttitor lorem. Donec accumsan, nisl nec gravida vestibulum, magna lorem tristique sapien, ac aliquam risus orci nec nibh. Maecenas purus tortor, eleifend id felis at, ullamcorper blandit nulla. Nullam dictum tempus tortor. In hendrerit eget metus eu volutpat. Aliquam et lobortis justo, non interdum orci. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum nec justo molestie, ultricies ex dapibus, viverra magna. Nulla eu commodo elit.</p>'),
(8, '20-June-2021 00: 31', 'Apple Leak Reveals Radical New MacBook', 'One of the biggest obstacles facing an ARM powered MacBook will be third-party application support, so it\'s unlikely that Apple can make the jump from Intel to ARM in a single move', 'Smart Devices', 'snehalbera', 'macbook pro.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sollicitudin ut massa sit amet pellentesque. Etiam augue neque, accumsan ultrices convallis non, tincidunt ac quam. Praesent maximus lacus at pellentesque ultrices. Maecenas feugiat rutrum nibh sit amet maximus. Nam vehicula ligula in leo imperdiet maximus. Aliquam eleifend venenatis lacus, ac porttitor elit elementum et. Etiam posuere lorem vitae elementum vestibulum. Proin convallis viverra nisl nec rutrum. Donec commodo ex nisl, sed ullamcorper urna sodales id. Nunc nec arcu dictum, ornare justo ac, vestibulum diam. Nulla ornare nisi non condimentum ultrices. Nullam nec blandit libero, in efficitur enim. Phasellus rhoncus mattis ante, eget placerat justo dignissim ut. Donec id congue augue. Duis sodales justo at porttitor euismod.</p>\r\n\r\n<p>Aliquam ac est vestibulum, mollis magna vel, vehicula lacus. Morbi leo lorem, vehicula eu pretium pharetra, congue vitae velit. Nam porttitor volutpat ante ac maximus. Cras vel lacus ipsum. Morbi faucibus metus quis nisl congue aliquet. Morbi maximus enim ut nulla suscipit mollis at vel quam. Proin euismod purus eget mauris sollicitudin vehicula. Sed sagittis tempor ex, ac fermentum nibh posuere vel. Vivamus venenatis suscipit nulla vitae posuere. Nulla finibus volutpat tincidunt. Pellentesque eu convallis est. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>\r\n\r\n<p>Praesent eros nibh, accumsan a nulla ut, bibendum blandit leo. Aliquam at consequat lacus, vitae porttitor velit. Quisque convallis, ligula id fringilla lacinia, justo eros tincidunt est, sit amet molestie ante metus et mi. Phasellus vestibulum sem in dui vestibulum posuere. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed eget venenatis lacus, sed ornare nulla. Pellentesque quis est vehicula, aliquam augue vel, porttitor elit. Maecenas velit augue, dictum id ipsum a, malesuada placerat metus. Etiam aliquet sodales ex vitae aliquet. Quisque semper in velit et pellentesque. Morbi aliquam placerat lectus, at pharetra ligula venenatis sit amet. Sed pharetra quam vitae mauris lacinia eleifend. Pellentesque cursus fringilla dolor et luctus.</p>\r\n	\r\n<p>Maecenas pulvinar laoreet sapien, a auctor ante tempus vitae. Ut vel mauris sed dui cursus ultricies congue quis metus. Nam in blandit diam, eu lacinia turpis. Ut et porttitor lorem. Donec accumsan, nisl nec gravida vestibulum, magna lorem tristique sapien, ac aliquam risus orci nec nibh. Maecenas purus tortor, eleifend id felis at, ullamcorper blandit nulla. Nullam dictum tempus tortor. In hendrerit eget metus eu volutpat. Aliquam et lobortis justo, non interdum orci. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum nec justo molestie, ultricies ex dapibus, viverra magna. Nulla eu commodo elit.</p>'),
(9, '20-June-2021 00: 32', 'New macOS update is wrecking MacBooks?', 'While Microsoft botches one Windows 10 update after the next, Apple has quietly gone about its business launching new versions of macOS', 'Software', 'snehalbera', 'macOs.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sollicitudin ut massa sit amet pellentesque. Etiam augue neque, accumsan ultrices convallis non, tincidunt ac quam. Praesent maximus lacus at pellentesque ultrices. Maecenas feugiat rutrum nibh sit amet maximus. Nam vehicula ligula in leo imperdiet maximus. Aliquam eleifend venenatis lacus, ac porttitor elit elementum et. Etiam posuere lorem vitae elementum vestibulum. Proin convallis viverra nisl nec rutrum. Donec commodo ex nisl, sed ullamcorper urna sodales id. Nunc nec arcu dictum, ornare justo ac, vestibulum diam. Nulla ornare nisi non condimentum ultrices. Nullam nec blandit libero, in efficitur enim. Phasellus rhoncus mattis ante, eget placerat justo dignissim ut. Donec id congue augue. Duis sodales justo at porttitor euismod.</p>\r\n\r\n<p>Aliquam ac est vestibulum, mollis magna vel, vehicula lacus. Morbi leo lorem, vehicula eu pretium pharetra, congue vitae velit. Nam porttitor volutpat ante ac maximus. Cras vel lacus ipsum. Morbi faucibus metus quis nisl congue aliquet. Morbi maximus enim ut nulla suscipit mollis at vel quam. Proin euismod purus eget mauris sollicitudin vehicula. Sed sagittis tempor ex, ac fermentum nibh posuere vel. Vivamus venenatis suscipit nulla vitae posuere. Nulla finibus volutpat tincidunt. Pellentesque eu convallis est. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>\r\n\r\n<p>Praesent eros nibh, accumsan a nulla ut, bibendum blandit leo. Aliquam at consequat lacus, vitae porttitor velit. Quisque convallis, ligula id fringilla lacinia, justo eros tincidunt est, sit amet molestie ante metus et mi. Phasellus vestibulum sem in dui vestibulum posuere. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed eget venenatis lacus, sed ornare nulla. Pellentesque quis est vehicula, aliquam augue vel, porttitor elit. Maecenas velit augue, dictum id ipsum a, malesuada placerat metus. Etiam aliquet sodales ex vitae aliquet. Quisque semper in velit et pellentesque. Morbi aliquam placerat lectus, at pharetra ligula venenatis sit amet. Sed pharetra quam vitae mauris lacinia eleifend. Pellentesque cursus fringilla dolor et luctus.</p>\r\n	\r\n<p>Maecenas pulvinar laoreet sapien, a auctor ante tempus vitae. Ut vel mauris sed dui cursus ultricies congue quis metus. Nam in blandit diam, eu lacinia turpis. Ut et porttitor lorem. Donec accumsan, nisl nec gravida vestibulum, magna lorem tristique sapien, ac aliquam risus orci nec nibh. Maecenas purus tortor, eleifend id felis at, ullamcorper blandit nulla. Nullam dictum tempus tortor. In hendrerit eget metus eu volutpat. Aliquam et lobortis justo, non interdum orci. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum nec justo molestie, ultricies ex dapibus, viverra magna. Nulla eu commodo elit.</p>'),
(10, '20-June-2021 00: 32', 'Spotify allows fans to pay musicians directly', 'Spotify has introduced a new feature allowing artists to receive \"tips\" or donate money to charity', 'Music', 'snehalbera', 'spotify.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sollicitudin ut massa sit amet pellentesque. Etiam augue neque, accumsan ultrices convallis non, tincidunt ac quam. Praesent maximus lacus at pellentesque ultrices. Maecenas feugiat rutrum nibh sit amet maximus. Nam vehicula ligula in leo imperdiet maximus. Aliquam eleifend venenatis lacus, ac porttitor elit elementum et. Etiam posuere lorem vitae elementum vestibulum. Proin convallis viverra nisl nec rutrum. Donec commodo ex nisl, sed ullamcorper urna sodales id. Nunc nec arcu dictum, ornare justo ac, vestibulum diam. Nulla ornare nisi non condimentum ultrices. Nullam nec blandit libero, in efficitur enim. Phasellus rhoncus mattis ante, eget placerat justo dignissim ut. Donec id congue augue. Duis sodales justo at porttitor euismod.</p>\r\n\r\n<p>Aliquam ac est vestibulum, mollis magna vel, vehicula lacus. Morbi leo lorem, vehicula eu pretium pharetra, congue vitae velit. Nam porttitor volutpat ante ac maximus. Cras vel lacus ipsum. Morbi faucibus metus quis nisl congue aliquet. Morbi maximus enim ut nulla suscipit mollis at vel quam. Proin euismod purus eget mauris sollicitudin vehicula. Sed sagittis tempor ex, ac fermentum nibh posuere vel. Vivamus venenatis suscipit nulla vitae posuere. Nulla finibus volutpat tincidunt. Pellentesque eu convallis est. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>\r\n\r\n<p>Praesent eros nibh, accumsan a nulla ut, bibendum blandit leo. Aliquam at consequat lacus, vitae porttitor velit. Quisque convallis, ligula id fringilla lacinia, justo eros tincidunt est, sit amet molestie ante metus et mi. Phasellus vestibulum sem in dui vestibulum posuere. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed eget venenatis lacus, sed ornare nulla. Pellentesque quis est vehicula, aliquam augue vel, porttitor elit. Maecenas velit augue, dictum id ipsum a, malesuada placerat metus. Etiam aliquet sodales ex vitae aliquet. Quisque semper in velit et pellentesque. Morbi aliquam placerat lectus, at pharetra ligula venenatis sit amet. Sed pharetra quam vitae mauris lacinia eleifend. Pellentesque cursus fringilla dolor et luctus.</p>\r\n	\r\n<p>Maecenas pulvinar laoreet sapien, a auctor ante tempus vitae. Ut vel mauris sed dui cursus ultricies congue quis metus. Nam in blandit diam, eu lacinia turpis. Ut et porttitor lorem. Donec accumsan, nisl nec gravida vestibulum, magna lorem tristique sapien, ac aliquam risus orci nec nibh. Maecenas purus tortor, eleifend id felis at, ullamcorper blandit nulla. Nullam dictum tempus tortor. In hendrerit eget metus eu volutpat. Aliquam et lobortis justo, non interdum orci. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum nec justo molestie, ultricies ex dapibus, viverra magna. Nulla eu commodo elit.</p>'),
(11, '20-June-2021 00: 32', 'Tesla Jailbreaking: How to Combat Software Updates That Are Removing Car Features', 'Numerous used Tesla owners have experienced certain vehicle features vanish despite having paid for them', 'Artificial Intelligence', 'snehalbera', 'tesla dashboard.jpg', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam sollicitudin ut massa sit amet pellentesque. Etiam augue neque, accumsan ultrices convallis non, tincidunt ac quam. Praesent maximus lacus at pellentesque ultrices. Maecenas feugiat rutrum nibh sit amet maximus. Nam vehicula ligula in leo imperdiet maximus. Aliquam eleifend venenatis lacus, ac porttitor elit elementum et. Etiam posuere lorem vitae elementum vestibulum. Proin convallis viverra nisl nec rutrum. Donec commodo ex nisl, sed ullamcorper urna sodales id. Nunc nec arcu dictum, ornare justo ac, vestibulum diam. Nulla ornare nisi non condimentum ultrices. Nullam nec blandit libero, in efficitur enim. Phasellus rhoncus mattis ante, eget placerat justo dignissim ut. Donec id congue augue. Duis sodales justo at porttitor euismod.</p>\r\n\r\n<p>Aliquam ac est vestibulum, mollis magna vel, vehicula lacus. Morbi leo lorem, vehicula eu pretium pharetra, congue vitae velit. Nam porttitor volutpat ante ac maximus. Cras vel lacus ipsum. Morbi faucibus metus quis nisl congue aliquet. Morbi maximus enim ut nulla suscipit mollis at vel quam. Proin euismod purus eget mauris sollicitudin vehicula. Sed sagittis tempor ex, ac fermentum nibh posuere vel. Vivamus venenatis suscipit nulla vitae posuere. Nulla finibus volutpat tincidunt. Pellentesque eu convallis est. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>\r\n\r\n<p>Praesent eros nibh, accumsan a nulla ut, bibendum blandit leo. Aliquam at consequat lacus, vitae porttitor velit. Quisque convallis, ligula id fringilla lacinia, justo eros tincidunt est, sit amet molestie ante metus et mi. Phasellus vestibulum sem in dui vestibulum posuere. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed eget venenatis lacus, sed ornare nulla. Pellentesque quis est vehicula, aliquam augue vel, porttitor elit. Maecenas velit augue, dictum id ipsum a, malesuada placerat metus. Etiam aliquet sodales ex vitae aliquet. Quisque semper in velit et pellentesque. Morbi aliquam placerat lectus, at pharetra ligula venenatis sit amet. Sed pharetra quam vitae mauris lacinia eleifend. Pellentesque cursus fringilla dolor et luctus.</p>\r\n	\r\n<p>Maecenas pulvinar laoreet sapien, a auctor ante tempus vitae. Ut vel mauris sed dui cursus ultricies congue quis metus. Nam in blandit diam, eu lacinia turpis. Ut et porttitor lorem. Donec accumsan, nisl nec gravida vestibulum, magna lorem tristique sapien, ac aliquam risus orci nec nibh. Maecenas purus tortor, eleifend id felis at, ullamcorper blandit nulla. Nullam dictum tempus tortor. In hendrerit eget metus eu volutpat. Aliquam et lobortis justo, non interdum orci. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum nec justo molestie, ultricies ex dapibus, viverra magna. Nulla eu commodo elit.</p>'),
(12, '22-June-2021 20: 49', 'Windows 11: the latest on Microsoft\'s \'next-generation\' OS', 'All the new Windows 11', 'Software', 'snehalbera', 'windows11.png', '<p>Microsoft is promising to show off the \"next generation\" of Windows at a June 24th event at 11AM ET / 8AM PT. The update, which will likely be called Windows 11, is expected to have a revamped look for the operating system as well as updates to the platform\'s built-in store. </p>\r\n\r\n<p>We\'ve already gotten a look at the upcoming OS ahead of the announcement, as it leaked in a somewhat useable state. From what we\'ve seen, 11 will be a big visual overhaul, taking inspiration from the unreleased Windows 10X, with a redesigned taskbar and Start menu and overall cleaner look throughout, including places like File Explorer and the Windows Store. Despite the leak, there are still some things we\'ll have to wait for Microsoft to show off - for example, widgets appear to be back but aren\'t functioning in the leaked version. </p>\r\n\r\n<p>Microsoft said in 2015 that Windows 10 would be \"the last version of Windows,\" so hopefully the presentation will offer some insight as to why the company has decided to call the next version Windows 11 instead of something like Windows 10.5. </p>\r\n\r\n<p>You can check back here for any further information we find in leaks before the event as well as for news during and after Microsoft\'s official announcement. </p>');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `postid` (`postid`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `FOREIGN` FOREIGN KEY (`postid`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
