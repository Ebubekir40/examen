<?php

require_once 'db.php';

class Producten
{
    private $conn;

    public function __construct()
    {
        $dbConnection = new DBConnection();
        $this->conn = $dbConnection->getConnection();
    }

    public function createProduct($productnaam, $afbeelding, $aantal, $stellingsnummer)
    {

        $query = "INSERT INTO producten (productnaam, afbeelding, aantal, stellingsnummer) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            die("Voorbereiden mislukt: (" . $this->conn->errno . ") " . $this->conn->error);
        }

        $stmt->bind_param("ssis", $productnaam, $afbeelding, $aantal, $stellingsnummer);

        if ($stmt->execute()) {
            $productid = $stmt->insert_id;
            return ["productid" => $productid];
        } else {
            die("Uitvoeren mislukt: (" . $stmt->errno . ") " . $stmt->error);
        }
    }

    public function getGebruikteStellingen()
    {

        $query = "SELECT DISTINCT stellingsnummer FROM producten";
        $result = $this->conn->query($query);
        $gebruikteStellingen = array();

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $gebruikteStellingen[] = $row['stellingsnummer'];
            }
        }

        return $gebruikteStellingen;
    }
}