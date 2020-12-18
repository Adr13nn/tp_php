<?php


class Tache {

    private $id_tache;
    private $description;
    private $date_limite;
    private $id_utilisateur;

    function __construct(string $description, string $date_limite,  int $id_utilisateur, $id_tache = 0) {
        $this->id_tache = $id_tache;
        $this->description = $description;
        $this->date_limite = $date_limite; 
        $this->id_utilisateur = $id_utilisateur; 
    }

    public function getId_tache(): int {
        return $this->id_tache;
    }

    public function setId_tache(int $id_tache) {
        $this->id_tache = $id_tache;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description) {
        $this->description = $description;
    }

    public function getDate_limite(): string {
        return $this->date_limite;
    }

    public function setDate_limite(string $date_limite) {
        $this->date_limite = $date_limite;
    }

    public function getId_utilisateur(): int {
        return $this->id_utilisateur;
    }

    public function setId_utilisateur(int $id_utilisateur) {
        $this->id_utilisateur = $id_utilisateur;
    }



    function save_tache(): bool {

        //echo "Je récupère le contenu de mon fichier livres.json :<br>";
        $contenu = (file_exists("datas/taches.json"))? file_get_contents("datas/taches.json") : "";
        //var_dump($contenu);
        //echo "Je décode mon JSON en structure PHP (tableau associatif) :<br>";
        $taches = json_decode($contenu);
        //var_dump($livres);
        $taches = (is_array($taches))? $taches : [];
        // Variable de vérification du bon résultat de l'appel à la méthode (utilisateur enregistré)


        // Je parcours mon tableau (ma liste d'utilisateurs) :
        
        $lastkey = (array_key_last($taches) != null)? array_key_last($taches) : 0;
        $this->id_tache = (!empty($taches))? $taches[$lastkey]->id_taches + 1 : 1;

        array_push($taches, get_object_vars($this));

        $handle = fopen("datas/taches.json", "w");
        $verif = (fwrite($handle, json_encode($taches)))? true : false;
        fclose($handle);
        
        
        return $verif;

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


