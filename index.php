<?php

session_start();

$route = (isset($_GET["route"]))? $_GET["route"] : "accueil";

switch($route) {

    case "accueil" : $toTemplate = showHome(); 
    break;
    case "register" : $toTemplate = showRegister();
    break;
    case "monEspace" : $toTemplate = showMonespace();
    break;
    case "showListe" : $toTemplate = showListe();
    break;
    case 'connectionUser' : connect_user();
    break;
    case "newUser" : insert_user();
    break;
    case "insertTache" : insert_tache();
    break;
    default : $toTemplate = ["template" => "404.html"];

}

function showHome(): array {

    return ["template" => "accueil.php"];
}


function showRegister(): array {

    return ["template" => "register.php"];
}

function showMonespace(): array {
    
    return ["template" => "monEspace.php", "datas" => null];

}

function showListe(): array {

    require_once "models/Tache.php";

    $taches = Tache::getTaches();

    return ["template" => "monespaceliste.php", "datas" => $taches];
}

function insert_user() {

    if(!empty($_POST["pseudo"]) && !empty($_POST["password"]) && $_POST["password"] === $_POST["password2"]) {
        // Je peux procéder à la suite de l'ajout d'un utilisateur

        require_once "models/Utilisateur.php";

        $user = new Utilisateur($_POST["pseudo"], password_hash($_POST["password"], PASSWORD_DEFAULT), $_POST["email"]);

        $user->save_user();
        
        
        
    } else {
        $_SESSION["errors"]["connexion"] = "Erreur lors de l'enregistrement";
          
    }

    header("Location:index.php?route=accueil");
    exit;

    // Je redirige vers une fonction d'affichage
    //header("Location:index.php?route=accueil");

}

function insert_tache() {

    require_once "models/Tache.php";

    $tache = new Tache($_POST["choixTache"], $_POST["choixDate"], $_SESSION["user"]["user_id"]);
    // var_dump($user);

    $tache->save_tache();

    header("Location:index.php?route=showListe");
    exit;
    
}

function connect_user() {
    require_once "models/Utilisateur.php";

    if(!empty($_POST["pseudo"]) && !empty($_POST["password"])) {

        $user = new Utilisateur( $_POST["pseudo"], $_POST["password"]);
        // var_dump($user);

        if($user->verify_user()) {
            // L'utilisateur est "autorisé" à se connecter
            $_SESSION["user"]["user_id"] = $user->getId_utilisateur();
            $_SESSION["user"]["username"] = $user->getPseudo();

            header("Location:index.php?route=monEspace");
            exit;

        } else {
            // L'utilisateur n'est pas "autorisé" à se connecter
            $_SESSION["errors"]["connexion"] = "Vous avez entré un mauvais identifiant et/ou mot de passe";
            header("Location:index.php?route=register");
    exit;
        }

    }else {
       
        $_SESSION["errors"]["champs"] = "L'ensemble des champs est obligatoire.";
    }

    header("Location:index.php?route=accueil");
    exit;

}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

    <?php require "templates/" . $toTemplate['template']; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>
</html>
