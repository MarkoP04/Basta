<?php

require_once '../config/db.php';
require_once '../classes/interfaces/CrudInterface.php';

class Zalivanje implements CrudInterface{
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create($data) {
        $query = "INSERT INTO zalivanje (basta_id, datum, kolicina)
                  VALUES (?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isi", $data['basta_id'], $data['datum'], $data['kolicina']);

        return $stmt->execute();
    }

    public function read($id) {
    }

    public function update($id, $data) {
    }

    public function delete($id) {
    }

    public function zalivanjaPoKorisniku($korisnik_id) {
        $query = "
        SELECT
        zalivanje.datum, 
        zalivanje.kolicina,
        zalivanje.zalivanje_id, 
        basta.nadimak, 
        biljke.naziv
        FROM zalivanje
        INNER JOIN basta ON zalivanje.basta_id = basta.basta_id
        INNER JOIN biljke ON basta.biljka_id = biljke.biljka_id
        WHERE basta.korisnik_id = ?
        ORDER BY zalivanje.datum DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $korisnik_id);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}
