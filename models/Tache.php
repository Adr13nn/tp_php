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
        $taches = json_decode($contenu);
        //var_dump($livres);
   
        $taches = (is_array($taches))? $taches : [];
    
        $tache = get_object_vars($this);

        array_push($taches, $tache);
        $handle = fopen("datas/taches.json", "w");
        $json = json_encode($taches);
        fwrite($handle, $json);
        fclose($handle);   
    }

    static function getTaches(): array {

        //echo "Je récupère le contenu de mon fichier livres.json :<br>";
        $contenu = (file_exists("datas/taches.json"))? file_get_contents("datas/taches.json") : "";
        //var_dump($contenu);

        //echo "Je décode mon JSON en structure PHP (tableau associatif) :<br>";
        $taches = json_decode($contenu);
        //var_dump($livres);

        $taches = (is_array($taches))? $taches : [];

        return $taches;
    }

}

?>


