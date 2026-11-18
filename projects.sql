CREATE DATABASE IF NOT EXISTS `projects`
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci;

USE `projects`;

CREATE TABLE IF NOT EXISTS `projects` (
    `id` int NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `image` varchar(255) NOT NULL,
    `link` varchar(255) NOT NULL,
    `database` varchar(255) NOT NULL,
    `technologies` varchar(255) DEFAULT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `uq_projects_name` (`name`),
    UNIQUE KEY `uq_projects_image` (`image`),
    UNIQUE KEY `uq_projects_link` (`link`),
    UNIQUE KEY `uq_projects_database` (`database`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT IGNORE INTO `projects`
    (`id`, `name`, `image`, `link`, `database`, `technologies`)
VALUES
    (1, 'Islandia', 'img/1.png', 'zadania/z1/islandia.php', 'zadania/z1/BD/baza.sql', 'HTML,PHP,MySQL,CSS'),
    (2, 'Wodospady', 'img/2.png', 'zadania/z2/index.php', 'zadania/z2/BD/baza.sql', 'HTML,PHP,MySQL,CSS'),
    (3, 'Fotele', 'img/3.png', 'zadania/z3/kartaProduktu.html', 'zadania/z3/BD/baza.sql', 'HTML,JS,MySQL,CSS'),
    (4, 'Rezerwacja', 'img/4.png', 'zadania/z4/rezerwacja.html', 'zadania/z4/BD/baza.sql', 'HTML,JS,MySQL,CSS'),
    (5, 'Antyki', 'img/5.png', 'zadania/z5/index.php', 'zadania/z5/BD/baza.sql', 'HTML,PHP,MySQL,CSS'),
    (6, 'Recepty', 'img/6.png', 'zadania/z6/recepty.html', 'zadania/z6/BD/baza.sql', 'HTML,JS,MySQL,CSS'),
    (7, 'Gra', 'img/7.png', 'zadania/z7/gra.html', 'zadania/z7/BD/baza.sql', 'HTML,JS,MySQL,CSS'),
    (8, 'Baza Gier', 'img/8.png', 'zadania/z8/index.html', 'zadania/z8/BD/baza.sql', 'HTML,JS,MySQL,CSS'),
    (9, 'Restauracja', 'img/9.png', 'zadania/z9/index.html', 'zadania/z9/BD/baza.sql', 'HTML,JS,MySQL,CSS'),
    (10, 'Laboratorium', 'img/10.png', 'zadania/z10/login.php', 'zadania/z10/BD/baza.sql', 'HTML,PHP,MySQL,CSS'),
    (11, 'Atlas Drzew', 'img/11.png', 'zadania/z11/lisciaste.html', 'zadania/z11/BD/baza.sql', 'HTML,JS,MySQL,CSS'),
    (12, 'Rowery', 'img/12.png', 'zadania/z12/index.html', 'zadania/z12/BD/baza.sql', 'HTML,JS,MySQL,CSS');
