<?php
include ('../global/global.php');
include ('../global/admin_global.php');
include ('../model/include.php');

$categories = db_getAllCategory();

render('admin/category.php', array(
    'categories'    => $categories,
), 'admin/layout.php');