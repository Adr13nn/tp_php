<?php


class Tache {

    private $id_tache;
    private $description;
    private $date_limite;
    private $id_utilisateur;

    function __construct(string $id_tache, string $date_limite) {
        $this->id_tache = $id_tache;
        $this->date_limite = $date_limite;  
    }


    function save_tache() {

        //echo "Je récupère le contenu de mon fichier livres.json :<br>";
        $contenu = (file_exists("datas/taches.json"))? file_get_contents("datas/taches.json") : "";
        //var_dump($contenu);

        //echo "Je décode mon JSON en structure PHP (tableau associatif) :<br>";
        $users = json_decode($contenu);
        //var_dump($livres);
   
        $users = (is_array($users))? $users : [];
    
        $user = get_object_vars($this);

        array_push($users, $user);
        $handle = fopen("datas/taches.json", "w");
        $json = json_encode($users);
        fwrite($handle, $json);
        fclose($handle);   
    }

}


