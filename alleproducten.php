<?php
session_start();
if (!isset($_SESSION['beheerderid'])) {
    header("Location: beheerderlogin.php");
    exit();
}
?>
<?php
require_once 'producten.php';
require_once 'hoofd1.php';
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Alle Producten</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h2 {
            margin-bottom: 20px;
        }

        .product-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            grid-gap: 20px;
        }

        .product-card {
            border: 1px solid #ddd;
            padding: 10px;
            cursor: pointer;
            height: 100%;
        }

        .product-card img {
            max-width: 100%;
            max-height: 150px;
            margin-bottom: 10px;
        }

        .product-card p {
            margin: 0;
        }

        .product-card:hover {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="mt-3">Alle Producten</h2>
    <div class="product-container">
        <?php

        $producten = new Producten();
        $productenLijst = $producten->getProducten();

        foreach ($productenLijst as $product) {
            echo "<div class='product-card' data-productid='{$product['productid']}' onclick='doorsturenNaarZoeken({$product['productid']})'>"; // Voeg een data-attribuut toe voor het productid en voeg een onclick-event toe
            echo "<img src='{$product['afbeelding']}' alt='Product Afbeelding'>";
            echo "<p><strong>Productnaam:</strong> {$product['productnaam']}</p>";
            echo "<p><strong>Aantal:</strong> {$product['aantal']}</p>";
            echo "<p><strong>Datum:</strong> {$product['datum']}</p>";
            echo "<p><strong>Stellingsnummer:</strong> {$product['stellingsnummer']}</p>";
            echo "</div>";
        }
        ?>
    </div>
</div>

<script>
    function doorsturenNaarZoeken(productId) {
        window.location.href = `searchproduct.php?productid=${productId}`;
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
