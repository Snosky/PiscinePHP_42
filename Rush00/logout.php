<?php
include ('global/global.php');
include ('lib/include.php');
include ('model/include.php');

if (!is_connected())
{
    add_flash_message('error', 'Cette pas n\'existe pas.');
    header('Location:index.php');
    die();
}

deconnect_user();
add_flash_message('success', 'Vous avez bien ete deconnecter.');
header('Location: ' . $_SERVER['HTTP_REFERER']);
die();