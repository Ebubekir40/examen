<?php
session_start();
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <style>
            body {
                padding-top: 150px;
            }

            .navbar {
                background-color: white;
                box-shadow: 0 4px 2px -2px gray;
            }

            .navbar-brand img {
                max-height: 125px;
            }

            .navbar-nav {
                justify-content: space-between;
            }

            .navbar-nav.ml-auto {
                margin-right: 0;
            }

            .nav-item {
                margin-right: 45px;
            }

            .navbar-nav .nav-link {
                color: black !important;
                font-size: 20px;
                font-weight: bold;
            }


        </style>
    </head>

    <body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <a class="navbar-brand" href="index.php"><img src="pochon%20logo" alt="Logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="zoekproduct1.php">Zoeken</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="alleproducten.php">Producten</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="maakproduct1.php">Product toevoegen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="beheerdersdashboard.php">laatst geüpdatet </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="beheerdersprofiel.php">Beheerdersprofiel</a>
                    </li>
                    <li class="nav-item">
                        <?php
                        if (isset($_SESSION['beheerderid'])) {
                            echo '<a class="nav-link" href="uitloggen.php">Uitloggen</a>';
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    </body>

    </html>

