<?php
class EleveDAO {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getById(int $id): ?EleveDTO {
        $stmt = $this->db->prepare("SELECT * FROM eleves WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ? $this->mapRowToEleve($row) : null;
    }

    public function getByClasseId(int $classeId): array {
        $stmt = $this->db->prepare("SELECT * FROM eleves WHERE classe_id = ?");
        $stmt->execute([$classeId]);
        $rows = $stmt->fetchAll();
        return array_map([$this, 'mapRowToEleve'], $rows);
    }

    private function mapRowToEleve(array $row): EleveDTO {
        $eleve = new EleveDTO();
        $eleve->id = $row['id'];
        $eleve->utilisateurId = $row['utilisateur_id'];
        $eleve->classeId = $row['classe_id'];
        $eleve->points = $row['points'];
        return $eleve;
    }
}
