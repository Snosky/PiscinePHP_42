<form action="" method="POST">
    <label for="name">Nom de la categorie :</label>
    <input type="text" id="name" name="name" required="required" value="<?php echo (isset($form['cat_name'])) ? $form['cat_name'] : '' ?>">
    <button type="submit">Ajouter</button>
</form>