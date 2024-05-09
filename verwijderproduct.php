<?php
require_once 'producten.php';
require_once 'hoofd1.php';

if (!isset($_SESSION['beheerderid'])) {
    header("Location: beheerderlogin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['productid'])) {
        $productid = $_GET['productid'];


        $producten = new Producten();
        $producten->verwijderProduct($productid);

        header("Location: alleproducten.php");
        exit();
    }
}
?>

