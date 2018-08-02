/*
SQLyog Ultimate v10.42 
MySQL - 5.5.5-10.1.32-MariaDB : Database - perpusma27
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`perpusma27` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `perpusma27`;

/*Table structure for table `buku` */

DROP TABLE IF EXISTS `buku`;

CREATE TABLE `buku` (
  `kode_ddc` int(20) NOT NULL AUTO_INCREMENT,
  `no_unik` varchar(55) DEFAULT NULL,
  `isbn_buku` varchar(55) DEFAULT NULL,
  `judul_buku` varchar(50) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `stok_buku` int(11) NOT NULL,
  `penerbit` varchar(50) DEFAULT NULL,
  `tahun_terbit` int(11) DEFAULT NULL,
  `subyek` varchar(200) DEFAULT NULL,
  `tahun_masuk` int(11) DEFAULT NULL,
  `kode_rakbuku` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`kode_ddc`),
  KEY `fk_kategori` (`kategori_id`),
  CONSTRAINT `fk_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1234567900 DEFAULT CHARSET=latin1;

/*Data for the table `buku` */

insert  into `buku`(`kode_ddc`,`no_unik`,`isbn_buku`,`judul_buku`,`kategori_id`,`stok_buku`,`penerbit`,`tahun_terbit`,`subyek`,`tahun_masuk`,`kode_rakbuku`) values (1,'5020094','9789793062792','Laskar Pelangi',5,3,'Bentang',2009,'subyek',NULL,NULL),(2,'5020104','97897930627','Endensor',5,4,'Bentang',2010,'buku ketiga dari tetralogi laskar pelangi',NULL,NULL),(3,'5020155','615110022','The Good Dinosaur',5,1,'Gramedia',2015,'',NULL,NULL),(4,'5020174','97897912278','sang pemimpi',5,5,'Bentang',2014,'Andrea Hirata',NULL,NULL),(5,'120045','4982012820493','pendidikan agama islam',4,0,'Erlangga',2011,'',NULL,NULL),(6,'50200946','4982012820493','fiqih',4,0,'Erlangga',2007,'',NULL,NULL),(20,'278','89919061011','Laskar Pelangi 5',5,10,'Elexmedia',2018,'subyek',NULL,NULL),(123,NULL,'89919061011','Laskar Pelangi',5,20,'Elexmedia',2019,'subyek',2010,'1-3'),(1234567899,'1123','89919061011','Laskar Pelangi',1,213,'Elexmedia',2018,'subyek',NULL,NULL);

/*Table structure for table `denda` */

DROP TABLE IF EXISTS `denda`;

CREATE TABLE `denda` (
  `denda_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaksi_id` int(11) NOT NULL,
  `total_denda` int(15) NOT NULL,
  PRIMARY KEY (`denda_id`),
  KEY `fk_denda` (`transaksi_id`),
  CONSTRAINT `fk_denda` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`transaksi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `denda` */

insert  into `denda`(`denda_id`,`transaksi_id`,`total_denda`) values (1,39,3500);

/*Table structure for table `donasi` */

DROP TABLE IF EXISTS `donasi`;

CREATE TABLE `donasi` (
  `donasi_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pendonasi` varchar(50) NOT NULL,
  `nohp_pendonasi` varchar(15) NOT NULL,
  `jumlah_buku` int(15) NOT NULL,
  `tgl_donasi` date DEFAULT NULL,
  PRIMARY KEY (`donasi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `donasi` */

insert  into `donasi`(`donasi_id`,`nama_pendonasi`,`nohp_pendonasi`,`jumlah_buku`,`tgl_donasi`) values (2,'TM 2','081234567890',2147483647,NULL),(3,'TM 1','081234567891',127,NULL),(7,'BOS','123',123,'2018-05-22');

/*Table structure for table `kategori` */

DROP TABLE IF EXISTS `kategori`;

CREATE TABLE `kategori` (
  `kategori_id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) NOT NULL,
  PRIMARY KEY (`kategori_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `kategori` */

insert  into `kategori`(`kategori_id`,`nama_kategori`) values (1,'Komedi'),(3,'Dokumen'),(4,'agama'),(5,'Novel');

/*Table structure for table `peminjam` */

DROP TABLE IF EXISTS `peminjam`;

CREATE TABLE `peminjam` (
  `nis` varchar(15) NOT NULL,
  `nama_peminjam` varchar(50) NOT NULL,
  `alamat_peminjam` varchar(100) NOT NULL,
  `jenis_kelamin` varchar(15) NOT NULL,
  `angkatan` varchar(10) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `notlp` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`nis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `peminjam` */

insert  into `peminjam`(`nis`,`nama_peminjam`,`alamat_peminjam`,`jenis_kelamin`,`angkatan`,`kelas`,`user_id`,`notlp`) values ('1127841543','Radit','Perumahan Buah Batu Bandung','Laki-Laki','2014','XI',1,'082233309259'),('1146299241','Teuku Muhammad','PBB Bandung','Laki-Laki','2014','XI',1,'082233309259'),('123456789','Agus','Rancanumpang','Laki-Laki','2015','XII',0,'082233309259'),('16701150008','dani','bojong soang','Laki-Laki','2012','X',0,'089688346196'),('6701150010','shasaM','pbb','Perempuan','2012','X',0,'082233309259');

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `transaksi_id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_ddc` int(15) NOT NULL,
  `no_unik` int(11) DEFAULT NULL,
  `isbn_buku` varchar(55) DEFAULT NULL,
  `nis` varchar(15) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tgl_peminjaman` date NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`transaksi_id`),
  KEY `fk_peminjam` (`nis`),
  KEY `fk_buku` (`kode_ddc`),
  CONSTRAINT `fk_buku` FOREIGN KEY (`kode_ddc`) REFERENCES `buku` (`kode_ddc`),
  CONSTRAINT `fk_peminjam` FOREIGN KEY (`nis`) REFERENCES `peminjam` (`nis`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

insert  into `transaksi`(`transaksi_id`,`kode_ddc`,`no_unik`,`isbn_buku`,`nis`,`user_id`,`tgl_peminjaman`,`tgl_pengembalian`,`status`) values (39,6,50200946,'4982012820493','123456789',0,'2018-07-25','2018-07-26','2'),(40,4,5020174,'97897912278','123456789',0,'2018-07-25','2018-07-26','1'),(42,3,5020155,'615110022','16701150008',0,'2018-07-25','2018-07-26','1'),(43,6,50200946,'4982012820493','1127841543',0,'2018-08-02','2018-08-02','1');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`user_id`,`username`,`password`,`nama_lengkap`) values (1,'admin','21232f297a57a5a743894a0e4a801fc3','Admin Library'),(3,'tm123','bc2a2d37570edcfa6328884761994486','Teuku Muhammad');

/*Table structure for table `waitinglist` */

DROP TABLE IF EXISTS `waitinglist`;

CREATE TABLE `waitinglist` (
  `idwaitinglist` int(11) NOT NULL AUTO_INCREMENT,
  `nis` varchar(15) NOT NULL,
  `kode_ddc` int(20) NOT NULL,
  `no_antri` int(11) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`idwaitinglist`),
  KEY `fk_nis` (`nis`),
  CONSTRAINT `fk_nis` FOREIGN KEY (`nis`) REFERENCES `peminjam` (`nis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `waitinglist` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
