<?php
require("db.php");
require('header.php');
?>
<?php
$sql = "SELECT * FROM produit WHERE idProduit = $idItem";
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
$idItem = $_SESSION['user']['idItem'];
?>

<form method="post" enctype="multipart/form-data">
    <div>
        <label for="nom">Nom du produit</label>
        <input type="text" name="nom">
    </div>
    <div>
        <label for="marque">Marque</label>
        <input type="text" name="marque">
    </div>
    <div><label for="description">Description</label>
        <input type="text" name="description">
    </div>
    <div>
        <label for="prix">Prix</label>
        <input type="text" name="prix">
    </div>
    <div>
        <label for="image">Image</label>
        <input type="file" name="image">
    </div>
    <div>
        <label for="stock">Stock</label>
        <input type="text" name="stock">
    </div>
    <div>
        <input type="hidden" name="id" value="<?=$idItem;?>">
    </div>

    <button type="submit">Modifier</button>
</form>


<?php
if (isset($_POST)) {
    if (isset($_POST["nom"]) && !empty($_POST['nom'])) {
        $nom = $_POST['nom'];
        $marque = $_POST["marque"];
        $description = $_POST["description"];
        $prix = $_POST["prix"];
        $image = $_FILES["image"]["name"];
        $stock = $_POST["stock"];
        $id = $_POST["id"];

        unlink("uploads/".$result[0]["imageProduit"]);

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if (isset($_POST)) {
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check !== false) {
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
        if ($_FILES["image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";

            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }

        $sql = "UPDATE produit 
        SET nomProduit=:nom ,prixProduit = :prix, marqueProduit = :marque ,descriptionProduit=:description ,imageProduuit=:image,stockProduit=:stock 
        WHERE idProduit = $idItem";
        $query = $db->prepare($sql);
        $query->bindValue(':nom', $nom, PDO::PARAM_STR);
        $query->bindValue(':prix', $prix, PDO::PARAM_STR);
        $query->bindValue(':marque', $marque, PDO::PARAM_STR);
        $query->bindValue(':description', $description, PDO::PARAM_STR);
        $query->bindValue(':image', $image, PDO::PARAM_STR);
        $query->bindValue(':stock', $stock, PDO::PARAM_STR);
        $query->execute();
    }
}

?>
