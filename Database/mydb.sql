-- DROP DATABASE IF EXISTS `MyDB`;
-- CREATE DATABASE IF NOT EXISTS `MyDB`;
-- USE `MyDB`;
DROP DATABASE IF EXISTS `u870391923_MyDB`;
CREATE DATABASE IF NOT EXISTS `u870391923_MyDB`;
USE `u870391923_MyDB`;

DROP TABLE IF EXISTS `table_users`;
CREATE TABLE IF NOT EXISTS `table_users`(
    `id_user` BIGINT NOT NULL AUTO_INCREMENT,
    `user_name` VARCHAR(25) NOT NULL UNIQUE,
    `user_email` VARCHAR(50) NOT NULL UNIQUE,
    `user_password` VARCHAR(255) NOT NULL,
    `user_admin` TINYINT NOT NULL DEFAULT '0',
    `user_online` TINYINT NOT NULL DEFAULT '0',
    `user_lastConnexion` DATETIME DEFAULT NOW() NOT NULL,
    `user_registerDate` DATETIME DEFAULT NOW() NOT NULL,
    PRIMARY KEY(`id_user`)
);

DROP TABLE IF EXISTS `table_clients`;
CREATE TABLE IF NOT EXISTS `table_clients`(
    `id_client` BIGINT NOT NULL AUTO_INCREMENT,
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
CREATE TABLE IF NOT EXISTS `table_dht`(
    `id_dht` BIGINT NOT NULL AUTO_INCREMENT,
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

-- DROP TABLE IF EXISTS `table_chatBox`;
-- CREATE TABLE IF NOT EXISTS `table_chatBox`
-- (
--     `id_message` BIGINT NOT NULL AUTO_INCREMENT,
--     `message_id_user` BIGINT NOT NULL,
--     `message_date` DATETIME DEFAULT NOW() NOT NULL,
--     `message_message` TEXT,
--     PRIMARY KEY(`id_message`)
-- );

INSERT INTO `table_users`(`user_name`, `user_password`, `user_email`, `user_admin`)
VALUES
('SamAdmin','$2y$10$uwgGIluTgwBlFdx1u2iSKOAjutS4Urx8opffWukBZ.RDu9zppcGOq', 'js201910271235@outlook.com', 1),
('Guest01', '$2y$10$Khz/p4atXc39ndOwAqMRyuzYNhqDFWnK4VxiUAgMbqmGaEpzNFhIC', 'Guest01@test.com', 0),
('Guest02', '$2y$10$iie5OvGIG9KiUHxSI6Sgf.GvCY36Wp.jEo5FGYGxV6j1frmCqsbn.', 'Guest02@test.com', 0);


-- SOURCE C:/_Projets/MyWAMP/apache/htdocs/MonSiteProd/Database/mydb.sql;