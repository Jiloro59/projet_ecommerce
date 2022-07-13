<?php
require("header.php");
require("db.php");
$sql = "SELECT * FROM produit";
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
?>


<div class="flex">
    <?php
    foreach ($result as $value) {
    ?>
        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <img src="uploads/<?= $value['imageProduit'] ?>" alt="">
                </div>
                <div class="flip-card-back">
                    <h2><?= $value['nomProduit'] ?></h2>
                    <p>Marque :<?= $value['marqueProduit'] ?></p>
                    <p>Description :<?= $value['descriptionProduit'] ?></p>
                    <p>Prix : <?= $value['prixProduit'] ?> €</p>
                    <p>Stock : <?= $value['stockProduit'] ?></p>
                    <form value ="<?= $value['idProduit']?>">
                        <input type="hidden" name="idPanier" value ="<?= $value['idProduit']?>">
                        <button type="submit" action="panier.php">Ajouter au panier</button>
                    </form>
                    <a href="#">En savoir plus</a>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<?php 
require("footer.php");
?>