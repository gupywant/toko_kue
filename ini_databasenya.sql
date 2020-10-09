-- Adminer 4.7.3 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(150) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(64) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `jenis_kue`;
CREATE TABLE `jenis_kue` (
  `id_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(250) NOT NULL,
  `deskripsi` text NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id_jenis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `kue`;
CREATE TABLE `kue` (
  `id_kue` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenis` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int(11) NOT NULL,
  `waktu_po` smallint(6) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_kue`),
  KEY `id_jenis` (`id_jenis`),
  CONSTRAINT `kue_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `jenis_kue` (`id_jenis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `kue_gambar`;
CREATE TABLE `kue_gambar` (
  `id_gambar` int(11) NOT NULL AUTO_INCREMENT,
  `id_kue` int(11) NOT NULL,
  `gambar` varchar(150) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id_gambar`),
  KEY `id_kue` (`id_kue`),
  CONSTRAINT `kue_gambar_ibfk_1` FOREIGN KEY (`id_kue`) REFERENCES `kue` (`id_kue`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `kue_keranjang`;
CREATE TABLE `kue_keranjang` (
  `id_order` int(11) NOT NULL AUTO_INCREMENT,
  `id_kue` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `waktu` tinyint(4) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_order`),
  KEY `id_kue` (`id_kue`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `kue_keranjang_ibfk_1` FOREIGN KEY (`id_kue`) REFERENCES `kue` (`id_kue`),
  CONSTRAINT `kue_keranjang_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `kue_order`;
CREATE TABLE `kue_order` (
  `id_order` int(11) NOT NULL AUTO_INCREMENT,
  `id_kue` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `kode` varchar(12) NOT NULL,
  `total` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `waktu` tinyint(4) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_order`),
  KEY `id_kue` (`id_kue`),
  KEY `id_user` (`id_user`),
  CONSTRAINT `kue_order_ibfk_1` FOREIGN KEY (`id_kue`) REFERENCES `kue` (`id_kue`),
  CONSTRAINT `kue_order_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE `order_detail` (
  `id_detail` int(11) NOT NULL AUTO_INCREMENT,
  `id_order` int(11) NOT NULL,
  `id_kue` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id_detail`),
  KEY `id_order` (`id_order`),
  KEY `id_kue` (`id_kue`),
  CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `kue_order` (`id_order`),
  CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`id_kue`) REFERENCES `kue` (`id_kue`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(150) NOT NULL,
  `password` varchar(64) NOT NULL,
  `nama` varchar(150) NOT NULL,
  `alamat` text NOT NULL,
  `kota` varchar(150) NOT NULL,
  `provinsi` varchar(150) NOT NULL,
  `kode_pos` int(5) NOT NULL,
  `no_tlp` varchar(13) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- 2020-10-09 09:45:18
