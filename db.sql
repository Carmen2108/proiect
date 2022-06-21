DROP TABLE IF EXISTS `autographs`;

CREATE TABLE `autographs` (
  `a_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `domain` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `provenance` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `location` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `object` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `mentions` varchar(45) COLLATE utf8mb4_bin DEFAULT NULL,
  `worth` decimal(10,0) DEFAULT NULL,
  `image` varchar(100) DEFAULT 'images/autograph.jpg',
  `user_id` int NOT NULL,
  PRIMARY KEY (`a_id`),
  UNIQUE KEY `id_UNIQUE` (`a_id`)
) ENGINE=InnoDB;


LOCK TABLES `autographs` WRITE;

INSERT INTO `autographs` VALUES 
(1,'Author1','music','concert','Bucuresti','paper','fewgfewgege',2002,'images/autograph.jpg',2),
(2,'Author2','football','game','Iasi','ball','60bfe7155a1ed',1500,'images/autograph.jpg',1),
(3,'Author3','art','museum','Iasi','paper','60bfe7155a1ed',4000,'images/autograph.jpg',2),
(4,'Author4','music','concert','Bucuresti','paper','fewgfewgege',900,'images/autograph.jpg',3),
(5,'Author5','football','game','Iasi','ball','60bfe7155a1ed',4999,'images/autograph.jpg',1);


UNLOCK TABLES;


DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(8) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(16) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'buyer',
  `balance` INT DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `balance` (`balance`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users` WRITE;

INSERT INTO `users` VALUES 
(1,'admin','$2y$10$xJVDq3HjKeYFd3jqJU6XTuxXtjaK5sVYVtYE4BM4vh.UJpPC9JI6.','2022-06-1 05:39:04','admin',0),
(2,'carmen','$2y$10$Nv9ZwUJmsbVEv8X/BetypuZIzK7P9rrPowTm28hQfcXnc8hC.701m','2022-06-1 05:41:10','buyer',10000),
(3,'razvan','$2y$10$q7qNm1jq1rsn4QCqh6ZdKuhtG6/OgVzIMo/BIcGavjS.UFpz0OzVa','2022-06-1 05:42:45','buyer',2000);

UNLOCK TABLES;
