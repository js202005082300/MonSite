DROP DATABASE IF EXISTS `MyDB`;
CREATE DATABASE IF NOT EXISTS `MyDB`;
USE `MyDB`;
-- DROP DATABASE IF EXISTS `u870391923_MyDB`;
-- CREATE DATABASE IF NOT EXISTS `u870391923_MyDB`;
-- USE `u870391923_MyDB`;

DROP TABLE IF EXISTS `table_users`;
CREATE TABLE IF NOT EXISTS `table_users`
(
    `id_user` INT(11) NOT NULL AUTO_INCREMENT,
    `user_name` VARCHAR(25) NOT NULL UNIQUE,
    `user_email` VARCHAR(50) NOT NULL UNIQUE,
    `user_password` VARCHAR(255) NOT NULL,
    `user_admin` TINYINT(1) NOT NULL DEFAULT '0',
    -- `user_online_time` BIGINT(21) NOT NULL, 
    `user_lastConnexion` DATETIME DEFAULT NOW() NOT NULL,
    `user_registerDate` DATETIME DEFAULT NOW() NOT NULL,
    PRIMARY KEY(`id_user`)
);

DROP TABLE IF EXISTS `table_clients`;
CREATE TABLE IF NOT EXISTS `table_clients`
(
    `id_client` INT(11) NOT NULL AUTO_INCREMENT,
    `client_firstname` VARCHAR(25) NOT NULL,
    `client_lastname` VARCHAR(25) NOT NULL,
    `client_gender` ENUM('H','F') NOT NULL,
    `client_birthday` DATE NOT NULL,
    `client_email` VARCHAR(50) NOT NULL,
    `client_tel` VARCHAR(25) NOT NULL,
    `client_description` TEXT,
    `client_registerDate` DATETIME DEFAULT NOW() NOT NULL,
    PRIMARY KEY(`id_client`)
);

DROP TABLE IF EXISTS `table_dht`;
CREATE TABLE IF NOT EXISTS `table_dht`
(
    `id_dht` BIGINT(20) NOT NULL AUTO_INCREMENT,
    `dht_date` DATETIME DEFAULT NOW() NOT NULL,
    `dht_sensorName` VARCHAR(50) NOT NULL,
    `dht_location` VARCHAR(50) DEFAULT '-',
    `dht_humidity` FLOAT DEFAULT 0.00,
    `dht_tempCelsus` FLOAT DEFAULT 0.00,
    `dht_tempFahrenheit` FLOAT DEFAULT 0.00,
    `dht_heatIndexCelsus` FLOAT DEFAULT 0.00,
    `dht_heatIndexFahrenheit` FLOAT DEFAULT 0.00,
    `dht_dewPoint` FLOAT DEFAULT 0.00,
    PRIMARY KEY(`id_dht`)
);

DROP TABLE IF EXISTS `table_chatBox`;
CREATE TABLE IF NOT EXISTS `table_chatBox`;
(
    `id_message` INT(11) NOT NULL AUTO_INCREMENT,
    `message_id_user` INT(11) NOT NULL,
    `message_date` DATETIME DEFAULT NOW() NOT NULL,
    `message_message` TEXT,
    PRIMARY KEY(`id_message`)
);

INSERT INTO `table_users`(`user_name`, `user_password`, `user_email`, `user_admin`)
VALUES
('SamAdmin', '$2y$10$Fdlb6svlSAJKxVEWtK.UjOUz9FZg5G17C2Ekt6MrV/AsrXFnIeM8a', 'js201910271235@outlook.com', 1),
('Guest01', '$2y$10$2S1yQapCZG9t8gA9yoRp9.c3W5VhjaIdnuKlwJ8qOgreqksFIPbPm', 'js201910271235@outlook.com', 0),
('Guest02', '$2y$10$i2FLupW7brb5Sx0a5TCUFO0NOKqgE0GbILUwOw6yE4aZdu5bMzHoO', 'js201910271235@outlook.com', 0);

-- SOURCE C:/_Projets/MyWAMP/apache/htdocs/MonSiteProd/Database/mydb.sql;