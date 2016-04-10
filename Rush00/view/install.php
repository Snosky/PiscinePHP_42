<?php if ($show_form): ?>
<form action="" method="POST">
    <p>Voulez vous vraiment installer la base de donne ? Cela supprimera les donnees deja existantes :( ?</p>
    <input type="submit" name="drop" value="Oui">
    <input type="submit" name="drop" value="Non">
</form>
<?php else: ?>
    <h1>Base de donnee OK.</h1>
<?php endif; ?>
