<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<h1></h1>

<?php
require_once 'beheerders.php';
require_once 'hoofd1.php';

session_start();
if (!isset($_SESSION['beheerderid'])) {
    header("Location: beheerderlogin.php");
    exit();
}
?>

<form id="searchForm" action="zoekproduct.php" method="GET">
    <label for="productid">Voer product ID in:</label>
    <input type="text" id="productid" name="productid">
    <input type="submit" value="Zoeken">
</form>
</body>
</html>
