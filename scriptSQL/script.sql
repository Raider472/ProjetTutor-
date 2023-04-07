-- Suppression les tables existant

DROP TABLE IF EXISTS CategorieUtilisateur;
DROP TABLE IF EXISTS Utilisateur;

-- Creation des tableaux

CREATE TABLE Utilisateur (
    id_utilisateur INT NOT NULL PRIMARY KEY AUTO INCREMENT,
    login_utilisateur VARCHAR(25) NOT NULL,
    pwd_utilisateur VARBINARY(255) NOT NULL,
    id_categorie_utilisateur int REFERENCES CategorieUtilisateur(id_categorie_utilisateur) NOT NULL
);

CREATE TABLE CategorieUtilisateur (
    id_categorie_utilisateur INT NOT NULL PRIMARY KEY AUTO INCREMENT,
    nom_categorie VARCHAR(50) NOT NULL
);

--