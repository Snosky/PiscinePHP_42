<?php
/**
 * Verifie que l'utilisateur est connecte
 * @return bool
 */
function is_connected()
{
    if (isset($_SESSION['user']))
        return TRUE;
    return FALSE;
}

/**
 * Retourne l'utilisateur courant
 * @return mixed
 */
function get_user()
{
    // Ici requete pour recup l'user et on retourn l'array
    return $_SESSION['user'];
}

/**
 * Creer la session user
 * @param $user
 */
function connect_user($user)
{
    $_SESSION['user']['name'] = $user['usr_name'];
    $_SESSION['user']['id'] = $user['usr_id'];
    $_SESSION['user']['role'] = $user['usr_role'];
}

/**
 * Verifie qu'un utilisateur a unrole
 * @param $role
 * @return bool
 */
function has_role($role)
{
    if (get_user()['role'] == $role)
        return TRUE;
    return FALSE;
}

function deconnect_user()
{
    unset($_SESSION['user']);
}