<?php

require_once '../config/db.php';
require_once '../classes/interfaces/CrudInterface.php';

class Zdravlje implements CrudInterface{
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create($data) {
        $query = "INSERT INTO zdravlje (basta_id, datum, simptomi, dijagnoza, akcije)
                  VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("issss", $data['basta_id'], $data['datum'], $data['simptomi'], $data['dijagnoza'], $data['akcije']);

        return $stmt->execute();
    }

    public function read($id) {
    }

    public function update($id, $data) {
    }

    public function delete($id) {
    }

    public function zdravljaPoKorisniku($korisnik_id) {
        $query = "
        SELECT
        zdravlje.datum, 
        zdravlje.simptomi,
        zdravlje.dijagnoza,
        zdravlje.akcije,
        zdravlje.zdravlje_id, 
        basta.nadimak, 
        biljke.naziv
        FROM zdravlje
        INNER JOIN basta ON zdravlje.basta_id = basta.basta_id
        INNER JOIN biljke ON basta.biljka_id = biljke.biljka_id
        WHERE basta.korisnik_id = ?
        ORDER BY zdravlje.datum DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $korisnik_id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}