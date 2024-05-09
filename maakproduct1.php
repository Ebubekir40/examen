<?php
require_once 'producten.php';
require_once 'hoofd1.php';

if (!isset($_SESSION['beheerderid'])) {
    header("Location: beheerderlogin.php");
    exit();
}

$producten = new Producten();
// Alle gebruikte stellingsnummers ophalen
$gebruikteStellingen = $producten->krijgGebruikteStellingen();
$beschikbareStellingen = array_diff(range(1, 25), $gebruikteStellingen);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Product Toevoegen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-rSWY5G/6S2X8K2V5/6S2D/jJb8tcPfVugWCPtgaU8BwhBIJjNqcyzy3W6F5wEWTl"
          crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h2 class="mt-3">Product Toevoegen</h2>
    <form action="maakproduct.php" method="post" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="productnaam" class="form-label">Productnaam:</label>
            <input type="text" class="form-control" id="productnaam" name="productnaam" required>
        </div>

        <div class="mb-3">
            <label for="aantal" class="form-label">Aantal:</label>
            <input type="number" class="form-control" id="aantal" name="aantal" required>
        </div>
        <div class="mb-3">
            <label for="stellingsnummer" class="form-label">Stellingsnummer:</label>
            <select class="form-select" id="stellingsnummer" name="stellingsnummer" required>
                <option value="" selected disabled>Kies een stellingsnummer</option>
                <?php foreach ($beschikbareStellingen as $stellingnummer) : ?>
                    <option value="<?php echo $stellingnummer; ?>"><?php echo $stellingnummer; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="afbeelding" class="form-label">Afbeelding uploaden:</label>
            <input type="file" class="form-control" id="afbeelding" name="afbeelding" accept="image/*">
        </div>

        <input type="submit" class="btn btn" value="Product Toevoegen" style="background-color: black; color: white;">
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
</html>
