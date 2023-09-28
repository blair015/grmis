-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2023 at 02:46 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `governanceis`
--

-- --------------------------------------------------------

--
-- Table structure for table `approval`
--

CREATE TABLE `approval` (
  `id` int(11) NOT NULL,
  `school_id` varchar(255) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `school_address` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `educ_background`
--

CREATE TABLE `educ_background` (
  `id` int(11) NOT NULL,
  `emp_no` varchar(255) NOT NULL,
  `under_school` varchar(255) NOT NULL,
  `under_course` varchar(255) NOT NULL,
  `under_year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `educ_background`
--

INSERT INTO `educ_background` (`id`, `emp_no`, `under_school`, `under_course`, `under_year`) VALUES
(1, '1234678', 'PCDS', 'BSIT', '2014-2015'),
(2, '12345678', 'University of Mindanao', 'Bachelor of Science in Secondary Education', '2015-2016');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_no` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type_of_employee` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(11) NOT NULL,
  `school_id` varchar(500) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `frame` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `school_id`, `latitude`, `longitude`, `frame`) VALUES
(2, '125225', '6.606372475772369', '125.34345789443138', ''),
(7, '302323', '', '', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126826.49216937121!2d125.21162196249999!3d6.606116700000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32f9c9ad439ba14b%3A0xc0808e4e2027a107!2sSulop%20National%20High%20School!5e0!3m2!1sen!2sph!4v1692160314844!5m2!1sen!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(8, '304401', '', '', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d990.3703246048096!2d125.41547358320149!3d6.832750311381383!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32f9a5bccf8e1841%3A0x42d5dada3fb630a9!2sSanta%20Cruz%20National%20High%20School!5e0!3m2!1sen!2sph!4v1692175435343!5m2!1sen!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(30, '129099', '', '', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d64904237.52978331!2d57.91551899999998!3d6.837699800000027!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32f9a5be8df1f979%3A0x763a4d96d17b409f!2sSanta%20Cruz%20Central%20Elementary%20School!5e0!3m2!1sen!2sus!4v1695172843747!5m2!1sen!2sus\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(12, '304294', '', '', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.4666187980433!2d125.41401584731358!3d6.834521991391371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32f9a5bccf8e1841%3A0x42d5dada3fb630a9!2sSanta%20Cruz%20National%20High%20School!5e0!3m2!1sen!2sus!4v1695186943524!5m2!1sen!2sus\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>'),
(10, '129031', '', '', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.85588320174!2d125.19139467576206!3d6.664775421503911!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x32f84aa1ea0f112b%3A0xdfc74c6725408705!2sBuri%20Elementary%20School!5e0!3m2!1sen!2sus!4v1695777095222!5m2!1sen!2sus\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(21, '2014_10_12_000000_create_users_table', 1),
(22, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(23, '2019_08_19_000000_create_failed_jobs_table', 1),
(24, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(25, '2023_05_12_060902_create_employees_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `physical_facilities`
--

CREATE TABLE `physical_facilities` (
  `id` int(11) NOT NULL,
  `school_id` varchar(255) NOT NULL,
  `acad_good` int(11) NOT NULL,
  `acad_damaged` int(11) NOT NULL,
  `acad_repair` int(11) NOT NULL,
  `tls` int(11) NOT NULL,
  `makeshift` int(11) NOT NULL,
  `arms_chairs` int(11) NOT NULL,
  `tables_chairs` int(11) NOT NULL,
  `clinic` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `id` int(11) NOT NULL,
  `school_id` varchar(255) NOT NULL,
  `school_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`id`, `school_id`, `school_name`) VALUES
(1, '304401', 'Santa Cruz, Davao del Sur'),
(2, '304296', 'Senior High School');

-- --------------------------------------------------------

--
-- Table structure for table `school_add`
--

CREATE TABLE `school_add` (
  `id` int(11) NOT NULL,
  `school_id` varchar(255) NOT NULL,
  `total_students` varchar(255) NOT NULL,
  `teaching` varchar(255) NOT NULL,
  `non_teaching` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_add`
--

INSERT INTO `school_add` (`id`, `school_id`, `total_students`, `teaching`, `non_teaching`) VALUES
(1, '304401', '5023', '345', '32');

-- --------------------------------------------------------

--
-- Table structure for table `school_enrol`
--

CREATE TABLE `school_enrol` (
  `id` int(11) NOT NULL,
  `school_id` varchar(255) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `enrolee` varchar(255) NOT NULL,
  `grade_level` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_enrol`
--

INSERT INTO `school_enrol` (`id`, `school_id`, `school_name`, `year`, `enrolee`, `grade_level`, `sex`) VALUES
(1, '304401', 'MATANAO', '2020', '', '1', 'MALE'),
(2, '304401', 'MATANAO', '2020', '', '1', 'FEMALE'),
(3, '304401', 'MATANAO', '2020', '', '2', 'MALE'),
(4, '304401', 'MATANAO', '2020', '', '2', 'FEMALE'),
(5, '304401', 'MATANAO', '2020', '', '2', 'FEMALE'),
(6, '304401', 'MATANAO', '2021', '', '1', 'MALE'),
(7, '30440', 'MATANAO', '2021', '', '2', 'MALE'),
(9, '125225', 'SULOP', '2020', '500', '7', 'MALE'),
(10, '125225', 'SULOP', '2020', '', '7', 'FEMALE'),
(11, '125225', 'SULOP', '2021', '1500', '8', 'MALE'),
(12, '125225', 'SULOP', '2021', '', '8', 'FEMALE'),
(11, '304294', 'STA. CRUZ NATIONAL HIGH SCHOOL', '2023-2024', '', '7', 'MALE'),
(12, '304294', 'STA. CRUZ NATIONAL HIGH SCHOOL', '2023-2024', '', '8', 'FEMALE'),
(13, '304294', 'STA. CRUZ NATIONAL HIGH SCHOOL', '2023-2024', '', '9', 'MALE');

-- --------------------------------------------------------

--
-- Table structure for table `school_head_info`
--

CREATE TABLE `school_head_info` (
  `id` int(15) NOT NULL,
  `school_id` varchar(255) NOT NULL,
  `emp_no` varchar(255) NOT NULL,
  `head_pic` varchar(255) NOT NULL,
  `f_name` varchar(255) NOT NULL,
  `l_name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `head_number` varchar(255) NOT NULL,
  `year_school` varchar(255) NOT NULL,
  `head_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_head_info`
--

INSERT INTO `school_head_info` (`id`, `school_id`, `emp_no`, `head_pic`, `f_name`, `l_name`, `position`, `head_number`, `year_school`, `head_email`) VALUES
(1, '304294', '123123', 'blair.png', 'BLair', 'Torres', 'Teacher II', '095123123131', '5', 'blair_deped.gov.ph');

-- --------------------------------------------------------

--
-- Table structure for table `school_info`
--

CREATE TABLE `school_info` (
  `id` int(11) NOT NULL,
  `school_id` varchar(255) NOT NULL,
  `school_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `school_profile`
--

CREATE TABLE `school_profile` (
  `id` int(11) NOT NULL,
  `school_id` varchar(255) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `school_address` varchar(255) NOT NULL,
  `about_school` varchar(999) NOT NULL,
  `school_type` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `school_email_address` varchar(255) NOT NULL,
  `school_logo` varchar(255) NOT NULL,
  `school_header` varchar(255) NOT NULL,
  `Municipality` varchar(255) NOT NULL,
  `District` varchar(255) NOT NULL,
  `sbm_level` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `academic_classroom` varchar(255) NOT NULL,
  `non_academic_classroom` varchar(255) NOT NULL,
  `needing_repair` varchar(255) NOT NULL,
  `tls` varchar(255) NOT NULL,
  `makeshift` varchar(255) NOT NULL,
  `arms_and_chairs` varchar(255) NOT NULL,
  `tables_and_chairs` varchar(255) NOT NULL,
  `functional_clinic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_profile`
--

INSERT INTO `school_profile` (`id`, `school_id`, `school_name`, `school_address`, `about_school`, `school_type`, `contact_number`, `school_email_address`, `school_logo`, `school_header`, `Municipality`, `District`, `sbm_level`, `category`, `academic_classroom`, `non_academic_classroom`, `needing_repair`, `tls`, `makeshift`, `arms_and_chairs`, `tables_and_chairs`, `functional_clinic`) VALUES
(28, '125225', 'Sulop National High School', 'Sulop, Davao del Sur', 'ASDA DASD ASD', 'URBAN', '12341233112', '125225@deped.gov.ph', 'uploads/6513d8b18df40_IMG20230925125028.jpg', 'uploads/6513d8b18df45_337282_autumn-tree-desktop-wallpaper-autumn-tree-backgrounds-new-wallpapers_1920x1200_h.jpg', 'BANSALAN', 'Sulop', '2', 'small', '5', '4', '2', '1', '2', '5', '5', '1'),
(30, '128816', 'Mabunga Elementary School', 'Mabunga, Bansalan, Davao del Sur', 'asdsa sad asd ', 'URBAN', '123 1231 23123 123 ', '128816@deped.gov.ph', 'uploads/6513b549b2b33_IMG20230925125028 - Edited.png', 'uploads/6513b549b2b38_singapore-teen-gaming-addiction.jpg', 'BANSALAN', 'Bansalan East', '2', 'small', '', '', '', '', '', '', '', ''),
(31, '128822', 'Union ES', 'Apo Beach, Zone III', 'dfsxddsds', 'URBAN', '123 1231 23123 123 ', 'blairbrian.torres@deped.gov.ph', 'Copy of Black Beige Geometric Graduation Program (1).png', 'Zoom Background.jpg', 'BANSALAN', 'MATANAO I', '2', 'medium', '', '', '', '', '', '', '', ''),
(32, '128815', 'Mabuhay ES', 'Apo Beach, Zone III', 'dfgf fg dfg dgf', 'URBAN', '1232144 123 1', 'blairbrian.torres@deped.gov.ph', 'Zoom Background.jpg', 'variables.png', 'BANSALAN', 'Bansalan East', '2', 'small', '', '', '', '', '', '', '', ''),
(33, '129099', 'Santa Cruz CES', 'Apo Beach, Zone III, Santa Cruz, Davao del Sur', 'asda sdsa das', 'URBAN', '12341233112', 'blairbrian.torres@deped.gov.ph', 'Zoom Background.jpg', 'Firewall.jpg', 'MATANAO', 'Sta. Cruz South', '3', 'large', '2', '3', '4', '1', '2', '3', '4', '5'),
(34, '128828', 'Dolo Elementary School', 'Dolo, Bansalan, Davao del Sur', 'sadas asd asd asd ', 'RURAL', '09517974460', '128828@deped.gov.ph', 'uploads/6513d5b468c3e_kim rohaina.jpg', 'uploads/6513d5b468c51_125316892_195313135420129_5548869138632988571_n.jpg', 'BANSALAN', 'Bansalan West', '1', 'small', '2', '3', '4', '5', '6', '7', '1', '1'),
(35, '128826', 'Bitaug ES', 'Apo Beach, Zone III', '', 'RURAL', '', 'blairbrian.torres@deped.gov.ph', 'Zoom Background.jpg', '361657937_3131313877162025_5772383619876780379_n.jpg', 'BANSALAN', 'Bansalan West', '3', 'small', '', '', '', '', '', '', '', ''),
(39, '128827', 'Darapuay ES', 'Apo Beach, Zone III', '', 'RURAL', '', 'blairbrian.torres@deped.gov.ph', 'Zoom Background.jpg', '361657937_3131313877162025_5772383619876780379_n.jpg', 'BANSALAN', 'Bansalan West', '3', 'small', '', '', '', '', '', '', '', ''),
(42, '128935', 'Glamang es', 'Magsaysay', '', '', '', '', '', '', '', 'Magsaysay South', '', 'small', '', '', '', '', '', '', '', ''),
(43, '128955', 'Benito Quibod ES', 'Malalag', '', '', '', '', '', '', '', 'Malalag', '', 'small', '', '', '', '', '', '', '', ''),
(44, '128896', 'Benito Perez ES', 'Kiblawan', '', '', '', '', '', '', '', 'Kiblawan North', '', 'small', '', '', '', '', '', '', '', ''),
(45, '304295', 'Bato NHS', 'Bato', '', '', '', '', '', '', '', 'Sta. Cruz South', '', 'medium', '', '', '', '', '', '', '', ''),
(46, '129024', 'San Vicente ES', 'Matanao', '', '', '', '', '', '', '', 'Matanao I', '', 'medium', '', '', '', '', '', '', '', ''),
(47, '129090', 'Apolinar Franco, Sr. ES', 'Sta. Cruz', '', '', '', '', '', '', '', 'Sta. Cruz South', '', 'small', '', '', '', '', '', '', '', ''),
(48, '129037', 'Sulatorio ES', 'Apo Beach, Zone III', 'dsadasd asdasd', 'URBAN', '12341233112', 'blairbrian.torres@deped.gov.ph', 'Seal_of_the_Department_of_Education_of_the_Philippines (2).png', 'A River.jpg', 'SANTA CRUZ', 'Matanao II', '1', 'small', '', '', '', '', '', '', '', ''),
(49, '129031', 'Buri Elementary School', 'Buri, Matanao Davao del Sur', 'dsadsadas', 'URBAN', '12312 123 131', '129031@deped.gov.ph', 'uploads/6513b1aae6216_IMG20230925125028.jpg', 'uploads/6513b1aae621c_337282_autumn-tree-desktop-wallpaper-autumn-tree-backgrounds-new-wallpapers_1920x1200_h.jpg', 'PADADA', 'Matanao II', '1', 'small', '', '', '', '', '', '', '', ''),
(50, '129017', 'Matanao CES', 'Bato, Santa Cruz, Davao del Sur', '', '', '', '', '', '', '', 'Matanao I', '', 'small', '', '', '', '', '', '', '', ''),
(51, '128950', 'Col. Lanzar ES', 'Malalag', '', '', '', '', '', '', '', 'Malalag', '', 'small', '', '', '', '', '', '', '', ''),
(52, '128950', 'Col. Lanzar ES', 'Malalag', '', '', '', '', '', '', '', 'Malalag', '', 'small', '', '', '', '', '', '', '', ''),
(53, '128950', 'Col. Lanzar ES', 'Malalag', '', '', '', '', '', '', '', 'Malalag', '', 'small', '', '', '', '', '', '', '', ''),
(54, '128956', 'Ngub PS', 'Malalag', '', '', '', '', '', '', '', 'Malalag', '', 'small', '', '', '', '', '', '', '', ''),
(55, '129031', 'Buri Elementary School', 'Buri, Matanao Davao del Sur', '', '', '', '129031@deped.gov.ph', 'uploads/6513b1aae6216_IMG20230925125028.jpg', 'uploads/6513b1aae621c_337282_autumn-tree-desktop-wallpaper-autumn-tree-backgrounds-new-wallpapers_1920x1200_h.jpg', '', 'Matanao II', '', 'small', '', '', '', '', '', '', '', ''),
(56, '129083', 'Langan ES', 'Langan, Santa Cruz, Davao del Sur', '', '', '', '129083@deped.gov.ph', 'uploads/6513b75ed6301_IMG20230925125028.jpg', 'uploads/6513b75ed6306_337282_autumn-tree-desktop-wallpaper-autumn-tree-backgrounds-new-wallpapers_1920x1200_h (1).jpg', '', 'Sta. Cruz North', '', 'small', '', '', '', '', '', '', '', ''),
(58, '304294', 'Sta. Cruz National High School', 'Brgy. Zone III, Santa Cruz, Davao del Sur', '', '', '', '304294', 'uploads/6514116468858_Seal_of_the_Department_of_Education_of_the_Philippines (2).png', 'uploads/651411646885d_Tarp Graduation 6th Rites.png', '', 'Sta. Cruz South', '', 'small', '', '', '', '', '', '', '', ''),
(59, '128812', 'Bansalan Central ES', 'Kapatagan NHS', '', '', '', '', '', '', '', 'Bansalan East', '', 'medium', '', '', '', '', '', '', '', ''),
(60, '205024', 'Sitio Project ES', 'Matanao', '', '', '', '', '', '', '', 'Matanao II', '', 'small', '', '', '', '', '', '', '', ''),
(61, '304290', 'Sinawilan National High School', 'Sinawilan, Matanao, Davao del Sur', '', '', '', '304290@deped.gov.ph', 'uploads/6514c1cd3dc15_Seal_of_the_Department_of_Education_of_the_Philippines.png', 'uploads/6514c1cd3dc1a_Tarp Graduation 6th Rites.png', '', 'Matanao I', '', 'medium', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_profile`
--

CREATE TABLE `teacher_profile` (
  `id` int(11) NOT NULL,
  `school_id` varchar(11) NOT NULL,
  `emp_no` varchar(11) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `t_birthday` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `t_age` varchar(255) NOT NULL,
  `t_status` varchar(255) NOT NULL,
  `t_number` varchar(255) NOT NULL,
  `t_address` varchar(255) NOT NULL,
  `n_training` varchar(255) NOT NULL,
  `t_training` varchar(255) NOT NULL,
  `t_attended` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher_profile`
--

INSERT INTO `teacher_profile` (`id`, `school_id`, `emp_no`, `designation`, `fname`, `email_address`, `t_birthday`, `sex`, `t_age`, `t_status`, `t_number`, `t_address`, `n_training`, `t_training`, `t_attended`) VALUES
(0, '304401', '12345612', '', 'Blair', '', '0', '', '0', '0', '0', '0', '', '', ''),
(0, '32312', '1231123', '', 'Nestle', '', '0', '', '0', '0', '0', '0', '', '', ''),
(3, '304401', '1234678', '', 'Jon Aegon', '', '0', '', '0', '0', '0', '0', 'Computer System Servicing NC II', 'Technical', 'March 18, 2018'),
(1, '304401', '12345678', '', 'Blair Brian', '', '09/15/1991', '', '31', 'Married', '09517974460', 'Santa Cruz, Davao del Sur', 'Horticulture NC II', 'Technical', '2018'),
(6, '304401', '123566123', 'Teacher II', 'Nestle', 'nestle', '', '', '', '', '', '', '', '', ''),
(7, '304401', '12571235', 'Master Teacher II', 'Jon', 'jonaegon.torres@deped.gov.ph', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `mobile` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `email_verified_at`, `mobile`, `image`, `role`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Blair Brian', 'Torres', 'blairbrian@deped.gov.ph', NULL, '09517974460', ' ', 'admin', '$2y$10$W1XUushyjUSE./5Ffq10S.ExBhrtFj3BtvzqQGb2/T9LX2z9qR8Ua', NULL, NULL, NULL),
(2, 'Nestle Anne', 'Torres', 'nestle@deped.gov.ph', NULL, '09303412189', ' ', 'user', '$2y$10$W1XUushyjUSE./5Ffq10S.ExBhrtFj3BtvzqQGb2/T9LX2z9qR8Ua', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approval`
--
ALTER TABLE `approval`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `educ_background`
--
ALTER TABLE `educ_background`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `physical_facilities`
--
ALTER TABLE `physical_facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_add`
--
ALTER TABLE `school_add`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_head_info`
--
ALTER TABLE `school_head_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_info`
--
ALTER TABLE `school_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_profile`
--
ALTER TABLE `school_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approval`
--
ALTER TABLE `approval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `educ_background`
--
ALTER TABLE `educ_background`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `physical_facilities`
--
ALTER TABLE `physical_facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `school_add`
--
ALTER TABLE `school_add`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `school_head_info`
--
ALTER TABLE `school_head_info`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `school_info`
--
ALTER TABLE `school_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_profile`
--
ALTER TABLE `school_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
