-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: daimyocms
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.17.10.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `d_articles`
--

DROP TABLE IF EXISTS `d_articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash_id` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `publishDate` datetime NOT NULL,
  `editedDate` datetime NOT NULL,
  `content` text NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d_articles`
--

LOCK TABLES `d_articles` WRITE;
/*!40000 ALTER TABLE `d_articles` DISABLE KEYS */;
INSERT INTO `d_articles` VALUES (2,'849a58e8178b7779b8182de1ee09f364','allo',2,14,'2018-02-23 04:08:05','2018-02-23 04:08:05','xDD',NULL),(4,'7b6943050c1e48f7de975f8657443084','lorem',2,9,'2018-02-23 04:29:31','2018-02-23 04:51:40','Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquid cumque distinctio eos facere, incidunt labore mollitia nam nobis non perferendis quaerat quam quidem recusandae temporibus tenetur ut. Blanditiis, harum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquid cumque distinctio eos facere, incidunt labore mollitia nam nobis non perferendis quaerat quam quidem recusandae temporibus tenetur ut. Blanditiis, harum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquid cumque distinctio eos facere, incidunt labore mollitia nam nobis non perferendis quaerat quam quidem recusandae temporibus tenetur ut. Blanditiis, harum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquid cumque distinctio eos facere, incidunt labore mollitia nam nobis non perferendis quaerat quam quidem recusandae temporibus tenetur ut. Blanditiis, harum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquid cumque distinctio eos facere, incidunt labore mollitia nam nobis non perferendis quaerat quam quidem recusandae temporibus tenetur ut. Blanditiis, harum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquid cumque distinctio eos facere, incidunt labore mollitia nam nobis non perferendis quaerat quam quidem recusandae temporibus tenetur ut. Blanditiis, harum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquid cumque distinctio eos facere, incidunt labore mollitia nam nobis non perferendis quaerat quam quidem recusandae temporibus tenetur ut. Blanditiis, harum.',NULL),(5,'dad4faa56851118f7a6b1cf102187341','Kaaaa',2,14,'2018-02-23 04:51:25','2018-02-23 04:51:25','dzadaz',NULL),(6,'d75bd1a5c6512eb3fedff868d8ac6ac9','kek haha',2,14,'2018-02-23 04:51:56','2018-02-23 05:11:34','mdzfezfgez\r\n','www');
/*!40000 ALTER TABLE `d_articles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d_category`
--

DROP TABLE IF EXISTS `d_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `createdDate` datetime NOT NULL,
  `description` text NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d_category`
--

LOCK TABLES `d_category` WRITE;
/*!40000 ALTER TABLE `d_category` DISABLE KEYS */;
INSERT INTO `d_category` VALUES (9,'90c2b47f2864719b5aa9c1dc91384320','CS:GO','classarticles','2018-02-22 03:42:54','',NULL),(14,'36f16ce6975f34c7f793e16beb1b9f68','Dev','www','2018-02-23 02:54:07','',NULL);
/*!40000 ALTER TABLE `d_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `d_users`
--

DROP TABLE IF EXISTS `d_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `d_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash_id` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `registerDate` datetime NOT NULL,
  `access` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d_users`
--

LOCK TABLES `d_users` WRITE;
/*!40000 ALTER TABLE `d_users` DISABLE KEYS */;
INSERT INTO `d_users` VALUES (2,'o90ccaHWhdnXIs54ZbXb7OgEvsX2NPRFFiLt','admin','daimyo@devbreak.fr','$2y$10$1DrA71.COOnqx1sMvYrRLeakZ4UYP0tMz4Et9VFpJe7cA69ZgI0sC','2018-02-21 00:00:00','0');
/*!40000 ALTER TABLE `d_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-02-23 12:26:04
