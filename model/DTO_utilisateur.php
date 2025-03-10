<?php

class DTO_utilisateur {
    public int $id;
    public string $nom;
    public string $prenom;
    public string $motDePasse;
    public string $role;
    public string $dateInscription;


    public function __construct() {
		$this->id = -1;
		$this->username = 'unset';
		$this->password = 'unset';
	}

    public function __get(string $attr): string
    {
        switch($attr)
        {
            case 'id':
                return $this->id;
            case 'username':
                return $this->username;
            case 'password':
                return $this->password;
            default:
                die('Error, no attribute named '.$attr);
        }
    }
    public function __set(string $attr, string $value): void
    {
        switch($attr)
        {
            case 'id':
                $this->id = $value;
                break;
            case 'username':
                $this->username = $value;
                break;
            case 'password':
                $this->password = $value;
                break;
            default:
                die('Error, no attribute named '.$attr);
        }
    }


    public function __toString(): string
    {
        return "Article :
            - ID : {$this->id}
            - user : {$this->username}
            - Date de publication: {$this->password}";
    }
}
