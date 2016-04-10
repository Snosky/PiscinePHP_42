<?php
include ('../global/global.php');
include ('../global/admin_global.php');
include ('../model/include.php');

$items = db_getAllItem();

render('admin/items.php', array(
    'items' => $items,
), 'admin/layout.php');