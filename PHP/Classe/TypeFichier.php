<?php
    require_once("./functionConnexion/ConnexionDocker.php");

    class TypeFichier {
        private string $type_fichier;
        private string $nom_format;

        public function __construct($type_fichier, $nom_format) {
            if($type_fichier!=0) {
                $this->fetchTypeFichierById($type_fichier);
            }
            else {
                $this->type_fichier = $type_fichier;
                $this->nom_format = $nom_format;
            }
        }

        private function fetchTypeFichierById($id) {
            $dbo = connexion();
            $req = $dbo -> execSQL("SELECT * FROM TypeFichier WHERE type_fichier =" . $id);
            unset($dbo);
            foreach($req as $lesrequeteTab) {
                $this->type_fichier = $lesrequeteTab["type_fichier"];
                $this->nom_format = $lesrequeteTab["nom_format"];
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
    }
?>