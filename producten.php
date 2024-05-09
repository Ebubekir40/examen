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

    public function maakProduct($productnaam, $afbeelding, $aantal, $stellingsnummer)
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

    public function krijgGebruikteStellingen()
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

    public function krijgProducten()
    {

        $query = "SELECT * FROM producten";
        $result = $this->conn->query($query);

        $producten = array();


        if ($result && $result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                $producten[] = $row;
            }
        }

        return $producten;
    }

    public function zoekProductOpId($productid)
    {
        $query = "SELECT productid, productnaam, afbeelding, aantal, datum, stellingsnummer FROM producten WHERE productid = ?";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            die("Voorbereiden mislukt: (" . $this->conn->errno . ") " . $this->conn->error);
        }

        $stmt->bind_param("i", $productid);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function updateProduct($productid, $productnaam, $aantal, $stellingsnummer)
    {
        $query = "UPDATE producten SET productnaam = ?, aantal = ?, stellingsnummer = ?, datum = CURRENT_TIMESTAMP WHERE productid = ?";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            die("Voorbereiden mislukt: (" . $this->conn->errno . ") " . $this->conn->error);
        }

        $stmt->bind_param("sisi", $productnaam, $aantal, $stellingsnummer, $productid);

        if ($stmt->execute()) {
            return true;
        } else {
            die("Uitvoeren mislukt: (" . $stmt->errno . ") " . $stmt->error);
        }
    }

    public function verwijderProduct($productid)
    {
        $query = "DELETE FROM producten WHERE productid = ?";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            die("Voorbereiden mislukt: (" . $this->conn->errno . ") " . $this->conn->error);
        }

        $stmt->bind_param("i", $productid);

        if ($stmt->execute()) {
        } else {
            die("Uitvoeren mislukt: (" . $stmt->errno . ") " . $stmt->error);
        }
    }
}
