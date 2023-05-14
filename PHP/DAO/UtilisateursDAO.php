<?php
    require_once("./PHP/Classe/Utilisateur.php");
    class LesUtilisateurs implements JsonSerializable {
        private array $UtilisateursTab;

        public function getArrayTab() {
            return $this->UtilisateursTab;
        }

        public function setArrayTab($arrayTab) {
            $this->UtilisateursTab = $arrayTab;
        }

        public function fetchAll() {
            $dbo = connexion();
            $req = $dbo -> execSQL("SELECT * FROM Utilisateur");
            unset($dbo);
            $Utilisateur = [];
            foreach($req as $lesRequettes) {
                $Utilisateur[] = new Utilisateur(
                    $lesRequettes["id_utilisateur"],
                    $lesRequettes["login_utilisateur"],
                    $lesRequettes["id_categorie_utilisateur"]
                );
            }
            $this->setArrayTab($Utilisateur);
        }

        
        /*public function fetchUtilisateurById($id) {
            $dbo = connexion();
            $req = $dbo -> execSQL("SELECT * FROM Utilisateur WHERE id_utilisateur =" . $id);
            unset($dbo);
            foreach($req as $lesrequeteTab) {
                $this->id_utilisateur = $lesrequeteTab["id_utilisateur"];
                $this->login_utilisateur = $lesrequeteTab["login_utilisateur"];
                $this->id_categorie_utilisateur = new CategorieUtilisateur($lesrequeteTab["id_categorie_utilisateur"]);
            }
        }*/

        public function jsonSerialize():mixed {
            return $this->UtilisateursTab;
        }
    }
?>