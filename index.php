<?php
    header('Access-Control-Allow-Origin: *');
    //header('Content-Type: application/json');
    require_once("PHP/DAO/UtilisateursDAO.php");
    $DAO = new LesUtilisateurs();

    if (isset($_GET["op"]) && $_GET["op"] === "ajout") {
        $identifiants['login'] = (isset($_POST['login'])?$_POST['login']:"");
        $identifiants['idCategorie'] = (isset($_POST['idCategorie'])?$_POST['idCategorie']:"");
        $identifiants['mdp'] = (isset($_POST['mdp'])?$_POST['mdp']:"");
        $errors = array();
        if($identifiants['login'] === "" || $identifiants['mdp'] === "" || $identifiants['idCategorie'] === "") {
            $errors["error101"] = "Un des champs de saisi est vide";
        }
        if(!is_numeric($identifiants['idCategorie'])) {
            $errors["error202"] = "La catégorie doit être un nombre";
        }
        if(!$DAO->fetchIdCategorieByIdCategorie((int)$identifiants['idCategorie'])) {
            $errors["error303"] = "Le numéro de catégorie n'existe pas";
        }

        if(count($errors) != 0) {
            echo json_encode($errors);
        }
        else {
            $DAO->insertUtilisateur($identifiants['login'], $identifiants['mdp'], (int)$identifiants['idCategorie']);
            echo json_encode("success");
        }
    }

    else if (isset($_GET["op"]) && $_GET["op"] === "connexion") {
        $identifiants['login'] = (isset($_POST['login'])?$_POST['login']:"");
        $identifiants['mdp'] = (isset($_POST['mdp'])?$_POST['mdp']:"");
        $bool = $DAO->fetchUtilisateurByLoginAndPassword($identifiants["login"], $identifiants["mdp"]);
        echo json_encode($bool);
    }

    else {
        $DAO->fetchAll();
    
        $json_data = json_encode($DAO);
    
        echo $json_data;
    }
?>