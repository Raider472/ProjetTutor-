-- Suppression des tables existantes;

DROP TABLE IF EXISTS CategorieUtilisateur;
DROP TABLE IF EXISTS Utilisateur;
DROP TABLE IF EXISTS AuditTrail;
DROP TABLE IF EXISTS Playlist;
DROP TABLE IF EXISTS Pubs;
DROP TABLE IF EXISTS Terminal;
DROP TABLE IF EXISTS TypeTerminal;
DROP TABLE IF EXISTS EmplacementTerminal;
DROP TABLE IF EXISTS PlaylistPubs;
DROP TABLE IF EXISTS PlaylistTerminaux;
DROP TABLE IF EXISTS TypeFichier;
DROP TABLE IF EXISTS ImageEtVideo;

-- Création des tables;

CREATE TABLE Utilisateur (
    id_utilisateur INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    login_utilisateur VARCHAR(25) NOT NULL,
    pwd_utilisateur VARBINARY(255) NOT NULL,
    id_categorie_utilisateur INT NOT NULL REFERENCES CategorieUtilisateur(id_categorie_utilisateur)
);

CREATE TABLE CategorieUtilisateur (
    id_categorie_utilisateur INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nom_categorie VARCHAR(50) NOT NULL
);

CREATE TABLE Playlist (
    id_playlist INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nom_playlist VARCHAR(100) NOT NULL,
    debut_date_playlist DATE NOT NULL,
    fin_date_playlist DATE NOT NULL,
    categorie_playlist VARCHAR(50) NOT NULL
);

CREATE TABLE AuditTrail (
    id_audit_trail INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_playlist INT NOT NULL REFERENCES Playlist (id_playlist),
    creation_date_playlist DATE NOT NULL,
    id_utilisateur INT NOT NULL REFERENCES Utilisateur (id_utilisateur),
    id_categorie_utilisateur INT NOT NULL REFERENCES CategorieUtilisateur (id_categorie_utilisateur)
);

CREATE TABLE Pubs (
    id_pubs INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nom_pubs VARCHAR(100),
    duree_pubs DECIMAL(4,2) DEFAULT 0 -- En secondes.
);

CREATE TABLE Terminal (
    id_terminal INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nom_terminal VARCHAR(70),
    adresse_mac VARCHAR(70) NOT NULL,
    id_type_terminal INT NOT NULL REFERENCES TypeTerminal (id_type_terminal),
    id_emplacement_terminal INT NOT NULL REFERENCES EmplacementTerminal (id_emplacement_terminal),
    categorie_playlist VARCHAR(50) NOT NULL REFERENCES Playlist (categorie_playlist)
);

CREATE TABLE TypeTerminal (
    id_type_terminal INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    type_terminal VARCHAR(25) NOT NULL REFERENCES Terminal(type_terminal)
);

CREATE TABLE EmplacementTerminal (
    id_emplacement_terminal INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    emplacement_terminal VARCHAR(40) NOT NULL REFERENCES Terminal(emplacement_terminal)
);

CREATE TABLE PlaylistPubs (
    PRIMARY KEY(id_pubs, id_playlist),
    id_pubs INT NOT NULL REFERENCES Pubs(id_pubs),
    id_playlist INT NOT NULL REFERENCES Playlist(id_playlist)
);

CREATE TABLE PlaylistTerminaux (
    PRIMARY KEY(id_terminal, id_playlist),
    id_playlist INT NOT NULL REFERENCES Playlist(id_playlist),
    id_terminal INT NOT NULL REFERENCES Terminal(id_terminal),
        nbr_de_fois_jouee_playlist INT DEFAULT 0,
    playlist_loop BOOLEAN DEFAULT false
);

CREATE TABLE TypeFichier (
    type_fichier VARCHAR(15) NOT NULL PRIMARY KEY,
    nom_format VARCHAR(40)
);

CREATE TABLE ImageEtVideo (
    id_image_video INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_pubs INT NOT NULL REFERENCES Pubs (id_pubs),
    type_fichier VARCHAR(15) NOT NULL REFERENCES TypeFichier (type_fichier),
    type_contenu VARCHAR(15) NOT NULL -- Exemple : Vidéo OU Son OU Image OU Texte
);

-- Création du jeu de données;

INSERT INTO Utilisateur VALUES (1, 'sudo', AES_ENCRYPT('sudo', 'YepaGaming'), 1), (2, 'admin', AES_ENCRYPT('admin', 'YepaGaming'), 2), (3, 'operatortest', AES_ENCRYPT('operatortest', 'YepaGaming'), 3), (4, 'usertest', AES_ENCRYPT('usertest', 'YepaGaming'), 4), (5, 'pgeorges', AES_ENCRYPT('Georges84@', 'YepaGaming'), 3), (6, 'nmart', AES_ENCRYPT('nat78#', 'YepaGaming'), 4);
INSERT INTO CategorieUtilisateur VALUES (1, 'super_admin'), (2, 'admin'), (3, 'opérateur'), (4,'utilisateur');
INSERT INTO Playlist VALUES (1, 'Outilages', '2022-03-10', '2022-03-17', 'Outilages'),(2, 'Maroquinerie', '2022-03-23', '2022-03-30', 'Maroquinerie');
INSERT INTO AuditTrail VALUES (1, 1, '2022-03-07 15:47:12', 5, 3), (2, 2, '2022-03-19 11:23:43', 5, 3);
INSERT INTO Pubs VALUES (1, 'Nouveau sac 1', 5), (2, 'Sets tournevis 1', 5), (3, 'Nouveau jouet 1', 5), (4, 'Promotion Fromagerie', 5), (5, 'Promotion Boucherie', 5);
INSERT INTO Terminal VALUES (1, 'Samsung modèle X', '00:1P:56:11:3B:L7', 1, 2, 'Outilages'), (2, 'Samsung modèle X', '01:3R:34:67:9Y:J0', 1, 1, 'Fromagerie'), (3, 'Samsung modèle X', '78:3K:89:32:5T:B5', 1, 4, 'Maroquinerie');
INSERT INTO TypeTerminal VALUES (1, 'Écran de télévision'), (2, 'Ordinateur'), (3, 'Smartphone'), (4, 'Autres');
INSERT INTO EmplacementTerminal VALUES (1, 'Fromagerie'), (2, 'Outilages'), (3, 'Boucherie'), (4, 'Prêt-à-porter'), (5, 'Poissonnerie'), (6, 'Boulangerie'), (7, 'Sports'), (8, 'Multimédia');
INSERT INTO PlaylistPubs VALUES (2, 1), (1, 2), (1, 1), (3, 1), (4, 1);
INSERT INTO PlaylistTerminaux VALUES (1, 1, 956, 0), (2, 3, 5672, 0);
INSERT INTO TypeFichier VALUES ('.mp3', 'MPEG-2'), ('.mp4', 'MPEG-4'), ('.mkv', 'Matroska Video'), ('.png', 'Portable Network Graphic'), ('.jpeg', 'Joint Photographic Experts Group'), ('.gif', 'Graphics Interchange Format');
INSERT INTO ImageEtVideo VALUES (1, 1, '.mp4', 'Vidéo'), (2, 2, '.mkv', 'Vidéo'), (3, 3, '.png', 'Image'), (4, 4, '.jpeg', 'Texte'), (5, 5, '.gif', 'Vidéo');