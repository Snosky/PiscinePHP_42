<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>42commerce</title>
    <link rel="stylesheet" href="web/css/style.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
</head>
<body>
    <header>
        <div class="wrap">
            <a href="index.php"><img src="web/img/logo-42-white.gif" alt="42commerce"></a>
            <ul class="nav">
                <li><a href="index.php">Accueil</a></li>
                <?php if (has_role('ROLE_ADMIN')): ?>
                <li><a href="admin">Administration</a></li>
                <?php endif; ?>
            </ul>

            <div class="align-right">
                <a href="cart.php">Mon Panier (<?php echo get_nb_item_cart() ?>)</a>
            </div>
        </div>
    </header>

    <div class="wrap banner">
        <img src="web/img/banner.gif" alt="">
        <p>Les composants informatique aux meilleurs prix !</p>
    </div>
    
    <?php if (have_flash_message('success')): ?>
        <div class="flash flash-success">
            <?php foreach (get_flash_message('success') as $msg): ?>
                <p><?php echo $msg; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if (have_flash_message('error')): ?>
    <div class="flash flash-error">
        <?php foreach (get_flash_message('error') as $msg): ?>
            <p><?php echo $msg; ?></p>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php if (have_flash_message('info')): ?>
        <div class="flash flash-info">
            <?php foreach (get_flash_message('info') as $msg): ?>
                <p><?php echo $msg;?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="wrap main-content">
        <div class="col-left">
            <?php echo $content_for_layout; ?>
        </div>
        <div class="col-right">
            <?php if (is_connected()): ?>
            <div class="widget">
                <div class="widget-title">Mon Compte</div>
                <div class="widget-content">
                    <p class="text-center">Vous etes connecter en tant que :</p>
                    <p class="text-center"><?php echo get_user()['name'] ?></p>
                    <p class="text-center"><a href="my_command.php">Voir mes commandes.</a></p>
                    <p class="text-center"><a href="my_account.php">Modifier mon compte.</a></p>
                    <p class="text-center"><a href="logout.php">Deconnexion.</a></p>
                </div>
            </div>
            <?php else: ?>
            <div class="widget">
                <div class="widget-title">Connexion</div>
                <div class="widget-content">
                    <form action="login.php" method="POST">
                        <label for="username">Nom d'utilisateur :</label>
                        <input type="text" name="username" id="username" required="required">
                        <label for="password">Mot de passe :</label>
                        <input type="password" id="password" name="password" required="required">
                        <button class="btn btn-default">Connexion</button>
                        <hr>
                        <p class="text-center"><a href="register.php">Pas encore inscrit ?</a></p>
                    </form>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>