<?php
include ('global/global.php');
include ('lib/include.php');
include ('model/include.php');

if (is_connected())
{
    add_flash_message('error', 'Cette pas n\'existe pas.');
    header('Location:index.php');
    die();
}

if ($_POST)
{
    if (($user = db_findUserByUsername($_POST['username'])))
    {
        $password = hash_pwd($_POST['password'], $user['usr_salt']);
        if ($user['usr_password'] == $password)
        {
            add_flash_message('success', sprintf('Vous etes maintenant connecte en tant que %s.', $user['usr_name']));
            connect_user($user);
            header('Location:index.php');
            die();
        }
    }
    add_flash_message('error', 'Le mot de passe et l\'identifiant ne correspondent pas.');
}

render('login.php');