<?php
    require_once("./functionConnexion/ConnexionDocker.php");
    require("./Playlist.php");
    require("./Terminal.php");

    class PlaylistTerminaux {
        private $id_playlist_terminaux;
        private Playlist $id_playlist;
        private Terminal $id_terminal;
        private int $nbr_de_fois_jouee_playlist;


        // Peut être revoir le constructeur, et la fonction fetchPlaylistTerminauxById
        public function __construct($id_playlist_terminaux = array_map($id_playlist, $id_terminal), $id_playlist, $id_terminal, $nbr_de_fois_jouee_playlist = 0) {
            if($id_playlist!=0 && $id_terminal!=0){
                $this->fetchPlaylistTerminauxById($id_playlist_terminaux);
            }
            else {
                $this->id_playlist_terminaux = $id_playlist_terminaux;
                $this->id_playlist = $id_playlist;
                $this->id_terminal = $id_terminal;
                $this->nbr_de_fois_jouee_playlist = $nbr_de_fois_jouee_playlist;
            }
        }

        private function fetchPlaylistTerminauxById($id) {
            $dbo = connexion();
            $req = $dbo -> execSQL("SELECT * FROM PlaylistTerminaux WHERE id_playlist_terminaux =" . $id);
            unset($dbo);
            foreach($req as $lesrequeteTab) {
                $this->id_playlist_terminaux = $lesrequeteTab["id_playlist_pubs"];
                $this->id_playlist = $lesrequeteTab["id_pubs"];
                $this->id_terminal = $lesrequeteTab["id_playlist"];
                $this->nbr_de_fois_jouee_playlist = $lesrequeteTab["nbr_de_fois_jouee_playlist"];
            }
        }

        public function getId_PlaylistTerminaux() {
            return $this->id_playlist_terminaux;
        }
        public function getId_Playlist() {
            return $this->id_playlist;
        }
        public function getId_Terminal() {
            return $this->id_terminal;
        }
        public function getNbrDeFoisJoueePlaylist() {
            return $this->nbr_de_fois_jouee_playlist;
        }

        public function setId_PlaylistTerminaux($id_playlist_terminaux) {
            $this->id_playlist_terminaux = $id_playlist_terminaux;
        }
        public function setId_Playlist($id_playlist) {
            $this->id_playlist = $id_playlist;
        }
        public function setId_Terminal($id_terminal) {
            $this->id_terminal = $id_terminal;
        }
        public function setNbrDeFoisJoueePlaylist($nbr_de_fois_jouee_playlist) {
            $this->nbr_de_fois_jouee_playlist = $nbr_de_fois_jouee_playlist;
        }
    }
?>