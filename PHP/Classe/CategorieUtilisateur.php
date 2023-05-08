<?php
    require_once("functionConnexion/ConnexionDocker.php");
    class CategorieUtilisateur {
        private int $id_categorie_utilisateur;
        private string $nom_categorie;

        public function __construct($id_categorie = 0, $nom_categorie = "") {
            if($id_categorie!=0) {
                $this->fetchCategorieById($id_categorie);
            }
            else {
                $this->id_categorie_utilisateur = $id_categorie;
                $this->nom_categorie = $nom_categorie;
            }
        }

        private function fetchCategorieById($id) {
            $dbo = connexion();
            $req = $dbo -> execSQL("SELECT * FROM CategorieUtilisateur WHERE id_categorie_utilisateur =" . $id);
            unset($dbo);
            foreach($req as $lesrequeteTab) {
                $this->id_categorie_utilisateur = $lesrequeteTab["id_categorie_utilisateur"];
                $this->nom_categorie = $lesrequeteTab["nom_categorie"];
            }
        }

        public function getId_categorie() {
            return $this->id_categorie_utilisateur;
        }

        public function setId_categorie($id_categorie) {
            $this->id_categorie_utilisateur = $id_categorie;
        }

        public function getNom_categorie() {
            return $this->nom_categorie;
        }

        public function setNom_categorie($nom_categorie) {
            $this->nom_categorie = $nom_categorie;
        }
    }
?>