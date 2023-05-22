<?php
    header('Access-Control-Allow-Origin: *');
    require_once("./DAO/UtilisateursDAO.php");
    $DAO = new LesUtilisateurs();

    if (isset($_GET["op"]) && $_GET["op"] === "connexion") {
        $identifiants['login'] = (isset($_POST['login'])?$_POST['login']:"");
        $identifiants['mdp'] = (isset($_POST['mdp'])?$_POST['mdp']:"");
        $bool = $DAO->fetchUtilisateurByLoginAndPassword($identifiants["login"], $identifiants["mdp"]);
        echo json_encode($bool);
    }
?>