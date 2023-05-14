<?php
    require_once("./functionConnexion/ConnexionDocker.php");
    require("./Pubs.php");
    require("./TypeFichier.php");

    class ImageEtVideo {
        private int $id_image_video;
        private Pubs $id_pubs;
        private TypeFichier $type_fichier;
        private string $type_contenu;

        public function __construct($id_image_video, $id_pubs, $type_fichier, $type_contenu) {
            if($id_image_video!=0) {
                $this->fetchImageEtVideoById($id_image_video);
            }
            else {
                $this->id_image_video = $id_image_video;
                $this->id_pubs = $id_pubs;
                $this->type_fichier = $type_fichier;
                $this->type_contenu = $type_contenu;
            }
        }

        private function fetchImageEtVideoById($id) {
            $dbo = connexion();
            $req = $dbo -> execSQL("SELECT * FROM ImageEtVideo WHERE id_image_video =" . $id);
            unset($dbo);
            foreach($req as $lesrequeteTab) {
                $this->id_image_video = $lesrequeteTab["id_image_video"];
                $this->id_pubs = $lesrequeteTab["id_pubs"];
                $this->type_fichier = $lesrequeteTab["type_fichier"];
                $this->type_contenu = $lesrequeteTab["type_contenu"];
            }
        }

        public function getId_ImageEtVideo() {
            return $this->id_image_video;
        }
        public function getId_Pubs() {
            return $this->id_pubs;
        }
        public function getTypeFichier() {
            return $this->type_fichier;
        }
        public function getTypeContenu() {
            return $this->type_contenu;
        }

        public function setId_ImageEtVideo($id_image_video) {
            $this->id_image_video = $id_image_video;
        }
        public function setId_Pubs($id_pubs) {
            $this->id_pubs = $id_pubs;
        }
        public function setTypeFichier($type_fichier) {
            $this->type_fichier = $type_fichier;
        }
        public function setTypeContenu($type_contenu) {
            $this->type_contenu = $type_contenu;
        }
    }
?>