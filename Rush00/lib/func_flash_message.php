<?php
/**
 * Ajoute un flash message dans une categorie
 * @param $type
 * @param $message
 */
function add_flash_message($type, $message)
{
    $_SESSION['flash_message'][$type][] = $message;
}

/**
 * Renvoi tous les flash message d'une categorie
 * @param $type
 * @return array
 */
function get_flash_message($type)
{
    if (isset($_SESSION['flash_message'][$type]))
    {
        $msg = $_SESSION['flash_message'][$type];
        unset ($_SESSION['flash_message'][$type]);
        return $msg;
    }
    return array();
}

/**
 * Determine si il y as des messages flash
 * @param $type
 * @return bool
 */
function have_flash_message($type)
{
    if (empty($_SESSION['flash_message'][$type]))
        return FALSE;
    return TRUE;
}
