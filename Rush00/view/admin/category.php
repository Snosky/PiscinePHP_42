<a href="category_add.php" class="btn btn-success">Ajouter une categorie</a>
<table>
    <thead>
        <tr>
            <th>Nom de la categorie</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($categories as $category): ?>
        <tr>
            <td><?php echo $category['cat_name']; ?></td>
            <td>
                <a href="category_edit.php?cat_id=<?php echo $category['cat_id'] ?>" class="btn btn-success">Modifier</a>
                <a href="category_delete.php?cat_id=<?php echo $category['cat_id'] ?>">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>