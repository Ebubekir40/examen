<?php
session_start();
require_once 'hoofd1.php';
require_once 'beheerders.php';


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if (!isset($_SESSION['beheerderid'])) {
    header("Location: beheerderlogin.php");
    exit();
}

$beheerders = new Beheerders();
$beheerderid = $_SESSION['beheerderid'];
$huidigeBeheerder = $beheerders->zoekBeheerderOpId($beheerderid);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Checken of alles is ingevuld
    if (isset($_POST['nieuweVoornaam'], $_POST['nieuweAchternaam'], $_POST['nieuweEmail'], $_POST['nieuweGebruikersnaam'], $_POST['nieuwWachtwoord'])) {
        // Voer de updates uit
        $nieuweVoornaam = $_POST['nieuweVoornaam'];
        $nieuweAchternaam = $_POST['nieuweAchternaam'];
        $nieuweEmail = $_POST['nieuweEmail'];
        $nieuweGebruikersnaam = $_POST['nieuweGebruikersnaam'];
        $nieuwWachtwoord = $_POST['nieuwWachtwoord'];


        $updateVoornaamResult = $beheerders->updateBeheerderVoornaam($beheerderid, $nieuweVoornaam);
        if ($updateVoornaamResult !== true) {
            echo "Voornaam bijwerken mislukt: " . $updateVoornaamResult;
        }


        $updateAchternaamResult = $beheerders->updateBeheerderAchternaam($beheerderid, $nieuweAchternaam);
        if ($updateAchternaamResult !== true) {
            echo "Achternaam bijwerken mislukt: " . $updateAchternaamResult;
        }


        $updateEmailResult = $beheerders->updateBeheerderEmail($beheerderid, $nieuweEmail);
        if ($updateEmailResult !== true) {
            echo "E-mail bijwerken mislukt: " . $updateEmailResult;
        }

        $updateGebruikersnaamResult = $beheerders->updateBeheerderGebruikersnaam($beheerderid, $nieuweGebruikersnaam);
        if ($updateGebruikersnaamResult !== true) {
            echo "Gebruikersnaam bijwerken mislukt: " . $updateGebruikersnaamResult;
        }


        $updateWachtwoordResult = $beheerders->updateBeheerderWachtwoord($beheerderid, $nieuwWachtwoord);
        if ($updateWachtwoordResult !== true) {
            echo "Wachtwoord bijwerken mislukt: " . $updateWachtwoordResult;
        }


        $huidigeBeheerder = $beheerders->zoekBeheerderOpId($beheerderid);
    } else {
        echo "Vul alle vereiste velden in.";
    }
}
?>

    <!DOCTYPE html>
    <html lang="nl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Beheerdersprofiel</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
              rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <style>
            .btn-primary {
                background-color: #000;
                border-color: #000;
            }
        </style>
    </head>
    <body class="bg-light">

    <div class="container mt-5">
        <h1 class="text-center mb-4">Beheerdersprofiel</h1>

        <form method="post" action="beheerdersprofiel.php">
            <div class="mb-3">
                <label for="nieuweVoornaam" class="form-label">Nieuwe voornaam:</label>
                <input type="text" id="nieuweVoornaam" name="nieuweVoornaam" class="form-control" value="<?php echo $huidigeBeheerder['voornaam']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="nieuweAchternaam" class="form-label">Nieuwe achternaam:</label>
                <input type="text" id="nieuweAchternaam" name="nieuweAchternaam" class="form-control" value="<?php echo $huidigeBeheerder['achternaam']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="nieuweEmail" class="form-label">Nieuwe e-mail:</label>
                <input type="email" id="nieuweEmail" name="nieuweEmail" class="form-control" value="<?php echo $huidigeBeheerder['email']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="nieuweGebruikersnaam" class="form-label">Nieuwe gebruikersnaam:</label>
                <input type="text" id="nieuweGebruikersnaam" name="nieuweGebruikersnaam" class="form-control" value="<?php echo $huidigeBeheerder['gebruikersnaam']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="nieuwWachtwoord" class="form-label">Nieuw wachtwoord:</label>
                <input type="password" id="nieuwWachtwoord" name="nieuwWachtwoord" class="form-control" required>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Opslaan</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    </body>
    </html>
