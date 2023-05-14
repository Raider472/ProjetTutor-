<?php
    header('Content-Type: application/json');
    require_once("PHP/DAO/UtilisateursDAO.php");

    $DAO = new LesUtilisateurs();

    $DAO->fetchAll();

    $json_data = json_encode($DAO);

    echo $json_data;
?>