-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2020 at 02:47 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cinecafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `api_token`
--

CREATE TABLE `api_token` (
  `token_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `device_type` int(11) NOT NULL COMMENT '1=>ios,2=>android',
  `access_token` varchar(255) NOT NULL,
  `date_of_creation` datetime NOT NULL,
  `session_start_time` varchar(255) NOT NULL,
  `session_end_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `api_token`
--

INSERT INTO `api_token` (`token_id`, `member_id`, `device_type`, `access_token`, `date_of_creation`, `session_start_time`, `session_end_time`) VALUES
(1, 1, 2, 'ffa8f0dcfc7d039dc6e80f0cab930d16', '2020-02-10 15:35:40', '2020-02-10 15:35:40', ''),
(2, 2, 2, '78c51f9c79096a3491ff07fc342dcae1', '2020-02-10 16:29:05', '2020-02-10 16:29:05', ''),
(3, 3, 2, 'c37bf112b5a5552943f3d08951854196', '2020-02-10 17:57:28', '2020-02-10 17:57:28', ''),
(4, 8, 2, '8c7193d6d112b84a516bf51e60621ee7', '2020-02-11 12:30:57', '2020-02-11 12:30:57', ''),
(5, 10, 2, 'fd9f42f04786bbfefc98dfcfd175c605', '2020-02-11 12:42:07', '2020-02-11 12:42:07', ''),
(6, 12, 2, 'a10f11c678758595e120e1bfa913c6c5', '2020-02-11 12:49:26', '2020-02-11 12:49:26', ''),
(7, 15, 2, 'fd240452a006b6efd956aedcf0005ff8', '2020-02-11 14:47:10', '2020-02-11 14:47:10', ''),
(8, 18, 2, '290983aca689ef900c87a76c7a5e21f3', '2020-02-11 17:41:45', '2020-02-11 17:41:45', ''),
(9, 21, 2, '36aa9c1b54251ffeb4c480e8b096c0b3', '2020-02-11 18:17:46', '2020-02-11 18:17:46', ''),
(10, 23, 2, '9d6fa41abc8f4e8b9cd7a6a4f4e43c08', '2020-02-11 18:37:15', '2020-02-11 18:37:15', ''),
(11, 25, 2, 'f015c679e8f0969249fd5be361c34399', '2020-02-11 18:58:45', '2020-02-11 18:58:45', ''),
(12, 26, 2, '9166c44a51b474912384972ddc551ede', '2020-02-11 19:00:45', '2020-02-11 19:00:45', ''),
(13, 27, 2, '978fcd8b2127ad3866a772e715c7b398', '2020-02-11 19:11:57', '2020-02-11 19:11:57', ''),
(14, 29, 2, '0a8686a438f5c0fb90ff6bfadd37a58b', '2020-02-11 19:20:25', '2020-02-11 19:20:25', ''),
(15, 30, 2, '6306e5c291b8572bfe16acf7bec061b3', '2020-02-11 19:25:59', '2020-02-11 19:25:59', ''),
(16, 35, 2, 'cfe8e51546431b6db5d3bab45bde21d8', '2020-02-11 19:38:50', '2020-02-11 19:38:50', ''),
(17, 34, 2, '0a5876bc6f3adc3803f16b478103ceed', '2020-02-11 19:49:22', '2020-02-11 19:49:22', ''),
(18, 36, 2, '4396ef0c777e18340c59a7a9869903b8', '2020-02-11 20:03:36', '2020-02-11 20:03:36', ''),
(19, 37, 2, '39273a072cf86f11dc1a92141bebe526', '2020-02-11 20:12:05', '2020-02-11 20:12:05', ''),
(20, 38, 2, 'afe3014d9a9d0c90b4eba10232c63b0d', '2020-02-11 20:16:05', '2020-02-11 20:16:05', ''),
(21, 22, 2, '5eece96cc6863d6ca961fb3c227e346e', '2020-02-11 20:36:32', '2020-02-11 20:36:32', ''),
(22, 39, 2, '17aba86da889225061df64793d97ee6b', '2020-02-12 10:54:44', '2020-02-12 10:54:44', ''),
(23, 32, 2, 'da1c06ff1684d911b5e50f65662570b4', '2020-02-12 11:52:56', '2020-02-12 11:52:56', ''),
(24, 42, 2, '472c48dde284df8f955bfc586a45bbfe', '2020-02-12 11:56:17', '2020-02-12 11:56:17', ''),
(25, 41, 2, '9edf651e808f6a2f22a83fdb31270f5f', '2020-02-12 12:08:26', '2020-02-12 12:08:26', ''),
(26, 44, 2, 'ff41100b7201f5c0d386d4f32bc09785', '2020-02-12 12:55:02', '2020-02-12 12:55:02', ''),
(27, 45, 2, '99e7f46a3e5c5ae953b987cec5562773', '2020-02-12 13:05:03', '2020-02-12 13:05:03', ''),
(28, 47, 2, '943b8982cdfadbf9401a83689e7ef494', '2020-02-12 13:23:27', '2020-02-12 13:23:27', ''),
(29, 48, 2, 'e616a5898fca26f41d12b28fe99edc88', '2020-02-12 13:30:19', '2020-02-12 13:30:19', ''),
(30, 55, 2, '37bb238e36a303da35c3e3bd891ae7f7', '2020-02-12 15:00:10', '2020-02-12 15:00:10', ''),
(31, 57, 2, '1024f0baaab7993c4b814661f54c7f78', '2020-02-14 19:08:15', '2020-02-14 19:08:15', ''),
(32, 58, 2, '602118d67110efc90fe1582cf9781296', '2020-02-14 19:23:32', '2020-02-14 19:23:32', ''),
(34, 69, 2, '18739dc0a99529830777db1892af5fcb', '2020-02-24 17:22:53', '2020-02-24 17:22:53', ''),
(35, 71, 2, '72d4dc85887e61277a046151edfa9be1', '2020-02-24 17:46:18', '2020-02-24 17:46:18', ''),
(37, 73, 2, '542b8ead8876e83e18c52dbb3c5e31ad', '2020-02-24 17:57:21', '2020-02-24 17:57:21', ''),
(38, 74, 2, 'ae07e0d5eb51ca2b74e54565035837da', '2020-02-24 17:58:57', '2020-02-24 17:58:57', ''),
(39, 75, 2, 'a6e7f1faf46e4145424a15acc64b9c9f', '2020-02-24 18:06:49', '2020-02-24 18:06:49', ''),
(42, 78, 1, 'e3ea82408039c6450ae73725d8e0892c', '2020-02-24 18:34:39', '2020-02-24 18:34:39', ''),
(44, 80, 2, '4a9f6a8d9dea7703c9094ad246f69cb3', '2020-02-24 19:18:16', '2020-02-24 19:18:16', ''),
(46, 82, 2, '1e8537388feaff7060d4f815d4abb433', '2020-02-24 19:23:19', '2020-02-24 19:23:19', ''),
(49, 84, 2, 'b68e05585769f7205225b96e7b0a4d8b', '2020-02-24 19:38:27', '2020-02-24 19:38:27', ''),
(50, 85, 2, '8d97eba6f3163331043d3754e559bdf2', '2020-02-24 19:44:52', '2020-02-24 19:44:52', ''),
(51, 86, 2, '93798fe98d8088d088d5c6a917f4f11a', '2020-02-25 11:06:13', '2020-02-25 11:06:13', ''),
(52, 87, 2, 'cf352012ae8def58394ccf00715e325c', '2020-02-25 12:18:11', '2020-02-25 12:18:11', ''),
(53, 89, 2, '8a5b4f3c59813326b9d971070dfd3f01', '2020-02-28 14:49:42', '2020-02-28 14:49:42', ''),
(54, 90, 2, '7bb23a6956a37f64d8a964f4d5210529', '2020-02-28 14:52:44', '2020-02-28 14:52:44', ''),
(55, 91, 2, '2250f3c913d2e4829e972b770f21006e', '2020-02-28 15:37:13', '2020-02-28 15:37:13', ''),
(56, 92, 2, '9781fa2b1a5218f5c9f68fef38d299c2', '2020-02-28 15:39:51', '2020-02-28 15:39:51', ''),
(57, 93, 2, '6e034aef0c39569574675e94ec86779f', '2020-02-28 17:37:19', '2020-02-28 17:37:19', ''),
(58, 94, 2, 'a0c3b688f305da26d5924961560bbc4d', '2020-02-28 19:02:09', '2020-02-28 19:02:09', ''),
(59, 95, 2, 'b0cf035e2a91bde561511dd20c1ebb21', '2020-03-02 15:33:20', '2020-03-02 15:33:20', ''),
(60, 96, 2, '04a7ce2d868985949ca079d8f7514315', '2020-03-02 16:27:06', '2020-03-02 16:27:06', ''),
(61, 97, 2, 'e2a1a15b0063d047e6bff3740684af48', '2020-03-02 18:43:22', '2020-03-02 18:43:22', ''),
(62, 98, 2, 'cd2d271e11405208c71f7f07a8512ba3', '2020-03-02 19:36:56', '2020-03-02 19:36:56', ''),
(63, 99, 2, '1067f5fef1cda2e0c413b19c828221c3', '2020-03-03 12:21:07', '2020-03-03 12:21:07', ''),
(64, 100, 2, '43b473e0b1fa38614e6a25db86ea673d', '2020-03-03 15:58:45', '2020-03-03 15:58:45', ''),
(65, 101, 2, 'ef18c0f99a9e5002d6c8e675b42215ce', '2020-03-03 16:10:28', '2020-03-03 16:10:28', ''),
(66, 102, 2, '9d17656cd7a4a06bd09678baf0c749e9', '2020-03-03 16:31:17', '2020-03-03 16:31:17', ''),
(67, 9, 2, '50b4d62fd0b5db2cc7d17055674dc381', '2020-03-03 16:35:36', '2020-03-03 16:35:36', ''),
(68, 103, 2, '5f1705d29ed28b8b62fa1bc928555b52', '2020-03-03 17:25:51', '2020-03-03 17:25:51', ''),
(69, 104, 2, 'd42394ad38d3dc04e4b24e86e41e01db', '2020-03-03 18:30:20', '2020-03-03 18:30:20', ''),
(70, 105, 2, 'fff9f6983eba42f326b6d1bdc05e1ee5', '2020-03-03 18:35:24', '2020-03-03 18:35:24', ''),
(71, 106, 1, '74854fda69b038a05a50013701496e7c', '2020-03-04 16:07:46', '2020-03-04 16:07:46', '');

-- --------------------------------------------------------

--
-- Table structure for table `cafe_images`
--

CREATE TABLE `cafe_images` (
  `cafe_img_id` int(11) NOT NULL,
  `cafe_id` int(11) NOT NULL,
  `cafe_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cafe_images`
--

INSERT INTO `cafe_images` (`cafe_img_id`, `cafe_id`, `cafe_image`) VALUES
(162, 4, 'Lords.jpg'),
(163, 30, 'Cigar_and_Malt_Lounge_1.jpg'),
(165, 4, 'Lords1.jpg'),
(166, 4, 'Lords-1.jpg'),
(167, 4, 'Lords-Chiller-Table.jpg'),
(168, 2, 'Mist_Hookah3.jpg'),
(169, 2, 'Mist_Vertical_Garden1.jpg'),
(170, 2, 'Mist.jpg'),
(171, 2, 'Mist-Outdoor-Garden.jpg'),
(172, 2, 'Mist-Statue-2.jpg'),
(173, 2, 'Mist_Dome1.jpg'),
(174, 3, 'Prego_Bed_Lounge.jpg'),
(175, 3, 'Prego_Corridor1.JPG'),
(176, 3, 'Prego.jpg'),
(177, 3, 'prego4.jpg'),
(178, 3, 'prego11.jpg'),
(179, 3, 'prego21.jpg'),
(180, 3, 'prego31.jpg'),
(181, 3, 'prego6.jpg'),
(182, 3, 'prego8.jpg'),
(183, 5, 'Velvet_Bar_21.jpg'),
(184, 5, 'Velvet_Bar1.jpg'),
(185, 5, 'velvet1.jpg'),
(186, 1, 'Glint_Bar_Top.jpg'),
(187, 1, 'Glint_Bar.JPG'),
(188, 1, 'Glint_Crystal_Screen_21.jpg'),
(189, 1, 'glint1.jpg'),
(190, 31, 'gallery615.jpg'),
(191, 31, 'gallery98.jpg'),
(192, 32, 'gallery514.jpg'),
(193, 32, 'gallery99.jpg'),
(194, 32, 'uws-bar-es.w600.h315.2x4.jpg'),
(195, 33, 'gallery78.jpg'),
(197, 34, 'gallery515.jpg'),
(199, 36, 'gallery516.jpg'),
(200, 37, 'gallery26.jpg'),
(202, 35, 'gallery412.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cms`
--

CREATE TABLE `cms` (
  `page_id` int(11) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `cms_slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `short_desc` text NOT NULL,
  `status` int(11) NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `date_of_creation` varchar(20) NOT NULL,
  `date_of_update` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cms`
--

INSERT INTO `cms` (`page_id`, `page_name`, `cms_slug`, `description`, `short_desc`, `status`, `is_delete`, `date_of_creation`, `date_of_update`) VALUES
(1, 'About Us', 'about_us', '<h2>Grandeur, Opulence, Magnificence…</h2>\r\n\r\n<p>These are the maxims that shall define your experience as you find yourself esconced in the quintessence of pleasure that is Club Fenicia. Bask in plush d&eacute;cor, leisure in lounge luxury and delight in epicurean delicacy, all with the privelege of being accompanied by pleasurable company and your favored tipple at Asia’s Largest Luxury Lounge. Add to that exclusive services, fully automated amenities and endless entertainment, and you discover the one place where time is just one of the many luxuries on offer – where you step in to satisfy your many guilty pleasures, but stay back as you discover many more; where the ambience is the ambrosia to your heart, mind and soul.</p>\r\n', 'Discover Infinite Indulgence at Club Fenicia, the Luxe Lounge', 1, '0', '2019-09-30 15:24:12', '2020-02-24 12:57:53'),
(2, 'Terms & Condition', 'terms-condition', '<p>Aenean eget ante sed tellus facilisis ultricies nec sit amet turpis. Suspendisse a tortor sit amet felis varius porta. Nulla vehicula nibh et nibh pulvinar iaculis. Maecenas tincidunt venenatis nunc a cursus. In eget egestas metus, ut vehicula tellus. Nam ultrices, nulla sed imperdiet dapibus, arcu nibh efficitur mi, sed scelerisque libero turpis ac risus. </p>\r\n', 'Terms and condition', 1, '0', '2019-10-01 07:29:23', '2020-02-24 12:58:56'),
(7, 'Privacy Policy ', 'privacy-policy', '<p>At https://www.fenicialounge.in/, accessible from https://www.fenicialounge.in/, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that are collected and recorded by https://www.fenicialounge.in/ and how we use it.</p>\r\n\r\n<p>If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.</p>\r\n\r\n<p>This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in https://www.fenicialounge.in/. This policy is not applicable to any information collected offline or via channels other than this website.</p>\r\n\r\n<p>Consent</p>\r\n\r\n<p>By using our website, you hereby consent to our Privacy Policy and agree to its terms.</p>\r\n\r\n<p>Information we collect</p>\r\n\r\n<p>The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.</p>\r\n\r\n<p>If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide.</p>\r\n\r\n<p>When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number.</p>\r\n\r\n<p>How we use your information</p>\r\n\r\n<p>We use the information we collect in various ways, including to:</p>\r\n\r\n<ul>\r\n	<li>Provide, operate, and maintain our website</li>\r\n	<li>Improve, personalize, and expand our website</li>\r\n	<li>Understand and analyze how you use our website</li>\r\n	<li>Develop new products, services, features, and functionality</li>\r\n	<li>Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the website, and for marketing and promotional purposes</li>\r\n	<li>Send you emails</li>\r\n	<li>Find and prevent fraud</li>\r\n</ul>\r\n\r\n<p>Log Files</p>\r\n\r\n<p>https://www.fenicialounge.in/ follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services&#39; analytics. The information collected by log files includes internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users&#39; movement on the website, and gathering demographic information. Our Privacy Policy was created with the help of the <a href=\"https://www.privacypolicygenerator.info/\">Privacy Policy Generator</a> and the <a href=\"https://www.privacypolicytemplate.net/\">Privacy Policy Template</a>.</p>\r\n\r\n<p>Advertising Partners Privacy Policies</p>\r\n\r\n<p>You may consult this list to find the Privacy Policy for each of the advertising partners of https://www.fenicialounge.in/.</p>\r\n\r\n<p>Third-party ad servers or ad networks use technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on https://www.fenicialounge.in/, which are sent directly to users&#39; browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on websites that you visit.</p>\r\n\r\n<p>Note that https://www.fenicialounge.in/ has no access to or control over these cookies that are used by third-party advertisers.</p>\r\n\r\n<p>Third-Party Privacy Policies</p>\r\n\r\n<p>https://www.fenicialounge.in/&#39;s Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options. You may find a complete list of these Privacy Policies and their links here: Privacy Policy Links.</p>\r\n\r\n<p>You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers&#39; respective websites. What Are Cookies?</p>\r\n\r\n<p>CCPA Privacy Rights (Do Not Sell My Personal Information)</p>\r\n\r\n<p>Under the CCPA, among other rights, California consumers have the right to:</p>\r\n\r\n<p>Request that a business that collects a consumer&#39;s personal data disclose the categories and specific pieces of personal data that a business has collected about consumers.</p>\r\n\r\n<p>Request that a business deletes any personal data about the consumer that a business has collected.</p>\r\n\r\n<p>Request that a business that sells a consumer&#39;s personal data, not sell the consumer&#39;s personal data.</p>\r\n\r\n<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>\r\n\r\n<p>GDPR Data Protection Rights</p>\r\n\r\n<p>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:</p>\r\n\r\n<p>The right to access – You have the right to request copies of your personal data. We may charge you a small fee for this service.</p>\r\n\r\n<p>The right to rectification – You have the right to request that we correct any information you believe is inaccurate. You also have the right to request that we complete the information you believe is incomplete.</p>\r\n\r\n<p>The right to erasure – You have the right to request that we erase your personal data, under certain conditions.</p>\r\n\r\n<p>The right to restrict processing – You have the right to request that we restrict the processing of your personal data, under certain conditions.</p>\r\n\r\n<p>The right to object to processing – You have the right to object to our processing of your personal data, under certain conditions.</p>\r\n\r\n<p>The right to data portability – You have the right to request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions.</p>\r\n\r\n<p>If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>\r\n\r\n<p>Children&#39;s Information</p>\r\n\r\n<p>Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and/or monitor and guide their online activity.</p>\r\n\r\n<p>https://www.fenicialounge.in/ does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.</p>\r\n', 'Privacy Policy for Club Fenicia', 1, '0', '2019-12-16 17:58:56', '2020-02-21 13:15:31'),
(11, 'Test001-Edit', 'test001', '<p>test</p>\r\n', 't00', 1, '0', '2020-02-21 13:15:41', '2020-02-21 13:16:01'),
(12, 'pg002-eee12q3434', 'pg002', '<p>sdfsdfdddee</p>\r\n', 'sdfsdf', 0, '0', '2020-02-24 12:18:08', '2020-03-05 12:06:32'),
(13, 'TEST Page-e', 'test-page', '<p>TEST Page</p>\r\n', 'TEST Page', 0, '0', '2020-03-04 19:34:44', '2020-03-04 19:35:18'),
(14, 'testpageddd', 'testpageddd', '<p><em>testpageddd</em></p>\r\n', 'testpageddd', 0, '0', '2020-03-05 12:06:55', ''),
(15, 'EH094', 'eh094', '<p>EH094</p>\r\n', 'EH094', 1, '0', '2020-03-06 12:42:54', '2020-03-10 15:55:58');

-- --------------------------------------------------------

--
-- Table structure for table `device_token`
--

CREATE TABLE `device_token` (
  `token_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `device_type` int(11) NOT NULL COMMENT '1=>ios,2=>android',
  `device_token` varchar(255) NOT NULL,
  `fcm_token` varchar(200) NOT NULL,
  `login_status` int(11) NOT NULL,
  `date_of_creation` datetime NOT NULL,
  `session_start_time` varchar(255) NOT NULL,
  `session_end_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `device_token`
--

INSERT INTO `device_token` (`token_id`, `member_id`, `device_type`, `device_token`, `fcm_token`, `login_status`, `date_of_creation`, `session_start_time`, `session_end_time`) VALUES
(1, 1, 2, '', '123', 1, '2020-02-10 15:35:40', '2020-02-10 15:35:40', ''),
(2, 2, 2, '', 'fU5tibSYL_A:APA91bFHsxgHkkDBaeaDX0h2IAX4ERiu4ombrepb5sOv0pyZdN9MKWGb2oPqaXf98iJsBpe0GSNLoDj5FBDNenIlbyPQw7DCKKeSWVqQQbAHHtYG2z73qM0jbUktp4nLRjLIVuRbyula', 1, '2020-02-10 16:29:05', '2020-02-10 16:29:05', ''),
(3, 3, 2, '', '123456', 1, '2020-02-10 17:57:28', '2020-02-10 17:57:28', ''),
(4, 8, 2, '', '', 1, '2020-02-11 12:30:57', '2020-02-11 12:30:57', ''),
(5, 10, 2, '', 'eP7qo7fhoo0:APA91bEXjh3FVFU1Vj5TYrm7yTahicc8ayzF66GGvTqx6Y0_-FHdlyTbO2bYyiIEKNGlbc28la4oX2LaOEz8HHxhfaPpVuYpEm3v1p-3Numd98lm4ZYXdQXnhyDyR3hVOIgx1UJkhSdL', 1, '2020-02-11 12:42:06', '2020-02-11 12:42:06', ''),
(6, 12, 2, '', '', 1, '2020-02-11 12:49:26', '2020-02-11 12:49:26', ''),
(7, 15, 2, '', 'dWJJFMflkXg:APA91bFcu_M_gSpOF73bH0asM5X-xvQesNxJIXSL9Co2Dye5MR3hGTHf-As3bY2ZFHXZIwLwOcPoGCaP_5ss6zIW8iF_PjeqS6-B1DWUgzqEzW0QAaQ3ICX-ZEdgybwmfpKgMKA13-Xz', 1, '2020-02-11 14:47:10', '2020-02-11 14:47:10', ''),
(8, 18, 2, '', 'cAWp2XfbXss:APA91bE5N3NOqCrQpQYpzIuu59VEe4YxJySHh17v8zfnIemE9sF5vJgkju-5rgT7N5Tv0ff61i6Xl39yN-ZTnOIDhQp2DbT1WgZUQGKL82Vt8jRGnxHlTM_QyItA5rOM6IXa5Oty2lcJ', 1, '2020-02-11 17:41:45', '2020-02-11 17:41:45', ''),
(9, 21, 2, '', 'fcSmwA8uYwo:APA91bG_-TOierH-1sSOxK0Hrct8VEE54Vo1h8fo-ozByNYCNJmomiXoVm0GkwtJrBy_lKxz9EgB5q6D2eBWxC5I8r9zbXeGZP-iU7Ked5GmHE7rakKOlHKh7GjePRt9d-UUl18s5fn1', 1, '2020-02-11 18:17:46', '2020-02-11 18:17:46', ''),
(10, 23, 2, '', 'cBNcKZEc9GM:APA91bEoiHmLX-cZkW8Xu8Pp98gPFPN6YpmDxANcPZg6vr-fS1NX4UL0KY1Do_D2FM03ZcO24Rsfe88LkP56f5h5HkF_z5hgsiejQkBUTceSYR-oPPA0t7-8D1K5g0TUMonpsDDAgcny', 1, '2020-02-11 18:37:15', '2020-02-11 18:37:15', ''),
(11, 25, 2, '', 'dd0uvW1Sdvk:APA91bEf8VaMpPNPil01IQvsyzWOs8O0b6mOalnBG3AUzcq1wVxIpoKoXaP1HH44VGzT6UX6-fbguIbOuuXDj76xtI4XKKvKIGuefENdG9VkbBqhxZqQzVutyL46Pw6WA5FM2H0489g2', 1, '2020-02-11 18:58:45', '2020-02-11 18:58:45', ''),
(12, 26, 2, '', 'dd0uvW1Sdvk:APA91bEf8VaMpPNPil01IQvsyzWOs8O0b6mOalnBG3AUzcq1wVxIpoKoXaP1HH44VGzT6UX6-fbguIbOuuXDj76xtI4XKKvKIGuefENdG9VkbBqhxZqQzVutyL46Pw6WA5FM2H0489g2', 1, '2020-02-11 19:00:45', '2020-02-11 19:00:45', ''),
(13, 27, 2, '', 'dd0uvW1Sdvk:APA91bEf8VaMpPNPil01IQvsyzWOs8O0b6mOalnBG3AUzcq1wVxIpoKoXaP1HH44VGzT6UX6-fbguIbOuuXDj76xtI4XKKvKIGuefENdG9VkbBqhxZqQzVutyL46Pw6WA5FM2H0489g2', 1, '2020-02-11 19:11:57', '2020-02-11 19:11:57', ''),
(14, 29, 2, '', 'cBNcKZEc9GM:APA91bEoiHmLX-cZkW8Xu8Pp98gPFPN6YpmDxANcPZg6vr-fS1NX4UL0KY1Do_D2FM03ZcO24Rsfe88LkP56f5h5HkF_z5hgsiejQkBUTceSYR-oPPA0t7-8D1K5g0TUMonpsDDAgcny', 1, '2020-02-11 19:20:25', '2020-02-11 19:20:25', ''),
(15, 30, 2, '', 'cBNcKZEc9GM:APA91bEoiHmLX-cZkW8Xu8Pp98gPFPN6YpmDxANcPZg6vr-fS1NX4UL0KY1Do_D2FM03ZcO24Rsfe88LkP56f5h5HkF_z5hgsiejQkBUTceSYR-oPPA0t7-8D1K5g0TUMonpsDDAgcny', 1, '2020-02-11 19:25:59', '2020-02-11 19:25:59', ''),
(16, 35, 2, '', 'cBNcKZEc9GM:APA91bEoiHmLX-cZkW8Xu8Pp98gPFPN6YpmDxANcPZg6vr-fS1NX4UL0KY1Do_D2FM03ZcO24Rsfe88LkP56f5h5HkF_z5hgsiejQkBUTceSYR-oPPA0t7-8D1K5g0TUMonpsDDAgcny', 1, '2020-02-11 19:38:50', '2020-02-11 19:38:50', ''),
(17, 34, 2, '', 'cBNcKZEc9GM:APA91bEoiHmLX-cZkW8Xu8Pp98gPFPN6YpmDxANcPZg6vr-fS1NX4UL0KY1Do_D2FM03ZcO24Rsfe88LkP56f5h5HkF_z5hgsiejQkBUTceSYR-oPPA0t7-8D1K5g0TUMonpsDDAgcny', 1, '2020-02-11 19:49:21', '2020-02-11 19:49:21', ''),
(18, 36, 2, '', 'dY35PUdyPBY:APA91bESdx0BEX2oMCHzLg7fulD6CGTzr-M922Jc8EygNbMWL6hl31omm_QkK5ZmTelAAAbUVWjJyJJfnq1FFA5iuxWBWlX1Jgx7-j41ja9jEMhUC5ciY5fa-1Fff3gBYYTIhs9bcG-4', 1, '2020-02-11 20:03:36', '2020-02-11 20:03:36', ''),
(19, 37, 2, '', 'dY35PUdyPBY:APA91bESdx0BEX2oMCHzLg7fulD6CGTzr-M922Jc8EygNbMWL6hl31omm_QkK5ZmTelAAAbUVWjJyJJfnq1FFA5iuxWBWlX1Jgx7-j41ja9jEMhUC5ciY5fa-1Fff3gBYYTIhs9bcG-4', 1, '2020-02-11 20:12:05', '2020-02-11 20:12:05', ''),
(20, 38, 2, '', 'dY35PUdyPBY:APA91bESdx0BEX2oMCHzLg7fulD6CGTzr-M922Jc8EygNbMWL6hl31omm_QkK5ZmTelAAAbUVWjJyJJfnq1FFA5iuxWBWlX1Jgx7-j41ja9jEMhUC5ciY5fa-1Fff3gBYYTIhs9bcG-4', 1, '2020-02-11 20:16:05', '2020-02-11 20:16:05', ''),
(21, 22, 2, '', 'eP7qo7fhoo0:APA91bEXjh3FVFU1Vj5TYrm7yTahicc8ayzF66GGvTqx6Y0_-FHdlyTbO2bYyiIEKNGlbc28la4oX2LaOEz8HHxhfaPpVuYpEm3v1p-3Numd98lm4ZYXdQXnhyDyR3hVOIgx1UJkhSdL', 1, '2020-02-11 20:36:32', '2020-02-11 20:36:32', ''),
(22, 39, 2, '', 'fcSmwA8uYwo:APA91bG_-TOierH-1sSOxK0Hrct8VEE54Vo1h8fo-ozByNYCNJmomiXoVm0GkwtJrBy_lKxz9EgB5q6D2eBWxC5I8r9zbXeGZP-iU7Ked5GmHE7rakKOlHKh7GjePRt9d-UUl18s5fn1', 1, '2020-02-12 10:54:44', '2020-02-12 10:54:44', ''),
(23, 32, 2, '', '', 1, '2020-02-12 11:52:56', '2020-02-12 11:52:56', ''),
(24, 42, 2, '', 'fcqQCLq_UaQ:APA91bF_zDotE8lKPVCUQmwfgs6PGhn68GoyO-E-JolW80hRVr377tVG8L_4M1NKeGKaDXavYMA2LMAbtUyJNDA_O1MOXZUsg3319OHWWARUUxDUqzP7IVZgaGUgSR2X1oLZVjrLHBpd', 1, '2020-02-12 11:56:17', '2020-02-12 11:56:17', ''),
(25, 41, 2, '', '', 1, '2020-02-12 12:08:26', '2020-02-12 12:08:26', ''),
(26, 44, 2, '', 'dfZNivfhc6k:APA91bGmoiW8GhTMDEf6L3BmN15i2TxC55Y0ZkbFaY5mJ8I0TksMIHzRybr8nKr_1Kb4_1e2iJGYRo9IhKoRFLh_1wCSDBopvPBOfDZ9RrDPUUtaeDk-hDDhkUELlK2nWK2pJ21AF0bI', 1, '2020-02-12 12:55:02', '2020-02-12 12:55:02', ''),
(27, 45, 2, '', 'cA_M0Si1wPc:APA91bFf3W9Ogp3yhD42zARHG2ieJFgD7Wazv6dP6PgsrpaEDY-VPtiB_cr8WfuInkH06_Ro9Zxkb-7daR-okcTnT_IV6hp0n8C_BVwLv8CS6g5V9YLmU1Y5woJPO2OuBl5T6dfHXjui', 1, '2020-02-12 13:05:03', '2020-02-12 13:05:03', ''),
(28, 47, 2, '', 'cA_M0Si1wPc:APA91bFf3W9Ogp3yhD42zARHG2ieJFgD7Wazv6dP6PgsrpaEDY-VPtiB_cr8WfuInkH06_Ro9Zxkb-7daR-okcTnT_IV6hp0n8C_BVwLv8CS6g5V9YLmU1Y5woJPO2OuBl5T6dfHXjui', 1, '2020-02-12 13:23:27', '2020-02-12 13:23:27', ''),
(29, 48, 2, '', 'fYwxSc57WTE:APA91bEh2YVZ2SpmNkq03AFc5hlOL1QkAQkMRO1yYZtBTWGVACSvF3xapXDs905nwhLke3IlQ8qP-B0EMhGKNnlfR6_6U4VzZvcsgklGUNb8BIqYimJpQZFOPukXZY901drxv3rFB76v', 1, '2020-02-12 13:30:19', '2020-02-12 13:30:19', ''),
(30, 55, 2, '', 'dyHopBmCBYQ:APA91bGVnuRCpLh90SXGCQSxwV_BIiSVddGmF32BadJMAfFJk2AYZLPYFDrcJrcrbYYjS-4qC830hhGDqcJGkkcTc1e3kawsuJB4-swz74nys6fh5mTU3wVoZConKjziuV2wthrb67Es', 1, '2020-02-12 15:00:10', '2020-02-12 15:00:10', ''),
(31, 57, 2, '', 'ebD6hMDgM0Q:APA91bH98bU6Fs0n2YWmqlaPekauCOprfgCp_kstKbYvuKlRliCoT-mMkPflp2X0ZsYi4kMbxVr_vcJwvUEFLxten6ugP5LG8jOL18zJUNFETK1rk_U1LI83ukqGo_VvyaxYjvp_viWZ', 1, '2020-02-14 19:08:15', '2020-02-14 19:08:15', ''),
(32, 58, 2, '', 'clDoOdteTe0:APA91bFwZZeUHb5MLR09LF7deV80bygIqHsbTXNB3eI6CHU6wwo97WOPsamy1AEUtK2EndVA37py8TT8QK-81Yoke1aK7ThCbZifhQ_ZfWf8xizv2OJO6WLcHTOaF__tPIan5qz7V4Bm', 1, '2020-02-14 19:23:32', '2020-02-14 19:23:32', ''),
(34, 69, 2, '', 'fjzXZPwXK28:APA91bEaQKKxhhPaM2sP_8w8eTjKTQW-LoFRrHrNeFB8e-qCkteBWQy_12k2wWZVrWJ7dfunXNEdgoXZC-8JZgEMpmqbPlFHDGSzWBc_rT_IdnEsIVdEBiIR4vGVeFjzxEC7J47h6g99', 1, '2020-02-24 17:22:53', '2020-02-24 17:22:53', ''),
(35, 71, 2, '', 'eb9mznI4MtY:APA91bHbAe5RgJmB9yTAuFkoeuq9Wkra3ATarqej8iyOlpLwtKV3itwvC9pXKJfH08ziYpe4nb3tLMn3jE6YT5sWlHhXFlDK_EYQm348Y5eCrb-MJPr40kp5RZo8BP0EkgeH5cEHRt-c', 1, '2020-02-24 17:46:18', '2020-02-24 17:46:18', ''),
(37, 73, 2, '', 'eb9mznI4MtY:APA91bHbAe5RgJmB9yTAuFkoeuq9Wkra3ATarqej8iyOlpLwtKV3itwvC9pXKJfH08ziYpe4nb3tLMn3jE6YT5sWlHhXFlDK_EYQm348Y5eCrb-MJPr40kp5RZo8BP0EkgeH5cEHRt-c', 1, '2020-02-24 17:57:21', '2020-02-24 17:57:21', ''),
(38, 74, 2, '', 'eb9mznI4MtY:APA91bHbAe5RgJmB9yTAuFkoeuq9Wkra3ATarqej8iyOlpLwtKV3itwvC9pXKJfH08ziYpe4nb3tLMn3jE6YT5sWlHhXFlDK_EYQm348Y5eCrb-MJPr40kp5RZo8BP0EkgeH5cEHRt-c', 1, '2020-02-24 17:58:57', '2020-02-24 17:58:57', ''),
(39, 75, 2, '', 'eb9mznI4MtY:APA91bHbAe5RgJmB9yTAuFkoeuq9Wkra3ATarqej8iyOlpLwtKV3itwvC9pXKJfH08ziYpe4nb3tLMn3jE6YT5sWlHhXFlDK_EYQm348Y5eCrb-MJPr40kp5RZo8BP0EkgeH5cEHRt-c', 1, '2020-02-24 18:06:49', '2020-02-24 18:06:49', ''),
(42, 78, 1, '', '123', 1, '2020-02-24 18:34:39', '2020-02-24 18:34:39', ''),
(44, 80, 2, '', 'eb9mznI4MtY:APA91bHbAe5RgJmB9yTAuFkoeuq9Wkra3ATarqej8iyOlpLwtKV3itwvC9pXKJfH08ziYpe4nb3tLMn3jE6YT5sWlHhXFlDK_EYQm348Y5eCrb-MJPr40kp5RZo8BP0EkgeH5cEHRt-c', 1, '2020-02-24 19:18:16', '2020-02-24 19:18:16', ''),
(46, 82, 2, '', 'eb9mznI4MtY:APA91bHbAe5RgJmB9yTAuFkoeuq9Wkra3ATarqej8iyOlpLwtKV3itwvC9pXKJfH08ziYpe4nb3tLMn3jE6YT5sWlHhXFlDK_EYQm348Y5eCrb-MJPr40kp5RZo8BP0EkgeH5cEHRt-c', 1, '2020-02-24 19:23:19', '2020-02-24 19:23:19', ''),
(49, 84, 2, '', 'djh2NGLM6vE:APA91bEc_wR9qek3Va7qjI9L_-3c_hFnJ_bGOpiNYA8CxLs45jRI2B2OrEOgMFrQHalls7rqyXY3Zof5cKsHtG7oXZelrNP8fKwrHyIoCJ93SY2uilJG2NtFPtdgMZRFF2YwqZp7ydHo', 1, '2020-02-24 19:38:27', '2020-02-24 19:38:27', ''),
(50, 85, 2, '', 'djrjnggRtrU:APA91bHJeG5LkAA4q5fe8WtpwtOseFqYgJCqxPJCJC9Oef2sImbBiHHKmE4V1st6puL000bqPAWqisuNrWGz6J6EPdBN4TA67TOaDWBWop8o9PJrxLc5qBWQXVPiSyAmARNqCPwzI3ZA', 1, '2020-02-24 19:44:52', '2020-02-24 19:44:52', ''),
(51, 86, 2, '', 'djrjnggRtrU:APA91bHJeG5LkAA4q5fe8WtpwtOseFqYgJCqxPJCJC9Oef2sImbBiHHKmE4V1st6puL000bqPAWqisuNrWGz6J6EPdBN4TA67TOaDWBWop8o9PJrxLc5qBWQXVPiSyAmARNqCPwzI3ZA', 1, '2020-02-25 11:06:13', '2020-02-25 11:06:13', ''),
(52, 87, 2, '', 'ele4EXPQUNM:APA91bH70xVDIcWfUV1djelPWZootbSNX6H7Q7zxVBRF-Y2zvycXpPnte3VpUb9sbJG-zOi0G60ubBlMNFy9Th8id3FLkvFypiU_AJUhWU9sp2gLAI0m9OKahzyuMY-jy9m2X4LJZ9xj', 1, '2020-02-25 12:18:11', '2020-02-25 12:18:11', ''),
(53, 89, 2, '', 'ddIBjkCnhXE:APA91bGd_PhgE0L3QmpE_kOM8Us32GWzkozu0v1hsVibzDgWHokME9CxGJ2SpcprE3GHq5ofHnz7ZBtG-4hxZI3L6cjmVmQCUy4DpqPnIsDntqJg2k65qjVIHbR4lczPhqMUEhswIJLa', 1, '2020-02-28 14:49:42', '2020-02-28 14:49:42', ''),
(54, 90, 2, '', 'ddIBjkCnhXE:APA91bGd_PhgE0L3QmpE_kOM8Us32GWzkozu0v1hsVibzDgWHokME9CxGJ2SpcprE3GHq5ofHnz7ZBtG-4hxZI3L6cjmVmQCUy4DpqPnIsDntqJg2k65qjVIHbR4lczPhqMUEhswIJLa', 1, '2020-02-28 14:52:44', '2020-02-28 14:52:44', ''),
(55, 91, 2, '', 'ddIBjkCnhXE:APA91bGd_PhgE0L3QmpE_kOM8Us32GWzkozu0v1hsVibzDgWHokME9CxGJ2SpcprE3GHq5ofHnz7ZBtG-4hxZI3L6cjmVmQCUy4DpqPnIsDntqJg2k65qjVIHbR4lczPhqMUEhswIJLa', 1, '2020-02-28 15:37:13', '2020-02-28 15:37:13', ''),
(56, 92, 2, '', 'ddIBjkCnhXE:APA91bGd_PhgE0L3QmpE_kOM8Us32GWzkozu0v1hsVibzDgWHokME9CxGJ2SpcprE3GHq5ofHnz7ZBtG-4hxZI3L6cjmVmQCUy4DpqPnIsDntqJg2k65qjVIHbR4lczPhqMUEhswIJLa', 1, '2020-02-28 15:39:51', '2020-02-28 15:39:51', ''),
(57, 93, 2, '', 'fIrQ7rYVhuk:APA91bGNdi9iROTcTVHrtFmDBEPfrFZaJk6K2LM5IzFPyaSrgW9X7BqCxTndh0zBcLGk539_q4eifBTsq1clikypvmb5wvc8rwOB7HRU6LE5LCalXMPZdKmI5WPpOXpf6GIuEOjitfZB', 1, '2020-02-28 17:37:19', '2020-02-28 17:37:19', ''),
(58, 94, 2, '', 'ddIBjkCnhXE:APA91bGd_PhgE0L3QmpE_kOM8Us32GWzkozu0v1hsVibzDgWHokME9CxGJ2SpcprE3GHq5ofHnz7ZBtG-4hxZI3L6cjmVmQCUy4DpqPnIsDntqJg2k65qjVIHbR4lczPhqMUEhswIJLa', 1, '2020-02-28 19:02:09', '2020-02-28 19:02:09', ''),
(59, 95, 2, '', 'cAxd_Dw5rA0:APA91bEEHkRf-y_Y-SXEG3zkY4U4MVcV-ViTWabnbwDT7u79-oaFdzqRMXDmDLBO7hndhs01c7Q74PKY972KukESK5R8NhRX_dnzLVu-VPGknKsoSQ-XvXReMdtGjUurPNTsj44t2300', 1, '2020-03-02 15:33:20', '2020-03-02 15:33:20', ''),
(60, 96, 2, '', 'cB4CY9j4qOo:APA91bEowydyPuVybm715Di-VIFWtG5LivNPMJ6GWxnQrUq_TgRufkaa7uNV6-5xSj-YpYvvi582ZT7HvAfZBpAtKhHuPfQ95OLJ13ZL1tL8h40i0N84PrJQ27EqxGdmOwIJvah-XFVa', 1, '2020-03-02 16:27:06', '2020-03-02 16:27:06', ''),
(61, 97, 2, '', 'cB4CY9j4qOo:APA91bEowydyPuVybm715Di-VIFWtG5LivNPMJ6GWxnQrUq_TgRufkaa7uNV6-5xSj-YpYvvi582ZT7HvAfZBpAtKhHuPfQ95OLJ13ZL1tL8h40i0N84PrJQ27EqxGdmOwIJvah-XFVa', 1, '2020-03-02 18:43:22', '2020-03-02 18:43:22', ''),
(62, 98, 2, '', 'dpz0Ppoj0uE:APA91bHNLOZLXPWl5_YQnsgbuLMEhh2LJ8vqidprPAjydHSeiyFtDU8L3bGiGNag6Bu7J2IIbBMOttOxn8D65nAcODcfj68aBqEa8JvYCnxXP3iTOZuYNDvel8lft4EYlDKpKwZxdeBV', 1, '2020-03-02 19:36:56', '2020-03-02 19:36:56', ''),
(63, 99, 2, '', 'czt5NcmYC7g:APA91bElBSda0NeqDQsexwRg1dug5wwp0QMfkpDm9MDZG2LK7c-9zjl84NvHk4bct4r_lyIcxrdxmf7r3wnn0EBUJnu_mSh8bNXIuwT4VINRnbUoljYIdQmw5gsbNdglYaWso_aT3xea', 1, '2020-03-03 12:21:07', '2020-03-03 12:21:07', ''),
(64, 100, 2, '', '', 1, '2020-03-03 15:58:45', '2020-03-03 15:58:45', ''),
(65, 101, 2, '', 'fU5tibSYL_A:APA91bFHsxgHkkDBaeaDX0h2IAX4ERiu4ombrepb5sOv0pyZdN9MKWGb2oPqaXf98iJsBpe0GSNLoDj5FBDNenIlbyPQw7DCKKeSWVqQQbAHHtYG2z73qM0jbUktp4nLRjLIVuRbyula', 1, '2020-03-03 16:10:28', '2020-03-03 16:10:28', ''),
(66, 102, 2, '', 'eyIvfw16Q5E:APA91bEPkRK4nMfzmCKSP1NYFL9N2WWc2DSCk0X1H9vbQH6m-zuFm1keWmlZKP2MaBEXf7U3c86AQ3ZY2HL1RfQjcCJbDQQIS5TnqHyJShLfz5WUJBmiB7p5VR-FIfFjpQy69fOg3MKG', 1, '2020-03-03 16:31:17', '2020-03-03 16:31:17', ''),
(67, 9, 2, '', 'dEaVO4d4Dgg:APA91bFM_HuikUo3JpH5LVF6nb4MynNoZftuSJQHOBhR_Hu3fbejVRSjnvx--5QTz6IhM2urK9NP_aqiEqOo-TvavNHbV5jcOCMxMkk_ZkOzxmhCUjjbFxMBglbwUvCSJYZcxUAlEqyq', 1, '2020-03-03 16:35:36', '2020-03-03 16:35:36', ''),
(68, 103, 2, '', 'fjzXZPwXK28:APA91bEaQKKxhhPaM2sP_8w8eTjKTQW-LoFRrHrNeFB8e-qCkteBWQy_12k2wWZVrWJ7dfunXNEdgoXZC-8JZgEMpmqbPlFHDGSzWBc_rT_IdnEsIVdEBiIR4vGVeFjzxEC7J47h6g99', 1, '2020-03-03 17:25:51', '2020-03-03 17:25:51', ''),
(69, 104, 2, '', 'fjzXZPwXK28:APA91bEaQKKxhhPaM2sP_8w8eTjKTQW-LoFRrHrNeFB8e-qCkteBWQy_12k2wWZVrWJ7dfunXNEdgoXZC-8JZgEMpmqbPlFHDGSzWBc_rT_IdnEsIVdEBiIR4vGVeFjzxEC7J47h6g99', 1, '2020-03-03 18:30:20', '2020-03-03 18:30:20', ''),
(70, 105, 2, '', 'fjzXZPwXK28:APA91bEaQKKxhhPaM2sP_8w8eTjKTQW-LoFRrHrNeFB8e-qCkteBWQy_12k2wWZVrWJ7dfunXNEdgoXZC-8JZgEMpmqbPlFHDGSzWBc_rT_IdnEsIVdEBiIR4vGVeFjzxEC7J47h6g99', 1, '2020-03-03 18:35:24', '2020-03-03 18:35:24', ''),
(71, 106, 1, '', '123', 1, '2020-03-04 16:07:46', '2020-03-04 16:07:46', '');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(10) NOT NULL,
  `cafe_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category_id` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `is_addon` int(10) NOT NULL,
  `addon_price` float(10,2) NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `food_category`
--

CREATE TABLE `food_category` (
  `category_id` int(10) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `status` int(10) NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `log_id` int(11) NOT NULL,
  `id` int(11) NOT NULL COMMENT 'action id',
  `action` varchar(50) NOT NULL,
  `statement` varchar(255) NOT NULL,
  `action_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `action_by` int(11) NOT NULL,
  `IP` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`log_id`, `id`, `action`, `statement`, `action_on`, `action_by`, `IP`, `status`) VALUES
(1, 15, 'Edit', 'Edited details of the CMS page named - \'EH094\'', '2020-03-10 10:25:48', 1, '::1', 1),
(2, 15, 'Edit', 'Edited details of the CMS page named - \'EH094\'', '2020-03-10 10:25:58', 1, '::1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_cafe`
--

CREATE TABLE `master_cafe` (
  `cafe_id` int(11) NOT NULL,
  `cafe_name` varchar(255) NOT NULL,
  `cafe_description` longtext NOT NULL,
  `cafe_location` varchar(255) NOT NULL,
  `cafe_lat` varchar(100) DEFAULT NULL,
  `cafe_lng` varchar(100) DEFAULT NULL,
  `avg_rating` float(10,2) NOT NULL,
  `review_count` int(10) NOT NULL,
  `price` float(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` int(11) NOT NULL,
  `update_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_cafe`
--

INSERT INTO `master_cafe` (`cafe_id`, `cafe_name`, `cafe_description`, `cafe_location`, `cafe_lat`, `cafe_lng`, `avg_rating`, `review_count`, `price`, `status`, `is_delete`, `created_by`, `created_on`, `updated_by`, `update_on`) VALUES
(1, 'Romance on the roof', '<p>Romance on the roof with a cocktail and kisses. Live saxophonist and candlelight dinner.</p>', '10th floor, Tower 1, Godrej Waterside, DP Block, Sec-V, Saltlake, Kolkata - 700091, West Bengal, India', NULL, NULL, 0.00, 0, 0.00, 1, 0, 4, '2020-03-05 18:30:00', 0, '2020-03-06 06:29:20'),
(2, 'A Hearty Affair', '<p>Its the day of Love!!</p>\r\n\r\n<p><br />\r\nLove for your Spouse, Love for your Family, Love for your Friends, Love for your partner and everyone around you!!</p>\r\n\r\n<p><br />\r\nWhat better way than to celebrate it in fun and romance with the best love tunes by none other than ABHISHEK ROY CHOUDHURY Project!</p>\r\n\r\n<p><br />\r\nBe there at the Largest Luxury Lounge in Asia on 14th February. Open till late! </p>\r\n\r\n<p>Book you private tables now: 7980191955 : 46002002 : 46022002</p>', '10th floor, Tower 1, Godrej Waterside, DP Block, Sec-V, Saltlake, Kolkata - 700091, West Bengal, India', NULL, NULL, 0.00, 0, 0.00, 0, 0, 1, '2020-02-11 05:00:00', 0, '2020-02-11 11:47:52'),
(3, 'testEt001-Edit', '<p>testEt001</p>', 'Kolkata', NULL, NULL, 0.00, 0, 0.00, 0, 0, 1, '2020-03-01 18:30:00', 0, '2020-02-21 05:44:56'),
(4, 'T00255', '<p>kol</p>', 'Kol', NULL, NULL, 0.00, 0, 0.00, 0, 0, 1, '2020-02-27 18:30:00', 0, '2020-02-21 05:49:16'),
(5, 'E784555-Edit', '<p>E784555</p>', 'kOLAKTA', NULL, NULL, 0.00, 0, 0.00, 0, 0, 4, '2020-02-23 18:30:00', 0, '2020-02-24 06:29:46'),
(6, 'On the Stage (acoustic sessions) with THE LOKO EXPRESS Live!', '<p> </p>\r\n\r\n<p>ON the Stage is back this week with a bang at Club Fenicia!<br />\r\n\\r\\n.</p>\r\n\r\n<p>\\r\\n\\r\\n</p>\r\n\r\n<p>Call 7980191955 for reservations!<br />\r\n\\r\\n<br />\r\n\\r\\nOpen till 2 AM every day!</p>\r\n\r\n<p> </p>', 'Godrej Waterside, 10th Floor, Tower 1, DP Block, Sector V', NULL, NULL, 0.00, 0, 0.00, 1, 0, 1, '2020-02-25 18:30:00', 0, '2020-02-26 07:26:42'),
(7, 'LeGrand Brunch!', '<p>p>The best way to end the week is dress sassy and head on over for a traditional Sunday Brunch. Famjam fun, scrumptious food, vibrant cocktails, and a stunning ambiance. Lounge away the afternoon, giggle over gossip or show off some new dance moves. Let&#39;s get brunching<br />\\r\\n<br />\\r\\nFor Reservations: +91 79801 91955</p></p>', 'Godrej Waterside, 10th Floor, Tower 1, DP Block, Sector V', NULL, NULL, 0.00, 0, 0.00, 0, 0, 1, '2020-02-25 18:30:00', 0, '2020-02-26 07:29:25'),
(8, 'LeGrand Brunch!', '<p><p>ON the Stage is back this week with a bang at Club Fenicia!<br />\\r\\n </p>\\r\\n\\r\\n<p>Call 7980191955 for reservations!<br />\\r\\n<br />\\r\\nOpen till 2 AM every day!</p></p>', 'Godrej Waterside, 10th Floor, Tower 1, DP Block, Sector V', NULL, NULL, 0.00, 0, 0.00, 1, 0, 1, '2020-02-25 18:30:00', 0, '2020-02-26 13:44:01'),
(9, 'test', '<p>test</p>', 'test location', NULL, NULL, 0.00, 0, 0.00, 0, 0, 1, '2020-03-01 18:30:00', 0, '2020-03-02 04:35:48'),
(10, 'test 234', '<p>test </p>', 'test location', NULL, NULL, 0.00, 0, 0.00, 0, 0, 1, '2020-03-01 18:30:00', 0, '2020-03-02 05:02:30'),
(11, 'test 2213', '<p>test location</p>', 'test 3423', NULL, NULL, 0.00, 0, 0.00, 0, 0, 1, '2020-03-01 18:30:00', 0, '2020-03-02 07:51:26'),
(12, 'TestE001', '<p>Test </p>', 'KOLKATA', NULL, NULL, 0.00, 0, 0.00, 0, 0, 1, '2020-03-01 18:30:00', 0, '2020-03-02 08:13:16'),
(13, 'Tst002', '<p>test    </p>', 'koll@$@#$@$#@', NULL, NULL, 0.00, 0, 0.00, 0, 0, 1, '2020-03-01 18:30:00', 0, '2020-03-02 10:08:48'),
(14, 'Test00010', '<p>testing</p>', 'kol', NULL, NULL, 0.00, 0, 0.00, 0, 0, 1, '2020-03-01 18:30:00', 0, '2020-03-02 10:35:23'),
(15, 'Teste0013434', '<p>\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\"</p>', 'dsgdfgssd', NULL, NULL, 0.00, 0, 0.00, 1, 0, 8, '2020-03-04 18:30:00', 0, '2020-03-02 10:51:17'),
(16, 'new  **', '<ul>\r\n	<li>Newtown</li>\r\n	<li>Newtown</li>\r\n	<li>Newtown</li>\r\n</ul>', 'Newtown*** ** ** ***', NULL, NULL, 0.00, 0, 0.00, 0, 0, 1, '2020-03-01 18:30:00', 0, '2020-03-02 11:00:21'),
(17, 'Teste01', '<p>testing event </p>', 'Kolkata', NULL, NULL, 0.00, 0, 0.00, 0, 0, 1, '2020-03-01 18:30:00', 0, '2020-03-02 12:36:47'),
(18, 'Teste02', '<p>Testing description </p>', 'Kolkata', NULL, NULL, 0.00, 0, 0.00, 0, 0, 1, '2020-03-01 18:30:00', 0, '2020-03-02 12:37:25'),
(19, 'LeGrand Brunch!', '<p>eyst</p>', 'test test', NULL, NULL, 0.00, 0, 0.00, 0, 0, 1, '2020-03-01 18:30:00', 0, '2020-03-02 12:41:26'),
(20, 'NewEvntt', '<p>test</p>', 'Kolkata', NULL, NULL, 0.00, 0, 0.00, 0, 0, 1, '2020-03-01 18:30:00', 0, '2020-03-02 13:16:27'),
(21, 'Tdmm000', '<p>tdmireioeroi</p>', 'Kolkata', NULL, NULL, 0.00, 0, 0.00, 0, 0, 1, '2020-03-01 18:30:00', 0, '2020-03-02 13:28:42'),
(22, 'EventH01', '<p>TEST</p>', 'KOLKATA', NULL, NULL, 0.00, 0, 0.00, 1, 0, 1, '2020-03-01 18:30:00', 0, '2020-03-02 13:33:51'),
(23, 'LeGrand Brunch!', '<p>test </p>', 'test', NULL, NULL, 0.00, 0, 0.00, 0, 0, 1, '2020-03-02 18:30:00', 0, '2020-03-03 05:58:21'),
(24, 'LeGrand Brunch!', '<p>kjkbkjbkjb</p>', 'jhvjhvjhv', NULL, NULL, 0.00, 0, 0.00, 0, 0, 1, '2020-03-02 18:30:00', 0, '2020-03-03 06:03:33'),
(25, 'test 234', '<p>gjhbjhbj</p>', 'hgvhg', NULL, NULL, 0.00, 0, 0.00, 0, 0, 1, '2020-03-02 18:30:00', 0, '2020-03-03 06:05:04'),
(26, 'LeGrand Brunch!', '<p>dsafbdsfb</p>', 'dsfbdsf', NULL, NULL, 0.00, 0, 0.00, 0, 0, 1, '2020-03-02 18:30:00', 0, '2020-03-03 06:14:19'),
(27, 'ETEST01', '<p>Test Event...</p>', 'KOLKATA', NULL, NULL, 0.00, 0, 0.00, 1, 0, 8, '2020-03-05 18:30:00', 0, '2020-03-03 06:22:38'),
(28, 'ETEST02', '<p>TestETEST02</p>', 'KOLKATA', NULL, NULL, 0.00, 0, 0.00, 1, 0, 1, '2020-03-02 18:30:00', 0, '2020-03-03 06:23:26'),
(29, 'ETEST03', '<p>Test ETEST03</p>', 'Kolkata', NULL, NULL, 0.00, 0, 0.00, 1, 0, 1, '2020-03-02 18:30:00', 0, '2020-03-03 06:24:06'),
(30, 'ETEST04', '<p>ETEST04TEST</p>', 'KOLKATA', NULL, NULL, 0.00, 0, 0.00, 1, 0, 1, '2020-03-02 18:30:00', 0, '2020-03-03 10:17:19'),
(31, 'ETEST05', '<p>ETEST05TEST</p>', 'KOL', NULL, NULL, 0.00, 0, 0.00, 1, 0, 1, '2020-03-02 18:30:00', 0, '2020-03-03 10:17:53'),
(32, 'Evet8899-Edit', '<p>Evet8899</p>', 'koltt', NULL, NULL, 0.00, 0, 0.00, 0, 0, 8, '2020-03-04 18:30:00', 0, '2020-03-04 13:41:50'),
(33, 'Ev434343', '<p>kol</p>', 'kol', NULL, NULL, 0.00, 0, 0.00, 1, 0, 4, '2020-03-04 18:30:00', 0, '2020-03-05 06:24:34'),
(34, 'Ev008', '<p>Ev008</p>', 'Ev008-4343', NULL, NULL, 0.00, 0, 0.00, 1, 0, 8, '2020-03-04 18:30:00', 0, '2020-03-05 14:13:28'),
(35, 'Ev008', '<p>Ev008</p>', 'Ev008', NULL, NULL, 0.00, 0, 0.00, 1, 0, 8, '2020-03-05 18:30:00', 0, '2020-03-06 06:53:43');

-- --------------------------------------------------------

--
-- Table structure for table `master_gallery`
--

CREATE TABLE `master_gallery` (
  `gallery_id` int(11) NOT NULL,
  `gallery_name` varchar(255) NOT NULL,
  `gallery_sub_title` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL,
  `update_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_gallery`
--

INSERT INTO `master_gallery` (`gallery_id`, `gallery_name`, `gallery_sub_title`, `status`, `is_delete`, `created_on`, `update_on`) VALUES
(1, 'Glint', 'Luxury Loungeed', 1, 0, '2020-02-28 00:00:00', '0000-00-00 00:00:00'),
(2, 'Mist', 'Rooftop Bar and Restaurant', 1, 0, '2020-02-21 00:00:00', '0000-00-00 00:00:00'),
(3, 'Prego', 'Modern Fusion Dining Experience', 1, 0, '2020-02-21 00:00:00', '0000-00-00 00:00:00'),
(4, 'Lords', '', 1, 0, '2020-02-27 00:00:00', '0000-00-00 00:00:00'),
(5, 'Velvet', 'Luxury Banquet', 1, 0, '2020-02-21 00:00:00', '0000-00-00 00:00:00'),
(31, 'Tal001-Edit', '', 0, 0, '2020-02-24 00:00:00', '0000-00-00 00:00:00'),
(32, 'AlbumHariom889-Edit', '', 0, 0, '2020-02-28 00:00:00', '0000-00-00 00:00:00'),
(33, 'Test', 'Test Album', 0, 0, '2020-02-28 00:00:00', '0000-00-00 00:00:00'),
(34, 'Test', 'SUB TITLE', 0, 0, '2020-03-03 00:00:00', '0000-00-00 00:00:00'),
(35, 'Logalbum01-Ed', 'Logalbum01d', 1, 0, '2020-03-06 00:00:00', '0000-00-00 00:00:00'),
(36, 'Testalbum33', '', 0, 0, '2020-03-05 00:00:00', '0000-00-00 00:00:00'),
(37, 'EVG01', 'EVG01', 0, 0, '2020-03-06 00:00:00', '0000-00-00 00:00:00'),
(38, 'Albumtlo11', '', 1, 0, '2020-03-06 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `master_media`
--

CREATE TABLE `master_media` (
  `media_id` int(10) NOT NULL,
  `media_name` varchar(255) NOT NULL,
  `cafe_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master_member`
--

CREATE TABLE `master_member` (
  `member_id` int(11) NOT NULL,
  `registration_type` enum('1','2','3') NOT NULL DEFAULT '1' COMMENT '1->mobile,2->email,3->fb',
  `fb_id` varchar(255) NOT NULL,
  `added_form` enum('admin','front') NOT NULL,
  `title` varchar(200) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `country_code` varchar(200) NOT NULL DEFAULT '+91',
  `mobile` varchar(55) NOT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `otp_generating_datetime` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `original_password` varchar(200) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `marriage_status` enum('married','single') DEFAULT NULL,
  `dob` date NOT NULL,
  `doa` date DEFAULT NULL COMMENT 'date_of_aniversary',
  `profile_img` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL COMMENT 'user_id of master_user',
  `created_ts` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL COMMENT 'user_id of master_user',
  `updated_ts` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('0','1') DEFAULT NULL COMMENT 'Status => 0 - inactive,1 - Active',
  `notification_allow_type` int(11) NOT NULL DEFAULT '0',
  `is_delete` enum('0','1') NOT NULL DEFAULT '0' COMMENT '0->not delete,1->deleted',
  `recovery_key` text,
  `login_status` tinyint(1) DEFAULT '0',
  `accept_terms_and_condition` enum('yes','no') NOT NULL DEFAULT 'yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `master_member`
--

INSERT INTO `master_member` (`member_id`, `registration_type`, `fb_id`, `added_form`, `title`, `first_name`, `middle_name`, `last_name`, `country_code`, `mobile`, `otp`, `otp_generating_datetime`, `email`, `password`, `original_password`, `gender`, `marriage_status`, `dob`, `doa`, `profile_img`, `created_by`, `created_ts`, `updated_by`, `updated_ts`, `status`, `notification_allow_type`, `is_delete`, `recovery_key`, `login_status`, `accept_terms_and_condition`) VALUES
(1, '2', '', '', 'Mr.', 'Anup', NULL, 'Bora', '91', '8910278956', '3214', '2020-03-03 12:28', 'anupkumar.bora@met-technologies.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', 'male', 'single', '1993-03-20', '0000-00-00', 'e8f4da8eced18958c01c5596c501c9ff.jpg', 1, '2020-03-03 11:14:48', 1, '2020-03-06 09:48:57', '1', 1, '0', NULL, 1, 'yes'),
(2, '2', '', '', 'Mr.', 'Emilly6576', NULL, 'Jems', '91', '4444444445', '1657', '2020-03-03 14:37', 'emilly@test.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', 'female', 'single', '1987-11-18', '0000-00-00', '080b4405cd392e54488d036dc3a4a1f7.jpg', 1, '2020-03-03 15:09:24', 2, '2020-03-06 10:49:34', '1', 1, '0', '', NULL, 'yes'),
(3, '2', '', 'front', 'Mr.', 'Bubai', NULL, 'Bora', '91', '8334856161', '6238', '2020-03-04 12:50', 'anupbora93@gmail.com', '719855e8f4ebd94341277b0b0d50b75c5187133f', '0', 'male', 'single', '2008-02-10', '0000-00-00', '', 4, '2020-02-21 15:48:03', NULL, '2020-03-04 07:20:06', '1', 0, '0', NULL, 1, 'yes'),
(4, '2', '', 'front', 'Mr.', 'kunal', NULL, 'gupta', '91', '9836063855', '7219', '', 'connect@kunalgupta.info', '5116e40694ac48f654cb7b6816177e0e717237c6', '0', 'male', 'married', '1985-05-14', '2020-01-01', '', 4, '2020-02-21 15:47:28', NULL, '2020-02-21 12:33:43', '1', 0, '0', NULL, 1, 'yes'),
(5, '2', '', 'front', 'Miss', 'Andressa', NULL, 'Silva', '91', '9330847609', '9638', '', 'andressamasil@gmail.com', 'b4b11f3ea124695fdf0f1aa84e80c3e21289d1d5', '0', 'female', 'single', '1983-04-11', '0000-00-00', '', 4, '2020-02-21 15:47:19', NULL, '2020-02-21 12:33:57', '1', 0, '0', NULL, 1, 'yes'),
(6, '2', '', 'front', 'Mr.', 'Om', '', 'hari', '91', '9163839088', NULL, '', 'hariom.sharan+sh03@met-technologies.com', '8cb2237d0679ca88db6464eac60da96345513964', '12345', 'male', 'married', '2019-10-01', '2019-10-01', '', 6, '2020-02-10 20:04:19', NULL, '2020-02-21 12:33:59', '1', 0, '0', NULL, 1, 'yes'),
(7, '2', '', 'front', 'Mr.', 'Raj', '', 'ki', '91', '9163839077', NULL, '', 'hariom.sharan+k30@met-technologies.com', '8cb2237d0679ca88db6464eac60da96345513964', '12345', 'male', 'married', '2019-10-01', '2019-08-04', '', 7, '2020-02-11 11:40:45', NULL, '2020-02-21 12:34:02', '1', 0, '0', NULL, 1, 'yes'),
(8, '2', '', '', 'Mr.', 'Hariom', '', 'Sharan', '91', '9163839071', '1024', '', 'hariom.sharan+k50@met-technologies.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '0', 'male', 'married', '2019-12-01', '2018-02-11', '', 8, '2020-02-11 12:30:49', 8, '2020-02-21 12:34:04', '1', 1, '0', NULL, NULL, 'yes'),
(10, '2', '', '', '', 'Arindam', NULL, 'Dutta', '91', '9830576623', '9407', '', 'arindamdutta.in@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '0', 'male', 'married', '1980-02-11', '2014-01-20', '39a9daf34deb740b781bd09482288aec.jpg', 1, '2020-02-11 20:47:00', 10, '2020-02-11 15:45:31', '1', 0, '0', NULL, 1, 'yes'),
(11, '2', '', 'front', '', 'Raj', '', 'om', '91', '9163235385', NULL, '', 'hariom.sharan-k50@met-technologies.com', '8cb2237d0679ca88db6464eac60da96345513964', '12345', 'male', 'married', '2019-12-01', '2019-11-01', '', 11, '2020-02-11 12:45:11', NULL, '2020-02-11 07:15:11', '1', 0, '0', NULL, 1, 'yes'),
(12, '3', '1872932056184530', 'front', '', 'Piyu', NULL, 'Dutta', '91', '6352352145', NULL, '', 'hariom.sharan-kt70@met-technologies.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '0', 'male', 'single', '2019-11-03', '0000-00-00', '', 1, '2020-02-11 18:11:45', NULL, '2020-02-11 12:41:45', '1', 0, '0', NULL, 1, 'yes'),
(22, '3', '10157858039329344', 'front', '', 'Arindam', '', 'Dutta', '91', '7003370702', NULL, '', 'pm@fitser.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '0', 'male', 'married', '1980-02-11', '2014-02-20', '', 22, '2020-02-11 18:16:35', NULL, '2020-02-11 12:46:35', '1', 0, '0', NULL, 1, 'yes'),
(23, '2', '', '', '', 'Anjan', '', 'om', '91', '9830780683', '5686', '2020-03-03 16:07', 'hariom.sharan+anjan01@met-technologies.com', '8cb2237d0679ca88db6464eac60da96345513964', '12345', 'male', 'married', '2019-08-01', '0000-00-00', '5501f312def2d9a302ff37f3af1d1b29.jpg', 23, '2020-02-11 18:36:37', 23, '2020-03-03 10:37:56', '1', 1, '0', NULL, NULL, 'yes'),
(24, '2', '', 'front', '', 'Anan2', '', 'om', '91', '9163839011', NULL, '', 'hariom.sharanan+an2@met-technologies.com', '8cb2237d0679ca88db6464eac60da96345513964', '12345', 'male', 'single', '2019-12-01', '0000-00-00', '', 24, '2020-02-11 18:53:46', NULL, '2020-02-11 13:23:46', '1', 0, '0', NULL, 1, 'yes'),
(25, '2', '', 'front', '', 'Anjn3', '', 'om', '91', '1234567895', NULL, '', 'hariom.sharan+anjan02@met-technologies.com', '8cb2237d0679ca88db6464eac60da96345513964', '12345', 'male', 'single', '2020-02-11', '0000-00-00', '', 25, '2020-02-11 18:58:21', NULL, '2020-02-11 13:28:21', '1', 0, '0', NULL, 1, 'yes'),
(26, '2', '', '', '', 'An03', '', 'om', '91', '9352555555', NULL, '', 'hariom.sharan+anjan03@met-technologies.com', '8cb2237d0679ca88db6464eac60da96345513964', '12345', 'male', 'single', '2020-02-11', '0000-00-00', 'de1e68037ee5990fcb5858a49504cb2b.jpg', 26, '2020-02-11 19:00:25', 26, '2020-02-12 00:09:12', '1', 0, '0', NULL, NULL, 'yes'),
(27, '2', '', '', '', 'kt010', '', '10', '91', '4563212365', NULL, '', 'hariom.sharan+kat900@met-technologies.com', '8cb2237d0679ca88db6464eac60da96345513964', '12345', 'female', 'married', '2020-02-11', '0000-00-00', '4a616f6ccd19603db88051949f8ca4b5.jpg', 27, '2020-02-11 19:11:33', 27, '2020-02-12 00:30:46', '1', 1, '0', NULL, NULL, 'yes'),
(28, '2', '', 'front', '', 'Test', '', 'Test', '91', '9007218467', NULL, '', 'test6666@gmail.com', '719855e8f4ebd94341277b0b0d50b75c5187133f', '0', 'male', 'single', '2001-02-11', '0000-00-00', '', 28, '2020-02-11 19:18:57', NULL, '2020-02-11 13:48:57', '1', 0, '0', NULL, 1, 'yes'),
(29, '2', '', 'front', '', 'test', '', 'test', '91', '9007218444', NULL, '', 'test888@gmail.com', '719855e8f4ebd94341277b0b0d50b75c5187133f', '0', 'male', 'single', '2016-02-11', '0000-00-00', '', 29, '2020-02-11 19:20:14', NULL, '2020-02-11 13:50:14', '1', 0, '0', NULL, 1, 'yes'),
(30, '2', '', 'front', '', 'test', '', 'test', '91', '9007218457', NULL, '', 'test999@gmail.com', '94ba69fdd6ac7c1576e4b079514aa04004822824', '0', 'male', 'single', '2020-02-08', '0000-00-00', '', 30, '2020-02-11 19:24:42', NULL, '2020-02-11 13:54:42', '1', 0, '0', NULL, 1, 'yes'),
(31, '2', '', 'front', '', 'test', '', 'test', '91', '9007217457', NULL, '', 'test9777@gmail.com', '94ba69fdd6ac7c1576e4b079514aa04004822824', '0', 'male', 'single', '2020-02-08', '0000-00-00', '', 31, '2020-02-11 19:33:10', NULL, '2020-02-11 14:03:10', '1', 0, '0', NULL, 1, 'yes'),
(33, '2', '', 'front', '', 'test', '', 'test', '91', '9007207457', NULL, '', 'test97@gmail.com', '94ba69fdd6ac7c1576e4b079514aa04004822824', '0', 'male', 'married', '2020-02-08', '0000-00-00', '', 33, '2020-02-11 19:35:48', NULL, '2020-02-11 14:05:48', '1', 0, '0', NULL, 1, 'yes'),
(34, '2', '', 'front', '', 'test', '', 'test', '91', '9007201457', NULL, '', 'test971@gmail.com', '94ba69fdd6ac7c1576e4b079514aa04004822824', '0', 'male', 'single', '2020-02-08', '0000-00-00', '', 34, '2020-02-11 19:36:23', NULL, '2020-02-11 14:06:23', '1', 0, '0', NULL, 1, 'yes'),
(35, '2', '', '', '', 'testhdbvjh', NULL, 'sjkdbvjkbs', '91', '9007218459', NULL, '', 'test123@gmail.com', '719855e8f4ebd94341277b0b0d50b75c5187133f', '0', 'female', 'single', '2020-02-08', '0000-00-00', '', 1, '2020-02-11 19:58:51', 35, '2020-02-11 14:28:51', '1', 0, '0', NULL, NULL, 'yes'),
(36, '2', '', '', '', 'Anjn', '', 'om', '91', '2352365232', NULL, '', 'hariom.sharan+anjan100@met-technologies.com', '8cb2237d0679ca88db6464eac60da96345513964', '12345', 'male', 'married', '2020-01-01', '2018-02-01', '6d8c46db00f11e4e6b4575e8b4787203.jpg', 36, '2020-02-11 20:03:17', 36, '2020-02-12 01:08:11', '1', 0, '0', NULL, NULL, 'yes'),
(37, '2', '', '', '', 'Hariom', '', 'Sharan', '91', '9123086984', '4942', '', 'hariom.sharan+kt09@met-technologies.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '0', 'male', 'married', '1990-02-11', '2018-03-03', '', 37, '2020-02-11 20:11:37', 37, '2020-02-12 01:14:38', '1', 0, '0', NULL, NULL, 'yes'),
(38, '2', '', '', '', 'kat100', '', 'om', '91', '9163539808', NULL, '', 'hariom.sharan+kat200@met-technologies.com', '8cb2237d0679ca88db6464eac60da96345513964', '12345', 'female', 'married', '2017-02-11', '2018-11-03', '', 38, '2020-02-11 20:15:46', 38, '2020-02-12 01:16:31', '1', 0, '0', NULL, NULL, 'yes'),
(39, '2', '', 'front', '', 'Test', '', 'test123', '91', '9007218499', NULL, '', 'test678@gmail.com', '719855e8f4ebd94341277b0b0d50b75c5187133f', '0', 'male', 'married', '2020-02-04', '0000-00-00', '', 39, '2020-02-12 10:54:22', NULL, '2020-02-12 05:24:22', '1', 0, '0', NULL, 1, 'yes'),
(41, '2', '', '', 'MR.', 'Hariom', NULL, 'shh', '91', '9132352365', NULL, '', 'hariom.sharan+an50@met-technologies.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '0', 'male', 'married', '2020-01-05', '0000-00-00', '', 4, '2020-02-24 13:10:24', 41, '2020-02-28 09:43:36', '1', 0, '0', NULL, NULL, 'yes'),
(42, '2', '', '', '', 'gggh', '', 'ttty', '91', '9163532532', NULL, '', 'hari.sharan1990+100@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', '12345', 'male', 'married', '2020-02-01', '2018-02-12', '', 42, '2020-02-12 11:55:44', 42, '2020-02-12 16:57:25', '1', 0, '0', NULL, NULL, 'yes'),
(43, '2', '', 'admin', '', 'I', NULL, 'B', '91', '7798567456', NULL, '', 'ishani.banerjee@met-technologies.com', 'a3ecf37f783e07da13f3ea397d4eaf6634865e13', '1504154245', 'female', 'single', '2002-02-12', '0000-00-00', '', 1, '2020-02-12 12:46:40', NULL, NULL, '1', 0, '0', NULL, 1, 'yes'),
(46, '2', '', 'admin', '', 'Avishek', NULL, 'Roy', '91', '2345678909', NULL, '', 'avishek.chakraborty@met-technologies.com', '57d52b9f10f73837f308991857f27b904f4a1884', '727233079', 'female', 'married', '2001-08-15', '0000-00-00', '', 1, '2020-02-12 13:12:42', NULL, NULL, '1', 0, '0', NULL, 1, 'yes'),
(47, '2', '', '', '', 'Somo', '', 'km', '91', '9658235451', NULL, '', 'soumya.h9415@test.com', '8cb2237d0679ca88db6464eac60da96345513964', '12345', 'male', 'married', '1993-02-10', '2020-02-12', '', 47, '2020-02-12 13:23:05', 47, '2020-02-24 07:57:10', '1', 0, '0', NULL, NULL, 'yes'),
(48, '3', '2616645468434349', 'front', '', 'Sagar', '', 'Nayak', '91', '8093329914', NULL, '', 'snkumar.nayak@rediffmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '0', 'male', 'single', '1994-10-11', '0000-00-00', '', 48, '2020-02-12 13:30:12', NULL, '2020-02-12 08:00:12', '1', 0, '0', NULL, 1, 'yes'),
(49, '2', '', 'admin', '', 'sdAD', NULL, 'xzxzc', '91', '3453646567', NULL, '', 'sd@test.com', 'f599c5998cf8f3e07cca8ca1a3d590b6646eca41', '661299224', 'female', 'single', '1987-02-11', '0000-00-00', '', 1, '2020-02-12 13:34:27', NULL, NULL, '1', 0, '0', NULL, 1, 'yes'),
(50, '2', '', 'admin', '', 'hjj', NULL, 'yui', '91', '6567788890', NULL, '', 'de@test.com', '943aa26c99d745673d7c0c0ad042f8792de4227f', '701803107', 'female', 'married', '1989-02-15', '0000-00-00', '', 1, '2020-02-12 13:34:59', NULL, '2020-02-21 14:47:39', '1', 0, '0', NULL, 1, 'yes'),
(51, '2', '', 'admin', '', 'sdfs', NULL, 'dfsfds', '91', '5464567890', NULL, '', 'sreelabiswas.kundu123@met-technologies.com', '347d05fe59b964ea63e2e53543fe5c8c191ae8d0', '1649686566', 'female', 'single', '1989-02-07', '0000-00-00', '', 4, '2020-02-21 16:01:01', NULL, '2020-02-24 11:44:56', '1', 0, '0', NULL, 1, 'yes'),
(52, '2', '', 'admin', '', 'sdfs', NULL, 'hjkhg', '91', '4354645657', NULL, '', 'ds@test.com', '889c1d86451ad34778bb837fcae798b3fb52601a', '1480070884', 'female', 'single', '1989-02-08', '0000-00-00', '', 1, '2020-02-12 13:38:36', NULL, NULL, '1', 0, '0', NULL, 1, 'yes'),
(53, '2', '', 'admin', '', 'Ishani10', NULL, 'Banerjee', '91', '5858568568', NULL, '', 'chayan.samanta@met-technologies.com', '7a1d9d2d8f41b47246010495d2664b26f306011f', '741837748', 'female', 'single', '1992-02-05', '0000-00-00', '', 1, '2020-02-12 13:40:37', NULL, NULL, '1', 0, '0', NULL, 1, 'yes'),
(54, '2', '', 'front', '', 'Arijit', '', 'Paul', '91', '8334966002', '7844', '', 'aarijitpaul@gmail.com', '39809ed380b882f8b349821f8d58e88921f351c2', '0', 'male', 'married', '1974-05-12', '1999-12-04', '', 54, '2020-02-12 13:44:36', NULL, '2020-02-12 08:36:17', '1', 0, '0', NULL, 1, 'yes'),
(55, '3', '10156838768280857', 'front', '', 'Shyam', '', 'Bhaiya', '91', '9830233006', NULL, '', 'sharad210@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '0', 'male', 'single', '2020-02-12', '0000-00-00', '', 55, '2020-02-12 15:00:02', NULL, '2020-02-12 09:30:02', '1', 0, '0', NULL, 1, 'yes'),
(56, '2', '', 'front', '', 'Test', '', 'Test', '91', '9007218469', NULL, '', 'test8888@gmail.com', '719855e8f4ebd94341277b0b0d50b75c5187133f', '0', 'male', 'single', '2020-02-13', '0000-00-00', '', 56, '2020-02-13 15:14:19', NULL, '2020-02-13 09:44:19', '1', 0, '0', NULL, 1, 'yes'),
(57, '2', '', 'front', '', 'Anup', '', 'Bora', '91', '9007218452', NULL, '', 'anupbora@gmail.com', '719855e8f4ebd94341277b0b0d50b75c5187133f', '0', 'male', 'single', '2020-02-10', '0000-00-00', '', 57, '2020-02-14 17:14:14', NULL, '2020-02-14 11:44:14', '1', 0, '0', NULL, 1, 'yes'),
(58, '2', '', 'front', '', 'Sandipan', NULL, 'shaw', '91', '9007218435', NULL, '', 'sandip.shaw@met-technologies.com', '719855e8f4ebd94341277b0b0d50b75c5187133f', '0', 'male', 'married', '1999-02-14', '0000-00-00', '', 4, '2020-02-21 15:37:49', NULL, '2020-02-21 10:07:49', '1', 0, '0', NULL, 1, 'yes'),
(59, '2', '', 'admin', '', 'Hsm', NULL, 'mi', '91', '9165985698', NULL, '', 'hariom.sharan+hsm01@met-technologies.com', 'cf83c2f571a03642ac371887c183e4c7d98bd7e1', '574073595', 'male', 'married', '2012-02-16', '0000-00-00', '', 4, '2020-02-21 10:39:11', NULL, '2020-02-21 05:09:11', '1', 0, '0', NULL, 1, 'yes'),
(60, '2', '', 'admin', '', 'Rahul', NULL, 'r', '91', '9898985874', NULL, '', 'hariom.sharan+t0001@met-technologies.com', 'a00b6343bd5434d2a70cb11912eb81e8934d8833', '2085104512', 'male', 'married', '2012-02-14', '0000-00-00', '', 4, '2020-02-21 17:44:39', NULL, '2020-02-21 12:14:39', '1', 0, '0', NULL, 1, 'yes'),
(61, '2', '', 'admin', '', 'Hm001', NULL, 'tes', '91', '9865896589', NULL, '', 'hariom.shara@gmail.com', '7e0540845fc0fec1ed695a77a938cbb660cc0e68', '1775323796', 'male', 'married', '2020-02-18', '0000-00-00', '', 4, '2020-02-21 17:52:13', NULL, NULL, '1', 0, '0', NULL, 1, 'yes'),
(62, '2', '', 'admin', 'MR.', 'Haii', NULL, 'te', '91', '9865986598', NULL, '', 'hari@gmail.com', '37d60de4b0fade8ed29642d1da01c71deaba8361', '2123751861', 'male', NULL, '2020-02-13', '0000-00-00', '', 4, '2020-02-21 20:16:00', NULL, '2020-02-21 14:46:00', '1', 0, '0', NULL, 1, 'yes'),
(63, '2', '', 'admin', 'MR.', 'Test', NULL, '54', '91', '8965322154', NULL, '', 'hari@gmail.co.in', '4386186e60aed5ece4fc91e224b43baf2981c2e0', '1426609264', 'male', NULL, '2018-02-08', '0000-00-00', '', 4, '2020-02-24 11:47:19', NULL, '2020-02-24 06:17:19', '1', 0, '0', NULL, 1, 'yes'),
(64, '2', '', 'admin', 'MR.', 'Rajsing-Ed', NULL, 'ha', '91', '98655487', NULL, '', 'hari99@gmail.com', '9bc21cdd7d48d6d49b9517ec4203743463c25e91', '1478898831', 'male', 'married', '2017-02-01', '0000-00-00', '', 4, '2020-02-24 11:58:30', NULL, '2020-02-24 06:29:18', '1', 0, '0', NULL, 1, 'yes'),
(65, '2', '', 'admin', 'MR.', 'T5445', NULL, '5454', '91', '9856986554', NULL, '', 'om09@gmail.com', '44cc110469215457437298a1d45af33fc4a4c417', '1735789636', 'male', 'married', '2018-02-01', '0000-00-00', '', 4, '2020-02-24 13:01:11', NULL, '2020-02-24 07:31:11', '1', 0, '0', NULL, 1, 'yes'),
(69, '2', '', 'front', '', 'Jaccy', '', 'Jams', '91', '8334856161', '6238', '2020-03-04 12:50', 'sreelabiswas.kundu@met-technologies.com', 'c129b324aee662b04eccf68babba85851346dff9', '12341234', 'male', 'single', '1990-11-26', '0000-00-00', '', 69, '2020-02-24 17:22:53', NULL, '2020-03-04 07:20:06', '1', 0, '0', 'MTYwODI0NTkyMg==', 1, 'yes'),
(70, '2', '', 'front', '', 'Test123', '', 'Test456', '91', '9007218896', NULL, '', 'test223@gmail.com', '719855e8f4ebd94341277b0b0d50b75c5187133f', '0', 'male', 'single', '2020-02-01', '0000-00-00', '4a970646db8824da44eb20c0352a717a.jpg', 70, '2020-02-24 17:29:04', NULL, '2020-02-24 11:59:04', '1', 0, '0', NULL, 1, 'yes'),
(71, '2', '', 'front', '', 'Test', '', 'Test', '91', '9007218777', NULL, '', 'test2223@gmail.com', '719855e8f4ebd94341277b0b0d50b75c5187133f', '0', 'male', 'single', '2020-02-24', '0000-00-00', '577936d382b7b68f5df40655f7b038eb.jpg', 71, '2020-02-24 17:46:18', NULL, '2020-02-24 12:16:18', '1', 0, '0', NULL, 1, 'yes'),
(73, '2', '', 'front', '', 'Test', '', 'Test789', '91', '9007894561', NULL, '', 'test2224@gmail.com', '719855e8f4ebd94341277b0b0d50b75c5187133f', '0', 'male', 'single', '2020-02-18', '0000-00-00', '711fc3bcff4da86c5edfd70489608e47.jpg', 73, '2020-02-24 17:57:21', NULL, '2020-02-24 12:27:21', '1', 0, '0', NULL, 1, 'yes'),
(74, '2', '', 'front', '', 'Test', '', 'Test', '91', '9800789453', NULL, '', 'test2225@gmail.com', '719855e8f4ebd94341277b0b0d50b75c5187133f', '0', 'male', 'single', '2020-02-20', '0000-00-00', '', 74, '2020-02-24 17:58:57', NULL, '2020-02-24 12:28:57', '1', 0, '0', NULL, 1, 'yes'),
(75, '2', '', '', '', 'Test', '', 'Test', '91', '7894561239', NULL, '', 'test2226@gmail.com', '719855e8f4ebd94341277b0b0d50b75c5187133f', '0', 'male', 'single', '2020-02-20', '0000-00-00', '879c6d44562b13ff7e7eade732da3516.jpg', 75, '2020-02-24 18:06:49', 75, '2020-02-24 12:40:05', '1', 0, '0', NULL, NULL, 'yes'),
(78, '2', '', '', '', 'Sophiaa', '', 'Jams', '91', '8334852222', NULL, '', 'sophia@test.com', '273a0c7bd3c679ba9a6f5d99078e36e85d02b952', '222222', 'male', 'single', '1990-10-26', '0000-00-00', 'https:\\/\\/platform-lookaside.fbsbx.com\\/platform\\/profilepic\\/?asid=171518267294417&height=200&width=200&ext=1585138890&hash=AeSSnQIC0aM5vf3b', 78, '2020-02-24 18:34:39', 78, '2020-03-06 11:08:59', '1', 1, '0', NULL, 1, 'yes'),
(80, '2', '', 'front', '', 'Test', '', 'Test', '91', '9007218448', NULL, '', 'test2227@gmail.com', '719855e8f4ebd94341277b0b0d50b75c5187133f', '0', 'male', 'single', '2020-02-20', '0000-00-00', 'be01d8184b9177a834e3eba0701c3875.jpg', 80, '2020-02-24 19:18:16', NULL, '2020-02-24 13:48:16', '1', 0, '0', NULL, 1, 'yes'),
(81, '2', '', 'front', '', 'Test', '', 'test', '91', '9874561290', NULL, '', 'test2228@gmail.com', '719855e8f4ebd94341277b0b0d50b75c5187133f', '0', 'male', 'single', '2020-02-13', '0000-00-00', '', 81, '2020-02-24 19:21:04', NULL, '2020-02-24 13:51:04', '1', 0, '0', NULL, 1, 'yes'),
(82, '2', '', 'front', '', 'Test', '', 'test', '91', '7894561230', NULL, '', 'test6789@gmail.com', '719855e8f4ebd94341277b0b0d50b75c5187133f', '0', 'male', 'single', '2020-02-14', '0000-00-00', '', 82, '2020-02-24 19:23:19', NULL, '2020-02-24 13:53:19', '1', 0, '0', NULL, 1, 'yes'),
(84, '3', '171518267294417', 'front', '', 'Sankha', '', 'Poddar', '91', '9966332210', NULL, '', 'fitser.usa@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '0', 'male', 'single', '2020-02-14', '0000-00-00', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=171518267294417&height=200&width=200&ext=1585145144&hash=AeSFrgckPNVWHkeU', 84, '2020-02-24 19:38:27', NULL, '2020-02-24 14:08:27', '1', 0, '0', NULL, 1, 'yes'),
(85, '2', '', 'front', '', 'Test', '', 'Test', '91', '9007218888', NULL, '', 'test8899@gmail.com', '719855e8f4ebd94341277b0b0d50b75c5187133f', '0', 'male', 'single', '2020-02-20', '0000-00-00', '176959709e4eb60b9d23ff1c528b8c21.jpg', 85, '2020-02-24 19:44:52', NULL, '2020-02-24 14:14:52', '1', 0, '0', NULL, 1, 'yes'),
(86, '2', '', 'front', '', 'test', '', 'test', '91', '9874569333', NULL, '', 'test7789@gmail.com', '719855e8f4ebd94341277b0b0d50b75c5187133f', '0', 'male', 'single', '2020-02-08', '0000-00-00', '2a0dcade0b0398ba6ca288746f52064e.jpg', 86, '2020-02-25 11:06:13', NULL, '2020-02-26 07:47:09', '0', 0, '0', NULL, 1, 'yes'),
(87, '3', '1521381051372856', 'front', '', 'Anup', NULL, 'Bora', '91', '1234567890', NULL, '', 'anup.love.in@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '0', 'male', 'single', '2020-02-25', '0000-00-00', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=1521381051372856&height=200&width=200&ext=1585205152&hash=AeSsneeyEuvJyx0l', 4, '2020-02-26 13:16:31', NULL, '2020-02-26 07:46:31', '1', 0, '0', NULL, 1, 'yes'),
(88, '2', '', 'admin', '', 'New user', NULL, 'Test', '91', '9856986598', NULL, '', 'hari8999@gmail.com', 'be24580fd458298d5be27f5ee682c1c1ad12ee0d', '1932439798', 'male', NULL, '2016-02-09', '0000-00-00', '', 5, '2020-02-26 12:08:15', NULL, '2020-03-04 13:38:41', '1', 0, '0', NULL, 1, 'yes'),
(89, '2', '', '', '', 'Hari', '', 'om', '91', '9163636363', NULL, '', 'hariom.sharan+123@met-technologies.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', 'male', 'married', '1990-02-28', '2018-02-11', '', 89, '2020-02-28 14:49:42', 89, '2020-02-28 10:02:14', '1', 1, '0', NULL, NULL, 'yes'),
(90, '2', '', '', '', 'Hariom', '', 'Sharan', '91', '6352352365', NULL, '', 'hari.sharan1990@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '0', 'male', 'married', '2020-02-28', '0000-00-00', '5cab8a7e651d9d9f50ce59ef792f0faa.jpg', 90, '2020-02-28 14:52:44', 90, '2020-02-28 09:24:24', '1', 0, '0', NULL, NULL, 'yes'),
(91, '2', '', '', '', 'Ru', '', 'k', '91', '6352415236', NULL, '', 'hariom.sharan+xyz@met-technologies.com', '8cb2237d0679ca88db6464eac60da96345513964', '12345', 'male', 'married', '1990-02-07', '0000-00-00', '', 91, '2020-02-28 15:37:13', 91, '2020-02-28 10:08:01', '1', 0, '0', NULL, NULL, 'yes'),
(92, '2', '', '', '', 'ka', '', 't', '91', '9163636366', NULL, '', 'hariom.sharan+kt01@met-technologies.com', '8cb2237d0679ca88db6464eac60da96345513964', '12345', 'male', 'single', '2020-01-05', '0000-00-00', '15c490e4b22c8f0fdf1eb492b0516897.jpg', 92, '2020-02-28 15:39:51', 92, '0000-00-00 00:00:00', '1', 1, '0', NULL, NULL, 'yes'),
(93, '2', '', '', '', 'abhik', '', 'das', '91', '9123047102', '4333', '2020-03-10 11:35', 'm.titu.das@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', 'male', 'married', '1989-03-05', '2017-03-05', '83f893905d0193870c88719800f9c332.jpg', 93, '2020-02-28 17:37:19', 93, '2020-03-10 06:05:43', '1', 0, '0', NULL, 1, 'yes'),
(94, '2', '', '', '', 'Hariom', '', 'hggg', '91', '6363636363', NULL, '', 'hari.sharan1990+10@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '0', 'male', 'single', '2020-02-28', '0000-00-00', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=3426282607442614&height=200&width=200&ext=1585488546&hash=AeTCB4P77NZPolav', 94, '2020-02-28 19:02:09', 94, '2020-02-28 13:34:27', '1', 0, '0', NULL, NULL, 'yes'),
(95, '2', '', '', '', 'Test', '', 'Qa', '91', '6589653258', NULL, '', 'testqa@yopmail.com', '719855e8f4ebd94341277b0b0d50b75c5187133f', '0', 'female', 'single', '2019-12-31', '0000-00-00', '5f60aeb8c38580387cd6dd0b8e27e07e.jpg', 95, '2020-03-02 15:33:20', 95, '2020-03-02 11:22:31', '1', 1, '0', NULL, NULL, 'yes'),
(96, '2', '', '', '', 'Test', '', 'Test', '91', '9007218498', NULL, '', 'test12345@gmail.com', '719855e8f4ebd94341277b0b0d50b75c5187133f', '0', 'male', 'single', '2020-03-02', '0000-00-00', '2f4d6b8fdfcbf874b3be0f1afa2228da.jpg', 96, '2020-03-02 16:27:06', 96, '2020-03-02 11:36:14', '1', 0, '0', NULL, NULL, 'yes'),
(97, '2', '', 'front', '', 'Test', '', 'Test', '91', '9007218488', NULL, '', 'test4567@gmail.com', '94ba69fdd6ac7c1576e4b079514aa04004822824', '0', 'male', 'single', '2020-03-02', '0000-00-00', '', 97, '2020-03-02 18:43:22', NULL, '2020-03-02 13:13:22', '1', 0, '0', NULL, 1, 'yes'),
(99, '2', '', '', '', 'Hariom', '', 'Sharan', '91', '9136365236', NULL, '', 'hari.sharan1990+333@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '0', 'male', 'married', '2020-03-03', '2010-03-03', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=3426282607442614&height=200&width=200&ext=1585810078&hash=AeQfYOIT_-rHCY_9', 99, '2020-03-03 12:21:07', 99, '2020-03-03 06:55:23', '1', 0, '0', NULL, NULL, 'yes'),
(100, '3', '3426282607442614', 'front', '', 'Hariom', '', 'Sharan', '91', '9163839087', '1860', '2020-03-03 16:06', 'hari.sharan1990+850@gmail.com', 'da39a3ee5e6b4b0d3255bfef95601890afd80709', '0', 'male', 'married', '2020-03-03', '0000-00-00', 'https://platform-lookaside.fbsbx.com/platform/profilepic/?asid=3426282607442614&height=200&width=200&ext=1585823162&hash=AeQBurhDiozcvdb_', 100, '2020-03-03 15:58:45', NULL, '2020-03-03 10:36:14', '1', 0, '0', NULL, 1, 'yes'),
(101, '2', '', '', '', 'Hariom', NULL, 'Sharan', '91', '7278343556', NULL, '', 'hari.sharan1990+8581@gmail.com', '7c4a8d09ca3762af61e59520943dc26494f8941b', '123456', 'male', 'single', '2020-03-03', '0000-00-00', 'f9b772389e12f8b7631c8c57a05396b8.jpg', 1, '2020-03-03 16:20:16', 101, '2020-03-03 11:43:41', '1', 1, '0', '', NULL, 'yes'),
(102, '2', '', '', '', 'Sagar', '', 'Kumar', '91', '8093329913', NULL, '', 'sagor@met-technologies.com', '719855e8f4ebd94341277b0b0d50b75c5187133f', '0', 'male', 'single', '2020-02-16', '0000-00-00', '090f05523e340f80dbc3f0060b81aa93.jpg', 102, '2020-03-03 16:31:17', 102, '2020-03-03 11:12:39', '1', 0, '0', NULL, NULL, 'yes'),
(103, '3', '123456', 'front', '', 'Sophia', '', 'Jams', '91', '8334852200', NULL, '', 'sophia1234@test.com', '273a0c7bd3c679ba9a6f5d99078e36e85d02b952', '222222', 'male', 'single', '1990-10-26', '0000-00-00', 'https:\\/\\/platform-lookaside.fbsbx.com\\/platform\\/profilepic\\/?asid=171518267294417&height=200&width=200&ext=1585138890&hash=AeSSnQIC0aM5vf3b', 103, '2020-03-03 17:25:51', NULL, '2020-03-06 10:52:51', '1', 0, '0', NULL, 1, 'yes'),
(104, '3', '123456', 'front', '', 'Sourish', '', 'Jams', '91', '8334850000', NULL, '', 'sreela.biswas05@gmail.com', '273a0c7bd3c679ba9a6f5d99078e36e85d02b952', '222222', 'male', 'single', '1990-10-26', '0000-00-00', 'https:\\/\\/platform-lookaside.fbsbx.com\\/platform\\/profilepic\\/?asid=171518267294417&height=200&width=200&ext=1585138890&hash=AeSSnQIC0aM5vf3b', 104, '2020-03-03 18:30:20', NULL, '2020-03-03 13:00:20', '1', 0, '0', NULL, 1, 'yes'),
(105, '3', '123456', 'front', '', 'Sam', '', 'Jems', '91', '8334851100', NULL, '', 'test.demomet@gmail.com\n', '273a0c7bd3c679ba9a6f5d99078e36e85d02b952', '222222', 'male', 'single', '1990-10-26', '0000-00-00', 'https:\\/\\/platform-lookaside.fbsbx.com\\/platform\\/profilepic\\/?asid=171518267294417&height=200&width=200&ext=1585138890&hash=AeSSnQIC0aM5vf3b', 105, '2020-03-03 18:35:24', NULL, '2020-03-03 13:05:24', '1', 0, '0', NULL, 1, 'yes'),
(106, '2', '', 'front', '', 'Abhik', '', 'Das', '91', '9593900081', '1410', '2020-03-10 11:41', 'abhik@gmail.com', '512b53eaafe040405f6a8675c5dc43231b24e13e', 'Aa@1234567', 'male', 'married', '1989-03-04', '2017-01-22', '', 106, '2020-03-04 16:07:46', 106, '2020-03-10 06:11:56', '1', 1, '0', NULL, 1, 'yes'),
(107, '2', '', 'admin', '', 'Anjan', NULL, 'Sharan', '91', '9158484542', NULL, '', 'hariom.sharan+anjn@met-technologies.com', '4a05a84ababa919196ffc36ea0cca52e896dbcff', '886261453', 'male', 'married', '1991-03-07', '2020-03-04', '3e98dd5402b934c3125c320ac6b48275.jpg', 8, '2020-03-05 11:39:03', NULL, '2020-03-05 06:09:03', '1', 0, '0', NULL, 1, 'yes'),
(108, '2', '', 'admin', '', 'Raja', NULL, 'kumard', '91', '9865741255', NULL, '', 'raja.kumar@gmail.com', 'ad0a6555b24ac4000b72d36f28dd3370d07eb786', '1430228914', 'male', 'married', '1991-03-01', '0000-00-00', '', 4, '2020-03-05 11:53:14', NULL, '2020-03-05 06:24:03', '0', 0, '0', NULL, 1, 'yes'),
(109, '2', '', 'admin', '', 'Rishu', NULL, 'om', '91', '9856985654', NULL, '', 'hari.t999@gmail.com', '3b12bf31a1f9aa13ea78a6edd81834bf73ce7a80', '1386076891', 'male', NULL, '1990-03-06', '0000-00-00', '', 5, '2020-03-05 12:30:51', NULL, NULL, '1', 0, '0', NULL, 1, 'yes'),
(110, '2', '', 'admin', '', 'LHT01', NULL, 'OM', '91', '9845211212', NULL, '', 'hariom.sh@gmail.com', '9f1ac5ccc7894600371ef4f374dc7a61853a8bbb', '1612379253', 'male', 'married', '2000-03-07', '0000-00-00', '', 1, '2020-03-06 15:03:15', NULL, '2020-03-06 09:33:15', '1', 0, '0', NULL, 1, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `master_menu`
--

CREATE TABLE `master_menu` (
  `menu_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `menu_name` varchar(100) DEFAULT NULL,
  `menu_link` varchar(500) DEFAULT NULL,
  `menu_rank` decimal(6,1) DEFAULT NULL,
  `action` varchar(100) DEFAULT NULL COMMENT 'uri name for active menu',
  `menu_icon` varchar(100) DEFAULT NULL,
  `is_active` bit(1) NOT NULL DEFAULT b'1' COMMENT '1 = active , inactive = 0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `master_menu`
--

INSERT INTO `master_menu` (`menu_id`, `parent_id`, `menu_name`, `menu_link`, `menu_rank`, `action`, `menu_icon`, `is_active`) VALUES
(1, 0, 'Users', NULL, '4.0', 'member', '<i class=\"fa fa-user\" aria-hidden=\"true\"></i>', b'1'),
(2, 1, 'Add New Users', 'admin/member/add', '4.1', 'member', NULL, b'1'),
(3, 1, 'Users List', 'admin/member', '4.2', 'member', '', b'1'),
(16, 0, 'Role', '', '21.0', 'role', '<i class=\"fa fa-book\" aria-hidden=\"true\"></i>', b'0'),
(17, 0, 'Dashboard', 'admin/dashboard', '1.0', 'dashboard', '<i class=\"icon-home\"></i>', b'1'),
(19, 81, 'Role List', 'admin/role', '11.8', 'role', NULL, b'1'),
(26, 0, 'Report', NULL, '10.0', 'reports', '<i class=\"fa fa-bar-chart\" aria-hidden=\"true\"></i>', b'1'),
(37, 0, 'Club Membership', '', '3.0', 'package', '<i class=\"fa fa-credit-card-alt\" aria-hidden=\"true\"></i>', b'1'),
(38, 37, 'Add New Club Membership', 'admin/package/add', '3.1', 'package', NULL, b'1'),
(39, 37, 'Club Membership List', 'admin/package', '3.2', 'package', NULL, b'1'),
(40, 0, 'CMS', NULL, '4.0', 'cms', '<i class=\"fa fa-file-text\" aria-hidden=\"true\"></i>', b'0'),
(41, 81, 'Page List', 'admin/cms', '11.5', 'cms', NULL, b'1'),
(43, 0, 'Club Members', '', '5.0', 'membership', '<i class=\"fa fa-users\" aria-hidden=\"true\"></i>', b'0'),
(44, 37, 'Membership edit', 'admin/package/edit', '3.1', 'package', NULL, b'0'),
(45, 81, 'Page edit', 'admin/cms/edit_cms', '11.3', 'cms', NULL, b'0'),
(46, 37, 'Membership Benefits List', 'admin/PackageBenefit', '3.3', 'PackageBenefit', NULL, b'1'),
(47, 81, 'Add New Role', 'admin/role/add', '11.6', 'role', NULL, b'1'),
(48, 1, 'Edit Users', 'admin/member/edit', '4.3', 'member', NULL, b'0'),
(49, 26, 'Membership Purchased Report', 'admin/reports/membershipPackagesPurchased', '10.1', 'reports', NULL, b'1'),
(50, 26, 'Reservation Report', 'admin/reports/reservationReport', '10.2', 'reports', NULL, b'1'),
(51, 0, 'Sub-Administrator', NULL, '14.0', 'users', '<i class=\"fa fa-users\" aria-hidden=\"true\"></i>', b'0'),
(52, 81, 'Sub-Administrator List', 'admin/users', '11.2', 'users', NULL, b'1'),
(53, 81, 'Add New Sub Administrator', 'admin/users/add', '11.1', 'users', NULL, b'1'),
(54, 81, 'Edit Sub Administrator', 'admin/users/edit', '11.3', 'users', NULL, b'0'),
(55, 37, 'Add New Membership Benefit', 'admin/PackageBenefit/add', '3.4', 'PackageBenefit', NULL, b'1'),
(56, 37, 'Edit Membership Benefit', 'admin/PackageBenefit/edit', '3.5', 'PackageBenefit', NULL, b'0'),
(57, 37, 'Membership Voucher List', 'admin/PackageVoucher', '3.6', 'PackageVoucher', NULL, b'1'),
(58, 37, 'Add New Membership Voucher', 'admin/PackageVoucher/add', '3.7', 'PackageVoucher', NULL, b'1'),
(59, 37, 'Edit Membership Voucher', 'admin/PackageVoucher/edit', '3.8', 'PackageVoucher', NULL, b'0'),
(60, 0, 'Reservation', NULL, '2.0', 'Reservation', '<i class=\"fa fa-ticket\" aria-hidden=\"true\"></i>', b'1'),
(61, 60, 'Reservation List', 'admin/Reservation', '2.2', 'Reservation', '', b'1'),
(62, 0, 'Gallery', NULL, '6.0', 'gallery', '<i class=\"fa fa-file-image-o\" aria-hidden=\"true\"></i>', b'1'),
(63, 62, 'Album List', 'admin/gallery', '6.2', 'gallery', '', b'1'),
(64, 62, 'Add New Album', 'admin/gallery/add', '6.1', 'gallery', '', b'1'),
(65, 62, 'Edit Album', 'admin/gallery/edit', '6.3', 'gallery', '', b'0'),
(66, 0, 'Event', NULL, '5.0', 'event', '<i class=\"fa fa-calendar\" aria-hidden=\"true\"></i>', b'1'),
(67, 66, 'Event List', 'admin/event', '5.2', 'event', '', b'1'),
(68, 66, 'Add New Event', 'admin/event/add', '5.1', 'event', '', b'1'),
(69, 66, 'Edit Event', 'admin/event/edit', '5.3', 'event', '', b'0'),
(70, 81, 'Add New Page', 'admin/cms/add', '11.4', 'cms', NULL, b'1'),
(71, 37, 'Club Members List', 'admin/membership', '3.8', 'membership', NULL, b'1'),
(72, 0, 'Zone', '', '8.0', 'zone', '<i class=\"fa fa-podcast\" aria-hidden=\"true\"></i>', b'1'),
(73, 72, 'Zone list', 'admin/zone', '8.2', 'zone', NULL, b'1'),
(74, 72, 'Add new Zone', 'admin/zone/add', '8.1', 'zone', NULL, b'1'),
(75, 72, 'Zone Edit', 'admin/zone/edit', '8.3', 'zone', NULL, b'0'),
(76, 66, 'Past events', 'admin/past-events', '5.4', 'event', NULL, b'1'),
(77, 0, 'Request for photograph', 'admin/Request-for-photograph', '7.0', 'Request-for-photograph', '<i class=\"fa fa-camera\" aria-hidden=\"true\"></i>', b'1'),
(78, 0, 'Inquiry', 'admin/inquiry', '9.0', 'inquiry', '<i class=\"fa fa-question-circle\" aria-hidden=\"true\"></i>', b'1'),
(79, 60, 'Add New Reservation', 'admin/reservation/add', '2.1', 'Reservation', '', b'1'),
(80, 43, 'Add New Users', 'admin/member/add', '5.2', 'member', NULL, b'0'),
(81, 0, 'Setting', '', '11.0', 'Setting', '<i class=\"fa fa-book\" aria-hidden=\"true\"></i>', b'1'),
(82, 62, 'view Album', 'admin/gallery/ViewGalleryImgs', '6.4', 'gallery', '', b'0'),
(83, 66, 'view Past Event Images', 'admin/event/viewPastEventImages', '5.6', 'event', NULL, b'0'),
(84, 81, 'Edit Role', 'admin/role/edit', '11.7', 'role', NULL, b'0'),
(85, 0, 'Change password', 'admin/changepassword', '22.0', 'changepassword', '<i class=\"icon-home\"></i>', b'0'),
(86, 0, 'Zone Blocking', NULL, '8.4', 'Zoneblocking', '<i class=\"fa fa-lock\" aria-hidden=\"true\"></i>', b'1'),
(87, 86, 'Block Zone', 'admin/zoneblocking/zoneBlocking', '8.4', 'Zoneblocking', '<i class=\"fa fa-lock\" aria-hidden=\"true\"></i>', b'1'),
(88, 86, 'zone Blocking List', 'admin/zoneblocking', '8.4', 'Zoneblocking', '<i class=\"fa fa-lock\" aria-hidden=\"true\"></i>', b'1'),
(89, 81, 'Log', 'admin/log', '11.9', 'log', NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `master_package`
--

CREATE TABLE `master_package` (
  `package_id` int(11) NOT NULL,
  `package_name` varchar(200) NOT NULL,
  `package_title` longtext NOT NULL,
  `package_description` longtext NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `is_delete` tinyint(4) NOT NULL,
  `created_on` date NOT NULL,
  `update_on` date NOT NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_package`
--

INSERT INTO `master_package` (`package_id`, `package_name`, `package_title`, `package_description`, `status`, `is_delete`, `created_on`, `update_on`) VALUES
(1, 'Club Fenicia', '<p>Club Fenicia takes this opportunity to present to you our newly launched and highly exclusive membership to Fenicia Club! Fenicia Club is a select membership program that offers you exciting benefits, offerings and privileges at Club Fenicia as well as our affiliate partners.</p>\r\n', '<p>Asia’s Largest Luxury Lounge, Club Fenicia, has discerningly curated this membership program with the vision to create a relationship with their patrons that allows them to avail a 360-degree experience of what the best in the leisure and entertainment industry has to offer.</p>\r\n', '1', 0, '2019-12-02', '2020-03-06'),
(20, 'clubfeniciaw22ww2', '<p>sdfdfg</p>\r\n', '<p>dfgfdgdfg</p>\r\n', '0', 0, '2020-02-24', '0000-00-00'),
(21, 'test989898', '<p>sdfsdfdsfssdf</p>\r\n', '<p>sdfsdfsdfsd</p>\r\n', '0', 0, '2020-02-24', '2020-02-24'),
(22, 'Tclub01-Edit', '<p>Tclub01</p>\r\n', '<p>Tclub01</p>\r\n', '0', 0, '2020-03-04', '2020-03-04'),
(24, 'New log clubtested-Edit', '<p>New log club</p>\r\n', '<p>New log club</p>\r\n', '0', 0, '2020-03-05', '2020-03-05'),
(25, 'Clubnew mem-Edit', '<p>Clubnew mem</p>\r\n', '<p>Clubnew mem</p>\r\n', '0', 0, '2020-03-05', '2020-03-05'),
(26, 'T2222', '<p>tes</p>\r\n', '<p>test</p>\r\n', '0', 0, '2020-03-06', '2020-03-06');

-- --------------------------------------------------------

--
-- Table structure for table `master_role`
--

CREATE TABLE `master_role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1=ative,0=inactive',
  `is_delete` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL COMMENT 'user_id of user_master',
  `updated_on` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `master_role`
--

INSERT INTO `master_role` (`role_id`, `role_name`, `status`, `is_delete`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 'Admin', 1, 0, 1, '2019-11-21 00:00:00', 4, '2020-02-24 06:55:05'),
(16, 'Owner', 1, 0, 1, '2020-02-14 16:13:38', 4, '2020-02-24 07:28:44'),
(17, 'Front end manager', 1, 0, 1, '2020-02-14 17:02:27', NULL, NULL),
(18, 'General Manager', 1, 0, 1, '2020-02-14 19:12:44', NULL, NULL),
(19, 'Te005-Edit', 0, 0, 4, '2020-02-21 13:16:13', 4, '2020-02-21 07:46:33'),
(20, 'test995dssd-e', 1, 0, 4, '2020-02-24 12:23:29', 4, '2020-03-05 06:47:27'),
(21, 'Test444-edit', 0, 0, 8, '2020-03-04 19:36:07', 8, '2020-03-04 14:06:54'),
(22, 'Roltest11', 0, 0, 4, '2020-03-05 12:17:47', NULL, '2020-03-05 06:48:25'),
(23, 'rol334', 0, 0, 4, '2020-03-05 12:18:10', NULL, NULL),
(24, 'test111', 1, 0, 8, '2020-03-06 13:23:52', 8, '2020-03-06 07:54:51');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `movie_id` int(10) NOT NULL,
  `cafe_id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category_id` int(10) NOT NULL,
  `duration` varchar(10) NOT NULL,
  `status` int(10) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `movie_category`
--

CREATE TABLE `movie_category` (
  `category_id` int(10) NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `status` int(10) NOT NULL,
  `is_delete` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notification_id` int(11) NOT NULL,
  `member_id` tinyint(4) NOT NULL DEFAULT '0',
  `reservation_id` int(11) NOT NULL,
  `notification_title` varchar(255) NOT NULL,
  `notification_description` longtext NOT NULL,
  `admin_notification_details` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_on` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notification_id`, `member_id`, `reservation_id`, `notification_title`, `notification_description`, `admin_notification_details`, `status`, `created_on`, `update_on`) VALUES
(1, 1, 3, 'Reservation Confirmed', 'Your request for reservation is Confirmed.', 'Reservation pending', 1, '2020-02-21 10:14:41', NULL),
(2, 41, 15, 'Reservation Cancelled', 'Your request for reservation is cancelled on your request.Reason given - test.', '', 1, '2020-02-21 07:50:24', NULL),
(3, 41, 16, 'Reservation Cancelled', 'Your request for reservation is cancelled on your request.Reason given - test.', '', 1, '2020-02-21 14:48:33', NULL),
(4, 41, 14, 'Reservation Rejected', 'Sorry to say your request for reservation is rejected by fenicia due to ok.', '', 1, '2020-02-22 07:08:45', NULL),
(5, 45, 20, 'Reservation Confirmed', 'Your request for reservation is Confirmed.', '', 1, '2020-02-24 06:20:27', NULL),
(6, 1, 4, 'Reservation Confirmed', 'Your request for reservation is Confirmed.', '', 1, '2020-02-24 06:38:10', NULL),
(7, 1, 28, 'Reservation Pending', 'Reservation done,\n pending form admin.', 'Anup reservation request for Cabana 1 on 29/02/2020 at 05:30 PM is Pending', 1, '2020-02-27 10:57:51', NULL),
(8, 1, 0, 'Reservation Cancelled', 'Your request for reservation is cancelled.', '', 1, '2020-02-27 11:06:17', NULL),
(9, 1, 29, 'Reservation Pending', 'Reservation done,\n pending form admin.', 'Anup reservation request for Dome1 on 11/03/2020 at 05:45 PM is Pending', 1, '2020-02-27 11:11:24', NULL),
(10, 1, 0, 'Reservation Cancelled', 'Your request for reservation is cancelled.', '', 1, '2020-02-27 11:11:56', NULL),
(11, 1, 30, 'Reservation Pending', 'Reservation done,\n pending form admin.', 'Anup reservation request for Prego | Modern Fusion Dining Experience on 29/02/2020 at 06:45 PM is Pending', 1, '2020-02-27 11:15:03', NULL),
(12, 1, 0, 'Reservation Cancelled', 'Your request for reservation is cancelled.', '', 1, '2020-02-27 11:15:48', NULL),
(13, 94, 31, 'Reservation Pending', 'Reservation done,\n pending form admin.', 'Hariom reservation request for Cabana 2 on 11/03/2020 at 07:00 PM is Pending', 1, '2020-02-28 13:38:58', NULL),
(14, 2, 0, 'Buy membership', 'Your club membership is in pending status.', '', 1, '2020-03-02 08:02:13', NULL),
(15, 2, 33, 'Reservation Confirmed', 'Your request for reservation is Confirmed.', 'Hariom reservation request for Dome1 on 05/03/2020 at 03:45 PM is Pending', 1, '2020-03-02 08:07:43', NULL),
(16, 1, 34, 'Reservation Pending', 'Reservation done,\n pending form admin.', 'Anup reservation request for Prego | Modern Fusion Dining Experience on 26/03/2020 at 03:45 PM is Pending', 1, '2020-03-02 08:45:15', NULL),
(17, 1, 35, 'Reservation Pending', 'Reservation done,\n pending form admin.', 'Anup reservation request for Mist | Rooftop Bar and Restaurant on 17/03/2020 at 06:00 PM is Pending', 1, '2020-03-02 08:57:02', NULL),
(18, 2, 36, 'Reservation Pending', 'Reservation done,\n pending form admin.', 'Hari reservation request for Dome2 on 07/03/2020 at 02:30 PM is Pending', 1, '2020-03-02 09:07:56', NULL),
(19, 1, 37, 'Reservation Pending', 'Reservation done,\n pending form admin.', 'Anup reservation request for Dome2 on 18/03/2020 at 04:15 PM is Pending', 1, '2020-03-02 09:16:42', NULL),
(20, 1, 38, 'Reservation Pending', 'Reservation done,\n pending form admin.', 'Anup reservation request for VIP Dome on 19/03/2020 at 04:15 PM is Pending', 1, '2020-03-02 09:23:27', NULL),
(21, 2, 39, 'Reservation Pending', 'Reservation done,\n pending form admin.', 'Hariom reservation request for Dome3 on 05/03/2020 at 03:00 PM is Pending', 1, '2020-03-02 09:27:35', NULL),
(22, 2, 42, 'Reservation Confirmed', 'Your request for reservation is Confirmed.', 'Hariom reservation request for Bed Lounge3 on 27/03/2020 at 03:00 PM is Pending', 1, '2020-03-02 09:38:45', NULL),
(23, 2, 43, 'Reservation Cancelled', 'Your request for reservation is cancelled on your request.Reason given - tests.', 'RAJM reservation request for Celebrity Cabana on 30/06/2020 at 10:15 PM is Pending', 1, '2020-03-02 09:48:24', NULL),
(24, 1, 46, 'Reservation Pending', 'Reservation done,\n pending form admin.', 'Anup reservation request for Mist | Rooftop Bar and Restaurant on 25/03/2020 at 05:00 PM is Pending', 1, '2020-03-02 10:00:14', NULL),
(25, 1, 48, 'Reservation Confirmed', 'Your request for reservation is Confirmed.', 'Anup reservation request for Prego | Modern Fusion Dining Experience on 31/03/2020 at 05:00 PM is Pending', 1, '2020-03-02 10:58:02', NULL),
(26, 2, 0, 'Buy membership', 'Your club membership is in pending status.', '', 1, '2020-03-02 10:14:43', NULL),
(27, 2, 0, 'Buy membership', 'Your club membership is in pending status.', '', 1, '2020-03-02 10:16:04', NULL),
(28, 2, 0, 'Reservation Cancelled', 'Your request for reservation is cancelled.', '', 1, '2020-03-02 10:22:52', NULL),
(29, 2, 0, 'Reservation Cancelled', 'Your request for reservation is cancelled.', '', 1, '2020-03-02 10:58:46', NULL),
(30, 2, 49, 'Reservation Pending', 'Reservation done,\n pending form admin.', 'hshhshejwueueiiMmanNae338934848484848484 reservation request for VIP Dome on 31/08/2020 at 04:30 PM is Pending', 1, '2020-03-02 11:03:09', NULL),
(31, 2, 0, 'Reservation Cancelled', 'Your request for reservation is cancelled.', '', 1, '2020-03-02 11:07:06', NULL),
(32, 2, 50, 'Reservation Pending', 'Reservation done,\n pending form admin.', 'Hariomshdhdheueueueueeueiieeieieie3i reservation request for Cabana 4 on 05/03/2020 at 04:30 PM is Pending', 1, '2020-03-02 11:11:18', NULL),
(33, 2, 0, 'Reservation Cancelled', 'Your request for reservation is cancelled.', '', 1, '2020-03-02 11:11:53', NULL),
(34, 2, 51, 'Reservation Pending', 'Reservation done,\n pending form admin.', 'Kat55 reservation request for Dome2 on 05/03/2020 at 05:15 PM is Pending', 1, '2020-03-02 11:51:03', NULL),
(35, 1, 0, 'Buy membership', 'Your club membership is in pending status.', '', 1, '2020-03-02 13:09:49', NULL),
(36, 97, 0, 'Buy membership', 'Your club membership is in pending status.', '', 1, '2020-03-02 13:14:28', NULL),
(37, 98, 0, 'Buy membership', 'Your club membership is in pending status.', '', 1, '2020-03-02 14:10:05', NULL),
(38, 1, 55, 'Reservation Pending', 'Reservation done,\n pending form admin.', 'Anup reservation request for Mist | Rooftop Bar and Restaurant on 10/03/2020 at 04:00 PM is Pending', 1, '2020-03-03 09:05:46', NULL),
(39, 1, 56, 'Reservation Pending', 'Reservation done,\n pending form admin.', 'Anup reservation request for Prego | Modern Fusion Dining Experience on 19/03/2020 at 04:30 PM is Pending', 1, '2020-03-03 09:27:29', NULL),
(40, 1, 57, 'Reservation Pending', 'Reservation done,\n pending form admin.', 'Anup reservation request for Prego | Modern Fusion Dining Experience on 11/03/2020 at 06:30 PM is Pending', 1, '2020-03-03 09:32:06', NULL),
(41, 1, 58, 'Reservation Pending', 'Reservation done,\n pending form admin.', 'Anup reservation request for Prego | Modern Fusion Dining Experience on 18/03/2020 at 06:30 PM is Pending', 1, '2020-03-03 09:36:32', NULL),
(42, 2, 59, 'Reservation Pending', 'Reservation done,\n pending form admin.', 'Kat55uu reservation request for Dome1 on 05/03/2020 at 03:45 PM is Pending', 1, '2020-03-03 10:07:40', NULL),
(43, 1, 60, 'Reservation Pending', 'Reservation done,\n pending form admin.', 'Anup reservation request for Prego | Modern Fusion Dining Experience on 18/03/2020 at 05:00 PM is Pending', 1, '2020-03-03 10:11:16', NULL),
(44, 1, 61, 'Reservation Pending', 'Reservation done,\n pending form admin.', 'Anup reservation request for Prego | Modern Fusion Dining Experience on 25/03/2020 at 05:15 PM is Pending', 1, '2020-03-03 10:16:04', NULL),
(45, 1, 62, 'Reservation Pending', 'Reservation done,\n pending form admin.', 'Anup reservation request for Prego | Modern Fusion Dining Experience on 19/03/2020 at 05:15 PM is Pending', 1, '2020-03-03 10:18:35', NULL),
(46, 1, 63, 'Reservation Pending', 'Reservation done,\n pending form admin.', 'Anup reservation request for Prego | Modern Fusion Dining Experience on 20/03/2020 at 05:15 PM is Pending', 1, '2020-03-03 10:25:12', NULL),
(47, 100, 64, 'Reservation Pending', 'Reservation done,\n pending form admin.', 'Hariom reservation request for VIP Dome on 06/03/2020 at 04:00 PM is Pending', 1, '2020-03-03 10:31:41', NULL),
(48, 1, 65, 'Reservation Pending', 'Reservation done,\n pending form admin.', 'Anup reservation request for Prego | Modern Fusion Dining Experience on 18/03/2020 at 05:30 PM is Pending', 1, '2020-03-03 10:33:05', NULL),
(49, 101, 0, 'Buy membership', 'Your club membership is in pending status.', '', 1, '2020-03-03 10:41:33', NULL),
(50, 101, 66, 'Reservation Cancelled', 'Your request for reservation is cancelled on your request.Reason given - test.', 'Hariom reservation request for Dome1 on 06/03/2020 at 04:15 PM is Pending', 1, '2020-03-03 10:48:57', NULL),
(51, 1, 67, 'Reservation Confirmed', 'Your request for reservation is Confirmed.', 'Anup reservation request for Prego | Modern Fusion Dining Experience on 16/03/2020 at 08:45 PM is Pending', 1, '2020-03-04 11:10:10', NULL),
(52, 101, 68, 'Reservation Confirmed', 'Your request for reservation is Confirmed.', 'Hariom reservation request for Dome2 on 05/03/2020 at 04:30 PM is Pending', 1, '2020-03-05 06:16:58', NULL),
(53, 102, 69, 'Reservation Pending', 'Reservation done,\n pending form admin.', 'Sagar reservation request for Prego | Modern Fusion Dining Experience on 12/03/2020 at 04:30 PM is Pending', 1, '2020-03-03 11:02:29', NULL),
(54, 101, 70, 'Reservation Pending', 'Reservation done,\n pending form admin.', 'Hariom reservation request for Dome2 on 06/03/2020 at 04:30 PM is Pending', 1, '2020-03-03 11:04:02', NULL),
(55, 102, 71, 'Reservation No-show', 'Sorry to say your request for reservation is No-show by fenicia due to .', 'Sagar reservation request for Mist | Rooftop Bar and Restaurant on 18/03/2020 at 06:30 PM is Pending', 1, '2020-03-05 05:58:35', NULL),
(56, 101, 0, 'Reservation Cancelled', 'Your request for reservation is cancelled.', '', 1, '2020-03-03 11:06:34', NULL),
(57, 101, 72, 'Reservation Confirmed', 'Your request for reservation is Confirmed.', 'Hariom reservation request for Cabana 1 on 07/03/2020 at 04:45 PM is Pending', 1, '2020-03-03 11:09:16', NULL),
(58, 102, 73, 'Reservation Confirmed', 'Your request for reservation is Confirmed.', 'Sagar reservation request for Mist | Rooftop Bar and Restaurant on 16/03/2020 at 06:30 PM is Pending', 1, '2020-03-04 08:16:35', NULL),
(59, 102, 74, 'Reservation Cancelled', 'Your request for reservation is cancelled on your request.Reason given - test.', 'Sagar reservation request for Prego | Modern Fusion Dining Experience on 18/03/2020 at 06:45 PM is Pending', 1, '2020-03-04 08:16:16', NULL),
(60, 9, 75, 'Reservation Confirmed', 'Your request for reservation is Confirmed.', 'Akansha reservation request for VIP Dome on 05/03/2020 at 05:00 PM is Pending', 1, '2020-03-03 11:37:51', NULL),
(61, 9, 0, 'Buy membership', 'Your club membership is in pending status.', '', 1, '2020-03-03 11:38:30', NULL),
(62, 9, 76, 'Reservation Pending', 'Reservation done,\n pending from admin.', 'Akansha reservation request for Cabana 4 on 05/03/2020 at 06:30 PM is Pending', 1, '2020-03-03 12:08:18', NULL),
(63, 9, 0, 'Reservation Cancelled', 'Your request for reservation is cancelled.', '', 1, '2020-03-03 12:10:04', NULL),
(64, 78, 79, 'Reservation Cancelled', 'Your request for reservation is cancelled on your request.Reason given - .', '', 1, '2020-03-05 06:06:11', NULL),
(65, 90, 80, 'Reservation Confirmed', 'Your request for reservation is Confirmed.', '', 1, '2020-03-05 06:16:21', NULL),
(66, 87, 85, 'Reservation No-show', 'Sorry to say your request for reservation is No-show by fenicia due to .', '', 1, '2020-03-05 10:25:53', NULL),
(67, 89, 84, 'Reservation No-show', 'Sorry to say your request for reservation is No-show by fenicia due to no.', '', 1, '2020-03-05 12:49:14', NULL),
(68, 87, 86, 'Reservation No-show', 'Sorry to say your request for reservation is No-show by fenicia due to test.', '', 1, '2020-03-06 07:35:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `package_benefits`
--

CREATE TABLE `package_benefits` (
  `package_benefit_id` int(11) NOT NULL,
  `benefit_name` varchar(255) NOT NULL,
  `benefit_description` longtext NOT NULL,
  `status` int(11) NOT NULL,
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `created_on` date NOT NULL,
  `modified_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package_benefits`
--

INSERT INTO `package_benefits` (`package_benefit_id`, `benefit_name`, `benefit_description`, `status`, `is_delete`, `created_on`, `modified_on`) VALUES
(1, 'Club Fenicia', '<p>> 20% discount on food bill at Club Fenicia</p>\r\n\r\n<p>> 20% discount on all alcoholic and non-alcoholic beverages at Club Fenicia</p>\r\n\r\n<p>> 20% discount on Pastry Shop</p>\r\n\r\n<p>> One Complimentary Designer Cake of 2 pounds on any event hosted by the member like engagement, birthday, baby shower or cocktail party.</p>\r\n\r\n<p>> 15% discount on the rack rates for a booking of minimum 50 people at Velvet Banquet.</p>\r\n\r\n<p>> 10% discount on Premium Cigars</p>\r\n\r\n<p>> Exclusive access to Private Members Zone</p>\r\n\r\n<p>> Exclusive access to Members Only Events</p>\r\n', 1, 0, '2019-11-29', '2020-01-29'),
(2, 'Avahan Spa', '<p>> 20% discount on body therapies and treatment when member/along with guests avails at Avahan Spa</p>\r\n', 0, 0, '2019-12-02', '2020-01-29'),
(3, 'One Sports Lounge', '<p>> 20% discount on food bill at One Sports Lounge</p>\r\n\r\n<p>> 20% discount on all alcoholic and non-alcoholic beverages at One Sports Lounge</p>\r\n\r\n<p>> One Complimentary Designer Cake of 2 pounds on any event hosted by the member like engagement, birthday, baby shower or cocktail party.</p>\r\n\r\n<p>> 15% discount on the rack rates for a booking of minimum 25 people at One Sports Lounge.</p>\r\n\r\n<p>> Exclusive access to Private Members Zone</p>\r\n\r\n<p>> Exclusive access to Members Only Events</p>\r\n', 0, 0, '2019-12-16', '2020-01-29'),
(14, 'Pind Punjabi Restaurant', '<p>> 20% discount on food bill when member and his guests dine at Pind Punjabi Restaurant</p>\r\n\r\n<p>> 20% discount on food bill when member takes delivery from Pind Punjabi Restaurant</p>\r\n\r\n<p>> Exclusive access to Members Only Event</p>\r\n', 1, 0, '2020-01-02', '2020-01-30'),
(16, 'Test M001-Edit', '<p>Test M001-Edit</p>\r\n', 0, 1, '2020-01-29', '2020-01-29'),
(17, 'Demop99-Edit', '<p>Demop99</p>\r\n', 0, 1, '2020-01-30', '2020-01-30'),
(18, 'Terms and Conditions', '<p>> Your membership is valid for 12 months from the date of issuance of the membership. The introductory membership fee is Rs. 25000, allowing you to avail benefits worth Rs. 50,000.</p>\r\n\r\n<p>> The membership card is not transferable. The membership card and the gift vouchers have no cash value and cannot be traded. Lost or misplaced cards shall not be replaced</p>\r\n\r\n<p>> Benefits and Gift Vouchers can only availed upon presentation of your valid Fenicia Club Membership Card. The value of the specific discount does not include taxes.</p>\r\n\r\n<p>> All certificates are for one time use only and need to be surrendered to avail the benefit</p>\r\n\r\n<p>> All membership benefits may not be available on Christmas, New Year’s, Special Promotions or any day as decided by the Club.</p>\r\n\r\n<p>> The liability of the company is limited to the amount paid.</p>\r\n\r\n<p>> Management reserves the right to change the terms of membership from time to time without any prior notice.</p>', 0, 0, '2020-01-31', '0000-00-00'),
(19, 'T001T-Edit', '<p>T001T-Edit</p>\r\n', 1, 0, '2020-02-21', '2020-02-21'),
(20, 't3434a-Ei', '<p>t3434a</p>\r\n', 0, 0, '2020-02-24', '2020-02-24'),
(21, 'm9898-Edit', '<p>m9898</p>\r\n', 0, 0, '2020-02-24', '2020-02-24'),
(22, 'Testmem', '<p>Testmem</p>\r\n', 1, 0, '2020-03-04', '2020-03-05'),
(23, 'Bevoucher', '<p>Bevoucher</p>', 0, 0, '2020-03-05', '0000-00-00'),
(24, 'lt001', '<p>lt001</p>\r\n', 1, 0, '2020-03-06', '2020-03-06');

-- --------------------------------------------------------

--
-- Table structure for table `package_benefits_mapping`
--

CREATE TABLE `package_benefits_mapping` (
  `package_benefits_mapping_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `package_benefit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package_benefits_mapping`
--

INSERT INTO `package_benefits_mapping` (`package_benefits_mapping_id`, `package_id`, `package_benefit_id`) VALUES
(111, 20, 1),
(115, 21, 2),
(116, 21, 18),
(118, 22, 1),
(124, 24, 1),
(125, 24, 21),
(137, 25, 14),
(139, 26, 3),
(140, 1, 1),
(141, 1, 14);

-- --------------------------------------------------------

--
-- Table structure for table `package_images`
--

CREATE TABLE `package_images` (
  `package_img_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `images` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package_images`
--

INSERT INTO `package_images` (`package_img_id`, `package_id`, `images`) VALUES
(4, 1, 'ic_membership_logo1.png'),
(5, 1, 'ic_one1.png'),
(6, 1, 'ic_spa1.png'),
(18, 25, '230616566.jpg'),
(19, 25, '230616571.jpg'),
(20, 25, '230616627.jpg'),
(21, 25, 'ccujw-lobby-0002-hor-feat.jpg'),
(23, 25, 'cocktails.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `package_membership_mapping`
--

CREATE TABLE `package_membership_mapping` (
  `package_membership_mapping_id` int(11) NOT NULL,
  `membership_id` varchar(255) DEFAULT NULL,
  `package_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL COMMENT 'who avail the package',
  `package_price_id` int(11) NOT NULL,
  `added_from` enum('admin','front') NOT NULL,
  `buy_on` date NOT NULL,
  `expiry_date` date NOT NULL DEFAULT '0000-00-00',
  `status` int(11) NOT NULL COMMENT '0=>package expired,''1''=>not expired'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package_membership_mapping`
--

INSERT INTO `package_membership_mapping` (`package_membership_mapping_id`, `membership_id`, `package_id`, `member_id`, `package_price_id`, `added_from`, `buy_on`, `expiry_date`, `status`) VALUES
(1, 'test678', 1, 21, 68, 'admin', '2020-02-11', '2021-02-11', 1),
(2, '56tr', 1, 12, 68, 'admin', '2020-02-11', '2021-02-11', 1),
(3, 'fd353', 1, 35, 68, 'admin', '2020-02-11', '2021-02-11', 0),
(4, 'fd353', 1, 35, 68, 'admin', '2020-02-11', '2021-02-11', 0),
(5, 'fd353', 1, 35, 68, 'admin', '2020-02-11', '2021-02-11', 0),
(6, 'fd353', 1, 35, 68, 'admin', '2020-02-11', '2021-02-11', 0),
(7, 'fd353', 1, 35, 68, 'admin', '2020-02-11', '2021-02-11', 1),
(9, NULL, 1, 10, 69, 'front', '2020-02-11', '2021-02-11', 0),
(10, 'club001', 1, 10, 69, 'admin', '2020-02-11', '2021-02-11', 0),
(11, 'club001', 1, 10, 69, 'admin', '2020-02-11', '2021-02-11', 0),
(12, 'club001', 1, 10, 69, 'admin', '2020-02-11', '2021-02-11', 0),
(13, 'club001', 1, 10, 69, 'admin', '2020-02-11', '2021-02-11', 0),
(14, NULL, 1, 1, 69, 'front', '2020-02-11', '2021-02-11', 0),
(15, 'club001', 1, 10, 69, 'admin', '2020-02-11', '2021-02-11', 0),
(16, 'fenicia22', 1, 1, 69, 'admin', '2020-02-11', '2021-02-11', 0),
(17, 'club001', 1, 10, 70, 'admin', '2020-02-11', '2021-02-11', 1),
(18, 'Fenicia123', 1, 43, 70, 'admin', '2020-02-12', '2021-02-12', 1),
(21, '5454', 1, 51, 72, 'admin', '2020-02-21', '2021-02-21', 1),
(22, '545498', 1, 60, 72, 'admin', '2020-02-21', '2021-02-21', 0),
(23, '545498', 1, 60, 72, 'admin', '2020-02-21', '2021-02-21', 1),
(24, '3434', 1, 65, 73, 'admin', '2020-02-24', '2021-02-24', 1),
(25, NULL, 1, 2, 73, 'front', '2020-03-02', '2021-03-02', 0),
(26, NULL, 1, 2, 73, 'front', '2020-03-02', '2021-03-02', 0),
(27, NULL, 1, 2, 73, 'front', '2020-03-02', '2021-03-02', 0),
(28, NULL, 1, 1, 73, 'front', '2020-03-02', '2021-03-02', 0),
(29, NULL, 1, 97, 73, 'front', '2020-03-02', '2021-03-02', 1),
(32, 'testtest12312344', 1, 1, 73, 'admin', '2020-03-03', '2021-03-03', 1),
(33, 'm0h01', 1, 2, 73, 'admin', '2020-03-03', '2021-03-03', 0),
(34, '5454ddd', 1, 2, 73, 'admin', '2020-03-03', '2021-03-03', 1),
(35, NULL, 1, 101, 73, 'front', '2020-03-03', '2021-03-03', 0),
(36, 'MD6767', 1, 101, 73, 'admin', '2020-03-03', '2021-03-03', 1),
(39, '5454aaaa', 1, 107, 73, 'admin', '2020-03-04', '2021-03-04', 0),
(40, '5454aaaa', 1, 107, 73, 'admin', '2020-03-05', '2021-03-05', 0),
(41, '5454aaaa', 1, 107, 73, 'admin', '2020-03-05', '2021-03-05', 0),
(42, '5454aaaa', 1, 107, 73, 'admin', '2020-03-05', '2021-03-05', 1),
(43, '5454dddd2222', 1, 110, 94, 'admin', '2020-03-06', '2021-03-06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `package_membership_transaction`
--

CREATE TABLE `package_membership_transaction` (
  `pkage_transaction_id` int(11) NOT NULL,
  `added_form` enum('admin','front') NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `package_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_mode` varchar(200) DEFAULT NULL,
  `payment_status` enum('0','1','2') NOT NULL DEFAULT '0' COMMENT '0->pending, 1->success, 2->failure',
  `transaction_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `package_membership_transaction`
--

INSERT INTO `package_membership_transaction` (`pkage_transaction_id`, `added_form`, `transaction_id`, `package_id`, `member_id`, `amount`, `payment_mode`, `payment_status`, `transaction_date`) VALUES
(1, 'admin', 'RO5kXl', 1, 21, '25000.00', NULL, '1', '2020-02-11'),
(2, 'admin', 'apr4OV', 1, 12, '25000.00', NULL, '1', '2020-02-11'),
(3, 'admin', 'GaKRP4', 1, 35, '25000.00', NULL, '1', '2020-02-11'),
(4, 'admin', 'sUlxvV', 1, 35, '25000.00', NULL, '1', '2020-02-11'),
(5, 'admin', 'KTfyGd', 1, 35, '25000.00', NULL, '1', '2020-02-11'),
(6, 'admin', 'UeU0Ib', 1, 35, '25000.00', NULL, '1', '2020-02-11'),
(7, 'admin', 'YKfcqc', 1, 35, '25000.00', NULL, '1', '2020-02-11'),
(9, 'front', '15814316759339830576623', 1, 10, '10.00', 'PayUMoney', '1', '2020-02-11'),
(10, 'admin', 'VX36Ag', 1, 10, '10.00', NULL, '1', '2020-02-11'),
(11, 'admin', 'z4ig2d', 1, 10, '10.00', NULL, '1', '2020-02-11'),
(12, 'admin', 'Ts3Mba', 1, 10, '10.00', NULL, '1', '2020-02-11'),
(13, 'admin', '27dZAD', 1, 10, '10.00', NULL, '1', '2020-02-11'),
(14, 'front', '15814326271337278343556', 1, 1, '10.00', 'PayUMoney', '1', '2020-02-11'),
(15, 'admin', 'XZ2NPV', 1, 10, '10.00', NULL, '1', '2020-02-11'),
(16, 'admin', 'uiL5zm', 1, 1, '10.00', NULL, '1', '2020-02-11'),
(17, 'admin', 'BtW0cC', 1, 10, '25000.00', NULL, '1', '2020-02-11'),
(18, 'admin', 'qQqr8e', 1, 43, '25000.00', NULL, '1', '2020-02-12'),
(21, 'admin', 'SkIiSq', 1, 51, '25000.00', NULL, '1', '2020-02-21'),
(22, 'admin', 'SW3lbU', 1, 60, '25000.00', NULL, '1', '2020-02-21'),
(23, 'admin', 'dNTVeh', 1, 60, '25000.00', NULL, '1', '2020-02-21'),
(24, 'admin', 'ydTjk0', 1, 65, '25000.00', NULL, '1', '2020-02-24'),
(25, 'front', '15831358745549163839086', 1, 2, '25000.00', 'PayUMoney', '1', '2020-03-02'),
(26, 'front', '15831439039559163839086', 1, 2, '25000.00', 'PayUMoney', '1', '2020-03-02'),
(27, 'front', '15831439926929163839086', 1, 2, '25000.00', 'PayUMoney', '1', '2020-03-02'),
(28, 'front', '15831544320279007218463', 1, 1, '25000.00', 'PayUMoney', '1', '2020-03-02'),
(29, 'front', '15831547242139007218488', 1, 97, '25000.00', 'PayUMoney', '1', '2020-03-02'),
(32, 'admin', 'J8cv8m', 1, 1, '25000.00', NULL, '1', '2020-03-03'),
(33, 'admin', 'KT6Qn6', 1, 2, '25000.00', NULL, '1', '2020-03-03'),
(34, 'admin', 's0YGHR', 1, 2, '25000.00', NULL, '1', '2020-03-03'),
(35, 'front', '15832319238167278343556', 1, 101, '25000.00', 'PayUMoney', '1', '2020-03-03'),
(36, 'admin', 'Np2uAW', 1, 101, '25000.00', NULL, '1', '2020-03-03'),
(39, 'admin', 'cUBrIk', 1, 107, '25000.00', NULL, '1', '2020-03-04'),
(40, 'admin', 'swfXRR', 1, 107, '25000.00', NULL, '1', '2020-03-05'),
(41, 'admin', '7WzKIe', 1, 107, '25000.00', NULL, '1', '2020-03-05'),
(42, 'admin', 'rkfRZq', 1, 107, '25000.00', NULL, '1', '2020-03-05'),
(43, 'admin', 'cfRYGS', 1, 110, '25000.00', NULL, '1', '2020-03-06');

-- --------------------------------------------------------

--
-- Table structure for table `package_price_mapping`
--

CREATE TABLE `package_price_mapping` (
  `package_price_mapping_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `package_type_id` int(11) NOT NULL,
  `price` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package_price_mapping`
--

INSERT INTO `package_price_mapping` (`package_price_mapping_id`, `package_id`, `package_type_id`, `price`) VALUES
(74, 20, 1, 456.00),
(77, 21, 1, 8958.00),
(79, 22, 1, 100.00),
(84, 24, 1, 120.00),
(91, 25, 1, 1000.00),
(93, 26, 2, 123.00),
(94, 1, 1, 25000.00);

-- --------------------------------------------------------

--
-- Table structure for table `package_type`
--

CREATE TABLE `package_type` (
  `package_type_id` int(11) NOT NULL,
  `package_type_name` varchar(255) NOT NULL,
  `no_of_months` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package_type`
--

INSERT INTO `package_type` (`package_type_id`, `package_type_name`, `no_of_months`) VALUES
(1, 'Yearly', 12),
(2, 'Monthly', 1);

-- --------------------------------------------------------

--
-- Table structure for table `package_vouchers`
--

CREATE TABLE `package_vouchers` (
  `package_voucher_id` int(11) NOT NULL,
  `voucher_name` varchar(255) NOT NULL,
  `voucher_description` longtext NOT NULL,
  `status` int(11) NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_on` date NOT NULL,
  `modified_on` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package_vouchers`
--

INSERT INTO `package_vouchers` (`package_voucher_id`, `voucher_name`, `voucher_description`, `status`, `is_delete`, `created_on`, `modified_on`) VALUES
(1, 'Club Fenicia', '<p>> 1 No. Complimentary Single Hookah Voucher for Club Fenicia worth Rs.3500</p>\r\n', 1, '0', '2019-11-29', '2020-01-29'),
(2, 'One Sports Lounge', '<p>> 1 No. Redeemable Voucher on Food, Beverage and Shisha at One Sports Lounge worth Rs. 1000</p>\r\n\r\n<p>> 1 No. Redeemable Voucher on Food, Beverage and Shisha at One Sports Lounge worth Rs. 1000</p>\r\n', 1, '0', '2019-11-29', '2020-01-29'),
(4, 'Avahan Spa', '<p>> 1 No. Redeemable Voucher on Body Therapy and Treatments at Avahan Spa worth Rs. 4000</p>\r\n\r\n<p>> 1 No. Redeemable Voucher on Body Therapy and Treatments at Avahan Spa worth Rs. 4000</p>\r\n\r\n<p>> 1 No. Redeemable Voucher on Body Therapy and Treatments at Avahan Spa worth Rs. 4000</p>\r\n', 1, '0', '2019-12-18', '2020-01-29'),
(8, 'Usable at All Venues', '<p>> 1 No. Redeemable Voucher on Food and Beverage at Club Fencia/OSL/Pind Punjabi Restaurant worth Rs. 5000 on successful conversion of single member referral.</p>\r\n', 1, '0', '2019-12-20', '2020-01-29'),
(9, 'Pind Punjabi Restaurant', '<p>> 1 No. Redeemable Voucher on Food at Pind Punjabi Restaurant worth Rs. 500</p>\r\n\r\n<p>> 1 No. Redeemable Voucher on Food at Pind Punjabi Restaurant worth Rs. 500</p>\r\n', 1, '0', '2020-01-02', '2020-01-29'),
(11, 'Terms and Conditions', '<p>> Your membership is valid for 12 months from the date of issuance of the membership. The introductory membership fee is Rs. 25000, allowing you to avail benefits worth Rs. 50,000.</p>\r\n\r\n<p>> The membership card is not transferable. The membership card and the gift vouchers have no cash value and cannot be traded. Lost or misplaced cards shall not be replaced</p>\r\n\r\n<p>> Benefits and Gift Vouchers can only availed upon presentation of your valid Fenicia Club Membership Card. The value of the specific discount does not include taxes.</p>\r\n\r\n<p>> All certificates are for one time use only and need to be surrendered to avail the benefit</p>\r\n\r\n<p>> All membership benefits may not be available on Christmas, New Year’s, Special Promotions or any day as decided by the Club.</p>\r\n\r\n<p>> The liability of the company is limited to the amount paid.</p>\r\n\r\n<p>> Management reserves the right to change the terms of membership from time to time without any prior notice.</p>\r\n', 1, '0', '2020-01-29', '2020-01-30'),
(14, 't00333', '<p>t00333</p>\r\n', 0, '0', '2020-02-21', '2020-02-21'),
(15, 'vt001-Edit', '<p>vt001</p>\r\n', 0, '0', '2020-02-21', '2020-02-21'),
(16, 't0001-Edit', '<p>t0001</p>\r\n', 1, '0', '2020-02-24', '2020-02-24'),
(17, 'v001te-Edit', '<p>v001te</p>\r\n', 1, '0', '2020-02-24', '2020-02-24'),
(18, 'Test001', '<p>Test001</p>\r\n', 1, '0', '2020-02-24', '0000-00-00'),
(19, 'Testvou', '<p>Testvou</p>\r\n', 1, '0', '2020-03-04', '0000-00-00'),
(20, 'Testvou2-Edit', '<p>Testvou2</p>\r\n', 1, '0', '2020-03-04', '2020-03-05'),
(21, 'testagain', '<p>test</p>\r\n', 1, '0', '2020-03-05', '0000-00-00'),
(22, 'test00sddsd', '<p>test00sddsd</p>\r\n', 1, '0', '2020-03-05', '2020-03-05'),
(23, 'lh001', '<p>lh001</p>\r\n', 1, '0', '2020-03-06', '2020-03-06');

-- --------------------------------------------------------

--
-- Table structure for table `package_vouchers_mapping`
--

CREATE TABLE `package_vouchers_mapping` (
  `package_voucher_mapping_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `package_voucher_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package_vouchers_mapping`
--

INSERT INTO `package_vouchers_mapping` (`package_voucher_mapping_id`, `package_id`, `package_voucher_id`) VALUES
(119, 20, 1),
(120, 20, 9),
(123, 21, 9),
(125, 22, 2),
(130, 24, 1),
(147, 25, 2),
(149, 26, 1),
(150, 1, 1),
(151, 1, 2),
(152, 1, 4),
(153, 1, 8),
(154, 1, 9),
(155, 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reservation_id` int(11) NOT NULL,
  `add_from` enum('admin','front') NOT NULL,
  `reservation_for` enum('My self','Someone else') NOT NULL,
  `member_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `country_code` varchar(200) DEFAULT NULL,
  `member_mobile` varchar(255) DEFAULT NULL,
  `reservation_date` date NOT NULL,
  `reservation_time` time NOT NULL,
  `zone_id` varchar(255) NOT NULL,
  `zone_price_type` varchar(255) NOT NULL,
  `zone_price` bigint(20) NOT NULL,
  `no_of_guests` int(11) NOT NULL,
  `message` longtext,
  `reservation_type` varchar(200) DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0=>canceled 1=>pending 2=>reserved 3=>rejected',
  `check_in_out_status` int(11) DEFAULT NULL COMMENT '0=>checkout,1=> checkin',
  `checkin_datetime` varchar(255) NOT NULL,
  `checkout_datetime` varchar(200) NOT NULL,
  `cancellation_reason` longtext COMMENT 'cancellation or rejection',
  `created_by` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_on` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reservation_id`, `add_from`, `reservation_for`, `member_id`, `first_name`, `last_name`, `email`, `country_code`, `member_mobile`, `reservation_date`, `reservation_time`, `zone_id`, `zone_price_type`, `zone_price`, `no_of_guests`, `message`, `reservation_type`, `status`, `check_in_out_status`, `checkin_datetime`, `checkout_datetime`, `cancellation_reason`, `created_by`, `created_on`, `updated_by`, `updated_on`) VALUES
(1, 'front', 'My self', 10, 'Arindam', 'Dutta', 'arindamdutta.in@gmail.com', '91', '9830576623', '2020-02-13', '14:07:00', '3', 'cover', 10, 3, '', '', 0, 2, '0000-00-00', '', 'test', 10, '2020-02-11', NULL, NULL),
(2, 'admin', 'My self', 12, 'Piyu', 'Dutta', 'hariom.sharan-kt70@met-technologies.com', '91', '1004856161', '2020-02-14', '17:00:00', '3', 'cover', 1000, 3, 'SAD', '', 2, 2, '0000-00-00', '', 'ok', 1, '2020-02-11', NULL, NULL),
(3, 'front', 'My self', 1, 'Gabrial', 'Brown', 'gabrial@test.com', '91', '2004856161', '2020-02-13', '14:00:00', '3', 'cover', 10, 1, 'Decorate the table For Birthday', '', 2, 2, '0000-00-00', '', NULL, 1, '2020-02-11', NULL, NULL),
(4, 'front', 'My self', 1, 'Gabrial', 'Brown', 'gabrial@test.com', '91', '3334856161', '2020-02-13', '14:00:00', '3', 'cover', 10, 1, 'Decorate the table For Birthday', '', 2, 2, '0000-00-00', '', NULL, 1, '2020-02-11', NULL, NULL),
(5, 'front', 'My self', 15, 'Shyam', 'Bhaiya', 'sharad210@gmail.com', '91', '9830233006', '2020-02-13', '14:20:00', '3', 'cover', 10, 2, '', '', 0, 2, '0000-00-00', '', 'OK ', 15, '2020-02-11', 15, '2020-02-11'),
(6, 'front', 'My self', 1, 'Anup', 'Bora', 'anupkumar.bora@met-technologies.com', '91', '7278343556', '2020-02-14', '21:56:00', '3', 'cover', 1000, 3, '', '', 2, 2, '0000-00-00', '', NULL, 1, '2020-02-11', NULL, NULL),
(7, 'front', 'My self', 1, 'Anup', 'Bora', 'anupkumar.bora@met-technologies.com', '91', '7278343556', '2020-02-15', '22:00:00', '11', 'cover', 1000, 2, '', '', 0, 2, '0000-00-00', '', 'test', 1, '2020-02-11', 1, '2020-02-13'),
(8, 'front', 'My self', 55, 'Gabrial', 'Brown', 'gabrial@test.com', '91', '4004856161', '2020-03-13', '14:00:00', '3', 'cover', 1000, 1, 'Decorate the table For Birthday', '', 0, 2, '0000-00-00', '', 'vcb', 55, '2020-02-12', NULL, NULL),
(9, 'admin', 'Someone else', 0, 'test', 'test', 'test@yopmail.com', '91', '1234567890', '2020-02-15', '18:00:00', '6', 'cover', 5000, 5, 'ok', '', 0, 2, '0000-00-00', '', 'hghj', 1, '2020-02-13', NULL, NULL),
(10, 'front', 'My self', 1, 'Anup', 'Bora', 'anupkumar.bora@met-technologies.com', '91', '7278343556', '2020-02-26', '21:06:00', '3', 'cover', 1000, 2, '', '', 0, 2, '0000-00-00', '', 'cbfd', 1, '2020-02-17', 1, '2020-02-17'),
(11, 'front', 'My self', 1, 'Anup', 'Bora', 'anupkumar.bora@met-technologies.com', '91', '7278343556', '2020-02-27', '12:28:00', '3', 'cover', 1000, 2, '', '', 0, 2, '0000-00-00', '', 'dhdbbd', 1, '2020-02-18', 1, '2020-02-18'),
(12, 'admin', 'My self', 41, 'Hariom', 'Sharan', 'hariom.sharan+an50@met-technologies.com', '91', '9132352365', '2020-02-29', '00:30:00', '2', 'cover', 600, 40, 'test', '', 2, 2, '0000-00-00', '', NULL, 4, '2020-02-21', NULL, NULL),
(13, 'admin', 'My self', 41, 'Hariom', 'Sharan', 'hariom.sharan+an50@met-technologies.com', '91', '9132352365', '2020-02-29', '00:30:00', '2', 'cover', 600, 40, 'test', '', 2, 2, '0000-00-00', '', NULL, 4, '2020-02-21', NULL, NULL),
(14, 'admin', 'My self', 41, 'Hariom', 'Sharan', 'hariom.sharan+an50@met-technologies.com', '91', '9132352365', '2020-02-29', '00:30:00', '2', 'cover', 600, 40, 'test', '', 3, 2, '0000-00-00', '', 'ok', 4, '2020-02-21', NULL, NULL),
(15, 'admin', 'My self', 41, 'Hariom', 'Sharan', 'hariom.sharan+an50@met-technologies.com', '91', '9132352365', '2020-02-27', '00:30:00', '9', 'cover', 5000, 10, 'test', '', 0, 2, '0000-00-00', '', 'test', 4, '2020-02-21', NULL, NULL),
(16, 'admin', 'My self', 41, 'Hariom', 'Sharan', 'hariom.sharan+an50@met-technologies.com', '91', '9132352365', '2025-02-04', '00:30:00', '4', 'cover', 15000, 12, 'test', '', 0, 2, '0000-00-00', '', 'test', 5, '2020-02-21', NULL, NULL),
(17, 'admin', 'Someone else', 0, 'Raj', 'rahul', 'hari.sharan1990@gmail.com', '91', '9456456456', '2020-02-27', '01:30:00', '6', 'cover', 5000, 10, 'tes444', '', 2, 2, '0000-00-00', '', NULL, 5, '2020-02-21', NULL, NULL),
(18, 'admin', 'My self', 41, 'Hariom', 'Sharan', 'hariom.sharan+an50@met-technologies.com', '91', '9132352365', '2020-02-27', '01:00:00', '13', 'cover', 2500, 8, 'test33', '', 2, 2, '0000-00-00', '', NULL, 4, '2020-02-21', NULL, NULL),
(19, 'admin', 'Someone else', 0, 'Manish', 'baid', 'manish@yopmail.com', '91', '9831331665', '2020-02-24', '22:00:00', '14', 'cover', 2500, 5, 'Book', '', 2, 2, '0000-00-00', '', NULL, 1, '2020-02-22', NULL, NULL),
(22, 'admin', 'Someone else', 0, 'Som', 'hari', 'som@gmail.com', '91', '9865985654', '2020-02-28', '00:00:00', '6', 'cover', 5000, 9, 'dssdfdsf', '', 2, 2, '0000-00-00', '', NULL, 5, '2020-02-24', NULL, NULL),
(23, 'admin', 'My self', 11, 'Raj', 'om', 'hariom.sharan-k50@met-technologies.com', '91', '9163235385', '2020-02-29', '01:00:00', '15', 'cover', 7000, 8, 'sddsfds', '', 2, 2, '0000-00-00', '', NULL, 5, '2020-02-24', NULL, NULL),
(25, 'admin', 'My self', 61, 'Hm001', 'tes', 'hariom.shara@gmail.com', '91', '9865896589', '2020-02-29', '00:00:00', '8', 'cover', 5000, 5, 'test', '', 2, 2, '0000-00-00', '', NULL, 5, '2020-02-26', NULL, NULL),
(26, 'admin', 'Someone else', 0, 'raj', 'hari', 'rajhari@gmail.com', '91', '9865986598', '2020-02-29', '00:00:00', '3', 'cover', 1000, 4, 'tesdfsdf', '', 2, 2, '0000-00-00', '', NULL, 5, '2020-02-26', NULL, NULL),
(27, 'admin', 'My self', 60, 'Rahul', 'r', 'hariom.sharan+t0001@met-technologies.com', '91', '9898985874', '2020-03-01', '00:30:00', '12', 'cover', 2500, 4, 'tess', '', 2, 2, '0000-00-00', '', NULL, 5, '2020-02-26', NULL, NULL),
(28, 'front', 'My self', 1, 'Anup', 'Bora', 'anupkumar.bora@met-technologies.com', '91', '9007218463', '2020-02-29', '17:30:00', '5', 'cover', 5000, 6, '', '', 0, 2, '0000-00-00', '', 'test', 1, '2020-02-27', 1, '2020-02-27'),
(29, 'front', 'My self', 1, 'Anup', 'Bora', 'anupkumar.bora@met-technologies.com', '91', '9007218463', '2020-03-11', '17:45:00', '15', 'cover', 7000, 3, '', '', 0, 2, '0000-00-00', '', 'test', 1, '2020-02-27', 1, '2020-02-27'),
(30, 'front', 'My self', 1, 'Anup', 'Bora', 'anupkumar.bora@met-technologies.com', '91', '9007218463', '2020-02-29', '18:45:00', '10', 'cover', 1000, 2, '', '', 0, 2, '0000-00-00', '', 'test', 1, '2020-02-27', 1, '2020-02-27'),
(31, 'front', 'My self', 94, 'Hariom', 'hggg', 'hari.sharan1990+10@gmail.com', '91', '6363636363', '2020-03-11', '19:00:00', '6', 'cover', 5000, 6, '', '', 1, 2, '0000-00-00', '', NULL, 94, '2020-02-28', NULL, NULL),
(32, 'admin', 'Someone else', 0, 'Test', 'User', 'test@yopmail.com', '91', '7827633006', '2020-03-05', '12:30:00', '15', 'cover', 7000, 5, 'Book', '', 2, 2, '0000-00-00', '', NULL, 1, '2020-03-02', NULL, NULL),
(33, 'front', 'My self', 2, 'Hariom', 'Sha', 'hariom.sharan+k60@met-technologies.com', '91', '9163839086', '2020-03-05', '15:45:00', '15', 'cover', 7000, 4, '', '', 2, 2, '0000-00-00', '', NULL, 2, '2020-03-02', NULL, NULL),
(34, 'front', 'My self', 1, 'Anup', 'Bora', 'anupkumar.bora@met-technologies.com', '91', '9007218463', '2020-03-26', '15:45:00', '10', 'cover', 1000, 2, '', '', 1, 2, '0000-00-00', '', NULL, 1, '2020-03-02', NULL, NULL),
(35, 'front', 'My self', 1, 'Anup', 'Bora', 'anupkumar.bora@met-technologies.com', '91', '9007218463', '2020-03-17', '18:00:00', '11', 'cover', 1000, 1, '', '', 1, 2, '0000-00-00', '', NULL, 1, '2020-03-02', NULL, NULL),
(36, 'front', 'Someone else', 2, 'Hari', 'Sharan', 'hariom.sharan@met-technologies.com', '91', '9163839086', '2020-03-07', '14:30:00', '16', 'cover', 10000, 3, '', '', 0, 2, '0000-00-00', '', 'hrridj, 628856@$$()(dhdhehehwkwhdfvhreueruururjrdjrjrujrjrdhdrjrurjjrjrjrrjruur7488', 2, '2020-03-02', 2, '2020-03-02'),
(37, 'front', 'My self', 1, 'Anup', 'Bora', 'anupkumar.bora@met-technologies.com', '91', '9007218463', '2020-03-18', '16:15:00', '16', 'cover', 10000, 3, '', '', 1, 2, '0000-00-00', '', NULL, 1, '2020-03-02', NULL, NULL),
(38, 'front', 'My self', 1, 'Anup', 'Bora', 'anupkumar.bora@met-technologies.com', '91', '9007218463', '2020-03-19', '16:15:00', '7', 'cover', 20000, 11, '', '', 1, 2, '0000-00-00', '', NULL, 1, '2020-03-02', NULL, NULL),
(39, 'front', 'My self', 2, 'Hariom', 'Sha', 'hariom.sharan+hari@met-technologies.com', '91', '9163839086', '2020-03-05', '15:00:00', '17', 'cover', 12000, 8, '', '', 0, 2, '0000-00-00', '', 'test', 2, '2020-03-02', 2, '2020-03-02'),
(41, 'admin', 'Someone else', 0, 'Feona', 'Jems', 'feona@test.com', '91', '', '2020-03-06', '18:00:00', '10', 'cover', 1000, 4, 'dfs', '', 2, 2, '0000-00-00', '', NULL, 1, '2020-03-02', NULL, NULL),
(42, 'front', 'My self', 2, 'Hariom', 'Sha', 'hariom.sharan+hari@met-technologies.com', '91', '9163839086', '2020-03-27', '15:00:00', '14', 'cover', 2500, 4, '', '', 2, 2, '0000-00-00', '', NULL, 2, '2020-03-02', NULL, NULL),
(43, 'front', 'Someone else', 2, 'RAJM', 'trs', 'hariom.sharan@met-technologies.com', '91', '9163839086', '2020-06-30', '22:15:00', '4', 'cover', 15000, 19, '', '', 0, 2, '0000-00-00', '', 'tests', 2, '2020-03-02', NULL, NULL),
(44, 'admin', 'Someone else', 0, '', '', '', '91', '', '2020-03-02', '15:30:00', '10', 'cover', 1000, 3, 'dsad', '', 2, 2, '0000-00-00', '', NULL, 1, '2020-03-02', NULL, NULL),
(45, 'admin', 'Someone else', 0, '', '', '', '91', '', '2020-03-03', '18:00:00', '10', 'cover', 1000, 3, '', '', 2, 2, '0000-00-00', '', NULL, 1, '2020-03-02', NULL, NULL),
(46, 'front', 'My self', 1, 'Anup', 'Bora', 'anupkumar.bora@met-technologies.com', '91', '9007218463', '2020-03-25', '17:00:00', '11', 'cover', 1000, 2, '', '', 1, 2, '0000-00-00', '', NULL, 1, '2020-03-02', NULL, NULL),
(47, 'admin', 'Someone else', 0, 'Test', 'User', 'test@yopmail.com', '91', '7827633006', '2020-03-02', '16:00:00', '5', 'cover', 5000, 9, '', '', 2, 2, '0000-00-00', '', NULL, 1, '2020-03-02', NULL, NULL),
(48, 'front', 'My self', 1, 'Anup', 'Bora', 'anupkumar.bora@met-technologies.com', '91', '9007218463', '2020-03-31', '17:00:00', '10', 'cover', 1000, 3, '', '', 2, 2, '0000-00-00', '', NULL, 1, '2020-03-02', NULL, NULL),
(49, 'front', 'Someone else', 2, 'hshhshejwueueiiMmanNae338934848484848484', 'shsusueueuejejejejejsjejsjsjjsejjdjdjddjdhhddhhddhhdhdh', 'hariom.sharan@met-technologies.com', '91', '9163839086', '2020-08-31', '16:30:00', '7', 'cover', 20000, 11, '', '', 0, 2, '0000-00-00', '', 'fcycyy yy. uyuvvuv', 2, '2020-03-02', 2, '2020-03-02'),
(50, 'front', 'My self', 2, 'Hariomshdhdheueueueueeueiieeieieie3i', 'ShaEeheh3ji38e9sieiejejjeejjeje', 'hariom.sharan+hari@met-technologies.com', '91', '9163839086', '2020-03-05', '16:30:00', '9', 'cover', 5000, 7, '', '', 0, 2, '0000-00-00', '', 'ycucucucuvu6x5d4s3q3wr68givivibvi', 2, '2020-03-02', 2, '2020-03-02'),
(51, 'front', 'My self', 2, 'Kat55', 'Sh', 'hariom.sharan+hari@met-technologies.com', '91', '9163839086', '2020-03-05', '17:15:00', '16', 'cover', 10000, 3, '', '', 1, 2, '0000-00-00', '', NULL, 2, '2020-03-02', NULL, NULL),
(53, 'admin', 'My self', 74, 'Test', 'Test', 'test2225@gmail.com', '91', '9800789453', '2020-03-02', '00:00:00', '2', 'cover', 24000, 40, '', '', 2, 2, '0000-00-00', '', NULL, 1, '2020-03-02', NULL, NULL),
(54, 'admin', 'Someone else', 0, '', '', '', '91', '', '2020-03-02', '00:00:00', '8', 'cover', 10000, 10, 'SFSDF', '', 0, 2, '0000-00-00', '', NULL, 1, '2020-03-02', NULL, NULL),
(55, 'front', 'My self', 1, 'Anup', 'Bora', 'anupkumar.bora@met-technologies.com', '91', '8910278956', '2020-03-10', '16:00:00', '11', 'cover', 1000, 2, '', '', 1, 2, '0000-00-00', '', NULL, 1, '2020-03-03', NULL, NULL),
(56, 'front', 'My self', 1, 'Anup', 'Bora', 'anupkumar.bora@met-technologies.com', '91', '8910278956', '2020-03-19', '16:30:00', '10', 'cover', 1000, 2, '', '', 1, 2, '0000-00-00', '', NULL, 1, '2020-03-03', NULL, NULL),
(57, 'front', 'My self', 1, 'Anup', 'Bora', 'anupkumar.bora@met-technologies.com', '91', '8910278956', '2020-03-11', '18:30:00', '10', 'cover', 1000, 2, '', '', 1, 2, '0000-00-00', '', NULL, 1, '2020-03-03', NULL, NULL),
(58, 'front', 'My self', 1, 'Anup', 'Bora', 'anupkumar.bora@met-technologies.com', '91', '8910278956', '2020-03-18', '18:30:00', '10', 'cover', 1000, 3, '', '', 1, 2, '0000-00-00', '', NULL, 1, '2020-03-03', NULL, NULL),
(59, 'front', 'My self', 2, 'Kat55uu', 'Sh', 'hariom.sharan@met-technologies.com', '91', '9163839086', '2020-03-05', '15:45:00', '15', 'cover', 7000, 3, '', '', 1, 2, '0000-00-00', '', NULL, 2, '2020-03-03', NULL, NULL),
(60, 'front', 'My self', 1, 'Anup', 'Bora', 'anupkumar.bora@met-technologies.com', '91', '8910278956', '2020-03-18', '17:00:00', '10', 'cover', 1000, 2, '', '', 1, 2, '0000-00-00', '', NULL, 1, '2020-03-03', NULL, NULL),
(61, 'front', 'My self', 1, 'Anup', 'Bora', 'anupkumar.bora@met-technologies.com', '91', '8910278956', '2020-03-25', '17:15:00', '10', 'cover', 1000, 3, '', '', 1, 2, '0000-00-00', '', NULL, 1, '2020-03-03', NULL, NULL),
(62, 'front', 'My self', 1, 'Anup', 'Bora', 'anupkumar.bora@met-technologies.com', '91', '8910278956', '2020-03-19', '17:15:00', '10', 'cover', 1000, 3, '', '', 1, 2, '0000-00-00', '', NULL, 1, '2020-03-03', NULL, NULL),
(63, 'front', 'My self', 1, 'Anup', 'Bora', 'anupkumar.bora@met-technologies.com', '91', '8910278956', '2020-03-20', '17:15:00', '10', 'cover', 1000, 2, '', '', 1, 2, '0000-00-00', '', NULL, 1, '2020-03-03', NULL, NULL),
(64, 'front', 'My self', 100, 'Hariom', 'Sharan', 'hari.sharan1990+850@gmail.com', '91', '9163839087', '2020-03-06', '16:00:00', '7', 'cover', 20000, 11, '', '', 1, 2, '0000-00-00', '', NULL, 100, '2020-03-03', NULL, NULL),
(65, 'front', 'My self', 1, 'Anup', 'Bora', 'anupkumar.bora@met-technologies.com', '91', '8910278956', '2020-03-18', '17:30:00', '10', 'cover', 1000, 2, '', '', 1, 2, '0000-00-00', '', NULL, 1, '2020-03-03', NULL, NULL),
(66, 'front', 'My self', 101, 'Hariom', 'Sharan', 'hari.sharan1990+8581@gmail.com', '91', '7278343556', '2020-03-05', '16:15:00', '15', 'cover', 7000, 3, '', '', 0, 2, '0000-00-00', '', 'test', 101, '2020-03-03', NULL, NULL),
(67, 'front', 'My self', 1, 'Anup', 'Bora', 'anupkumar.bora@met-technologies.com', '91', '8910278956', '2020-03-16', '20:45:00', '10', 'cover', 1000, 2, '', '', 2, 2, '0000-00-00', '', NULL, 1, '2020-03-03', NULL, NULL),
(68, 'front', 'My self', 101, 'Hariom', 'Sharan', 'hari.sharan1990+8581@gmail.com', '91', '7278343556', '2020-03-05', '16:30:00', '16', 'cover', 7000, 2, '', '', 2, 2, '0000-00-00', '', NULL, 101, '2020-03-03', NULL, NULL),
(69, 'front', 'My self', 102, 'Sagar', 'Kumar', 'sagor@met-technologies.com', '91', '8093329913', '2020-03-12', '16:30:00', '10', 'cover', 1000, 2, '', '', 1, 2, '0000-00-00', '', NULL, 102, '2020-03-03', NULL, NULL),
(70, 'front', 'My self', 101, 'Hariom', 'Sharan', 'hari.sharan1990+8581@gmail.com', '91', '7278343556', '2020-03-06', '16:30:00', '16', 'cover', 7000, 2, '', '', 0, 2, '0000-00-00', '', 'yfxyxyxysystdydy6857899966665678iigvhcch', 101, '2020-03-03', 101, '2020-03-03'),
(71, 'front', 'My self', 102, 'Sagar', 'Kumar', 'sagor@met-technologies.com', '91', '8093329913', '2020-03-18', '18:30:00', '11', 'cover', 1000, 2, '', '', 3, 2, '0000-00-00', '', NULL, 102, '2020-03-03', NULL, NULL),
(72, 'front', 'My self', 101, 'Hariom', 'Sharan', 'hari.sharan1990+8581@gmail.com', '91', '7278343556', '2020-03-07', '16:45:00', '5', 'cover', 5000, 5, '', '', 2, 2, '0000-00-00', '', NULL, 101, '2020-03-03', NULL, NULL),
(73, 'front', 'My self', 102, 'Sagar', 'Kumar', 'sagor@met-technologies.com', '91', '8093329913', '2020-03-16', '18:30:00', '11', 'cover', 1000, 3, '', '', 2, 2, '0000-00-00', '', NULL, 102, '2020-03-03', NULL, NULL),
(74, 'front', 'My self', 102, 'Sagar', 'Kumar', 'sagor@met-technologies.com', '91', '8093329913', '2020-03-18', '18:45:00', '10', 'cover', 1000, 3, '', '', 0, 2, '0000-00-00', '', 'test', 102, '2020-03-03', NULL, NULL),
(77, 'admin', 'Someone else', 0, 'Hariom', 'Sha', 'hariom.sharan+k60@met-technologies.com', '91', '9163839086', '2020-03-06', '00:00:00', '6', 'cover', 5000, 5, 'test', '', 2, 2, '0000-00-00', '', 'test', 8, '2020-03-04', NULL, NULL),
(79, 'admin', 'My self', 78, 'Sophia', 'Jams', 'sophia@test.com', '91', '8334852222', '2020-03-04', '20:30:00', '10', 'cover', 1000, 4, '', 'Phone', 0, 2, '0000-00-00', '', NULL, 1, '2020-03-04', NULL, NULL),
(80, 'admin', 'My self', 90, 'Hariom', 'Sharan', 'hari.sharan1990@gmail.com', '91', '6352352365', '2020-03-06', '00:30:00', '4', 'cover', 15000, 12, 'test', 'Online', 2, 1, '2020-03-05 16:37:21', '', 'sdfdsfdsf', 4, '2020-03-05', NULL, NULL),
(81, 'admin', 'My self', 85, 'Test', 'Test', 'test8899@gmail.com', '91', '9007218888', '2020-03-06', '00:00:00', '8', 'cover', 10000, 10, 'test', 'Walk-in', 2, 2, '0000-00-00', '', NULL, 5, '2020-03-05', NULL, NULL),
(82, 'admin', 'My self', 103, 'Sophia', 'Jams', 'sophia@test.com', '91', '8334852200', '2020-03-05', '17:00:00', '10', 'cover', 1000, 4, '', 'Phone', 2, 2, '0000-00-00', '', NULL, 5, '2020-03-05', NULL, NULL),
(83, 'admin', 'Someone else', 0, 'Hariom', 'Sharan', 'hari.sharan1990@gmail.com', '91', '6352352365', '2020-03-05', '20:00:00', '10', 'cover', 1000, 4, '', 'Walk-in', 2, 1, '2020-03-06 13:44:22', '', NULL, 5, '2020-03-05', NULL, NULL),
(84, 'admin', 'My self', 89, 'Hari', 'om', 'hariom.sharan+123@met-technologies.com', '91', '9163636363', '2020-03-19', '04:00:00', '15', 'cover', 12000, 8, 'gggjv', 'Walk-in', 3, 1, '2020-03-05 16:36:16', '', 'no', 5, '2020-03-05', NULL, NULL),
(85, 'admin', 'My self', 87, 'Anup', 'Bora', 'anup.love.in@gmail.com', '91', '1234567890', '2020-03-06', '00:30:00', '5', 'cover', 10000, 10, '', 'Phone', 3, 2, '0000-00-00', '', NULL, 3, '2020-03-05', NULL, NULL),
(86, 'admin', 'My self', 87, 'Anup', 'Bora', 'anup.love.in@gmail.com', '91', '1234567890', '2020-03-05', '00:00:00', '5', 'cover', 10000, 10, 'test', 'Online', 3, NULL, '', '', 'test', 8, '2020-03-06', NULL, NULL),
(87, 'front', 'My self', 1, 'Anup1', 'Bora1', 'anupkumar1.bora@met-technologies.com', '91', '8910278956', '2020-03-09', '16:00:00', '11', 'cover', 1000, 2, '', '', 1, 2, '0000-00-00', '', NULL, 1, '2020-03-03', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reservation_payment_transaction`
--

CREATE TABLE `reservation_payment_transaction` (
  `reservation_transaction_id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `transaction_id` varchar(200) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `payment_amount` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `payment_status` enum('success','failed','pending') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reservation_payment_transaction`
--

INSERT INTO `reservation_payment_transaction` (`reservation_transaction_id`, `reservation_id`, `transaction_id`, `payment_mode`, `payment_amount`, `transaction_date`, `payment_status`) VALUES
(1, 1, '15814103101749830576623', 'PayUMoney', 10, '2020-02-11', 'success'),
(2, 3, 'paytm', 'paytm', 1000, '2020-02-11', 'success'),
(3, 4, 'paytm', 'paytm', 1000, '2020-02-11', 'success'),
(4, 5, '15814146312929830233006', 'PayUMoney', 10, '2020-02-11', 'success'),
(5, 6, '15814330323677278343556', 'PayUMoney', 1000, '2020-02-11', 'success'),
(6, 7, '15814332532797278343556', 'PayUMoney', 1000, '2020-02-11', 'success'),
(7, 8, 'paytm', 'paytm', 1000, '2020-02-12', 'success'),
(8, 9, '378904194897', 'cash', 1000, '2020-02-13', 'success'),
(9, 10, '15819484121477278343556', 'PayUMoney', 1000, '2020-02-17', 'success'),
(10, 11, '15820037487277278343556', 'PayUMoney', 1000, '2020-02-18', 'success'),
(11, 12, '134475715318', 'cash', 600, '2020-02-21', 'success'),
(12, 13, '436715348251', 'cash', 600, '2020-02-21', 'success'),
(13, 14, '741241858154', 'cash', 600, '2020-02-21', 'success'),
(14, 15, '735226962529', 'cash', 5000, '2020-02-21', 'success'),
(15, 16, '209769397648', 'cash', 15000, '2020-02-21', 'success'),
(16, 17, '826225289609', 'cash', 5000, '2020-02-21', 'success'),
(17, 18, '152675295574', 'cash', 2500, '2020-02-21', 'success'),
(18, 19, '916622647643', 'cash', 2500, '2020-02-22', 'success'),
(19, 20, '818230953067', 'cash', 15000, '2020-02-24', 'success'),
(20, 21, '937929325224', 'cash', 5000, '2020-02-24', 'success'),
(21, 22, '405374687258', 'cash', 5000, '2020-02-24', 'success'),
(22, 23, '196231577126', 'cash', 7000, '2020-02-24', 'success'),
(23, 24, '974065917590', 'cash', 7000, '2020-02-24', 'success'),
(24, 25, '248187711695', 'cash', 5000, '2020-02-26', 'success'),
(25, 26, '213940404076', 'cash', 1000, '2020-02-26', 'success'),
(26, 27, '183866547467', 'cash', 2500, '2020-02-26', 'success'),
(27, 28, '15827996952059007218463', 'PayUMoney', 6000, '2020-02-27', 'success'),
(28, 29, '15828005245699007218463', 'PayUMoney', 7000, '2020-02-27', 'success'),
(29, 30, '15828007666849007218463', 'PayUMoney', 1000, '2020-02-27', 'success'),
(30, 31, '15828969706286363636363', 'PayUMoney', 6000, '2020-02-28', 'success'),
(31, 32, '532113263383', 'cash', 7000, '2020-03-02', 'success'),
(32, 33, '15831362429549163839086', 'PayUMoney', 9000, '2020-03-02', 'success'),
(33, 34, '15831385517539007218463', 'PayUMoney', 1000, '2020-03-02', 'success'),
(34, 35, '15831392790349007218463', 'PayUMoney', 1000, '2020-03-02', 'success'),
(35, 36, '15831398919699163839086', 'PayUMoney', 10000, '2020-03-02', 'success'),
(36, 37, '15831404574169007218463', 'PayUMoney', 10000, '2020-03-02', 'success'),
(37, 38, '15831408459029007218463', 'PayUMoney', 20000, '2020-03-02', 'success'),
(38, 39, '15831410237109163839086', 'PayUMoney', 12000, '2020-03-02', 'success'),
(40, 41, '404684724612', 'cash', 1000, '2020-03-02', 'success'),
(41, 42, '15831416833869163839086', 'PayUMoney', 2500, '2020-03-02', 'success'),
(42, 43, '15831420111199163839086', 'PayUMoney', 15000, '2020-03-02', 'success'),
(43, 44, '507797495136', 'cash', 1000, '2020-03-02', 'success'),
(45, 46, '15831430593319007218463', 'PayUMoney', 1000, '2020-03-02', 'success'),
(46, 47, '923419272666', 'cash', 5000, '2020-03-02', 'success'),
(47, 48, '15831432101589007218463', 'PayUMoney', 1000, '2020-03-02', 'success'),
(48, 49, '15831467907529163839086', 'PayUMoney', 20000, '2020-03-02', 'success'),
(49, 50, '15831472978729163839086', 'PayUMoney', 7000, '2020-03-02', 'success'),
(50, 51, '15831496840589163839086', 'PayUMoney', 10000, '2020-03-02', 'success'),
(52, 53, '997628273861', 'cash', 24000, '2020-03-02', 'success'),
(53, 54, '768166272062', 'cash', 10000, '2020-03-02', 'success'),
(54, 55, '00000', 'PayUMoney', 1000, '2020-03-03', 'success'),
(55, 56, '15832274807028910278956', 'PayUMoney', 1000, '2020-03-03', 'success'),
(56, 57, '15832277694788910278956', 'PayUMoney', 1000, '2020-03-03', 'success'),
(57, 58, '15832280393658910278956', 'PayUMoney', 1000, '2020-03-03', 'success'),
(58, 59, '15832298692009163839086', 'PayUMoney', 7000, '2020-03-03', 'success'),
(59, 60, '00000', 'PayUMoney', 1000, '2020-03-03', 'success'),
(60, 61, '00000', 'PayUMoney', 1000, '2020-03-03', 'success'),
(61, 62, '00000', 'PayUMoney', 1000, '2020-03-03', 'success'),
(62, 63, '00000', 'PayUMoney', 1000, '2020-03-03', 'success'),
(63, 64, '15832313295189163839087', 'PayUMoney', 20000, '2020-03-03', 'success'),
(64, 65, '250130486', 'PayUMoney', 1000, '2020-03-03', 'success'),
(65, 66, '15832320500717278343556', 'PayUMoney', 7000, '2020-03-03', 'success'),
(66, 67, '250130582', 'PayUMoney', 1000, '2020-03-03', 'success'),
(67, 68, '15832328598267278343556', 'PayUMoney', 7000, '2020-03-03', 'success'),
(68, 69, '250130642', 'PayUMoney', 1000, '2020-03-03', 'success'),
(69, 70, '15832332828667278343556', 'PayUMoney', 7000, '2020-03-03', 'success'),
(70, 71, '250130664', 'PayUMoney', 1000, '2020-03-03', 'success'),
(71, 72, '15832335496327278343556', 'PayUMoney', 5000, '2020-03-03', 'success'),
(72, 73, '250130682', 'PayUMoney', 1000, '2020-03-03', 'success'),
(73, 74, '250130708', 'PayUMoney', 1000, '2020-03-03', 'success'),
(76, 77, '969768338976', 'cash', 5000, '2020-03-04', 'success'),
(78, 79, '219292877055', 'cash', 1000, '2020-03-04', 'success'),
(79, 80, '172704581590', 'cash', 15000, '2020-03-05', 'success'),
(80, 81, '868566439533', 'cash', 10000, '2020-03-05', 'success'),
(81, 82, '913079822529', 'cash', 1000, '2020-03-05', 'success'),
(82, 83, '301676545990', 'cash', 1000, '2020-03-05', 'success'),
(83, 84, '601579436333', 'cash', 12000, '2020-03-05', 'success'),
(84, 85, '533419005479', 'cash', 10000, '2020-03-05', 'success'),
(85, 86, '464245104463', 'cash', 10000, '2020-03-06', 'success');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `room_id` int(100) NOT NULL,
  `room_no` varchar(100) NOT NULL,
  `room_type_id` int(10) NOT NULL,
  `price` float(10,2) NOT NULL,
  `description` varchar(100) NOT NULL,
  `status` int(10) NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `room_type_id` int(10) NOT NULL,
  `room_type_name` varchar(100) NOT NULL,
  `status` int(10) NOT NULL,
  `is_delete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `time_slot`
--

CREATE TABLE `time_slot` (
  `time_slot_id` int(11) NOT NULL,
  `day_name` varchar(255) NOT NULL,
  `time_slot` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `time_slot`
--

INSERT INTO `time_slot` (`time_slot_id`, `day_name`, `time_slot`, `status`) VALUES
(1, 'Sunday', '12:00pm-3:00pm', '1'),
(2, 'Sunday', '3:00pm-6:00pm', '1'),
(3, 'Sunday', '6:00pm-8:00pm', '1'),
(4, 'Sunday', '8:00pm-11:00pm', '1'),
(5, 'Monday', '12:00pm-3:00pm', '1'),
(6, 'Monday', '3:00pm-6:00pm', '1'),
(7, 'Monday', '6:00pm-8:00pm', '1'),
(8, 'Monday', '8:00pm-11:00pm', '1'),
(9, 'Tuesday', '12:00pm-3:00pm', '1'),
(10, 'Tuesday', '3:00pm-6:00pm', '1'),
(11, 'Tuesday', '6:00pm-8:00pm', '1'),
(12, 'Tuesday', '8:00pm-11:00pm', '1'),
(13, 'Wednesday', '12:00pm-3:00pm', '1'),
(14, 'Wednesday', '3:00pm-6:00pm', '1'),
(15, 'Wednesday', '6:00pm-8:00pm', '1'),
(16, 'Wednesday', '8:00pm-11:00pm', '1'),
(17, 'Thursday', '12:00pm-3:00pm', '1'),
(18, 'Thursday', '3:00pm-6:00pm', '1'),
(19, 'Thursday', '6:00pm-8:00pm', '1'),
(20, 'Thursday', '8:00pm-11:00pm', '1'),
(21, 'Friday', '12:00pm-3:00pm', '1'),
(22, 'Friday', '3:00pm-6:00pm', '1'),
(23, 'Friday', '6:00pm-8:00pm', '1'),
(24, 'Friday', '8:00pm-11:00pm', '1'),
(25, 'Saturday', '12:00pm-3:00pm', '1'),
(26, 'Saturday', '3:00pm-6:00pm', '1'),
(27, 'Saturday', '6:00pm-8:00pm', '1'),
(28, 'Saturday', '8:00pm-11:00pm', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `original_password` varchar(255) NOT NULL,
  `code` varchar(200) NOT NULL,
  `profile_photo` varchar(255) NOT NULL,
  `created_by` int(11) DEFAULT NULL COMMENT 'user_id of master_user',
  `created_date` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL COMMENT 'user_id of master_user',
  `updated_date` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT NULL COMMENT 'Driver Status => 0 - Pending,1 - Aggrement Generated \\\\\\\\nUser Status   => ',
  `is_delete` int(11) NOT NULL DEFAULT '0',
  `recovery_key` text,
  `login_status` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `role_id`, `first_name`, `middle_name`, `last_name`, `mobile`, `email`, `password`, `original_password`, `code`, `profile_photo`, `created_by`, `created_date`, `updated_by`, `updated_date`, `status`, `is_delete`, `recovery_key`, `login_status`) VALUES
(1, 1, 'Admin', '', '', '', 'admin@admin.com', '601f1889667efaebb33b8c12572835da3f027f78', '123123', 'FENICIA#111', '', 1, '2019-12-04 17:22:55', 1, '2020-03-04 23:10:53', 1, 0, NULL, 0),
(8, 1, 'Ishani', '', '', '', 'ishani@test.com', 'c129b324aee662b04eccf68babba85851346dff9', '12341234', 'FENICIA#111', '', 1, '2019-12-04 17:22:55', 8, '2020-07-16 08:08:30', 1, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `profile_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `landline_no` varchar(50) DEFAULT NULL,
  `flat_no` varchar(100) DEFAULT NULL,
  `street_no` varchar(100) DEFAULT NULL,
  `street_name` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `pin` int(6) NOT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL COMMENT 'user_id of master_user',
  `created_ts` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL COMMENT 'user_id of master_user',
  `updated_ts` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`profile_id`, `user_id`, `first_name`, `middle_name`, `last_name`, `mobile`, `landline_no`, `flat_no`, `street_no`, `street_name`, `city`, `state`, `pin`, `profile_photo`, `created_by`, `created_ts`, `updated_by`, `updated_ts`) VALUES
(1, 1, 'Admin', NULL, 'Test', '1234567890', NULL, '10', 'sector 5', 'RDB Road', 'kolkata', 'westbengal', 7000091, NULL, 1, '2019-11-20 18:27:00', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_token`
--
ALTER TABLE `api_token`
  ADD PRIMARY KEY (`token_id`);

--
-- Indexes for table `cafe_images`
--
ALTER TABLE `cafe_images`
  ADD PRIMARY KEY (`cafe_img_id`);

--
-- Indexes for table `cms`
--
ALTER TABLE `cms`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `device_token`
--
ALTER TABLE `device_token`
  ADD PRIMARY KEY (`token_id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `food_category`
--
ALTER TABLE `food_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `master_cafe`
--
ALTER TABLE `master_cafe`
  ADD PRIMARY KEY (`cafe_id`);

--
-- Indexes for table `master_gallery`
--
ALTER TABLE `master_gallery`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `master_media`
--
ALTER TABLE `master_media`
  ADD PRIMARY KEY (`media_id`);

--
-- Indexes for table `master_member`
--
ALTER TABLE `master_member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `master_menu`
--
ALTER TABLE `master_menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `master_package`
--
ALTER TABLE `master_package`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `master_role`
--
ALTER TABLE `master_role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`movie_id`);

--
-- Indexes for table `movie_category`
--
ALTER TABLE `movie_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `package_benefits`
--
ALTER TABLE `package_benefits`
  ADD PRIMARY KEY (`package_benefit_id`);

--
-- Indexes for table `package_benefits_mapping`
--
ALTER TABLE `package_benefits_mapping`
  ADD PRIMARY KEY (`package_benefits_mapping_id`);

--
-- Indexes for table `package_images`
--
ALTER TABLE `package_images`
  ADD PRIMARY KEY (`package_img_id`);

--
-- Indexes for table `package_membership_mapping`
--
ALTER TABLE `package_membership_mapping`
  ADD PRIMARY KEY (`package_membership_mapping_id`);

--
-- Indexes for table `package_membership_transaction`
--
ALTER TABLE `package_membership_transaction`
  ADD PRIMARY KEY (`pkage_transaction_id`),
  ADD KEY `booking_id` (`package_id`);

--
-- Indexes for table `package_price_mapping`
--
ALTER TABLE `package_price_mapping`
  ADD PRIMARY KEY (`package_price_mapping_id`);

--
-- Indexes for table `package_type`
--
ALTER TABLE `package_type`
  ADD PRIMARY KEY (`package_type_id`);

--
-- Indexes for table `package_vouchers`
--
ALTER TABLE `package_vouchers`
  ADD PRIMARY KEY (`package_voucher_id`);

--
-- Indexes for table `package_vouchers_mapping`
--
ALTER TABLE `package_vouchers_mapping`
  ADD PRIMARY KEY (`package_voucher_mapping_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reservation_id`);

--
-- Indexes for table `reservation_payment_transaction`
--
ALTER TABLE `reservation_payment_transaction`
  ADD PRIMARY KEY (`reservation_transaction_id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`room_type_id`);

--
-- Indexes for table `time_slot`
--
ALTER TABLE `time_slot`
  ADD PRIMARY KEY (`time_slot_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`profile_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_token`
--
ALTER TABLE `api_token`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `cafe_images`
--
ALTER TABLE `cafe_images`
  MODIFY `cafe_img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `cms`
--
ALTER TABLE `cms`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `device_token`
--
ALTER TABLE `device_token`
  MODIFY `token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `food_category`
--
ALTER TABLE `food_category`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `master_cafe`
--
ALTER TABLE `master_cafe`
  MODIFY `cafe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `master_gallery`
--
ALTER TABLE `master_gallery`
  MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `master_media`
--
ALTER TABLE `master_media`
  MODIFY `media_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master_member`
--
ALTER TABLE `master_member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `master_menu`
--
ALTER TABLE `master_menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `master_package`
--
ALTER TABLE `master_package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `master_role`
--
ALTER TABLE `master_role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `movie_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movie_category`
--
ALTER TABLE `movie_category`
  MODIFY `category_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `package_benefits`
--
ALTER TABLE `package_benefits`
  MODIFY `package_benefit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `package_benefits_mapping`
--
ALTER TABLE `package_benefits_mapping`
  MODIFY `package_benefits_mapping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `package_images`
--
ALTER TABLE `package_images`
  MODIFY `package_img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `package_membership_mapping`
--
ALTER TABLE `package_membership_mapping`
  MODIFY `package_membership_mapping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `package_membership_transaction`
--
ALTER TABLE `package_membership_transaction`
  MODIFY `pkage_transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `package_price_mapping`
--
ALTER TABLE `package_price_mapping`
  MODIFY `package_price_mapping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `package_type`
--
ALTER TABLE `package_type`
  MODIFY `package_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `package_vouchers`
--
ALTER TABLE `package_vouchers`
  MODIFY `package_voucher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `package_vouchers_mapping`
--
ALTER TABLE `package_vouchers_mapping`
  MODIFY `package_voucher_mapping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `reservation_payment_transaction`
--
ALTER TABLE `reservation_payment_transaction`
  MODIFY `reservation_transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `room_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `room_type_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `time_slot`
--
ALTER TABLE `time_slot`
  MODIFY `time_slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
