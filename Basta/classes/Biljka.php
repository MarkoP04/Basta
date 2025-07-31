<?php

require_once '../config/db.php';
require_once '../classes/interfaces/CrudInterface.php';

class Biljka implements CrudInterface{
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function create($data) {
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
    }

    public function sveBiljke() {
        $query = "SELECT * FROM biljke";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function pretraziPoNazivu($naziv) {
        $stmt = $this->conn->prepare("SELECT * FROM biljke WHERE naziv LIKE ?");
        $search = "%{$naziv}%";
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $rezultat = $stmt->get_result();
        return $rezultat->fetch_all(MYSQLI_ASSOC);
    }
}
