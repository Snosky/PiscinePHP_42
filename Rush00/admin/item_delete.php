<?php
include ('../global/global.php');
include ('../global/admin_global.php');
include ('../model/include.php');

if (isset($_GET['itm_id']))
{
    $item = db_findItemById($_GET['itm_id']);
    if ($_POST)
    {
        if ($_POST['action'] == 'true')
        {
            db_deleteItem($_GET['itm_id']);
            add_flash_message('success', sprintf("L'article %s a ete supprime.", $item['itm_name']));
        }
        header('Location:items.php');
        die();
    }
    render('admin/item_delete.php', array(
        'item'  => $item,
    ), 'admin/layout.php');
}
else
{
    add_flash_message('error', 'Cette page n\'existe pas.');
    header('Location:index.php');
    die();
}