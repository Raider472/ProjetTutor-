<?php
    require_once("functionConnexion/ConnexionDocker.php");
    require_once("./PHP/Classe/CategorieFichier.php");

    class TypeFichier implements JsonSerializable {
        private string $type_fichier;
        private string $nom_format;

        private CategorieFichier $id_imageVideo;

        public function __construct($type_fichier = ".txt", $nom_format = "Texte", $id_imageVideo = 3) {
            if($type_fichier!=".txt") {
                $this->fetchCategorieById($type_fichier);
            }
            else {
                $this->type_fichier = $type_fichier;
                $this->nom_format = $nom_format;
                $this->id_imageVideo = new CategorieFichier($id_imageVideo);
            }
        }

        private function fetchCategorieById($id) {
            $dbo = connexion();
            $req = $dbo -> execSQL("SELECT * FROM TypeFichier WHERE type_fichier = \"$id\"");
            unset($dbo);
            foreach($req as $lesrequeteTab) {
                $this->type_fichier = $lesrequeteTab["type_fichier"];
                $this->nom_format = $lesrequeteTab["nom_format"];
                $this->id_imageVideo = new CategorieFichier($lesrequeteTab["id_imageVideo"]);
                
            }
        }

        public function getTypeFichier() {
            return $this->type_fichier;
        }
        public function getNomFormat() {
            return $this->nom_format;
        } 

        public function setTypeFichier($type_fichier) {
            $this->type_fichier = $type_fichier;
        }
        public function setNomFormat($nom_format) {
            $this->nom_format = $nom_format;
        }

        public function jsonSerialize():mixed {
            return [
               "TypeDeFichier" => $this->type_fichier,
               "NomFormat" => $this->nom_format,
               "CategorieFichier" => $this->id_imageVideo,
            ];
        }
    }
?>