<?php
include ('global/global.php');
include ('lib/include.php');
include ('model/include.php');

function cat_name_sort($a, $b)
{
    return strcmp($a['cat_name'], $b['cat_name']);
}

$categories = db_getAllCategory();
usort($categories, 'cat_name_sort');

foreach ($categories as $k => $v)
{
    $categories[$k]['nb_items'] = db_countItemByCategory($v['cat_id']);
}

render('index.php', array(
    'categories'    => $categories,
));