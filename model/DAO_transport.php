<?php

class TransportDAO {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getByEleveId(int $eleveId): array {
        $stmt = $this->db->prepare("SELECT * FROM transports WHERE eleve_id = ?");
        $stmt->execute([$eleveId]);
        $rows = $stmt->fetchAll();
        return array_map([$this, 'mapRowToTransport'], $rows);
    }

    public function insert(TransportDTO $transport): int {
        $stmt = $this->db->prepare(
            "INSERT INTO transports (eleve_id, mode_transport, points_attribues, date_utilisation) 
             VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([
            $transport->eleveId,
            $transport->modeTransport,
            $transport->pointsAttribues,
            $transport->dateUtilisation,
        ]);
        return $this->db->lastInsertId();
    }

    private function mapRowToTransport(array $row): TransportDTO {
        $transport = new TransportDTO();
        $transport->id = $row['id'];
        $transport->eleveId = $row['eleve_id'];
        $transport->modeTransport = $row['mode_transport'];
        $transport->pointsAttribues = $row['points_attribues'];
        $transport->dateUtilisation = $row['date_utilisation'];
        return $transport;
    }
}
