<?php

require_once '../config/db.php';
require_once '../classes/interfaces/CrudInterface.php';

class Korisnik implements CrudInterface{
    private $conn;
    
    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function create($data) {
        $hashLozinka = password_hash($data['password'], PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare("INSERT INTO korisnik (ime, prezime, username, email, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $data['ime'], $data['prezime'], $data['username'], $data['email'], $hashLozinka);
        
        return $stmt->execute();
    }

    public function read($id) {
        $stmt = $this->conn->prepare("SELECT * FROM korisnik WHERE korisnik_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $rezultat = $stmt->get_result();
        return $rezultat->fetch_assoc();
    }

    public function update($id, $data) {
        $stmt = $this->conn->prepare("UPDATE korisnik SET ime = ?, prezime = ?, username = ?, email = ? WHERE korisnik_id = ?");
        $stmt->bind_param("ssssi", $data['ime'], $data['prezime'], $data['username'], $data['email'], $id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM korisnik WHERE korisnik_id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function registruj($ime, $prezime, $username, $email, $password) {
        $data = [
        'ime' => $ime,
        'prezime' => $prezime,
        'username' => $username,
        'email' => $email,
        'password' => $password
    ];

    return $this->create($data);
    }

    public function prijavi($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM korisnik WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $rezultat = $stmt->get_result();

       if ($rezultat->num_rows === 1){
        $korisnik = $rezultat->fetch_assoc();
                if (password_verify($password, $korisnik['password'])){
                    return $korisnik;
                }
            }
            return false;
        }
    }
?>