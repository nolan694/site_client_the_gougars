<?php
class ClasseDAO {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getById(int $id): ?ClasseDTO {
        $stmt = $this->db->prepare("SELECT * FROM classes WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ? $this->mapRowToClasse($row) : null;
    }

    public function getAll(): array {
        $stmt = $this->db->query("SELECT * FROM classes");
        $rows = $stmt->fetchAll();
        return array_map([$this, 'mapRowToClasse'], $rows);
    }

    private function mapRowToClasse(array $row): ClasseDTO {
        $classe = new ClasseDTO();
        $classe->id = $row['id'];
        $classe->nomClasse = $row['nom_classe'];
        return $classe;
    }
}
