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
        <a href="#">
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
                        <a href="#">Ajouter au panier</a>
                        <form action="update.php" method="POST">
                            <input type="hidden" name="update" value="<?= $value['idProduit'] ?>">
                            <button type="submit">Modifier</button>
                        </form>
                        <form action="delete.php" method="POST">
                            <input type="hidden" name="delete" value="<?= $value['idProduit'] ?>">
                            <button type="submit">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </a>
    <?php
    }
    ?>
</div>
<?php
require("footer.php");
?>