<?php
session_start();
require_once 'hoofd.php';
require_once 'beheerderlogin.php';

if (isset($_SESSION['beheerderid'])) {
    header("Location: beheerdersdashboard.php");
    exit;
}
?>
