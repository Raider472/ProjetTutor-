<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    require_once("PHP/DAO/UtilisateursDAO.php");
    $DAO = new LesUtilisateurs();

    if (isset($_GET["op"]) && $_GET["op"] === "ajout") {
        $identifiants['login'] = (isset($_GET['login'])?$_GET['login']:"");
        $identifiants['idCategorie'] = (isset($_GET['idCategorie'])?$_GET['idCategorie']:"");
        $identifiants['mdp'] = (isset($_GET['mdp'])?$_GET['mdp']:"");
        $DAO->insertUtilisateur($identifiants['login'], $identifiants['mdp'], (int)$identifiants['idCategorie']);
    }

    else {
        $DAO->fetchAll();
    
        $json_data = json_encode($DAO);
    
        echo $json_data;
    }
?>