<?php
require_once 'Beheerders.php';
require_once 'hoofd.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gebruikersnaam = $_POST['gebruikersnaam'];
    $wachtwoord = $_POST['wachtwoord'];
    $voornaam = $_POST['voornaam'];
    $achternaam = $_POST['achternaam'];
    $email = $_POST['email'];

    $beheerders = new Beheerders();


    if (!$beheerders->gebruikersnaambezet($gebruikersnaam)) {
        if (substr($email, -strlen("@adminpochon.nl")) === "@adminpochon.nl") {
            if ($beheerders->maak($gebruikersnaam, $wachtwoord, $voornaam, $achternaam, $email)) {
                header("Location: beheerderlogin.php?success=1");
                exit();
            } else {
                $message = "Registratie mislukt. Probeer het opnieuw.";
            }
        } else {
            $message = "Registratie mislukt. Vraag hulp bij werkgever.";
        }
    } else {
        $message = "Deze gebruikersnaam is al in gebruik. Kies een andere.";
    }
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Registratiepagina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .btn-primary {
            background-color: #000;
            border-color: #000;
        }
        body {
            padding-top: 150px;
        }

        .container {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .btn-dark {
            background-color: black;
            color: white;
        }
    </style>
</head>

<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Registratie</h2>
            <?php if (isset($message)) : ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <form action="beheerderregister.php" method="post">
                <div class="mb-3">
                    <label for="gebruikersnaam" class="form-label">Gebruikersnaam:</label>
                    <input type="text" class="form-control" id="gebruikersnaam" name="gebruikersnaam" required>
                </div>
                <div class="mb-3">
                    <label for="wachtwoord" class="form-label">Wachtwoord:</label>
                    <input type="password" class="form-control" id="wachtwoord" name="wachtwoord" required>
                </div>
                <div class="mb-3">
                    <label for="voornaam" class="form-label">Voornaam:</label>
                    <input type="text" class="form-control" id="voornaam" name="voornaam" required>
                </div>
                <div class="mb-3">
                    <label for="achternaam" class="form-label">Achternaam:</label>
                    <input type="text" class="form-control" id="achternaam" name="achternaam" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail:</label>
                    <input type="text" class="form-control" id="email" name="email" required>
                </div>
                <button type="submit" class="btn btn-primary">Registreren</button>
            </form>
            <p class="mt-4">Heb je al een account? <a href="beheerderlogin.php">Login</a>.</p>
        </div>
    </div>
</div>
</body>
</html>
