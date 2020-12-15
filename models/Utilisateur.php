<?php


class Utilisateur {

    private $pseudo;
    private $email;
    private $mdp;
    private $id_utilisateur;
    

    function __construct( $pseudo, $email, $mdp) {
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->mdp = $mdp;
        
    }

    // function caracteristiques() {
    //     $this->pseudo = $pseudo;
    //     $this->email = $email;
    //     $this->mdp = $mdp;
    //     $this->id_utilisateur = $id_utilisateur++; 
    // }

    function addId(){
        $this->id_utilisateur++;
    }

    function save_user() {

        //echo "Je récupère le contenu de mon fichier livres.json :<br>";
        $contenu = (file_exists("datas/users.json"))? file_get_contents("datas/users.json") : "";
        //var_dump($contenu);

        //echo "Je décode mon JSON en structure PHP (tableau associatif) :<br>";
        $users = json_decode($contenu);
        //var_dump($livres);
   
        $users = (is_array($users))? $users : [];
    
        $user = get_object_vars($this);

        array_push($users, $user);
        $handle = fopen("datas/users.json", "w");
        $json = json_encode($users);
        fwrite($handle, $json);
        fclose($handle);   
    }

    function verify_user() {
        $contenu = file_get_contents("datas/users.json");
        $users = json_decode($contenu);
        $user = get_object_vars($this);

        // var_dump($user);
        // var_dump($users);

        if($user["pseudo"] == $users["pseudo"] && $user["mdp"] == $users["mdp"]) {
            $this-> getUsers();
            
            $_SESSION["savedUser"] = $user;
            
        } else {
            array_push($users, $user);
            $handle = fopen("datas/users.json", "w");
            $json = json_encode($users);
            fwrite($handle, $json);
            fclose($handle);
        }
    }



    static function getUsers(): array {

        //echo "Je récupère le contenu de mon fichier livres.json :<br>";
        $contenu = (file_exists("datas/users.json"))? file_get_contents("datas/users.json") : "";
        //var_dump($contenu);

        //echo "Je décode mon JSON en structure PHP (tableau associatif) :<br>";
        $users = json_decode($contenu);
        //var_dump($livres);

        $users = (is_array($users))? $users : [];

        return $users;
    }
}