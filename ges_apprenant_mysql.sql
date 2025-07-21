
-- MySQL Dump Equivalent of ges_apprenant.sql (Structure + Insert Adapté)
CREATE DATABASE IF NOT EXISTS ges_apprenant;
USE ges_apprenant;

-- Table: apprenant
CREATE TABLE apprenant (
    id INT AUTO_INCREMENT PRIMARY KEY,
    matricule VARCHAR(50) NOT NULL,
    photo BLOB,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    adresse TEXT,
    telephone VARCHAR(20),
    id_referentiel INT NOT NULL,
    statut VARCHAR(20) DEFAULT 'Actif',
    email VARCHAR(100),
    date_naissance DATE,
    lieu_naissance VARCHAR(100)
);

-- Table: referentiel
CREATE TABLE referentiel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(255) NOT NULL,
    photo BLOB,
    description TEXT,
    capacite INT,
    CHECK (capacite >= 0)
);

-- Table: promotion
CREATE TABLE promotion (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    statut VARCHAR(20) NOT NULL,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    nb_apprenants INT DEFAULT 0,
    cover_photo BLOB,
    CHECK (nb_apprenants >= 0),
    CHECK (statut IN ('Actif', 'Inactif'))
);

-- Table: promo_referentiel
CREATE TABLE promo_referentiel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    promo_id INT,
    referentiel_id INT
);

-- Table: tuteur
CREATE TABLE tuteur (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    telephone VARCHAR(20),
    adresse TEXT,
    lien_de_parente VARCHAR(50),
    id_apprenant INT NOT NULL
);

-- Table: utilisateur
CREATE TABLE utilisateur (
    id_utilisateur INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    email VARCHAR(100) NOT NULL,
    mot_de_passe TEXT NOT NULL,
    photo BLOB,
    profil VARCHAR(20) NOT NULL,
    CHECK (profil IN ('Admin', 'Vigile', 'Apprenant'))
);
