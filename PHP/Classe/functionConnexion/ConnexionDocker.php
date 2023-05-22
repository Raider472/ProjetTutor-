<?php
    require_once("./Classe/Connexion.php");
    //GestionPubs est le nom de ma bdd dans phpMyAdmin, si tu as mis un autre nom, change la variable.
    function connexion($SGBD = "mysql", $host = "db_api", $db_name = "GestionPubs"): Connexion {
        $dbo = new Connexion($SGBD, $host, $db_name);
        return $dbo;
    }
?>