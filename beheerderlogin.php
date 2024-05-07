<?php
session_start();

require_once 'hoofd.php';
require_once 'Beheerders.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gebruikersnaam = $_POST['gebruikersnaam'];
    $wachtwoord = $_POST['wachtwoord'];

    $beheerders = new Beheerders();
    $beheerderid = $beheerders->geldigeBeheerder($gebruikersnaam, $wachtwoord);

    if ($beheerderid) {

        $_SESSION['beheerderid'] = $beheerderid;
        header("Location: beheerdersdashboard.php");
        exit();
    } else {

        $error = "Ongeldige inloggegevens. Probeer het opnieuw.";
    }
}
?>

    <!DOCTYPE html>
    <html lang="nl">
    <head>
        <meta charset="UTF-8">
        <title>Inloggen</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
              rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <style>
            .btn-primary {
                background-color: #000;
                border-color: #000;
            }
            .container {
                margin-top: -100px;
            }
        </style>
    </head>
    <body>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 90vh;">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Inloggen</h2>
                <?php if (isset($error)) { echo "<p style='color: red;' class='mb-4'>$error</p>"; } ?>
                <form action="beheerderlogin.php" method="post">
                    <div class="mb-3">
                        <label for="gebruikersnaam" class="form-label">Gebruikersnaam:</label>
                        <input type="text" class="form-control" id="gebruikersnaam" name="gebruikersnaam" required>
                    </div>
                    <div class="mb-3">
                        <label for="wachtwoord" class="form-label">Wachtwoord:</label>
                        <input type="password" class="form-control" id="wachtwoord" name="wachtwoord" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Inloggen</button>
                </form>

                <p class="mt-4">Nog geen beheerdersaccount? <a href="beheerderregister.php">Registreer hier</a>.</p>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    </body>
    </html>

