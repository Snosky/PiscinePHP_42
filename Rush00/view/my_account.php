<form action="" method="POST">
    <label for="old_password">Mot de passe *:</label>
    <input type="password" id="old_password" name="old_password" required="required">
    <label for="email">Adresse email :</label>
    <input type="email" id="email" name="email" value="<?php echo (isset($form['usr_email'])) ? $form['usr_email'] : '' ?>">
    <label for="new_password">Nouveau mot de passe :</label>
    <input type="password" id="new_password" name="new_password">
    <label for="new_password_conf">Confirmation mot de passe :</label>
    <input type="password" id="new_password_conf" name="new_password_conf">
    <button type="submit">Modifier</button>
</form>