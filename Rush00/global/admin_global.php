<?php
include ('../lib/include.php');

// Verification utilisateur connecter et droit
if (!is_connected() || !has_role('ROLE_ADMIN'))
{
    add_flash_message('error', 'Cette page n\'existe pas.');
    header('Location:../index.php');
    die();
    // On redirige vers la connexion
}