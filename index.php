<?php

session_start();

$route = (isset($_GET["route"]))? $_GET["route"] : "accueil";

switch($route) {

    case "accueil" : $toTemplate = showHome(); 
    break;
    case "register" : $toTemplate = showRegister();
    break;
    case 'connectionUser' : $toTemplate = connect_user();
    break;
    case "monEspace" : $toTemplate = showMonespace();
    break;
    case "showListe" : $toTemplate = showListe();
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


function showListe(): array {

    require_once "models/Tache.php";

    $taches = Tache::getTaches();

    return ["template" => "monespaceliste.php", "datas" => $taches];
}


function insert_user() {

    require_once "models/Utilisateur.php";

    $user = new Utilisateur($_SESSION["pseudo"] = $_POST["pseudo"], $_SESSION["password"] = $_POST["password"],$_SESSION["email"] = $_POST["email"]);
    // var_dump($user);
    
    $users = Utilisateur::getUsers();
    // var_dump($users);

    if($user->verify_user()){
        header("Location:index.php?route=register");
        exit;
    }else {
        $user->id_utilisateur = sizeof($users++); 
        $user->save_user();
        header("Location:index.php?route=accueil");
        exit;
    }
    
}

function insert_tache() {

    require_once "models/Tache.php";

    $tache = new Tache($_POST["choixTache"], $_POST["choixDate"]);
    // var_dump($user);

    $tache->save_tache();

    header("Location:index.php?route=showListe");
    exit;
    
}

function showMonespace(): array {
    
    return ["template" => "monEspace.php"];

}

function connect_user() {
    require_once "models/Utilisateur.php";

    $user = new Utilisateur( $_SESSION["pseudo"] = $_POST["pseudo"], $_SESSION["password"] = $_POST["password"]);
    
    if($user->verify_user()){
        return ["template" => "monEspace.php"];
    }else{
        echo "Le compte n'existe pas !";
        return ["template" => "accueil.php"];
    }  
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
