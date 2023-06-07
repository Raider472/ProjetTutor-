<?php
    require_once("functionConnexion/ConnexionDocker.php");

    class CategorieFichier implements JsonSerializable {
        private int $id_image_video;
        private string $type_contenu;

        public function __construct($id_image_video = 3, $type_contenu = "Texte") {
            if($id_image_video!=3) {
                $this->fetchCategorieById($id_image_video);
            }
            else {
                $this->id_image_video = $id_image_video;
                $this->type_contenu = $type_contenu;
            }
        }

        private function fetchCategorieById($id) {
            $dbo = connexion();
            $req = $dbo -> execSQL("SELECT * FROM CategorieFichier WHERE id_image_video = $id");
            unset($dbo);
            foreach($req as $lesrequeteTab) {
                $this->id_image_video = $lesrequeteTab["id_image_video"];
                $this->type_contenu = $lesrequeteTab["type_contenu"];
            }
        }

        public function getId_ImageEtVideo() {
            return $this->id_image_video;
        }
        public function getTypeContenu() {
            return $this->type_contenu;
        }

        public function setId_ImageEtVideo($id_image_video) {
            $this->id_image_video = $id_image_video;
        }
        public function setTypeContenu($type_contenu) {
            $this->type_contenu = $type_contenu;
        }

        public function jsonSerialize():mixed {
            return [
               "Id" => $this->id_image_video,
               "TypeContenu" => $this->type_contenu
            ];
        }
    }
?>