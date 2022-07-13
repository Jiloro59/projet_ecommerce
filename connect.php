<?php
require('db.php');
require("header.php");
// RECUPERATION DES DONNEES DE LA TABLE UTILISATEUR

$sql = "SELECT * FROM utilisateur";
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);


?>

<body>

    <!-- FORMULAIRE DE CONNEXION -->
<h2>Connectez-vous pour accéder au site</h2>
    <div class="form-body">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <form method="POST">
                            <div class="col-md-12">
                                <input class="form-control" type="email" name="mail" placeholder="E-mail" required>
                            </div>


                            <div class="col-md-12">
                                <input class="form-control" type="password" name="password" placeholder="Mot de passe" required>
                            </div>

                            <div class="form-button mt-3">
                                <button id="submit" type="submit" class="btn btn-primary modifier">Connexion</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST)) {
        if (
            isset($_POST["mail"]) && !empty($_POST["mail"])
            && isset($_POST["password"]) && !empty($_POST["password"])
        ) {

            // RECUPERATION DES DONNEES DU FORM

            $email = trim(htmlspecialchars($_POST["mail"]));
            $password = trim(htmlspecialchars($_POST["password"]));

            // REQUETE SQL -> BIND -> EXECUTE

            $sql = "SELECT * from utilisateur WHERE mailUtilisateur=:email";
            $query = $db->prepare($sql);
            $query->bindValue(':email', $email, PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetch(PDO::FETCH_ASSOC);
            error_reporting(0);

            // VERIFICATION DU PASSWORD -> PASSWORD VERIFY

            if (password_verify($password, $result['passwordUtilisateur'])) {
                echo "<p>Connexion réussie</p>";
                    $_SESSION['connected'] = true;
                    $_SESSION['user'] = [
                                            'id'=>$result['idUtilisateur'],
                                            'nom'=>$result['nomUtilisateur'],
                                            'prenom'=>$result['prenomUtilisateur'],
                                            'mail'=>$result['mailUtilisateur'],
                                            'adresse'=>$result['adresseUtilisateur'],
                                            'statut'=>$result['statutUtilisateur'],
                                        ];
                header('Location: index.php');
                exit;

            } else {
                echo "<p>Connexion échouée, Veuillez recommencer</p>";
            }
        }
    }
    if (isset($_SESSION)) {
        if ($_SESSION['admin'] == 2) {
            echo "Bonjour admin";
        } elseif ($_SESSION["admin"] == 1) {
            echo "Bonjour client";
        }
    }

    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>