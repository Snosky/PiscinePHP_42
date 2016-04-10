<form action="" method="POST">
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" id="username" name="username" value="<?php echo $form['usr_name'] ?>" required="required">
    <label for="email">Adresse email :</label>
    <input type="email" id="email" name="email" value="<?php echo $form['usr_email'] ?>" required="required">
    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password">
    <label for="password_conf">Confirmation mot de passe :</label>
    <input type="password" id="password_conf" name="password_conf">
    <label for="role">Roles de l'utilisateur</label>
    <select name="role" id="role">
        <option value="ROLE_USER" <?php echo ($form['usr_role'] == 'ROLE_USER') ? 'selected' : '' ?>>Utilisateur basique</option>
        <option value="ROLE_ADMIN" <?php echo ($form['usr_role'] == 'ROLE_ADMIN') ? 'selected' : '' ?>>Administrateur</option>
    </select>
    <button type="submit">Modifier</button>
</form>