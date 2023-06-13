<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    require_once("PHP/DAO/UtilisateursDAO.php");
    require_once("PHP/DAO/PlaylistDAO.php");
    $UtilisateurDAO = new LesUtilisateurs();
    $PlaylistDAO = new LesPlaylists();

    $idPlaylist = ((int)isset($_POST["playlistSelect"]) ? (int)$_POST["playlistSelect"] : 1); 

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
        if(!$UtilisateurDAO->verifieurExistenceCategorie((int)$identifiants['idCategorie'])) {
            $errors["error303"] = "Le numéro de catégorie n'existe pas";
        }
        if(!$UtilisateurDAO->verifieurDoublonPseudo($identifiants['login'])) {
            $errors["error404"] = "l'utilisateur existe deja";
        }

        if(count($errors) != 0) {
            echo json_encode($errors);
        }
        else {
            $UtilisateurDAO->insertUtilisateur($identifiants['login'], $identifiants['mdp'], (int)$identifiants['idCategorie']);
            echo json_encode("success");
        }
    }

    else if (isset($_GET["op"]) && $_GET["op"] === "connexion") {
        $identifiants['login'] = (isset($_POST['login'])?$_POST['login']:"");
        $identifiants['mdp'] = (isset($_POST['mdp'])?$_POST['mdp']:"");
        $bool = $UtilisateurDAO->verificationLoginPassword($identifiants["login"], $identifiants["mdp"]);
        echo json_encode($bool);
    }

    else if (isset($_GET["op"]) && $_GET["op"] === "affichagePubs") {
        $PlaylistDAO->fetchPlaylistById($idPlaylist);
        echo json_encode($PlaylistDAO);
    }

    else if(isset($_POST["status"]) && $_SERVER["REQUEST_METHOD"] === "POST") {
        
        $dbo = connexion();
        $req = $dbo->execSQL("UPDATE Playlist SET playing = :status", ["status" => ($_POST["status"] ?? "false") === "true" ? 1 : 0]);
        $idPlaylist = (int)$_POST["playlistSelect"];
    }

    else {
        $UtilisateurDAO->fetchAll();
    
        $json_data = json_encode($UtilisateurDAO);
    
        echo $json_data;
    }
?>