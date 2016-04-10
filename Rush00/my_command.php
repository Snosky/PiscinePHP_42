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

$commands_raw = db_findCommandByUser(get_user()['id']);

$command = array();
foreach ($commands_raw as $k => $v)
{
    $command[$k] = array(
        'com_id'    => $v['com_id'],
        'com_date'  => $v['com_date'],
        'com_status'    => $v['com_status'],
    );

    $command[$k]['com_total'] = 0;
    $items = unserialize($v['com_data']);
    foreach ($items as $itm_id => $itm_q)
    {
        if (($item = db_findItemById($itm_id)))
        {
            $item['itm_quantity'] = $itm_q;
            $command[$k]['com_total'] += ($itm_q * $item['itm_price']);
            $command[$k]['items'][] = $item;
        }
    }
}

render('my_command.php', array(
    'commands'  => $command
));