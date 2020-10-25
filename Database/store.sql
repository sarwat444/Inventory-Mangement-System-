-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 25 أكتوبر 2020 الساعة 09:35
-- إصدار الخادم: 10.4.10-MariaDB
-- PHP Version: 7.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `university`
--

-- --------------------------------------------------------

--
-- بنية الجدول `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `quantinty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `category`
--

INSERT INTO `category` (`id`, `name`, `quantinty`) VALUES
(1, 'جهاز اساسى ', 88888),
(2, 'جهاز رئيسى ', 8000);

-- --------------------------------------------------------

--
-- بنية الجدول `conferance`
--

CREATE TABLE `conferance` (
  `ID` int(11) NOT NULL,
  `Name` varchar(225) NOT NULL,
  `description` varchar(225) NOT NULL,
  `date` date NOT NULL,
  `location` varchar(225) NOT NULL,
  `userid` int(11) NOT NULL,
  `approve1` int(11) NOT NULL DEFAULT 0,
  `approve2` int(11) NOT NULL DEFAULT 0,
  `approve3` int(11) NOT NULL DEFAULT 0,
  `approve4` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `conferance`
--

INSERT INTO `conferance` (`ID`, `Name`, `description`, `date`, `location`, `userid`, `approve1`, `approve2`, `approve3`, `approve4`) VALUES
(4, 'التعاون بين الشركات التكنولوجيه  ', 'xxxxxxxxxxxxxxxxxxxxxxxxx', '2020-03-16', 'القاهره', 4, 1, 1, 1, 1),
(5, 'بنها العسل  ', 'hhhhhhhhhhhhhhhhhhhhh', '2020-03-16', 'القاهره', 4, 1, 1, 0, 0),
(6, 'dasdasd', 'dsadsa', '2020-08-13', '', 4, 0, 0, 0, 0),
(7, 'القريه الذكيه ', 'Description ', '2020-08-16', 'cairo ', 4, 1, 1, 1, 1),
(8, 'القاهره  الكبرى  ', 'test', '2020-08-17', 'cairo ', 4, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- بنية الجدول `faculty`
--

CREATE TABLE `faculty` (
  `F_ID` int(11) NOT NULL,
  `Name` varchar(225) NOT NULL,
  `universtyID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `faculty`
--

INSERT INTO `faculty` (`F_ID`, `Name`, `universtyID`) VALUES
(1, 'الحاسبات  والمعلومات', 1);

-- --------------------------------------------------------

--
-- بنية الجدول `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `title` varchar(225) NOT NULL,
  `company_name` varchar(225) NOT NULL,
  `model_no` int(11) NOT NULL,
  `made_in` varchar(225) NOT NULL,
  `quantinty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `tawred_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `items`
--

INSERT INTO `items` (`id`, `name`, `title`, `company_name`, `model_no`, `made_in`, `quantinty`, `price`, `cat_id`, `tawred_id`) VALUES
(7, 'mouse ', '', 'google', 145780, 'المانيا ', 50, 0, 1, 2),
(8, 'test', '', 'fd', 15885, 'مصر', 2, 0, 2, 2);

-- --------------------------------------------------------

--
-- بنية الجدول `momarsa`
--

CREATE TABLE `momarsa` (
  `id` int(11) NOT NULL,
  `unite_name` varchar(225) NOT NULL,
  `momarsa_date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `total` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- بنية الجدول `momarsa_items`
--

CREATE TABLE `momarsa_items` (
  `id` int(11) NOT NULL,
  `momarsa_id` int(11) NOT NULL,
  `unit_name` varchar(225) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `momarsa_items`
--

INSERT INTO `momarsa_items` (`id`, `momarsa_id`, `unit_name`, `price`, `quantity`) VALUES
(1, 1, 'test', 100, 2),
(2, 2, 'test', 100, 2),
(3, 1, 'laptop', 50, 2),
(4, 1, 'mouse', 20, 2);

-- --------------------------------------------------------

--
-- بنية الجدول `sarf`
--

CREATE TABLE `sarf` (
  `id` int(11) NOT NULL,
  `unite_name` varchar(225) NOT NULL,
  `sarf_date` date NOT NULL,
  `sarf_reason` varchar(225) NOT NULL,
  `total` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- بنية الجدول `sarf_items`
--

CREATE TABLE `sarf_items` (
  `id` int(11) NOT NULL,
  `sarf_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `sarf_items`
--

INSERT INTO `sarf_items` (`id`, `sarf_id`, `unit_id`, `price`, `quantity`) VALUES
(3, 3, 1, 100, 2),
(5, 4, 1, 800, 2),
(6, 4, 1, 100, 2),
(7, 3, 1, 150, 2),
(8, 3, 1, 100, 2),
(9, 3, 1, 100, 2),
(10, 3, 1, 100, 2),
(11, 3, 1, 100, 2),
(12, 3, 1, 100, 1),
(13, 4, 1, 100, 5),
(14, 3, 1, 500, 1),
(15, 4, 1, 3, 20),
(16, 4, 1, 100, 20),
(17, 4, 1, 100, 1),
(18, 4, 1, 10, 1),
(19, 4, 1, 500, 1),
(20, 4, 1, 655, 20),
(21, 3, 1, 10, 2),
(22, 3, 8, 100, 2);

-- --------------------------------------------------------

--
-- بنية الجدول `taraf`
--

CREATE TABLE `taraf` (
  `id` int(11) NOT NULL,
  `Description` varchar(225) NOT NULL,
  `Doctorid` int(11) NOT NULL,
  `approve1` tinyint(4) NOT NULL DEFAULT 0,
  `approve2` tinyint(4) NOT NULL DEFAULT 0,
  `approve3` tinyint(4) NOT NULL DEFAULT 0,
  `approve4` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `taraf`
--

INSERT INTO `taraf` (`id`, `Description`, `Doctorid`, `approve1`, `approve2`, `approve3`, `approve4`) VALUES
(6, 'اتقذم بطلب  اخلاء الطرف  .....................................', 4, 0, 0, 0, 0),
(7, 'طلب الموافقه على  اخلاء  طرف  ', 4, 0, 0, 0, 0),
(8, 'test', 4, 0, 0, 0, 0),
(9, 'اتقدم  بطلب اخلاء  طرف  من  ....................', 4, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- بنية الجدول `tawred`
--

CREATE TABLE `tawred` (
  `id` int(11) NOT NULL,
  `unite_name` varchar(225) NOT NULL,
  `tawred_date` date NOT NULL,
  `total` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- بنية الجدول `universt`
--

CREATE TABLE `universt` (
  `U_ID` int(11) NOT NULL,
  `Name` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `universt`
--

INSERT INTO `universt` (`U_ID`, `Name`) VALUES
(1, 'بنها\r\n');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `Email` varchar(225) NOT NULL,
  `specialization` varchar(225) NOT NULL,
  `FullName` varchar(225) NOT NULL,
  `phone` varchar(225) NOT NULL,
  `GroupID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `IDe` varchar(225) NOT NULL,
  `job_place` varchar(225) NOT NULL,
  `Image` varchar(225) NOT NULL,
  `faculityid` int(11) NOT NULL,
  `fileno` varchar(225) NOT NULL,
  `hiring_date` date NOT NULL,
  `job` varchar(225) NOT NULL,
  `allowances` int(11) NOT NULL,
  `nationalty` varchar(225) NOT NULL,
  `position` varchar(225) NOT NULL,
  `salary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`UserID`, `Username`, `password`, `Email`, `specialization`, `FullName`, `phone`, `GroupID`, `Date`, `IDe`, `job_place`, `Image`, `faculityid`, `fileno`, `hiring_date`, `job`, `allowances`, `nationalty`, `position`, `salary`) VALUES
(4, 'mohamed', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Moahmed@gmail.com', 'علوم حواسب ', 'يبيmohamed', '01068255245', 0, '2020-03-08', '12345667899', 'jkljljlkjljlكليه الحاسبات  والمعلومات  ', 'test.png', 1, '10558', '2020-03-17', 'مدرس بكليه الحاسبات ', 1, 'مصرى ', 'استاذ مساعد', 8000),
(5, 'test1', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Ali@gmail.com', 'نظم المعلومات  ', 'Ali ELSYED', '01254868681', 1, '2020-03-10', '23654889555', 'كليه الحاسبات  والمعلومات  ', 'test.png', 1, '125544888', '2020-03-04', 'مدرس بكليه الحاسبات ', 1, 'مصرى ', 'استاذ مساعد', 5000),
(6, 'test2', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Ali@gmal.com', 'نظم المعلومات  ', 'ALI mOHAMED ', '01065289898', 2, '2020-03-04', '255886666', 'كليه الحاسبات  والمعلومات  ', 'test.png', 1, '1452', '2020-03-05', 'مدرس بكليه الحاسبات ', 1, 'مصرى ', 'استاذ مساعد', 80000),
(7, 'test3', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Mona@gaml.doo', 'نظم المعلومات  ', 'mona Ahmed ', '01585457458', 3, '2020-03-16', '142226533', 'كليه الحاسبات  والمعلومات  ', 'test.png', 1, '555222', '2020-03-09', ',مدرس بكليه الحاسبات ', 1, 'مصرى ', 'استاذ مساعد', 5000),
(8, 'test4', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Elsayed@gmail.com', 'علوم الحواسب ', 'السيد على السيد ', '01062054578', 4, '2020-03-24', '12365874458885', 'كليه الحاسبات والمعلومات  ', 'test.png', 1, '145885', '2020-03-03', 'أستاذ مساعد ', 1, 'مصرى ', 'كليه  الحاسبات والمعلومات ', 8000);

-- --------------------------------------------------------

--
-- بنية الجدول `vacation`
--

CREATE TABLE `vacation` (
  `V_ID` int(11) NOT NULL,
  `Name` varchar(225) NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `vacation`
--

INSERT INTO `vacation` (`V_ID`, `Name`, `Description`) VALUES
(1, 'أجازة رعاية طفل', '١ -تتقدم الموظفة بطلب للحصول على اجازة رعایة طفل، وترفق بطلبھا شھادة میلاد الطفل\r\nالى الكادر العام.\r\n٢ -یتم عرض الطلب على أمین الكلیة، ومن ثم عرضھ على السید أ.د./ عمید الكلیة للموافقة\r\nفى ضوء التفویضات الممنوحة لھ.\r\n٣ -تقوم الموظفة بعمل إخلاء طرف قبل القیام بالإجازة، ثم تقدیمھ الى شئوهى اجازة تمنح لعضو هيئة التدريس ومعاونيهم ( من الاناث فقط ) ولا تزيد مدتها عن 6 سنوات طوال مدة الخدمة وتكون بدون مرتب ويمكن منحها لمدة عاميين متتالين بشرط الا يزيد عمر اصغر الابناء عن 18 عام .'),
(2, 'اجازه خاصه لمرافقه الزوج /الزوجه', ' هى اجازة تمنح لعضو هيئة التدريس ومعاونيهم لمرافقة ( الزوج/الزوجة ) وتكون بدون مرتب وحسب مدة عقد الطرف المسافر وتجدد الاجازة لمدد اخرى بناء على طلب الموفد فى الاجازة على ان يستوفى الشروط اللازمة .'),
(3, 'اجازة اعتيادى', 'هى اجازة تمنح لعضو هيئة التدريس لمدة محدده سنويا بمرتب .\r\n4-5 الندب فى اوقات العمل الغير رسمية: يمنح عضو هيئة التدريس فرصه للعمل فى غير اوقات العمل الرسمية بحد اقصى يومين فى الاسبوع .'),
(4, 'منح الاجازة الاعتيادى', 'هى اجازة تمنح لعضو هيئة التدريس لمدة محدده سنويا بمرتب .'),
(5, 'أجازه الوضع ', 'یمنح القانون الحق للموظفة الحق فى الحصول على أجازة وضع لمدة ثلاثة شھور،\r\nبمرتب كامل، وثلاث مرات خلال حیاتھا الوظیفیة.'),
(6, 'الاجازة الخاصة لرعایة الاسرة', 'یقوم الموظف بتقدیم طلب للكادر العام للحصول على أجازة خاصة لرعایة الاسرة،\r\nویرفق بھ شھادة مرضیة للوالد أوالوالده أو نجلة');

-- --------------------------------------------------------

--
-- بنية الجدول `vaction_requests`
--

CREATE TABLE `vaction_requests` (
  `RequestID` int(11) NOT NULL,
  `visa` varchar(225) NOT NULL,
  `Marriage_Certificate` varchar(225) NOT NULL,
  `work_permit` varchar(225) NOT NULL,
  `residence` varchar(225) NOT NULL,
  `report_child_care` varchar(225) NOT NULL,
  `Add_Date` date NOT NULL,
  `contract` varchar(225) NOT NULL,
  `birth_certificate` varchar(225) NOT NULL,
  `martial_status` int(11) NOT NULL,
  `Social_Solidarity_Fund` varchar(225) NOT NULL,
  `Vacation_ID` int(11) NOT NULL,
  `Doctor_ID` int(11) NOT NULL,
  `Sick_note` varchar(255) NOT NULL,
  `approve1` int(11) NOT NULL DEFAULT 0,
  `approve2` int(11) NOT NULL DEFAULT 0,
  `approve3` int(11) NOT NULL DEFAULT 0,
  `approve4` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- إرجاع أو استيراد بيانات الجدول `vaction_requests`
--

INSERT INTO `vaction_requests` (`RequestID`, `visa`, `Marriage_Certificate`, `work_permit`, `residence`, `report_child_care`, `Add_Date`, `contract`, `birth_certificate`, `martial_status`, `Social_Solidarity_Fund`, `Vacation_ID`, `Doctor_ID`, `Sick_note`, `approve1`, `approve2`, `approve3`, `approve4`) VALUES
(4, '', '', '', '', 'طلب  مقدم من  ...... بخصوص  طلب  اجازه  ..... xxxxx', '2020-03-08', '', '', 0, '', 6, 4, '1921_3description sanf.PNG', 1, 1, 1, 0),
(5, '7490_3description sanf.PNG', '51342_3description sanf.PNG', '80727_3description sanf.PNG', '37807_3description sanf.PNG', 'طلب  مقدم من  ...... بخصوص  طلب  اجازه  ..... xxxxx', '2020-03-08', '', '', 0, '', 2, 4, '', 1, 1, 1, 1),
(6, '', '', '', '', 'طلب  مقدم من  ...... بخصوص  طلب  اجازه  ..... xxxxx', '2020-03-11', '', '54801_3description sanf.PNG', 0, '', 1, 4, '', 1, 1, 1, 1),
(7, '74017_3description sanf.PNG', '2268_3description sanf.PNG', '33367_3description sanf.PNG', '63624_3description sanf.PNG', 'طلب  مقدم من  ...... بخصوص  طلب  اجازه  ..... xxxxx', '2020-03-11', '', '', 0, '', 2, 4, '', 1, 2, 0, 0),
(8, '', '', '', '', 'طلب  مقدم من  ...... بخصوص  طلب  اجازه  ..... xxxxx', '2020-03-11', '', '70228_3description sanf.PNG', 0, '', 1, 4, '', 1, 1, 1, 1),
(9, '', '', '', '', 'طلب  مقدم من  ...... بخصوص  طلب  اجازه  ..... xxxxx', '2020-03-11', '', '51252_3description sanf.PNG', 0, '', 5, 4, '', 1, 1, 0, 0),
(10, '', '', '', '', 'طلب  مقدم من  ...... بخصوص  طلب  اجازه  ..... xxxxx', '2020-03-12', '', '', 0, '', 6, 4, '15754_3description sanf.PNG', 1, 0, 1, 0),
(11, '', '', '', '', 'طلب  مقدم من  ...... بخصوص  طلب  اجازه  ..... xxxxx', '2020-03-12', '', '', 0, '', 6, 4, '19690_3description sanf.PNG', 1, 1, 1, 1),
(12, '', '', '', '', 'طلب  مقدم من  ...... بخصوص  طلب  اجازه  ..... xxxxx', '2020-03-12', '', '', 0, '', 6, 4, '90406_3description sanf.PNG', 1, 0, 0, 0),
(15, '', '', '', '', 'طلب  مقدم من  ...... بخصوص  طلب  اجازه  ..... xxxxx', '2020-03-16', '', '', 0, '', 6, 4, '24328_', 1, 1, 1, 0),
(16, '', '', '', '', 'طلب  مقدم من  ...... بخصوص  طلب  اجازه  ..... xxxxx', '2020-03-16', '', '', 0, '', 6, 4, '87908_manzoma (1).sql', 1, 1, 1, 0),
(17, '', '', '', '', 'طلب  مقدم من  ...... بخصوص  طلب  اجازه  ..... xxxxx', '2020-03-16', '', '', 0, '', 6, 4, '46517_فكيها_بقى .png', 1, 1, 1, 0),
(18, '', '', '', '', 'طلب  مقدم من  ...... بخصوص  طلب  اجازه  ..... xxxxx', '2020-03-16', '', '75232_فكيها_بقى .png', 0, '', 1, 4, '', 1, 1, 1, 0),
(19, '9145_فكيها_بقى .png', '79326_فكيها_بقى .png', '76319_فكيها_بقى .png', '64672_فكيها_بقى .png', 'طلب  مقدم من  ...... بخصوص  طلب  اجازه  ..... xxxxx', '2020-03-16', '', '', 0, '', 2, 4, '', 1, 1, 1, 1),
(20, '', '', '', '', 'طلب  مقدم من  ...... بخصوص  طلب  اجازه  ..... xxxxx', '2020-03-16', '', '98690_1-تسجيل  الدخول .PNG', 0, '', 5, 4, '', 1, 1, 1, 0),
(21, '', '', '', '', 'طلب  مقدم من  ...... بخصوص  طلب  اجازه  ..... xxxxx', '2020-03-16', '', '', 0, '', 6, 4, '30072_1-تسجيل  الدخول .PNG', 1, 1, 1, 0),
(22, '', '', '', '', '1mohamed', '2020-03-16', '', '39381_فكيها_بقى .png', 0, '', 1, 4, '', 1, 1, 0, 0),
(23, '', '', '', '', '', '2020-03-16', '', '', 0, '', 6, 4, '69810_فكيها_بقى .png', 1, 1, 0, 0),
(25, '29965_فكيها_بقى .png', '79999_فكيها_بقى .png', '28136_فكيها_بقى .png', '38166_فكيها_بقى .png', '', '2020-03-16', '', '', 0, '', 2, 4, '', 1, 1, 1, 1),
(26, '', '', '', '', '', '2020-03-16', '', '', 0, '', 6, 4, '79526_أضافه أمر توريد جديد.PNG', 1, 0, 0, 0),
(27, '', '', '', '', 'لببابتبببابابتتببت', '2020-08-13', '', '43835_44583340_498951233915988_3075471358763728896_o.jpg', 0, '', 1, 6, '', 1, 0, 0, 0),
(28, '', '', '', '', 'تتلتلتلت', '2020-08-16', '', '68923_', 0, '', 1, 4, '', 0, 0, 0, 0),
(29, '', '', '', '', 'تتلتلتلت', '2020-08-16', '', '5795_', 0, '', 1, 4, '', 0, 0, 0, 0),
(30, '', '', '', '', 'dfsdfsfsdfsdfs', '2020-08-16', '', '33542_', 0, '', 1, 4, '', 0, 0, 0, 0),
(31, '', '', '', '', 'dfsdfsfsdfsdfs', '2020-08-16', '', '48456_', 0, '', 1, 4, '', 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conferance`
--
ALTER TABLE `conferance`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `r18` (`userid`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`F_ID`),
  ADD KEY `R1` (`universtyID`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rr` (`cat_id`);

--
-- Indexes for table `momarsa`
--
ALTER TABLE `momarsa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `momarsa_items`
--
ALTER TABLE `momarsa_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sarf`
--
ALTER TABLE `sarf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sarf_items`
--
ALTER TABLE `sarf_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `H55` (`sarf_id`);

--
-- Indexes for table `taraf`
--
ALTER TABLE `taraf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tawred`
--
ALTER TABLE `tawred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `universt`
--
ALTER TABLE `universt`
  ADD PRIMARY KEY (`U_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `j1` (`faculityid`);

--
-- Indexes for table `vacation`
--
ALTER TABLE `vacation`
  ADD PRIMARY KEY (`V_ID`);

--
-- Indexes for table `vaction_requests`
--
ALTER TABLE `vaction_requests`
  ADD PRIMARY KEY (`RequestID`),
  ADD KEY `h1` (`Vacation_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `conferance`
--
ALTER TABLE `conferance`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `F_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `momarsa`
--
ALTER TABLE `momarsa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `momarsa_items`
--
ALTER TABLE `momarsa_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sarf`
--
ALTER TABLE `sarf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sarf_items`
--
ALTER TABLE `sarf_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `taraf`
--
ALTER TABLE `taraf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tawred`
--
ALTER TABLE `tawred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `universt`
--
ALTER TABLE `universt`
  MODIFY `U_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vacation`
--
ALTER TABLE `vacation`
  MODIFY `V_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vaction_requests`
--
ALTER TABLE `vaction_requests`
  MODIFY `RequestID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- قيود الجداول المحفوظة
--

--
-- القيود للجدول `conferance`
--
ALTER TABLE `conferance`
  ADD CONSTRAINT `r18` FOREIGN KEY (`userid`) REFERENCES `users` (`UserID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `faculty`
--
ALTER TABLE `faculty`
  ADD CONSTRAINT `R1` FOREIGN KEY (`universtyID`) REFERENCES `universt` (`U_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `rr` FOREIGN KEY (`cat_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `j1` FOREIGN KEY (`faculityid`) REFERENCES `faculty` (`F_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- القيود للجدول `vaction_requests`
--
ALTER TABLE `vaction_requests`
  ADD CONSTRAINT `h1` FOREIGN KEY (`Vacation_ID`) REFERENCES `vacation` (`V_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
