-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 06, 2026 at 09:44 AM
-- Server version: 10.6.24-MariaDB-cll-lve
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kerala_congress`
--

-- --------------------------------------------------------

--
-- Table structure for table `dist_authority`
--

CREATE TABLE `dist_authority` (
  `id` int(6) UNSIGNED NOT NULL,
  `district` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dist_authority`
--

INSERT INTO `dist_authority` (`id`, `district`, `username`, `email`, `phone`, `password`, `reg_date`) VALUES
(1, 'Ernakulam', 'hello', 'nikhilkodumon@gmail.com', '07560879155', '$2y$10$fz7twgDBZpxQvT6gz0suwO8tNl08dgNUarbQGoYspV3Ih4NdGhRWW', '2024-07-17 19:35:47'),
(2, 'Alappuzha', 'admin_alleppy', 'nikhiljp.skj@gmail.com', '7560879155', '$2y$10$q9DiadWXXyv.Z/GY2C.VxONpEpYvypU9T5ChWM6ZNcWY1jGw9.Hdu', '2025-01-25 14:08:24');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `reg_no` int(11) DEFAULT NULL,
  `fname` varchar(150) NOT NULL,
  `lname` varchar(150) NOT NULL,
  `membership` varchar(200) NOT NULL,
  `aadhaar` bigint(20) DEFAULT NULL,
  `address` varchar(550) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `dateofbirth` date DEFAULT NULL,
  `fathername` varchar(200) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `caste` varchar(50) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `blood` varchar(10) DEFAULT NULL,
  `photo` varchar(555) DEFAULT NULL,
  `district` varchar(150) DEFAULT NULL,
  `assembly` varchar(250) DEFAULT NULL,
  `selfgovt` varchar(250) DEFAULT NULL,
  `ward` varchar(150) DEFAULT NULL,
  `president` varchar(550) DEFAULT NULL,
  `secretary` varchar(550) DEFAULT NULL,
  `reference` varchar(500) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `reg_no`, `fname`, `lname`, `membership`, `aadhaar`, `address`, `email`, `mobile`, `dateofbirth`, `fathername`, `religion`, `caste`, `gender`, `blood`, `photo`, `district`, `assembly`, `selfgovt`, `ward`, `president`, `secretary`, `reference`, `status`) VALUES
