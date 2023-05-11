<?php
    require_once("functionConnexion/ConnexionDocker.php");
    include("./Playlist.php");
    require("./Playlist.php");
    require("./Utilisateur.php");
    require("./CategorieUtilisateur.php");
    
    class AuditTrail {
        private int $id_audit_trail;
        private Playlist $id_playlist;
        private DateTime $creation_date_playlist;
        private Utilisateur $id_utilisateur;
        private CategorieUtilisateur $id_categorie_utilisateur;

        public function __construct($id_audit_trail = 0, $id_playlist = 0, $creation_date_playlist = "", $id_utilisateur = 0, $id_categorie_utilisateur = 0) {
            if($id_audit_trail!=0) {
                $this->fetchAuditTrailById($id_audit_trail);
            }
            else {
                $this->id_audit_trail = $id_audit_trail;
                $this->id_playlist = $id_playlist;
                $this->creation_date_playlist = $creation_date_playlist;
                $this->id_utilisateur = $id_utilisateur;
                $this->id_categorie_utilisateur = $id_categorie_utilisateur;
            }
        }

        private function fetchAuditTrailById($id) {
            $dbo = connexion();
            $req = $dbo -> execSQL("SELECT * FROM AuditTrail WHERE id_audit_trail =" . $id);
            unset($dbo);
            foreach($req as $lesrequeteTab) {
                $this->id_audit_trail = $lesrequeteTab["id_audit_trail"];
                $this->id_playlist = $lesrequeteTab["id_playlist"];
                $this->creation_date_playlist = $lesrequeteTab["creation_date_playlist"];
                $this->id_utilisateur = $lesrequeteTab["id_utilisateur"];
                $this->id_categorie_utilisateur = $lesrequeteTab["id_categorie_utilisateur"];
            }
        }

        public function getId_AuditTrail() {
            return $this->id_audit_trail;
        }

        public function setId_AuditTrail($id_audit_trail) {
            $this->id_audit_trail = $id_audit_trail;
        }

        public function getPlaylist() {
            return $this->id_playlist;
        }

        public function setPlaylist($id_playlist) {
            $this->id_playlist = $id_playlist;
        }

        public function getCreationDatePlaylist() {
            return $this->creation_date_playlist;
        }

        public function setCreationDatePlaylist($creation_date_playlist) {
            $this->creation_date_playlist = $creation_date_playlist;
        }

        public function getId_Utilisateur() {
            return $this->id_utilisateur;
        }

        public function setId_Utilisateur($id_utilisateur) {
            $this->id_utilisateur = $id_utilisateur;
        }

        public function getId_CategorieUtilisateur() {
            return $this->id_categorie_utilisateur;
        }

        public function setId_CategorieUtilisateur($id_categorie_utilisateur) {
            $this->id_categorie_utilisateur = $id_categorie_utilisateur;
        }
    }
?>