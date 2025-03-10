<?php

require_once('DTO_utilisateur.php');

class DAO_utilisateurs {
    private PDO $bdd;

    // initialisation de notre PDO (constructeur)
    public function __construct() {
        try {
            $this->bdd = new PDO('mysql:host=localhost;dbname=client_cougars',
            'root', '');
        } catch(Exception $e){
            die('ERROR : ' .$e->getMessage());        
    }

}
public function getAll() {
    $sql = 'SELECT * FROM user_gougars';
    $data = $this->bdd->query($sql);
    $user = [];
    while($row = $data->fetch()) {
        $a = new User;
        $a->id = $row['id'];
        $a->username = $row['username'];
        $a->password = $row['password'];
        $user[] = $a;
    }
    return $user;
}

public function connectUser($username, $password) {
   //implicite
    $sql = 'SELECT * FROM user_gougars WHERE username = ?' ;
    $req = $this->bdd->prepare($sql);
    $req->execute([$username]);


    if ($userData = $req->fetch()) {
        //echo $userData['password'];
        //echo $password ;
        if ($password == $userData['password']) {
            //echo "oui" ;
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['username'] = $userData['username'];
            return 'ok';
        } else {
            return 'Mot de passe incorrect';
        }
    } else {
        return "Utilisateur $username inconnu";
    }
}
}
