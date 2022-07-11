<?php
require("header.php");
session_start();
if($_SESSION['nom'] !== ""){
    $user = $_SESSION['nom'];
    // afficher un message
    echo "Bonjour $user, vous êtes connecté";
}

?>