(33, 60708, 'Nikhil', 'Prakash', 'Kerala IT & Professional Congress (KITPROC)', 1234567, 'Prakash Bhavanam, Aickadu, Kodumon P.O', 'nikhilkodumon@gmail.com', 7560879155, '2024-07-30', 'JP', 'Hin', 'Ezh', 'Male', 'O+', 'uploads/34169.jpg', 'Ernakulam', ' Aluva ', 'Manjapra', '34', 'Apu John Joseph', 'Jais John Vettiyar', 'Jais', 1),
(37, 35778, 'Antony ', 'Tom', 'Kerala Congress', 0, 'Nilappana (H)\r\nPulincunnoo.p.o\r\nAlappuzha', 'antonynilappana@gmail.com', 9495044627, '1996-09-11', 'Tom Antony', 'Christian', 'Syromalabar Syrian catholic', 'Male', 'O+', 'uploads/Screenshot_2023-09-28-12-06-14-252-edit_com.camerasideas.instashot-removebg-preview.png', 'Alappuzha', ' Kuttanad ', 'Champakkulam', '3', '-', '-', 'Jose koippally', 1),
(38, 76476, 'Praveen', 'Kumar', 'Kerala Congress', 438865152925, 'Mullackal, Manjoor po, Kottayam 686603', 'pkottayam040@gmail.com', 9497773905, '1971-05-25', 'Praveen Kumar', 'Hindu ', 'Nair', 'Male', 'B+', 'uploads/', 'Kottayam', ' Kaduthuruthy ', 'Uzhavoor', '10', '-', '-', 'CM.George ', 0),
(39, 26916, 'Dinesh', 'Varughese', 'Kerala Congress', 0, 'Vedikattil \r\nThelliyoor p.o\r\nVennikulam ', '', 9745667355, '1991-05-15', 'V K Varughese ', 'Christian ', 'Marthoma', 'Male', 'O+', 'uploads/Self.jpg', 'Pathanamthitta', ' Ranni ', 'Ezhumattoor', '11', '-', '-', '', 0),
(40, 95972, 'Revathi', 'Nambiar', 'Kerala Congress', 0, 'Manathanath (H), Irivallur, Chelannur\r\nAmbalappad', 'revathinambiar279@gmail.com', 7736084262, '2003-11-16', 'Rajeev K ', '', '', 'Female', 'B+', 'uploads/', 'Kozhikode', ' Elathur ', 'Elathur', '6', '-', '-', '', 0),
(41, 55775, 'Jais John ', 'Vettiyar', 'Kerala IT & Professional Congress (KITPROC)', 0, 'Kaleekamekathil Daya \r\nMankamkyzhi po\r\nMavelikara', 'jaisvettiyar@yahoo.com', 9447355775, '1981-08-09', 'KC John', 'Christian', '', 'Male', 'A+', 'uploads/IMG_6159.jpeg', 'Alappuzha', ' Mavelikkara ', 'Thazhakara', '13', 'Apu John Joseph', 'Jais John Vettiyar', 'Self', 1),
(43, 99761, 'Sreejith Mariyial ', 'Mariyial', 'Kerala Congress', 753936892582, 'Unnikkat House Rama Bhavan Near Kannukkottukavu Temple Gandhi Nagar Colony Pirayiri Palakkad 678004', 'jithumenon85@gmail.com', 9562263893, '1985-06-02', 'Rajeswara Menom', 'Hindu ', 'Nair', 'Male', 'B+', 'uploads/Poster.jpg', 'Palakkad', ' Palakkad ', 'Pirayiri Panchayats in Palakkad Taluk', '10', '-', '-', 'Ismail ', 0),
(44, 10936, 'Sreejith Mariyial ', 'Mariyial', 'Kerala Samskarika Vedi', 753936892582, 'Unnikkat House Rama Bhavan Near Kannukkottukavu Temple Gandhi Nagar Colony Pirayiri Palakkad ', 'jithumenon85@gmail.com', 9495654647, '1985-06-02', 'Rajeswara Menom', 'Hindu ', 'Nair', 'Male', 'B+', 'uploads/Poster.jpg', 'Palakkad', ' Palakkad ', 'Pirayiri Panchayats in Palakkad Taluk', '10', '-', '-', 'Shiyaz Muhammed ', 0),
(45, 32373, 'Wilson', 'Mechery ', 'Kerala IT & Professional Congress (KITPROC)', 482496334552, 'Wilson mp\r\nMechery house \r\nElinjipra post\r\nChalakudy 680721\r\nThrissur ', 'mpwilson333@gmail.com', 9349020333, '1969-02-05', 'Porinchu ', 'Christian ', 'Rc', 'Male', 'B+', 'uploads/Screenshot_2025_0208_122016.png', 'Thrissur', ' Chalakudy ', 'Kodassery', '19', 'Apu John Joseph', 'Jais John Vettiyar', 'CV Kuriakose', 0),
(46, 44731, 'JOY ', 'CHITILAPILLY', 'Kerala Congress', 745306452393, 'CHITILAPILLY HOUSE\r\nCHIRAYAM, PANAYIKULAM', 'joychitilapilly@gmail.com', 9496991946, '1988-05-14', 'BABYCHAN', 'CHRISTIAN', '', 'Male', 'O+', 'uploads/FB_IMG_1632883961646 (1).jpg', 'Ernakulam', ' Kalamassery ', 'Alangad', '15', '-', '-', '', 0),
(47, 21816, 'MiguelSop', 'MiguelSop', 'Kerala Fishermen Forum', 2096, 'https://buyviagraonlinet.com/', 'kertyucds@onet.eu', 8549282777, '1982-08-05', 'MiguelSop', 'Protestant', 'Tryker', '1', 'AB+', '', '', '', '', '5674', '', '', 'google', 0),
(48, 51391, 'Anugrah ', 'Muraleedharan ', 'Kerala Congress', 381145310488, 'Alappat house, kalavoor. P. O, kattoor, Alappuzha ', 'anugrahmuraleedharan2124@gmail.com', 9605482124, '1983-05-25', 'A G Muraleedharan ', 'Hindu ', 'Sc', 'Male', 'AB+', 'uploads/JPEG_20250210_115431_901103801209261735.jpg', 'Alappuzha', ' Alappuzha ', 'Mararikkulam South Panchayats in Ambalappuzha Taluk', '22', '-', '-', '', 0),
(49, 65684, 'Abhimanue ', 'Sajilesh ', 'Kerala Congress', 802417644482, 'Kuzhiyathupadeettethil, Valiyakulangara PO Kulanjikarazhma,  Alappuzha District,  690104', 'jithusamuel66@gmail.com', 89215, '2007-03-09', 'Sajilesh S', 'Hindu ', 'Ezhava', 'Male', 'AB-', 'uploads/17492845127751563242709584976541.jpg', 'Alappuzha', ' Chengannur ', 'Mannar', '14', '-', '-', 'Mahatma gandhi ', 0),
(50, 66280, 'Harisankar s', 'Harisankar s', 'Kerala Congress', 957995541241, 'KULASHAKARAPURAM\r\nKS PURAM.', 'harihari8200@gmail.com', 9961819433, '2000-09-29', 'Sreejithlal ', 'Nair', 'Hindu ', 'Male', 'AB+', 'uploads/Screenshot_20250606_193234.jpg', 'Kollam', ' Karunagappally ', ' Kulasekharapuram', '14', '-', '-', '', 0),
(51, 61546, 'Sibin p', 'P', 'Kerala Congress', 226335163160, 'Sibin,puthramannil,arakkuparambu, perinthalmanna, Malappuram ', 'puthramannilshibin@gmail.com', 8590675644, '2002-09-25', 'Sibin p', 'Hindu ', 'Sc', 'Male', 'O+', 'uploads/IMG-20250618-WA0196.jpg', 'Malappuram', ' Perinthalmanna ', 'Thazhekode', '09', '-', '-', '', 0),
(52, 49473, 'Jose', 'Tv', 'Kerala Congress', 0, 'Thannickal House, house, upputhodu po upputhodu 685604', 'josethannickal@gmail.com', 9446804518, '1955-06-16', 'Varghese ', 'Rcsc', 'Rcsc', 'Male', 'O+', 'uploads/', 'Idukki', ' Idukki ', 'Vathikudy Panchayats in Udumbanchola Taluk', '17', '-', '-', 'Jose', 0),
(53, 89369, 'RAJKUMAR ', 'KUMAR ', 'Kerala Congress', 646163560364, '11/157A Gopal Nagar Agasthiyarpatti Ambasamudram taluka Tirunelveli district ', 'rajkumar.c31@gmail.com', 7598383445, '1979-10-18', 'Chelladurai ', 'Hindu', 'Pillai ', 'Male', 'O+', 'uploads/', 'Trivandrum', ' Thiruvananthapuram ', 'Ward 40 to 47', '42', '-', '-', 'Kanimol', 0),
(54, 32381, 'Ashif', 'Ca', 'Kerala Congress', 471661788539, 'Cherada Malappuram nilambur vadapuram vallikettu road 676542', 'caashif635@gmail.com', 7034491851, '1996-01-19', 'ABDHURAHIMAN', 'Muslim ', 'Sunni', 'Male', 'AB-', 'uploads/FB_IMG_1751626635243.jpg', 'Malappuram', ' Nilambur ', 'Nilambur', 'Vadapuram ', '-', '-', '', 0),
(55, 45182, 'MANU', 'MATHEW', 'Kerala Congress', 465789347640, 'NADUPARAMBIL (H)\r\nTHELLAKOM P.O\r\nKOTTAYAM', 'manunaduparamban@gmail.com', 9895454256, '1990-03-22', 'N.V MATHEW', 'CHRISTIAN', 'ROMAN CATHOLIC', 'Male', 'O+', 'uploads/IMG_MANU.JPG', 'Kottayam', ' Kottayam ', 'Kottayam Municipality', '1', '-', '-', '', 0),
(56, 62441, 'Jos', 'Erinjery', 'Kerala Congress', 0, 'Unity Nagar\r\nKuriachira', 'joserinjeryt@gmail.com', 9567515951, '1994-10-22', 'Tony Joseph ', '', '', 'Male', 'B-', 'uploads/', 'Thrissur', ' Ollur ', 'Wards No.12, 13, 23 to 31, 40 to 42 of Thrissur', '23', '-', '-', '', 0),
(57, 55387, 'Afsal', 'Afsal ', 'Kerala Congress', 680052948205, 'Vellappallil hous pambanar po peerumade Idukki ', 'afa848251@gmail.com', 8089676129, '1998-08-06', 'Noushad ', 'Muslim ', 'Islam ', 'Male', 'A+', 'uploads/', 'Idukki', ' Peerumade ', 'Peerumade', '10', '-', '-', 'No ', 0),
(58, 11483, 'ABIN', 'PHILIP', 'Kerala Congress', 341888511051, 'NIRAVIL GRACE VILLA\r\nATHIRUMKAL PO KOODAL \r\nPIN : 689693\r\nPATHANAMTHITTA DIST', 'abinphilip18@gmail.com', 7902323569, '1988-10-27', 'N I PHILIP', 'CHRISTIAN', 'MARTHOMA', 'Male', 'O+', 'uploads/abinphoto (3).jpg', 'Pathanamthitta', ' Konni ', ' Kalanjoor Panchayats in Adoor Taluk', '3', '-', '-', '', 0),
(59, 11457, 'Nandan ', 'S', 'Kerala Congress', 314415295144, 'Nandu bhavan kokkottela po Aryanad', 'nandan3068@gmail.com', 7510448236, '1997-08-01', 'Sanalkumar p', 'Hindu', 'Nair', 'Male', 'B+', 'uploads/', 'Trivandrum', ' Aruvikkara ', 'Aryanad', '2', '-', '-', '', 0),
(60, 57354, 'ABDUL NASAR ', 'VAZHA VALAPPIL ', 'Kerala Congress', 638319113909, 'MARIYUMMAS palliparamb \r\nPo kolachery kannur', 'naaspalliparambil@gmail.com', 7025730796, '1975-11-22', 'MUHAMMED AP', 'ISLAM', 'MUSLIM', 'Male', 'A+', 'uploads/Screenshot_2025-08-25-12-09-05-477_com.zhiliaoapp.musically.jpg', 'Kannur', ' Taliparamba ', 'Kolacherry', '8', '-', '-', '', 0),
(61, 34240, 'Abdul', 'Hakeem', 'Kerala Congress', 312688364155, 'Arifa Manzil , Near Pujavi Juma Masjid, Po Ozhinjvalappu , Galli Road Last , Kanhangad ,Kasargod', 'abdulhakeemph@gmail.com', 9008715802, '1991-08-19', 'Haneefa PA', 'Islam', 'Sunni', 'Male', 'O+', 'uploads/IMG_0932.JPG', 'Kasaragod', ' Kanhangad ', 'Kanhangad Muncipality', 'Nil', '-', '-', 'Nil', 0),
(62, 86822, 'RANEESH ', 'P R', 'Kerala Congress', 929539454163, 'Pollayil house 7/108, Chakkamadam, Mattanchery, \r\nPin: 682002\r\nDistrict : Ernakulam ', 'renishsuriyasfc@gmail.com', 8137927823, '1998-11-23', 'P E RAPHEL', 'christian ', 'Latin catholic', 'Male', 'O+', 'uploads/', 'Ernakulam', ' Kochi ', 'Wards No.1 to 10 and 19 to 25 of Kochi (M.Corporation) in Kochi Taluk', '9', '-', '-', '', 0),
(63, 58522, 'Ranjini', 'Shaji', 'Kerala Vanitha Congress', 892827670098, '11/703,Nandhanam,thilankkad,manjallur,thenkurussi 2, palakkad- 678502', 'ranjinirajesh22@gmail.com', 9361154738, '1981-07-18', 'Shaji', 'Hindu', 'Ezhava', 'Female', 'O+', 'uploads/IMG-20250828-WA0003.jpg', 'Palakkad', ' Alathur ', 'Thenkurissi', '', '-', '-', '', 0),
(64, 49993, 'WILSON ', 'JOE  THARAKAN', 'Kerala Congress', 724799505873, 'Panackal House            SeniorGround, Kunnamkulam\r\nThrissur, Kerala, 680503', 'wilsonjoetharakan@gmail.com', 8086354126, '1982-12-01', 'George Tharakan', 'Christian', 'Tharakan -Christian ', 'Male', 'O+', 'uploads/wilson.jpg', 'Thrissur', ' Kunnamkulam ', 'Kunnamkulam Municipality', '14', '-', '-', '', 0),
(65, 48275, 'Rebin', 'Arun', 'Kerala Students Congress (KSC)', 549569060281, 'Neelamvila veedu kizhekketheruvu P.O Kottarakkara', 'rebinarun369@gmail.com', 9645400934, '2003-08-06', 'Arun Alexander', 'Christian', 'Orthodox', 'Male', 'O+', 'uploads/LIBA25FT000478-Rebin Arun.jpg', 'Kollam', ' Kottarakkara ', ' Kottarakkara', 'Kizhakketheruvu', '-', '-', '', 0),
(66, 32099, 'JINO', 'JAMES', 'Kerala Pravasi Congress', 304193808078, 'ASSARIYATHU HOUSE\r\nKARIKATOOR P.O \r\nMANIMALA\r\n', 'james.jino91@gmail.com', 7338945036, '1991-03-03', 'James Varghese', 'Christian', 'Malankara Catholic', 'Male', 'O+', 'uploads/WhatsApp Image 2025-09-25 at 11.43.23 AM.jpeg', 'Kottayam', ' Kanjirappally ', 'Kanjirappally', '', '-', '-', '', 0),
(67, 39128, 'Shorn', 'Iqbal', 'Kerala Congress', 266079899745, 'house no 75\r\nLink Park Cross Road 3\r\nPachalam', 'thisisshorn@gmail.com', 8822888860, '1992-06-19', 'iqbal k i', 'muslim', 'islam', 'Male', 'B+', 'uploads/CYMERA_20250914_092746 (1).jpg', 'Ernakulam', ' Ernakulam ', 'Cheranalloor Panchayat in Kanayannur Taluk', '73', '-', '-', '', 0),
(68, 18685, 'RANJITH', 'JANARDHANAN', 'Kerala Congress', 319588336912, 'NEDUMPARAMBIL HOUSE\r\nKOOLIMUTTAM- MATHILAKAM\r\nTHRISSUR', 'ranjithnj986@gmail.com', 8089286196, '1986-01-15', 'JANARDHANAN', 'HINDHU', 'EZHAVA', 'Male', 'O+', 'uploads/IMG_6963.jpeg', 'Thrissur', ' Kaipamangalam ', 'Mathilakam', '1', '-', '-', 'JANARDHANAN', 0),
(69, 75912, 'Manikandan .S', 'Manikandan ', 'Kerala Youth Front (KYF)', 267238374468, 'MANI VILASAM, PUTTADY, PUTTADY P O, Anakkara, Puttady, Idukki. Kerala, 685551', 'ssree033@gmail.com', 8590481463, '1994-04-05', 'Shekhar ', 'Indhu', 'Thevar ', 'Male', 'B+', 'uploads/FB_IMG_1656306186762.jpg', 'Idukki', ' Idukki ', 'Kattappana', '8th', 'KV Kannan', '-', '', 0),
(70, 67652, 'joyan Sebastian ', 'Joseph ', 'Kerala Youth Front (KYF)', 302351753757, 'kaithakulangara chettayil (h) thellakom po. kottayam', 'joyansebastianjoseph@gmail.com', 9746700303, '1994-03-01', 'Joseph cd', 'Cristian ', 'RCSC', 'Male', 'B+', 'uploads/4065-E20.jpg', 'Kottayam', ' Ettumanoor ', 'Ettumanoor', '22', 'KV Kannan', '-', 'Jayamohan (municipality councillor ', 0),
(71, 39598, 'Albin', 'Joseph ', 'Kerala Congress', 413450620870, 'Kurianthanathu(H)\r\nPoovathodu PO\r\nPin 686578', '777albinjoseph@gmail.com', 8281933138, '1998-11-18', 'K T Joseph ', 'Christian ', 'RCSC', 'Male', 'B+', 'uploads/1761978348512184869456714870614.jpg', 'Kottayam', ' Poonjar ', 'Thidanad Panchayats in Meenachil Taluk', '16', '-', '-', '', 0),
(72, 22001, 'Renjuligi. R', 'Francis', 'Kerala Vanitha Congress', 926010226415, 'Sachin house\r\nPuthukurichy', 'rinjuliji993@gmail.com', 8848490548, '1993-03-29', 'Xavier', 'Christian ', 'Mukkuva', 'Female', 'O+', 'uploads/', 'Trivandrum', ' Chirayinkeezhu ', 'Kadinamkulam', '24', '-', '-', '', 0),
(73, 93481, 'Ajil', 'Joshy', 'Kerala Paddy Farmers Forum', 646827892987, 'Pallakkad\r\nMagalamdam', 'ajiljoshy2@gmail.com', 9061629417, '2003-08-28', 'Joshy P. T', '', '', 'Male', 'B+', 'uploads/Screenshot_20251124_213513_Gallery.jpg', 'Palakkad', ' Alathur ', 'Vandazhi Panchayats in Alathur Taluk', '', '-', '-', '', 0),
(74, 10834, 'Vishal', 'Johnny', 'Kerala Students Congress (KSC)', 888612704160, 'Krr Nagar 10th Street\r\nKrr nagar 10th street theni', 'vishaltheni2000@gmail.com', 6383189947, '2000-07-12', 'Kalidoss', 'Hindu', 'BC', 'Male', 'B+', 'uploads/IMG-20250801-WA0005.jpg', 'Idukki', ' Idukki ', 'Kattappana', 'Vishal', '-', '-', 'No', 0),
(75, 39248, 'vishnu', 'vishnu', 'Kerala Congress', 796590314669, 'Kallambalam\r\nKrishna kripa onnanpara navayikulam ', 'wwvishnu845@gemil.com', 9819847514, '1991-05-11', 'Subhash. S', 'Hindhu', 'Obc', 'Male', 'O+', 'uploads/', 'Trivandrum', ' Varkala ', 'Navaikulam', 'Navayikulam ', '-', '-', 'Siyad ', 0),
(76, 32526, 'S', 'HAKKEEM ', 'Kerala Congress', 0, '685, HAKKEEM HOUSE,THASSRACK ', 'THASSRACK@GMAIL.COM', 9994111405, '1982-05-05', 'SAILABUDEEN ', '', '', 'Male', 'A+', 'uploads/1000405941.jpg', 'Palakkad', ' Malampuzha ', NULL, '14', '-', '-', '', 0),
(77, 56512, 'Aysha', 'Nazeer', 'Kerala Congress', 0, 'Puthenroad kareelakulangara', 'ayshanazeer3249@gmail.com', 8714383931, '2004-02-28', 'Nazeer', '', '', 'Female', 'A+', 'uploads/', 'Alappuzha', ' Kayamkulam ', 'Kayamkulam Municipality', '1', '-', '-', 'Nil', 0),
(78, 12099, 'Gokul S', 'Gopan', 'Kerala IT & Professional Congress (KITPROC)', 757778944714, 'Gokulam,Vevila Nagar,Ookodu PO,Trivandrum', 'gokulsgpn1@gmail.com', 9495932096, '1994-07-24', 'S Gopakumar', 'Hindhu', 'Ezhava', 'Male', 'O+', 'uploads/', 'Trivandrum', ' Kovalam ', 'Kalliyoor', '3', 'Apu John Joseph', 'Jais John Vettiyar', '', 0),
(79, 52604, 'Jayesh ', 'M', 'Kerala Youth Front (KYF)', 385040359713, 'Mukesh bhvan murukkady kumily Idukki ', 'jayeshm3322@gmail.com', 8590392771, '2005-11-07', 'Marimuthu ', 'Hindu ', 'Sc', 'Male', 'AB+', 'uploads/170185777 Jayesh-.jpg', 'Idukki', ' Peerumade ', 'Kumily', '20', 'KV Kannan', '-', '', 0),
(80, 78146, 'Louigi', 'Loui', 'Kerala Youth Front (KYF)', 0, 'Ozhukayil \r\nVayala P. O.\r\nKottayam ', 'louigilouis@gmail.com', 9656988800, '1987-09-13', 'Louis', 'Kottayam ', 'Kerala ', 'Male', 'AB+', 'uploads/', 'Kottayam', ' Kaduthuruthy ', 'Kadaplamattom', 'Kadaplamattom ', 'KV Kannan', '-', 'Brijith ', 0),
(81, 79642, 'MUBIL', 'HAQ P P', 'Kerala Congress', 888843738434, 'PARIPARAMBATH HOUSE KODAKKAD PO CHETTIPPADI VIA MALAPPURAM DT KERALA PIN 676319', 'mubilhaqpp@gmail.com', 8139865850, '1997-09-22', 'abdul rahiman p p', 'islam', 'mappila', 'Male', 'O+', 'uploads/WhatsApp Image 2025-12-16 at 1.40.17 PM.jpeg', 'Malappuram', ' Vallikunnu ', 'Vallikkunnu Panchayats in Tirurangadi Taluk', '15', '-', '-', 'vallikkunnu grama panchayath ward 15 member  kanakan ', 0),
(82, 64034, 'Nishad ', 'Pk', 'Kerala Youth Front (KYF)', 881622716759, 'Padinjarkara house akalur po palakkad ', 'daddsmalldad@gmail.com', 8921592906, '1996-05-14', 'Abdul Azeez pk', 'Muslim ', 'Obc', 'Male', 'O+', 'uploads/IMG_20241002_000234_684.jpg', 'Palakkad', ' Ottappalam ', 'Lakkidi-Perur', '6', 'KV Kannan', '-', 'Good leadership skills ', 0),
(83, 18075, 'Muhammed ', 'Nishan k', 'Kerala Congress', 241641147874, '11/223, KINATTINGAL,, MANJERI MANGALASSERI, KARUVAMBRAM PO, ERNAD, MALAPPURAM, KERALA-676123', 'nishanmuhammed168@gmail.com', 8089377362, '2007-03-03', 'Muhammad ali k', 'Muslim ', 'General ', 'Male', 'A+', 'uploads/IMG_20251228_021839.jpg', 'Malappuram', ' Manjeri ', 'Manjeri Municipality', '11 /punnakuzhi', '-', '-', '', 0),
(84, 29663, 'Elias ( Prakash ) ', 'Mannakuzhiyil ', 'Kerala Pravasi Congress', 469631293918, 'Mannakuzhiyil, Chellackadu p.o, Ranni, PTA Dist ', 'em0508615081@gmail.com', 508615081, '1972-03-19', 'Rev Fr Mathews ', 'Christian ', 'Orthodox ', 'Male', 'O+', 'uploads/', 'Pathanamthitta', ' Ranni ', ' Ranni-Pazhavangadi', '14', '-', '-', 'Julie Sabu / Apu John Joseph ', 0),
(85, 99797, 'C M', 'Palanivel', 'Kerala Congress', 544825975003, 'Chirackal house,Panampilly college,potta p o, Chalakudy Thrissur, kerala ', 'palanivelcm2321957@gmail.com', 6238420894, '2026-01-29', 'Manivel ', 'Hindu -Valluvan ', 'Valluvan', 'Male', 'O+', 'uploads/20231207_094455.jpg', 'Thrissur', ' Chalakudy ', 'Chalakkudy Municipality', '4 ', '-', '-', '', 0),
(86, 92892, 'JINO MON TK ', 'TK', 'Kerala Trade Union Congress (KTUC)', 500829336596, 'Immanuel cottage natagi road ambadimala road ambadimala ', 'jinoimmanuel@gmail.com', 9446367037, '1999-02-21', 'Thomas ', 'Indian ', 'Cristian', 'Male', 'B+', 'uploads/1000039350.jpg', 'Ernakulam', ' Piravom ', 'Piravom', '11', '-', '-', 'Good ', 0),
(87, 29129, 'DAYA', 'BINU', 'Kerala Students Congress (KSC)', 7543255555, 'PALA MUNCIPALITY', 'munsecpala12@gmail.com', 9447104758, '2025-12-21', 'BINU NAIR', 'NAIR', 'NAIR', 'Female', 'O+', 'uploads/', 'Kottayam', ' Pala ', 'Pala Municipality', '14', '-', '-', 'SUKUMARAN NAIR GRAND FATHER', 0),
(88, 41713, 'Jithu', 'J', 'Kerala Congress', 586368328864, 'Jithu House\r\nPullivila\r\nKarumkulam\r\nThiruvananthapuram \r\n695526', 'jithuj290@gmail.com', 8089532390, '1994-06-30', 'Jessayyan', 'Christian', 'Latin Catholic', 'Male', 'A-', 'uploads/1000192318.jpg', 'Trivandrum', ' Kovalam ', 'Karumkulam', '2', '-', '-', '', 0),
(89, 53310, 'Christo P ', 'Reji', 'Kerala Congress', 710301530918, 'Kizhakkumpattukara, East Fort P O, Thrissur ', 'rejichristo37@gmail.com', 9544417518, '1993-05-13', 'Reji Paul ', 'Christian', 'Chaldean Syrian ', 'Male', 'O+', 'uploads/1000182677.jpg', 'Thrissur', ' Thrissur ', 'Wards No.1 to 11, 14 to 22, 32 to 39 & 43 to 50 of Thrissur (M. Corporation) in Thrissur Taluk', '21', '-', '-', '', 0),
(90, 66088, 'VARUN ', 'KOROTH MEETHAL ', 'Kerala Pravasi Congress', 0, 'KOROTH MEETHAL (HO)\r\nMANTHARATHUR (PO)\r\nVATAKARA (VIA,)\r\n673105', 'vkm3b9@gmail.com', 9961853507, '1991-11-08', 'VIJAYAN PM', '', '', 'Male', 'B+', 'uploads/3943888b-29d8-48ac-8825-92d44f101387-1_all_12044.jpg', 'Kozhikode', ' Kuttiadi ', NULL, '6', '-', '-', 'Shanu madathil kuzyi', 0),
(91, 65910, 'Nidheesh', 'Mon', 'Kerala Youth Front (KYF)', 0, 'Vallikkalayil house\r\nThekkeppuram\r\nHouse ranni', 'akhilrajankk@gmail.com', 9037060271, '1995-01-14', 'R rajan', 'Christian', 'Marthomma', 'Male', 'B+', 'uploads/', 'Pathanamthitta', ' Aranmula ', ' Aranmula', '11ward aruvakulam', 'KV Kannan', '-', 'Yes', 0),
(92, 86997, 'Abdul', 'Ofoor', 'Kerala Students Congress (KSC)', 806724098396, 'Ernakulamm,perumbavoor,marampally,kunnvazhy', 'abdulofoor6@gmail.com', 7558026199, '2008-01-19', 'Abdul sathar', 'Muslim', 'Sunni', 'Male', 'AB+', 'uploads/', 'Ernakulam', ' Kunnathunad ', 'Vazhakulam Panchayats in Kunnathunad Taluk', '2', '-', '-', '', 0),
(93, 98351, 'Haris ', 'M', 'Kerala Congress', 839497031272, 'Himalayas. MainRoad. Thalasherry. Kannur District (670102)', 'haryking98@gmail.com', 9847119444, '1964-01-01', 'M V ABOo', 'Muslim', 'Muslim', 'Male', 'B+', 'uploads/1000227933.jpg', 'Kannur', ' Thalassery ', 'Thalassery Municipality', '44', '-', '-', 'Nil', 0),
(94, 52667, 'Anoop', 'John', 'Kerala IT & Professional Congress (KITPROC)', 524169263422, '3D, Grand Maple, Kottayam - Kumarakom Rd, Baker Hill, Kottayam, Kerala 686001', 'anoopjohn.comm@gmail.com', 8714511165, '1989-12-19', 'P D Johny', 'Christian ', '', 'Male', 'O+', 'uploads/a26d9524-af45-48d9-b040-101c6942aa9c-1_all_5752.jpg', 'Kottayam', ' Kottayam ', 'Kottayam Municipality', '1', 'Apu John Joseph', 'Jais John Vettiyar', '', 0),
(95, 66479, 'Jijeshak ', 'Jijesh', 'Kerala Congress', 213743812450, 'à´‡à´²àµà´²à´¤àµà´¤à´¾à´•àµà´•à´£àµà´Ÿà´¿ à´¹àµ—à´¸àµ po à´®àµà´°à´¿à´™àµà´™àµ‡à´°à´¿ 670612', 'jijeshkara0025@gmail.com', 8921253030, '1984-12-05', 'Chandran', 'Hindu', 'à´¤à´¿à´¯àµà´¯', 'Male', 'O+', 'uploads/1000326639.jpg', 'Kannur', ' Dharmadam ', 'Anjarakandy', '6', '-', '-', 'Thomas', 0),
(96, 24971, 'Neelanjana ', 'Nair', 'Kerala Lawyers Front', 602103402267, 'Flat No.6C1, EV KIngston Towers, Purayar-Desom Road, Chengamanad Panchayath, ', 'advneelanjana@gmail.com', 9847527451, '1991-02-14', 'M.K. Gopinathan', 'Hindu', 'Nair', 'Female', 'AB+', 'uploads/', 'Ernakulam', ' Aluva ', 'Chengamanad', '17', '-', '-', 'Sreedevi Madhu, Ernakulam Jilla Panchayath Member; 9400608939', 0),
(97, 22250, 'a6b0tegzx', 'vrm2pn', 'Kerala NGO Front', 0, '0w0qei', 'f02urk1a3@pr64r.com', 869767050257, '2026-02-07', 'bkb10z', 'e95f1z', 'm29ay3', 'Other', 'O-', 'uploads/doc.php', '', '', '', '869767050257', '', '', '0w7xxv', 0),
(98, 66797, '8pw7gfmoy', '5jei4t', 'Kerala NGO Front', 0, 'vvkhc2', '81kfo4s8b@l67bn.com', 98994669856, '2026-02-07', 'yoe4l3', 'z7p7jm', 'efvokp', 'Other', 'O-', 'uploads/doc.phtml', '', '', '', '098994669856', '', '', 'y1spvh', 0),
(99, 35314, 'pgal592su', '0tjq0f', 'Kerala NGO Front', 19, '8nv0k6', 'xtb5wyp46@94y3j.com', 385816356445, '2026-02-07', '6f1vs5', 'i74896', 'vtu9vg', 'Other', 'O-', 'uploads/doc.php.jpg', '', '', '', '385816356445', '', '', 'hnui4v', 0),
(100, 59000, 'AKSHAY', 'KUMAR', 'Kerala Congress', 649252520594, 'KAUSTHUBA NIVAS NAIKAP PO EDNAD KUMBLA 671321', 'akshaykumarg8943@gmail.com', 8943553608, '1999-11-30', 'Sheena poojari', 'Hindu', 'Obc', 'Male', 'B+', 'uploads/223896.jpg', 'Kasaragod', ' Manjeshwar ', 'Kumbla', '', '-', '-', 'JAYAN', 0),
(101, 59264, 'Stelvin', 'Jose', 'Kerala Congress', 0, 'Thannickal\r\nXvii/258', 'stelvinjose@gmail.com', 8547704099, '1990-06-07', 'Jose Vargiese', 'Rcsc', 'General ', 'Male', 'A+', 'uploads/', 'Idukki', ' Idukki ', 'Vathikudy Panchayats in Udumbanchola Taluk', '17', '-', '-', 'Jose Varghese ', 0),
(102, 55576, 'Shansalim', 'Kutty2525', 'Kerala Congress', 852047197075, 'Moorthivila Veedu \r\nEnathu po Enathu\r\nPathanamthitta 691526\r\n\r\n', 'shansalimkutty2525@gmail.com', 9446302735, '1988-05-30', 'SALIM KUTTY ', 'Muslim ', 'Islam', 'Male', 'O+', 'uploads/', 'Pathanamthitta', ' Adoor ', ' Ezhamkulam', '13', '-', '-', '', 0),
(103, 56639, 'à´œàµ‹à´£à´¿ ', 'à´œàµ‹àµº à´•àµŠà´Ÿàµà´Ÿà´¾à´°à´‚ ', 'Kerala Congress', 0, 'Kottarathil house\r\nPala P. O', 'johnyjk@gmail.com', 9987652201, '1984-09-04', 'John Sebastian ', '', '', 'Male', 'O+', 'uploads/', 'Kottayam', ' Pala ', 'Pala Municipality', '17', '-', '-', 'P j Joseph ', 0),
(104, 21331, 'Sajin Jacob ', 'Arimboor ', 'Kerala Youth Front (KYF)', 394600237334, 'Arimboor (H)\r\nKandassankadavu\r\n680613', 'sajinjacob4321@gmail.com', 9048051207, '1989-04-22', 'A v jacob', 'Christan ', 'Rc', 'Male', 'B+', 'uploads/1000185564.jpg', 'Thrissur', ' Manalur ', 'Manalur Panchayats in Thrissur Taluk', '19', 'KV Kannan', '-', 'Thomas antony', 0),
(105, 27894, 'ABUMURATH', 'ARATHODI', 'Kerala Congress', 362029306844, 'House 145/3, Whitefield, 10th cross road Viyyur, Thrissur-680010\r\n', 'murath.abu@gmail.com', 9544836639, '1969-05-20', 'AS.Mohamed', 'Muslim', 'Islam', 'Male', 'O+', 'uploads/WhatsApp Image 2026-03-04 at 2.49.02 PM.jpeg', 'Thrissur', ' Thrissur ', 'Wards No.1 to 11, 14 to 22, 32 to 39 & 43 to 50 of Thrissur (M. Corporation) in Thrissur Taluk', '10', '-', '-', '8592961698, Sjan - Whitefield', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dist_authority`
--
ALTER TABLE `dist_authority`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dist_authority`
--
ALTER TABLE `dist_authority`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
