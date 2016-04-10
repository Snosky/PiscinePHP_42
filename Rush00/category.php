<?php
include ('global/global.php');
include ('lib/include.php');
include ('model/include.php');

if ($_GET['cat_id'])
{
    if (!($category = db_findCategoryById($_GET['cat_id'])))
    {
        add_flash_message('error', 'Cette page n\'exite pas.');
        header('Location:index.php');
        die();
    }

    $items = db_findItemByCategory($_GET['cat_id']);

    render('category.php', array(
        'category' => $category,
        'items'     => $items,
    ));
}
else
{
    add_flash_message('error', 'Cette page n\'existe pas.');
    header('Location:index.php');
    die();
}