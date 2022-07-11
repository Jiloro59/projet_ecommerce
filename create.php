<?php
require('db.php');
require("header.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>

<body>

</body>

</html>

<body>
    <div class="form-body" id="artiste">
        <div class="row">
            <div class="form-holder">
                <div class="form-content">
                    <div class="form-items">
                        <h3>Ajouter un article</h3>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <input class="form-control" type="text" name="nom" placeholder="Nom de l'article" required>
                            </div>

                            <div class="col-md-12">
                                <input class="form-control" type="text" name="prix" placeholder="Prix" required>
                            </div>

                            <div class="col-md-12">
                                <input class="form-control" type="text" name="marque" placeholder="Marque" required>
                            </div>

                            <div class="col-md-12">
                                <input class="form-control" type="text" name="description" placeholder="Description" required>
                            </div>

                            <div class="col-md-12">
                                <input class="form-control" type="file" name="imageProduit" placeholder="Image" required>
                            </div>

                            <div class="col-md-12">
                                <input class="form-control" type="text" name="stock" placeholder="Stock" required>
                            </div>

                            <div class="form-button mt-3">
                                <button id="submit" type="submit" class="btn btn-primary modifier">Ajouter</button>
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
            isset($_POST["prix"]) && !empty($_POST["prix"])
            && isset($_POST["nom"]) && !empty($_POST["nom"])
        ) {
            $prix = trim(htmlspecialchars($_POST["prix"]));
            $nom = trim(htmlspecialchars($_POST["nom"]));
            $marque = trim(htmlspecialchars($_POST["marque"]));
            $description = trim(htmlspecialchars($_POST["description"]));
            $image = $_FILES["imageProduit"]["name"];
            $stock = trim(htmlspecialchars($_POST["stock"]));

            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["imageProduit"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            if(isset($_POST)) {
              $check = getimagesize($_FILES["imageProduit"]["tmp_name"]);
              if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
              } else {
                echo "File is not an image.";
                $uploadOk = 0;
              }
            }
            
            // Check if file already exists
            if (file_exists($target_file)) {
              echo "Sorry, file already exists.";
              $uploadOk = 0;
            }
            
            // Check file size
            if ($_FILES["imageProduit"]["size"] > 500000) {
              echo "Sorry, your file is too large.";
              $uploadOk = 0;
            }
            
            // Allow certain file formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
              echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
              $uploadOk = 0;
            }
            
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
              echo "Sorry, your file was not uploaded.";
    
            // if everything is ok, try to upload file
            } else {
              if (move_uploaded_file($_FILES["imageProduit"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["imageProduit"]["name"])). " has been uploaded.";
              } else {
                echo "Sorry, there was an error uploading your file.";
              }
            }




            $sql = "INSERT INTO produit(nomProduit, prixProduit, marqueProduit, descriptionProduit, imageProduit, stockProduit) 
            VALUES (:nom,:prix,:marque,:description,:image,:stock)";
            $query = $db->prepare($sql);
            $query->bindValue(':nom', $nom, PDO::PARAM_STR);
            $query->bindValue(':prix', $prix, PDO::PARAM_STR);
            $query->bindValue(':marque', $marque, PDO::PARAM_STR);
            $query->bindValue(':description', $description, PDO::PARAM_STR);
            $query->bindValue(':image', $image, PDO::PARAM_STR);
            $query->bindValue(':stock', $stock, PDO::PARAM_STR);
            $query->execute();
            echo '<script language="javascript">';
            echo 'alert("Ajout réussi")';
            echo '</script>';
        }
    }
    ?>