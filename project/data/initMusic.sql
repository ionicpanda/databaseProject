CREATE DATABASE music;

use music;

CREATE TABLE instruments (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        invented VARCHAR(10) NOT NULL,
        musickey VARCHAR(8) NOT NULL,
        clef VARCHAR(10)
);

CREATE TABLE family (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        components VARCHAR(30) NOT NULL,
        instrument_id VARCHAR(50) NOT NULL
);


CREATE TABLE ensembles (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        family_id INT(30) NOT NULL,
        playercount INT(50) NOT NULL
);


CREATE TABLE genre (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        ensemble_id VARCHAR(30) NOT NULL
);


CREATE TABLE period (
        id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(30) NOT NULL,
        start VARCHAR(30) NOT NULL,
        end VARCHAR(50) NOT NULL,
        genre_id INT(3)
);
