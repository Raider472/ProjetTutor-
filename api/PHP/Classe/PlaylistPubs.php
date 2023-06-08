<?php
    require_once("./functionConnexion/ConnexionDocker.php");
    require("./Pubs.php");
    require("./Playlist.php");

    class PlaylistPubs {
        private $id_playlist_pubs;
        private Pubs $id_pubs;
        private Playlist $id_playlist;


        // Peut être revoir le constructeur, et la fonction fetchPlaylistPubsById
        public function __construct($id_playlist_pubs = array_map($id_pubs, $id_playlist), $id_pubs, $id_playlist) {
            if($id_pubs!=0 && $id_playlist!=0){
                $this->fetchPlaylistPubsById($id_playlist_pubs);
            }
            else {
                $this->id_playlist_pubs = $id_playlist_pubs;
                $this->id_pubs = $id_pubs;
                $this->id_playlist = $id_playlist;
            }
        }

        private function fetchPlaylistPubsById($id) {
            $dbo = connexion();
            $req = $dbo -> execSQL("SELECT * FROM PlaylistPubs WHERE id_playlist_pubs =" . $id);
            unset($dbo);
            foreach($req as $lesrequeteTab) {
                $this->id_playlist_pubs = $lesrequeteTab["id_playlist_pubs"];
                $this->id_pubs = $lesrequeteTab["id_pubs"];
                $this->id_playlist = $lesrequeteTab["id_playlist"];
            }
        }

        public function getId_PlaylistPubs() {
            return $this->id_playlist_pubs;
        }
        public function getId_Pubs() {
            return $this->id_pubs;
        }
        public function getId_Playlist() {
            return $this->id_playlist;
        }

        public function setId_PlaylistPubs($id_playlist_pubs) {
            $this->id_playlist_pubs = $id_playlist_pubs;
        }
        public function setId_Pubs($id_pubs) {
            $this->id_pubs = $id_pubs;
        }
        public function setId_Playlist($id_playlist) {
            $this->id_playlist = $id_playlist;
        }
    }
?>