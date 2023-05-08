<?php
    class Pubs {
        private int $id_pubs;
        private string $nom_pubs;
        private float $duree_pubs;

        public function __construct($id_pubs, $nom_pubs, $duree_pubs) {
            $this->id_pubs = $id_pubs;
            $this->nom_pubs = $nom_pubs;
            $this->duree_pubs = $duree_pubs;
        }

        public function getId_pubs() {
            return $this->id_pubs;
        }

        public function getNom_pubs() {
            return $this->nom_pubs;
        }

        public function getDuree_pubs() {
            return $this->duree_pubs;
        }

        public function setId_pubs($id_pubs) {
            $this->id_pubs = $id_pubs;
        }

        public function setNom_pubs($nom_pubs) {
            $this->nom_pubs = $nom_pubs;
        }

        public function setDuree_pubs($duree_pubs) {
            $this->duree_pubs = $duree_pubs;
        }
    }
?>