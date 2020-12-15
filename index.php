<?php

session_start();

$route = (isset($_GET["route"]))? $_GET["route"] : "accueil";

switch($route) {

    case "accueil" : $toTemplate = showHome();
    break;
    case "register" : $toTemplate = showRegister();
    break;
    case 'login' : $toTemplate = showLogin();
    break;
    // case "formlivre" : $toTemplate = showFormLivre();
    // break;
    case "newUser" : insert_user();
    break;
    case 'connectionUser' : $toTemplate = connect_user();
    break;
    case "monEspace" : $toTemplate = showMonespace();
    break;
    case "showListe" : $toTemplate = showListe();
    break;
    case "insertTache" : insert_tache();
    break;
    case "listeTache" : $toTemplate = showListetache();
    break;
    default : $toTemplate = ["template" => "404.html"];

}

function showHome(): array {

    // $ressource = fopen("compteur.txt", "r");
    // $compteur = fgets($ressource);
    // fclose($ressource);
    // $compteur++;
    
    // echo $compteur;
    
    // $ressource = fopen("compteur.txt", "w");
    // fwrite($ressource, $compteur);
    // fclose($ressource);

    return ["template" => "accueil.html"];
}


function showRegister(): array {

    return ["template" => "register.html"];
}

function showLogin(): array {

    return ["template" => "accueil.html"];
}

// function showFormLivre(): array {

//     require_once "models/Livre.php";

//     $livres = Livre::getLivres();

//     return ["template" => "formulaire.php", "datas" => $livres];
// }

function showListe(): array {

    require_once "models/Tache.php";

    $taches = Tache::getTaches();

    return ["template" => "monEspace.php", "datas" => $taches];
}

// function showListetache() {
//     return ["template" => "listeTache.html"];
// }

function insert_user() {

    require_once "models/Utilisateur.php";

    $user = new Utilisateur($_POST["pseudo"], $_POST["email"], $_POST["password"]);
    var_dump($user);

    // $user->addId();

    var_dump($user);


    $user->save_user();
    $user ->showListe();

    header("Location:index.php?route=accueil");
    exit;
}

function insert_tache() {

    require_once "models/Tache.php";

    $user = new Tache($_POST["choixTache"], $_POST["choixDate"]);
    // var_dump($user);

        

    $user->save_tache();

    // $user->addId();

    // var_dump($user);


    // $user->save_user();

    header("Location:index.php?route=showListe");
    exit;
}


function showMonespace(): array {
    

    return ["template" => "monEspace.php"];

}

function connect_user() {
    require_once "models/Utilisateur.php";

    $user = new Utilisateur($_POST["pseudo"], $_POST["email"], $_POST["password"]);
    // var_dump($user);
    $user->verify_user();


    // if() {
    //     header("Location:index.php?route=monEspace");
    //     exit;
    // } else {
    //     header("Location:index.php?route=accueil");
    //     exit;
    // }
    
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

    <!-- <nav>
        <ul>
            <li><a href="index.php?route=accueil">Accueil</a></li>
            <li><a href="index.php?route=autrepage">Autre page</a></li>
            <li><a href="index.php?route=formlivre">Formulaire d'ajout d'un livre</a></li>
        </ul>
    </nav> -->
    
    <?php require "templates/" . $toTemplate['template']; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>
</html>
