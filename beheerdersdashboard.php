<?php
session_start();
if (!isset($_SESSION['beheerderid'])) {
    header("Location: beheerderlogin.php");
    exit();
}

require_once 'producten.php';
require_once 'hoofd1.php';


$producten = new Producten();
$productenLijst = $producten->krijgProducten();

usort($productenLijst, function($a, $b) {
    return strtotime($b['datum']) - strtotime($a['datum']);
});


$gebruikteStellingen = $producten->krijgGebruikteStellingen();
$beschikbareStellingen = array_diff(range(1, 25), $gebruikteStellingen);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Beheerdersdashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h2 class="mt-3">Beheerdersdashboard</h2>
    <div class="mb-3">
        <strong>Vrije stellingen:</strong>
        <?php foreach ($beschikbareStellingen as $stellingnummer) : ?>
            <span class="badge bg-success"><?php echo $stellingnummer; ?></span>
        <?php endforeach; ?>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th>Productnaam</th>
            <th>Aantal</th>
            <th>Datum</th>
            <th>Stellingsnummer</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($productenLijst as $product) {
            echo "<tr>";
            echo "<td>{$product['productnaam']}</td>";
            echo "<td>{$product['aantal']}</td>";
            echo "<td>{$product['datum']}</td>";
            echo "<td>{$product['stellingsnummer']}</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>


</body>
</html>
