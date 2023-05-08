<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>ZA WARUDO !</h1>
    <?php
        require_once("./PHP/Classe/Utilisateur.php");
        $test = new Utilisateur(10,"edsdsq", 1);
        echo $test->getId_categorie()->getNom_categorie();
    ?>
</body>
</html>