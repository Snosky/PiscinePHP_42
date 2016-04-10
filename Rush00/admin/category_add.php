<?php
include ('../global/global.php');
include ('../global/admin_global.php');
include ('../model/include.php');

$category = array();

if ($_POST)
{
    $form_is_valid = TRUE;
    
    if (!isset($_POST['name']) || empty($_POST['name']) || strlen($_POST['name']) < 3 || strlen($_POST['name']) > 254 || !preg_match('/^[a-z\-_\ 0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]*$/i', $_POST['name']))
    {
        add_flash_message('error', 'Le nom de la categorie doit etre alpha-numerique et contenir entre 3 et 253 caracteres.');
        $form_is_valid = FALSE;
    }
    
    if (db_findCategoryByName($_POST['name']))
    {
        add_flash_message('error', 'Ce nom de categorie est deja utilise.');
        $form_is_valid = FALSE;
    }

    if ($form_is_valid)
    {
        if (!db_addCategory($_POST))
            add_flash_message('error', 'Erreur lors de l\'enregistrement des donnees :'.mysqli_error($db));
        else
        {
            add_flash_message('success', 'La categorie a ete cree.');
            header('Location:category.php');
            die();
        }
    }
    
    $category['cat_name'] = $_POST['name'];
}

render('admin/category_add.php', array(
    'form'  => $category,
), 'admin/layout.php');