<form action="" method="POST">
    <label for="username">Pseudo :</label>
    <input type="text" id="username" name="username" required="required" value="<?= $form['val_username'] ?>"/>
    <label for="email">Addresse e-mail :</label>
    <input type="email" id="email" name="email" required="required" value="<?= $form['val_email'] ?>"/>
    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required="required" />
    <label for="password_conf">Confirmation du mot de passe :</label>
    <input type="password" id="password_conf" name="password_conf" require="require" />
    <label for="role">Roles de l'utilisateur</label>
    <select name="role" id="role">
        <option value="ROLE_USER" <?php echo ($form['usr_role'] == 'ROLE_USER') ? 'selected' : '' ?>>Utilisateur basique</option>
        <option value="ROLE_ADMIN" <?php echo ($form['usr_role'] == 'ROLE_ADMIN') ? 'selected' : '' ?>>Administrateur</option>
    </select>
    <button type="submit">Creer l'utilisateur</button>
</form>