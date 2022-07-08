/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 10.4.14-MariaDB : Database - db_travelindo
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_travelindo` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_travelindo`;

/*Table structure for table `tb_artikel` */

DROP TABLE IF EXISTS `tb_artikel`;

CREATE TABLE `tb_artikel` (
  `idartikel` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `fitur` text NOT NULL,
  `img1` varchar(100) NOT NULL,
  `img2` varchar(100) NOT NULL,
  `img3` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `rating` varchar(10) NOT NULL,
  `day` varchar(20) NOT NULL,
  PRIMARY KEY (`idartikel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_artikel` */

/*Table structure for table `tb_buktipembayaran` */

DROP TABLE IF EXISTS `tb_buktipembayaran`;

CREATE TABLE `tb_buktipembayaran` (
  `id_bukti_pembayaran` int(11) NOT NULL AUTO_INCREMENT,
  `idbooking` int(11) NOT NULL,
  `idl` int(11) NOT NULL,
  `img_trx` varchar(100) NOT NULL,
  PRIMARY KEY (`id_bukti_pembayaran`),
  KEY `fr_tbl_bukti_booking` (`idbooking`),
  KEY `fr_tbl_bukti_user` (`idl`),
  CONSTRAINT `fr_tbl_bukti_booking` FOREIGN KEY (`idbooking`) REFERENCES `tbl_booking` (`idbooking`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fr_tbl_bukti_user` FOREIGN KEY (`idl`) REFERENCES `tb_userlengkap` (`idl`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_buktipembayaran` */

/*Table structure for table `tb_user` */

DROP TABLE IF EXISTS `tb_user`;

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  `role` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_user` */

/*Table structure for table `tb_userlengkap` */

DROP TABLE IF EXISTS `tb_userlengkap`;

CREATE TABLE `tb_userlengkap` (
  `idl` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `notelp` varchar(20) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  PRIMARY KEY (`idl`),
  KEY `id_user_lengkap` (`id`),
  CONSTRAINT `id_user_lengkap` FOREIGN KEY (`id`) REFERENCES `tb_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tb_userlengkap` */

/*Table structure for table `tbl_booking` */

DROP TABLE IF EXISTS `tbl_booking`;

CREATE TABLE `tbl_booking` (
  `idbooking` int(11) NOT NULL AUTO_INCREMENT,
  `idartikel` int(11) NOT NULL,
  `idl` int(11) NOT NULL,
  `wisata` varchar(50) NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `kodepos` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `tanggalbooking` date NOT NULL,
  `notes` text NOT NULL,
  PRIMARY KEY (`idbooking`),
  KEY `fr_tbl_booking` (`idartikel`),
  KEY `fr_tbl_booking_user` (`idl`),
  CONSTRAINT `fr_tbl_booking` FOREIGN KEY (`idartikel`) REFERENCES `tb_artikel` (`idartikel`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fr_tbl_booking_user` FOREIGN KEY (`idl`) REFERENCES `tb_userlengkap` (`idl`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `tbl_booking` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
