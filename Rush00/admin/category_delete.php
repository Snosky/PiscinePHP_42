<?php
include ('../global/global.php');
include ('../global/admin_global.php');
include ('../model/include.php');

if (isset($_GET['cat_id']))
{
    $category = db_findCategoryById($_GET['cat_id']);
    $item = db_countItemByCategory($_GET['cat_id']);
    if ($item)
    {
        add_flash_message('error', 'Des articles utilisent cette categorie, vous ne pouvez donc pas la supprimer.');
        header('Location:category.php');
        die();
    }
    if ($_POST)
    {
        if ($_POST['action'] == 'true')
        {
            db_deleteCategory($_GET['cat_id']);
            add_flash_message('success', sprintf("La categorie %s a ete supprime.", $category['cat_name']));
        }
        header('Location:category.php');
        die();
    }
    render('admin/category_delete.php', array(
        'category'  => $category,
    ), 'admin/layout.php');
}
else
{
    add_flash_message('error', 'Cette page n\'existe pas.');
    header('Location:index.php');
    die();
}