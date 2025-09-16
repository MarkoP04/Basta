<?php

require_once '../config/db.php';
require_once '../classes/interfaces/CrudInterface.php';

class Djubrenje implements CrudInterface{
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create($data) {
        $query = "INSERT INTO djubrenje (basta_id, datum, tip, kolicina)
                  VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("issi", $data['basta_id'], $data['datum'], $data['tip'], $data['kolicina']);

        return $stmt->execute();
    }

    public function read($id) {
    }

    public function update($id, $data) {
    }

    public function delete($id) {
    }

    public function djubrenjaPoKorisniku($korisnik_id) {
        $query = "
        SELECT
        djubrenje.datum, 
        djubrenje.kolicina,
        djubrenje.tip,
        djubrenje.djubrenje_id, 
        basta.nadimak, 
        biljke.naziv
        FROM djubrenje
        INNER JOIN basta ON djubrenje.basta_id = basta.basta_id
        INNER JOIN biljke ON basta.biljka_id = biljke.biljka_id
        WHERE basta.korisnik_id = ?
        ORDER BY djubrenje.datum DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $korisnik_id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}