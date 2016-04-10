<?php
include ('../global/global.php');
include ('../global/admin_global.php');
include ('../model/include.php');

if ($_GET['itm_id'])
{
    $item = db_findItemById($_GET['itm_id']);
    $item['cat_id'] = explode(',', $item['cats_id']);
    $categories = db_getAllCategory();
    $categories_id = array();
    foreach ($categories as $category) {
        $categories_id[] = $category['cat_id'];
    }


    if ($_POST) {
        $form_is_valid = TRUE;

        if (!isset($_POST['name']) || empty($_POST['name']) || strlen($_POST['name']) < 3 || strlen($_POST['name']) > 254 || !preg_match('/^[a-z\-_\ 0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]*$/i', $_POST['name'])) {
            add_flash_message('error', 'Le nom de l\'article doit etre alpha-numerique et contenir entre 3 et 253 caracteres.');
            $form_is_valid = FALSE;
        }

        if (!isset($_POST['price']) || empty($_POST['price']) || !preg_match('/^[0-9]+\.?[0-9]*$/', $_POST['price']) || $_POST['price'] < 0) {
            add_flash_message('error', 'Le prix doit etre un nombre composer de chiffre, point ou virgule.');
            $form_is_valid = FALSE;
        }

        if (!isset($_POST['quantity']) || empty($_POST['quantity']) || !is_numeric($_POST['quantity']) || $_POST['quantity'] < -1) {
            add_flash_message('error', 'La quantity doit etre un nombre compris entre -1 et infinie');
            $form_is_valid = FALSE;
        }

        if (!isset($_POST['category']) || empty($_POST['category']))
        {
            add_flash_message('error', 'La categorie n\'est pas valide.');
            $form_is_valid = FALSE;
        }
        else
            foreach ($_POST['category'] as $cat)
                if (!in_array($cat, $categories_id))
                {
                    add_flash_message('error', 'La categorie n\'est pas valide.');
                    $form_is_valid = FALSE;
                }

        $item['itm_name'] = $_POST['name'];
        $item['itm_description'] = $_POST['description'];
        $item['itm_quantity'] = $_POST['quantity'];
        $item['itm_price'] = $_POST['price'];
        $item['cat_id'] = $_POST['category'];

        if ($form_is_valid) {
            if (!db_editItem($item))
                add_flash_message('error', 'Erreur lors de l\'enregistrement des donnees :' . mysqli_error($db));
            else {
                add_flash_message('success', 'L\'article a ete cree.');
                header('Location:items.php');
                die();
            }
        }
    }


    render('admin/item_add.php', array(
        'categories' => $categories,
        'form' => $item,
    ), 'admin/layout.php');
}
else
{
    add_flash_message('error', 'Cette page n\'existe pas.');
    header('Location:index.php');
    die();
}