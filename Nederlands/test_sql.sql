/*
-- FICHIER SQL POUR LE COURS DE NÉÉRLANDAIS
-- Samuel Jacquet
*/
DROP DATABASE IF EXISTS `nl_database`;
CREATE DATABASE IF NOT EXISTS `nl_database`;
USE `nl_database`;

/*
-- Création des tables 
*/
CREATE TABLE IF NOT EXISTS `nl_woordenschat`
(
    `id_woordenschat` INT NOT NULL AUTO_INCREMENT, 
    `woordenschat_woord` VARCHAR(255) NOT NULL UNIQUE,
    `woordenschat_vertaling` VARCHAR(255) NOT NULL UNIQUE,
    `woordenschat_lidword` CHAR(6),
    PRIMARY KEY(`id_woordenschat`)
);
-- Lijst van sterke en onregelmatige werkwoorden
CREATE TABLE IF NOT EXISTS `nl_onregelmatige_werkwoorden`
(
    `id_onregelmatige_werkwoorden` INT NOT NULL AUTO_INCREMENT, 
    `werkwoord_infinitief` VARCHAR(25) NOT NULL UNIQUE,
    `werkwoord_imperfectum_enkelvoud` VARCHAR(25) NOT NULL UNIQUE, -- ovt enkelvoud
    `werkwoord_imperfectum_meervoud` VARCHAR(25) NOT NULL UNIQUE,  -- ovt meervoud
    `werkwoord_participium_pefectum` VARCHAR(25) NOT NULL UNIQUE,
    `werkwoord_met_hebben_of_zijn` CHAR(1) NOT NULL,
    PRIMARY KEY(`id_onregelmatige_werkwoorden`)
);

/*
-- Ajout de quelques enregistrements 
*/
INSERT INTO `nl_woordenschat`(`woordenschat_woord`, `woordenschat_vertaling`, `woordenschat_lidword`)
VALUES
('gegeven(s)', 'donnée(s)', 'NC'), 
('bewerken', 'modifier', 'NC'),
('voornaam', 'Allemagne', 'NC'),
('tussenvoegsel', 'Deuxième nom', 'NC'),
('geboortedatum', 'date de naissance', 'NC'),
('geslacht', 'sexe', 'NC'),
('telefoonnummer', 'numéro de téléphone', 'NC'),
('e-mailadres', 'adresse e-mail', 'NC'),
('vorige stap', 'étape précédente', 'NC'),
('volgende stap', 'étape suivante', 'NC'),
('Straatnaam ongeldig, controleer je invoer', 'Nom de rue invalide, veuillez vérifier votre saisie', 'NC'),
('postcode', 'code postal', 'NC'),
('Gemeente', 'commune', 'NC'),
('Straat', 'rue', 'NC'),
('Huisnummer', 'numéro de maison', 'NC'),
('Mijn facturatieadres is gelijk aan bovenstaande adres', "Mon adresse de facturation est la même que l'adresse ci-dessus", 'NC'),
('Vul een wachtwoord van minstens 6 tekens in', "Entrez un mot de passe d'au moins 6 caractères", 'NC'),
('Herhaal je wachtwoord', 'Répétez votre mot de passe', 'NC'),
('Ik ga akkoord met de Algemene voorwaarden', "J'accepte les termes et conditions", 'NC'),
('afronden', 'achevé', 'NC'),
('leerling', 'élève', 'NC');
