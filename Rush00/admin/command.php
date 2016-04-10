<?php
include ('../global/global.php');
include ('../global/admin_global.php');
include ('../model/include.php');

if (isset($_GET['action']) && isset($_GET['com_id']))
{
    if ($_GET['action'] == 'valid') {
        if (!(db_validCommand($_GET['com_id']))) {
            add_flash_message('error', 'Erreur lors de l\'enregistrement des donnees :' . mysqli_error($db));
        }
        // Faudrait update la quantite mais jsuis mort :(
        $command_quantity = command_extract_quantity(db_findCommandById($_GET['com_id']));
        if (empty($command_quantity))
        {
            foreach ($command_quantity as $itm_id => $quantity) {
                if (!($item = db_findItemById($itm_id))) {
                    $item['itm_quantity'] -= $quantity;
                    db_editItem($item);
                }
            }
        }
        add_flash_message('success', 'Commande valide');
        header('Location:command.php');
        die();
    }
    else if ($_GET['action'] == 'cancel')
    {
        if (!(db_cancelCommand($_GET['com_id'])))
        {
            add_flash_message('error', 'Erreur lors de l\'enregistrement des donnees :' . mysqli_error($db));
        }
        add_flash_message('success', 'Commande annule');
        header('Location:command.php');
        die();
    }
}

$command_raw = db_getAllCommand();

$command = array();
foreach ($command_raw as $k => $v) {
    $command[$k] = array(
        'com_id' => $v['com_id'],
        'com_date' => $v['com_date'],
        'com_status' => $v['com_status'],
        'com_usr'  => db_findUserById($v['usr_id'])
    );

    $command[$k]['com_total'] = 0;
    $items = unserialize($v['com_data']);
    foreach ($items as $itm_id => $itm_q) {
        if (($item = db_findItemById($itm_id))) {
            $item['wanted_quantity'] = $itm_q;
            $command[$k]['com_total'] += ($itm_q * $item['itm_price']);
            $command[$k]['items'][] = $item;
        }
    }
}

render('admin/command.php', array(
    'commands' => $command
), 'admin/layout.php');