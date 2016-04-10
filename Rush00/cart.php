<?php
include ('global/global.php');
include ('lib/include.php');
include ('model/include.php');

if (isset($_GET['action']))
{
    if ($_GET['action'] == 'add' && $_POST)
    {
        if (!($item = db_findItemById($_POST['itm_id'])) || !isset($_POST['quantity']) || !is_numeric($_POST['quantity']) || ($item['itm_quantity'] != -1 && ($_POST['quantity'] < 0 || (int)$_POST['quantity'] > $item['itm_quantity'])))
        {
            add_flash_message('error', 'Une erreur est survenue lors de l\'ajout de l\'article au panier.');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }
        add_to_cart($item, $_POST['quantity']);
        add_flash_message('success', sprintf('L\'article <i>%s</i>(%s) a bien ete ajoute au panier.', $item['itm_name'], $_POST['quantity']));
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die();
    }
    else if ($_GET['action'] == 'del' && $_GET['quantity'] && $_GET['itm_id'])
    {
        if (!($item = db_findItemById($_GET['itm_id'])))
        {
            add_flash_message('error', 'Une erreur est survenue lors de la mise a jour du panier.');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }
        delete_item_from_cart($item, $_GET['quantity']);
        add_flash_message('success', sprintf('L\'article <i>%s</i>(%s) a bien ete supprime du panier.', $item['itm_name'], $_GET['quantity']));
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die();
    }
    else if ($_GET['action'] == 'more' && $_GET['itm_id'])
    {
        if (!($item = db_findItemById($_GET['itm_id'])))
        {
            add_flash_message('error', 'Une erreur est survenue lors de la mise a jour du panier.');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }
        add_to_cart($item, 1);
        add_flash_message('success', sprintf('L\'article <i>%s</i>(%s) a bien ete ajoute au panier.', $item['itm_name'], '1'));
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die();
    }
    else if ($_GET['action'] == 'less' && $_GET['itm_id'])
    {
        if (!($item = db_findItemById($_GET['itm_id'])))
        {
            add_flash_message('error', 'Une erreur est survenue lors de la mise a jour du panier.');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            die();
        }
        delete_item_from_cart($item, 1);
        add_flash_message('success', sprintf('L\'article <i>%s</i>(%s) a bien ete retire au panier.', $item['itm_name'], '1'));
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        die();
    }
}
else
{
    $items = array();
    if (($cart = get_cart()))
        foreach ($cart as $itm_id => $quantity)
        {
            if (($itm = db_findItemById($itm_id)))
            {
                $itm['itm_quantity'] = $quantity;
                $items[] = $itm;
            }
        }

    render('cart.php', array(
        'items' => $items,
    ));
}