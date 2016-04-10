<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>42commerce Administration</title>
    <link rel="stylesheet" href="../web/css/style.css">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />
</head>
<body class="admin">
    <header>
        <div class="wrap">
            <a href="../index.php"><img src="../web/img/logo-42-white.gif" alt="42commerce"></a>
            <ul class="nav">
                <li><a href="user.php">Gestion utlisateur</a></li>
                <li><a href="category.php">Gestion des categories</a></li>
                <li><a href="items.php">Gestion des articles</a></li>
                <li><a href="command.php">Gestion des commandes</a></li>
            </ul>
        </div>
    </header>

    <div class="banner wrap">
        <h3 class="text-center">:-)</h3>
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

    <div class="wrap main-content">
    <?php echo $content_for_layout; ?>
    </div>
</body>
</html>
