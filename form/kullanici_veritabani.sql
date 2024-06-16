CREATE DATABASE kullanici_veritabani;

USE kullanici_veritabani;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    surname VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    birthdate DATE NOT NULL,
    gender ENUM('Erkek', 'Kadın', 'Diğer') NOT NULL
);
