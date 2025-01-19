/*
SQLyog Community v13.2.1 (64 bit)
MySQL - 10.4.32-MariaDB : Database - starwars
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`starwars` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci */;

USE `starwars`;

/*Table structure for table `sw_filmes_index` */

DROP TABLE IF EXISTS `sw_filmes_index`;

CREATE TABLE `sw_filmes_index` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) NOT NULL,
  `fundo` varchar(255) NOT NULL,
  `sinopse` longtext NOT NULL,
  `video` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `sw_filmes_index` */

insert  into `sw_filmes_index`(`id`,`logo`,`fundo`,`sinopse`,`video`) values 
(1,'ameaca-fantasma.png','ameaca-fantasma.png','Two Jedi are sent to resolve a political conflict and uncover a greater threat from an ancient enemy. They encounter a boy with extraordinary Force abilities who may change the galaxy\'s future.','ameaca-fantasma.mp4'),
(2,'nova-esperanca.png','nova-esperanca.png','A young farm boy discovers he is the son of a legendary Jedi and teams up with a princess, a smuggler, and a droid to fight the Empire. Together, they attempt to destroy the imperial space station and bring freedom to the galaxy.','nova-esperanca.mp4'),
(3,'han-solo.png','han-solo.png','Han Solo, a charismatic smuggler and skilled pilot, gets involved in the fight against the Empire after rescuing Princess Leia. Alongside his loyal Wookiee friend, Chewbacca, he joins the Rebellion. Together, they play a crucial role in the battle for the galaxy\'s freedom.','han-solo.mp4'),
(4,'skywalker.png','skywalker.png','Rey, the last hope of the Jedi, faces the return of Emperor Palpatine, who seeks to rule the galaxy once again. Alongside Finn, Poe, and the Resistance, she must confront her dark lineage and fulfill her destiny to bring balance to the Force, while the final battle against the Sith unfolds.','skywalker.mp4');

/*Table structure for table `sw_lista_filmes` */

DROP TABLE IF EXISTS `sw_lista_filmes`;

CREATE TABLE `sw_lista_filmes` (
  `id` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `sw_lista_filmes` */

insert  into `sw_lista_filmes`(`id`,`foto`) values 
(1,'episode-1.png'),
(2,'episode-2.png'),
(3,'episode-3.png'),
(4,'episode-4.png'),
(5,'episode-5.png'),
(6,'episode-6.png'),
(7,'episode-7.png');

/*Table structure for table `sw_log_api` */

DROP TABLE IF EXISTS `sw_log_api`;

CREATE TABLE `sw_log_api` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `requisicao` varchar(255) NOT NULL,
  `data_requisicao` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=867 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `sw_log_api` */

/*Table structure for table `sw_login` */

DROP TABLE IF EXISTS `sw_login`;

CREATE TABLE `sw_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `foto` longtext NOT NULL,
  `faccao` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

/*Data for the table `sw_login` */

insert  into `sw_login`(`id`,`nome`,`foto`,`faccao`) values 
(1,'Darth Vader','darth_vader.png',1),
(2,'Emperor Palpatine','imperador_palpatine.png',1),
(3,'Boba Fett','boba_fett.png',1),
(4,'Darth Maul','darth_maul.png',1),
(5,'Stormtrooper','stormtroopers.png',1),
(6,'Luke Skywalker','luke_skywalker.png',2),
(7,'Princess Leia','princesa_leia.png',2),
(8,'Han Solo','han_solo.png',2),
(9,'R2D2','r2d2.png',2),
(10,'C-3PO','c3po.png',2);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
