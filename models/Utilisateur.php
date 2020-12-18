<?php


class Utilisateur {

    private $pseudo;
    private $password;
    private $email;
    private $id_utilisateur;
    

    function __construct( string $pseudo, string $password, string $email=null, int $id_utilisateur=0) {
        $this->pseudo = $pseudo;
        $this->password = $password;
        $this->email = $email;
        $this->id_utilisateur = $id_utilisateur;
        
        
    }

    public function getPseudo(): string {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo) {
        $this->pseudo = $pseudo;
    }

    public function getPassword(): string {
        return $this->username;
    }

    public function setPassword(string $password) {
        $this->password = $password;
    }
    
    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email) {
        $this->email = $email;
    }

    public function getId_utilisateur(): int {
        return $this->id_utilisateur;
    }

    public function setId_utilisateur(int $id_utilisateur) {
        $this->id_utilisateur = $id_utilisateur;
    }

    static function getUsers(): array {

       
        $contenu = (file_exists("datas/users.json"))? file_get_contents("datas/users.json") : "";
        
        $users = json_decode($contenu);
        

        $users = (is_array($users))? $users : [];

        return $users;
    }

    function save_user(): bool {

        //echo "Je récupère le contenu de mon fichier livres.json :<br>";
        $contenu = (file_exists("datas/users.json"))? file_get_contents("datas/users.json") : "";
        //var_dump($contenu);
        //echo "Je décode mon JSON en structure PHP (tableau associatif) :<br>";
        $users = json_decode($contenu);
        //var_dump($livres);
        $users = (is_array($users))? $users : [];
        // Variable de vérification du bon résultat de l'appel à la méthode (utilisateur enregistré)

        $verif = true;

        // Je parcours mon tableau (ma liste d'utilisateurs) :
        foreach($users as $user) {
            // Si l'on rencontre un utilisateur ayant le même pseudo, on ne permettra pas l'enregistrement de l'utilisateur courant
            if($user->pseudo == $this->pseudo) {
                $verif = false;
            }
        }

        if($verif) {
            $lastkey = (array_key_last($users) != null)? array_key_last($users) : 0;
            $this->id_utilisateur = (!empty($users))? $users[$lastkey]->id_utilisateur + 1 : 1;

            array_push($users, get_object_vars($this));

            $handle = fopen("datas/users.json", "w");
            $verif = (fwrite($handle, json_encode($users)))? true : false;
            fclose($handle);
        }
        
        return $verif;

    }

    function verify_user(): bool {
        
        $contenu = (file_exists("datas/users.json"))? file_get_contents("datas/users.json") : "";
        $users = json_decode($contenu);
        $users = (is_array($users))? $users : [];

        $verif = false;

        foreach($users as $user) {
            if($user->pseudo == $this->pseudo) {
                $verif = password_verify($this->password, $user->password);
            }
        }

        return $verif;

    }

}

?>
