<?php


class Utilisateur {

    private $pseudo;
    private $password;
    private $email;
    private $id_utilisateur;
    

    function __construct( string $pseudo, string $password, $email=null, $id_utilisateur=null) {
        $this->pseudo = $pseudo;
        $this->password = $password;
        $this->email = $email;
        $this->id_utilisateur = $id_utilisateur;
        
        
    }

    public function getPseudo(): int {
        return $this->pseudo;
    }

    public function setPseudo(int $pseudo) {
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

    static function getusers(): array {

       
        $contenu = (file_exists("datas/users.json"))? file_get_contents("datas/users.json") : "";
        
        $users = json_decode($contenu);
        

        $users = (is_array($users))? $users : [];

        return $users;
    }
}

?>
