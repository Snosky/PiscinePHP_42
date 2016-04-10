<?php
session_start();

if ($_GET['login'] != NULL && $_GET['passwd'] != NULL && $_GET['submit'] == 'OK')
{
    if ($_SESSION['log']['login'] == $_GET['login'])
    {
        $_SESSION['log']['passwd'] = $_GET['passwd'];
    }
    else
    {
        $_SESSION['log']['login'] = $_GET['login'];
        $_SESSION['log']['passwd'] = $_GET['passwd'];
    }
}

?>
<!DOCTYPE html>
<html>
<body>
    <form action="" method="GET">
        Identifiant: <input type="text" name="login" value="<?php echo ($_SESSION['log']['login']) ? $_SESSION['log']['login'] : '' ?>" />
        <br />
        Mot de passe: <input type="password" name="passwd" value="<?php echo ($_SESSION['log']['passwd']) ? $_SESSION['log']['passwd'] : '' ?>" />
        <br />
        <input type="submit" name="submit" value="OK" />
    </form>
</body>
</html>
