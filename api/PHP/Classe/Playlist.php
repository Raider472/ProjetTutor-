<?php
    require_once("Pubs.php");
    require_once("functionConnexion/ConnexionDocker.php");
    class Playlist implements JsonSerializable {
        private int $id_playlist;
        private string $nom_playlist;
        private $debut_date_playlist;
        private $fin_date_playlist;
        private string $categorie_playlist;
        private array $tabPubs;

        public function __construct($id_playlist, $nom_playlist, $debut_date_playlist, $fin_date_playlist, $categorie_playlist) {
            $this->id_playlist = $id_playlist;
            $this->nom_playlist = $nom_playlist;
            $this->debut_date_playlist = $debut_date_playlist;
            $this->fin_date_playlist = $fin_date_playlist;
            $this->categorie_playlist = $categorie_playlist;
            $this->tabPubs = $this->fetchPubs($id_playlist);
        }

        public function getId_playlist() {
            return $this->id_playlist;
        }

        public function getNom_playlist() {
            return $this->nom_playlist;
        }

        public function getDebut_date_playlist() {
            return $this->debut_date_playlist;
        }

        public function getFin_date_playlist() {
            return $this->fin_date_playlist;
        }

        public function getCategorie_playlist() {
            return $this->categorie_playlist;
        }

        public function getTabPubs() {
            return $this->tabPubs;
        }

        public function setId_playlist($id) {
            $this->id_playlist = $id;
        }

        public function setNom_playlist($nom) {
            $this->nom_playlist = $nom;
        }

        public function setDebut_date_playlist($debut) {
            $this->debut_date_playlist = $debut;
        }

        public function setFin_date_playlist($fin) {
            $this->fin_date_playlist = $fin;
        }

        public function setCategorie_playlist($categorie) {
            $this->categorie_playlist = $categorie;
        }

        private function fetchPubs(int $idPlaylist): array {
            $dbo = connexion();
            $req = $dbo -> execSQL("SELECT * FROM PlaylistPubs Where id_playlist = $idPlaylist");
            unset($dbo);
            $pubs = [];
            foreach($req as $lesPubs) {
                $dbo = connexion();
                $parametre = $lesPubs["id_pubs"];
                $requete = $dbo -> execSQL("SELECT * FROM Pubs Where id_pubs = $parametre");
                unset($dbo);
                foreach($requete as $laPub) {
                    $pubs[] = new Pubs(
                        $laPub["id_pubs"],
                        $laPub["nom_pubs"],
                        $laPub["duree_pubs"],
                        $laPub["description_pubs"],
                        $laPub["type_fichier"],
                    );
                }
            }
            return $pubs;
        }

        public function jsonSerialize():mixed {
            return [
               "Id" => $this->id_playlist,
               "Nom" => $this->nom_playlist,
               "Debut" => $this->debut_date_playlist,
               "Fin" => $this->fin_date_playlist,
               "Categorie" => $this->categorie_playlist,
               "Pubs" => $this->tabPubs
            ];
        }
    }
?>