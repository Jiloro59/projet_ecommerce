<?php

require("db.php");
require("header.php");

?>

<!DOCTYPE html>

<html lang="en">

<body>

    <form method="POST">
        <div>
            <label for="nom">Nom</label>
            <input type="text" name="nom">
        </div>

        <div>
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom">
        </div>

        <div>
            <label for="mail">Mail</label>
            <input type="text" name="mail">
        </div>

        <div>
            <label for="adresse">Adresse</label>
            <input type="text" name="adresse">
        </div>

        <div>
            <label for="password">Password</label>
            <input type="password" name="password">
        </div>

        <button type="submit">Valider</button>
    </form>

    <?php

    // VERIFICATION DE L'ADRESSE MAIL 

    if (isset($_POST['mail']) && !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
        echo '<p>Email incorrect</p>';
    }
    // VERIFICATION DU MOT DE PASSE

    if (!empty($_POST["password"])) {
        $password = $_POST["password"];
        if (strlen($_POST["password"]) <= '8') {
            $passwordErr = "<p>Votre mot de passe doit contenir au moins 8 caractères</p>";
            print_r($passwordErr);
        } elseif (strlen($_POST["password"]) >= 15) {
            $passwordErr = "<p>Votre mot de passe doit contenir moins de 15 caractères</p>";
            echo $passwordErr;
        } elseif (!preg_match("#[0-9]+#", $password)) {
            $passwordErr = "<p>Votre mot de passe doit contenir 1 nombre</p>";
            echo $passwordErr;
        } elseif (!preg_match("#[A-Z]+#", $password)) {
            $passwordErr = "<p>Votre mot de passe doit contenir 1 majuscule</p>";
            echo $passwordErr;
        } elseif (!preg_match("#[a-z]+#", $password)) {
            $passwordErr = "<p>Votre mot de passe doit contenir 1 minuscule</p>";
            echo $passwordErr;
        } elseif (isset($_POST)) { // On vérifie que les inputs sont remplis
            if (
                isset($_POST["nom"]) && !empty($_POST["nom"])
                && isset($_POST["prenom"]) && !empty($_POST["prenom"])
                && isset($_POST["mail"]) && !empty($_POST["mail"])
                && isset($_POST["adresse"]) && !empty($_POST["adresse"])
                && isset($_POST["password"]) && !empty($_POST["password"])
            ) {
                $nom = trim(htmlspecialchars($_POST["nom"]));
                $prenom = trim(htmlspecialchars($_POST["prenom"]));
                $mail = trim(htmlspecialchars($_POST["mail"]));
                $adresse = trim(htmlspecialchars($_POST["adresse"]));
                $password = trim(htmlspecialchars(password_hash($_POST["password"], PASSWORD_DEFAULT)));

                $sql = "INSERT INTO utilisateur (nomUtilisateur, prenomUtilisateur, mailUtilisateur, adresseUtilisateur, passwordUtilisateur) 
                        VALUES (:nom,:prenom,:mail,:adresse,:password)";
                $query = $db->prepare($sql);
                $query->bindValue(':nom', $nom, PDO::PARAM_STR);
                $query->bindValue(':prenom', $prenom, PDO::PARAM_STR);
                $query->bindValue(':mail', $mail, PDO::PARAM_STR);
                $query->bindValue(':adresse', $adresse, PDO::PARAM_STR);
                $query->bindValue(':password', $password, PDO::PARAM_STR);
                $query->execute();

                $sql = "SELECT statutClient FROM utilisateur WHERE mailUtilisateur = '$mail'";
                $query = $db->prepare($sql);
                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_ASSOC);

                echo '<script language="javascript">';
                echo 'alert("Inscription réussie")';
                echo '</script>';
            }
        }
    }
    else {
        echo "ça marche pas";
    }

    ?>
</body>
</html>