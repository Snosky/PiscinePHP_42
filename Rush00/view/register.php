<form action="" method="POST">
    <label for="username">Pseudo :</label>
    <input type="text" id="username" name="username" required="required" value="<?= $form['val_username'] ?>"/>
    <label for="email">Addresse e-mail :</label>
    <input type="email" id="email" name="email" required="required" value="<?= $form['val_email'] ?>"/>
    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required="required" />
    <label for="password_conf">Confirmation du mot de passr :</label>
    <input type="password" id="password_conf" name="password_conf" require="require" />
    <button type="submit">S'inscrire</button>
</form>