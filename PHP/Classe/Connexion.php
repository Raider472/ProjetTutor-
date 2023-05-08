<?php
    class Connexion {
        private PDO $db;
        function __construct(string $SGBD, string $Host, string $dbName, string $UserPassword = "root") {
            $db_config["SGBD"] = $SGBD;
            $db_config["HOST"] = $Host;
            $db_config["DB_NAME"] = $dbName;
            $db_config["USER"] = $UserPassword;
            $db_config["PASSWORD"] = $UserPassword;
            $this->db = new PDO($db_config["SGBD"] . ":host=" . $db_config["HOST"] . ";dbname=" . $db_config["DB_NAME"], $db_config["USER"], $db_config["PASSWORD"], array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            unset($db_config);
        }
        function execSQL(string $req, array $valeur=[]) : array {
            try {
                $resultat = $this->db->prepare($req);
                $resultat->execute($valeur);
                return $resultat->fetchAll(PDO::FETCH_ASSOC);
            }
            catch (PDOException $e) {
                echo $e->getMessage();
                $resultat = [];
            }
            return $resultat;
        }
    }
?>