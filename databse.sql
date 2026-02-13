DROP DATABASE IF EXISTS ticketing_app;
CREATE DATABASE ticketing_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE ticketing_app;

-- Table CLIENTS
CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom_entreprise VARCHAR(255) NOT NULL
);

-- Table UTILISATEURS
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    prenom VARCHAR(100) NOT NULL,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) DEFAULT 'client'
);

-- Table CONTRATS
CREATE TABLE contrats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    client_id INT NOT NULL,
    nom_contrat VARCHAR(255) NOT NULL,
    heures_incluses INT DEFAULT 0,
    taux_horaire DECIMAL(10,2) DEFAULT 0.00,
    date_debut DATE,
    date_fin DATE,
    FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE
);

-- Table PROJETS
CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contrat_id INT NOT NULL,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    statut VARCHAR(50) DEFAULT 'Actif',
    FOREIGN KEY (contrat_id) REFERENCES contrats(id) ON DELETE CASCADE
);

-- Table TICKETS
CREATE TABLE tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    projet_id INT NOT NULL,
    auteur_id INT NOT NULL,
    titre VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    statut VARCHAR(50) DEFAULT 'Nouveau',
    priorite VARCHAR(50) DEFAULT 'Moyenne',
    type VARCHAR(50) DEFAULT 'inclus', -- inclus ou facturable
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (projet_id) REFERENCES projects(id) ON DELETE CASCADE,
    FOREIGN KEY (auteur_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Table TEMPS PASSE
CREATE TABLE temps_passe (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ticket_id INT NOT NULL,
    user_id INT NOT NULL,
    duree_heures DECIMAL(5,2) NOT NULL,
    date_saisie DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ticket_id) REFERENCES tickets(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- ==========================================
-- JEU DE DONNÉES TEST
-- ==========================================
INSERT INTO clients (nom_entreprise) VALUES ('Acme Corp');

INSERT INTO users (prenom, nom, email, password, role) 
VALUES ('Jean', 'Admin', 'admin@ticketing.app', 'secret', 'admin');

-- On crée d'abord le Contrat
INSERT INTO contrats (client_id, nom_contrat, heures_incluses, taux_horaire) 
VALUES (1, 'Maintenance Globale 2026', 50, 80.00);

-- Ensuite on attache le Projet à ce Contrat
INSERT INTO projects (contrat_id, nom, description) 
VALUES (1, 'Site Vitrine 2026', 'Refonte complète');

-- Et on ajoute les tickets
INSERT INTO tickets (projet_id, auteur_id, titre, description, priorite, type) 
VALUES 
(1, 1, 'Problème affichage menu', 'Le menu est cassé', 'Haute', 'inclus'),
(1, 1, 'Ajout module PDF', 'Demande export', 'Moyenne', 'facturable');