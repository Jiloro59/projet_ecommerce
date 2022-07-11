<?php 

// Connexion à la base de données

try{
    $db = new PDO('mysql:host=localhost;dbname=nitro', 'root', '');
    $db -> exec('SET NAMES "UTF8"');
}
catch (PDOException $e) {
    echo 'Erreur : '. $e->getMessage();
    die();
}


?>