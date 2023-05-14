<?php
    require_once("./functionConnexion/ConnexionDocker.php");
    require("./TypeTerminal.php");
    require("./EmplacementTerminal.php");
    require("./Playlist.php");

    class Terminal {
        private int $id_terminal;
        private string $nom_terminal;
        private string $adresse_mac;
        private TypeTerminal $id_type_terminal;
        private EmplacementTerminal $id_emplacement_terminal;
        private Playlist $categorie_playlist;

        public function __construct($id_terminal, $nom_terminal, $adresse_mac, $id_type_terminal, $id_emplacement_terminal, $categorie_playlist) {
            if($id_terminal!=0) {
                $this->fetchTerminalById($id_terminal);
            }
            else {
                $this->id_terminal = $id_terminal;
                $this->nom_terminal = $nom_terminal;
                $this->adresse_mac = $adresse_mac;
                $this->id_type_terminal = $id_type_terminal;
                $this->id_emplacement_terminal = $id_emplacement_terminal;
                $this->categorie_playlist = $categorie_playlist;
            }
        }

        private function fetchTerminalById($id) {
            $dbo = connexion();
            $req = $dbo -> execSQL("SELECT * FROM Terminal WHERE id_terminal =" . $id);
            unset($dbo);
            foreach($req as $lesrequeteTab) {
                $this->id_terminal = $lesrequeteTab["id_terminal"];
                $this->nom_terminal = $lesrequeteTab["nom_terminal"];
                $this->adresse_mac = $lesrequeteTab["adresse_mac"];
                $this->id_type_terminal = $lesrequeteTab["id_type_terminal"];
                $this->id_emplacement_terminal = $lesrequeteTab["id_emplacement_terminal"];
                $this->categorie_playlist = $lesrequeteTab["categorie_playlist"];
            }
        }

        public function getId_Terminal() {
            return $this->id_terminal;
        }
        public function getNomTerminal() {
            return $this->nom_terminal;
        }
        public function getAdresseMac() {
            return $this->adresse_mac;
        }
        public function getId_TypeTerminal() {
            return $this->id_type_terminal;
        }
        public function getId_EmplacementTerminal() {
            return $this->id_emplacement_terminal;
        }
        public function getCategoriePlaylist() {
            return $this->categorie_playlist;
        }

        public function setId_Terminal($id_terminal) {
            $this->id_terminal = $id_terminal;
        }
        public function setNomTerminal($nom_terminal) {
            $this->nom_terminal = $nom_terminal;
        }
        public function setAdresseMac($adresse_mac) {
            $this->adresse_mac = $adresse_mac;
        }
        public function setId_TypeTerminal($id_type_terminal) {
            $this->id_type_terminal = $id_type_terminal;
        }
        public function setId_EmplacementTerminal($id_emplacement_terminal) {
            $this->id_emplacement_terminal = $id_emplacement_terminal;
        }
        public function setCategoriePlaylist($categorie_playlist) {
            $this->categorie_playlist = $categorie_playlist;
        }
    }
?>