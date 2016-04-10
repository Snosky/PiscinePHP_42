<?php
include ('../global/global.php');
include ('../global/admin_global.php');
include ('../model/include.php');

$users = db_getAllUsers();

render('admin/user.php', array(
    'users' => $users,
), 'admin/layout.php');