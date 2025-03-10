CREATE DATABASE GestionEcole;

USE GestionEcole;

-- Table des utilisateurs (Admins, Profs, Élèves)
CREATE TABLE utilisateurs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    prenom VARCHAR(50) NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('admin', 'prof', 'eleve') NOT NULL,
    date_inscription TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table des classes
CREATE TABLE classes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom_classe VARCHAR(50) NOT NULL,
);

-- Table des élèves (lié aux classes)
CREATE TABLE eleves (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    classe_id INT NOT NULL,
    points INT DEFAULT 0,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE,
    FOREIGN KEY (classe_id) REFERENCES classes(id) ON DELETE CASCADE
);

-- Table des professeurs
CREATE TABLE profs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    utilisateur_id INT NOT NULL,
    classe_id INT NOT NULL,
    FOREIGN KEY (utilisateur_id) REFERENCES utilisateurs(id) ON DELETE CASCADE
    FOREIGN KEY (classe_id) REFERENCES classes(id) ON DELETE CASCADE

);


-- Table des appels (présences des élèves)
CREATE TABLE appels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    eleve_id INT NOT NULL,
    present BOOLEAN DEFAULT FALSE,
    date_appel TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (eleve_id) REFERENCES eleves(id) ON DELETE CASCADE
);

-- Table des modes de transport et des points
CREATE TABLE transports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    eleve_id INT NOT NULL,
    mode_transport ENUM('A pied', 'Vélo', 'Trottinette', 'Covoiturage', 'Trottinette electrique', 'Bus', 'Voiture') NOT NULL,
    points_attribues INT NOT NULL,
    date_utilisation DATE NOT NULL,
    FOREIGN KEY (eleve_id) REFERENCES eleves(id) ON DELETE CASCADE
);

-- Table de suivi des scores par élève
CREATE TABLE competition_scores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    eleve_id INT NOT NULL,
    points_totaux INT DEFAULT 0,
    date_mise_a_jour TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (eleve_id) REFERENCES eleves(id) ON DELETE CASCADE
);
