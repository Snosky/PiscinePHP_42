<?php
include ('global/global.php');
include ('lib/include.php');
include ('model/include.php');

if (!is_connected())
{
    add_flash_message('error', 'Vous devez vous connecte pour valider la commande.');
    header('Location:login.php');
    die();
}

if (get_cart())
{
    $data = array(
        'usr_id'        => get_user()['id'],
        'com_data'      => serialize(get_cart()),
        'com_status'    => -1,
    );

    $is_valid = TRUE;

    foreach (get_cart() as $itm_id => $quantity)
    {
        $item = db_findItemById($itm_id);
        if ($item['itm_quantity'] < $quantity)
        {
            add_flash_message('error', sprintf('Nous n\'avons pas le stock demande sur %s. Stock actuel %s.', $item['itm_name'], $item['itm_quantity']));
            $is_valid = FALSE;
        }
    }

    if (!$is_valid)
    {
        header('Location:cart.php');
        die();
    }


    if (!(db_addCommand($data)))
    {
        add_flash_message('error', 'Erreur lors de l\'enregistrement des donnees.');
        header('Location:cart.php');
        die();
    }
    else
    {
        add_flash_message('info', 'Votre commande est en cours de validation, vous pouvez suivre le progression sur cette page.');
        destroy_cart();
        header('Location:my_command.php');
        die();
    }
}
else
{
    add_flash_message('error', 'Cette page n\'existe pas.');
    header('Location:index.php');
    die();
}