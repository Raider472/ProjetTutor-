<?php
    require_once("./PHP/Classe/Playlist.php");
    class LesPlaylists implements JsonSerializable {
        private array $playlistTab;

        public function getArrayTab() {
            return $this->playlistTab;
        }

        public function setArrayTab($arrayTab) {
            $this->playlistTab = $arrayTab;
        }

        public function fetchPlaylistById(int $id) {
            $dbo = connexion();
            $req = $dbo -> execSQL("SELECT * FROM Playlist WHERE id_playlist = $id");
            unset($dbo);
            $playlist = [];
            foreach($req as $lesPlaylist) {
                $playlist[] = new Playlist(
                    $lesPlaylist["id_playlist"],
                    $lesPlaylist["nom_playlist"],
                    $lesPlaylist["debut_date_playlist"],
                    $lesPlaylist["fin_date_playlist"],
                    $lesPlaylist["categorie_playlist"]
                );
            }
            $this->setArrayTab($playlist);
        }

        public function jsonSerialize():mixed {
            return $this->playlistTab;
        }
    }
?>