<?php
include ('../global/global.php');
include ('../global/admin_global.php');
include ('../model/include.php');

if ($_GET['cat_id'])
{
    if (!($category = db_findCategoryById($_GET['cat_id'])))
    {
        header('Location:category_add.php');
        die();
    }
    if ($_POST)
    {
        $form_is_valid = TRUE;

        if (!isset($_POST['name']) || empty($_POST['name']) || strlen($_POST['name']) < 3 || strlen($_POST['name']) > 254 || !preg_match('/^[a-z\-_\ 0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]*$/i', $_POST['name']))
        {
            add_flash_message('error', 'Le nom de la categorie doit etre alpha-numerique et contenir entre 3 et 253 caracteres.');
            $form_is_valid = FALSE;
        }

        if (db_findCategoryByName($_POST['name'], $category['cat_id']))
        {
            add_flash_message('error', 'Ce nom de categorie est deja utilise.');
            $form_is_valid = FALSE;
        }

        if ($form_is_valid)
        {
            $data = array(
                'cat_name'  => $_POST['name'],
                'cat_id'    => $category['cat_id']
            );

            if (!db_editCategory($data))
                add_flash_message('error', 'Erreur lors de l\'enregistrement des donnees :' . mysqli_error($db));
            else {
                add_flash_message('success', 'La categorie a ete modifie.');
                header('Location:category.php');
                die();
            }
        }
    }

    render('admin/category_add.php', array(
        'form'  => $category,
    ), 'admin/layout.php');
}
else
{
    add_flash_message('error', 'Cette page n\'existe pas.');
    header('Location:index.php');
    die();
}