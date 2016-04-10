<?php
include ('../global/global.php');
include ('../global/admin_global.php');
include ('../model/include.php');

if (isset($_GET['usr_id']))
{
    if (!($user = db_findUserById($_GET['usr_id'])))
    {
        header('Location:user_add.php');
        die();
    }

    $form = $user;

    if ($_POST)
    {
        $form_is_valid = TRUE;
        
        //Verification username
        if (!isset($_POST['username']) || empty($_POST['username']) || strlen($_POST['username']) < 3 || strlen($_POST['username']) > 254 || !preg_match('/^[a-z\-_\ 0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]*$/i', $_POST['username']))
        {
            add_flash_message('error', 'Le champs "Nom d\'utilisateur" ne doit faire entre 3 et 254 caracteres et doit uniquement contenir des caracteres alpha-numerique');
            $form_is_valid = FALSE;
        }

        // Verification username deja utilise
        if (db_findUserByUsername($_POST['username'], $user['usr_id']) != FALSE)
        {
            add_flash_message('error', 'Le nom d\'utilisateur est deja utilise.');
            $form_is_valid = FALSE;
        }

        //Verification password
        if ($_POST['password'] != $_POST['password_conf'])
        {
            add_flash_message('error', 'Les mots de passe ne correspondent pas.');
            $form_is_valid = FALSE;
        }

        //Verification email
        if (!isset($_POST['email']) || empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            add_flash_message('error', 'L\'adresse email n\'est pas valide.');
            $form_is_valid = FALSE;
        }

        if(db_findUserByEmail($_POST['email'], $user['usr_id']) != FALSE)
        {
            add_flash_message('error', 'L\'adresse email est deja utilise.');
            $form_is_valid = FALSE;
        }
        
        if (!isset($_POST['role']) || empty($_POST['role']) || !in_array($_POST['role'], array('ROLE_ADMIN', 'ROLE_USER')))
        {
            add_flash_message('error', 'Le role n\'est pas valide.');
            $form_is_valid = FALSE;
        }

        if ($form_is_valid)
        {
            // On enregistre en bdd, on co et on redirige


            $data = array(
                'usr_id'        => $user['usr_id'],
                'usr_name'  => $_POST['username'],
                'usr_email'     => $_POST['email'],
                'usr_role'      => $_POST['role'],
            );

            if (!empty($_POST['password']))
                $data['usr_password'] = hash_pwd($_POST['password'], $user['usr_salt']);

            if (!db_editUser($data))
                add_flash_message('error', 'Erreur lors de l\'enregistrement des donnees :'.mysqli_error($db));
            else
            {
                add_flash_message('success', 'Utilisateur modifie.');
                header('Location:user.php');
                die();
            }
        }
    }

    render('admin/user_edit.php', array(
        'form'  => $form
    ), 'admin/layout.php');
}
else
{
    add_flash_message('error', 'Cette page n\'existe pas.');
    header('Location:index.php');
    die();
}