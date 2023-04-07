-- Suppression des tables existantes;

DROP TABLE IF EXISTS CategorieUtilisateur;
DROP TABLE IF EXISTS Utilisateur;
DROP TABLE IF EXISTS Playlist;
DROP TABLE IF EXISTS Pubs;
DROP TABLE IF EXISTS Terminal;
DROP TABLE IF EXISTS TypeTerminal;
DROP TABLE IF EXISTS EmplacementTerminal;
DROP TABLE IF EXISTS PlaylistPubs;
DROP TABLE IF EXISTS PlaylistTerminaux;
DROP TABLE IF EXISTS TypeFichier;
DROP TABLE IF EXISTS Historique;

-- Création des tables;

CREATE TABLE Utilisateur (
    id_utilisateur INT NOT NULL AUTO INCREMENT PRIMARY KEY,
    login_utilisateur VARCHAR(25) NOT NULL,
    pwd_utilisateur VARBINARY(255) NOT NULL,
    id_categorie_utilisateur INT REFERENCES CategorieUtilisateur(id_categorie_utilisateur) NOT NULL
);

CREATE TABLE CategorieUtilisateur (
    id_categorie_utilisateur INT NOT NULL AUTO INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(50) NOT NULL
);

CREATE TABLE Playlist (
    id_playlist INT NOT NULL AUTO INCREMENT PRIMARY KEY,
    debut_date_playlist DATE NOT NULL,
    fin_date_playlist DATE NOT NULL,
    categorie_playlist VARCHAR(50) NOT NULL,
    creation_date_playlist DATETIME NOT NULL
);

CREATE TABLE Pubs (
    id_pubs INT NOT NULL AUTO INCREMENT PRIMARY KEY,
    nom_pubs VARCHAR(100),
    duree_pubs DECIMAL(4,2) NOT NULL,
    type_fichier VARCHAR(15) REFERENCES TypeFichier(type_fichier) NOT NULL
);

CREATE TABLE Terminal (
    id_terminal INT NOT NULL AUTO INCREMENT PRIMARY KEY,
    nom_terminal VARCHAR(70),
    adresse_mac VARCHAR(70) NOT NULL,
    type_terminal VARCHAR(25) NOT NULL,
    emplacement_terminal VARCHAR(40) NOT NULL,
    categorie_playlist VARCHAR(50) REFERENCES Playlist (categorie_playlist) NOT NULL
);

CREATE TABLE TypeTerminal (
    id_type_terminal INT NOT NULL AUTO INCREMENT PRIMARY KEY,
    type_terminal VARCHAR(25) REFERENCES Terminal(type_terminal) NOT NULL
);

CREATE TABLE EmplacementTerminal (
    id_emplacement_terminal INT NOT NULL AUTO INCREMENT PRIMARY KEY,
    emplacement_terminal VARCHAR(40) REFERENCES Terminal(emplacement_terminal) NOT NULL
);

CREATE TABLE PlaylistPubs (
    id_playlist_pubs INT NOT NULL AUTO INCREMENT PRIMARY KEY,
    id_pubs INT REFERENCES Pubs(id_pubs) NOT NULL,
    id_playlist INT REFERENCES Playlist(id_playlist) NOT NULL
);

CREATE TABLE PlaylistTerminaux (
    id_playlist_terminaux INT NOT NULL AUTO INCREMENT PRIMARY KEY,
    id_playlist INT REFERENCES Playlist(id_playlist) NOT NULL,
    id_terminal INT REFERENCES Terminal(id_terminal) NOT NULL
);

CREATE TABLE TypeFichier (
    type_fichier VARCHAR(15) NOT NULL PRIMARY KEY,
    nom_format VARCHAR(40)
);

CREATE TABLE Historique (
    id_historique INT NOT NULL AUTO INCREMENT PRIMARY KEY,
    id_playlist_terminaux INT REFERENCES PlaylistTerminaux(id_playlist_terminaux) NOT NULL,
    id_playlist INT REFERENCES Playlist(id_playlist) NOT NULL,
    debut_date_playlist INT REFERENCES Playlist(debut_date_playlist) NOT NULL,
    fin_date_playlist INT REFERENCES Playlist(fin_date_playlist) NOT NULL,
    id_terminal INT REFERENCES Terminal(id_terminal) NOT NULL,
    type_terminal VARCHAR(25) REFERENCES Terminal(type_terminal) NOT NULL,
    nbrDeFoisJoueePlaylist INT DEFAULT 0
);

-- Création du jeu de données;

INSERT INTO Utilisateur VALUES (1, admin, admin, 'super_admin');
INSERT INTO CategorieUtilisateur VALUES (1, 'super_admin'),(2, 'admin'),(3, 'opérateur'),(4,'utilisateur');
INSERT INTO Playlist VALUES (1, '2022-03-10', '2022-03-17', 'Outilages', '2022-03-07 15:47:12'),(2, '2022-03-23', '2022-03-30', 'Maroquinerie', '2022-03-19 11:23:43');
INSERT INTO Pubs VALUES (1, 'Nouveau sac 1', 75.00, '.mp4'),(2, 'Sets tournevis 1', 43.34, '.mkv');
INSERT INTO Terminal VALUES (1, 'Samnsung modèle 1', '00:1P:56:11:3B:L7', 'Écran de télévision', 'Outilages', 'Outilages');
INSERT INTO TypeTerminal VALUES (1, 'Écran de télévision');
INSERT INTO EmplacementTerminal VALUES (1, 'Fromagerie'),(2, 'Outilages'),(3, 'Boucherie'),(4, 'Prêt-à-porter'),(5, 'Poissonnerie');
INSERT INTO PlaylistPubs VALUES (1, 2, 1);
INSERT INTO PlaylistTerminaux VALUES (1, 1, 1);
INSERT INTO TypeFichier VALUES ('.mp4', 'MPEG-4'),('.mkv', 'Matroska Video');
INSERT INTO Historique VALUES (1, 1, 1, '2022-03-10', '2022-03-17', 1, 'Écran de télévision', 3);