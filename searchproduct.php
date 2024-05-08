<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <style>


        form {
            margin-top: 20px;
        }

        button {
            background-color: black;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        button:hover {
            background-color: black;
        }

        .product-image {
            max-width: 200px;
            max-height: 200px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div id="content" class="content">
    <h1>Product Details</h1>

<?php
require_once 'hoofd1.php';
require_once 'producten.php';

session_start();
if (!isset($_SESSION['beheerderid'])) {
    header("Location: beheerderlogin.php");
    exit();
}

if (isset($_GET['productid'])) {
    $productid = $_GET['productid'];

    $producten = new Producten();
    $gevondenProduct = $producten->zoekProductOpId($productid);

    if ($gevondenProduct) {
        echo '<img class="product-image" src="' . $gevondenProduct['afbeelding'] . '" alt="Product Afbeelding"><br>';
        echo "Product ID: " . $gevondenProduct['productid'] . "<br>";
        echo "Productnaam: " . $gevondenProduct['productnaam'] . "<br>";
        echo "Aantal: " . $gevondenProduct['aantal'] . "<br>";
        echo "Datum: " . $gevondenProduct['datum'] . "<br>";
        echo "Stellingsnummer: " . $gevondenProduct['stellingsnummer'] . "<br>";

        echo '<form action="deleteproduct.php" method="GET">
                  <input type="hidden" name="productid" value="' . $gevondenProduct['productid'] . '">
                  <button type="submit">Verwijder Product</button>
              </form>';

        echo '<form action="updateproduct.php" method="GET">
                  <input type="hidden" name="productid" value="' . $gevondenProduct['productid'] . '">
                  <button type="submit">Aanpassen</button>
              </form>';
    } else {
        echo "Geen product gevonden met het opgegeven ID.";
    }
} else {
    echo "Geen product ID opgegeven.";
}
?><?php
