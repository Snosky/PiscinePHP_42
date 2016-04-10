<?php
include ('../global/global.php');
include ('../global/admin_global.php');
include ('../model/include.php');

if (isset($_GET['usr_id']))
{
    $user = db_findUserById($_GET['usr_id']);
    if ($_POST)
    {
        if ($_POST['action'] == 'true')
        {
            db_deleteUser($_GET['usr_id']);
            add_flash_message('success', sprintf("L'utilisateur %s a ete supprime.", $user['usr_name']));
        }
        header('Location:user.php');
        die();
    }
    render('admin/user_delete.php', array(
        'user'  => $user,
    ), 'admin/layout.php');
}
else
{
    add_flash_message('error', 'Cette page n\'existe pas.');
    header('Location:index.php');
    die();
}