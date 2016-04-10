<form action="" method="POST">
    <label for="name">Nom de l'article :</label>
    <input type="text" id="name" name="name" required="required" value="<?php echo $form['itm_name'] ?>">
    <label for="description">Description de l'article :</label>
    <textarea name="description" id="description" cols="30" rows="10"><?php echo $form['itm_description'] ?></textarea>
    <label for="price">Prix (utiliser un point pour la virgule ex: 28.50)</label>
    <input type="text" name="price" required="required" id="price" value="<?php echo $form['itm_price'] ?>">
    <label for="quantity">Quantite : (-1 pour illimite)</label>
    <input type="number" name="quantity" id="quantity" required="required" value="<?php echo $form['itm_quantity'] ?>">
    <label for="category">Categorie :</label>
    <select name="category[]" id="category" required="required" multiple>
        <?php foreach ($categories as $category): ?>
            <option value="<?php echo $category['cat_id'] ?>" <?php echo (in_array($category['cat_id'], $form['cat_id'])) ? 'selected' : '' ?>><?php echo $category['cat_name'] ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Sauvegarder</button>
</form>