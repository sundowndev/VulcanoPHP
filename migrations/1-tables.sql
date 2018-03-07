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
  `image_url` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `d_articles_slug_uindex` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d_articles`
--

LOCK TABLES `d_articles` WRITE;
/*!40000 ALTER TABLE `d_articles` DISABLE KEYS */;
INSERT INTO `d_articles` VALUES (4,'7b6943050c1e48f7de975f8657443084','lorem',2,9,'2018-02-23 04:29:31','2018-03-05 17:21:18','**allo ?**\r\n\r\n*lorem ipsum*\r\n\r\nLorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquid cumque distinctio eos facere, incidunt labore mollitia nam nobis non perferendis quaerat quam quidem recusandae temporibus tenetur ut. Blanditiis, harum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquid cumque distinctio eos facere, incidunt labore mollitia nam nobis non perferendis quaerat quam quidem recusandae temporibus tenetur ut.\r\n\r\n### Subtitle\r\nBlanditiis, harum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquid cumque distinctio eos facere, incidunt labore mollitia nam nobis non perferendis quaerat quam quidem recusandae temporibus tenetur ut. Blanditiis, harum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquid cumque distinctio eos facere, incidunt labore mollitia nam nobis non perferendis quaerat quam quidem recusandae temporibus tenetur ut. Blanditiis, harum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquid cumque distinctio eos facere, incidunt labore mollitia nam nobis non perferendis quaerat quam quidem recusandae temporibus tenetur ut. Blanditiis, harum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquid cumque distinctio eos facere, incidunt labore mollitia nam nobis non perferendis quaerat quam quidem recusandae temporibus tenetur ut. Blanditiis, harum. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci aliquid cumque distinctio eos facere, incidunt labore mollitia nam nobis non perferendis quaerat quam quidem recusandae temporibus tenetur ut. Blanditiis, harum.','lorem',NULL),(5,'dad4faa56851118f7a6b1cf102187341','Kaaaa',2,14,'2018-02-23 04:51:25','2018-02-26 10:22:11','dzadaz','kaaaa',NULL),(6,'d75bd1a5c6512eb3fedff868d8ac6ac9','lol oui',2,14,'2018-02-23 04:51:56','2018-02-27 09:10:07','mdzfezfgez\r\n','lol-oui',NULL),(7,'0f1e5d5f51be7a3373373286bf3a6f64','CS:GO : Le rÃ´le de leader in-game',2,9,'2018-03-02 19:27:07','2018-03-06 15:35:08','AprÃ¨s avoir Ã©crit un article sur comment sâ€™amÃ©liorer sur Counter-Strike: Global Offensive, il est temps maintenant dâ€™approfondir le sujet en vous parlant des diffÃ©rent rÃ´les composant une Ã©quipe.\r\n\r\nÃ‰tant lâ€™un des rÃ´les les plus importants dans une Ã©quipe CS:GO, le leader in-game (LIG) Ã  pour objectif de diriger son Ã©quipe durant le round afin de le remporter en donnant les calls (indications) et en Ã©laborant des strats (stratÃ©gies).\r\n\r\nLe joueur principal qui va indiquer les stratÃ©gies et le plan de jeu Ã  son Ã©quipe. Son objectif est de faire gagner le round Ã  son Ã©quipe. Un des rÃ´les les plus importants de Counter-Strike, si ce nâ€™est le plus important. -[Liquipedia](http://liquipedia.net/counterstrike/Roles#IN-GAME_LEADER)\r\n\r\nSelon Liquipedia, les principales qualitÃ©s du LIG sont : une excellente connaissance des stratÃ©gies, un esprit crÃ©atif, une bonne comprÃ©hension du jeu, une bonne expÃ©rience de jeu, et une solide confiance en soi (vous allez devoir diriger votre Ã©quipe et prendre la totale responsabilitÃ© du round, mÃªme si vous le perdez).\r\n\r\nLe LIG doit pouvoir laisser ses coÃ©quipiers se concentrer sur leur jeu individuel, les enlevant cette lourde tache de devoir rÃ©flÃ©chir aux stratÃ©gies et essayer de lire dans le jeu adverse.\r\n\r\n![img1](https://cdn-images-1.medium.com/max/800/1*J8lAE3r7QrDCwEH-11oZIg.jpeg)\r\n\r\nMaintenant que vous savez en quoi consiste le rÃ´le, vous voulez certainement savoir comment le maÃ®triser, en effet les joueurs amateurs ne savent souvent pas comment aborder les rÃ´les quâ€™ils entreprennent. Câ€™est pourquoi jâ€™ai contactÃ© Engin â€œMAJ3Râ€ Kupeli, capitaine et leader in-game de lâ€™Ã©quipe Space Soldiers, afin de nous expliquer selon lui, comment fonctionne ce rÃ´le et quelles sont les clÃ©s pour le maÃ®triser.\r\n\r\n<hr>\r\n\r\n**Bonjour MAJ3R, dâ€™abord merci de mâ€™accorder un peu de ton temps pour rÃ©pondre Ã  mes questions. PremiÃ¨rement, penses-tu quâ€™il y a diffÃ©rents types de leader in-game ? Si oui lesquels ?**\r\n\r\nOui il existe plusieurs styles de leader, cela dÃ©pend fortement du caractÃ¨re de lâ€™individus, par exemple je suis un peu perfectionniste donc je demande beaucoup Ã  mes team mates (coÃ©quipiers) de retravailler leurs smokes, je leur dit quâ€™une smoke ratÃ©e de 1 cm peut faire changer un rounds etc. Ensuite il y a aussi diffÃ©rentes faÃ§on de lead, agressif, passif, utiliser les deux, utiliser des stratÃ©gies basÃ©es sur des smokes flash molotov ou bien jouer de maniÃ¨re beaucoup plus lente et pendre une dÃ©cision sur les infos quâ€™on reÃ§ois. Je pense que la meilleure maniÃ¨re est dâ€™Ãªtre polyvalent et dâ€™utiliser toute ces mÃ©thode dans un moment prÃ©cis.','cs-go-le-role-de-leader-in-game',NULL),(9,'fba73914322c076c78632fcffee47e53','LE MARKDOWN ALLO?',2,15,'2018-03-05 16:40:55','2018-03-06 14:25:39','###### Extending Twig\r\n\r\nTwig can be extended in many ways; you can add extra tags, filters, tests,\r\noperators, global variables, and functions. You can even extend the parser\r\nitself with node visitors.\r\n\r\n.. note::\r\n\r\n    The first section of this chapter describes how to extend Twig easily. If\r\n    you want to reuse your changes in different projects or if you want to\r\n    share them with others, you should then create an extension as described\r\n    in the following section.\r\n\r\n.. caution::\r\n\r\n    When extending Twig without creating an extension, Twig won\'t be able to\r\n    recompile your templates when the PHP code is updated. To see your changes\r\n    in real-time, either disable template caching or package your code into an\r\n    extension (see the next section of this chapter).\r\n\r\nBefore extending Twig, you must understand the differences between all the\r\ndifferent possible extension points and when to use them.\r\n\r\nFirst, remember that Twig has two main language constructs:\r\n\r\n* ``{{ }}``: used to print the result of an expression evaluation;\r\n\r\n* ``{% %}``: used to execute statements.\r\n\r\nTo understand why Twig exposes so many extension points, let\'s see how to\r\nimplement a *Lorem ipsum* generator (it needs to know the number of words to\r\ngenerate).\r\n\r\nYou can use a ``lipsum`` *tag*:\r\n\r\n.. code-block:: jinja\r\n\r\n    {% lipsum 40 %}\r\n\r\nThat works, but using a tag for ``lipsum`` is not a good idea for at least\r\nthree main reasons:\r\n\r\n* ``lipsum`` is not a language construct;\r\n* The tag outputs something;\r\n* The tag is not flexible as you cannot use it in an expression:\r\n\r\n  .. code-block:: jinja\r\n\r\n      {{ \'some text\' ~ {% lipsum 40 %} ~ \'some more text\' }}\r\n\r\nIn fact, you rarely need to create tags; and that\'s good news because tags are\r\nthe most complex extension point of Twig.','le-markdown-allo',NULL),(10,'ab911021d162bf67396c5b99a1351094','test',2,15,'2018-03-07 14:35:47','2018-03-07 14:35:47','### Allo ?','test','ab911021d162bf67396c5b99a1351094');
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `d_category_slug_uindex` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d_category`
--

LOCK TABLES `d_category` WRITE;
/*!40000 ALTER TABLE `d_category` DISABLE KEYS */;
INSERT INTO `d_category` VALUES (9,'90c2b47f2864719b5aa9c1dc91384320','CS:GO','cs-go','2018-02-22 03:42:54',''),(14,'36f16ce6975f34c7f793e16beb1b9f68','DÃ©veloppement','developpement','2018-02-23 02:54:07',''),(15,'652e4c4a75714ee12662594a460f1481','PHP','php','2018-03-05 17:09:17','');
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
  `access` int(11) NOT NULL,
  `description` text,
  `avatar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `d_users`
--

LOCK TABLES `d_users` WRITE;
/*!40000 ALTER TABLE `d_users` DISABLE KEYS */;
INSERT INTO `d_users` VALUES (2,'o90ccaHWhdnXIs54ZbXb7OgEvsX2NPRFFiLt','SundownDEV','daimyo@devbreak.fr','$2y$10$1DrA71.COOnqx1sMvYrRLeakZ4UYP0tMz4Et9VFpJe7cA69ZgI0sC','2018-02-21 00:00:00',1,'I got the power',NULL);
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

-- Dump completed on 2018-03-07 15:23:41
