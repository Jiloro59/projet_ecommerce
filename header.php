<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
?>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
  <link rel="stylesheet" href="css/style.css">

 
  <title>Nitro</title>
</head>

<body class="overflow-auto">
  <header>
<div class="logo">
  <h1><a href="index.php">Nitro</a></h1>
</div>
<?php
error_reporting(0);
if($_SESSION["connected"] == true){
  if($_SESSION['user']['statut'] == '2'){


?>
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container-fluid">

        <div class="collapse navbar-collapse" id="navbarColor01">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <a class="nav-link active" href="index.php">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="inscription.php">Inscription</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="connect.php">Connexion</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="create.php">Ajouter</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="delete.php">Supprimer</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="update.php">Modifier</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="indexAdmin.php">Index Admin</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="disconnect.php">Déconnexion</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="panier.php">Panier</a>
            </li>
          </ul>

        </div>
      </div>
    </nav>
<?php
  }
  elseif($_SESSION['user']['statut'] == 1) {
  ?>
       <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container-fluid">

        <div class="collapse navbar-collapse" id="navbarColor01">
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <a class="nav-link active" href="index.php">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="disconnect.php">Déconnexion</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="panier.php">Panier</a>
            </li>

          </ul>

        </div>
      </div>
    </nav>
<?php    
  }
}
else {
?>
  <nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">

    <div class="collapse navbar-collapse" id="navbarColor01">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link active" href="index.php">Accueil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="inscription.php">Inscription</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="connect.php">Connexion</a>
        </li>
      </ul>

    </div>
  </div>
</nav>
<?php
}
?>

    <?php if($_SESSION["connected"] == true){
    echo "Bonjour " .$_SESSION['user']['nom'];
}?>
  </header> 
