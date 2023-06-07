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

        public function verificationLoginPassword(string $login, string $password): bool {
            $dbo = connexion();
            $requete = $dbo->execSQL("SELECT * FROM Utilisateur WHERE login_utilisateur = \"$login\" AND pwd_utilisateur = AES_ENCRYPT(\"$password\", \"YepaGaming\")");
            unset($dbo);
            if (count($requete) != 0) {
                return true;
            }
            else {
                return false;
            }
        }

        public function verifieurExistenceCategorie(int $categorie): bool {
            $dbo = connexion();
            $requete = $dbo->execSQL("SELECT id_categorie_utilisateur FROM Utilisateur WHERE id_categorie_utilisateur = $categorie ");
            unset($dbo);
            if (count($requete) != 0) {
                return true;
            }
            else {
                return false;
            }
        }

        public function verifieurDoublonPseudo(String $login): bool {
            $dbo = connexion();
            $requete = $dbo->execSQL("SELECT login_utilisateur FROM Utilisateur WHERE login_utilisateur = \"$login\"");
            unset($dbo);
            if (count($requete) === 0) {
                return true;
            }
            else {
                return false;
            }
        }

        public function insertUtilisateur(string $login, string $pwd, int $idCategorie) {
            $dbo = connexion();
            $dbo -> execSQL("INSERT INTO Utilisateur(login_utilisateur, pwd_utilisateur, id_categorie_utilisateur) VALUES (\"$login\", AES_ENCRYPT(\"$pwd\", \"YepaGaming\"), $idCategorie)");
            unset($dbo);
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