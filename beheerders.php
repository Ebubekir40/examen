<?php
require_once 'db.php';

class Beheerders
{
    private $conn;

    public function __construct()
    {
        $dbConnection = new DBConnection();
        $this->conn = $dbConnection->getConnection();
    }

    public function create($gebruikersnaam, $wachtwoord, $voornaam, $achternaam, $email)
    {
        $query = "INSERT INTO beheerders (gebruikersnaam, wachtwoord, voornaam, achternaam, email) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            die("Voorbereiden mislukt: (" . $this->conn->errno . ") " . $this->conn->error);
        }

        $hashedPassword = password_hash($wachtwoord, PASSWORD_DEFAULT);

        $stmt->bind_param("sssss", $gebruikersnaam, $hashedPassword, $voornaam, $achternaam, $email);

        if ($stmt->execute()) {
            return true;
        } else {
            die("Uitvoeren mislukt: (" . $stmt->errno . ") " . $stmt->error);
        }
    }