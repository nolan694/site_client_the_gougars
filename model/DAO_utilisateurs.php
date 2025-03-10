<?php
class UtilisateurDAO {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getById(int $id): ?DTO_utilisateur {
        $stmt = $this->db->prepare("SELECT * FROM utilisateurs WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ? $this->mapRowToUtilisateur($row) : null;
    }

    public function getAll(): array {
        $stmt = $this->db->query("SELECT * FROM utilisateurs");
        $rows = $stmt->fetchAll();
        return array_map([$this, 'mapRowToUtilisateur'], $rows);
    }

    public function insert(UtilisateurDTO $utilisateur): int {
        $stmt = $this->db->prepare(
        "INSERT INTO utilisateurs (nom, prenom, mot_de_passe, role) VALUES (?, ?, ?, ?)"
    );
        $stmt->execute([
        $utilisateur->nom,
        $utilisateur->prenom,
        $utilisateur->motDePasse,
        $utilisateur->role,
    ]);
    return $this->db->lastInsertId();
}

private function mapRowToUtilisateur(array $row): UtilisateurDTO {
$utilisateur = new UtilisateurDTO();
$utilisateur->id = $row['id'];
$utilisateur->nom = $row['nom'];
$utilisateur->prenom = $row['prenom'];
$utilisateur->motDePasse = $row['mot_de_passe'];
$utilisateur->role = $row['role'];
$utilisateur->dateInscription = $row['date_inscription'];
return $utilisateur;
}
}
