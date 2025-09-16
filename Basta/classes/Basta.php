<?php

require_once '../config/db.php';
require_once '../classes/interfaces/CrudInterface.php';

class Basta implements CrudInterface{
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create($data) {
        $stmt = $this->conn->prepare("INSERT INTO basta (korisnik_id, biljka_id, datum_dodavanja, nadimak, lokacija)
                                      VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("iisss", 
            $data['korisnik_id'], 
            $data['biljka_id'], 
            $data['datum_dodavanja'], 
            $data['nadimak'], 
            $data['lokacija']
        );

        return $stmt->execute();
    }

    public function read($id) {
        $stmt = $this->conn->prepare("SELECT * FROM biljke WHERE biljka_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $rezultat = $stmt->get_result();
        return $rezultat->fetch_assoc();
    }

    public function update($id, $data) {
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM basta WHERE basta_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    public function uBasti($id){
        $stmt = $this->conn->prepare("
        SELECT biljke.biljka_id, biljke.naziv
        FROM basta
        JOIN biljke ON basta.biljka_id = biljke.biljka_id
        WHERE basta.korisnik_id = ?
    ");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $rezultat = $stmt->get_result();
        return $rezultat->fetch_all(MYSQLI_ASSOC);
    }

    public function ukloniBiljku($biljkaId, $korisnikId){
        $stmt = $this->conn->prepare("SELECT basta_id FROM basta WHERE biljka_id = ? AND korisnik_id = ?");
        $stmt->bind_param("ii", $biljkaId, $korisnikId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $bastaId = $row['basta_id'];

            $this->delete($bastaId);
            return true;
        }
        return false;
    }

    public function sveBiljkeKorisnika($korisnik_id) {
        $query = "
        SELECT 
        biljke.naziv,
        biljke.latinski_naziv,
        biljke.tip,
        biljke.slika,
        biljke.osvetljenje,
        biljke.zalivanje_dani,
        biljke.kolicina_vode,
        biljke.djubrenje_dani,
        biljke.tip_djubriva,
        basta.nadimak,
        basta.basta_id,
        basta.lokacija,
        basta.datum_dodavanja
        FROM basta
        INNER JOIN biljke ON basta.biljka_id = biljke.biljka_id
        WHERE basta.korisnik_id = ?
        ORDER BY basta.datum_dodavanja DESC
        ";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $korisnik_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}