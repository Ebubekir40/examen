<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'producten.php';


if ($_FILES['afbeelding']['error'] == 4) {
    $afbeelding = null;
} elseif ($_FILES['afbeelding']['error'] !== UPLOAD_ERR_OK) {
    echo "Er is een fout opgetreden bij het uploaden van de afbeelding: " . $_FILES['afbeelding']['error'];
    exit();
} else {
    $uploadDirectory = 'uploads/';
    $uploadedFile = $uploadDirectory . basename($_FILES['afbeelding']['name']);

    if (move_uploaded_file($_FILES['afbeelding']['tmp_name'], $uploadedFile)) {
        $afbeelding = $uploadedFile;
    } else {
        echo "Er is een fout opgetreden bij het uploaden van de afbeelding.";
        exit();
    }
}

// Controleert of 'aantal' een numerieke waarde is
$aantal = $_POST['aantal'];
if (!is_numeric($aantal)) {
    die("Aantal moet een numerieke waarde zijn.");
}

$productnaam = $_POST['productnaam'];
$stellingsnummer = $_POST['stellingsnummer'];

$producten = new Producten();
$productinfo = $producten->maakProduct($productnaam, $afbeelding, $aantal, $stellingsnummer);

$message = "Product succesvol toegevoegd. Product ID: {$productinfo['productid']}";
$_SESSION['success_message'] = $message;

header("Location: alleproducten.php");
exit();
?>
