<?php


class Utilisateur {

    private $pseudo;
    private $password;
    private $email;
    private $id_utilisateur;
    

    function __construct( $pseudo, $password,$email=null) {
        $this->pseudo = $pseudo;
        $this->password = $password;
        $this->email = $email;
        
    }

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
        // var_dump($users);
        $user = get_object_vars($this);
        // var_dump($user);

        array_push($users, $user);
        $handle = fopen("datas/users.json", "w");
        $json = json_encode($users);
        fwrite($handle, $json);
        fclose($handle);   
    }

    function verify_user() {
        $connect = false;
        $contenu = (file_exists("datas/users.json"))? file_get_contents("datas/users.json") : "";
        $taches = json_decode($contenu);
        $taches = (is_array($taches))? $taches : [];


        foreach($taches as $value) {
            if($value->pseudo == $this->pseudo && $value->password == $this->password) {
                $connect = true;
            }
        }
        return $connect;
    }
}
