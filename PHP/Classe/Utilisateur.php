<?php
    require_once("CategorieUtilisateur.php");
    require_once("functionConnexion/ConnexionDocker.php");
    class Utilisateur implements JsonSerializable {
        private int $id_utilisateur;
        private string $login_utilisateur;
        //private $pwd_utilisateur;
        private CategorieUtilisateur $id_categorie_utilisateur;

        public function __construct($id_utilisateur, $login_utilisateur, $id_categorie_utilisateur) {
            $this->id_utilisateur = $id_utilisateur;
            $this->login_utilisateur = $login_utilisateur;
            $this->id_categorie_utilisateur = new CategorieUtilisateur($id_categorie_utilisateur);
        }

        public function getId_utilisateur() {
            return $this->id_utilisateur;
        }

        public function getLogin_utilisateur() {
            return $this->login_utilisateur;
        }

        public function getId_categorie() {
            return $this->id_categorie_utilisateur;
        }

        public function setId_utilisateur($id_utilisateur) {
            $this->id_utilisateur = $id_utilisateur;
        }

        public function setLogin_utilisateur($login_utilisateur) {
            $this->login_utilisateur = $login_utilisateur;
        }

        public function setId_categorie($id_categorie) {
            $this->id_categorie_utilisateur = $id_categorie;
        }

        public function jsonSerialize():mixed {
            return [
                $this->id_utilisateur,
                $this->login_utilisateur,
                $this->id_categorie_utilisateur
            ];
        }
    }
?>