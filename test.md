                <table class="table table-hover table-bordered container">
            <thead>
                <th>Nom</th>
                <th>Marque</th>
                <th>Description</th>
                <th>Prix</th>
                <th>Stock</th>
                <th>Image</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                // On affiche dans le tableau chaque donnée de la bdd
                foreach ($result as $value) :
                ?>
                    <tr>
                        <td><?= $value['nomProduit'] ?></td> <!-- $value['prenom'] = Le prénom de l'artiste dans la bdd -->

                        <td><?= $value['marqueProduit'] ?></td>

                        <td><?= $value['descriptionProduit'] ?></td>

                        <td><?= $value['prixProduit'] ?></td>

                        <td><?= $value['stockProduit'] ?></td>

                        <td><img src="uploads/<?=$value['imageProduit']?>" alt=""></td>

                        <td><form action="update.php" method="POST">
                            <input type="hidden" name="update" value ="<?=$value['idProduit']?>">
                            <button type="submit">Modifier</button>
                        </form>
                        <form action="delete.php" method="POST">
                            <input type="hidden" name="delete" value ="<?=$value['idProduit']?>">
                            <button type="submit">Supprimer</button>
                        </form>
                    </td>

                    </tr>
                <?php endforeach; ?>


            </tbody>
        </table>