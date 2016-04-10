<?php
include ('global/global.php');
include ('lib/include.php');
include ('model/include.php');

if ($_GET['itm_id'])
{
    if (!($item = db_findItemById($_GET['itm_id'])))
    {
        add_flash_message('error', 'Cette page n\'exite pas.');
        header('Location:index.php');
        die();
    }

    render('item.php', array(
        'item'  => $item,
    ));
}
else
{
    add_flash_message('error', 'Cette page n\'existe pas.');
    header('Location:index.php');
    die();
}