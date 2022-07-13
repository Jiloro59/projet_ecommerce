<?php
require("db.php");
require('header.php');
$idItem = $_POST["delete"];
$sql = "SELECT * FROM produit WHERE idProduit = $idItem";
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

$sql = "DELETE FROM `produit` WHERE idProduit = $idItem";
$query = $db->prepare($sql);
$query->execute();
unlink("uploads/".$result["imageProduit"]);
// header("Location : index.php");
?>