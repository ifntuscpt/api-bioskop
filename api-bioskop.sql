/*
SQLyog Ultimate v12.09 (64 bit)
MySQL - 10.4.21-MariaDB : Database - bioskop
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bioskop` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `bioskop`;

/*Table structure for table `film` */

DROP TABLE IF EXISTS `film`;

CREATE TABLE `film` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(50) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `rating` varchar(50) NOT NULL,
  `produksi` varchar(100) NOT NULL,
  `distributor` varchar(100) NOT NULL,
  `durasi` int(11) NOT NULL,
  `country` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `film` */

insert  into `film`(`id`,`judul`,`deskripsi`,`rating`,`produksi`,`distributor`,`durasi`,`country`,`created_at`,`updated_at`) values (1,'Titanic','Bercerita tentang kisah cinta antara Jack dan Rose (diperankan oleh Leonardo DiCaprio dan Kate Winslet) yang berasal dari status sosial berbeda di atas kapal RMS Titanic yang tenggelam dalam pelayaran perdananya pada tanggal 15 April 1912','8.5','Paramount Pictures 20th Century Fox Lightstorm Entertainment','Paramount Pictures (North America) 20th Century Fox (International)',196,'Amerika Serikat','2022-12-04 18:03:06','2022-12-06 09:59:26'),(2,'Black Panther','Bercerita tentang kisah cinta antara Jack dan Rose (diperankan oleh Leonardo DiCaprio dan Kate Winslet) yang berasal dari status sosial berbeda di atas kapal RMS Titanic yang tenggelam dalam pelayaran perdananya pada tanggal 15 April 1912','7.5','Paramount Pictures 20th Century Fox Lightstorm Entertainment','Paramount Pictures (North America) 20th Century Fox (International)',195,'Amerika Serikat','2022-12-05 04:25:32','2022-12-11 08:08:13');

/*Table structure for table `jadwal` */

DROP TABLE IF EXISTS `jadwal`;

CREATE TABLE `jadwal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hari` varchar(50) NOT NULL,
  `jam` varchar(20) NOT NULL,
  `harga` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `teater_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `film_id` (`film_id`),
  KEY `teater_id` (`teater_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `jadwal` */

insert  into `jadwal`(`id`,`hari`,`jam`,`harga`,`film_id`,`teater_id`,`created_at`,`updated_at`) values (1,'selasa','18.00',80000,2,2,'2022-12-10 09:33:17','2022-12-11 13:07:04');

/*Table structure for table `kursi` */

DROP TABLE IF EXISTS `kursi`;

CREATE TABLE `kursi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `teater_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `teater_id` (`teater_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

/*Data for the table `kursi` */

insert  into `kursi`(`id`,`nama`,`teater_id`,`created_at`,`updated_at`) values (1,'A 1',2,'2022-12-10 09:47:28','2022-12-11 21:34:58'),(2,'A 2',1,'2022-12-10 09:47:34','2022-12-10 09:47:34'),(3,'A 3',1,'2022-12-10 09:47:39','2022-12-10 09:47:39'),(4,'A 4',1,'2022-12-10 09:47:46','2022-12-10 09:47:46'),(5,'A 5',1,'2022-12-10 09:47:51','2022-12-10 09:47:51'),(6,'A 6',1,'2022-12-10 09:47:56','2022-12-10 09:47:56'),(7,'A 7',1,'2022-12-10 09:48:01','2022-12-10 09:48:01'),(8,'A 9',1,'2022-12-10 09:48:08','2022-12-10 09:48:08'),(9,'A 10',1,'2022-12-10 09:48:13','2022-12-10 09:48:13');

/*Table structure for table `teater` */

DROP TABLE IF EXISTS `teater`;

CREATE TABLE `teater` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `kapasitas` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `teater` */

insert  into `teater`(`id`,`nama`,`kapasitas`,`created_at`,`updated_at`) values (2,'teater 2','5','2022-12-11 11:37:57','2022-12-11 11:37:57'),(3,'teater 3','8','2022-12-11 12:24:18','2022-12-11 12:39:48');

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jadwal_id` int(11) NOT NULL,
  `kursi_id` int(11) NOT NULL,
  `jumlah_dibayar` int(11) NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `status` enum('Sudah dibayar','Belum dibayar') NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `jadwal_id` (`jadwal_id`),
  KEY `kursi_id` (`kursi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `transaksi` */

insert  into `transaksi`(`id`,`jadwal_id`,`kursi_id`,`jumlah_dibayar`,`bukti_pembayaran`,`status`,`created_at`,`updated_at`) values (1,1,1,50000,'66105d2728bdfc2b6eec1e3a795f7952','Sudah dibayar','2022-12-10 17:54:05','2022-12-11 13:35:51');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
