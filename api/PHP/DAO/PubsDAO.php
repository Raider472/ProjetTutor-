<?php
    require_once("./PHP/Classe/Pubs.php");
    class LesPubs implements JsonSerializable {
        private array $pubTab;

        public function getArrayTab() {
            return $this->pubTab;
        }

        public function setArrayTab($arrayTab) {
            $this->pubTab = $arrayTab;
        }

        public function fetchPubById(int $id) {
            $dbo = connexion();
            $req = $dbo -> execSQL("SELECT * FROM Playlist WHERE id_playlist = $id");
            unset($dbo);
            $pubs = [];
            foreach($req as $lesPubs) {
                $pubs[] = new Pubs(
                    $lesPubs["id_pubs"],
                    $lesPubs["nom_pubs"],
                    $lesPubs["duree_pubs"],
                    $lesPubs["type_fichier"]
                );
            }
            $this->setArrayTab($pubs);
        }

        

        public function jsonSerialize():mixed {
            return $this->pubTab;
        }
    }
?>