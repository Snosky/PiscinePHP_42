<a href="item_add.php" class="btn btn-success">Ajouter un article</a>
<table>
    <thead>
    <tr>
        <th>Nom de l'article</th>
        <th>Quantite</th>
        <th>Prix</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($items as $item): ?>
        <tr>
            <td><?php echo $item['itm_name']; ?></td>
            <td><?php if ($item['itm_quantity'] == -1): ?>
                    Illimite
                <?php else: ?>
                <?php echo $item['itm_quantity']; ?></td>
                <?php endif; ?>
            </td>
            <td><?php echo $item['itm_price']; ?></td>
            <td>
                <a href="item_edit.php?itm_id=<?php echo $item['itm_id'] ?>" class="btn btn-success">Modifier</a>
                <a href="item_delete.php?itm_id=<?php echo $item['itm_id'] ?>">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>