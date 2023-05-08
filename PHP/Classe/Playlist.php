<?php
    require_once("./Pubs.php");
    require_once("./functionConnexion/ConnexionDocker.php");
    class Playlist {
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
    }
?>