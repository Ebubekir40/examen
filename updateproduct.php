<?php
session_start();
if (!isset($_SESSION['beheerderid'])) {
    header("Location: beheerderlogin.php");
    exit();
}

require_once 'producten.php';
require_once 'hoofd1.php';

if (!isset($_GET['productid'])) {
    header("Location: searchproduct.php");
    exit();
}

$productid = $_GET['productid'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $aantal = $_POST['aantal'];
    $stellingsnummer = $_POST['stellingsnummer'];


    $producten = new Producten();
    $producten->updateProduct($productid, $aantal, $stellingsnummer);


    header("Location: productdetails.php?productid=$productid");
    exit();
}


$producten = new Producten();
$product = $producten->zoekProductOpId($productid);

if (!$product) {
    header("Location: searchproduct.php");
    exit();
}

$gebruikteStellingen = $producten->getGebruikteStellingen();

$alleStellingen = range(1, 100);
$beschikbareStellingen = array_diff($alleStellingen, $gebruikteStellingen);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map {
            height: 400px;
        }
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
    <h1>Update Product</h1>
    <?php
    echo '<img class="product-image" src="' . $product['afbeelding'] . '" alt="Product Afbeelding"><br>';
    echo "<form action='updateproduct.php?productid=$productid' method='post'>";
    echo "<label for='aantal'>Aantal:</label>";
    echo "<input type='number' id='aantal' name='aantal' value='{$product['aantal']}' required><br>";
    echo "<label for='stellingsnummer'>Stellingsnummer:</label>";
    echo "<select id='stellingsnummer' name='stellingsnummer' required>";
    foreach ($beschikbareStellingen as $stelling) {
        echo "<option value='$stelling'>$stelling</option>";
    }
    echo "</select><br>";
    echo "<button type='submit'>Update Product</button>";
    echo "</form>";
    ?>
</div>
</body>
</html>
